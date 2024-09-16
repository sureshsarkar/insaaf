<link href="<?php echo base_url(); ?>assets/dist/css/newstyle.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .chosen-container-multi .chosen-choices {
   
    padding: 3px 9px;
   
    border: 1px solid #ccc;
    
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         <a href="<?php echo base_url();?>admin/product"> <i class="fa fa-sitemap" aria-hidden="true"></i> Distributor </a>
        <small>Add New Distributor</small>
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
                        <h3 class="box-title">Add New Distributor</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/Distributor/insertnow" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- first row end -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!--name-->                             
                                            <div class="form-group">
                                                <label for="name">First Name</label>
                                                <input type="text" id="firstname" name ="firstname" class="form-control" required="required" placeholder="Enter First Name" >
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!--name-->                             
                                            <div class="form-group">
                                                <label for="name">Last Name</label>
                                                <input type="text" id="lastname" name ="lastname" class="form-control" required="required" placeholder="Enter Last Name" >
                                            </div>   
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Regular Price--> 
                                            <div class="form-group">
                                                <label for="email"> Email </label>
                                                
                                            <input type="email" name ="email" id="email" class="form-control" required="required" placeholder="Enter Email.." >
                                            </div>   
                                        </div>
                                        <div class="col-md-6">
                                            <!-- No item--> 
                                            <div class="form-group">
                                                <label for="mobile"> Mobile</label>
                                                <input type="number" id="mobile" name ="mobile" class="form-control" required="required" placeholder=" Mobile" >
                                            </div>   
                                        </div>
                                    </div>
                                    <!--  distributor address -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- Regular Price--> 
                                            <div class="form-group">
                                                <label for="email"> Addres  </label>
                                                <textarea class="form-control" id="address" name="address" placeholder="Enter Addresss"></textarea>
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="country">Country</label>
                                            <select class="custom-select w-100 country country_select form-control" id="country" name="country" data-columnName="country_id" data-listtype="z_states" data-bindId="state" required>
                                                <option value="">Choose...</option>
                                                <?php if(!empty($country_list)) {
                                                    foreach ($country_list as $key =>
                                                $value) { ?>
                                                <option value="<?=$value->id?>"><?=$value->name?></option>
                                                <?php } }?>
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-3 delete">
                                            <label for="state" class="delete">State</label>
                                            <select class="custom-select state w-100 state_height form-control" id="state" data-columnName="state_id" data-listtype="z_cities" data-bindId="city" name="state"> </select required>
                                        </div>
                                        <div class="col-md-3 city_del">
                                            <label for="city" class="city_del">City</label>
                                            <select class="custom-select city w-100 state_height form-control" name="city" id="city" required>
                                                <option value="">Choose...</option>
                                            </select>
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <label for="address">Pin Code</label>
                                            <input type="number" class="form-control" name="pincode" id="address" placeholder="E.g..201301"  required />
                                        </div>
                                    </div>

                                    <!--  end distributor address -->
                                    
                                    
                                    
                                    <!-- fourth row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="form-table table" id="customFields">
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
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            
                                                            <select class=" form-control" name="product[]" id="product0"  data-placeholder=" Assign Products" onchange="get(this)" > 
                                                                <option>--- SELECT ---</option>
                                                                <?php foreach ($product_list as $key => $value) {?>
                                                                      <option value="<?=$value->id?>"><?=$value->name?></option>  
                                                                <?php } ?>

                                                                
                                                            </select>
                                                        </div> 
                                                    </td>
                                                    <td>
                                                        <input type="number" min="1" class="code form-control customFieldName0" id="customFieldName0" name="no_item[]" value="1" placeholder="Quantity" />
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="addCF"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
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

                                    <!-- deal of day and is coming soon  -->
                                    
                                    <!--  end code for deal of day and coming soon  -->

                                    <!-- Fifth row -->
                                                                   
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
var set_id_val=0;
    function get(data){
    
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

        /* end code for country state */
        
        $("#customFieldName0").click(function(){
            var max = $(this).attr('max');

         });

        $(".addCF").click(function(){
            set_id_val++;
            $("#customFields").append('<tr valign="top"><td><div class="form-group"><select class=" form-control" name="product[]" id="product'+set_id_val+'"  onchange="get(this)" data-placeholder=" Assign Products"  ><option>--- SELECT ---</option><?php foreach ($product_list as $key => $value) {?><option value="<?=$value->id?>"><?=$value->name?></option><?php } ?></select></div></td><td><input type="number" min="1" class="code form-control customFieldName'+set_id_val+'" id="customFieldName'+set_id_val+'" name="no_item[]" value="1" placeholder="Quantity" /></td><td><a href="javascript:void(0);" class="remCF"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a></td></tr>');
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

