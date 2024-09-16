<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sitemap" aria-hidden="true"></i>
            Follow Up List
            <small> Edit, Delete</small>
        </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/calling/addnew"><i
                            class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <div class="col-xs-12">
            <div class="box p-2">
                    <div class="d-flex flex-row m-2">
                        <button type="button" class="btn btn-success clickPPC" data-value="all">All Follow Up</button>
                        <button type="button" class="btn btn-info clickPPC" data-value="today">Today Follow Up</button>
                        <button type="button" class="btn btn-warning clickPPC" data-value="upcomming">Upcomming Follow Up</button>
                    </div>
                    <div class="box-header">
                        <h3 class="box-title">Filter Query List
                            <span style="margin-left:10px;">
                                <select id="shortBtn">
                                    <option value="all">Sort By</option>
                                        <option value="today"
                                            <?= (isset($_GET['type']) && $_GET['type'] == 'today' )?"selected":''?>>Today
                                        </option>
                                        <option value="upcomming"
                                            <?= (isset($_GET['type']) && $_GET['type'] == 'upcomming' )?"selected":''?>>Upcomming
                                        </option>
                                </select>
                            </span>
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
                                    <th>Mobile</th>
                                    <th>State</th>
                                    <th>Next Follow up </th>
                                    <th>subject</th>
                                    <th>Date</th>
                                    <th>Actions</th>
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
<!-- Delete Script-->
<script type="text/javascript">
jQuery(document).ready(function() {
    //$('#example').DataTable();
    jQuery(document).on("click", ".deletebtn", function() {
        var tableId = $(this).attr("data_id");
        currentRow = $(this);
        hitURL = "<?php echo base_url() ?>admin/calling/delete";
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
        url = url + 'admin/calling?type=' + sortBy;
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
    var getcontact_data = "<?php echo  isset($_GET['type'])?"?type=".$_GET['type']:''?>";
    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/calling/ajax_list')?>" + getcontact_data,
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
    $(".clickPPC").click(function() {
        var sortBy = $(this).attr("data-value");
        var url = "<?php echo base_url();?>";
          url = url + 'admin/calling?type=' + sortBy;
        window.location.href = url;

    })

});
</script>