<div class="content-wrapper">
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

        </div>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form
                            action="<?php echo base_url('client/create_case/ajax4/'.base64_encode($this->session->userdata('ses_lawyer_id'))); ?>"
                            method="post" onSubmit="return checkLength()">

                            <div class="left___col ___date___top___nsp">
                                <span><i class="fa fa-calendar-check-o" aria-hidden="true"></i> SELECT APPOINTMENT
                                    DATE</span>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="btn-group btn-group-toggle ___toggle_date" data-toggle="buttons">
                                    <?php 
                                    $defaultSelect = "false";
                                $Date =date("Y-m-d");
                                for ($i=1; $i <= 30 ; $i++) { 
                                    $check_sess = date('d M Y', strtotime($Date. ' + '.$i.' days'));
                                $find_sunday = date('D', strtotime($Date. ' + '.$i.' days'));
                                if($find_sunday != 'Sun' && $defaultSelect =="false"){
                                        $defaultSelect = "true";
                                        $active = 'active'; $checked = 'checked';
                                }else{
                                    $active = ''; $checked = '';
                                }
                                
                            ?>
                                    <label
                                        class="btn btn-outline-primary des_btn_colr_fjjjg slot_date_div <?php echo $active;?>"
                                        data-id="<?php echo $i; ?>"
                                        <?php if(date('D', strtotime($Date. ' + '.$i.' days')) =="Sun") echo 'disabled';?>>
                                        <input type="radio" name="schedule_date"
                                            class="slot_date_input_<?php echo $i; ?>"
                                            data-day="<?php echo date('D', strtotime($Date. ' + '.$i.' days')); ?>"
                                            value="<?php echo date('d M Y', strtotime($Date. ' + '.$i.' days')); ?>"
                                            <?php echo $checked;  ?>>
                                        <?php  echo date('M d , D ', strtotime($Date. ' + '.$i.' days'));?>
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>


                            <div class="___topselectCall">
                                <div class="left___col ___date___top___nsp">
                                    <span><i class="fa fa-clock-o" aria-hidden="true"></i> AVAILABLE SLOT</span>
                                </div>
                            </div>

                            <div class="">
                                <div class="d-flex flex-row">
                                    <div class="btn-group btn-group-toggle ___toggle_date put_schedule"
                                        data-toggle="buttons">
                                        <?php $n=1; foreach($schedule_times as $schedule_time){ ?>
                                        <?php 
                                    //$booked = check_slot($this->session->userdata('ses_lawyer_id'), date('Y-m-d', strtotime($Date. ' + 1 days')), $schedule_time); 
                              
                                        $AddDate =date('Y-m-d', strtotime(date("Y-m-d"). ' + 1 days'));
                                        $addTime = date("H:i:s", strtotime($schedule_time));
                                        $AddDate =date("Y-m-d H:i:s", strtotime("$AddDate $addTime"));
                                        $booked = check_slot_booked($AddDate); //check time booked or not function
                                  
                                       // call function fetche date & time from scheduler table to block date time || check_date_time_block()
                                        $dateBlock = date("Y-m-d", strtotime("$AddDate"));
                                        $timeBlock = date("h:i A", strtotime("$schedule_time"));
                                        $date_time_block = check_date_time_block($dateBlock,$timeBlock);
                                        

                                        if ($n==1 && $booked !=1) {
                                            $active = 'active'; $checked = 'checked';
                                        }else{
                                            $active = ''; $checked = '';
                                        }
                                        
                                        if ($booked == 1) {
                                            $disabled = 'disabled'; $n--;
                                        }elseif((isset($date_time_block) && !empty($date_time_block))){
                                            $disabled = 'disabled'; $active = '';
                                        }
                                        else{
                                            $disabled = '';
                                        }
                                    ?>
                                        <label
                                            class="btn btn-outline-primary des_btn_colr_fjjjg <?php echo $active. ' ' .$disabled; ?>">
                                            <input type="radio" name="schedule_time"
                                                value="<?php echo $schedule_time; ?>" <?php echo $checked; ?>>
                                            <?php echo $schedule_time; ?>
                                        </label>
                                        <?php $n++; } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="__flx_button_prv_nxt" style="width:100%">
                                <div class="__bck_butn">
                                    <a href="<?php echo base_url('client/create_case')?>"
                                        class="button_news btn">Back</a>
                                </div>
                                <div class="__nxt_btn_">
                                    <!-- <?php if(!empty($schedule_times)){ ?> -->
                                    <button type="submit" class="for_nextdjijdf">Next</button>
                                    <!-- <?php } ?> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>

</div>
<script>
function checkLength() {
    if ($('input[name="schedule_date"]:checked').length == 0) {
        //alert('Schedule time not available');
        alert('Select Schedule Date');
        return false;
    }
    if ($('input[name="schedule_time"]:checked').length == 0) {
        //alert('Schedule time not available');
        alert('Select Schedule time');
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

        var lawyer_id = "<?php echo $this->session->userdata('ses_lawyer_id'); ?>";
        var url = "<?php echo base_url('client/create_case/get_time'); ?>";
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
});
</script>


<style>
.for_nextdjijdf {
    margin-top: 4px;
    background: #1a243f;
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 4px;
    font-size: 1.5rem;
    padding: 0.5rem 3rem;
}

.for_nextdjijdf:hover {
    background: #ff9100;
    transition: 0.2s ease-in-out;
}

.button_news:hover {
    background: #1a243f;
    transition: 0.2s ease-in-out;
}



.___toggle_date label {
    border-radius: 0;
    margin-left: 1rem;

}

.disabled {
    background: red;
}
</style>