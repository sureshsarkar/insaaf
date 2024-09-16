
<?php 
 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_GET) && !empty($_GET)){
    $data['id']=base64_decode($_GET['key']);
    $data['status']=1;
    $data['update_dt']=date("Y-m-d H:i:s");
   update_notification($data);
}
?>
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link constitution text-center" type="button" data-toggle="collapse"
                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <?=$this->lang->line('ipc');?> <i class="bi bi-arrow-down-circle"></i>
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
            <?=$this->lang->line('ipc_des');?>
                
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link constitution text-center" type="button" data-toggle="collapse"
                    data-target="#Preamble" aria-expanded="true" aria-controls="Preamble">
                    <?=$this->lang->line('preamble_of_ipc');?>
                    <i class="bi bi-arrow-down-circle"></i>
                </button>
            </h2>
        </div>

        <div id="Preamble" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
            <?=$this->lang->line('ipc_where');?>
            </div>
        </div>
    </div>
    

    <?php  if(isset($IPC) && !empty($IPC)){
        foreach ($IPC as $key => $value) {?>
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link article" type="button" data-toggle="collapse"
                    data-target="#<?php echo $value->act_number?>" aria-expanded="true"
                    aria-controls="<?php echo $value->act_number?>">

                    <?=$this->lang->line('indian_panel_code');?>
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