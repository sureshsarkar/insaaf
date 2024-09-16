<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">

<style>
h1 {
    padding: 10px 0;
    font-size: 32px;
    text-align: center;
    color: #3b2eb5;
    font-weight: 500;
}

p {
    font-size: 12px;
}

hr {
    color: #a9a9a9;
    opacity: 0.3;
}

.main-block {
    max-width: 513px;
    min-height: 460px;
    padding: 10px 0;
    margin: auto;
    border-radius: 5px;
    border: solid 1px #ccc;
    box-shadow: 1px 2px 5px rgba(0, 0, 0, .31);
    background: #ebebeb;
}

form {
    margin: 0 30px;
}

.account-type,
.gender {
    margin: 15px 0;
}

input[type=radio] {
    display: none;
}

label#icon {
    margin: 0;
    border-radius: 5px 0 0 5px;
}

label.radio {
    position: relative;
    display: inline-block;
    padding-top: 4px;
    margin-right: 20px;
    text-indent: 30px;
    overflow: visible;
    cursor: pointer;
}

label.radio:before {
    content: "";
    position: absolute;
    top: 2px;
    left: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #1c87c9;
}

label.radio:after {
    content: "";
    position: absolute;
    width: 9px;
    height: 4px;
    top: 8px;
    left: 4px;
    border: 3px solid #fff;
    border-top: none;
    border-right: none;
    transform: rotate(-45deg);
    opacity: 0;
}

input[type=radio]:checked+label:after {
    opacity: 1;
}

input[type=text],
input[type=password] {
    width: calc(100% - 39px);
    height: 36px;
    margin: 13px 0 0 -5px;
    padding-left: 10px;
    border-radius: 0 5px 5px 0;
    border: solid 1px #cbc9c9;
    box-shadow: 1px 2px 5px rgba(0, 0, 0, .09);
    background: #fff;
}

input[type=password] {
    margin-bottom: 15px;
}

#icon {
    display: inline-block;
    padding: 9.3px 15px;
    box-shadow: 1px 2px 5px rgba(0, 0, 0, .09);
    background: #1c87c9;
    color: #fff;
    text-align: center;
}

.btn-block {
    margin-top: 10px;
    text-align: center;
}

button {
    width: 100%;
    padding: 10px 0;
    margin: 10px auto;
    border-radius: 5px;
    border: none;
    background: #1c87c9;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
}

button:hover {
    background: #26a9e0;
}

.mt-2 {
    margin-top: 10px;
    border-radius: 7px !important;
}

.formInnerGIF {
    display: none;
}
</style>

<!-- ================================================================================================= -->

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
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="main-block">
                        <div class="formInnerGIF" id="loaderAreaCon">
                            <div class="row">
                                <div class="col-md-12 text-center py-5">
                                    <img src="<?php echo base_url('assets/images/loader.gif') ?>" alt="" width="40%">
                                </div>
                            </div>
                        </div>
                        <div class="Form_hide">
                            <h1> Free Query </h1>
                            <form role="form" id="member_form"
                                action="<?php echo base_url()?>client/Dashboard/Send_free_query" method="post"
                                role="form" enctype="multipart/form-data">
                                <label id="icon" for="name"><i class="fa fa-user"></i></label>
                                <input type="text" name="name" id="name" value="<?php echo  $_SESSION['name'];?>" />
                                <textarea type="text" id="name" name="query" class="form-control mt-2"
                                    value="<?=$Query_data->query; ?>"><?=$Query_data->query; ?></textarea>
                                <hr>
                                <hr>
                                <div class="btn-block">
                                    <p>Your first query will be free in a text form</p>
                                    <input type="hidden" name="q_id" value="<?=$Query_data->id?>" />
                                    <input type="hidden" name="client_id" value="<?=$_SESSION['id'];?>" />
                                    <input type="hidden" name="c_name" value="<?=$_SESSION['name'];?>" />
                                    <input type="hidden" name="c_email" value="<?=$_SESSION['email'];?>" />
                                    <input type="hidden" name="c_mobile" value="<?=$_SESSION['phone'];?>" />
                                    <button type="submit" class="Fquery">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(document).ready(function() {
    $(".Fquery").click(function() {
        $(".formInnerGIF").show();
        $(".Form_hide").hide();
    })
});
</script>