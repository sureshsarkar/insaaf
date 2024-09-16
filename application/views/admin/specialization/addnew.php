<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/specialization"> <i class="fa fa-sitemap"
                    aria-hidden="true"></i> Specialization List</a>
            <small>Add New Specialization</small>
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
                        <h3 class="box-title">Add New Specialization Category</h3>
                    </div>

                    <form action="<?php echo base_url() ?>admin/specialization/insertnow" method="post"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Title</label>
                                        <input type="text" id="title" name="title" class="form-control"
                                            placeholder="Enter title" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Title in Hindi</label>
                                        <input type="text" name="title_hi" class="form-control"
                                            placeholder="Enter title in Hindi" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Banner Image</label>
                                        <input type="file" name="banner_img" class="form-control"
                                            placeholder="Choose Category Image" required>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Detail Page Image</label>
                                        <input type="file" name="detail_img" class="form-control"
                                            placeholder="Choose Category Image">
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="slug" name="slug_url" class="form-control"
                                            required="required" placeholder="Slug">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about">Description</label>
                                        <textarea rows="8" name="description" id="description" class="form-control"
                                            placeholder="Description" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="about">Description in Hindi</label>
                                        <textarea rows="8" name="descreption_hi" id="descreption_hi"
                                            class="form-control" placeholder="Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="Enter Meta Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Meta Keyword</label>
                                        <input type="text" name="meta_keyword" class="form-control"
                                            placeholder="Enter Meta Keyword">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Meta Description</label>
                                        <input type="text" name="meta_description" class="form-control"
                                            placeholder="Enter Meta Description">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Meta URL</label>
                                        <input type="text" name="meta_url" class="form-control"
                                            placeholder="Enter Meta  URL">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Meta OG Description</label>
                                        <input type="text" name="meta_og_description" class="form-control"
                                            placeholder="Enter Meta OG Description">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Meta Twitter Title</label>
                                        <input type="text" name="meta_twitter_title" class="form-control"
                                            placeholder="Enter Meta Twitter Title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Meta Twitter Description</label>
                                        <input type="text" name="meta_twitter_description" class="form-control"
                                            placeholder="Enter Meta Twitter Description">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Meta Canonical</label>
                                        <input type="text" name="meta_canonical" class="form-control"
                                            placeholder="Enter Meta Canonical">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image alt</label>
                                        <input type="text" name="img_alt" class="form-control"
                                            placeholder="Enter Meta Canonical">
                                    </div>
                                </div>
                            </div>
                        </div>

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
CKEDITOR.replace('description', {
    height: 250,
    extraPlugins: 'colorbutton,colordialog',
    removeButtons: 'PasteFromWord',
    extraPlugins: 'justify',
});
CKEDITOR.replace('description_hi', {
    height: 250,
    extraPlugins: 'colorbutton,colordialog',
    removeButtons: 'PasteFromWord',
    extraPlugins: 'justify',


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