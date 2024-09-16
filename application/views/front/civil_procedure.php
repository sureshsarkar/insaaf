<?php 
if(isset($_GET) && !empty($_GET)){
    $data['id']=$_GET['key'];
    $data['status']=1;
   update_notification($data);
}
?>
<div class="accordion" id="accordionExample">
<?php  if(isset($CrPC) && !empty($CrPC)){
        foreach ($CrPC as $key => $value) {?>
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link article" type="button" data-toggle="collapse"
                    data-target="#<?php echo $value->act_number?>" aria-expanded="true"
                    aria-controls="<?php echo $value->act_number?>">

                    <?=$this->lang->line('civil_procedure_code');?>
                    <?php if( isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->title_hi;
                         }else{
                            echo $value->title;
                     }?>

                    <i class="bi bi-arrow-down-circle"></i>
                </button>
            </h2>
        </div>

        <div id="<?php echo $value->act_number?>" class="collapse " aria-labelledby="headingOne"
            data-parent="#accordionExample">
            <div class="card-body text-justify constforntsize">
                <?php if( isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->descreption_hi;
                         }else{
                            echo $value->descreption;
                     }?>
            </div>
        </div>
    </div>

    <?php }}?>
   





</div>