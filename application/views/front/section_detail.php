<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php $actType = $this->db->where('id', $sectionData->act_type)->get('act_category')->result();?>
            <h1 class="mt-2"><?php if(isset($actType) && !empty($actType)){
                if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $actType[0]->title_hi ;
                ?>
                <?php }else{
                            echo $actType[0]->title;
                           }}
                ?>
            -</h1>

            <?php if(isset($sectionData) && !empty($sectionData)){?>
            <div class="m_hed mt-2">
                <h3><?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $sectionData->title_hi ;
                         }else{
                            echo $sectionData->title;
                           }  ?></h3>
                <p>
                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $sectionData->descreption_hi;
                            }else{
                                echo $sectionData->descreption;
                            }
                    ?>
                </p>
            </div>
            <?php }?>
        </div>
    </div>
</div>


<style>
.m_hed {
    margin-top: 52px;
    margin-bottom: 30px;
}

.m_hed h3 {
    color: #1a243f;
    font-weight: 600;
}
</style>