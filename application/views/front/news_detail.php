<div id="allSet" class="marginCls_nes">
    <section>
        <div class="container-fluid newsCint">
            <div class="row">
                <div class="col-md-6 p-0 ">
                    <div class="_leftcontent _leftcontentnews texx_durl">
                        <h1 class="swing-top-fwd news_head_">
                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $news_detail->news_cat_hi;
                                }else{
                                    echo $news_detail->news_cat;
                                }?>
                        </h1>
                        <h4 class=" Our_talk">
                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $news_detail->expert_hi;
                                }else{
                                    echo $news_detail->expert;
                                }?>
                        </h4>

                        <p style="text-align: justify;">
                            <?=$news_detail->adding_date?>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="news__ pt-3">
                        <img src="<?=base_url()?>uploads/news/<?=$news_detail->image?>" class="img-fluid news_img_"
                            alt="<?=$news_detail->img_alt?>">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="_wp_law_pd mt-2" style="padding:40px 5px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 law_client">
                    <p>
                        <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $news_detail->descreption_hi;
                                }else{
                                    echo $news_detail->descreption;
                                }?>
                    </p>
                </div>
            </div>
        </div>
    </section>