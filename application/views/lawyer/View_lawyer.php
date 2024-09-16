<link rel="stylesheet" href="<?php echo base_url()?>/assets/user/assets/css/themify-icons.css">
    <!-- others css -->

    <link rel="stylesheet" href="<?php echo base_url()?>/assets/user/assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/ic.css">
    <style type="text/css">
  
    .sidebar-menu { width: 231px;}
    .{margin-left: 14px;}
    .mt_15{margin-top: 15px;}
    .bg-info, .bg-info>a{
    color: #fff!important;
    }
    .bg-info {
        background-color: #584489!important;
    }
    .small-box {
        border-radius: 0.25rem;
        box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
        display: block;
        margin-bottom: 20px;
        position: relative;
    }
    .bg-info {
        background-color: #584489!important;
    }
    .small-box>.inner {
        padding: 10px;
    }
  
    .col-lg-3 .small-box h3, .col-md-3 .small-box h3, .col-xl-3 .small-box h3 {
        font-size: 2.2rem;
    }
    .small-box p {
        z-index: 5;
    }
    .small-box .icon {
        color: rgba(0,0,0,.15);
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
        transition: transform .3s linear,-webkit-transform .3s linear;
    }
    .small-box>.small-box-footer {
        background-color: rgba(0,0,0,.1);
        color: rgba(255,255,255,.8);
        display: block;
        padding: 3px 0;
        position: relative;
        text-align: center;
        text-decoration: none;
        z-index: 10;
    }
    </style>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css"/>
    <script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> <?=$view->fname?><?=$view->lname?>
        <small>Control panel</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12 m-auto">
     		    <div class="row">
            		<div class="col-md-3 col-2 mt-md-5 mb-3 mt-5">
                        <div class="small-box bg-info ">
                            <div class="inner">
                                <h3></h3>
                                <p>Lawyer Details </p>
                            </div>

                            <a href="<?php echo base_url()?>lawyer/lawyer/view/<?=$id?>" class="small-box-footer">Click to View
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!--  end total order  -->
                    
                    <!-- end total category -->
                    <div class="col-md-3 col-2 mt-md-5 mb-3 mt-5">
                        <div class="small-box bg-info ">
                            <div class="inner">
                                <h3><?php echo  (isset($productCount))?$productCount:'0' ?></h3>
                                <p>All Cases </p>
                            </div>

                            <a href="#" class="small-box-footer">Click to View
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- end total Product  -->
                    <div class="col-md-3 col-2 mt-md-5 mb-3 mt-5">
                        <div class="small-box bg-info ">
                            <div class="inner">
                                <h3><?php echo  (isset($userCount))?$userCount:'0' ?></h3>
                                <p>Pending Cases</p>
                            </div>

                            <a href="#" class="small-box-footer">Click to View
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-2 mt-md-5 mb-3 mt-5">
                        <div class="small-box bg-info ">
                            <div class="inner">
                                <h3><?php echo  (isset($out_of_stock))?$out_of_stock:'0' ?></h3>
                                <p>Scheduled Cases </p>
                            </div>

                            <a href="#" class="small-box-footer">Click to View
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- end total user  -->

                </div>   
                <!-- end first row -->
        
                <div class="row mt_15">
               
                    <div class="col-md-3 col-2 mt-md-5 mb-3 mt-5">
                        <div class="small-box bg-info ">
                            <div class="inner">
                                <h3> <?php echo  (isset($total_today_sell))?$total_today_sell:'0' ?>   </h3>
                                <p>Case Recordings</p>
                            </div>

                            <a href="#" class="small-box-footer">Click to view
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!--  end today sell  -->
                    <div class="col-md-3 col-2 mt-md-5 mb-3 mt-5">
                        <div class="small-box bg-info ">
                            <div class="inner">
                                <h3> <?php echo  (isset($total_week_sell))?$total_week_sell:'0' ?>   </h3>
                                <p>View All Case Study </p>
                            </div>

                            <a href="#" class="small-box-footer">Click to view
                                <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!--  end week sales  -->
                    

                    <!--  end year sales  -->
                   
                    <!--  end year sales  -->
                    
                   
                </div>
               
                    

                </div>

                <!--  end second row -->
                <!-- third row -->
                
                <!--  end third row -->
            </div>
        </div>
    </section>
    <canvas id="myChart" width="400" height="100"></canvas>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>


<script>
    const ctx = document.getElementById('myChart');
    var result  = <?php echo $total_order; ?>;    
    var date_substring;var sub_concat_variable;
    var sub_total=0;
    var price = [];
    var date = [];
    var months = [ "January", "February", "March", "April", "May", "June", 
           "July", "August", "September", "October", "November", "December" ];
    for(var j=1;j<=12;j++)
    {
        if(j>=1 && j<10)
        {
            sub_concat_variable="0"+j;
        }
        else{
            sub_concat_variable=j;
        }
        var selectedMonthName = months[j-1];
        date.push(selectedMonthName);  // code for show selected month 
        for (var i in result){
            date_substring=result[i].payment_date.substr(5, 2);
            if(date_substring == sub_concat_variable)
            {
             sub_total=Number(sub_total)+Number(result[i].totalPrice);
            }
        }
        price.push(sub_total);
        sub_total=0;

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
 
$(document).ready(function(){
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
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
});
</script>

<style type="text/css">
.SealBox {
    display: inline-block;
    width: 100%;
    margin: 4px;
    flex-wrap: wrap;
}
.seofct-icon {
   text-align: center;
}

.seo-fact  {
    flex-wrap: wrap;
}

.DashboardSeal {

        width: 100%;
    display: inline-flex;
}
</style>