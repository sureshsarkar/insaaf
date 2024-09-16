<?php  $schedule_times = getStaticTime();?>

<link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css"
    rel="stylesheet">

<style>
.active {
    background: transparent !important;
}

.expriences p {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 119px;
}
</style>
<section class="bg_mobile_home">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header_mobile_home">
                    <div class="menu_home">
                        <div id="myNav" class="overlay">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <div class="overlay-content">
                                <a href="<?=base_url()?>"><?=$this->lang->line('home_menu');?></a>
                                <a href="<?=base_url()?>about-us"><?=$this->lang->line('about_menu');?></a>
                                <a
                                    href="<?=base_url()?>specialization"><?=$this->lang->line('specialization_menu');?></a>
                                <a href="<?=base_url()?>contact-us"><?=$this->lang->line('contact_menu');?></a>
                            </div>
                        </div>
                        <span class="menu_icons" onclick="openNav()"><img
                                src="<?php echo base_url()?>assets/images/mobilehome/menu.png" alt=""></span>
                    </div>
                    <div class="logo_side">
                        <img src="<?php echo base_url()?>assets/images/law_logo.png" alt="">
                    </div>
                    <div class="login">
                        <a href="<?php echo base_url('login')?>"> <img
                                src="<?php echo base_url()?>assets/images/mobilehome/user.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg_mobile_home2">
    <div class="banner_images">
        <p><?php echo (isset($_GET['keyword']) && !empty($_GET['keyword']))?ucwords($_GET['keyword']):"Online Legal Consultations!";?>
            <?php 
            if(isset($_GET['type']) && $_GET['type'] == 'family'){ ?>
            <br /><small>Protect Yourself in a troubled
                marriage</small>
            <?php }elseif(isset($_GET['type']) && $_GET['type'] == 'rera'){ ?>
            <br /><small>Connect with us to get the solutions of RERA issues.</small>
            <?php }elseif(isset($_GET['type']) && $_GET['type'] == 'trademark'){ ?>
            <br /><small>Connect with us to get the solutions of Trademark issues</small>
            <?php }elseif(isset($_GET['type']) && $_GET['type'] == 'property'){ ?>
            <br /><small>Get the solutions of your Property issues immediately.</small>
            <?php }elseif(isset($_GET['type']) && $_GET['type'] == 'copyright'){ ?>
            <br /><small>Get the solutions of your Copyright issues immediately.</small>
            <?php }elseif(isset($_GET['type']) && $_GET['type'] == 'arbitration'){ ?>
            <br /><small>Connect with us to get the solutions of Arbitration issues.</small>
            <?php }else{ ?>
            <br /><small>Get to solutions of your legal issues.</small>
            <?php } ?>

        </p>

        <?php
         if(isset($_GET['type']) && $_GET['type'] == 'family'){ ?>
        <img src="<?php echo base_url()?>assets/images/ppc/divorce.png" alt="">
        <?php }elseif(isset($_GET['type']) && $_GET['type'] == 'rera'){ ?>
        <img src="<?php echo base_url()?>assets/images/ppc/rera.png" alt="">
        <?php } elseif(isset($_GET['type']) && $_GET['type'] == 'trademark'){ ?>
        <img src="<?php echo base_url()?>assets/images/ppc/trademark.png" alt="">
        <?php } elseif(isset($_GET['type']) && $_GET['type'] == 'property'){ ?>
        <img src="<?php echo base_url()?>assets/images/ppc/property.png" alt="">
        <?php } elseif(isset($_GET['type']) && $_GET['type'] == 'copyright'){ ?>
        <img src="<?php echo base_url()?>assets/images/ppc/copyright.png" alt="">
        <?php } elseif(isset($_GET['type']) && $_GET['type'] == 'arbitration'){ ?>
        <img src="<?php echo base_url()?>assets/images/ppc/arbitation.png" alt="">
        <?php } else{ ?>
        <img src="<?php echo base_url()?>assets/images/mobilehome/defaultbanner.png" alt="">
        <?php }  
        
        ?>


    </div>
</section>


<section class="bg_main_full">
    <pull><i></i></pull>
    <div class="tag_line px-3">
        <p>
            <?php  
            if(isset($_GET['type']) && $_GET['type'] == 'family'){
               echo 'Connect with legal experts & get the answers you need to make the right decision.';
            }elseif(isset($_GET['type']) && $_GET['type'] == 'rera'){
                echo 'A RERA issue pertains to a legal dispute or conflict arising from non-compliance or violations of the Real Estate (Regulation and Development) Act, a regulatory framework governing the real estate sector in India.';
             }elseif(isset($_GET['type']) && $_GET['type'] == 'trademark'){
                echo 'A trademark is a legally protected symbol, word, or phrase that identifies and distinguishes the source of goods or services.';
             }elseif(isset($_GET['type']) && $_GET['type'] == 'property'){
                echo '
                Property refers to a legally recognized and owned asset or possession, which can include land, buildings, or other tangible or intangible items of value.';
             }elseif(isset($_GET['type']) && $_GET['type'] == 'copyright'){
                echo 'A copyright issue involves a legal dispute or conflict concerning the protection and unauthorized use of original creative works, such as writings, music, art, or software.';
             }elseif(isset($_GET['type']) && $_GET['type'] == 'arbitration'){
                echo 'An arbitration issue refers to a legal dispute or conflict that is being resolved through the process of arbitration, where a neutral third party makes a binding decision outside of the court system.';
             }
            else{
               echo '- We have in-house team of lawyers -';
            }
                ?>
        </p>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg_clor_talk_toLawy">
                <a href="javascript:void(0)" class="_btnTalk">
                    <div class="talk_lawyer_BG">
                        <div class="talk_layer_icon">
                            <img src="<?=base_url()?>assets/images/ppc/telephone.png" alt="">
                        </div>
                        <div class="talk_lawyer_text">
                            <p>Talk To Lawyer</p>
                            <small>Legal ways to resolve</small>
                        </div>
                        <div class="talk_lawyer_text2">
                            <img src="<?=base_url()?>assets/images/mobilehome/UP1p.gif" alt=""> <br>
                            <small>Select Problem</small>
                        </div>
                    </div>
                </a>
                <div class="talk_lawyer_BG mt-2">
                    <div class="d-flex align-items-center ___chat__online_ppc ___chat__online2">
                        <div class="bd-highlight">
                            <img src="https://insaaf99.com/assets/images/chat/01.webp" class="img-fluid"
                                alt="Online Lawyer">
                            <img src="https://insaaf99.com/assets/images/chat/02.webp" class="img-fluid"
                                alt="Hire Lawyer">
                            <img src="https://insaaf99.com/assets/images/chat/03.webp" class="img-fluid"
                                alt="Consult A lawyer">

                        </div>
                        <div class="bd-highlight _btnTalk">
                            <span>&nbsp;+115 online lawyer </span>
                        </div>
                        <div class="bd-highlight ml-auto">
                            <div class="center1">
                                <div class="circle__pulse pulse1 green"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- star lawyer list section  -->

                <section>

                    <div class="">
                        <div class="">
                            <div class="">

                                <div class="main_heading_lawyer_list">
                                    <h5>Talk to the Best Lawyer in India</h5>
                                </div>

                                <!----------HTML code starts here------->
                                <?php if(!empty($lawyers)){?>
                                <div class="owl-carousel owl-theme owl-loaded owl-drag">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage"
                                            style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">
                                            <?php foreach ($lawyers as $k => $v) {?>
                                            <div class="owl-item " style="width: 128.906px; margin-right: 10px;">
                                                <div class="item">
                                                    <div class="lawyer_list_bg">
                                                        <div class="dis_flc">
                                                            <div class="lawyer_img">
                                                                <img src="<?=base_url()?><?php echo (!empty($v->image))?$v->image:"assets/images/mobilehome/sai.webp";?>"
                                                                    alt="">
                                                                <div class="rating_layer">
                                                                    <p>4.2</p>
                                                                    <img src="<?=base_url()?>assets/images/documents/star.webp"
                                                                        alt="">
                                                                </div>
                                                            </div>
                                                            <div class="side_text_lawyer_list">
                                                                <h4><?php echo $v->fname." ".$v->lname?></h4>

                                                                <div class="expriences">
                                                                    <img src="<?=base_url()?>assets/images/mobilehome/translate.svg"
                                                                        alt="">
                                                                    <p><?php echo (!empty($v->language))?$v->language:"Hindi";?>
                                                                    </p>
                                                                </div>
                                                                <div class="expriences">
                                                                    <img src="<?=base_url()?>assets/images/mobilehome/mortarboard.svg"
                                                                        alt="">
                                                                    <p><?php echo $v->experience?></p>
                                                                </div>
                                                                <div class="button_lawyer_list">
                                                                    <a href="#cll_talk_butn"><img
                                                                            src="<?=base_url()?>assets/images/mobilehome/bubble-chat.png"
                                                                            alt="" class="list_chat_lawyer"></a>
                                                                    <a href="#cll_talk_butn"><img
                                                                            src="<?=base_url()?>assets/images/mobilehome/phone-call.png"
                                                                            alt=""></a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <?php }?>
                                <div class="owl-item " style="width: 128.906px; margin-right: 10px;">
                                    <div class="item">
                                        <div class="view_all_lawyer_list">
                                            <button><a href="<?= base_url('lawyer-list')?>">View All</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

                <!-- End lawyer list section  -->
                <!-- <div class="talk_lawyer_BG mt-2">
                    <div class="pheragrap_discuss">
                        <p><span>With Expert Lawyers -</span> Family matters, Property, Agreements, Documentation,
                            Partnership, Money Recovery, Cheque bounce, Startup, Registrations, Trademark, Copyright,
                            Legal opinion, Loans, Legal Notice, etc.</p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>

    <!-- special offerimg  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 bg_clor_talk_toLawy _btnTalk">
                <div class="talk_lawyer_BG mt-2 d-block">
                    <div class="disply_flx_spcial_offer">
                        <div class="spical_offer _btnTalk">
                            <span>Offer End</span>
                            <p id="countdown"></p>
                        </div>
                        <div class="spcial_offer">
                            <img src="<?=base_url()?>assets/images/mobilehome/spical_offer.gif" alt="">
                        </div>
                    </div>
                    <div class="bummper_discount">
                        <p>Bumper Discount</p>
                        <span>₹99 <del>₹499</del></span>
                        <small>get 80% discount now.</small>
                    </div>
                    <div class="get_now_button">
                        <button>Consult Now</button>
                    </div>
                </div>
                <div class="get_discount">
                    <p>Get 80% discount for Talking to Lawyer, if you are visit first time</p>
                    <p><small>once per user.</small></p>
                </div>
            </div>
        </div>
    </div>

    <!-- End ############  -->

</section>


<!-- start reating section -->



<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-6">
                <a href="#scroll_review">
                    <div class="product-number text-center">
                        <div class="ma_dix">
                            <span class="number d-block font-60 color11">
                                4.8
                            </span>
                            <div class="rating-star">

                                <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                    src="<?=base_url()?>assets/images/documents/star.webp">
                                <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                    src="<?=base_url()?>assets/images/documents/star.webp">
                                <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                    src="<?=base_url()?>assets/images/documents/star.webp">
                                <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                    src="<?=base_url()?>assets/images/documents/star.webp">
                                <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                    src="<?=base_url()?>assets/images/documents/half_star.webp">
                            </div>
                        </div>
                        <div class="ma_dix">


                            <div class="image_google">
                                <img alt="Insaaf99 Rating and Reviews"
                                    src="<?=base_url()?>assets/images/mobilehome/google.png">
                            </div>
                            <span class="d-block rating_text" style="cursor: pointer;">
                                (108 <br> reviews)
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-6">
                <div class="product-number">
                    <div class="text_case_resolved">
                        <h4>1500+</h4>
                        <p>Case resolved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End rating section  -->




<!-- how work start  -->

<!-- form ========================================================================-->
<div class="main_form_con scrollClass">
    <div class="_btnClose"><span>x</span></div>
    <section id="cll_talk_butn">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main_conslt_heding text-center mb-0">
                        <div class="_clickBack hidden">
                            <div class="btn btnColor"> Back </div>
                        </div>
                        <h3><img src="<?=base_url()?>assets/images/ppc/businessman.png" alt=""> Let's Talk</h3>
                        <p><small>Book your Online meeting with our Legal Expert</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <form action="<?=base_url('new_user/pay_for_slot')?>" method="post" onSubmit="return checkLength()">
                <div class="row">
                    <div class="col-md-6 col-xl-4 col-lg-4 col-sm-12 firstCon ">
                        <div class="form-group chng_emil_box mt-1">
                            <label for="FName">Select Your Problem*</label>
                            <select id="inputCategory" class="form-control category" name="case_category_id" required>
                                <option value="">---Select--- </option>
                                <?php if(isset($all_category) && !empty($all_category)){
                                         foreach ($all_category as $key => $value) {?>
                                <option value="<?=$value->id?>" class="<?=$value->id?>" data_cat="<?=$value->name?>">
                                    <?php echo $value->name?>
                                </option>
                                <?php }}?>
                            </select>
                            <info class="textInfo">Please choose a problem type to understand your issues</info>
                        </div>
                        <div class="form-group chng_emil_box">
                            <label for="FName">Your Name*</label>
                            <input type="text" class="form-control fullname" id="userName" name="fullname"
                                placeholder="" required>
                            <info class="textInfo">Please Enter your full name to identify you</info>
                        </div>

                        <div class="form-group chng_emil_box">
                            <label for="inputMobile">Mobile No.*</label>
                            <div class="mobile_validation"></div>
                            <input type="text" class="form-control mobile" name="mobile" placeholder="" maxlength="11"
                                id="mobile" required>
                            <info class="textInfo">Please Enter your mobile number to contact with you</info>
                        </div>

                        <p class="text-danger m-0 showError"></p>

                        <div class="row">
                            <div class="col-12 text-center"> <button type="button"
                                    class="btn  btn-themeCall btnNext mb-2">Next</button></div>
                        </div>

                    </div>

                    <div class="col-md-6 col-xl-4 col-lg-4 col-sm-12 hidden _secondCon">
                        <div class="enter_dtail">
                            <h5>Select Call Date* </h5>
                            <info class="textInfo">(When you want call with lawyer ?)</info>
                        </div>

                        <div class="border-calendera">
                            <div class="">
                                <div class=" btn-group-toggle ___toggle_date clentdr" data-toggle="buttons">
                                    <?php 
                                        $Date =date("Y-m-d");
                                        for ($i=1; $i <= 30 ; $i++) { 
                                            $check_sess = date('d M Y', strtotime($Date. ' + '.$i.' days'));
                                        $find_sunday = date('D', strtotime($Date. ' + '.$i.' days'));
                                        if($find_sunday == 'Sun'){
                                                    $active = ''; $checked = '';$disabled = 'disabled';
                                        }else{
                                                if($i==1){
                                                    $active = 'active'; $checked = 'checked';$disabled = '';
                                                }else{
                                                    $active = ''; $checked = '';$disabled = '';
                                                }
                                        }
                                    ?>
                                    <label
                                        class="btn my-1 btn-outline-primary des_btn_colr_fjjjg slot_date_div dateBtnStyle <?php echo $active;?> <?=$disabled;?>"
                                        data-id="<?php echo $i; ?>">
                                        <input type="radio" name="schedule_date"
                                            class="slot_date_input_<?php echo $i; ?>"
                                            data-day="<?php echo date('D', strtotime($Date)); ?>"
                                            value="<?php echo date('d M Y', strtotime($Date. ' + '.$i.' days')); ?>"
                                            <?php echo $checked;  ?>>
                                        <?php  echo date('d D', strtotime($Date. ' + '.$i.' days'));?>
                                    </label>
                                    <?php } ?>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 col-xl-4 col-lg-4 col-sm-12 hidden _secondCon">
                        <div class="enter_dtail">
                            <h5>Select Meeting Time* </h5>
                        </div>

                        <div class=" btn-group-toggle ___toggle_date put_schedule clentdr" data-toggle="buttons">
                            <?php $n=0; foreach($schedule_times as $schedule_time){ ?>
                            <?php 
                                   $Date = date('Y-m-d');
                                    $AddDate =date('Y-m-d', strtotime($Date. ' + 1 days'));
                                    $addTime = date("H:i:s", strtotime($schedule_time));
                                    $AddDate =date("Y-m-d H:i:s", strtotime("$AddDate $addTime"));
                                    $booked = check_slot_booked($AddDate); //check time booked or not function
                                    
                                   // call function fetche date & time from scheduler table to block date time || check_date_time_block()
                                    $dateBlock = date("Y-m-d", strtotime("$AddDate"));
                                    $timeBlock = date("h:i A", strtotime("$schedule_time"));
                                    $date_time_block = check_date_time_block($dateBlock,$timeBlock);

                                    if ($n==0 && $booked !=1) {
                                        $active = 'active'; $checked = 'checked';
                                    }else{
                                        $active = ''; $checked = '';
                                    }
                                    
                                    if ($booked == 1) {
                                        $disabled = 'disabled';  $n--;
                                    }elseif((isset($date_time_block) && !empty($date_time_block))){
                                        $disabled = 'disabled'; $active = '';
                                    }else{
                                        $disabled = '';
                                    }
                                ?>

                            <div class="slote">
                                <label
                                    class="btn btn-outline-primary des_btn_colr_fjjjg <?php echo $active. ' ' .$disabled; ?>">
                                    <input type="radio" name="schedule_time" value="<?php echo $schedule_time; ?>"
                                        <?php echo $checked; ?>>
                                    <?php echo $schedule_time;?>
                                </label>
                            </div>

                            <?php $n++; } ?>
                        </div>
                        <div class="col-md-12 text-center">
                            <input type="hidden" name="refrence" value="<?=$this->uri->segment(1)?>">
                            <button type="submit"
                                class="btn payBtn"><?= (isset($userSlotData) && count($userSlotData) >= 2)?'Submit':'Submit' ?>
                            </button>
                        </div>
                    </div>
            </form>
        </div>

    </section>
</div> <!-- main div-->
<!-- form end ========================================================================-->

<section class="bg_how_full_width">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="how_it_work">
                    <h4>How Insaaf99 Work?</h4>
                </div>
                <div class="icon_text_mobie">
                    <div class="icon_img">
                        <img src="<?=base_url()?>assets/images/mobilehome/user_dark.png" alt="">
                    </div>
                    <div class="text_inr">
                        <p><b>Sign Up / Sign In</b> <br> Fill your <b>Name</b> & <b>Phone no</b> and get <b>OTP</b>,
                            after verification of OTP you will be <b>Sign in.</b></p>
                    </div>
                </div>
                <div class="icon_text_mobie">
                    <div class="icon_img">
                        <img src="<?=base_url()?>assets/images/mobilehome/shopping-cart.png" alt="">
                    </div>
                    <div class="text_inr">
                        <p><b>Buy Talktime</b> <br> Click on <b>buy talktime</b> and <b>choose a plan</b> to buy
                            talktime and <b>checkout</b>,please.</p>
                    </div>
                </div>
                <div class="icon_text_mobie">
                    <div class="icon_img">
                        <img src="<?=base_url()?>assets/images/mobilehome/telephone.png" alt="">
                    </div>
                    <div class="text_inr">
                        <p><b>Request Call</b> <br> Click on <b>Talk to Lawyer</b> & <b>choose</b> your <b>problem</b>,
                            type,<b>language</b>& click on <b>Call Now.</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end ################  -->

<!-- services  -->

<section>
    <div class="services_overview">

        <div class="container">
            <div class="servics__">
                <h4>Services Overview</h4>
            </div>
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="one_services_img _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/consultation.png" alt="">
                    </div>
                    <div class="txt_services__">
                        <p>Counseling & Mediation</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="one_services_img _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/heart.png" alt="">
                    </div>
                    <div class="txt_services__">
                        <p>Matrimonial & Family Issues</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="one_services_img _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/property.png" alt="">
                    </div>
                    <div class="txt_services__">
                        <p>Property Issues</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="one_services_img _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/handcuffs.png" alt="">
                    </div>
                    <div class="txt_services__">
                        <p>Criminal Matters</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="one_services_img _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/contract.png" alt="">
                    </div>
                    <div class="txt_services__">
                        <p>Agreement & Contracts</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="one_services_img _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/briefcase.png" alt="">
                    </div>
                    <div class="txt_services__">
                        <p>Business & Corporate Issues</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="one_services_img _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/rocket.png" alt="">
                    </div>
                    <div class="txt_services__">
                        <p>Start up & Registrations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End ###############  -->

<!-- pay per minuit  -->
<section class="bg_how_full_width hidden">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="how_it_work">
                    <h4 class="m-0">Pay Per Minute</h4>
                    <p>Balance minutes remains in wallet that you can use anytime.</p>
                </div>
                <div class="talk_lawyer_BG2">
                    <div class="minu">
                        <div class="time_min">
                            <p>10</p>
                        </div>
                        <div class="min_text">
                            <p><b>10 Minutes</b></p>
                            <p>Rate: 27.9/Minutes</p>
                            <p>Discount: 46.9%</p>
                            <del><small>₹525</small><b>₹279</b></del>
                        </div>
                    </div>
                    <div class="bus_btn_time">
                        <a href="#"><button class="_btnTalk">Buy Now</button></a>
                    </div>
                </div>
                <div class="talk_lawyer_BG2">
                    <div class="minu">
                        <div class="time_min">
                            <p>10</p>
                        </div>
                        <div class="min_text">
                            <p><b>10 Minutes</b></p>
                            <p>Rate: 27.9/Minutes</p>
                            <p>Discount: 46.9%</p>
                            <del><small>₹525</small><b>₹279</b></del>
                        </div>
                    </div>
                    <div class="bus_btn_time">
                        <a href="#"><button class="_btnTalk">Buy Now</button></a>
                    </div>
                </div>
                <div class="talk_lawyer_BG2">
                    <div class="minu">
                        <div class="time_min">
                            <p>10</p>
                        </div>
                        <div class="min_text">
                            <p><b>10 Minutes</b></p>
                            <p>Rate: 27.9/Minutes</p>
                            <p>Discount: 46.9%</p>
                            <del><small>₹525</small><b>₹279</b></del>
                        </div>
                    </div>
                    <div class="bus_btn_time">
                        <a href="#"><button class="_btnTalk">Buy Now</button></a>
                    </div>
                </div>
                <div class="talk_lawyer_BG2">
                    <div class="minu">
                        <div class="time_min">
                            <p>10</p>
                        </div>
                        <div class="min_text">
                            <p><b>10 Minutes</b></p>
                            <p>Rate: 27.9/Minutes</p>
                            <p>Discount: 46.9%</p>
                            <del><small>₹525</small><b>₹279</b></del>
                        </div>
                    </div>
                    <div class="bus_btn_time">
                        <a href="#"><button class="_btnTalk">Buy Now</button></a>
                    </div>
                </div>
                <div class="talk_lawyer_BG mt-2">
                    <div class="pheragrap_discuss">
                        <p><span>With Expert Lawyers -</span> Family matters, Property, Agreements, Documentation,
                            Partnership, Money Recovery, Cheque bounce, Startup, Registrations, Trademark, Copyright,
                            Legal opinion, Loans, Legal Notice, etc.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End ######################  -->

<!-- product section start  -->
<section>
    <div class="container-fluid">
        <div class="servics__">
            <h4>Products</h4>
        </div>
        <div class="row">
            <div class="col-md-3 col-3 ">
                <a href="#">
                    <div class="one_img_prod _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/trademark.png" alt="">
                    </div>
                    <div class="name_prod">
                        <p>Trademark Registration</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-3 ">
                <a href="#">
                    <div class="one_img_prod _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/copywriting.png" alt="">
                    </div>
                    <div class="name_prod">
                        <p>Copyright Registration</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-3 ">
                <a href="#">
                    <div class="one_img_prod _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/agreement.png" alt="">
                    </div>
                    <div class="name_prod">
                        <p>Non Disclosure Agreement</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-3 ">
                <a href="#">
                    <div class="one_img_prod _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/cooperation.png" alt="">
                    </div>
                    <div class="name_prod">
                        <p>Partnership Agreement</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-3 ">
                <a href="#">
                    <div class="one_img_prod _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/draft.png" alt="">
                    </div>
                    <div class="name_prod">
                        <p>Sale Deed Drafting</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-3 ">
                <a href="#">
                    <div class="one_img_prod _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/mortgage.png" alt="">
                    </div>
                    <div class="name_prod">
                        <p>Gift Deed</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-3 ">
                <a href="#">
                    <div class="one_img_prod _btnTalk">
                        <img src="<?=base_url()?>assets/images/mobilehome/will.png" alt="">
                    </div>
                    <div class="name_prod">
                        <p>Will</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- End ####################  -->

<!-- benefit of legal section start  -->
<section class="bg_how_full_width">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="how_it_work">
                    <h4 class="m-0">Benefits of Insaaf99</h4>
                    <p>Best in Legal | 24x7 | Quick & Accurate</p>
                </div>
                <div class="talk_lawyer_BG2 mt-4">
                    <div class="benifitImgbox_cls"><img loading="lazy"
                            src="<?=base_url()?>assets/images/mobilehome/policy-sold.svg"
                            alt="Over 45 Lac Happy Customers" width="186" height="186"></div>
                    <div class="carintitle">
                        <h3>Pay Per Minute</h3>
                    </div>
                    <div>
                        <p>Ever first time in India, you pay per minute i.e. only for the time you talk to our Advocates
                            or legal experts. Your balance talk time remains with you so you can talk again anytime by
                            using the same.....</p>
                    </div>
                </div>
                <div class="talk_lawyer_BG2 mt-4">
                    <div class="benifitImgbox_cls"><img loading="lazy"
                            src="<?=base_url()?>assets/images/mobilehome/time.svg" alt="Over 45 Lac Happy Customers"
                            width="186" height="186"></div>
                    <div class="carintitle">
                        <h3>Time Saving, Cost Saving</h3>
                    </div>
                    <div>
                        <p>We provide online legal services, Audio/Video consultation that actually saves you lot of
                            money and also the travel time. Services comes to you at the cost of petrol you consume to
                            meet your Adviser. Discuss your issues with highly qualified experts from your own place and
                            at your own chosen time....</p>
                    </div>
                </div>
                <div class="talk_lawyer_BG2 mt-4">
                    <div class="benifitImgbox_cls"><img loading="lazy"
                            src="<?=base_url()?>assets/images/mobilehome/support.svg" alt="Over 45 Lac Happy Customers"
                            width="186" height="186"></div>
                    <div class="carintitle">
                        <h3>Quick and Accurate</h3>
                    </div>
                    <div>
                        <p>Our dedicated support team is available for your assistance all the 7 days. Feel free to
                            reach out to us in case of any confusion - be it related to the any area of law, legal
                            advise, documentation, court litigation or starup, our team of experts is at your service
                            all days.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End ####################  -->

<!-- start google review section  -->
<section id="scroll_review">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="google_rating_review">
                    <img src="<?=base_url()?>assets/images/mobilehome/google.png" alt="google">
                    <h4>Rating</h4>
                </div>
                <div class="custormer_reviews">
                    <div class="rating-star">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                    </div>
                    <div class="review_text">
                        <p>Loved the support and communication. 100% recommended for your company’s incorporation!</p>
                    </div>
                    <div class="rating_posted_on_google">

                        <div class="Icon__IconContainer">
                            <img alt="Insaaf99 Rating and Reviews"
                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                        </div>
                        <div class="ReviewSource__">
                            <p>Posted on Google</p>
                        </div>
                    </div>
                </div>
                <div class="custome_details">
                    <div class="customer_img_on_review">
                        <img alt="customer_image" src="<?php echo base_url()?>assets/images/mobilehome/vishal.webp">
                    </div>
                    <div class="customer_name">
                        <h6>Vishal Gupta</h6>
                        <p><small>3 Days ago</small></p>
                    </div>
                    <div class="blue_tick">
                        <img alt="customer_image"
                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                    </div>
                </div>
                <div class="custormer_reviews">
                    <div class="rating-star">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                    </div>
                    <div class="review_text">
                        <p>Very good experience with Vinny ji</p>
                    </div>
                    <div class="rating_posted_on_google">

                        <div class="Icon__IconContainer">
                            <img alt="Insaaf99 Rating and Reviews"
                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                        </div>
                        <div class="ReviewSource__">
                            <p>Posted on Google</p>
                        </div>
                    </div>
                </div>

                <div class="custome_details">
                    <div class="customer_img_on_review">
                        <img alt="customer_image" src="<?php echo base_url()?>assets/images/mobilehome/yashi.webp">
                    </div>
                    <div class="customer_name">
                        <h6>Yashi Jain</h6>
                        <p><small>5 Days ago</small></p>
                    </div>
                    <div class="blue_tick">
                        <img alt="customer_image"
                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                    </div>
                </div>
                <div class="custormer_reviews">
                    <div class="rating-star">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/half_star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/rating.webp">
                    </div>
                    <div class="review_text">
                        <p>Some Issue to Joining a Meeting But Insaaf99 Team Help me.</p>
                    </div>
                    <div class="rating_posted_on_google">

                        <div class="Icon__IconContainer">
                            <img alt="Insaaf99 Rating and Reviews"
                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                        </div>
                        <div class="ReviewSource__">
                            <p>Posted on Google</p>
                        </div>
                    </div>
                </div>
                <div class="custome_details">
                    <div class="customer_img_on_review">
                        <img alt="customer_image" src="<?php echo base_url()?>assets/images/mobilehome/ayush.webp">
                    </div>
                    <div class="customer_name">
                        <h6>Ayush Tyagi</h6>
                        <p><small>5 Days ago</small></p>
                    </div>
                    <div class="blue_tick">
                        <img alt="customer_image"
                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                    </div>
                </div>
                <div class="custormer_reviews">
                    <div class="rating-star">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                    </div>
                    <div class="review_text">
                        <p>Provided smooth and easy services.</p>
                    </div>
                    <div class="rating_posted_on_google">

                        <div class="Icon__IconContainer">
                            <img alt="Insaaf99 Rating and Reviews"
                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                        </div>
                        <div class="ReviewSource__">
                            <p>Posted on Google</p>
                        </div>
                    </div>
                </div>
                <div class="custome_details">
                    <div class="customer_img_on_review">
                        <img alt="customer_image" src="<?php echo base_url()?>assets/images/mobilehome/saurabh.webp">
                    </div>
                    <div class="customer_name">
                        <h6>Saurabh Singh</h6>
                        <p><small>5 Days ago</small></p>
                    </div>
                    <div class="blue_tick">
                        <img alt="customer_image"
                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                    </div>
                </div>
                <div class="custormer_reviews">
                    <div class="rating-star">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                    </div>
                    <div class="review_text">
                        <p>Got the best legal advice from Insaaf99 for my startup. Their team was knowledgeable and
                            responsive, and they helped me navigate complex legal issues with ease. Highly recommended
                        </p>
                    </div>
                    <div class="rating_posted_on_google">

                        <div class="Icon__IconContainer">
                            <img alt="Insaaf99 Rating and Reviews"
                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                        </div>
                        <div class="ReviewSource__">
                            <p>Posted on Google</p>
                        </div>
                    </div>
                </div>
                <div class="custome_details">
                    <div class="customer_img_on_review">
                        <img alt="customer_image" src="<?php echo base_url()?>assets/images/mobilehome/sai.webp">
                    </div>
                    <div class="customer_name">
                        <h6>Sai Abhishek</h6>
                        <p><small>6 Days ago</small></p>
                    </div>
                    <div class="blue_tick">
                        <img alt="customer_image"
                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                    </div>
                </div>
                <div class="custormer_reviews">
                    <div class="rating-star">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                    </div>
                    <div class="review_text">
                        <p>इंसाफ99 के वकील वास्तव में सबसे अच्छे हैं। उन्होंने मुझे एक कानूनी नोटिस और एस्टेट प्लानिंग
                            को मूल रूप से तैयार करने में मदद की। मेरी आवश्यकताओं के अनुरूप व्यावहारिक सलाह प्रदान की</p>
                    </div>
                    <div class="rating_posted_on_google">

                        <div class="Icon__IconContainer">
                            <img alt="Insaaf99 Rating and Reviews"
                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                        </div>
                        <div class="ReviewSource__">
                            <p>Posted on Google</p>
                        </div>
                    </div>
                </div>
                <div class="custome_details">
                    <div class="customer_img_on_review">
                        <img alt="customer_image" src="<?php echo base_url()?>assets/images/mobilehome/monika.webp">
                    </div>
                    <div class="customer_name">
                        <h6>Monika Garg</h6>
                        <p><small>7 Days ago</small></p>
                    </div>
                    <div class="blue_tick">
                        <img alt="customer_image"
                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

<script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js">
</script>

<!-- script for menu start  -->
<script>
function openNav() {
    document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}
</script>
<!-- script for menu End  -->

<!-- script for countdown  -->
<script>
// Set the date we're counting down to
var today = new Date().getTime();
var countDownDate = today + 86400 * 60 * 60; //  new Date("june 1, 2023 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("countdown").innerHTML = hours + "<small>H</small> : " +
        minutes + "<small>M</small> : " + seconds + "<small>S</small>";

    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "EXPIRED";
    }
}, 1000);
</script>

<!-- End ############  -->



<script>
function checkLength() {
    if ($('input[name="schedule_time"]:checked').length == 0) {
        //alert('Schedule time not available');
        alert('Select Schedule time');
        return false;
    }

    if ($('input[name="schedule_date"]:checked').length == 0) {
        //alert('Schedule time not available');
        alert('Select Schedule Date');
        return false;
    }
}



$(document).ready(function() {
    $(".slot_date_div").click(function() {
        var slot_data_id = $(this).attr('data-id');
        var schedule_day = $('.slot_date_input_' + slot_data_id).attr('data-day');
        var schedule_date = $('.slot_date_input_' + slot_data_id).val();
        // alert(schedule_day); exit();

        // var lawyer_id = "<?php echo $this->session->userdata('ses_lawyer_id'); ?>";
        var url = "<?php echo base_url('new_user/get_time'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                schedule_day: schedule_day,
                lawyer_id: '',
                schedule_date: schedule_date
            },
            success: function(response) {
                $(".put_schedule").html(response);
                // alert(response);
            }
        });
    });
});
</script>

<script>
var owl = $('.owl-carousel');
owl.owlCarousel({
    items: 1.5,
    // items change number for slider display on desktop
    dots: false,
    loop: true,
    margin: 0,
    autoplay: false,
    autoplayTimeout: 3000,
    autoplayHoverPause: true
});
</script>