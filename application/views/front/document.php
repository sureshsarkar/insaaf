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
    <section class="bg__gry_documents">
        <div class="container  ">
            <div class="row mar_tp_pp___">
                <div class="col-md-12 p-0">
                    <ul class="m-0 p-0 d-flex align-items-center list-unstyled list_style">
                        <li class="m-r-10">
                            <a href="<?= base_url()?>"><span>Home</span></a>
                        </li>
                        <li><img src="<?php echo base_url()?>assets/images/svg/chevron-right.svg" alt=""></li>
                        <li class="m-r-10">
                            <a href="<?= base_url('all-services')?>"><span>Document</span></a>
                        </li>
                        <li> <img src="<?php echo base_url()?>assets/images/svg/chevron-right.svg" alt=""></li>

                        <li class="m-r-10">

                            <span><?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $details->sub_sub_category_name_hi;
                            }else{
                                echo $details->sub_sub_category_name;
                            }?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

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

                    <!-- Add Classes start  -->
                    <?php 
                    // $pageSegment =  $this->uri->segment(3);
                    // if(isset($pageSegment) && $pageSegment == 'trademark'){
                        if(isset($details->classes) && !empty($details->classes)){
                            $classData = json_decode($details->classes);
                        ?>

                    <div class="accordion new_bg_class" id="accordionExample">
                        <!-- <h2 class="mt-2 text-center text-warning bgExtra">Check your Class Details</h2> -->
                        <?php foreach ($classData as $k => $v) {?>
                        <div class="card bg_card_clas">
                            <div class="card-header card_hed_extrnalcss" id="<?= $k;?>">
                                <h2 class="mb-0">
                                    <button class="btn btn-link w-100" type="button" data-toggle="collapse"
                                        data-target="#<?= $k+1;?>" aria-expanded="true" aria-controls="<?= $k+1?>">
                                        <?= $v->class?>
                                    </button>
                                </h2>
                            </div>

                            <div id="<?= $k+1?>" class="collapse" aria-labelledby="<?= $k;?>"
                                data-parent="#accordionExample">
                                <div class="card-body card_inner_textextrncss">
                                    <?= $v->classDescreption?>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <?php }?>

                    <!-- Add Classes end -->
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
                                        }?>
                                    </h5>
                                </div>
                                <div class=" bd-highlight ml-auto  ">
                                    <h4 class=""> <del>₹<?=$details->price?></del></h4>
                                </div>

                            </div>
                            <div class="next_line ___firstRow">
                                <span class="red" style="float: left;"> Get (<?=$details->discount?>% Off) &nbsp;
                                </span>
                                <span class="red" style="float: left;">Save ₹<?=$details->save_price?> </span>
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