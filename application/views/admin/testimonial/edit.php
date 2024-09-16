<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/testimonial"> <i class="fa fa-sitemap" aria-hidden="true"></i>
                Testimonial</a>
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
                        <h3 class="box-title">Testimonial</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/testimonial/update"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="<?=$edit_data->name?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Name in Hindi</label>
                                                <input type="text" class="form-control" name="name_hi"
                                                    value="<?=$edit_data->name_hi?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Designation</label>
                                                <input type="text" class="form-control" name="designation"
                                                    value="<?=$edit_data->designation?>"
                                                    placeholder="Enter designation">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Image</label>
                                                <input type="file" class="form-control" name="image">
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
                                        <div class="col-md-6">
                                            <label for="status">Descreption</label>
                                            <div class="form-group">
                                                <textarea name="descreption" cols="80"
                                                    rows="5"><?= $edit_data->descreption?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status">Descreption in Hindi</label>
                                            <div class="form-group">
                                                <textarea name="descreption_hi" cols="80"
                                                    rows="5"><?= $edit_data->descreption_hi?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" class="btn btn-primary" name="id" value="<?=$edit_data->id?>" />
                            <input type="hidden" class="btn btn-primary" name="old_image"
                                value="<?=$edit_data->image?>" />
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>