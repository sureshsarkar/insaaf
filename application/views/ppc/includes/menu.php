<!--======================================== use only mobile==================================== -->
<section class="__view_mobile __bg_view_top">
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="row menu_border ">
            <div class="col-2 topBg4355 ">
                <img src="<?php echo base_url()?>assets/images/law_logo.webp" class="___my_fix">
            </div>

            <div class="col-10 topBg4355">
                <div class="ToggleBtn d-flex align-items-center  pt-2 for_some_chng_hedar_moble">
                    <a href="<?=base_url()?>student-corner" class="___Base_Tec">
                        <div class="pulse">Student <br><span class="___corner">Corner</span></div>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-dark overflow123">

                    <!-- language select  -->

                    <div class="dropdown  tabHov">
                        <button class="btn  dropdown-toggle ___LangPut" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?=base_url()?>assets/images/flag.png">
                            <span class="___Eng">
                                <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['langText'])){ echo $_COOKIE['langText'];
                                }else{
                                    echo "English";
                                }?>
                            </span>
                        </button>

                        <div class="dropdown-menu ___dropdown_wp" aria-labelledby="dropdownMenuButton">
                            <div class="badge22">
                                <img src="<?=base_url()?>assets/images/badge.png">
                            </div>
                            <form>
                                <a class="dropdown-item __newItem " href="#">
                                    <label for="english1" class="fix_label click_lang text-dark"
                                        english="english">English -
                                        EN</label><br>
                                </a>
                                <a class="dropdown-item __newItem" href="#">
                                    <label for="hindi1" class="fix_label1 click_lang text-dark" hindi="hindi">हिन्दी -
                                        HI
                                    </label><br>
                                </a>
                            </form>
                        </div>
                    </div>
                    <div id="main_nav " class=" w-100">
                        <ul class="navbar-nav li_line">
                            <li class="nav-item active"> <a class="nav-link"
                                    href="<?=base_url()?>"><?=$this->lang->line('home_menu'); ?>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link law_toggle26541564"
                                    href="<?=base_url()?>about-us"><?=$this->lang->line('about_menu');?> </a></li>
                            <li class="nav-item"><a class="nav-link law_toggle26541564"
                                    href="<?=base_url()?>specialization"><?=$this->lang->line('specialization_menu');?>
                                </a>
                            </li>

                            <?php 
                            if(!empty($categoryMenu)){
                              foreach ($categoryMenu['category'] as $key => $value){
                                  ?>
                            <li class="nav-item dropdown has-megamenu">
                                <a class="nav-link dropdown-toggle law_toggle26541564" href="#" data-toggle="dropdown">
                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->name_hi;
                                    }else{
                                        echo $value->name;
                                    }?> </a>
                                <div class="dropdown-menu megamenu __over12465978">

                                    <div class="row menu">
                                        <?php 
                              foreach ($categoryMenu['subCategory'] as $key1 => $value1) {
                                  if($key==$value1->category_id){
                                  ?>
                                        <div class="col-md-3 ">
                                            <h5>
                                                <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value1->sub_category_hi;
                                            }else{
                                                echo $value1->sub_category;
                                            }?> </h5>
                                            <div class="list-unstyled border_menu">
                                                <?php 
                                            foreach ($categoryMenu['sub_subCategory'] as $key2 => $value2) {
                                            
                                               if($key1==$value2->sub_category_id){
                                                $categoryname=strtolower($value->name);
                                                $catslug=str_replace(" ", "-", $categoryname);
                                                   ?>

                                                <a href="<?=base_url()?>specialization/<?= $catslug?>/<?php echo $value2->slug_url?>"
                                                    class="mega_link">
                                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value2->sub_sub_category_name_hi;
                                            }else{
                                                echo $value2->sub_sub_category_name;
                                            }?>
                                                </a>
                                                <?php }}?>
                                            </div>
                                        </div>
                                        <?php }}?>
                                    </div>
                                </div>
                                <!-- dropdown-mega-menu -->
                            </li>
                            <?php } } ?>
                            <li class="nav-item"><a class="nav-link law_toggle26541564"
                                    href="<?=base_url()?>contact-us">
                                    <?=$this->lang->line('contact_menu');?> </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="dhfhffggfghfhhffd">
        <span class="logo__" onclick="openNav()">&#9776;</span>
        <a class="logoMobile" href="<?php echo base_url()?>">
            <img src="<?php echo base_url()?>assets/images/law_logo.webp" class="img-fluid">
        </a>
        <!-- login or rigistation for mobile view  -->
        <!-- End  -->
        <!-- after login profile show for mobile  -->

        <?php if(isset($_SESSION['id']) && isset($_SESSION['role']) ){?>
        <a class="logoMobile uufjgghgh" href="<?=base_url($_SESSION['role'].'/dashboard')?>">
            <img src="<?= isset($_SESSION['img'])?$_SESSION['img']:base_url('assets/images/defult_image.png')?>"
                class="img-fluid"><?= isset($_SESSION['fname'])?$_SESSION['fname']:'' ?></a>
        <?php }else{ ?>

        <a href="<?=base_url('signup?type=lawyer')?>" class="btn notw_lawye_btn_mobile"><i
                class="bi bi-person-circle"></i>&nbsp;&nbsp;&nbsp;Lawyers Click Here</a>

        <?php } ?>

        <!-- End  -->

    </div>
    <form action="<?php echo base_url('all-news'); ?>">
        <input type="text" name="search" class="mobileSearch" placeholder="<?=$this->lang->line('search_menu');?>">
    </form>
</section>
<!-- ==============================================end========================================= -->

<!--======================================= use only desktop ===================================-->

<div class="__view_desktop">

    <div class="header ">
        <header class="main_header progress-container">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2 text-center bg-logo ">
                        <a class="logo" href="<?php echo base_url()?>">
                            <img src="<?php echo base_url()?>assets/images/law_logo.webp" class="img-fluid"
                                alt="Insaaf99 Logo">
                        </a>
                    </div>
                    <div class="col-md-10 bg_top_">
                        <div class="row">
                            <div class="col-sm-12 p-0">
                                <div class="main_law_menu ">
                                    <div class="d-flex justify-content-end __poll_social align-items-center">
                                        <div class="bd-highlight mr-auto chng_searcg_wdth" style="">
                                            <form class="example" action="<?php echo base_url('search');?>"
                                                methog="get">
                                                <input type="text" class="__focus_form"
                                                    placeholder="<?=$this->lang->line('search_menu');?>"
                                                    name="searchKey" required>
                                                <button type="submit">
                                                    <img src="<?php echo base_url()?>assets/images/svg/search.svg"
                                                        class="img-fluid" alt="Find Lawyer">
                                                </button>
                                            </form>
                                        </div>

                                        <!-- login and registation button for desttop  -->
                                        <?php if(isset($_SESSION['id']) && isset($_SESSION['role']) ){?>

                                        <div class="topUserCon" style="margin-right: 45px;">
                                            <a href="<?=base_url($_SESSION['role'].'/dashboard')?>"
                                                class=" btn lawBtn36"><img
                                                    src="<?= isset($_SESSION['img'])?$_SESSION['img']:base_url('assets/images/defult_image.png')?>"
                                                    width="30">
                                                <?= isset($_SESSION['fname'])?$_SESSION['fname']:'' ?></a>
                                        </div>

                                        <?php }else{?>
                                        <div class="bd-highlight  call_noe  mr-2" style="">
                                            <a href='tel:1800-212-9001' class="">
                                                <small> <img src="<?=base_url()?>assets/images/svg/telephone.svg"
                                                        alt="Indian Flag"></small> 1800-212-9001
                                            </a>

                                        </div>

                                        <div class="bd-highlight  mr-2" style="">
                                            <a href="<?php echo base_url('signup?type=lawyer')?>" class="btn lawClick">
                                                <i class="bi bi-person-circle"></i>&nbsp;&nbsp;Lawyers Click here</a>

                                        </div>

                                        <div class="bd-highlight  mr-2" style="">
                                            <a href="<?php echo base_url('login')?>" class="btn lawClick">
                                                <?=$this->lang->line('lawyer_log_menu');?></a>

                                        </div>

                                        <div class="bd-highlight  mr-2" style="">
                                            <a href="<?php echo base_url('signup?type=client')?>"
                                                class="btn lawClick">Register</a>
                                        </div>

                                        <?php }?>

                                        <!-- End  -->

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 p-0">
                                <nav class="navbar navbar-expand-lg navbar-dark law_menu pl-0 ">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#main_nav">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <!-- side  panel all -->
                                    <div id="my2" class="sidepanel">
                                        <p><strong><?=$this->lang->line('welcom_insaaf_menu');?></strong></p>
                                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav1()">×</a>

                                        <div class="insaafSpace">
                                            <?php  if( isset($_COOKIE['lang']) && !empty($_COOKIE['lang']) && !empty($categoryMenu)){
                                                  foreach ($categoryMenu['category'] as $key => $value){ ?>

                                            <?php foreach ($categoryMenu['subCategory'] as $key1 => $value1) {
                                                      if($key==$value1->category_id){ ?>
                                            <div class="left-ContentSide mt-3">
                                                <h4 class="mb-4">
                                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value1->sub_category_hi;
                                                    }else{
                                                        echo $value1->sub_category;
                                                    }?></h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php  foreach ($categoryMenu['sub_subCategory'] as $key2 => $value2) {
                                                                   if($key1==$value2->sub_category_id){ 

                                                                    $categoryname=strtolower($value->name);
                                                                    $catslug=str_replace(" ", "-", $categoryname);
                                                                    
                                                                    ?>
                                                        <a href="<?=base_url()?>specialization/<?= $catslug?>/<?php echo $value2->slug_url?>"
                                                            class="class_mandetoy">
                                                            <div class="row">
                                                                <div class="col-10">
                                                                    <div
                                                                        class=" flex-grow-1 bd-highlight ___oppFirm mb-3">
                                                                        <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value2->sub_sub_category_name_hi;
                                                                        }else{
                                                                            echo $value2->sub_sub_category_name;
                                                                        }?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2">
                                                                    <div class=" bd-highlight ml-auto "><i
                                                                            class="bi bi-arrow-right-short"></i></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <?php }}?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }}?>
                                            <?php }
                                        }elseif(isset($categoryMenu) && !empty($categoryMenu)){
                                             foreach ($categoryMenu['category'] as $key => $value){ ?>
                                            <!-- start -->
                                            <?php foreach ($categoryMenu['subCategory'] as $key1 => $value1) {
                                                      if($key==$value1->category_id){ ?>
                                            <div class="left-ContentSide mt-3">
                                                <h4 class="mb-4">
                                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value1->sub_category_hi;
                                                    }else{
                                                        echo $value1->sub_category;
                                                    }?></h4>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <?php  foreach ($categoryMenu['sub_subCategory'] as $key2 => $value2) {
                                                                   if($key1==$value2->sub_category_id){ 

                                                                    $categoryname=strtolower($value->name);
                                                                    $catslug=str_replace(" ", "-", $categoryname);
                                                                    
                                                                    ?>
                                                        <a href="<?=base_url()?>specialization/<?= $catslug?>/<?php echo $value2->slug_url?>"
                                                            class="class_mandetoy">
                                                            <div class="row">
                                                                <div class="col-10">
                                                                    <div
                                                                        class=" flex-grow-1 bd-highlight ___oppFirm mb-3">
                                                                        <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value2->sub_sub_category_name_hi;
                                                                        }else{
                                                                            echo $value2->sub_sub_category_name;
                                                                        }?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2">
                                                                    <div class=" bd-highlight ml-auto "><i
                                                                            class="bi bi-arrow-right-short"></i></div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <?php }}?>
                                                    </div>
                                                </div>
                                            </div><!-- left-ContentSide close -->
                                            <?php }}}}?>
                                        </div>
                                    </div>
                                    <button class="openbtn" onclick="openNav1()">☰ <span
                                            class="__all_toggle"><?=$this->lang->line('all_menu');?></span></button>

                                    <!-- end -->

                                    <div class="collapse navbar-collapse" id="main_nav">
                                        <ul class="navbar-nav">
                                            <li class="nav-item active"> <a class="nav-link"
                                                    href="<?=base_url()?>"><?=$this->lang->line('home_menu');?>
                                                </a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link law_toggle26541564"
                                                    href="<?=base_url()?>about-us"><?=$this->lang->line('about_menu');?>
                                                </a></li>
                                            <li class="nav-item"><a class="nav-link law_toggle26541564"
                                                    href="<?=base_url()?>specialization"><?=$this->lang->line('specialization_menu');?>
                                                </a></li>

                                            <?php 
                                           
                                                if(!empty($categoryMenu)){
                                                  foreach ($categoryMenu['category'] as $key => $value) {
                                                      ?>
                                            <li class="nav-item dropdown has-megamenu">
                                                <a class="nav-link dropdown-toggle law_toggle26541564" href="#"
                                                    data-toggle="dropdown">
                                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value->name_hi;
                                                    }else{
                                                        echo $value->name;
                                                    }?>
                                                </a>
                                                <div class="dropdown-menu megamenu">

                                                    <div class="row menu">
                                                        <?php 
                                                  foreach ($categoryMenu['subCategory'] as $key1 => $value1) {
                                                      if($key==$value1->category_id){
                                                      ?>
                                                        <div class="col-md-3 ">
                                                            <h5>
                                                                <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value1->sub_category_hi;
                                                    }else{
                                                        echo $value1->sub_category;
                                                    }?> </h5>
                                                            <div class="list-unstyled border_menu">
                                                                <?php 
                                                                foreach ($categoryMenu['sub_subCategory'] as $key2 => $value2) {
                                                                
                                                                   if($key1==$value2->sub_category_id){
                                                                       
                                                                     $categoryname=strtolower($value->name);
                                                                     $catslug=str_replace(" ", "-", $categoryname);
                                                                            ?>

                                                                <a href="<?=base_url()?>specialization/<?= $catslug;?>/<?php echo $value2->slug_url?>"
                                                                    class="mega_link">
                                                                    <?php if( isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $value2->sub_sub_category_name_hi;
                                                                    }else{
                                                                        echo $value2->sub_sub_category_name;
                                                                    }?>
                                                                </a>
                                                                <?php }}?>
                                                            </div>
                                                        </div>
                                                        <?php }}?>
                                                    </div>
                                                </div>

                                            </li>
                                            <?php } } ?>
                                            <li class="nav-item"><a class="nav-link law_toggle26541564"
                                                    href="<?=base_url()?>contact-us">
                                                    <?=$this->lang->line('contact_menu');?> </a>
                                            </li>
                                        </ul>

                                        <!-- language select  -->

                                        <div class="dropdown mr-auto tabHov __savemr">
                                            <button class="btn  dropdown-toggle ___LangPut" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <img src="<?=base_url()?>assets/images/flag.png" alt="Indian Flag">
                                                <span class="___Eng"><?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['langText'])){ echo $_COOKIE['langText'];
                                                    }else{
                                                        echo "English";
                                                    }?></span>
                                            </button>

                                            <div class="dropdown-menu ___dropdown_wp"
                                                aria-labelledby="dropdownMenuButton">
                                                <div class="badge22">
                                                    <img src="<?=base_url()?>assets/images/badge.png">
                                                </div>
                                                <form>
                                                    <a class="dropdown-item __newItem " href="#">
                                                        <label for="english1" class="fix_label click_lang"
                                                            english="english">English - EN</label><br>
                                                    </a>
                                                    <a class="dropdown-item __newItem" href="#">
                                                        <label for="hindi1" class="fix_label1 click_lang"
                                                            hindi="hindi">हिन्दी - HI </label><br>
                                                    </a>
                                                </form>


                                            </div>
                                        </div>
                                        <!-- end -->

                                        <div class="d-flex flex-row bd-highlight ml-0 ">

                                            <a href="<?=base_url('legal-advice')?>" class="___Base_Tec">
                                                <div class="__pulse_rectangle2">Book your <br><span
                                                        class="___corner">Slot now</span></div>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-row bd-highlight ml-0 ">

                                            <a href="<?=base_url()?>student-corner" class="___Base_Tec">
                                                <div class="__pulse_rectangle">Student <br><span
                                                        class="___corner">Corner</span></div>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-row bd-highlight  ___headerimg">
                                            <div class="bd-highlight ___highgov">
                                                <a href="https://play.google.com/store/apps/details?id=com.insaaf99"
                                                    target="_blank">
                                                    <img src="<?php echo base_url()?>assets/images/play__strore___btn.png"
                                                        class="img-fluid" alt="Insaaf Google App"></a>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="sapce__to__all"></div>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">
// When the user scrolls the page, execute myFunction
window.onscroll = function() {
    myFunction()
};

function myFunction() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;
}
</script>

<script type="text/javascript">
// Prevent closing from click inside dropdown
$(document).on('click', '.dropdown-menu', function(e) {
    e.stopPropagation();
});
</script>

<script>
$(document).ready(function() {
    $(".main_btn").click(function() {
        $("#panel").slideToggle("slow");
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#showmenu').click(function() {
        $('.search-exp').slideToggle("slide");

    });
});
</script>

<script type="text/javascript">
function openNav() {
    document.getElementById("mySidenav").style.width = "100%";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>

<!-- SIDEBAR JS  -->

<script>
function openNav1() {
    document.getElementById("my2").style.width = "300px";
}

function closeNav1() {
    document.getElementById("my2").style.width = "0";
}
</script>

<script type="text/javascript">
$(function() {
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 600) {
            $(".bg-logo").addClass("removeCol");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
            $(".bg-logo").removeClass("removeCol");
        }
    });
});
</script>