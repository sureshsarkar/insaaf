<style>
.expriences_2 p {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.expriences p {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    width: 182px;
}
</style>
<section class="upper_top">
    <div class="container">
        <div class="main_heading_lawyer_list">
            <h5>Talk to the Best Lawyer in India</h5>
        </div>
        <div class="row border_lawyer_list_2">

            <?php if(isset($lawyers) && !empty($lawyers)){
                foreach ($lawyers as $k => $v) {?>
            <div class="col-md-3 col-6 mt-4 mb-4">
                <div class="border_lawyer_list">
                    <a href="<?= base_url('lawyer-details?k='.base64_encode($v->id))?>">
                        <div class="lawyer_list_bg">
                            <div class="dis_flc div_2_block">
                                <div class="welcome_lawyer welcome_lawyer_2">
                                    <p><small>Welcome</small></p>
                                </div>
                                <div class="lawyer_img">
                                    <img src="<?=base_url()?><?php echo (!empty($v->image))?$v->image:"assets/images/mobilehome/sai.webp";?>"
                                        alt="">
                                    <div class="rating_layer rating_layer_2">
                                        <p>4.2</p>
                                        <img src="<?=base_url()?>assets/images/documents/star.webp" alt="">
                                    </div>
                                </div>
                                <div class="side_text_lawyer_list">
                                    <h4><?php echo $v->fname." ".$v->lname?></h4>

                                    <div class="expriences">
                                        <img src="<?=base_url()?>assets/images/mobilehome/translate.svg" alt="">
                                        <p><?php echo $v->language ?></p>
                                    </div>
                                    <div class="expriences">
                                        <img src="<?=base_url()?>assets/images/mobilehome/mortarboard.svg" alt="">
                                        <p><?php echo $v->experience ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                    <div class="back_prict_area">
                        <div class="expriences_2">
                            <img src="<?=base_url()?>assets/images/mobilehome/medal.png" alt="">
                            <p><?php echo $v->practice_area ?></p>
                        </div>
                    </div>
                    <div class="button_lawyer_list">
                        <a href="<?= base_url('legal-advice')?>"><img
                                src="<?=base_url()?>assets/images/mobilehome/bubble-chat.png" alt=""
                                class="list_chat_lawyer"></a>
                        <a href="<?= base_url('legal-advice')?>"><img
                                src="<?=base_url()?>assets/images/mobilehome/phone-call.png" alt=""></a>
                    </div>
                </div>
            </div>
            <?php }}else{?>
            <h3>No Lawyer available</h3>
            <?php }?>

        </div>
    </div>
</section>