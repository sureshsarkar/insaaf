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
                    <div class="container-fluid">
                        <div class="row p-2">
                            <div class="col-md-12 box pb-2">

                                <p class="p-2 font-text-form">
                                    In India, partnership businesses fall under governance and get regulated under the
                                    Indian Partnership Act, of 1932. Partners are the people who work together to
                                    establish a partnership company. The partnership business is founded by an agreement
                                    between the partners. A partnership Agreement is a contract between the partners
                                    that governs the relationship between the partners as well as the partnership
                                    company.
                                    <br>
                                    To get a Partnership Firm issued or to know more
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
                                            <div class="form-group">
                                                <label for="name">Company Name</label><span>*</span>
                                                <input type="text" name="addtional[company_name]" class="form-control"
                                                    placeholder="Enter No of Partners" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">No of Partners</label><span>*</span>
                                                <input type="mumber" name="addtional[no_of_partners]"
                                                    class="form-control" placeholder="Enter No of Partners" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="name">Name 1</label><span>*</span>
                                                <input type="text" name="addtional[Name_1]" class="form-control"
                                                    placeholder="Enter Co-Owner Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="name">Father Name 1</label><span>*</span>
                                                <input type="text" name="addtional[father_name_1]" class="form-control"
                                                    placeholder="Enter Father Name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="name">Address 1</label><span>*</span>
                                                <input type="text" name="addtional[address_1]" class="form-control"
                                                    placeholder="Enter Address" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="name">Capital 1</label><span>*</span>
                                                <input type="text" name="addtional[capital_1]" class="form-control"
                                                    placeholder="Enter Capital" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2"><button id="addRow" type="button"
                                                class="btn btn-info btn-small" title="">+</button>
                                        </div>
                                        <div id="newRow"></div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
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
                                    <h3 class="text-success">Your Request Sent Successfully. Our Team will contact you
                                        in a Short while</h3>
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

<script>
// add row
var i = 1;
$("#addRow").click(function() {
    i++;
    var html = '';
    html += '<div id="inputFormRow">';
    html += ' <div class="col-md-5">';
    html += '<div class="form-group">';
    html += '<label for="name">Name ' + i + '</label><span>*</span>';
    html += '<input type="text" name="addtional[Name_' + i +
        ']" class="form-control" placeholder="Enter Co-Owner Name" required>';
    html += '</div>';
    html += ' </div>';
    html += ' <div class="col-md-5">';
    html += ' <div class="form-group">';
    html += '   <label for="name">Father Name ' + i + '</label><span>*</span>';
    html += '   <input type="text" name="addtional[father_name_' + i +
        ']" class="form-control" placeholder="Enter Father Name" required>';
    html += ' </div>';
    html += ' </div>';
    html += ' <div class="col-md-5">';
    html += ' <div class="form-group">';
    html += '  <label for="name">Address ' + i + '</label><span>*</span>';
    html += ' <input type="text" name="addtional[address_' + i +
        ']" class="form-control" placeholder="Enter Address" required>';
    html += ' </div>';
    html += '</div>';
    html += ' <div class="col-md-5">';
    html += '<div class="form-group">';
    html += '<label for="name">Capital ' + i + '</label><span>*</span>';
    html += ' <input type="text" name="addtional[capital_' + i +
        ']" class="form-control" placeholder="Enter Capital" required>';
    html += ' </div>';
    html += '</div>';
    html +=
        '  <div class="col-md-2 mt-5"><button id="removeRow" type="button" class="btn btn-danger btn-small">-</button>';
    html += ' </div>';
    html += '</div>';

    $('#newRow').append(html);
});



// remove row
$(document).on('click', '#removeRow', function() {
    $(this).closest('#inputFormRow').remove();
});
</script>

<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>