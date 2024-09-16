
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
            <!-- left column -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(isset($categoryData) && !empty($categoryData)){?>
                        <div class="tab __ttf_insaaf_ab">
                            <button class="tablinks active"
                                onclick="openCity(event, 'startup')"><?=$categoryData[0]->name?></button>
                            <button class="tablinks"
                                onclick="openCity(event, 'document')"><?=$categoryData[1]->name?></button>
                        </div>
                        <?php }?>
                        <div id="startup" class="tabcontent  ___insaaf_ttf">
                            <div class="__saf___document">
                                <div class="row">
                                  <?php if(isset($sub_categoryData) &&!empty($sub_categoryData)){ 
                                    foreach($sub_categoryData as $key => $value) {
                                      if($value->category_id==$categoryData[0]->id){?>
                                    <div class="col-md-3">
                                        <div class="__isaf_heading">
                                            <h4><?=$value->sub_category?></h4>
                                            <ul class="list-unstyled">
                                              <?php foreach($sub_sub_categoryData as $key1 => $value1) {
                                                if($value->id==$value1->sub_category_id){?>
                                                <li><a href="<?php echo base_url()."client/documentation/documentation_detail/".$value1->slug_url;?>"><?=$value1->sub_sub_category_name;?><i class="bi bi-arrow-right-circle"></i></a></li>
                                                <?php }}?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php }}}?>
                                </div>
                            </div>
                        </div>
                        <div id="document" class="tabcontent ___insaaf_ttfud_op">
                            <div class="__saf___document">
                                <div class="row">
                                <?php if(isset($sub_categoryData) &&!empty($sub_categoryData)){ 
                                    foreach($sub_categoryData as $key => $value) {
                                      if($value->category_id==$categoryData[1]->id){?>
                                    <div class="col-md-3">
                                        <div class="__isaf_heading">
                                            <h4><?=$value->sub_category?></h4>
                                            <ul class="list-unstyled">
                                              <?php foreach($sub_sub_categoryData as $key1 => $value1) {
                                                if($value->id==$value1->sub_category_id){?>
                                                <li><a href="<?php echo base_url()."client/documentation/documentation_detail/".$value1->slug_url?>"><?=$value1->sub_sub_category_name;?><i class="bi bi-arrow-right-circle"></i></a></li>
                                                <?php }}?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php }}}?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script type="text/javascript">
function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>


<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>