<?php 
if(isset($edit_data->jsonText) && !empty($edit_data->jsonText)){
 $otherData =json_decode($edit_data->jsonText);   

}else{
    $otherData ='';
}
?>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>sub_admin/support"> <i class="fa fa-sitemap" aria-hidden="true"></i>
                Support</a>
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
                        Support Request
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="member_form" action="<?php echo base_url() ?>sub_admin/client/update"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Mobile</label>
                                        <input type="text" id="name" name="fname" class="form-control"
                                            placeholder="Enter first Name" value="<?php echo $otherData->mobile; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="text" id="name" name="lname" class="form-control"
                                            placeholder="Enter last Name" value="<?php echo $otherData->email; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>" />
            <input type="submit" class="btn btn-primary" value="Update" />
            <input type="reset" class="btn btn-default" value="Reset" />
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