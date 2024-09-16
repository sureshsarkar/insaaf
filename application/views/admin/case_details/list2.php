<style>
  .sdjfhilsjh{
    border: 1px solid #3c8dbc;

  }
  .hjggjugiu{
    border: 1px solid #3c8dbc;
    background: #9ee9c7;
  }
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     <!-- <?php foreach($client_name as $client_value){
       $fname=$client_value->fname;
       $lname=$client_value->lname;
        $fullname=$fname.' '.$lname;
     }
       ?> -->
    <?php if(!empty($total_cases)){
         foreach($total_cases as $case_details){
              $case_id = $case_details->id;
              }}?>
      <i class="fa fa-sitemap" aria-hidden="true"></i>All Pending Case Details
        <small>Add, Edit</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
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
            <div class="col-xs-12 text-right">
                
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Case List</h3>
                     <div class="box-tools">
                         
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive sdjfhilsjh">
                  <table class="display" cellspacing="0" width="100%" id="example">
                    <thead>
                    <tr class="hjggjugiu bg-1">
                        <th >S.No.</th>   
                        <th>Case Category</th>                                                       
                        <th>Asign Lawyer</th> 
                        <th>Client Name</th>                                            
                        <th>Status</th>                                            
                        <th>Date</th>                                            
                        <th class="">Actions</th>
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
          hitURL = "<?php echo base_url() ?>admin/case_details/delete2";
          var confirmation = confirm("Are you sure to delete this Case ?");
          if(confirmation)
          {
            $.ajax({
            type : 'POST',
            url :hitURL,
            data: {id:tableId}, 
            }).done(function(data){ 
              currentRow.parents('tr').remove();          
              if(data.status = true) { alert("successfully deleted"); }
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
            "url": "<?php echo site_url('admin/Case_details/ajax_list2/')?>",
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








