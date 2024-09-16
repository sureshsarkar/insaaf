<!-- disclamer box strat -->
<script>
$(document).ready(function() {
    $("#myModal").modal('show');
});
</script>

<?php if(empty($_COOKIE['disclamer']) && !isset($_COOKIE['disclamer'])){?>
<div id="myModal" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Disclaimer</h5>
            </div>
            <div class="modal-body p-3">
                <p class="mb-3">
                    Disclaimer! This note is for general information only. It is not to be substituted for legal advice
                    or
                    taken as legal advice. The creator or author shall not be liable for any act or omission based on
                    this site/notes/videos</p>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success Agree" data-dismiss="modal">Agree</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- disclamer  end -->
<?php } ?>
<section>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 ___right__side___row__panel">
                <div class="wp-height">
                    <div class="row">
                        <div class="col-md-7 p-0">
                            <div class="___index_content_ text-left ">
                                <p class="__india__index"> <?=$this->lang->line('largest_legal')?></p>

                                <h1 class="mt-3 temp_h1  h2">Online Lawyer Consultation - Insaaf99</h1>
                                <h2> <span class="temp_txt">Platform for Online Legal Consultation. We know all the
                                        Right Legal moves and will advice you to Make The Best Decisions</span></h2>
                                <h5><?php echo $this->lang->line('expert_lawyers')?></h5>
                                <div class="sfdfsdf">
                                    <marquee onMouseOver="this.stop()" onMouseOut="this.start() " width="100%"
                                        direction="left" class="__marquee__btn">
                                        <ul class="d-flex marquuee__index mb-0">
                                            <?php if(isset($allCategoty) && !empty($allCategoty)){
                                           
                                            foreach($allCategoty as $key=>$value){
                                            ?>
                                            <li>
                                                <a href="<?php echo base_url('specialization/documentation/'.$value->slug_url)?>"
                                                    class="_____marquueindex__row">
                                                    <?php 
                                                   if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->sub_sub_category_name_hi;
                                                   }else{
                                                       echo $value->sub_sub_category_name;
                                                   }?>
                                                </a>
                                            </li>
                                            <?php }}?>
                                        </ul>
                                    </marquee>
                                </div>
                                <div class="___legal_index">

                                    <h3 class="mt-0"><?php echo $this->lang->line('expert_lawyers2')?></h3>
                                </div>
                                <div class="___legal_index">
                                    <h3><?=$this->lang->line('insaaf99_provide')?> </h3>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="bd-highlight">
                                        <div class="___index__consult">
                                            <a href="<?=base_url('signup?type=lawyer')?>" class="btn __row">
                                                <?=$this->lang->line('lawyers_click_here')?>
                                            </a>
                                        </div>
                                        <div class="___index__consult3">
                                            <a href="<?=base_url('legal-advice')?>" class="btn __row"><i
                                                    class="bi bi-arrow-right-circle-fill"></i>&nbsp;&nbsp;&nbsp;<?=$this->lang->line('book_slot_menu')?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="__polular__tag">
                                    <ul class="d-flex  flex-wrap p-0 list-unstyled">
                                        <li class="first__li"><?=$this->lang->line('popular')?>:&nbsp;&nbsp;</li>

                                        <li><a href="<?=base_url('/specialization/start-up/partnership-firm')?>"
                                                class="___row_wp  active"> <?=$this->lang->line('partnership_firm')?>
                                            </a></li>
                                        <li><a href="<?=base_url('/specialization/start-up/copyright')?>"
                                                class="___row_wp"> <?=$this->lang->line('copyright')?> </a></li>
                                        <li><a href="<?=base_url('/specialization/documentation/non-disclosure-agreement')?>"
                                                class="___row_wp">
                                                <?=$this->lang->line('non_disclosure_agreement')?></a></li>
                                        <li><a href="<?=base_url('/specialization/documentation/sale-deed')?>"
                                                class="___row_wp"> <?=$this->lang->line('sale_deed')?></a></li>
                                    </ul>
                                </div>
                                <div class="make-in-india">
                                    <img src="<?php echo base_url()?>assets/images/home/make-in-india.webp"
                                        class="img-fluid" alt="Make in India">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 pl-0">
                            <div class="___form__row  pt-5 ">
                                <div class="__only__submit">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="box__index__row">
                                                <div class="__form__index ">
                                                    <!-- form box  -->
                                                    <div class="formCon">
                                                        <form id="formSubmit" method="POST">
                                                            <div class="___form__header">
                                                                <p><?=$this->lang->line('get_started')?></p>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-12">
                                                                    <div
                                                                        class="form-group mb-0 form_input_pading_home_page">
                                                                        <input type="text" name="name" id="first1"
                                                                            placeholder="Full Name"
                                                                            class="form-control  selected name">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-12">
                                                                    <div
                                                                        class="form-group mb-0 form_input_pading_home_page">
                                                                        <input type="number" name="mobile" id="first1"
                                                                            placeholder="Mobile Number" minlength="10"
                                                                            maxlength="10"
                                                                            class="form-control __control__form mobile">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-12">
                                                                    <div
                                                                        class="form-group mb-0 form_input_pading_home_page">
                                                                        <input type="email" name="email" id="first1"
                                                                            placeholder="Email"
                                                                            class="form-control   __control__form email">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-12">
                                                                    <div
                                                                        class="form-group mb-0 form_input_pading_home_page">
                                                                        <input type="text" name="query" id="first1"
                                                                            placeholder="Enter query"
                                                                            class="form-control __control__form query">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-12">
                                                                    <div class="">
                                                                        <div class="d-flex ___final__row">
                                                                            <div
                                                                                class="form-check male __sameCallInsaff ml__coll_0">
                                                                                <input class="form-check-input gender"
                                                                                    type="radio" name="gender"
                                                                                    id="flexRadioDefault1" value="1">
                                                                                <label class="form-check-label"
                                                                                    id="male" for="flexRadioDefault1">
                                                                                    <?=$this->lang->line('male')?>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-check __sameCallInsaff">
                                                                                <input
                                                                                    class="form-check-input female gender"
                                                                                    type="radio" name="gender"
                                                                                    id="exampleCheck2" value="2">
                                                                                <label class="form-check-label"
                                                                                    id="female" for="exampleCheck2">
                                                                                    <?=$this->lang->line('female')?>
                                                                                </label>
                                                                            </div>

                                                                            <div class="form-check __sameCallInsaff">
                                                                                <input
                                                                                    class="form-check-input other gender"
                                                                                    type="radio" name="gender"
                                                                                    id="exampleCheck3" value="3">
                                                                                <label class="form-check-label"
                                                                                    id="other" for="exampleCheck3">
                                                                                    <?=$this->lang->line('other')?>
                                                                                </label>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="talk__to11 ">

                                                                        <button type="submit" class="btn talk__btn">
                                                                            <?=$this->lang->line('talk_to_expert')?>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- progress page -->
                                                    <div class="progressCon hidden">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-12">
                                                                <div class="row py-5">
                                                                    <div class="col-md-12 text-center">
                                                                        <img src="<?= base_url('assets/images/home/progress.gif')?>"
                                                                            width="130">
                                                                        <br /><br />
                                                                        <p class="text-success">Sending....</p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end progress con -->

                                                    <!-- success page -->
                                                    <div class=" successCon hidden">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-12">
                                                                <div class="row py-5">
                                                                    <div class="col-md-12 text-center">
                                                                        <img src="<?= base_url('assets/images/home/success.webp')?>"
                                                                            width="130">
                                                                        <br /><br />
                                                                        <h4 class="text-success">
                                                                            <?=$this->lang->line('thanks_we_will')?>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end success con -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="__badge__index">
                    <div class="d-flex align-items-center ___chat__online">
                        <div class="bd-highlight">
                            <img src="<?php echo base_url()?>assets/images/chat/01.webp" class="img-fluid"
                                alt="Online Lawyer">
                            <img src="<?php echo base_url()?>assets/images/chat/02.webp" class="img-fluid"
                                alt="Hire Lawyer">
                            <img src="<?php echo base_url()?>assets/images/chat/03.webp" class="img-fluid"
                                alt="Consult A lawyer">

                        </div>
                        <div class="bd-highlight">
                            <span>&nbsp;<?=$this->lang->line('online_lawyer')?> </span>
                        </div>
                        <div class="bd-highlight ml-auto">
                            <div class="center1">
                                <div class="circle__pulse pulse1 green"></div>
                            </div>
                        </div>
                    </div>
                    <div class="__inner__index ">
                        <div class="d-flex align-items-center">
                            <div class="bd-highlight shake ">
                                <img src="<?php echo base_url()?>assets/images/home/call_alert.webp" class="img-fluid"
                                    alt="Online Lawyer Consultation">
                            </div>
                            <div class="bd-highlight">
                                <span><?=$this->lang->line('consult_lawyer')?> </span>
                            </div>
                        </div>
                        <a class="text-dark" href="<?php echo base_url('signup?type=client')?>">
                            <div class="__toll__free_index ">
                                <span><strong><?=$this->lang->line('connect_now')?> </strong></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- section for mobile news button  -->
<div id="news2" class="">
    <a href="<?php echo base_url('all-news')?>">
        <?=$this->lang->line('latest_news_and_judgment')?>
    </a>
</div>

<!-- End ##############  -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="__index_heading_get text-center ">
                    <p> <?=$this->lang->line('how_to_register')?> </p>

                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 col-12">
                <div class="__process__index text-center">
                    <h3><?=$this->lang->line('describe_your_cont')?></h3>
                    <p><?=$this->lang->line('get_yourself')?>
                    </p>
                    <h4><?=$this->lang->line('step_1')?> </h4>

                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="__process__index text-center">
                    <h3><?=$this->lang->line('with_a_lawyer')?></h3>
                    <p><?=$this->lang->line('avail_the_opportunity')?></p>
                    <h4><?=$this->lang->line('step_2')?> </h4>
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="__process__index text-center">
                    <h3><?=$this->lang->line('save_time')?> </h3>
                    <p><?=$this->lang->line('select_time_slot')?> </p>
                    <h4><?=$this->lang->line('step_3')?> </h4>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="____rounder__row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex ____rounder__span justify-content-center">
                    <div class="bd-highlight __box__index_row"><?=$this->lang->line('contact_menu')?> </div>
                    <div class="bd-highlight __box__index_row2"><?=$this->lang->line('2_easy_way')?></div>
                </div>
                <div class="row">
                    <div class="col-md-12 __chart__row pt-5">
                        <img src="<?php echo base_url()?>assets/images/home/info.webp" class="img-fluid"
                            alt="Registration Process">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-5 pb-5 ">
    <div class="___bg___categories__index">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <h3 class="documentServices"> For Business Registration</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 margin-30px-bottom xs-margin-20px-bottom">
                    <div class="services-block-three">
                        <a href="<?= base_url('specialization/start-up/trademark')?>">
                            <div class="padding-15px-bottom">

                            </div>
                            <h4>Trademark</h4>

                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 margin-30px-bottom xs-margin-20px-bottom">
                    <div class="services-block-three">
                        <a href="<?= base_url('specialization/start-up/copyright')?>">
                            <div class="padding-15px-bottom">

                            </div>
                            <h4>Copyright </h4>

                        </a>
                    </div>
                </div>
                <div class="services-block-three col-lg-3 col-md-6 margin-30px-bottom xs-margin-20px-bottom">
                    <div class="services-block-three">
                        <a href="<?= base_url('specialization/start-up/design')?>">
                            <div class="padding-15px-bottom">

                            </div>
                            <h4>Design </h4>

                        </a>
                    </div>
                </div>
                <div class="services-block-three col-lg-3 col-md-6 sm-margin-30px-bottom xs-margin-20px-bottom">
                    <div class="services-block-three">
                        <a href="<?= base_url('specialization/start-up/patents')?>">
                            <div class="padding-15px-bottom">

                            </div>
                            <h4> Patent </h4>

                        </a>
                    </div>
                </div>
                <div class="services-block-three col-lg-3 col-md-6 xs-margin-20px-bottom">
                    <div class="services-block-three">
                        <a href="<?= base_url()?>">
                            <div class="padding-15px-bottom">

                            </div>
                            <h4>MSME </h4>

                        </a>
                    </div>
                </div>
                <div class="services-block-three col-lg-3 col-md-6">
                    <div class="services-block-three">
                        <a href="<?= base_url('specialization/start-up/limited-liability-partnership')?>">
                            <div class="padding-15px-bottom">

                            </div>
                            <h4>LLP</h4>

                        </a>
                    </div>
                </div>
                <div class="services-block-three col-lg-3 col-md-6">
                    <div class="services-block-three">
                        <a href="<?= base_url('specialization/start-up/private-limited-company')?>">
                            <div class="padding-15px-bottom">

                            </div>
                            <h4>PLC</h4>

                        </a>
                    </div>
                </div>
                <div class="services-block-three col-lg-3 col-md-6">
                    <div class="services-block-three">
                        <a href="<?= base_url()?>">
                            <div class="padding-15px-bottom">

                            </div>
                            <h4>GST</h4>

                        </a>
                    </div>
                </div>

                <!-- end -->
            </div>
            <div class="row justify-content-center">
                <div class="services-block-three col-lg-3 col-md-6">
                    <div class="services-block-three">
                        <a href="<?= base_url('specialization/start-up/partnership-firm')?>">
                            <div class="padding-15px-bottom">

                            </div>
                            <h4>Partnership Firm</h4>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="___bg___categories__index2 mt-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="__jugement___new__index text-center">
                    <h3 class="mb-0 documentServices"><?=$this->lang->line('documentation_services')?> </h3>
                    <h4 class="mt-2 we__are__index"><?=$this->lang->line('documentation_services_with')?> </h4>
                    <h4><?=$this->lang->line('excellent_performance')?> </h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex flex-wrap bd-highlight justify-content-center pt-5 text-decoration-none tex_none_co">
                    <a href="<?php echo base_url('specialization/documentation/loans-agreements')?>">
                        <div class="p-2 bd-highlight box_height__">
                            <div class="___services__index">
                                <h2><?=$this->lang->line('loan_agreement')?> </h2>
                                <P><?=$this->lang->line('loan_agreement_is_a_formal')?> </P>
                                <span class="text-right">Read more <img
                                        src="<?=base_url('assets/images/svg/arrow-right-short.svg')?>" alt=""></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo base_url('specialization/documentation/legal-recovery-notice')?>">
                        <div class="p-2 bd-highlight box_height__">
                            <div class="___services__index">
                                <h2><?=$this->lang->line('legal_recovery_notice')?> </h2>
                                <P><?=$this->lang->line('a_legal_recovery_notice')?> </P>
                                <span class="text-right">Read more <img
                                        src="<?=base_url('assets/images/svg/arrow-right-short.svg')?>" alt=""></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo base_url('specialization/documentation/cheque-bounce')?>">
                        <div class="p-2 bd-highlight box_height__">
                            <div class="___services__index">
                                <h2><?=$this->lang->line('cheque_bounce')?></h2>
                                <P><?=$this->lang->line('a_cheque_bounce_sometimes')?></P>
                                <span class="text-right">Read more <img
                                        src="<?=base_url('assets/images/svg/arrow-right-short.svg')?>" alt=""></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo base_url('specialization/documentation/refund-of-security-notices')?>">
                        <div class="p-2 bd-highlight box_height__">
                            <div class="___services__index">
                                <h2><?=$this->lang->line('refund_of_security')?> </h2>
                                <P><?=$this->lang->line('a_security_deposit_is')?></P>
                                <span class="text-right">Read more <img
                                        src="<?=base_url('assets/images/svg/arrow-right-short.svg')?>" alt=""></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo base_url('specialization/documentation/recovery-of-dues')?>">
                        <div class="p-2 bd-highlight box_height__">
                            <div class="___services__index">
                                <h2><?=$this->lang->line('recovery_of_dues')?> </h2>
                                <P><?=$this->lang->line('if_someone_fails_to_recover')?> </P>
                                <span class="text-right">Read more <img
                                        src="<?=base_url('assets/images/svg/arrow-right-short.svg')?>" alt=""></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo base_url('specialization/documentation/power-of-attorney')?>">
                        <div class="p-2 bd-highlight box_height__">
                            <div class="___services__index">
                                <h2><?=$this->lang->line('power_of_attorney')?> </h2>
                                <P><?=$this->lang->line('using_a_general_power')?> </P>
                                <span class="text-right">Read more <img
                                        src="<?=base_url('assets/images/svg/arrow-right-short.svg')?>" alt=""></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo base_url('specialization/documentation/will')?>">
                        <div class="p-2 bd-highlight box_height__">
                            <div class="___services__index">
                                <h2> <?=$this->lang->line('will')?></h2>
                                <P> <?=$this->lang->line('what_is_a_will')?></P>
                                <span class="text-right">Read more <img
                                        src="<?=base_url('assets/images/svg/arrow-right-short.svg')?>" alt=""></span>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo base_url('specialization/documentation/rent-agreement')?>">
                        <div class="p-2 bd-highlight box_height__">
                            <div class="___services__index">
                                <h2> <?=$this->lang->line('rent_agreement')?></h2>
                                <P> <?=$this->lang->line('country_with_vast')?></P>
                                <span class="text-right">Read more <img
                                        src="<?=base_url('assets/images/svg/arrow-right-short.svg')?>" alt=""></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="___view__index__all_services text-center mt-4 pb-4">
            <a href="<?php echo base_url('practice_area/all_services')?>" class="btn view__all__btn mt-3 mb-3">
                <?=$this->lang->line('view_all')?></a>
        </div>
    </div>
</section>
<section class="bg__black_index">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="__jugement___new__index text-center pt-5 mb-5">
                    <p class="mb-0"> <?=$this->lang->line('client_focused')?></p>
                    <h4 class="mt-2 we__are__index text-white pb-5"> <?=$this->lang->line('we_offer_a_client')?> </h4>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="___set__level" data-aos="fade-up" data-aos-duration="3000">
                    <div class="row">
                        <div class="col-md-4" data-aos="flip-left" data-aos-duration="6000">
                            <img src="<?php echo base_url()?>assets/images/home/p-01.webp" class="img-fluid"
                                alt="Online Legal Advice">
                        </div>
                        <div class="col-md-5">
                            <div class="___online___legal___index" data-aos="fade-up" data-aos-duration="6000">
                                <h2> <?=$this->lang->line('we_talk_about_cont')?></h2>
                                <p> <?=$this->lang->line('help_you_cont_stpe1')?></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="___circle__index__col" data-aos="zoom-in-down" data-aos-duration="6000">
                                <span>1</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="___set__level__left __space___cloud " data-aos="fade-up" data-aos-duration="3000">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="___circle__index__col_left" data-aos="zoom-in-down" data-aos-duration="6000">
                                <span>2</span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="___online___legal___index new_set_pdi" data-aos="fade-up"
                                data-aos-duration="6000">
                                <h2 class="pt-4"> <?=$this->lang->line('narrow_if_cont')?></h2>
                                <p> <?=$this->lang->line('give_you_cont')?> </p>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="flip-left" data-aos-duration="6000">
                            <img src="<?php echo base_url()?>assets/images/home/p-03.webp" class="img-fluid"
                                alt="Online Legal Consultation">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="___set__level __space___cloud" data-aos="fade-up" data-aos-duration="3000">
                    <div class="row">
                        <div class="col-md-4" data-aos="flip-left" data-aos-duration="6000">
                            <img src="<?php echo base_url()?>assets/images/home/p-02.webp" class="img-fluid"
                                alt="Hire Lawyer Online">
                        </div>
                        <div class="col-md-6">
                            <div class="___online___legal___index" data-aos="fade-up" data-aos-duration="6000">
                                <h2 class="pt-4"><?=$this->lang->line('get_it_right_cont')?> </h2>
                                <p><?=$this->lang->line('legal_stap_cont')?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="___circle__index__col" data-aos="zoom-in-down" data-aos-duration="6000">
                                <span>3</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container ___bg__container__index">
        <div class="row">
            <div class="col-md-12">
                <div class="__jugement___new__index text-center mt-5">
                    <p class="mb-0"><?=$this->lang->line('client_testimonials')?></p>
                    <h4 class="mt-2 we__are__index"> <?=$this->lang->line('know_what_they_say')?></h4>
                    <h4> <?=$this->lang->line('we_provide_the_highest_quality')?></h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="__testimonial___index">
                            <p> <?=$this->lang->line('it_was_a_great_experience_consulting')?> </p>
                            <div class="__testimonial__details ">
                                <span> <?=$this->lang->line('deepak_saxena')?> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="__testimonial___index">
                            <p> <?=$this->lang->line('i_am_super_impressed')?> </p>
                            <div class="__testimonial__details ">
                                <span><?=$this->lang->line('rashmi_morya')?> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="__testimonial___index">
                            <p><?=$this->lang->line('excellent_online_consultation')?> </p>
                            <div class="__testimonial__details ">
                                <span><?=$this->lang->line('avinash_chaudhary')?> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
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


<!-- <script type="text/javascript">
var owl = $('.owl-carousel');
owl.owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1,
            nav: false
        },
        1000: {
            items: 3,
            nav: false,
            loop: true
        }
    }
});
</script> -->

<!-- <script>
AOS.init();
</script> -->

<script>
$(document).ready(function() {
    $(".mobile").keyup(function() {
        var mobile = $(this).val();
        if (mobile.length == 10) {
            var url = "<?=base_url()?>index/checkMobile";
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    mobile: mobile
                },
                success: function(responce) {

                    if (responce == 1) {
                        alert("You are already registered as Client so go for login");
                        $(".mobile").val("");
                        return false;
                    } else if (responce == 2) {
                        alert("You are already registered as Lawyer so go for login");
                        $(".mobile").val("");
                        return false;
                    }
                }
            });
            return false;
        }
    })
})
</script>

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