<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/category"> <i class="fa fa-sitemap" aria-hidden="true"></i> Sub Category</a>
         <small>Add New Sub Category</small>
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
                  <h3 class="box-title">Add New Sub Category</h3>
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" id="member_form" action="<?php echo base_url() ?>admin/sub_category/insertnow" method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-6">
                           <?php if(!empty($category)) {?>
                              <div class="form-group">
                                <label for="status">Category Name </label>
                                <select class ="form-control" name="category_id" id="parent_id">
                                    <option value="" >Select </option>
                                    <?php  foreach ($category as $key => $value) {?>
                                    <option value="<?=$value->id?>"><?=$value->name?></option>
                                    <?php   } ?>
                                </select>
                             </div>
                           <?php }?>                          
                           <div class="form-group">
                              <label for="name">Sub Category</label>
                              <input type="text" id="name" name ="sub_category" class="form-control" required="required"  placeholder="Enter Sub Category Name" >
                           </div>
                           <div class="form-group">
                              <label for="status">Status</label>
                              <select class ="form-control" name="status" id="status">
                                 <option value="1">Active</option>
                                 <option value="0">Inactive</option>
                              </select>
                           </div>
                           <!--name-->                             
                           <div class="form-group">
                              <label for="slug">Slug</label>
                              <input type="text" id="slug" name ="slug_url" class="form-control" required="required" placeholder="Slug" >
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.box-body -->
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
<script>
   CKEDITOR.replace( 'about' , {
     height: 250,
     extraPlugins: 'colorbutton,colordialog',
     removeButtons: 'PasteFromWord'
   } );
</script>
<script>
   $(document).ready(function(){
       $("#video_file").change(function(){
          var id = "video_file";
           var max_size = 400000000;
           video_validation(id,max_size);
       });
   
   });
   
</script>
<script type="text/javascript">
   $(document).ready(function(){
       $("#name").keyup(function(){
           var text = $(this).val();
          var slug_text =  convertToSlug(text);
           $("#slug").val(slug_text);
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