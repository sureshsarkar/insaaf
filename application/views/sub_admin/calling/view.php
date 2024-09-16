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
                                            <th>State </th>
                                            <td>: <?php echo $view_data->state?></td>
                                        </tr>
                                        <tr>
                                            <th>City </th>
                                            <td>: <?php echo $view_data->city?></td>
                                        </tr>
                                        <tr>
                                            <th>Leading Date </th>
                                            <td>:
                                                <?php echo date("Y-m-d / h:i A", strtotime($view_data->leading_date))?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status </th>
                                            <td>
                                                :
                                                <?php echo ($view_data->status ==1)?'<b class="text-success">Active</b>':'<b class="text-danger">Inactive</b>'?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Adding Date</th>
                                            <td>: <?php echo date("Y-m-d / h:i A", strtotime($view_data->adding_dt))?>
                                            </td>
                                        </tr>

                                        <?php if(!empty($view_data->comment)){?>
                                        <tr>
                                            <th>Comment </th>
                                            <td class="text-align-justify">: <?php echo $view_data->comment?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                        <div class="__flx_button_prv_nxt" style="width:99%">
                            <div class="__bck_butn">
                                <a href="<?=base_url()?>sub_admin/calling" class="button_news"> &lt; Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>