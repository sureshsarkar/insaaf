<style>
.phone_section {
    display: none;
}
</style>

<style>
.robotValue {
    width: 72px !important;
    margin: 0px;
}
</style>
<style>


</style>
<?php  $schedule_times = getStaticTime();?>

<div class="main_form_con">
    <div class="_btnClose"><span>x</span></div>
    <section id="cll_talk_butn">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main_conslt_heding text-center mb-0">
                        <div class="_clickBack hidden">
                            <div class="btn btnColor"> Back </div>
                        </div>
                        <h3><img src="<?=base_url()?>assets/images/ppc/businessman.png" alt=""> Let's Talk</h3>
                        <p><small>Book your Online meeting with our Legal Expert</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form action="<?=base_url('new_user/pay_for_slot')?>" method="post" onSubmit="return checkLength()">
                <div class="row">
                    <div class="col-md-6 col-xl-4 col-lg-4 col-sm-12 firstCon ">
                        <div class="form-group chng_emil_box mt-1">
                            <label for="FName">Select Your Problem*</label>
                            <select id="inputCategory" class="form-control category" name="case_category_id" required>
                                <option value="">---Select--- </option>
                                <?php if(isset($all_category) && !empty($all_category)){
                                         foreach ($all_category as $key => $value) {?>
                                <option value="<?=$value->id?>" class="<?=$value->id?>" data_cat="<?=$value->name?>">
                                    <?php echo $value->name?>
                                </option>
                                <?php }}?>
                            </select>
                            <info class="textInfo">Please choose a problem type to understand your issues</info>
                        </div>
                        <div class="form-group chng_emil_box">
                            <label for="FName">Name*</label>
                            <input type="text" class="form-control fullname" id="userName" name="fullname"
                                placeholder="" required>
                            <info class="textInfo">Please Enter your full name to identify you</info>
                        </div>

                        <div class="form-group chng_emil_box">
                            <label for="inputMobile">Mobile1*</label>
                            <div class="mobile_validation"></div>
                            <input type="text" class="form-control mobile" name="mobile" placeholder="" maxlength="11"
                                id="mobile" required>
                            <info class="textInfo">Please Enter your mobile number to contact with you</info>
                        </div>

                        <p class="text-danger m-0 showError"></p>

                        <div class="row">
                            <div class="col-12 text-center"> <button class="btn  btn-themeCall btnNext mb-2">Call
                                    Now</button></div>
                        </div>

                    </div>

                    <div class="col-md-6 col-xl-4 col-lg-4 col-sm-12 hidden _secondCon">
                        <div class="enter_dtail">
                            <h5>Select Call Date* </h5>
                            <small>(When you call with lawyer ?)</small>
                        </div>

                        <div class="border-calendera">
                            <div class="">
                                <div class=" btn-group-toggle ___toggle_date clentdr" data-toggle="buttons">
                                    <?php 
                                        $Date =date("Y-m-d");
                                        for ($i=1; $i <= 30 ; $i++) { 
                                            $check_sess = date('d M Y', strtotime($Date. ' + '.$i.' days'));
                                        $find_sunday = date('D', strtotime($Date. ' + '.$i.' days'));
                                        if($find_sunday == 'Sun'){
                                                    $active = ''; $checked = '';$disabled = 'disabled';
                                        }else{
                                                if($i==1){
                                                    $active = 'active'; $checked = 'checked';$disabled = '';
                                                }else{
                                                    $active = ''; $checked = '';$disabled = '';
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

                    <div class="col-md-6 col-xl-4 col-lg-4 col-sm-12 hidden _secondCon">
                        <div class="enter_dtail">
                            <h5>Select Meeting Time* </h5>
                        </div>

                        <div class=" btn-group-toggle ___toggle_date put_schedule clentdr" data-toggle="buttons">
                            <?php $n=0; foreach($schedule_times as $schedule_time){ ?>
                            <?php 
                                   $Date = date('Y-m-d');
                                    $AddDate =date('Y-m-d', strtotime($Date. ' + 1 days'));
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
                                        $disabled = 'disabled';  $n--;
                                    }elseif((isset($date_time_block) && !empty($date_time_block))){
                                        $disabled = 'disabled'; $active = '';
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
                        <div class="col-md-12 text-center">
                            <input type="hidden" name="refrence" value="<?=$this->uri->segment(1)?>">
                            <button type="submit"
                                class="btn payBtn"><?= (isset($userSlotData) && count($userSlotData) >= 2)?'Submit':'Submit' ?>
                            </button>
                        </div>
                    </div>
            </form>
        </div>

    </section>
</div> <!-- main div-->


<script>
function checkLength() {
    if ($('input[name="schedule_time"]:checked').length == 0) {
        alert('Select Schedule time');
        return false;
    }

    if ($('input[name="schedule_date"]:checked').length == 0) {
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

        var lawyer_id = "<?php echo $this->session->userdata('ses_lawyer_id'); ?>";
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
            }
        });
    });


    $("#mobile").keyup(function() {
        var mobile = $("#mobile").val();
        var value = mobile.replace(/[^0-9]/g, "");
        $(this).val(value);
        if (mobile.length < 10) {
            $('.mobile_validation').html(
                '<div class="alert-danger">Enter 10 digit mobile number</div>');
            $(".apply_btn").attr("disabled", "disabled");
        } else {

            var url = "<?php echo base_url('new_user/getMobileNumber'); ?>";
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    mobile: mobile
                },
                success: function(response) {
                    if (response == 1) {
                        alert("You have already registered as a client, So please login");
                        window.location.replace("<?php echo base_url('login')?>");
                    } else if (response == 2) {
                        alert(
                            "You have already registered as a lawyer, So please login"
                        );
                        window.location.replace("<?php echo base_url('login')?>");
                    }
                }
            });

            $('.mobile_validation').html('<div class="alert-success"></div>');
            return (true);
        }
    })

});
</script>

<!-- call new uaser page to show slot end -->

<!-- End  -->

<script>
$(document).ready(function() {



    $("#mobile").keyup(function() {
        var mobile = $("#mobile").val();
        if (mobile.length == 1 && mobile == '0') {
            var value = '';
            $("#mobile").val(value);
        } else if (mobile.length == 2 && mobile == '91') {
            var value = '';
            $("#mobile").val(value);
        } else {
            var value = mobile.replace(/[^0-9]/g, "");
            $(this).val(value);
        }
    })


    // on click NEXT button check validation 


    // show alert
    function _showAlert(msg, className) {
        $("." + className).html(msg);
        _removeAlert(className);
    }

    // for remove alert after 1 sec.
    function _removeAlert(className) {
        setTimeout(function() {
            $("." + className).html('');
        }, 5000);
    }



    $("._clickBack").click(function() {
        $(".firstCon").removeClass("hidden");
        $(".secondCon").addClass("hidden");
        $("._clickBack").addClass("hidden");

    });
    // function to count word
    function WordCount(str) {
        return str.split(" ").length;
    }



});
</script>
<!-- End  -->