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
                                    class="text-warning"><?php echo $view_data->fname." ".$view_data->lname?></b>
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
                                            <td>: <?php echo $view_data->client_unique_id?></td>
                                        </tr>
                                        <tr>
                                            <th>Name </th>
                                            <td>: <?php echo $view_data->fname." ".$view_data->lname?></td>
                                        </tr>
                                        <tr>
                                            <th>Email </th>
                                            <td>: <?php echo $view_data->email?></td>
                                        </tr>
                                        <tr>
                                            <th>Mobile </th>
                                            <td>: <?php echo $view_data->mobile?></td>
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
                                        <!-- Payment details-->
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase"><b>Payment Details</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Payment Status</th>
                                            <td>:
                                                <?=($view_data->payment_status=='Success')?'<div class="badge bg-success">Success</div>':'<div class="badge bg-danger">Pending</div>';?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Payment For</th>
                                            <td>: <?=$view_data->payment_type?></td>
                                        </tr>
                                        <tr>
                                            <th>Order ID</th>
                                            <td>: <?=$view_data->order_id?></td>
                                        </tr>
                                        <tr>
                                            <th>Transection ID</th>
                                            <td>: <?=$view_data->txn_id?></td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td>: <?=$view_data->amount?>/-</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Date</th>
                                            <td>: <?=$view_data->payment_date?>/-</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Update Date</th>
                                            <td>: <?=$view_data->updateAt?>/-</td>
                                        </tr>
                                        <tr>
                                            <th>Download Invoice </th>
                                            <td>: <a href="<?=base_url('utils/invoices/').$view_data->pdfname.$view_data->client_id.'invoice.pdf'?>"
                                                    target="_blank"><button
                                                        class="bnt btn-success">Download</button></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="__flx_button_prv_nxt" style="width:99%">
                                <div class="__bck_butn">
                                    <a href="<?=base_url()?>admin/refund" class="button_news"> &lt; Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>