<?php 
if(isset($blogList) && !empty($blogList)){?>
<section class="all__top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 p-0 mb-3 mt-3">
                <div class="d-flex flex-row align-items-center">
                    <div class="p-2">
                        <h2 class="jl-heading-text4"> Top New </h2>
                    </div>
                    <!-- <div class="p-2 __toparea">I Thought I’d Found a Cheat Code for Parenting</div>
                    <div class="p-2 __toparea colColor">JULY 29, 2022</div> -->
                    <div class="p-2 ml-auto _start53135643">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                        <i class="bi bi-star"></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<section class="height_first_div">
    <div class="container">
        <div class="row">
            <div class="col-md-7 p-0 padd">
                <a href="<?=base_url()?>student-corner/blog/<?=$blogList[0]->slug_url?>">
                    <img src="<?php echo base_url()?>uploads/blogs/<?=$blogList[0]->image?>" class="img-fluid">
                    <div class="bottom-left __content">
                        <div class="badge">
                            <!-- <p>Business</p> -->
                        </div>
                        <h3><?=$blogList[0]->title?></h3>
                    </div>
                </a>
            </div>

            <div class="col-md-5 p-0 __right_base padd">
                <div class="row">
                    <a href="<?=base_url()?>student-corner/blog/<?=$blogList[0]->slug_url?>">
                        <div class="col-md-12 p-0 base-topmob padd">
                            <img src="<?php echo base_url()?>uploads/blogs/<?=$blogList[0]->image?>"
                                class="img-fluid">
                            <div class="bottom-left2 __content2">
                                <div class="badge">
                                </div>
                                <h3><?=$blogList[0]->title?></h3>
                            </div>
                        </div>
                    </a>
                    <a href="<?=base_url()?>student-corner/blog/<?=$blogList[0]->slug_url?>">
                        <div class="col-md-12 p-0 padd __right_base  base-top">
                            <img src="<?php echo base_url()?>uploads/blogs/<?=$blogList[0]->image?>"
                                class="img-fluid">
                            <div class="bottom-left __content3">
                                <div class="badge">
                                </div>
                                <h3><?=$blogList[0]->title?></h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
</section>


<section class="height_second_div">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 pl-0 pad1241478 ">
                <div class="div_line">
                    <h2 class="jl-heading-text">
                        More Top Stories
                    </h2>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <a href="<?=base_url()?>student-corner/blog/<?=$blogList[0]->slug_url?>">
                        <img src="<?php echo base_url()?>uploads/blogs/<?=$blogList[0]->image?>"class="img-fluid">
                            
                        <div class="__blog_content pt-3">
                            <h4><?=$blogList[0]->title?></h4>
                            </a>
                            <p><?=$blogList[0]->descreption?></p>
                        </div>

                        <div class="___owner mb-3">
                            <div class="d-flex flex-row">
                                <div class="">By</div>
                                <div class=" ml-3"><strong><?=$blogList[0]->author_name?></strong></div>
                                <div class="ml-3"><?=$blogList[0]->dt?></div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <?php
                       foreach ($blogList as $key => $value) {?>
                        <div class="__right__side">
                            <a href="<?=base_url()?>student-corner/blog/<?=$value->slug_url?>">
                                <div class="d-flex flex-row">
                                    <div class="p-2">
                                        <img src="<?=base_url()?>uploads/blogs/<?=$value->image?>" class="img-fluid">
                                    </div>
                                    <div class="p-2 ___cateGories__Content">
                                        <!-- <p class="mb-0 underline1">Business</p> -->
                                        <h4><?=$value->title?></h4>
                                        <div class="d-flex flex-row ___Flex_row">
                                            <div class=""><?=$value->dt?></div>
                                            <!-- <div class="">&nbsp;&nbsp;2022</div> -->
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php }?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="div_line3">
                            <h2 class="jl-heading-text3">
                                More Top Stories
                            </h2>
                        </div>
                        <div class="row mt-4">
                            <?php if(isset($blogList[1]) && !empty($blogList[1])){?>
                            <div class="col-md-6 col-xs-12">
                                <div class="__actNew">
                                    <a href="<?=base_url()?>student-corner/blog/<?=$blogList[1]->slug_url?>">
                                    <img src="<?php echo base_url()?>uploads/blogs/<?=$blogList[1]->image?>"
                                        class="img-fluid">

                                    <div class="__conNext">
                                        <div class="__blog_content pt-3">
                                        <h4><?=$blogList[1]->title?></h4>
                                        </a>
                                        <p><?=$blogList[1]->descreption?></p>
                                        </div>
                                        <div class="___owner">
                                            <div class="d-flex flex-row">
                                                <div class="">By</div>
                                                <div class=" ml-3"><strong><?=$blogList[1]->author_name	?></strong></div>
                                                <div class="ml-3"><?=$blogList[1]->dt?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php }?>
                            <?php if(isset($blogList[2]) && !empty($blogList[2])){?>
                            <div class="col-md-6 col-xs-12">
                                <div class="__actNew">
                                <a href="<?=base_url()?>student-corner/blog/<?=$blogList[2]->slug_url?>">
                                    <img src="<?php echo base_url()?>uploads/blogs/<?=$blogList[2]->image?>" class="img-fluid">

                                    <div class="__conNext">
                                        <div class="__blog_content pt-3">
                                        <h4><?=$blogList[2]->title?></h4>
                                        </a>
                                        <p><?=$blogList[2]->descreption?></p>
                                        </div>
                                        <div class="___owner">
                                            <div class="d-flex flex-row">
                                                <div class="">By</div>
                                                <div class=" ml-3"><strong><?=$blogList[2]->author_name	?></strong></div>
                                                <div class="ml-3"><?=$blogList[2]->dt?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>

            </div>
            <!-- sticky2 fixedLeftCol -->
            <div class="col-md-4  mb-4114">
                <div class="_Frame_Take ">
                    <a href="https://www.facebook.com/insaaf99" target="_blank"><i
                            class=" fa bi bi-facebook  _fake">&nbsp;&nbsp;facebook</i></a>
                    <a href="https://twitter.com/insaaf_99" target="_blank"><i
                            class=" fa bi bi-twitter _twitter">&nbsp;&nbsp;Twitter</i></a>
                    <a href="https://www.linkedin.com/company/insaaf99" target="_blank"><i
                            class=" fa bi bi-linkedin _linkedin">&nbsp;&nbsp;Linkedin</i></a>
                    <a href="https://www.youtube.com/@insaaf99" target="_blank"><i class=" fa bi bi-youtube _youtube">&nbsp;&nbsp;You
                            Tube</i></a>
                    <a href="https://www.instagram.com/insaaf_99" target="_blank"><i
                            class=" fa bi bi-instagram _insta">&nbsp;&nbsp;Instagram</i></a>
                    <a
                        href="https://api.whatsapp.com/send?phone=+919354008027&text=Hi%20%0D%0A,%20Insaaf99%20https://insaaf99.com" target="_blank"><i
                            class=" fa bi bi-whatsapp whats2">&nbsp;&nbsp;WhatsApp</i></a>

                </div>
                <div class="div_line2">
                    <h2 class="jl-heading-text2 ">
                        Trending Now
                    </h2>

                </div>

                <?php if(isset($TreandBlogList) && !empty($TreandBlogList)){
                foreach ($TreandBlogList as $key => $value) {?>
                <div class="__right__side mt-3">
                <a href="<?=base_url()?>student-corner/blog/<?=$value->slug_url?>">
                        <div class="d-flex flex-row">
                            <div class="p-2">
                                <img src="<?=base_url()?>uploads/blogs/<?=$value->image?>" class="img-fluid">
                            </div>
                            <div class="p-2 ___cateGories__Content">
                                <!-- <p class="mb-0 underline1">Business</p> -->
                                <h4><?=$value->title?></h4>
                                <div class="d-flex flex-row ___Flex_row">
                                    <div class=""><?=$value->dt?></div>
                                    <!-- <div class="">&nbsp;&nbsp;2022</div> -->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php }}?>
            </div>
        </div>
    </div>
</section>
<?php if(isset($TreandBlogList) && !empty($TreandBlogList)){?>
<section>
    <div class="container">
        <div class="row mt-4 mb-5 ">
            <div class="col-md-6  p-0 __imortants_bg">
                <div class="__imortants ">
                    <h2><?=$TreandBlogList[0]->title?></h2>
                    <div class="___owner">
                        <div class="d-flex flex-row">
                            <div class="">By</div>
                            <div class=" ml-3"><strong><?=$TreandBlogList[0]->author_name?></strong></div>
                            <div class="ml-3"><?=$TreandBlogList[0]->dt?></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 p-0 ">
                <a href="<?=base_url()?>student-corner/blog/<?=$TreandBlogList[0]->slug_url?>">
                    <img src="<?php echo base_url()?>uploads/blogs/<?=$TreandBlogList[0]->image?>" class="img-fluid last_img__">
                </a>
            </div>
        </div>
    </div>
</section>

<?php }}?>



<!--     <script>
    $(document).ready(function() {
        let sticky2 = $('.sticky2');
        let sticky2_hight = $(".sticky2").height()
        let height_first_div = $(".height_first_div").height()
        let height_second_div = $(".height_second_div").height()
        let total_hight = height_first_div + height_second_div-sticky2_hight;
        $(window).scroll(function() {
            sticky2.css('display','block');
            var scroll2 = $(window).scrollTop();
            var height = $("body").height();

            if (scroll2 >= height_first_div) sticky2.addClass('fixedLeftCol');
            else sticky2.removeClass('fixedLeftCol');

            if ((total_hight) < scroll2) sticky2.removeClass('fixedLeftCol');


        });
    });
    </script> -->