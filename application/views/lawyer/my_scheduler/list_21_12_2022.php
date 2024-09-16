<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

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
  .schedule_time{
    font-size: 25px;
    padding-left: 20px;
  }
 ._size{
    padding-left:30px;
    font-size:24px;
  }
 ._size1{
    padding-left:30px;
    padding-right:30px;
    font-size:24px;
  }
 ._size24{
   
    font-size:20px;
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
        <div class="row">
            <div class="col-md-12 text-right">
            <!-- <div class="conjqqqqk" style="color:green;"></div> -->
                <div class="form-group">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModalqqqq" href=""><i
                            class="fa fa-plus"></i> Add New Schedule</a>
                </div>
            </div>
        </div>
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
        hitURL = "<?php echo base_url() ?>lawyer/My_scheduler/delete";
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
            "url": "<?php echo site_url('lawyer/My_scheduler/ajax_list/'.$lawyer_id->id)?>",
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
<div class="modal fade" id="exampleModalqqqq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    action1="<?=base_url()?>lawyer/My_scheduler/insertnow/" method="post">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div id="collapseOne" class="show collapse biiling_details_bg" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="conjk" style="color:red;"></div>
                                    <div class="row " style="padding-bottom:19px;">
                                        <div class="col-md-12">

                                            <label for="text" class="_size24">Lawyer Name <span class="text-muted">*</span></label>
                                            <input type="text" class="form-control new_control "
                                                value="<?=$lawyer_id->fname.'' .$lawyer_id->lname?>" readonly>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="text" class="_size24"> Selected Date <span class="text-muted">*</span></label>
                                                    <input type="text" placeholder="Click to Select date" class="form-control new_control" name="schedule_date" id="schedule_date"  value="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                 <div class="col-md-12">
                                                 <label for="text" class="_size24">Time <span class="text-muted">*</span></label><br>
                                                    <input type="checkbox" class="select_all" id="selectAll"  value=""><span class="_size">Select All Time Schedule </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time1" name="schedule_time[]" value="09:00 am"> <span  class="_size">09:00 am <span  class="_size1">to</span> 10:00 am </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time2" name="schedule_time[]" value="10:00 am"> <span class="_size"> 10:00 am <span  class="_size1">to</span> 11:00 am </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time3" name="schedule_time[]" value="11:00 am"> <span class="_size"> 11:00 am <span  class="_size1">to</span> 12:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time4" name="schedule_time[]" value="12:00 pm"> <span class="_size"> 12:00 pm <span  class="_size1">to</span> 01:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time5" name="schedule_time[]" value="01:00 pm"> <span class="_size"> 01:00 pm <span  class="_size1">to</span> 02:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time6" name="schedule_time[]" value="02:00 pm"> <span class="_size"> 02:00 pm <span  class="_size1">to</span> 03:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time7" name="schedule_time[]" value="03:00 pm"> <span class="_size"> 03:00 pm <span  class="_size1">to</span> 04:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time8" name="schedule_time[]" value="04:00 pm"> <span class="_size"> 04:00 pm <span  class="_size1">to</span> 05:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time9" name="schedule_time[]" value="05:00 pm"> <span class="_size"> 05:00 pm <span  class="_size1">to</span> 06:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time10" name="schedule_time[]" value="06:00 pm"> <span class="_size"> 06:00 pm <span  class="_size1">to</span> 07:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time11" name="schedule_time[]" value="07:00 pm"> <span class="_size"> 07:00 pm <span  class="_size1">to</span> 08:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time12" name="schedule_time[]" value="08:00 pm"> <span class="_size"> 08:00 pm <span  class="_size1">to</span> 09:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time13" name="schedule_time[]" value="09:00 pm"> <span class="_size"> 09:00 pm <span  class="_size1">to</span> 10:00 pm </span><br>
                                                    <input type="checkbox" class="scheduleT" id="schedule_time14" name="schedule_time[]" value="10:00 pm"> <span class="_size"> 10:00 pm <span  class="_size1">to</span> 11:00 pm </span><br><br>
                                                    <input type="checkbox" class="scheduleT" id="enter_time" name="schedule_time[]" value=""><input type="time" class="form-control _other_time" name="_other_time" style="width:300px;margin-left:44px;margin-top:-24px;" value=""><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary click1 "
                                    style="background-color:#04367d;color:white;"
                                    data-lawyerID="<?=$lawyer_id->id?>">Submit</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Js link Convet time in 24 hour to 12 hour formate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<!-- check all  js start -->
<script>
    $(document).ready(function(){
$("#selectAll").click(function(){
        if(this.checked){
            $('.scheduleT').each(function(){
                $(".scheduleT").prop('checked', true);
            })
        }else{
            $('.scheduleT').each(function(){
                $(".scheduleT").prop('checked', false);
            })
        }
    });
});
  </script>
<!-- check all  js end -->
<script>
 $(document).ready(function(){
$(document).on('click', '.click1', function() {

    // $(".click1").prop('disabled',true);
    var url = $("#lawyer_sche").attr("action1");
    var schedule_date = $("#schedule_date").val();
    var lawyerID = $(".click1").attr("data-lawyerID");
    var schedule_time =[];

    $(".scheduleT").each(function(){
        if($(this).is(":checked")){
            schedule_time.push($(this).val());
        }
        
    });
    schedule_time=schedule_time.toString();
    // alert(schedule_time);
    $.ajax({
        type: "POST",
        url: url,
        data: {
            lawyer_id: lawyerID,
            schedule_date: schedule_date,
            schedule_time: schedule_time
        },
        success: function(fb) {
            console.log(fb);
            var resp = $.parseJSON(fb);
            if (resp.status == 'true1') {
                $(".conjk").show().html(
                    '<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please fill the form correcty</div>'
                );
                return true;
            }
            else if(resp.status == 'true3') {
                $(".conjk").show().html(
                    '<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>This date is already Exist! </div>'
                );
                return true;
            }
            else if (resp.status == 'true2') {
                $(".conjqqqqk").show().html(
                    '<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> You have successfully Added a lawyer schedule </div>'
                );
                window.location.href = resp.reload;
                return true;
            }
        }
    });
    return false;
});
});
</script>
<script>
$(document).ready(function(){
  $(":checkbox").wrap();
});

</script>


</script>

  <script>
  $(function() {
    $( "#schedule_date" ).datepicker();
  });
  </script>
  <script>
$(document).ready(function(){
    $("._other_time").change(function(){
       var other_time= $(this).val();
       var convertedTime = moment(other_time, 'HH:mm').format('hh:mm a')
      $("#enter_time").val(convertedTime);
        })
});
</script>
