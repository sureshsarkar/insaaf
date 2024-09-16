<div class="content-wrapper">

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

        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto">
                    <div class="for_client__">
                        <form action="#" method="post">
                            <div class="for_imffhd">
                                <h4 class="text-uppercase"><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i
                                            class="bi bi-arrow-left"></i> </a><b>Note Details</b></h4>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">

                                    <tr>
                                        <th>Note : </th>
                                        <td><?php echo $view_data->other; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Adding Date : </th>
                                        <td><?php echo date("M d, Y", strtotime($view_data->created_at)); ?></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="__flx_button_prv_nxt" style="width:99%">
                                <div class="__bck_butn">
                                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="button_news">
                                        < Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<style>
.for_imffhd {
    border-bottom: 2px solid #dfdfdf;
    margin-bottom: 15px;
}

.__flx_button_prv_nxt {
    display: flex;
    justify-content: space-between;
    margin-top: 40px;
}

.button_news {
    background: #ff9100;
    padding: 6px 20px;
    margin-bottom: 7px;
    color: white;
    border: none;
    border-radius: 11px;
    margin-top: 4px;
}

.for_nextdjijdf {
    margin-top: 4px;
    background: #1a243f;
    color: white;
    padding: 6px 16px;
    border: none;
    border-radius: 11px;
}

.button_news:hover {
    background: #1a243f;
    transition: 0.2s ease-in-out;
}

.for_nextdjijdf:hover {
    background: #ff9100;
    transition: 0.2s ease-in-out;
}

.for_chchek_colr {
    color: green;
}

.__bck_butn {
    float: left;
}

.__nxt_btn_ {
    float: right;
}
</style>