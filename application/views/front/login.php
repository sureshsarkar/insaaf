<section class="form_login_bg">
    <div class="container mar_tp_pp___">
        <div class="for_full_login_backhdf">
            <div class="row ">
                <div class="col-md-4 col-12 order-insaaf-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="___left_side_panel_call save__space3213654789">
                                <h2>It’s secure and confidential</h2>
                                <p>We maintain full data security and confidentiality of your personal details.
                                    <br>Please check our <span><a href="<?php echo base_url()?>terms-condition"
                                            target="_blank"> Terms of Use</a></span> and <span><a
                                            href="<?php echo base_url()?>privacy-policy" target="_blank"> Privacy
                                            Policy</a></span> for details.
                                </p>
                            </div>
                            <div class="___left_side_panel_call mt-5">
                                <h2>How does Insaaf99 Work?</h2>
                                <p>Get expert advice from top rated lawyers in India – Contact Now.</p>
                                <a href="<?php echo base_url()?>about-us" target="_blank"
                                    class="btn  knowMore3654 ">Know More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- login section-->
                <div class="col-md-8 loginCon _bodyCon col-12 order-insaaf-0">
                    <div class="fkrio_oodfk">
                        <div class="row ">
                            <div class="col-md-8">
                                <div class=" ">
                                    <div class="for_sometext_loginj">
                                        <h4>Login </h4>
                                    </div>
                                    <form id="form1">
                                        <div class="form-group">
                                            <label for="exampleInputNumber">Phone Number </label>
                                            <input type="text"
                                                class="form-control OnlyNumberInput ___mobiletypeframe mobile"
                                                id="mobile" value="" placeholder="Enter Phone number" maxlength="10">
                                        </div>
                                        <label for="exampleInputPassword1">Enter your Password</label>
                                        <div class="pin-code">
                                            <input type="number" id="pin1" name="pin1" class=" pinClass loginPIN pin1"
                                                data-next="2" maxlength="1">
                                            <input type="number" id="pin2" name="pin2" class=" pinClass loginPIN pin2"
                                                data-next="3" maxlength="1">
                                            <input type="number" id="pin3" name="pin3" class=" pinClass loginPIN pin3"
                                                data-next="4" maxlength="1">
                                            <input type="number" id="pin4" name="pin4" class=" pinClass loginPIN pin4"
                                                data-next="" maxlength="1">
                                            <div class="___login_cion566556465">
                                                &nbsp;<i class="bi bi-eye btnView" data-target=".loginPIN"
                                                    data-status="0"></i>
                                            </div>
                                        </div>
                                        <div class="forkdkfj_ooldjf">
                                            <a href="javascript:void(0)" id="btnForgetPassword" class="text-primary">
                                                Forgot Password
                                            </a>
                                        </div>
                                        <p class="msg text-danger"></p>
                                        <button type="submit"
                                            class="btn btn-primary log_button mob__log_button">Submit</button>
                                    </form>
                                </div>
                                <div class="centerOR">
                                    <span class="___orDraw">OR</span>
                                </div>
                            </div>
                            <div class="col-md-4 ___acceptCol">
                                <a href="<?php echo base_url('signup?type=client')?>">
                                    <div class="creat__account">
                                        <i class="bi bi-plus-circle-dotted"></i>
                                        <div class="for_sing_upinndr">
                                            <p> <a href="<?php echo base_url('signup?type=client')?>"><span
                                                        class="__new__vase51454">New User?</span>
                                                    <span class="__register__account__login"> Register
                                                        Account.</span></a></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end login screen-->
                <!-- login section ===================================== -->
                <div class="col-md-6 forgotCon _bodyCon hidden ">

                    <div class="fkrio_oodfk">
                        <div class="">
                            <h4 class="forgotHeading">
                                <?= (isset($_GET['label']) && !empty($_GET['label']))?$_GET['label']:"Forgot Password"?>
                            </h4>
                        </div>
                        <form id="form2">
                            <div class="form-group">
                                <label for="exampleInputNumber">Phone Number </label>
                                <input type="text" class="form-control ___mobiletypeframe OnlyNumberInput mobile"
                                    id="phone" placeholder="Enter Phone number" maxlength="10">
                            </div>
                            <div class="otp_section hidden">
                                <label for="exampleInputPassword1">Enter your OTP</label>
                                <div class="pin-code">
                                    <input type="number" id="pin11" class="pinClass pin1" data-next="22" maxlength="1">
                                    <input type="number" id="pin22" class="pinClass pin2" data-next="33" maxlength="1">
                                    <input type="number" id="pin33" class="pinClass pin3" data-next="44" maxlength="1">
                                    <input type="number" id="pin44" class="pinClass pin4" data-next="" maxlength="1">
                                    <div class="pt-3">
                                        &nbsp;<i class="bi bi-eye btnView" data-target=".pinClass" data-status="0"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="coundownCon  hidden">
                                <p id="counter" class=""></p>
                                <button type="button" class="btn btn-success verifyBtn for_nwe_ckdhf">Verify</button>
                            </div>
                            <p class="msg text-danger"></p>
                            <button type="button" class=" mt-2 btn btn-primary mob__log_button sendOtpBtn">Send
                                OTP</button>
                        </form>
                    </div>
                </div><!-- end login screen-->

                <!-- Pin section ===================================== -->
                <div class="col-md-6 pinCon _bodyCon hidden ">

                    <div class="fkrio_oodfk">
                        <div class="">
                            <h4 class="forgotHeading">Set new pin</h4>
                        </div>
                        <form id="form2">
                            <div class="otp_section">
                                <label for="exampleInputPassword1">Enter Password</label>
                                <div class="pin-code">
                                    <input type="number" id="pin5" class="pinClass _newpin1" data-next="6"
                                        maxlength="1">
                                    <input type="number" id="pin6" class="pinClass _newpin1" data-next="7"
                                        maxlength="1">
                                    <input type="number" id="pin7" class="pinClass _newpin1" data-next="8"
                                        maxlength="1">
                                    <input type="number" id="pin8" class="pinClass _newpin1" data-next="55"
                                        maxlength="1">
                                    <div class="pt-3">
                                        &nbsp;<i class="bi bi-eye btnView" data-target="._newpin1" data-status="0"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="otp_section">
                                <label for="exampleInputPassword1">Confirm Password</label>
                                <div class="pin-code">
                                    <input type="number" id="pin55" class="pinClass _newpin2" data-next="66"
                                        maxlength="1">
                                    <input type="number" id="pin66" class="pinClass _newpin2" data-next="77"
                                        maxlength="1">
                                    <input type="number" id="pin77" class="pinClass _newpin2" data-next="88"
                                        maxlength="1">
                                    <input type="number" id="pin88" class="pinClass _newpin2" data-next=""
                                        maxlength="1">
                                    <div class="pt-3">
                                        &nbsp;<i class="bi bi-eye btnView" data-target="._newpin2" data-status="0"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="msg text-danger"></p>
                            <button type="button" class="btn btn-primary saveBtn">Save</button>
                        </form>
                    </div>
                </div>
                <!--end set pin-->

                <!-- Success con ===================================== -->
                <div class="col-md-6 successCon _bodyCon text-center hidden ">
                    <img src="<?= base_url('assets/images/success.png')?>" width="130px ">
                    <br /><br />
                    <p class="text-success"><b>Pin Successfully Updated</b></p>
                    <br />
                    <a href="<?= base_url()?>login<?= (isset($_GET['m']))?"?mob=".$_GET['m']:""?>"
                        class="btn btn-primary saveBtn">Login
                        Now</a>
                </div>
            </div>
            <!--Success-->
        </div>
    </div>
    </div>
</section>
<script>
$(document).ready(function() {
    // To triger the forgot button to set password
    var type = "<?= (isset($_GET['type']) && $_GET['type'] == 'forgot')?true:false; ?>";
    var mob = "<?= (isset($_GET['mob']))?true:false; ?>";
    var myMobile = "<?= (isset($_GET['m']))?$_GET['m']:""; ?>";
    if (type) {
        $("#btnForgetPassword ").trigger("click");
    } else {
        $("#mobile").val(myMobile);
    }

    if (mob == true) {
        var mobilenum = "<?= (isset($_GET['mob']))?$_GET['mob']:''; ?>";
        $("#mobile").val(mobilenum);
    }

    if (myMobile != "") {
        $("#phone").val(myMobile);
    }

    $(".hide_this_section").addClass('hidden');
    // ===============================================
    $(".log_button").click(function(e) {

        $(".msg").html("");
        var mobile = $(".mobile").val();
        var pin1 = $(".pin1").val();
        var pin2 = $(".pin2").val();
        var pin3 = $(".pin3").val();
        var pin4 = $(".pin4").val();
        var pin = pin1 + pin2 + pin3 + pin4;
        var alert = '';
        if (mobile.length < 10) {
            alert = 'Enter 10 digit Phone number';
        } else if (pin.length < 4) {

            alert = 'Enter Password';
        }
        if (alert != '') {
            _showAlert(alert);
            return false;
        }
        // send ajax
        var url = "<?php echo base_url('signup_ajax/login'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                mobile: mobile,
                pin: pin
            },
            success: function(response) {
                // console.log(response);
                // return false;
                if (response == 1) {
                    // lawyer
                    window.location.href =
                        "<?= base_url("lawyer/dashboard?action=login")?>";
                } else if (response == 2) {
                    // client
                    window.location.href =
                        "<?= base_url("client/dashboard?action=login")?>";
                } else {
                    $(".loginPIN").val('');
                    $("#pin1").focus();
                    _showAlert(response);
                }
            }
        });
        return false;
    });
});

// when click forgate password
$("#btnForgetPassword").click(function() {
    $("._bodyCon").addClass("hidden");
    $(".forgotCon").removeClass("hidden");
    $("#phone").val($("#mobile").val());
});

// send otp
$(".sendOtpBtn").click(function() {
    $(".msg").html('');
    var mobile = $("#phone").val();
    if (mobile.length < 10) {
        _showAlert('Enter 10 digit Phone number');
        return false;
    } else {
        // send opt
        var url = "<?php echo base_url('signup_ajax/send_otp'); ?>";

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                mobile: mobile
            },
            success: function(response) {

                if (response == 99) {
                    // lawyer

                    _showAlert("Phone number does not exist!");
                } else {

                    var temp = response.trim().replace("testnnoseww", "");
                    $(".coundownCon").removeClass("hidden");
                    $(".otp_section").removeClass("hidden");
                    $(".sendOtpBtn").addClass("hidden");
                    $(".sendOtpBtn").html("Resend OTP");
                    // base64 decode 
                    window.matchotp = atob(temp);
                    _timerStart();
                }
            }
        });
    }
});

// verify OTP
// send otp
$(".verifyBtn").click(function() {
    $(".msg").html('');
    var pin1 = $("#pin11").val();
    var pin2 = $("#pin22").val();
    var pin3 = $("#pin33").val();
    var pin4 = $("#pin44").val();
    var pin = pin1 + pin2 + pin3 + pin4;
    var alert = '';
    if (phone.length < 10) {
        alert = 'Enter Phone number';
    } else if (pin.length < 4) {
        alert = 'Enter Password';
    }

    if (alert != '') {
        _showAlert(alert);
        return false;
    }
    if (window.matchotp == pin) {
        // save password 
        $("._bodyCon").addClass("hidden");
        $(".pinCon").removeClass("hidden")
    } else {
        $(".msg").html("Wrong OTP!");
        $(".pinClass").val("");
        $("#pin11").focus();
    }
});

// save pin 
$(".saveBtn").click(function() {
    $(".msg").html("");
    var pin1 = $("#pin5").val() + $("#pin6").val() + $("#pin7").val() + $("#pin8").val();
    var pin2 = $("#pin55").val() + $("#pin66").val() + $("#pin77").val() + $("#pin88").val();
    if (pin1 == pin2 && pin1.length == 4) {
        _saveNewPin(pin1);
    } else {
        _showAlert("Password does not match!");
    }

});

function _saveNewPin(pin) {
    var mobile = $("#phone").val();
    var url = "<?php echo base_url('signup_ajax/update_pin'); ?>";
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            mobile: mobile,
            pin: pin
        },
        success: function(response) {
            console.log(response);
            if (response == 1) {
                // new screen
                $("._bodyCon").addClass("hidden");
                $(".successCon").removeClass("hidden")
            } else {
                alert("Something went wrong!!");
            }
        }
    });
}

// only number
$('.OnlyNumberInput').keypress(function(event) {
    var code = event.which;

    if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
            $(this).val().indexOf('.') != 0) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
})
// .on('paste', function(event) {
//     event.preventDefault();
// });

// focus
$(".pinClass").keyup(function() {
    var next = $(this).attr('data-next');
    if (this.value.length >= 1) {
        $(this).attr('type', "password");
        if (next != '') {
            $("#pin" + next).focus();
            $(this).attr('type', "password");
        }
    }
});

// focus
$("#mobile").keyup(function() {
    if (this.value.length == 10) {
        $(".pin1").focus();
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
        $(target).attr("type", 'number');
        $(this).attr("data-status", '1');
        $(this).removeClass('bi-eye').addClass("bi-eye-slash");
    }
});
</script>

<script type="text/javascript">
// timer
function _timerStart() {
    var seconds = 120;
    var timer;

    function _fnCounter() {
        if (seconds < 120) {
            document.getElementById("counter").innerHTML = "Time Left " + Math.floor(seconds / 60) + ":" + (seconds %
                60 ? seconds % 60 : '00');
        }
        if (seconds > 0) { // so it doesn't go to -1
            seconds--;
        } else {
            clearInterval(timer);
            $(".coundownCon").addClass("hidden");
            $(".sendOtpBtn").removeClass("hidden");
        }
    }
    $(document).ready(function() {
        if (!timer) {
            timer = window.setInterval(function() {
                _fnCounter();
            }, 1000); // every second
        }
    });
}
// show alert
function _showAlert(msg) {
    $(".msg").html(msg);
    _removeAlert();
}
// for remove alert after 1 sec.
function _removeAlert() {
    setTimeout(function() {
        $(".msg").html('');
    }, 5000);
}
// back button --------------------
document.addEventListener("keydown", function(event) {
    if (event.keyCode == 8 || event.keyCode == 46) {
        var id = $("*:focus").attr("id");
        if (id.includes('pin')) {
            $(".loginPIN").val('');
            $("#pin1").focus();
        }
    }
});
</script>