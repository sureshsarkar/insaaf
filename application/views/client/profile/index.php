<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>



<?php if(isset($userData) && !empty($userData)){?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- complete your profile sec-->
            <div class="row editCon <?=  ($userData->profile_complete > 84)?'hidden':'' ?> ">
                <div class="box">
                    <div class="row py-2">
                        <div class="col-md-2 col-xs-3 text-center ml-3">
                            <!-- progress bar-->
                            <div class="mt-4" role="progressbar" aria-valuenow="<?=  $userData->profile_complete ?>"
                                aria-valuemin="0" aria-valuemax="100"
                                style="--value:<?=  $userData->profile_complete ?>"></div>
                            <!-- end progress bar-->
                        </div>
                        <div class="col-md-8 col-xs-8">
                            <h2 class="text-danger pl-2 yourProfileTextSize">Your profile
                                <?=  $userData->profile_complete ?>% completed.
                            </h2>
                            <br />
                            <a href="<?= base_url('client/profile/edit')?>"
                                class="btn btn-success text-white ml-2">Complete
                                profile <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!--// complete your profile sec-->
            <div class="row">
                <div class="col-md-12 p-0">
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

                                        <div class="profile___dxc_">

                                            <div class="d-flex flex-row">
                                                <div class="p-1 tytdxcspan_">Name</div>
                                                <div class="p-1">: <?=$userData->fname.' '.$userData->lname?></div>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <div class="p-1 tytdxcspan_">Mobile</div>
                                                <div class="p-1">: <?=$userData->mobile?></div>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <div class="p-1 tytdxcspan_">Email</div>
                                                <div class="p-1">: <?=$userData->email?></div>
                                            </div>

                                            <div class="d-flex flex-row">
                                                <div class="p-1 tytdxcspan_">Gender</div>
                                                <div class="p-1">
                                                    :
                                                    <?php $g = $this->config->item('gender'); echo isset($g[$userData->gender])?$g[$userData->gender]:'' ?>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <div class="p-1 tytdxcspan_">Client ID</div>
                                                <div class="p-1">: <?=$userData->client_unique_id?></div>
                                            </div>
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
                                            <a href="<?=base_url()?>client/profile/edit" class="btn editPro"><i
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
                                                            value="<?=$userData->email?>" title="<?=$userData->email?>"
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
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label type="text">Client ID:</label><br>
                                                        <input type="text" name="Client" id="Id-client"
                                                            class="form-control classified "
                                                            value="<?=$userData->client_unique_id?>"
                                                            placeholder="INS:ADCM245841" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="heade__abo">
                                            <h2>Additional Info:</h2>
                                        </div>
                                        <div class="__about__dash_profile">
                                            <p class="prevent-select"><?=$userData->address?></p>
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