<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/lawyer_register.css">
<section class="bg_log text-center pt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12 marg">
                <div class="example1">
                    <div class="w3-bar w3-black p-1 d-flex justify-content-center">
                        <button class="w3-bar-item w3-button  insaaf-log" onclick="openCity('register')"
                            style="cursor: pointer;"><?=$this->lang->line('regi_lregister');?> </button>
                        <button class="w3-bar-item w3-button  ml-2 insaaf-log" onclick="openCity('login')"
                            style="cursor: pointer;"><?=$this->lang->line('Login_lregister');?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
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
<section class="___bg_lawyer">
    <div class="container">
        <div class="row">
            <div class="col-md-10 m-auto">

                <!-- lawyer registration start -->
                <div id="register" class="w3-container lawyer"  style="display:none">
                    <div id="allSet">
                        <div class="">
                            <h1 class="swing-top-fwd _lawyer132543789">

                                <?=$this->lang->line('Login1_lregister');?>
                            </h1>
                        </div>
                        <div class="___colSet Insaafcard-body">

                            <form class="needs-validation lawyer_register"
                                action="<?=base_url()?>Lawyer_account/register" method="post"
                                enctype="multipart/form-data">

                                <div class="Register "> </div>
                                <div class="row pt-3">
                                    <div class="col-md-4 col-sm-12 ">
                                        <label for="fname"><?=$this->lang->line('fname_contact');?><span
                                                class="text-muted">*</span></label>
                                        <input type="text" class="form-control new_control" maxlength="25"
                                            id="firstName" placeholder="" name="fname" value="" required>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label for="lastName"><?=$this->lang->line('lname_contact');?></label>
                                        <input type="text" class="form-control new_control" maxlength="25" name="lname"
                                            id="lastName" placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="law_img">
                                            <!-- <div class="row">
                                    <div class="col-sm-4"> -->
                                            <div class="">
                                                <img id="previewImg" src="<?= base_url("assets/images/user_law.png")?>"
                                                    width="85px" class="_pointer">
                                            </div>
                                            <input type="file" name="lawyer_img" id="lawyerFile" class="hidden">
                                            <!-- </div>
                                </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label for="email">
                                            <?=$this->lang->line('email_contact');?>
                                            <span class="text-muted">*</span>
                                        </label>
                                        <input type="email" class="form-control new_control" maxlength="128"
                                            name="email" id="email_add" value="" required>
                                        <div class="otp_msg_email"></div>

                                        <section class="hide_email">
                                            <div class="form-group show_emai_otp m-0" id="emailotpdiv">
                                                <input type="text" class="form-control" id="email_otp"
                                                    placeholder="Enter Email OTP">
                                                <br>
                                                <div class="countdown_email"></div>
                                            </div>
                                            <button type="button" id="sendotp_email" class="btn btn-primary"> Send
                                                OTP</button>
                                            <button type="button" id="verifyemailotp"
                                                class="btn btn-primary hide_email_btn"> Verify OTP</button>
                                        </section>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label for="mobile"><?=$this->lang->line('mobile_contact');?> <span
                                                class="text-muted">*</span></label>
                                        <input type="text" class="form-control new_control LawyerMobileNum"
                                            base_url="<?= base_url();?>" minlength="10" maxlength="10" id="mob"
                                            name="mobile" value="" required>
                                        <span class="numberexist text-danger"></span>
                                        <div class="invalid-feedback">
                                            Please Enter valid mobile number
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check checkbox" id="checkbox" style="margin-top: 28px;">
                                            <input type="checkbox" class="form-check-input check" name="phone_condition"
                                                required="required" id="exampleCheck1" required>
                                            <label class="form-check-label" id="check"
                                                for="exampleCheck1"><?=$this->lang->line('listing_lregister');?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="otp_msg">

                                        </div>
                                        <section class="hide_sec" id="hide_sec">
                                            <div class="form-group">
                                                <input type="hidden" class="url"
                                                    value="<?=base_url()?>Lawyer_account/otp_verify">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group show_otp" id="otpdiv">
                                                    <label
                                                        for="otp verification"><?=$this->lang->line('otp_lregister');?>
                                                    </label>
                                                    <input type="text" class="form-control" id="otp"
                                                        placeholder="Enter OTP">
                                                    <br>
                                                    <div class="countdown"></div>
                                                </div>
                                                <a href="#" id="resend_otp"
                                                    type="button"><?=$this->lang->line('rotp_lregister');?> </a>
                                            </div>
                                            <button type="button" id="sendotp"
                                                class="btn btn-primary"><?=$this->lang->line('sotp_lregister');?>
                                            </button>
                                            <button type="button" id="verifyotp"
                                                class="btn btn-primary hide_but"><?=$this->lang->line('votp_lregister');?>
                                            </button>
                                        </section>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label for="Enrolement"><?=$this->lang->line('location_lregister');?> <span
                                                class="text-muted"></span></label>
                                        <input type="text" class="form-control new_control" maxlength="55"
                                            name="address" id="address" value="" required>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <?php if(!empty($case_category)) {?>
                                        <label for="password"><?=$this->lang->line('selection_lregister');?> <span
                                                class="text-muted">*</span>
                                        </label>

                                        <select id="select" class="selectbox category" name="category[]" value=""
                                            data-placeholder="Select Category" multiple>
                                            <option value=""><?=$this->lang->line('selection1_lregister');?> </option>
                                            <?php  foreach ($case_category as $key => $value) {?>
                                            <option value="<?=$value->id?>">
                                                <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->name_hi;
                                    }else{
                                        echo $value->name;
                                    }?>
                                            </option>
                                            <?php  } } ?>
                                        </select>

                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label for="Enrolement"><?=$this->lang->line('enrole_lregister');?> <span
                                                class="text-muted">*</span></label>
                                        <input type="text" class="form-control new_control" maxlength="55"
                                            name="enrolement_no" id="password" value="" required>
                                    </div>
                                </div>
                                <div class="row">


                                    <div class="col-md-4 col-sm-12">
                                        <label for="Bar"><?=$this->lang->line('bar_lregister');?> <span
                                                class="text-muted">*</span>
                                        </label>
                                        <input type="text" class="form-control new_control" maxlength="150" id="bar"
                                            name="bar_councle" value="" placeholder="Enter your Bar council place"
                                            required>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label for="password"><?=$this->lang->line('set_pass_lregister');?><span
                                                class="text-muted">*</span></label>
                                        <input id="RePasswordLawyer" type="password" class="form-control new_control"
                                            maxlength="255" name="password" value="" required><i
                                            class="bi bi-eye-fill re_pass_eye_lw"></i>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label for="Experience"><?=$this->lang->line('year_lregister');?><span
                                                class="text-muted">*</span></label>
                                        <select maxlength="255" name="experience" id="experience" class="form-control"
                                            required>
                                            <option>Select</option>
                                            <option value="1 Year">1 Year</option>
                                            <option value="2 Years">2 Years</option>
                                            <option value="3 Years">3 Years</option>
                                            <option value="4 Years">4 Years</option>
                                            <option value="5 Years">5 Years</option>
                                            <option value="6 Years">6 Years</option>
                                            <option value="7 Years">7 Years</option>
                                            <option value="8 Years">8 Years</option>
                                            <option value="9 Years">9 Years</option>
                                            <option value="10 Years">10 Years</option>
                                            <option value="11 Years">11 Years</option>
                                            <option value="12 Years">12 Years</option>
                                            <option value="13 Years">13 Years</option>
                                            <option value="14 Years">14 Years</option>
                                            <option value="15 Years">15 Years</option>
                                            <option value="16 Years">16 Years</option>
                                            <option value="17 Years">17 Years</option>
                                            <option value="18 Years">18 Years</option>
                                            <option value="19 Years">19 Years</option>
                                            <option value="20 Years">20 Years</option>
                                            <option value="21 Years">21 Years</option>
                                            <option value="22 Years">22 Years</option>
                                            <option value="23 Years">23 Years</option>
                                            <option value="24 Years">24 Years</option>
                                            <option value="25 Years">25 Years</option>
                                            <option value="26 Years">26 Years</option>
                                            <option value="27 Years">27 Years</option>
                                            <option value="28 Years">28 Years</option>
                                            <option value="29 Years">29 Years</option>
                                            <option value="30 Years">30 Years</option>
                                            <option value="31 Years">31 Years</option>
                                            <option value="32 Years">32 Years</option>
                                            <option value="33 Years">33 Years</option>
                                            <option value="34 Years">34 Years</option>
                                            <option value="35 Years">35 Years</option>
                                            <option value="36 Years">36 Years</option>
                                            <option value="37 Years">37 Years</option>
                                            <option value="38 Years">38 Years</option>
                                            <option value="39 Years">39 Years</option>
                                            <option value="40 Years">40 Years</option>
                                            <option value="41 Years">41 Years</option>
                                            <option value="42 Years">42 Years</option>
                                            <option value="43 Years">43 Years</option>
                                            <option value="44 Years">44 Years</option>
                                            <option value="45 Years">45 Years</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <label for="Enrolement"><?=$this->lang->line('practice_lregister');?> <span
                                                class="text-muted"></span></label>
                                        <input type="text" class="form-control new_control" maxlength="255"
                                            name="practice_area" id="practice" value="" required>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <label for="password"><?=$this->lang->line('Attach_lregister');?> <span
                                                class="text-muted"></span></label>
                                        <input type="file" class="form-control new_control" name="enrol_image"
                                            id="enrol_image" value="">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-check" style="margin-top: 28px;">
                                            <input type="checkbox" class="form-check-input" name="term_condi"
                                                id="exampleCheck1" required>
                                            <label class="form-check-label" for="exampleCheck1"><a
                                                    href="<?=base_url()?>Lawyer_account/lawyer_term"><?=$this->lang->line('term_lregister');?>
                                                </a></label>
                                        </div>
                                    </div>
                                </div>



                                <div class="formInnerCon container hidden" id="loaderAreaCon">
                                    <div class="row">
                                        <div class="col-sm-12 text-center py-3">
                                            <img src="<?php echo base_url('assets/images/loader.gif') ?>" alt=""
                                                width="20%">
                                        </div>
                                    </div>
                                </div>
                                <div class="" style="justify-content:flex-start!important;">
                                    <button type="submit" class="btn btn-primary  d-none" id="formSubmit1"
                                        style="background-color:#04367d;color:white;"><?=$this->lang->line('Submit_btn');?></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- lawyer registration end -->
<section class="__register_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto Insaafcard-body">
                <div id="login" class="w3-container lawyer ">
                    <!-- Lowyer Login  Modal   start-->

                    <div class="" role="document">
                        <div class="">
                            <h1 class="swing-top-fwd ___log_law"><?=$this->lang->line('lawyer_log_menu');?></h1>
                            <div class="modal-body mb-5">
                                <form base="<?=base_url()?>" data_id="<?=base_url()?>Lawyer_account/login"
                                    class="needs-validation lawyer_login" action="" method="post">
                                    <div class="card-body">
                                        <div class="res" style=" color:red;"> </div>
                                        <div class="row">
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label for="email"><?=$this->lang->line('mobile_contact');?><span
                                                        class="text-muted">*</span></label>
                                                <input type="number" class="form-control new_control" minlength="10"
                                                    maxlength="10" name="mobile" id="email" value=""
                                                    required="required">
                                                <div class="invalid-feedback">
                                                    Please enter a valid mobile number
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="password"><?=$this->lang->line('password_lregister');?><span
                                                        class="text-muted">*</span></label>
                                                <input id="lawyer_password" type="password"
                                                    class="form-control new_control" maxlength="255" name="password"
                                                    value="" required="required"><span><i
                                                        class="bi bi-eye-fill click_eye"></i></span>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-sm-12 text-center" style="display:grid">

                                                <!-- <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button> -->
                                                <button type="submit"
                                                    class="btn ___button_submit"><?=$this->lang->line('Submit_btn');?></button>
                                                <a href="" style="text-decoration:none; color:#04367d;"
                                                    data-toggle="modal" data-target="#exampleModal_forget">
                                                    <h5 class="___submith5">
                                                        <?=$this->lang->line('forgot_lregister');?>
                                                    </h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Lowyer Login model end-->



    </div>
    </div>
    </div>
</section>

</div>
<!-- Lawyer forget password  Modal start -->
<div class="modal fade" id="exampleModal_forget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="height: 376px;">
            <div class="modal-header">
                <h1 class="swing-top-fwd" style="font-family: Playfair Display;color:#04367d">
                    <?=$this->lang->line('Lforgot_lregister');?> </h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation forgot_lawyer_pass " action="<?=base_url()?>lawyer-account/forgot"
                    method="post">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div id="collapseOne" class="show collapse biiling_details_bg " aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="res1" style=" color:red;"> </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="email"><?=$this->lang->line('email_contact');?><span
                                                    class="text-muted">*</span></label>
                                            <input type="text" class="form-control new_control forgot_pass_client"
                                                maxlength="128" name="email" id="email" placeholder="Enter Your Email"
                                                value="">
                                            <div class="otp_msg_email_forgot"> </div>
                                            <section class="hide_sec_cforgot" id="hide_sec_cforgot">
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
                                                    class="btn btn-primary"><?=$this->lang->line('votp_lregister');?></button>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary forgot_pass_button "
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
<!--Lawyer forget password model end-->

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

<!-- Lowyer Resistration model end-->
<script>
$("#previewImg").click(function(fb) {
    $("#lawyerFile").trigger("click");
}) // Live Image change ontime ===========================================

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#previewImg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}



$("#lawyerFile").change(function() {
    readURL(this);
});
// ======================================================================


//ajax call case sub cat name

$(document).ready(function() {
    $('select').chosen();
    // category change
    $('.category').click(function() {
        var val = $(this).val();
        // alert(val);
        // AJAX request
        $.ajax({
            url: '<?=base_url()?>Lawyer_account/ajax_call_case_sub_category_name',
            method: 'post',
            data: {
                id: val
            },
            dataType: 'json',
            success: function(response) {
                // alert(response);
                $('.sub_category').html('');
                // Add options
                $.each(response, function(index, data) {
                    $('.sub_category').append('<option value="' + data['id'] +
                        '">' + data['case_sub_category'] + '</option>');
                });
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    $("#hide_sec").hide();
    $("#checkbox").hide();
    $("#mob").keyup(function() {
        $(".checkbox").show();
        $(".check").click(function() {
            $("#hide_sec").show();
            $("#checkbox").hide();
        });
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
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('.countdown_email').html("OPT will Expire in :  <b class='text-primary'>" + minutes + ':' + seconds +
            " seconds </b>");
        //if (minutes < 0) clearInterval(interval);
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


        var emailStatus = checkEmail();

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
                        // $("#EmailotpForm,.alert-success").show();
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

    //     $("#email_add_forgot_pass").keyup(function(){
    //         alert("ok");
    //         $(".hide_email").css("display","block");
    //         $("#sendotp_email").css("display","block");


    //     var emailStatus  =  checkEmail();
    //     if(emailStatus==true){

    //     $("#sendotp_email").click(function(){
    //         $("#email_otp").css("display","block");
    //         $("#sendotp_email").css("display","none");
    //         $("#verifyemailotp").css("display","block");

    //         var emailAddress  = $("#email_add").val();
    //         var url="<?=base_url()?>Lawyer_account/EmailOtp";
    //             jQuery.ajax({
    //                 url  : url,
    //                 type : "POST",
    //                 cache:false,
    //                 data : {
    //                          emailAddress:emailAddress,
    //                          type:'sendotp'
    //                         },
    //                 success:function(result){
    //                     console.log(result);
    //                     if (result == "yes") {
    //                         // $("#EmailotpForm,.alert-success").show();
    //                         $('.otp_msg_email').html('<div class="alert alert-success">OTP Sent successfully on Your Email</div>').fadeIn();
    //                         timer_email_otp();
    //                         window.setTimeout(function(){
    //                         $('.otp_msg_email').fadeOut();
    //                       },2000)
    //                     }
    //                     if(result =="no") {
    //                         $("#email_otp").css("display","none");
    //                        $("#sendotp_email").css("display","block");
    //                        $("#verifyemailotp").css("display","none");
    //                         $('.otp_msg_email').html('<div class="alert alert-danger">Please Enter valid number</div>').fadeIn();

    //                         window.setTimeout(function(){
    //                         $('.otp_msg_email').fadeOut();
    //                       },2000)
    //                     }        
    //                 }
    //             }); 

    //     });
    // }
    // });

    // end code for send email 


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
$(".click_eye").click(function() {
    $(this).toggleClass("bi bi-eye-slash-fill");
    if (state) {
        document.getElementById("lawyer_password").setAttribute("type", "password");
        state = false;
    } else {
        document.getElementById("lawyer_password").setAttribute("type", "text");
        state = true;
    }
});
</script>

<script>
var state = false;
$(".re_pass_eye_lw").click(function() {
    $(this).toggleClass("bi bi-eye-slash-fill");
    if (state) {
        document.getElementById("RePasswordLawyer").setAttribute("type", "password");
        state = false;
    } else {
        document.getElementById("RePasswordLawyer").setAttribute("type", "text");
        state = true;
    }
});
</script>

<script>
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
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('.countdown_email_forgot').html("OPT will Expire in :  <b class='text-primary'>" + minutes + ':' +
            seconds + " seconds </b>");
        //if (minutes < 0) clearInterval(interval);
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
    //   alert(emailAddress);
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
                    '<div class="alert alert-danger">Please Enter valid number</div>').fadeIn();

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
                        '<div class="alert alert-success">Email Verified successfully</div>')
                    .fadeIn();

                $(".email_otp_forgot").css("display", "none");
                $(".countdown_email").css("display", "none");
                $("#sendotp_email_forgot_pass").css("display", "none");
                window.setTimeout(function() {
                    $('.otp_msg_email_forgot').fadeOut();
                }, 2000);


            }
            if (response == "No") {
                $('.otp_msg_email_forgot').html(
                    '<div class="alert alert-danger">Please Enter valid OTP</div>').fadeIn();
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
                    '<div class="alert alert-danger">Please enter otp </div>').fadeIn();
                window.setTimeout(function() {
                    $('.otp_msg_email_forgot').fadeOut();
                }, 2000)

            }
        }
    });
});
</script>