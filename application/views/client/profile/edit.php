<style>
.__type_modal {
    border-radius: 10px;
}

.__type_modal .modal-title {
    font-size: 2rem;
}

.alertMessage {
    color: red;
}

.resend {
    float: revert;
    border: none;
    background: none;
    display: none;
}
</style>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<?php if(isset($userData) && !empty($userData)){?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- complete your profile sec-->
        <div class="row editCon <?=  ($userData->profile_complete > 84)?'hidden':'' ?> ">
            <div class="box">
                <div class="row py-2">
                    <div class="col-md-2 col-xs-3 text-center ml-3">
                        <!-- progress bar-->
                        <div class="mt-4" role="progressbar" aria-valuenow="<?=  $userData->profile_complete ?>"
                            aria-valuemin="0" aria-valuemax="100" style="--value:<?=  $userData->profile_complete ?>">
                        </div>
                        <!-- end progress bar-->
                    </div>
                    <div class="col-md-8 col-xs-8">
                        <h2 class="text-danger pl-2 yourProfileTextSize">Your profile
                            <?=  $userData->profile_complete ?>% completed.
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!--// complete your profile sec-->
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="bg__white_col">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="radius__col">
                                <img src="<?php echo base_url()?>assets/images/cover_im.jpg" class="img-responsive">
                            </div>
                        </div>
                    </div>

                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 p-0">
                                    <form method="POST" action="<?php echo base_url('client/profile/update')?>"
                                        role="form" id="form1" enctype="multipart/form-data">
                                        <div class="bg__white_col">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12 col-xs-12">
                                                            <div class="dasProfile change__img" id="previewImg">
                                                                <div class="___edit__pencil">
                                                                    <i class="bi bi-pencil-fill"></i>
                                                                </div>
                                                                <img src="<?php if(isset($userData->image) && !empty($userData->image)){
                                                echo base_url().$userData->image;
                                             }else{ echo base_url().'assets/images/new_user.png';
                                             }?>" class="img-responsive" id="showIMG">

                                                            </div>
                                                            <input type="file" name="image" id="lawyerFile"
                                                                class="hidden">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-9 br-left">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="profile___name">
                                                                <span
                                                                    class="name m-0"><?=$userData->fname.' '.$userData->lname?></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="classified__space __mainCol">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label type="text">First Name:</label><br>
                                                                            <input type="text" name="fname" id="fname"
                                                                                class="form-control classified"
                                                                                value="<?=$userData->fname?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label type="text">Last Name:</label><br>
                                                                            <input type="text" name="lname" id="lname"
                                                                                class="form-control classified"
                                                                                value="<?=$userData->lname?>"
                                                                                placeholder=" ">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label type="text">Gender:</label><br>
                                                                            <div class=" mar______">
                                                                                <?php 
                                              $checked1="";
                                              $checked2="";
                                              $checked3="";
                                              if($userData->gender==1){
                                                 $checked1="checked";
                                                  }
                                                  elseif($userData->gender==2){
                                                    $checked2="checked";
                                                }
                                                else{
                                                    $checked3="checked";
                                                }
                                                    ?>
                                                                                <div
                                                                                    class="form-check form-check-inline">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="gender"
                                                                                        id="inlineRadio1" value="1"
                                                                                        <?php echo $checked1;?> />
                                                                                    <label
                                                                                        class="form-check-label m-lable"
                                                                                        for="inlineRadio1">Male</label>
                                                                                </div>

                                                                                <div
                                                                                    class="form-check form-check-inline mar232______">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="gender"
                                                                                        id="inlineRadio2" value="2"
                                                                                        <?php echo $checked2;?> />
                                                                                    <label
                                                                                        class="form-check-label m-lable"
                                                                                        for="inlineRadio2">Female</label>
                                                                                </div>
                                                                                <div
                                                                                    class="form-check form-check-inline mar232______">
                                                                                    <input class="form-check-input"
                                                                                        type="radio" name="gender"
                                                                                        id="inlineRadio3" value="3"
                                                                                        <?php echo $checked3;?> />
                                                                                    <label
                                                                                        class="form-check-label m-lable"
                                                                                        for="inlineRadio3">Other</label>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="__flex_item">

                                                                            <div class="form-group w2-100">
                                                                                <label type="text">Email:</label><br>
                                                                                <input type="text" name="Email"
                                                                                    id="e-mail"
                                                                                    class="form-control classified"
                                                                                    value="<?=$userData->email?>"
                                                                                    disabled>
                                                                            </div>
                                                                            <button type="button"
                                                                                class="btn classified1121 " id="_change"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModal8989">
                                                                                Change
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class=" group-d">
                                                                            <label type="text" class="d-text ">Mobile
                                                                                Number:</label><br>
                                                                            <input type="text" name="mob_number"
                                                                                id="mname"
                                                                                class="form-control classified OnlyNumberInput d-text "
                                                                                value="<?=$userData->mobile?>"
                                                                                placeholder="921146487" disabled="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="group-d">
                                                                            <label type="text" class="d-text ">Client
                                                                                ID:</label><br>
                                                                            <input type="text" name="Client"
                                                                                id="Id-client"
                                                                                class="form-control d-text  classified "
                                                                                value="<?=$userData->client_unique_id?>"
                                                                                disabled="">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Additional Info-->
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label type="text">Additional
                                                                                Info:</label><br>
                                                                            <textarea rows="2" name="address"
                                                                                id="address"
                                                                                class="form-control classified"><?=$userData->address?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--// Additional Info-->
                                                                <div class="row">
                                                                    <div class="msg"></div>
                                                                    <div class="col-md-6">
                                                                        <input type="hidden" name="oldimage1"
                                                                            value="<?php echo $userData->image; ?>" />
                                                                        <div class="edit_button ">
                                                                            <button type="submit"
                                                                                class="btn editpro1212" id="save_data">
                                                                                Save</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="edit_button ">

                                                                            <button type="button"
                                                                                class="btn btn-primary btn-sm __removeoldpin"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModal89895">
                                                                                Reset Password
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
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- passwprd reset modal -->

                    <div class="modal fade" data-backdrop="static" id="exampleModal89895" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content __type_modal">
                                <div class="modal-header">
                                    <h5 class="modal-title text-warning" id="exampleModalLabel">Update your password
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span> </button>
                                    </h5>


                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label type="text" class="marui____">New Password :</label><br>
                                                <div class="rpin-code password">
                                                    <input type="password" class="pinClass rpin1" data-next=".rpin2"
                                                        maxlength="1">
                                                    <input type="password" class="pinClass rpin2" data-next=".rpin3"
                                                        maxlength="1">
                                                    <input type="password" class="pinClass rpin3" data-next=".rpin4"
                                                        maxlength="1">
                                                    <input type="password" class="pinClass rpin4" data-next=".crpin1"
                                                        maxlength="1">
                                                    <span class="fa fa-fw fa-eye  viewpassword frodjf viewPass"
                                                        data-target="password" data-status="0"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label type="text" class="maruiyuy____">Confirm Password :</label><br>
                                                <div class="rcpin-code cpassword">
                                                    <input type="password" class="crpin1" data-next=".crpin2"
                                                        maxlength="1">
                                                    <input type="password" class="crpin2" data-next=".crpin3"
                                                        maxlength="1">
                                                    <input type="password" class="crpin3" data-next=".crpin4"
                                                        maxlength="1">
                                                    <input type="password" class="crpin4" data-next="" maxlength="1">
                                                    <span class="fa fa-fw fa-eye  viewrcpassword frodjf viewCPass"
                                                        data-target="cpassword" data-status="0"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="msg"></div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="col-md-12 pad-l">
                                                <button type="button" class="btn classified1121btn save_pin">
                                                    Set Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <!-- change modal -->
                    <div class="modal fade" data-backdrop="static" id="exampleModal8989" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <div class="modal-content __type_modal ">
                                <div class="hfgjdhfgjh">
                                    <!-- Loader div -->
                                </div>
                                <div class="dgfhh">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?= (isset($_GET['msg']))?'<p  class="text-success" >'.$_GET['msg'].'</p>':'' ?>
                                        <h5 class="modal-title dis_block emailBox" id="exampleModalLabel">Enter Your
                                            Email Id</h5>
                                        <h5 class="modal-title verify_opt" id="exampleModalLabel">Enter OTP</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="email" name="email" id="email"
                                            class="form-control dis_block emailBox __emailrem" value=""
                                            placeholder="Enter Your Email Id">
                                        <input type="number" class="form-control optval verify_opt" value="">
                                    </div>
                                    <div class="modal-footer dmfgkdj">
                                        <button type="button" class="btn flot_ll send_opt_email dis_block">Send
                                            OTP</button>
                                        <button type="button"
                                            class="btn flot_ll verify_opt verify_opt_send">Verify</button>
                                        <button type="text" class="text-primary resend send_opt_email">Resend</button>
                                        <div class="countdown"></div>
                                        <div class="alertMessage"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>

                <script>
                function verify_opt(time, type) {
                    var className = 'hfgjdhfgjh';
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
                        //minutes = (minutes < 10) ?  minutes : minutes;
                        $('.countdown').html("OTP Expire in :  <b class='text-primary'>0" + minutes + ':' +
                            seconds + "</b>");

                        if ((seconds <= 0) && (minutes <= 0)) {
                            clearInterval(interval);
                            $('.countdown').html('');
                            $(".resend").css("display", "block");
                            $(".emailBox").css("display", "block");
                            $(".verify_opt").css("display", "none");

                        }
                        timer2 = minutes + ':' + seconds;
                    }, 1000);
                }
                </script>

                <!-- Delete Script-->
                <script type="text/javascript">
                jQuery(document).ready(function() {

                    $(".__removeoldpin").click(function() {
                        var p = "";
                        $(".pinClass").val(p);
                    });

                    $(".__emailrem").val(" ");
                    // set old email on email change button start
                    $("#_change").click(function() {
                        var e = "<?php echo $userData->email?>";
                        $("#email").val(e);
                    });
                    // set old email on email change button end


                    var emailVeriry =
                        "<?= (isset($_GET['action']) && $_GET['action'] == 'verify_email')?true:false; ?>";
                    if (emailVeriry) {
                        $(".classified1121 ").trigger("click");
                    } else {
                        emailVeriry =
                            "<?= (isset($requireUpdate) && $requireUpdate == 'email_verify')?true:false; ?>";
                        if (emailVeriry) {
                            $(".classified1121 ").trigger("click");
                            var e = "<?php echo $userData->email?>";
                            $("#email").val(e);
                        }
                    }

                    // Save changes profile data

                    // ------------------------------------------     
                    $("#form1").submit(function() {
                        var fname = $("#fname").val();
                        var lname = $("#lname").val();
                        var about = $("#about").val();
                        var image = $("#lawyerFile").val();


                        //return false;

                    });
                    // Save changes profile data end
                    // Loader function

                    function loadergif(className, type) {
                        $("." + className).css("display", type);
                        $("." + className).html(
                            '<div class="text-center"><img src="<?=base_url()?>assets/images/loader.gif" width="70" class="img-fluid" alt="IKP"><br><br><p>Please wait !</p></div>'
                        );
                    }
                    // send email otp start
                    $(".send_opt_email").click(function() {
                        var email = $("#email").val();

                        var emailvalid = validate(email);

                        if (email == "") {
                            $(".alertMessage").css("display", "block");
                            $(".alertMessage").html(
                                "<div class='red__88'>Enter Your Email Id</div>"
                            );

                            setInterval(function() {
                                $(".alertMessage").css("display", "none");
                            }, 5000);
                            return false;
                        }

                        if (emailvalid == false) {
                            $(".alertMessage").css("display", "block");
                            $(".alertMessage").html(
                                "<div class='red__88'>Enter Valid Email Id</div>"
                            );

                            setInterval(function() {
                                $(".alertMessage").css("display", "none");
                            }, 5000);
                            return false;
                        }
                        var className = 'hfgjdhfgjh';
                        var type = 'block';
                        loadergif(className, type);
                        $(".dgfhh").css("display", "none");
                        $(".resend").css("display", "none");


                        var url = "<?php echo base_url('client/profile/send_email_otp'); ?>";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                email: email
                            },
                            success: function(response) {
                                if (response == 1) {
                                    var type = 'none';
                                    var time = "02:59";
                                    verify_opt(time);
                                    //loadergif(className, type);
                                    $(".hfgjdhfgjh").css("display", "none");
                                    $(".dgfhh").css("display", "block");
                                    $(".dis_block").css("display", "none");
                                    $(".verify_opt").css("display", "block");
                                    $(".resend").css("display", "none");
                                    return false;
                                } else {
                                    var type = 'none';
                                    loadergif(className, type);
                                    $(".dis_block").css("display", "block");
                                    $(".verify_opt").css("display", "none");
                                }
                            }
                        });
                        return false;

                    });
                    // send email otp start

                    // Verify email otp start***********************************************************
                    $(".verify_opt_send").click(function() {
                        var email = $("#email").val();
                        var otp = $(".optval").val();

                        // progress active
                        $(".hfgjdhfgjh").css("display", "block");
                        $(".dgfhh").css("display", "none");

                        var url = "<?php echo base_url('client/profile/verify_email_otp'); ?>";
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                email: email,
                                otp: otp
                            },
                            success: function(response) {
                                if (response == 1) {
                                    // progress active
                                    $(".hfgjdhfgjh").css("display", "none");
                                    alert("Email id successfully updated");
                                    window.location.href =
                                        '<?= (isset($_GET['msg']))?base_url('client/create_case'):base_url('client/profile/edit') ?>';
                                    return false;
                                } else {

                                    $(".dis_block").css("display", "none");
                                    $(".verify_opt").css("display", "block");

                                    $(".alertMessage").css("display", "block");
                                    $(".alertMessage").html(
                                        "<div class='red__88'>Wrong OTP!</div>"
                                    );

                                    $(".hfgjdhfgjh").css("display", "none");
                                    $(".dgfhh").css("display", "block");

                                    setInterval(function() {
                                        $(".alertMessage").css("display", "none");
                                    }, 2000);
                                    return false;
                                }
                            }
                        });
                        return false;

                    });
                    // Verify email otp start

                    //$('#example').DataTable();

                    jQuery(document).on("click", ".deletebtn", function() {
                        var tableId = $(this).attr("data_id");
                        currentRow = $(this);
                        hitURL = "<?php echo base_url() ?>client/client/delete";
                        var confirmation = confirm("Are you sure to delete this Categorys ?");
                        if (confirmation) {
                            $.ajax({
                                type: 'POST',
                                url: hitURL,
                                data: {
                                    id: tableId
                                },
                            }).done(function(data) {
                                currentRow.parents('tr').remove();
                                if (data.status = true) {
                                    alert("successfully deleted");
                                    location.reload();
                                } else if (data.status = false) {
                                    alert("deletion failed");
                                } else {
                                    alert("Access denied..!");
                                }
                            });



                        }
                    });
                });
                </script>
                <!-- Get Databse List -->

                <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                });
                </script>



                <script type="text/javascript">
                $('.OnlyNumberInput').keypress(function(event) {
                    var code = event.which;

                    if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
                            $(this).val().indexOf('.') != 0) && (event.which < 48 || event.which > 57)) {
                        event.preventDefault();
                    }
                }).on('paste', function(event) {
                    event.preventDefault();
                });
                </script>

                <script type="text/javascript">
                // pin auto next

                var pinContainer = document.querySelector(".rpin-code");

                console.log('There is ' + pinContainer.length + ' Pin Container on the page.');

                pinContainer.addEventListener('keyup', function(event) {
                    var target = event.srcElement;

                    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
                    var myLength = target.value.length;


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
                <script type="text/javascript">
                // pin auto next

                //var pinContainer = document.getElementsByClassName("pin-code")[0];
                var pinContainer = document.querySelector(".rcpin-code");

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

                    // if (myLength === 0) {
                    //     var next = target;
                    //     while (next = next.previousElementSibling) {
                    //         if (next == null) break;
                    //         if (next.tagName.toLowerCase() == "input") {
                    //             next.focus();
                    //             break;
                    //         }
                    //     }
                    // }
                }, false);

                pinContainer.addEventListener('keydown', function(event) {
                    var target = event.srcElement;
                    target.value = "";
                }, false);
                </script>

                <!-- view password  -->
                <script>
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
                // view confirm password 
                $(".viewCPass").click(function() {
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


                // $(".save_pin").click(function() {
                //  alert("pl");
                // });
                // Save Password 

                $(".save_pin").click(function() {


                    var pin1 = $(".rpin1").val();
                    var pin2 = $(".rpin2").val();
                    var pin3 = $(".rpin3").val();
                    var pin4 = $(".rpin4").val();

                    var cpin1 = $(".crpin1").val();
                    var cpin2 = $(".crpin2").val();
                    var cpin3 = $(".crpin3").val();
                    var cpin4 = $(".crpin4").val();
                    var password = pin1 + pin2 + pin3 + pin4;
                    var cpassword = cpin1 + cpin2 + cpin3 + cpin4;
                    var url = "<?php echo base_url('client/profile/save_pin'); ?>";

                    if (password.length < 4 && cpassword.length < 4) {
                        $(".msg").css("display", "block");
                        $(".msg").html(
                            "<p style='margin-left: 44px;color: red;font-weight: 600;text-align:center;'>Enter 4 digits Password !</p>"
                        );
                        setInterval(function() {
                            $(".msg").css("display", "none");
                        }, 4000);

                        $(".cpassword input").val('');
                        return false;
                    }

                    if (cpassword.trim() != password.trim()) {
                        $(".msg").css("display", "block");
                        $(".msg").html(
                            "<p style='margin-left: 44px;color: red;font-weight: 600;text-align:center;'>Password do not match!</p>"
                        );
                        setInterval(function() {
                            $(".msg").css("display", "none");
                        }, 4000);

                        $(".cpassword input").val('');
                        return false;
                    } else {
                        // form data

                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: {
                                password: password,
                                cpassword: cpassword
                            },
                            success: function(response) {
                                if (response == 1) {
                                    // lawyer
                                    location.reload();
                                } else {
                                    $(".msg").css("display", "block");
                                    $(".msg").html(
                                        "<p style='margin-left: 44px;color: red;font-weight: 600;text-align:center;'>Your old Password same as new Password!</p>"
                                    );
                                    setInterval(function() {
                                        $(".msg").css("display", "none");
                                    }, 4000);

                                    $(".cpassword input").val('');
                                    return false;
                                }
                            }
                        });
                        return false;
                    }
                });


                // focus
                $(".pinClass").keyup(function() {
                    var next = $(this).attr('data-next');
                    if (this.value.length >= 1) {
                        $(this).attr('type', "password");
                        if (next != '') {
                            $(next).focus();
                            $(this).attr('type', "password");
                        }
                    }
                });

                // // focus
                // $("#mobile").keyup(function () {
                //     if (this.value.length == 10) {
                //       $(".pin1").focus();
                //     }
                // });


                $("#previewImg").click(function(fb) {
                    $("#lawyerFile").trigger("click");
                }) // Live Image change ontime ===========================================

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#showIMG').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]); // convert to base64 string
                    }
                }



                $("#lawyerFile").change(function() {
                    readURL(this);
                });




                // email validation 
                function validate(email) {
                    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                    if (reg.test(email) == false) {
                        $('.email_validation').html('<div class="alert-danger">Invalid Email Address</div>');
                        $(".apply_btn").attr("disabled", "disabled");
                        return (false);
                    } else {
                        $('.email_validation').html('');
                        return (true);
                    }

                }
                </script>