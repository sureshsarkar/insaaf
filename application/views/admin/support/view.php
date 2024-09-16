<?php 
if(isset($view_data->jsonText) && !empty($view_data->jsonText)){
 $otherData =json_decode($view_data->jsonText);   

}else{
    $otherData ='';
}
?>

<style>
.boxDataCenter {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <section class="content">
            <div class="container">
                <div class="row ">
                    <div class="col-md-10 boxDataCenter">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <?php if(isset($otherData) && !empty($otherData)){?>
                                    <tbody>
                                        <tr>
                                            <th>Mobile</th>
                                            <td> : <?php echo $otherData->mobile?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td> : <?php echo $otherData->email?></td>
                                        </tr>

                                        <tr>
                                            <th>Message</th>
                                            <td> : <?php echo $otherData->message?></td>
                                        </tr>
                                    </tbody>
                                    <?php }?>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>