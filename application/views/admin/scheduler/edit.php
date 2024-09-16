<?php
    $Date =date("Y-m-d");
  $selectedTime  = json_decode($edit_data->time);
  pre($selectedTime);

    // exit();
?>


<style>
.formWidth {
    width: 450px;
    margin: auto;
}

.chosen-container-single .chosen-single {
    height: 30px !important;
    border: 1px solid #3c8dbc !important;
}

.chosen-container-multi .chosen-choices {
    /* height: 30px !important; */
    /* border: 1px solid #3c8dbc !important; */
    /* border-radius: 5px; */
}
</style>
<?php
    $Date =date("Y-m-d");
?>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/scheduler">
                <i class="fa fa-sitemap" aria-hidden="true"></i> Scheduler List </a>
            <small>Edit</small>
        </h1>
    </section>
    <section class="container mt-3">
        <div class="formWidth">
            <form action="<?php echo base_url() ?>admin/scheduler/update" method="post">
                <div class="form-group">
                    <label for="date">Date</label>
                    <?php $AddedDate = date("d M Y", strtotime($edit_data->date)); ?>
                    <select class="form-control selectData" name="date" id="date">
                        <option selected>Choose...</option>
                        <?php for($i=0; $i <= 29;$i++){?>
                        <option <?php 
                            if($AddedDate == date('d M Y', strtotime($Date. ' + '.$i.' days'))){ echo "selected";}
                            ?> value="<?php echo date('d M Y', strtotime($Date. ' + '.$i.' days'));?>">
                            <?php echo date('d M Y', strtotime($Date. ' + '.$i.' days'));?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <select class="selectbox form-control" name="time[]" id="time" multiple>
                        <option value="false" <?php if($selectedTime[0] == "false"){echo 'selected';}?>>false
                        </option>
                        <?php $n=1; foreach($times as $time){ ?>
                        <option <?php  if(!empty($selectedTime) && in_array($time, $selectedTime)){echo 'selected';}?>
                            value="<?php echo $time;?>">
                            <?php echo $time;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="text-right pt-1">
                    <input type="hidden" name="id" value="<?= $edit_data->id;?>">
                    <button type="submit" class="btn btn-primary">Add Schedule</button>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('select').chosen();
});
</script>