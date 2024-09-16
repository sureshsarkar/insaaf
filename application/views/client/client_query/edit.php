<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>


            <a href="<?php echo base_url();?>client/Client_query/index/<?=base64_encode($_SESSION['id'])?>"> <i class="fa fa-sitemap" aria-hidden="true"></i> Query</a>
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

               
                    <form role="form" id="member_form" action="<?php echo base_url() ?>client/Client_query/update"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Client Name</label>
                                        <input type="text" id="name" name="client_name" class="form-control"
                                            readonly="readonly"
                                            value="<?php echo $client_data->fname.' '.$client_data->lname; ?> ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php if(!empty($case_cat_data)) {?>
                                    <div class="form-group">
                                        <label for="status"> Case Category Name </label>
                                        <select class="form-control" name="case_cat_id" id="parent_id" value="" require>
                                            <?php foreach($case_cat_data as $cat_value){?>
                                            <option <?php if($cat_value->id==$edit_data->case_cat_id){?>
                                                value="<?=$cat_value->id ;?>"> <?=$cat_value->name ;?></option>
                                            <?php } }?>
                                            <?php  foreach ($case_cat_data as $key => $value) {?>
                                            <option value="<?=$value->id?>"><?=$value->name?></option>
                                            <?php   } ?>
                                        </select>
                                    </div>
                                    <?php }?>
                                </div>
                                <div class="col-md-4">
                                <label for="status">Query File</label>
                               <input type="file" class="form-control" name="querry_file">
                                </div>
                            </div>
                            <div class="row">
                               
                                <div class="col-md-4">
                                    <label for="status">My Query</label>
                                    <textarea class="form-control" name="query" id="" value="" cols="30"
                                        rows="4"><?=$edit_data->query?></textarea>
                                </div>
                            </div>


                        </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="id" value="<?php echo $edit_data->id;?>" />
                <input type="hidden" id="name" name="user_id" value="<?php echo $edit_data->user_id; ?>" />
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