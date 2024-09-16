

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<style>
  .sdjfhilsjh{
    border: 1px solid #3c8dbc;

  }
  .hjggjugiu{
    border: 1px solid #3c8dbc;
    background: #9ee9c7;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sitemap" aria-hidden="true"></i> Schedule List
            <small> Edit, Delete</small>
        </h1>
    </section>
    <?php $lawyer_id= $lawyer_name[0];?>

    <section class="content">
        <!-- <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModalqq" href=""><i
                            class="fa fa-plus"></i> Add New Schedule</a>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="box-tools">

                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive sdjfhilsjh" >
                        <table class="display " cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="hjggjugiu" >    
                                    <th>S.No.</th>
                                    <th>Lawyer Name</th>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Adding Date</th>
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
        hitURL = "<?php echo base_url() ?>admin/Lawyer_scheduler/delete";
        var confirmation = confirm("Are you sure to delete Hearing date ?");
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
var table;

$(document).ready(function() {

    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/Lawyer_scheduler/ajax_list/'.$lawyer_id->id)?>",
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


<div class="modal fade" id="exampleModalqq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="swing-top-fwd" style="font-family: Playfair Display;color:#04367d">Add A New Lawyer Schedule
                    Date </h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation " id="lawyer_sche"
                    action1="<?=base_url()?>admin/Lawyer_scheduler/insertnow/" method="post">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div id="collapseOne" class="show collapse biiling_details_bg" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="conjk" style="color:red;"></div>
                                    <div class="row " style="padding-bottom:19px;">
                                        <div class="col-md-12">

                                            <label for="text">Lawyer Name <span class="text-muted">*</span></label>
                                            <input type="text" class="form-control new_control "
                                                value="<?=$lawyer_id->fname.'' .$lawyer_id->lname?>" readonly>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="text">Date <span class="text-muted">*</span></label>
                                                    <input type="date" class="form-control new_control "
                                                        name="schedule_date" id="schedule_date" value="">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="text">Time <span class="text-muted">*</span></label>
                                                    <input type="time" class="form-control new_control "
                                                        name="schedule_time" id="schedule_time" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary click1 "
                                    style="background-color:#04367d;color:white;"
                                    data-lawyerID="<?=$lawyer_id->id?>">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).on('click', '.click1', function() {
    // $(".click1").prop('disabled',true);
    var url = $("#lawyer_sche").attr("action1");
    var schedule_date = $("#schedule_date").val();
    var schedule_time = $("#schedule_time").val();
    var lawyerID = $(".click1").attr("data-lawyerID");

    $.ajax({
        type: "POST",
        url: url,
        data: {
            lawyer_id: lawyerID,
            schedule_date: schedule_date,
            schedule_time: schedule_time,

        },
        success: function(fb) {
            console.log(fb);
            var resp = $.parseJSON(fb);
            if (resp.status == 'true1') {
                $(".conjk").show().html(
                    '<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please fill the form correcty</div>'
                );
                return true;
            } else if (resp.status == 'true2') {
                $(".lawshdfj").show().html(
                    '<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> You have successfully Added a lawyer schedule </div>'
                );
                window.location.href = resp.reload;
                return true;

            }
        }
    });
    return false;

});
</script>