<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Traits\FirebaseAuthTrait;
use App\Traits\FirebaseMessagingTrait;
use AnthonyMartin\GeoLocation\GeoPoint;
use App\Services\FirestoreRestService;
use App\Services\AutoAssignmentService;
use App\Models\AutoAssignment;
use App\Models\User;
use App\Traits\GoogleMapApiTrait;
use Carbon\Carbon;

class TaxiOrderMatchingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use FirebaseAuthTrait, FirebaseMessagingTrait;
    use GoogleMapApiTrait;


    public $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // // logger("Taxi order matching");

        // // logger("Order loaded ==> " . $order->code . "");
        //
        $order = $this->order;
        $order->refresh();
        //check if driver as been assinged to order now
        if (!empty($order->driver_id) || in_array($order->status, ["cancelled", "delivered", "failed", "scheduled"])) {
            // logger("Driver has been assigned. Now closing matching for order ==> {$order->code}");
            return;
        }

        try {
            $pickupLocationLat = $order->taxi_order->pickup_latitude;
            $pickupLocationLng = $order->taxi_order->pickup_longitude;
            //
            $pickupLat = "" . $order->taxi_order->pickup_latitude . "," . $order->taxi_order->pickup_longitude;
            $dropoffLat = "" . $order->taxi_order->dropoff_latitude . "," . $order->taxi_order->dropoff_longitude;
            //earth distance of order
            $geopointA = new GeoPoint($pickupLocationLat, $pickupLocationLng);
            $geopointB = new GeoPoint(0.00, 0.00);
            $earthDistance = $geopointA->distanceTo($geopointB, 'kilometers');

            //
            $driverSearchRadius = setting('driverSearchRadius', 10);
            $earthDistanceToNorth = $earthDistance + $driverSearchRadius;
            $earthDistanceToSouth = $earthDistance - $driverSearchRadius;
            //
            $rejectedDriversCount = AutoAssignment::where(
                'order_id',
                $order->id,
            )->count();
            //find driver within that range
            $firestoreRestService = new FirestoreRestService();
            $driverDocuments = $firestoreRestService->whereAvailableTaxiDriversBetween(
                $earthDistanceToNorth,
                $earthDistanceToSouth,
                $order->taxi_order->vehicle_type_id,
                $rejectedDriversCount,
            );
            // // logger("Drivers found for order =>" . $order->code . "", [$driverDocuments]);

            //if no driver was found, create another delayed job
            if (empty($driverDocuments)) {
                // logger("No Driver found. Now rescheduling the order for another time");
                TaxiOrderMatchingJob::dispatch($order)
                    ->delay(
                        now()->addSeconds(setting('delayResearchTaxiMatching', 30))
                    );
                return;
            }



            //
            foreach ($driverDocuments as $driverData) {

                //found closet driver
                $driver = User::where('id', $driverData["id"])->first();
                if (empty($driver)) {
                    continue;
                }
                //check if he/she has a pending auto-assignment
                $anyPendingAutoAssignment = AutoAssignment::where([
                    'driver_id' => $driver->id,
                    'status' => "pending",
                ])->first();

                if (!empty($anyPendingAutoAssignment)) {
                    // logger("there is pending auto assign");
                    continue;
                }

                //check if he/she has a pending auto-assignment
                $rejectedThisOrderAutoAssignment = AutoAssignment::where([
                    'driver_id' => $driver->id,
                    'order_id' => $order->id,
                    'status' => "rejected",
                ])->first();

                if (!empty($rejectedThisOrderAutoAssignment)) {
                    // logger("" . $driver->name . " => rejected this order => " . $order->code . "");
                    continue;
                } else {
                    // logger("" . $driver->name . " => is being notified about this order => " . $order->code . "");
                }


                try {


                    \DB::beginTransaction();

                    //assign order to him/her
                    $autoAssignment = new AutoAssignment();
                    $autoAssignment->order_id = $order->id;
                    $autoAssignment->driver_id = $driver->id;
                    $autoAssignment->save();

                    //add the new order to it
                    $driverDistanceToPickup = $this->getDistance(
                        [
                            $pickupLocationLat,
                            $pickupLocationLng
                        ],
                        [
                            $driverData["lat"],
                            $driverData["long"],
                        ]
                    );



                    //pickup data 
                    $pickup = [
                        'lat' => $pickupLocationLat,
                        'lng' => $pickupLocationLng,
                        'address' => $order->taxi_order->pickup_address,
                    ];


                    //dropoff data
                    $dropoffLocationLat = $order->taxi_order->dropoff_latitude;
                    $dropoffLocationLng = $order->taxi_order->dropoff_longitude;
                    $dropoff = [
                        'lat' => $dropoffLocationLat,
                        'lng' => $dropoffLocationLng,
                        'address' => $order->taxi_order->dropoff_address,
                    ];


                
                    //get when the order can expire
                    $newTimestamp = $this->getExpireTimestamp($order);
                    //
                    $newOrderData = [
                        "dropoff" => json_encode($dropoff),
                        "pickup" => json_encode($pickup),
                        'amount' => (string)$order->total,
                        'total' => (string)$order->total,
                        'id' => (string)$order->id,
                        'range' => (string) $driverSearchRadius,
                        'status' => (string)$order->status,

                        'trip_distance' => $this->getRelativeDistance($pickupLat, $dropoffLat),
                        'code' => $order->code,
                        'vehicle_type_id' => $order->taxi_order->vehicle_type_id,
                        'earth_distance' => $this->getEarthDistance(
                            $order->taxi_order->pickup_latitude,
                            $order->taxi_order->pickup_longitude,
                        ),
                        'exipres_at' => $newTimestamp,
                        'exipres_at_timestamp' => Carbon::createFromTimestamp($newTimestamp)->toDateTimeString(),

                    ];
                    //send the new order to driver via push notification
                    $autoAssignmentSerivce = new AutoAssignmentService();
                    $autoAssignmentSerivce->saveNewOrderToFirebaseFirestore(
                        $driver,
                        $newOrderData,
                        $pickup["address"],
                        $driverDistanceToPickup
                    );
                    //

                    \DB::commit();
                } catch (\Exception $ex) {
                    \DB::rollback();
                    logger("Skipping Taxi Order Matching", [$ex]);
                }
            }
        } catch (\Exception $ex) {
            logger("Skipping Order", [$order->id]);
            logger("Order Error", [$ex->getMessage() ?? '']);
        }

        //queue another check to resend order incase no driver accepted the order
        // logger("queue another check to resend order incase no driver accepted the order");
        $alertDuration = ((int) setting('alertDuration', 15)) + 10;
        TaxiOrderMatchingJob::dispatch($order)
            ->delay(
                now()->addSeconds($alertDuration)
            );
    }


    //
    public function getDistance($loc1, $loc2)
    {
        $geopointA = new GeoPoint($loc1[0], $loc1[1]);
        $geopointB = new GeoPoint($loc2[0], $loc2[1]);
        return $geopointA->distanceTo($geopointB, 'kilometers');
    }

    public function getExpireTimestamp($order)
    {
        $currentTimeStamp = Carbon::now()->timestamp;
        $nextTimestamp = $currentTimeStamp + (setting('alertDuration', 15) * 1000);
        return $nextTimestamp;
    }
}
