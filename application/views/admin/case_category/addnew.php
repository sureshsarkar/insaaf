<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/case_category"> <i class="fa fa-sitemap" aria-hidden="true"></i> Case
                Category</a>
            <small>Add New Case Category</small>
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
                        <h3 class="box-title">Add New Case Category</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/case_category/insertnow"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--name-->
                                            <div class="form-group">
                                                <label for="name">Case Category</label>
                                                <input type="text" id="name" name="name" class="form-control"
                                                    required="required" placeholder="Enter Category Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!--name-->
                                            <div class="form-group">
                                                <label for="name">Case Category in Hindi</label>
                                                <input type="text" id="name" name="name_hi" class="form-control"
                                                    required="required" placeholder="Enter Category Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <!--  Price-->
                                            <div class="form-group">
                                                <label for="number"> Total Amount: </label>
                                                <input type="number" id="total_amount" name="total_amount"
                                                    class="form-control" required="required" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!--  Price-->
                                            <div class="form-group">
                                                <label for="number"> Owner ( % )</label>
                                                <input type="number" id="owner_percentage" name="owner_percentage"
                                                    class="form-control " required="required" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Regular Price-->
                                            <div class="form-group">
                                                <label for="number"> Owner Amount</label>
                                                <input type="number" id="owner_amount" name="owner_amount" readonly
                                                    class="form-control " required="required" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Regular Price-->
                                            <div class="form-group">
                                                <label for="number"> Lawyer Amount</label>
                                                <input type="number" id="lawyer_amount" name="lawyer_amount" readonly
                                                    class="form-control " required="required" placeholder=" ">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Regular Price-->
                                            <div class="form-group">
                                                <label for="number">GST %</label>
                                                <input type="number" id="gst" name="gst" class="form-control "
                                                    required="required" placeholder=" ">
                                            </div>
                                        </div>
                                    </div>
                                    <!--Category Icon-->
                                    <div class="form-group">
                                        <label for="image">Icon Image</label>
                                        <input type="file" id="image" name="image" class="form-control"
                                            placeholder="Choose Category Image">
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <!--name-->
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="slug" name="slug_url" class="form-control"
                                            required="required" placeholder="Slug">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- About  -->
                                    <div class="form-group">
                                        <label for="about">About Case Category</label>
                                        <textarea rows="8" id="about" name="about" class="form-control"
                                            placeholder="About Category"></textarea>
                                    </div>

                                </div>
                            </div>


                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" id="gst_amount" name="gst_amount" class="form-control gst_amount"
                                value="" />
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
CKEDITOR.replace('about', {
    height: 250,
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
    $("#name").keyup(function() {
        var text = $(this).val();
        var slug_text = convertToSlug(text);
        $("#slug").val(slug_text);
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

<script>
$("#total_amount,#owner_percentage,#gst").keyup(function() {

    var total = $("#total_amount").val();
    var percentage = $("#owner_percentage").val();
    var gst = $("#gst").val();
    if (total_amount != '' || percentage != '') {

        var owrer_amount = total * percentage / 100
        var lawyer_amount = total - owrer_amount;
        var gst_amount = total * gst / 100
        $("#owner_amount").val(owrer_amount)
        $("#lawyer_amount").val(lawyer_amount)
        $("#gst_amount").val(gst_amount)

    }
});
</script>