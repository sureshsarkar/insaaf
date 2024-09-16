<link href="<?php echo base_url(); ?>assets/dist/css/newstyle.css" rel="stylesheet" type="text/css" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/product"> <i class="fa fa-sitemap" aria-hidden="true"></i> Product </a>
        <small>Add New Product</small>
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
                        <h3 class="box-title">Add New Product</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/Product/insertnow" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- first row end -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--name-->                             
                                            <div class="form-group">
                                                <label for="name"> Name</label>
                                                <input type="text" id="name" name ="name" class="form-control" required="required" placeholder="Enter Product Name" >
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!-- category list -->
                                            <?php if(!empty($parent_list)) {?>
                                            <div class="form-group">
                                                 <label for="category_id">Category Name</label>
                                                 <select class ="form-control" name="category_id" id="category_id">
                                                    <option value="" >Select </option>
                                                    <?php  foreach ($parent_list as $key => $value) {?>
                                                        <option value="<?=$value->id?>"><?=$value->name?></option>
                                                   <?php   } ?>
                                                </select>   
                                            </div> 
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Regular Price--> 
                                            <div class="form-group">
                                                <label for="regular_price"> Tag</label>
                                                
                                            <input type="text" id="tag" name ="tag" class="form-control" required="required" placeholder="Enter Tag Name to filter " >
                                            </div>   
                                        </div>
                                    </div>
                                    
                                    <!-- second row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Regular Price--> 
                                            <div class="form-group">
                                                <label for="regular_price"> Regular Price</label>
                                                <input type="text" id="regular_price" name ="regular_price" class="form-control" required="required" placeholder=" " >
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!--  Price--> 
                                            <div class="form-group">
                                                <label for="price">  Price</label>
                                                <input type="text" id="price" name ="price" class="form-control" required="required" placeholder=" " >
                                            </div>
                                        </div>
                                    </div>
                                    <!-- third row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- No item--> 
                                            <div class="form-group">
                                                <label for="no_item"> No.Item</label>
                                                <input type="number" id="no_item" name ="no_item" class="form-control" required="required" placeholder=" " >
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!--  color--> 
                                            <div class="form-group">
                                                <label for="color"> Color </label>
                                                <select   name="color[]" id="color" class="multipleChosen" multiple="true" >
                                                    <?php foreach ($color_list as $key => $value) {?>
                                                          <option value="<?=$value->id?>"><?=$value->name?></option>  
                                                    <?php } ?>
                                                </select>
                                            </div>     
                                        </div>
                                    </div>
                                    <!-- fourth row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--  size--> 
                                            <div class="form-group">
                                                <label for="size"> Size</label>
                                                <select class="multipleChosen" name="size[]" id="size" multiple="true" data-placeholder=" Select Size"  >
                                                    <?php foreach ($size_list as $key => $value) {?>
                                                          <option value="<?=$value->id?>"><?=$value->name?></option>  
                                                    <?php } ?>

                                                    
                                                </select>
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!--  color--> 
                                            <div class="form-group">
                                                <label for="brand"> Brand </label>
                                                <input type="text" id="brand" name ="brand" class="form-control"  placeholder=" " >
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fifth row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--  size--> 
                                            <!--  color--> 
                                            <div class="form-group">
                                                <label for="brand"> Slug Url </label>
                                                <input type="text" id="slug_url" name ="slug_url" class="form-control"  placeholder="" >
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!--  color--> 
                                            <div class="form-group">
                                                 <label for="status">Status</label>
                                                 <select class ="form-control" name="status" id="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>   
                                            </div>
                                        </div>
                                    </div>

									<!--Product Icon-->                             
                                    <div class="form-group">
                                        <label for="image">Upload Image Here </label>
                                        <!-- <input type="file" id="image" name ="image[]" class="form-control" multiple="true" accepts="image/*"  placeholder="Choose Product Image" > -->

                                        <div>
                                            <label style="font-size: 14px;">
                                                <span style='color:navy;font-weight:bold'>Attachment Instructions :</span>
                                            </label>
                                            <ul>
                                                <li>
                                                    Allowed only files with extension (jpg, png, gif)
                                                </li>
                                                <li>
                                                    Maximum number of allowed files 10 with 300 KB for each
                                                </li>
                                                <li>
                                                    you can select files from different folders
                                                </li>
                                            </ul>
                                            <!--To give the control a modern look, I have applied a stylesheet in the parent span.-->
                                            <span class="btn btn-success fileinput-button">
                                                <span>Select Attachment</span>
                                                <input type="file" name="files[]" id="files" multiple accept="image/jpeg, image/png, image/gif,"><br />
                                            </span>
                                            <output id="Filelist"></output>
                                        </div>
                                    </div>
                                   <!--Status-->                                    
                                 </div> 
                                    
                                <div class="col-md-6">     
                                    <!-- About  -->
                                    <div class="form-group">
                                         <label for="short_description">Short Description </label>
                                        <textarea  rows="5" id="short_description" name ="short_description" class="form-control" placeholder="Short Description.." ></textarea>
                                    </div>
                                    <div class="form-group">
                                         <label for="description"> description </label>
                                        <textarea  rows="8" id="description" name ="description" class="form-control" placeholder="Description.." ></textarea>
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
    CKEDITOR.replace( 'description' );
</script>
<script>

    $(document).ready(function(){
         //Chosen
    $("#name").keyup(function(){
        var text = $(this).val();
        var slug_url = convertToSlug(text);
        $("#slug_url").val(slug_url);

    });
    function convertToSlug(Text) {
      return Text.toLowerCase()
                 .replace(/ /g, '-')
                 .replace(/[^\w-]+/g, '');
    }
    $(".multipleChosen").chosen({
      placeholder_text_multiple: "Select Color .." //placeholder
    });
    
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
