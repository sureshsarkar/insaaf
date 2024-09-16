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
            <div class="col-md-12">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add New Calling</h3>
                    </div>

                    <!-- 			subject	details	folloup_dt	adding_dt	status	seen	 -->

                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/calling/insertnow"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Client Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter calling Name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Client mobile</label>
                                        <input type="number" name="mobile" class="form-control"
                                            placeholder="Enter mobile number" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Client Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Enter email"
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="state">Client State</label>
                                        <input type="text" name="state" class="form-control" placeholder="Enter state"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="city">Client City</label>
                                        <input type="text" name="city" class="form-control" placeholder="Enter city"
                                            autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">Leading Date</label>
                                        <input type="date" name="date" class="form-control"
                                            placeholder="Enter leading date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="time">Leading Time</label>
                                        <input type="time" name="time" class="form-control"
                                            placeholder="Enter leading time" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="text">Leading Source</label>
                                        <input type="text" name="source" class="form-control"
                                            placeholder="Enter leading Source" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Comment">Comment</label>
                                        <textarea name="comment" cols="30" class="form-control" rows="2"></textarea>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary formSubmit hidden1" value="Submit" />
                            </div>
                            <div class="col-md-12">
                                <div class="box-body">
                                    <form role="form" id="member_form"
                                        action="<?php echo base_url() ?>admin/calling/update" method="post" role="form">
                                        <div class="addrowhere"></div>
                                    </form>
                                    <!-- Next Follow Up end -->
                                    <div class="col-md-12 text-right btnDisable">
                                        <a class="btn btn-primary" id="addRow"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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