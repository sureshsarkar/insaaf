
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <section class="content">
         <div class="container">
            <div class="row">
                    <div class="col-md-10">
                        <div class="for_imffhd">
                            <h4 class="text-uppercase text-center"><b>Client: </b> <b
                                    class="text-warning"><?php echo $meeting_Detail->c_fname." ".$meeting_Detail->c_lname?></b>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-4 m-auto">
                        <div class="for_client__">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Client ID </th>
                                            <td>:<?php echo $meeting_Detail->client_unique_id?></td>
                                        </tr>
                                        <tr>
                                            <th>Name  </th>
                                            <td>:<?php echo $meeting_Detail->c_fname." ".$meeting_Detail->c_lname?></td>
                                        </tr>
                                        <tr>
                                            <th>Email  </th>
                                            <td>:<?php echo $meeting_Detail->email?></td>
                                        </tr>
                                        <tr>
                                            <th>Mobile  </th>
                                            <td>:<?php echo $meeting_Detail->mobile?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase"><b>Lawyer Details</b></td>
                                        </tr>
                                        <tr>
                                            <th>Lawyer ID </th>
                                            <td>:<?php echo $meeting_Detail->lawyer_UID?></td>
                                        </tr>
                                        <tr>
                                            <th>Lawyer Name </th>
                                            <td>:<?php echo $meeting_Detail->l_fname." ".$meeting_Detail->l_lname?></td>
                                        </tr>
                                        <tr>
                                            <th>Lawyer Mobile</th>
                                            <td>:<?php echo $meeting_Detail->l_mobile?></td>
                                        </tr>
                                        <tr>
                                            <th>Lawyer Email  </th>
                                            <td>:<?php echo $meeting_Detail->l_email?></td>
                                        </tr>
                                      
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 m-auto">
                        <div class="for_client__">
                           
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <!-- case details-->
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase"><b>Meeting Details</b></td>
                                        </tr>
                                        <tr>
                                            <th>Case Category</th>
                                            <td>: <?=$meeting_Detail->case_cat_name?></td>
                                        </tr>
                                        <tr>
                                            <th>Meeting Date </th>
                                            <td>: <?php echo $date=date('Y-m-d ',strtotime($meeting_Detail->meeting_time))?></td>
                                        </tr>
                                        <tr>
                                            <th>Meeting Time </th>
                                            <td>: <?php echo $time=date('h:i a ',strtotime($meeting_Detail->meeting_time))?></td>
                                        </tr>
                                        <?php
                                        $encriptID= JKMencoder($meeting_Detail->slotId);
                                        if($meeting_Detail->slot_status==1){
                                            $clientLink= base_url().'z/c/'.$encriptID;
                                            $lawyerLink= base_url().'z/l/'.$encriptID;
                                        }else{
                                            $clientLink='#';
                                            $lawyerLink='#';
                                        }
                                        ?>
                                        <tr>
                                            <th>Client Meeting Link:</th>
                                            <td><a href="<?=$clientLink?>" target="_blank"><div class="btn btn-success">Join</div></a></td>
                                        </tr>
                                        <tr>
                                            <th>Lawyer Meeting Link:</th>
                                            <td><a href="<?=$lawyerLink?>" target="_blank"><div class="btn btn-success">Join</div></a></td>
                                        </tr>
                                       <?php if(isset($meeting_Detail->case_file) && !empty($meeting_Detail->case_file)){ ?>
                                        <tr>
                                            <th>Case File : </th>
                                            <td><a href="<?=base_url().$meeting_Detail->case_file?>" target="_blank">view<i class="bi bi-box-arrow-up-right"></i></a></td>
                                        </tr>
                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="__flx_button_prv_nxt" style="width:99%">
                                <div class="__bck_butn">
                                    <a href="<?=base_url()?>admin/meeting_list/?type=upcoming" class="button_news"> &lt; Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>