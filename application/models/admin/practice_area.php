
<div id="allSet">
    <section class="_bg_content_2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12  p-0  text-end " style=" text-align: end;">
                    <div class="_leftcontent p-5 texx_durl">
                        <h1 class=""><?=$this->lang->line('our_specia_spcl')?></h1>
                        <h3 class=" Our_talk"><?=$this->lang->line('we_talk_about_cont')?></h3>
                        <div class="__slot_inner">
                            <a href="https://www.insaaf99.com/login" class="btn "> Book your Slot Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-0">
                    <marquee class="marque"><?=$this->lang->line('online_plt_cont')?></marquee>
                </div>
            </div>
        </div>
    </section>

    <section class="_wp_law_pd mt-5">
        <div class="container wrap_container">
            <div class="row">
                <div class="col-md-12  text-center paraColor law_client">
                    <h2 class=" we_offer"> <?=$this->lang->line('offer_a_spcl')?></h2>
                </div>
            </div>
            <?php pre($specialization_data);?>
            <?php if(isset($specialization_data) && !empty($specialization_data)){?>
            <div class="row pt-4">
                <?php foreach($specialization_data as $value){?>

                <div class="col-md-4 mt-2">
                    <div class="main_box_little">
                        <div class=" second_title pt-3">
                            <div class="img">
                                <a href="<?php echo base_url()?>specialization/<?=$value->slug?>"
                                    alt="online consultation advocate" class="zoomout">
                                    <img src="<?php echo base_url('uploads/specialization/').$value->banner_img?>" width="100%;"
                                        class="img-fluid zoom" alt="<?=$value->title?>">
                            </div>
                            <h3> 
                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->title_hi;
                            }else{
                                echo $value->title;
                            }
                         ?>
                            </h3>
                            <p class="practice-text">Read more</p></a>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <?php }else{?>
                <h1>No Data Found</h1>
            <?php }?>
        </div>
    </section>
</div>
</section>
</div>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="__footer3654365 slide-top text-center">
                    <a href="<?=base_url()?>login" class="btn ">
                        <h3><i class="bi bi-arrow-right"></i>&nbsp; <?=$this->lang->line('consult_menu')?></h3>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>