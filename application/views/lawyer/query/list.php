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
        <div class="container-fluid ">
            <div class="for_Upk__list_lawyer">
                <i class="fa fa-sitemap" aria-hidden="true"></i> Querie Meeting
                <small> Edit, Delete</small>
            </div>
        </div>
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
                        <h3 class="box-title">Total Querie List </h3>
                        <div class="box-tools">

                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="display " cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="hjggjugiu">
                                    <th>S.No.</th>
                                    <th>Message</th>
                                    <th>Assign Client</th>
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
jQuery(document).ready(function() {
    //$('#example').DataTable();

    jQuery(document).on("click", ".deletebtn", function() {
        var tableId = $(this).attr("data_id");
        currentRow = $(this);
        hitURL = "<?php echo base_url() ?>client/Meeting_list/delete";
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
            "url": "<?php echo site_url('lawyer/query/ajax_list')?>",
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

<style>
.wrapText {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    width: 200px;
}
</style>