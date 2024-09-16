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
                <div class="col-md-8 m-auto">
                    <div class="for_client__">
                        <form
                            action="<?php echo base_url('client/slot_booking_pay/'); ?><?= isset($_SESSION['chat_user'])?'generate_code':'Pay_for_slot' ?>"
                            method="post" id="form1">
                            <div class="for_imffhd">
                                <h4 class="text-uppercase"><b>Case Preview</b></h4>
                            </div>
                            <div>
                                <?php 
                                $originalDate = $this->session->userdata('ses_schedule_date');
                                $newDate = date("Y-m-d", strtotime($originalDate));
                            ?>
                                <input type="hidden" name="lawyer_id"
                                    value="<?php echo empty($lawyer_data)?'':$lawyer_data->id; ?>">
                                <input type="hidden" name="client_id"
                                    value="<?php echo isset($_SESSION['chat_user'])?$_SESSION['chat_user']:$_SESSION['id']; ?>">
                                <input type="hidden" name="case_category_id" value="<?php echo $case_cat_data->id; ?>">
                                <input type="hidden" name="slot_date" value="<?php echo $newDate; ?>">
                                <input type="hidden" name="case_description"
                                    value="<?php echo $this->session->userdata('case_description'); ?>">
                                <input type="hidden" name="time"
                                    value="<?php echo $this->session->userdata('ses_schedule_time'); ?>">
                                <?php
                                $meeting_day = $this->session->userdata('ses_schedule_date')." ".$this->session->userdata('ses_schedule_time');
                                $meeting_time = date('Y-m-d H:i:s', strtotime($meeting_day));
                            ?>
                                <input type="hidden" name="meeting_time" value="<?php echo $meeting_time; ?>">
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Case : </th>
                                        <td><?php echo $case_cat_data->name; ?></td>
                                    </tr>
                                    <!-- <tr>
                                    <th>Lawyer : </th> <td><?php echo empty($lawyer_data)?'':$lawyer_data->fname." ".$lawyer_data->lname; ?></td>
                                </tr> -->
                                    <!-- <tr>
                                    <th>Lawyer Experience : </th> <td><?php echo empty($lawyer_data)?'':$lawyer_data->experience; ?></td>
                                </tr> -->
                                    <tr>
                                        <th>Case Details : </th>
                                        <td><?php echo $this->session->userdata('case_description'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Meeting Date : </th>
                                        <td><?php echo $this->session->userdata('ses_schedule_date'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Meeting Time : </th>
                                        <td><?php echo $this->session->userdata('ses_schedule_time'); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Attach File : </th>
                                        <td><?php echo isset($_SESSION['case_file'])?'<a href="'.base_url("uploads/cases/".$_SESSION['case_file']).'" target="_blank">View &nbsp; <i class="bi bi-box-arrow-up-right"></i> </a>':'N/A' ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="__flx_button_prv_nxt" style="width:99%">
                                <div class="__bck_butn">
                                    <a href="<?php echo base_url('client/create_case/ajax4/'.base64_encode($this->session->userdata('ses_lawyer_id'))); ?>"
                                        class="button_news">
                                        < Back</a>
                                </div>
                                <?php 
                                    $clientID = $_SESSION['id'];
                                    $query= $this->db->query("select id from slot where `client_id` = $clientID AND `MeetingStatus` = '2'");
                                    $userSlotData=$query->result_array(); 
                                   ?>

                                <div class="__nxt_btn_">
                                    <button type="submit"
                                        class="for_nextdjijdf"><?= (isset($userSlotData) && count($userSlotData) >= 1)?'Pay ₹299':'Pay ₹99' ?>
                                    </button>
                                    <!-- <button type="submit" class="for_nextdjijdf"><?= (isset($_SESSION['chat_id']))?'Generate Code':'Pay ₹99' ?>
                                    </button> -->


                                    <!-- <a  class="for_nextdjijdf"> Pay ₹99 </a> -->
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>





<style>
.forfldk_justc {
    display: flex;
    justify-content: space-between;
    font-weight: 700;
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

.radio_start {
    height: 200px;
    overflow: hidden;
    overflow-y: scroll;
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
</style>