<section class="all__top">
    <div class="container">
        <div class="row"></div>
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

</section>



<!-- main-content-start -->
<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 __inBase text-center p-0">
                <img src="<?php echo base_url()?>assets/images/school_banner.jpg" class="img-fluid">

            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3 mb-2">
                <div class="__school_heading text-center">
                    <h3><span class="___spanMust">S</span>tudent <span class="___spanMust">C</span>orner</h3>
                    <img src="<?php echo base_url()?>assets/images/clip.png" class="img-fluid">

                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="row">
                    <div class="col-md-6 checkMob">
                        <a href="<?=base_url()?>student-corner/blog" class="__hoveBlog">
                            <div class="___blogger3248769 text-center ml-auto ">
                                <img src="<?php echo base_url()?>assets/images/blogger.png" class="img-fluid">
                                <p class="mt-3">Blogs</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 checkMob ">
                        <a href="<?=base_url()?>student-corner/bare-acts" class="__hoveBlog">
                            <div class="___blogger3248769 text-center ml-auto ">
                                <img src="<?php echo base_url()?>assets/images/law___cos.png" class="img-fluid">
                                <p class="mt-3">Bare Acts</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row mt-4 mb-5 checkMob">
                    <div class="col-md-6 checkMob">
                        <a href="<?=base_url()?>student-corner/dictionay" class="__hoveBlog">
                            <div class="___blogger3248769 text-center ">
                                <img src="<?php echo base_url()?>assets/images/dictionary.png" class="img-fluid">
                                <p class="mt-3">Dictionary </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 checkMob">
                        <a href="<?=base_url()?>student-corner/study-materials" class="__hoveBlog">
                            <div class="___blogger3248769 text-center ">
                                <img src="<?php echo base_url()?>assets/images/read.png" class="img-fluid">
                                <p class="mt-3">Study Materials </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>