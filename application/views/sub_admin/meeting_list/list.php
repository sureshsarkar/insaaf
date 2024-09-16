<?php 
 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_GET['key']) && !empty($_GET['key'])){
    $data['id']=base64_decode($_GET['key']);
    $data['status']=1;
    $data['update_dt']=date("Y-m-d H:i:s");
   update_notification($data);
}
?>

<style>
.sdjfhilsjh {
    border: 1px solid #3c8dbc;

}

.hjggjugiu {
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
            <i class="fa fa-sitemap" aria-hidden="true"></i> Meeting Date List
            <small> Edit, Delete</small>
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
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Filter Meeting Date List
                                <span style="margin-left:10px;">
                                    <select id="shortBtn">
                                        <option value="upcoming"
                                            <?= (isset($_GET['meet']) && $_GET['meet'] == 'upcoming' )?"selected":''?>>
                                            Upcoming Meeting
                                        </option>

                                    </select>
                                </span>
                            </h3>
                            <div class="box-tools">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive sdjfhilsjh">
                            <table class="display " cellspacing="0" width="100%" id="example">
                                <thead>
                                    <tr class="hjggjugiu bg-1">
                                        <th>S.No.</th>
                                        <th>client Name</th>
                                        <th>Lawyer Name</th>
                                        <th>Meeting Time</th>
                                        <th>Join Meeting</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th class="">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
    </section>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
    //$('#example').DataTable();

    jQuery(document).on("click", ".deletebtn", function() {
        var tableId = $(this).attr("data_id");
        currentRow = $(this);
        hitURL = "<?php echo base_url() ?>sub_admin/meeting_list/delete";
        var confirmation = confirm("Are you sure to delete this Categorys ?");
        if (confirmation) {
            $.ajax({
                type: 'POST',
                url: hitURL,
                data: {
                    id: tableId
                },
            }).done(function(data) {
                currentRow.parents('tr').remove();
                if (data.status = true) {
                    alert("successfully deleted");
                    location.reload();
                } else if (data.status = false) {
                    alert("deletion failed");
                } else {
                    alert("Access denied..!");
                }
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
        url = url + 'sub_admin/meeting_list/?type=' + sortBy;
        //       alert(url);
        // return fasle;
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
function _fnGetTableData() {
    var getmeet_data = "<?php echo  isset($_GET['type'])?"?type=".$_GET['type']:''?>";

    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sub_admin/meeting_list/ajax_list')?>" + getmeet_data,
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