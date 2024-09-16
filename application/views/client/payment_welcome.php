<style>
.___not__found img {
    width: 400px;
}

.link_404 {
    background: #f0c14b;
    padding: 0.4rem 4rem;
    color: #000;
    font-weight: 700;
}
.__meet{
    color:#008609;
}
#demo{
    color:#0008b1;
}
</style>


<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12  text-center">
                <div class="___not__found mt-5">
                    <img src="https://insaaf99.com/assets/images/law_logo.png" alt="" style="width:78px;">
                    <h3 class="__meet"><?php echo (isset($_GET['pay_msg']) && !empty($_GET['pay_msg']))? $_GET['pay_msg']:'';?></h3>
                    <h3 id="demo"></h3>
                </div>
                <div class="contant_box_404">
                    <div class="mb-5 mt-4">
                        <a href="https://play.google.com/store/apps/details?id=com.insaaf99&pli=1" class=" btn link_404">Download App</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<script>
var timer2 = '02:00';
    var interval = setInterval(function() {
        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;

        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        document.getElementById("demo").innerHTML = minutes + " minute " + seconds + " second ";

        if ((seconds <= 0) && (minutes <= 0)) {
window.location.replace('https://play.google.com/store/apps/details?id=com.insaaf99&pli=1');
// window.location.replace("https://call.insaaf99.com/#/v?t="+type+"&s="+slotId+"&i="+userId);
        }
        timer2 = minutes + ':' + seconds;
    }, 1000);

</script>