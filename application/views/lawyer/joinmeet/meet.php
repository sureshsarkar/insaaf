<style>
p {
    text-align: center;
    font-size: 60px;
    margin-top: 0px;
}

.meettext {
    text-align: center;
    background: linear-gradient(to left, #47CF0C 0%, #01b7f4 50%, #df2ee5 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

#demo {
    background: linear-gradient(to left, #abd599 0%, #1161dd 50%, #e91af1 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.video_call{
    position: absolute;
    top: 125%;
    left: 45%;
    font-size: 100;
    background: linear-gradient(to left, #1a67d7 63%, #1161dd 77%, #b047e2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>lawyer/meeting/index/<?=$_SESSION['id']?>"> <i
                    class="fa fa-sitemap" aria-hidden="true"></i>Go To Meeting List</a>

        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h2 class="meettext">Your meeting will start after</h2>
                <p id="demo"></p>

                <i class="fa fa-video-camera video_call"></i>
            </div>

        </div>
    </section>
</div>
<script>
                // Set the date we're counting down to
                // var date ="10/05/22";
                var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
                // var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="demo"
                    document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " +
                        seconds + "s ";

                    // If the count down is over, write some text 
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                    }
                }, 1000);
                </script>