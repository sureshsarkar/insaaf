<?php 
 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_GET) && !empty($_GET)){
    $data['id']=base64_decode($_GET['key']);
    $data['status']=1;
    $data['update_dt']=date("Y-m-d H:i:s");
   update_notification($data);
}
?>




<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
       <div class="row">
        <div class="col-md-12 ">
        <div class="__all__cases">
               <i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;&nbsp;New Query List
      

        </div>
       </div>
      </div>
    </section>
      <section class="content">
        <div class="row">
            <div class="col-xs-12 __badge">
              <div class="">
                <div class="box-header __vtx__light">
                    <h3 class="box-title">  New Query List</h3>
                     <div class="box-tools">
                         
                    </div>
                </div><!-- /.box-header -->
                </div><!-- /.box-header -->
                <div class="box-body table-responsive sdjfhilsjh">
                  <table class="display "  cellspacing="0" width="100%" id="example">
                    <thead>
                      <tr class="__red_gray" >
                        <th >S.No.</th>                                          
                        <th>Case Category</th>                                             
                        <th>Date</th>                                            
                        <th>Payment Status</th>                                            
                        <!-- <th>Refund</th>                                             -->
                        <th>Action</th>                                            
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

<!-- Delete Script-->
  <script type="text/javascript">
    jQuery(document).ready(function(){
        //$('#example').DataTable();

          jQuery(document).on("click", ".deletebtn", function(){
          var tableId = $(this).attr("data_id");
          currentRow = $(this);
          hitURL = "<?php echo base_url() ?>client/Client_query/delete";
          var confirmation = confirm("Are you sure to delete this Categorys ?");
          if(confirmation)
          {
            $.ajax({
            type : 'POST',
            url :hitURL,
            data: {id:tableId}, 
            }).done(function(data){ 
              currentRow.parents('tr').remove();          
              if(data.status = true) { alert("successfully deleted");
                location.reload();
               }
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
 
    //datatables
    table = $('#example').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('client/Client_query/ajax_list/'.$user_id)?>",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});
</script>








