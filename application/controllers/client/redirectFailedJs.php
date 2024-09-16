<script>
if(/Mobile/i.test(navigator.userAgent) == true) {
    var url = "<?php echo  base_url('client/welcome/payment_welcome?pay_msg=Your Payment has been failed. Please Download App for payment and meeting link')?>";
    window.location.replace(url);
}else{
    var url = "<?php echo base_url('client/create_case/payment_failed/'.$order_id.'/'.$error);?>";
    window.location.replace(url);
}

</script>