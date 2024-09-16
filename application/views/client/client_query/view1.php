<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a
                href="<?php echo base_url();?>client/Client_query/select_lawyer_query/<?php echo base64_encode($view_data->user_id);?>">
                <i class="fa fa-sitemap" aria-hidden="true"></i>Your Query </a>
            <small>view</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">

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

                    <div class="box-body">
                        <div class="row">
                            <?php if(!empty($case_cat_name)){ ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name"> Case Category Name </label>
                                    <input type="text" id="name" name="fname" class="form-control" readonly="readonly"
                                        value="<?php echo $case_cat_name->name; ?>">
                                </div>
                            </div>
                            <?php }?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name"> Your Query </label>
                                    <textarea type="text" id="name" name="fname" class="form-control"
                                        readonly="readonly" placeholder="Enter first Name"
                                        value=""><?php echo $view_data->query; ?> </textarea>
                                </div>
                            </div>

                            <?php if(!empty($view_data->querry_file)){?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Case Document</label></br>
                                    <a class="btn btn-sm btn-info"
                                        href="<?php echo base_url('uploads/cases/').$view_data->querry_file; ?>"
                                        target="_blank" title="view" co><i class="fa fa-eye"><img
                                                src1="<?php echo base_url('uploads/cases/').$view_data->querry_file; ?>"
                                                width="30px;" alt=""></i></a>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Your  Query Solution</label>
                                    <?php if(!empty($view_data->q_solution)){?>
                                    <textarea type="text" id="name" name="fname" class="form-control"
                                        readonly="readonly" placeholder="Enter first Name"
                                        value=""><?php echo $view_data->q_solution; ?></textarea>
                                    <?php }else{?>
                                        <textarea type="text" id="name" name="fname" class="form-control"
                                        readonly="readonly" placeholder="Enter first Name"
                                        value=""></textarea>
                                        <?php }?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="id" value="<?php echo $view_data->id; ?>" />

                </div>
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