<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content">
        <!-- <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/product/addnew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div> -->
        <div class="row">
        <div class="col-md-5">
           <h1>
      <i class="fa fa-sitemap" aria-hidden="true"></i>Out of Stock list
      
      </h1>
        </div>
        
      </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box-body table-responsive">
                  <table class="display admin_table" cellspacing="0" width="100%" id="example">
                    <thead >
                      <tr>
                        <th >S.No.</th>
                        <th>Logo</th>                                            
                        <th>Name</th>                                            
                                                        
                        <th>Quantity</th>                                            
                        <th>Trending</th>                                            
                        <th>Featured</th>                                            
                        <th>Status</th>                                            
                        <th>Date</th>                                            
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                  </table>
                  
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<!--  js for filter by qnt -->
<!--  js for change tranding and featured status  -->
<script type="text/javascript">
  $(document).ready(function(){
              
   jQuery(document).on("change", "#no_item", function(){
 
    var Quantity = $(this).val();
  
    hitURL = "<?php echo base_url() ?>admin/product/ajax_list";
    //getlist(Quantity);
    //getlist(Quantity); 
 /*  $.ajax({
           url:hitURL,
           method:"POST",
           data:{action:'filterbyqnt',Quantity:Quantity},
           success: function(data){
            
          },
     }); */
  });
});
</script>

<!--  end code for filter by qnt  -->


<!--  js for change tranding and featured status  -->
<script type="text/javascript">
  $(document).ready(function(){
              
   jQuery(document).on("change", ".trending", function(){
   
    var id = $(this).attr('data_id');
    var columnName = $(this).attr('data_colname');
    var status = 0;
    hitURL = "<?php echo base_url() ?>admin/product/changestatus";
    if($(this).is(':checked'))
    {
      status =1;
    }else
    {
       status =0;
    }
    $.ajax({
           url:hitURL,
           method:"POST",
           data:{status:status,id:id,columnName:columnName},
           success: function(data){
       
            
          },
     });
  });
});
</script>
<!-- Delete Script-->
  <script type="text/javascript">
    jQuery(document).ready(function(){
        //$('#example').DataTable();

          jQuery(document).on("click", ".deletebtn", function(){
          var tableId = $(this).attr("data_id");
          currentRow = $(this);
          hitURL = "<?php echo base_url() ?>admin/product/delete";
          var confirmation = confirm("Are you sure to delete this Product ?");
          if(confirmation)
          {
            $.ajax({
            type : 'POST',
            url :hitURL,
            data: {id:tableId}, 
            }).done(function(data){ 
              currentRow.parents('tr').remove();          
              if(data.status = true) { alert("successfully deleted"); location.reload();}
              else if(data.status = false) { alert("deletion failed"); }
              else { alert("Access denied..!"); }
            });



          }
     });
    });
   
</script>
<!-- Get Databse List -->
<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
    
  //  getlist();
 
    


    //datatables
      table = $('#example').DataTable({ 
   
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.
          
          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": "<?php echo site_url('admin/product/out')?>",
              "type": "POST",
            
          },
   
          //Set column definition initialisation properties.
          "columnDefs": [
          { 
              "targets": [0], //first column / numbering column
              "orderable": false, //set not orderable
          },
          ],
   
      });
});
</script>









