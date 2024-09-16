<?php 
 date_default_timezone_set('Asia/Kolkata'); 
?>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sitemap" aria-hidden="true"></i> Lawyers
            <small> Edit, Delete</small>
        </h1>
    </section>
    <section class="content">
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
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/color/addnew"><i class="fa fa-plus"></i> Add New</a> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box p-2">
                    <div class="d-flex flex-row m-2">
                        <button type="button" class="btn btn-success clickLawyer" data-value="close">Active
                            Lawyers</button>
                        <button type="button" class="btn btn-warning clickLawyer" data-value="open">Pending
                            Lawyers</button>
                        <button type="button" class="btn btn-info clickLawyer" data-value="under_review">Under Review
                            Lawyers</button>
                        <button type="button" class="btn btn-danger clickLawyer" data-value="blocked">Blocked
                            Lawyers</button>
                        <button type="button" class="btn btn-success clickLawyer" data-value="male">Male</button>
                        <button type="button" class="btn btn-warning clickLawyer" data-value="female">Female</button>
                    </div>
                    <div class="box-header">
                        <h3 class="box-title">Filter Query List
                            <span style="margin-left:10px;">
                                <select id="shortBtn">
                                    <option value="all">Sort By</option>
                                    <option value="under_review"
                                        <?= (isset($_GET['type']) && $_GET['type'] == 'under_review' )?"selected":''?>>
                                        Under Review Lawyers
                                    </option>
                                    <option value="open"
                                        <?= (isset($_GET['type']) && $_GET['type'] == 'open' )?"selected":''?>>Pending
                                        Lawyers
                                    </option>
                                    <option value="close"
                                        <?= (isset($_GET['type']) && $_GET['type'] == 'close' )?"selected":''?>>Active
                                        Lawyers
                                    </option>
                                    <option value="blocked"
                                        <?= (isset($_GET['type']) && $_GET['type'] == 'blocked' )?"selected":''?>>
                                        Blocked Lawyers
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
                        <table class="display" cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="bg-4" style="background: #b3d8f7; margin-buttom:10px; ">
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Lawyer ID</th>
                                    <th>Mobile</th>
                                    <th>Profile</th>
                                    <!-- <th>Email</th> -->
                                    <th>Concluded Meet</th>
                                    <th>Earn</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
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
        hitURL = "<?php echo base_url() ?>admin/lawyer/delete";
        var confirmation = confirm("Are you sure to delete this Lawyer ?");
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
<!-- Change Lawyer session_status  -->

<script type="text/javascript">
jQuery(document).ready(function() {
    //$('#example').DataTable();

    jQuery(document).on("change", ".lawyerStatus", function() {
        var lawyer_id = $(this).attr("data-id");
        var statusValue = $(this).val();
        hitURL = "<?php echo base_url() ?>admin/lawyer/update_lawyer_status";
        var confirmation = confirm("Are you sure to update Lawyer status ?");
        if (confirmation) {
            $.ajax({
                type: 'POST',
                url: hitURL,
                data: {
                    lawyerId: lawyer_id,
                    status: statusValue
                },
            }).done(function(data) {
                if (data == 1) {
                    alert("Status updated successfully !");
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
        url = url + 'admin/lawyer?type=' + sortBy;
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
         $type = isset($_GET['type'])?'type='.$_GET['type']:"";
         $status = isset($_GET['status'])?'status='.$_GET['status']:"";
    ?>
    var getlawyer_data =
        "<?php echo  isset($_GET['daterange'])?'?daterange='.$_GET['daterange'].$from_date.$to_date."&".$status:"?".$type."&".$status?>";


    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/lawyer/ajax_list')?>" + getlawyer_data,
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
// get lawyer list by click the active,pending, new & blocked 

$(document).ready(function() {
    $(".clickLawyer").click(function() {
        let sortBy;
        var type = "<?php echo  isset($_GET['type'])?$_GET['type']:"";?>";
        let status = "<?php echo  isset($_GET['status'])?$_GET['status']:"";?>";

        sortBy = $(this).attr("data-value");

        if (sortBy == "male" || sortBy == "female") {
            status = sortBy;
        } else {
            type = sortBy;
        }
        var url = "<?php echo base_url();?>";
        url = url + 'admin/lawyer?type=' + type + "&status=" + status;
        window.location.href = url;

    })

});
</script>

<!-- Get Databse List by date  -->
<script type="text/javascript">
$(document).ready(function() {
    $(".find_by_date").click(function() {
        var type = "<?php echo  isset($_GET['type'])?$_GET['type']:"";?>";
        var status = "<?php echo  isset($_GET['status'])?$_GET['status']:"";?>";

        var from_date = $(".from_date").val();
        var to_date = $(".to_date").val();
        if (from_date == '' || to_date == '') {
            alert("Please select dates");
            return false;
        }
        var url = "<?php echo base_url();?>";
        url = url + 'admin/lawyer/?type=daterangefilter&from_date=' + from_date + '&to_date=' +
            to_date;
        url = url + '&status=' + status;
        window.location.href = url;
    });
});
</script>