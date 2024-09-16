<?php if(isset($blogDetails) && !empty($blogDetails)){?>
<section>
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="___main_news">
                                    <h2>
                                        <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $blogDetails->title_hi;
                                    }else{
                                        echo $blogDetails->title;
                                    }?>
                                    </h2>
                                    <!-- <h3>
                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $blogDetails->descreption_hi;
                                    }else{
                                        echo $blogDetails->descreption;
                                    }?>
                                </h3> -->
                                    <div class="___owner">
                                        <div class="d-flex align-items-center">
                                            <div class="">By</div>
                                            <div class=" ml-3 img_radius_">
                                                <?php if(isset($blogDetails->author_image) && !empty($blogDetails->author_image)){?>
                                                <img src="<?=base_url('uploads/blogs/').$blogDetails->author_image?>"
                                                    width="30">
                                                <?php }else{?>
                                                <img src="<?=base_url('assets/images/defult_image.png')?>" width="30">
                                                <?php }?>
                                            </div>
                                            <div class=" ml-3"><strong><?=$blogDetails->author_name?></strong></div>
                                            <div class="ml-3"><?=$blogDetails->dt?></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="main__Start">
                                    <img src="<?=base_url()?>uploads/blogs/<?=$blogDetails->image?>"
                                        class="img-fluid mt-3">

                                    <div class="insaaf_title_ttf mt-4 ">
                                        <p>
                                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $blogDetails->descreption_hi;
                                            }else{
                                                echo $blogDetails->descreption;
                                            }?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-4">
                        <div class="div_line5 mt-3">
                            <h2 class="jl-heading-text5 ">
                                Recent Post
                            </h2>

                        </div>


                        <?php if(isset($blogList) && !empty($blogList)){
                        foreach ($blogList as $key => $value) {
                        ?>
                        <div class="__right__side mt-3">
                            <a href="<?=base_url()?>student-corner/blog/<?=$value->slug_url?>">
                                <div class="d-flex flex-row">
                                    <div class="p-2">
                                        <img src="<?php echo base_url()?>uploads/blogs/<?=$value->image?>"
                                            class="img-fluid">
                                    </div>
                                    <div class="p-2 ___cateGories__Content">
                                        <p class="mb-0 underline1">Business</p>
                                        <h4><?=$value->title?></h4>
                                        <div class="d-flex flex-row ___Flex_row">
                                            <div class=""><?=$value->dt?></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php }}?>


                    </div> -->
                </div>
            </div>
        </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="Blg_heding">
                    <h2 class="faq-heading">Frequently Asked Questions</h2>
                </div>
                <div class="blog_fnq">
                    <div class="accordion" id="accordionExample">
                        <div class="card mb-2">
                            <div class="card-header card_bg_remov" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        Collapsible Group Item #1
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body card_bg_rem_op">
                                    Some placeholder content for the first accordion panel. This panel is shown by
                                    default, thanks to the <code>.show</code> class.
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header card_bg_remov" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Collapsible Group Item #2
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body card_bg_rem_op">
                                    Some placeholder content for the second accordion panel. This panel is hidden by
                                    default.
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header card_bg_remov" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        Collapsible Group Item #3
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body card_bg_rem_op">
                                    And lastly, the placeholder content for the third and final accordion panel. This
                                    panel is hidden by default.
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="Blg_heding">
                    <h2 class="faq-heading">Sheare Now</h2>
                </div>
                <div class="new_icon_blg">

                    <div class="d-flex justify-content-start ">
                        <div class="p-1 bd-highlight    bg_ho facebook  ____Only_mobile ">
                            <a href="https://www.facebook.com/insaaf99" target="_blank" rel="nofollow"><img
                                    src="http://localhost/web11/sarkar/insaaf99/assets/images/svg/facebook.svg"
                                    class="img-fluid" alt="facebook"></a>
                        </div>
                        <div class="p-1 bd-highlight instagram  bg_ho ____Only_mobile ">
                            <a href="https://www.instagram.com/insaaf_99" target="_blank" rel="nofollow"><img
                                    src="http://localhost/web11/sarkar/insaaf99/assets/images/svg/instagram.svg"
                                    class="img-fluid" alt="Instagram"></a>
                        </div>
                        <div class="p-1 bd-highlight linkedin bg_ho ____Only_mobile ">
                            <a href="https://www.linkedin.com/company/insaaf99/" target="_blank" rel="nofollow"><img
                                    src="http://localhost/web11/sarkar/insaaf99/assets/images/svg/linkedin.svg"
                                    class="img-fluid" alt="Linkedin"></a>
                        </div>
                        <div class="p-1 bd-highlight twiiter bg_ho ____Only_mobile  ">
                            <a href="https://twitter.com/insaaf_99" target="_blank" rel="nofollow"><img
                                    src="http://localhost/web11/sarkar/insaaf99/assets/images/svg/twitter.svg"
                                    class="img-fluid" alt="twitter"></a>
                        </div>
                        <div class="p-1 bd-highlight whats bg_ho ____Only_mobile  ">
                            <a href="https://api.whatsapp.com/send?phone=+919953536391&amp;text=Hi %0D%0A,%20Insaaf99%20https://insaaf99.com/ "
                                target="_blank"><img
                                    src="http://localhost/web11/sarkar/insaaf99/assets/images/svg/whatsapp.svg"
                                    class="img-fluid" alt="whatsapp">
                            </a>
                        </div>
                        <div class="p-1 bd-highlight youtube bg_ho ____Only_mobile  ">
                            <a href="https://www.youtube.com/@insaaf99" target="_blank"><img
                                    src="http://localhost/web11/sarkar/insaaf99/assets/images/svg/youtube.svg"
                                    class="img-fluid" alt="youtube">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="more_top__">
            <h2>More Top Stories</h2>
        </div>
        <div class="row">
            <?php if(isset($blogList) && !empty($blogList)){ 
                foreach ($blogList as $k => $v) {?>
            <div class="col-md-3">
                <a href="<?= base_url()?>student-corner/blog/<?=$v->slug_url?>" class="ancho_newcs">
                    <div class="card new_redic">
                        <img src="<?= base_url()?>uploads/blogs/<?=$v->image?>" class="d-block w-100"
                            alt="<?= $v->title?>">
                        <div class="card-body blog_new_cs">
                            <div class="innertext_blog new_wid_blog">
                                <h5 class="">
                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $v->title_hi;
                            }else{
                                echo $v->title;
                            }?></h5>
                                <span>
                                    <small>
                                        <img src="<?= base_url()?>uploads/blogs/<?=$v->author_image?>" class="d-block"
                                            alt="">
                                        <strong>Date: </strong> <?= date("d-M-y", strtotime($v->dt))?>
                                    </small>
                                </span>
                            </div>
                            <div class="dis_bolg new_wid_blog2">
                                <p>
                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $v->descreption_hi;
                            }else{
                                echo $v->descreption;
                            }?></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php }}?>
        </div>
    </div>
</section>
<?php }?>