<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>sub_admin/client"> <i class="fa fa-sitemap" aria-hidden="true"></i>
                Client</a>
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
                    <form role="form" id="member_form" action="<?php echo base_url() ?>sub_admin/size/update"
                        method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> First Name</label>
                                        <input type="text" id="name" name="fname" class="form-control"
                                            required="required" placeholder="Enter first Name"
                                            value="<?php echo $edit_data->fname; ?> ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Last Name</label>
                                        <input type="text" id="name" name="lname" class="form-control"
                                            required="required" placeholder="Enter last Name"
                                            value="<?php echo $edit_data->lname; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="text" id="name" name="email" class="form-control"
                                            required="required" placeholder="Enter email Name"
                                            value="<?php echo $edit_data->email; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Mobile</label>
                                        <input type="text" id="name" name="mobile" class="form-control"
                                            required="required" placeholder="Enter mobile Name"
                                            value="<?php echo $edit_data->mobile; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Joining date</label>
                                        <input type="text" id="name" name="dt" class="form-control" required="required"
                                            placeholder="Enter mobile Name" value="<?php echo $edit_data->dt; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1" <?php echo ($edit_data->status == 1)?'selected':''; ?>>
                                                Active</option>
                                            <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?>>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Case Type</label>
                                        <?php if($Categoryname){?>
                                        <input type="text" id="name" name="dt" class="form-control" required="required"
                                            placeholder="Enter mobile Name" value="<?php echo $Categoryname; ?>">
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Message </label>
                                        <textarea type="file" id="name" name="message" class="form-control"
                                            placeholder="Enter mobile Name"
                                            value="<?php echo $edit_data->message; ?>"><?php echo $edit_data->message; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Case File</label><br>
                                        <button type="button" class="btn btn-primary "> <a
                                                href="<?php echo base_url('uploads/client/').$edit_data->case_file; ?>"
                                                target="_blank" title="view"><img
                                                    src1="<?php echo base_url('uploads/client/').$edit_data->case_file; ?>"
                                                    width="30px;" alt=""></a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>" />
                </div>
                </form>
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