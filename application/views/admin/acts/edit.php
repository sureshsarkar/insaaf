<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/acts"> <i class="fa fa-sitemap" aria-hidden="true"></i>Bare Acts</a>

            <?php
            //  pre($Sub_category);
              ?>
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
                    <?php if(isset($edit_data) && !empty($edit_data)){?>
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/acts/update" method="post"
                        role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Bare Act Category</label>
                                                <select name="act_type" class="form-control change_cat">
                                                    <?php if(isset($category) && !empty($category)){ 
                                                        foreach ($category as $key => $value) {?>
                                                    <option value="<?=$value->id?>"
                                                        <?php if($edit_data->act_type==$value->id) echo "selected";?>>
                                                        <?=$value->title?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Bare Act Sub Category</label>
                                                <select name="sub_category_id" class="form-control add_sub_cat">
                                                    <?php if(isset($sub_category) && !empty($sub_category)){ 
                                                        foreach ($sub_category as $key => $value1) {?>
                                                    <option value="<?=$value1->id?>"
                                                        <?php if($value1->id==$edit_data->sub_category_id) echo "selected";?>>
                                                        <?=$value1->title?></option>
                                                    <?php }}?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="text">Section/Article Number</label>
                                                <input class="form-control" value="<?=$edit_data->act_number?>"
                                                    name="act_number">
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
                                                <label for="status">Act Title</label>
                                                <input class="form-control" value="<?=$edit_data->title?>" name="title"
                                                    id="title_cat">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Act Title in Hindi</label>
                                                <input class="form-control" value="<?=$edit_data->title_hi?>"
                                                    name="title_hi">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descreption">Descreption</label>
                                        <textarea rows="2" id="descreption" value="<?=$edit_data->descreption?>"
                                            name="descreption" class="form-control"
                                            placeholder="Enter your Description"><?=$edit_data->descreption?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descreption">Descreption in Hindi</label>
                                        <textarea rows="2" id="descreption_hi" value="<?=$edit_data->descreption_hi?>"
                                            name="descreption_hi" class="form-control"
                                            placeholder="Enter your Description"><?=$edit_data->descreption_hi?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="slug" value="<?=$edit_data->slug_url?>" name="slug_url"
                                            class="form-control" required="required" placeholder="Slug">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta Title</label>
                                        <input type="text" value="<?=$edit_data->meta_title?>" name="meta_title"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta Keyword</label>
                                        <input type="text" value="<?=$edit_data->meta_keyword?>" name="meta_keyword"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta Description</label>
                                        <input type="text" value="<?=$edit_data->meta_description?>"
                                            name="meta_description" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta URL</label>
                                        <input type="text" value="<?=$edit_data->meta_url?>" name="meta_url"
                                            class="form-control">
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
                    <?php }?>
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
    $("#title_cat").keyup(function() {
        var text = $(this).val();
        var slug_text = convertToSlug(text);
        $("#slug").val(slug_text);
    });
});
</script>
<script>
$(document).ready(function() {
    $(".change_cat").on('change', function() {
        $(".add_sub_cat").html("");
        let category_id = $(this).val();
        let url = "<?php echo base_url() ?>admin/acts/get_bare_sub_category";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                id: category_id
            },
            success: function(responce) {
                var resp = $.parseJSON(responce);
                console.log(resp.data);

                $.each(resp.data, function(key, value) {
                    $(".add_sub_cat").append('<option value="' + value.id + '">' +
                        value.title + '</option>');
                })
            }
        })
    })
})
</script>