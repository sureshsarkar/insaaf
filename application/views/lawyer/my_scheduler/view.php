<style>
        ._size{
        padding-left:30px;
        font-size:24px;
    }
    ._size24{
    
    font-size:20px;
    }
</style>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>lawyer/My_scheduler/index/<?=base64_encode($view_data->lawyer_id)?>"> <i class="fa fa-sitemap" aria-hidden="true"></i> Scheduler List</a>
            <small>View</small>
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
                    <?php if(!empty($view_data)){?>
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/Slot_list/update"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="_size24"> Schedule Date</label>
                                        <input type="text" id="name" name="schedule_date" class="form-control"
                                            readonly="readonly"
                                            value="<?php echo $view_data->schedule_date;?> ">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="_size24" > Schedule Status</label>
                                        <select class="form-control" readonly="readonly" name="schedule_status" id="status">
                                            <option value="0" <?php echo ($view_data->schedule_status == 0)?'selected':''; ?>>
                                                Pending</option>
                                            <option value="1" <?php echo ($view_data->schedule_status == 1)?'selected':''; ?>>
                                                Active</option>
                                        </select>

                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $da= json_decode( $view_data->schedule_time);?>
                                    <div class="form-group">
                                        <label for="name" class="_size24"> Selected Schedule Time</label><br>
                                        <?php foreach($da as $time){?>
                                        <input type="checkbox"   value=" " <?php echo ($time !=='')?'checked':''; ?>><span class="_size"><?php echo $time;?></span><br>
                                         <?php }?>       
                                    </div>

                                </div>
                            </div>
                        </div>
                </div>
            </div>
            </form>
            <?php }?>
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