<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/acts/category"> <i class="fa fa-sitemap" aria-hidden="true"></i>Bare Acts Category</a>
            <small></small>
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
                <div class="box box-primary p-3">
                    <div class="box-header">
                        <h3 class="box-title">Bare Acts Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/acts/insertcategory"
                        method="post" role="form" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Act Title</label>
                                                <input class="form-control category_id" id="title" name="title">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Act Title in Hindi</label>
                                                <input class="form-control " name="title_hi">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">slug</label>
                                                <input class="form-control" id="slug" name="slug_url"  value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="1">Active</option>
                                                    <option value="0">InActive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Image</label>
                                                <input type="file" class="form-control" name="image"  value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           
                        
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
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
CKEDITOR.replace('descreption', {
    height: 240,
    extraPlugins: 'colorbutton,colordialog',
    removeButtons: 'PasteFromWord'
});
</script>
<script>
CKEDITOR.replace('descreption_hi', {
    height: 240,
    extraPlugins: 'colorbutton,colordialog',
    removeButtons: 'PasteFromWord'
});
</script>
<script>
$(document).ready(function() {

    $("#video_file").change(function() {
        var id = "video_file";
        var max_size = 400000000;
        video_validation(id, max_size);
    });

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#title").keyup(function() {
        var text = $(this).val();
        var slug_text = convertToSlug(text);
        $("#slug").val(slug_text);
    });
});
</script>