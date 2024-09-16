<?php 
 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_GET) && !empty($_GET['key'])){
    $data['id']=base64_decode($_GET['key']);
    $data['status']=1;
    $data['update_dt']=date("Y-m-d H:i:s");
   update_notification($data);
}
?>
<style>
  .sdjfhilsjh{
    border: 1px solid #3c8dbc;

  }
  .hjggjugiu{
    border: 1px solid #3c8dbc;
    background: #9ee9c7;
  }
  
  .wrapText{
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    width: 200px;
  }

</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-sitemap" aria-hidden="true"></i>Client Queries
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/color/addnew"><i class="fa fa-plus"></i> Add New</a> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
            <div class="box p-2">
                    <div class="d-flex flex-row m-2">
                        <button type="button" class="btn btn-success clickQuery" data-value="close">Active</button>
                        <button type="button" class="btn btn-warning clickQuery" data-value="open">Pending</button>
                        <button type="button" class="btn btn-primary clickQuery" data-value="1">Today</button>
                        <button type="button" class="btn btn-warning clickQuery" data-value="7">Weekly</button>
                        <button type="button" class="btn btn-info clickQuery" data-value="30">Monthly</button>
                        <button type="button" class="btn btn-success clickQuery" data-value="365">Yearly</button>
                    </div>
                <div class="box-header">
                  <!-- <h3 class="box-title ">  Querie List </h3> -->
                <h3 class="box-title">Filter Query List
                                <span style="margin-left:10px;">
                                    <select id="shortBtn">
                                        <option value="all">Sort By</option>
                                        <option value="open"
                                            <?= (isset($_GET['type']) && $_GET['type'] == 'open' )?"selected":''?>>Pending
                                        </option>
                                        <option value="close"
                                            <?= (isset($_GET['type']) && $_GET['type'] == 'close' )?"selected":''?>>Active
                                        </option>
                                    </select>
                                </span>
                            </h3>
                     <div class="box-tools">
                         
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body sdjfhilsjh">
                  <table class="display table table table-bordered table-responsive"  cellspacing="0" width="100%" id="example">
                    <thead>
                      <tr class="hjggjugiu bg-1">
                        <th >S.No.</th>                                           
                        <th>Message</th>                                                        
                        <th>Client</th>                                                        
                        <th>Lawyer</th>                                                        
                        <th>Status</th>
                        <th>Date At</th>  
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
          hitURL = "<?php echo base_url() ?>admin/query/delete";
          var confirmation = confirm("Are you sure to delete this query ?");
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

<script type="text/javascript">
$(document).ready(function() {
    $("#shortBtn").change(function() {
      var sortBy = $(this).val();
        var url = "<?php echo base_url();?>";
        url = url + 'admin/query?type=' + sortBy;
        window.location.href = url;
    });
});
</script>

<!-- Get Databse List -->
<script type="text/javascript">
 
var table;
 
$(document).ready(function() {
    _fnGetTableData();

});


// function get table data from data base
function  _fnGetTableData() {
  var getquery_data = "<?php echo  isset($_GET['type'])?"?type=".$_GET['type']:''?>";
  //datatables
    table = $('#example').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/query/ajax_list')?>"+ getquery_data,
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

}
</script>



<script>
// get lawyer list by click the active,pending Querys

$(document).ready(function() {
    $(".clickQuery").click(function() {
        var sortBy = $(this).attr("data-value");
        var url = "<?php echo base_url();?>";
          url = url + 'admin/query?type=' + sortBy;
        window.location.href = url;

    })

});
</script>







