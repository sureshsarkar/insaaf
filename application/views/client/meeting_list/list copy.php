<style>

</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="__all__cases">
                        <i class="fa fa-sitemap" aria-hidden="true">&nbsp;&nbsp;</i>Meeting List
                        <a href="<?= base_url('client/meeting?type=upcoming') ?>"
                            class="pull-right  btn btn-md btn-success __blink_dasg45 m-1 p-1"><i
                                class="bi bi-arrow-counterclockwise"></i> Upcoming Meetings</a>
                        <a href="<?= base_url('client/meeting') ?>"
                            class="pull-right  btn btn-md btn-info __blink_dasg45 m-1 p-1"><i class="bi bi-list"></i>
                            All
                            Meetings</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content"><?php echo $this->session->flashdata('message'); ?>
        <div class="row">
            <div class="col-xs-12 __badge">
                <div class="">
                    <div class="box-header __vtx__red">
                        <h3 class="box-title"> Meeting List </h3>
                        <div class="box-tools">

                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive sdjfhilsjh">
                        <table class="display " cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="__green__vtx322354">
                                    <th>S.No.</th>
                                    <th>Case</th>
                                    <th>Assign Lawyer</th>
                                    <th>Meeting date</th>
                                    <th>Meeting Time</th>
                                    <th>Meeting Link</th>
                                    <th>Status</th>
                                    <th></th>
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
    var type = "<?php echo (isset($_GET['type']))?'?type='.$_GET['type']:'' ?>";
    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('client/meeting/ajax_list')?>" + type,
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