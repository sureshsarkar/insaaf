<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">User List</h3>
                     <div class="box-tools">
                         
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="myTable" class="display">
                    <thead>
                      <tr>
                        <th >S.No.</th>                                        
                        <th>Name</th>  
                        <th>Email</th>
                        <th>Mobile</th>                                         
                    
                        <th>Address</th>
                        <th>Status</th>                                            
                        <th>Date</th>                                            
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                      <?php if(!empty($user_list)) {
                          $i=0;
                          foreach ($user_list as $key => $value) {
                            $i++;
                        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$value->fullname?></td>
                            <td><?=$value->email?></td>
                            <td><?=$value->mobile?></td>
                            <td><?=$value->address?></td>
                            <td><?=($value->status==1)?'<span class="btn-success">Active</span>':'<span class="btn-danger">InActive</span>'?></td> 
                            <td><?=$value->date_at?></td>
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

<!-- Delete Script-->
  <script type="text/javascript">
    jQuery(document).ready(function(){
        $(document).ready( function () {
          $('#myTable').DataTable();
      } );
        //$('#example').DataTable();
          jQuery(document).on("click", ".deletebtn", function(){
          var tableId = $(this).attr("data_id");
          currentRow = $(this);
          hitURL = "<?php echo base_url() ?>admin/userlist/delete";
          var confirmation = confirm("Are you sure to delete this Categorys ?");
          if(confirmation)
          {
            $.ajax({
            type : 'POST',
            url :hitURL,
            data: {id:tableId}, 
            }).done(function(data){ 
              currentRow.parents('tr').remove();          
              if(data.status = true) { alert("successfully deleted"); }
              else if(data.status = false) { alert("deletion failed"); }
              else { alert("Access denied..!"); }
            });



          }
     });
    });
   
</script>
<!-- Get Databse List -->








