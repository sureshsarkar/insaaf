<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="Breadcrumb_lawyer">
                    <a href="<?= base_url()?>">
                        <ol>Home /</ol>
                    </a>
                    <a href="<?= base_url('lawyerlist')?>">
                        <ol>Lawyer List</ol>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <?php if(isset($lawyerData) && !empty($lawyerData)){?>
        <div class="row">
            <div class="col-md-4 pos_lawe">
                <div class="lawyer_detail_border">
                    <div class="profile_imag">
                        <img src="<?=base_url()?><?php echo (!empty($lawyerData->image))?$lawyerData->image:"assets/images/mobilehome/sai.webp";?>"
                            alt="">
                        <div class="rating_layer rating_lawyer_details">
                            <p>4.2</p>
                            <img src="<?=base_url()?>assets/images/documents/star.webp" alt="">
                        </div>
                    </div>
                    <div class="lawyer_details_tetx">
                        <h5>
                            <?php echo $lawyerData->fname?>
                        </h5>
                        <div class="expriences exprinces_icon">
                            <img src="<?=base_url()?>assets/images/mobilehome/translate.svg" alt="">
                            <p><?php echo (!empty($lawyerData->language))?$lawyerData->language:"Hindi";?></p>
                        </div>
                        <div class="expriences exprinces_icon">
                            <img src="<?=base_url()?>assets/images/mobilehome/geo-alt-fill.svg" alt="">
                            <p><?php echo $lawyerData->city?></p>
                        </div>
                        <div class="expriences exprinces_icon">
                            <img src="<?=base_url()?>assets/images/mobilehome/mortarboard.svg" alt="">
                            <p><?php echo $lawyerData->experience?></p>
                        </div>
                        <div class="back_prict_area">
                            <div class="expriences_2 m-0">
                                <img src="<?=base_url()?>assets/images/mobilehome/medal.png" alt="">
                                <p><?php echo $lawyerData->practice_area?></p>
                            </div>
                        </div>
                        <div class="consult_now_lawyer_details">
                            <a href="<?= base_url('legal-advice')?>"><button>Consult Now</button></a>
                        </div>
                    </div>
                </div>


                <div class="lawyer_detail_border">
                    <div class="money_back">
                        <img src="<?=base_url()?>assets/images/mobilehome/money-back.png" alt="">
                        <p>100% Money Back Guarantee</p>
                    </div>
                    <div class="money_back">
                        <img src="<?=base_url()?>assets/images/mobilehome/verify.png" alt="">
                        <p>Verified Expert Lawyer</p>
                    </div>
                    <div class="money_back">
                        <img src="<?=base_url()?>assets/images/mobilehome/security.png" alt="">
                        <p> 100% Secure Payments</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="lawyer_detail_border">
                    <div class="about_au_lawyer">
                        <h4>About Lawyer</h4>
                        <p><?php echo (isset($lawyerData->about) && !empty($lawyerData->about))?$lawyerData->about:"A professional lawyer is highly knowledgeable and experienced in the field of law, possessing a deep understanding of legal principles and procedures. They provide expert advice and representation to clients, advocating for their rights and interests. A skilled lawyer possesses strong analytical and problem-solving skills, allowing them to navigate complex legal issues and develop effective strategies. They maintain the highest ethical standards, prioritizing client confidentiality and acting in their best interests. Ultimately, a professional lawyer is dedicated to achieving favorable outcomes for their clients through their expertise and commitment to justice."?>
                        </p>
                    </div>
                </div>
                <section id="scroll_review">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="google_rating_review">
                                    <img src="<?=base_url()?>assets/images/mobilehome/google.png" alt="google">
                                    <h4>Rating</h4>
                                </div>
                                <div class="custormer_reviews">
                                    <div class="rating-star">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                    </div>
                                    <div class="review_text">
                                        <p>Loved the support and communication. 100% recommended for your company’s
                                            incorporation!</p>
                                    </div>
                                    <div class="rating_posted_on_google">

                                        <div class="Icon__IconContainer Icon__IconContainer_2">
                                            <img alt="Insaaf99 Rating and Reviews"
                                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                                        </div>
                                        <div class="ReviewSource__">
                                            <p>Posted on Google</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="custome_details">
                                    <div class="customer_img_on_review">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/vishal.webp">
                                    </div>
                                    <div class="customer_name">
                                        <h6>Vishal Gupta</h6>
                                        <p><small>3 Days ago</small></p>
                                    </div>
                                    <div class="blue_tick">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                                    </div>
                                </div>
                                <div class="custormer_reviews">
                                    <div class="rating-star">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                    </div>
                                    <div class="review_text">
                                        <p>Very good experience with Vinny ji</p>
                                    </div>
                                    <div class="rating_posted_on_google">

                                        <div class="Icon__IconContainer Icon__IconContainer_2">
                                            <img alt="Insaaf99 Rating and Reviews"
                                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                                        </div>
                                        <div class="ReviewSource__">
                                            <p>Posted on Google</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="custome_details">
                                    <div class="customer_img_on_review">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/yashi.webp">
                                    </div>
                                    <div class="customer_name">
                                        <h6>Yashi Jain</h6>
                                        <p><small>5 Days ago</small></p>
                                    </div>
                                    <div class="blue_tick">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                                    </div>
                                </div>
                                <div class="custormer_reviews">
                                    <div class="rating-star">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/half_star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/rating.webp">
                                    </div>
                                    <div class="review_text">
                                        <p>Some Issue to Joining a Meeting But Insaaf99 Team Help me.</p>
                                    </div>
                                    <div class="rating_posted_on_google">

                                        <div class="Icon__IconContainer Icon__IconContainer_2">
                                            <img alt="Insaaf99 Rating and Reviews"
                                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                                        </div>
                                        <div class="ReviewSource__">
                                            <p>Posted on Google</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="custome_details">
                                    <div class="customer_img_on_review">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/ayush.webp">
                                    </div>
                                    <div class="customer_name">
                                        <h6>Ayush Tyagi</h6>
                                        <p><small>5 Days ago</small></p>
                                    </div>
                                    <div class="blue_tick">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                                    </div>
                                </div>
                                <div class="custormer_reviews">
                                    <div class="rating-star">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                    </div>
                                    <div class="review_text">
                                        <p>Provided smooth and easy services.</p>
                                    </div>
                                    <div class="rating_posted_on_google">

                                        <div class="Icon__IconContainer Icon__IconContainer_2">
                                            <img alt="Insaaf99 Rating and Reviews"
                                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                                        </div>
                                        <div class="ReviewSource__">
                                            <p>Posted on Google</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="custome_details">
                                    <div class="customer_img_on_review">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/saurabh.webp">
                                    </div>
                                    <div class="customer_name">
                                        <h6>Saurabh Singh</h6>
                                        <p><small>5 Days ago</small></p>
                                    </div>
                                    <div class="blue_tick">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                                    </div>
                                </div>
                                <div class="custormer_reviews">
                                    <div class="rating-star">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                    </div>
                                    <div class="review_text">
                                        <p>Got the best legal advice from Insaaf99 for my startup. Their team was
                                            knowledgeable and
                                            responsive, and they helped me navigate complex legal issues with ease.
                                            Highly recommended
                                        </p>
                                    </div>
                                    <div class="rating_posted_on_google">

                                        <div class="Icon__IconContainer Icon__IconContainer_2">
                                            <img alt="Insaaf99 Rating and Reviews"
                                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                                        </div>
                                        <div class="ReviewSource__">
                                            <p>Posted on Google</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="custome_details">
                                    <div class="customer_img_on_review">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/sai.webp">
                                    </div>
                                    <div class="customer_name">
                                        <h6>Sai Abhishek</h6>
                                        <p><small>6 Days ago</small></p>
                                    </div>
                                    <div class="blue_tick">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                                    </div>
                                </div>
                                <div class="custormer_reviews">
                                    <div class="rating-star">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                        <img width="16" height="16" alt="Insaaf99 Rating and Reviews"
                                            src="<?php echo base_url()?>assets/images/documents/star.webp">
                                    </div>
                                    <div class="review_text">
                                        <p>इंसाफ99 के वकील वास्तव में सबसे अच्छे हैं। उन्होंने मुझे एक कानूनी नोटिस और
                                            एस्टेट प्लानिंग
                                            को मूल रूप से तैयार करने में मदद की। मेरी आवश्यकताओं के अनुरूप व्यावहारिक
                                            सलाह प्रदान की</p>
                                    </div>
                                    <div class="rating_posted_on_google">

                                        <div class="Icon__IconContainer Icon__IconContainer_2">
                                            <img alt="Insaaf99 Rating and Reviews"
                                                src="<?php echo base_url()?>assets/images/mobilehome/google.png">
                                        </div>
                                        <div class="ReviewSource__">
                                            <p>Posted on Google</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="custome_details">
                                    <div class="customer_img_on_review">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/monika.webp">
                                    </div>
                                    <div class="customer_name">
                                        <h6>Monika Garg</h6>
                                        <p><small>7 Days ago</small></p>
                                    </div>
                                    <div class="blue_tick">
                                        <img alt="customer_image"
                                            src="<?php echo base_url()?>assets/images/mobilehome/patch-check-fill.svg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <?php }else{?>
        <h1 class="text-center">Lawyer Details not found</h1>
        <?php }?>
    </div>
</section>