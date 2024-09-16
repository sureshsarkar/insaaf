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
}

.sdfsd {
    border-bottom: 1px solid #2acbe7;
}

._home {
    font-size: 22px !important;
    color: #f7f7f7;
    padding-right: 12px;
    padding-top: 10px;
    padding-left: 12px;

}

.menu_hover {
    padding: 4px !important;
    border-bottom: 1px dotted #ffffff42;
}

.menu_hover:hover {
    background: #b07c4b;
}

.__user {
    margin-right: 20px;
    margin-left: -4px;
}

.DashboardLogo img {
    width: 106px;
}

#example_filter label {
    float: right;
    margin-top: -29px;
}

.user-header {

    padding: 10px;
    text-align: center;
    background: #0d98c7;
}

.bi {
    margin-right: 20px;
    margin-left: 10px;
}

.menu_hover p {
    margin: 6px 0px 6px 0px
}

ul.fle_lawyer_sec {
    display: flex;
    flex-direction: row;
}

.count__2 {
    top: 8px !important;
    right: 140px !important;
}

@media only screen and (min-width: 0px) and (max-width:768px) {
    .count__2 {
        right: 90px !important;
    }
}
</style>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <!-- <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />     -->
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/admin-style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/lawyer-style.css" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo base_url(); ?>assets/dist/css/newstyle.css" rel="stylesheet" type="text/css" /> -->
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
    <script src="https://cdn.ckeditor.com/4.18.0/standard-all/ckeditor.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
    </script>
</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo dashboardBg">
                <p>Insaaf99</p>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top justify-content-end" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav fle_lawyer_sec">
                        <a id="menu-toggle" href="#" class="btn  btn-lg toggle __glypIcon"><i
                                class="glyphicon glyphicon-bell"></i>
                            <?php 
                            $where=array();
                            $where['user_type']=2;
                            $where['user_id']=$_SESSION['id'];
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
                            $where['user_type']=2;
                            $where['orderby']=-1;
                            $where['user_id']=$_SESSION['id'];
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
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo (isset($_SESSION['img']) && !empty($_SESSION['img']))?$_SESSION['img']:"";?>"
                                    class="user-image" alt="User Image" />
                                <span
                                    class="hidden-xs"><?= isset($_SESSION['fname'])?trim($_SESSION['fname']):''?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header" style="height:45px!important;">
                                    <!-- <img src="<?php echo base_url(); ?>assets/dist/img/avtar.png" class="img-circle" alt="User Image" /> -->
                                    <p>
                                        <?php echo $name; ?>
                                        <small><?php echo $role_text; ?></small>
                                    </p>
                                </li>
                                <li class="user-footer sdfsd">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url(); ?>lawyer/profile"
                                            class="btn btn-default btn-flat" style="color: #043070;"><i
                                                class="fa fa-key"></i> Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url(); ?>signup_ajax/logout"
                                            class="btn btn-default btn-flat" style="color: #043070;"><i
                                                class="fa fa-sign-out"></i> Sign out</a>
                                    </div>

                                </li>
                            </ul>
                        </li>
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
                    <li class="header admin_bg">LAWYER</li>

                    <a href="<?php echo base_url() ?>" target="_blank">
                        <li class="menu_hover">
                            <p><i class="bi bi-house"></i> Home</p>
                        </li>
                    </a>

                    <a href="<?php echo base_url('lawyer/dashboard') ?>">
                        <li class="menu_hover">
                            <p><i class="bi bi-columns-gap"></i> Dashboard</p>
                        </li>
                    </a>
                    <?php if(($_SESSION['status'] == 1 || $_SESSION['status'] == 2) && $_SESSION['profile_complete'] > 50){ ?>
                    <a class="hidden" href="<?=base_url('lawyer/my_scheduler')?>">
                        <li class="menu_hover">
                            <p><i class="bi bi-calendar2-check"></i> My Schedule</p>
                        </li>
                    </a>

                    <a href="<?=base_url()?>lawyer/meeting">
                        <li class="menu_hover">
                            <p><i class="bi bi-calendar"></i> My Meeting List</p>
                        </li>
                    </a>

                    <a href="<?=base_url()?>lawyer/cases">
                        <li class="menu_hover">
                            <p><i class="bi bi-card-list"></i>Total Cases</p>
                        </li>
                    </a>
                    <a href="<?=base_url()?>lawyer/cases?type=pending">
                        <li class="menu_hover">
                            <p><i class="bi bi-card-list"></i>Pending Cases</p>
                        </li>
                    </a>

                    <!-- my query menu -->

                    <a href="<?= base_url('lawyer/query')?>">
                        <li class="menu_hover">
                            <p><i class="bi bi-chat-left-text"></i>Client Query</p>
                        </li>
                    </a>

                    <?php }else{ ?>
                    <a href="<?=base_url('lawyer/profile/edit?action=update_category&action2=complete_profile')?>">
                        <li class="menu_hover">
                            <p><i class="bi bi-bookmark-plus"></i> Update Category</p>
                        </li>
                    </a>

                    <!-- <a href="<?=base_url('lawyer/my_scheduler?action=complete_profile')?>"><li class="menu_hover">
              <p><i class="bi bi-calendar2-check"></i> Update Schedule</p>
            </li> </a> -->

                    <?php } ?>

                    <a href="<?=base_url('lawyer/lawyer_note')?>">
                        <li class="menu_hover">
                            <p><i class="bi bi-bookmark-plus"></i> Note</p>
                        </li>
                    </a>

                    <a href="<?= base_url()?>lawyer/profile">
                        <li class="menu_hover">
                            <p><i class="bi bi-person-bounding-box"></i>My Profile</p>
                        </li>
                    </a>

                    <a href="<?php echo base_url(); ?>signup_ajax/logout">
                        <li class="menu_hover">
                            <p><i class="bi bi-box-arrow-in-left"></i> Sign out</p>
                        </li>
                    </a>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>


        <!-- start -->
        <style>
        #sidebar-wrapper {
            margin-right: -250px;
            right: 0;
            width: 250px;
            background: #fff;
            position: fixed;
            height: 100%;
            overflow-y: auto;
            z-index: 1000;
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
            top: -3px !important;
            z-index: 1 !important;
        }

        #sidebar-wrapper.active {
            right: 250px;
            width: 350px;
            transition: all 0.5s ease-out 0s;
            -webkit-transition: all 0.5s ease-out 0s;
            -moz-transition: all 0.5s ease-out 0s;
            -ms-transition: all 0.5s ease-out 0s;
            -o-transition: all 0.5s ease-out 0s;
        }

        .toggle {
            margin: 5px 5px 0 0;
        }
        </style>

        <style>
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
            color: #fff !important;
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

        .sdjfhilsjh {
            border: 1px solid #3c8dbc;

        }

        .hjggjugiu {
            border: 1px solid #3c8dbc;
            background: #9ee9c7;
        }

        .for_Upk__list_lawyer small {
            font-size: 12px;
            margin-left: 3px;
            color: gray;
        }

        .for_Upk__list_lawyer i {
            margin-right: 7px;
        }

        .for_Upk__list_lawyer {
            font-size: 19px;
            padding-top: 8px;
            margin-bottom: -10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-top: 25px;
        }

        .inner {
            padding: 10px;
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