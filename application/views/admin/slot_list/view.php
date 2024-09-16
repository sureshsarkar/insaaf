<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            <a href="<?php echo base_url();?>admin/Slot_list"> <i class="fa fa-sitemap" aria-hidden="true"></i> Slot List</a>
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
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                
                    <?php if(!empty($view_data)){
                 foreach($view_data as $slot){?>
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/Slot_list/update"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Client Name</label>
                                        <input type="text" id="name" name="client_id" class="form-control"
                                            readonly="readonly"
                                            value="<?php echo $slot->c_fname.' '.$slot->c_lname; ?> ">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Lawyer Name</label>
                                        <input type="text" id="name" name="client_id" class="form-control"
                                            readonly="readonly"
                                            value="<?php echo $slot->l_lname.' '.$slot->l_lname; ?> ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Case Category</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            readonly="readonly" value="<?php echo $slot->name; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Slot Date</label>
                                        <input type="text" id="name" name="slot_date" class="form-control"
                                            readonly="readonly" value="<?php echo $slot->slot_date; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Time</label>
                                        <input type="text" id="name" name="time" class="form-control"
                                            readonly="readonly" value="<?php echo $slot->time; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Period</label>
                                        <input type="text" id="name" name="period" class="form-control"
                                            readonly="readonly" value="<?php echo $slot->period; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Contact Mode</label>
                                        <select class="form-control" name="contact_mode" id="contact_mode"
                                            readonly="readonly">
                                            <option value="Zoom Meeting"
                                                <?php echo ($slot->contact_mode == 'Zoom Meeting')?'selected':''; ?>>
                                                Zoom Meeting</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="slot_status" id="status">
                                            <option value="0" <?php echo ($slot->slot_status == 0)?'selected':''; ?>>
                                                Pending</option>
                                            <option value="1" <?php echo ($slot->slot_status == 1)?'selected':''; ?>>
                                                Approve</option>
                                            <option value="2" <?php echo ($slot->slot_status == 2)?'selected':''; ?>>
                                                Decline</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Query</label><br>
                                        <textarea cols="51" rows="3" readonly><?=$query_data->query?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </form>
            <?php }}?>
        </div>
</div>
</div>
</section>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(".delete_old_image").click(function() {
    $("#old_img_con").addClass('hidden');
    $(".color_img").addClass('hidden');
    $("#old_image").val('');
});
</script>