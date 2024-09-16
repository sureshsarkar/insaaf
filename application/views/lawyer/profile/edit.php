<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"
    integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

<style type="text/css">
.content-wrapper {
    background: #e1ebf7;
}

.bg__white_col {
    background: #f7f9fc;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    /* margin: 2rem; */
    border-radius: 10px;
    padding: 1rem;
    max-width: 1097px;

}

.dasProfile img {
    width: 200px;
    height: 200px;
    border-radius: 100%;
    margin: auto;
    object-fit: cover;
    cursor: pointer;

}

.dasProfile {
    position: relative;
    /* top: -60px; */
    transform: translate(10px, 10px);

}

.radius__col img {
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
}

.profile___name .name {
    font-size: 3.5rem;
    margin-top: 20px;
    color: #000;
    font-weight: 700;
    font-family: arial;
}

.profile___name {
    padding-bottom: 2rem;
    border-bottom: 1px solid #e9e9e9;
}

.profile___name .profession {
    text-indent: 2px;
    font-size: 2rem;
    color: #918b8b;
    font-weight: 500;
    font-family: arial;
}



.profile___name {
    display: grid;
}

.prevent-select {
    -webkit-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.edit_button .editpro1212 {
    color: #fff;
    width: 20%;
    color: #fff;
    background: #f0c14b;
    border-color: #1fd079 #03a857 #088f4d;
    color: #fff;
    background: #f3d078;
    background: -webkit-linear-gradient(top, #f7dfa5, #f0c14b);
    background: linear-gradient(to bottom, #03a857, #21cf7a);
    font-size: 2rem;
    margin-bottom: 2rem;
}

/*.__about__dash_profile p {
  cursor: no-drop;
}*/

.__about__dash_profile {
    padding: 9px;
    font-size: 1.5rem;
    -webkit-box-shadow: rgb(100 100 111 / 30%) 0px 7px 29px 0px;
    box-shadow: rgb(100 100 111 / 30%) 0px 7px 29px 0px;
    margin-top: 2rem;
    margin-bottom: 2rem;
    background: #fff;
}

.profile___dxc_ ul li {
    font-size: 1.7rem;
    list-style: none;
    padding: 0;
}

.profile___dxc_ ul {

    padding: 0;
}



.profile___dxc_ {

    -webkit-box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    padding: 1rem;
    border-radius: 10px;
    background: #fff;

}

.__about__dash_profile textarea {
    border: none;
    width: 100%;
    height: auto;
    overflow: hidden;
}

.about {
    min-height: 150px;
    text-indent: 5px;
    padding: 1rem;
}

.about:focus {
    outline: 0;
}

.br-left {
    border-left: 1px solid #e9e9e9;
}


.bg__white_col .form-group {
    -webkit-box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    padding: 1rem;
}

.__mainCol .form-group {
    background: #e4ffe4 !important;
}

.__mainCol .__about__dash_profile {
    background: #e4ffe4 !important;
}

.classified {
    font-size: 2rem;
    color: #000;
    /* background: #e7e4e4; */
    border-radius: 6px !important;
    padding: 2rem;
    border: 0;
}

.classified676766 {
    font-size: 2rem;
    color: #000;
    /* background: #e7e4e4; */
    border-radius: 6px !important;
    /* padding: 2rem; */
    border: 0;
}

.classified1121:focus {
    outline: 0 !important;
    border: 0 !important;
    color: #fff !important;

}

.classified1121:hover {
    outline: 0;
    border: 0;
    color: #fff;

}

.classified11213434:focus {
    outline: 0 !important;
    border: 0 !important;
    color: #fff !important;

}

.classified11213434:hover {
    outline: 0;
    border: 0;
    color: #fff;

}


.classified1121btn:focus {
    outline: 0 !important;
    border: 0 !important;
    color: #fff !important;
    cursor: pointer;
    font-size: 2rem;
    margin-top: 2rem;
    height: 50px;
    color: #111 !important;
    background: #f0c14b;
    border-color: #a88734 #9c7e31 #846a29;
    color: #111;
    background: #f3d078;
    background: -webkit-linear-gradient(top, #f7dfa5, #f0c14b);
    background: linear-gradient(to bottom, #f7dfa5, #f0c14b);
    padding: 0.7rem 0.5rem;
    width: 121px;
    border-radius: 4px;

}

.classified1121btn:hover {
    cursor: pointer;
    font-size: 2rem;
    margin-top: 2rem;
    height: 50px;
    color: blue;
    color: #fff;
    background: #f0c14b;
    border-color: #a88734 #9c7e31 #846a29;
    color: #111;
    background: #f3d078;
    background: -webkit-linear-gradient(top, #f7dfa5, #f0c14b);
    background: linear-gradient(to bottom, #f7dfa5, #f0c14b);
    padding: 0.7rem 0.5rem;
    width: 60%;
    border-radius: 4px;

}

.classified1121 {
    cursor: pointer;
    font-size: 2rem;
    margin-top: 2rem;
    margin-left: 2rem;
    height: 50px;
    color: #1a243f;
    background: #e1e1e1;
    padding: 0.7rem 0.5rem;
    border: 0;
    width: 121px;
    border-radius: 4px;

}

.classified11213434 {
    cursor: pointer;
    font-size: 2rem;
    margin-left: 2rem;
    height: 50px;
    color: #1a243f;
    background: #e1e1e1;
    padding: 0.7rem 0.5rem;
    border: 0;
    width: 121px;
    border-radius: 4px;

}

.ressetBtn {
    float: right;
    margin-top: 8px;
    background: #e3e3e3;
}

.ressetBtn:focus {
    outline: 0 !important;
    border: 0 !important;
}

.pad-l {
    padding-left: 0;
}

.classified1121btn {
    cursor: pointer;
    font-size: 2rem;
    margin-top: 2rem;
    height: 50px;
    color: blue;
    color: #fff;
    background: #f0c14b;
    border-color: #a88734 #9c7e31 #846a29;
    color: #111;
    background: #f3d078;
    background: -webkit-linear-gradient(top, #f7dfa5, #f0c14b);
    background: linear-gradient(to bottom, #f7dfa5, #f0c14b);
    padding: 0.7rem 0.5rem;
    width: 60%;
    border-radius: 4px;

}

.w2-100 {
    width: 100%;
}

.__flex_item {
    display: inline-flex;
    width: 96%;
}

.classified1121:hover {
    cursor: pointer;
    font-size: 2rem;
    margin-top: 2rem;

    height: 50px;
    color: blue;
    color: #fff;
    background: #03a857;
    padding: 0.7rem 0.5rem;
    border: 0;
    width: 121px;
    border-radius: 4px;
}

.classified__space {
    margin-top: 30px;

}

.classified__space label {
    font-size: 1.6rem;
    font-weight: 400;
    font-family: arial;

}

.heade__abo h2 {
    font-family: arial;
    border-bottom: 1px solid #e6e6e6;
    /* padding-bottom: 2rem; */
}

.mar______ {
    display: flex;
    background: #fff;
    border-radius: 7px;
    padding: 5px;

}

.m-lable {
    margin-bottom: 0px;
}

.mar232______ {
    margin-left: 20px;
}

.msg .green__88 {
    display: block;
    color: green;
    font-size: 15px;
    margin-left: 14px;
}

.group-d {
    background-color: #dfdfdf !important;
    margin-bottom: 15px;
    -webkit-box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    padding: 1rem;
}



.d-text {
    color: #b6b6b6;
}

.msg .red__88 {
    display: block;
    color: red;
    font-size: 15px;
    margin-left: 14px;
}

.msg343 .red__88 {
    float: left;
    display: block;
    color: red;
    font-size: 15px;
    margin-left: 14px;
}

.col_base {
    border: 1px solid #000 !important;
}

.verify_opt {
    display: none;
}

.flot_ll {

    float: left;
    background: #03a857;
    color: white;
    font-size: 2rem;

}

.flot_ll:hover {

    color: #fff;

}

.flot_ll:focus {
    outline: 0 !important;
    border: 0 !important;
    color: #fff;

}

.___edit__pencil {
    width: 35px;
    position: absolute;
    right: 56px;
    bottom: 11px;
    background: #fff;
    padding: 1rem;
    border-radius: 100%;
    cursor: pointer;
    height: 35px;
    text-align: center;
}

.rpin-code {
    padding: 0;
    margin: 0 auto;
    /* display: flex; */

}

.rpin-code input {
    border: 1px solid #cbcbcb;
    width: 32px;
    height: 32px;
    font-size: 21px;
    background-color: #e7e7e7;
    margin-right: 5px;
    text-align: center;
}

.rcpin-code {
    padding: 0;
    margin: 0 auto;
    /* display: flex; */

}

.rcpin-code input {
    border: 1px solid #cbcbcb;
    width: 32px;
    height: 32px;
    font-size: 21px;
    background-color: #e7e7e7;
    margin-right: 5px;
    text-align: center;
}

.marui____ {
    margin-left: -73px;
}

.maruiyuy____ {
    margin-left: -69px;
}

.viewrcpassword {
    margin-top: 7px;
}

.__margin90 {
    margin-top: 30px;
}

.editCon {
    padding: 0px 7px;
}

.py-3 {
    padding: 30px 0px;
}

.px-3 {
    padding: 0px 30px;
}

div[role="progressbar"] {
    --size: 12rem;
    --fg: #ff9800;
    --bg: #def;
    --pgPercentage: var(--value);
    animation: growProgressBar 5s 1 forwards;
    width: var(--size);
    height: var(--size);
    border-radius: 50%;
    display: grid;
    place-items: center;
    background:
        radial-gradient(closest-side, white 80%, transparent 0 99.9%, white 0),
        conic-gradient(var(--fg) calc(var(--pgPercentage) * 1%), var(--bg) 0);
    font-family: Helvetica, Arial, sans-serif;
    font-size: calc(var(--size) / 5);
    color: var(--fg);
}

div[role="progressbar"]::before {
    counter-reset: percentage var(--value);
    content: counter(percentage) '%';
}
</style>
<?php $experience=array('1 Year','2 Year','3 Year','4 Year','5 Year','6 Year','7 Year','8 Year','9 Year','10 Year','11 Year','12 Year','13 Year','14 Year','15 Year','16 Year','17 Year','18 Year','19 Year','20 Year','21 Year','22 Year','23 Year','24 Year','25 Year','26 Year','27 Year','28 Year','29 Year','30 Year','31 Year','32 Year','33 Year','34 Year','35 Year','36 Year','37 Year','38 Year','39 Year','40 Year','41 Year','42 Year','43 Year','44 Year','45 Year');?>
<?php if(isset($userData) && !empty($userData)){
    
   ?>

<div class="content-wrapper">
    <!-- complete your profile sec-->
    <div class="container">
        <div class="row editCon <?=  ($userData->profile_complete > 95)?'hidden':'' ?> ">
            <div class="box">
                <div class="row py-3">
                    <div class="col-md-3 col-xs-3 text-center px-3">
                        <!-- progress bar-->
                        <div class="ml-3" role="progressbar" aria-valuenow="<?=  $userData->profile_complete ?>"
                            aria-valuemin="0" aria-valuemax="100" style="--value:<?=  $userData->profile_complete ?>">
                        </div>
                        <!-- end progress bar-->
                    </div>
                    <div class="col-md-9 col-xs-8">
                        <h2 class="text-danger yourProfileTextSize">Your profile <?=  $userData->profile_complete ?>%
                            completed.</h2>
                        <?= (isset($_GET['action']) && $_GET['action'] == 'verification_doc')?'<h2 class="blink" >Upload Enrolment Certificate for verification</h2>':'' ?>
                        <?= (isset($_GET['action']) && $_GET['action'] == 'verify_email')?'<h2 class="blink" >Verify your email id</h2>':'' ?>

                        <?= (isset($_GET['action']) && $_GET['action'] == 'update_category')?'<h2 class="blink" >Update Your Case Category</h2>':'' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--// complete your profile sec-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <section>
            <div class="container">
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
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" action="<?php echo base_url('lawyer/profile/update')?>" role="form" id="form1"
                        enctype="multipart/form-data">
                        <div class="bg__white_col">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="dasProfile change__img" id="previewImg">
                                                <div class="___edit__pencil">
                                                    <i class=" bi-pencil-fill"></i>
                                                </div>
                                                <img src="<?php if(isset($userData->image) && !empty($userData->image)){
                                                echo base_url().$userData->image;
                                             }else{ echo base_url().'assets/images/new_user.png';
                                             }?>" class="img-responsive" id="showIMG">

                                            </div>
                                            <input type="file" name="image" id="lawyerFile" class="hidden">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-9 br-left">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="profile___name">
                                                <span class="name"><?=$userData->fname.' '.$userData->lname?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="classified__space __mainCol">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label type="text">First Name:</label><br>

                                                            <input type="text" name="fname" id="fname"
                                                                class="form-control classified"
                                                                value="<?=$userData->fname?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label type="text">Last Name:</label><br>
                                                            <input type="text" name="lname" id="lname"
                                                                class="form-control classified"
                                                                value="<?=$userData->lname?>" placeholder=" ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">


                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label type="text">Gender:</label><br>
                                                            <div class=" mar______">
                                                                <?php 
                                                                    $checked1="";
                                                                    $checked2="";
                                                                    $checked3="";
                                                                    if($userData->gender==1){
                                                                        $checked1="checked";
                                                                        }else if($userData->gender==2){
                                                                            $checked2="checked";
                                                                            }else if($userData->gender==3){
                                                                                $checked3="checked";}
                                                                                ?>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" id="inlineRadio1" value="1"
                                                                        <?php echo $checked1;?> />
                                                                    <label class="form-check-label m-lable"
                                                                        for="inlineRadio1">Male</label>
                                                                </div>

                                                                <div class="form-check form-check-inline mar232______">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" id="inlineRadio2" value="2"
                                                                        <?php echo $checked2;?> />
                                                                    <label class="form-check-label m-lable"
                                                                        for="inlineRadio2">Female</label>
                                                                </div>
                                                                <div class="form-check form-check-inline mar232______">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gender" id="inlineRadio3" value="3"
                                                                        <?php echo $checked3;?> />
                                                                    <label class="form-check-label m-lable"
                                                                        for="inlineRadio3">Other</label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="__flex_item">

                                                            <div class="form-group w2-100">
                                                                <label type="text">Email:</label><br>
                                                                <?= empty($userData->email)?'<label class="text-danger" ><small>Update Email</small></label>':'' ?>
                                                                <input type="text" name="Email" id="e-mail"
                                                                    class="form-control classified"
                                                                    value="<?=$userData->email?>" disabled>
                                                            </div>
                                                            <button type="button" class="btn classified1121"
                                                                id="_change" data-toggle="modal"
                                                                data-target="#exampleModal8989">
                                                                Change
                                                            </button>


                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class=" group-d">
                                                            <label type="text" class="d-text ">Mobile
                                                                Number:</label><br>
                                                            <input type="text" name="mob_number" id="mname"
                                                                class="form-control classified OnlyNumberInput d-text "
                                                                value="<?=$userData->mobile?>" disabled="">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class=" group-d">
                                                            <label type="text" class="d-text ">lawyer ID:</label><br>
                                                            <input type="text" name="lawyer" id="Id-lawyer"
                                                                class="form-control d-text  classified "
                                                                value="<?=$userData->lawyer_unique_id?>" disabled="">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label type="text">Lawyer Category</label><br>
                                                            <?= empty($userData->category)?'<label class="text-danger" ><small>Select your category</small></label>':'' ?>

                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn  classified11213434"
                                                        data-toggle="modal" data-target="#exampleModal89892323">
                                                        Change
                                                    </button>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label type="text">Enrolment No:</label><br>
                                                            <?= empty($userData->enrolement_no)?'<label class="text-danger" ><small>Add your Enrolment No</small></label>':'' ?>
                                                            <input type="text" name="enrolement_no" id="lname"
                                                                class="form-control classified"
                                                                value="<?=$userData->enrolement_no?>" placeholder=" ">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label type="text"> Bar council :</label><br>
                                                            <?= empty($userData->bar_councle)?'<label class="text-danger" ><small> Specify Bar council of registration</small></label>':'' ?>

                                                            <input type="text" name="bar_councle" id="lname"
                                                                class="form-control classified"
                                                                value="<?=$userData->bar_councle?>"
                                                                placeholder="Enter your Bar Council">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label type="text">Experience</label><br>
                                                            <?= empty($userData->experience)?'<label class="text-danger" ><small>Add your Experience</small></label>':'' ?>
                                                            <select name="experience"
                                                                class="form-control classified676766">
                                                                <?php foreach($experience as $evalue){?>
                                                                <option value="<?php echo $evalue?>"
                                                                    <?php if($userData->experience==$evalue) echo 'selected';?>>
                                                                    <?php echo $evalue?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label type="text">Practice Area :</label><br>
                                                            <?= empty($userData->practice_area)?'<label class="text-danger" ><small>Add your Practice Area</small></label>':'' ?>
                                                            <input type="text" name="practice_area" id="lname"
                                                                class="form-control classified"
                                                                value="<?=$userData->practice_area?>"
                                                                placeholder="Enter your Practice Area ">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label type="text">State :</label><br>
                                                            <?= empty($userData->state)?'<label class="text-danger" ><small>Add your state</small></label>':'' ?>
                                                            <input type="text" name="state"
                                                                class="form-control classified"
                                                                value="<?=$userData->state?>"
                                                                placeholder="Enter your state">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label type="text">City :</label><br>
                                                            <?= empty($userData->city)?'<label class="text-danger" ><small>Add your city</small></label>':'' ?>
                                                            <input type="text" name="city"
                                                                class="form-control classified"
                                                                value="<?=$userData->city?>"
                                                                placeholder="Enter your city">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label type="text">Languages Known :</label><br>
                                                            <?= empty($userData->language)?'<label class="text-danger" ><small>Add your languages known </small></label>':'' ?>
                                                            <input type="text" name="language"
                                                                class="form-control classified"
                                                                value="<?=$userData->language?>"
                                                                placeholder="Enter your language">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label type="text">Enrolment Certificate :</label><br>
                                                            <?= empty($userData->enrol_image)?'<label class="text-danger blink" ><small>Upload Enrolment Certificate</small></label>':'' ?>
                                                            <input type="file" name="enrol_image"
                                                                class="form-control classified1"
                                                                value="<?=$userData->enrol_image?>">
                                                        </div>
                                                    </div>
                                                    <?php if(isset($userData->enrol_image) && !empty($userData->enrol_image)){?>
                                                    <div class="col-md-2 text-center mt-3">
                                                        <a href="<?=base_url('uploads/lawyer/').$userData->enrol_image?>"
                                                            class="__margin90 btn btn-success" target="_blank"
                                                            title="View">
                                                            view

                                                        </a>
                                                    </div>
                                                    <?php }?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="heade__abo">
                                                            <h2>About</h2>
                                                            <?= empty($userData->about)?'<label class="text-danger" ><small>Bio</small></label>':'' ?>
                                                        </div>
                                                        <div class="__about__dash_profile">
                                                            <textarea class="about" name="about" id="about"
                                                                value="<?=$userData->about?>"
                                                                name="about"><?=$userData->about?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="heade__abo">
                                                            <h2>Additional Info:</h2>
                                                        </div>
                                                        <div class="__about__dash_profile">
                                                            <textarea class="address" name="address" id="address"
                                                                value="<?=$userData->address?>"
                                                                name="address"><?=$userData->address?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="msg"></div>
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="oldimage1"
                                                            value="<?=$userData->image?>">
                                                        <input type="hidden" name="oldimage2"
                                                            value="<?=$userData->enrol_image?>">
                                                        <div class="edit_button">
                                                            <button type="submit" class="btn editpro1212 "
                                                                id="save_data">
                                                                Save</button>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="edit_button ">

                                                            <button type="button" class="btn ressetBtn "
                                                                data-toggle="modal" data-target="#exampleModal89895">
                                                                Reset Your Password
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <style type="text/css">
    .__type_modal {
        border-radius: 10px;
    }

    .__type_modal .modal-title {
        font-size: 2rem;
    }

    .dmfgkdj {
        width: 50%;
    }
    </style>

    <!-- passwprd reset modal -->

    <div class="modal fade" data-backdrop="static" id="exampleModal89895" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content __type_modal">
                <div class="modal-header">
                    <h5 class="modal-title text-warning" id="exampleModalLabel">Update your password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                            aria-hidden="true">×</span> </button>
                </div>
                <div class="modal-body">
                    <div class="row text-center">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label type="text" class="marui____">New Password :</label><br>
                                <div class="rpin-code password">
                                    <input type="password" class="pinClass rpin1" data-next=".rpin2" maxlength="1">
                                    <input type="password" class="pinClass rpin2" data-next=".rpin3" maxlength="1">
                                    <input type="password" class="pinClass rpin3" data-next=".rpin4" maxlength="1">
                                    <input type="password" class="pinClass rpin4" data-next=".crpin1" maxlength="1">
                                    <span class="fa fa-fw fa-eye  viewpassword frodjf viewPass" data-target="password"
                                        data-status="0"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label type="text" class="maruiyuy____">Confirm Password :</label><br>
                                <div class="rcpin-code cpassword ">
                                    <input type="password" class="crpin1" data-next=".crpin2" maxlength="1">
                                    <input type="password" class="crpin2" data-next=".crpin3" maxlength="1">
                                    <input type="password" class="crpin3" data-next=".crpin4" maxlength="1">
                                    <input type="password" class="crpin4" data-next="" maxlength="1">
                                    <span class="fa fa-fw fa-eye  viewrcpassword frodjf viewCPass"
                                        data-target="cpassword" data-status="0"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="msg"></div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="col-md-12 pad-l">
                                <button type="button" class="btn classified1121btn save_pin">
                                    Set Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  -->
    <!-- change modal -->
    <div class="modal fade" data-backdrop="static" id="exampleModal8989" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content __type_modal ">
                <div class=" hfgjdhfgjh">
                    <!-- Loader div -->

                </div>
                <div class="dgfhh">


                    <div class="modal-header">
                        <h5 class="modal-title dis_block" id="exampleModalLabel">Enter Your Email ID</h5>
                        <h5 class="modal-title verify_opt" id="exampleModalLabel">Enter OTP sent to Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                aria-hidden="true">&times;</span> </button>

                    </div>
                    <div class="modal-body">
                        <input type="email" name="email" id="email" class="form-control dis_block"
                            placeholder="Enter your email Id" value="<?php (!empty($userData->email))?"ok":'';?>"
                            autocomplete="off">
                        <input type="number" class="form-control optval verify_opt" value="" required>
                    </div>
                    <div class="modal-footer dmfgkdj">
                        <button type="button" class="btn flot_ll send_opt_email dis_block">Send OTP</button>
                        <button type="button" class="btn flot_ll verify_opt verify_opt_send">Verify</button>
                        <div class="msg343"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Lawyer Category modal -->
    <div class="modal fade" id="exampleModal89892323" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">

            <div class="modal-content __type_modal ">
                <section class="content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="font-size: 30px;">&times;</span>
                    </button>
                    <form action="<?= base_url()?>lawyer/profile/update_lawyer_category" method="post">
                        <!-- <input type="text" name="lawyer_id" value="189"> -->
                        <?php 
                            $temp = empty($userData->category)?'':json_decode($userData->category,true);
                            $myCateCount = 0;
                                $myCat = array();
                                if(!empty($temp)){
                                    foreach($temp as $catId){
                                        $myCat[$catId] = 1;
                                        $myCateCount++;
                                     
                                    }
                                }
                        ?>
                        <div class="">
                            <h2>Category <small class="pull-right">Your Selected Category(<?= $myCateCount ?>) </small>
                            </h2>
                            <hr />
                        </div>
                        <!-- list -->
                        <div class="categoryListCon">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">

                                    <tbody>
                                        <tr>
                                            <td>Select All</td>
                                            <td>
                                                <input type="checkbox" id="checkAll">
                                            </td>
                                        </tr>

                                        <?php 
                                      if(isset($caseCategory) && !empty($caseCategory)){
                                        
                                        foreach($caseCategory as $cal){?>
                                        <tr>
                                            <td><?php echo $cal->name ;?></td>
                                            <td>
                                                <input type="checkbox" name="category[]" value="<?php echo $cal->id ;?>"
                                                    <?= isset($myCat[$cal->id])?'checked':'' ?>>
                                            </td>
                                        </tr>
                                        <?php }}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="text-right mr-5 pt-5 mb-5">
                                <input type="hidden" name="action"
                                    value="<?= (isset($_GET['action2']))?$_GET['action2']:'' ?>">
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </div>
                        </div>
                        <!-- end list-->
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
<?php }?>
<!-- Delete Script-->
<script type="text/javascript">
$("#_change").click(function() {
    var e = "<?php echo $userData->email?>";
    $("#email").val(e);

});

$("#previewImg").click(function() {

    $("#lawyerFile").trigger("click");
}) // Live Image change ontime ===========================================

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#showIMG').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}



$("#lawyerFile").change(function() {
    readURL(this);
});

jQuery(document).ready(function() {
    var emailVeriry = "<?= (isset($_GET['action']) && $_GET['action'] == 'verify_email')?true:false; ?>";
    var updateCategory = "<?= (isset($_GET['action2']) && $_GET['action'] == 'update_category')?true:false; ?>";
    if (emailVeriry) {
        $(".classified1121 ").trigger("click");
    } else if (updateCategory) {
        $(".classified11213434 ").trigger("click");
    }


    // Save changes profile data


    // ------------------------------------------     
    $("#form1").submit(function() {
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var about = $("#about").val();
        var image = $("#lawyerFile").val();


        //return false;

    });
    // Save changes profile data end
    // Loader function

    function loadergif(className, type) {
        $("." + className).css("display", type);
        $("." + className).html(
            '<div class="text-center"><img src="<?=base_url()?>assets/images/loader.gif" width="70" class="img-fluid" alt="IKP"><br><br><p>Please wait !</p></div>'
        );
    }
    // send email otp start
    $(".send_opt_email").click(function() {

        var email = $("#email").val();

        var emailvalid = validate(email);

        if (email == "") {
            $(".msg343").css("display", "block");
            $(".msg343").html(
                "<div class='red__88'>Enter Your Email Id </div>"
            );

            setInterval(function() {
                $(".msg343").css("display", "none");
            }, 5000);
            return false;
        }

        if (emailvalid == false) {
            $(".msg343").css("display", "block");
            $(".msg343").html(
                "<div class='red__88'>Enter Valid Email Id </div>"
            );

            setInterval(function() {
                $(".msg343").css("display", "none");
            }, 5000);
            return false;
        }

        var className = 'hfgjdhfgjh';
        var type = 'block';

        loadergif(className, type);
        $(".dgfhh").css("display", "none");
        var email = $("#email").val();

        var url = "<?php echo base_url('lawyer/profile/send_email_otp'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                email: email
            },
            success: function(response) {
                if (response == 1) {
                    var type = 'none';
                    $(".hfgjdhfgjh").css("display", "none");
                    $(".dgfhh").css("display", "block");
                    $(".dis_block").css("display", "none");
                    $(".verify_opt").css("display", "block");
                    return false;
                } else {
                    var type = 'none';
                    loadergif(className, type);
                    $(".dis_block").css("display", "block");
                    $(".verify_opt").css("display", "none");
                }
            }
        });
        return false;

    });
    // send email otp start

    // Verify email otp start***********************************************************
    $(".verify_opt_send").click(function() {
        var email = $("#email").val();
        var otp = $(".optval").val();
        // progress active
        $(".hfgjdhfgjh").css("display", "block");
        $(".dgfhh").css("display", "none");

        var url = "<?php echo base_url('lawyer/profile/verify_email_otp'); ?>";
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                email: email,
                otp: otp
            },
            success: function(responce) {

                if (responce == 1) {
                    // progress active
                    $(".hfgjdhfgjh").css("display", "none");
                    alert("Email id Successfully Updated");
                    window.location.href =
                        "<?= (isset($_GET['action']) && $_GET['action'] =='verify_email')?base_url('lawyer/my_scheduler?action=complete_profile'):base_url('lawyer/profile') ?>";
                    return false;
                } else {
                    $(".dis_block").css("display", "none");
                    $(".verify_opt").css("display", "block");

                    $(".msg343").css("display", "block");
                    $(".msg343").html(
                        "<div class='red__88'>Enter Valid OTP!</div>"
                    );

                    $(".hfgjdhfgjh").css("display", "none");
                    $(".dgfhh").css("display", "block");

                    setInterval(function() {
                        $(".msg343").css("display", "none");
                    }, 2000);
                    return false;
                }
            }
        });
        return false;

    });
    // Verify email otp start

    //$('#example').DataTable();

    jQuery(document).on("click", ".deletebtn", function() {
        var tableId = $(this).attr("data_id");
        currentRow = $(this);
        hitURL = "<?php echo base_url() ?>lawyer/lawyer/delete";
        var confirmation = confirm("Are you sure to delete this Categorys ?");
        if (confirmation) {
            $.ajax({
                type: 'POST',
                url: hitURL,
                data: {
                    id: tableId
                },
            }).done(function(data) {
                currentRow.parents('tr').remove();
                if (data.status = true) {
                    alert("successfully deleted");
                    location.reload();
                } else if (data.status = false) {
                    alert("deletion failed");
                } else {
                    alert("Access denied..!");
                }
            });



        }
    });
});
</script>
<!-- Get Databse List -->


<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>



<script type="text/javascript">
$('.OnlyNumberInput').keypress(function(event) {
    var code = event.which;

    if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
            $(this).val().indexOf('.') != 0) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
}).on('paste', function(event) {
    event.preventDefault();
});
</script>


<script type="text/javascript">
// pin auto next

//var pinContainer = document.getElementsByClassName("pin-code")[0];
var pinContainer = document.querySelector(".rpin-code");

console.log('There is ' + pinContainer.length + ' Pin Container on the page.');

pinContainer.addEventListener('keyup', function(event) {
    var target = event.srcElement;

    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
    var myLength = target.value.length;

    // if (myLength >= maxLength) {
    //     var next = target;
    //     while (next = next.nextElementSibling) {
    //         if (next == null) break;
    //         if (next.tagName.toLowerCase() == "input") {
    //             next.focus();
    //             break;
    //         }
    //     }
    // }

    if (myLength === 0) {
        var next = target;
        while (next = next.previousElementSibling) {
            if (next == null) break;
            if (next.tagName.toLowerCase() == "input") {
                next.focus();
                break;
            }
        }
    }
}, false);

pinContainer.addEventListener('keydown', function(event) {
    var target = event.srcElement;
    target.value = "";
}, false);
</script>
<script type="text/javascript">
// pin auto next

//var pinContainer = document.getElementsByClassName("pin-code")[0];
var pinContainer = document.querySelector(".rcpin-code");

console.log('There is ' + pinContainer.length + ' Pin Container on the page.');

pinContainer.addEventListener('keyup', function(event) {
    var target = event.srcElement;

    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
    var myLength = target.value.length;

    if (myLength >= maxLength) {
        var next = target;
        while (next = next.nextElementSibling) {
            if (next == null) break;
            if (next.tagName.toLowerCase() == "input") {
                next.focus();
                break;
            }
        }
    }

    // if (myLength === 0) {
    //     var next = target;
    //     while (next = next.previousElementSibling) {
    //         if (next == null) break;
    //         if (next.tagName.toLowerCase() == "input") {
    //             next.focus();
    //             break;
    //         }
    //     }
    // }
}, false);

pinContainer.addEventListener('keydown', function(event) {
    var target = event.srcElement;
    target.value = "";
}, false);
</script>

<!-- view password  -->
<script>
$(".viewPass").click(function() {
    var target = $(this).attr("data-target");
    var status = $(this).attr("data-status");
    if (status == 1) {
        $("." + target + " input").attr("type", "password");
        $(this).attr("data-status", '0');
    } else {
        $("." + target + " input").attr("type", "text");
        $(this).attr("data-status", '1');
    }
});
// view confirm password 
$(".viewCPass").click(function() {
    var target = $(this).attr("data-target");
    var status = $(this).attr("data-status");
    if (status == 1) {
        $("." + target + " input").attr("type", "password");
        $(this).attr("data-status", '0');
    } else {
        $("." + target + " input").attr("type", "text");
        $(this).attr("data-status", '1');
    }
});


// $(".save_pin").click(function() {
//  alert("pl");
// });
// Save Password 

$(".save_pin").click(function() {


    var pin1 = $(".rpin1").val();
    var pin2 = $(".rpin2").val();
    var pin3 = $(".rpin3").val();
    var pin4 = $(".rpin4").val();

    var cpin1 = $(".crpin1").val();
    var cpin2 = $(".crpin2").val();
    var cpin3 = $(".crpin3").val();
    var cpin4 = $(".crpin4").val();
    var password = pin1 + pin2 + pin3 + pin4;
    var cpassword = cpin1 + cpin2 + cpin3 + cpin4;
    var url = "<?php echo base_url('lawyer/profile/save_pin'); ?>";

    if (cpassword.trim() != password.trim()) {
        $(".msg").css("display", "block");
        $(".msg").html(
            "<p style='margin-left: 44px;color: red;font-weight: 600;text-align:center;'>Password mistmatch!</p>"
        );
        setInterval(function() {
            $(".msg").css("display", "none");
        }, 4000);

        $(".cpassword input").val('');
        return false;
    } else {
        // form data

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                password: password,
                cpassword: cpassword
            },
            success: function(response) {
                if (response == 1) {
                    $(".msg").css("display", "block");
                    $(".msg").html(
                        "<p style='margin-left: 44px;color: green;font-weight: 600;text-align:center;'>Password updated!</p>"
                    );
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

                } else {
                    $(".msg").css("display", "block");
                    $(".msg").html(
                        "<p style='margin-left: 44px;color: red;font-weight: 600;text-align:center;'>Your Old Password same as New Password!</p>"
                    );
                    setInterval(function() {
                        $(".msg").css("display", "none");
                    }, 4000);

                    $(".cpassword input").val('');
                    return false;
                }
            }
        });
        return false;
    }
});


// focus
$(".pinClass").keyup(function() {
    var next = $(this).attr('data-next');
    if (this.value.length >= 1) {
        $(this).attr('type', "password");
        if (next != '') {
            $(next).focus();
            $(this).attr('type', "password");
        }
    }
});

// focus
$("#mobile").keyup(function() {
    if (this.value.length == 10) {
        $(".pin1").focus();
    }
});


// email validation 
function validate(email) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (reg.test(email) == false) {
        $('.email_validation').html('<div class="alert-danger">Invalid Email Address</div>');
        $(".apply_btn").attr("disabled", "disabled");
        return (false);
    } else {
        $('.email_validation').html('');
        return (true);
    }

}
</script>


<script>
$("#checkAll").click(function() {
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>