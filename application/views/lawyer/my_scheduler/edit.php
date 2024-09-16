<div class="content-wrapper">
   <!-- Content Header (Page header) -->
 <section class="content-header">
    <h1>
    

       <a href="<?php echo base_url();?>lawyer/My_scheduler/index/<?=base64_encode($schedule_detail->lawyer_id);?>"> <i class="fa fa-sitemap" aria-hidden="true"></i> Scheduler List </a>
       <small>Edit</small>
    </h1>
 </section>
<section class="content">
<form action="<?php echo base_url() ?>lawyer/My_scheduler/update" method="post">
<div class="table-responsive">
    <table class="table table-bordered text-center table-striped">
        <thead>
            <tr class="bg-light-gray">
                <th class="text-uppercase">Time</th>
                <th class="text-uppercase">Monday</th>
                <th class="text-uppercase">Tuesday</th>
                <th class="text-uppercase">Wednesday</th>
                <th class="text-uppercase">Thursday</th>
                <th class="text-uppercase">Friday</th>
                <th class="text-uppercase">Saturday</th>
                <th class="text-uppercase">Sunday</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
                $times = array(
                    array("time" => "09:00 AM - 10:00 AM"),
                    array("time" => "10:00 AM - 11:00 AM"),
                    array("time" => "11:00 AM - 12:00 PM"),
                    array("time" => "12:00 PM - 01:00 PM"),
                    array("time" => "01:00 PM - 02:00 PM"),
                    array("time" => "02:00 PM - 03:00 PM"),
                    array("time" => "03:00 PM - 04:00 PM"),
                    array("time" => "04:00 PM - 05:00 PM"),
                    array("time" => "05:00 PM - 06:00 PM"),
                    array("time" => "06:00 PM - 07:00 PM"),
                    array("time" => "07:00 PM - 08:00 PM"),
                    array("time" => "08:00 PM - 09:00 PM"),
                    array("time" => "09:00 PM - 10:00 PM"),
                    array("time" => "10:00 PM - 11:00 PM")
                );
                // echo count($times);
            ?>
            <?php $n=1; foreach($times as $time){ ?>
            <tr>
                <td><?php echo $time['time']; ?></td>
                <td><input type="checkbox" name="<?php echo $days['0'].'_'.$n; ?>" value="1"></td>
                <td><input type="checkbox" name="<?php echo $days['1'].'_'.$n; ?>" value="1"></td>
                <td><input type="checkbox" name="<?php echo $days['2'].'_'.$n; ?>" value="1"></td>
                <td><input type="checkbox" name="<?php echo $days['3'].'_'.$n; ?>" value="1"></td>
                <td><input type="checkbox" name="<?php echo $days['4'].'_'.$n; ?>" value="1"></td>
                <td><input type="checkbox" name="<?php echo $days['5'].'_'.$n; ?>" value="1"></td>
                <td><input type="checkbox" name="<?php echo $days['6'].'_'.$n; ?>" value="1"></td>
            </tr>
            <?php $n++; } ?>
        </tbody>
    </table>
    <div class="text-right mr-5 pt-5">
        <button type="submit" class="btn btn-primary" name="update">Update Schedule</button>
    </div>
</div>
</form>
</section>
</div>
