<?php
    if(!empty($view_data->form_data) || !empty($view_data->cart_data) || !empty($view_data->additional)){
    $formData= json_decode($view_data->form_data,true);
    $cartData= json_decode($view_data->cart_data,true);
    $additional= json_decode($view_data->additional,true);
    }

?>



<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="content">
            <div class="container">
                <div class="row">
                    <h3 class="text-center text-warning"><b>Category</b>
                        <span>:<?=$categoryData->sub_sub_category_name?></span>
                    </h3>
                    <?php  if(isset($formData['first_party']['label']) && !empty($formData['first_party']['label'])){ ?>
                    <div class="col-md-5 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">

                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                          
                                            <td colspan="2" class="bg-primary text-uppercase">
                                                <b><?php  echo $formData['first_party']['label'];?></b>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php if(isset($formData['first_party']) && !empty($formData['first_party'])){
                                        foreach($formData['first_party'] as $key=>$value){
                                            $key= lavelToText($key);
                                        ?>
                                        <tr>
                                            <th><?=$key?></th>
                                            <td>:<?=$value?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                    <?php  if(isset($formData['second_party']['label']) && !empty($formData['second_party']['label'])){ ?>
                    <div class="col-md-5 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                          
                                            <td colspan="2" class="bg-primary text-uppercase">
                                                <b><?php echo $formData['first_party']['label'];?></b>

                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php if(isset($formData['second_party']) && !empty($formData['second_party'])){
                                        foreach($formData['second_party'] as $key=>$value){
                                            $key= lavelToText($key);
                                        ?>
                                        <tr>
                                            <th><?=$key?></th>
                                            <td>:<?=$value?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <?php  if(isset($cartData['cart_data']) && !empty($cartData['cart_data'])){ ?>
                <div class="row">
                    <div class="col-md-5 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase">
                                                <b>cart Data</b>
                                            </td>
                                        </tr>
                                        <?php if(isset($cartData['cart_data']) && !empty($cartData['cart_data'])){
                                        foreach($cartData['cart_data'] as $key=>$value){
                                            $key= lavelToText($key);
                                        ?>
                                        <tr>
                                            <th><?=$key?></th>
                                            <td>:<?=$value?></td>
                                        </tr>
                                        <?php }}?>
                                   
                                        <tr>
                                            <th>Payment Status</th>
                                            <td><span class="badge"><?=$view_data->payment_status?></span></td>
                                        </tr>
                                        <?php if($view_data->payment_status=='Success'){ ?>
                                        <tr>
                                        <th>Invoice</th>
                                        <td>
                                            <a href="<?= base_url('utils/invoices/'.$view_data->pdfname.$view_data->user_id.'invoice.pdf');?>"
                                                target="_blank"> <button class="btn-success">Download</button></a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                   
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
             
                    <?php if((isset($additional['more_details']) && !empty($additional['more_details'])) || (isset($additional['addtional']) && !empty($additional['addtional']))){?>
                    <div class="col-md-5 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase">
                                                <b>Addtional Data</b>
                                            </td>
                                        </tr>
                                        <?php  if(isset($view_data->user_id) && !empty($view_data->user_id)){ ?>
                                        <tr>
                                            <td class="text-success">
                                                <b><?php echo (isset($additional['more_details']['label'])?$additional['more_details']['label']:'')?></b>
                                            </td>
                                        </tr>
                                        <?php
                                        foreach($additional['more_details'] as $key=>$value){
                                            $key= lavelToText($key);
                                        ?>
                                        <tr>
                                            <th><?=$key?></th>
                                            <td>: <?=$value?></td>
                                        </tr>
                                        <?php }}else{?>
                                            <?php 
                                        foreach($additional['addtional'] as $key=>$value){
                                            $key= lavelToText($key);
                                        ?>
                                        <tr>
                                            <th><?=$key?></th>
                                            <td>: <?=$value?></td>
                                        </tr>
                                       <?php }} ?>
                                        
                                       <!-- show user data start -->
                                      <?php if(isset($additional['addtional']['type']) && !empty($additional['addtional']['type'])){ ?>
                                        <tr>
                                            <th>Client ID</th>
                                            <td>: <?=$view_data->client_unique_id?></td>
                                        </tr>

                                        <tr>
                                            <th>Client Name</th>
                                            <td>: <?=$view_data->fname?></td>
                                        </tr>
                                    
                                        <tr>
                                            <th>Email</th>
                                            <td>: <?=$view_data->email?></td>
                                        </tr>
                                        <tr>
                                            <th>Mobile</th>
                                            <td>: <?=$view_data->mobile?></td>
                                        </tr>
                                        <tr>
                                            <th>Need Document</th>
                                            <td>: <?=$categoryData->sub_sub_category_name?></td>
                                        </tr>
                                      <?php } ?>
                                       <!-- show user data end -->
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>
                   <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-5 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <?php if(isset($additional['attachment'][0]) && !empty($additional['attachment'][0])){?>
                                        Attachment
                                        <tr>
                                            <?php
                                        foreach($additional['attachment'][0] as $key=>$value){
                                            $key= lavelToText($key);
                                        ?>
                                            <td><b><a class="" href="<?=base_url().$value?>" title="View"
                                                        target="_blank">view <i
                                                            class="bi bi-box-arrow-up-right"></i></a></b></td>
                                            <?php }}?>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>