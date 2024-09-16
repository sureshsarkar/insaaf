<?php 



//$invoiceNumber = invoiceNumber($_POST['orderId']);

$invoiceNumber =$invoice_num;
//$invoiceNumber = $_POST['orderId'];
$invoiceDate = date("M d, Y");
//$invoiceClientId = invoiceClientId($_POST['userId']);

$invoiceClientId = $orderData->user_id;
 //$invoicePlanName = $orderData->firstname;
  $invoiceAmount = 600;
   $invoiceGSTAmount = 'gdgdgjgdshgjkld';

// if($payment_type == 2){
//     $invoiceTotalAmount =  $total_reg_price-$courierCharge;
// }else{
//     $invoiceTotalAmount =  $total_sell_amt+$courierCharge;
// }
$invoiceTotalAmount =  $total_sell_amt;

$invoiceTotalAmountInWord   = ucwords($this->convert_number_to_words($invoiceTotalAmount)).' Only'; 
// $payment_type               = ($payment_type==1)?'Paid':'Cash on Dilivery ';
$invoiceRayzorpayPayId      = $orderData->txn_id; 
$to_name                    = $orderData->fname;
$to_last_name               =$orderData->lname;
// $std_streetaddress1 = ($orderData->ship_to_different==1)?$orderData->std_streetaddress1:$orderData->delivery_adddress1;
// $std_streetaddress2 = ($orderData->ship_to_different==1)?$orderData->std_streetaddress2:$orderData->std_streetaddress2;
// $std_Locality       = ($orderData->ship_to_different==1)?$orderData->std_Locality:$orderData->std_Locality;
// $std_Landmark       = ($orderData->ship_to_different==1)?$orderData->std_Landmark:$orderData->std_Landmark;
// $pincode            = ($orderData->ship_to_different==1)?$orderData->std_pincode:$orderData->pincode;
$city               = $orderData->city;
$state              = $orderData->state;

//$address = $orderData->ship_address_id; 
$gstNumber = (isset($userData['gstNumber']) && !empty($userData['gstNumber']))?'
<tr>
    <td colspan="2" style="text-align: left; color: #d49c11;"><b>GSTIN :</b> '.$userData['gstNumber'].'</td>
</tr>
':''; $invoiceTemplate = '
<html>
    <body>
        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width: 800px; margin: auto;">
            <tbody>
                <tr>
                    <td style="padding: 23px 0px; background: white; box-shadow: 0px 0px 3px 0px #bcc3bf;">
                        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width: 800px; padding: 0px 40px 10px 40px; margin: auto;">
                            <tbody>
                                <tr>
                                    <td style="width: 300px;">
                                        <div class="logo">
                                            <img src="'.base_url().'/assets/images/law_logo.png" style="width: 170px;" />
                                        </div>
                                    </td>
                                    <td style="font-family: system-ui; text-align: right;">
                                        <table>
                                            <tr>
                                                <td style="margin-bottom: 15px; font-size: 25px; color: #c08a00;font-weight: 600; text-align: right;">Insaaf99 </td>
                                            </tr>
                                            <tr>
                                                <td style="margin-bottom: 10px; line-height: 1.4; font-size: 14px; text-align: right;">
                                                    Noida, UP-201301 .
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin-bottom: 10px; text-align: right;">
                                                    <a href="'.base_url().'">www.Insaaf99.com</a>&nbsp;&nbsp;
                                                    <a href="mailto:insaaf99.com">insaaf99.com</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin-bottom: 10px; text-align: right;"><strong></strong></td>
                                            </tr>
                                            
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width: 800px; padding: 0px 40px; margin: auto;">
                            <tbody>
                                <tr>
                                    <td style="width: 33%;">
                                        <p style="height: 1px; background-color: #b3b3b3; color: #b3b3b3; width: 250px;"></p>
                                    </td>
                                    <td style="text-align: center; font-family: system-ui; font-size: 20px; margin-bottom: 15px; padding-bottom: 30px;">
                                        <p style="margin-top: 17px;"> Invoice </p>
                                    </td>
                                    <td style="width: 33%;">
                                        <p style="height: 1px; background-color: #b3b3b3; color: #000; width: 250px;"></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width: 800px; padding: 0px 40px; margin: auto;">
                            <tbody>
                                <tr>
                                    <td style="width: 360px;">
                                        <table style="width: 101%;padding:20px; font-family: system-ui; font-size: 15px; height: 20px; border: 2px solid #d49c11;">
                                           
                                            <tr>
                                                <td style=" color: #000000; font-weight:600;">'.strtoupper($orderData->sub_cat_name).'</td>
                                            </tr>
                                        </table>
                                    </td>

                                    <td style="width: 360px; border: 2px solid #d49c11; padding: 8px;">
                                        <table style="width: 99%; font-family: system-ui; font-size: 15px;">
                                        <tr>
                                        <td style=" color: #000000; font-weight:600;">'.strtoupper($orderData->sub_sub_category_name).'</td>
                                    </tr>
                                        </table>
                                    </td>
                                    <!-- end -->
                                </tr>
                            </tbody>
                        </table>
                        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width: 800px; padding: 0px 40px; margin: auto;">
                            <tbody>
                                <tr>
                                    <td style="width: 360px;">
                                        <table style="width: 99%;padding:20px; font-family: system-ui; font-size: 15px; height: 120px; border: 2px solid #d49c11;">
                                           
                                            <tr>
                                                <td style=" color: #d49c11;">'.strtoupper($orderData->fname).' '.strtoupper($orderData->lname).'</td>
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="2" style="text-align: left; color: #d49c11;">'.$orderData->mobile.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;"><a href="'.$orderData->email.'">'.$orderData->email.'</a><br>'.$orderData->city.'  '.$orderData->state.'</td>
                                            </tr>
                                           '.$gstNumber.'
                                        </table>
                                        <!-- end -->
                                        <!-- new table start -->
                                    </td>

                                    <td style="width: 360px; border: 2px solid #d49c11; padding: 8px;">
                                        <table style="width: 99%; font-family: system-ui; font-size: 15px;">
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Invoice No:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$invoiceNumber.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Invoice Date:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$invoiceDate.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Client ID:</td>
                                                <td colspan="2" style="text-align: right; float: right;">100'.$invoiceClientId.'</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <!-- end -->
                                </tr>
                            </tbody>
                        </table>
                         
                        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width: 800px; padding: 8px 40px; margin: auto;">
                            <tbody style="padding-top: 20px;">
                                <tr>
                                    <th style="background-color: #d49c11; font-family: system-ui; font-weight: 300; text-align: center; padding: 10px; color: #fff;">Payment Date</th>
                                    <th style="background-color: #d49c11; font-family: system-ui; font-weight: 300; text-align: center; padding: 10px; color: #fff;">Payment Mode</th>
                                    <th style="background-color: #d49c11; font-family: system-ui; font-weight: 300; text-align: center; padding: 10px; color: #fff;">Payment Reference ID</th>
                                    <th style="background-color: #d49c11; font-family: system-ui; font-weight: 300; text-align: center; padding: 10px; color: #fff;">Payment Amount (INR)</th>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; font-family: system-ui; color: #000; border-bottom: 2px solid #d49c11; border-left: 2px solid #d49c11; border-right: 2px solid #d49c11; text-align: center;">'.$invoiceDate.'</td>
                                    <td style="padding: 10px; text-align: right; font-family: system-ui; border-bottom: 2px solid #d49c11; border-right: 2px solid #d49c11; text-align: center;">'.strtoupper($payment_method).'</td>
                                    <td style="padding: 10px; text-align: right; font-family: system-ui; border-bottom: 2px solid #d49c11; border-right: 2px solid #d49c11; text-align: center;">'.$invoiceRayzorpayPayId.'</td>
                                    <td style="padding: 10px; text-align: right; font-family: system-ui; border-bottom: 2px solid #d49c11; border-right: 2px solid #d49c11; text-align: center;">'.$total_sell_amt.''."/-".'</td>
                                </tr>
                            </tbody>
                        </table>
                          <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0"  style="width: 100%; padding: 0px 40px; margin:auto; padding-top:20px;">
                             <tbody style="margin-top:20px;">
                            
                             
                            
                              <tr style="padding-top: 10px;">
                                <td style="padding-top: 20px; "><span style=" font-family: system-ui;color: #535353;">Amount in Words:</span>&nbsp;
                                    <span style=" font-family: system-ui;color: #000; font-weight: 600; font-size:17px">'.$invoiceTotalAmountInWord.'</span>
                                </td>
                              </tr>
                            </tbody>
                           </table>

                        <!-- footer Con -->
                        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="padding: 0px 40px; margin-top: 30px;">
                            <tbody>
                                <tr>
                                    <td colspan="1" style="text-align: left; font-size: 18px; font-weight: 800; width: 49%;">Important Note</td>
                                    <td colspan="1" style="text-align: right; font-size: 17px; font-weight: 800; width: 49%; padding-left: 40px;">Insaaf99 </td>
                                </tr>
                                <tr></tr>
                                <tr>
                                    <td colspan="1" style="text-align: left; font-family: system-ui;">
                                        <p style="font-size:14px;text-align: justify font-family: system-ui;">
                                            Please note that cancellation of your subscription is not available at Insaaf99 . We do not offer refunds of any value at any stage according to our refund policy, our policy
                                            equally to each member.
                                        </p>
                                        <br />
                                        <a href="mailto:insaaf99.com">insaaf99.com</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--// footer Con -->
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
'; ?>
