<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/sub_sub_category"> <i class="fa fa-sitemap" aria-hidden="true"></i>
                Sub Sub Category</a>
            <small>Add New Sub Sub Category</small>
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
                        <h3 class="box-title">Add New Sub Sub Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/sub_sub_category/insertnow"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php if(!empty($category)) {?>
                                            <div class="form-group">
                                                <label for="status">Category Name </label>
                                                <select class="form-control category_id" name="category_id"
                                                    id="category_id">
                                                    <option value="">Select </option>
                                                    <?php  foreach ($category as $key => $value) {?>
                                                    <option value="<?=$value->id?>"><?=$value->name?></option>
                                                    <?php   } ?>
                                                </select>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Sub Category</label>
                                                <select class="form-control sub_category" name="sub_category_id"
                                                    id="sub_category">
                                                    <option value="">Select </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Sub Sub Category</label>
                                        <input type="text" id="sub_sub_category" name="sub_sub_category_name"
                                            class="form-control" required="required"
                                            placeholder="Enter sub sub category">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Sub Sub Category Hindi</label>
                                        <input type="text" name="sub_sub_category_name_hi" class="form-control"
                                            required="required" placeholder="Enter sub sub category">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Price</label>
                                                <input type="number" id="price" name="price" class="form-control"
                                                    required="required" placeholder="Enter price">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Discount</label>
                                                <input type="number" id="discount" name="discount" class="form-control"
                                                    required="required" placeholder="Enter Discount">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">GST</label>
                                                <input type="number" id="gst" name="gst" class="form-control"
                                                    required="required" placeholder="Enter GST in percentage">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Short Descreption</label>
                                        <input type="text" name="short_descreption" class="form-control" value=""
                                            placeholder="Enter short descreption ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Short Descreption Hindi</label>
                                        <input type="text" name="short_descreption_hi" class="form-control" value=""
                                            placeholder="Enter short descreption in Hindi ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="slug">Exc.</label>
                                        <input type="text" name="exclusive" class="form-control"
                                            placeholder="Enter Exclusive ">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descreption">Descreption</label>
                                        <textarea rows="5" id="descreption" name="descreption" class="form-control"
                                            placeholder="Enter your Description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descreption">Descreption in Hindi</label>
                                        <textarea rows="5" id="descreption_hi" name="descreption_hi"
                                            class="form-control" value=""
                                            placeholder="Enter your Description"></textarea>
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
                                        <input type="text" id="slug" name="slug_url" class="form-control"
                                            required="required" placeholder="Slug">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta Title</label>
                                        <input type="text" value="" name="meta_title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta Keyword</label>
                                        <input type="text" value="" name="meta_keyword" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta Description</label>
                                        <input type="text" value="" name="meta_description" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta URL</label>
                                        <input type="text" value="" name="meta_url" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Image alt</label>
                                        <input type="text" value="" name="img_alt" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" id="gross_price" name="gross_price" value="" class="form-control">
                            <input type="hidden" id="save_price" name="save_price" value="" class="form-control">
                            <input type="hidden" id="gst_price" name="gst_price" value="" class="form-control">
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
    height: 250,
    extraPlugins: 'colorbutton,colordialog,justify',
    removeButtons: 'PasteFromWord'
});

CKEDITOR.replace('descreption_hi', {
    height: 250,
    extraPlugins: 'colorbutton,colordialog,justify',
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
    $("#sub_sub_category").keyup(function() {
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
<script type='text/javascript'>
// baseURL variable
var baseURL = "<?php echo base_url();?>";

$(document).ready(function() {

    // City change
    $('.category_id').change(function() {
        var val = $(this).val();

        // AJAX request
        $.ajax({
            url: '<?=base_url()?>admin/Sub_sub_category/ajax_call_sub_cat_name',
            method: 'post',
            data: {
                id: val
            },
            dataType: 'json',
            success: function(response) {

                $('.sub_category').html('');
                // Add options
                $.each(response, function(index, data) {
                    $('.sub_category').append('<option value="' + data['id'] +
                        '">' + data['sub_category'] + '</option>');
                });
            }
        });
    });
});
</script>

<script>
$("#price,#discount,#gst").keyup(function() {
    var total_amount = $("#price").val();
    var dis_percentage = $("#discount").val();
    var gst_percentage = $("#gst").val();
    if (total_amount != '' || dis_percentage != '' || gst_percentage != '') {

        var save_price = total_amount * dis_percentage / 100
        var gross_price = total_amount - save_price
        var gst_price = total_amount * gst_percentage / 100
        $("#gross_price").val(gross_price)
        $("#save_price").val(save_price)
        $("#gst_price").val(gst_price)

    }
});
</script>
<!-- <script>
$("#sub_sub_category").keyup(function() {
    var str = $("#sub_sub_category").val();
    var splitStr = str.toLowerCase().split(' ');
    for (var i = 0; i < splitStr.length; i++) {
        splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
    }
    // Directly return the joined string
    var value = splitStr.join(' ')
    $("#sub_sub_category").val(value)
});
</script> -->