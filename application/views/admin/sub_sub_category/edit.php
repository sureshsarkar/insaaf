<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/sub_sub_category"> <i class="fa fa-sitemap" aria-hidden="true"></i>
                Sub sub Category</a>
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
                        <button type="button" class="btn btn-primary addingClass" data-toggle="modal"
                            data-target="#addingClass">
                            Add Classes
                        </button>
                        <button type="button" class="btn btn-primary editClass" data-toggle="modal"
                            data-target="#editClass">
                            Edit Classes
                        </button>
                    </div>
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/sub_sub_category/update"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php if(!empty($category)) {?>
                                            <div class="form-group">
                                                <label for="status">Category Name </label>
                                                <select class="form-control category_id" name="category_id"
                                                    id="category_id">
                                                    <?php  foreach ($category as $key => $value) {?>
                                                    <option
                                                        <?php if($value->id==$edit_data->category_id){ echo "selected";}else{echo "";}?>
                                                        value="<?=$value->id?>"><?=$value->name?></option>
                                                    <?php }   ?>
                                                </select>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Sub Category</label>
                                                <select class="form-control sub_category" name="sub_category_id"
                                                    id="sub_category" required>
                                                    <?php  foreach ($sub_category as $key => $sub_cat_value) {?>
                                                    <option
                                                        <?php if($sub_cat_value->id==$edit_data->sub_category_id){ echo "selected";}else{echo "";}?>
                                                        value="<?=$sub_cat_value->id?>">
                                                        <?=$sub_cat_value->sub_category?>
                                                    </option>
                                                    <?php  }  ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="slug">Sub Sub Category</label>
                                                <input type="text" id="sub_sub_category" name="sub_sub_category_name"
                                                    class="form-control sub_sub_category"
                                                    value="<?=$edit_data->sub_sub_category_name;?>" required="required"
                                                    placeholder="Enter sub sub category">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="slug">Sub Sub Category in Hindi</label>
                                        <input type="text" id="sub_sub_category" name="sub_sub_category_name_hi"
                                            class="form-control sub_sub_category"
                                            value="<?=$edit_data->sub_sub_category_name_hi;?>" required="required"
                                            placeholder="Enter sub sub category">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Price</label>
                                                <input type="number" id="price" name="price" class="form-control"
                                                    required="required" value="<?=$edit_data->price?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Discount</label>
                                                <input type="number" id="discount" name="discount" class="form-control"
                                                    required="required" value="<?=$edit_data->discount?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">GST</label>
                                                <input type="number" id="gst" name="gst" class="form-control"
                                                    required="required" value="<?=$edit_data->gst?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Short Descreption</label>
                                        <input type="text" name="short_descreption" class="form-control"
                                            value="<?=$edit_data->short_descreption?>"
                                            placeholder="Enter short descreption ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Short Descreption Hindi</label>
                                        <input type="text" name="short_descreption_hi" class="form-control"
                                            value="<?=$edit_data->short_descreption_hi?>"
                                            placeholder="Enter short descreption in Hindi ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="slug">Exc.</label>
                                        <input type="text" name="exclusive" class="form-control"
                                            value="<?=$edit_data->exclusive?>" placeholder="Enter Exclusive ">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="slug">Upload Banner.</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descreption">Descreption</label>
                                        <textarea rows="5" id="descreption" name="descreption" class="form-control"
                                            value=""><?=$edit_data->descreption?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descreption">Descreption in Hindi</label>
                                        <textarea rows="5" id="descreption_hi" name="descreption_hi"
                                            class="form-control"><?=$edit_data->descreption_hi?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1" <?php echo ($edit_data->status == 1)?'selected':''; ?>>
                                                Active</option>
                                            <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?>>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="slug" value="<?php echo $edit_data->slug_url;?>"
                                            name="slug_url" class="form-control" required="required" placeholder="Slug">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta Title</label>
                                        <input type="text" value="<?php echo $edit_data->meta_title;?>"
                                            name="meta_title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta Keyword</label>
                                        <input type="text" value="<?php echo $edit_data->meta_keyword;?>"
                                            name="meta_keyword" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta Description</label>
                                        <input type="text" value="<?php echo $edit_data->meta_description;?>"
                                            name="meta_description" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Meta URL</label>
                                        <input type="text" value="<?php echo $edit_data->meta_url;?>" name="meta_url"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Image alt</label>
                                        <input type="text" name="img_alt" class="form-control"
                                            value="<?php echo $edit_data->img_alt;?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="old_image" value="<?= $edit_data->image?>">
                            <input type="hidden" id="gross_price" name="gross_price"
                                value="<?=$edit_data->gross_price?>" class="form-control">
                            <input type="hidden" id="save_price" name="save_price" value="<?=$edit_data->save_price?>"
                                class="form-control">
                            <input type="hidden" id="gst_price" name="gst_price" value="<?=$edit_data->gst_price?>"
                                class="form-control">
                            <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>" />
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal  for adding classes-->
<div class="modal fade " data-backdrop="static" id="addingClass" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-info" id="exampleModalLabel">Add Classes <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h2>
            </div>
            <form action="<?= base_url('admin/sub_sub_category/addClasses')?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descreption">Class Number</label>
                                <input type="text" name="class" class="form-control classData">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descreption">Class Descreption</label>
                                <textarea rows="4" name="classDescreption" class="form-control  ckeditor"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="CattegoryId" name="id" value="<?= $edit_data->id?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitClass">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
.w-100 {
    width: 100% !important;
}
</style>
<!-- Modal  for edit Class -->
<div class="modal fade " data-backdrop="static" id="editClass" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-info" id="exampleModalLabel">Edit Classes <button type="button"
                        class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h2>
            </div>
            <?php 
            $classData = json_decode($edit_data->classes);
            if(isset($classData) && !empty($classData)){
                foreach ($classData as $k => $v) {?>

            <div class="row ml-0 w-100 p-2">
                <div class="col-md-6 col-6 bg-secondary">
                    <div class="p-2"><?= $v->class?></div>
                </div>
                <div class="col-md-6 col-6 bg-secondary">
                    <button classValue="<?= $v->class?>" descreptionValue="<?= $v->classDescreption?>"
                        keyValue="<?= $k?>" type="button" class="btn btn-info updateModal" data-toggle="modal"
                        data-target="#updateModal">
                        Edit
                    </button>
                </div>
            </div>
            <?php   }
            }else{
                echo '<h2 class="text-warning">No Data Found</h2>';
            }
            ?>

        </div>
    </div>
</div>

<!-- Modal  for Update Class -->
<div class="modal fade " data-backdrop="static" id="updateModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-info" id="exampleModalLabel">Update Classes <button type="button"
                        class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h2>
            </div>
            <form action="<?= base_url('admin/sub_sub_category/updateClasses')?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descreption">Class Number</label>
                                <input type="text" name="class" class="form-control updateClassTitle">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descreption">Class Descreption</label>
                                <textarea rows="4" name="classDescreption" id="updateClassDescription"
                                    class="form-control ckeditor"> </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" class="CattegoryId" name="id" value="<?= $edit_data->id?>">
                    <input type="hidden" class="key" name="key">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitClass">Update Class</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
CKEDITOR.replace('classDescription', {
    height: 150,
    extraPlugins: 'colorbutton,colordialog,justify',
    removeButtons: 'PasteFromWord'
});
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
<script src=" <?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(".delete_old_image").click(function() {
    $("#old_img_con").addClass('hidden');
    $(".category_img").addClass('hidden');
    $("#old_image").val('');
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
$(document).ready(function() {
    // City change
    $('.category_id').change(function() {
        var val = $(this).val();
        //    alert(val);
        // AJAX request
        $.ajax({
            url: '<?=base_url()?>admin/Sub_sub_category/ajax_call_sub_sub_cat_name',
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



<!-- <script>
$(document).ready(function() {
    $(".editClass").click();
})
</script> -->


<!-- get & set value in Update modal script  -->
<script>
$(document).ready(function() {
    $(".updateModal").click(function() {
        var insertClassTitle = $(this).attr('classValue');
        var insertClassDescription = $(this).attr('descreptionValue');
        var keyValue = $(this).attr('keyValue');
        $(".updateClassTitle").val(insertClassTitle);
        $(".key").val(keyValue);
        var editData = CKEDITOR.instances['updateClassDescription']; // create instances
        editData.setData(insertClassDescription);
    })
})
</script>