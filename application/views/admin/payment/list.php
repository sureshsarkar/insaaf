<?php 
 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_GET['key']) && !empty($_GET['key'])){
    $data['id']=base64_decode($_GET['key']);
    $data['status']=1;
    $data['update_dt']=date("Y-m-d H:i:s");
   update_notification($data);
}
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/tableHTMLExport.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-sitemap" aria-hidden="true"></i> Payment List
            <small> Edit, Delete</small>
        </h1>


    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <!-- <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/color/addnew"><i class="fa fa-plus"></i> Add New</a> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box p-2">
                    <div class="d-flex flex-row m-2">
                        <button type="button" class="btn btn-info all">All</button>
                        <button type="button" class="btn btn-success clickPayment" data-value="close"> Success</button>
                        <button type="button" class="btn btn-danger clickPayment" data-value="open"> Failed</button>
                        <button type="button" class="btn btn-primary clickPayment" data-value="1">Today</button>
                        <button type="button" class="btn btn-warning clickPayment" data-value="7">Weekly</button>
                        <button type="button" class="btn btn-info clickPayment" data-value="30">Monthly </button>
                        <button type="button" class="btn btn-warning clickPayment" data-value="365">Yearly</button>
                        <button class="btn btn-success export-btn" onclick="exportTableToExcel('example')"><i
                                class="fa fa-file-excel-o"></i>Export in Excel</button>
                        <button class="btn btn-danger deletByCheck">Delete</button>

                    </div>
                    <div class="box-header">
                        <h3 class="box-title">Filter Query List
                            <span style="margin-left:10px;">
                                <select id="shortBtn">
                                    <option value="all">Sort By</option>
                                    <option value="open"
                                        <?= (isset($_GET['typeOf']) && $_GET['typeOf'] == 'open' )?"selected":''?>>
                                        Pendding
                                    </option>
                                    <option value="close"
                                        <?= (isset($_GET['typeOf']) && $_GET['typeOf'] == 'close' )?"selected":''?>>
                                        Active
                                    </option>
                                </select>
                            </span>
                            <span style="margin-left:10px;">
                                <input type="Date" class="text-black date_pic from_date" placeholder="To Date">
                            </span>

                            <span style="margin-left:10px;">To</span>

                            <span style="margin-left:10px;">
                                <input type="Date" class="text-black date_pic to_date" placeholder="To Date">
                            </span>
                            <span class="find_by_date" style="margin-left:10px;"><i
                                    class="bi bi-arrow-right-circle-fill fs-1"></i></span>
                        </h3>
                        <div class="box-tools">

                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table class="display " cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="bg-5" style="background: #b3d8f7; margin-buttom:10px;">
                                    <th></th>
                                    <th>S.No.</th>
                                    <th>Client Name</th>
                                    <th>Mobile</th>
                                    <th>Total Amount</th>
                                    <th>Order ID</th>
                                    <th>Payment Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->


                <!-- graph start -->
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
                <!-- graph end  -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<!--google chart graph start  -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<!--google chart graph start  -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
$(document).ready(function() {

    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);
    var result = <?php echo $jsonData ?>;
    console.log(result);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(result);
        var options = {
            chart: {
                title: 'Insaaf99',
                subtitle: 'Payment And Meetings: <?= $year?>',
            },
            bars: 'vertical', // Required for Material Bar Charts.
            hAxis: {
                format: 'decimal'
            },
            height: 400,
            colors: ['#1b9e77', '#8e44ad']
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


<!-- Delete Script-->
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery(document).on("click", ".deletebtn", function() {
        var tableId = $(this).attr("data_id");
        currentRow = $(this);
        hitURL = "<?php echo base_url() ?>admin/Payment/delete";
        var confirmation = confirm("Are you sure to delete this Payment ?");
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

                    // location.reload();
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

<!-- script to download excel sheet  -->
<script>
$(document).ready(function() {
    $(".export-btn").click(function() {
        $("#example").tableHTMLExport({
            type: 'csv',
            filename: 'insaaf99-payment.csv',
        });
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#shortBtn").change(function() {
        var sortBy = $(this).val();
        var url = "<?php echo base_url();?>";
        url = url + 'admin/payment?typeOf=' + sortBy;
        window.location.href = url;
    });
});
</script>

<!-- Get Databse List -->
<script type="text/javascript">
var table;
$(document).ready(function() {
    _fnGetTableData();

});

// function get table data from data base
function _fnGetTableData() {
    <?php
         $from_date = isset($_GET['from_date'])?'&from_date='.$_GET['from_date']:"";
         $to_date = isset($_GET['to_date'])?'&to_date='.$_GET['to_date']:"";
         $typeOf = isset($_GET['typeOf'])?'typeOf='.$_GET['typeOf']:"";
         $status = isset($_GET['status'])?'status='.$_GET['status']:"";
    ?>
    var getpayment_data =
        "<?php echo  isset($_GET['daterange'])?'?daterange='.$_GET['daterange'].$from_date.$to_date."&".$status:"?".$typeOf."&".$status?>";

    //datatables
    table = $('#example').DataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/payment/ajax_list')?>" + getpayment_data,
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [{
            "targets": [0], //first column / numbering column
            "orderable": false, //set not orderable
        }, ],
    });
}
</script>

<!-- Get Databse List by date  -->
<script type="text/javascript">
$(document).ready(function() {
    $(".find_by_date").click(function() {
        var typeOf = "<?php echo  isset($_GET['typeOf'])?$_GET['typeOf']:"";?>";
        var status = "<?php echo  isset($_GET['status'])?$_GET['status']:"";?>";

        var from_date = $(".from_date").val();
        var to_date = $(".to_date").val();
        if (from_date == '' || to_date == '') {
            alert("Please select dates");
            return false;
        }
        var url = "<?php echo base_url();?>";
        url = url + 'admin/payment/?daterange=daterangefilter&from_date=' + from_date +
            '&to_date=' +
            to_date;
        url = url + '&status=' + status;

        window.location.href = url;
    });
});
</script>

<script>
// get lawyer list by click the active,pending& new  
$(document).ready(function() {
    $(".clickPayment").click(function() {
        let sortBy;
        var typeOf = "<?php echo  isset($_GET['typeOf'])?$_GET['typeOf']:"";?>";
        let status = "<?php echo  isset($_GET['status'])?$_GET['status']:"";?>";

        sortBy = $(this).attr("data-value");

        if (sortBy == "open" || sortBy == "close") {
            status = sortBy;
        } else {
            typeOf = sortBy;
        }
        var url = "<?php echo base_url();?>";
        url = url + 'admin/payment?typeOf=' + typeOf + "&status=" + status;
        window.location.href = url;

    })

    $(".all").click(function() {

        var url = "<?php echo base_url();?>admin/payment";
        window.location.href = url;
    })
});
</script>

<!-- script to delete multiple -->
<script>
jQuery(document).ready(function() {
    $(".deletByCheck").attr('disabled', 'disabled');
    jQuery(document).on("click", ".checkbox", function() {
        var da = $("input:checkbox[name=checkbox]:checked");
        if (da.length != "") {
            jQuery(".deletByCheck").removeAttr("disabled");
        } else {
            $(".deletByCheck").attr('disabled', 'disabled');
        }
    });

    var allVals = [];
    jQuery(document).on("click", ".deletByCheck", function() {
        $("input:checkbox[name=checkbox]:checked").each(function() {
            allVals.push($(this).val());
        })
        if (allVals.length > 0) {
            var hitURL = "<?php echo base_url() ?>admin/payment/deleteByCheck";
            $.ajax({
                type: 'POST',
                url: hitURL,
                data: {
                    allVals: allVals
                },
            }).done(function(res) {
                if (res == 1) {
                    alert("Deleted Successfully");
                    location.reload();
                }
            });
        }
    });
})
</script>