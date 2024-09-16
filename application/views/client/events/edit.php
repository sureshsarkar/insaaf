<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css"> 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->

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
                       
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                   <form role="form" id="member_form" action="<?php echo base_url() ?>admin/events/update" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                            <!--name-->                             
                                            <div class="form-group">
                                                <label for="name"> Name</label>
                                                <input type="text" id="name" name ="name" class="form-control" required="required" placeholder="Enter Product Name" value="<?php echo $edit_data->name; ?>" >
                                            </div>   
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name"> From</label>
                                                <input type="text" id="my_date_picker1" name ="from_date" class="form-control" required="required" placeholder="" value="<?php echo $edit_data->from_date; ?>" >
                                            </div>  
                                            
    
                                        </div>
                                         <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name"> To Date</label>
                                                <input type="text" id="my_date_picker2" name ="to_date" class="form-control" required="required" placeholder=""  value="<?php echo $edit_data->to_date; ?>" >
                                            </div> 
                                                 
                                        </div>
                                        <div class="col-md-2">
                                             <div class="form-group">
                                                 <label for="status">Status</label>
                                                 <select class ="form-control" name="status" id="status">
                                            <option value="1" <?php echo ($edit_data->status == 1)?'selected':''; ?> >Active</option>
                                            <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?> >Inactive</option>
                                        </select>     
                                            </div>
                                        </div>
                                    
                                 </div> 
                                    
                            
                             </div>
                             
                             
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>"/>
                            <input type="submit" class="btn btn-primary" value="Update" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            
        </div>    
    </section>
</div>
<!--  js for change tranding and featured status  -->

<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>  

  <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
        </script>
        <script src=
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
        </script>
<script>
    $(document).ready(function() {

        $(function() {
            $("#my_date_picker1").datepicker({});
        });

        $(function() {
            $("#my_date_picker2").datepicker({});
        });

        $('#my_date_picker1').change(function() {
            startDate = $(this).datepicker('getDate');
            $("#my_date_picker2").datepicker("option", "minDate", startDate);
        })

        $('#my_date_picker2').change(function() {
            endDate = $(this).datepicker('getDate');
            $("#my_date_picker1").datepicker("option", "maxDate", endDate);
        })
    })
</script>
<!-- <script>
	$(".delete_old_image").click(function(){
        $(this).addClass('hide');
		$("#old_image").val('');
	});
</script> -->
