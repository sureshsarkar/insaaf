<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="__all__cases">
                        <i class="fa fa-sitemap"
                            aria-hidden="true"></i>&nbsp;&nbsp;<?= isset($_GET['type'])?$_GET['type']:'total'?> case
                        list

                        <a href="<?= base_url('client/cases?type=pending') ?>"
                            class="pull-right  btn btn-md btn-success __blink_dasg45 sdjfhilsjh"><i
                                class="bi bi-arrow-counterclockwise"></i> Pending Cases</a>
                        <a href="<?= base_url('client/cases') ?>"
                            class="pull-right  btn btn-md btn-success __blink_dasg45 sdjfhilsjh"><i
                                class="bi bi-list"></i> All
                            Cases</a>


                    </div>
                </div>
            </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 __badge">
                <div class="">
                    <div class="box-header __vtx__red sdjfhilsjh">
                        <h3 class="box-title"> Cases</h3>
                        <div class="box-tools">

                        </div>
                    </div><!-- /.box-header -->

                    <!-- /.box-header -->
                    <!-- deshtop view  -->
                    <div class="box-body table-responsive sdjfhilsjh __sn">
                        <table class="display admin_table" cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="__red_top">
                                    <th>S.No.</th>
                                    <th>Case Category</th>
                                    <th>Lawyer Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>


                    <!-- mobile view -->
                    <div class="mt-2 mobileDisplay">
                        <?php if(isset($caseData) && !empty($caseData)){
                        foreach ($caseData as $key => $value) {?>
                        <div class="mobile_box m-1">
                            <h4>
                                <?php echo $value->case_description?>
                            </h4>
                            <div class="d-flex flex-row mb-3">
                                <div class="p-2">
                                    <ul class="liHeading">
                                        <li>Case</li>
                                        <li>Lawyer</li>
                                        <li>Date</li>
                                        <li>Status</li>
                                    </ul>
                                </div>
                                <div class="p-2">
                                    <ul class="dataList">
                                        <li>: <?php echo $value->case_description?></li>
                                        <li>: <?php echo $value->fname.' '.$value->lname?></li>
                                        <li>: <?php echo date("d M Y",strtotime($value->dt))?></li>
                                        <li>:
                                            <?php echo ($value->status==1)?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Pending</span>'?>
                                        </li>

                                    </ul>
                                </div>
                                <div class="right__iconer"><a
                                        href="<?= base_url('client/cases/details/'.base64_encode($value->id).'?case_id='.$value->id)?>">
                                        <i class="bi bi-chevron-right h1"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php }}else{?>
                        <h1 class="text-warning">No data</h1>
                        <?php }?>
                        <!-- mobile view end  -->


                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
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
        hitURL = "<?php echo base_url() ?>client/cases/delete";
        var confirmation = confirm("Are you sure to delete?");
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
    var slug =
        "<?= (isset($_GET['type']) && $_GET['type'] == 'pending')?base_url('client/cases/ajax_list?type=pending'):base_url('client/cases/ajax_list') ?>";
    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": slug,
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