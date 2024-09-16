<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/acts/sub_category"> <i class="fa fa-sitemap" aria-hidden="true"></i>
                Bare Acts Category List</a>
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
                        <h3 class="box-title">Bare Acts</h3>
                    </div>
                    <!-- <?php pre($edit_cat_data);?>
                    <?php pre($edit_data);?> -->
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/acts/updateActsubCategory"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">Act Category</label>
                                                <select name="category_id" class="form-control">
                                                    <?php if(isset($edit_cat_data) && !empty($edit_cat_data)){
                                                        foreach($edit_cat_data as $value){?>
                                                    <option value="<?=$value->id?>" <?php if($edit_data->category_id==$value->id) echo "selected"; ?>><?=$value->title?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">Act Title</label>
                                                <input class="form-control category_id" name="title"id="title" value="<?=$edit_data->title?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name"> Act Title in Hindi</label>
                                                <input class="form-control " name="title_hi"  value="<?=$edit_data->title_hi?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Section Range</label>
                                                <input type="text" name="section_range" class="form-control" value="<?=$edit_data->section_range?>" />
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="1"  <?php echo ($edit_data->status ==1)?'selected':'';?>>Active</option>
                                                    <option value="0" <?php echo ($edit_data->status ==0)?'selected':'';?>>InActive</option>
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" class="btn btn-primary" name="id" value="<?=$edit_data->id?>" />
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
CKEDITOR.replace('descreption', {
    height: 250,
    extraPlugins: 'colorbutton,colordialog',
    removeButtons: 'PasteFromWord'
});
</script>
<script>
CKEDITOR.replace('descreption_hi', {
    height: 250,
    extraPlugins: 'colorbutton,colordialog',
    removeButtons: 'PasteFromWord'
});
</script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(".delete_old_image").click(function() {
    $("#old_img_con").addClass('hidden');
    $(".category_img").addClass('hidden');
    $("#old_image").val('');
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#title").keyup(function() {
        var text = $(this).val();
        var slug_text = convertToSlug(text);
        // console.log(slug_text);
        $("#slug").val(slug_text);
    });
});
</script>