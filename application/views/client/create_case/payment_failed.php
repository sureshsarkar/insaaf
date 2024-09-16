
<div class="content-wrapper">
<section class="content">
    <div class="container text-center">
       <div class="row">
          <div class="col-md-6" style="margin:auto;">
             <div class="payment">
                <div class="payment_header">
                   <div class="check"><i class="fa fa-times" aria-hidden="true"></i></div>
                </div>
                <div class="__success">
                   <h1 class="text-danger">Payment Failed !</h1>
                   <!-- <p><?php echo @$error; ?></p><br> -->
                   <p><?php echo str_replace('%20', ' ',$error); ?></p><br>
                   <a class="go_home" href="<?php echo base_url('client/dashboard/index/'.base64_encode($_SESSION['id'])); ?>">Go to Home</a>&nbsp;&nbsp;&nbsp;&nbsp;
                   <a class="go_home" href="<?php echo base_url('client/slot_booking_pay/Pay_for_slot/'.$payment_data->order_id); ?>">Try Again</a>
                </div>
                
             </div>
          </div>
          <div class="col-md-7">
             
          </div>
       </div>
    </div>
</section>
</div>



