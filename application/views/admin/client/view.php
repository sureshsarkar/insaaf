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
                                              if(!empty($oldData)){
                                                ?>
                                                <tr>
                                                    <th>
                                                        <?php if($key == 'profileImg'){
                                                            echo  lavelToText($key);
                                                         }elseif($key == 'status'){
                                                            echo  lavelToText($key);
                                                         }else{
                                                            echo lavelToText($key);
                                                         }?>
                                                    </th>
                                                    <td>
                                                        <?php if($key == 'profileImg'){
                                                                    echo '<a href="'.base_url($oldData).'" target="_blank"><button class="btn btn-primary">View</button></a>';
                                                                }elseif($key == 'status'){
                                                                    echo ($oldData==1)?'<span class="badge bg-success">Active</span>':'<span class="badge bg-denger">Pending</span>';
                                                                }else{
                                                                    echo ':'.$oldData;
                                                                }?>
                                                    </td>
                                                </tr>
                                                <?php }}?>
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
                            <img src="<?php echo (empty($view_data->image))?base_url('assets/images/').'new_user.png':base_url().$view_data->image;?>"
                                class="img-responsive">
                        </div>
                        <div class="for_imffhd">
                            <h4 class="text-uppercase text-center"><b>Client: </b> <b
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
                                            <th>Client ID</th>
                                            <td> : <?php echo $view_data->client_unique_id?></td>
                                        </tr>
                                        <tr>
                                            <th>First Name</th>
                                            <td> : <?php echo $view_data->fname?></td>
                                        </tr>
                                        <tr>
                                            <th>Last Name</th>
                                            <td> : <?php echo $view_data->lname?></td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
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
                                            <th>PIN</th>
                                            <td> : <span class="badge"> <?php echo $view_data->login_pin?></span></td>
                                        </tr>

                                        <tr>
                                            <th>Profile Completed</th>
                                            <td> : <?php echo $view_data->profile_complete?>%</td>
                                        </tr>

                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <?php echo ($view_data->status ==1)?'<b class="text-success">Active</b>':'<b class="text-danger">Inactive</b>'?></b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>State</th>
                                            <td> : <?php echo $view_data->state?></td>
                                        </tr>

                                        <tr>
                                            <th>City</th>
                                            <td> : <?php echo $view_data->city?></td>
                                        </tr>

                                        <tr>
                                            <th>Joining Date</th>
                                            <td> : <?php echo date('d-m-Y h:i a',strtotime($view_data->dt))?></td>
                                        </tr>

                                        <tr>
                                            <th>Added From</th>
                                            <td>:<?php echo (isset($view_data->added_from) && $view_data->added_from == 'app')?"App":"Website"?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Address</th>
                                            <td> : <?php echo $view_data->address?></td>
                                        </tr>

                                        <tr>
                                            <th>About</th>
                                            <td> : <?php echo $view_data->about?></td>
                                        </tr>

                                        <tr>
                                            <th>Query</th>
                                            <td> : <?php echo $view_data->query?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 m-auto">
                        <div class="for_client__">
                            <div class="for_imffhd">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
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
                                    </tbody>
                                </table>
                            </div>

                            <div class="__flx_button_prv_nxt" style="width:99%">
                                <div class="__bck_butn">
                                    <a href="<?=base_url()?>admin/client" class="button_news"> &lt; Back</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </section>
</div>

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