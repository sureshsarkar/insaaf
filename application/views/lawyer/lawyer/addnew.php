<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css"> 

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/size"> <i class="fa fa-sitemap" aria-hidden="true"></i> size</a>
        <small>Add New Size</small>
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
                        <h3 class="box-title">Add New size</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/size/insertnow" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!--Size --> 

                                       <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name ="name" class="form-control" required="required" placeholder="Enter size Name" autocomplete="off" >
                                    </div>
                                  
                                       
                                           <!--Width --> 

                                     <!--   <div class="form-group">
                                        <label for="name">Width</label>
                                        <input type="text" id="width" name ="width" class="form-control" required="required" placeholder="Enter width" >
                                    </div> -->
                                       
                                                <!--hight--> 
<!-- 
                                       <div class="form-group">
                                        <label for="name">Height</label>
                                        <input type="text" id="height" name ="height" class="form-control" required="required" placeholder="Enter hight" >
                                    </div>
 -->

                                    <!--size Icon-->                           


                                    <div class="form-group">
                                         <label for="status">Status</label>
                                         <select class ="form-control" name="status" id="status">
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>	
                                    </div>
                                    
                                 </div> 
                                 
                             </div>
                             
                             
                        </div><!-- /.box-body -->
    
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
