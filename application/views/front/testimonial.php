<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="what_client_say">
                    <h2>What Clients Say</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">

        <?php if(isset($testimonial) && !empty($testimonial)){
            // pre($testimonial);
            ?>
        <div class="row justify-content-center">
            <?php 
                 $i = 0; 
                    ?>
            <?php  foreach ($testimonial as $key => $value) {
                $i++;
                if($i==5){
             $i = 1;
                }
            ?>
            <div class="col-md-3 col-12">

                <div class="_main_content_testmonil bgColor<?=$i?>">
                    <p>
                        <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){
                             echo $value->descreption_hi;
                            }else{
                             echo $value->descreption;
                            }?>
                    </p>
                </div>
                <div class="images_test_Name">
                    <div class="smal_img">
                        <img src="<?php echo base_url('uploads/testimonial/'.$value->image)?>" alt=""
                            class="img-fluid imgFitt">
                    </div>
                    <div class="name_text">
                        <h6><?= $value->name?></h6>
                        <p>
                            <span><?php echo (isset($value->designation) && $value->designation !="")?"(".$value->designation.")":"";?></span>
                        </p>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <?php }?>
    </div>
</section>