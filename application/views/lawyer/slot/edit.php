<style>
.formInnerGIF {
    display: none;
}

.padd_yu {
    padding: 7px;
    text-align: center;
    font-size: 20px;
    color: green;
}

.center989 {
    width: 50%;
    background: #00d6ff8f;
}
</style>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>


            <a href="<?php echo base_url();?>lawyer/slot/index/<?=base64_encode($edit_data->lawyer_id)?>"> <i
                    class="fa fa-sitemap" aria-hidden="true"></i> Slot</a>
            <small>Edit</small>
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
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                    </div>
                    <div class="formInnerGIF " id="loaderAreaCon">
                        <div class="row">
                            <div class="col-md-12 text-center py-5">
                                <img src="<?php echo base_url('assets/images/loader.gif') ?>" alt="" width="20%">
                            </div>
                        </div>
                    </div>
                    <div class="center989">
                        <div class="padd_yu">
                            Please Approve the status
                        </div>
                    </div>
                    <form role="form" id="member_form" action="<?=base_url()?>lawyer/Slot/update" method="post"
                        role="form" enctype="multipart/form-data">
                        <div class="box-body _Hide_box">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name"> Client Name</label>
                                        <input type="text" id="name" name="client_id" class="form-control"
                                            readonly="readonly"
                                            value="<?php echo $client_data->fname.' '.$client_data->lname; ?> ">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name"> Client Code</label>
                                        <input type="text" id="name" name="client_id" class="form-control"
                                            readonly="readonly"
                                            value="<?php echo $client_data->client_unique_id ?> ">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name"> Slot Date</label>
                                        <input type="text" id="name" name="slot_date" class="form-control"
                                            readonly="readonly" value="<?php echo $edit_data->slot_date; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Time</label>
                                        <?php $time= date("h:i a", strtotime($edit_data->time)) ?>
                                        <input type="text" id="name" name="time" class="form-control"
                                            readonly="readonly" value="<?php echo $time; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Period</label>
                                        <input type="text" id="name" name="period" class="form-control"
                                            readonly="readonly" value="<?php echo $edit_data->period; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Contact Mode</label>
                                        <select class="form-control" name="contact_mode" id="contact_mode"
                                            readonly="readonly">
                                            <option value="Zoom Meeting"
                                                <?php echo ($edit_data->contact_mode == 'Zoom Meeting')?'selected':''; ?>>
                                                Zoom Meeting</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="hidden" value="" class="click_status">
                                        <select class="form-control" name="slot_status" id="status">
                                            <option value="0"
                                                <?php echo ($edit_data->slot_status == 0)?'selected':''; ?>>Pending
                                            </option>
                                            <option value="1"
                                                <?php echo ($edit_data->slot_status == 1)?'selected':''; ?>>Approve
                                            </option>
                                            <option value="2" <?php echo ($edit_data->slot_status == 2)?'selected':''; ?> >Decline</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php if(!empty($query_data->query)){?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Query</label>
                                         <textarea  cols="167" rows="5" readonly><?=$query_data->query?></textarea>
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="id" value="<?=$edit_data->id;?>" />
                <input type="hidden" name="client_email" value="<?=$client_data->email;?>" />
                <input type="hidden" name="client_phone" value="<?=$client_data->mobile;?>" />
                <input type="hidden" name="client_name" value="<?php echo $client_data->fname.' '.$client_data->fname;?>" />
                <input type="hidden" id="name" name="client_id" value="<?=$edit_data->client_id; ?>" />
                <input type="hidden" id="name" name="lawyer_id" value="<?=$edit_data->lawyer_id; ?>" />
                <input type="hidden" id="name" name="lawyer_email" value="<?=$lawyer_data->email; ?>" />
                <input type="hidden" id="name" name="lawyer_phone" value="<?=$lawyer_data->mobile; ?>" />
                <input type="hidden" id="name" name="lawyer_name" value="<?=$name;?>" />
                <input type="hidden" id="name" name="meeting_time" value="<?=$edit_data->meeting_time;?>" />
                <input type="hidden" id="query_id" name="query_id" value="<?=$query_data->id;?>" />
                <input type="submit" class="btn btn-primary _click_update _hide_" value="Update" />
                <input type="reset" class="btn btn-default _hide_" value="Reset" />
            </div>
            </form>
        </div>
</div>
</div>
</section>
</div>
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(".delete_old_image").click(function() {
    $("#old_img_con").addClass('hidden');
    $(".color_img").addClass('hidden');
    $("#old_image").val('');
});
</script>
<script>
$(document).ready(function() {
    $("._hide_").hide();
    $("._click_update").click(function() {
        var status_val = $(".click_status").val();
        if (status_val == 1) {
            $(".formInnerGIF").show();
            $("._Hide_box").hide();
            $("._hide_").hide();
        }

    })

    $("#status").change(function() {
        var st = 1;
        $(".click_status").val(st);
        var status_data = $(".click_status").val();
        if (status_data == 1) {
            $("._hide_").show();
            $(".center989").hide();

        }

    })
});
</script>