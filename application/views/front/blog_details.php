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
                </div>
            </div>
        </div>
</section>
<?php
$fqData  =json_decode($blogDetails->fqData);
if(isset($fqData) && !empty($fqData)){?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="blog_hneding">
                    <h2 class="faq-heading">Frequently Asked Questions</h2>
                </div>
                <div class="blog_fnq">
                    <div class="accordion" id="accordionExample">

                        <?php
                            foreach ($fqData as $key => $value) {
                        ?>
                        <div class="card mb-2">
                            <div class="card-header card_bg_remov" id="<?= $key?>">
                                <h2 class="mb-0 d-flex">
                                    <button class="btn btn-link btn-block text-left my_cls_space_blg" type="button"
                                        data-toggle="collapse" data-target="#<?= $key+1?>" aria-expanded="true"
                                        aria-controls="<?= $key+1?>">
                                        <?= $value->fqTitle; ?><img
                                            src="<?= base_url()?>assets/images/svg/chevron-down.svg" alt="">
                                    </button>

                                </h2>
                            </div>

                            <div id="<?= $key+1?>" class="collapse" aria-laDelledby="<?= $key?>"
                                data-parent="#accordionExample">
                                <div class="card-body card_bg_rem_op">
                                    <?= $value->fqDescription; ?>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php }?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="blog_hneding">
                    <h2 class="faq-heading">Share Now</h2>
                </div>
                <div class="socialmedia_icon_blg new_icon_blg">
                    <div class="d-flex justify-content-start">
                        <div class="p-1 bd-highlight    bg_ho facebook  ____Only_mobile ">
                            <a href="https://www.facebook.com/share.php?u=https://insaaf99.com/student-corner/blog/<?= $blogDetails->slug_url?>"
                                target="_blank" rel="nofollow">
                                <img src="<?= base_url()?>assets/images/svg/facebook.svg" class="img-fluid"
                                    alt="facebook">
                            </a>
                        </div>
                        <!-- <div class="p-1 bd-highlight instagram  bg_ho ____Only_mobile ">
                            <a href="#" target="_blank" rel="nofollow">
                                <img src="<?= base_url()?>assets/images/svg/instagram.svg" class="img-fluid"
                                    alt="Instagram">
                            </a>
                        </div> -->
                        <div class="p-1 bd-highlight linkedin bg_ho ____Only_mobile ">
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://insaaf99.com/student-corner/blog/<?= $blogDetails->slug_url?>&title=<?= $blogDetails->title?>"
                                target="_blank" rel="nofollow">
                                <img src="<?= base_url()?>assets/images/svg/linkedin.svg" class="img-fluid"
                                    alt="Linkedin">
                            </a>
                        </div>
                        <div class="p-1 bd-highlight twiiter bg_ho ____Only_mobile  ">
                            <a href="https://twitter.com/intent/tweet?mini=true&url=https://insaaf99.com/student-corner/blog/<?= $blogDetails->slug_url?>&text=<?= $blogDetails->title?>&hashtags=#PHP"
                                target="_blank" rel="nofollow">
                                <img src="<?= base_url()?>assets/images/svg/twitter.svg" class="img-fluid"
                                    alt="twitter">
                            </a>
                        </div>
                        <div class="p-1 bd-highlight whats bg_ho ____Only_mobile  ">
                            <a href="https://api.whatsapp.com/send?text=<?php urlencode('Hi Hello')?> https://insaaf99.com/student-corner/blog/<?= $blogDetails->slug_url?>"
                                target="_blank">
                                <img src="<?= base_url()?>assets/images/svg/whatsapp.svg" class="img-fluid"
                                    alt="whatsapp">
                            </a>
                        </div>
                        <!-- <div class="p-1 bd-highlight youtube bg_ho ____Only_mobile  ">
                            <a href="#" target="_blank">
                                <img src="<?= base_url()?>assets/images/svg/youtube.svg" class="img-fluid"
                                    alt="youtube">
                            </a>
                        </div> -->
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