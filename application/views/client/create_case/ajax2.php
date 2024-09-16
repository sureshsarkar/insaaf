
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
                <div class="col-md-12">
                    <div class="for_client__">
                      <form action="<?php echo base_url('client/create_case/ajax3/'.base64_encode($lawyer_data->id)); ?>" method="post">
                        <div class="for_imffhd">
                            <h4 class="text-uppercase"><b>Select Case Category</b></h4>
                        </div>
                        <div class="radio_start">
                            <?php foreach($case_cats as $case_cat){ ?>
                            <div class="form-check">
                                <?php 
                                    if ($this->session->userdata('ses_case_cat_id')!='' && $this->session->userdata('ses_case_cat_id') == $case_cat['id']) {
                                        $checked = 'checked';
                                    }else{
                                        $checked = '';
                                    }
                                ?>
                                <label class="form-check-label for_chchek_colr">
                                    <input class="" type="radio" name="case_cat" value="<?php echo $case_cat['id']; ?>" <?php echo $checked; ?> required> <?php echo $case_cat['name']; ?> 
                                </label>
                            </div>
                            <?php } ?>   
                        </div>
                        <div class="__flx_button_prv_nxt" style="width:90%">
                            <div class="__bck_butn">
                                <a href="<?php echo base_url('client/create_case'); ?>" class="button_news"> < Back</a>
                            </div>
                            <div class="__nxt_btn_">
                                <button type="submit" class="for_nextdjijdf">Next > </button>
                            </div>
                        </div>
                      </form>
                    </div>
              </div>
            </div>
        </div>
    </section>
    
</div>


<style>
    .forfldk_justc {
    display: flex;
    justify-content: space-between;
    font-weight: 700;
}
.for_imffhd {
    border-bottom: 2px solid #dfdfdf;
    margin-bottom: 15px;
}
.__flx_button_prv_nxt {
    display: flex;
    justify-content: space-between;
    margin-top: 40px;
}
.radio_start {
    height: 200px;
    overflow: hidden;
    overflow-y: scroll;
}
.button_news {
	background: #ff9100;
    padding: 6px 20px;
    margin-bottom: 7px;
    color: white;
    border: none;
    border-radius: 11px;
    margin-top: 4px;
}
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
.for_chchek_colr{
    color: green;
}
</style>


