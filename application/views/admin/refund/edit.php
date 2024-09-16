<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>


            <a href="<?php echo base_url();?>admin/refund"> <i class="fa fa-sitemap" aria-hidden="true"></i> Refund</a>
            <small>Edit</small>
        </h1>
    </section>
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
            <div class="col-md-12 ">

                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                    </div>
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/Refund/update" method="post"
                        role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Client Name</label>
                                        <input type="text" id="name" name="client_name" class="form-control" readonly value="<?=$payment_data->name;?> ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Order ID</label>
                                        <input type="text" id="name" name="order_id" class="form-control" readonly value="<?=$edit_data->order_id;?> ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Transaction ID</label>
                                        <input type="text" id="name" name="txn_id" class="form-control" readonly value="<?=$edit_data->txn_id;?> ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Payment Status</label>
                                        <input type="text" id="name" name="payment_status" class="form-control" readonly value="<?=$edit_data->payment_status;?> ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Amount</label>
                                        <input type="text" id="name" name="amount" class="form-control" readonly value="<?=$payment_data->amount;?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Client Email</label>
                                        <input type="text" id="name" name="email" class="form-control" readonly value="<?=$payment_data->email;?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="id" value="<?php echo $edit_data->id;?>" />
                <input type="hidden" name="q_id" value="<?php echo $edit_data->q_id;?>" />
                <input type="hidden" name="client_id" value="<?php echo $edit_data->client_id;?>" />
                <input type="submit" class="btn btn-primary" value="Update" />
                <input type="reset" class="btn btn-default" value="Reset" />
            </div>
            </form>
        </div>
</div>
</div>
</section>
</div>

<!-- model for send document end  -->
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(".delete_old_image").click(function() {
    $("#old_img_con").addClass('hidden');
    $(".color_img").addClass('hidden');
    $("#old_image").val('');
});
</script>