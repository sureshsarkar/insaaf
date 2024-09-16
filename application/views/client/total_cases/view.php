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
                <div class="col-md-6 m-auto">
                    <div class="for_client__">
                        <form action="<?php echo base_url('client/slot_booking_pay/Pay_for_slot'); ?>" method="post">
                            <div class="for_imffhd">
                                <h4 class="text-uppercase"><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i
                                            class="bi bi-arrow-left"></i></a> <b>Case
                                        Details</b></h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Case : </th>
                                        <td><?php echo $case_cat_data->name; ?></td>
                                    </tr>
                                    <?php if(!empty($lawyer_data)){?>
                                    <tr>
                                        <th>Lawyer : </th>
                                        <td><?php echo $lawyer_data->fname." ".$lawyer_data->lname; ?></td>
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
                                    <?php if(isset($slot_data) && !empty($slot_data)){?>
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
                                        <?php 
                                    $diff = dateDiffMin($slot_data->meeting_time,date("Y-m-d H:i:s"));
                                
                                    $caseSatatus = (isset($slot_data->slot_status) && $slot_data->slot_status == 1)?"Active":$this->config->item('slot_status')[$slot_data->slot_status];
                                    $caseSatatus = (isset($slot_data->MeetingStatus) && ($slot_data->MeetingStatus != 0))?$this->config->item('meetStatus')[$slot_data->MeetingStatus]:$caseSatatus;
                                    $Action = (isset($slot_data->MeetingStatus) && $slot_data->MeetingStatus == 0 && $diff < -60 )?'<a href="'.base_url().'client/meeting/reschedule/'.base64_encode($slot_data->id).'" class="badge bg-2"  style="padding: 10px;font-size: 11px;" title="Click to Re-schedule">Re-Schedule</a>':'';
                                    $encriptID= JKMencoder($slot_data->id);
                                    $clientID=base64_encode($slot_data->client_id);    
                                    ?>
                                        <th> Slot Status </th>
                                        <td> <span class="badge bg-1"><?php echo $caseSatatus ?></span></td>
                                    </tr>
                                    <tr>
                                        <th> Action </th>
                                        <td><?= ($diff > -60 && $slot_data->slot_status == 1 && $slot_data->MeetingStatus == 0)?'<a class="bg-1 badge" href="'.base_url().'z/c/'.$encriptID.'" target="_blank">Join Meeting</a>':$Action ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>

                            <div class="__flx_button_prv_nxt" style="width:99%">
                                <!-- <div class="__bck_butn">
                                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="button_news">
                                        < Back</a>
                                </div> -->
                                <div class="__nxt_btn_">
                                    <?php if (isset($payment_data->payment_status) && $payment_data->payment_status== "pending") { ?>
                                    <a href="<?php echo base_url('client/slot_booking_pay/Pay_for_slot/'.$payment_data->order_id); ?>"
                                        class="for_nextdjijdf"> Pay ₹99 </a>
                                    <?php } ?>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-md-6 m-auto">
                    <div class="for_client__">
                        <div class="for_imffhd">
                            <h4 class="text-uppercase"><b>Lawyer Details</b></h4>
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
                                    <th>Bar Council : </th>
                                    <td><?php echo $lawyer_data->bar_councle; ?></td>
                                </tr>
                                <tr>
                                    <th>Practice Area : </th>
                                    <td><?php echo $lawyer_data->practice_area; ?></td>
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
                            <?php }else{  ?>
                            <?php if($case_data->status==0){ echo "<h4>We will assign an expert lawyer within 2-4 hours.</h4>"; }?>
                            <p>For more details contact our support team <b class="text-success">Toll Free :
                                    1800-212-9001</b></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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