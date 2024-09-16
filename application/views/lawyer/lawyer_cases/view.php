<style>
.overFlow {
    overflow-y: clip;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid ">
            <div class="for_Upk__list_lawyer">

                <a href="<?php echo base_url();?>lawyer/cases"> <i class="bi bi-bookmark-check"
                        aria-hidden="true"></i>All case list</a>
                <small>View Case Details</small>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <!-- <div class="form-group">
                    <a class="btn btn-primary"
                        href="<?php echo base_url(); ?>lawyer/hearing_date/Complane/<?=$case_id?>"><i
                            class="fa fa-plus"></i>Contact Admin</a>
                </div> -->
                <!-- <div class="form-group">
                    <a class="btn btn-primary"
                        href="<?php echo base_url(); ?>lawyer/hearing_date/addnew/<?=$case_id?>"><i
                            class="fa fa-plus"></i> Add Next Date of Hearing </a>
                </div>
                <div class="form-group">
                    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#exampleModal11"><i
                            class="fa fa-plus"></i> Add Case document</a>
                </div> -->
            </div>
        </div>

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
                <div class="box box-primary p-3">
                    <div class="box-header">
                    </div>
                    <!-- form start -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="hidden" name="id" value="<?php echo $view_data->id; ?>" />
                                <div class="form-group">
                                    <label for="name"> Case Category</label>
                                    <input type="text" name="fname" class="form-control" placeholder="Enter first Name"
                                        value="<?php echo $case_cat_name1->name; ?> ">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="name">Client Name</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter email Name"
                                        value="<?php echo $client_name->fname.' '.$client_name->lname; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="name">Client Code</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter email Name"
                                        value="<?php echo $client_name->client_unique_id?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" name="dt" class="form-control" placeholder="Enter mobile Name"
                                        value="<?php echo ($view_data->status==1)?'Active':'Inactive'; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="name">Date </label>
                                    <input type="text" name="dt" class="form-control" placeholder="Enter mobile Name"
                                        value="<?php echo $view_data->dt; ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="name">Case Description</label>
                                    <textarea type="text" name="mobile" class="w-100 overFlow"
                                        value=""><?php echo $view_data->case_description; ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <?php if(!empty($view_data->case_file)){?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Case Document</label><br>
                                <?php $image_data=explode(',', $view_data->case_file);
                                            foreach($image_data as $image){
                                                $client_img=$image;
                                                $file=explode('.', $client_img);
                                                // pre($file[1]);
                                                if($file[1]=='mp3'){
                                                ?>
                                <a class="btn btn-sm btn-info " style="margin-top:2px;"
                                    href="<?php echo base_url('uploads/cases/').$client_img; ?>" target="_blank"
                                    title="mp3" co><i class="fa fa-play"><img
                                            src1="<?php echo base_url('uploads/cases/').$client_img; ?>" width="30px;"
                                            alt=""></i></a>
                                <?php }elseif($file[1]=='mp4'){ ?>
                                <a class="btn btn-sm btn-info " style="margin-top:2px;"
                                    href="<?php echo base_url('uploads/cases/').$client_img; ?>" target="_blank"
                                    title="mp4" co><i class="fa fa-play-circle-o" style="font-size:20px;"><img
                                            src1="<?php echo base_url('uploads/cases/').$client_img; ?>" width="30px;"
                                            alt=""></i></a>
                                <?php }else{ 
                                        ?>
                                <a class="btn btn-sm btn-info " style="margin-top:2px;"
                                    href="<?php echo base_url('uploads/cases/').$client_img; ?>" target="_blank"
                                    title="view" co><i class="fa fa-eye"><img
                                            src1="<?php echo base_url('uploads/cases/').$client_img; ?>" width="30px;"
                                            alt=""></i></a>
                                <?php }}?>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>

</div>
</section>
</div>

<!-- model for send document start -->
<div class="modal fade" id="exampleModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <form role="form" action="<?php echo base_url() ?>lawyer/cases/send_case_document" method="post"
                    enctype='multipart/form-data'>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Document</label>
                        <input type="file" class="form-control" id="document" name="case_file">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="client_Id" value="<?php echo $view_data->client_id?>">
                        <input type="hidden" name="client_name"
                            value="<?php echo $client_name->fname.' '.$client_name->lname; ?>">
                        <input type="hidden" name="client_email" value="<?php echo $client_name->email; ?>">
                        <input type="hidden" name="client_mobile" value="<?php echo $client_name->mobile; ?>">
                        <input type="hidden" name="case_Id" value="<?php echo $view_data->id?>">
                        <input type="hidden" name="lawyer_Id" value="<?php echo $view_data->asign_lawyer_id?>">
                        <input type="hidden" name="lawyer_name" value="<?php echo $_SESSION['name']; ?>">
                        <input type="hidden" name="lawyer_email" value="<?php echo $_SESSION['email']; ?>">
                        <input type="hidden" name="lawyer_mobile" value="<?php echo $_SESSION['phone']; ?>">
                        <input type="hidden" name="old_case_file" value="<?php echo $view_data->case_file?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Query</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- model for send document end  -->

<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>

<script>
$(".delete_old_image").click(function() {
    $("#old_img_con").addClass('hidden');
    $(".color_img").addClass('hidden');
    $("#old_image").val('');
});
</script>