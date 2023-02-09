// The Cloud Functions for Firebase SDK to create Cloud Functions and set up triggers.
const functions = require('firebase-functions');
const admin = require('firebase-admin');


//
// exports.scheduledFunction = functions.pubsub.schedule('every 1 minutes').onRun(async (context) => {
//     //clear any assgined order to driver_new_order node, if it has expired
//     //find expired orders
//     const db = admin.firestore();
//     const driverNewOrdersRef = db.collection('driver_new_order');
//     const timestamp = Date.now();

//     // Create a query against the collection
//     const pastOrders = await driverNewOrdersRef.where('exipres_at', '<', timestamp)
//         .limit(50)
//         .get();

//     //delete all of them
//     pastOrders.forEach(pastOrder => {
//         pastOrder.ref.delete();
//     });
//     return null;
// });


//listen to driver new order
// exports.driverNewOrder = functions.firestore.document('/driver_new_order/{documentId}')
//     .onCreate(async (snap, context) => {

//         console.warn("A new driver_new_order document created ");
//         const timestamp = Date.now();
//         const newTimestamp = timestamp + ((snap.data().notificationTime ? snap.data().notificationTime : 15) * 1000);
//         //
        
//         return snap.ref.set({
//             exipres_at: newTimestamp,
//             exipres_at_timestamp: new Date(newTimestamp),
//         }, { merge: true });
//     });




