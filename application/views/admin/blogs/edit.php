<?php $fqData = json_decode($edit_data->fqData) ;?>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/blogs"> <i class="fa fa-sitemap" aria-hidden="true"></i>
                Blogs</a>
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
                        <h3 class="box-title">Blogs</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/blogs/update" method="post"
                        role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Act Title</label>
                                                <input class="form-control category_id" name="title" id="title"
                                                    value="<?=$edit_data->title?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name"> Act Title in Hindi</label>
                                                <input class="form-control " name="title_hi"
                                                    value="<?=$edit_data->title_hi?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option value="1"
                                                        <?php echo ($edit_data->status == 1)?'selected':''; ?>>Active
                                                    </option>
                                                    <option value="0"
                                                        <?php echo ($edit_data->status == 0)?'selected':''; ?>>Inactive
                                                    </option>
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
                                                <label for="status">Author Name</label>
                                                <input class="form-control category_id" name="author_name"
                                                    value="<?=$edit_data->author_name?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Upload Author Image</label>
                                                <input type="file" name="author_image" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descreption">Descreption</label>
                                        <textarea rows="5" id="descreption" name="descreption" class="form-control"
                                            placeholder="Enter Description"><?=$edit_data->descreption?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descreption">Descreption in Hindi</label>
                                        <textarea rows="5" id="descreption_hi" name="descreption_hi"
                                            class="form-control"
                                            placeholder="Enter Description"><?=$edit_data->descreption_hi?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                            if(isset($fqData) && !empty($fqData)){
                                
                                foreach ($fqData as $k => $v) {
                                ?>
                                <div id="inputFormRow">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="status">F/Q Title</label>
                                            <input type="text" name="fqTitle[]" value="<?= $v->fqTitle?>"
                                                class="form-control" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group"><label for="slug">F/Q Description</label>
                                            <textarea name="fqDescription[]" class="form-control" rows="3"
                                                required="required">
                                                <?= $v->fqDescription?>
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-5">
                                        <button id="removeRow" type="button" class="btn btn-danger btn-small">-</button>
                                    </div>
                                </div>
                                <?php }}?>
                            </div>

                            <div class="row">
                                <div id="addSection">

                                </div>
                            </div>
                            <div class="btn btn-primary clickToAdd mt-2">+ Add F/Q Section</div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="slug" name="slug_url" class="form-control"
                                            required="required" placeholder="Slug" value="<?=$edit_data->slug_url?>">
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
                            <input type="hidden" class="btn btn-primary" name="old_image"
                                value="<?=$edit_data->image?>" />
                            <input type="hidden" class="btn btn-primary" name="old_author_image"
                                value="<?=$edit_data->author_image?>" />
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



<script>
$(document).ready(function() {
    $(".clickToAdd").click(function() {

        var html = '';


        html += '<div id="inputFormRow">';
        html += '<div class="col-md-12">';
        html += '<div class="form-group">';
        html += '<label for="status">F/Q Title</label>';
        html += '<input type="text" name="fqTitle[]" class="form-control" required="required">';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-12">';
        html += '<div class="form-group">';
        html += '<label for="slug">F/Q Description</label>';
        html +=
            ' <textarea name="fqDescription[]" class="form-control" rows="3" required = "required" >';
        html += '     </textarea>';
        html += '  </div>';
        html += ' </div>';
        html +=
            '  <div class="col-md-2 mt-5"><button id="removeRow" type="button" class="btn btn-danger btn-small">-</button>';
        html += ' </div>';
        html += ' </div>';


        $("#addSection").append(html);

    });

    // remove row
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
    });

});
</script>