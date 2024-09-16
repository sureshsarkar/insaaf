    <script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
        </section>
        

    <section class="content">
        <div class="container-fluid px-2">
            <div class="row">
                <?php if(isset($_GET['action']) && $_GET['action'] == 'welcome'){ ?>
                <!-- Welcome message-->
                <div class="col-md-12 ">
                    <div class="for_d_fle_cil_proge themeBox1 " style="background-color:#03a857;color:#ffff">
                        <div class="row">
                            <div class="col-md-12 paret-0">
                                <div class="proccessCon" style="margin-bottom:50px"> 
                                    <h4>Hello, <?= $_SESSION['name']?> !!</h4>
                                    <h2>Welcome to insaaf99.com</h2></small>
                                 </div>
                            </div>
                        </div>
                     </div>
                </div>
                <!-- Welcome message-->
                <?php } ?>

                <!-- progress bar-->
                <div class="col-md-12 ">
                    <div class="for_d_fle_cil_proge themeBox1">
                        <div class="row">
                            <div class="col-md-2 col-3">
                                 <div role="progressbar" aria-valuenow="<?= isset($_SESSION['profile_complete'])?$_SESSION['profile_complete']:'0'?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?= isset($_SESSION['profile_complete'])?$_SESSION['profile_complete']:'0'?>"><?= isset($_SESSION['profile_complete'])?$_SESSION['profile_complete']:'0'?>% </div>
                            </div>
                       
                            <div class="col-md-10 col-9">
                                <div class="fro_some_text_progress_compt_pro">
                                <h2>Your account is <span class="text-danger"> Inactive</span></h2>
                                <p>Complete your profile for activate account</p>
                                <div class="for_butok_qie_rhhfv">
                                <a href="<?=base_url('lawyer/profile/edit?action=update_category&action2=complete_profile')?>" class="btn btn-success"><small>Complete Now <i class="bi bi-arrow-right"></i></small></a>
                                </div>
                            </div>
                        </div>
                     </div>

                    </div>
                </div>
                <!-- End progress bar-->

                <!-- Steps -->
                <div class="col-md-12 ">
                    <div class="for_d_fle_cil_proge themeBox1">
                        <div class="row">
                            <div class="col-md-12 paret-0">
                                <div class="proccessCon" style="margin-bottom:50px"> <h4><strong>Account Activation proccess</strong></h4>
                                    <h2><small>
                                            <a href="<?=base_url('lawyer/profile/edit?action=update_category&action2=complete_profile')?>">Update Your Case Category </a>->
                                     <!-- <a href="<?=base_url('lawyer/my_scheduler?action=complete_profile')?>"> Update Your Meeting Schedule</a> -> -->
                                    <a href="<?=base_url('lawyer/profile?action=complete_profile')?>"> Upload Verification Document</a> ->
                                    We are good to go (Our team will verify the credentials & activate the account!)</h2></small>
                                 </div>

                                
                            </div>
                        </div>
                     </div>
                </div>
                <!-- End progress bar-->
            </div>
        </div><!-- // container-->
    </section>