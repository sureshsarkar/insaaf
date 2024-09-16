<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <div class="logo dashboardBg">
            <p>Welcome to Insaaf99</p>
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg DashboardLogo">
            </span>
        </div>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->

            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav" style="display:flex;">
                    <li class="___clientAlert5348">
                        <a href="<?php echo base_url('client/create_case'); ?>">
                            <img src="<?php echo base_url()?>assets/images/lawyer_consultation.gif">
                        </a>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle pt-2" data-toggle="dropdown">
                            <img src="<?php echo (isset($_SESSION['img']) && !empty($_SESSION['img']))?$_SESSION['img']:base_url('assets/images/user.png'); ?>"
                                class="client_image" alt="User Image" />
                            <!-- <img src="http://localhost/web/sync/Sync/web/insaaf99/assets/images/user.png" class="user-image" alt="User Image"> -->
                            <span class="hidden-xs"><?= isset($_SESSION['fname'])?trim($_SESSION['fname']):''?></span>
                        </a>
                        <ul class="dropdown-menu __menu_topDrop">
                            <!-- User image -->
                            <!-- <img src="http://localhost/web/sync/Sync/web/insaaf99/assets/dist/img/avtar.png" class="img-circle" alt="User Image" /> -->
                            <!--   <p>
                     <?= isset($_SESSION['fname'])?trim($_SESSION['fname']):''?>
                     </p> -->
                    </li>
                    <!-- Menu Footer -->
                    <li class=" ">
                        <!--        <div class="pull-left">
                        <a href="http://localhost/web/sync/Sync/web/insaaf99/admin/dashboard/loadChangePass" class="btn btn-default btn-flat" style="color: #043070;" ><i class="fa fa-key" ></i> Change Password</a>
                        </div> -->
                        <a href="<?php echo base_url('client/profile') ?>" class="btn ">Profile</a>
                        <a href="<?=base_url()?>signup_ajax/logout" class="btn "> Sign out</a>
                    </li>
                </ul>
                </li>
                <li>
                    <a id="menu-toggle2" href="#" class="btn  btn-lg toggle __glypIcon"><i
                            class="glyphicon glyphicon-bell"></i>
                        <?php 
                  $where=array();
                  $where['user_type']=3;
                  $where['user_id']=$_SESSION['id'];
                  $where['status']=0;
                  $result= get_notification($where);
                  if(isset($result) && !empty($result)){
                      $countNotification =  count($result) ;
                      echo '<div class="count__2">'.$countNotification.'</div>';
                  }
                  ?>
                    </a>
                </li>
                </ul>
                <div id="sidebar-wrapper">
                    <ul class="sidebar-nav">
                        <a id="menu-close" href="#" class="btn btn-default btn-lg pull-right toggle"><i
                                class="glyphicon glyphicon-remove"></i></a>
                        <li class="sidebar-brand">
                            All Notification
                        </li>
                        <?php 
                  $where=array();
                  $where['user_type']=3;
                  $where['orderby']=-1;
                  $where['user_id']=$_SESSION['id'];
                  $result= get_notification($where);
                  if(isset($result) && !empty($result)){
                      foreach ($result as $key => $value) {?>
                        <li class="___spaMeet">
                            <a href="<?= $value->act_slug;?>?key=<?=base64_encode($value->id)?>" class="___head">
                                <h3> <?php if($value->status==0)echo'<span><i class="fa fa-circle circle__" aria-hidden="true"></i></span>'?>
                                    <?= $value->subject;?>
                                </h3>
                                <p><?= $value->msg;?></p>
                                <div class="___time">
                                    <span><?= $value->dt;?></span>
                                </div>
                            </a>
                        </li>
                        <?php }}?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <?php  $clintiD=$_SESSION['id'];
   if(isset($clintiD) && !empty($clintiD)){
          $userDetails =  ClientDetails($clintiD);
          if(isset($userDetails) && !empty($userDetails)){
           if($userDetails['status']==1){
           }
    ?>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <!-- <div class="top__heading">
         <p>Client</p>
         </div> -->
            <a href="<?php echo base_url() ?>" target="_blank">
                <div class="d-flex flex-row bd-highlight  mb-3 w-100 menu_hover    ">
                    <div class="p-2 bd-highlight"><i class="fa fa-home _home"></i></div>
                    <div class="p-2 bd-highlight">
                        Home
                    </div>
                </div>
            </a>
            <a href="<?php echo base_url('client/dashboard'); ?>">
                <div class="d-flex flex-row bd-highlight  mb-3 w-100 menu_hover    ">
                    <div class="p-2 bd-highlight">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <div class="p-2 bd-highlight">
                        Dashboard
                    </div>
                </div>
            </a>

            <!-- query-->
            <div class="d-flex flex-row bd-highlight align-items-center mb-3 w-100 menu_hover cases justifyCon for_pps_hein"
                id="queryhide">
                <div class="p-2 bd-highlight">
                    <i class="bi bi-chat-left-dots"></i>
                </div>
                <div class="__pad_collect2 bd-highlight  mar-right">My Queries</div>
                <div class="___bd bd-highlight"> <i class="bi bi-caret-down-fill " class="line-break"></i></div>
            </div>
            <div class=" bd-highlight align-items-center  mb-3 w-100  cases-colr   d-nonePlus list-none  clicktoShowinsaaf "
                id="queryshowhide">
                <ul>
                    <a href="<?=base_url()?>client/query/chat" class="text__black ___pad_special">
                        <li>New Query</li>
                    </a>
                    <a href="<?=base_url()?>client/query" class="text__black ___pad_special">
                        <li>All Queries</li>
                    </a>
                    <a href="<?=base_url()?>client/query?type=open" class="text__black ___pad_special">
                        <li>Open Queries </li>
                    </a>
                    <a href="<?=base_url()?>client/query?type=close" class="text__black ___pad_special">
                        <li>Closed Queries </li>
                    </a>
                </ul>
            </div>
            <!-- query-->



            <a href="<?=base_url()?>client/meeting">
                <div class="d-flex flex-row bd-highlight  mb-3 w-100 menu_hover    ">
                    <div class="p-2 bd-highlight">
                        <i class="bi bi-camera-video"></i>
                    </div>
                    <div class="p-2 bd-highlight">My Meetings
                    </div>
                </div>
            </a>
            <ul class="unstyled ___dashimg54464164 list-unstyled">
                <li> <a href="<?php echo base_url('client/create_case'); ?>" class="text__black btn "><img
                            src="<?php echo base_url(''); ?>assets/images/new__case.png" class="img-fluid">&nbsp;&nbsp;
                        Consult with a Lawyer</a></li>
                <li> <a href="<?php echo base_url('client/cases'); ?>" class="text__black  btn "><img
                            src="<?php echo base_url(''); ?>assets/images/all__case.png"
                            class="img-fluid">&nbsp;&nbsp;Consultations </a></li>
                <!-- <li> <a href="<?php echo base_url('client/cases?type=pending'); ?>" class=" btn text__black "><img src="<?php echo base_url(''); ?>assets/images/pending.png" class="img-fluid">&nbsp;&nbsp;Pending Cases </a></li> -->
            </ul>

            <a href="<?php echo base_url('client/documentation') ?>">
                <div class="d-flex flex-row bd-highlight  mb-3 w-100 menu_hover    ">
                    <div class="p-2 bd-highlight">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div class="p-2 bd-highlight">
                        Documentation
                    </div>
                </div>
            </a>

            <a href="<?=base_url()?>client/query/support">
                <div class="d-flex flex-row bd-highlight mb-3 w-100 menu_hover  ">
                    <div class="p-2 bd-highlight">
                        <i class="bi bi-headset"></i>
                    </div>
                    <div class="p-2 bd-highlight">
                        Support
                    </div>
                </div>
            </a>

            <a href="<?php echo base_url('client/profile') ?>">
                <div class="d-flex flex-row bd-highlight  mb-3 w-100 menu_hover    ">
                    <div class="p-2 bd-highlight">
                        <i class="bi bi-person-bounding-box"></i>
                    </div>
                    <div class="p-2 bd-highlight">
                        My Profile
                    </div>
                </div>
            </a>

            <a href="<?php echo base_url('client/payment'); ?>">
                <div class="d-flex flex-row bd-highlight  mb-3 w-100 menu_hover    ">
                    <div class="p-2 bd-highlight">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="p-2 bd-highlight">
                        My Transactions
                    </div>
                </div>
            </a>


        </section>

    </aside>
    <?php }}?>
    <!-- model for query start -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <form role="form" action="<?php echo base_url() ?>client/Client/Query" method="post">
                        <div class="form-group">
                            <label for="text">Enter Your Query</label>
                            <textarea type="text" name="query" class="form-control __query_676676"
                                placeholder=" Enter Your Query" value="" required> </textarea>
                        </div>
                        <div class="msg"></div>
                        <div class="modal-footer">
                            <input type="hidden" name="client_Id" value="<?php echo $_SESSION['id']?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary __click_query89">Send Query</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    $("#menu-toggle2").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $("#btnShowHide").click(function() {
            $("#divShowHide").toggle();
        });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $("#queryhide").click(function() {
            $("#queryshowhide").toggle();
        });
    });
    </script>