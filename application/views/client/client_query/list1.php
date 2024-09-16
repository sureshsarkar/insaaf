<?php 
 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_GET['key']) && !empty($_GET['key'])){
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
      <h1>
      <i class="fa fa-sitemap" aria-hidden="true"></i> All Query List
        <small> Edit, Delete</small>
      
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
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">All Query List </h3>
                     <div class="box-tools">
                         
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive sdjfhilsjh">
                  <table class="display "  cellspacing="0" width="100%" id="example">
                    <thead>
                      <tr class="hjggjugiu" >
                        <th >S.No.</th>                                          
                        <th>Lawyer Name</th>                                             
                        <th>Case Category</th>                                             
                        <th>Date</th>                                              
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
            "url": "<?php echo site_url('client/Client_query/ajax_list1/'.$user_id)?>",
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








