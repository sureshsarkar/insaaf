<?php
    if(!empty($view_data->adtional) ){
    $additional= json_decode($view_data->adtional,true);
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
                        <div class="for_imffhd">
                            <h4 class="text-uppercase text-center"><b>Client: </b> <b
                                    class="text-warning"><?php echo $view_data->name?></b>
                            </h4>
                        </div>
                    </div>


                    <div class="col-md-11 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <?php if(isset($view_data->contact_type) && !empty($view_data->contact_type)){ ?>
                                        <tr>
                                            <th>Contact Type </th>
                                            <td> : <?php echo $view_data->contact_type?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <th>Name </th>
                                            <td> : <?php echo $view_data->name?></td>
                                        </tr>
                                        <tr>
                                            <th>Email </th>
                                            <td>: <?php echo $view_data->email?></td>
                                        </tr>
                                        <tr>
                                            <th>Mobile </th>
                                            <td>: <?php echo $view_data->mobile?></td>
                                        </tr>
                                        <tr>
                                            <th>Status </th>
                                            <td>
                                                :
                                                <?php echo ($view_data->status ==1)?'<b class="text-success">Active</b>':'<b class="text-danger">Inactive</b>'?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Joining Date</th>
                                            <td>: <?php echo $view_data->date_at?></td>
                                        </tr>
                                        <?php if(isset($view_data->attachment) && !empty($view_data->attachment)){ ?>
                                        <tr>
                                            <th>Attachment</th>
                                            <td>: <b>
                                                    <a class=""
                                                        href="<?php echo base_url('uploads/contact/').$view_data->attachment?>"
                                                        title="View" target="_blank">view <i
                                                            class="bi bi-box-arrow-up-right"></i>
                                                    </a>
                                                </b>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php if(!empty($view_data->query)){?>
                                        <tr>
                                            <th>About </th>
                                            <td class="text-align-justify">: <?php echo $view_data->query?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php if(isset($additional) && !empty($additional)){
                                        foreach($additional as $key=>$value){
                                            $key= lavelToText($key);
                                        ?>
                                        <tr>
                                            <th><?php echo $key ?> </th>
                                            <td class="text-align-justify">: <?php echo $value?></td>
                                        </tr>
                                        <?php } } ?>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                        <div class="__flx_button_prv_nxt" style="width:99%">
                            <div class="__bck_butn">
                                <a href="<?=base_url()?>sub_admin/contact<?php echo (isset($_GET['ppc_key']) && $_GET['ppc_key'] =='ppc')?'?type=ppc':''?>"
                                    class="button_news"> &lt; Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>