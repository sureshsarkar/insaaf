<style>
.sdjfhilsjh {
    border: 1px solid #3c8dbc;

}

.hjggjugiu {
    border: 1px solid #3c8dbc;
    background: #9ee9c7;
    border-bottom: 1px solid #042900;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <!-- <?php foreach($client_name as $client_value){
       $fname=$client_value->fname;
       $lname=$client_value->lname;
        $fullname=$fname.' '.$lname;
     }
       ?> -->
            <?php if(!empty($total_cases)){
         foreach($total_cases as $case_details){
              $case_id = $case_details->id;
              }}?>
            <i class="fa fa-sitemap" aria-hidden="true"></i>All Case List
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <?php
               $this->load->helper('form');
              
          
               $success = $this->session->flashdata('success');
               if($success)
               {
               ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            <div class="col-xs-12 text-right">
                <div class="form-group">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box p-2">
                    <div class="d-flex flex-row m-2">
                        <button type="button" class="btn btn-primary clickCase" data-value="over">Meeting Done</button>
                        <button type="button" class="btn btn-success clickCase" data-value="close">Active</button>
                        <button type="button" class="btn btn-warning clickCase" data-value="open">Pending</button>
                        <button type="button" class="btn btn-primary clickCase" data-value="1">Today</button>
                        <button type="button" class="btn btn-warning clickCase" data-value="7">Weekly</button>
                        <button type="button" class="btn btn-info clickCase" data-value="30">Monthly</button>
                        <button type="button" class="btn btn-success clickCase" data-value="365">Yearly</button>
                        <button type="button" class="btn btn-warning clickCase" data-value="PPC">PPC</button>
                        <button type="button" class="btn btn-info clickCase" data-value="SEO">SEO</button>
                    </div>
                    <div class="box-header">
                        <!-- <h3 class="box-title"> Case List</h3> -->
                        <h3 class="box-title">Filter Query List
                            <span style="margin-left:10px;">
                                <select id="shortBtn">
                                    <option value="all">Sort By</option>
                                    <option value="open"
                                        <?= (isset($_GET['type']) && $_GET['type'] == 'open' )?"selected":''?>>Pending
                                    </option>
                                    <option value="close"
                                        <?= (isset($_GET['type']) && $_GET['type'] == 'close' )?"selected":''?>>Active
                                    </option>
                                    <option value="over"
                                        <?= (isset($_GET['type']) && $_GET['type'] == 'over' )?"selected":''?>>Meeting
                                        Over
                                    </option>
                                    <option value="1"
                                        <?= (isset($_GET['type']) && $_GET['type'] == '1' )?"selected":''?>>Today
                                    </option>
                                    <option value="7"
                                        <?= (isset($_GET['type']) && $_GET['type'] == '7' )?"selected":''?>>Last 7 Days
                                    </option>
                                    <option value="30"
                                        <?= (isset($_GET['type']) && $_GET['type'] == '30' )?"selected":''?>>Last 30
                                        Days
                                    </option>
                                    <option value="365"
                                        <?= (isset($_GET['type']) && $_GET['type'] == '365' )?"selected":''?>>Last 365
                                        Days
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
                    <div class="box-body table-responsive sdjfhilsjh">
                        <table class="display" cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="hjggjugiu bg-2">
                                    <th>S.No.</th>
                                    <th>Case Category</th>
                                    <th>Asign Lawyer</th>
                                    <th>Client Name</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Meeting Time</th>
                                    <th>Create At</th>
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
        hitURL = "<?php echo base_url() ?>sub_admin/case_details/delete1";
        var confirmation = confirm("Are you sure to delete this Case ?");
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

<!-- Get Databse List -->
<script type="text/javascript">
$(document).ready(function() {
    $("#shortBtn").change(function() {
        var sortBy = $(this).val();

        var url = "<?php echo base_url();?>";
        url = url + 'sub_admin/case_details/?type=' + sortBy;
        //       alert(url);
        // return fasle;
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
    var getcase_data = "<?php echo  isset($_GET['type'])?'?type='.$_GET['type'].$from_date.$to_date:''?>";

    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('sub_admin/case_details/ajax_list1')?>" + getcase_data,
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
    $(".clickCase").click(function() {
        var sortBy = $(this).attr("data-value");
        var url = "<?php echo base_url();?>";
        url = url + 'sub_admin/case_details?type=' + sortBy;
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
        url = url + 'sub_admin/case_details/?type=daterangefilter&from_date=' + from_date +
            '&to_date=' +
            to_date;
        window.location.href = url;
    });
});
</script>