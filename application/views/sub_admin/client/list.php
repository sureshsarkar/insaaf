<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sitemap" aria-hidden="true"></i> Clients
            <small> Edit, Delete</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>sub_admin/color/addnew"><i class="fa fa-plus"></i> Add New</a> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box p-2">
                    <div class="d-flex flex-row m-2">
                        <button type="button" class="btn btn-success clickClient" data-value="all">All Client</button>
                        <button type="button" class="btn btn-success clickClient" data-value="close">Active
                            Client</button>
                        <!-- <button type="button" class="btn btn-info clickClient" data-value="new_lawyer">New Client</button> -->
                    </div>
                    <div class="box-header">
                        <h3 class="box-title">Filter Query List
                            <span style="margin-left:10px;">
                                <select id="shortBtn">
                                    <option value="all">All</option>
                                    <!-- <option value="new_lawyer"
                                            <?= (isset($_GET['type']) && $_GET['type'] == 'new_lawyer' )?"selected":''?>>New Lawyers
                                        </option> -->
                                    <option value="close"
                                        <?= (isset($_GET['type']) && $_GET['type'] == 'close' )?"selected":''?>>Active
                                    </option>
                                </select>
                            </span>
                            <span style="margin-left:10px;">
                                <input type="Date" class="text-black date_pic from_date" placeholder="To Date">
                            </span>

                            <span style="margin-left:10px;">To</span>

                            <span style="margin-left:10px;">
                                <input type="Date" class="text-black date_pic to_date" placeholder="To Date">
                            </span>
                            <span class="find_by_date" style="margin-left:10px;"><i
                                    class="bi bi-arrow-right-circle-fill fs-1"></i></span>
                        </h3>
                        <div class="box-tools">

                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="display " cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="bg-8" style="background: #b3d8f7; margin-buttom:10px;">
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Client ID</th>
                                    <th>Mobile</th>
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
jQuery(document).ready(function() {
    //$('#example').DataTable();

    jQuery(document).on("click", ".deletebtn", function() {
        var tableId = $(this).attr("data_id");
        currentRow = $(this);
        hitURL = "<?php echo base_url() ?>sub_admin/client/delete";
        var confirmation = confirm("Are you sure to delete this Client ?");
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
        url = url + 'sub_admin/client?type=' + sortBy;
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
    <?php
         $from_date = isset($_GET['from_date'])?'&from_date='.$_GET['from_date']:"";
         $to_date = isset($_GET['to_date'])?'&to_date='.$_GET['to_date']:"";
    ?>
    var getclient_data = "<?php echo  isset($_GET['type'])?'?type='.$_GET['type'].$from_date.$to_date:''?>";


    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sub_admin/client/ajax_list')?>" + getclient_data,
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
    $(".clickClient").click(function() {
        var sortBy = $(this).attr("data-value");
        var url = "<?php echo base_url();?>";
        url = url + 'sub_admin/client?type=' + sortBy;
        window.location.href = url;

    })

});
</script>

<!-- Get Databse List by date  -->
<script type="text/javascript">
$(document).ready(function() {
    $(".find_by_date").click(function() {

        var from_date = $(".from_date").val();
        var to_date = $(".to_date").val();
        if (from_date == '' || to_date == '') {
            alert("Please select dates");
            return false;
        }
        var url = "<?php echo base_url();?>";
        url = url + 'sub_admin/client/?type=daterangefilter&from_date=' + from_date + '&to_date=' +
            to_date;
        window.location.href = url;
    });
});
</script>