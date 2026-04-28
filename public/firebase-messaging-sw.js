importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.2/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyCpMeNB28hIZo_NBQrXjpez83FGanXVos4",
  authDomain: "absensi-sekolah-f641b.firebaseapp.com",
  projectId: "absensi-sekolah-f641b",
  messagingSenderId: "786384334590",
  appId: "1:786384334590:web:69a126eae3aec0155d7faf"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log('Background message:', payload);

    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
        icon: '/icon.png'
    });
});