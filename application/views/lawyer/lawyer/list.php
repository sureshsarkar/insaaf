<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <i class="fa fa-sitemap" aria-hidden="true"></i> 
      
      <?=$userData->fname.' '.$userData->lname?>
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
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lawyers List</h3>
                     <div class="box-tools">
                         
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
 
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$userData->fname.' '.$userData->lname?></td>
                            <td><?=$userData->email?></td>
                            <?php if($userData->status==1){?>
                            <td ><span class="badge" style=" background:#008d4c; color:white; ">Approved</span> </td> <?php }else{?> <td><span class="badge" style=" background:#d73925; color:white;">Pending</span></td>  <?php }?>
                            <td><?=$userData->dt?></td>
                            <td><a class="btn btn-sm btn-info" href="<?php echo  base_url()?>lawyer/lawyer/edit/<?=$userData->id?>" title="Edit" ><i class="fa fa-pencil"></i></a> <a class="btn btn-sm btn-info " href="<?=base_url()?>lawyer/lawyer/view/<?=$userData->id?>" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a></td>
                        </tr>
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
        //$('#example').DataTable();

          jQuery(document).on("click", ".deletebtn", function(){
          var tableId = $(this).attr("data_id");
          currentRow = $(this);
          hitURL = "<?php echo base_url() ?>lawyer/lawyer/delete";
          var confirmation = confirm("Are you sure to delete this Categorys ?");
          if(confirmation)
          {
            $.ajax({
            type : 'POST',
            url :hitURL,
            data: {id:tableId}, 
            }).done(function(data){ 
              currentRow.parents('tr').remove();          
              if(data.status = true) { alert("successfully deleted");
                location.reload();
               }
              else if(data.status = false) { alert("deletion failed"); }
              else { alert("Access denied..!"); }
            });



          }
     });
    });
   
</script>
<!-- Get Databse List -->


<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
  </script>










