<?php 
 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_GET['key']) && !empty($_GET['key'])){
    $data['id']=base64_decode($_GET['key']);
    $data['status']=1;
    $data['update_dt']=date("Y-m-d H:i:s");
   update_notification($data);
}
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sitemap" aria-hidden="true"></i> Documentation List
            <small> Edit, Delete</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-body table-responsive sdjfhilsjh">
                    <table class="display " cellspacing="0" width="100%" id="example">
                        <thead>
                            <tr class="bg-9" style="background: #9ee9c7;">
                                <th>S.No.</th>
                                <th>client Name</th>
                                <th>Document Name</th>
                                <th>Payment Status</th>
                                <th>Date</th>
                                <th class="">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>

                <!-- mobile view -->
                <div class="mt-2 mobileDisplay">
                    <?php if(isset($documentationData) && !empty($documentationData)){
                        foreach ($documentationData as $key => $value) {?>
                    <div class="mobile_box m-1">
                        <div class="d-flex flex-row mb-3">
                            <div class="p-2">
                                <ul class="liHeading">
                                    <li>Name</li>
                                    <li>Type</li>
                                    <li>Payment</li>
                                    <li>Date</li>
                                </ul>
                            </div>
                            <div class="p-2">
                                <ul class="dataList">
                                    <li class="msgTest">: <?php echo $value->fname.' '. $value->lname;?></li>
                                    <li class="msgTest">: <?php echo $value->sub_sub_category_name;?></li>

                                    <li>:
                                        <?php echo ($value->payment_status=="Success")?'<span class="badge bg-success">Success</span>':'<span class="badge bg-danger">Pending</span>'?>
                                    </li>
                                    <li>: <?php echo date("d M Y",strtotime($value->dateAt))?></li>

                                </ul>
                            </div>
                            <div class="right__iconer"><a
                                    href="<?= base_url('client/documentationList/view/'.base64_encode($value->id))?>">
                                    <i class="bi bi-chevron-right h1"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php }}else{?>
                    <h1 class="text-warning">No data</h1>
                    <?php }?>
                    <!-- mobile view end  -->

                </div><!-- /.box -->
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
        hitURL = "<?php echo base_url() ?>admin/Certificare/delete";
        var confirmation = confirm("Are you sure to delete Certificate request ?");
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
        url = url + 'client/documentationList/?type=' + sortBy;
        window.location.href = url;
    });
});
</script>

<!-- Get Databse List -->
<script type="text/javascript">
var table;

$(document).ready(function() {
    _fnGetTableData(); // call function to get data by GET method

});

// function get table data from data base
function _fnGetTableData() {
    var getcertificate_data = "<?php echo  isset($_GET['type'])?"?type=".$_GET['type']:''?>";

    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('client/documentationList/ajax_list')?>" + getcertificate_data,
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