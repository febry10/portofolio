// Initialize Firebase
const firebaseConfig = {
    apiKey: "AIzaSyCekv3ZfpuCVeSqak69g-QS3VBPS5KdG38",
    authDomain: "blacklotus-db.firebaseapp.com",
    projectId: "blacklotus-db",
    storageBucket: "blacklotus-db.appspot.com",
    messagingSenderId: "358130544819",
    appId: "1:358130544819:web:9f2951f99d81b40e0a2e74",
    measurementId: "G-QKZVZXPT1P",
    databaseURL: "https://blacklotus-db-default-rtdb.firebaseio.com/",
  };
  
  firebase.initializeApp(firebaseConfig);
  const database = firebase.database();
  const auth = firebase.auth();
  