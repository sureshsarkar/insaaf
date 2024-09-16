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
                        <a href="#"><span>Specialization</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mar_tp_pp___2">
            <div class="col-md-12">
                <div class="spicalization_maim_headin">
                    <h2>Our Specialization</h2>
                    <p>We Offer A Client Focused Approach</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="_wp_law_pd mt-5 mb-4">
    <div class="container wrap_container">
        <?php if(isset($specialization_data) && !empty($specialization_data)){?>
        <div class="row pt-4">
            <?php foreach($specialization_data as $value){?>
            <div class="col-md-4 mt-2">
                <div class="main_box_little">
                    <div class=" second_title pt-3">
                        <div class="img">
                            <a href="<?php echo base_url()?>specialization/<?=$value->slug?>" class="zoomout">
                                <img src="<?php echo base_url('uploads/specialization/').$value->banner_img?>"
                                    width="100%;" class="img-fluid zoom" alt="<?=$value->img_alt?>">
                        </div>
                        <h3>
                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->title_hi;
                            }else{
                                echo $value->title;
                            }
                         ?>
                        </h3>
                        <p class="practice-text"><?=$this->lang->line('')?></p></a>
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