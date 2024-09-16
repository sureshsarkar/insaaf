<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<style type="text/css">
    .hide{display: none;}
</style> 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <a href="<?php echo base_url();?>admin/sub_admin"> <i class="fa fa-sitemap" aria-hidden="true"></i> Sub Admin</a>
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
                       
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                   <form role="form" id="member_form" action="<?php echo base_url() ?>admin/sub_admin/update" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                        <div class="row">
                        <div class="col-md-6">
                           <label for="firstName">First name <span class="text-muted">*</span></label>
                           <input type="text" class="form-control new_control" maxlength="25" id="firstName" placeholder="" name="fname" value="<?php echo $edit_data->fname; ?>" required="">
                           <div class="invalid-feedback">
                       
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label for="lastName">Last name</label>
                           <input type="text" class="form-control new_control" maxlength="25" name="lname" id="lastName" placeholder="" value="<?php echo $edit_data->lname; ?>" required="">
                           <div class="invalid-feedback">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <label for="email">Email <span class="text-muted">*</span></label>
                           <input type="email" class="form-control new_control" maxlength="128" name="email" id="email" value="<?php echo $edit_data->email; ?>" required="required">
                           <div class="invalid-feedback">
                           
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label for="mobile">Mobile <span class="text-muted">*</span></label>
                           <input type="text" class="form-control new_control" maxlength="10" id="mobile" name="mobile" value="<?php echo $edit_data->mobile;?>" required="">
                           <div class="invalid-feedback">
                          
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <label for="password">Password <span class="text-muted">*</span></label>
                           <input type="password" class="form-control new_control" maxlength="255" name="password" id="password" value="<?php echo $edit_data->password; ?>" required="required">
                           <div class="invalid-feedback">
                           
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="status">Status</label>
                              <select class ="form-control" name="status" id="status">
                              <option value="1" <?php echo ($edit_data->status == 1)?'selected':''; ?> >Active</option>
                                 <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?> >Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                            
                             
                             
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>"/>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/color_code.js"></script> 
<script>
    $(document).ready(function(){
        $(".colorcode_default").click(function(){
            $(".colorcode_default").addClass('hide');
            $(".dynamic").removeClass('hide');
        });
    });
	$(".delete_old_image").click(function(){
		$("#old_img_con").addClass('hidden');
        $(".color_img").addClass('hidden');
		$("#old_image").val('');
	});
</script>
