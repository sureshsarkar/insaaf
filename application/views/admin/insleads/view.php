<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="__flx_button_prv_nxt mb-2" style="width:99%">
                        <div class="__bck_butn">
                            <a href="<?=base_url()?>admin/insleads" class="button_news"> &lt; Back</a>
                        </div>
                    </div>
                    <div class="col-md-11 m-auto">
                        <div class="for_client__">

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>

                                        <tr>
                                            <th>Device IP </th>
                                            <td> : <?php echo $view_data->device_ip?></td>
                                        </tr>

                                        <tr>
                                            <th>camp_id </th>
                                            <td> : <?php echo $view_data->camp_id?></td>
                                        </tr>

                                        <tr>
                                            <th>type </th>
                                            <td> : <?php echo $view_data->type?></td>
                                        </tr>

                                        <tr>
                                            <th>keyword </th>
                                            <td> : <?php echo $view_data->keyword?></td>
                                        </tr>

                                        <tr>
                                            <th>device </th>
                                            <td> : <?php echo $view_data->device?></td>
                                        </tr>

                                        <tr>
                                            <th>network </th>
                                            <td> : <?php echo $view_data->network?></td>
                                        </tr>

                                        <tr>
                                            <th>created_at </th>
                                            <td> : <?php echo date("d M Y",strtotime($view_data->created_at))?></td>
                                        </tr>

                                        <?php if(isset($view_data->tempData) && !empty($view_data->tempData)){ 
                                            $viewData = json_decode($view_data->tempData);
                                            $i = -1;
                                        foreach ($viewData as $key => $value) {
                                            $i++;
                                            if($key =='category'){
                                                if(preg_match('/[0-9]/', $value)){
                                                    $get_cat = $this->db->get_where('case_category', ['id'=> $value])->row();
                                                    ?>
                                        <tr>
                                            <th><?php echo ucwords($key)?> </th>
                                            <td> :<?php echo (isset($get_cat->name))? ucwords($get_cat->name):"";?></td>
                                        </tr>
                                        <?php }else{

                                        ?>
                                        <tr>
                                            <th><?php echo ucwords($key)?> </th>
                                            <td> : <?php echo ucwords($value)?></td>
                                        </tr>
                                        <?php }}else{?>
                                        <tr>
                                            <th><?php echo ucwords($key)?> </th>
                                            <td> : <?php echo ucwords($value)?></td>
                                        </tr>
                                        <?php }} ?>

                                        <?php } ?>


                                        <tr>
                                            <th>Feedback </th>
                                            <td> : <?php echo $view_data->feedback?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                        <h3>JKM Leads</h3>


                    </div>
                </div>
            </div>
        </section>
    </section>
</div>