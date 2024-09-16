<style>
  .sdjfhilsjh{
    border: 1px solid #ffc0d3;

  }
  .hjggjugiu{
    border: 1px solid #3c8dbc;
    background: #9ee9c7;
  }

  .__all__cases {
    font-size: 2.5rem;
    text-transform: uppercase;
    font-weight: 600;
    padding: 1rem;
  }

  .__vtx__red {
    background: #ffc0d3;
  }

  .__red_top{
        border: 1px solid #f62e6a;
    background: #ff759e;
  }

</style>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery.dataTables.min.css" />
<script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
       <div class="row">
        <div class="col-md-12 ">
        <div class="__all__cases">
               <i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;&nbsp;case list
      

        </div>
       </div>
      </div>
    </section>
      <section class="content">
        <div class="row">
            <div class="col-xs-12 __badge">
              <div class="">
                <div class="box-header __vtx__red">
                    <h3 class="box-title">  Total Case List</h3>
                     <div class="box-tools">
                         
                    </div>
                </div><!-- /.box-header -->
                    
                    <!-- /.box-header -->
                    <div class="box-body table-responsive sdjfhilsjh">
                        <table class="display admin_table" cellspacing="0" width="100%" id="example">
                            <thead>
                                <tr class="__red_top">
                                    <th>S.No.</th>
                                    <th>Case Category</th>
                                    <th>Lawyer Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                     
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>

<!--  js for filter by qnt -->
<!--  js for change tranding and featured status  -->
<script type="text/javascript">
    $(document).ready(function () {
        jQuery(document).on("change", "#no_item", function () {
            var Quantity = $(this).val();

            hitURL = "<?php echo base_url() ?>client/Dashboard/ajax_list";
            //getlist(Quantity);
            //getlist(Quantity);
            /*  $.ajax({
           url:hitURL,
           method:"POST",
           data:{action:'filterbyqnt',Quantity:Quantity},
           success: function(data){
            
          },
     }); */
        });
    });
</script>

<!--  end code for filter by qnt  -->

<!--  js for change tranding and featured status  -->
<script type="text/javascript">
    $(document).ready(function () {
        jQuery(document).on("change", ".trending", function () {
            var id = $(this).attr("data_id");
            var columnName = $(this).attr("data_colname");
            var status = 0;
            hitURL = "<?php echo base_url() ?>client/Dashboard/changestatus";
            if ($(this).is(":checked")) {
                status = 1;
            } else {
                status = 0;
            }
            $.ajax({
                url: hitURL,
                method: "POST",
                data: { status: status, id: id, columnName: columnName },
                success: function (data) {},
            });
        });
    });
</script>
<!-- Delete Script-->
<script type="text/javascript">
    jQuery(document).ready(function () {
        //$('#example').DataTable();

        jQuery(document).on("click", ".deletebtn", function () {
            var tableId = $(this).attr("data_id");
            currentRow = $(this);
            hitURL = "<?php echo base_url() ?>admin/distributor/delete";
            var confirmation = confirm("Are you sure to delete this Product ?");
            if (confirmation) {
                $.ajax({
                    type: "POST",
                    url: hitURL,
                    data: { id: tableId },
                }).done(function (data) {
                    currentRow.parents("tr").remove();
                    if ((data.status = true)) {
                        alert("successfully deleted");
                        location.reload();
                    } else if ((data.status = false)) {
                        alert("deletion failed");
                    } else {
                        alert("Access denied..!");
                    }
                });
            }
        });
    });
</script>
<!-- Get Databse List -->
<script type="text/javascript">
    var table;

    $(document).ready(function () {
        //  getlist();

        //datatables
        table = $("#example").DataTable({
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            // order: [], //Initial no order.

            // Load data for the table's content from an Ajax source
            ajax: {
                url: "<?php echo site_url('client/Dashboard/ajax_list/').base64_encode($client_id)?>",
                type: "POST",
                data: { quntity: 1 },
            },

            //Set column definition initialisation properties.
            columnDefs: [
                {
                    targets: [0], //first column / numbering column
                    orderable: true, //set not orderable
                },
            ],
        });
    });
</script>
