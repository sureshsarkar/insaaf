<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="Baner_cont_imgsd">
                    <img src="<?php echo base_url()?>assets/images/contact_banner.webp" alt="">
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="for_con_info_heding">
                    <h2>Contact Us</h2>
                    <p>Your voice is our anchor. we strongly believe your feedback is indispensable to help us improve
                        our services.Please send in your views, query, complaints or experience to us here. We assure
                        all your comments will be answered and addressed expediently.</p>
                </div>
            </div>
            <div class="col-md-2 col-6 ">
                <div class="Baner_cont_imgsdppso">
                    <img src="<?php echo base_url()?>assets/images/contact_banner2.webp" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container for_pad_mar_full">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="for_icon_desing">
                    <div class="for_border_icon_cont">
                        <a href="https://goo.gl/maps/chPUVppQQaDNUGc67"><i class="bi bi-geo-alt"></i></a>
                    </div>
                    <div class="for_text_design_cont">
                        <a href="https://goo.gl/maps/chPUVppQQaDNUGc67" class="fornon_dursdht ">
                            <p>Address: G-45, First Floor, Sector-6, Opp Hyundai Service Station Noida, Uttar Pradesh
                                (201301), India.</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="for_icon_desing">
                    <div class="for_border_icon_cont">
                        <a href="tel:(+91-9953536391)" class="fornon_dursdht "><i class="bi bi-telephone-fill"></i></a>
                    </div>
                    <div class="for_text_design_cont for_cokdkf_conyt">
                        <p>Land-Line:<a href="tel:(1800-212-9001)" class="fornon_dursdht ">1800-212-9001 </a></p>
                        <p> Mobile:<a href="tel:(+91-9953536391)" class="fornon_dursdht "> +91-9953536391 </a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="for_icon_desing">
                    <div class="for_border_icon_cont">
                        <a href="mailto: contact@insaaf99.com" class="fornon_dursdht "><i
                                class="bi bi-envelope"></i></a>
                    </div>
                    <div class="for_text_design_cont for_cokdkf_conyt">
                        <p>Email: <a href="mailto: contact@insaaf99.com" class="fornon_dursdht "> contact@insaaf99.com
                            </a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="for_icon_desing">
                    <div class="for_border_icon_cont">
                        <a href="https://www.insaaf99.com/" class="fornon_dursdht "><i class="bi bi-globe"></i></a>
                    </div>
                    <div class="for_text_design_cont for_cokdkf_conyt">
                        <p>Website: <a href="https://www.insaaf99.com/" class="fornon_dursdht "> insaaf99.com</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <!-- form1-->
        <div class="for_bg_color_cont_us formCon">
            <div class="row">
                <div class="col-md-7 dor_so_ckkdfj_oo_cont_us">
                    <div class="for_spcl_cont_us_text">
                        <h3>Contact Us</h3>
                    </div>
                    <form action="<?=base_url()?>contact/formsubmit" method="post" id="form1"
                        enctype="multipart/form-data">
                        <div class="for_cont_ldfkkjsd_us">
                            <div class="label-float for_my_updt_cont">
                                <input type="text" placeholder=" " name="fname" required />
                                <label>First Name</label>
                            </div>
                            <div class="label-float for_my_updt_cont">
                                <input type="text" placeholder=" " name="lname" required/>
                                <label>Last Name</label>
                            </div>
                        </div>
                        <div class="for_cont_ldfkkjsd_us">
                            <div class="label-float for_my_updt_cont">
                                <input type="text" placeholder=" " class="OnlyNumberInput" name="mobile" 
                                    maxlength="10" required/>
                                <label>Phone</label>
                            </div>
                            <div class="label-float for_my_updt_cont">
                                <input type="email" placeholder=" " name="email"  required/>
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="for_flecx_cont_ico_us_po">
                            <div class="for_my_css_attach_file">
                                <div class="form-group ">
                                    <label>Attach files:</label>
                                    <input type="file" id="myfile" name="attachment"><br><br>
                                </div>
                            </div>
                            <div class="label-float for_my_updt_cont">
                                <textarea type="text" name="query" id="" cols="28" rows="2" placeholder=" "
                                required></textarea>
                                <label style="background: white;">Enter Your Query</label>
                            </div>
                            
                            <div class="label-float for_my_updt_cont">
                            <div class="g-recaptcha" data-sitekey="6Lc8mD8lAAAAANXThFpcfbxV_uGOXo7OMV-D19J2"></div>
                                 <br/>
                            </div>

                        </div>
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="myfile">Captcha Code</label>
                                        <div class="for_chta_law">
                                            <div class="captchaBox" data-captcha="<?= $captcha ?>">
                                                <div class="overlyBg"></div>
                                                <span class="captChaText"><?= $captcha ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="label-float for_my_updt_cont">
                                        <input type="text" placeholder="Enter Captcha" name="captcha" id="captChaText"
                                            style="    min-width: 235px;" />
                                        <label>Enter Captcha</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="for_butooon_cont_us">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <div class="for_cont_us_im">
                        <img src="<?php echo base_url()?>assets/images/contact-us2.webp" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- progress page -->
        <div class="for_bg_color_cont_us progressCon hidden">
            <div class="row py-5">
                <div class="col-md-12 text-center">
                    <img src="<?= base_url('assets/images/progress.gif')?>" width="130">
                    <br /><br />
                    <p class="text-success">Sending....</p>

                </div>
            </div>
        </div>
        <!--end progress con -->

        <!-- success page -->
        <div class="for_bg_color_cont_us successCon hidden">
            <div class="row py-5">
                <div class="col-md-12 text-center">
                    <img src="<?= base_url('assets/images/success.png')?>" width="130">
                    <br /><br />
                    <h2 class="text-success">Thank You for submit your query!!</h2>
                    <br />
                    <a href="<?= base_url() ?>" class="btn btn-primary"><i class="bi bi-house"></i> Go Home</a>
                </div>
            </div>
        </div>
        <!--end success con -->

        <div class="for_con_info_heding2">
            <h2>Disclaimer</h2>
            <p>This note/video is for general information only. It is not to be substituted for legal advice or taken as
                legal advice. The creator or author shall not be liable for any act or omission based on this
                note/video.</p>
        </div>
    </div>
</section>


<script>
$("#form1").submit(function(e) {
    e.preventDefault()
    // check captcha
        var captcha = $("#captChaText").val();
        var myCaptcha = $(".captchaBox").attr('data-captcha');
        if(captcha != myCaptcha){
            alert("Captcha Mistmatch");
            return false;
        }

       $(".for_bg_color_cont_us").addClass('hidden');
       $(".progressCon").removeClass('hidden');
       var formData = new FormData(this);

    var url = "<?=base_url()?>contact/formsubmit";
    $.ajax({
        type: "POST",
        url: url,
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(returnVal) {
       
               $(".for_bg_color_cont_us").addClass('hidden');
               $(".successCon").removeClass('hidden'); 
        }
    });
    return false;
});
</script>