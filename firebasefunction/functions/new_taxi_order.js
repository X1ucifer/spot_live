// The Cloud Functions for Firebase SDK to create Cloud Functions and set up triggers.
const functions = require('firebase-functions');
const crypto = require("crypto");
const admin = require('firebase-admin');

//listen to new taxi order
exports.newTaxiOrder = functions.firestore.document('/newTaxiOrders/{documentId}')
    .onCreate(async (snap, context) => {
        //new Taxi order data
        const newTaxiOrder = snap.data();
        let earthDistanceNorth = newTaxiOrder.earth_distance + newTaxiOrder.range;
        let earthDistanceSouth = newTaxiOrder.earth_distance - newTaxiOrder.range;
        if (earthDistanceNorth == null || earthDistanceSouth == null || newTaxiOrder.vehicle_type_id == null) {
            return;
        }
        let notifyDrivers = newTaxiOrder.notify;
        let orderCoder = context.params.documentId;
        //find nearby drivers
        const db = admin.firestore();
        const driversRef = db.collection('drivers');


        // Create a query against the collection
        const drivers = await driversRef.where('earth_distance', '<=', earthDistanceNorth)
            .where('earth_distance', '>=', earthDistanceSouth)
            //if driver is online
            .where('online', "==", 1)
            //if driver has not trip
            .where('free', "==", 1)
            //same vehicle type 
            .where("vehicle_type_id", "==", newTaxiOrder.vehicle_type_id)
            .limit(notifyDrivers)
            .get();

        //
        if (drivers.empty) {
            console.warn('No driver within range');
            return;
        }

        //loop through drivers, then call api to send notification to drivers
        drivers.forEach(async (driver) => {

            const timestamp = Date.now();
            const newTimestamp = timestamp + ((snap.data().notificationTime ? snap.data().notificationTime : 15) * 1000);

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
            //
            //fetch data from that node
            const driverId = driver.id;
            const driverNewOrderRef = db.collection("driver_new_order").doc(driverId.toString());
            const driverNewOrder = await driverNewOrderRef.get()
            // make sure the node is empty before pushing
            if (!driverNewOrder.exists) {
                var write = driverNewOrderRef.set(notificationData);
                console.info('Driver has been notified of new taxi order', driverId);
            } else {
                console.warn('Found Driver but had pending order notification');
            }
        });


        return;
    });


//order ignoredDrivers updated
exports.ignoredDriversUpdated = functions.firestore.document('/newTaxiOrders/{documentId}')
    .onUpdate(async (snap, context) => {
        //taxi order data
        let orderCoder = context.params.documentId;
        const prevTaxiOrder = snap.before.data();
        const newTaxiOrder = snap.after.data();

        //check the new data, 
        if (prevTaxiOrder.ignoredDrivers === newTaxiOrder.ignoredDrivers) {
            //ignored drivers is yet to be update
            return;
        } else {

            //
            let earthDistanceNorth = newTaxiOrder.earth_distance + newTaxiOrder.range;
            let earthDistanceSouth = newTaxiOrder.earth_distance - newTaxiOrder.range;
            if (earthDistanceNorth == null || earthDistanceSouth == null || newTaxiOrder.vehicle_type_id == null) {
                return;
            }

            let notifyDrivers = newTaxiOrder.notify + newTaxiOrder.ignoredDrivers.length;
            let orderCoder = context.params.documentId;
            //find nearby drivers
            const db = admin.firestore();
            const driversRef = db.collection('drivers');

            // Create a query against the collection
            const drivers = await driversRef.where('earth_distance', '<=', earthDistanceNorth)
                .where('earth_distance', '>=', earthDistanceSouth)
                //if driver is online
                .where('online', "==", 1)
                //if driver has not trip
                .where('free', "==", 1)
                //same vehicle type 
                .where("vehicle_type_id", "==", newTaxiOrder.vehicle_type_id)
                .limit(notifyDrivers)
                .get();

            //
            if (drivers.empty) {
                console.warn('No driver within range');
                return;
            }

            //loop through drivers, then call api to send notification to drivers
            drivers.forEach(async (driver) => {

                //if driver is in the ingored drivers, then skip the loop
                if (newTaxiOrder.ignoredDrivers.includes(driver.id)) {
                    return;
                }

                const timestamp = Date.now();
                const newTimestamp = timestamp + ((snap.data().notificationTime ? snap.data().notificationTime : 15) * 1000);

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

                //
                //fetch data from that node
                const driverId = driver.id;
                const driverNewOrderRef = db.collection("driver_new_order").doc(driverId.toString());
                const driverNewOrder = await driverNewOrderRef.get()
                // make sure the node is empty before pushing
                if (!driverNewOrder.exists) {
                    var write = driverNewOrderRef.set(notificationData);
                    console.info('Driver has been notified of new taxi order');
                } else {
                    console.warn('Found Driver but had pending order notification');
                }

            });
        }

        return true;
    });


