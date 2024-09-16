<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css"> 
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <a href="<?php echo base_url();?>lawyer/cases/index/<?=$view_data->asign_lawyer_id?>"> <i class="fa fa-sitemap" aria-hidden="true"></i>All case list</a>
        <small>View Case Details</small>
      </h1>
    </section>
    
    <section class="content">
    <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>lawyer/hearing_date/Complane/<?=$case_id?>"><i class="fa fa-plus"></i>Complane to Admin</a>
                </div>
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>lawyer/hearing_date/addnew/<?=$case_id?>"><i class="fa fa-plus"></i> Add New Hearing Date</a>
                </div>
            </div>
        </div>
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
                    <!-- form start -->
                   <form role="form" id="member_form" action="<?php echo base_url() ?>lawyer/client/update" method="post" role="form" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                <input type="hidden" name="id" value="<?php echo $view_data->id; ?>"/>
                                    <div class="form-group">
                                        <label for="name"> Case Category Name</label>
                                        <input type="text" id="name" name ="fname" class="form-control" required="required" placeholder="Enter first Name" value="<?php echo $case_cat_name1->name; ?> " >
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name"> Case Sub Category Name</label>
                                        <input type="text" id="name" name ="lname" class="form-control" required="required" placeholder="Enter last Name" value="<?php echo $case_sub_cat_name1->case_sub_category; ?>" >
                                    </div> 
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Client Name</label>
                                        <input type="text" id="name" name ="email" class="form-control" required="required" placeholder="Enter email Name" value="<?php echo $client_name->fname.' '.$client_name->lname; ?>" >
                                    </div> 
                                    </div> 
                                 
                            </div>
                            <div class="row">
                              
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Case Description</label>
                                        <input type="text" id="name" name ="mobile" class="form-control" required="required" placeholder="Enter mobile Name" value="<?php echo $view_data->case_description; ?>" >
                                    </div> 
                                 </div> 
                                 <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class ="form-control" name="status" id="status">
                                                <option value="1" <?php echo ($view_data->status == 1)?'selected':''; ?> >Active</option>
                                                <option value="0" <?php echo ($view_data->status == 0)?'selected':''; ?> >Inactive</option>
                                            </select>	
                                        </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Date </label>
                                        <input type="text" id="name" name ="dt" class="form-control" required="required" placeholder="Enter mobile Name" value="<?php echo $view_data->dt; ?>" >
                                    </div> 
                                 </div> 
                                 </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Case Document</label><br>
                                        <button type="button" class="btn btn-primary "> <a href="<?php echo base_url('uploads/client/').$client_name->case_file; ?>" target="_blank" title="view"><img src1="<?php echo base_url('uploads/client/').$client_name->case_file; ?>" width="30px;" alt=""></a></button>
                                    </div> 
                                </div>
                             </div>
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
