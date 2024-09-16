<div id="allSet">
    <section class="_wp_law_pd" style="padding:40px 5px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 law_client">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                        <div class="for_bg_color_cont_us formCon">
                            <div class="modal-header1 ">
                                <div class="row p-2 m-3 ">
                                    <div class="col-md-8">
                                        <h3 class=" pt-3">
                                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $sub_sub_category_name_hi;
                            }else{
                                echo $sub_sub_category_name;
                            }?>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <form id="form_submit" action="<?=base_url()?>certificare/book-now" method="post">
                                <div class="container for_m_pld_qury__">
                                    <div class="row">
                                        <div class="col-md-8 formInnerCon" id="formAreaCon">
                                            <div id="" class="show  biiling_details_bg " aria-labelledby="headingOne"
                                                data-parent="#">
                                                <div class="form">
                                                    <div class="Register" style=" color:red;"> </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group for_text_Indhf">
                                                                <label for="text">First name <span
                                                                        class="text-muted">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control fname ___mobiletypeframe "
                                                                    maxlength="25" id="fname"
                                                                    placeholder="Enter your First Name"
                                                                    name="addtional[first_name]" value="" required>
                                                                <div class="invalid-feedback">
                                                                    Valid first name is required.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group for_text_Indhf">
                                                                <label for="lname">Last name</label>
                                                                <input type="text"
                                                                    class="form-control lname ___mobiletypeframe"
                                                                    maxlength="25" name="addtional[last_name]"
                                                                    id="lname" placeholder="Enter your Last Name"
                                                                    value="">
                                                                <div class="invalid-feedback">
                                                                    Valid last name is required.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="email_validation"></div>
                                                            <div class="form-group for_text_Indhf">
                                                                <label for="email">Email <span
                                                                        class="text-muted">*</span></label>
                                                                <input type="email"
                                                                    class="form-control email ___mobiletypeframe"
                                                                    maxlength="128" name="addtional[email]" id="email"
                                                                    value="" placeholder="Enter your Email" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid email address for shipping
                                                                    updates.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group for_text_Indhf">
                                                                <label for="mobile">Mobile <span
                                                                        class="text-muted">*</span></label>
                                                                <div class="mobile_validation"></div>
                                                                <input type="text"
                                                                    class="form-control mobile ___mobiletypeframe"
                                                                    maxlength="10" id="mobile" name="addtional[mobile]"
                                                                    value="" placeholder="Enter your Mobile No"
                                                                    required>
                                                                <div class="invalid-feedback">
                                                                    Please Enter valid mobile number
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group for_text_Indhf">
                                                                <label for="Enrolement">State</span> <span
                                                                        class="text-muted">*</span></label>
                                                                <input type="text"
                                                                    class="form-control state ___mobiletypeframe"
                                                                    name="addtional[state]" value="" required
                                                                    placeholder="State">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="form-group for_text_Indhf">
                                                                <label for="Enrolement">City</label>
                                                                <input type="text"
                                                                    class="form-control city ___mobiletypeframe"
                                                                    name="addtional[city]" value="" placeholder="City">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row pt-5">
                                                        <div class="col-md-12">
                                                            <div class="text-center">
                                                                <input type="hidden" name="addtional[sub_cat_name]"
                                                                    value="<?=$sub_cat_name?>">
                                                                <input type="hidden"
                                                                    name="addtional[sub_sub_category_name]"
                                                                    value="<?=$sub_sub_category_name?>">
                                                                <input type="hidden" name="addtional[discount]"
                                                                    value="<?=$discount?>">
                                                                <input type="hidden" name="addtional[save_price]"
                                                                    value="<?=$save_price?>">
                                                                <input type="hidden" name="addtional[price]"
                                                                    value="<?=$price?>">
                                                                <input type="hidden" name="addtional[gross_price]"
                                                                    value="<?=$gross_price?>">
                                                                <input type="hidden" name="addtional[gst_price]"
                                                                    value="<?=$gst_price?>">
                                                                <input type="hidden" name="addtional[gst]"
                                                                    value="<?=$gst?>">
                                                                <input type="hidden" name="doc_id" value="<?=$doc_id?>">
                                                                <div class="for_but_imsg_qury_sent">
                                                                    <button type="submit" class="btn btn-lg apply_btn"
                                                                        style="margin-bottom: 8px;"><?=$this->lang->line('submit_cpay');?></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="for_qury_paymt_img">
                                                <img src="<?= base_url('assets/images/payment_query.jpg')?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <!-- progress page -->
                        <div class="for_bg_color_cont_us progressCon hidden">
                            <div class="row py-5">
                                <div class="col-md-12 text-center">
                                    <img src="<?= base_url('assets/images/progress.gif')?>" width="130">
                                    <br /><br />
                                    <p class="text-success">Sending....</p>

                                </div>
                            </div>
                        </div>
                        <!--end progress con -->

                        <!-- success page -->
                        <div class="for_bg_color_cont_us successCon hidden">
                            <div class="row py-5">
                                <div class="col-md-12 text-center">
                                    <img src="<?= base_url('assets/images/success.png')?>" width="130">
                                    <br /><br />
                                    <h2 class="text-success">Query successfully sent!</h2>
                                    <br />
                                    <a href="<?= base_url() ?>" class="btn btn-primary"><i class="bi bi-house"></i>
                                        Go Home</a>
                                </div>
                            </div>
                        </div>
                        <!--end success con -->

                    </div>

                </div>


            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function() {
    $("#form_submit").submit(function(e) {
        e.preventDefault()
        var url = $(this).attr('action');
        $(".for_bg_color_cont_us").addClass('hidden');
        $(".progressCon").removeClass('hidden');
        var arr = $(this).serializeArray();

        $.ajax({
            type: 'post',
            url: url,
            data: arr,
            success: function(responce) {
                if (responce == 1) {
                    $(".for_bg_color_cont_us").addClass('hidden');
                    $(".successCon").removeClass('hidden');
                }
            }
        });
        return false;

    });
});
$("#fname,#lname,#email,#mobile,#state,#city").keyup(function() {
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var mobile = $("#mobile").val();
    var state = $("#state").val();
    var city = $("#city").val();

    $("#first_name").val(fname)
    $("#last_name").val(lname)
    $("#my_email").val(email)
    $("#my_mobile").val(mobile)
    $("#my_state").val(state)
    $("#my_city").val(city)

});
</script>
<script>
$(document).ready(function() {

    $(".apply_btn").attr("disabled", "disabled");
    $(".fname,.email,.mobile").keyup(function() {

        var fname = $(".fname").val();
        var email = $(".email").val();
        var mobile = $(".mobile").val();

        if (email !== '') {
            var emailvalid = validate(email);

            if (fname !== '' && emailvalid == true && mobile !== '') {

                $(".apply_btn").removeAttr("disabled");
            } else {
                $(".apply_btn").attr("disabled", "disabled");
            }
        }
    });

    function validate(email) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (reg.test(email) == false) {
            $('.email_validation').html('<div class="alert-danger">Invalid Email Address</div>');
            $(".apply_btn").attr("disabled", "disabled");
            return (false);
        } else {
            $('.email_validation').html('');
            return (true);
        }

    }

    $("#mobile").keyup(function() {
        var mobile = $("#mobile").val();
        var value = mobile.replace(/[^0-9]/g, "");
        $(this).val(value);
        if (mobile.length < 10) {
            $('.mobile_validation').html(
                '<div class="alert-danger">Enter 10 digit mobile number</div>');
            $(".apply_btn").attr("disabled", "disabled");
        } else {
            $('.mobile_validation').html('<div class="alert-success"></div>');
            return (true);
        }
    })

});
</script>

<style>
.for_text_Indhf input {
    width: 100% !important;
    margin: 0 !important;
}

.for_qury_paymt_img img {
    width: 100%;
}

.for_m_pld_qury__ {
    padding: 35px;
}

.for_but_imsg_qury_sent button {
    background: green;
    color: white;
}
</style>