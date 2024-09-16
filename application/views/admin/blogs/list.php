<style>
  .sdjfhilsjh{
    border: 1px solid #3c8dbc;

  }
  .hjggjugiu{
    border: 1px solid #3c8dbc;
    background: #9ee9c7;
    border-bottom: 1px solid #042900;
  }
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <i class="fa fa-sitemap" aria-hidden="true"></i>Blogs
        <small>Add, Edit</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 ">
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
                <div class="form-group text-right">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/blogs/addnew"><i class="fa fa-plus "></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
            <div class="box p-2">
                    <div class="d-flex flex-row m-2">
                        <button type="button" class="btn btn-success clickBlog" data-value="close">Active</button>
                        <button type="button" class="btn btn-warning clickBlog" data-value="open">Pending</button>
                        <button type="button" class="btn btn-primary clickBlog" data-value="1">Today</button>
                        <button type="button" class="btn btn-warning clickBlog" data-value="7">Weekly</button>
                        <button type="button" class="btn btn-info clickBlog" data-value="30">Monthly</button>
                        <button type="button" class="btn btn-success clickBlog" data-value="365">Yearly</button>
                    </div>
                <div class="box-header">
                    <h3 class="box-title">Blogs </h3>
                     <div class="box-tools">
                         
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive sdjfhilsjh">
                  <table class="display" cellspacing="0" width="100%" id="example">
                    <thead>
                      <tr class="hjggjugiu bg-6">
                        <th >S.No.</th>
                        <th>Title</th>                                           
                        <th>Name</th>                                           
                        <th>Trending</th>                                           
                        <th>Status</th>                                            
                        <th>Date</th>                                            
                        <th>Actions</th>
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
          hitURL = "<?php echo base_url() ?>admin/blogs/delete";
          var confirmation = confirm("Are Your Deleted Blog ?");
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
$(document).ready(function() {
    jQuery(document).on("change", ".trending", function() {
   
        var id = $(this).attr('data_id');
        var columnName = $(this).attr('data_colname');
        var status = 0;
        hitURL = "<?php echo base_url() ?>admin/blogs/changestatus";
        if ($(this).is(':checked')) {
            status = 1;
        } else {
            status = 0;
        }
        $.ajax({
            url: hitURL,
            method: "POST",
            data: {
                status: status,
                id: id,
                columnName: columnName
            },
            success: function(data) {},
        });
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
function _fnGetTableData() {
    var getcontact_data = "<?php echo  isset($_GET['type'])?"?type=".$_GET['type']:''?>";
    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/blogs/ajax_list')?>" + getcontact_data,
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
        }, ],
    });
}
</script>


<script>
// get lawyer list by click the active,pending& new  

$(document).ready(function() {
    $(".clickBlog").click(function() {
        var sortBy = $(this).attr("data-value");
        var url = "<?php echo base_url();?>";
          url = url + 'admin/blogs?type=' + sortBy;
        window.location.href = url;

    })

});
</script>








