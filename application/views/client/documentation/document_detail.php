<style>

</style>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                <section class="content-header">
                    <div class="fro_rexch_back_color_doct">
                        <h1 class="yhhg_uudhhf"><?=$sub_sub_category_data->sub_sub_category_name?></h1>
                    </div>
                </section>
                <!-- detials -->
                <section class="content-header containerBox detailsCon">
                    <div class="container py-3">
                        <div class="row">
                            <div class="col-md-12 box" style="padding:30px 20px">
                                <?= $sub_sub_category_data->descreption ?>
                                <br/>
                                <button type="button" class="nextBtn btn btn-primary">Next  <i class="bi bi-arrow-right text-white"></i> </button>
                            </div>
                        </div>
                        
                    </div>
                </section>
                <!--// end-->
                <div class="row">
                    <div class="col-md-12">

                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
            <div class="document_div">
                <div class="col-md-12 containerBox  hidden formCon">
                    <div class="box box-primary">
                        <form role="form" id="member_form" action="<?php echo base_url() ?>client/documentation/payment"
                            method="post" role="form" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="box___doctmt ">
                                    <div class="row ">
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>Price-</b>
                                                <?=$sub_sub_category_data->price?></h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>Discount-</b>
                                                <?=$sub_sub_category_data->discount?>%
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>Gross-</b>
                                                <?=$sub_sub_category_data->gross_price?>
                                            </h4>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>GST-</b> <?=$sub_sub_category_data->gst?>%
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>GST Price-</b>
                                                <?=$sub_sub_category_data->gst_price?></h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>Total Price-
                                                </b><?=$sub_sub_category_data->price+$sub_sub_category_data->gst_price-$sub_sub_category_data->save_price?>/-
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="for_oosd_documtati__padg">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-center party">First party</p>
                                            <div class="form-group">
                                                <label for="name"> Name</label><span>*</span>
                                                <input type="text" name="frist_party_name" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Father's Name</label><span>*</span>
                                                <input type="text" name="first_party_father" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Age</label><span>*</span>
                                                <input type="number" name="frist_party_age" class="form-control"
                                                    placeholder="Enter your Age" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Address</label><span>*</span>
                                                <input type="text" name="frist_party_address" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-center party">Second party</p>
                                            <div class="form-group">
                                                <label for="name">Name</label><span>*</span>
                                                <input type="text" name="second_party_name" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Father's Name</label><span>*</span>
                                                <input type="text" name="second_party_father" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Age</label><span>*</span>
                                                <input type="number" name="second_party_age" class="form-control"
                                                    placeholder="Enter your Age" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Address</label><span>*</span>
                                                <input type="text" name="second_party_address" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="doc_type"
                                                value="<?=$sub_sub_category_data->sub_sub_category_name?>">
                                            <input type="hidden" name="price"
                                                value="<?=$sub_sub_category_data->price?>">
                                            <input type="hidden" name="discount"
                                                value="<?=$sub_sub_category_data->discount?>">
                                            <input type="hidden" name="save_price"
                                                value="<?=$sub_sub_category_data->save_price?>">
                                            <input type="hidden" name="gst" value="<?=$sub_sub_category_data->gst?>">
                                            <input type="hidden" name="gst_price"
                                                value="<?=$sub_sub_category_data->gst_price?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">More Details</label>
                                                <textarea name="more_details" class="text_field form-control"
                                                    placeholder="Enter More Details"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer text-center">
                                <button type="button" class="backBtn btn btn-primary"><i class="bi bi-arrow-left"></i> Back   </button>
                                <input type="submit" class="btn btn-primary" value="Submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".nextBtn").click(function(){
            $(".containerBox").addClass('hidden');
            $(".formCon").removeClass('hidden');
        });

        $(".backBtn").click(function(){
            $(".containerBox").addClass('hidden');
            $(".detailsCon").removeClass('hidden');
        });

    });
</script>



<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>