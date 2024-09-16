<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
      

         <a href="<?php echo base_url();?>lawyer/Hearing_date/index/<?php echo $edit_data->lawyer_id;?>"> <i class="fa fa-sitemap" aria-hidden="true"></i> Hearing</a>
      
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
         <div class="col-md-12">  
            <div class="box box-primary">
               <div class="box-header">
               </div>
               <form role="form" id="member_form" action="<?php echo base_url() ?>lawyer/Hearing_date/update" method="post" role="form" enctype="multipart/form-data"> 
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name"> Client Name</label>
                              <input type="text" id="client_id"  class="form-control"  readonly="readonly" value="<?php echo $client_name->fname.' '.$client_name->lname; ?> " >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name"> Hearing Date</label>
                              <input type="date" id="hearing_date" name ="hearing_date" class="form-control"   value="<?php echo $edit_data->hearing_date; ?>" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Hearing Time</label>
                              <input type="time" id="hearing_time" name ="hearing_time" class="form-control"  value="<?php echo $edit_data->hearing_time; ?>" >
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="status">Status</label>
                              <select class ="form-control" name="status" id="status">
                                 <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?> >Pending</option>
                                 <option value="1"  <?php echo ($edit_data->status == 1)?'selected':''; ?> >Active</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
         <input type="hidden" name="id" value="<?php echo $edit_data->id;?>"/>
         <input type="hidden" name="lawyer_id" value="<?php echo $edit_data->lawyer_id;?>"/>
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
