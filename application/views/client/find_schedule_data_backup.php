<style>
._border {
    border-radius: 3px;
}

._bg_jhewe1 {
    background: #22dffa;
}

.jhghj {
    border-right: 1px solid #fefefe;
    border-bottom: 1px solid #fefefe;
}

.rte {
    background: #22dffa;

}

.dob {
    font-size: 25px;
}

._bg_jhe {
    /* background: #47f47c54; */
    /* padding: 6px; */
}

.sfsdf {
    border-right: 1px solid #fefefe;
}



.__btn {
    background: #9ef3ff;
    border: 1px solid #22dffa;
    padding: 7px;
    contain: content;
    cursor: pointer;
}

.bijjbn {
    padding: 5px;
    background: #9effd0;
    border: 1px solid #22dffa;
    contain: content;
    cursor: pointer;
}

.jkh {
    margin-top: 7px;
}

.dt {
    display: none;
}

.formInnerCon {
    display: none;
}
.__booked{
    background: #22dffa;
    border: 1px solid #22dffa;
    padding: 7px;
    contain: content;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
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
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                    </div>
                    <div class="container">
                        <div class="_bg_jhewe11">
                            <div class="row">
                                <div class="col-md-12">

                                <!-- <div class="row">
                                    <div class="col-md-3">
                                    <label for="text" class="_size24"> Selected Date <span class="text-muted">*</span></label>
                                    <input type="text" class="form-control new_control scheduleDT" name="schedule_date" id="schedule_date" style="border-radius: 7px!important;">
                                    </div>
                                </div> -->
                                    <div class="row date_time_hide">
                                        <div class="col-md-2 _bg_jhewe1 jhghj">
                                            <div class="dob text-center"> Available Dates</div>
                                        </div>
                                        <div class="col-md-10 _bg_jhewe1 jhghj">
                                            <div class="dob text-center">Available Times</div>
                                        </div>
                                    </div>
                                    <div class="row date_time_hide">
                                        <div class="col-md-12">
                                            <?php if(!empty($schedule_data)){$i=-1; foreach($schedule_data as $sch_data){$i++;?>
                                    
                                            <div class="row" style="padding-bottom: 6px;">
                                                <div class="col-md-2 _bg_jhe sfsdf date_val">
                                                    <div class="text-center ___padd">
                                                        <input type="text" class="bijjbn"
                                                            value="<?= $tempDate =  $sch_data->schedule_date;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-10 _bg_jhe">
                                                    <div class="jkh">
                                                        <?php $time=json_decode($sch_data->schedule_time);
                                                            
                                                        ?>

                                                        <?php foreach($time as $key => $s_time){?>

                                                            <?php if(isset($slot_data) && isset($slot_data[$tempDate]) && isset($slot_data[$tempDate][$s_time])  ){?>
                                                            <?php  ?>
                                                        <span class="__booked">
                                                            <?php echo $s_time ;?>
                                                           Booked
                                                        </span>
                                                        <?php }else{?>
                                                        <span class="__btn" Sdate="<?php echo $tempDate;?>" Stime="<?php echo $s_time;?>">
                                                           <?php echo $s_time;?>
                                                        </span>
                                                        <?php }?>
                                                       
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php  }}?>
                                        </div>
                                    </div>
                                    <form class="needs-validation"
                                        action="<?=base_url()?>client/Dashboard/Select_lawyer/" method="post">
                                        <div class="dt">
                                            <label for="">Date <span>*</span></label><br>
                                            <input type="text" class="schedule_date" id="shadule_date" name="schedule_date" value=""><br>
                                            <label for="">Time <span>*</span></label><br>
                                            <input type="text" class="schedule_time" id="schedule_time" name="schedule_time" value="">
                                        </div>
                                        <input type="hidden" class=" " id="lawyer_id" name="lawyer_id" value="<?php echo  $lawyerId?>">
                                        <input type="hidden" class="" id="client_id" name="client_id" value="<?php echo $user_ID?>">
                                        <input type="hidden" class=" " id="query_id" name="query_id" value="<?php echo  $queryId?>">
                                        <div class="formInnerCon container hidden" id="loaderAreaCon">
                                            <div class="row">
                                                <div class="col-sm-12 text-center py-3">
                                                    <img src="<?php echo base_url('assets/images/loader.gif') ?>" alt=""
                                                        width="20%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="formInnerCon" id="loaderAreaCon">
                                            <div class="row">
                                                <div class="col-md-12 text-center py-3">
                                                    <img src="<?php echo base_url('assets/images/loader.gif') ?>" alt=""
                                                        width="20%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer date_time_hide" style="float: left;">
                                            <button type="submit" id="submitID" class="btn btn-primary"
                                                style="background-color:#04367d;color:white;">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(document).ready(function() {
    $(".bijjbn").click(function() {
        $(".dt").show();
        var date = $(this).val();
        $(".schedule_date").val(date);
    })
    $(".__btn").click(function() {
        $(".dt").show();
        var time = $(this).attr("Stime");
        var Sdate = $(this).attr("Sdate");
        $(".schedule_time").val(time);
        $(".schedule_date").val(Sdate);

    })
    $("#submitID").click(function() {
        $(".formInnerCon").show();
        $(".date_time_hide").hide();



    })

});
</script>
<script>
$(document).ready(function() {
    $(".scheduleDT").click(function() {
        var date = $(this).val();
        // alert(date);
    })

});
</script>
<script>
  $( function() {
    $( "#schedule_date" ).datepicker();
  } );
  </script>
<!-- //     $("#submitID").click(function() {
//         document.getElementById("submitID").disabled = true;
//   setTimeout(()=>{
//     document.getElementById("submitID").disabled = false;
//   }, 8000)
    
//     }) -->