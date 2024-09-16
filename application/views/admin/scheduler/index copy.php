<style>
.my-custom-scrollbar {
    position: relative;
    width: 162%;
    overflow-x: scroll;
}


.table-wrapper-scroll-x {
    display: block;
    z-index: 99999;
}

.dateText {
    width: 110px;
    font-weight: 800;
}

.checkBoxPad {
    margin: 4px !important;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <a href="<?php echo base_url();?>admin/scheduler/view">
                <i class="fa fa-sitemap" aria-hidden="true"></i> Scheduler List </a>
            <small>Edit</small>
        </h1>
    </section>
    <section class="content">
        <form action="<?php echo base_url() ?>admin/scheduler/insertnow" method="post">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $Date =date("Y-m-d");
                        ?>
                        <?php for($i=0; $i <= 29;$i++){?>
                        <tr>
                            <td class="dateText">
                                <?php echo date('d M Y', strtotime($Date. ' + '.$i.' days'));?><input type="checkbox"
                                    name="date[]" class="checkBoxDate" value=""></td>
                            <?php $n=1; foreach($times as $time){ ?>

                            <td><input type="checkbox" name="" class=""><?= $time?></td>

                            <?php $n++; }?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right mr-5 pt-5">
                <button type="submit" class="btn btn-primary" name="update">Update Schedule</button>
            </div>
        </form>
    </section>
</div>