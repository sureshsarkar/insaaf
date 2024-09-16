<style>
    #demo{
    text-align: center;
    padding: 11px;
    margin:0px;
    font-size:19px;
    font-family: sans-serif;
    /* color: #2a00ff; */
    color: linear-gradient(to right,red,orange,yellow,green,blue,indigo,violet,red);
    background-image: linear-gradient(to right,red,orange,#0037ff,#910fbb,#1079e5,indigo,violet,red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    animation: rainbow-animation 400s linear infinite;
    }
    .__meet{
        text-align:center;
        margin:auto;
        font-size: 26px;
        font-family:sans-serif;
        color:#01ab45;
        /* padding-top: 10px; */

    }
    .meeting_body{
      text-align: center;
    width: auto;
    height: auto;
    background: #fff9f9;
    padding: 14%;
    margin-top: 10%;
    border-radius:3px;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }
   .mbody {
    width: 50%;
    margin: auto;
    }
    body {
      margin:0;
    }
    .hidden{
      display: none;
    }
</style>
<script>
// Set the date we're counting down to
var meetTime = "<?php echo $link->meeting_time;?>";

var countDownDate = new Date(meetTime).getTime();
// get php variable data 
var timeDiff = "<?php echo $timeDiff;?>";
var type = "<?php echo $type;?>";
var slotId = "<?php echo $slotId;?>";
var userId = "<?php echo $userId;?>";
var TeamsMeetingLink = "<?php echo $TeamsMeetingLink;?>";

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + " day " + hours + " hour " + minutes + " minute " + seconds + " second ";
 
    // return false;
    //  window.location.replace(url);
  // If the count down is over, write some text 
  if (distance < 0){
    window.location.replace(TeamsMeetingLink);
    //  window.location.replace("https://call.insaaf99.com/#/v?t="+type+"&s="+slotId+"&i="+userId);
    // var urldata ="https://call.insaaf99.com/#/v?t="+type+"&s="+slotId+"&i="+userId ;
  
    clearInterval(x);
    // document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
