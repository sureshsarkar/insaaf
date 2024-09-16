<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />

    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/admin-style.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo base_url(); ?>assets/dist/css/newstyle.css" rel="stylesheet" type="text/css" /> -->
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin-style.css">

    <script src="https://cdn.ckeditor.com/4.18.0/standard-all/ckeditor.js"></script>

    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>

    <!-- <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>  -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

    <!-- for sevrer  -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!--comment -->
    <!-- for local  -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/bootstrap-some-style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/admin-chat-style.css">

    <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
    </script>
</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url(); ?>" class="logo dashboardBg text-center">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg DashboardLogo ">
                    <!-- <img src="<?php echo base_url()?>assets/images/front_logo/logo8.png" alt="" /> -->
                    <p><strong>Insaaf99</strong></p>
                </span>
            </a>



            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav" style="display:flex;">

                        <div class="dropdown show">

                            <!-- <button type="button" class=" colo988" data-toggle="modal" data-target="#exampleModal">Send
                                Mail</button> -->
                            <a class="btn btn-secondary dropdown-toggle __linked" href="#" role="button"
                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo base_url(); ?>assets/images/user.png" class="user-image"
                                    alt="User Image" /><span class="hidden-xs ghjgl ">Admin</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="<?php echo base_url(); ?>admin/dashboard/loadChangePass"
                                    class="btn btn-default btn_wid rtr"><i class="fa fa-key"></i> Change
                                    Password</a><br>
                                <a href="<?php echo base_url(); ?>admin/login/logout" class="btn btn-default erfsd"><i
                                        class="fa fa-sign-out"></i> Sign out</a>
                            </div>

                            <a href="<?php echo base_url('admin/calling?type=today') ?>">
                                <span style="position: relative;"><i class="bi bi-app-indicator todayCalling "
                                        title="Today Follow" style="color: white; padding-right: 41px;">
                                        <b class="notifData"
                                            style="position: absolute; left: 18px; top: -3px; color: white;">0</b>
                                    </i>
                                </span>
                            </a>

                        </div>

                        <!-- notification counter -->

                        <a id="menu-toggle" href="#" class="btn  btn-lg toggle __glypIcon"><i
                                class="glyphicon glyphicon-bell " style="color:white;"></i>
                            <?php 
                            $where=array();
                            $where['user_type']=1;
                            $where['user_id']=2;
                            $where['status']=0;
                            $result= get_notification($where);
                            if(isset($result) && !empty($result)){
                                $countNotification =  count($result) ;
                                echo '<div class="count__2">'.$countNotification.'</div>';
                            }
                            ?>
                        </a>
                        <div id="sidebar-wrapper">
                            <ul class="sidebar-nav">
                                <a id="menu-close" href="#" class="btn btn-default btn-lg pull-right toggle"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                                <li class="sidebar-brand">
                                    All Notification
                                </li>
                                <?php 
                            $where=array();
                            $where['user_type']=1;
                            $where['orderby']=-1;
                            $where['user_id']=2;
                            $result= get_notification($where);
                            if(isset($result) && !empty($result)){
                                foreach ($result as $key => $value) {?>
                                <li class="___spaMeet">
                                    <a href="<?= $value->act_slug;?>?key=<?=base64_encode($value->id)?>"
                                        class="___head">
                                        <h3> <?php if($value->status==0)echo'<span><i class="fa fa-circle circle__" aria-hidden="true"></i></span>'?>
                                            <?= $value->subject;?></h3>
                                        <p><?= $value->msg;?></p>
                                        <div class="___time">
                                            <span><?= $value->dt;?></span>
                                        </div>
                                    </a>
                                </li>
                                <?php }}?>
                            </ul>
                        </div>

                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu DashboardSidemenu">
                    <li class="header admin_bg">ADMIN</li>

                    <li style="margin-top: 15px;">
                        <a href="<?php echo base_url('admin/') ?>"><i class="bi bi-house-add"></i>&nbsp
                            Dashboard</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/lawyer') ?>" class="active"> <i
                                class="bi bi-person-workspace"></i> &nbsp
                            Lawyers</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/client') ?>" class="menuActive"> <i
                                class="bi bi-person-vcard"></i>&nbsp
                            Clients</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/case_details') ?>" class="menuActive"><i
                                class="bi bi-card-checklist"></i>&nbsp
                            Cases</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/query') ?>" class="menuActive"> <i
                                class="bi bi-file-text"></i>&nbsp
                            Queries</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/scheduler') ?>" class="menuActive"> <i
                                class="bi bi-clock"></i>&nbsp
                            Scheduler</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/contact/?type=ppc') ?>"><i
                                class="bi bi-file-earmark-richtext"></i>&nbsp&nbsp PPC Leads</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/contact') ?>"> <i class="bi bi-person-rolodex"></i>&nbsp
                            Contact Leads</a>
                    </li>

                    <li>
                        <a href=" <?php echo base_url('admin/tempdata') ?>"><i class="bi bi-bar-chart"></i>&nbsp
                            Direct Leads</a>
                    </li>

                    <li>
                        <a href=" <?php echo base_url('admin/insleads') ?>"><i
                                class="bi bi-graph-up-arrow"></i></i>&nbsp
                            PPC Analytics</a>
                    </li>

                    <li>
                        <a href=" <?php echo base_url('admin/certificare') ?>"> <i class="bi bi-window-dock"></i>&nbsp
                            Documentation Query</a>
                    </li>

                    <li>
                        <a href=" <?php echo base_url('admin/Payment') ?>"><i class="bi bi-wallet-fill"></i>&nbsp
                            Payments</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/Latest_News') ?>"><i class="bi bi-newspaper"></i>&nbsp
                            Latest
                            News</a>
                    </li>

                    <li>
                        <a href=" <?php echo base_url('admin/specialization') ?>"><i
                                class="bi bi-file-earmark-break-fill"></i>&nbsp Specialization</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/blogs') ?>"><i
                                class="bi bi-file-earmark-richtext"></i>&nbsp
                            Blogs</a>
                    </li>
                    <li>
                        <a href=" <?php echo base_url('admin/dictionary') ?>"> <i
                                class="bi bi-file-earmark-medical"></i>&nbsp Dictionary</a>
                    </li>

                    <li>
                        <a href=" <?php echo base_url('admin/testimonial') ?>"> <i
                                class="bi bi-file-earmark-medical"></i>Testimonial</a>
                    </li>

                    <li>
                        <a href=" <?php echo base_url('admin/support') ?>"> <i class="bi bi-person-workspace"></i>&nbsp
                            Support Message</a>
                    </li>

                    <li class="dropdown treeview dropdown-submenu  ">
                        <a href="<?php echo base_url('admin/calling') ?>/" class="dropdown-toggle"
                            data-toggle="dropdown"> <i class="bi bi-journal-richtext"></i>&nbsp Follow Up <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu ml_10  for_set_new_w_admin">
                            <li><a href="<?php echo base_url(); ?>admin/calling/addnew" class="text__black">Add </a>
                            </li>
                            <li><a href="<?php echo base_url('admin/calling') ?>/" class="text__black">List </a></li>
                        </ul>
                    </li>

                    <li class="dropdown treeview dropdown-submenu ">
                        <a href="<?php echo base_url('admin/acts/') ?>" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="bi bi-subtract"></i>&nbsp Bare Act <b class="caret"></b></a>
                        <ul class="dropdown-menu ml_10 for_set_new_w_admin">
                            <li><a href="<?php echo base_url()?>admin/acts/category" class="text__black">Act
                                    Category</a></li>
                            <li><a href="<?php echo base_url()?>admin/acts/sub_category" class="text__black">Act Sub
                                    Category</a></li>
                            <li><a href="<?php echo base_url()?>admin/acts" class="text__black">Bare Act List</a></li>
                        </ul>
                    </li>

                    <li class="dropdown treeview dropdown-submenu  ">
                        <a href="<?php echo base_url('admin/category') ?>/" class="dropdown-toggle"
                            data-toggle="dropdown"><i class="bi bi-bookmarks"></i>&nbsp Category Menu <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu ml_10  for_set_new_w_admin">
                            <li><a href="<?php echo base_url(); ?>admin/category/addnew" class="text__black">Add </a>
                            </li>
                            <li><a href="<?php echo base_url('admin/category') ?>/" class="text__black">List </a></li>
                        </ul>
                    </li>

                    <li class="dropdown treeview dropdown-submenu  ">
                        <a href="<?php echo base_url('admin/sub_category') ?>/" class="dropdown-toggle"
                            data-toggle="dropdown"><i class="bi bi-bookmarks"></i>&nbsp Sub Category Menu <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu ml_10  for_set_new_w_admin">
                            <li><a href="<?php echo base_url(); ?>admin/sub_category/addnew" class="text__black">Add
                                </a></li>
                            <li><a href="<?php echo base_url('admin/sub_category') ?>/" class="text__black">List </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown treeview dropdown-submenu  ">
                        <a href="<?php echo base_url('admin/sub_sub_category') ?>/" class="dropdown-toggle"
                            data-toggle="dropdown"><i class="bi bi-tags"></i>&nbsp Sub Sub Category Menu <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu ml_10  for_set_new_w_admin">
                            <li><a href="<?php echo base_url(); ?>admin/sub_sub_category/addnew" class="text__black">Add
                                </a></li>
                            <li><a href="<?php echo base_url('admin/sub_sub_category') ?>/" class="text__black">List
                                </a></li>
                        </ul>
                    </li>
                    <li class="dropdown treeview dropdown-submenu ">
                        <a href="<?php echo base_url('admin/color/') ?>" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="bi bi-window-plus"></i>&nbsp Case Category <b class="caret"></b></a>
                        <ul class="dropdown-menu ml_10 for_set_new_w_admin">
                            <li><a href="<?php echo base_url(); ?>admin/case_category/addnew" class="text__black">Add
                                </a></li>
                            <li><a href="<?php echo base_url('admin/case_category/') ?>" class="text__black">List </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="dropdown treeview dropdown-submenu ">
                        <a href="<?php echo base_url('admin/color/') ?>" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="bi bi-briefcase"></i></i>&nbsp Case Sub Category <b class="caret"></b></a>
                        <ul class="dropdown-menu ml_10 for_set_new_w_admin">
                            <li><a href="<?php echo base_url(); ?>admin/case_sub_category/addnew"
                                    class="text__black">Add </a></li>
                            <li><a href="<?php echo base_url('admin/case_sub_category/') ?>" class="text__black">List
                                </a></li>
                        </ul>
                    </li> -->

                    <li>
                        <a href=" <?php echo base_url('admin/sub_admin') ?>"><i
                                class="bi bi-file-earmark-richtext"></i>&nbsp Sub Admin</a>
                    </li>
                </ul>
            </section>
        </aside>


        <style>
        .btn_wid {
            width: 100% !important;
        }

        .ghf {
            margin-right: 72px;
        }

        .erfsd {
            width: 100%;
            text-align: left !important;
        }

        .rtr {
            text-align: left !important;
        }

        .ghjgl {
            color: #fff;
            margin-left: 10px;
        }

        .colo988 {
            background-color: #2f80ad;
            border-color: #367fa9;
            color: #fff;
            padding: 2px 7px;
            border-radius: 3px;
        }

        .colo988:hover {
            background-color: #0b73ad;
            border-color: #367fa9;
            color: #fff;
        }

        .position__ {
            left: -86px !important;
        }
        </style>


        <style type="text/css">
        .DashboardLogo img {
            width: 106px;
        }

        .___head h3 {
            white-space: nowrap;
            overflow: hidden;
            margin-top: 0;
            font-weight: 600;
            text-overflow: ellipsis;
            font-size: 2rem;
        }

        .___head p {

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;

        }

        .count__2 {
            background: #e89100;
            position: absolute;
            top: 4px;
            height: 20px;
            border-radius: 100%;
            font-size: 1.1rem;
            line-height: 1.8;
            vertical-align: middle;
            width: 20px;
            right: 30px;
        }

        .__linked {
            padding: 12px 35px !important;
        }

        #example_filter label {
            float: right;
            margin-top: -29px;
        }

        .___spaMeet {
            margin-top: 2rem;
        }



        .__glypIcon {
            color: #fff;
        }

        .__glypIcon:hover {
            color: #fff;
        }

        .___time {
            float: right;
            margin-top: 1.1rem;
        }

        .___time span {
            color: #a9a9a9;
        }

        .___head {

            box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;
            padding: 1rem;
            margin-bottom: 4rem;
            border: 1px solid #e6e6e6;
            border-radius: 0.5rem;
        }

        .mt-4em {
            margin-top: 3rem;
        }

        .circle__ {
            font-size: 7px;
            color: #cb3083;
        }
        </style>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-center" id="exampleModalLabel">Send Mail</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?=base_url()?>admin/dashboard/send_mail_CL" method="post">
                            <div class="row">
                                <div class="col col-md-12">
                                    <label for="">Enter Email</label>
                                    <input type="email" class="form-control" name="mail" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-12">
                                    <label for="">Your Information</label><br>
                                    <textarea name="info" cols="81" rows="7"
                                        placeholder="Please Enter your Information that you want to send client or lawyer"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send Mail</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <style type="text/css">
        #sidebar-wrapper {
            margin-right: -250px;
            right: 0;
            width: 250px;
            background: #fff;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            z-index: 99999999999999999999999;
        }

        .sidebar-nav {
            position: absolute;
            top: 0;
            width: 350px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .sidebar-nav li {
            margin-left: 2rem;
            margin-right: 2rem;
        }

        .sidebar-nav li a {
            color: #000;
            display: block;
            text-decoration: none;
        }

        .sidebar-nav:hover li a {
            color: #000;
            display: block;
            text-decoration: none;
        }

        .sidebar-nav li a:hover {
            color: #000;
            background: rgba(255, 255, 255, 0.2);
            text-decoration: none;
        }

        .sidebar-nav li a:active,
        .sidebar-nav li a:focus {
            text-decoration: none;
        }

        .sidebar-nav>.sidebar-brand {
            height: 55px;
            line-height: 55px;
            font-size: 18px;
        }

        .sidebar-nav>.sidebar-brand a {
            color: #999999;
        }

        .sidebar-nav>.sidebar-brand a:hover {
            color: #fff;
            background: none;
        }

        #menu-toggle {
            top: -3px;
            z-index: 1;
        }

        #sidebar-wrapper.active {
            right: 250px;
            width: 350px;
        }

        .toggle {
            margin: 5px 5px 0 0;
        }
        </style>

        <script type="text/javascript">
        $("#menu-close").click(function(e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("active");
        });
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("active");
        });
        </script>


        <script>
        $(document).ready(function() {

            loadPage30sec();
            setInterval(loadPage30sec, 20000);
        });
        // auto refresh
        function loadPage30sec() {
            $.ajax({
                type: "POST",
                url: '<?= base_url('admin/refresh/todayCalling') ?>',
                success: function(returnVal) {
                    var data = JSON.parse(returnVal);
                    console.log(data['todayCalling']);
                    //calling
                    $(".todayCalling").removeClass("hidden");
                    $(".todayCalling .notifData").text(data['todayCalling']);
                }
            });
        };
        // refresh
        </script>