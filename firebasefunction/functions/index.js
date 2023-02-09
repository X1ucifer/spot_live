// The Firebase Admin SDK to access Firestore.
const admin = require('firebase-admin');
admin.initializeApp();
admin.firestore().settings({ ignoreUndefinedProperties: true });

exports.taxiOrder = require('./new_taxi_order');
exports.driverTracking = require('./driver_tracking');
exports.cronHandler = require('./cron_handler');