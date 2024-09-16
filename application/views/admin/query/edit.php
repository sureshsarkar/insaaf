<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>


            <a href="<?php echo base_url();?>admin/Query"> <i class="fa fa-sitemap" aria-hidden="true"></i> Query</a>
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
            <div class="col-md-12 ">
        
            
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                    </div>

                    <form role="form" id="member_form" action="<?php echo base_url() ?>admin/Query/update"
                        method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php if($edit_data->user_type=='1'){?>
                                        <label for="name"> Client Name</label>
                                        <?php }elseif($edit_data->user_type=='2'){?>
                                        <label for="name"> Lawyer Name</label>
                                        <?php }?>
                                        <?php if($edit_data->user_type=='1'){?>
                                        <input type="text" id="name" name="client_name" class="form-control"
                                            readonly="readonly"
                                            value="<?php echo $client_data->fname.' '.$client_data->lname; ?> ">
                                        <?php }elseif($edit_data->user_type=='2'){?>
                                        <input type="text" id="name" name="client_name" class="form-control"
                                            readonly="readonly"
                                            value="<?php echo $client_data->fname.' '.$client_data->lname; ?> ">
                                        <?php }?>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php if($edit_data->user_type=='1'){?>
                                        <label for="name"> Client Email</label>
                                        <?php }elseif($edit_data->user_type=='2'){?>
                                        <label for="name"> Lawyer Email</label>
                                        <?php }?>
                                        <?php if($edit_data->user_type=='1'){?>
                                        <input type="text" id="name" name="client_email" class="form-control"
                                            value="<?php echo $client_data->email; ?> ">
                                        <?php }elseif($edit_data->user_type=='2'){?>
                                        <input type="text" id="name" name="lawyer_email" class="form-control"
                                            value="<?php echo $lawyer_data->email; ?> ">
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php if($edit_data->user_type=='1'){?>
                                        <label for="name"> Client Mobile</label>
                                        <?php }elseif($edit_data->user_type=='2'){?>
                                        <label for="name"> Lawyer Mobile</label>
                                        <?php }?>
                                        <?php if($edit_data->user_type=='1'){?>
                                        <input type="text" id="name" name="client_mobile" class="form-control"
                                            value="<?php echo $client_data->mobile; ?> ">
                                        <?php }elseif($edit_data->user_type=='2'){?>
                                        <input type="text" id="name" name="lawyer_mobile" class="form-control"
                                            value="<?php echo $lawyer_data->mobile; ?> ">
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">  <?php if($edit_data->user_type=='1'){?>
                                        <label for="name"> Client Query</label>
                                        <?php }elseif($edit_data->user_type=='2'){?>
                                        <label for="name"> Lawyer Query</label>
                                        <?php }?>
                                        <textarea type="text" id="name" name="query" class="form-control"
                                            value=""><?php echo $edit_data->query; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Case Category</label>
                                         <?php if(!empty($all_case_cat_data)){
                                                       ?>
                                                     <div class="form-group">
                                                        <select  name="case_cat_id" value="" id="case_cat_id" class="form-control" required>
                                                            <?php foreach($all_case_cat_data as $case_cat){ ?>
                                                            <option value="<?php echo $case_cat->id ?>" <?php echo ($edit_data->case_cat_id == $case_cat->id)?'selected':''; ?>><?php echo $case_cat->name;?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                        <?php }?>
                                      
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="query_status" id="query_status">
                                            <option value="0"
                                                <?php echo ($edit_data->query_status == 0)?'selected':''; ?>>Pending
                                            </option>
                                            <option value="1"
                                                <?php echo ($edit_data->query_status == 1)?'selected':''; ?>>Active
                                            </option>
                                            
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <input type="hidden" name="id" value="<?php echo $edit_data->id;?>" />
             
                <input type="submit" class="btn btn-primary" value="Update" />
                <input type="reset" class="btn btn-default" value="Reset" />
            </div>
            </form>
        </div>
</div>
</div>
</section>
</div>

<!-- model for send document start -->
<div class="modal fade" id="exampleModal11121" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <form role="form" action="<?php echo base_url() ?>client/Client_query/Send_document"
                            method="post" enctype='multipart/form-data'>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Document</label>
                                <input type="file" class="form-control" id="document" name="case_file"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="text">Enter Your Query</label>
                                <textarea type="text" name="message" class="form-control"
                                    placeholder=" Enter Your Query"> </textarea>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="client_Id" value="<?php echo $_SESSION['id']?>">
                                <input type="hidden" name="client_name" value="<?php echo $_SESSION['name']?>">
                                <input type="hidden" name="client_email" value="<?php echo $_SESSION['email']?>">
                                <input type="hidden" name="client_phone" value="<?php echo $_SESSION['phone']?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send Query</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- model for send document end  -->
<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script>
$(".delete_old_image").click(function() {
    $("#old_img_con").addClass('hidden');
    $(".color_img").addClass('hidden');
    $("#old_image").val('');
});
</script>