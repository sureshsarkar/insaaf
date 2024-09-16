<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<style>
.reason_text {
    width: 100%;
    border: 1px solid #e8dada;
    height: 50px;
}

.pl-2 {
    padding-left: 14px;
}

.divmodel3 {
    display: none;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid ">
            <div class="for_Upk__list_lawyer">

                <i class="fa fa-sitemap" aria-hidden="true"></i> Meeting List
            </div>

        </div>
    </section>

    <section class="content">

        <div class="row">
            <?php
               $this->load->helper('form');
               $error = $this->session->flashdata('error');
               if($error)
               {
               ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
            <?php } ?>
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
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Filter Meeting List
                                <span style="margin-left:10px;">
                                    <select id="shortBtn">
                                        <option value="all">Sort By</option>
                                        <option value="all"
                                            <?= (isset($_GET['meet']) && $_GET['meet'] == 'all' )?"selected":''?>>All
                                            Data
                                        </option>
                                        <option value="1"
                                            <?= (isset($_GET['meet']) && $_GET['meet'] == '1' )?"selected":''?>>Today
                                        </option>
                                        <option value="7"
                                            <?= (isset($_GET['meet']) && $_GET['meet'] == '7' )?"selected":''?>>Weekly
                                        </option>
                                        <option value="30"
                                            <?= (isset($_GET['meet']) && $_GET['meet'] == '30' )?"selected":''?>>Monthly
                                        </option>
                                        <option value="365"
                                            <?= (isset($_GET['meet']) && $_GET['meet'] == '365' )?"selected":''?>>Yearly
                                        </option>
                                    </select>
                                </span>
                            </h3>
                            <div class="box-tools">

                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive sdjfhilsjh">
                            <table class="display " cellspacing="0" width="100%" id="example">
                                <thead>
                                    <tr class="hjggjugiu">
                                        <th>S.No.</th>
                                        <th>Client Name</th>
                                        <th>Case Category</th>
                                        <th>Meeting Time</th>
                                        <th>Join Meeting</th>
                                        <th></th>
                                        <th>Status</th>
                                        <th class="">Actions</th>
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


<!-- model for to say why not abale to atend meeting start  -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary moder_triget" data-toggle="modal" data-target="#exampleModal">
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="divmodel1">
                <div class="modal-header">
                    <h3 class="modal-title text-center text-warning" id="exampleModalLabel">Why you are not able to
                        attend
                        meeting</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_submit" action="#">
                    <div class="modal-body">
                        <textarea name="reason" class="reason_text"> </textarea>
                    </div>
                    <div class="msg text-danger pl-2"></div>
                    <div class="modal-footer">
                        <input type="hidden" class="client_id" name="client_id" value="">
                        <input type="hidden" class="slot_id" name="slot_id" value="">
                        <input type="hidden" class="slot_status" name="slot_status" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="divmodel2">

            </div>
            <div class="divmodel3">
                <div class="modal-header">
                    <!-- success page -->
                    <div class="for_bg_color_cont_us successCon">
                        <div class="row py-5">
                            <div class="col-md-12 text-center">
                                <img src="<?= base_url('assets/images/success.png')?>" width="130">
                                <br /><br />
                                   <h2 class="text-success">You have disapproved the meeting </h2>
                                <br />
                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                    <!--end success con -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- model for to say why not abale to atend meeting start  -->

<!-- Change Lawyer session_status  -->

<script type="text/javascript">
jQuery(document).ready(function() {
    // jQuery(".moder_triget").click();
    var val = "";
    jQuery(".reason_text").val(val);

    // $(".msg").css("display", "none");
    jQuery(document).on("change", ".slotStatus", function() {
        var slot_id = $(this).attr("data-id");
        var client_id = $(this).attr("client-id");
        var statusValue = $(this).val();

        if (statusValue == 2) {
            jQuery(".moder_triget").click();
            jQuery(".slot_id").val(slot_id);
            jQuery(".slot_status").val(statusValue);
            jQuery(".client_id").val(client_id);
        }
    }); // End code 

    // Submit reason data to slot table start
    jQuery(document).on("submit", "#form_submit", function(e) {
        var reason = jQuery(".reason_text").val();

        e.preventDefault()
        var form_data = $(this).serialize();
        if (reason != '' && form_data != '') {
            $(".divmodel1").css("display", "none");
            loadergif("divmodel2", "block");
            hitURL = "<?php echo base_url() ?>lawyer/meeting/update_meeting_status";
            $.ajax({
                type: 'POST',
                url: hitURL,
                data: form_data,
            }).done(function(data) {
                if (data == 1) {
                    $(".divmodel2").css("display", "none");
                    $(".divmodel3").css("display", "block");

                }
            });
        } else {
            $(".divmodel2").css("display", "none");
            $(".divmodel1").css("display", "block");
            $(".msg").css("display", "block");
            $(".msg").html("<p>Please enter the reason!</p>");
            _removeAlert();
            return false;
        }
    });
    // Submit reason data to slot table start

});
</script>
<!-- Change Lawyer session_status end -->

<script type="text/javascript">
$(document).ready(function() {
    $("#shortBtn").change(function() {
        var sortBy = $(this).val();
        var url = "<?php echo base_url();?>";
        url = url + 'lawyer/meeting?meet=' + sortBy;
        window.location.href = url;
    });
});
</script>
<!-- Delete Script-->
<script type="text/javascript">
jQuery(document).ready(function() {
    //$('#example').DataTable();

    jQuery(document).on("click", ".deletebtn", function() {
        var tableId = $(this).attr("data_id");
        currentRow = $(this);
        hitURL = "<?php echo base_url() ?>lawyer/meeting/delete";
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
    var getmeet_data = "<?php echo  isset($_GET['meet'])?"?meet=".$_GET['meet']:''?>";

    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('lawyer/meeting/ajax_list/')?>" + getmeet_data,
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

<script>
function _removeAlert() {
    setTimeout(function() {
        $(".msg").html('');
    }, 5000);
}
</script>
