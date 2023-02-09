// The Cloud Functions for Firebase SDK to create Cloud Functions and set up triggers.
const functions = require('firebase-functions');
const crypto = require("crypto");
const admin = require('firebase-admin');

//listen to new taxi order
exports.newDriverData = functions.firestore.document('/drivers/{documentId}')
    .onCreate(async (snap, context) => {

        // taxi order data
        let driverId = context.params.documentId;
        const newDriverData = snap.after.data();
        //if driver is frr and online 
        if (snap != null && newDriverData != null) {
            findAndNotifyDriver(snap.after.data(), newDriverData, driverId);
        }
        return true;
    });


//order ignoredDrivers updated
exports.driverDataUpdated = functions.firestore.document('/drivers/{documentId}')
    .onUpdate(async (snap, context) => {

        // taxi order data
        let driverId = context.params.documentId;
        const newDriverData = snap.after.data();
        //if driver is frr and online 
        if (snap != null && newDriverData != null) {
            findAndNotifyDriver(snap.after.data(), newDriverData, driverId);
        }
        return true;
    });



//
const findAndNotifyDriver = async (snapData, newDriverData, driverId) => {
    // Very long calculation
    if (newDriverData.free == 1 && newDriverData.online == 1) {
        //get the nearby new taxi order
        let driverSearchRrange = newDriverData.range ? newDriverData.range : 10;
        let earthDistanceNorth = newDriverData.earth_distance + driverSearchRrange;
        let earthDistanceSouth = newDriverData.earth_distance - driverSearchRrange;
        if (earthDistanceNorth == null || earthDistanceSouth == null || newDriverData.vehicle_type_id == null) {
            return;
        }
        //
        const db = admin.firestore();
        const newTaxiOrdersRef = db.collection('newTaxiOrders');
        const newTaxiOrders = await newTaxiOrdersRef.where('earth_distance', '<=', earthDistanceNorth)
            .where('earth_distance', '>=', earthDistanceSouth)
            .where("vehicle_type_id", "==", newDriverData.vehicle_type_id)
            .limit(1)
            .get();

        //
        if (newTaxiOrders.empty) {
            console.warn('No new taxi order within range');
            return;
        }

        const newTaxiOrder = newTaxiOrders.docs[0];
        if (newTaxiOrder == null) {
            console.warn('Found taxi order is null');
            return;
        }
        console.info("Got New Taxi Order", JSON.stringify(newTaxiOrder));

        //loop through drivers, then call api to send notification to drivers
        //if driver is in the ingored drivers, then skip the loop
        if (newTaxiOrder.ignoredDrivers != null && newTaxiOrder.ignoredDrivers.includes(driverId)) {
            console.warn('Driver ignored this order');
            return;
        }

        //
        const timestamp = Date.now();
        const newTimestamp = timestamp + ((snapData.notificationTime ? snapData.notificationTime : 15) * 1000);
        //notification data
        let notificationData = {
            pickup: JSON.stringify(newTaxiOrder.pickup),
            dropoff: JSON.stringify(newTaxiOrder.dropoff),
            amount: newTaxiOrder.amount.toString(),
            total: newTaxiOrder.total.toString(),
            id: newTaxiOrder.id.toString(),
            range: newTaxiOrder.range.toString(),
            status: newTaxiOrder.status.toString(),
            trip_distance: newTaxiOrder.trip_distance.toString(),
            code: newTaxiOrder.trip_distance.toString(),
            vehicle_type_id: newTaxiOrder.vehicle_type_id.toString(),
            earth_distance: newTaxiOrder.earth_distance.toString(),
            exipres_at: newTimestamp,
            exipres_at_timestamp: new Date(newTimestamp),
        };
        //fetch data from that node
        const driverNewOrderRef = db.collection("driver_new_order").doc(driverId.toString());
        const driverNewOrder = (await driverNewOrderRef.get()).data;
        // make sure the node is empty before pushing
        if (driverNewOrder == null) {
            var write = driverNewOrderRef.set(notificationData);
            console.info('Driver has been notified of new taxi order');
        } else {
            console.warn('Found Driver but had pending order notification');
        }

    }
    return true;
}


