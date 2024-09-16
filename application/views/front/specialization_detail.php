<section class="bg__gry_documents">
    <div class="container">
        <div class="row mar_tp_pp___">
            <div class="col-md-12 p-0">
                <ul class="m-0 p-0 d-flex align-items-center list-unstyled list_style">
                    <li class="m-r-10">
                        <a href="<?= base_url()?>"><span>Home</span></a>
                    </li>
                    <li><img src="<?php echo base_url()?>assets/images/svg/chevron-right.svg" alt=""></li>
                    <li class="m-r-10">
                        <a href="<?= base_url('specialization')?>"><span>Specialization</span></a>
                    </li>
                    <li><img src="<?php echo base_url()?>assets/images/svg/chevron-right.svg" alt=""></li>
                    <li class="m-r-10">
                        <a href="#"><span> <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $specialization_detali->title_hi;
                            }else{
                                echo $specialization_detali->title;
                            }
                         ?></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="_wp_law_pd" style="padding:40px 5px;">
    <div class="container">
        <div class="row mar_tp_pp___2">
            <div class="col-md-10 law_client">
                <h4 class="base_">
                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $specialization_detali->title_hi;
                            }else{
                                echo $specialization_detali->title;
                            }
                         ?>
                </h4>
                <p style="text-align: justify;">
                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $specialization_detali->descreption_hi;
                            }else{
                                echo $specialization_detali->description;
                            }
                         ?>
                </p>
            </div>
            <div class="col-md-2">
                <div class="images_spc">
                    <a href="<?=base_url('legal-advice')?>"><img src="<?=base_url('assets/images/ads_img.webp')?>"
                            alt="" class="w-100" /></a>
                </div>
            </div>
        </div>
    </div>
</section>