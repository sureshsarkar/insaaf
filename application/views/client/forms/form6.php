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
                <section class="content-header containerBox detailsCon ">
                    <div class="container-fluid py-3">
                        <div class="row p-2">
                            <div class="col-md-12 box pb-2">
                                <p class="p-2 font-text-form">
                                    Relinquishment Deed is a legal instrument that gives up or releases the rights,
                                    titles, and interests of a specific legal heir on behalf of other legal heirs in a
                                    common property. The other heirs may be linked as parents, siblings, children, and
                                    so on. The relinquishment Deed has the effect of lowering the number of
                                    shareowners in a property, resulting in a bigger portion for the current heirs. It
                                    differs from a gift deed in which the shares of a specific owner are gifted to any
                                    other person who may or may not be a legal heir to that property.
                                    <br>
                                    To get your Relinquishment Deed drafted or to know more
                                </p>

                                <button type="button" id="RequestCall" class="btn btn-primary"> <i
                                        class="bi bi-arrow-right text-white color121">Request for call</i> </button>

                                <button type="button" class="nextBtn btn btn-primary ml-2"> <i
                                        class="bi bi-arrow-right text-white color121">Book Now</i> </button>
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
                <div class="col-md-12 containerBox hidden  formCon">
                    <div class="box box-primary">
                        <form role="form" id="member_form" action="<?php echo base_url() ?>client/documentation/payment"
                            method="post" role="form" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="box___doctmt ">
                                    <div class="row ">
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>Price-</b>
                                            ₹<?=$sub_sub_category_data->price?></h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>Discount-</b>
                                                <?=$sub_sub_category_data->discount?>%
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>GST-</b> <?=$sub_sub_category_data->gst?>%
                                            </h4>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <?php $res=getPrice($sub_sub_category_data->price,$sub_sub_category_data->discount,$sub_sub_category_data->gst);
                                      
                                      $priceData=json_decode($res);
                                      ?>
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>GST Price-
                                                </b> ₹<?=$priceData->gstPrice?>/-
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>Save Price-
                                                </b> ₹<?=$priceData->savePrice?>/-
                                            </h4>
                                        </div>

                                        <div class="col-md-4">
                                            <h4 class="text-center head__"><b>Total Price-
                                                </b> ₹<?=$priceData->grossPrice?>/-
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="for_oosd_documtati__padg">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-center party">Executant</p>
                                            <div class="form-group">
                                                <label for="name"> Name</label><span>*</span>
                                                <input type="text" name="first[name]" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Husband/Father's Name</label><span>*</span>
                                                <input type="text" name="first[father_name]" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Age</label><span>*</span>
                                                <input type="text" name="first[age]" class="form-control"
                                                    placeholder="Enter your Age" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Address</label><span>*</span>
                                                <input type="text" name="first[address]" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-center party">Beneficiary</p>
                                            <div class="form-group">
                                                <label for="name">Name</label><span>*</span>
                                                <input type="text" name="second[name]" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Husband/Fathers Name</label><span>*</span>
                                                <input type="text" name="second[father_name]" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="text">Age</label><span>*</span>
                                                <input type="text" name="second[age]" class="form-control"
                                                    placeholder="Enter your Age" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Address</label><span>*</span>
                                                <input type="text" name="second[address]" class="form-control"
                                                    placeholder="Enter your Name" required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <h4 class="text-warning ml-4">Actual Owner of the Property</h4>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Name</label><span>*</span>
                                                <input type="text" name="addtional[actual_owner_name]"
                                                    class="form-control" placeholder="Enter Actual Owner Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Husband/Fathers Name</label><span>*</span>
                                                <input type="text" name="addtional[actual_owner_father]"
                                                    class="form-control" placeholder="Enter Husband/Fathers Name"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Age</label><span>*</span>
                                                <input type="text" name="addtional[actual_owner_age]"
                                                    class="form-control" placeholder="Enter Reason for Eviction"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Address</label><span>*</span>
                                                <input type="text" name="addtional[actual_owner_address]"
                                                    class="form-control" placeholder="Enter Actual Owner Address "
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Detail of Assets</label><span>*</span>
                                                <textarea name="addtional[details_of_assets]"
                                                    class="text_field form-control" placeholder="Enter Detail of Assets"
                                                    required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">More Info</label>
                                                <textarea name="addtional[more_details]" class="text_field form-control"
                                                    placeholder="Enter More info"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Attachment</label>
                                                <input type="file" name="attachfile[]" multiple="multiple"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="doc_id" value="<?=$sub_sub_category_data->id?>">
                                    <input type="hidden" name="slug" value="<?=$sub_sub_category_data->slug_url?>">
                                    <input type="hidden" name="doc_type"
                                        value="<?=$sub_sub_category_data->sub_sub_category_name?>">
                                    <input type="hidden" name="cart[price]" value="₹<?=$sub_sub_category_data->price?>">
                                    <input type="hidden" name="cart[discount]"
                                        value="<?=$sub_sub_category_data->discount?>%">
                                    <input type="hidden" name="cart[gst]" value="<?=$sub_sub_category_data->gst?>%">
                                    <input type="hidden" name="cart[save_price]" value="₹<?=$priceData->savePrice?>">
                                    <input type="hidden" name="cart[gst_price]" value="₹<?=$priceData->gstPrice?>">
                                    <input type="hidden" name="cart[gross_price]" value="₹<?=$priceData->grossPrice?>">
                                    <input type="hidden" name="gross_price" value="<?=$priceData->grossPrice?>">
                                    <input type="hidden" name="cart[label]" value="Cart Data">
                                    <input type="hidden" name="first[label]" value="Landload">
                                    <input type="hidden" name="second[label]" value="Tenant">
                                    <input type="hidden" name="addtional[label]" value="Actual Owner of the Property">
                                </div>
                            </div>

                            <div class="box-footer text-center">
                                <button type="button" class="backBtn btn btn-primary"><i class="bi bi-arrow-left"></i>
                                    Back </button>
                                <input type="submit" class="btn btn-primary" value="Submit" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 containerBox hidden  welcomeDiv">
                    <div class="box box-primary">
                        <div class="for_bg_color_cont_us successCon">
                            <div class="row py-5">
                                <div class="col-md-12 text-center">
                                    <img src="<?= base_url('assets/images/success.png')?>" width="130">
                                    <br><br>
                                    <h3 class="text-success">Your Request Sent Successfully. Our Team will contact you in a Short while</h3>
                                    <br>
                                    <a href="<?= base_url('client/dashboard')?>" class="btn btn-primary"><i
                                            class="bi bi-house"></i>
                                        Go Home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script type="text/javascript">
$(document).ready(function() {
    $(".nextBtn").click(function() {
        $(".containerBox").addClass('hidden');
        $(".formCon").removeClass('hidden');
    });

    $(".backBtn").click(function() {
        $(".containerBox").addClass('hidden');
        $(".detailsCon").removeClass('hidden');
    });

});
</script>



<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>