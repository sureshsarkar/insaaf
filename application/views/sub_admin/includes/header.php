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
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/admin-style.css">

    <script src="https://cdn.ckeditor.com/4.18.0/standard-all/ckeditor.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!--comment -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
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
                            <a class="btn btn-secondary dropdown-toggle __linked" href="#" role="button"
                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?php echo base_url(); ?>assets/images/user.png" class="user-image"
                                    alt="User Image" /><span
                                    class="hidden-xs ghjgl "><?php echo (isset($_SESSION['name']))? ucwords($_SESSION['name']):"Sub Admin"?></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="<?php echo base_url(); ?>sub_admin/dashboard/loadChangePass"
                                    class="btn btn-default btn_wid rtr"><i class="fa fa-key"></i> Change
                                    Password</a><br>
                                <a href="<?php echo base_url(); ?>sub_admin/login/logout"
                                    class="btn btn-default erfsd"><i class="fa fa-sign-out"></i> Sign out</a>
                            </div>
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
                    <li class="header admin_bg">Sub Admin</li>
                    <li style="margin-top: 15px;">
                        <a href="<?php echo base_url('sub_admin/dashboard') ?>"> Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('sub_admin/payment') ?>"> Payment</a>
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