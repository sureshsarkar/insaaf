<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>


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

}

.dasProfile {
    position: relative;
    top: -60px;
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

.edit_button .editpro {
    margin-top: 20px;
    background: #0a66c2;
    padding: 1rem;
    font-style: unset !important;
    float: right;
    color: #fff;
    -webkit-box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    font-family: arial;
    margin-right: 10px;
    font-size: 1.5rem;

}

.edit_button .editpro:hover {
    margin-top: 20px;
    background: #0a66c2;
    padding: 1rem;
    font-style: unset !important;
    float: right;
    color: #fff;
    -webkit-box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    font-family: arial;
    margin-right: 10px;
    font-size: 1.5rem;

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

.dxcspan_ {
    width: 150px;
    font-weight: 600;
    padding: 1rem;
}

.profile___dxc_ {

    -webkit-box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    padding: 1rem;
    border-radius: 10px;
    background: #fff;

}

.br-left {
    border-left: 1px solid #e9e9e9;
}


.bg__white_col .form-group {
    -webkit-box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
    padding: 1rem;
}

.classified {
    font-size: 2rem;
    color: #000;
    background: #e7e4e4;
    border-radius: 6px !important;
    padding: 2rem;
    border: 0;
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
    padding-bottom: 2rem;
}

.elips___ {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}



.__prograssbg {

    width: 100%;
    height: 4px;
    border-radius: 10% !important;
    margin: 12px 10px;

}

.__prtyuty {
    background: none;
    height: 28px;
    margin-bottom: 0;

}

.__pehuru {
    color: #000;
    font-weight: 900;
    width: 40px;
    background: #fff;
    padding: 2px;
    border-radius: 100%;
    box-shadow: rgb(0 0 0 / 10%) 0px 4px 12px;
    -webkit-box-shadow: rgb(0 0 0 / 10%) 0px 4px 12px;
    height: 40px;
    text-align: center;
    line-height: 3;
    font-size: 1.2rem;

}

.ml-auto54478 {
    margin-left: auto !important;
}

.d-flex {
    display: flex;
    width: 100%;
}

.___profile_case534178 {
    align-items: center !important;
    margin-bottom: 2rem;

    margin-top: -10%;

    line-height: 4;
    align-items: center;
    justify-content: flex-start;
    clear: both;
}

.doxuiu {
    margin-left: -10px;
}
</style>

<?php if(isset($userData) && !empty($userData)){?>

<div class="content-wrapper">
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
                <!-- status bar -->
                <?php 
                    if(isset($_SESSION['status']) && ($_SESSION['status'] == 2 || $_SESSION['status'] == 3)){
                    $l_status = $this->config->item('lawyerStatus');

                    ?>
                <div class="col-md-12 " style="padding: 10px 30px;">
                    <div class="themeBox2 bg-danger-2">
                        <div class="row">
                            <div class="col-md-12 paret-0">
                                <h4><strong>Account
                                        <?= isset($_SESSION['status'])?$l_status[$_SESSION['status']] :''?></strong>
                                </h4>
                                <small>Account will be active within 24 hours.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <!--// status bar -->

                <div class="col-md-12">
                    <div class="bg__white_col">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="radius__col">
                                    <img src="<?php echo base_url()?>assets/images/cover_im.jpg" class="img-responsive">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="dasProfile">
                                            <img src="<?php if(isset($userData->image) && !empty($userData->image)){
                                                echo base_url().$userData->image;
                                             }else{ echo base_url().'assets/images/new_user.png';
                                             }?>" class="img-responsive">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="d-flex ___profile_case534178">
                                            <div class="_progressCon text-center">
                                                <div class="progress __prtyuty">
                                                    <div class="progress-bar __prograssbg" role="progressbar"
                                                        aria-valuenow="<?= $_SESSION['profile_complete']?>"
                                                        aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 100%;height: 2px;margin-top: 15px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="doxuiu">
                                                <div class="__pehuru"><?= $_SESSION['profile_complete']?>%</div>
                                            </div>
                                        </div>



                                        <div class="profile___dxc_">
                                            <ul class="">
                                                <li><span class="dxcspan_">Name:</span>
                                                    <?=$userData->fname.' '.$userData->lname?></li>
                                                <li><span class="dxcspan_">Mobile:</span><?=$userData->mobile?></li>
                                                <li class="elips___"><span
                                                        class="dxcspan_ ">Email:</span><?=$userData->email?></li>
                                                <li><span
                                                        class="dxcspan_">Gender:</span><?php $g = $this->config->item('gender'); echo isset($g[$userData->gender])?$g[$userData->gender]:'' ?>
                                                </li>
                                                <li><span class="dxcspan_">Lawyer
                                                        ID:</span><?=$userData->lawyer_unique_id?></li>

                                            </ul>
                                        </div>
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

                                    <div class="col-md-4">
                                        <div class="edit_button">
                                            <a href="<?=base_url()?>lawyer/profile/edit" class="btn editPro"><i
                                                    class="bi bi-pencil-fill"></i>&nbsp;Edit
                                                Profile</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="classified__space">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label type="text">First Name:</label><br>
                                                        <input type="text" name="first_name" id="fname"
                                                            class="form-control classified"
                                                            value="<?=$userData->fname?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label type="text">Last Name:</label><br>
                                                        <input type="text" name="first_name" id="fname"
                                                            class="form-control classified"
                                                            value="<?=$userData->lname?>" placeholder="Shangloo"
                                                            disabled>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label type="text">Mobile Number:</label><br>
                                                        <input type="text" name="mob_number" id="mname"
                                                            class="form-control classified OnlyNumberInput"
                                                            value="<?=$userData->mobile?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label type="text">Email:</label><br>
                                                        <input type="text" name="Email" id="e-mail"
                                                            class="form-control classified"
                                                            title="<?=$userData->email?>" value="<?=$userData->email?>"
                                                            disabled>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label type="text">Gender:</label><br>
                                                        <input type="text" name="female" id="fe-male"
                                                            value="<?php $g = $this->config->item('gender'); echo isset($g[$userData->gender])?$g[$userData->gender]:'' ?>"
                                                            class="form-control classified" disabled>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label type="text">Lawyer ID:</label><br>
                                                        <input type="text" name="Client" id="Id-client"
                                                            class="form-control classified "
                                                            value="<?=$userData->lawyer_unique_id?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label type="text">State:</label><br>
                                                        <input type="text" name="Client" id="Id-client"
                                                            class="form-control classified "
                                                            value="<?=$userData->state?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label type="text">City:</label><br>
                                                        <input type="text" name="Client" id="Id-client"
                                                            class="form-control classified "
                                                            value="<?=$userData->city?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label type="text">Language:</label><br>
                                                        <input type="text" name="Client" id="Id-client"
                                                            class="form-control classified "
                                                            value="<?=$userData->language?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label type="text">Additional Info:</label><br>
                                                        <input type="text" name="Client" id="Id-client"
                                                            class="form-control classified "
                                                            value="<?=$userData->address?>" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="heade__abo">
                                            <h2>About Us</h2>
                                        </div>
                                        <div class="__about__dash_profile">
                                            <p class="prevent-select"><?=$userData->about?></p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
<?php }?>
<!-- Delete Script-->
<script type="text/javascript">
jQuery(document).ready(function() {

    var profilePer = <?=$_SESSION['profile_complete']?>;
    if (profilePer < 50) {
        $(".__prograssbg").css('background', 'red');
        $("._progressCon").css('width', profilePer + '%');
    } else if (profilePer < 60) {
        $(".__prograssbg").css('background', '#ecb012');
        $("._progressCon").css('width', profilePer + '%');
    } else if (profilePer < 80) {
        $(".__prograssbg").css('background', 'blue');
        $("._progressCon").css('width', profilePer + '%');
    } else if (profilePer < 100) {
        $(".__prograssbg").css('background', 'green');
        $("._progressCon").css('width', profilePer + '%');
    }
    //$('#example').DataTable();

    jQuery(document).on("click", ".deletebtn", function() {
        var tableId = $(this).attr("data_id");
        currentRow = $(this);
        hitURL = "<?php echo base_url() ?>client/client/delete";
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
< script type = "text/javascript" >
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
</script>