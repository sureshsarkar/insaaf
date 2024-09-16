<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="main_blog_heding more_top__">
                    <h2 class="">Blogs</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <?php if(isset($blogList[0]) && !empty($blogList[0])){ ?>
        <div class="row">
            <div class="col-md-12 col-xl-8">
                <div class="blog_crosul">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($blogList as $k => $v) {
                                if($k == 0){
                                $active = "active";
                                }else{
                                   $active = ""; 
                                }
                           ?>
                            <div class="carousel-item <?=$active?>">
                                <a href="<?= base_url()?>student-corner/blog/<?=$v->slug_url?>" class="ancho_newcs">
                                    <img src="<?= base_url()?>uploads/blogs/<?=$v->image?>" class="d-block w-100"
                                        alt="...">
                                    <div class="innertext_blog">
                                        <h5>
                                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $v->title_hi;
                                            }else{
                                                echo $v->title;
                                            }?></h5>
                                        <span>
                                            <small>
                                                <img src="<?= base_url()?>uploads/blogs/<?=$v->author_image?>"
                                                    class="d-block " alt="<?= $v->title?>">
                                                <strong>Date: </strong> <?= date("d-M-y", strtotime($v->dt))?>
                                            </small>
                                        </span>
                                    </div>
                                    <div class="dis_bolg">
                                        <p>
                                            <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $v->descreption_hi;
                                            }else{
                                                echo $v->descreption;
                                            }?>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <?php }?>

                        </div>
                        <button class="carousel-control-prev buton_indr" type="button"
                            data-target="#carouselExampleCaptions" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next buton_indr" type="button"
                            data-target="#carouselExampleCaptions" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>

                </div>
            </div>
            <div class="col-md-12 col-xl-4">
                <div class="___form__row  pt-1 ">
                    <div class="__only__submit">
                        <div class="box__index__row">
                            <div class="__form__index blog_index ">
                                <!-- form box  -->
                                <div class="formCon">
                                    <form id="formSubmit" method="POST">
                                        <div class="___form__header">
                                            <p>Get Started</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-12">
                                                <div class="form-group mb-0">
                                                    <input type="text" name="name" id="first1" placeholder="Full Name"
                                                        class="form-control  selected name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-12">
                                                <div class="form-group mb-0">
                                                    <input type="number" name="mobile" id="first1"
                                                        placeholder="Mobile Number" minlength="10" maxlength="10"
                                                        class="form-control __control__form mobile">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-12">
                                                <div class="form-group mb-0">
                                                    <input type="email" name="email" id="first1" placeholder="Email"
                                                        class="form-control   __control__form email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-12">
                                                <div class="form-group mb-0">
                                                    <input type="text" name="query" id="first1"
                                                        placeholder="Enter query"
                                                        class="form-control __control__form query">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-12">
                                                <div class="">
                                                    <div class="d-flex ___final__row">
                                                        <div class="form-check male __sameCallInsaff ml__coll_0">
                                                            <input class="form-check-input gender" type="radio"
                                                                name="gender" id="flexRadioDefault1" value="1">
                                                            <label class="form-check-label" id="male"
                                                                for="flexRadioDefault1">
                                                                Male </label>
                                                        </div>
                                                        <div class="form-check __sameCallInsaff">
                                                            <input class="form-check-input female gender" type="radio"
                                                                name="gender" id="exampleCheck2" value="2">
                                                            <label class="form-check-label" id="female"
                                                                for="exampleCheck2">
                                                                Female </label>
                                                        </div>

                                                        <div class="form-check __sameCallInsaff">
                                                            <input class="form-check-input other gender" type="radio"
                                                                name="gender" id="exampleCheck3" value="3">
                                                            <label class="form-check-label" id="other"
                                                                for="exampleCheck3">
                                                                Other </label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="talk__to11 blinker_buton">
                                                    <button type="submit" class=" talk_to_button ">
                                                        Talk to Expert </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- progress page -->
                                <div class="progressCon hidden">
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <div class="row py-5">
                                                <div class="col-md-12 text-center">
                                                    <img src="http://localhost/web11/sarkar/insaaf99/assets/images/home/progress.gif"
                                                        width="130">
                                                    <br><br>
                                                    <p class="text-success">Sending....</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end progress con -->

                                <!-- success page -->
                                <div class=" successCon hidden">
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <div class="row py-5">
                                                <div class="col-md-12 text-center">
                                                    <img src="http://localhost/web11/sarkar/insaaf99/assets/images/home/success.webp"
                                                        width="130">
                                                    <br><br>
                                                    <h4 class="text-success">
                                                        Thanks <br> We will contact you shortly! </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end success con -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</section>

<section>
    <div class="container">
        <div class="more_top__">
            <h2>More Top Stories</h2>
        </div>
        <div class="row">
            <?php if(isset($AllBlogs) && !empty($AllBlogs)){ 
                foreach ($AllBlogs as $k => $v) {?>
            <div class="col-md-4">
                <a href="<?= base_url()?>student-corner/blog/<?=$v->slug_url?>" class="ancho_newcs">
                    <div class="card new_redic">
                        <img src="<?= base_url()?>uploads/blogs/<?=$v->image?>" class="d-block w-100"
                            alt="<?= $v->title?>">
                        <div class="card-body blog_new_cs">
                            <div class="innertext_blog new_wid_blog blog_elips">
                                <h5 class="">
                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $v->title_hi;
                            }else{
                                echo $v->title;
                            }?></h5>
                            </div>
                            <div class="dis_bolg new_wid_blog2">
                                <p>
                                    <?php if(isset($_COOKIE['lang']) && !empty($_COOKIE['lang']=='hindi')){ echo $v->descreption_hi;
                            }else{
                                echo $v->descreption;
                            }?></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php }}?>
        </div>
    </div>
</section>


<script>
$("#formSubmit").submit(function(e) {
    e.preventDefault();

    var name = $(".name").val();
    var text = name.split(' ');
    var fname = text[0];
    var lname = text[1];

    var email = $(".email").val();
    var mobile = $(".mobile").val();
    var query = $(".query").val();
    var gender = document.getElementsByName('gender');
    var genderStatus = false;
    if (gender[0].checked || gender[1].checked || gender[2].checked) {
        genderStatus = true;
    }

    let genderVal = 0;

    if (gender[0].checked) {
        genderVal = 1;
    } else if (gender[1].checked) {
        genderVal = 2;
    } else if (gender[2].checked) {
        genderVal = 3;
    }

    var error = '';
    if (fname == '' || fname.length < 2) {
        error = "Please enter your first name!";
    } else if (lname == '' || lname.length < 3) {
        error = "Please enter your last name!";
    } else if (mobile == '' || mobile.length < 10) {
        error = "Please enter your 10 digit phone number!";
    } else if (email == '' || email.length < 6) {
        error = "Please enter valid email!";
    } else if (!genderStatus) {
        error = "Please select your Gender!";
    }
    if (error != '') {
        alert(error);
        return false;
    }
    sessionStorage.setItem("user_query", query);
    var url = "<?=base_url()?>new_user/getMobileNumber";
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            mobile: mobile
        },
        success: function(responce) {
            if (responce == 1) {
                alert("You have already registered as a client, So please login");
                window.location.replace("<?php echo base_url('login')?>");
            } else if (responce == 2) {
                alert("You have already registered as a lawyer, So please login");
                window.location.replace("<?php echo base_url('login')?>");
            }
        }
    });
    let base_url = "<?php echo base_url()?>";
    let redirect = base_url + 'signup?type=client&user_fname=' + fname + '&user_lname=' +
        lname + '&user_mobile=' + mobile + '&user_email=' + email + '&user_gender=' + genderVal;

    window.location.href = redirect;
    return false;

});
</script>