<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css"> 
<style type="text/css">

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
        <div class="row">
           
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->    
                <div class="box box-primary">
                    <div class="box-header">
                       
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
              
     
                    

                   
                </div>
            </div>
            
        </div>    
    </section>
</div>
<!--  js for change tranding and featured status  -->
<script type="text/javascript">
  $(document).ready(function(){

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
