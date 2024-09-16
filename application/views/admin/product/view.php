<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css"> 
<style type="text/css">
    .multipleChosen{
  width:100%;

}
input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
.hide{display: none}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <a href="<?php echo base_url();?>admin/product"> <i class="fa fa-sitemap" aria-hidden="true"></i> Product</a>
        <small>View Details</small>
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
                       
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- first row end -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--name-->                             
                                            <div class="form-group">
                                                <label for="name"> Name</label>
                                                <input type="text" disabled="disabled" id="name" name ="name" class="form-control" value="<?php echo $edit_data->name; ?>" required="required" placeholder="Enter Product Name" >
                                            </div>   
                                        </div>

                                        <div class="col-md-6">
                                            <!-- category list -->
                                            <?php if(!empty($parent_list)) {?>
                                            <div class="form-group">
                                                 <label for="category_id">Category Name</label>
                                                 <select class ="form-control" disabled="disabled" name="category_id" id="category_id">
                                                    <option value="" >Select </option>
                                                    <?php  foreach ($parent_list as $key => $value) {?>
                                                    <option value="<?=$value->id?>" <?php echo ($value->id == $edit_data->category_id)?'selected':''; ?>><?=$value->name?></option>
                                                    <?php   } ?>
                                                </select>   
                                            </div> 
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">


                                          <!-- category list -->
                                          <?php if(!empty($parent_list)) {?>
                                            <div class="form-group">
                                            <label for="tag">Tag</label>

                                            <input type="text" disabled="disabled" id="tag" name ="tag" class="form-control" required="required" placeholder=" " value="<?php echo $edit_data->tag; ?>" >
                                            </div> 
                                            <?php }?>

                                        </div>
                                      <!--   <div class="col-md-6">
                                         
                                            <div class="form-group">
                                                <label for="no_item"> No.Item</label>
                                                <input type="number" disabled="disabled" id="no_item" name ="no_item" class="form-control" value="<?php echo $edit_data->no_item; ?>" required="required" placeholder=" " >
                                            </div>   
                                        </div> -->
                                    </div>
                                    <!-- second row -->

                                    <?php 

                                    $odd= '#a9a9a973';
                                    $even= '#ffdaad91';
                                   
                                    $data_price     =json_decode($edit_data->price);
                                    $regular_price  =json_decode($edit_data->regular_price);
                                    $no_item        =json_decode($edit_data->no_item);
                                    $discount       =json_decode($edit_data->discount);
                                    $size           =json_decode($edit_data->size);
                                    $color           =json_decode($edit_data->color);
                                    $counting       = count($data_price);
                                    for($i=0;$i<$counting;$i++) { ?>

                                 

                                    <div class="more_product" id="1remove<?=$i?>"  style="background-color:<?php if($i/2==1){echo $even;}else{echo $odd;} ?>">
                                        <!-- second row -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <!--  Price--> 
                                                
                                                <div class="form-group">
                                                    <label for="price">  MRP: </label>
                                                    <input type="text" disabled="disabled" id="price0" name ="price[]" class="form-control" required="required" placeholder=" "  value="<?=$data_price[$i]?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <!--  Price--> 
                                                <div class="form-group">
                                                    <label for="price">  Discount ( % )</label>
                                                    <input type="text" disabled="disabled" id="discount0" name="discount[]" onkeyup="get_discount(this)" class="form-control discount" value="<?=$discount[$i]?>" required="required" placeholder=" " >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Regular Price--> 
                                                <div class="form-group">
                                                    <label for="regular_price"> Offer Price</label>
                                                    <input type="text" disabled="disabled" id="regular_price0" name="regular_price[]"  readonly class="form-control regular_price"  value="<?=$regular_price[$i]?>"required="required" placeholder=" " >
                                                </div>   
                                            </div>
                                            <div class="col-md-3">
                                                <!-- Regular Price--> 
                                                <div class=" mt_25">
                                                    <?php if($i==0)  {?>
                                                    <p class="btn btn-primary  mt-5 add_pr">Add</p>
                                                <?php }else{ ?>
                                                    <p class="btn btn-primary  mt-5 1remove<?=$i?>"  onclick="remove_block1(this)" id="1remove<?=$i?>">Remove</p>
                                                <?php } ?>
                                                </div>   
                                            </div>
                                        </div>
                                        <!-- third row -->
                                        
                                        <!-- fourth row -->
                                        <div class="row">
                                            <div class="col-md-4">
                                                <!--  size--> 
                                                <div class="form-group">
                                                    <label for="size"> Size</label>
                                                    <select class="form-control" disabled="disabled" name="size[]" id="size" data-placeholder=" Select Size"  >
                                                        <?php foreach ($size_list as $key => $value) {?>
                                        <option  <?php echo  ($value->id==$size[$i])?'selected':''; ?>  value="<?=$value->id?>"><?=$value->name?></option>  
                                                        <?php } ?>
                                                    </select>
                                                  
                                                </div>   
                                            </div>
                                            <div class="col-md-4">
                                                <!--  size--> 
                                                <div class="form-group">
                                                    <label for="Color"> Color</label>
                                                    <select class="form-control" disabled="disabled" name="color[]" id="color" data-placeholder=" Select Size"  >
                                                        <?php foreach ($size_list as $key => $value) {?>
                                                              <option <?php echo  ($value->id==$color[$i])?'selected':''; ?> value="<?=$value->id?>"><?=$value->name?></option>  
                                                        <?php } ?>
                                                    </select>
                                                   
                                                </div>   
                                            </div>
                                           
                                            <div class="col-md-4">
                                                <!-- No item--> 
                                                <div class="form-group">
                                                    <label for="no_item"> No.Item</label>
                                                    <input type="number" disabled="disabled" id="no_item" name ="no_item[]" class="form-control" required="required" placeholder=" "  value="<?=$no_item[$i]?>">
                                                </div>   
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="addmore"></div>


                                    <!-- deal of day and is coming soon  -->
                                       
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--  size--> 
                                            <!--  color--> 
                                            <div class="form-group">
                                                <label for="brand"> Deal of Day</label>
                                                <select class ="form-control" disabled="disabled" name="deal_of_day" id="deal_of_day">
                                                    <option value="1" <?php echo ($edit_data->deal_of_day == 1)?'selected':''; ?>>True</option>
                                                    <option value="0" <?php echo ($edit_data->deal_of_day == 0)?'selected':''; ?>>False</option>
                                                </select>
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!--  color--> 
                                            <div class="form-group">
                                                 <label for="status">Coming Soon</label>
                                                 <select class ="form-control" disabled="disabled" name="is_coming" id="is_coming">
                                                    <option value="1" <?php echo ($edit_data->is_coming == 1)?'selected':''; ?> >True</option>
                                                    <option value="0" <?php echo ($edit_data->is_coming == 0)?'selected':''; ?>>False</option>
                                                </select>   
                                            </div>
                                        </div>
                                    </div>

                                        <!--  end code for deal of day and coming soon  -->


                                    <!-- six row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--  size--> 
                                            <!--  color--> 
                                            <div class="form-group">
                                                <label for="brand"> Slug Url </label>
                                                <input type="text" disabled="disabled" id="slug_url" name ="slug_url" class="form-control"  value="<?= $edit_data->slug_url?>" placeholder="" >
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!--  color--> 
                                            <div class="form-group">
                                                 <label for="status">Status</label>
                                                 <select class ="form-control" disabled="disabled" name="status" id="status">
                                                    <option value="1" <?php echo ($edit_data->status == 1)?'selected':''; ?> >Active</option>
                                                    <option value="0" <?php echo ($edit_data->status == 0)?'selected':''; ?> >Inactive</option>
                                                </select>   
                                            </div>
                                        </div>
                                    </div>

                                    <!--Product Icon-->                             
                                    <div class="form-group">
                                        
                                        <div>

                                        <?php
                                            

                                            $image_array =  json_decode($edit_data->image);
                                           
                                            $i=0;  foreach  ($image_array as $key => $value) {$i++;?>
                                            <span class="pip delete_old_image" disabled="disabled" data_imagename="<?=$value?>" data_index="<?=$i?>" data_id="spanid_<?=$i?>" id="spanid_<?=$i?>">
                                                <img  disabled="disabled" src="<?php echo base_url(); ?>uploads/product/<?php echo $value;?>" class="imageThumb " data_id="<?=$i?>" data_imagename="<?=$value?>">
                                          
                                                <input type="hidden"  disabled="disabled" name="tableId" id="tableId" value="<?=$edit_data->id?>">
                                            </span>
                                        <?php } ?>
                                        </div>
                                        <!-- <input type="file" id="files" name="files1[]" multiple /> -->
                                    </div>
                                   <!--Status-->  
                                 </div>      
                                <div class="col-md-6">     
                                    <!-- About  -->
                                    <div class="form-group">
                                         <label for="short_description">Short Description </label>
                                        <textarea  rows="5" id="short_description" name ="short_description"   class="form-control" placeholder="Short Description.." disabled="disabled"><?php echo $edit_data->short_description?></textarea>
                                    </div>
                                    <div class="form-group">
                                         <label for="description"> description </label>
                                        <textarea  rows="8" id="description" name ="description" class="form-control" disabled="disabled" placeholder="Description.." ><?php echo $edit_data->description?></textarea>
                                    </div>
                                    
                                </div>
                             </div>
                             
                             
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>"/>
                           
                           
                        </div>
                    </form>
                    

                   
                </div>
            </div>
            
        </div>    
    </section>
</div>
<!--  js for change tranding and featured status  -->


<script type="text/javascript">

    $(document).ready(function(){
        var count=1;
        function randomNumber(min, max) { 
    return Math.floor(Math.random() * (max - min) + min);
}
        $(".add_pr").click(function(){
var colors = ["#ffe771", "#ff7e7161", "#71ff89","#2f763b75","#819d9987","#55f9e2","#536ce529","#ad53e5c7","#bc51ff29","#f140e340","#f140b2"];
            $(".addmore").append('<div class="more_product " style="background:'+colors[randomNumber(0, 10)]+'" id="remove'+count+'"><!-- second row --> <div class="row"><div class="col-md-3"><!--  Price--><div class="form-group"><label for="price">  MRP: </label><input type="number" disabled="disabled" id="price'+count+'" name ="price[]" class="form-control price" required="required" placeholder=" " ></div></div><div class="col-md-3"><!--  Price--><div class="form-group"> <label for="price">  Discount ( % )</label><input type="number" disabled="disabled" id="discount'+count+'" name ="discount[]" onkeyup="get_discount(this)" class="form-control discont" required="required" placeholder=" " > </div> </div><div class="col-md-3"><!-- Regular Price--><div class="form-group"><label for="regular_price"> Offer Price</label><input type="text" id="regular_price'+count+'" name="regular_price[]"  readyonly class="form-control regular_price"  required="required" placeholder=" " ></div></div><div class="col-md-3"><!-- Regular Price--><div class=" mt_25"><p class="btn btn-primary  mt-5 remove" id="remove'+count+'" onclick="remove_block(this)">Remove</p></div></div></div><!-- third row --><!-- fourth row --><div class="row"><div class="col-md-4"><!--  size--><div class="form-group"><label for="size"> Size</label><select class="form-control" disabled="disabled" name="size[]" id="size" data-placeholder=" Select Size"  > <?php foreach ($size_list as $key => $value) {?><option value="<?=$value->id?>"><?=$value->name?></option>  <?php } ?>
                </select> <!-- <select class="multipleChosen" name="size[]" id="size" multiple="true" data-placeholder=" Select Size"  > <?php foreach ($size_list as $key => $value) {?> <option value="<?=$value->id?>"><?=$value->name?></option>    <?php } ?>  </select> --> </div>   </div><div class="col-md-4"><!--  size-->  <div class="form-group"> <label for="Color"> Color</label> <select class="form-control" disabled="disabled" name="color[]" id="color" data-placeholder=" Select Size"  >   <?php foreach ($size_list as $key => $value) {?>
                          <option value="<?=$value->id?>"><?=$value->name?></option>   <?php } ?>
                </select> <!-- <select class="multipleChosen" name="size[]" id="size" multiple="true" data-placeholder=" Select Size"  >  <?php foreach ($size_list as $key => $value) {?>
                    <option value="<?=$value->id?>"><?=$value->name?></option>    <?php } ?>    </select> --></div>  </div>  <div class="col-md-4"> <!-- No item-->   <div class="form-group">    <label for="no_item"> No.Item</label> <input type="number" disabled="disabled" id="no_item" name ="no_item[]" class="form-control" required="required" placeholder=" " > </div>     </div>    </div>  </div>');
            count++;
        });
    //      $("#remove").click(function(){
    //      $(this).remove();



    // });
    });

function remove_block(data)
{
    

 $("#"+data.id).remove();

}

</script>



<script>
    $(document).on("change keyup blur", "#discount1,#price1", function() {
        var main = $('#price1').val();
        var disc = $('#discount1').val();
        var dec = (disc / 100).toFixed(3); //its convert 10 into 0.10
        var mult = main * dec; // gives the value for subtract from main value
        var discont = main - mult;

        $('#regular_price1').val(discont.toFixed(0));
    });
    function remove_block1(data)
    {
        var div_id = data.id;
        var  id = div_id.substr(7, 7);
        $("#1remove"+id).remove();
    }

</script>

 <script>
    CKEDITOR.replace( 'short_description' );
    CKEDITOR.replace( 'description' );
</script>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>  
<script>
    $(document).ready(function(){
         //Chosen
        $(".multipleChosen").chosen({
          placeholder_text_multiple: "Select Color .." //placeholder
        });
    });
  </script>
<!-- <script>
	$(".delete_old_image").click(function(){
        $(this).addClass('hide');
		$("#old_image").val('');
	});
</script> -->
<script>

function get_discount(data)
{
    var div_id = data.id;
    var  id = div_id.substr(8, 4);
    var main = $("#price"+id).val();
    var disc = $("#discount"+id).val();
    var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
    var mult = main * dec; // gives the value for subtract from main value
    var discont = main - mult;
    $('#regular_price'+id).val(discont);
}
</script>
