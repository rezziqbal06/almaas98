// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";
import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-messaging.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.4.0/firebase-analytics.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyBeGZnEqypNa88Haer2ZUM3L7iSi7RQvZo",
  authDomain: "almaas-198bc.firebaseapp.com",
  projectId: "almaas-198bc",
  storageBucket: "almaas-198bc.appspot.com",
  messagingSenderId: "1014167839012",
  appId: "1:1014167839012:web:6d9906dadd7635674453b1",
  measurementId: "G-N3QRP1TY30"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

// Initialize Firebase Cloud Messaging and get a reference to the service
const messaging = getMessaging(app);

// Function to request notification permission
async function requestNotificationPermission() {
    try {
        const permission = await Notification.requestPermission();
        if (permission === 'granted') {
            getToken(messaging, { vapidKey: 'BAFLt2QBitg-j1o8_ltnSNhU_9wdPdXRqlYkMREoVEU2Iuj1qBDO5zz2nbLfWyeqJKQIkFss-tJfJR7RaLb7Yts' }).then((currentToken) => {
                if (currentToken) {
                    // Send the token to your server and update the UI if necessary
                    // ...
                    console.log(currentToken, 'token')
                } else {
                    // Show permission request UI
                    console.log('No registration token available. Request permission to generate one.');
                    // ...
                }
            }).catch((err) => {
                console.log('An error occurred while retrieving token. ', err);
            // ...
            });
        }
    } catch (error) {
        console.error("Error requesting notification permission:", error);
    }
}

