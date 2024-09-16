<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="__all__cases">
                        <i class="fa fa-sitemap" aria-hidden="true">&nbsp;&nbsp;</i>My Transactions


                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 __badge">
                <div class="">
                    <div class="box-header __vtx__red sdjfhilsjh mb-2">
                        <h3 class="box-title"> Transactions List </h3>
                        <div class="box-tools">

                        </div>
                    </div><!-- /.box-header -->


                    <div class="box-body table-responsive sdjfhilsjh">
                        <table class="display " cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class=" __orange_vtx">
                                    <th>S.No.</th>
                                    <th>Total Amount</th>
                                    <th>Payment Type</th>
                                    <th>Payment Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div><!-- /.box-body -->


                    <!-- mobile view -->
                    <div class="mt-2 mobileDisplay">
                        <?php if(isset($paymentData) && !empty($paymentData)){
                        foreach ($paymentData as $key => $value) {?>
                        <div class="mobile_box m-1">
                            <h4>
                                <?php echo $value->payment_type?>
                            </h4>
                            <div class="d-flex flex-row mb-3">
                                <div class="p-2">
                                    <ul class="liHeading">
                                        <li>Amount</li>
                                        <li>Payment Type</li>
                                        <li>Status</li>
                                        <li>Date</li>
                                    </ul>
                                </div>
                                <div class="p-2">
                                    <ul class="dataList">
                                        <li>: ₹<?php echo $value->amount?></li>
                                        <li>: <?php echo $value->payment_type?></li>
                                        <li>:
                                            <?php echo ($value->payment_status=='Success')?'<span class="badge bg-success">Success</span>':'<span class="badge bg-danger">Pending</span>'?>
                                        </li>
                                        <li>: <?php echo date("d M Y A",strtotime($value->payment_date))?></li>
                                    </ul>
                                </div>
                                <div class="right__iconer"><a class="btn btn-sm btn-info" style="margin: 5px 0px;"
                                        href="<?= base_url().'utils/invoices/'.$value->pdfname.$value->user_id.'invoice.pdf'?>"
                                        title="Edit" target="_blank"><i class="fa fa-download"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php }}else{?>
                        <h1 class="text-warning">No data</h1>
                        <?php }?>
                        <!-- mobile view end  -->

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
        hitURL = "<?php echo base_url() ?>client/Client_payment/delete";
        var confirmation = confirm("Are you sure to delete this Payment ?");
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
            "url": "<?php echo site_url('client/payment/ajax_list')?>",
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