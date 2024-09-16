<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            <a href="<?php echo base_url();?>admin/Query"> <i class="fa fa-sitemap" aria-hidden="true"></i>Query
                List</a>
            <small>Edit</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group text-right">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal11121" href=""><i
                            class="fa fa-plus"></i>Craete a Case </a>
                </div>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                    </div>

                    <?php if(!empty($view_data)){
                 foreach($view_data as $query){?>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php if($query->user_type=='1'){?>
                                    <label for="name"> Client Name</label>
                                    <?php }elseif($query->user_type=='2'){?>
                                    <label for="name"> Lawyer Name</label>
                                    <?php }?>
                                    <input type="text" id="name" name="client_id" class="form-control"
                                        readonly="readonly" value="<?php echo $query->c_fname.' '.$query->c_lname; ?> ">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php if($query->user_type=='1'){?>
                                    <label for="name"> Client Mobile</label>
                                    <?php }elseif($query->user_type=='2'){?>
                                    <label for="name"> Lawyer Mobile</label>
                                    <?php }?>
                                    <input type="text" id="name" name="client_id" class="form-control"
                                        readonly="readonly" value="<?php echo $query->mobile; ?> ">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php if($query->user_type=='1'){?>
                                    <label for="name"> Client Email</label>
                                    <?php }elseif($query->user_type=='2'){?>
                                    <label for="name"> Lawyer Email</label>
                                    <?php }?>
                                    <input type="text" id="name" name="name" class="form-control" readonly="readonly"
                                        value="<?php echo $query->email; ?>">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Query Date</label>
                                    <input type="text" id="name" name="query_date" class="form-control"
                                        readonly="readonly" value="<?php echo $query->dt; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php if($query->user_type=='1'){?>
                                    <label for="name"> Client Query</label>
                                    <?php }elseif($query->user_type=='2'){?>
                                    <label for="name"> Lawyer Query</label>
                                    <?php }?>
                                    <textarea type="text" id="name" name="case_sub_category" class="form-control"
                                        readonly="readonly"
                                        value="<?php echo $query->query; ?>"><?php echo $query->query; ?></textarea>
                                </div>
                            </div>
                            <?php if(!empty($lawyer_detail->fname)){?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Selected Lawyer Name</label>
                                    <input type="text" id="name" name="query_date" class="form-control"
                                        readonly="readonly"
                                        value="<?php echo $lawyer_detail->fname.' '.$lawyer_detail->lname; ?>">
                                </div>
                            </div>
                            <?php }?>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Query Status</label>
                                    <select class="form-control" readonly="readonly" name="slot_status" id="status">
                                        <option value="0" <?php echo ($query->query_status == 0)?'selected':''; ?>>
                                            Pending</option>
                                        <option value="1" <?php echo ($query->query_status == 1)?'selected':''; ?>>
                                            Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Case Type</label>
                                    <input type="text" id="name" name="query_date" class="form-control"
                                        readonly="readonly" value="<?php echo $query->name; ?>">
                                </div>
                            </div>
                            <?php if(isset($query->q_solution) && !empty($query->q_solution)){?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Query Solution</label>
                                    <textarea type="text"  name="q_solution" class="form-control"
                                        readonly="readonly"
                                        value="<?php echo $query->q_solution; ?>"><?php echo $query->q_solution; ?></textarea>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        <div class="row">
                            <?php if(!empty($query->querry_file)){?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Case Document</label><br>
                                    <a class="btn btn-sm btn-info"
                                        href="<?php echo base_url('uploads/cases/').$query->querry_file; ?>"
                                        target="_blank" title="mp3" co><i class="fa fa-play"><img
                                                src1="<?php echo base_url('uploads/cases/').$query->querry_file; ?>"
                                                width="30px;" alt=""></i></a>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

            <?php }}?>
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