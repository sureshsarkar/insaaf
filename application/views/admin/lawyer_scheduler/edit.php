<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
      

         <a href="<?php echo base_url();?>admin/Hearing_list"> <i class="fa fa-sitemap" aria-hidden="true"></i> Hearting </a>
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
               <form role="form" id="member_form" action="<?php echo base_url() ?>admin/Lawyer_scheduler/update" method="post" role="form"> 
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Date</label>
                              <input type="date" id="name" name ="schedule_date" class="form-control"  value="<?php echo $schedule_detail->schedule_date; ?>" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Time</label>
                              <input type="text" id="name" name ="schedule_time" class="form-control"  value="<?php echo $schedule_detail->schedule_time; ?>" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Status</label>
                              <select name="schedule_status" id=""value="" class="form-control">
                              <option value="0" <?php echo ($schedule_detail->schedule_status == 0)?'selected':''; ?> >Pending</option>
                                 <option value="1"  <?php echo ($schedule_detail->schedule_status == 1)?'selected':''; ?> >Active</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <div class="box-footer">
         <input type="hidden" name="id"  value="<?php echo $schedule_detail->id;?>"/>
         <input type="hidden" name="lawyer_id"  value="<?php echo $schedule_detail->lawyer_id;?>"/>
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
