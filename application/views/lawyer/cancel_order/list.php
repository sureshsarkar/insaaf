

<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<!-- modernizr css -->
<script src="<?php echo base_url()?>/assets/user/assets/js/vendor/modernizr-2.8.3.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-sitemap" aria-hidden="true"></i> <?php echo $ListType; ?> Cancel Order

      </h1>
    </section>
    <section class="content">
        <!--  show order list  -->
                    <div class="row">
                <!-- order list start -->
                      <div class="col-12 mt-5">
                          <div class="card">
                              <div class="card-body">
                                 
                                  <div class="data-tables datatable-dark">
                                      <table id="dataTable3" class="text-center">
                                          <thead class="text-capitalize">
                                              <tr>
                                                <th>S.N.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>OrderId</th>
                                                <th>Price</th>
                                                <th>Cancel Status</th>
                                                <th>Payment Status </th>
                                                <th>Invoice </th>
                                                <th>Payment Date</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                            <?php if(isset($total_today_cancel)) { 
                                                $i=1;
                                              foreach ($total_today_cancel as $key => $value) {
                                              
                                              ?>
                                              <tr>
                                                <td><?=$i;?></td>
                                                <td><?= $value->first_name?></td>
                                                <td><?= $value->email?></td>
                                                <td><?= $value->mobile?></td>
                                                <td><?= $value->order_id?></td>
                                                <td><?= $value->totalPrice?></td>
                                                <td><?php echo ($value->cancel_status==1)?'Canceled':'';?></td>
                                                <td>
                                                  <span class="text-<?php echo  ($value->payment_status=='Success')?'success':'danger'; ?>">
                                                      <?=$value->payment_status?>
                                                  </span>
                                                </td>
                                                <td><?='<a class="btn btn-sm btn-success" href="'.base_url().'/utils/invoices/'.$value->first_name.$value->pdfname.$value->user_id.'invoice.pdf" title="Download"  data_id="'.$value->id.'" ><i class="fa fa-download"></i></a>';?></td>
                                                <td><?= $value->update_at?></td>
                                                  
                                                </tr>
                                                <?php $i++; } }?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                    <!-- order list end -->
              </div>
           <!--  end code for order list -->
   
    </section>
</div>
<!--  js for change tranding and featured status  -->


    
    <!-- bootstrap 4 js -->
    <script src="<?php echo base_url()?>/assets/user/assets/js/metisMenu.min.js"></script>
    <script src="<?php echo base_url()?>/assets/user/assets/js/jquery.slimscroll.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
  <!-- Start datatable js -->
  <script src="<?php echo base_url()?>/assets/user/assets/js/scripts.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function(){
        //$('#example').DataTable();

          jQuery(document).on("click", ".deletebtn", function(){
          var tableId = $(this).attr("data_id");
          currentRow = $(this);
          hitURL = "<?php echo base_url() ?>admin/order/delete";
          var confirmation = confirm("Are you sure to delete this order ?");
          if(confirmation)
          {
            $.ajax({
            type : 'POST',
            url :hitURL,
            data: {id:tableId}, 
            }).done(function(data){ 
              currentRow.parents('tr').remove();          
              if(data.status = true) { alert("successfully deleted"); location.reload();}
              else if(data.status = false) { alert("deletion failed"); }
              else { alert("Access denied..!"); }
            });



          }
     });
    });
   
</script>
<!-- Get Databse List -->
<script type="text/javascript">
 
var table;
 
$(documenhfgdht).ready(function() {
      var list_type = $("#list_type").val();

    //datatables
    table = $('#example').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/sales/ajax_list')?>",
            "type": "POST",
            "data":{list_type:list_type}
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








