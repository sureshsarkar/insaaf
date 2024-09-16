
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            <?php echo  $name;?>
            <small class="__panel123">Control panel</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary __BG">
                    <div class="main-block">
                        <div class="formInnerGIF" id="loaderAreaCon">
                            <div class="row">
                                <div class="col-md-12 text-center py-5">
                                    <img src="<?php echo base_url('assets/images/loader.gif') ?>" alt="" width="40%">
                                </div>
                            </div>
                        </div>
                        <div class="Form_hide">
                            <h1>Insaaf99</h1>
                            <form
                                action="<?=base_url()?>client/Refund/insert/<?=$_SESSION['id']?>"
                                method="post" role="form">
                                
                                <label id="icon" for="name"><i class="fa fa-user"></i></label>
                                <input type="text" name="name" class="Text_class"  value="<?=$_SESSION['name'];?>" readonly><br>
                                <label for="name" class="text_light">Reason</label><br>
                                <textarea type="text" name="reason" class="_teartarea" value="" placeholder="Enter Reason for Refund" required></textarea>
                                <div class="btn-block __Text">
                                    <!-- <p>Pay Registration Fee Rs. 99 to Go to Dashboard</p> -->
                                    <input type="hidden" name="q_id" value="<?=$Query_Data->q_id?>">
                                    <input type="hidden" name="client_id" value="<?=$Query_Data->user_id?>">
                                    <input type="hidden" name="order_id" value="<?=$Query_Data->order_id?>">
                                    <input type="hidden" name="txn_id" value="<?=$Query_Data->txn_id?>">
                                    <input type="hidden" name="payment_status" value="<?=$Query_Data->payment_status?>">
                                    <input type="hidden" name="amount" value="<?=$Query_Data->amount?>">
                                    <button type="submit" class="Fquery ">Take Refund</button>
                                </div>
                            </form>
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

<style>
    input[type=radio] {
    display: none;
}
</style>