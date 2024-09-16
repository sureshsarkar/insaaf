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
                    <div class="col-md-10">
                        <button class="unlock"><i class="bi bi-unlock text-primary">History</i></button>
                        <button class="lock"><i class="bi bi-lock text-primary">History</i></button>
                        <div class="row dataCon">
                            <div class="col-md-6 m-auto">
                                <div class="for_client__">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <?php if(isset($otherData['newData']) && !empty($otherData['newData'])){?>
                                                <tr>
                                                    <th>Last Updated Date</th>
                                                    <td> :
                                                        <?php echo date('d-m-Y h:i a',strtotime($otherData['newData']['last_updated_date']))?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Updated By</th>
                                                    <td> : <?php echo $otherData['newData']['updated_by']?></td>
                                                </tr>
                                                <?php }?>
                                                <tr>
                                                    <td colspan="2" class="bg-primary text-uppercase"><b>Old Data</b>
                                                    </td>
                                                </tr>
                                                <?php if(isset($otherData['oldData']) && !empty($otherData['oldData'])){
                                                    foreach($otherData['oldData'] as $k=> $v){ 
                                                    foreach($v as $key=> $oldData){ 
                                               
                                              if(!empty($oldData)){?>
                                                <?php if($key =='category'){?>
                                                <tr>
                                                    <th>Category</th>
                                                    <td> <button class="btn btn-primary" title="view"
                                                            data-toggle="modal"
                                                            data-target="#exampleModal89892323143<?=$k?>">Last Selected
                                                            Category</button></td>
                                                </tr>
                                                <!-- to open modal to show selected categories  -->
                                                <tr>
                                                    <td>
                                                        <div class="modal fade" data-backdrop="static"
                                                            id="exampleModal89892323143<?=$k?>" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">

                                                                <div class="modal-content __type_modal">
                                                                    <section class="content">
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <?php 
                                                                            $temp = empty($oldData)?'':json_decode($oldData,true);
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
                                                                            <h2>Category <small
                                                                                    class="pull-right text-warning">Your
                                                                                    Selected
                                                                                    Category(<?= $myCateCount ?>)
                                                                                </small>
                                                                            </h2>
                                                                            <hr />
                                                                        </div>
                                                                        <!-- list -->
                                                                        <div class="categoryListCon">
                                                                            <div class="table-responsive">
                                                                                <table
                                                                                    class="table table-bordered text-center table-striped">

                                                                                    <tbody>
                                                                                        <?php 
                                                                                        if(isset($case_cat_data) && !empty($case_cat_data)){
                                                                                            
                                                                                            foreach($case_cat_data as $cal){?>
                                                                                        <tr>
                                                                                            <td><?php echo $cal->name ;?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="checkbox"
                                                                                                    name="category[]"
                                                                                                    value="<?php echo $cal->id ;?>"
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
                                                    </td>
                                                </tr>

                                                <?php }else{
                                                    
                                                   ?>
                                                <tr>
                                                    <th>
                                                        <?php if($key == 'profileImg'){
                                                           echo  lavelToText($key);
                                                         }elseif($key == 'enrol_image'){
                                                            echo  lavelToText($key);
                                                         }elseif($key == 'status'){
                                                            echo  lavelToText($key);
                                                         }else{
                                                            echo lavelToText($key);
                                                         }
                                                                ?>
                                                    </th>
                                                    <td>
                                                        <?php if($key == 'profileImg'){
                                                          echo '<a href="'.base_url($oldData).'" target="_blank"><button class="btn btn-primary">View</button></a>';
                                                         }elseif($key == 'enrol_image'){
                                                            echo '<a href="'.base_url($oldData).'" target="_blank"><button class="btn btn-primary">View</button></a>';
                                                         }elseif($key == 'status'){
                                                            echo ($oldData==1)?'<span class="badge bg-success">Active</span>':'<span class="badge bg-denger">Pending</span>';
                                                         }else{
                                                            echo ':'.$oldData;
                                                         }
                                                                ?>
                                                    </td>
                                                </tr>
                                                <?php }}}?>
                                                <td colspan="2" class="bg-info" style="padding:1px 0px 0px 0px;"></td>
                                                <?php }}?>
                                            </tbody>
                                        </table>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dasProfile change__img" id="previewImg">
                            <img src="<?php echo (empty($view_data->image))?base_url('assets/images/new_user.png'):base_url().$view_data->image;?>"
                                class="img-responsive">
                        </div>
                        <div class="for_imffhd">
                            <h4 class="text-uppercase text-center"><b>Advocate: </b> <b
                                    class="text-warning"><?php echo $view_data->fname." ".$view_data->lname?></b>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-6 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>

                                        <tr>
                                            <th>Lawyer ID </th>
                                            <td>: <?php echo $view_data->lawyer_unique_id?></td>
                                        </tr>
                                        <tr>
                                            <th>First Name </th>
                                            <td> : <?php echo $view_data->fname?></td>
                                        </tr>
                                        <tr>
                                            <th>Last Name </th>
                                            <td> : <?php echo $view_data->lname?></td>
                                        </tr>
                                        <tr>
                                            <th>PIN</th>
                                            <td> : <span class="badge"> <?php echo $view_data->login_pin?></span></td>
                                        </tr>
                                        <tr>
                                            <th>Gender </th>
                                            <td> :
                                                <?php $g = $this->config->item('gender'); echo isset($g[$view_data->gender])?$g[$view_data->gender]:'' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td> : <?php echo $view_data->email?></td>
                                        </tr>
                                        <tr>
                                            <th>Mobile</th>
                                            <td> : <?php echo $view_data->mobile?></td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td> : <?php echo $view_data->city?></td>
                                        </tr>
                                        <tr>
                                            <th>Status </th>
                                            <td>
                                                <?php 
                                                
                                                $l_status = $this->config->item('lawyerStatus');
                                                // select type
                                                $changeStatus = '<select class="lawyerStatus bg-primary" id="lawyer_id'.$view_data->id.'" data-id="'.$view_data->id.'" last-ststus="'.$view_data->status.'" >';
                                    
                                                foreach($l_status as $k=>$v){
                                                    $active = ($k == $view_data->status)?' selected ':'';
                                                    $changeStatus .= '<option value="'.$k.'" '.$active.' >'.$v.'</option>';
                                                }
                                                $changeStatus .= '</select>';

                                                ?>
                                                : <?php echo $changeStatus?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Joining Date </th>
                                            <td>: <?php echo date('d-m-Y h:i a',strtotime($view_data->dt))?></td>
                                        </tr>
                                        <tr>
                                            <th>Added From </th>
                                            <td>:
                                                <?php echo (isset($view_data->added_from) && $view_data->added_from == 'app')?"App":"Website"?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Additional Info </th>
                                            <td>: <?php echo $view_data->address?></td>
                                        </tr>
                                        <tr>
                                            <th>About </th>
                                            <td>: <?php echo $view_data->about?></td>
                                        </tr>
                                        <tr>
                                            <th>Office Note</th>
                                            <td>: <?php echo $view_data->reason?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase"><b>Expertise</b></td>
                                        </tr>
                                        <tr>
                                            <th>Lawyer Category : </th>
                                            <td><button class="btn btn-primary" title="view" data-toggle="modal"
                                                    data-target="#exampleModal89892323">Selected Category</button>
                                            <td>
                                        </tr>
                                        <tr>
                                            <th>Lawyer Experience : </th>
                                            <td><?php echo $view_data->experience?></td>
                                        </tr>
                                        <tr>
                                            <th>Bar Council : </th>
                                            <td><?php echo $view_data->bar_councle?></td>
                                        </tr>
                                        <tr>
                                            <th>Profile Completed : </th>
                                            <td><?php echo $view_data->profile_complete?>%</td>
                                        </tr>
                                        <tr>
                                            <th>Practice Area : </th>
                                            <td><?php echo $view_data->practice_area?></td>
                                        </tr>
                                        <tr>
                                            <th>Enrolment No : </th>
                                            <td><?php echo $view_data->enrolement_no?></td>
                                        </tr>
                                        <tr>
                                            <th>Enrolment Certificate : </th>
                                            <?php if(isset($view_data->enrol_image) && !empty($view_data->enrol_image)){?>
                                            <td><a href="<?=base_url('uploads/lawyer/').$view_data->enrol_image?>"
                                                    target="_blank"><button class="btn btn-primary">View</button></a>
                                            </td>
                                            <?php }?>
                                        </tr>


                                        <?php if(isset($cases) && !empty($cases)){?>
                                        <!-- case details-->
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase"><b>Case Details</b></td>
                                        </tr>
                                        <tr>
                                            <th>Total Cases </th>
                                            <td>: <?=count($cases)?></td>
                                        </tr>
                                        <?php 
                                            $activeCases=0;
                                            $inActiveCases=0;
                                            if(isset($cases) && !empty($cases)){
                                                foreach ($cases as $k => $v) {
                                                    if($v->status==1){
                                                    $activeCases++;
                                                    }else{
                                                        $inActiveCases++;
                                                    }
                                                }   
                                            }?>
                                        <tr>
                                            <th>Active Cases </th>
                                            <td>: <?=$activeCases?></td>
                                        </tr>
                                        <tr>
                                            <th>Pending Cases </th>
                                            <td>: <?=$inActiveCases?></td>
                                        </tr>
                                        <?php }?>


                                        <!-- Meeting details-->
                                        <?php if(isset($earnData) && !empty($earnData)){?>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase"><b>Earning Details</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Total Meeting </th>
                                            <td>: <?=count($earnData)?></td>
                                        </tr>
                                        <?php 
                                            $totalEarn=0;
                                            if(isset($earnData) && !empty($earnData)){
                                            
                                            foreach ($earnData as $k => $v) {
                                                $totalEarn = $totalEarn + $v->amount;
                                            }   
                                            }?>
                                        <tr>
                                            <th>Total Earning </th>
                                            <td>:Rs- <?= $totalEarn?></td>
                                        </tr>
                                        <tr>
                                            <th>Lawyer amount(50%) </th>
                                            <td>:Rs- <?= $totalEarn*50/100?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="__flx_button_prv_nxt" style="width:99%">
                                <div class="__bck_butn">
                                    <a href="<?=base_url()?>sub_admin/lawyer" class="button_news"> &lt; Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            hitURL = "<?php echo base_url() ?>sub_admin/lawyer/update_lawyer_status";
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
            hit = "<?php echo base_url() ?>sub_admin/lawyer/update_lawyer_status";
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