
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/client_register.css"> 

<section class="bg_log text-center pt-2 ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 marg">
                <div class="example1">
                    <div class="w3-bar w3-black p-1 poinred_btnn d-flex justify-content-center">
                        <button class="w3-bar-item w3-button  insaaf-log"
                            onclick="openCity('register')"><?=$this->lang->line('regi_lregister');?> </button>
                        <button class="w3-bar-item w3-button  ml-2 insaaf-log"
                            onclick="openCity('login')"><?=$this->lang->line('Login_lregister');?> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
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
        </div>
    </div>
</section>

<section class="__register_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="start_Form">

                    <!-- client registration start -->
                    <div id="register" class="w3-container lawyer" style="display:none">
                        <div id="allSet">
                            <div class="modal-body">
                                <div class="container GIF_hide">
                                    <div class="row">
                                        <div class="col-sm-12 text-center py-3">
                                            <img src="<?php echo base_url('assets/images/loader.gif') ?>" alt=""
                                                width="20%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="needs-validation __formHide formClass" id="client_register"
                                action="<?=base_url()?>signup_ajax/register" method="post"
                                enctype="multipart/form-data">
                                <div class="accordion">
                                    <div class="card formInnerCon1 card__insaff mt-5" id="formAreaCon1">
                                        <div id="collapseOne" class="show collapse biiling_details_bg "
                                            aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="Insaafcard-body">
                                                <div class="modal-header1 text-center p-2">
                                                    <h1 class="swing-top-fwd "
                                                        style="color:#fff; margin-bottom: 0.5rem;   font-family: 'bootstrap-icons';font-size: 1.5rem;font-weight: 700;">
                                                        <?=$this->lang->line('register_client');?>
                                                    </h1>
                                                </div>
                                                <div class="card-body">
                                                    <div class="Register"> </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label
                                                                for="firstName"><?=$this->lang->line('fname_contact');?>
                                                                <span class="text-muted">*</span></label>
                                                            <input type="text" class="form-control new_control"
                                                                maxlength="25" id="firstName" placeholder=""
                                                                name="fname" value="" required="">
                                                            <div class="invalid-feedback">
                                                                Valid first name is required.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label
                                                                for="lastName"><?=$this->lang->line('lname_contact');?>
                                                            </label>
                                                            <input type="text" class="form-control new_control"
                                                                maxlength="25" name="lname" id="lastName" placeholder=""
                                                                value="">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="email"><?=$this->lang->line('email_contact');?>
                                                                <span class="text-muted">*</span></label>
                                                            <input type="email" class="form-control new_control"
                                                                maxlength="128" name="email" id="email_add" value=""
                                                                required="required">
                                                            <div class="otp_msg_email"></div>

                                                            <section class="hide_email">
                                                                <div class="form-group show_emai_otp m-0"
                                                                    id="emailotpdiv">
                                                                    <input type="text" class="form-control"
                                                                        id="email_otp" placeholder="Enter Email OTP">
                                                                    <br>
                                                                    <div class="countdown_email"></div>
                                                                </div>
                                                                <button type="button" id="sendotp_email"
                                                                    class="btn btn-primary"><?=$this->lang->line('sotp_lregister');?>
                                                                </button>
                                                                <button type="button" id="verifyemailotp"
                                                                    class="btn btn-primary hide_email_btn"><?=$this->lang->line('votp_lregister');?>
                                                                </button>
                                                            </section>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label
                                                                for="mobile"><?=$this->lang->line('mobile_contact');?>
                                                                <span class="text-muted">*</span></label>
                                                            <input type="text"
                                                                class="form-control new_control clientMobileNum"
                                                                base_url="<?= base_url();?>" minlength="10"
                                                                maxlength="10" id="mob" name="mobile" value=""
                                                                required="">
                                                            <span class="numberexist text-danger"></span>
                                                            <div class="invalid-feedback">
                                                                Please Enter valid mobile number
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="otp_msg">
                                                    </div>
                                                    <section class="hide_sec" id="hide_sec">
                                                        <div class="form-group">
                                                            <input type="hidden" class="url"
                                                                value="<?=base_url()?>signup_ajax/otp_verify">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group show_otp" id="otpdiv">
                                                                <label
                                                                    for="otp verification"><?=$this->lang->line('otp_lregister');?>
                                                                </label>
                                                                <input type="text" class="form-control" id="otp"
                                                                    placeholder="Enter OTP">
                                                                <br>
                                                                <div class="countdown_email"></div>

                                                            </div>
                                                            <a href="#" id="resend_otp"
                                                                type="button"><?=$this->lang->line('rotp_lregister');?>
                                                            </a>
                                                        </div>
                                                        <button type="button" id="sendotp"
                                                            class="btn btn-primary"><?=$this->lang->line('sotp_lregister');?>
                                                        </button>
                                                        <button type="button" id="verifyotp"
                                                            class="btn btn-primary hide_but"><?=$this->lang->line('votp_lregister');?>
                                                        </button>
                                                    </section>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="password"
                                                                class="mt-3"><?=$this->lang->line('set_pass_lregister');?>
                                                                <span class="text-muted">*</span></label>
                                                            <input id="SetNewPassClientRe" type="password"
                                                                class="form-control new_control" maxlength="255"
                                                                name="password" value="" required="required"><i
                                                                class="bi bi-eye-fill set_pass_eye"></i>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-check" style="margin-top: 28px;">
                                                                <input type="checkbox" class="form-check-input"
                                                                    name="term_condi" required="required"
                                                                    id="exampleCheck1">
                                                                <label class="form-check-label" for="exampleCheck1"><a
                                                                        href="<?=base_url()?>signup_ajax/client_term"><?=$this->lang->line('term_lregister');?>
                                                                    </a></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <label for="text"
                                                                class="mb-4"><?=$this->lang->line('Captcha_client');?>
                                                            </label>
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div
                                                                        class="d-flex flex-row bd-highlight mb-3 flex-wrap">
                                                                        <div class=" bd-highlight">
                                                                            <input class="chapt"
                                                                                onselectstart="return false" type="text"
                                                                                id="capt" readonly="readonly">
                                                                        </div>
                                                                        <div class="p-1 bd-highlight">
                                                                            <span> <i class="fa fa-refresh mar"
                                                                                    aria-hidden="true"
                                                                                    onclick="cap()"></i>
                                                                            </span>
                                                                        </div>
                                                                        <div class=" bd-highlight">
                                                                            <input type="text" id="textinput"
                                                                                class="chapt1"
                                                                                placeholder="Enter chapcha">
                                                                            <div class=" alert check_chap "
                                                                                style=" color:red;"></div>
                                                                        </div>
                                                                        <div class="ml-3 bd-highlight">
                                                                            <button type="submit" id="formSubmit1"
                                                                                class="btn btn-primary d-none ml-4 _btn_sha"
                                                                                onclick="validcap()"><?=$this->lang->line('Submit_btn');?>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--  close container -->
</section>

<!-- client registration end -->
<div id="login" class="w3-container lawyer __register_bg" >
    <!-- client Login  Modal   start-->
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto mb-5">
                <div class=" modal-header2 text-center p-2" style="padding-bottom: 2e;">
                    <h1 class=""
                        style="margin-bottom: 0px;font-family:'bootstrap-icons'; text-align: center;color: #fff;font-size: 1.5rem; font-weight: 700;">
                        <?=$this->lang->line('client_log_menu');?></h1>

                </div>

                <form class="needs-validation client_login" action="<?=base_url()?>signup_ajax/login" method="post">
                    <div class="accordion" id="accordionExample">
                        <div class="">
                            <div id="collapseOne" class="show collapse biiling_details_bg " aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body Insaafcard-bodynew mb-5">
                                    <div class="res" style="color:red;"></div>
                                    <div class="row">
                                        <div class="col-md-12 mt-4">
                                            <label for="email"><?=$this->lang->line('mobile_contact');?> <span
                                                    class="text-muted">*</span></label>
                                            <input type="text" class="form-control new_control" minlength="10"
                                                maxlength="10" name="mobile" value="" required="required">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="password"><?=$this->lang->line('password_lregister');?> <span
                                                    class="text-muted">*</span></label>
                                            <input id="LogNewPassClientRe" type="password"
                                                class="form-control new_control" maxlength="255" name="password"
                                                value="" required="required"><i
                                                class="bi bi-eye-fill set_pass_eye_cl"></i>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center" style="display:grid">
                                            <button type="submit" class="btn ___button_submit"
                                                style=""><?=$this->lang->line('Submit_btn');?> </button>
                                            <a href="" class=" btn" data-toggle="modal"
                                                data-target="#exampleModal1_forget">
                                                <h5 class="___submith5">
                                                    <?=$this->lang->line('forgot_lregister');?>
                                                </h5>
                                            </a>
                                        </div>
                                    </div>
                                </div> <!-- close card body -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Client Login model end-->



<!-- Clint forget password  Modal start -->
<div class="modal fade" id="exampleModal1_forget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height: 374px;">
            <div class="modal-header">
                <h1 class="swing-top-fwd" style="font-family: Playfair Display;color:#04367d">
                    <?=$this->lang->line('forgot_pass_client');?>
                </h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation forgot_client_pass" action="<?=base_url()?>signup_ajax/forgot"
                    method="post">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div id="collapseOne" class="show collapse biiling_details_bg " aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="res1" style="color:red;"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="email"><?=$this->lang->line('email_contact');?> <span
                                                    class="text-muted">*</span></label>
                                            <input type="text" class="form-control new_control forgot_pass_client"
                                                maxlength="128" name="email" id="email"
                                                placeholder="Enter Your Email or Password" value="" required="required">
                                            <div class="otp_msg_email_forgot"> </div>
                                            <section class="hide_sec_cforgot" id="hide_sec_cforgot">
                                                <div class="form-group">
                                                    <input type="hidden" class="url"
                                                        value="<?=base_url()?>signup_ajax/otp_verify">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group email_otp_forgot">
                                                        <label for="text"><?=$this->lang->line('otp_lregister');?>
                                                        </label>
                                                        <input type="text" class="form-control enter_opt_forgot"
                                                            placeholder="Enter OTP">
                                                        <br>
                                                        <div class="countdown_email_forgot"></div>
                                                    </div>
                                                    <a href="#" id="resend_otp_forgot"
                                                        type="button"><?=$this->lang->line('rotp_lregister');?> </a>
                                                </div>
                                                <button type="button" id="sendotp_email_forgot_pass"
                                                    class="btn btn-primary"><?=$this->lang->line('sotp_lregister');?>
                                                </button>
                                                <button type="button" id="verifyotpforgot"
                                                    class="btn btn-primary"><?=$this->lang->line('votp_lregister');?>
                                                </button>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary forgot_pass_button"
                                data-dismiss="modal"><?=$this->lang->line('Close_lregister');?> </button>
                            <button type="submit" class="btn btn-primary forgot_pass_button"
                                style="background-color:#04367d;color:white;"><?=$this->lang->line('Submit_btn');?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Clint forget password model end-->
</section>

<script>
function openCity(cityName) {
    var i;
    var x = document.getElementsByClassName("lawyer");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(cityName).style.display = "block";
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#hide_sec").hide();
    $("#mob").keyup(function() {
        $(".hide_sec").show();
    });
});
</script>

<!--================================ Email verify Start========================== -->
<script>
//start of timer function

function timer_email_otp() {

    var timer2 = "01:59";
    var interval = setInterval(function() {


        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;

        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        $('.countdown_email').html("OPT will Expire in :  <b class='text-primary'>" + minutes + ':' + seconds +
            " seconds </b>");
        if ((seconds <= 0) && (minutes <= 0)) {
            clearInterval(interval);
            $('.countdown_email').html('');
            $('#sendotp_email').css("display", "block");
            $('#verifyemailotp').css("display", "none");
            $('#email_otp').css("display", "none");
            $('#sendotp_email').html('Resend');
        }
        timer2 = minutes + ':' + seconds;
    }, 1000);

}


// code for validate email address
function checkEmail() {

    var email = document.getElementById('email_add');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {

        email.focus;
        return false;
    } else {
        return true;
    }
}

$(document).ready(function() {

    $("#email_add").click(function() {
        $(".hide_email").css("display", "block");
        $("#sendotp_email").css("display", "block");

        var emailStatus  =  checkEmail();

    // if(emailStatus==true){
    $("#sendotp_email").click(function() {

        $("#email_otp").css("display", "block");
        $("#sendotp_email").css("display", "none");
        $("#verifyemailotp").css("display", "block");

        var emailAddress = $("#email_add").val();
        var url = "<?=base_url()?>Lawyer_account/EmailOtp";
        jQuery.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: {
                emailAddress: emailAddress,
                type: 'sendotp'
            },
            success: function(result) {
                console.log(result);
                if (result == "yes") {
                    $('.otp_msg_email').html(
                        '<div class="alert alert-success">OTP Sent successfully on Your Email</div>'
                        ).fadeIn();
                    timer_email_otp();
                    window.setTimeout(function() {
                        $('.otp_msg_email').fadeOut();
                    }, 2000)
                }
                if (result == "no") {
                    $("#email_otp").css("display", "none");
                    $("#sendotp_email").css("display", "block");
                    $("#verifyemailotp").css("display", "none");
                    $('.otp_msg_email').html(
                        '<div class="alert alert-danger">Please Enter valid number</div>'
                        ).fadeIn();

                    window.setTimeout(function() {
                        $('.otp_msg_email').fadeOut();
                    }, 2000)
                }
            }
        });

    });
// }
});
    // forgot password start

    //start of timer function for forgot password

    function timer_email_otp_forgot(time1, type) {

        var timer2 = time1;
        var interval = setInterval(function() {


            var timer = timer2.split(':');
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;

            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            $('.countdown_email_forgot').html("OPT will Expire in :  <b class='text-primary'>" +
                minutes + ':' + seconds + " seconds </b>");
            if ((seconds <= 0) && (minutes <= 0)) {
                clearInterval(interval);
                $('.countdown_email_forgot').html('');

                $('#sendotp_email_forgot_pass').css("display", "block");
                $('#verifyotpforgot').css("display", "none");
                $('.email_otp_forgot').css("display", "none");
                if (type != "verify") {
                    $('#sendotp_email_forgot_pass').html('Resend');
                }
            }
            timer2 = minutes + ':' + seconds;
        }, 1000);

    }

    $(".forgot_pass_client").click(function() {
        $(".hide_sec_cforgot").css("display", "block");
        $(".email_otp_forgot").css("display", "none");
        $("#sendotp_email_forgot_pass").css("display", "block");

        //  emailStatus  =  checkEmail();

    });

    $("#sendotp_email_forgot_pass").click(function() {
        var emailAddress = $(".forgot_pass_client").val();
        $(".email_otp_forgot").css("display", "block");
        $("#sendotp_email_forgot_pass").css("display", "none");


        var url = "<?=base_url()?>Lawyer_account/EmailOtp";
        jQuery.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: {
                emailAddress: emailAddress,
                type: 'forgot'
            },
            success: function(result) {
                console.log(result);
                if (result == "yes") {
                    $("#verifyotpforgot").css("display", "block");
                    $('.otp_msg_email_forgot').html(
                        '<div class="alert alert-success">OTP Sent successfully on Your Email</div>'
                        ).fadeIn();
                    var time1 = "01:59";
                    var type = "sendopt11";
                    timer_email_otp_forgot(time1, type);

                    window.setTimeout(function() {
                        $('.otp_msg_email_forgot').fadeOut();
                    }, 2000)

                }
                if (result == "no") {
                    $("#otp_msg_email_forgot").css("display", "none");
                    $("#sendotp_email_forgot_pass").css("display", "block");
                    $("#verifyotpforgot").css("display", "none");
                    $('.otp_msg_email_forgot').html(
                        '<div class="alert alert-danger">Please Enter valid number</div>'
                        ).fadeIn();

                    window.setTimeout(function() {
                        $('.otp_msg_email_forgot').fadeOut();
                    }, 2000)
                }
            }
        });

    });

    // end forgot password start


    // code for verify email address 
    $("#verifyotpforgot").on("click", function(e) {
        var otp = $(".enter_opt_forgot").val();
        e.preventDefault();
        $.ajax({
            url: "<?=base_url()?>Lawyer_account/email_otp_verification",
            type: "POST",
            cache: false,
            data: {
                otp: otp
            },
            success: function(response) {
                if (response == "yes") {
                    var time1 = "01:59";
                    var type = "verify";
                    timer_email_otp_forgot(time1, type);

                    $(".forgot_pass_button").css("display", "block");
                    $("#verifyotpforgot").css("display", "none");
                    $('.otp_msg_email_forgot').html(
                        '<div class="alert alert-success">Email Verified successfully</div>'
                        ).fadeIn();

                    $(".email_otp_forgot").css("display", "none");
                    $(".countdown_email").css("display", "none");
                    $("#sendotp_email_forgot_pass").css("display", "none");
                    window.setTimeout(function() {
                        $('.otp_msg_email_forgot').fadeOut();
                    }, 2000);


                }
                if (response == "No") {
                    $('.otp_msg_email_forgot').html(
                            '<div class="alert alert-danger">Please Enter valid OTP</div>')
                        .fadeIn();
                    window.setTimeout(function() {
                        $('.otp_msg_email_forgot').fadeOut();
                    }, 2000)


                }
                if (response == '0') {
                    $('.otp_msg_email_forgot').html(
                        '<div class="alert alert-danger">OTP Expired...</div>').fadeIn();
                    window.setTimeout(function() {
                        $('.otp_msg_email_forgot').fadeOut();
                    }, 2000)
                    $("#sendotp_email_forgot_pass").css("display", "block");
                }
                if (response == '2') {
                    $('.otp_msg_email_forgot').html(
                            '<div class="alert alert-danger">Please enter otp </div>')
                        .fadeIn();
                    window.setTimeout(function() {
                        $('.otp_msg_email_forgot').fadeOut();
                    }, 2000)

                }
            }
        });
    });

    // code for verify email address 
    $("#verifyemailotp").on("click", function(e) {
        var otp = $("#email_otp").val();
        e.preventDefault();
        $.ajax({
            url: "<?=base_url()?>Lawyer_account/email_otp_verification",
            type: "POST",
            cache: false,
            data: {
                otp: otp
            },
            success: function(response) {
                if (response == "yes") {
                    $("#verifyemailotp").css("display", "none");
                    $('.otp_msg_email').html(
                        '<div class="alert alert-success">Email Verified successfully</div>'
                        ).fadeIn();
                    $("#email_otp").css("display", "none");
                    $(".countdown_email").css("display", "none");
                    window.setTimeout(function() {
                        $('.otp_msg_email').fadeOut();
                    }, 2000);
                    $('#sendotp_email').css("display", "none");


                }
                if (response == "No") {
                    $('.otp_msg_email').html(
                            '<div class="alert alert-danger">Please Enter valid OTP</div>')
                        .fadeIn();
                    window.setTimeout(function() {
                        $('.otp_msg_email').fadeOut();
                    }, 2000)


                }
                if (response == '0') {
                    $('.otp_msg_email').html(
                        '<div class="alert alert-danger">OTP Expired...</div>').fadeIn();
                    window.setTimeout(function() {
                        $('.otp_msg_email').fadeOut();
                    }, 2000)
                    $("#sendotp_email").css("display", "block");
                }
                if (response == '2') {
                    $('.otp_msg_email').html(
                            '<div class="alert alert-danger">Please enter otp </div>')
                        .fadeIn();
                    window.setTimeout(function() {
                        $('.otp_msg_email').fadeOut();
                    }, 2000)

                }
            }
        });
    });

    // end code for verify email address 

});

// end code for validate email address 
</script>
<script>
var state = false;
$(".set_pass_eye").click(function() {
    $(this).toggleClass("bi bi-eye-slash-fill");
    if (state) {
        document.getElementById("SetNewPassClientRe").setAttribute("type", "password");
        state = false;
    } else {
        document.getElementById("SetNewPassClientRe").setAttribute("type", "text");
        state = true;
    }
});
</script>
<script>
var state = false;
$(".set_pass_eye_cl").click(function() {
    $(this).toggleClass("bi bi-eye-slash-fill");
    if (state) {
        document.getElementById("LogNewPassClientRe").setAttribute("type", "password");
        state = false;
    } else {
        document.getElementById("LogNewPassClientRe").setAttribute("type", "text");
        state = true;
    }
});
</script>