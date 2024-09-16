<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/Case_details/index/<?=$edit_data->client_id;?>"> <i class="fa fa-sitemap" aria-hidden="true"></i> Case Details </a>
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
               <?php
                  foreach ($lawyer_name as $key => $value) 
                  {
                   if($value->id==$edit_data->asign_lawyer_id){
                      $lawyer_name_data= $value->fname.' '.$value->lname;
                     }
                  }
                   ?>        
               <form role="form" id="member_form" action="<?php echo base_url()?>admin/Lawyer_cases/update" method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php if(!empty($case_category)) {?>
                              <label for="password">Case Category <span class="text-muted">*</span></label>
                              <select class ="form-control case_category" name="case_category_id" id="case_category">
                                 <?php  foreach ($case_category as $key => $value) {?>
                                 <option <?php if($edit_data->case_category_id==$value->id){echo " selected";}else{echo "";} ?> value="<?=$value->id?>" ><?=$value->name?></option>
                                 <?php  } } ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <?php if(!empty($case_sub_category)) {?>
                              <label for="password">Case Sub Category <span class="text-muted">*</span></label>
                              <select class ="form-control case_sub_category" name="case_sub_category_id" id="case_sub_category">
                                 <?php  foreach ($case_sub_category as $key => $value) {?>
                                 <option value="<?=$value->id?>" <?php if($edit_data->case_sub_category_id==$value->id){echo " selected";}else{echo "";} ?>><?=$value->case_sub_category?></option>
                                 <?php  } } ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="slug">Lawyer</label>
                              <select class ="form-control lawyer_detail" name="asign_lawyer_id" id="lawyer_detail">
                              <?php if(!empty($lawyer_name)) {?>
                                 <?php  foreach ($lawyer_name as $key => $lawyer_value) {?>
                                 <option value="<?=$lawyer_value->id?>" <?php if($edit_data->asign_lawyer_id==$lawyer_value->id){echo " selected";}else{echo "";} ?>><?=$lawyer_value->fname.' '.$lawyer_value->lname;?></option>
                                 <?php  } } ?>
                              </select>
                              <!-- <input type="text" id="slug" name ="asign_lawyer_id" class="form-control"  placeholder="Lawyer Name"  value="<?php echo $lawyer_name_data ?>"> -->
                           </div>
                           <div class="form-group">
                              <label for="file">Caes File</label>
                              <input type="file" id="case_file" name ="case_file" class="form-control"    value="<?php echo $edit_data->case_file; ?>">
                           </div>
                           <div class="form-group">
                              <label for="status">Status</label>
                              <select class ="form-control" name="status" id="status">
                                 <option value="1" <?php echo ($edit_data->status == 1)?'selected':''; ?> >Active</option>
                                 <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?> >Inactive</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <!-- About  -->
                           <div class="form-group">
                              <label for="about">Case Descripton</label>
                              <textarea  rows="8" id="about" name ="case_description" class="form-control" placeholder="About Category" ><?php echo $edit_data->case_description; ?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
         <input type="hidden" name="client_id" value="<?php echo $edit_data->client_id; ?>"/>
         <input type="hidden" name="oldimage" value="<?php echo $edit_data->case_file; ?>"/>
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
<script>
   $(".delete_old_image").click(function(){
   	$("#old_img_con").addClass('hidden');
          $(".color_img").addClass('hidden');
   	$("#old_image").val('');
   });
</script>
<script>
   $(document).ready(function(){
   
   // City change
   $('.case_category').change(function(){
   var val = $(this).val();
   // alert(val);
   // AJAX request
   $.ajax({
   url:'<?=base_url()?>admin/Case_details/ajax_call_case_sub_cat_name',
   method: 'post',
   data: {id: val},
   dataType: 'json',
   success: function(response){
    
    $('.case_sub_category').html('');  
     // Add options
     $.each(response,function(index,data){
        $('.case_sub_category').append('<option value="'+data['id']+'">'+data['case_sub_category']+'</option>');
     });
   }
   });
   });
   });
</script>

<script>
   $(document).ready(function(){
   
   // City change
   $('.case_sub_category').click(function(){
   var val = $(this).val();
   // alert(val);
   // AJAX request
   $.ajax({
   url:'<?=base_url()?>admin/Case_details/ajax_call_lawyer_name',
   method: 'post',
   data: {id: val},
   dataType: 'json',
   success: function(response){
   //  console.log(response);
    $('.lawyer_detail').html('');  
     // Add options
     $.each(response,function(index,data){
        $('.lawyer_detail').append('<option value="'+data['id']+'">'+data['fname']+' '+data['fname']+' </option>');
     });
   }
   });
   });
   });
</script>