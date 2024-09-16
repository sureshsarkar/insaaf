

<script>
if(/Mobile/i.test(navigator.userAgent) == true) {
    var url = "<?php echo  base_url('client/welcome/payment_welcome?pay_msg=Your Payment has been successfully received. Please Download App for meeting link')?>";
    window.location.replace(url);
}else{
    var url = "<?php echo base_url('client/create_case/payment_success/'.$order_id);?>";
    window.location.replace(url);
}

</script>