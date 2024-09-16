<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/case_category"> <i class="fa fa-sitemap" aria-hidden="true"></i> Case Category</a>
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
             

               <form role="form" id="member_form" action="<?php echo base_url() ?>admin/case_category/update" method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-3">
                           <!--name-->                             
                           <div class="form-group">
                              <label for="name">Case Category</label>
                              <input type="text" id="name" name ="name" class="form-control" value="<?php echo $edit_data->name; ?>" >
                           </div>
                        </div>
                        <div class="col-md-3">
                           <!--name-->                             
                           <div class="form-group">
                              <label for="name">Case Category in Hindi</label>
                              <input type="text" id="name" name ="name_hi" class="form-control" value="<?php echo $edit_data->name_hi; ?>" >
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="row">
                              <div class="col-md-3">
                                 <!--  Price--> 
                                 <div class="form-group">
                                    <label for="number">  Total Amount: </label>
                                    <input type="text" id="total_amount" name ="total_amount" class="form-control" required="required" placeholder="Enter Category Name" value="<?php echo $edit_data->total_amount; ?>" >
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <!--  Price--> 
                                 <div class="form-group">
                                    <label for="number">  Owner ( % )</label>
                                    <input type="number" id="owner_percentage" name="owner_percentage" class="form-control " required="required"  value="<?php echo $edit_data->owner_percentage; ?>">
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <!-- Regular Price--> 
                                 <div class="form-group">
                                    <label for="number"> Owner Amount</label>
                                    <input type="number" id="owner_amount" name="owner_amount"  readonly class="form-control " required="required" value="<?php echo $edit_data->owner_amount; ?>" >
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <!-- Regular Price--> 
                                 <div class="form-group">
                                    <label for="number"> Lawyer Amount</label>
                                    <input type="number" id="lawyer_amount" name="lawyer_amount"  readonly class="form-control " required="required" value="<?php echo $edit_data->lawyer_amount; ?>">
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <!-- Regular Price--> 
                                 <div class="form-group">
                                    <label for="number">GST %</label>
                                    <input type="number" id="gst" name="gst"   class="form-control " required="required" value="<?php echo $edit_data->gst; ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
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
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="slug">Slug</label>
                              <input type="text" id="slug" name ="slug_url" class="form-control" required="required" value="<?php echo $edit_data->slug_url?>" >
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <!-- About  -->
                     <div class="form-group">
                        <label for="about">About Case Category</label>
                        <textarea  rows="8" id="about" name ="about" class="form-control" value="<?php echo $edit_data->about?>" ></textarea>
                     </div>
                  </div>
            </div>
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
         <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>"/>
         <input type="hidden" id="gst_amount" name="gst_amount" value=""/>
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
          $(".category_img").addClass('hidden');
   	$("#old_image").val('');
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
  
        $("#total_amount,#owner_percentage,#gst,#name").keyup(function(){
           
            var total = $("#total_amount").val();
            var percentage = $("#owner_percentage").val();
            var gst = $("#gst").val();
            if(total_amount!='' || percentage!=''){
              
                var owrer_amount=total*percentage/100
                var gst_amount=total*gst/100
                var lawyer_amount=total-owrer_amount;
                 $("#owner_amount").val(owrer_amount)
                 $("#lawyer_amount").val(lawyer_amount)
                 $("#gst_amount").val(gst_amount)
                
        
            }
        });

</script>


