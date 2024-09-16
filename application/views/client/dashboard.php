<!-- <link rel="stylesheet" href="<?php echo base_url()?>/assets/user/assets/css/themify-icons.css"> -->
<!-- others css -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/user/assets/css/styles.css"> -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/ic.css"> -->


<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
    <section class="content-header top_dashboard____">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-6 col-xs-6">
                    <div class="main_div">
                        <div class="fro_nec_set_clint_dshd">

                            <div class="left___col p-2">
                                <span><i class="fa fa-tachometer pl-2" aria-hidden="true"></i><?php echo  $name;?>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 col-xs-6">

                    <div class="right___col p-2 for_my_cls_ned mt-1">
                        <span>
                            <span class="__img_play"> <a
                                    href="https://play.google.com/store/apps/details?id=com.insaaf99"
                                    target="blank"><img src="<?php echo base_url() ?>assets/images/vtx_playstore.png"
                                        alt=""></a></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- condition for pay registration fee  after registration  start-->
    <section>
        <div class="row">
            <div
                class="col-md-12  <?=  (isset($_SESSION['profile_complete']) && $_SESSION['profile_complete'] > 95)?'hidden':'' ?>">
                <div class="container-fluid">

                    <!-- complete your profile sec-->
                    <div class="row editCon <?=  ($_SESSION['profile_complete'] > 84)?'hidden':'' ?> ">
                        <div class="box">
                            <div class="row py-2">
                                <div class="col-md-2 col-xs-3 text-center ml-3">
                                    <!-- progress bar-->
                                    <div class="mt-4" role="progressbar"
                                        aria-valuenow="<?=  $_SESSION['profile_complete'] ?>" aria-valuemin="0"
                                        aria-valuemax="100" style="--value:<?=  $_SESSION['profile_complete'] ?>"></div>
                                    <!-- end progress bar-->
                                </div>
                                <div class="col-md-8 col-xs-8">
                                    <h2>Complete Your Profile</h2>
                                    <p>We will suggest you to complete your profile for Activation of your
                                        account</p>
                                    <div class="for_butok_qie_rhhfv">
                                        <a href="<?= base_url('client/profile/edit') ?>" class="">
                                            <button><small class="">Complete Now</small></button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--// complete your profile sec-->

                </div>
            </div>
        </div>
    </section>
    <section class="content py-1 px-3">
        <div class="row">
            <div class="col-md-12">
                <div class="__noti" style="color:red;"></div>
            </div>
        </div>
        <div class="row">
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


            <div class="lawshdfj" style="color:green;"></div>
            <div class="col-md-12 m-auto">
                <div class="row">
                    <!-- alert profile detials -->

                    <!--// alert profile detials -->
                    <div class="col-md-3 col-xs-6 py-1">

                        <div class="small-box bg-info saf__box1  ">
                            <a href="<?=base_url()?>client/meeting" class="notification notifCon newMeeting hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?=base_url()?>client/meeting">
                                <div class="inner">
                                    <h3><?php echo  (isset($totalMeetingDate))?$totalMeetingDate:'0' ?></h3>
                                    <p>My Meeting List <i class="bi bi-pc-display-horizontal h1"></i></p>

                                </div>
                            </a>

                            <a href="<?=base_url()?>client/meeting" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-6 py-1">
                        <div class="small-box bg-info saf__box2 ">
                            <a href="<?=base_url()?>client/cases" class="notification notifCon newCase hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?=base_url()?>client/cases">
                                <div class="inner">
                                    <h3><?php echo  (isset($caseCount))?$caseCount:'0' ?></h3>
                                    <p>Total Cases <i class="bi bi-bag h1"></i></p>
                                </div>
                            </a>
                            <a href="<?=base_url()?>client/cases" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6 py-1">
                        <a href="<?=base_url()?>client/cases?type=pending">
                            <div class="small-box bg-info saf__box3 ">
                                <a href="<?=base_url()?>client/cases?type=pending"
                                    class="notification notifCon pendingCase hidden">
                                    <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                        class="badge1 notifData"></span>
                                </a>
                                <a href="<?=base_url()?>client/cases?type=pending">
                                    <div class="inner">
                                        <h3><?php echo  (isset($totalPendingCases))?$totalPendingCases:'0' ?></h3>
                                        <p>Pending Cases <i class="bi bi-bag h1"></i></p>
                                    </div>
                                </a>
                                <a href="<?=base_url()?>client/cases?type=pending" class="small-box-footer">More info
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a>

                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-xs-6 py-1">

                        <div class="small-box bg-info saf__box4 ">
                            <a href="<?=base_url()?>client/meeting" class="notification notifCon newPaymwnt hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?=base_url()?>client/payment">
                                <div class="inner">
                                    <h3><?php echo  (isset($totalPayment))?$totalPayment:'0' ?></h3>
                                    <p>My Transactions <i class="bi bi-wallet h1"></i></p>
                                </div>
                            </a>
                            <a href="<?=base_url()?>client/payment" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <!-- all Query -->
                    <div class="col-md-3 col-xs-6 py-1">

                        <div class="small-box bg-info saf__box3 ">
                            <a href="<?=base_url()?>client/query" class="notification notifCon newQuery hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href=" <?=base_url()?>client/query">
                                <div class="inner">
                                    <h3><?php echo  (isset($totalQuery))?$totalQuery:'0' ?>
                                    </h3>
                                    <p>All Queries <i class="bi bi-cart h1"></i></p>
                                </div>
                            </a>
                            <a href="<?=base_url()?>client/query" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>

                    </div>
                    <!-- pending query -->
                    <div class="col-md-3 col-xs-6 py-1">
                        <div class="small-box bg-info saf__box1 ">
                            <?php if(!empty($SelectLawyerNotify)){?>
                            <a href="<?=base_url()?>client/query?type=open">
                                <span><i class="fa fa-bell " style="font-size:20px;color: #ffffff;"></i></span>
                                <span
                                    class="_saf_badge1"><?php echo  (isset($SelectLawyerNotify))?$SelectLawyerNotify:'0' ?></span>
                            </a>
                            <?php }?>
                            <a href="<?=base_url()?>client/query?type=open">
                                <div class="inner">
                                    <h3><?php echo  (isset($pendingQuery))?$pendingQuery:'0' ?>
                                    </h3>
                                    <p>Open Queries <i class="bi bi-bag h1"></i></p>
                                </div>
                            </a>
                            <a href="<?=base_url()?>client/query?type=open" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-xs-6 py-1">

                        <div class="small-box bg-info saf__box7 ">
                            <a href="<?=base_url()?>client/documentationList"
                                class="notification notifCon newMeeting hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?=base_url()?>client/documentationList">
                                <div class="inner">
                                    <h3><?php echo  (isset($Documentation))?$Documentation:'0' ?></h3>
                                    <p>Documentation<i class="bi bi-file-earmark-medical h1"></i></p>
                                </div>
                            </a>

                            <a href="<?=base_url()?>client/documentationList" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <canvas id="myChart" width="400" height="100"></canvas>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<script type="text/javascript">
var table;

$(document).ready(function() {
    //datatables
    table = $('#example').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/category/ajax_list')?>",
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
        }, ],
    });
});
</script>

<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(document).ready(function() {

    //Haering Notification
    $(".click_hearing").click(function() {
        var url = '<?php echo site_url('client/Hearing_date/Hearing_notify')?>';
        var client_id = '<?=$_SESSION['id']?>';
        //  alert(url);
        $.ajax({
            type: "POST",
            url: url,
            client_id: client_id,
            data: {
                url: url,
                client_id: client_id,
            },
            success: function(fb) {
                console.log(fb);
                var resp = $.parseJSON(fb);
                if (resp.status == 'true') {
                    window.location.href = resp.reload;
                    return true;
                }
                if (resp.status == 'true1') {
                    window.location.href = resp.reload;
                    return true;
                }
            }
        });
        return false;

    });

    //Query Notification
    $(".click_query").click(function() {
        var url = '<?php echo site_url('client/Client_query/Query_notify')?>';
        var client_id = '<?=$_SESSION['id']?>';
        //  alert(url);
        $.ajax({
            type: "POST",
            url: url,
            client_id: client_id,
            data: {
                url: url,
                client_id: client_id,
            },
            success: function(fb) {
                console.log(fb);
                var resp = $.parseJSON(fb);
                if (resp.status == 'true') {
                    window.location.href = resp.reload;
                    return true;
                }
                if (resp.status == 'true1') {
                    window.location.href = resp.reload;
                    return true;
                }
            }
        });
        return false;

    });
    //Select Lawyer Notification
    $(".click_select_l").click(function() {
        var url = '<?php echo site_url('client/Client_query/select_lawyer_notify')?>';
        var client_id = '<?=$_SESSION['id']?>';
        //  alert(url);
        $.ajax({
            type: "POST",
            url: url,
            client_id: client_id,
            data: {
                url: url,
                client_id: client_id,
            },
            success: function(fb) {
                console.log(fb);
                var resp = $.parseJSON(fb);
                if (resp.status == 'true') {
                    window.location.href = resp.reload;
                    return true;
                }
                if (resp.status == 'true1') {
                    window.location.href = resp.reload;
                    return true;
                }
            }
        });
        return false;

    });
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
        url: '<?= base_url('client/refresh/dashboard_data') ?>',
        success: function(returnVal) {
            var data = JSON.parse(returnVal);

            // new meeting
            $(".newMeeting").removeClass("hidden");
            $(".newMeeting .notifData").text(data['newMeeting']);
            // new case
            $(".newCase").removeClass("hidden");
            $(".newCase .notifData").text(data['newCase']);
            // // pending case 
            $(".pendingCase").removeClass("hidden");
            $(".pendingCase .notifData").text(data['pendingCase']);
            // new Paymwnt
            $(".newPaymwnt").removeClass("hidden");
            $(".newPaymwnt .notifData").text(data['newPaymwnt']);
            // new Query
            $(".newQuery").removeClass("hidden");
            $(".newQuery .notifData").text(data['newQuery']);
        }
    });
};

// refresh
</script>