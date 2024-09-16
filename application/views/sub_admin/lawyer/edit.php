<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>sub_admin/lawyer"> <i class="fa fa-sitemap" aria-hidden="true"></i>
                Lawyer</a>
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

                    <form role="form" id="member_form" action="<?php echo base_url() ?>sub_admin/lawyer/update"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name"> First Name</label>
                                        <input type="text" id="name" name="fname" class="form-control"
                                            placeholder="Enter first Name" value="<?php echo $edit_data->fname;?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name"> Last Name</label>
                                        <input type="text" id="name" name="lname" class="form-control"
                                            placeholder="Enter last Name" value="<?php echo $edit_data->lname;?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="text" id="name" name="email" class="form-control"
                                            placeholder="Enter email Name" value="<?php echo $edit_data->email;?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Lawyer ID</label>
                                        <input type="text" id="name" name="lawyer_unique_id" class="form-control"
                                            placeholder="Enter email Name"
                                            value="<?php echo $edit_data->lawyer_unique_id;?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Mobile</label>
                                        <input type="text" id="name" name="mobile" class="form-control"
                                            placeholder="Enter mobile Name" value="<?php echo $edit_data->mobile;?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">PIN</label>
                                        <input type="text" name="login_pin" class="form-control" placeholder="Enter PIN"
                                            minlength="4" maxlength="4" value="<?php echo $edit_data->login_pin;?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Experience</label>
                                        <input type="text" id="name" name="experience" class="form-control"
                                            placeholder="Enter password Name"
                                            value="<?php echo $edit_data->experience;?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Address</label>
                                        <input type="text" id="name" name="address" class="form-control"
                                            placeholder="Enter Father Name" value="<?php echo $edit_data->address;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="1" <?php echo ($edit_data->gender == 1)?'selected':''; ?>>
                                                Male</option>
                                            <option value="2" <?php echo ($edit_data->gender == 2)?'selected':''; ?>>
                                                Female</option>
                                            <option value="3" <?php echo ($edit_data->gender == 3)?'selected':''; ?>>
                                                Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Practice Area</label>
                                        <input type="text" id="name" name="practice_area" class="form-control"
                                            placeholder="Enter mobile Name"
                                            value="<?php echo $edit_data->practice_area;?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Bar Councle</label>
                                        <input type="text" id="name" name="bar_councle" class="form-control"
                                            placeholder="Enter password Name"
                                            value="<?php echo $edit_data->bar_councle;?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Enrolement No</label>
                                        <input type="text" id="name" name="enrolement_no" class="form-control"
                                            placeholder="Enter mobile Name"
                                            value="<?php echo $edit_data->enrolement_no;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="name">Joining date</label>
                                        <input type="text" id="name" name="dt" class="form-control" required="required"
                                            placeholder="Enter mobile Name"
                                            value="<?php echo date('d-m-Y h:i a',strtotime($edit_data->dt))?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="name">City</label>
                                        <input type="text" id="city" name="city" class="form-control"
                                            required="required" placeholder="Enter city Name"
                                            value="<?php echo $edit_data->city;?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
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
                                <div class="col-md-6 col-sm-12">
                                    <?php if(!empty($edit_data->category)) {?>

                                    <label for="password">Select Category <span class="text-muted">*</span></label>
                                    <?php $cat=json_decode($edit_data->category)?>

                                    <select id="select" class="selectbox category form-control" name="category[]"
                                        value="" data-placeholder="Select Category" multiple>
                                        <option value="">Select </option>
                                        <?php  foreach ($case_cat_data as $key => $value) { 
                                            ?>

                                        <option
                                            <?php  if(!empty($cat) && in_array($value->id, $cat)){echo 'selected';} ?>
                                            value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                        <?php  } } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Profile Image</label>
                                        <input type="file" id="name" name="image" class="form-control"
                                            placeholder="Enter mobile Name" value="<?php echo $edit_data->image; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Enrolment ID Image</label>
                                        <input type="file" id="name" name="enrol_image" class="form-control"
                                            placeholder="Enter mobile Name"
                                            value="<?php echo $edit_data->enrol_image; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>" />
                    <input type="hidden" name="oldimage1" value="<?php echo $edit_data->image; ?>" />
                    <input type="hidden" name="oldimage2" value="<?php echo $edit_data->enrol_image; ?>" />
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

//ajax call case sub cat name

$(document).ready(function() {

    // category change
    $('.category_id').click(function() {
        var val = $(this).val();
        // alert(val);
        // AJAX request
        $.ajax({
            url: '<?=base_url()?>sub_admin/lawyer/ajax_call_case_sub_cat_name',
            method: 'post',
            data: {
                id: val
            },
            dataType: 'json',
            success: function(response) {
                // alert(response);
                $('.case_sub_category').html('');
                // Add options
                $.each(response, function(index, data) {
                    $('.case_sub_category').append('<option value="' + data['id'] +
                        '">' + data['case_sub_category'] + '</option>');
                });
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    $('select').chosen();
});
</script>