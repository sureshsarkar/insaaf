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
        	 <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <form action="<?php echo base_url('client/meeting/save_reschedule/'.base64_encode($slotid)); ?>" method="post" onSubmit="return checkLength()">
                    <div class="for_enter_date">
                        <p><i class="fa fa-calendar-check-o" aria-hidden="true"></i><b>SELECT APPOINTMENT DATE</b></p>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <?php 
                        $Date = date("Y-m-d");
                        for ($i=1; $i <= 30 ; $i++) { 
                            $check_sess = date('d M Y', strtotime($Date. ' + '.$i.' days'));
                            if($i==1){
                                $active = 'active'; $checked = 'checked';
                            }else{
                                $active = ''; $checked = '';
                            }
                        ?>
                          <label class="btn btn-outline-primary des_btn_colr_fjjjg slot_date_div <?php echo $active;?>" data-id="<?php echo $i; ?>">
                            <input type="radio" name="schedule_date" class="slot_date_input_<?php echo $i; ?>" data-day="<?php echo date('D', strtotime($Date. ' + '.$i.' days')); ?>" value="<?php echo date('d M Y', strtotime($Date. ' + '.$i.' days')); ?>" <?php echo $checked; ?> > <?php echo date('M d , D ', strtotime($Date. ' + '.$i.' days')); ?>
                          </label>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="for_enter_date">
                        <p><i class="fa fa-clock-o" aria-hidden="true"></i><b>AVAILABLE SLOT</b></p>
                    </div>
                    <div class="">
                        <div class="d-flex flex-row">
                            <div class="btn-group btn-group-toggle put_schedule" data-toggle="buttons">
                                <?php $n=1; foreach($schedule_times as $schedule_time){ ?>
                                <?php 
                                    $booked = check_slot($this->session->userdata('ses_lawyer_id'), date('Y-m-d', strtotime($Date. ' + 1 days')), $schedule_time); 
                                    if ($booked == 1) {
                                        $disabled = 'disabled'; $n--;
                                    }else{
                                        $disabled = '';
                                    }
                                    if ($n==1 && $booked !=1) {
                                        $active = 'active'; $checked = 'checked';
                                    }else{
                                        $active = ''; $checked = '';
                                    }
                                    ?>
                                <label class="btn btn-outline-primary des_btn_colr_fjjjg <?php echo $active. ' ' .$disabled; ?>">
                                   <input type="radio" name="schedule_time" value="<?php echo $schedule_time; ?>" <?php echo $checked; ?>> <?php echo $schedule_time; ?>
                                </label>
                                <?php $n++; } ?>
                            </div>
                        </div>
                    </div>
                    <div class="__flx_button_prv_nxt" style="width:90%">
                            <div class="__bck_butn">
                                <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>" class="button_news"> < Back</a>
                            </div>
                            <div class="__nxt_btn_">
                                <!-- <?php if(!empty($schedule_times)){ ?> -->
                                <button type="submit" class="for_nextdjijdfjfhne_cld_df">Submit, Re-schedule Request <i class="bi bi-arrow-right"></i></button>
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
    function checkLength(){
        if ($('input[name="schedule_time"]:checked').length == 0) {
             alert('Schedule time not available');
             return false; 
         }
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".slot_date_div").click(function(){

          var slot_data_id = $(this).attr('data-id');
          var schedule_day = $('.slot_date_input_'+slot_data_id).attr('data-day');
          var schedule_date = $('.slot_date_input_'+slot_data_id).val();
          // alert(schedule_day); exit();
         
          var lawyer_id = "<?php echo $lawyer_id; ?>";
          var url = "<?php echo base_url('client/create_case/get_time'); ?>";
        $.ajax({  
            type: 'POST',
            url: url, 
            data: { schedule_day: schedule_day, lawyer_id: lawyer_id , schedule_date: schedule_date },
            success: function(response) {
                $(".put_schedule").html(response);
                // alert(response);
            }
        });
      });
    });
   
</script>

