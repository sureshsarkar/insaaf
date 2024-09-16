<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pl-2">
        <h1 class="super_admin">
            <i class="fa fa-tachometer" aria-hidden="true"></i>Super Admin Dashboard
            <small>Control panel</small>
        </h1>
    </section>
    <section class="content bg_color_bar">
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="row">
                    <!-- new lawyer -->
                    <!--// new lawyer -->

                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box1 ">
                            <a href="<?=base_url()?>admin/query" class="notification1 notifCon newQuery hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/query') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($toatalquery))?$toatalquery:'0' ?></h3>
                                    <p>All Query <i class="bi bi-chat-left-dots h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/query') ?>" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box2 ">
                            <a href="<?=base_url()?>admin/case_details" class="notification1 notifCon newCase hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/case_details') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($caseCount))?$caseCount:'0' ?></h3>
                                    <p>All Cases & Meetings <i class="bi bi-pc-display-horizontal h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/case_details') ?>" class="small-box-footer ">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!--  end total order  -->

                    <!-- lawyers-->
                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box3 ">
                            <a href="<?=base_url()?>admin/lawyer" class="notification1 notifCon newLawyer hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/lawyer') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($toatalLawyer))?$toatalLawyer:'0' ?></h3>
                                    <p>All Lawyers <i class="bi bi-person-vcard h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/lawyer') ?>" class="small-box-footer ">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- lawyers-->

                    <!-- clients  -->
                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box4">
                            <a href="<?=base_url()?>admin/client" class="notification1 notifCon newClient hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/client') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($toatalClient))?$toatalClient:'0' ?></h3>
                                    <p>All Clients <i class="bi bi-person-badge h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/client') ?>" class="small-box-footer click_client">More
                                info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- clients  -->

                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box5">
                            <a href="<?=base_url()?>admin/payment" class="notification1 notifCon newPayment hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>

                            <a href="<?php echo base_url('admin/payment') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($toatalPaymentList))?$toatalPaymentList:'0' ?></h3>
                                    <p>All Payment List <i class="bi bi-bank h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/payment') ?>" class="small-box-footer ">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box1 ">
                            <a href="<?=base_url()?>admin/meeting_list/?type=upcoming"
                                class="notification1 notifCon upcomingmeetings hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>

                            <a href="<?php echo base_url('admin/meeting_list/?type=upcoming') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($meetingcount))?$meetingcount:'0' ?></h3>
                                    <p>Up Coming Meetings <i class="bi bi-person-video2 h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/meeting_list/?type=upcoming') ?>"
                                class="small-box-footer ">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box2 ">
                            <a href="<?=base_url()?>admin/certificare"
                                class="notification1 notifCon newCertificate hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/certificare') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($toatalCertificate))?$toatalCertificate:'0' ?></h3>
                                    <p>Documentation Request <i class="bi bi-file-earmark-medical h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/certificare') ?>"
                                class="small-box-footer click_certi">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- end total category -->

                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box3 ">
                            <a href="<?=base_url()?>admin/contact?type=ppc"
                                class="notification1 notifCon newPpc hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/contact?type=ppc') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($toatalPpc))?$toatalPpc:'0' ?></h3>
                                    <p> PPC Leads Query <i class="bi bi-journal-text h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/contact?type=ppc') ?>" class="small-box-footer">More
                                info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box4 ">
                            <a href="<?=base_url()?>admin/contact" class="notification1 notifCon newContact hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/contact') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($toatalContact))?$toatalContact:'0' ?></h3>
                                    <p>Contact Form Query <i class="bi bi-journal-text h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/contact') ?>" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>


                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box5 ">
                            <a href="<?=base_url()?>admin/calling" class="notification1 notifCon calling hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/calling') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($calling_data))?$calling_data:'0' ?></h3>
                                    <p>Follow Up <i class="bi bi-pc-display-horizontal h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/calling') ?>" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>


                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box1 ">
                            <a href="<?=base_url()?>admin/support" class="notification1 notifCon newSupport hidden">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/support') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($supportCount))?$supportCount:'0' ?></h3>
                                    <p>Support message <i class="bi bi-credit-card-2-front h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/support') ?>" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-3 col-2 col-xs-6">
                        <div class="small-box saf__box2  ">
                            <a href="<?=base_url()?>admin/refund" class="notification1 notifCon newPaymentRefund ">
                                <span><i class="fa fa-bell " style="font-size:20px;color:#fafcff"></i></span> <span
                                    class="badge1 notifData"></span>
                            </a>
                            <a href="<?php echo base_url('admin/refund') ?>">
                                <div class="inner">
                                    <h3><?php echo  (isset($RefundCount))?$RefundCount:'0' ?></h3>
                                    <p>Payment Refund Request <i class="bi bi-credit-card-2-front h1 ml-2"></i> </p>
                                </div>
                            </a>
                            <a href="<?php echo base_url('admin/refund') ?>" class="small-box-footer">More info
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="row saf__boxlight pt-2 pb-2">
                    <div class="col-md-12 bg_color_bar p-0">
                        <div id="myChart" class="p-4">
                            <div id="chart_div"></div>
                            <br />
                            <div id="btn-group">
                                <button class="button button-blue" id="none">No Format</button>
                                <button class="button button-blue" id="scientific">Scientific Notation</button>
                                <button class="button button-blue" id="decimal">Decimal</button>
                                <button class="button button-blue" id="short">Short</button>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<!--google chart graph start  -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
$(document).ready(function() {

    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);
    var result = <?php echo $jsonData ?>;

    function drawChart() {
        var data = google.visualization.arrayToDataTable(result);
        var options = {
            chart: {
                title: 'Insaaf99',
                subtitle: 'Payment, Meetings, Clients, and Queries: <?= $year?>',
            },
            bars: 'vertical', // Required for Material Bar Charts.
            hAxis: {
                format: 'decimal'
            },
            height: 400,
            colors: ['#1b9e77', '#8e44ad', '#d95f02', '#0652DD']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));

        var btns = document.getElementById('btn-group');

        btns.onclick = function(e) {
            if (e.target.tagName === 'BUTTON') {
                options.hAxis.format = e.target.id === 'none' ? '' : e.target.id;
                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        }
    }
})
</script>
<!--google chart graph end  -->



<script>
$(document).ready(function() {

    //Client Notification
    $(".click_client").click(function() {
        var url = '<?php echo site_url('admin/client/client_notify')?>';
        //  alert(url);
        $.ajax({
            type: "POST",
            url: url,
            data: {
                url: url,
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
    $(".click_certi").click(function() {
        var url = '<?php echo site_url('admin/Certificare/certi_notify')?>';
        //  alert(url);
        $.ajax({
            type: "POST",
            url: url,
            data: {
                url: url,
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

    //News Notification
    $(".click_news").click(function() {
        var url = '<?php echo site_url('admin/Latest_News/News_notify')?>';
        //  alert(url);
        $.ajax({
            type: "POST",
            url: url,
            data: {
                url: url,
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



$(document).ready(function() {
    loadPage30sec();
    setInterval(loadPage30sec, 20000);
});
// auto refresh
function loadPage30sec() {
    $.ajax({
        type: "POST",
        url: '<?= base_url('admin/refresh/dashboard_data') ?>',
        success: function(returnVal) {
            var data = JSON.parse(returnVal);

            // new chat
            $(".newQuery").removeClass("hidden");
            $(".newQuery .notifData").text(data['newChat']);

            // new case
            $(".newCase").removeClass("hidden");
            $(".newCase .notifData").text(data['newCase']);

            // new newLawyer
            $(".newLawyer").removeClass("hidden");
            $(".newLawyer .notifData").text(data['newLawyer']);

            // new newClient
            $(".newClient").removeClass("hidden");
            $(".newClient .notifData").text(data['newClient']);

            // new newPayment
            $(".newPayment").removeClass("hidden");
            $(".newPayment .notifData").text(data['newPayment']);

            //upcomingmeetings
            $(".upcomingmeetings").removeClass("hidden");
            $(".upcomingmeetings .notifData").text(data['upcomingmeetings']);

            //newCertificate
            $(".newCertificate").removeClass("hidden");
            $(".newCertificate .notifData").text(data['newCertificate']);

            //newPaymentRefund
            $(".newPaymentRefund").removeClass("hidden");
            $(".newPaymentRefund .notifData").text(data['newPaymentRefund']);

            //newContact
            $(".newContact").removeClass("hidden");
            $(".newContact .notifData").text(data['newContact']);

            //newPPC
            $(".newPpc").removeClass("hidden");
            $(".newPpc .notifData").text(data['newPpc']);
            //calling
            $(".calling").removeClass("hidden");
            $(".calling .notifData").text(data['calling']);
            //calling
            $(".todayCalling").removeClass("hidden");
            $(".todayCalling .notifData").text(data['todayCalling']);
            //support
            $(".newSupport").removeClass("hidden");
            $(".newSupport .notifData").text(data['newSupport']);
        }
    });
};

// refresh
</script>