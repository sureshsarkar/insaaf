<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="__flx_button_prv_nxt mb-2" style="width:99%">
                        <div class="__bck_butn">
                            <a href="<?=base_url()?>sub_admin/tempdata" class="button_news"> &lt; Back</a>
                        </div>
                    </div>
                    <div class="col-md-11 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
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
                                            <th>Feedback</th>
                                            <td>
                                                <input type="text" name="feedback" value="<?= $view_data->feedback?>"
                                                    class="form-control feedback">
                                                <input type="hidden" name="id" id="dataId" value="<?= $view_data->id?>">
                                                <button class="btn btn-info my-2 addFeedback">Add</button>
                                            </td>
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



<script>
$(document).ready(function() {
    $(".addFeedback").click(function() {
        var id = $("#dataId").val();
        var feed = $(".feedback").val();

        var hitURL = "<?php echo base_url() ?>admin/tempdata/addFeed";
        $.ajax({
            type: 'POST',
            url: hitURL,
            data: {
                id: id,
                feed: feed
            },
        }).done(function(res) {
            if (res == 1) {
                alert("Feedback Added")
            }
        });


    })

})
</script>