<section class="banner_main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="banner_text_home">
                    <h1><?=$this->lang->line('onlineadvise')?></h1>
                    <h2 class="h1"><?=$this->lang->line('insaaf99')?></h2>
                    <h5 class="h5para"> <?=$this->lang->line('onlineplt')?></h5>
                    <div class=" rx_slider_text_btn">

                        <a href="<?= base_url("signup?type=lawyer")?>" target="_blank" rel="nofollow">
                            <?=$this->lang->line('lawyerclickhere')?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4 pt-4">
                <div class="__form__index ">
                    <!-- form box  -->
                    <div class="formCon">
                        <form id="formSubmit" method="POST">
                            <div class="___form__header">
                                <p> <?=$this->lang->line('get_started')?></p>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="form-group mb-0 form_input_pading_home_page">
                                        <input type="text" name="name" id="userName" placeholder="Full Name"
                                            class="form-control  selected name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="form-group mb-0 form_input_pading_home_page">
                                        <input type="number" name="mobile" id="mobile" placeholder="Mobile Number"
                                            minlength="10" maxlength="10" class="form-control __control__form mobile">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="form-group mb-0 form_input_pading_home_page">
                                        <input type="email" name="email" placeholder="Email"
                                            class="form-control   __control__form email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="form-group mb-0 form_input_pading_home_page">
                                        <input type="text" name="query" placeholder="Enter query"
                                            class="form-control __control__form query">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="">
                                        <div class="d-flex ___final__row">
                                            <div class="form-check male __sameCallInsaff ml__coll_0">
                                                <input class="form-check-input gender" type="radio" name="gender"
                                                    id="flexRadioDefault1" value="1">
                                                <label class="form-check-label" id="male" for="flexRadioDefault1">
                                                    Male </label>
                                            </div>
                                            <div class="form-check __sameCallInsaff">
                                                <input class="form-check-input female gender" type="radio" name="gender"
                                                    id="exampleCheck2" value="2">
                                                <label class="form-check-label" id="female" for="exampleCheck2">
                                                    Female </label>
                                            </div>

                                            <div class="form-check __sameCallInsaff">
                                                <input class="form-check-input other gender" type="radio" name="gender"
                                                    id="exampleCheck3" value="3">
                                                <label class="form-check-label" id="other" for="exampleCheck3">
                                                    Other </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="talk__to11">
                                        <button type="submit"
                                            class="btn talk__btn"><?=$this->lang->line('talk_to_expert')?> </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- start documentation section  -->
<section class="bg_timeline">
    <div class="container">
        <div class="row mt-4 pt-4 mb-4 pb-4">
            <div class="col-md-6">
                <div class="side_img__">
                    <img src="<?=base_url('assets/images/new-home/banner_3.webp')?>" alt="">
                </div>
            </div>
            <div class="col-md-6 order_col">
                <div class="side_text">
                    <h3> <?=$this->lang->line('legaldoc')?></h3>
                    <p> <?=$this->lang->line('doyouwant')?></p>
                </div>
                <div class="topics_documents">
                    <a class="Topic_po"
                        href="<?=base_url('specialization/documentation/non-disclosure-agreement')?>">Non Disclosure
                        Agreement</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/non-compete-agreement')?>">Non
                        Compete Agreement</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/service-agreement')?>">Service
                        Agreement</a>
                    <a class="Topic_po"
                        href="<?=base_url('specialization/documentation/franchise-agreement')?>">Franchise Agreement</a>
                    <a class="Topic_po"
                        href="<?=base_url('specialization/documentation/partnership-deed')?>">Partnership Deed</a>
                    <a class="Topic_po"
                        href="<?=base_url('specialization/documentation/memorandum-of-understanding')?>">Memorandum Of
                        Understanding</a>
                    <a href="<?= base_url('all-services')?>"><button
                            class="red_mored_documentas"><?=$this->lang->line('read_more')?>..</button></a>
                </div>

                <div class="limited_offer">
                    <div class="limited_text_button">
                        <div class="_off_less">
                            <h5> <?=$this->lang->line('limitedoffer')?></h5>
                            <p><small> <?=$this->lang->line('get80')?> </small></p>
                        </div>
                        <div class="_consult_now_btn">
                            <a href="<?=base_url('legal-advice?c=document')?>"><button>
                                    <?=$this->lang->line('consultnow')?></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 pt-4 mb-4 pb-4">
            <div class="col-md-6">
                <div class="side_text">
                    <h3><?=$this->lang->line('legalconsult')?></h3>
                    <p><?=$this->lang->line('areyou')?></p>
                </div>
                <div class="topics_documents">
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/sale-deed')?>">Sale Deed</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/rent-agreement')?>">Rent
                        Agreement</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/gift-deed')?>">Gift Deed</a>
                    <a class="Topic_po"
                        href="<?=base_url('specialization/documentation/lease-license-agreement')?>">Lease/license
                        Agreement</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/partition-deed')?>">Partition
                        Deed</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/power-of-attorney')?>">Power Of
                        Attorney</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/will')?>">Will</a>
                    <a href="<?= base_url('all-services')?>"><button
                            class="red_mored_documentas"><?=$this->lang->line('read_more')?>..</button></a>
                </div>

                <div class="limited_offer">
                    <div class="limited_text_button">
                        <div class="_off_less">
                            <h5> <?=$this->lang->line('limitedoffer')?> </h5>
                            <p><small> <?=$this->lang->line('get80')?> </small></p>
                        </div>
                        <div class="_consult_now_btn">
                            <a
                                href="<?=base_url('legal-advice?c=document')?>"><button><?=$this->lang->line('consultnow')?></button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="side_img__">
                    <img src="<?=base_url('assets/images/new-home/banner_2.webp')?>" alt="">
                </div>
            </div>
        </div>
        <div class="row mt-4 pt-4 mb-4 pb-4">
            <div class="col-md-6 ">
                <div class="side_img__">
                    <img src="<?=base_url('assets/images/new-home/banner_4.webp')?>" alt="">
                </div>
            </div>
            <div class="col-md-6 order_col">
                <div class="side_text">
                    <h3><?=$this->lang->line('legal_Notices_cont')?></h3>
                    <p><?=$this->lang->line('gettingthe')?> </p>
                </div>
                <div class="topics_documents">
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/legal-recovery-notice')?>">Legal
                        Recovery Notice</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/promissory-note')?>">Promissory
                        Note</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/loans-agreements')?>">Loans/
                        Agreements</a>
                    <a class="Topic_po"
                        href="<?=base_url('specialization/documentation/refund-of-security-notices')?>">Refund Of
                        Security Notices</a>
                    <a class="Topic_po" href="<?=base_url('specialization/documentation/recovery-of-dues')?>">Recovery
                        Of Dues</a>
                    <a href="<?= base_url('all-services')?>"><button
                            class="red_mored_documentas"><?=$this->lang->line('read_more')?>..</button></a>
                </div>
                <div class="limited_offer">
                    <div class="limited_text_button">
                        <div class="_off_less">
                            <h5><?=$this->lang->line('limitedoffer')?></h5>
                            <p><small><?=$this->lang->line('get80')?></small>
                            </p>
                        </div>
                        <div class="_consult_now_btn">
                            <a href="<?=base_url('legal-advice?c=document')?>"><button><?=$this->lang->line('consultnow')?>
                                </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End documentation section  -->


<!-- How To Register on section start  -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="__index_heading_get text-center ">
                    <p><?=$this->lang->line('howto')?></p>

                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 col-12">
                <div class="__process__index text-center">
                    <h3><?=$this->lang->line('describe_your_cont')?> </h3>
                    <p><?=$this->lang->line('get_yourself')?>
                    </p>
                    <h4><?=$this->lang->line('step_1')?> </h4>

                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="__process__index text-center">
                    <h3><?=$this->lang->line('with_a_lawyer')?> </h3>
                    <p><?=$this->lang->line('availthe')?> </p>
                    <h4><?=$this->lang->line('step_2')?> </h4>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="__process__index text-center">
                    <h3><?=$this->lang->line('save_time')?> </h3>
                    <p><?=$this->lang->line('select_time_slot')?> </p>
                    <h4><?=$this->lang->line('step_3')?></h4>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="____rounder__row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="step_count_info pt-4 mt-4">
                    <img src="<?php echo base_url()?>assets/images/new-home/graph.webp" alt="" class="img-fluid">

                </div>
            </div>
        </div>
    </div>
</section>

<!-- How To Register on section End   -->


<!-- we offer a client section start  -->
<section class="mb-4 pb-4 ">
    <div class="container-fluid">
        <div class="for_nn_disply">
            <div class="container pb-4 mb-4">
                <div class="main_heding_doument2">

                    <h3 class="pb-3 pt-2"><?=$this->lang->line('weoffer')?> </h3>
                </div>
                <!--first section-->
                <div class="row align-items-center how-it-works d-flex">
                    <div
                        class="col-2 text-center bottom d-inline-flex justify-content-center align-items-center chng_dirc_1">
                        <div class="circle font-weight-bold">1</div>
                    </div>
                    <div class="col-6 text_dar_timeline">
                        <h5><?=$this->lang->line('platforforon')?></h5>
                        <p><?=$this->lang->line('help_you_cont_stpe1')?> </p>
                    </div>
                    <div class="col-md-2">
                        <div class="timelineImage">
                            <img src="<?=base_url('assets/images/new-home/attorney.webp')?>" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
                <!--path between 1-2-->
                <div class="row timeline">
                    <div class="col-2">
                        <div class="corner top-right"></div>
                    </div>
                    <div class="col-8">
                        <hr />
                    </div>
                    <div class="col-2">
                        <div class="corner left-bottom"></div>
                    </div>
                </div>
                <!--second section-->
                <div class="row align-items-center justify-content-end how-it-works d-flex">
                    <div class="col-md-2">
                        <div class="timelineImage">
                            <img src="<?=base_url('assets/images/new-home/case-study.webp')?>" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-6 text_dar_timeline text-right">
                        <h5><?=$this->lang->line('narrow_if_cont')?> </h5>
                        <p><?=$this->lang->line('give_you_cont')?>
                        </p>
                    </div>
                    <div
                        class="col-2 text-center full d-inline-flex justify-content-center align-items-center  chng_dirc_2">
                        <div class="circle font-weight-bold">2</div>
                    </div>
                </div>
                <!--path between 2-3-->
                <div class="row timeline">
                    <div class="col-2">
                        <div class="corner right-bottom"></div>
                    </div>
                    <div class="col-8">
                        <hr />
                    </div>
                    <div class="col-2">
                        <div class="corner top-left"></div>
                    </div>
                </div>
                <!--third section-->
                <div class="row align-items-center how-it-works d-flex">
                    <div
                        class="col-2 text-center top d-inline-flex justify-content-center align-items-center chng_dirc_3">
                        <div class="circle font-weight-bold">3</div>
                    </div>
                    <div class="col-6 text_dar_timeline">
                        <h5><?=$this->lang->line('get_it_right_cont')?></h5>
                        <p><?=$this->lang->line('legal_stap_cont')?></p>
                    </div>
                    <div class="col-md-2">
                        <div class="timelineImage">
                            <img src="<?=base_url('assets/images/new-home/lawyer_time.webp')?>" class="img-fluid"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>


<!-- we offer a client End   -->


<div class="bg_color">


    <section class="bg_testmonial">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main_testmonial_heading">
                        <h4><?=$this->lang->line('ourtesti')?></h4>
                        <p><?=$this->lang->line('know_what_they_say')?> </p>
                        <p><small><?=$this->lang->line('we_provide_the_highest_quality')?></small>
                        </p>
                    </div>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner for_wid_crosul">

                            <?php if(isset($testimonial) && !empty($testimonial)){
                                foreach ($testimonial as $key => $value) {
                                    if($key == 1){
                                        $active = "active";
                                    }else{
                                        $active = "";
                                    }
                                ?>
                            <div class="carousel-item <?= $active?>">
                                <div class="testmonial_new">
                                    <div class="testmonial_img">
                                        <img src="<?=base_url('uploads/testimonial/').$value->image?>" alt="">
                                    </div>
                                    <div class="testmonial_nam_phera">
                                        <p> <?= $value->descreption?> </p>
                                        <h4><?= $value->name?></h4>
                                        <span><?php echo (isset($value->designation) && $value->designation !="")?"(".$value->designation.")":"";?></span>
                                    </div>
                                </div>
                            </div>
                            <?php } }?>

                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleControls"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>
                    <div class="view_all_testmonial">
                        <a href="<?=base_url('testimonial')?>"><button><?=$this->lang->line('view_all')?></button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<section>
    <div class="container mt-4 pt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="___qr__code">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="__jugement___new__index text-center float-left mb-3">
                                <p class="mb-0"><?=$this->lang->line('download_app')?> </p>
                            </div>
                            <div class="___app___comntent clear">
                                <h2><?=$this->lang->line('palm_of_your')?> </h2>
                                <p><?=$this->lang->line('get_all_your_legal')?> </p>
                            </div>
                            <ul class=" ___ul___index">
                                <li><?=$this->lang->line('get_services')?> </li>
                                <li> <?=$this->lang->line('use_your_dashboard')?> </li>
                                <li> <?=$this->lang->line('talk_to_our')?> </li>
                            </ul>
                            <div class="__play__insde ">
                                <a href="https://play.google.com/store/apps/details?id=com.insaaf99">
                                    <img src="<?php echo base_url()?>assets/images/home/play__strore___btn.webp"
                                        class="img-fluid" alt="Insaaf Google App">
                                </a>
                                <a href="#" class="text-decoration-none text-dark">or</a>
                                <div class="ool">
                                    <img src="<?php echo base_url()?>assets/images/home/insaaf-app-download.webp"
                                        class="img-fluid" alt="Insaaf App Download">
                                    <p><strong><?=$this->lang->line('scan_this_qr_qode')?> </strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 text-center size_ins_mobile">
                            <img src="<?php echo base_url()?>assets/images/home/insaaf_app.webp" class="img-fluid"
                                alt="Insaaf App Dashboard">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<script>
$("#formSubmit").submit(function(e) {
    e.preventDefault();
    // check captcha
    var name = $(".name").val();
    var email = $(".email").val();
    var mobile = $(".mobile").val();
    var query = $(".query").val();
    var gender = document.getElementsByName('gender');
    var genderStatus = false;
    if (gender[0].checked || gender[1].checked || gender[2].checked) {
        genderStatus = true;
    }

    if (mobile == "" || mobile.length < 10) {
        alert("Please enter valid mobile number");
        return false;
    }

    let genderVal = 0; //(gender[0].checked)?1:2;

    if (gender[0].checked) {
        genderVal = 1;
    } else if (gender[1].checked) {
        genderVal = 2;
    } else if (gender[2].checked) {
        genderVal = 3;
    }

    sessionStorage.setItem("user_query", query);

    var url = "<?=base_url()?>index/homeRegister";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            name: name,
            query: query,
            email: email,
            mobile: mobile,
            gender: genderVal
        },

        success: function(responce) {
            var res = JSON.parse(responce)
            if (res.status == 3) {
                window.location.href = res.redirect;
                return false;
            } else {
                $(".formCon").removeClass('hidden');
                $(".progressCon").addClass('hidden');
                $(".successCon").addClass('hidden');
                return false;
            }
        }
    });
    return false;
});
</script>

<script>
$(document).ready(function() {


    $(".card_services").click(function() {
        var href = $(this).find("a").attr("href");
        window.location.href = href;
    })

    $(".Agree").click(function() {
        $.ajax({
            url: "<?php echo base_url('index/setCookie')?>",
            type: 'POST',
            data: {
                'disclamer': 1
            },
            'success': function(data) {},
        });
    });
});
</script>

<script>
$(".button_bar").css("background-color", "red");
</script>