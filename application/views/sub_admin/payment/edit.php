<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>sub_admin/client"> <i class="fa fa-sitemap" aria-hidden="true"></i> Client</a>
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
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" id="member_form" action="<?php echo base_url() ?>sub_admin/client/update" method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name"> First Name</label>
                              <input type="text" id="name" name ="fname" class="form-control" required="required" placeholder="Enter first Name" value="<?php echo $edit_data->fname; ?> " >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name"> Last Name</label>
                              <input type="text" id="name" name ="lname" class="form-control" required="required" placeholder="Enter last Name" value="<?php echo $edit_data->lname; ?>" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Email</label>
                              <input type="text" id="name" name ="email" class="form-control" required="required" placeholder="Enter email Name" value="<?php echo $edit_data->email; ?>" >
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Mobile</label>
                              <input type="text" id="name" name ="mobile" class="form-control" required="required" placeholder="Enter mobile Name" value="<?php echo $edit_data->mobile; ?>" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Case file</label>
                              <input type="file" id="case_file" name ="case_file" class="form-control" placeholder="Enter Father Name" value="<?php echo $edit_data->case_file; ?>" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="status">Joining Date</label>
                              <input type="text" id="name" name ="dt" class="form-control" required="required" placeholder="Joining date" value="<?php echo $edit_data->dt; ?>" >	
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="status">Status</label>
                              <select class ="form-control" name="status" id="status">
                                 <option value="1" <?php echo ($edit_data->status == 1)?'selected':''; ?> >Active</option>
                                 <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?> >Inactive</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                           <?php if(!empty($category)) {?>
                           <label for="password">Case Category <span class="text-muted">*</span></label>
                           <select class ="form-control" name="case_type" id="category">
                              <?php  foreach ($category as $key => $value) {?>
                              <option value="<?=$value->id?>" <?php if($edit_data->case_type==$value->id){echo " selected";}else{echo "";} ?>><?=$value->name?></option>
                              <?php  } } ?>
                           </select>
                        </div>
                        <div class="col-md-4 col-sm-12">
                           <?php if(!empty($sub_category)) {?>
                           <label for="password">Case Sub Category <span class="text-muted">*</span></label>
                           <select class ="form-control" name="case_sub_type_id" id="category">
                              <?php  foreach ($sub_category as $key => $value) {?>
                              <option value="<?=$value->id?>" <?php if($edit_data->case_sub_type_id==$value->id){echo " selected";}else{echo "";} ?>><?=$value->case_sub_category?></option>
                              <?php  } } ?>
                           </select>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Message</label>
                              <textarea type="text" id="name" name ="message" class="form-control" required="required" placeholder="Enter password Name" value="<?php echo $edit_data->message; ?>"><?php echo $edit_data->message; ?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
         <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>"/>
         <input type="hidden" name="oldimage" value="<?php echo $edit_data->case_file; ?>"/>
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
   $(".delete_old_image").click(function(){
   	$("#old_img_con").addClass('hidden');
          $(".color_img").addClass('hidden');
   	$("#old_image").val('');
   });
</script>