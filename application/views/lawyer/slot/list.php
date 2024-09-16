<!-- <?php 
 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_GET['key']) && !empty($_GET['key'])){
    $data['id']=base64_decode($_GET['key']);
    $data['status']=1;
    $data['update_dt']=date("Y-m-d H:i:s");
   update_notification($data);
}
?> -->
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
            <i class="fa fa-sitemap" aria-hidden="true"></i> Slot List
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
                        <h3 class="box-title">Filter Slot List
                            <span style="margin-left:10px;">
                                <select id="shortBtn">
                                    <option value="all">Sort By</option>
                                    <option value="all"
                                        <?= (isset($_GET['slot']) && $_GET['slot'] == 'all' )?"selected":''?>>All Data
                                    </option>
                                    <option value=<?=base64_encode(1)?>
                                        <?= (isset($_GET['meet']) && $_GET['meet'] == '1' )?"selected":''?>>Today
                                    </option>
                                    <option value=<?=base64_encode(7)?>
                                        <?= (isset($_GET['slot']) && $_GET['slot'] == '7' )?"selected":''?>>Weekly
                                    </option>
                                    <option value=<?=base64_encode(30)?>
                                        <?= (isset($_GET['slot']) && $_GET['slot'] == '30' )?"selected":''?>>Monthly
                                    </option>
                                    <option value=<?=base64_encode(365)?>
                                        <?= (isset($_GET['slot']) && $_GET['slot'] == '365' )?"selected":''?>>Yearly
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
                                <tr class="hjggjugiu">
                                    <th>S.No.</th>
                                    <th>client Name</th>
                                    <th>client Code</th>
                                    <th>Slot date</th>
                                    <th>Time</th>
                                    <th>period</th>
                                    <!-- <th>Contact Type</th> -->
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
<!-- end code for multiple delete  -->
<script type="text/javascript">
      $(document).ready(function(){
        $("#shortBtn").change(function(){
            var sortBy =  $(this).val();
            var url = "<?php echo base_url();?>";
              url = url+'lawyer/Slot?slot='+sortBy;
              window.location.href = url;
        });
    });
  </script>

<!-- Delete Script-->
<script type="text/javascript">
jQuery(document).ready(function() {

    //$('#example').DataTable();
    jQuery(document).on("click", ".deletebtn", function() {
        var tableId = $(this).attr("data_id");
        currentRow = $(this);
        hitURL = "<?php echo base_url() ?>lawyer/slot/delete";
        var confirmation = confirm("Are you sure to delete slot");
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
<!-- Get Databse List -->
<script type="text/javascript">
var table;

$(document).ready(function() {
  var getslot_data = "<?php echo  isset($_GET['slot'])?"?slot=".$_GET['slot']:''?>";
    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('lawyer/slot/ajax_list/')?>"+getslot_data,
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
        }, ],

    });
});
</script>