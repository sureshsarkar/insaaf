<style>
.lawyerListData {
    height: 272px;
    overflow-y: scroll;
    width: 500px;
}

.for_client__ {
    max-width: 505px;
}

.radioInput {
    padding: 8px;
}

.bg-light {
    background: #3333;
    color: #333;
}

._active {
    background: #009688;
    color: wheat;
}

.px-2 {
    padding: 10px 10px;
}

.box-cart {
    padding-bottom: 9px;
    border: 2px solid #009688;
    margin-bottom: 20px;
}

.box-cart .box-head {
    background: #009688;
    padding: 11px;
    margin-bottom: 10px;
    color: wheat;
}

.for_imffhd {
    border-bottom: 2px solid #dfdfdf;
    margin-bottom: 15px;
}

.__flx_button_prv_nxt {
    display: flex;
    justify-content: space-between;
    margin-top: 40px;
}

.button_news {
    background: #ff9100;
    padding: 6px 20px;
    margin-bottom: 7px;
    color: white;
    border: none;
    border-radius: 11px;
    margin-top: 4px;
}

.for_nextdjijdf {
    margin-top: 4px;
    background: #1a243f;
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 11px;
}

.button_news:hover {
    background: #1a243f;
    transition: 0.2s ease-in-out;
}

.for_nextdjijdf:hover {
    background: #ff9100;
    transition: 0.2s ease-in-out;
}

.for_chchek_colr {
    color: green;
}

.__bck_butn {
    float: left;
}

.__nxt_btn_ {
    float: right;
}
</style>

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
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <h3><a href="<?= base_url('admin/case_details') ?>"><i class="bi bi-arrow-left"></i></a> Case
                        Details</h3>
                </div>
                <div class="col-md-6 m-auto">
                    <div class="for_client__">
                        <form action="<?php echo base_url('client/slot_booking_pay/Pay_for_slot'); ?>" method="post">
                            <div class="for_imffhd">
                                <h4 class="text-uppercase"><b>Case Details</b></h4>
                            </div>

                            <div class="table-responsiv1e">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Case ID </th>
                                        <td>: <?php echo $case_data->id; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Case </th>
                                        <td>: <?php echo $case_cat_data->name; ?></td>
                                    </tr>
                                    <?php if(!empty($lawyer_data)){?>
                                    <tr>
                                        <th>Lawyer </th>
                                        <td>: <?php echo $lawyer_data->fname." ".$lawyer_data->lname; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th>Case Status </th>
                                        <td>:
                                            <?php echo ($case_data->status==1)?'<strong>Active</strong>':'<strong>Inactive</strong>'; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Payment Status </th>
                                        <td>: <span
                                                class="badge"><?php echo (isset($case_data->payment_status) && $case_data->payment_status == 1)?"Success":'Pending'; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date </th>
                                        <td>: <?php echo date("M d, Y", strtotime($case_data->dt)); ?></td>
                                    </tr>
                                    <tr>
                                        <th>About Case </th>
                                        <td>: <?php echo $case_data->case_description; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Attached File </th>
                                        <td>:
                                            <?php echo !empty($case_data->case_file)?'<a href="'.base_url("uploads/cases/".$case_data->case_file).'" target="_blank">View &nbsp; <i class="bi bi-box-arrow-up-right"></i> </a>':'N/A' ?>
                                        </td>
                                    </tr>
                                    <!-- case details-->
                                    <?php if(!empty($slot_data)){ ?>
                                    <tr>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="bg-primary">Slot Details</td>
                                    </tr>
                                    <tr>
                                        <th>Slot ID </th>
                                        <td>: <?php echo $slot_data->id; ?></td>
                                    </tr>
                                    <?php if(isset($slot_data->camp_data)){
                                        
                                        $campData = json_decode($slot_data->camp_data);
                                        ?>
                                    <tr>
                                        <th>State </th>
                                        <td>: <?php echo (isset($campData->state))?$campData->state:""; ?></td>
                                    </tr>
                                    <tr>
                                        <th>City </th>
                                        <td>: <?php echo (isset($campData->city))?$campData->city:""; ?></td>
                                    </tr>
                                    <?php }?>
                                    <tr>
                                        <th>Meeting Time </th>
                                        <td>:
                                            <b><?php echo date("d/M/Y | h:i A", strtotime($slot_data->meeting_time)); ?></b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Slot Status </th>
                                        <td>: <span
                                                class="badge"><?php echo (isset($slot_data->slot_status) && $slot_data->slot_status == 1)?"Active":'Pending'; ?></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Meeting Status </th>
                                        <td>: <span
                                                class="badge"><?php echo (isset($slot_data->MeetingStatus) && $slot_data->MeetingStatus == 0)?"Pending":'Done'; ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Refrence page </th>
                                        <td>:
                                            <b>
                                                <?php
                                                 $g = $this->config->item('pageRefrence');
                                                 echo isset($g[$slot_data->pageRefrence])?$g[$slot_data->pageRefrence]:$g[$slot_data->pageRefrence] ;
                                                 ?>
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Came From </th>
                                        <td>:
                                            <b>
                                                <?php
                                                $c = $this->config->item('came_from');
                                                 echo isset($c[$slot_data->came_from])?$c[$slot_data->came_from]:$c[$slot_data->came_from];
                                                 ?>
                                            </b>
                                        </td>
                                    </tr>

                                    <!-- Meeting Feedback-->
                                    <?php if($slot_data->MeetingStatus != 0){ ?>
                                    <tr>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="bg-primary">FeedBack & Meeting Details</td>
                                    </tr>
                                    <tr>
                                        <th>Meeting Duration </th>
                                        <td>:
                                            <?php echo  ($slot_data->total_done_meet_time > 10)?number_format((float)$slot_data->total_done_meet_time/(60), 2, ':', '')." Minutes":''  ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Client FeedBack </th>
                                        <td>: <?php echo $slot_data->clientFeedback; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Lawyer FeedBack </th>
                                        <td>: <?php echo $slot_data->lawyerFeedback; ?></td>
                                    </tr>

                                    <?php } ?>

                                    <?php } ?>

                                    <!-- Client details-->
                                    <?php if(!empty($client)){ ?>
                                    <tr>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="bg-primary">Client Details</td>
                                    </tr>

                                    <tr>
                                        <th>Client ID </th>
                                        <td>: <?php echo $client->client_unique_id ?></td>
                                    </tr>
                                    <tr>
                                        <th>Client Name </th>
                                        <td>: <?php echo $client->fname." ".$client->lname; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Phone </th>
                                        <td>: <?php echo $client->mobile ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email </th>
                                        <td>: <?php echo $client->email ?></td>
                                    </tr>
                                    <tr>
                                        <th>State </th>
                                        <td>: <?php echo $client->state ?></td>
                                    </tr>
                                    <tr>
                                        <th>City </th>
                                        <td>: <?php echo $client->city ?></td>
                                    </tr>
                                    <?php } ?>
                                    <!-- Change Date & Time start-->
                                    <tr>
                                        <td colspan="2">
                                            <div class="box-cart mt-2">
                                                <div class="box-head"><i class="bi bi-calendar2-date"></i> Change Date &
                                                    Time
                                                </div>
                                                <form>
                                                    <div class="box-body row px-2">
                                                        <div class="col-md-6">
                                                            <label for="text">Date</label><br>
                                                            <input type="date" name="date"
                                                                class="form-control updateDate">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="text">Time</label><br>
                                                            <input type="time" name="time"
                                                                class="form-control updateTime">
                                                        </div>
                                                        <div class="col-md-6 mt-3">
                                                            <button type="button"
                                                                class="btn btn-primary changeDateTime">Update</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Change Date & Time end-->


                                    <tr>
                                        <td colspan="2">
                                            <div class="box-cart mt-2">
                                                <div class="box-head"><i class="bi bi-person"></i>Admin FeedBack
                                                </div>
                                                <div class="box-body px-2">
                                                    <input type="text" value="<?php echo $slot_data->adminFeedback; ?>"
                                                        class="form-control adminFeedback" name="adminFeedback"
                                                        placeholder="Enter Meeting Feedback">

                                                    <button class="btn btn-primary mt-2 addFeedback">Add
                                                        FeedBack</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6 m-auto">
                    <div class="for_client__">
                        <div class="for_imffhd">
                            <h4 class="text-uppercase">
                                <b>Assign Lawyer</b>
                                <?php if(empty($lawyer_data)){?>
                                <input type="text" class="SearchLawyer" name="searchlawyer" value="">
                                <?php }?>
                            </h4>
                        </div>

                        <div class="table-responsive">
                            <?php if(!empty($lawyer_data)){?>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Lawyer ID : </th>
                                    <td><?php echo $lawyer_data->lawyer_unique_id; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer : </th>
                                    <td><?php echo $lawyer_data->fname." ".$lawyer_data->lname; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer Experience : </th>
                                    <td><?php echo $lawyer_data->experience; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer Email : </th>
                                    <td><?php echo $lawyer_data->email; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer Mobile : </th>
                                    <td><?php echo $lawyer_data->mobile; ?></td>
                                </tr>
                                <tr>
                                    <th>Bar Councle : </th>
                                    <td><?php echo $lawyer_data->bar_councle; ?></td>
                                </tr>
                                <tr>
                                    <th>Practice Area : </th>
                                    <td><?php echo $lawyer_data->practice_area; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer State : </th>
                                    <td><?php echo $lawyer_data->state; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer City : </th>
                                    <td><?php echo $lawyer_data->city; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer Known Language : </th>
                                    <td><?php echo $lawyer_data->language; ?></td>
                                </tr>
                                <tr>
                                    <th>Case Status : </th>
                                    <td><?php echo ($case_data->status==1)?'<strong>Active</strong>':'<strong>Inactive</strong>'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date : </th>
                                    <td><?php echo date("M d, Y", strtotime($case_data->dt)); ?></td>
                                </tr>
                            </table>

                            <!-- Re Schedule -->
                            <div class="box-cart">
                                <div class="box-head"><i class="bi bi-calendar2-date"></i>
                                    <?= ($slot_data->slot_status == 9)?"<span class='blink_now'>Client Re-Schedule Requested</span>":'Re-Schedule' ?>
                                </div>
                                <div class="box-body px-2">
                                    <!-- date section-->

                                    <select class="form-control" id="MeetingDate">
                                        <?php 
                                            $Date = date("Y-m-d");
                                            $startDate = date('d M Y', strtotime($Date. ' + '.$i.' days'));
                                            $diff = dateDiffMin($slot_data->meeting_time,$startDate);
                                            
                                            for ($i=0; $i <= 30 ; $i++) { 
                                                $check_sess = date('d M Y', strtotime($Date. ' + '.$i.' days'));
                                                if($diff > 0 &&  date('y-m-d', strtotime($slot_data->meeting_time )) == date('y-m-d', strtotime($check_sess)) ){
                                                    $active = '_active'; 
                                                    $checked = ' selected ';
                                                }else{
                                                    $active = ''; $checked = '';
                                                }
                                            ?>
                                        <option value="<?php echo date('d M Y', strtotime($Date. ' + '.$i.' days')); ?>"
                                            data-day="<?php echo date('D', strtotime($Date. ' + '.$i.' days')); ?>"
                                            <?= $checked ?>>
                                            <?php echo date('F d , D ', strtotime($Date. ' + '.$i.' days')) ; ?>
                                        </option>
                                        <?php } ?>
                                    </select>

                                    <!-- time section Start -->
                                    <br />
                                    <div class="">
                                        <?php 
                                            $schedule_times = getStaticTime();
                                            $n=1; foreach($schedule_times as $schedule_time){ ?>
                                        <?php 
                                                $clientTime = date('h:i A', strtotime($slot_data->meeting_time));
                                                $booked = check_slot('', date('Y-m-d', strtotime($Date. ' + 1 days')), $schedule_time); 
                                               
                                                if (trim($schedule_time) == trim($clientTime) && $diff > 0) {
                                                    $active = '_active'; $checked = 'checked';
                                                }else{
                                                    $active = ''; $checked = '';
                                                }
                                                ?>
                                        <label class="badge bg-light radioInput <?php echo $active ?>">
                                            <input type="radio" class="hidden" name="schedule_time"
                                                value="<?php echo $schedule_time; ?>" <?php echo $checked; ?>>
                                            <?php echo $schedule_time; ?>
                                        </label>
                                        <?php $n++; } ?>
                                    </div>
                                    <button class="btn btn-info btn-sm"
                                        id="updateBtn"><?= ($slot_data->slot_status == 9)?"Approve":'Update'?></button>
                                    <!-- end time section-->

                                </div>
                            </div>

                            <!-- Re assign Lawyer -->
                            <div class="box-cart">
                                <div class="box-head"><i class="bi bi-person"></i> Re-Assign Lawyer </div>
                                <div class="box-body px-2">
                                    <select class="form-control" id="reAssignLawyer">
                                        <option value="">Re-Assign Lawyer</option>
                                        <?php foreach($allLawyers as $k=> $v){
                                                if($lawyer_data->id != $v->id){
                                            ?>
                                        <option value="<?= $v->id ?>">
                                            <?= $v->fname." ".$v->lname."/".$v->mobile."/".$v->state."/".$v->city?>
                                        </option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>

                            <?php }else{ ?>
                            <div class="lawyerListData">
                                <?php 
                                 if(!empty($allLawyers)){
                                 foreach($allLawyers as $k=> $v){?>

                                <label><input type="radio" name="lawyerId" class="checkBox" value="<?= $v->id ?>">
                                    &nbsp;
                                    <?= ucwords($v->fname." ".$v->lname)."/".$v->mobile."/".$v->state."/".$v->city ?>
                                </label><br />
                                <?php }}else{
                                        echo "<p class='text-danger' >No have any lawyer in this category!!</p>";
                                    } ?>
                            </div>
                            <button type="button" class="btn btn-primary btnSubmit">Submit</button>
                            <?php } ?>

                        </div>
                    </div>
                    <!-- =================== -->
                    <?php 
                $teamsLink ='';
                $teamsLink = json_decode($slot_data->teamsdata,true);
                if(isset($slot_data->teamsdata)){
                ?>

                    <div class="box-cart mt-2">
                        <div class="box-head"><i class="bi bi-person"></i>Teams Link</div>
                        <form id="submitLink">
                            <div class="box-body row px-2">
                                <div class="col-md-11">
                                    <label for="text">Add Meeting Link</label><br>
                                    <input type="text" class="form-control meetinglink"
                                        value="<?php echo (isset($teamsLink['meetinglink']))? $teamsLink['meetinglink']:'';?>"
                                        name="meetinglink">
                                </div>
                                <div class="col-md-8 hidden">
                                    <label for="text">Meeting ID</label><br>
                                    <input type="text" class="form-control meeting_id"
                                        value="<?php echo (isset($teamsLink['meeting_id']))? $teamsLink['meeting_id']:'';?>"
                                        name="meeting_id">
                                </div>
                                <div class="col-md-8 hidden">
                                    <label for="text">Password</label><br>
                                    <input type="text" class="form-control password"
                                        value="<?php echo (isset($teamsLink['password']))? $teamsLink['password']:'';?>"
                                        name="">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ml-2">Insert</button>
                        </form>
                    </div>
                    <?php }?>
                    <!-- Update when meeting success-->
                    <tr>
                        <td colspan="2">
                            <div class="box-cart mt-2">
                                <div class="box-head"><i class="bi bi-person"></i> Update When Meeting
                                    Success</div>
                                <form>
                                    <div class="box-body row px-2">
                                        <div class="col-md-8">
                                            <label for="text">Update Meeting</label><br>
                                            <button type="button"
                                                class="btn btn-primary ml-2 update_meeting">Update</button>
                                        </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <!-- Update when meeting success-->
                </div>
                <!-- Cancel meeting-->
                <tr>
                    <td colspan="2">
                        <div class="box-cart mt-2">
                            <div class="box-head"><i class="bi bi-person"></i> Cancel Meeting </div>
                            <form>
                                <div class="box-body row px-2">
                                    <div class="col-md-11">
                                        <label for="text">Add Cancel Reason</label><br>
                                        <input type="text" class="form-control cancel_reason"
                                            value="<?= $slot_data->cancel_reason?>" name="cancel_reason">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary ml-2 cancel_meeting">Cancel</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <!-- Cancel meeting end-->
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function() {

    // Add Feedback
    $(".addFeedback").click(function(e) {
        e.preventDefault();
        var case_id = "<?= $case_data->id?>";
        var feedback = $(".adminFeedback").val();
        if (feedback == '') {
            alert("Please Enter feedback");
            return false;
        }
        // alert(feedback);
        // return false;
        var url = "<?php echo base_url('admin/Case_details/addfeedback')?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                case_id: case_id,
                feedback: feedback
            },
            success: function(responce) {
                if (responce == 1) {
                    alert("Feedback Added successfully");
                    location.reload();
                    return false;
                }
            }
        });

        return false;
    });

    // change Date & Time
    $(".changeDateTime").click(function(e) {
        e.preventDefault();
        var case_id = "<?= $case_data->id?>";
        var date = $(".updateDate").val();
        var time = $(".updateTime").val();
        if (date == '' || time == '') {
            alert("Please select Date and Time");
            return false;
        }
        var url = "<?php echo base_url('admin/Case_details/update_date_time')?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                case_id: case_id,
                date: date,
                time: time
            },
            success: function(responce) {
                if (responce == 1) {
                    alert("Date & Time Changed successfully");
                    location.reload();
                    return false;
                }
            }
        });

        return false;
    });


    // update_meeting
    $(".update_meeting").click(function() {
        var case_id = "<?= $case_data->id?>";
        var url = "<?php echo base_url('admin/Case_details/update_meeting')?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                case_id: case_id
            },
            success: function(responce) {
                if (responce == 1) {
                    alert("Meeting Status Updated successfully");
                    location.reload();
                    return false;
                }
            }
        });
        return false;
    });

    // Cancel meeting reason
    $(".cancel_meeting").click(function() {
        var case_id = "<?= $case_data->id?>";
        var cancelmeet = $(".cancel_reason").val();
        var url = "<?php echo base_url('admin/Case_details/cancel_meeting')?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                cancelmeet: cancelmeet,
                case_id: case_id
            },
            success: function(responce) {
                if (responce == 1) {
                    alert("Meeting Canceled successfully");
                    location.reload();
                    return false;
                }
            }
        });
        return false;
    });


    // submit Teams meeting Link
    $('#submitLink').submit(function(e) {
        e.preventDefault();
        var case_id = "<?= $case_data->id?>";
        var meetinglink = $(".meetinglink").val();
        var meeting_id = $(".meeting_id").val();
        var password = $(".password").val();

        var url = "<?php echo base_url('admin/Case_details/teamsLink')?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {
                meetinglink: meetinglink,
                meeting_id: meeting_id,
                password: password,
                case_id: case_id
            },
            success: function(responce) {
                if (responce == 1) {
                    alert("Link Inserted successfully");
                    return false;
                }
            }
        });
        return false;
    })
})
</script>


<script type="text/javascript">
$(document).ready(function() {
    $(".btnSubmit").click(function() {
        $(".btnSubmit").addClass("hidden");
        var checkd = 0;

        $(".checkBox").each(function() {
            if ($(this).is(':checked')) {
                checkd = $(this).val();
            }
        });
        if (checkd != 0) {
            _fnSubmitAjax(checkd);
        } else {
            alert("First select lawyer then click submit");
        }
    });


    // re assign lawyer
    $("#reAssignLawyer").change(function() {
        var val = $(this).val();

        var assignLawyer = "<?= isset($lawyer_data->id)?$lawyer_data->id:'' ?>";
        if (val == '') {

        } else if (parseInt(val) == parseInt(assignLawyer)) {
            alert("Already assign lawyer !!");
        } else {
            var confirmation = confirm("Are you sure to assign other lawyer ?");
            if (confirmation) {
                _fnSubmitAjax(val);
            }

        }
    });


    // when Date change
    $("#MeetingDate").change(function() {

        var selectedData =
            "<?= empty($slot_data)?'':date('d M Y', strtotime($slot_data->meeting_time));?>";
        var selectedTime =
            "<?= empty($slot_data)?'':date('h:i A', strtotime($slot_data->meeting_time));?>";
        var val = $(this).val();
        var day = $('option:selected', this).attr('data-day');
        $('.radioInput').removeClass("_active");
        $('.radioInput input').prop("checked", false);
        if (selectedData == val) {
            $(".radioInput").each(function() {
                var tempTime = $(this).find("input").val();
                if (tempTime == selectedTime) {
                    $(this).addClass("_active");
                    $(this).find("input").prop("checked", true);
                }
            });
        }
    });

    // when click on time
    $(".radioInput").click(function() {
        $(".radioInput").removeClass("_active");
        $(this).find("input").prop("checked", true);
        $(this).addClass("_active");
    });



    // when Date change
    $("#updateBtn").click(function() {
        var meetingDate = $("#MeetingDate").val();
        var meetingTime = '';
        $(".radioInput input").each(function() {
            if ($(this).is(':checked')) {
                meetingTime = $(this).val();
            }
        });


        if (meetingTime == '') {
            alert('First Select Meeting Time');
            return false;
        }

        // check already same
        var selectedData =
            "<?= empty($slot_data)?'':date('d M Y', strtotime($slot_data->meeting_time));?>";
        var selectedTime =
            "<?= empty($slot_data)?'':date('h:i A', strtotime($slot_data->meeting_time));?>";

        if (selectedData == meetingDate && meetingTime == selectedTime && $(this).text() != 'Approve') {
            alert("Already scheduled in same time");
            return false;
        }


        var lawyerIdId = "<?= empty($lawyer_data)?'':$lawyer_data->id?>";
        if (lawyerIdId != '') {
            var confirmation = confirm("Are you sure to change schedule ?");
            if (confirmation) {
                $(this).addClass("hidden");
                _fnSubmitAjax(lawyerIdId, meetingDate, meetingTime);
            }
        }

    });
});


// function create submittion ===========================================
function _fnSubmitAjax(val = '', meetingDate = '', meetingTime = '') {
    var url = "<?= base_url("admin/case_details/assign_lawyer") ?>";
    var case_id = "<?= $case_data->id?>";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            lawyerId: val,
            caseId: case_id,
            meetingDate: meetingDate,
            meetingTime: meetingTime
        },
        success: function(returnVal) {
            //  alert(returnVal);
            //  return false;
            if (returnVal.includes('1')) {
                alert("Lawyer Successfully Assignd!!");
                location.reload();
            } else if (returnVal.includes('2')) {
                alert("Schedule Successfully Updated!!");
                location.reload();
            } else if (returnVal.includes('3')) {
                alert("Case id Mistmatch OR empty");
            } else if (returnVal.includes('4')) {
                alert("Case / slot / laweyr data empty!!");
            } else {
                alert(returnVal);
            }

            $(".btnSubmit").removeClass("hidden");

        }
    });
    return false;
}
</script>


<script>
$(document).ready(function() {
    // when click on time
    $(".SearchLawyer").keyup(function() {
        var val = $(this).val();
        var categoryId = "<?php echo $case_cat_data->id?>";
        var url = "<?php echo base_url('admin/case_details/searchLawyer')?>";

        $.ajax({
            type: "POST",
            url: url,
            data: {
                lawyerName: val,
                categoryId: categoryId,
            },
            success: function(returnVal) {
                var arr = JSON.parse(returnVal);
                var html = "";

                if (arr.status == 1) {
                    $(".lawyerListData").html("");
                    var allData = arr.allData;
                    allData.forEach(function(e) {
                        html += ''
                        html +=
                            '<label><input type="radio" name="lawyerId" class="checkBox" value="' +
                            e.id + '">'
                        html +=
                            '&nbsp; ' + e.fname + ' ' + e.lname + '/' + e
                            .mobile + '/' + e.state + '/' + e.city +
                            ' </label> </br> ';
                    });
                } else {
                    $(".lawyerListData").html("");
                    html += '<p class="text-danger h2">No Lawyer Found</p>';
                }
                $(".lawyerListData").html(html);

            }
        });
        return false;

    });

})
</script>