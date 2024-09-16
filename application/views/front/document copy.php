<style>
@media only screen and (min-width: 768px) and (max-width: 3000px) {

    .___index__consult,
    .__view_desktop,
    .for_document_step {
        display: block !important;
    }
}
</style>
<!-- <?php pre($details);?> -->
<div id="allSet">
    <section class="_bg_content_3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 forcenter_colm p-0">
                    <div class="_leftcontent">
                        <h1 class="">
                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $details->sub_sub_category_name_hi;
                            }else{
                                echo $details->sub_sub_category_name;
                            }?>
                            <h2 class=" Our_talk"><?=$this->lang->line('we_talk_about_cont');?></h2>
                            <!-- <div class="__para__about mt-2">
                                <h5 class="">A non-disclosure agreement (NDA) is a legal contract between two or more
                                    parties, where one party agrees to keep the confidential information shared by the
                                    other party secret.</h5>
                                <a href="#read_full">Read More</a>
                            </div> -->
                            <div class="__slot_inner mt-4">
                                <a href="<?=base_url()?>legal-advice"
                                    class="btn "><?=$this->lang->line('book_slot_menu');?></a>
                            </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="banner_ppc_imh">
                        <img src="<?php echo base_url()?>assets/images/documentation__inner.webp" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <?php  $res=getPrice($details->price,$details->discount,$details->gst); 
               $PriceData=json_decode($res);?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-0">
                    <marquee class="marque"><?=$this->lang->line('online_plt_cont');?></marquee>
                </div>
            </div>
        </div>
    </section>
    <!-- <div class="container" id="read_full">
        <div class="row">
            <div class="col-md-12">
                <div class="for_document_step mt-4">
                    <img src="<?php echo base_url()?>assets/images/documtation_steps.webp" alt="<?=$details->img_alt?>"
                        class="w-100">
                </div>
            </div>
        </div>
    </div> -->
    <section class="_wp_law_pd mt-5 pl-1 pr-1 pb-4">
        <div class="container-fluid">
            <div class="row p-3">
                <div class="col-md-12  col-lg-8 law_client   pr-4">
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
                    <!-- Add Classes start  -->
                    <?php 
                    $pageSegment =  $this->uri->segment(3);
                    if(isset($pageSegment) && $pageSegment == 'trademark'){
                        if(isset($details->classes) && !empty($details->classes)){
                            $classData = json_decode($details->classes);
                        ?>

                    <div class="accordion new_bg_class" id="accordionExample">
                        <h2 class="mt-2 text-center text-warning bgExtra">Check your Class Details</h2>
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
                    <?php }}?>

                    <!-- Add Classes end -->
                </div>

                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="__bg_payment document_css p-4" id="sideBar">
                        <h4 class="font700">
                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $details->sub_cat_name_hi;
                            }else{
                                echo $details->sub_cat_name;
                            }?>
                        </h4>
                        <div class="d-flex bd-highlight mt-4 __border_bottom">
                            <div class=" flex-grow-1 bd-highlight ___firstRow">
                                <h5>
                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $details->sub_sub_category_name_hi;
                            }else{
                                echo $details->sub_sub_category_name;
                            }?> </h5>
                            </div>
                            <div class=" bd-highlight ml-auto ___firstRow">
                                <h4 class=""> <del>₹<?=$details->price?></del></h4>
                                <span class="red"> (<?=$details->discount?>% Off) </span>
                                <span class="red">₹<?=$details->save_price?> Save</span>
                                <span style="font:25px; font-family: arial;">
                                    ₹<?=$details->price - $details->save_price?></span>
                                <p> <?=$details->exclusive?></p>
                            </div>
                        </div>
                        <div class="d-flex bd-highlight mt-4 __border_bottom">
                            <div class=" flex-grow-1 bd-highlight ___firstRow">
                                <h4><?=$this->lang->line('gst_price');?>(<?=$details->gst?>%)</h4>
                            </div>
                            <div class=" bd-highlight ml-auto ___firstRow">
                                <h4 class=""> ₹<?=$PriceData->gstPrice?></h4>
                            </div>
                        </div>
                        <div class="d-flex bd-highlight mt-4 __border_bottom">
                            <div class=" flex-grow-1 bd-highlight ___firstRow">
                                <h4><?=$this->lang->line('gross_documents');?></h4>
                            </div>
                            <div class=" bd-highlight ml-auto ___firstRow">
                                <h4 class=""> ₹<?=$PriceData->grossPrice?></h4>
                            </div>
                        </div>
                        <div class="d-flex bd-highlight mt-4">
                            <div class=" bd-highlight">
                                <img src="<?=base_url()?>assets/images/payment.webp" class="img-fluid" alt="payment">
                            </div>
                        </div>
                        <form action="<?=base_url()?>certificare/payment" method="post">
                            <div class="row pt-5">
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
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-0">
                    <div class="__footer3654365 slide-top text-center">
                        <a href="<?=base_url()?>legal-advice" class="btn ">
                            <h3><i class="bi bi-arrow-right"></i>&nbsp; <?=$this->lang->line('consult_menu');?></h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <script>
    $(document).ready(function() {
        $("#sideBar").stickySidebar({})
    })
    </script> -->