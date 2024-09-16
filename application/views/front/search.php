<section>
    <div class="container">
        <div class="main_hed">
            <h4>Searching Results</h4>
        </div>
        <div class="row mt-4 ">
            <div class="col-md-12">
                <?php
            if(isset($SearchNewsData) || isset($SearchActData) || isset($SearchDocData) || isset($SearchDecsData)){
            
            if(isset($SearchNewsData) && !empty($SearchNewsData)){?>
                <h5 class="text-primary"><?=$newspage?></h5>

                <div class="row mt-4 ">
                    <?php
                foreach ($SearchNewsData as $key => $value) {?>
                    <div class="col-md-4">
                        <div class="card_search">
                            <div class="card_heading_search">
                                <h5><?= $value->news_cat?></h5>
                            </div>
                            <div class="card_dis_search">
                                <a href="<?= $value->meta_url?>">
                                    <p><?php echo $hightLightText = textHighLight($value->news_cat,$search); ?></p>
                                    <span>Read More <img src="<?=base_url()?>assets/images/svg/arrow-right-short.svg"
                                            class="img-fluid" alt="rightarrow"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <?php }?>

                <?php
            if(isset($SearchActData) && !empty($SearchActData)){?>
                <h5 class="text-primary"><?=$actpage?></h5>
                <div class="row mt-4 ">
                    <?php
                     foreach ($SearchActData as $key => $value) {?>
                    <div class="col-md-4">
                        <div class="card_search">
                            <div class="card_heading_search">
                                <h5><?= $value->title?></h5>
                            </div>
                            <div class="card_dis_search">
                                <a href="<?= $value->meta_url?>">
                                    <p><?php echo $hightLightText = textHighLight($value->title,$search); ?></p>
                                    <span>Read More <img src="<?=base_url()?>assets/images/svg/arrow-right-short.svg"
                                            class="img-fluid" alt="rightarrow"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <?php }?>
                <?php
            if(isset($SearchDocData) && !empty($SearchDocData)){?>
                <h5 class="text-primary"><?=$documentpage?></h5>
                <div class="row mt-4 ">
                    <?php
                     foreach ($SearchDocData as $key => $value) {?>
                    <div class="col-md-4">
                        <div class="card_search">
                            <div class="card_heading_search">
                                <h5><?= $value->title?></h5>
                            </div>
                            <div class="card_dis_search">
                                <a href="<?= $value->meta_url?>">
                                    <p><?php echo $hightLightText = textHighLight($value->ctitle,$search); ?></p>
                                    <p><?php echo $hightLightText = textHighLight($value->sctitle,$search); ?></p>
                                    <p><?php echo $hightLightText = textHighLight($value->title,$search); ?></p>
                                    <span>Read More <img src="<?=base_url()?>assets/images/svg/arrow-right-short.svg"
                                            class="img-fluid" alt="rightarrow">
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <?php }?>
                <?php
            if(isset($SearchDecsData) && !empty($SearchDecsData)){?>
                <h5 class="text-primary"><?=$dictionarypage?></h5>
                <div class="row mt-4 ">
                    <?php
                     foreach ($SearchDecsData as $key => $value) {?>
                    <div class="col-md-4 card_dis_search">
                        <a href="<?= base_url('student-corner/dictionay#'.$value->meta_url)?>">
                            <div class="card_search">
                                <div class="card_heading_search">
                                    <h5><?= $value->descreption?></h5>
                                </div>
                                <div class="card_dis_search">
                                    <p><?php echo $hightLightText = textHighLight($value->descreption,$search); ?></p>
                                    <span>Read More <img src="<?=base_url()?>assets/images/svg/arrow-right-short.svg"
                                            class="img-fluid" alt="rightarrow"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php }?>
                </div>
                <?php }?>
                <?php }?>
            </div>
        </div>
    </div>
</section>