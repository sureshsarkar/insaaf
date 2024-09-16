
<div class="content-wrapper">

    <section class="content">
    
        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
           
        </div> 
        	 <div class="container">
              <div class="row">
                <div class="col-md-8 m-auto">
                    <div class="for_client__">
                      <form action="<?php echo base_url('client/create_case/ajax5/'.base64_encode($this->session->userdata('ses_lawyer_id'))); ?>" method="post" enctype="multipart/form-data" onSubmit="return checkLength()">
                        <div class="for_imffhd">
                            <h4 class="text-uppercase"><b>Case Details</b></h4>
                        </div>
                        <div class="form-group">
                          <label>Case Details</label>
                          <textarea id="textbox" name="case_description" class="form-control" rows="3"><?php echo $this->session->userdata('case_description'); ?><?= isset($msgData)?$msgData->msg:$case_category?></textarea>
                          <small id="text_error" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                          <label>Upload Attachment <small class="text-info">(In case of documentation to be relied, it is highly recomended to upload the document for swift resolution)</small></label>
                          <input type="file" name="case_file" id="attachFileBtn" class="form-control">
                          <span class="text-success successFileCon hidden"><i class="bi bi-check2"></i> <small>File Uploaded</small></span>
                        </div>

                        <div class="__flx_button_prv_nxt" style="width:99%">
                            <div class="__bck_butn">
                                <a href="<?php echo base_url('client/create_case/ajax3/'.base64_encode($this->session->userdata('ses_lawyer_id'))); ?>" class="button_news"> < Back</a>
                            </div>
                            <div class="__nxt_btn_">
                                <button type="submit" class="for_nextdjijdf"> Preview </button>
                            </div>
                        </div>
                    
                      </form>
                    </div>
              </div>
            </div>
        </div>
    </section>
    
</div>

<script>
    function checkLength(){
        var maxLength = "<?= isset($msgData)?0:10?>";
        var textbox = document.getElementById("textbox");
        if(textbox.value.length <= maxLength){
            // alert("success");
            $("#text_error").text("Description must be at least 10 characters");
            // exit();
            $("#textbox").focus();
            return false;
        }
    }

    $("#attachFileBtn").change(function(){
        $(".successFileCon").removeClass("hidden");
    });
</script>



<style>
    .for_nextdjijdf {
    margin-top: 4px;
    background: #1a243f;
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 11px;
}
.button_news:hover {
  background: #1a243f;
  transition: 0.2s ease-in-out;
}

.for_nextdjijdf:hover{
    background: #ff9100;
    transition: 0.2s ease-in-out;
}
</style>