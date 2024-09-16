<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>lawyer/dashboard/index/<?php echo $detail->lawyer_id?>"> <i class="fa fa-sitemap" aria-hidden="true"></i> Go back </a>
            <small>Add New Hearing Date</small>
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
                        <h3 class="box-title">Add Hearing Date </h3>
                    </div>
       
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="member_form"
                        action="<?php echo base_url() ?>lawyer/Hearing_date/Complane_mail" method="post" role="form"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       
                                        <label for="name">Client Name</label>
                                        <input type="text" id="name" name="client_name" value="<?php echo $detail->fname .' '.$detail->lname;?>"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Case Category</label>
                                        <input type="text" id="query"  class="form-control" value="<?=$detail->name;?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       
                                        <label for="name">Case Sub Category</label>
                                        <input type="text" id="query"  class="form-control" value="<?=$detail->name;?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Enter your query </label>
                                        <textarea type="text" id="query" name="query" class="form-control"
                                            placeholder="Enter your query" require></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="box-footer">
                    <input type="text" class="hidden" name="lawyer_id" value="<?=$detail->lawyer_id;?>" />
                    <input type="text" class="hidden" name="lawyer_name" value="<?=$detail->l_fname .''. $detail->l_lname;?>" />
                    <input type="text" class="hidden" name="case_id" value="<?=$detail->case_id;?>" />
                    <input type="text" class="hidden" name="case_cat" value="<?=$detail->name;?>" />
                    <input type="text" class="hidden" name="case_sub_cat" value="<?=$detail->case_sub_category;?>" />
                    <input type="text" class="hidden" name="client_mobile" value="<?=$detail->mobile;?>" />
                    <input type="text" class="hidden" name="client_email" value="<?=$detail->email;?>" />
                    <input type="text" class="hidden" name="lawyer_email" value="<?=$detail->l_email;?>" />
                    <input type="text" class="hidden" name="lawyer_mobile" value="<?=$detail->l_mobile;?>" />

                    <input type="submit" class="btn btn-primary" value="Send " />
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
CKEDITOR.replace('short_description');
</script>
<script>
CKEDITOR.replace('description');
</script>
<script>
$(document).ready(function() {
    //Chosen
    $(".multipleChosen").chosen({
        placeholder_text_multiple: "Select Size .." //placeholder
    });

    $("#video_file").change(function() {
        var id = "video_file";
        var max_size = 400000000;
        video_validation(id, max_size);
    });

});
</script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(document).ready(function() {
    $("#video_file").change(function() {
        var id = "video_file";
        var max_size = 400000000;
        video_validation(id, max_size);
    });

});
</script>
<script>
// Function Video Validation

function video_validation(id, max_size) {
    var fuData = document.getElementById(id);
    var FileUploadPath = fuData.value;


    if (FileUploadPath == '') {
        alert("Please upload Video");
    } else {
        var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
        if (Extension == "mp4" || Extension == "mov" || Extension == "flv" || Extension == "avi" || Extension ==
            "3gp") {

            if (fuData.files && fuData.files[0]) {
                var size = fuData.files[0].size;

                if (size > max_size) { //1000000 = 1 mb
                    alert("Maximum file size 50 MB");
                    $("#" + id).val('');
                    return;
                }
            }

        } else {
            alert("Video only allows file types of mp4, mov, flv, avi, 3gp , 3gpp");
            $("#" + id).val('');
        }
    }
}
</script>