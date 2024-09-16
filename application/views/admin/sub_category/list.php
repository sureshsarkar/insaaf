<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <i class="fa fa-sitemap" aria-hidden="true"></i>Sub Category
        <small>Add, Edit</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/sub_category/addnew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
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
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Sub Category List</h3>
                     <div class="box-tools">
                         
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table class="display" cellspacing="0" width="100%" id="example">
                    <thead>
                    <tr style="background: #b3d8f7; margin-buttom:10px;">
                        <th >S.No.</th>
                        <th>Category</th>                                                                                     
                        <th>Sub Category</th>                                            
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
          hitURL = "<?php echo base_url() ?>admin/Sub_category/delete";
          var confirmation = confirm("Are you sure to delete this Categorys ?");
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
            "url": "<?php echo site_url('admin/sub_category/ajax_list')?>",
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








