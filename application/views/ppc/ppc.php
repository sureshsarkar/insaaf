<style>
.robotValue {
    width: 72px !important;
    margin: 0px;
}

@media (max-width:768px) {
    section.phone_section {
        display: none !important;
    }

    .___chat__online_ppc {
        margin-top: 0 !important;
    }

    .talk_lawyer_BG {
        margin-top: 10px;
        margin-bottom: 10px;
    }
}

@media only screen and (min-width:0px) and (max-width:768px) {
    .talk_to_lawyer_buton_2 {
        display: Block;
    }
}

@media only screen and (min-width:768px) and (max-width:3000px) {
    .talk_to_lawyer_buton_2 {
        display: none;
    }
}
</style>
<!-- Google Tag Manager -->
<script>
(function(w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
})(window, document, 'script', 'dataLayer', 'GTM-T8MWRN9');
</script><!-- End Google Tag Manager -->

<!-- Google Tag Manager (noscript) --><noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T8MWRN9"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-KZ098RXQ4W"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());
gtag('config', 'G-KZ098RXQ4W');
</script>




<!--Start third banner section  -->

<section>
    <div class="container-fluid">
        <div class="row p-4">
            <div class="col-md-6 m-auto">
                <div class="for_cont_pos_abos__">
                    <h1 class=" font-weight-extrabold m-0  lh-60 pt-2">
                        <?php echo (isset($_GET['keyword']) && !empty($_GET['keyword']))?ucwords($_GET['keyword']):"Online Legal Consultations!";?>
                    </h1>
                    <p><b>With Expert Lawyers -</b>
                        Family matters, Property, Agreements, Documentation, Partnership, Money Recovery, Cheque bounce,
                        Startup, Registrations, Trademark, Copyright, Legal opinion, Loans, Legal&nbsp;Notice,&nbsp;etc.
                    </p>
                </div>
                <div class="row p-0 pad_butn">
                    <div class="col-md-6 col-6">

                        <div class="talk_to_lawyer_buton">
                            <a href="#cll_talk_butn"><button><img src="<?=base_url()?>assets/images/ppc/telephone.png"
                                        alt="">Talk To Lawyer</button></a>
                        </div>
                        <div class="talk_to_lawyer_buton talk_to_lawyer_buton_2">
                            <a href="tel:1800-212-9001"><button><img
                                        src="<?=base_url()?>assets/images/ppc/telephone.png"
                                        alt="">1800-212-9001</button></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-6">
                        <div class="whatsapp_butn">
                            <a href="https://api.whatsapp.com/send?phone=919953536391&text=Hi" target="_blank"><button>
                                    <img src="<?=base_url()?>assets/images/ppc/whatsapp.png" alt="">
                                    Whatsapp</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 order_col">
                <div class="banner_ppc_imh">
                    <?php if(isset($_GET['type']) && !empty($_GET['type'])){
                        $get_data = trim($_GET['type']);
                      if($get_data == 'documentation'){
                        echo '<img src="'.base_url().'assets/images/ppc/documentation.png" alt="">';
                    }elseif($get_data == 'divorce'){
                          echo '<img src="'.base_url().'assets/images/ppc/divorce.png" alt="">';
                        
                      }
                      elseif($get_data == 'property'){
                        echo '<img src="'.base_url().'assets/images/ppc/property.png" alt="">';
                      
                    }else{
                        echo '<img src="'.base_url().'assets/images/ppc/defaultbanner.png" alt="">';
                      
                    }
                    }else{
                    ?>
                    <img src="<?=base_url()?>assets/images/ppc/defaultbanner.png" alt="">
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- third banner section End  -->



<!-- team a lawyer section  -->
<section>
    <div class="container bg_talk">
        <div class="row ">
            <div class="col-md-6">
                <a href="#cll_talk_butn">
                    <div class="talk_lawyer_BG">
                        <div class="talk_layer_icon">
                            <img src="<?=base_url()?>assets/images/ppc/telephone.png" alt="">
                        </div>
                        <div class="talk_lawyer_text">
                            <p>Talk To Lawyer</p>
                            <small>Legal ways to resolve</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <div class="talk_lawyer_BG">
                    <div class="d-flex align-items-center ___chat__online_ppc ___chat__online">
                        <div class="bd-highlight">
                            <img src="https://insaaf99.com/assets/images/chat/01.webp" class="img-fluid"
                                alt="Online Lawyer">
                            <img src="https://insaaf99.com/assets/images/chat/02.webp" class="img-fluid"
                                alt="Hire Lawyer">
                            <img src="https://insaaf99.com/assets/images/chat/03.webp" class="img-fluid"
                                alt="Consult A lawyer">

                        </div>
                        <div class="bd-highlight">
                            <span>&nbsp;+115 online lawyer </span>
                        </div>
                        <div class="bd-highlight ml-auto">
                            <div class="center1">
                                <div class="circle__pulse pulse1 green"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End team a lawyer section  -->
<!-- call new uaser page to show slot start -->
<?php
 $device = check_device();
 if(isset($device) && $device=='m'){
     $this->load->view('ppc/ppcmobile', '', '');
    }else{
     $this->load->view('front/new_user', '', '');
 }

?>
<!-- call new uaser page to show slot end -->

<section class="bg-light d-none">
    <div class="container">
        <div class="row">
            <div class="col-md-7  order-2">
                <div class="for_se_ppc_marp">
                    <div class="start_rating_ppc">
                        <p>4.3 <i class="bi bi-star-fill"></i></p>
                        <span> <small>1020 Rating </small> </span>
                    </div>
                    <div class="flc_ppcx">
                        <h3>Talk To Lawyer</h3>
                        <p>Quick & Instant Consultation</p>
                    </div>
                </div>
                <div class="for_mx_or_min_ppc">
                    <h3 class=" text-color-1 lh-30">On phone Instant Legal consultation from top Lawyers</h3>
                    <button class="btn">Legal Conssultation at just ₹99</button>
                </div>
                <div class="for_new_ppc_cnh_online">
                    <div class="__nex_ppc_dic">
                        <img src="<?=base_url()?>assets/images/ppc/call.gif" alt="">
                        <a href="tel:(+91-9953536391)">
                            <p>Call Now:-<br> <small>+91-9953536391</small></p>
                        </a>
                    </div>
                    <div class="__nex_ppc_dic">
                        <img src="<?=base_url()?>assets/images/ppc/website.gif" alt="">
                        <a href="<?=base_url()?>">
                            <p>Visit on:-<br> <small>www.insaaf99.com</small></p>
                        </a>
                    </div>
                </div>


                <!-- The Timeline -->
                <div class="bg_time_li">
                    <h2>How to talk to a Lawyer?</h2>
                    <p>It’s Just a simple three steps</p>

                    <ul class="timeline">
                        <!-- Item 1 -->
                        <li>
                            <div class="direction-r">
                                <div class="flag-wrapper">
                                    <span class="flag">Select Category</span>
                                    <span class="time-wrapper"><span class="time">Step1</span></span>
                                </div>
                                <div class="desc">Minutes you wants to talk</div>
                            </div>
                        </li>

                        <!-- Item 2 -->
                        <li>
                            <div class="direction-l">
                                <div class="flag-wrapper">
                                    <span class="flag">Pay</span>
                                    <span class="time-wrapper"><span class="time">Step2</span></span>
                                </div>
                                <div class="desc">Buy minutes</div>
                            </div>
                        </li>

                        <!-- Item 3 -->
                        <li>
                            <div class="direction-r">
                                <div class="flag-wrapper">
                                    <span class="flag">Meeting</span>
                                    <span class="time-wrapper"><span class="time">Step3</span></span>
                                </div>
                                <div class="desc">Accept meeting link</div>
                            </div>
                        </li>

                    </ul>
                </div>

                <div class="for_set_ne_test_ppc_cols mt-4">
                    <div class="for_sex_test_ppc mt-2 mb-4 text-bold">
                        <h3>What our customers are saying</h3>
                    </div>
                    <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="content">
                                            <span class="quote-icon flaticon-quote-left"><i
                                                    class="bi bi-quote"></i></span>
                                            <div class="text_reviewsd2">
                                                <p>It was a great experience consulting on insaaf99. I call at wee hours
                                                    and
                                                    was able to speak to a learned lawyer; I am really impressed with
                                                    the
                                                    amazing 24/7 service where anyone can clarify their doubts about
                                                    their
                                                    legal consultation at any time.</p>
                                            </div>
                                            <div class="author-info">
                                                <span> Danish Khan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">

                                    <div class="col-md-12 col-12">
                                        <div class="content">
                                            <span class="quote-icon flaticon-quote-left"><i
                                                    class="bi bi-quote"></i></span>
                                            <div class="text_reviewsd2">
                                                <p>Excellent online consultation and that too at any time. What amazing
                                                    technology! Now I have the app saved on my phone and I can call and
                                                    talk
                                                    to a lawyer at any time. I have already topped up my account with 60
                                                    minutes.</p>
                                            </div>
                                            <div class="author-info">
                                                <span>Yash</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">

                                    <div class="col-md-12 col-12">
                                        <div class="content">
                                            <span class="quote-icon flaticon-quote-left"><i
                                                    class="bi bi-quote"></i></span>
                                            <div class="text_reviewsd2">
                                                <p>I am super impressed with insaaf99 24/7 technology to talk to a
                                                    Lawyer. I
                                                    spoke to three lawyers on my issue and they are thoroughly
                                                    professional
                                                    and prompt. They provide me best way to come out through my problem.
                                                </p>
                                            </div>
                                            <div class="author-info">
                                                <span> Mansi Tyagi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="for-nex-pos-set2">

                            <a class="carousel-control-prev" href="#carouselExampleControls2" role="button"
                                data-slide="prev">
                                <i class="bi bi-arrow-left-circle-fill __same3251542"></i>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls2" role="button"
                                data-slide="next">
                                <i class="bi bi-arrow-right-circle-fill __same3251542"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 order-1">

                <div class="for_bf_colrd_ppc_price">
                    <div class="free_consltsi_ppc ">
                        <h5>15 Minutes</h5>
                        <a href="#">
                            <p>Rs 99 (Including GST)</p>
                        </a>
                        <img src="<?=base_url()?>assets/images/ppc/banner-coslt.jpg" alt="">

                        <!-- form div start  -->
                        <div class="for_frm for_bg_color_cont_us formCon ">
                            <form action="<?= base_url('talk-to-lawyer/submit')?>" id="submitForm" method="post">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="for_legalk_ad">
                                            <h4>GET EXPERT LEGAL ADVICE</h4>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <div class="form-group for_cnh_widj_sin_ppc">
                                                <label for="exampleFormControlInput1">Name</label>
                                                <input type="text" class="form-control cls_pls_ppc_smal name"
                                                    id="exampleFormControlInput1" placeholder="Enter your Name "
                                                    name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <div class="form-group for_cnh_widj_sin_ppc">
                                                <label for="exampleFormControlInput1">Email address</label>
                                                <input type="email" class="form-control cls_pls_ppc_smal email"
                                                    id="exampleFormControlInput1" placeholder="Enter your Email"
                                                    name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <div class="form-group for_cnh_widj_sin_ppc">
                                                <label for="exampleFormControlInput1">Enter mobile Number</label>
                                                <input type="text" class="form-control cls_pls_ppc_smal mobile"
                                                    id="exampleFormControlInput1" minlength="10" maxlength="10"
                                                    placeholder="Enter mobile number" name="mobile" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-0">
                                            <div class="form-group for_cnh_widj_sin_ppc">
                                                <label for="exampleFormControlSelect1"> Select Category</label>
                                                <select class="form-control select-css customselect category"
                                                    name="adtional[category]" id="exampleFormControlSelect1">
                                                    <option>Select Category</option>
                                                    <?php  if(isset($categoryList) && !empty($categoryList)){ 
                                                    foreach ($categoryList as $key => $value) { ?>
                                                    <option value="<?=$value->sub_sub_category_name?>">
                                                        <?=$value->sub_sub_category_name?></option>
                                                    <?php } }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group for_cnh_widj_sin_ppc">
                                                <label for="exampleFormControlSelect1">Select language</label>
                                                <select class="form-control select-css customselect language"
                                                    name="adtional[language]" id="language_id">
                                                    <option value="0">Select language</option>
                                                    <option value="English">English</option>
                                                    <option value="Hindi">Hindi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 p-0">
                                            <div class="form-group for_cnh_widj_sin_ppc">
                                                <div class="d-flex justify-content-center ">
                                                    <!-- <div class=""> -->
                                                    <div class="p-2 mt-3"><?=$v1?></div>
                                                    <div class="p-2 mt-3">+</div>
                                                    <div class="p-2 mt-3"><?=$v2?></div>
                                                    <div class="p-2 mt-3">=</div>
                                                    <!-- </div> -->
                                                    <div class="p-2">
                                                        <input type="number" name="robotValue" class="robotValue"
                                                            required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="for_send_buton_ppc">
                                                <input type="number" name="v1" class="v1 hidden" value="<?=$v1?>" />
                                                <input type="number" name="v2" class="v2 hidden" value="<?=$v2?>" />
                                                <input type="hidden" name="contact_type" value="PPC" />
                                                <button type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- form div end  -->
                        <!-- progress page -->
                        <div class="for_bg_color_cont_us  progressCon hidden">
                            <div class="row py-5">
                                <div class="col-md-12 text-center">
                                    <img src="<?= base_url('assets/images/progress.gif')?>" class="imgwidth">
                                    <br /><br />
                                    <p class="text-success">Sending....</p>

                                </div>
                            </div>
                        </div>
                        <!--end progress con -->
                    </div>
                    <div class="lawyer_conslt_ppc">
                        <img src="<?=base_url()?>assets/images/ppc/banner_lwr.png" alt="">
                        <button><a href="#">consult a lawyer <i class="bi bi-arrow-right-short"></i></a></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="adventages">
                <div class="block_heading">
                    <h2>Benefits</h2>
                </div>
                <div class="col-sm-12 col-md-12 advantage_margin">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="advantge_box">
                                        <i><img src="<?=base_url()?>assets/images/ppc/person_consult.png"
                                                alt="Consultation"></i>
                                        <h4>Online/Phone Legal Advice V/S In-Person Consultation</h4>
                                        <p>Saves your transportation cost, saves time, provide urgent solutions also
                                            convenient for busy clients, privacy maintained while discussing over phone
                                            and emails.

                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="advantge_box">
                                        <i><img src="<?=base_url()?>assets/images/ppc/process.png"
                                                alt="Less Running"></i>
                                        <h4>Less Running</h4>
                                        <p>This entire process is very fuzz-free one can gain advice over a short period
                                            without worrying about it much.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="advantge_box">
                                        <i><img src="<?=base_url()?>assets/images/ppc/advice_1.png"
                                                alt="Appropriate Advice"></i>
                                        <h4>Appropriate Advice</h4>
                                        <p>Our team of counsel has sound knowledge and would guide you according to your
                                            requirement.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="advantge_box">
                                        <i><img src="<?=base_url()?>assets/images/ppc/privacy.png"
                                                alt="Maintaining Confidentiality"></i>
                                        <h4>Maintaining Confidentiality</h4>
                                        <p>We maintain an end to end privacy concerning any of our clients and provide
                                            undisclosed service.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="advantge_box">
                                        <i><img src="<?=base_url()?>assets/images/ppc/nohidden_charges.png"
                                                alt="No hidden charges"></i>
                                        <h4>No hidden charges</h4>
                                        <p>There are no hidden charges levied.
                                        </p>
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

<!-- f and q section  -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block_heading">
                    <h2>Frequently Asked Questions (FAQs)</h2>
                </div>
                <div class="accordion" id="accordionExample">
                    <div class="card for_chng_bg_cor">
                        <div class="card-header for_bg_tsdpt" id="headingOne">
                            <h2 class="mb-0">
                                <button class="  btn-block text-left nex_alfted_cldjkfppc" type="button"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    What kinds of questions can I ask? <img
                                        src="<?=base_url()?>assets/images/svg/plus.svg" alt="">
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body for_mvn_cung_ppc">
                                You can ask about anything related to your legal situation, such as questions about a
                                specific process, documents or forms related to your legal matter, or about the meaning
                                of specific terms or phrases. You can also seek advice, strategic coaching, or insight
                                into possible outcomes.
                            </div>
                        </div>
                    </div>
                    <div class="card for_chng_bg_cor">
                        <div class="card-header for_bg_tsdpt" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="  btn-block text-left collapsed nex_alfted_cldjkfppc" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    How can I keep my identity private while asking questions?<img
                                        src="<?=base_url()?>assets/images/svg/plus.svg" alt="">
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionExample">
                            <div class="card-body for_mvn_cung_ppc">
                                Yes your identity would be kept confidential while asking any question. Lawyers who
                                answer your query may contact you to discuss your query in detail.
                            </div>
                        </div>
                    </div>
                    <div class="card for_chng_bg_cor">
                        <div class="card-header for_bg_tsdpt" id="headingThree">
                            <h2 class="mb-0">
                                <button class="  btn-block text-left collapsed nex_alfted_cldjkfppc" type="button"
                                    data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Are there any hidden involved for registration? <img
                                        src="<?=base_url()?>assets/images/svg/plus.svg" alt="">
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div class="card-body for_mvn_cung_ppc">
                                No, there are no extra charges we charge from our clients.
                            </div>
                        </div>
                    </div>
                    <div class="card for_chng_bg_cor">
                        <div class="card-header for_bg_tsdpt" id="headingFour">
                            <h2 class="mb-0">
                                <button class="  btn-block text-left collapsed nex_alfted_cldjkfppc" type="button"
                                    data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                    aria-controls="collapseFour">
                                    Is the physical presence required of the person? <img
                                        src="<?=base_url()?>assets/images/svg/plus.svg" alt="">
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                            data-parent="#accordionExample">
                            <div class="card-body for_mvn_cung_ppc">
                                The whole process is online. So, a person needn’t go anywhere to register it. You are
                                required to send in your documents via email and fill up our questionnaire to get it
                                done.

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- End  -->

<!-- service stction  -->
<section class="mt-8">
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
                        <img src="<?php echo base_url()?>assets/images/service1.jpg" class="img-fluid" alt="Image">
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
                        <img src="<?php echo base_url()?>assets/images/service2.jpg" class="img-fluid" alt="Image">
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
                        <img src="<?php echo base_url()?>assets/images/service3.jpg" class="img-fluid" alt="Image">
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

<section>
    <div class="talk_to_lawyer_btnd hidden">
        <button class="_btnTalk"><img src="<?=base_url()?>assets/images/ppc/telephone.png" alt="">Talk To
            Lawyer</button>
    </div>
</section>

<script>
$(document).ready(function() {
    $("#submitForm").submit(function() {

        var name = $('.name').val();
        var email = $('.email').val();
        var mobile = $('.mobile').val();
        var category = $('.category').val();
        var language = $('.language').val();

        var v1 = parseInt($('.v1').val());
        var v2 = parseInt($('.v2').val());
        var robotValue = $('.robotValue').val();

        if (robotValue != v1 + v2) {
            alert("Sum is not correct!");
            return false;
        }
        if (language != '' && email != '' && mobile != '' && category != '' && language != '') {
            $(".for_bg_color_cont_us").addClass('hidden');
            $(".progressCon").removeClass('hidden');
        } else {
            alert("Please fill the form correctly !");
        }
    })


    $(".mobile").keyup(function() {
        var mobile = $(".mobile").val();
        if (mobile.length == 1 && mobile == '0') {
            var value = '';
            $(".mobile").val(value);
        } else {
            var value = mobile.replace(/[^0-9]/g, "");
            $(this).val(value);
        }
    })


    var $logo = $('.talk_to_lawyer_btnd');
    $(document).scroll(function() {
        if ($(this).scrollTop() > 200) { //alert("scop");
            $('.talk_to_lawyer_btnd').removeClass("hidden");
        } else {
            $('.talk_to_lawyer_btnd').addClass("hidden");
        }

    });

    // $(document).scroll(function() {
    //     $('.talk_to_lawyer_btnd').removeClass("removeClass");
    // });


});
</script>
<!-- End  -->