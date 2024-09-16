<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <hr>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">client_name</th>
                        <th scope="col">lawyer_name</th>
                        <th scope="col">meeting_end_at</th>
                        <th scope="col">meeting_id</th>
                        <th scope="col">recording_by</th>
                        <th scope="col">slot_id</th>
                        <th scope="col">time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody"></tbody>
            </table>
        </div>
    </section>
</div>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-firestore.js"></script>



<script id="MainScript">

// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyAYGpBtLHgW1jtChM3Pv6Ap_iwbJ0MKxmI",
  authDomain: "videocallinsaaf99.firebaseapp.com",
  projectId: "videocallinsaaf99",
  storageBucket: "videocallinsaaf99.appspot.com",
  messagingSenderId: "97464620767",
  appId: "1:97464620767:web:e95ce979af23b2c0fd3b6a",
  measurementId: "G-GTXCW60RCE"
};



firebase.initializeApp(firebaseConfig);
let db = firebase.firestore();
//  Get All Data start===========================================
function GetAllDocumentOnce() { //function to All Data
    db.collection("recording").get().then((querySnapshot)=>{
        var listArray = [];

        querySnapshot.forEach(doc => {
            listArray.push(doc.data());
        });
        addAllItemToTheTable(listArray)
        // console.log(querySnapshot)
        console.log(listArray)
    })
}
window.onload = GetAllDocumentOnce;
// Get All Data End===========================================
// Add Item to table start=====================================
var sdtNo = 1;
var tbody = document.getElementById('tbody');
  function addItemToTable(client_name,lawyer_name,meeting_end_at,meeting_id,recording_by,slot_id,time,audio){
    var trow =document.createElement('tr');
    var td1 =document.createElement('td');
    var td2 =document.createElement('td');
    var td3 =document.createElement('td');
    var td4 =document.createElement('td');
    var td5 =document.createElement('td');
    var td6 =document.createElement('td');
    var td7 =document.createElement('td');
    var td8 =document.createElement('td');
    var td9 =document.createElement('td');
    var td10 =document.createElement('td');

    td1.innerHTML = stdNo++;
    td2.innerHTML = client_name;
    td3.innerHTML = lawyer_name;
    td4.innerHTML = meeting_end_at;
    td5.innerHTML = meeting_id;
    td6.innerHTML = recording_by;
    td7.innerHTML = slot_id;
    td8.innerHTML = time;
    td9.innerHTML = audio;
    td10.innerHTML = '<span class="btn btn-success">Play</span>';
   
    trow.appendChild(td1);
    trow.appendChild(td2);
    trow.appendChild(td3);
    trow.appendChild(td4);
    trow.appendChild(td5);
    trow.appendChild(td6);
    trow.appendChild(td7);
    trow.appendChild(td8);
    trow.appendChild(td9);
    trow.appendChild(td10);

    tbody.appendChild(trow);
  }

  function addAllItemToTheTable(RecordDocList){
    stdNo = 1;
    tbody.innerHTML = "";
    RecordDocList.forEach(element => {
        addItemToTable(element.client_name,element.lawyer_name,element.meeting_end_at,element.meeting_id,element.recording_by,element.slot_id,element.time,element.audio);
    });

  }
//Add Item to table End===========================================
</script>


<script type="module">
//Inport and configration Section ========================================

//   Import the functions you need from the SDKs you need
import {initializeApp} from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";

const firebaseConfig = {
    apiKey: "AIzaSyB2G2W6nwVqJVYwWi7yVNWgtBoSN3mDvyo",
    authDomain: "audiorec-bb825.firebaseapp.com",
    projectId: "audiorec-bb825",
    storageBucket: "audiorec-bb825.appspot.com",
    messagingSenderId: "675165290240",
    appId: "1:675165290240:web:7249236fc446dd86647de5"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

import {
    getFirestore,
    doc,
    getDoc,
    setDoc,
    collection,
    addDoc,
    updateDoc,
    deleteDoc,
    deleteField
}
from "https://www.gstatic.com/firebasejs/9.17.1/firebase-firestore.js"

const db = getFirestore(); // this use to get database

//Common Code ========================================
var name = document.getElementById('name'); 
var email = document.getElementById('email'); 
var mobile = document.getElementById('mobile'); 


$(".save").click(function() {
    AddDocument_AutoID();
})
$(".savebyname").click(function() {
    AddDocument_CustomID();
})
$(".get").click(function() {
    GetAllDocument();
})
$(".update").click(function() {
    UpdateDocument();
})
$(".delete").click(function() {
    DeleteDocument();
})

//Save Data ======================================================================
//function to add with rendom ID
async function AddDocument_AutoID() {
    var ref = collection(db, "RecordList");

    const docRef = await addDoc(
            ref, {
                Name: name.value,
                email: email.value,
                mobile: mobile.value
            })
        .then(() => {
            alert("Data Added !");
        })
        .catch((error) => {
            alert("Failed to save");
        });

}

//function to add with custom ID
async function AddDocument_CustomID() { 
    var ref = doc(db, "RecordList", name.value);

    await setDoc(
            ref, {
                name: name.value,
                email: email.value,
                mobile: mobile.value
            }
        )
        .then(() => {
            alert("Data Added !");
        })
        .catch((error) => {
            alert("Failed to save");
        })
}



// Get Data Start===========================================
//function to get with rendom ID
async function GetDocument() { 
    var ref = doc(db, "RecordList", name.value);
    var docSnap = await getDoc(ref);

    if (docSnap.exists()) {
        name.value = docSnap.data().name;
        email.value = docSnap.data().email;
        mobile.value = docSnap.data().mobile;
    } else {
        alert("No such Document");
    }

}

//Update Data Start===========================================
 //function to update
async function UpdateDocument() {
    var ref = doc(db, "RecordList", name.value);
    await updateDoc(
            ref, {
                Name: name.value,
                email: email.value,
                mobile: mobile.value
            })
        .then(() => {
            alert("Data Updated !");
        })
        .catch((error) => {
            alert("Failed to Updated");
        })
}

// Get Delete Data start===========================================
//function to Delete with rendom ID
async function DeleteDocument() { 
    var ref = doc(db, "RecordList", name.value);
    var docSnap = await getDoc(ref);

    if (!docSnap.exists()) {
        alert("Failed to Delete");
        return;
    } else {
        await deleteDoc(ref)
            .then(() => {
                alert("Data Deleted !");
            })
            .catch((error) => {
                alert("Failed to Delete");
            })
    }

}

// <!-- firebase database code  end-->
</script>