<div class="content-wrapper">

    <section class=" ___bg_content___vtx_dashboard">

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

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>

        </div>
        <section>
            <div class="container-fluid">
                <div class="col-md-12 paret-0">
                    <div class="proccessCon">
                        <h4><strong>Slot booking proccess</strong></h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Select Case Category</li>
                                <li class="breadcrumb-item active">Schedule Meeting</li>
                                <li class="breadcrumb-item active" aria-current="page">Payment</li>
                                <li class="breadcrumb-item active" aria-current="page">Done</li>
                            </ol>
                        </nav>
                    </div>

                    <select class="btn btn-primary dropdown-toggle ___civil__lawyer" id="option_case">
                        <option value="">Select Category</option>
                        <?php foreach($all_case_category as $case_category){ ?>
                        <option value="<?php echo $case_category->id; ?>"><?php echo $case_category->name; ?></option>
                        <?php } ?>
                    </select>
                    &nbsp;&nbsp;&nbsp; <a href="<?php echo base_url('client/create_case/ajax3/') ?>"
                        class="btn btn-primary btnNext hidden">Next &nbsp; <i class="bi bi-arrow-right"></i> </a>
                </div>
                <!-- div lawyer list-->
                <div class="row lawyerCon">

                </div>
                <!--// div lawyer list-->
            </div>
        </section>
    </section>

</div>
<script>
$(document).ready(function() {
    $('#option_case').on('change', function() {
        $(".proccessCon").addClass("hidden");
        $(".btnNext").addClass("hidden");
        var demovalue = $(this).val();
        // alert(demovalue);
        if (demovalue != '') {
            $(".law_div").hide();
            $(".lawyer_div_" + demovalue).show();
        } else {
            $(".law_div").show();
        }
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('client/create_case/save_ses_casecategory'); ?>",
            data: {
                case_cat: demovalue
            },
            success: function(response) {
                if (response == 2 || response == 3) {
                    $(".proccessCon").removeClass("hidden");
                    $(".btnNext").addClass("hidden");
                    $(".lawyerCon").html(
                        '<br/><br/><div class="container-fluid"><div class="row"><div class="col-md-12 py-3 px-4"><p>No have lawyer in this category!!</p></div></div></div>'
                        );
                } else {
                    // $(".lawyerCon").html(response);
                    $(".btnNext").removeClass("hidden");
                }

            }
        });
    });
});
</script>