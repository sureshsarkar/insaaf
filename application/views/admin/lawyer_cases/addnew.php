<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<style>
    .lawyer_value{
        display: none;
    }
</style>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/Case_details/"> <i class="fa fa-sitemap" aria-hidden="true"></i> Add New Case</a>
         <small>Add New Case</small>
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
                  <h3 class="box-title">Add New case</h3>
               </div>
               <!-- /.box-header -->
               <form role="form" id="member_form" action="<?php echo base_url()?>admin/case_details/insertnow" method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php if(!empty($case_category)) {?>
                              <label for="password">Case Category <span class="text-muted">*</span></label>
                              <select class ="form-control case_category_id" name="case_category_id" id="case_category_id">
                                  <option value="">Select Case Category</option>
                                 <?php  foreach ($case_category as $key => $value) {?>
                                 <option  value="<?=$value->id?>" ><?=$value->name?></option>
                                 <?php  } } ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <?php if(!empty($case_sub_category)) {?>
                              <label for="password">Case Sub Category <span class="text-muted">*</span></label>
                              <select class ="form-control sub_case_category_id" name="case_sub_category_id" id="sub_case_category_id">
                              <?php   } ?>
                              </select>
                           </div>
                           <div class="form-group">
                              <?php if(!empty($case_sub_category)) {?>
                              <label for="password">Lawyer <span class="text-muted">*</span></label>
                              <select class ="form-control lawyer_value" name="asign_lawyer_id"  id="lawyer">
                              </select>   
                                 <select class ="form-control lawyer"  data-toggle="modal" data-target="#exampleModalScrollable"  id="lawyer"></select>
                                 <!-- Modal -->
                                 <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                       <div class="modal-content" style="width:116%!important;">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalScrollableTitle">Assign Lawyer</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body row">
                                              <!-- lawter Details  -->
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- open lawyers model end  -->
                                 <?php   } ?>
                                 
                           </div>
                           <div class="form-group">
                                <label for="file">Caes File</label>
                                <input type="file" class="form-control" id="case_file" name ="case_file"  value="">
                           </div>
                           <div class="form-group">
                           <label for="status">Status</label>
                           <select class ="form-control" name="status" id="status">
                           <option value="1">Active</option>
                           <option value="0">Inactive</option>
                           </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="about">Case Descripton</label>
                              <textarea  rows="8" id="about" name ="case_description" class="form-control" placeholder="About Category" ></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <!-- Button trigger modal -->
         <!-- /.box-body -->
         <div class="box-footer">
         <input type="hidden" name="client_id" value="<?php echo $client_id; ?>"/>
         <!-- <input type="hidden" name="oldimage" value="<?php echo $client_id; ?>"/> -->
         <input type="submit" class="btn btn-primary" value="Add" />
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
<script type='text/javascript'>
   // baseURL variable
   var baseURL= "<?php echo base_url();?>";
   
   $(document).ready(function(){
   
     // City change
     $('.case_category_id').change(function(){
       var val = $(this).val();
   
       // AJAX request
       $.ajax({
         url:'<?=base_url()?>admin/Case_details/ajax_call_sub_cat_name',
         method: 'post',
         data: {id: val},
         dataType: 'json',
         success: function(response){
          
          $('.sub_case_category_id').html('');  
           // Add options
           $('.sub_case_category_id').append('<option  >Select case Sub Category</option>');
           $.each(response,function(index,data){
              $('.sub_case_category_id').append('<option value="'+data['id']+'">'+data['case_sub_category']+'</option>');
           });
         }
      });
    });
    $('.sub_case_category_id').change(function(){
       var val = $(this).val();
   
       // AJAX request
       $.ajax({
         url:'<?=base_url()?>admin/Case_details/ajax_call_lawyer',
         method: 'post',
         data: {id: val},
         dataType: 'json',
         success: function(response){
          console.log(response);
          $('.lawyer').html('');  
           // Add options
          $('.lawyer').append('<option  >Select Lawyer</option>');
           $.each(response,function(index,data){
            var fname=data['fname'];
            fname=fname.replace(/\s+/g, '');
            var lname=data['lname'];
            lname=lname.replace(/\s+/g, '');
            // option data  
            var fun="callthis('"+fname+"','"+lname+"',"+data['id']+")";
              $('.modal-body').append('<div class="card col-md-4" ><img class="card-img-top" onclick="'+fun+'" src="<?=base_url()?>uploads/lawyer/'+data['lawyer_img']+'" alt="'+data['fname']+''+data['lname']+'" width="150px"><div class="card-body" style="width:250px;"><h5 class="card-title"><b style="color:#16a085;">'+data['fname']+' '+data['lname']+'</b></h5><p class="card-text"><b>Expericen:-</b>' +data['experience']+'<br><b>Email:-</b> '+data['email']+'<br><b>Practice Area:-</b>' +data['practice_area']+'.</p> <a onclick="'+fun+'"  class="btn btn-primary">Assign Lawyer</a></div></div>');
           });
         }
      });
    });
   });
</script>
<script>
   function callthis(fname,lname,id){
       $('.fade').css('display','none');
       $('.lawyer_value').css('display','block');
       $('.lawyer_value').append('<option value="'+id+'">'+fname+' '+lname+'</option>');
       $('.lawyer').css('display','none');
      //  $('.modal').css('display','none');
       
   }
</script>
<!-- open lawyers model start  -->