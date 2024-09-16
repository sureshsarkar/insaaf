<style>
 .schedule_time{
    font-size: 25px;
    padding-left: 20px;
  }
 ._size{
    padding-left:30px;
    font-size:24px;
  }
 ._size1{
    padding-left:30px;
    padding-right:30px;
    font-size:24px;
  }
 ._size24{
   
    font-size:20px;
  }
  ._other_time{
width:300px;
margin-left:44px;
margin-top:-20px;"
  }
</style>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
      

         <a href="<?php echo base_url();?>lawyer/My_scheduler/index/<?=base64_encode($schedule_detail->lawyer_id);?>"> <i class="fa fa-sitemap" aria-hidden="true"></i> Scheduler List </a>
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
               <form role="form" id="member_form" action="<?php echo base_url() ?>lawyer/My_scheduler/update" method="post" role="form"> 
                  <div class="box-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="name" class="_size24">Date</label>
                              <input type="text" name ="schedule_date" class="form-control"  value="<?php echo $schedule_detail->schedule_date;?>" >
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="name" class="_size24">Status</label>
                              <select name="schedule_status" id=""value="" class="form-control">
                              <option value="0" <?php echo ($schedule_detail->schedule_status == 0)?'selected':''; ?> >Inactive</option>
                                 <option value="1"  <?php echo ($schedule_detail->schedule_status == 1)?'selected':''; ?> >Active</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <?php $da= json_decode($schedule_detail->schedule_time); $c= count($da); $t=$c-1;?>
                                 <label for="name" class="_size24"> Selected Schedule Time</label><br>
                                 <input type="checkbox" value="09:00 am" name="schedule_time[]" <?php if(in_array('09:00 am',$da)){echo "checked"; }?>> <span  class="_size">09:00 am <span  class="_size1">to</span> 10:00 am </span><br>
                                 <input type="checkbox" value="10:00 am" name="schedule_time[]" <?php if(in_array('10:00 am',$da)){echo "checked"; }?>> <span  class="_size">10:00 am <span  class="_size1">to</span> 11:00 am </span><br>
                                 <input type="checkbox" value="11:00 am" name="schedule_time[]" <?php if(in_array('11:00 am',$da)){echo "checked"; }?>> <span  class="_size">11:00 am <span  class="_size1">to</span> 12:00 pm </span><br>
                                 <input type="checkbox" value="12:00 pm" name="schedule_time[]" <?php if(in_array('12:00 pm',$da)){echo "checked"; }?>> <span  class="_size">12:00 pm <span  class="_size1">to</span> 01:00 pm </span><br>
                                 <input type="checkbox" value="01:00 pm" name="schedule_time[]" <?php if(in_array('01:00 pm',$da)){echo "checked"; }?>> <span  class="_size">01:00 pm <span  class="_size1">to</span> 02:00 pm </span><br>
                                 <input type="checkbox" value="02:00 pm" name="schedule_time[]" <?php if(in_array('02:00 pm',$da)){echo "checked"; }?>> <span  class="_size">02:00 pm <span  class="_size1">to</span> 03:00 pm </span><br>
                                 <input type="checkbox" value="03:00 pm" name="schedule_time[]" <?php if(in_array('03:00 pm',$da)){echo "checked"; }?>> <span  class="_size">03:00 pm <span  class="_size1">to</span> 04:00 pm </span><br>
                                 <input type="checkbox" value="04:00 pm" name="schedule_time[]" <?php if(in_array('04:00 pm',$da)){echo "checked"; }?>> <span  class="_size">04:00 pm <span  class="_size1">to</span> 05:00 pm </span><br>
                                 <input type="checkbox" value="05:00 pm" name="schedule_time[]" <?php if(in_array('05:00 pm',$da)){echo "checked"; }?>> <span  class="_size">05:00 pm <span  class="_size1">to</span> 06:00 pm </span><br>
                                 <input type="checkbox" value="06:00 pm" name="schedule_time[]" <?php if(in_array('06:00 pm',$da)){echo "checked"; }?>> <span  class="_size">06:00 pm <span  class="_size1">to</span> 07:00 pm </span><br>
                                 <input type="checkbox" value="07:00 pm" name="schedule_time[]" <?php if(in_array('07:00 pm',$da)){echo "checked"; }?>> <span  class="_size">07:00 pm <span  class="_size1">to</span> 08:00 pm </span><br>
                                 <input type="checkbox" value="08:00 pm" name="schedule_time[]" <?php if(in_array('08:00 pm',$da)){echo "checked"; }?>> <span  class="_size">08:00 pm <span  class="_size1">to</span> 09:00 pm </span><br>
                                 <input type="checkbox" value="09:00 pm" name="schedule_time[]" <?php if(in_array('09:00 pm',$da)){echo "checked"; }?>> <span  class="_size">09:00 pm <span  class="_size1">to</span> 10:00 pm </span><br>
                               
                                 <input type="checkbox" class="scheduleT" id="enter_time" name="schedule_time[]" value="" style="margin-top:12px;"<?php if($da[$t]!=''){echo "checked"; }?>> <input type="text" class="form-control _other_time" name="_other_time" value="<?php echo $da[$t]?>"><br>
                                 
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
<script>
$(document).ready(function(){
    $("._other_time").change(function(){
       var other_time= $(this).val();
      $("#enter_time").val(other_time);
        })
});
</script>