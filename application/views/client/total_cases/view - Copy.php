<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>client/Dashboard/total_cases/<?=base64_encode($_SESSION['id'])?>"> <i class="fa fa-sitemap" aria-hidden="true"></i> Cases</a>
            <small>Edit</small>
        </h1>
    </section>
    <section class="content">
        <!-- <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">

                    <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal11"><i
                            class="fa fa-plus"></i>Add New File</a>
                </div>
            </div>
        </div> -->

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
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/size/update" method="post"
                        role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Case Category</label>
                                        <input type="text" id="name" name="fname" class="form-control"
                                            required="required" placeholder="Enter first Name"
                                            value="<?php echo $Categoryname; ?> ">
                                    </div>
                                </div>
                             
                                <?php if(!empty($lawyer_name)){?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Lawyer Name</label>
                                        <input type="text" id="name" name="email" class="form-control"
                                            required="required" placeholder="Enter email Name"
                                            value="<?php echo $lawyer_name; ?>">
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1" <?php echo ($view_data->status == 1)?'selected':''; ?>>
                                                Active</option>
                                            <option value="0" <?php echo ($view_data->status == 0)?'selected':''; ?>>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Case File</label><br>
                                        <?php if(!empty($view_data->case_file)){?>
                                        <button type="button" class="btn btn-primary "> <a
                                                href="<?php echo base_url('uploads/cases/').$view_data->case_file; ?>"
                                                target="_blank" title="view"><img
                                                    src1="<?php echo base_url('uploads/cases/').$view_data->case_file; ?>"
                                                    width="30px;" alt=""></a></button>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="id" value="<?php echo $view_data->id; ?>" />
                </div>
                </form>
            </div>
        </div>
</div>


<!-- model for send document start -->
<div class="modal fade" id="exampleModal1111" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form role="form" action="<?php echo base_url() ?>client/Client/Send_document" method="post"
                    enctype='multipart/form-data'>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Document</label>
                        <input type="file" class="form-control" id="document" name="case_file"
                            placeholder="Enter email">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="client_Id" value="<?php echo $_SESSION['id']?>">
                        <input type="hidden" name="client_name" value="<?php echo $_SESSION['name']?>">
                        <input type="hidden" name="client_email" value="<?php echo $_SESSION['email']?>">
                        <input type="hidden" name="client_phone" value="<?php echo $_SESSION['phone']?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Query</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- model for send document end  -->

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