<?php 
 $seg  = $this->uri->segment(3);

?>

<section class="bg_us_images">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading_us">
                    <?php if(isset($seg) && !empty($seg)){?>
                    <?php if($seg =="partnership-firm"){?>
                    <h2>Up to 10% Off on Non-Disclosure Agreement Only with <mark>Insaaf99</mark></h2>
                    <?php }elseif($seg =="partnership"){?>
                    <?php }?>
                    <?php }?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="phera_us">
                    <?php if(isset($seg) && !empty($seg)){?>
                    <?php if($seg =="partnership-firm"){?>
                    <p>If you own a business or are planning to start one, there will be instances when you would need
                        to share your personal information with a third party. Put your troubles aside and concentrate
                        on your business with a <span>non-disclosure agreement.</span></p>
                    <?php }?>
                    <?php }?>
                    <div class="wp-block-ugb-icon-list ugb-icon-list ugb-06c0eed ugb-icon-list--v2 ugb-main-block">

                        <div class="ugb-inner-block">
                            <div class="ugb-block-content">
                                <h2 class="faq-heading">Our NDA Packages Includes</h2>
                                <ul>
                                    <li>Lorem ipsum dolor sit.</li>
                                    <li>Lorem ipsum dolor sit.dolor sit</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="pheragr_con_form">

                    <p>Submit your Details to get an <span> Instant All-inclusive</span> Quote to your email</p>
                </div>
                <div class="form_us_document">

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputName">Name</label>
                                <input type="text" class="form-control" id="inputName" placeholder="Ex- Mark jackob"
                                    required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputnumber">Number</label>
                                <input type="number" class="form-control" id="inputnumber"
                                    placeholder="Ex- +16504570138" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control" required>
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="btn_talk">

                                <button type="submit" class="btn btn-primary">Talk to a lawyer</button>
                            </div>
                            <div class="no_span">
                                <p><small>No Spam. No Sharing. 100% Confidentiality.</small></p>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
@media screen and (max-width:769px) {
    section.phone_section {
        display: none;
    }
}

@media only screen and (min-width: 768px) and (max-width: 3000px) {

    .___index__consult,
    .__view_desktop,
    .for_document_step {
        display: block !important;
    }
}

.mb-2 {
    margin-bottom: 20px;
}
</style>
<div id="allSet">
    <?php  $res=getPrice($details->price,$details->discount,$details->gst); 
               $PriceData=json_decode($res);?>


    <!-- rating and text sectuon  -->
    <section class="mb-2">
        <div class="container">
            <div class="row mar_tp_pp___2">
                <div class="col-md-8">
                    <div class="row ">
                        <div class="col-md-3 m_au_center">
                            <div class="product-number text-center">
                                <span class="number d-block font-60 color11">
                                    4.8
                                </span>
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
                                        src="<?php echo base_url()?>assets/images/documents/half_star.webp">
                                </div>
                                <span class="d-block font-14 font-weight-semi color11 m-t-5 totalReviewsDiv"
                                    style="cursor: pointer;">
                                    (108 reviews)
                                </span>
                            </div>
                        </div>
                        <div class="col-md-9 ">
                            <div class="ratings-title m-b-10">
                                <h1><?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $details->sub_sub_category_name_hi;
                            }else{
                                echo $details->sub_sub_category_name;
                            }?></h1>
                            </div>
                            <p>
                                <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $details->short_descreption_hi;
                            }else{
                                echo $details->short_descreption;
                            }?>
                            </p>
                            <p class="m_zero"> <img src="<?= base_url('assets/images/svg/check_mark.svg')?>" alt="">
                                3,500+ Insaaf99
                                verified experts</p>
                            <p class="m_zero"> <img src="<?= base_url('assets/images/svg/check_mark.svg')?>" alt="">
                                Senior Corporate
                                Lawyers with 30+ years of experience</p>
                            <div class="people-count d-flex align-items-center">
                                <div
                                    class="icon-circle border-radius-50p d-flex align-items-center justify-content-center">
                                    <img width="13" height="13" alt="Insaaf99 Rating and Reviews"
                                        src="<?php echo base_url()?>assets/images/svg/person-fill.svg">
                                </div>
                                <p class="font-18 font-weight-normal">
                                    <span class="font-20 font-weight-bold color1">345</span> People purchased
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="google_review">
                        <div class="google_icon">
                            <img src="<?=base_url()?>assets/images/us-page/google.png" alt="">
                        </div>
                        <div class="google_review_conrent">
                            <p><small>Google Reviews</small></p>
                            <div class="ratin_str">

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
                                        src="<?php echo base_url()?>assets/images/documents/half_star.webp">
                                </div>
                                <div class="show_rating">

                                    <p> ,4.8/5 <span>108+ Happy Customer</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="how_it_wor_docment">
                        <h3>How It Works</h3>
                        <div class="row">
                            <div class="col-md-3 ">
                                <div class="bg_how_it_work_inner">
                                    <div class="inner_imge_how_it_work">
                                        <img src="<?php echo base_url()?>assets/images/documents/file.webp" alt="">
                                    </div>
                                    <div class="inner_text_how_it_work">
                                        <h6>Step 1</h6>
                                        <p>Choose your required Document</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="bg_how_it_work_inner">
                                    <div class="inner_imge_how_it_work">
                                        <img src="<?php echo base_url()?>assets/images/documents/customer-service.webp"
                                            alt="">
                                    </div>
                                    <div class="inner_text_how_it_work">
                                        <h6>Step 2</h6>
                                        <p>Schedule Call with Lawyer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="bg_how_it_work_inner">
                                    <div class="inner_imge_how_it_work">
                                        <img src="<?php echo base_url()?>assets/images/documents/payment.webp" alt="">
                                    </div>
                                    <div class="inner_text_how_it_work">
                                        <h6>Step 3</h6>
                                        <p>Fill your required details & pay nominal fee</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <div class="bg_how_it_work_inner">
                                    <div class="inner_imge_how_it_work">
                                        <img src="<?php echo base_url()?>assets/images/documents/box.webp" alt="">
                                    </div>
                                    <div class="inner_text_how_it_work">
                                        <h6>Step 4</h6>
                                        <p>Delivery of your Document</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- maine_content__ start  -->
                    <div class="___clientbg">
                        <div class="descreption">
                            <p class="dex">
                                <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $details->descreption_hi;
                            }else{
                                echo $details->descreption;
                            }?>
                            </p>

                        </div>
                    </div>

                    <!-- End -->
                </div>
                <div class="col-md-4">
                    <div class="__bg_payment document_css p-2" id="sideBar">
                        <h4 class="font700">
                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $details->sub_cat_name_hi;
                            }else{
                                echo $details->sub_cat_name;
                            }?>
                        </h4>
                        <div class="__border_bottom">
                            <div class="d-flex bd-highlight mt-4 ">
                                <div class=" flex-grow-1 bd-highlight ___firstRow">
                                    <h5>
                                        <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $details->sub_sub_category_name_hi;
                            }else{
                                echo $details->sub_sub_category_name;
                            }?> </h5>
                                </div>
                                <div class=" bd-highlight ml-auto  ">
                                    <h4 class=""> <del>₹<?=$details->price?></del></h4>
                                </div>

                            </div>
                            <div class="next_line ___firstRow">
                                <span class="red"> (<?=$details->discount?>% Off) </span>
                                <span class="red">₹<?=$details->save_price?> Save</span>
                                <span style="font:25px; font-family: arial;">
                                    ₹<?=$details->price - $details->save_price?></span>
                                <p> <?=$details->exclusive?></p>
                            </div>
                        </div>
                        <div class="d-flex bd-highlight mt-2 __border_bottom">
                            <div class=" flex-grow-1 bd-highlight ___firstRow">
                                <h4><?=$this->lang->line('gst_price');?>(<?=$details->gst?>%)</h4>
                            </div>
                            <div class=" bd-highlight ml-auto ___firstRow">
                                <h4 class=""> ₹<?=$PriceData->gstPrice?></h4>
                            </div>
                        </div>
                        <div class="d-flex bd-highlight mt-2 __border_bottom">
                            <div class=" flex-grow-1 bd-highlight ___firstRow">
                                <h4><?=$this->lang->line('gross_documents');?></h4>
                            </div>
                            <div class=" bd-highlight ml-auto ___firstRow">
                                <h4 class=""> ₹<?=$PriceData->grossPrice?></h4>
                            </div>
                        </div>
                        <div class="deliverables-box">
                            <h4>
                                Deliverables <sup>*</sup>
                            </h4>
                            <div class="deliverable-data">
                                <p>a) Detailed Call with you to understand your specific requirements</p>

                                <p>b) Post delivery another call to ensure it meets all your requirements and final
                                    submissions.</p>

                            </div>
                        </div>

                        <div class="d-flex bd-highlight mt-4">
                            <div class=" bd-highlight">
                                <img src="<?=base_url()?>assets/images/payment.webp" class="img-fluid" alt="payment">
                            </div>
                        </div>
                        <form action="<?=base_url()?>certificare/payment" method="post">
                            <div class="row pt-4">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <input type="hidden" name="doc_id" value="<?=$details->id?>">
                                        <input type="hidden" name="sub_cat_name" value="<?=$details->sub_cat_name?>">
                                        <input type="hidden" name="sub_cat_name_hi"
                                            value="<?=$details->sub_cat_name_hi?>">
                                        <input type="hidden" name="sub_sub_category_name"
                                            value="<?=$details->sub_sub_category_name?>">
                                        <input type="hidden" name="sub_sub_category_name_hi"
                                            value="<?=$details->sub_sub_category_name_hi?>">
                                        <input type="hidden" name="price" value="<?=$details->price?>">
                                        <input type="hidden" name="discount" value="<?=$details->discount?>">
                                        <input type="hidden" name="save_price" value="<?=$details->save_price?>">
                                        <input type="hidden" name="gst" value="<?=$details->gst?>">
                                        <input type="hidden" name="gst_price" value="<?=$PriceData->gstPrice?>">
                                        <input type="hidden" name="gross_price" value="<?=$PriceData->grossPrice?>">
                                        <button type="submit"
                                            class="__order_now_pay btn"><?=$this->lang->line('request_documents');?></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>