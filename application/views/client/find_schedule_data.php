<style>
._border {
    border-radius: 3px;
}
._bg_jhewe1 {
    background: #fff!important;
    border-right: 1px solid #fefefe;
    border-bottom: 1px solid #fefefe;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    font-size: 1.2rem;
    float: left;
    margin-bottom: 15px;
}

.schedule_date {
    outline: 0;
    border: 1px solid #cdcdcd;
    width: 10%;
    padding: 6px;
    background: #ececec;
}




.schedule_time {
   outline: 0;
    border: 1px solid #cdcdcd;
    width: 10%;
    padding: 6px;
    background: #ececec;
}



.rte {
    background: #22dffa;

}

.dob {
    font-size: 1.8rem;
    float: left;
    padding: 12px;
}

._bg_jhe {
    /* background: #47f47c54; */
    /* padding: 6px; */
}



.__btn {
    background: #c4f8ff;
    border: 1px solid #96effc;
    padding: 7px;
    contain: content;
    cursor: pointer;
}

.bijjbn {
    margin: 8px;
    padding: 10px;
    background: #ffffff;
    border: 1px solid #dedede;
    contain: content;
    -webkit-box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgb(0 0 0 / 57%) 0px 3px 7px -3px;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgb(0 0 0 / 57%) 0px 3px 7px -3px;
    cursor: pointer;
    font-size: 1.7rem;
}


.bijjbn:focus {
   border: 1px solid #06d7a0;
   outline: 0;
   background-color: #06d7a0;
   color: #fff;
}

.jkh {
    margin-top: 7px;
    padding: 10px;
    line-height: 3;
}

.dt {
    display: none;
    padding: 10px;
}

.formInnerCon {
    display: none;
}

.__booked {
    background: #22dffa;
    border: 1px solid #22dffa;
    padding: 7px;
    contain: content;
}

.d-flex{
    display: flex!important;
} 
.flex-wrap {
   -ms-flex-wrap: wrap!important;
    flex-wrap: wrap!important;
}
.tablinks:active {
    border: 1px solid #06d7a0!important;
    outline: 0!important;
    background-color: #06d7a0!important;
    color: #fff;
}

.modal__123 {
    padding: 9px!important;
}
.__btn_submit {
    border: #06d7a0;
    background: #06d7a0;
    padding: 1rem 5rem;
}
.noplanner{
    font-size: 18px;
    color: #0e0f74;
}
</style>

</script>
<!--   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />  -->   
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
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
                <div class="container-fluid">
                    <div class="_bg_jhewe11">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row date_time_hide">
                                    <div class="col-md-12 _bg_jhewe1">
                                        <div class="dob text-center">Select Date&nbsp;&nbsp;&nbsp;<i class="bi bi-calendar-check-fill"></i></div>
                                    </div>
                                </div>

                                    <div class=" d-flex  bd-highlight mb-3">
                                      <div class="bd-highlight date_time_hide d-flex flex-wrap">
                                       <?php if(!empty($schedule_data)){ foreach($schedule_data as $sch_data){?>
                                                <div class=" _bg_jhe sfsdf ">
                                                    <div class=" ">
                                                        <input type="text" class="bijjbn"
                                                            value="<?=$tempDate = $sch_data->schedule_date;?>">
                                                    </div>
                                                </div>
                                                <?php  }}else{
                                            echo "<p class='noplanner'>No planner Available of this lawyer</p>";
                                            }?>
                                      </div>

                                    </div>
                                <div class="row date_time_hide _insaaf_date213">
                                    <div class="col-md-12">
                                        <?php if(!empty($schedule_data)){ foreach($schedule_data as $sch_data){?>
                                        <div class="row  " style="padding-bottom: 6px;">
                                            <div class="col-md-10 _bg_jhe hideTime <?=$sch_data->schedule_date;?>"
                                                Dadte="<?=$sch_data->schedule_date;?>" style="display:none;">
                                                <div class="jkh tabcontent">
                                                    <?php $time=json_decode($sch_data->schedule_time);
                                                        ?>
                                                    <?php foreach($time as $key => $s_time){?>
                                                    <?php if(isset($slot_data) && isset($slot_data[$tempDate]) && isset($slot_data[$tempDate][$s_time])  ){?>

                                                    <span class="__booked">
                                                        <?php echo $s_time ;?>
                                                        Booked
                                                    </span>
                                                    <?php }else{?>
                                                    <span class="__btn  tablinks " Sdate="<?php echo $sch_data->schedule_date;?>"
                                                        Stime="<?php echo $s_time;?>">
                                                        <?php echo $s_time;?>
                                                    </span>
                                                    <?php }?>

                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }}?>
                                    </div>
                                </div>
                                <form class="needs-validation"
                                    action="<?=base_url()?>client/Dashboard/Select_lawyer/" method="post">
                                    <div class="dt">
                                        <label for="">Date <span>*</span></label><br>
                                        <input type="text" class="schedule_date " id="shadule_date" name="schedule_date"
                                            value="" readonly><br>
                                        <label for="">Time <span>*</span></label><br>
                                        <input type="text" class="schedule_time" id="schedule_time" name="schedule_time"
                                            value="" readonly>
                                    </div>
                                    <input type="hidden" class=" " id="lawyer_id" name="lawyer_id"
                                        value="<?php echo  $lawyerId?>">
                                    <input type="hidden" class="" id="client_id" name="client_id"
                                        value="<?php echo $user_ID?>">
                                    <input type="hidden" class=" " id="query_id" name="query_id"
                                        value="<?php echo  $queryId?>">
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
                                    <div class="modal-footer date_time_hide modal__123 " style="float: left;">
                                        <button type="submit" id="submitID" class="btn __btn_submit ">
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
        var DT = date;
        $(".schedule_date").val(date);
        var Dadte = $('.' + DT).attr("Dadte");


        if (date == Dadte) {
            $('.hideTime').hide();
            $('.' + Dadte).show();
        }

        // if(date==)
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
$(function() {
    $("#schedule_date").datepicker();
});
</script>
<!-- //     $("#submitID").click(function() {
//         document.getElementById("submitID").disabled = true;
//   setTimeout(()=>{
//     document.getElementById("submitID").disabled = false;
//   }, 8000)
    
//     }) -->