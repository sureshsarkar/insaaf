<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
      

         <a href="<?php echo base_url();?>admin/client"> <i class="fa fa-sitemap" aria-hidden="true"></i> Client</a>
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
            
            <!-- <?php pre($client_data);?> -->
               <form role="form" id="member_form" action="<?php echo base_url() ?>lawyer/Slot/update" method="post" role="form" enctype="multipart/form-data"> 
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name"> Client Name</label>
                              <input type="text" id="name" name ="client_id" class="form-control"  readonly="readonly" value="<?php echo $client_data->fname.' '.$client_data->lname; ?> " >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name"> Slot Date</label>
                              <input type="text" id="name" name ="slot_date" class="form-control" readonly="readonly"  value="<?php echo $edit_data->slot_date; ?>" >
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Time</label>
                              <input type="text" id="name" name ="time" class="form-control" readonly="readonly" value="<?php echo $edit_data->time; ?>" >
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Period</label>
                              <input type="text" id="name" name ="period" class="form-control" readonly="readonly" value="<?php echo $edit_data->period; ?>">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Contact Mode</label>
                              <select class ="form-control" name="contact_mode" id="contact_mode">
                                 <option value="Zoom Meeting" <?php echo ($edit_data->contact_mode == 'Zoom Meeting')?'selected':''; ?> >Zoom Meeting</option>
                               
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="status">Status</label>
                              <select class ="form-control" name="status" id="status">
                                 <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?> >Pending</option>
                                 <option value="1"  <?php echo ($edit_data->status == 1)?'selected':''; ?> >Approve</option>
                                 <option value="2" <?php echo ($edit_data->status == 2)?'selected':''; ?> >Decline</option>
                              </select>
                           </div>
                        </div>
                       
                     </div>
                      <div class="row">
                          <div class="col-md-4">
                           <div class="form-group">
                              <label for="name">Reply</label>
                              <input type="text" id="name" name ="reply" class="form-control" required="required" placeholder="Enter message to contact place" value="<?php echo $edit_data->reply; ?>">
                           </div>
                        </div>
                      </div>
                  </div>
            </div>
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
         <input type="hidden" name="id" value="<?php echo $edit_data->id;?>"/>
         <input type="hidden" name="client_email" value="<?php echo $client_data->email;?>"/>
         <input type="hidden" name="client_name" value="<?php echo $client_data->fname.' '.$client_data->fname;?>"/>
         <input type="hidden" id="name" name ="client_id"  value="<?php echo $edit_data->client_id; ?>"/>
         <input type="hidden" id="name" name ="lawyer_id"  value="<?php echo $edit_data->lawyer_id; ?>"/>
         <input type="hidden" id="name" name ="lawyer_name"  value="<?php echo $name;?>"/>
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
