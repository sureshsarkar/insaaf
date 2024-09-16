<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/Case_details/total_cases"> <i class="fa fa-sitemap"
                    aria-hidden="true"></i> Case </a>
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
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/size/update" method="post"
                        role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Client Name</label>
                                        <input type="text" id="name" name="fname" class="form-control"
                                            value="<?php echo $Client_name; ?> ">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Lawyer name</label>
                                        <input type="text" id="name" name="email" class="form-control" 
                                            value="<?php echo isset($lawyer_name)?$lawyer_name:''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Case Category</label>
                                        <input type="text" id="name" name="mobile" class="form-control"
                                            value="<?php echo $Categoryname; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php if(!empty($CategorySubname)){?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Case Sub Category</label>
                                        <input type="text" id="name" name="mobile" class="form-control"
                                            value="<?php echo $CategorySubname; ?>">
                                    </div>
                                </div>
                                <?php }?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Joining date</label>
                                        <input type="text" id="name" name="dt" class="form-control" required="required"
                                            placeholder="Enter mobile Name" value="<?php echo $edit_data->dt; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1" <?php echo ($edit_data->status == 1)?'selected':''; ?>>
                                                Active</option>
                                            <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?>>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Case description </label>
                                        <textarea type="file" id="name" name="message" class="form-control"
                                            value="<?php echo $edit_data->case_description; ?>"><?php echo $edit_data->case_description; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Case Documents</label><br>
                                        <?php $image_data=explode(',', $edit_data->case_file); ?>
                                        <?php if(!empty($edit_data->case_file)){
                                            foreach($image_data as $image){
                                                $client_img=$image;
                                                $file=explode('.', $client_img);
                                                // pre($file[1]);
                                                if($file[1]=='mp3'){
                                                ?>
                                        <a class="btn btn-sm btn-info"
                                            href="<?php echo base_url('uploads/cases/').$client_img; ?>" target="_blank"
                                            title="mp3" co><i class="fa fa-play"><img
                                                    src1="<?php echo base_url('uploads/cases/').$client_img; ?>"
                                                    width="30px;" alt=""></i></a>
                                                    <!-- <buttom class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" title="delete"  data_id="<?php echo $edit_data->id?>" data_img="<?php echo $client_img?>" ><i class="fa fa-trash"></i></buttom> -->
                                        <?php }elseif($file[1]=='mp4'){
                                          
                                        
                                        ?>
                                        <a class="btn btn-sm btn-info"
                                            href="<?php echo base_url('uploads/cases/').$client_img; ?>" target="_blank"
                                            title="mp4" co><i class="fa fa-play-circle-o" style="font-size:20px;"><img
                                                    src1="<?php echo base_url('uploads/cases/').$client_img; ?>"
                                                    width="30px;" alt=""></i></a>
                                                    <!-- <buttom class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" title="delete"  data_id="<?php echo $edit_data->id?>" data_img="<?php echo $client_img?>" ><i class="fa fa-trash"></i></buttom> -->
                                                  
                                        <?php }else{
                                        
                                        ?>
                                       <a class="btn btn-sm btn-info"
                                            href="<?php echo base_url('uploads/cases/').$client_img; ?>" target="_blank"
                                            title="view" co><i class="fa fa-eye"><img
                                                    src1="<?php echo base_url('uploads/cases/').$client_img; ?>"
                                                    width="30px;" alt=""></i></a>
                                                    <!-- <buttom class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" title="delete"  data_id="<?php echo $edit_data->id?>" data_img="<?php echo $client_img?>" ><i class="fa fa-trash"></i></buttom> -->
                                                    
                                        <?php }}}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>" />
                </div>
                </form>
            </div>
        </div>
</div>
</section>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(".delete_old_image").click(function() {
    $("#old_img_con").addClass('hidden');
    $(".color_img").addClass('hidden');
    $("#old_image").val('');
});
</script>
<script>
        //$('#example').DataTable();
        jQuery(".deletebtn").on('click',function(){
          var tableId = $(this).attr("data_id");
          var tableImg = $(this).attr("data_img");
          currentRow = $(this);
          hitURL = "<?php echo base_url() ?>admin/Case_details/delete_case_file";
          var confirmation = confirm("Are you sure to delete Document ?");
          if(confirmation)
          {
            $.ajax({
            type : 'POST',
            url :hitURL,
            data: {id:tableId, img:tableImg}, 
            }).done(function(data){ 
              currentRow.parents('tr').remove();          
              if(data.status = true) { alert("successfully deleted"); }
              else if(data.status = false) { alert("deletion failed"); }
              else { alert("Access denied..!"); }
            });



          }
     });
</script>
  


  