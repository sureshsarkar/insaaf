<style>
.divmodel1 {
    display: none1;
}

.divmodel2 {
    display: none;
}

.divmodel3 {
    display: none;
}

.w-70 {
    width: 70%;
}


.detailCls {
    background: #f9f9f9;
    border-radius: 12px;
    padding: 5px;
    margin: 4px;
    height: 141px;
}

.detailCls th {
    width: 50% !important;
    padding: 1px !important;
}

.detailCls td {
    padding: 1px !important;
}

.FeedData {
    cursor: pointer;
    color: #0167bf;
}

span.FeedElips {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
<?php 
if(isset($view_data->other) && !empty($view_data->other)){
 $otherData =json_decode($view_data->other,true);   

}else{
    $otherData ='';
}

?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="__flx_button_prv_nxt" style="width:99%">
                            <div class="__bck_butn">
                                <a href="<?=base_url()?>admin/lawyer/view/<?= $view_data->id?>" class="button_news">
                                    &lt; Back</a>
                            </div>
                        </div>
                        <div class="for_imffhd">
                            <h4 class="text-uppercase text-center"><b>Advocate: </b> <b
                                    class="text-warning"><?php echo $view_data->fname." ".$view_data->lname?></b>
                            </h4>
                        </div>
                    </div>
                </div>

                <!-- ------------ Total Meetings start--------------->
                <div class="row">
                    <div class="col-md-11 m-auto">
                        <div class="for_client__">
                            <?php if(isset($meetingData) && !empty($meetingData)){?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase">
                                                <b><?php echo $view_data->fname." ".$view_data->lname?> - Total Meetings
                                                    conducted (<?php echo count($meetingData)?>)
                                                </b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <?php foreach ($meetingData as $k => $v) {?>
                                <div class="col-md-6">
                                    <div class="detailCls">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th>Client ID </th>
                                                        <td>: <?php echo $v->client_unique_id;?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Client Name </th>
                                                        <td>: <?php echo $v->fname." ".$v->fname;?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Meeting Date </th>
                                                        <td>:
                                                            <?php echo date("d-M-Y h:i a",strtotime($v->meeting_time));?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Category </th>
                                                        <td> : <?php echo $v->name;?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Admin FeedBack </th>
                                                        <td>
                                                            <span class="FeedElips">:
                                                                <?php echo $v->adminFeedback;?></span>
                                                            <span class="FeedData" title="view" data-toggle="modal"
                                                                data-target="#exampleModal212331"
                                                                data-value="<?php echo $v->adminFeedback;?>">
                                                                <?= (isset($v->adminFeedback) && !empty($v->adminFeedback))?" view more":""?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <!------------- Total Meetings end--------------->
            </div>
        </section>
    </section>
</div>


<div class="modal fade" data-backdrop="static" id="exampleModal89892323" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content __type_modal w-70 m-auto">
            <section class="content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php 
                        $temp = empty($view_data->category)?'':json_decode($view_data->category,true);
                        $myCateCount = 0;
                            $myCat = array();
                            if(!empty($temp)){
                                foreach($temp as $catId){
                                    $myCat[$catId] = 1;
                                    $myCateCount++;
                                }
                            }
                        ?>
                <div class="">
                    <h2>Category <small class="pull-right text-warning">Your Selected Category(<?= $myCateCount ?>)
                        </small>
                    </h2>
                    <hr />
                </div>
                <!-- list -->
                <div class="categoryListCon">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center table-striped">
                            <tbody>
                                <?php 
                                      if(isset($case_cat_data) && !empty($case_cat_data)){
                                        foreach($case_cat_data as $cal){?>
                                <tr>
                                    <td><?php echo $cal->name ;?></td>
                                    <td>
                                        <input type="checkbox" name="category[]" value="<?php echo $cal->id ;?>"
                                            <?= isset($myCat[$cal->id])?' checked ':'' ?>>
                                    </td>
                                </tr>
                                <?php }}?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end list-->
            </section>
        </div>
    </div>
</div>


<div class="modal fade" data-backdrop="static" id="exampleModal89892323143" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content __type_modal ">
            <section class="content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php 
                        $temp = empty($otherData->oldData->category)?'':json_decode($otherData->oldData->category,true);
                        $myCateCount = 0;
                            $myCat = array();
                            if(!empty($temp)){
                                foreach($temp as $catId){
                                    $myCat[$catId] = 1;
                                    $myCateCount++;
                                }
                            }
                        ?>
                <div class="">
                    <h2>Category <small class="pull-right text-warning">Your Selected Category(<?= $myCateCount ?>)
                        </small>
                    </h2>

                    <hr />
                </div>
                <!-- list -->
                <div class="categoryListCon">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center table-striped">

                            <tbody>
                                <?php 
                                      if(isset($case_cat_data) && !empty($case_cat_data)){
                                        
                                        foreach($case_cat_data as $cal){?>
                                <tr>
                                    <td><?php echo $cal->name ;?></td>
                                    <td>
                                        <input type="checkbox" name="category[]" value="<?php echo $cal->id ;?>"
                                            <?= isset($myCat[$cal->id])?' checked ':'' ?>>
                                    </td>
                                </tr>
                                <?php }}?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end list-->
            </section>
        </div>
    </div>
</div>

<!-- Show FeedBack start -->

<div class="modal fade" data-backdrop="static" id="exampleModal212331" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content __type_modal ">
            <section class="content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="h3 pull-left text-warning mt-0">Admin FeedBack For This Meeting
                </div>
                <br>
                <hr />
                <p id="viewFeedData"></p>
            </section>
        </div>
    </div>
</div>
<!-- Show FeedBack end -->

<!-- model for to say why not abale to atend meeting start  -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary reasonmodal" data-toggle="modal" data-target="#exampleModal1122">
</button>
<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="exampleModal1122" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content b-radius-1">
            <!-- div 1 -->
            <div class="divmodel1">
                <div class="modal-header">
                    <h3 class="modal-title text-center text-warning" id="exampleModalLabel">Enter The Reason</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <textarea name="reason" class="reason_text"><?php echo $view_data->reason?></textarea>
                    </div>
                    <div class="msg text-danger pl-2"></div>
                    <div class="modal-footer">
                        <input type="hidden" class="lawyer_id" name="lawyer_id" value="">
                        <input type="hidden" class="curentstatus" name="status" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit_data">Submit</button>
                    </div>
                </form>
            </div>
            <!-- div 2 -->
            <div class="divmodel2">

            </div>
            <!-- div 3 -->
            <div class="divmodel3">
                <div class="modal-header">
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
    $(".lawyerStatus").change(function() {
        var status = $(this).val();
        var lawyer_id = $(this).attr("data-id");
        var last_ststus = $(this).attr("last-ststus");
        if (status == 1) {
            hitURL = "<?php echo base_url() ?>admin/lawyer/update_lawyer_status";
            var confirmation = confirm("Are you sure to update Lawyer status ?");
            if (confirmation) {
                $.ajax({
                    type: 'POST',
                    url: hitURL,
                    data: {
                        lawyerId: lawyer_id,
                        status: status
                    },
                }).done(function(data) {
                    if (data == 1) {
                        alert("Status updated successfully !");
                    }
                });
            }
            return false;
        }
        jQuery(".curentstatus").val(status);
        jQuery(".lawyer_id").val(lawyer_id);
        jQuery(".reasonmodal").click();
    });

    // var val = "";
    // jQuery(".reason_text").val(val);

    // Submit reason data to slot table start
    jQuery(document).on("click", ".submit_data", function(e) {
        e.preventDefault()
        var reason = jQuery(".reason_text").val();
        var curentstatus = jQuery(".curentstatus").val();
        var lawyer_id = jQuery(".lawyer_id").val();

        if (reason != '') {
            $(".divmodel1").css("display", "none");
            loadergif("divmodel2", "block");
            hit = "<?php echo base_url() ?>admin/lawyer/update_lawyer_status";
            $.ajax({
                type: 'POST',
                url: hit,
                data: {
                    lawyerId: lawyer_id,
                    status: curentstatus,
                    reason: reason
                }
            }).done(function(data) {

                if (data == 2) {
                    $(".divmodel2").css("display", "none");
                    $(".divmodel3").css("display", "block");
                    location.reload();
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

<!-- script to view last updated data  -->
<script>
$(document).ready(function() {
    $(".dataCon").addClass('hidden');
    $(".lock").hide();
    $(".unlock").click(function() {
        $(".dataCon").removeClass('hidden');
        $(".unlock").hide();
        $(".lock").show();
    });
})
</script>

<script>
$(document).ready(function() {
    $(".lock").click(function() {
        $(".unlock").show();
        $(".lock").hide();
        $(".dataCon").addClass('hidden');
    })
})
</script>

<script>
$(document).ready(function() {
    $(".FeedData").click(function() {
        var data_value = $(this).attr("data-value");
        $("#viewFeedData").html(data_value);
    })
})
</script>