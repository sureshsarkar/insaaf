<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/jquery-ui.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <!-- left column -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box pb-2">
                        <div class="box-header">
                            <section class="content-header">
                                <h1>
                                    <a href="<?= base_url("client/dashboard")?>"><i class="bi bi-arrow-left"></i></a>
                                    &nbsp;&nbsp;&nbsp;<?= isset($lawyer)?"Chat with - Lawyer":"<span class='titleMessage' >Send message</span> " ?>
                                </h1>
                            </section>
                        </div><!-- /.box-header -->

                        <!-- body start-->
                        <div class="box-body">
                            <div class="row">
                                <?php if(!isset($lawyer)){?>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="themebox text-center">

                                                <!-- progress page -->
                                                <div class="for_bg_color_cont_us progressCon hidden">
                                                    <div class="row py-5">
                                                        <div class="col-md-12 text-center">
                                                            <img src="<?= base_url('assets/images/progress.gif')?>"
                                                                width="130">
                                                            <br /><br />
                                                            <p class="text-success">Sending....</p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end progress con -->

                                                <!-- message con-->
                                                <div class="messageCon hidden firstBox py-5">
                                                    <img src="<?= base_url('assets/images/success.png')?>" width="100">
                                                    <h1 class="text-success">Thanks, your message sent successfully!
                                                    </h1>
                                                    <div>
                                                    </div>
                                                    <a href="<?= base_url('client/dashboard') ?>"
                                                        class="mb-1 btn btn-warning"><i class="bi bi-house"></i>
                                                        Dashboard</a>
                                                </div>
                                                <!-- message con end -->

                                                <form class="px-4" id="support">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="mobile">Mobile</label>
                                                                <input type="number" class="form-control mobile"
                                                                    name="mobile" placeholder="Enter mobile" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Email address</label>
                                                                <input type="email" class="form-control email"
                                                                    name="email" placeholder="Enter email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <textarea placeholder="Write your query, brief description "
                                                        rows="5" name="message" id="chatInput"
                                                        class="form-control message232 messageText message"
                                                        value=""></textarea>
                                                    <br />

                                                    <button type="submit" class="btn btn-success pull-right "
                                                        id="sendButton">Send</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php     } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<script>
$("#support").submit(function(e) {
    e.preventDefault()

    $("#support").addClass('hidden');
    $(".progressCon").removeClass('hidden');

    var mobile = $('.mobile').val();
    var email = $('.email').val();
    var message = $('.message').val();

    var url = "<?=base_url()?>client/query/submitSupport";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            mobile: mobile,
            email: email,
            message: message
        },
        success: function(returnVal) {
            if (returnVal == 1) {
                $("#support").addClass('hidden');
                $(".for_bg_color_cont_us").addClass('hidden');
                $(".messageCon").removeClass('hidden');
            } else {
                $(".for_bg_color_cont_us").removeClass('hidden');
                $(".progressCon").addClass('hidden');
            }
        }
    });
    return false;
});
</script>