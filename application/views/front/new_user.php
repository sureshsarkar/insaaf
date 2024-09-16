<style>
input[type=radio] {
    box-sizing: border-box !important;
    padding: 0 !important;
    display: none !important;
}

.dateBtnStyle {
    /* width: 65px; */
    border: 1px solid #060e45;
    color: #060e45;
    /* border-radius: 55%; */
    /* height: 39px; */
    width: 78px;
}

.active {
    background: #060e45 !important;
}

.slot_date_div:hover {
    background: #060e45 !important;

}

.payBtn {
    background: #060e45 !important;
    color: #fff !important;
    padding: 16px 18px;
    border: 3px solid #fff;
    border-radius: 60px !important;
    font-weight: 700;
    font-size: 20px;
    line-height: 15px;
    letter-spacing: 0.1rem;
    margin: 3px 5px 14px 5px;

}

.payBtn:hover {
    background: #ff9100 !important;
}


.disabled {
    pointer-events: none !important;
    border: 1px solid red;
    /* background: #ff000b!important; */
    color: #ff000b !important;
}

.border-calendera {
    text-align: center;
}

.box_time_solt {
    justify-content: center;
}
</style>
<?php  $schedule_times = getStaticTime();
 ?>

<div class="main_form_con" style="background-color: #f0f8ff;">
    <section id="cll_talk_butn">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main_conslt_heding text-center">
                        <h1>Let's Talk</h1>
                        <h6>Book your Online meeting with our Legal Expert</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form action="<?=base_url('new_user/pay_for_slot')?>" method="post" onSubmit="return checkLength()">
                <div class="row">
                    <div class="col-md-6 col-xl-4 col-lg-4 col-sm-12">
                        <div class="enter_dtail">
                            <h5>Enter Your Details</h5>
                        </div>
                        <form>
                            <div class="form-group chng_emil_box">
                                <label for="inputCategory">Select Area of Concern*</label>
                                <select id="inputCategory" class="form-control" name="case_category_id" required>
                                    <option value="">---Select--- </option>
                                    <?php if(isset($all_category) && !empty($all_category)){
                                     foreach ($all_category as $key => $value) {?>
                                    <option value="<?=$value->id?>"><?php echo $value->name?></option>
                                    <?php }}?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-6 chng_emil_box">
                                    <label for="FName">First Name*</label>
                                    <input type="text" class="form-control fname" name="fname" required>
                                </div>
                                <div class="form-group col-md-6 col-6 chng_emil_box">
                                    <label for="LName">Last Name*</label>
                                    <input type="text" class="form-control lname" name="lname" required>
                                </div>
                            </div>
                            <div class="form-group chng_emil_box">
                                <label for="inputMobile">Mobile*</label>
                                <div class="mobile_validation"></div>
                                <input type="text" class="form-control" name="mobile" maxlength="10" id="mobile"
                                    required>
                            </div>
                            <div class="form-group chng_emil_box">
                                <label for="inputEmail4">Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-row pt-2">
                                <div class="form-group col-md-6 col-6 p-1 chng_emil_box">
                                    <label for="inputState">Select Your State*</label>
                                    <select id="inputState" class="form-control" name="state" required>
                                        <option value="">---Select--- </option>
                                        <?php if(isset($states) && !empty($states)){
                                     foreach ($states as $k => $v) {?>
                                        <option value="<?=$v->name?>"> <?php echo ucfirst($v->name)?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-6 p-1 chng_emil_box">
                                    <label for="LName">Enter Your City*</label>
                                    <input type="text" id="inputCity" class="form-control" name="city" required>
                                </div>
                            </div>
                            <div class="form-group chng_emil_box">
                                <label for="inputmessage">Enter Your Query (Optional)</label>
                                <textarea name="case_description" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 col-xl-4 col-lg-4 col-sm-12">
                        <div class="enter_dtail">
                            <div class="monthname">
                                <!-- <h6><?php echo date("F Y")?></h6> -->
                            </div>
                            <h5>Select Meeting Date*</h5>
                        </div>

                        <div class="border-calendera">

                            <div class="d-flex flex-row flex-wrap ">
                                <div class=" btn-group-toggle ___toggle_date" data-toggle="buttons">
                                    <?php 
                                    $Date =date("Y-m-d");

                                    // for today slot showing
                                    $i=(isset($_GET['t']) && $_GET['t']=="true")?"0":"1";
                                  
                                    for ($i; $i <= 30 ; $i++) { 
                                        $check_sess = date('d M Y', strtotime($Date. ' + '.$i.' days'));
                                    $find_sunday = date('D', strtotime($Date. ' + '.$i.' days'));
                                    if($find_sunday == 'Sun'){
                                                $active = ''; $checked = '';$disabled = 'disabled';
                                    }else{
                                          if((isset($_GET['t']) && $_GET['t']=="true")){
                                            if($i==0){
                                                $active = 'active'; $checked = 'checked';$disabled = '';
                                            }else{
                                                $active = ''; $checked = '';$disabled = '';
                                            }
                                          }else{
                                            if($i==1){
                                                $active = 'active'; $checked = 'checked';$disabled = '';
                                            }else{
                                                $active = ''; $checked = '';$disabled = '';
                                            }
                                          }
                                           
                                    }
                                ?>
                                    <label
                                        class="btn my-1 btn-outline-primary des_btn_colr_fjjjg slot_date_div dateBtnStyle <?php echo $active;?> <?=$disabled;?>"
                                        data-id="<?php echo $i; ?>">
                                        <input type="radio" name="schedule_date"
                                            class="slot_date_input_<?php echo $i; ?>"
                                            data-day="<?php echo date('D', strtotime($Date)); ?>"
                                            value="<?php echo date('d M Y', strtotime($Date. ' + '.$i.' days')); ?>"
                                            <?php echo $checked;  ?>>
                                        <?php  echo date('d D', strtotime($Date. ' + '.$i.' days'));?>
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4 col-lg-4 col-sm-12">
                        <div class="enter_dtail">
                            <h5>Select Meeting Time*</h5>
                        </div>

                        <div class="box_time_solt btn-group-toggle ___toggle_date put_schedule" data-toggle="buttons">
                            <?php $n=0; foreach($schedule_times as $schedule_time){ ?>
                            <?php 
                                $Date = date('Y-m-d');
                                $AddDt =date('Y-m-d', strtotime($Date. ' + 1 days'));
                                // for today slot showing
                                $AddDate=(isset($_GET['t']) && $_GET['t']=="true")?$Date:$AddDt;
                                $addTime = date("H:i:s", strtotime($schedule_time));
                                $AddDate =date("Y-m-d H:i:s", strtotime("$AddDate $addTime"));
                                $booked = check_slot_booked($AddDate); //check time booked or not function
                                
                               // call function fetche date & time from scheduler table to block date time || check_date_time_block()
                                $dateBlock = date("Y-m-d", strtotime("$AddDate"));
                                $timeBlock = date("h:i A", strtotime("$schedule_time"));
                                $date_time_block = check_date_time_block($dateBlock,$timeBlock);

                                if ($n==0 && $booked !=1) {
                                    $active = 'active'; $checked = 'checked';
                                }else{
                                    $active = ''; $checked = '';
                                }
                                
                                if ($booked == 1) {
                                    $disabled = 'disabled';  $checked = '';  $n--;
                                }elseif((isset($date_time_block) && !empty($date_time_block))){
                                    $disabled = 'disabled'; $active = ''; $checked = ''; $n--;
                                }else{
                                    $disabled = '';
                                }
                            ?>

                            <div class="slote">
                                <label
                                    class="btn btn-outline-primary des_btn_colr_fjjjg <?php echo $active. ' ' .$disabled; ?>">
                                    <input type="radio" name="schedule_time" value="<?php echo $schedule_time; ?>"
                                        <?php echo $checked; ?>>
                                    <?php echo $schedule_time;?>
                                </label>
                            </div>

                            <?php $n++; } ?>
                        </div>

                        <!-- <button type="submit"
                            class="btn payBtn m-1"><?= (isset($userSlotData) && count($userSlotData) >= 2)?'Pay ₹499 to book slot':'Pay ₹499 to book slot' ?>
                        </button> -->
                    </div>
                    <div class="col-md-12 text-center">
                        <input type="hidden" name="refrence" value="<?=$this->uri->segment(1)?>">
                        <button type="submit" class="btn payBtn" style="width:30%">Submit</button>
                        <!-- <button type="submit" class="btn payBtn"
                            style="width:30%"><?= (isset($userSlotData) && count($userSlotData) >= 2)?'Schedule My Consultation':'Schedule My Consultation' ?>
                        </button> -->
                    </div>
            </form>
        </div>
    </section>
</div>
<!--// main form-->


<script>
function checkLength() {
    if ($('input[name="schedule_time"]:checked').length == 0) {
        //alert('Schedule time not available');
        alert('Select Schedule time');
        return false;
    }

    if ($('input[name="schedule_date"]:checked').length == 0) {
        //alert('Schedule time not available');
        alert('Select Schedule Date');
        return false;
    }
}
</script>

<script type="text/javascript">
$(document).ready(function() {
    $(".slot_date_div").click(function() {
        var slot_data_id = $(this).attr('data-id');
        var schedule_day = $('.slot_date_input_' + slot_data_id).attr('data-day');
        var schedule_date = $('.slot_date_input_' + slot_data_id).val();
        // alert(schedule_day); exit();

        // var lawyer_id = "<?php echo $this->session->userdata('ses_lawyer_id'); ?>";
        var url = "<?php echo base_url('new_user/get_time'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                schedule_day: schedule_day,
                lawyer_id: '',
                schedule_date: schedule_date
            },
            success: function(response) {
                $(".put_schedule").html(response);
                // alert(response);
            }
        });
    });


    $("#mobile").keyup(function() {
        var mobile = $("#mobile").val();
        let value = mobile.replace(/[^0-9]/g, "");
        $(this).val(value);
        if (mobile.length == 1 && mobile == '0') {
            var mobileNum = "";
            $("#mobile").val(mobileNum);
        }

        if (mobile.length == 2 && mobile == '91') {
            var mobileNum = "";
            $("#mobile").val(mobileNum);
        }

        if (mobile.length < 10) {
            $('.mobile_validation').html(
                '<div class="alert-danger">Enter 10 digit mobile number</div>');
            $(".apply_btn").attr("disabled", "disabled");
        } else {
            $('.mobile_validation').html('<div class="alert-success"></div>');
            // return (true); 
        }
        // else {
        //     var url = "<?php echo base_url('new_user/getMobileNumber'); ?>";
        //     $.ajax({
        //         type: 'POST',
        //         url: url,
        //         data: {
        //             mobile: mobile
        //         },
        //         success: function(response) {
        //             var res = JSON.parse(response);
        //             if (res.status == 1) {
        //                 alert("You have already registered as a client, So please login");
        //                 var resData = res.data;
        //                 var pin = resData.login_pin;
        //                 if (pin.length != 4) {

        //                     var href =
        //                         "<?php echo base_url('login')?>?label=Set 4 Digit PIN&type=forgot&m=" +
        //                         resData.mobile
        //                     window.location.href = href;
        //                     return false;
        //                 } else {
        //                     var href = "<?php echo base_url('login')?>" + "?m=" +
        //                         resData.mobile;
        //                     window.location.href = href;
        //                     return false;
        //                 }

        //             } else if (res.status == 2) {
        //                 alert("You have already registered as a lawyer, So please login");
        //                 var resData = res.data;
        //                 var pin = resData.login_pin;
        //                 if (pin.length != 4) {
        //                     var href =
        //                         "<?php echo base_url('login')?>?label=Set 4 Digit PIN&type=forgot&m=" +
        //                         resData.mobile
        //                     window.location.href = href;
        //                     return false;
        //                 } else {
        //                     var href = "<?php echo base_url('login')?>" + "?m=" +
        //                         resData.mobile;
        //                     window.location.href = href;
        //                     return false;
        //                 }

        //             }
        //         }
        //     });

        //     $('.mobile_validation').html('<div class="alert-success"></div>');
        //     return (true);
        // }
    })



    // when change form 
    $("#inputCategory").change(function() {
        _ajaxCall();
    });

    $("#inputState").change(function() {
        _ajaxCall();
    });

    // when change form 
    $("#mobile, .fname, #inputCity").keyup(function() {
        _ajaxCall();
    });

    function _ajaxCall() {
        //fullname, mobile, category
        //var userIp = '<?= $_SERVER['REMOTE_ADDR']; ?>';

        var fname = $(".fname").val();
        var mobile = $("#mobile").val();

        // alert(fname);
        let inputCategory = ""
        inputCategory = $("#inputCategory").val();
        let inputState = ""
        inputState = $("#inputState").val();
        let inputCity = ""
        inputCity = $("#inputCity").val();
        // alert(inputCity);
        var keyword = '<?php isset($_GET['keyword'])?$_GET['keyword']:'' ?>';
        var camp_id = '<?php isset($_GET['camp_id'])?$_GET['camp_id']:'' ?>';


        var url = "<?php echo base_url("ppc/temDataFunc");?>"
        $.ajax({
            type: "POST",
            url: url,
            data: {
                name: fname,
                mobile: mobile,
                category: inputCategory,
                state: inputState,
                city: inputCity,
                camp_id: camp_id,
                keyword: keyword
            },
            success: function(returnVal) {
                console.log(returnVal);
            }
        });
        return false;
    }

});
</script>