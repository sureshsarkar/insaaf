<section class="form_login_bg ">
    <div class="container">
        <div class="row mar_tp_pp___">
            <div class="col-md-12">
                <div class="for_full_login_backhdf">
                    <div class="">
                        <!-- progress bar -->
                        <div class="stepper-wrapper">
                            <div class="stepper-item completed item1">
                                <div class="step-counter ">1</div>
                                <div class="step-name">Your details</div>
                            </div>
                            <div class="stepper-item item2">
                                <div class="step-counter">2</div>
                                <div class="step-name">Number Verification</div>
                            </div>
                            <div class="stepper-item item3">
                                <div class="step-counter">3</div>
                                <div class="step-name">Submit</div>
                            </div>
                        </div>
                        <!-- progress bar -->
                    </div>
                    <div class="row">
                        <div class="col-md-8 oorpddflf ___acceptCol2">
                            <div class="registerCollForm21354789">
                                <!-- 1st Screen =============================================== -->
                                <form id="form1" method="post">
                                    <div class="boxdiv1 stepCon">
                                        <div class="for_sometext_loginj">
                                            <h4 class="">Register Here</h4>
                                        </div>
                                        <div class="dorkk_opkd">
                                            <div class="label-float">
                                                <input type="text" class="fname" class="__call_100" placeholder=" "
                                                    value="<?php if(isset($_GET['user_fname'])) echo $_GET['user_fname']?>"
                                                    name="fname" />
                                                <label>First name </label>
                                            </div>
                                            <div class="label-float ml-5">
                                                <input type="text" class="lname" class="__call_100" placeholder=" "
                                                    value="<?php if(isset($_GET['user_lname'])) echo $_GET['user_lname']?>"
                                                    name="lname" />
                                                <label>Last name </label>
                                            </div>
                                        </div>
                                        <div class="beside">
                                            <div class="label-float">
                                                <input type="text" class="OnlyNumberInput mobile __call_100"
                                                    placeholder=" " id="mobile"
                                                    value="<?php echo (isset($_GET['user_mobile'])&& !empty($_GET['user_mobile']))? $_GET['user_mobile']:'';?>"
                                                    name="mobile" maxlength="10" />
                                                <label>Phone Number </label>
                                            </div>
                                            <div class="hfkdjfkodkfjj">
                                                <div class="ckdkkfl">
                                                    <div class="form-check male __sameCallInsaff ml__coll_0">
                                                        <input class="form-check-input gender" type="radio"
                                                            name="gender" id="flexRadioDefault1" value="1"
                                                            <?php if(isset($_GET['user_gender']) && $_GET['user_gender']==1) echo 'checked';?>>
                                                        <label class="form-check-label" id="male"
                                                            for="flexRadioDefault1">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check __sameCallInsaff">
                                                        <input class="form-check-input female gender" type="radio"
                                                            name="gender" id="exampleCheck2" value="2"
                                                            <?php if(isset($_GET['user_gender']) && $_GET['user_gender']==2) echo 'checked';?>>
                                                        <label class="form-check-label" id="female" for="exampleCheck2">
                                                            Female
                                                        </label>
                                                    </div>

                                                    <div class="form-check __sameCallInsaff">
                                                        <input class="form-check-input other gender" type="radio"
                                                            name="gender" id="exampleCheck3" value="3"
                                                            <?php if(isset($_GET['user_gender']) && $_GET['user_gender']==3) echo 'checked';?>>
                                                        <label class="form-check-label" id="other" for="exampleCheck3">
                                                            Other
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="for_kkfkfd">
                                            <div class="form-group form-check ">
                                                <input type="checkbox" class="form-check-input terms_condition"
                                                    value="">
                                                <label class="form-check-label opdfjfj">
                                                    <?php if(isset($_GET['type']) && $_GET['type']=='lawyer'){?>
                                                    <a href="<?= base_url()?>lawyer-terms-conditions"
                                                        target="_blank">Terms & Conditions </a></label>
                                                <?php }else{?>
                                                <label class="mt-2"><a href="<?= base_url()?>client-terms-conditions"
                                                        target="_blank">Terms & Conditions </a></label>
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="msg"></div>
                                        <button type="submit" class=" btn btn-primary log_button ">Next</button>
                                    </div>
                                    <!-- second Screen =============================================== -->
                                    <div class="boxdiv2 stepCon">
                                        <div class="">
                                            <div class="">
                                                <div class="modal-content">
                                                    <div class="for_otp_img">
                                                        <img src="<?php echo base_url()?>assets/images/otp.png" alt="">
                                                    </div>
                                                    <div class="tecjdffpl">
                                                        <div class="label-float">
                                                            <input type="text" class="otp OnlyNumberInput "
                                                                placeholder=" " value="" maxlength="4" />
                                                            <label>Enter OTP</label>
                                                            <br />
                                                            <p class="countdown"></p>
                                                            <input type="hidden" class="resend_num"
                                                                value="<?php if(isset($_SESSION['user_mobile'])) echo $_SESSION['user_mobile']?>">
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <div class="cf_ldfkkf row otpCon otpCon1">
                                                        <div class="col-sm-12 text-center">
                                                            <div class="msg text-danger text-center"></div>
                                                            <button type="button"
                                                                class="btn btn-success verifyBtn text-center">Verify
                                                                OTP</button>
                                                        </div>
                                                    </div>
                                                    <div class="forlggkffg row otpCon otpCon2 hidden">
                                                        <div class="col-sm-12 text-center">
                                                            <a type="button" class="btn  resendBtn"><b>Resend
                                                                    OTP</b></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- 3rd Screen =============================================== -->
                                <div class="boxdiv3 stepCon">
                                    <form id="form2">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="<?php echo base_url()?>assets/images/pinsave.jpg"
                                                    class="img-fluid">
                                            </div>
                                            <div class="col-md-6 pinsetCon pinMainCon">
                                                <div class="label-float">
                                                    <input type="email" class="__call_100 email" name="email"
                                                        value="<?php echo (isset($_GET['user_email']) && !empty($_GET['user_email']))? $_GET['user_email']:'';?>"
                                                        autocomplete="off" required />
                                                    <label>Email </label>
                                                </div>
                                                <div class="___set__insaaf_col__6556">
                                                    <div class="for_pin_cldf">
                                                        <p>Set Password</p>
                                                    </div>
                                                    <div class="pin-code password __only_web_3">
                                                        <input type="password" id="setPin1"
                                                            class="pinChange setPin pin1" data-next="#setPin2"
                                                            maxlength="1">
                                                        <input type="password" id="setPin2"
                                                            class="pinChange setPin pin2" data-next="#setPin3"
                                                            maxlength="1">
                                                        <input type="password" id="setPin3"
                                                            class="pinChange setPin pin3" data-next="#setPin4"
                                                            maxlength="1">
                                                        <input type="password" id="setPin4"
                                                            class="pinChange setPin pin4" data-next="#setPin5"
                                                            maxlength="1">
                                                        <i class="bi btnView bi-eye  frodjf " data-target=".setPin"
                                                            data-status="0" data-target="password" data-status="0"></i>
                                                    </div>
                                                    <div class="for_pin_cldf">
                                                        <p>Confirm Password</p>
                                                    </div>
                                                    <div class="cpin-code cpassword">
                                                        <input type="password" id="setPin5"
                                                            class="pinChange cofirmPin cpin1" data-next="#setPin6"
                                                            maxlength="1">
                                                        <input type="password" id="setPin6"
                                                            class="pinChange cofirmPin cpin2" data-next="#setPin7"
                                                            maxlength="1">
                                                        <input type="password" id="setPin7"
                                                            class="pinChange cofirmPin cpin3" data-next="#setPin8"
                                                            maxlength="1">
                                                        <input type="password" id="setPin8"
                                                            class="pinChange cofirmPin cpin4" data-next=""
                                                            maxlength="1">
                                                        <i class="bi btnView bi-eye frodjf  " data-target=".cofirmPin"
                                                            data-status="0"></i>
                                                    </div>
                                                    <br />
                                                    <div class="msg"></div>
                                                    <div class=" ___submit_pinsave">
                                                        <button type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-center progressCon pinsetCon  hidden pt-4">
                                                <img src="<?= base_url('assets/images/progress.gif') ?>" width="120">
                                                <p><small>Please wait..</small></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 oorpddflf loginCon">
                            <div class="___centerOrCallBase___">
                                <div class="centerOR2">
                                    <span class="___orDraw2">OR</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 oorpddflf ___acceptCol2 loginCon">
                            <a href="<?= base_url("login")?>">
                                <div class="__right__side_ColLogoin3213415 for_sing_upinndr ">
                                    <div class="loginRightBaseCall__123654789">
                                        <span><i class="bi bi-person-circle"></i></span>
                                        <a href="<?= base_url("login")?>"><span class="__new__vase51454">Already
                                                registered ?</span><span class="__log2Call">Login Now</span></a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function verify_opt(time, type) {
    var timer2 = time;
    var interval = setInterval(function() {
        var timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        var minutes = parseInt(timer[0], 10);
        var seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;

        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        $('.countdown').html("OTP Expire in :  <b class='text-primary'>0" + minutes + ':' + seconds + "</b>");

        if ((seconds <= 0) && (minutes <= 0)) {
            clearInterval(interval);
            $('.countdown').html('');

            $(".otpCon").addClass("hidden");
            $(".otpCon2").removeClass("hidden");
        }
        timer2 = minutes + ':' + seconds;
    }, 1000);
}
</script>

<script>
window.step = 1;
$(document).ready(function() {
    $(".hide_this_section").addClass('hidden');
    //set radio box male
    $(".viewpassword").click(function() {

        var passtype = $(".pin1").attr("type");
        if (passtype == "password") {
            $(".pin1").attr("type", "text");
            $(".pin2").attr("type", "text");
            $(".pin3").attr("type", "text");
            $(".pin4").attr("type", "text");
        } else {
            $(".pin1").attr("type", "password");
            $(".pin2").attr("type", "password");
            $(".pin3").attr("type", "password");
            $(".pin4").attr("type", "password");
        }
    });
    //View CPassword 
    $(".viewcpassword").click(function() {
        var cpasstype = $(".cpin1").attr("type");
        if (cpasstype == "password") {
            $(".cpin1").attr("type", "text");
            $(".cpin2").attr("type", "text");
            $(".cpin3").attr("type", "text");
            $(".cpin4").attr("type", "text");
        } else {
            $(".cpin1").attr("type", "password");
            $(".cpin2").attr("type", "password");
            $(".cpin3").attr("type", "password");
            $(".cpin4").attr("type", "password");
        }
    });
});
// Enter password
</script>

<script type="text/javascript">
//Resend OTP End    
// Step 1 Submition ==================================
$(document).ready(function() {
    $("#form1").submit(function() {
        $(".msg").html("");
        var terms = $(".terms_condition").val();
        var fname = $(".fname").val();
        var lname = $(".lname").val();
        var mobile = $(".mobile").val();
        var gender = document.getElementsByName('gender');
        var genderStatus = false;
        if (gender[0].checked || gender[1].checked || gender[2].checked) {
            genderStatus = true;
        }
        //var genderVal  = (gender[0].checked)?1:2;
        if (gender[0].checked) {
            genderVal = 1;
        } else if (gender[1].checked) {
            genderVal = 2;
        } else if (gender[2].checked) {
            genderVal = 3;
        }
        var alert = '';
        if (fname == '' || fname.length < 2) {
            alert = "Please enter your first name!";
        } else if (lname == '' || lname.length < 3) {
            alert = "Please enter your last name!";
        } else if (mobile == '' || mobile.length < 10) {
            alert = "Please enter your 10 digit phone number!";
        } else if (!genderStatus) {
            alert = "Please select your Gender!";
        } else if (!$('.terms_condition').is(':checked')) {
            alert = "Please agree our terms & conditions!";
        }
        if (alert != '') {
            _showAlert(alert)
            return false;
        }

        var url = "<?php echo base_url('signup_ajax/newregister'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                fname: fname,
                lname: lname,
                mobile: mobile,
                gender: genderVal
            },
            success: function(response) {
                if (response == 1) {

                    _showAlert(
                        "<p>Mobile Number Already Exist as a Client !</p>"
                    );
                    return false;
                } else if (response == 2) {
                    _showAlert(
                        "<p>Mobile Number Already Exist as a Lawyer !</p>"
                    );
                    return false;
                } else if (response == 3) {
                    var time = "01:59";
                    verify_opt(time);
                    window.step = 2;
                    _fnProgressChange();
                } else if (response == 4) {
                    $(".msg").css("display", "block");
                    $(".msg").html("<p>Enter your mobile number</p>");
                    return false;
                }
            }
        });
        return false;
    });
});

//verify OTP Start ==============================================
// step 2
$(".verifyBtn").click(function() {
    $(".msg").html("");
    var otp = $(".otp").val();
    var ch = "verify_otp";
    if (otp.length >= 4) {
        var url = "<?php echo base_url('signup_ajax/otp_verify'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                otp: otp,
                ch: ch,
            },
            success: function(response) {
                if (response == 1) {
                    window.step = 3;
                    _fnProgressChange();
                    return false;
                } else {
                    _showAlert("<p>Please enter valid OTP</p>");
                    $(".otp").val('');
                    return false;
                }
            }
        });
    } else {
        _showAlert("<p>Please enter valid OTP</p>");
        $(".otp").val('');
        _removeAlert();
    }
})
//verify OTP End

//Resend OTP Start
$(".resendBtn").click(function() {
    var mob = $("#mobile").val();
    var ch = "send_otp";
    $(".otp").val('');
    if (mob != "") {
        var url = "<?php echo base_url('signup_ajax/otp_verify'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                mob: mob,
                ch: ch,
            },
            success: function(response) {
                if (response == 1) {
                    $(".otpCon").addClass("hidden");
                    $(".otpCon1").removeClass("hidden");
                    var time = "01:59";
                    verify_opt(time);
                    return false;
                }
            }
        });
    }
});
// Step 3 set password =======================================
//  step 3
$("#form2").submit(function() {
    $(".msg").html('');
    var pin1 = $(".pin1").val();
    var pin2 = $(".pin2").val();
    var pin3 = $(".pin3").val();
    var pin4 = $(".pin4").val();
    var cpin1 = $(".cpin1").val();
    var cpin2 = $(".cpin2").val();
    var cpin3 = $(".cpin3").val();
    var cpin4 = $(".cpin4").val();
    var password = pin1 + pin2 + pin3 + pin4;
    var cpassword = cpin1 + cpin2 + cpin3 + cpin4;
    var url = "<?php echo base_url('signup_ajax/register_now'); ?>";
    var user_type = "<?= strtolower($_GET['type']); ?>";
    if (cpassword.trim() != password.trim()) {
        $(".msg").html("<p>Pin do not match!</p>");
        $(".cpassword input").val('');
        return false;
    } else if (password.length < 4) {
        $(".msg").html("<p>Password should be 4 digits !</p>");
        $(".password input").val('');
        $(".cpassword input").val('');
        return false;
    } else {
        // form data
        var fname = $(".fname").val();
        var lname = $(".lname").val();
        var mobile = $(".mobile").val();
        var email = $(".email").val();
        var gender = document.getElementsByName('gender');

        if (gender[0].checked) {
            genderVal = 1;
        } else if (gender[1].checked) {
            genderVal = 2;
        } else if (gender[2].checked) {
            genderVal = 3;
        }
        $(".pinsetCon").addClass("hidden");
        $(".progressCon").removeClass("hidden");
        var query = sessionStorage.getItem("user_query");
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                password: password,
                cpassword: cpassword,
                user_type: user_type,
                fname: fname,
                lname: lname,
                mobile: mobile,
                email: email,
                gender: genderVal,
                query: query
            },
            success: function(response) {
                if (response == 1) {
                    // lawyer
                    window.location.href = "<?= base_url("lawyer/dashboard?action=welcome")?>";
                } else if (response == 2) {
                    // client
                    window.location.href = "<?= base_url("client/dashboard?action=welcome")?>";
                } else {
                    $(".pinsetCon").addClass("hidden");
                    $(".pinMainCon").removeClass("hidden");
                }
            }
        });
        return false;
    }
});
</script>

<script>
// funciton for step select Active & deactive
function _fnProgressChange() {
    $(".stepper-item").removeClass('completed');
    $(".stepCon").css('display', 'none');
    $(".loginCon").css('display', 'none');
    var screenStatus = 0;
    if (window.step >= 3) {
        $(".item3").addClass('completed');
        screenStatus = 1;
        $(".boxdiv3").css('display', 'block');
        $(".___acceptCol2").removeClass('col-md-0').addClass('col-md-12');
    }
    if (window.step >= 2) {
        $(".item2").addClass('completed');
        if (screenStatus == 0) {
            screenStatus = 1;
            $(".boxdiv2").css('display', 'block');
            $(".___acceptCol2").removeClass('col-md-8').addClass('col-md-12');
        }
    }
    if (window.step >= 1) {
        $(".item1").addClass('completed');
        if (screenStatus == 0) {
            screenStatus = 1;
            $(".boxdiv1").css('display', 'block');
            $(".loginCon").css('display', 'block');
            $(".___acceptCol2").removeClass('col-md-8').addClass('col-md-12');
        }
    }
}

// back function =============================
$(".step-counter").click(function() {
    var selectedStep = $(this).text().trim();
    selectedStep = parseInt(selectedStep);
    _fnBack(selectedStep);
});

function _fnBack(stepID) {
    if (window.step > stepID) {
        window.step = stepID;
        _fnProgressChange();
    }
}

// pin show & hide ====================================
$(".viewPass").click(function() {
    var target = $(this).attr("data-target");
    var status = $(this).attr("data-status");
    if (status == 1) {
        $("." + target + " input").attr("type", "password");
        $(this).attr("data-status", '0');
    } else {
        $("." + target + " input").attr("type", "text");
        $(this).attr("data-status", '1');
    }
});
//View Password 

$(".viewpassword").click(function() {
    var passtype = $(".pin1").attr("type");
    if (passtype == "password") {
        $(".pin1").attr("type", "text");
        $(".pin2").attr("type", "text");
        $(".pin3").attr("type", "text");
        $(".pin4").attr("type", "text");
    } else {
        $(".pin1").attr("type", "password");
        $(".pin2").attr("type", "password");
        $(".pin3").attr("type", "password");
        $(".pin4").attr("type", "password");
    }
})
//View CPassword 
$(".viewcpassword").click(function() {
    var cpasstype = $(".cpin1").attr("type");
    if (cpasstype == "password") {
        $(".cpin1").attr("type", "text");
        $(".cpin2").attr("type", "text");
        $(".cpin3").attr("type", "text");
        $(".cpin4").attr("type", "text");
    } else {
        $(".cpin1").attr("type", "password");
        $(".cpin2").attr("type", "password");
        $(".cpin3").attr("type", "password");
        $(".cpin4").attr("type", "password");
    }
})
// Enter password
</script>

<script type="text/javascript">
// pin auto next
var pinContainer = document.querySelector(".pin-code");
console.log('There is ' + pinContainer.length + ' Pin Container on the page.');
pinContainer.addEventListener('keyup', function(event) {
    var target = event.srcElement;
    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
    var myLength = target.value.length;
    if (myLength >= maxLength) {
        var next = target;
        while (next = next.nextElementSibling) {
            if (next == null) break;
            if (next.tagName.toLowerCase() == "input") {
                next.focus();
                break;
            }
        }
    }
    if (myLength === 0) {
        var next = target;
        while (next = next.previousElementSibling) {
            if (next == null) break;
            if (next.tagName.toLowerCase() == "input") {
                next.focus();
                break;
            }
        }
    }
}, false);

pinContainer.addEventListener('keydown', function(event) {
    var target = event.srcElement;
    target.value = "";
}, false);
</script>

<script>
var pinContainer = document.querySelector(".cpin-code");
console.log('There is ' + pinContainer.length + ' Pin Container on the page.');
pinContainer.addEventListener('keyup', function(event) {
    var target = event.srcElement;
    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
    var myLength = target.value.length;
    if (myLength >= maxLength) {
        var next = target;
        while (next = next.nextElementSibling) {
            if (next == null) break;
            if (next.tagName.toLowerCase() == "input") {
                next.focus();
                break;
            }
        }
    }
    if (myLength === 0) {
        var next = target;
        while (next = next.previousElementSibling) {
            if (next == null) break;
            if (next.tagName.toLowerCase() == "input") {
                next.focus();
                break;
            }
        }
    }
}, false);
pinContainer.addEventListener('keydown', function(event) {
    var target = event.srcElement;
    target.value = "";
}, false);
// only number
$('.OnlyNumberInput').keypress(function(event) {
    var code = event.which;

    if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
            $(this).val().indexOf('.') != 0) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
}).on('paste', function(event) {
    event.preventDefault();
});
// show alert
function _showAlert(alert) {
    $(".msg").html("<p>" + alert + "</p>");
    _removeAlert();
}
// for remove alert after 1 sec.
function _removeAlert() {
    setTimeout(function() {
        $(".msg").html('');
    }, 5000);
}
// focus
$(".pinChange").keyup(function() {
    var next = $(this).attr('data-next');
    if (this.value.length >= 1) {
        $(this).attr('type', "password");
        if (next != '') {
            $(next).focus();
            $(this).attr('type', "password");
        }
    }
});
// view & hide pass
$(".btnView").click(function() {
    var status = $(this).attr("data-status");
    var target = $(this).attr("data-target");

    if (status == 1) {
        $(this).attr("data-status", '0');
        $(target).attr("type", 'password');
        $(this).addClass('bi-eye').removeClass("bi-eye-slash");
    } else {
        $(target).attr("type", 'text');
        $(this).attr("data-status", '1');
        $(this).removeClass('bi-eye').addClass("bi-eye-slash");
    }
});
</script>