<style>
.seenNew {
    cursor: pointer;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sitemap" aria-hidden="true"></i>
            Direct Leads List
        </h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box p-2">
                    <div class="d-flex flex-row m-2">
                        <button type="button" class="btn btn-success clickPPC" data-value="all">All</button>
                        <button type="button" class="btn btn-info clickPPC" data-value="today">Today</button>
                        <button class="btn btn-danger deletByCheck">Delete</button>

                    </div>
                    <div class="box-header">
                        <h3 class="box-title">Filter Query List
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
                                    <th></th>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Category</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Device</th>
                                    <th>Network</th>
                                    <th>Info</th>
                                    <th>Feedback</th>
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
        hitURL = "<?php echo base_url() ?>admin/tempdata/delete";
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
        url = url + 'admin/tempdata?type=daterangefilter&from_date=' + from_date + '&to_date=' +
            to_date;
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
    var getcontact_data = "<?php echo  isset($_GET['type'])?'?type='.$_GET['type'].$from_date.$to_date:''?>";
    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/tempdata/ajax_list')?>" + getcontact_data,
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
        url = url + 'admin/tempdata?type=' + sortBy;
        window.location.href = url;
    })

    // reload page after 60 seconds
    setTimeout(function() {
        window.location.reload();
    }, 60000);


});
</script>
<!-- script to delete multiple -->
<script>
jQuery(document).ready(function() {

    $(".deletByCheck").attr('disabled', 'disabled');
    jQuery(document).on("click", ".checkbox", function() {
        var da = $("input:checkbox[name=checkbox]:checked");
        if (da.length != "") {
            jQuery(".deletByCheck").removeAttr("disabled");
        } else {
            $(".deletByCheck").attr('disabled', 'disabled');
        }
    });

    var allVals = [];
    jQuery(document).on("click", ".deletByCheck", function() {
        $("input:checkbox[name=checkbox]:checked").each(function() {
            allVals.push($(this).val());
        })
        if (allVals.length > 0) {
            var hitURL = "<?php echo base_url() ?>admin/tempdata/deleteByCheck";
            $.ajax({
                type: 'POST',
                url: hitURL,
                data: {
                    allVals: allVals
                },
            }).done(function(res) {
                if (res == 1) {
                    alert("Deleted Successfully");
                    location.reload();
                }
            });
        }
    });
})
</script>



<!-- seen data action  -->

<script>
$(document).ready(function() {
    jQuery(document).on("click", ".seenNew", function() {
        var id = $(this).attr('data-id');
        $(this).remove();
        _ajaxSeenNew(id);
    })

    function _ajaxSeenNew(id) {
        var hitURL = "<?php echo base_url() ?>admin/insleads/seenAuto";
        $.ajax({
            type: 'POST',
            url: hitURL,
            data: {
                id: id
            },
        }).done(function(res) {
            if (res == 1) {
                console.log("ok");
            }
        });

    }
});
</script>