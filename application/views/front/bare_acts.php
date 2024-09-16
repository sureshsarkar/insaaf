<section>
    <div class="container mb-5">
        <div class="doe_chdngd_basdj_br_act mar_tp_pp___">
            <div class="and_somedesi">
                <h1><?=$this->lang->line('bare_act_of_india');?></h1>
            </div>
            <div class="row mt-5 ">
                <?php if(isset($act_category) && !empty($act_category)){
                  foreach ($act_category as $key => $value) { ?>
                <div class="col-md-4 mb-5">
                    <div class="for_chang_pag_jdnhh">
                        <a href="<?=base_url()?>student-corner/bare-acts/<?=$value->slug_url?>"
                            class="___ttf_insaaf_role d-flex">
                            <div class="____bore_jkm">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="<?php echo base_url('uploads/acts/').$value->image?>"
                                            class="img-fluid p-0">
                                        <div class=" bare_act_para">
                                            <p class="pt-2  mb-0 ">
                                                <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->title_hi;
                                }else{
                                    echo $value->title;
                                }?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php }}?>
            </div>
        </div>
    </div>
</section>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("insaafactive");
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}
</script>