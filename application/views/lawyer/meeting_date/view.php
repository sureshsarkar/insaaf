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

            <div class="box-header">
                <h3 class="box-title">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal89892323">Add
                        Note</button>
                </h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <div class="for_client__">
                        <form action="#" method="post">
                            <div class="for_imffhd">
                                <h4 class="text-uppercase"><a href="<?= base_url('lawyer/meeting') ?>"><i
                                            class="bi bi-arrow-left"></i> </a><b>Case Details</b></h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Case : </th>
                                        <td><?php echo $case_cat_data->name; ?></td>
                                    </tr>
                                    <?php if(!empty($client_data)){?>
                                    <tr>
                                        <th>Lawyer : </th>
                                        <td><?php echo $client_data->fname." ".$client_data->lname; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th>Expert Appointment : </th>
                                        <td><?php echo ($case_data->status==1)?'Active':'Inactive'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Payment Status : </th>
                                        <td><?php echo @$payment_data->payment_status; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Booking Date : </th>
                                        <td><?php echo date("M d, Y", strtotime($case_data->dt)); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Category/Query : </th>
                                        <td><?php echo $case_data->case_description; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Document Attached : </th>
                                        <td><?php echo !empty($case_data->case_file)?'<a href="'.base_url("uploads/cases/".$case_data->case_file).'" target="_blank">View &nbsp; <i class="bi bi-box-arrow-up-right"></i> </a>':'N/A' ?>
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
                                        <?php 
                                    
                                    $diff = dateDiffMin($slot_data->meeting_time,date("Y-m-d H:i:s"));
                                    if($slot_data->MeetingStatus != 0){
                                        $caseSatatus = $this->config->item('meetStatus')[$slot_data->MeetingStatus];
                                    }else if(isset($slot_data->slot_status) && $slot_data->slot_status == 1){
                                        $caseSatatus = ($diff < -20)?'Expire':"Active";
                                    }else{
                                        $caseSatatus = $this->config->item('slot_status')[$slot_data->slot_status];
                                    }
                                    
                                    
                                    // $Action = (isset($slot_data->MeetingStatus) && $slot_data->MeetingStatus == 0 && $diff < -60 )?'<a href="'.base_url().'client/meeting/reschedule/'.base64_encode($slot_data->id).'" class="badge bg-2"  style="padding: 10px;font-size: 11px;" title="Click to Re-schedule">Re-Schedule</a>':'';
                                    $Action = '';

                                    $encriptID= JKMencoder($slot_data->id);
                                    $clientID=base64_encode($slot_data->client_id);    
                                    ?>

                                        <th> Meeting Status </th>
                                        <td>: <span class="badge bg-1"><?php echo $caseSatatus ?></span></td>
                                    </tr>
                                    <tr>
                                        <th> Action </th>
                                        <td>:
                                            <?= ($diff > -60 && $slot_data->slot_status == 1 && $slot_data->MeetingStatus == 0)?'<a class="bg-1 badge" href="'.base_url().'z/l/'.$encriptID.'">Join Meeting</a>':$Action ?>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                    <!-- Meeting Feedback-->
                                    <?php if($slot_data->MeetingStatus != 0){ ?>
                                    <tr>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="bg-danger">FeedBack & Meeting Details</td>
                                    </tr>
                                    <tr>
                                        <th>Meeting Duration </th>
                                        <td>:
                                            <?php echo  ($slot_data->total_done_meet_time > 10)?number_format((float)$slot_data->total_done_meet_time/(60), 2, ':', '')." Minutes":'-'  ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Client FeedBack </th>
                                        <td>: <?php echo $slot_data->clientFeedback; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Your FeedBack </th>
                                        <td>: <?php echo $slot_data->lawyerFeedback; ?></td>
                                    </tr>

                                    <?php } ?>


                                </table>
                            </div>

                            <div class="__flx_button_prv_nxt" style="width:99%">
                                <div class="__bck_butn">
                                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="button_news">
                                        < Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="for_client__">
                        <div class="for_imffhd">
                            <h4 class="text-uppercase"><b>Client Details</b></h4>
                        </div>

                        <div class="table-responsive">
                            <?php if(!empty($client_data)){?>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Client ID : </th>
                                    <td><?php echo $client_data->client_unique_id; ?></td>
                                </tr>
                                <tr>
                                    <th>Client : </th>
                                    <td><?php echo $client_data->fname." ".$client_data->lname; ?></td>
                                </tr>

                                <tr>
                                    <th>Case Status : </th>
                                    <td><?php echo ($case_data->status==1)?'Active':'Inactive'; ?></td>
                                </tr>
                                <tr>
                                    <th>Date : </th>
                                    <td><?php echo date("M d, Y", strtotime($case_data->dt)); ?></td>
                                </tr>

                            </table>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>



<!--  Lawyer Note modal -->
<div class="modal fade" id="exampleModal89892323" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog" role="document">

        <div class="modal-content __type_modal ">
            <section class="p-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                </button>
                <form action="<?= base_url()?>lawyer/lawyer_note/addNoteByMeet" method="post">
                    <!-- list -->
                    <div class="table-responsive p-2">
                        <label for="">Add Notes for this meeting</label>
                        <textarea class="form-control w-100" name="note" id="" cols="30"
                            rows="10"><?php echo (isset($noteData))?$noteData->note:""?> </textarea>
                    </div>

                    <div class="modal-footer">
                        <div class="text-right mr-2 pt-2 mb-2">
                            <input type="hidden" name="id" value="<?=(isset($noteData))?$noteData->id:""?>">
                            <input type="hidden" name="lawyer_id" value="<?= $_SESSION['id']?>">
                            <input type="hidden" name="slot_id" value="<?= $slot_data->id?>">
                            <button type="submit" class="btn btn-primary">Update Note</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>


<style>
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