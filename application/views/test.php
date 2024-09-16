<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KVVVJXM" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<section>
    <div class="container">
        <div class="row"></div>
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

</section>

<!------------------------------------------- view on mobile  ------------------------------------>

<section class="__view_mobile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">

                            <img class="d-block w-100" src="<?php echo base_url()?>assets/images/view1mobile.jpg"
                                alt="online legal advice">
                            <div class=" for_mob_text_chrb">
                                <div class="carousel-caption __capCor  d-md-block">

                                    <div class="__bg__mob_index">
                                        <h1><?=$this->lang->line('onlinelegal');?></h1>
                                        <h2><?=$this->lang->line('leading_online_cont');?></h2>
                                        <p class="mb-0"><?=$this->lang->line('with_insaaf');?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?php echo base_url()?>assets/images/view2mobile.jpg"
                                alt="lawyer for consultation">
                            <div class=" for_mob_text_chrb">
                                <div class="carousel-caption __capCor  d-md-block">


                                    <div class="__bg__mob_index">
                                        <h1><?=$this->lang->line('onlinelegal');?></h1>
                                        <h2><?=$this->lang->line('leading_online_cont');?></h2>
                                        <p class="mb-0"><?=$this->lang->line('with_insaaf');?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?php echo base_url()?>assets/images/view3mobile.jpg"
                                alt="online law consultation india">
                            <div class=" for_mob_text_chrb">
                                <div class="carousel-caption __capCor  d-md-block">

                                    <div class="__bg__mob_index">
                                        <h1><?=$this->lang->line('onlinelegal');?></h1>
                                        <h2><?=$this->lang->line('leading_online_cont');?></h2>
                                        <p class="mb-0"><?=$this->lang->line('with_insaaf');?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- for mobile lawyer online  -->
        <div class="row d-none">
            <div class="col-md-6 col-6">
                <div class="for_pos_abd_inde_mob">
                    <div class="for_sjherj_inner_mobile">
                        <!-- <p><small>Online Lawyers</small></p> -->
                        <div class="for_cjdnh_oosp">
                            <span> Online Lawyers </span>
                            <i class="fa fa-circle text-danger-glow blink"></i>
                        </div>
                        <div class="dif_fldkfjff">
                            <img src="<?php echo base_url()?>assets/images/defult_image.png" alt="">
                            <img src="<?php echo base_url()?>assets/images/defult_image.png" alt="">
                            <img src="<?php echo base_url()?>assets/images/defult_image.png" alt="">
                            <p><small>+123</small></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="for_pos_abd_inde_mob">
                    <div class="for_sjherj_inner_mobile">
                        <!-- <p><small>Online Lawyers</small></p> -->
                        <div class="for_cjdnh_oosp">
                            <span> Online Calls </span>
                            <i class="fa fa-circle text-danger-glow blink"></i>
                        </div>
                        <p>28</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- ###########End#####################  -->
    </div>
</section>
<!------------------------------------------------- end ----------------------------------->
<div id="" class="header">
    <section class="__view_desktop">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12 p-0">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">

                                <img class="d-block w-100" src="<?php echo base_url()?>assets/images/baner1.jpg"
                                    alt="consult lawyer online india" class="img-fluid">
                                <div class="carousel-caption d-md-block _carsoul_title">
                                    <h1><?=$this->lang->line('onlinelegal');?></h1>
                                    <h2><?=$this->lang->line('leading_online_cont');?></h2>
                                    <p class="mb-0"><?=$this->lang->line('with_insaaf');?></p>
                                </div>
                            </div>

                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?php echo base_url()?>assets/images/insaaf_banner2.jpg"
                                    alt="online consultation advocate">
                                <div class="carousel-caption d-md-block _carsoul_title">

                                    <h1><?=$this->lang->line('onlineadvise');?> </h1>
                                    <h2><?=$this->lang->line('we_know_all_cont');?> </h2>
                                    <p class="mb-0"><?=$this->lang->line('connectwith');?> </p>
                                </div>

                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="<?php echo base_url()?>assets/images/insaff_banner2.jpg"
                                    alt="online consultation advocate">
                                <div class="carousel-caption d-md-block _carsoul_title">

                                    <h1><?=$this->lang->line('find_lawyer_');?> </h1>
                                    <h2><?=$this->lang->line('we_talk_about_cont');?></h2>
                                    <p class="mb-0"><?=$this->lang->line('best_divorce');?></p>
                                </div>

                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <i class="bi bi-arrow-left-circle-fill __same325154"></i>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <i class="bi bi-arrow-right-circle-fill __same325154"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>




<section class="bg_booking text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="example1">
                    <ul class="d-flex list-unstyled __marquee">
                        <p class="mb-0"><?=$this->lang->line('Business_con_cont');?> &nbsp;&nbsp;|
                            &nbsp;&nbsp;<?=$this->lang->line('property_real_cont');?> &nbsp;&nbsp;|&nbsp;&nbsp;
                            &nbsp;&nbsp;<?=$this->lang->line('legal_Notices_cont');?>
                            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
                            &nbsp;&nbsp;<?=$this->lang->line('Website_digi_cont');?> &nbsp;&nbsp;|&nbsp;&nbsp;
                            &nbsp;&nbsp;<?=$this->lang->line('hr_labour_cont');?> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
                            &nbsp;&nbsp;<?=$this->lang->line('company_for_cont');?> &nbsp;&nbsp;|&nbsp;&nbsp;
                            &nbsp;&nbsp;<?=$this->lang->line('intellectual_cont');?></p>&nbsp;&nbsp;
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="cream">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class=" justify-content-between">

                    <div class="p-2 bd-highlight">
                        <div class="bottom_provide text-center">
                            <p class="mb-0 p-3 "><?=$this->lang->line('insaaf99_provide_cont');?></p>



                            <div class="bd-highlight __slot_inner blk_bng mb-3 " id="">
                                <a href="<?=base_url()?>login"
                                    class="btn   ">&nbsp;<?=$this->lang->line('book_slot_menu');?></a>
                                <!--  _book_btn -->
                            </div>



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

</script>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="d-flex flex-row bd-highlight text-center __box_Head ">
                    <div class="p-2 bd-highlight w-100 __legalbg"> <img
                            src="<?=base_url()?>assets/images/check-mark.png"
                            alt="lawyer for consultation"><?=$this->lang->line('protect_cont');?>
                    </div>
                    <div class="p-2 bd-highlight w-100 __legalbg"><img src="<?=base_url()?>assets/images/check-mark.png"
                            alt="lawyer for consultation">&nbsp;<?=$this->lang->line('take_right_cont');?>
                    </div>
                    <div class="p-2 bd-highlight w-100 __legalbg"><img src="<?=base_url()?>assets/images/check-mark.png"
                            alt="lawyer for consultation"><?=$this->lang->line('avoid_cont');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- <div id=""> -->
    <section class="bg_next  sec_pad_ner">
        <div class="container">
            <div class="row pl-3">
                <div class="col-md-12">
                    <div class="law_client">
                        <h4 class=" pb-3 pt-5 bold1">

                            <span
                                style="font-weight: 500;font-family: playfair display;"><?=$this->lang->line('how_documents')?></span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="col-md-4 pt-2">
                    <a href="<?= (isset($_SESSION['id']) && isset($_SESSION['role']))?base_url($_SESSION['role'].'/dashboard'):'javascript:void(0)'?>"
                        <?= (isset($_SESSION['id']))?'':'data-toggle="modal" data-target="#exampleModalCenter"'?>
                        class="dcudfjr_nfjf">
                        <div class="my_doc">
                            <div class="docu1 ">
                                <div class="law_client">
                                    <div class="file">
                                        <div class="row">
                                            <div class="col-md-4 pt-2">
                                                <img src="<?=base_url()?>assets/images/verify_tick.png"
                                                    class="img-fluid round " alt="lawyer for consultation">
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="hiw-content hiw-static d-flex align-items-center justify-content-between ">
                                        <div class="tile-item">
                                            <div class="icon-circle-box">
                                                <div class="icon-circle">
                                                    <div class="bg-hiw_choose_your_required_icon"></div>
                                                </div>
                                            </div>
                                            <div class="description">
                                                <h5 class="head-text1  mb-0">
                                                    <?=$this->lang->line('describe_your_cont');?>
                                                </h5>
                                                <p class="pt-2 text1 ">
                                                    <?=$this->lang->line('describe_your_text_cont');?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <i class="bi bi-arrow-right-square-fill"></i>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 pt-2">
                    <a href="<?=base_url()?>login" class="dcudfjr_nfjf">
                        <div class="my_doc">
                            <div class="docu1 ">
                                <div class="law_client">
                                    <div class="file">
                                        <div class="row">
                                            <div class="col-md-4 pt-2">
                                                <img src="<?=base_url()?>assets/images/chat__law.png"
                                                    class="img-fluid round" alt="lawyer for consultation">
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="hiw-content hiw-static d-flex align-items-center justify-content-between ">
                                        <div class="tile-item">
                                            <div class="icon-circle-box">
                                                <div class="icon-circle">
                                                    <div class="bg-hiw_choose_your_required_icon"></div>
                                                </div>
                                            </div>
                                            <div class="description">
                                                <h5 class="head-text1 mb-0"><?=$this->lang->line('chat_one_cont');?>
                                                </h5>
                                                <p class="pt-2 text1">
                                                    <?=$this->lang->line('chat_one_text_cont');?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <i class="bi bi-arrow-right-square-fill"></i>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 pt-2">
                    <a href="<?=base_url()?>login" class="dcudfjr_nfjf">
                        <div class="my_doc ">
                            <div class="docu1 ">
                                <div class="law_client">
                                    <div class="file">
                                        <div class="row">
                                            <div class="col-md-4 pt-2">
                                                <img src="<?=base_url()?>assets/images/saving_time.png"
                                                    class="img-fluid round" alt="lawyer for consultation">
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="hiw-content hiw-static d-flex align-items-center justify-content-between ">
                                        <div class="tile-item">
                                            <div class="icon-circle-box">
                                                <div class="icon-circle">
                                                    <div class="bg-hiw_choose_your_required_icon"></div>
                                                </div>
                                            </div>
                                            <div class="description">
                                                <h5 class="head-text1 mb-0">
                                                    <?=$this->lang->line('save_time_cont');?>
                                                </h5>
                                                <p class="pt-2 text1">
                                                    <?=$this->lang->line('save_time_text_cont');?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <i class="bi bi-arrow-right-square-fill"></i>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <section class="new_table_pop">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 p-0">
                            <div class="bg_black_conslut_layer">
                                <div class="text_Cont_cntr">
                                    <div class="title new_linfirm">We are INSAAF99.COM </div>
                                </div>
                                <div class="cente_tex">
                                    <h2>Request For Consultation</h2>
                                    <p>THE NEW WAY TO FIND A LAWYER FOR ALL YOUR LEGAL SOLUTIONS</p>
                                    <button class="for_bg_tebd_constl"> <a href="<?= base_url('login')?>"
                                            class="btn callrequestbtn">Consult a lawyer&nbsp;&nbsp;<span><i
                                                    class="bi bi-arrow-right-circle"></i></span></a></button>
                                </div>
                                <div class="for_nec_cdj_posd">
                                    <div
                                        class="d-flex text-white align-items-center justify-content-end for_colro_rd flex-wrap">

                                        <div class="p-2 new_hig_clsdd"><i class="bi bi-telephone-fill"></i></div>
                                        <div class="p-2">Want to take help? <br>+91-9354008027</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-0">
                            <div class="for_null_value">
                                <img class="w-100 img-fluid"
                                    src="<?php echo base_url()?>assets/images/conslt_lyr_bg2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- start mobile view of consult lawyer  -->

    <section class="for_mobile_vi_table">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-0">
                    <div class="bg_black_conslut_layer">
                        <div class="text_Cont_cntr">
                            <div class="title new_linfirm">We are INSAAF99.COM</div>
                        </div>
                        <div class="cente_tex">
                            <h2>Request For Consultation</h2>
                            <p>THE NEW WAY TO FIND A LAWYER FOR ALL YOUR LEGAL SOLUTIONS</p>
                            <button class="for_bg_tebd_constl"> <a href="<?= base_url('login')?>"
                                    class="btn callrequestbtn">Consult a lawyer&nbsp;&nbsp;<span><i
                                            class="bi bi-arrow-right-circle"></i></span></a></button>
                        </div>
                        <div class="for_nec_cdj_posd">
                            <div
                                class="d-flex text-white align-items-center justify-content-end for_colro_rd flex-wrap">

                                <div class="p-2 new_hig_clsdd"><i class="bi bi-telephone-fill"></i></div>
                                <div class="p-2">Want to take help? <br>+91-9354008027</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End mobile view of consult lawyer  -->

    <!-- start a youtube video sec  -->
    <section class="bg_ground_youtube">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="for_set_wid m-auto">

                                <div class="yout_video_cont mb-4 ">
                                    <div class="main_video_cont">
                                        <h1>Introduction to <span>Insaaf99</span> </h1>
                                        <p>Insaaf99.com provides a legal platform to general public to <br> meet with
                                            the best legal professionals. </p>
                                    </div>
                                    <div class="i_fr_video">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/0sW3loHLaRI"
                                            title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4">
                        <div class="for_ply_vido_img">
                            <img src="<?php echo base_url()?>assets/images/youtbe_bane.png" alt="" class="w-50">
                        </div>
                    </div> -->
            </div>
        </div>
    </section>


    <!-- End #############  -->



    <!-- <section class="__bg_call_re">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="bg__request">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="for_dlf_indz_pas">
                                    <div class="reuest__call">
                                        <h2>Request For Consultation</h2>
                                        <p>contact@insaaf99.com</p>
                                        <p class="gort_botm_bor_conslt">THE NEW WAY TO FIND A LAWYER FOR ALL YOUR LEGAL
                                            SOLUTIONS</p>
                                    </div>
                                    <button class="for_bg_tebd_constl"> <a href="<?= base_url('login')?>"
                                            class="btn callrequestbtn">Consult a
                                            lawyer&nbsp;&nbsp;<span><i
                                                    class="bi bi-arrow-right-circle"></i></span></a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="bg___cout__21343">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="__average3543">
                        <div class="d-flex justify-content-between">
                            <div class="p-2 bd-highlight text-center __addon">
                                <h1><strong>409</strong></h1>
                                <p><?=$this->lang->line('qualified_lawyers_cont');?></p>
                            </div>

                            <div class="p-2 bd-highlight text-center __addon">
                                <h1><strong>+275</strong></h1>
                                <p><?=$this->lang->line('satisfied_clients_cont');?> <i
                                        class="bi bi-emoji-smile-fill"></i></p>
                            </div>

                            <div class="p-2 bd-highlight text-center __addon">
                                <h1><strong>46</strong></h1>
                                <p><?=$this->lang->line('on_elivery_cont');?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="cut_off">
        <svg classs="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 19">
            <polygon fill="#ffffff"
                points="1422,18 1404,0 1386,18 1368,0 1350,18 1332,0 1314,18 1296,0 1278,18 1260,0 1242,18 1224,0 1206,18 1188,0 1170,18 1152,0 1134,18 1116,0 1098,18 1080,0 1062,18 1044,0 1026,18 1008,0 990,18 972,0 954,18 936,0 918,18 900,0 882,18 864,0 846,18 828,0 810,18 792,0 774,18 756,0 738,18 720,0 702,18 684,0 666,18 648,0 630,18 612,0 594,18 576,0 558,18 540,0 522,18 504,0 486,18 468,0 450,18 432,0 414,18 396,0 378,18 360,0 342,18 324,0 306,18 288,0 270,18 252,0 234,18 216,0 198,18 180,0 162,18 144,0 126,18 108,0 90,18 72,0 54,18 36,0 18,18 0,0 0,19 1440,19 1440,0 ">
            </polygon>
        </svg>
    </section>

    <!-- lawyer list section end-->
    <section class="hidden">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="top_recent_gtx">
                        <span>Recent Case Studies</span>
                        <h4 class="mt-4">We Are Specialist For Many <br>Consulting Cases</h4>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="__agency_gtx">

                        <p>Our agency can only be as strong as our people our team follwing agenhave run their
                            businesses designed.</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme __owl">
                        <div class="item __main_law">
                            <div class="__lawywer_gtx mb-5">
                                <div class=" ">
                                    <div class="p-2 ___lawyer_img_gtx">
                                        <img src="<?php echo base_url()?>assets/images/main_layer.jpg"
                                            class="img-fluid">
                                    </div>
                                    <div class="p-2 ___law_gtx pt-4">
                                        <div class="Details_lawyer_gtx d-flex  ">
                                            <span class="__namespan gtx_span">Name:</span>
                                            <span class="detailsSpan">Vinny Shangloo</span>
                                        </div>

                                        <div class="Details_lawyer_gtx d-flex  ">
                                            <span class="__exspan gtx_span">Exp:</span>
                                            <span class="detailsSpan">15yrs</span>
                                        </div>

                                        <div class="Details_lawyer_gtx d-flex  ">
                                            <span class="__Barspan gtx_span">Bar Councle:</span>
                                            <span class="detailsSpan">New Delhi </span>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="#" class="btn SuInsuBnt">View All</a>
                </div>
            </div>
        </div>
    </section>

    <!-- lawyer list section end-->
    <section class="bg_next sec_pad bg1__ pb-1 ">
        <!--  back1234 -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <h4 class="base_ pb-3 pt-5 bold1 text-center co_text_bsgd">
                        <span
                            style="font-weight: 500;font-family: playfair display;"><?=$this->lang->line('contact_menu');?>
                            - </span> <?=$this->lang->line('to_easy_cont');?>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 col-12 __box_Head">
                    <div class="fro_input_texghd">
                        <div class="fro_main_hedsfd">
                            <h1><?=$this->lang->line('register_pro_cont');?></h1>
                        </div>
                        <div class="fro_regst_proces">
                            <div class="for-widjf_img_lidf">
                                <a href="<?=base_url()?>login"><img
                                        src="<?php echo base_url()?>assets/images/registation_process.png" alt=""></a>
                                <a href="<?=base_url()?>login"><img src="<?php echo base_url()?>assets/images/free.png"
                                        alt=""></a>
                            </div>
                            <div class="fro_same_cldd_dm">
                                <div class="_fortwo_levelr">
                                    <img src="<?php echo base_url()?>assets/images/check-mark.png"
                                        alt="lawyer advice online">
                                    <p><?=$this->lang->line('register_your_cont');?></p>
                                </div>
                                <div class="_fortwo_levelr">
                                    <img src="<?php echo base_url()?>assets/images/check-mark.png"
                                        alt="lawyer advice online">
                                    <p><?=$this->lang->line('select_cat_cont');?></p>
                                </div>
                                <div class="_fortwo_levelr">
                                    <img src="<?php echo base_url()?>assets/images/check-mark.png"
                                        alt="lawyer advice online">
                                    <p><?=$this->lang->line('put_query_cont');?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="for_iisjd_img_left_side">
                        <img src="<?php echo base_url()?>assets/images/men_side_hand.png" alt="">
                    </div>
                </div>

                <div class="col-md-5 col-12 __box_Head mobileSpace">
                    <div class="fro_input_texghd">
                        <div class="fro_main_hedsfd">
                            <h1><?=$this->lang->line('meeting_process_cont');?></h1>
                        </div>
                        <div class="fro_regst_proces">
                            <div class="for-widjf_img_lidf">
                                <a href="<?=base_url()?>login"><img
                                        src="<?php echo base_url()?>assets/images/communication.png" alt=""></a>
                                <a href="<?=base_url()?>login"><img
                                        src="<?php echo base_url()?>assets/images/book_slot.png" alt=""></a>
                            </div>
                            <div class="fro_same_cldd_dm">
                                <div class="_fortwo_levelr">
                                    <img src="<?php echo base_url()?>assets/images/check-mark.png"
                                        alt="lawyer advice online">
                                    <p><?=$this->lang->line('register_your_cont');?></p>
                                </div>
                                <div class="_fortwo_levelr">
                                    <img src="<?php echo base_url()?>assets/images/check-mark.png"
                                        alt="lawyer advice online">
                                    <p><?=$this->lang->line('purchase_cont');?></p>
                                </div>
                                <div class="_fortwo_levelr">
                                    <img src="<?php echo base_url()?>assets/images/check-mark.png"
                                        alt="lawyer advice online">
                                    <p><?=$this->lang->line('book_slot_15_cont');?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- only view mobile -->

    <section class="sec_pad">
        <div class="container section_view_mobile">
            <div class="row">
                <div class="col-md-12 ">
                    <h4 class="base_ pb-3 pt-5 bold1 text-center">
                        <span
                            style="font-weight: 500;font-family: playfair display;"><?=$this->lang->line('we_offer_cont');?></span><?=$this->lang->line('focused_cont');?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <img width="600" height="600"
                        src="<?php echo base_url()?>assets/images/pexels-ekaterina-bolovtsova-6077123.jpg"
                        alt="online legal advice" class="circle_roll"><br>
                    <span
                        style="font-size: 1.5rem; font-weight: 700;"><?=$this->lang->line('we_talk_about_cont');?></span><br>
                    <p><?=$this->lang->line('help_you_cont');?></p>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <img width="600" height="600"
                        src="<?php echo base_url()?>assets/images/pexels-sora-shimazaki-5669619.jpg"
                        alt="online legal advice" class="circle_roll"><br>
                    <span
                        style="  font-size: 1.5rem;font-weight: 700;"><?=$this->lang->line('narrow_if_cont');?></span><br>
                    <p><?=$this->lang->line('give_you_cont');?></p>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center mt-5">
                    <img width="600" height="600"
                        src="<?php echo base_url()?>assets/images/pexels-ekaterina-bolovtsova-6077326.jpg"
                        alt="online legal advice" class="circle_roll"><br>
                    <span
                        style=" font-size: 1.5rem;font-weight: 700;"><?=$this->lang->line('get_it_right_cont');?></span><br>
                    <p><?=$this->lang->line('legal_stap_cont');?></p>


                </div>
            </div>
        </div>
    </section>

    <!-- end -->



    <!-- only view desktop  -->
    <section class="bg_next sec_pad bg1__ pb-1 section_view_desktop">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <h4 class="base_ pb-3 pt-5 bold1 text-center">
                        <span
                            style="font-weight: 500;font-family: playfair display;"><?=$this->lang->line('we_offer_cont');?></span><?=$this->lang->line('focused_cont');?>
                    </h4>
                </div>
            </div>


            <div class="row _space653 mt-0">
                <div class="col-md-5">
                    <div class="p-2 bd-highlight text-right mt-4"><b><span
                                style="font-size: 1.5rem;"><?=$this->lang->line('we_talk_about_cont');?></span></b><br>
                        <p><?=$this->lang->line('help_you_cont');?></p>
                    </div>
                </div>


                <div class="col-md-2">
                    <div class="p-2 bd-highlight">
                        <div class="__div_shape">
                            <img width="600" height="600"
                                src="<?php echo base_url()?>assets/images/pexels-ekaterina-bolovtsova-6077123.jpg"
                                alt="online legal advice" class="circle_roll">
                        </div>
                    </div>
                </div>



                <div class="col-md-5">
                    <div class="p-2 bd-highlight _numeric">01</div>
                </div>
            </div>

            <div class="row _space653">
                <div class="col-md-5">
                    <div class="p-2 bd-highlight _numeric text-right">02</div>
                </div>


                <div class="col-md-2">
                    <div class="p-2 bd-highlight">
                        <div class="__div_shape">
                            <img width="600" height="600"
                                src="<?php echo base_url()?>assets/images/pexels-sora-shimazaki-5669619.jpg"
                                alt="online legal advice" class="circle_roll">
                        </div>
                    </div>
                </div>



                <div class="col-md-5">

                    <div class="p-2 bd-highlight text-left mt-4"><b><span
                                style="font-size: 1.5rem;"><?=$this->lang->line('narrow_if_cont');?></span></b><br>
                        <p><?=$this->lang->line('give_you_cont');?></p>
                    </div>
                </div>
            </div>


            <div class="row _space653">
                <div class="col-md-5">
                    <div class="p-2 bd-highlight text-right mt-4"><b><span style="    font-size: 1.5rem;
                     "><?=$this->lang->line('get_it_right_cont');?></span></b><br>
                        <p><?=$this->lang->line('legal_stap_cont');?></p>
                    </div>
                </div>


                <div class="col-md-2">
                    <div class="p-2 bd-highlight">
                        <div class="__div_shape">
                            <img width="600" height="600"
                                src="<?php echo base_url()?>assets/images/pexels-ekaterina-bolovtsova-6077326.jpg"
                                alt="online legal advice" class="circle_roll">
                        </div>
                    </div>
                </div>



                <div class="col-md-5">
                    <div class="p-2 bd-highlight _numeric">03</div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">

                    <div class="d-flex justify-content-center m-auto _auto_need">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end -->


    <section class=" __should_bg">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <span
                        style="font-weight: 700;   font-style: italic;font-family: playfair display;"><?=$this->lang->line('Why_us_cont');?></span>
                    <h4 class="base_   bold1"><?=$this->lang->line('Why_should_cont');?> <span
                            style="color: #ff9100;"><?=$this->lang->line('insaaf99_cont');?> </span>
                    </h4>
                    <div class="__better65">
                        <h4><?=$this->lang->line('better_access_cont');?></h4>
                        <p><?=$this->lang->line('Why_are_here_cont');?>
                            <strong><?=$this->lang->line('99_cont');?></strong>
                        </p>

                        <div class="__query_call justify-content-between">
                            <span><?=$this->lang->line('call_to_cont');?><a href="tel:9354008027"
                                    class="__any354653"><?=$this->lang->line('any_question_cont');?></a></span>
                            <span style="font-size:1.3rem;"><strong>+91-9354008027 / 1800-212-9001</strong></span>


                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-2">
                    <img src="<?php echo base_url()?>assets/images/law_mam35413651.png" alt="lawyer for consultation"
                        class="img-fluid">

                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="__average3543">
                        <div class="d-flex">
                            <div class="p-2 bd-highlight text-center ">
                                <img src="<?php echo base_url()?>assets/images/signature.png"
                                    alt="lawyer for consultation" class="img-fluid">

                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </section>
    <section>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#cbeffc" fill-opacity="1"
                d="M0,32L48,42.7C96,53,192,75,288,74.7C384,75,480,53,576,53.3C672,53,768,75,864,85.3C960,96,1056,96,1152,106.7C1248,117,1344,139,1392,149.3L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
            </path>
        </svg>
    </section>


    <section class=" ___curve_size bg-img  pb-5">
        <div class="for-borderpp">
            <div class="container hhff">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="base_  bold1 text-left">
                            <span
                                style="font-weight: 500;font-family: playfair display;"><?=$this->lang->line('virtue_cont');?>
                        </h4>
                        <h5 class="ari_3612356 mb-0 text-black"><?=$this->lang->line('ARISTOTLE_cont');?></h5>
                    </div>
                </div>
                <div class="container">
                    <div class="row pt-5">
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="<?=base_url()?>assets/images/cyber__56453.jpg"
                                    alt="lawyer for consultation" style="">
                                <div class=" shadow p-2">
                                    <div class="my_doc11">
                                        <div class="docu1 ">
                                            <div class="law_client">
                                                <div
                                                    class="hiw-content hiw-static d-flex align-items-center justify-content-between ">
                                                    <div class="tile-item">
                                                        <div class="icon-circle-box">
                                                            <div class="icon-circle">
                                                                <div class="bg-hiw_choose_your_required_icon"></div>
                                                            </div>
                                                        </div>
                                                        <div class="description _desk_head">
                                                            <h5 class="mb-0">
                                                                <?=$this->lang->line('cybercrimes_cont');?>
                                                            </h5>
                                                            <p class="pt-2  mb-0">
                                                                <?=$this->lang->line('how_to_cy_cont');?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <a href="<?=base_url()?>specialization/cyber-crimes" class="btn cyber_">
                                                    <?=$this->lang->line('view_more_cont');?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mobileSpace">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="<?=base_url()?>assets/images/cyber_family.jpg"
                                    alt="lawyer for consultation" style="">
                                <div class=" shadow p-2">
                                    <div class="my_doc11">
                                        <div class="docu1 ">
                                            <div class="law_client">
                                                <div
                                                    class="hiw-content hiw-static d-flex align-items-center justify-content-between ">
                                                    <div class="tile-item">
                                                        <div class="icon-circle-box">
                                                            <div class="icon-circle">
                                                                <div class="bg-hiw_choose_your_required_icon"></div>
                                                            </div>
                                                        </div>
                                                        <div class="description _desk_head">
                                                            <h5 class="  mb-0">
                                                                <?=$this->lang->line('family_law_cont');?>
                                                            </h5>
                                                            <p class="pt-2  mb-0">
                                                                <?=$this->lang->line('what_family_law_cont');?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <a href="<?=base_url()?>specialization/family-law-practice"
                                                    class="btn cyber_">
                                                    <?=$this->lang->line('view_more_cont');?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mobileSpace">
                            <div class="card">
                                <img class="card-img-top img-fluid"
                                    src="<?=base_url()?>assets/images/business_start.jpg"
                                    alt="online advocate consultation" style="">
                                <div class=" shadow p-2">
                                    <div class="my_doc11">
                                        <div class="docu1 ">
                                            <div class="law_client">
                                                <div
                                                    class="hiw-content hiw-static d-flex align-items-center justify-content-between ">
                                                    <div class="tile-item">
                                                        <div class="icon-circle-box">
                                                            <div class="icon-circle">
                                                                <div class="bg-hiw_choose_your_required_icon"></div>
                                                            </div>
                                                        </div>
                                                        <div class="description _desk_head ">
                                                            <h5 class="  mb-0">
                                                                <?=$this->lang->line('startup_cont');?>
                                                            </h5>
                                                            <p class="pt-2  mb-0">
                                                                <?=$this->lang->line('what_document_cont');?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <a href="<?=base_url()?>specialization/start-ups"
                                                    class="btn cyber_"><?=$this->lang->line('view_more_cont');?>
                                                </a>
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


    <!-- start top services section  -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <span>Our Documentation Services</span>
                        <h2>We Are Providing <span>Top Documentation Services</span> With Excellent Performance</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card">
                        <a href="<?php echo base_url('specialization/documentation/loans-agreements')?>">
                            <img src="<?php echo base_url()?>assets/images/service1.jpg" alt="Image">
                            <div class="text_services">
                                <h4>Loans <span> Agreements</span></h4>
                                <p>A Loan Agreement is a formal contract controlling the promises made by each party in
                                    a borrowing and lending relationship. It is a formal record that attests to a loan.
                                    A loan agreement may have a lending institution, friends, family, and other parties
                                    as parties.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <a href="<?php echo base_url('specialization/documentation/legal-recovery-notice')?>">
                            <img src="<?php echo base_url()?>assets/images/service2.jpg" alt="Image">
                            <div class="text_services">
                                <h4>Legal <span> Recovery Notice</span></h4>
                                <p>A legal recovery notice is a method of recovering money owed to someone. The person
                                    who owes the money can’t just decide to pay up, and neither can they just write them
                                    off as insolvent (that is, unable to pay debts). they have to take action in order
                                    to get their money. Depending on the circumstances, a legal recovery notice can be
                                    very effective in getting the money they are owed.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <a href="<?php echo base_url('specialization/documentation/website-development-agreement')?>">
                            <img src="<?php echo base_url()?>assets/images/service3.jpg" alt="Image">
                            <div class="text_services">
                                <h4>Website <span>agreement</span></h4>
                                <p>A contract for the development of one or more websites or web applications for a
                                    business is known as a "Website Development Contract." It reduces the scope of the
                                    services that the developer is required to provide or plans to provide to the
                                    business.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end top services section  -->


    <!-- contact us section  -->

    <!-- <section>
        <div class="container">
            <div class="row lawyerConnect ">
                <div class="col-md-12 ">
                    <div class="row">
                        <div class="col-md-12 pl-0 padunset">
                            <div class="lawyerConnect __lawyer456536">
                                <div class="content ">
                                    <h5 class="head-text111  mb-3"> <?=$this->lang->line('contact_menu');?> <span><a
                                                href="mailto:contact@insaaf99.com">contact@insaaf99.com</a></span>
                                    </h5>
                                    <p> <?=$this->lang->line('the_new_cont');?></p>
                                    <div class="fro-OOps_usudj">

                                        <i class="bi bi-bank"></i>
                                        <div class="bd-highlight __slot_inner mt-4">
                                        <a href="<?php echo base_url('login')?>" class="btn ">&nbsp; Book your Slot Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- contact us section end  -->

    <!-- testmonial section start   -->

    <section>
        <div class="for_fl_and_contespac">
            <div class="top_imgh_testmob">
                <img src="<?php echo base_url()?>assets/images/testmonial1.png" alt="">
            </div>

        </div>
        <div class="container for_Pldf_line">
            <div class="row">
                <div class="col-md-4">

                    <div class="inner-column">
                        <div class="sec-title">
                            <div class="title">Client’s Testimonials</div>
                            <h2>Know What they Say about Our Services.</h2>
                            <div class="text_testmonial">
                                <p>We provide the highest-quality advice and legal insight in resolving
                                    issues.</p>
                            </div>
                        </div>
                        <div class="button-box">
                            <a href="" class="theme-btn btn-style-seven"><i
                                    class="bi bi-person-heart for_icon_sect"></i>Testimonials</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-4 col-4">
                                        <div class="icon  flaticon-poetry"><i class="bi bi-pencil-square"></i></div>
                                        <img src="<?php echo base_url()?>assets/images/testmonial_ppl1.jpg"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="col-md-8 col-8">
                                        <div class="content">
                                            <span class="quote-icon flaticon-quote-left"><i
                                                    class="bi bi-quote"></i></span>
                                            <div class="text_reviewsd">
                                                <p>It was a great experience consulting on insaaf99. I call at wee hours
                                                    and
                                                    was able to speak to a learned lawyer; I am really impressed with
                                                    the
                                                    amazing 24/7 service where anyone can clarify their doubts about
                                                    their
                                                    legal consultation at any time.</p>
                                            </div>
                                            <div class="author-info">
                                                <span> Danish Khan</span> <br>
                                                <p>Digital marketing</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-4 col-4">
                                        <div class="icon  flaticon-poetry"><i class="bi bi-pencil-square"></i></div>
                                        <img src="<?php echo base_url()?>assets/images/testmonial_ppl2.jpg"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="col-md-8 col-8">
                                        <div class="content">
                                            <span class="quote-icon flaticon-quote-left"><i
                                                    class="bi bi-quote"></i></span>
                                            <div class="text_reviewsd">
                                                <p>Excellent online consultation and that too at any time. What amazing
                                                    technology! Now I have the app saved on my phone and I can call and
                                                    talk
                                                    to a lawyer at any time. I have already topped up my account with 60
                                                    minutes.</p>
                                            </div>
                                            <div class="author-info">
                                                <span>Yash</span> <br>
                                                <p>Designer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-4 col-4">
                                        <div class="icon  flaticon-poetry"><i class="bi bi-pencil-square"></i></div>
                                        <img src="<?php echo base_url()?>assets/images/testmonial_ppl3.jpg"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="col-md-8 col-8">
                                        <div class="content">
                                            <span class="quote-icon flaticon-quote-left"><i
                                                    class="bi bi-quote"></i></span>
                                            <div class="text_reviewsd">
                                                <p>I am super impressed with insaaf99 24/7 technology to talk to a
                                                    Lawyer. I
                                                    spoke to three lawyers on my issue and they are thoroughly
                                                    professional
                                                    and prompt. They provide me best way to come out through my problem.
                                                </p>
                                            </div>
                                            <div class="author-info">
                                                <span> Mansi Tyagi</span> <br>
                                                <p>Team leader</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="for-nex-pos-set">

                            <a class="carousel-control-prev" href="#carouselExampleControls2" role="button"
                                data-slide="prev">
                                <i class="bi bi-arrow-left-circle-fill __same325154"></i>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls2" role="button"
                                data-slide="next">
                                <i class="bi bi-arrow-right-circle-fill __same325154"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 codl_mt_for_test_monial">
                    <h2 class="mb-5">Client <b><span class="for_ckdj_test_monisl">Testimonials</span></b></h2>
                    

                    <div class="owl-carousel owl-theme owl-loaded owl-drag">

                        <div class="owl-stage-outer">

                            <div class="owl-stage"
                                style="transform: translate3d(-1527px, 0px, 0px); transition: all 0.25s ease 0s; width: 3334px;">

                                <div class="owl-item " style="width: 128.906px; margin-right: 10px;">
                                    <div class="item">
                                        <div class="testimonial">
                                            <p>It was a great experience consulting on insaaf99. I call at wee hours and
                                                was able to speak to a learned lawyer; I am really impressed with the
                                                amazing 24/7 service where anyone can clarify their doubts about their
                                                legal consultation at any time.</p>
                                        </div>
                                        <div class="media">
                                            <img src="<?php echo base_url()?>assets/images/defult_image.png"
                                                class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="overview">
                                                    <div class="name"><b>Danish Khan</b></div>
                                                    <div class="details">Web Developer / SoftBee</div>
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star-o"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="owl-item " style="width: 128.906px; margin-right: 10px;">
                                    <div class="item">
                                        <div class="testimonial">
                                            <p>Excellent online consultation and that too at any time. What amazing
                                                technology! Now I have the app saved on my phone and I can call and talk
                                                to a lawyer at any time. I have already topped up my account with 60
                                                minutes.</p>
                                        </div>
                                        <div class="media">
                                            <img src="<?php echo base_url()?>assets/images/user__icon1246578912.png"
                                                class="mr-3" alt="">
                                            <div class="media-body">
                                                <div class="overview">
                                                    <div class="name"><b>Mansi Tyagi </b></div>
                                                    <div class="details">Web Designer</div>
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star-o"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="owl-item " style="width: 128.906px; margin-right: 10px;">
                                    <div class="item">
                                        <div class="testimonial">
                                            <p>I am super impressed with insaaf99 24/7 technology to talk to a Lawyer. I
                                                spoke to three lawyers on my issue and they are thoroughly professional
                                                and prompt. They provide me best way to come out through my problem.</p>
                                        </div>
                                        <div class="media">
                                            <img src="<?php echo base_url()?>assets/images/user11.png" class="mr-3"
                                                alt="">
                                            <div class="media-body">
                                                <div class="overview">
                                                    <div class="name"><b>Elijha </b></div>
                                                    <div class="details">Tester </div>
                                                    <div class="star-rating">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                                            <li class="list-inline-item"><i class="fa fa-star-o"></i>
                                                            </li>
                                                        </ul>
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
    </section> -->




    <!-- End testmonial section  -->







    <section class="bg-imgag pt-3 bg-img  pb-5">
        <div class="for-borderpp">
            <div class="container hhff">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="base_  pt-5 bold1 text-center ">
                            <span style="font-weight: 500;font-family: playfair display;">
                                <?=$this->lang->line('letast_news_cont');?>
                        </h4>
                    </div>
                </div>
                <div class="container">
                    <div class="row pt-5">
                        <?php if(!empty($latest_news)){ foreach($latest_news as $news){?>
                        <div class="col-md-4 mobileSpace">
                            <div class="card">
                                <img class="card-img-top ___news_Card img-fluid"
                                    src="<?=base_url()?>uploads/news/<?=$news->image?>"
                                    alt="online consultation advocate" style="">
                                <div class="p-2">
                                    <div class="my_doc11">
                                        <div class="docu1 ">
                                            <div class="law_client">
                                                <div class="hiw-content hiw-static ">
                                                    <div class="tile-item">
                                                        <div class="icon-circle-box">
                                                            <div class="icon-circle">
                                                                <div class="bg-hiw_choose_your_required_icon"></div>
                                                            </div>
                                                        </div>
                                                        <div class="description _desk_head app">
                                                            <h5 class="mb-0 text-justify">
                                                                <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $news->news_cat_hi;
                                                                }else{
                                                                    echo $news->news_cat;
                                                                }?>
                                                            </h5>
                                                            <p class="pt-2  mb-0 DT">
                                                                <?=$news->adding_date?>
                                                            </p>
                                                            <div class="exp">
                                                                <p class="pt-2  mb-0 ">
                                                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $news->expert_hi;
                                                                }else{
                                                                    echo $news->expert;
                                                                }?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 ">
                                                <a href="<?=base_url()?>latest-news/<?=$news->slug_url?>"
                                                    class="btn cyber_"><?=$this->lang->line('view_more_cont');?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }}?>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight">
                        <div class="p-2 bd-highlight viewallnews"><a href="<?=base_url()?>all-news">&nbsp;Library <i
                                    class="bi bi-arrow-right"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Bg_towords _wp_law_pd d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12 paraColor text-center law_client">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme text-center mt-5">
                        <div class="item">
                            <img src="<?php echo base_url()?>assets/images/award_logo3.png"
                                alt="lawyers online consultation">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url()?>assets/images/award_logo2.png"
                                alt="lawyers online consultation">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url()?>assets/images/award_logo4.png"
                                alt="lawyers online consultation">
                        </div>
                        <div class="item">
                            <img src="<?php echo base_url()?>assets/images/award_logo1.png"
                                alt="lawyers online consultation">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> <!-- this div close mandatory -->
<!--Disclaimer start -->
<div id="myModal888" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content _height4544">
            <div class="modal-header">
                <h3> <?=$this->lang->line('click_dis_cont');?></h3>
            </div>
            <div class="modal-body _weight23">
                <p> <?=$this->lang->line('insaaf_dis_cont');?></p>
                <p> <?=$this->lang->line('insaaf_liable_dis_cont');?></p>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default _posi" data-dismiss="modal">Agree</button>
                <button type="button" class="btn  disagree">Disagree</button>

            </div>

        </div>
    </div>
    <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    })
    </script>

    <!-- tab verticle  -->


    <script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    </script>

    <!-- testmonial script  -->
    <script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true
    });
    </script>


    <!-- End ########################## -->