<?php  $coloraArray = ["#ffe771", "#ff7e7161", "#71ff89", "#2f763b75", "#819d9987", "#55f9e2", "#536ce529",
                            "#ad53e5c7", "#bc51ff29", "#f140e340", "#f140b2"];?>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/calling"> <i class="fa fa-sitemap" aria-hidden="true"></i>
                Calling</a>
            <small>Add New Calling</small>
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

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="box-header">
                    <h3 class="box-title">Add New Calling</h3>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="for_imffhd">
                            <h4 class="text-uppercase text-center"><b>Client: </b> <b
                                    class="text-warning"><?php echo $edit_data[0]->name?></b>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-11 m-auto">
                        <div class="for_client__">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">

                                    <?php if(isset($edit_data[0]) && !empty($edit_data[0])){ ?>
                                    <tbody>

                                        <tr>
                                            <th>Name </th>
                                            <td> : <?php echo $edit_data[0]->name?></td>
                                        </tr>
                                        <tr>
                                            <th>Email </th>
                                            <td>: <?php echo $edit_data[0]->email?></td>
                                        </tr>
                                        <tr>
                                            <th>Mobile </th>
                                            <td>: <?php echo $edit_data[0]->mobile?></td>
                                        </tr>
                                        <tr>
                                            <th>State </th>
                                            <td>: <?php echo $edit_data[0]->state?></td>
                                        </tr>
                                        <tr>
                                            <th>City </th>
                                            <td>: <?php echo $edit_data[0]->city?></td>
                                        </tr>
                                        <tr>
                                            <th>Leading Date </th>
                                            <td>:
                                                <?php echo date("Y-m-d / h:i A", strtotime($edit_data[0]->leading_date))?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Leading Source </th>
                                            <td>:
                                                <?php echo $edit_data[0]->source?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Status </th>
                                            <td>
                                                :
                                                <?php echo ($edit_data[0]->status ==1)?'<b class="text-success">Active</b>':'<b class="text-danger">Inactive</b>'?></b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Adding Date</th>
                                            <td>:
                                                <?php echo date("Y-m-d / h:i A", strtotime($edit_data[0]->adding_dt))?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Comment</th>
                                            <td>: <?php echo $edit_data[0]->comment?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bg-primary text-uppercase"><b>Next Follow Up List</b>
                                            </td>
                                        </tr>
                                        <?php
                                        $JsonData = json_decode($edit_data[0]->additional);
                                        // pre($JsonData);
                                        if(isset($JsonData) && !empty($JsonData)){
                                            $i=0;
                                        foreach ($JsonData as $key => $value) {
                                            $i++;
                                            
                                        ?>
                                        <?php if($i==1){
                                            if($value->subject !=''){?>
                                        <tr>
                                            <th>Subject </th>
                                            <td>: <?php echo $value->subject?></td>
                                        </tr>
                                        <tr>
                                            <th>Follow up Date </th>
                                            <td>: <?php echo date("Y-m-d / h:i A", strtotime($value->folloup_dt))?></td>
                                        </tr>
                                        <tr>
                                            <th>Details </th>
                                            <td>: <?php echo $value->details?></td>
                                        </tr>
                                        <tr>
                                            <th>Added By </th>
                                            <td>: <?php echo $value->added_by?></td>
                                        </tr>
                                        <tr>
                                            <th>Adding Date </th>
                                            <td>: <?php echo date("Y-m-d / h:i A", strtotime($value->adding_dt))?></td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <th>Last Updated </th>
                                            <td>:
                                                <?php echo (isset($value->last_updated) && !empty($value->last_updated))? date("Y-m-d / h:i A",strtotime($value->last_updated)):"";?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModalCenter<?=$i?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" data-backdrop="static"
                                                    id="exampleModalCenter<?=$i?>" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <form class="editData"
                                                            action="<?=base_url('admin/calling/newUpdate')?>"
                                                            method="post">
                                                            <div class="modal-content" style="border-radius:25px;">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        <b>Edit details</b>
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <textarea name="details"
                                                                        class="form-control"><?=$value->details?></textarea>
                                                                </div>
                                                                <input type="hidden" name="count" value="1">
                                                                <input type="hidden" name="id"
                                                                    value="<?=$edit_data[0]->id?>">
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary closeBtn"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bg-info"></td>
                                            <?php }}else{?>
                                        <tr>
                                            <th>Subject </th>
                                            <td>: <?php echo $value->subject?></td>
                                        </tr>
                                        <tr>
                                            <th>Follow up Date </th>
                                            <td>: <?php echo date("Y-m-d / h:i A", strtotime($value->folloup_dt))?></td>
                                        </tr>
                                        <tr>
                                            <th>Details </th>
                                            <td>: <?php echo $value->details?></td>
                                        </tr>
                                        <tr>
                                            <th>Added By </th>
                                            <td>: <?php echo $value->added_by?></td>
                                        </tr>
                                        <tr>
                                            <th>Adding Date </th>
                                            <td>: <?php echo date("Y-m-d / h:i A", strtotime($value->adding_dt))?></td>
                                        </tr>
                                        <tr>
                                            <th>Last Updated </th>
                                            <td>:
                                                <?php echo (isset($value->last_updated) && !empty($value->last_updated))? date("Y-m-d / h:i A",strtotime($value->last_updated)):"";?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModalCenter<?=$i?>">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" data-backdrop="static"
                                                    id="exampleModalCenter<?=$i?>" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                                        <form class="editData"
                                                            action="<?=base_url('admin/calling/newUpdate')?>"
                                                            method="post">
                                                            <div class="modal-content" style="border-radius:25px;">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        <b>Edit details</b>
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <textarea name="details"
                                                                        class="form-control"><?=$value->details?></textarea>
                                                                </div>
                                                                <input type="hidden" name="count" value="<?=$i?>">
                                                                <input type="hidden" name="id"
                                                                    value="<?=$edit_data[0]->id?>">
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-secondary closeBtn"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary save">Save
                                                                        changes</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="bg-info"></td>
                                        </tr>
                                        <?php }}?>
                                    </tbody>
                                    <?php }} ?>
                                </table>
                                <br>
                            </div>
                        </div>
                        <div class="__flx_button_prv_nxt" style="width:99%">
                            <div class="__bck_butn">
                                <a href="<?=base_url()?>admin/calling" class="button_news"> &lt; Back</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-12">
                <div class="box-body">
                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/calling/update"
                        method="post" role="form">
                        <div class="addrowhere"></div>
                        <input type="hidden" name="id" value="<?=$edit_data[0]->id?>" />
                        <input type="submit" class="btn btn-primary formSubmit hidden" value="Submit" />
                    </form>
                    <!-- Next Follow Up end -->
                    <div class="col-md-12 text-right btnDisable">
                        <a class="btn btn-primary" id="addRow"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>

<script>
$(document).ready(function() {
    let i = 2;
    let coloraArray = ['#71ff89', '#2f763b75', '#819d9987', '#55f9e2', '#536ce529',
        '#ad53e5c7', '#bc51ff29', '#f140e340', '#f140b2'
    ];
    $("#addRow").click(function() {
        var html = '';
        html += '<div class="row m-1" style="background:' + coloraArray[i] + '">';
        html += ' <div class="col-md-4">';
        html += ' <div class="form-group">';
        html += ' <label for="subject">Subject</label>';
        html +=
            ' <input type="text" name="subject" class="form-control" placeholder="Enter subject" autocomplete="off">';
        html += ' </div>';
        html += ' </div>';
        html += ' <div class="col-md-4">';
        html += ' <div class="form-group">';
        html += ' <label for="date">Next Follow Up Date</label>';
        html +=
            ' <input type="date" name="next_date" class="form-control" placeholder="Enter next follow up date" autocomplete="off">';
        html += ' </div>';
        html += ' </div>';
        html += ' <div class="col-md-4">';
        html += ' <div class="form-group">';
        html += ' <label for="time">Next Follow Up Time</label>';
        html +=
            ' <input type="time" name="next_time" class="form-control" placeholder="Enter next follow up time" autocomplete="off">';
        html += ' </div>';
        html += ' </div>';
        html += ' <div class="col-md-12">';
        html += ' <div class="form-group">';
        html += ' <label for="details">Details</label>';
        html += ' <textarea name="details" cols="30" class="form-control" rows="2"></textarea>';
        html += ' </div>';
        html += ' </div>';
        html += '</div>';

        $('.addrowhere').append(html);
        $("#addRow").attr('disabled', 'disabled')
        $(".formSubmit").removeClass('hidden')
        i++;
    });
});
</script>



<script>
$(document).ready(function() {
    $(".editData").submit(function(e) {
        e.preventDefault()
        var formData = new FormData(this);
        var url = "<?=base_url()?>admin/calling/newUpdate";
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(returnVal) {
                if (returnVal == 1) {
                    $(".closeBtn").click();
                }
            }
        });
        return false;
    });

})
</script>