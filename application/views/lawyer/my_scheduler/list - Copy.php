<div class="content-wrapper">
   <!-- Content Header (Page header) -->
 <section class="content-header">
    <h1>
       <a> <i class="fa fa-sitemap" aria-hidden="true"></i> Scheduler List </a>
       <small>Edit</small>
    </h1>
 </section>
<section class="content">
<form action="<?php echo base_url() ?>lawyer/My_scheduler/update_schedule/<?php echo $id; ?>" method="post">
    <!-- <input type="text" name="lawyer_id" value="<?php echo $id; ?>"> -->
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
                $meeting_Time = array(
                     '9' => array('h'=> '09:00 AM', 'H'=> '09:00',"label" => "09:00 AM - 10:00 AM"),
                    '10' => array('h'=> '10:00 AM', 'H'=> '10:00',"label" => "10:00 AM - 11:00 AM"),
                    '11' => array('h'=> '11:00 AM', 'H'=> '11:00',"label" => "11:00 AM - 12:00 PM"),
                    '12' => array('h'=> '12:00 PM', 'H'=> '12:00',"label" => "12:00 PM - 01:00 PM"),
                    '13' => array('h'=> '01:00 PM', 'H'=> '01:00',"label" => "01:00 PM - 02:00 PM"),
                    '14' => array('h'=> '02:00 PM', 'H'=> '02:00',"label" => "02:00 PM - 03:00 PM"),
                    '15' => array('h'=> '03:00 PM', 'H'=> '03:00',"label" => "03:00 PM - 04:00 PM"),
                    '16' => array('h'=> '04:00 PM', 'H'=> '04:00',"label" => "04:00 PM - 05:00 PM"),
                    '17' => array('h'=> '05:00 PM', 'H'=> '05:00',"label" => "05:00 PM - 06:00 PM"),
                    '18' => array('h'=> '06:00 PM', 'H'=> '06:00',"label" => "06:00 PM - 07:00 PM"),
                    '19' => array('h'=> '07:00 PM', 'H'=> '07:00',"label" => "07:00 PM - 08:00 PM"),
                    '20' => array('h'=> '08:00 PM', 'H'=> '08:00',"label" => "08:00 PM - 09:00 PM"),
                    '21' => array('h'=> '09:00 PM', 'H'=> '09:00',"label" => "09:00 PM - 10:00 PM"),
                    '22' => array('h'=> '10:00 PM', 'H'=> '10:00',"label" => "10:00 PM - 11:00 PM")
                );
                // echo count($meeting_Time);
                // echo json_encode($meeting_Time , JSON_PRETTY_PRINT); die();
            ?>
            <?php foreach($meeting_Time as $key => $time){ ?>
            <tr>
                <td><?php echo $time['label']; ?></td>
                <td><input type="checkbox" name="<?php echo $days['0'].'_'.$key; ?>" value="<?php echo $time['H']; ?>"></td>
                <td><input type="checkbox" name="<?php echo $days['1'].'_'.$key; ?>" value="<?php echo $time['H']; ?>"></td>
                <td><input type="checkbox" name="<?php echo $days['2'].'_'.$key; ?>" value="<?php echo $time['H']; ?>"></td>
                <td><input type="checkbox" name="<?php echo $days['3'].'_'.$key; ?>" value="<?php echo $time['H']; ?>"></td>
                <td><input type="checkbox" name="<?php echo $days['4'].'_'.$key; ?>" value="<?php echo $time['H']; ?>"></td>
                <td><input type="checkbox" name="<?php echo $days['5'].'_'.$key; ?>" value="<?php echo $time['H']; ?>"></td>
                <td><input type="checkbox" name="<?php echo $days['6'].'_'.$key; ?>" value="<?php echo $time['H']; ?>"></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="text-right mr-5 pt-5">
        <button type="submit" class="btn btn-primary" name="update">Update Schedule</button>
    </div>
</div>
</form>
</section>
</div>
