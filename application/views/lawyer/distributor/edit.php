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
       <a href="<?php echo base_url();?>admin/product"> <i class="fa fa-sitemap" aria-hidden="true"></i> Distributor</a>
        <small>Edit</small>
      </h1>
    </section>
    <?php

    $assign_products  = json_decode($edit_data->products,true); 
    $assign_products_item  = json_decode($edit_data->no_item,true); 
   

    ?>

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
                    
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/distributor/update" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- first row end -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--name-->                             
                                            <div class="form-group">
                                                <label for="name"> Name</label>
                                                <input type="text" id="firstname" name ="firstname" class="form-control" value="<?php echo $edit_data->firstname; ?>" required="required" placeholder="Enter First Name" >

                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!--name-->                             
                                            <div class="form-group">
                                                <label for="name">Last Name</label>
                                                <input type="text" id="lastname" name ="lastname" class="form-control" required="required" placeholder="Enter Last Name"  value="<?php echo $edit_data->lastname; ?>">
                                            </div>   
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Regular Price--> 
                                            <div class="form-group">
                                                <label for="email"> Email </label>
                                                
                                            <input type="email" name ="email" id="email" class="form-control" required="required" value="<?php echo $edit_data->email; ?>" placeholder="Enter Email.." >
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!-- No item--> 
                                            <div class="form-group">
                                                <label for="mobile"> Mobile</label>
                                                <input type="number" id="mobile" name ="mobile" class="form-control" value="<?php echo $edit_data->mobile; ?>" required="required" placeholder=" Mobile" >
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Regular Price--> 
                                            <div class="form-group">
                                                <label for="email"> Addres  </label>
                                                <textarea class="form-control" id="address" name="address" placeholder="Enter Addresss" ><?php echo $edit_data->address; ?></textarea>
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="country">Country</label>
                                            <select class=" country custom-select w-100 country_select form-control" id="country" name="country" data-columnName="country_id" data-listtype="z_states" data-bindId="state" required>
                                                <option value="">Choose...</option>
                                                <?php if(!empty($country_list)) {
                                                    foreach ($country_list as $key =>
                                                $value) { ?>
                                                <option value="<?=$value->id?>" <?php echo ($value->id==$edit_data->country)?'selected':'' ?>><?=$value->name?></option>
                                                <?php } }?>
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-3 delete">
                                            <label for="state" class="delete">State</label>
                                            <select class="custom-select w-100 state state_height form-control" id="state" data-columnName="state_id" data-listtype="z_cities" data-bindId="city" name="state" required>
                                                <?php if(!empty($state_list)) {
                                                    foreach ($state_list as $key =>
                                                $value) { ?>
                                                <option value="<?=$value->id?>" <?php echo ($value->id==$edit_data->state)?'selected':'' ?>><?=$value->name?></option>
                                                <?php } }?>
                                             </select >
                                        </div>
                                        <div class="col-md-3 city_del">
                                            <label for="city" class="city_del">City</label>
                                            <select class="custom-select w-100 state_height form-control" name="city" id="city" required>
                                                <option value="">Choose...</option>
                                                <?php if(!empty($city_list)) {
                                                    foreach ($city_list as $key =>
                                                $value) { ?>
                                                <option value="<?=$value->id?>" <?php echo ($value->id==$edit_data->city)?'selected':'' ?>><?=$value->name?></option>
                                                <?php } }?>
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <label for="address">Pin Code</label>
                                            <input type="number" class="form-control" name="pincode" id="address" placeholder="E.g..201301" value="<?php echo $edit_data->pincode; ?>"  required />
                                        </div>
                                    </div>
                                    <!-- six row -->
                                    <div class="row">
                                        <!-- fourth row -->
                                
                                        <div class="col-md-6">
                                            <table class="form-table table" id="customFields" style="margin-left:-7px;">
                                                <tr valign="top">
                                                    <th scope="row">
                                                        Product 
                                                    </th>
                                                    <th>
                                                        Quantity
                                                    </th>
                                                    <th>
                                                        Add
                                                    </th>
                                                    <th>
                                                        Remove
                                                    </th>
                                                </tr>
                                               
                                                        <?php
                                                        $array_product=json_decode($edit_data->products,true);
                                                       // pre($array_product);
                                                        $i=0;
                                                        foreach($array_product as $key_product => $value_product )
                                                        {
                                                          
                                                        
                                                        
                                                        //exit;
                                                        ?>
                                                         <tr>
                                                             <td>
                                                        <div class="form-group">
                                                            
                                                            <select class=" form-control" name="product[]" id="product<?=$i?>"  data-placeholder=" Assign Products" onchange="get(this)" > 

                                                                <option>--- SELECT ---</option>
                                                                <?php foreach ($product_list as $key => $value) {?>


                                                                 <option value="<?=$value->id?>" <?php echo  ($value->id==$value_product)?'selected':''?> ><?=$value->name?>
                                                                          
                                                                      </option>  
                                                                <?php } ?>

                                                                

                                                            </select>
                                                        </div> 
                                                        </td>
                                                    <td>
                                                        <input type="number" min="1" class="code form-control customFieldName<?=$i?>" id="customFieldName<?=$i?>" name="no_item[]" value="1" placeholder="Quantity" />
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="addCF"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                                    </td>
                                                     <td style="text-align: center;">
                                                        <a href="javascript:void(0);" class="remCF"><i class="fa fa-minus-circle fa-2x" style="color:red;" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                                        <?php
                                                        $i++;
                                                            }
                                                        ?>
                                                    
                                            </table> 
                                        </div>
                                        <div class="col-md-6 " >
                                            <!--  color--> 
                                            <div class="form-group " >
                                                 <label for="status" style="padding: 10px;">Status</label>
                                                 <select class ="form-control" name="status" id="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>   
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?php echo $edit_data->id; ?>"/>
                            <input type="submit" class="btn btn-primary" value="Update" />
                        </div>
                    </form>
                    

                   
                </div>
            </div>
            
        </div>    
    </section>
</div>
<!--  js for change tranding and featured status  -->
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script> 
<script type="text/javascript">
  $(document).ready(function(){

  //calling get function

    <?php
    $array_product=json_decode($edit_data->products,true);
    // pre($array_product);
        $j=0;
   foreach($array_product as $key_product => $value_product )
    {
       
        ?>
              var get_object = {
                    value : <?=$value_product?>,
                     id : "product"+<?=$j?>,
              };
              get(get_object);
              //console.log(get_object);
        <?php
         $j++;
    }
    ?>
  
  //end of get function call

    $(".delete_old_image").click(function(){
        var image_index = $(this).attr('data_index');
        var imageName  = $(this).attr('data_imagename');
        var imageID  = $(this).attr('data_id');
        var id = $("#tableId").val();
        hitURL = "<?php echo base_url() ?>admin/product/removeImage";
        var confirmation = confirm("Are you sure to delete this Categorys ?");
        if(confirmation)
        {
            $.ajax({
                   url:hitURL,
                   method:"POST",
                   data:{image_index:image_index,id:id,imageName:imageName},
                   success: function(data){
                    $("#"+imageID).addClass('hide');
                  },
             });
        }
    });
});
</script>
 
<script>
    $(document).ready(function(){
         //Chosen
        $(".multipleChosen").chosen({
          placeholder_text_multiple: "Select Color .." //placeholder
        });
    });
  </script>

<script>
var set_id_val=0;
    function get(data){

        console.log(data.value);
        console.log(data.id);
        var product_id = data.value;
        var id = data.id;
        //let text = "product10";
       let new_id = id.substring(7, id.length);
        
        var no_of_item = <?php echo  $no_item?>;
        var max_size  = '';
        var key = Object.keys(no_of_item);
        var value = Object.values(no_of_item);

        for(var i=0;i<value.length;i++)
        {
            if(key[i]==product_id){
                max_size =  value[i];
                $(".customFieldName"+new_id).attr("max",max_size);
            }   
        }
    }

    $(document).ready(function(){

       
        
        $("#customFieldName0").click(function(){
            var max = $(this).attr('max');

         });

        $(".addCF").click(function(){
            set_id_val++;
            $("#customFields").append('<tr valign="top"><td><div class="form-group"><select class=" form-control" name="product[]" id="product'+set_id_val+'"  onchange="get(this)" data-placeholder=" Assign Products"  required="required" ><option>--- SELECT ---</option><?php foreach ($product_list as $key => $value) {?><option value="<?=$value->id?>"><?=$value->name?></option><?php } ?></select></div></td><td><input type="number" min="1" class="code form-control customFieldName'+set_id_val+'" id="customFieldName'+set_id_val+'" required="required" name="no_item[]" value="1" placeholder="Quantity" /></td><td><a href="javascript:void(0);" class="remCF"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a></td></tr>');
        });
        $("#customFields").on('click','.remCF',function(){
            $(this).parent().parent().remove();
        });
});

    $(document).ready(function(){
   
    $(".multipleChosen").chosen({
      placeholder_text_multiple: "Select Color .." //placeholder
    });
    
       
    });
    
  </script>