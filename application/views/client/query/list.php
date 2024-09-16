<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="__all__cases">
                        <i class="fa fa-sitemap" aria-hidden="true">&nbsp;&nbsp;</i>Meeting List
                        <a href="<?= base_url('client/meeting?type=upcoming') ?>"
                            class="pull-right  btn btn-md btn-success __blink_dasg45 p-1 sdjfhilsjh"><i
                                class="bi bi-arrow-counterclockwise"></i> Upcoming Meetings</a>
                        <a href="<?= base_url('client/meeting') ?>"
                            class="pull-right  btn btn-md btn-info __blink_dasg45 p-2 sdjfhilsjh"><i
                                class="bi bi-list"></i> All
                            Meetings</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content"><?php echo $this->session->flashdata('message'); ?>
        <div class="row">
            <div class="col-xs-12 __badge">
                <div class="">
                    <div class="box-header __vtx__red sdjfhilsjh">
                        <h3 class="box-title"> Meeting List </h3>
                        <div class="box-tools">

                        </div>
                    </div><!-- /.box-header -->
                    <!-- deshtop view  -->
                    <div class="box-body table-responsive sdjfhilsjh">
                        <table class="display " cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="__green__vtx322354">
                                    <th>S.No.</th>
                                    <th>Message</th>
                                    <th>Assign Lawyer</th>
                                    <th>Status</th>
                                    <th>Date At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    <!-- mobile view -->
                    <div class="mt-2 mobileDisplay">
                        <?php if(isset($queryData) && !empty($queryData)){
                        foreach ($queryData as $key => $value) {?>
                        <div class="mobile_box m-1">
                            <div class="d-flex flex-row mb-3">
                                <div class="p-2">
                                    <ul class="liHeading">
                                        <li>Message</li>
                                        <li>Assign Lawyer</li>
                                        <li>Status</li>
                                        <li>Date</li>
                                    </ul>
                                </div>
                                <div class="p-2">
                                    <ul class="dataList">
                                        <li class="msgTest">: <?php echo $value->msg?></li>

                                        <?php 
                                    $lawyerID = $value->assign_lawyer;
                                    $lawyer= $this->db->query("select id,fname,lname from lawyer where `id` = $lawyerID ");
                                    $lawyerData=$lawyer->result_array(); 
                                    if(isset($lawyerData) && !empty($lawyerData)){
                                    $lawyerData  =$lawyerData[0];
                                    echo ':<li>:'.$lawyerData['fname'].' '.$lawyerData['lname'];'</li>';
                                    }else{
                                        echo ": -";
                                    }
                                   ?>

                                        <li>:
                                            <?php echo ($value->status==1)?'<span class="badge bg-success">Success</span>':'<span class="badge bg-danger">Pending</span>'?>
                                        </li>
                                        <li>: <?php echo date("d M Y",strtotime($value->dateAt))?></li>

                                    </ul>
                                </div>
                                <div class="right__iconer"><a
                                        href="<?= base_url('client/query/chat/'.base64_encode($value->id))?>">
                                        <i class="bi bi-chevron-right h1"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php }}else{?>
                        <h1 class="text-warning">No data</h1>
                        <?php }?>
                        <!-- mobile view end  -->

                    </div>
                </div>
            </div>
    </section>
</div>
<!-- Get Databse List -->
<!-- Get Databse List -->
<script type="text/javascript">
var table;

$(document).ready(function() {
    var type = "<?php echo (isset($_GET['type']))?'?type='.$_GET['type']:'' ?>";
    //datatables
    table = $('#example').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('client/query/ajax_list')?>" + type,
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