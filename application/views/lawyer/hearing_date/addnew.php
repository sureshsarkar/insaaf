<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid ">
        <div class="for_Upk__list_lawyer">
            <a href="<?php echo base_url();?>admin/size"> <i class="fa fa-sitemap" aria-hidden="true"></i>  Hearing Date List </a>
            <small>Add New Hearing Date</small>
        </div>
      </div>
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
                  <h3 class="box-title">Add Hearing Date </h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" id="member_form" action="<?php echo base_url() ?>lawyer/Hearing_date/insertnow" method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                           <?php if(!empty($client_name)){ foreach($client_name as $client){ $client_n=$client->fname.''.$client->lname;}}?>
                              <label for="name">Client Name</label>
                              <input type="text" id="name" name ="client_id" value="<?php echo $client_n;?>" class="form-control" readonly >
                           </div>
                           <div class="form-group">
                              <label for="name">Hearing Date </label>
                              <input type="date" id="hearing_date" name ="hearing_date" class="form-control"  placeholder="Enter hearing_date" >
                           </div>
                           <div class="form-group">
                              <label for="name"> Time </label>
                              <input type="time" id="hearing_time" name ="hearing_time" class="form-control"  placeholder="Enter hearing Time" >
                           </div>
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
                  <div class="box-footer">
                  <?php if(!empty($case_detail)){ foreach($case_detail as $case){?>
                     <input type="text" class="hidden" name ="case_id"  value="<?=$case->id;?>" />
                     <input type="text" class="hidden" name ="case_cat_id"  value="<?=$case->case_category_id;?>" />
                     <input type="text" class="hidden" name ="case_sub_cat_id" value="<?=$case->case_sub_category_id;?>" />
                     <input type="text" class="hidden" name ="lawyer_id" value="<?=$case->asign_lawyer_id;?>" />
                     <input type="text" class="hidden" name ="client_id" value="<?=$case->client_id;?>" />
                    
                    <?php  }}?>
                    <input type="submit" class="btn btn-primary" value="Add " />
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
   CKEDITOR.replace( 'short_description' );
</script>
<script>
   CKEDITOR.replace( 'description' );
</script>
<script>
   $(document).ready(function(){
        //Chosen
   $(".multipleChosen").chosen({
     placeholder_text_multiple: "Select Size .." //placeholder
   });
   
       $("#video_file").change(function(){
          var id = "video_file";
           var max_size = 400000000;
           video_validation(id,max_size);
       });
   
   });
   
</script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>  
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