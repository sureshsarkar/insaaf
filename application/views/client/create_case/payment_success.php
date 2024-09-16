
<div class="content-wrapper">
<section class="content">
    <div class="container text-center">
       <div class="row">
          <div class="col-md-6">
             <div class="payment">
                <div class="payment_header">
                   <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                </div>
                <div class="__success">
                   <h1 class="text-success">Payment Success !</h1>
                   <p>Our executive will contact you shortly.</p><br/>
                    
                   <a class="go_home" href="<?php echo base_url('client/dashboard'); ?>">Go to Home</a>&nbsp;&nbsp;&nbsp;&nbsp;
                   <a class="go_home" href="<?php echo base_url().'utils/invoices/'.$payment_data->pdfname.$payment_data->user_id.'invoice.pdf'; ?>" target="_blank">Download Invoice</a>
                   <a class="go_home" href="<?php echo base_url('client/meeting'); ?>">Meeting Details</a>&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                
             </div>
          </div>
          <div class="col-md-6">
            <!-- <h4 class="text-right">
                <a class="btn btn-info" href="<?php echo base_url().'utils/invoices/'.$payment_data->pdfname.$payment_data->user_id.'invoice.pdf'; ?>" title="Edit" target="_blank">Download Invoice</a>
            </h4> -->
                         
            <?php
            // $file = base_url().'utils/invoices/'.$payment_data->pdfname.$payment_data->user_id.'invoice.pdf';
                 // header('Pragma: public');
                 // header('Expires: 0');
                 // header('Content-Type: mime');
                 // header('Content-Description: File Transfer');
                 // header('Content-Disposition: attachment; filename="'.basename($file).'"');
                 // header('Content-Transfer-Encoding: binary');
                 // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                 // header('Content-Length'.filesize($file));
                 // ob_clean();
                 // flush();
                 // readfile($file);
                 // exit();
               
            ?>
          </div>
       </div>
    </div>
</section>
</div>


<style>
.payment
    {
        border:1px solid #f2f2f2;
        height:280px;
        border-radius:20px;
        background:#fff;
    }
   .payment_header
   {
       background:rgb(255 145 0);
       padding:20px;
       border-radius:20px 20px 0px 0px;
       
   }
   
   .check
   {
       margin:0px auto;
       width:50px;
       height:50px;
       border-radius:100%;
       background:#fff;
       text-align:center;
   }
   
   .check i
   {
       vertical-align:middle;
       line-height:50px;
       font-size:30px;
   }
    .go_home
    {
        width:200px;
        height:35px;
        color:#fff; margin-top: 20px;
        border-radius:30px;
        padding:5px 10px;
        background:rgb(255 145 0);
        transition:all ease-in-out 0.3s;
    }

    .go_home:hover
    {
        text-decoration:none; background:#1a243f;
    }
    .__success h1{margin-bottom: 20px;}
   

</style>


