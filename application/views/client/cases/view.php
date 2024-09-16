
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
                            <h4 class="text-uppercase"><b>Case Details</b></h4>
                        </div>
                                                
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Case : </th> <td><?php echo $case_cat_data->name; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer : </th> <td><?php echo $lawyer_data->fname." ".$lawyer_data->lname; ?></td>
                                </tr>
                                <tr>
                                    <th>Case Status : </th> <td><?php echo ($case_data->status==1)?'Active':'Inactive'; ?></td>
                                </tr>
                                <tr>
                                    <th>Payment Status : </th> <td><?php echo @$payment_data->payment_status; ?></td>
                                </tr>
                                <tr>
                                    <th>Date : </th> <td><?php echo date("M d, Y", strtotime($case_data->dt)); ?></td>
                                </tr>
                                <tr>
                                    <th>About Case : </th> <td><?php echo $case_data->case_description; ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="__flx_button_prv_nxt" style="width:99%">
                            <div class="__bck_butn">
                                <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="button_news"> < Back</a>
                            </div>
                            <div class="__nxt_btn_">
                                <!-- <button type="submit" class="for_nextdjijdf"> Pay ₹99 </button> -->
                                <?php if (isset($payment_data->payment_status) && $payment_data->payment_status=="pending") { ?>
                                <a href="<?php echo base_url('client/slot_booking_pay/Pay_for_slot/'.$payment_data->order_id); ?>" class="for_nextdjijdf"> Pay ₹99 </a>
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
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Lawyer ID : </th> <td><?php echo $lawyer_data->lawyer_unique_id; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer : </th> <td><?php echo $lawyer_data->fname." ".$lawyer_data->lname; ?></td>
                                </tr>
                                <tr>
                                    <th>Lawyer Experience : </th> <td><?php echo $lawyer_data->experience; ?></td>
                                </tr>
                                <tr>
                                    <th>Bar Councle : </th> <td><?php echo $lawyer_data->bar_councle; ?></td>
                                </tr>
                                <tr>
                                    <th>Practice Area : </th> <td><?php echo $lawyer_data->practice_area; ?></td>
                                </tr>
                                <tr>
                                    <th>Case Status : </th> <td><?php echo ($case_data->status==1)?'Active':'Inactive'; ?></td>
                                </tr>
                                <tr>
                                    <th>Date : </th> <td><?php echo date("M d, Y", strtotime($case_data->dt)); ?></td>
                                </tr>
                            </table>
                        </div>

                    </div>
              </div>
            </div>
        </div>
    </section>
    
</div>


