<link rel="stylesheet" href="<?php echo base_url()?>/assets/user/assets/css/themify-icons.css">
<!-- others css -->

<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/user/assets/css/styles.css"> -->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/ic.css"> -->
<style type="text/css">
.sidebar-menu {
    width: 231px;
}

. {
    margin-left: 14px;
}

.mt_15 {
    margin-top: 15px;
}

.bg-info,
.bg-info>a {
    color: #fff !important;
}

.bg-info {
    background-color: #17a2b8 !important;
}

.small-box {
    border-radius: 0.25rem;
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    display: block;
    margin-bottom: 20px;
    position: relative;
}

.bg-info {
    background-color: #17a2b8 !important;
}

.small-box>.inner {
    padding: 10px;
}

.col-lg-3 .small-box h3,
.col-md-4 .small-box h3,
.col-xl-3 .small-box h3 {
    font-size: 2.2rem;
}

.small-box p {
    z-index: 5;
}

.small-box .icon {
    color: rgba(0, 0, 0, .15);
    z-index: 0;
}

.icon>i.ion {
    font-size: 70px;
    top: 20px;
}

.small-box .icon>i {
    font-size: 90px;
    position: absolute;
    right: 15px;
    top: 15px;
    transition: -webkit-transform .3s linear;
    transition: transform .3s linear;
    transition: transform .3s linear, -webkit-transform .3s linear;
}

.small-box>.small-box-footer {
    background-color: rgba(0, 0, 0, .1);
    color: rgba(255, 255, 255, .8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
}

.notification {
    font-size: 16px;
    background: #bccadb;
    color: #d83680;
    border-radius: 4px;
    font-weight: 600;
    padding: 3px;
}

._box {
    padding-bottom: 2px;
    background: #17a2b8;
}

._color {
    color: #fff;
}

._border {
    border-radius: 3px;
}

._bg_jhewe1 {
    background: #22dffa;
}

.jhghj {
    border-right: 1px solid #fefefe;
    border-bottom: 1px solid #fefefe;
}

.rte {
    background: #22dffa;

}

.dob {
    font-size: 25px;
}

._bg_jhe {
    background: #47f47c54;
}

.sfsdf {
    border-right: 1px solid #fefefe;
}
._bg_jh{
    color:#fff;
}


.__btn {
    background: #9ef3ff;
    border: 1px solid #22dffa;
    padding: 5px;

}

.bijjbn {
    padding: 5px;
    background: #9ef3ff;
    border: 1px solid #22dffa;
}


._btn_color{
    background: #17a2b8;
}



</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            <?php 
            echo  $name;
            ?>
            <small>Control panel
            </small>

        </h1>
    </section>
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
                <div class="lawshdfj" style="color:green;"></div>

            </div>
        </div>
        <div class="row">
            <?php if(!empty($my_lawyers)){ ?>
            <div class="box _box">
                <h3 class="text-center _bg_jh color-light"><b>Select a Lawyer to book your appointment for your query</b>
                </h3>
            </div>
            <?php foreach($my_lawyers as $lawyer){?>
            <div class="col-md-4 " style="border: 2px  solid #17a2b8;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="mar " style="margin:15px;">
                                <!-- <img class="card-img-top" src="<?=base_url()?>uploads/lawyer/<?=$lawyer->lawyer_img?>" width="250px" class="img-fluid" alt="Card image cap"> -->
                                <div class="card-body" style="">
                                    <h4 class="card-title ">Advocate:- <b
                                            style="color:#31d390;marg  n-left:30px;"><?=$lawyer->fname.' ';?><?=$lawyer->lname;?></b>
                                    </h4>
                                    <h4 class="card-text"><b>Experience:-</b><b style="color:#31d390;margin-left:15px;"><?=$lawyer->experience;?></b></h4>
                                    <?php if(!empty($client_pay_data)){
                                    if($client_pay_data->f_pay_free==0 && $client_query_data->q_payment_status==1){?>
                                        <form action="<?=base_url()?>client/Dashboard/Find_lawyer_data" method="post">
                                        <input type="hidden" name="queryId" value="<?php echo $query_ID;?>">
                                        <input type="hidden" name="lawyerId" value="<?php echo $lawyer->id;?>">
                                        <input type="hidden" name="user_ID" value="<?php echo $user_ID->scalar;?>">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">Book Your Appointment</button>
                                        </form>
                                    <?php }
                                   else if($client_pay_data->f_pay_free==1  && $client_query_data->q_payment_status==1){?>
                                        <form action="<?=base_url()?>client/Dashboard/Find_lawyer_data" method="post">
                                        <input type="hidden" name="queryId" value="<?php echo $query_ID;?>">
                                        <input type="hidden" name="lawyerId" value="<?php echo $lawyer->id;?>">
                                        <input type="hidden" name="user_ID" value="<?php echo $user_ID->scalar;?>">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">Book Your Appointment</button>
                                        </form>
                                    <?php }
                                   else if($client_pay_data->f_pay_free==1 && $client_query_data->q_payment_status==0){?>
                                        <form action="<?=base_url()?>client/Slot_booking_pay/Pay_for_slot" method="post">
                                        <input type="hidden" name="queryId" value="<?php echo $query_ID;?>">
                                        <input type="hidden" name="lawyerId" value="<?php echo $lawyer->id;?>">
                                        <input type="hidden" name="user_ID" value="<?php echo $user_ID->scalar;?>">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">Pay to book Your  Appointment</button>
                                        </form>
                                    <?php }
                                    else if($client_pay_data->f_pay_free==0 && $client_query_data->q_payment_status==0){?>
                                        <form action="<?=base_url()?>client/Slot_booking_pay/Pay_for_slot" method="post">
                                        <input type="hidden" name="queryId" value="<?php echo $query_ID;?>">
                                        <input type="hidden" name="lawyerId" value="<?php echo $lawyer->id;?>">
                                        <input type="hidden" name="user_ID" value="<?php echo $user_ID->scalar;?>">
                                        <button type="submit" class="btn btn-info _btn_color btn-lg btn-block">Pay to book Your Appointment</button>
                                        </form>
                                    <?php }?>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <?php }?>

        </div>
    </section>

    <canvas id="myChart" width="400" height="100"></canvas>
</div>

<!-- model -->
<!-- <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="width: 122%;">
            <div class="modal-header">
                <h1 class="swing-top-fwd text-center" style="font-family: Playfair Display;color:#04367d">Dear
                    <?php echo $name.' ';?>Book your slot</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation " id="client_slot"
                    action1="<?=base_url()?>client/Dashboard/Select_lawyer/" method="post">
                    <div class="_bg_jhewe11">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2 _bg_jhewe1 jhghj">
                                        <div class="dob text-center">Date</div>
                                    </div>
                                    <div class="col-md-10 _bg_jhewe1 jhghj">
                                        <div class="dob text-center">Time</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-2 _bg_jhe sfsdf date_val ">
                                                <div class=" text-center ___padd"> 
                                                    <button class="bijjbn ">12/08/2022</button>
                                                </div>
                                            </div>
                                            <div class="col-md-10 _bg_jhe ">
                                                <div class="jkh">
                                                    <span>
                                                        <button class="__btn">09:00 am</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dt1">
                                    <label for="">Date <span>*</span></label><br>
                                    <input type="text" class="schedule_date" id="shadule_date" name="schedule_date"
                                        value=""><br>
                                    <label for="">Time <span>*</span></label><br>
                                    <input type="text" class="schedule_time" id="schedule_time" name="schedule_time"value="">
                                </div>
                                <input type="hidden" class=" " id="lawyer_id" name="lawyer_id" value="<?php echo  $lawyer->id?>">
                                <input type="hidden" class="" id="client_id" name="client_id" value="<?php echo $user_ID->scalar?>">
                                <input type="hidden" class=" " id="query_id" name="query_id" value="<?php echo  $query_ID?>">
                                <input type="hidden" class=" " id="lawyer_name" name="lawyer_name"  value="<?=$lawyer->fname.' '.$lawyer->lname ;?>">
                                <div class="modal-footer" style="float: left;">
                                     <button type="button" id="click#" class="btn btn-primary click1" style="background-color:#04367d;color:white;" data-lawyerID="<?=$lawyer->id?>">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script>
const ctx = document.getElementById('myChart');
var result = <?php echo $total_order; ?>;
var date_substring;
var sub_concat_variable;
var sub_total = 0;
var price = [];
var date = [];
var months = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
for (var j = 1; j <= 12; j++) {
    if (j >= 1 && j < 10) {
        sub_concat_variable = "0" + j;
    } else {
        sub_concat_variable = j;
    }
    var selectedMonthName = months[j - 1];
    date.push(selectedMonthName); // code for show selected month 
    for (var i in result) {
        date_substring = result[i].payment_date.substr(5, 2);
        if (date_substring == sub_concat_variable) {
            sub_total = Number(sub_total) + Number(result[i].totalPrice);
        }
    }
    price.push(sub_total);
    sub_total = 0;

}
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: date,
        datasets: [{
            label: 'none',
            data: price,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]

    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
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
<script>
    $(document).ready(function() {
$(document).on('click', '.select_lawyer1', function() {

    var lawyerID = $(this).attr('data-lawyerId');
    var url1 = $(this).attr('url1');

    $.ajax({
        type: "POST",
        url: url1,
        data: {
            lawyer_id: lawyerID,

        },
        success: function(res) {

            var resp = JSON.parse(res);
            console.log(resp);
            $('.slot_date').html('');
            // Add options
            var option = '';
            var option1 = '';
            $.each(resp, function(index, v) {
                console.log(v);
                option=' <button class="bijjbn date_val" value="' + v['schedule_date'] + '">'+ v['schedule_date'] + '</button>';

                // option += '<option value="' + v['schedule_date'] + '">' + v['schedule_date'] + ' </option>';
            });
            $('.date_val').html(option);
            $.each(resp, function(index, v) {
                console.log(v);
                var resp = JSON.parse(res);
                // option1=' <button class="bijjbn date_val">12/08/2022</button>';
               
                option1 += '<option value="' + v['schedule_time'] + '">' + v[
                    'schedule_time'] + ' </option>';
            });
            $('#time').html(option1);
            


            // // $(".slot_date").val(resp.schedule_data); 
            // if (resp.status == 'true1') {
            //     $(".conjk").show().html(
            //         '<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please fill the form correcty</div>'
            //     );
            //     return true;
            // } 
        }
    });
    return false;

});

$(document).on('click', '.select_lawyer1', function() {
    var lawyerID = $(this).attr('data-lawyerId');
    var case_cat_id = $(this).attr('data-case_cat_id');
    var client_id = $(this).attr('data-userID');
    var query_id = $(this).attr('data-queryId');
    $("#lawyer_id").val(lawyerID);
    $("#client_id").val(client_id);
    $("#case_cat_id").val(case_cat_id);
    $("#query_id").val(query_id);
});


$(document).on('click', '.click1', function() {

    // $(".click1").prop('disabled', true);

    var lawyerID = $("#lawyer_id").val();
    var client_id = $("#client_id").val();
    var query_id = $("#query_id").val();
    var url = $("#client_slot").attr("action1");
    var slot_date = $("#slot_date").val();
    var time = $("#time").val();
    var period = $("#period").val();
    var contact_mode = $("#contact_mode").val();

    $.ajax({
        type: "POST",
        url: url,
        data: {
            lawyer_id: lawyerID,
            client_id: client_id,
            query_id: query_id,
            slot_date: slot_date,
            time: time,
            period: period,
            contact_mode: contact_mode

        },
        success: function(fb) {
            console.log(fb);
            var resp = $.parseJSON(fb);
            if (resp.status == 'true1') {
                $(".conjk").show().html(
                    '<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Please fill the form correcty</div>'
                );
                return true;
            } else if (resp.status == 'true2') {
                $(".lawshdfj").show().html(
                    '<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> You have successfully selected a lawyer </div>'
                );
                window.location.href = resp.reload;
                return true;

            } else if (resp.status == 'true3') {
                $(".lawshdfj").show().html(
                    '<div  class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Failed to selected a lawyer </div>'
                );
                window.location.href = resp.reload;
                return true;

            }
        }
    });
    return false;

});
});
</script>
