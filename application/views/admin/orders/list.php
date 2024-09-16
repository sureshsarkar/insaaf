
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <i class="fa fa-sitemap" aria-hidden="true"></i> order list
      
      </h1>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                
                <div class="box-body table-responsive">
                  <table id="myTable" class="display">
                    <thead>
                    <th >S.No.</th>
                                                                  
                    <th>Name</th> 
                    <th>Email</th> 
                    <th>Mobile</th> 
                    <th>transaction ID</th>                                            
                    <th>Order Id </th>                                            
                    <th>Price</th>                                            
                    <th>Status</th>                                            
                                                            
                      <th>Payment Date</th> 
                      <th>Invoice</th>                                            
                    <th class="">Actions</th>
                    </thead>
                    <tbody>
                      <?php if(!empty($order_list)) {
                        $i=0;
                        foreach ($order_list as $key => $value) {
                        
                          $i++;
                          
                      ?>
                      <tr>
                          <td><?=$i?></td>
                          <td><?=$value->first_name?></td>
                          <td><?=$value->email?></td>
                          <td><?=$value->mobile?></td>
                          <td><?=$value->txn_id?></td>
                          <td><?=$value->order_id?></td>
                          <td><?= '₹ '.$value->totalPrice;?></td>
                          <td><?=($value->payment_status=='Success')?'<span class="btn-success">Success</span>':'<span class="btn-danger">'.$value->payment_status.'</span>'?></td>
                          <td><?=$value->date_at?></td>
                          <td><?='<a class="btn btn-sm btn-success" href="'.base_url().'/utils/invoices/'.$value->first_name.$value->pdfname.$value->user_id.'invoice.pdf" title="Download"  data_id="'.$value->id.'" ><i class="fa fa-download"></i></a>';?></td>
                          <td><?='<a class="btn btn-sm btn-danger deletebtn" href="javascript:void(0)" title="delete"  data_id="'.$value->id.'" ><i class="fa fa-trash"></i></a>';?></td>
                        </tr>
                      <?php } } ?>
                        
                    </tbody>
                </table>
                  
                  
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<!--  js for change tranding and featured status  -->

<!-- Delete Script-->
  <script type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
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









