<style type="text/css">
.___insaff_panel a {
    display: grid;
    background: #ffefdb;
    font-weight: 500;
    padding: 0.6rem;
    font-size: 0.8rem;
    color: #000;
}

.___insaff_panel:hover a {
    text-decoration: none;
}

.__collapse__col {
    width: 100%;
    border: 1px solid #e8e8e8;
    margin-bottom: 0.2rem;
    text-align: left;
    padding: 0;
}
</style>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ___head__cons">
                <h2><?php if(isset($bare_act_cat_name) &&  !empty($bare_act_cat_name)){
                if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $bare_act_cat_name->title_hi;
                }else{
                    echo $bare_act_cat_name->title;
                }
               }
                ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <?php if(isset($bare_act_sub_cat_data) && !empty($bare_act_sub_cat_data)){
              foreach ($bare_act_sub_cat_data as $key => $value) {?>


                <button class=" __collapse__col" data-toggle="collapse" data-target="#<?php echo $value->id?>"
                    aria-expanded="true" aria-controls="<?php echo $value->id?>">
                    <div class="___inner_div _div_bg">
                        <div class="d-flex flex-row align-items-center">
                            <div class="p-2 ___wide_90">
                                <h4><?php 
                                   if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->title_hi;
                                   }else{
                                       echo $value->title;
                                   }?>
                                   </h4>
                                <p><?php  echo $value->section_range?></p>
                            </div>
                            <div class="p-2 ml-auto ___wide_10"><i class="bi bi-caret-right-fill"></i></div>
                        </div>
                    </div>
                </button>
                <div id="<?php echo $value->id?>" class="collapse " aria-labelledby="headingOne"
                    data-parent="#accordionExample">
                    <?php $get_sub_cat = $this->db->get_where('acts', ['sub_category_id'=> $value->id ,'status'=>1])->result(); ?>
                    <div class="___insaff_panel">
                        <?php if(isset($get_sub_cat) && !empty($get_sub_cat)){ 
                      foreach ($get_sub_cat as $key => $value) {?>
                        <a
                            href="<?=base_url()?>student-corner/bare-acts/detail/<?php echo $value->slug_url?>"><?php echo $value->title?></a>
                        <?php }}?>
                    </div>
                </div>
                <?php }}?>
            </div>
        </div>
    </div>
</section>