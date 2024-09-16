<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/sub_admin"> <i class="fa fa-sitemap" aria-hidden="true"></i> Sub Admin</a>
         <small>Add New Sub Admin</small>
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
                  <h3 class="box-title">Add New Sub Admin</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" id="member_form" action="<?php echo base_url() ?>admin/sub_admin/insertnow" method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-6">
                           <label for="firstName">First name <span class="text-muted">*</span></label>
                           <input type="text" class="form-control new_control" maxlength="25" id="firstName" placeholder="" name="fname" value="" required="">
                           <div class="invalid-feedback">
                              Valid first name is required.
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label for="lastName">Last name</label>
                           <input type="text" class="form-control new_control" maxlength="25" name="lname" id="lastName" placeholder="" value="" required="">
                           <div class="invalid-feedback">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <label for="email">Email <span class="text-muted">*</span></label>
                           <input type="email" class="form-control new_control" maxlength="128" name="email" id="email" value="" required="required">
                           <div class="invalid-feedback">
                              Please enter a valid email address for shipping updates.
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label for="mobile">Mobile <span class="text-muted">*</span></label>
                           <input type="text" class="form-control new_control" maxlength="10" id="mobile" name="mobile" value="" required="">
                           <div class="invalid-feedback">
                              Please Enter valid mobile number
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <label for="password">Password <span class="text-muted">*</span></label>
                           <input type="password" class="form-control new_control" maxlength="255" name="password" id="password" value="" required="required">
                           <div class="invalid-feedback">
                              Please enter a valid password address for shipping updates.
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="status">Status</label>
                              <select class ="form-control" name="status" id="status">
                                 <option value="1">Active</option>
                                 <option value="0">Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.box-body -->
            </div>
            <div class="box-footer">
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/color_code.js"></script> 
<script>
   $(document).ready(function(){
       $("#video_file").change(function(){
          var id = "video_file";
           var max_size = 400000000;
           video_validation(id,max_size);
       });
   
   });
   
</script>
<script>
   // Function Video Validation
   
   function video_validation(id,max_size)
   {
       var fuData = document.getElementById(id);
       var FileUploadPath = fuData.value;
       
   
       if (FileUploadPath == ''){
           alert("Please upload Video");
       } 
       else {
           var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
           if (Extension == "mp4" || Extension == "mov" || Extension == "flv"|| Extension == "avi"|| Extension == "3gp") {
   
                   if (fuData.files && fuData.files[0]) {
                       var size = fuData.files[0].size;
                       
                       if(size > max_size){   //1000000 = 1 mb
                           alert("Maximum file size 50 MB");
                           $("#"+id).val('');
                           return;
                       }
                   }
   
           } 
           else 
           {
               alert("Video only allows file types of mp4, mov, flv, avi, 3gp , 3gpp");
               $("#"+id).val('');
           }
       }   
   }   
   
</script>