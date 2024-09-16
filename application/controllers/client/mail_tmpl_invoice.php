<?php 
$cart=json_decode($orderData->cart_data,true);

$invoiceNumber =$invoice_num;
$invoiceDate = date("M d, Y");
$payment_status = $orderData->payment_status;
$invoiceTotalAmount =  $totalPrice;

$invoiceTotalAmountInWord   = ucwords($this->convert_number_to_words($invoiceTotalAmount)).' Only'; 
$orderUserName=$orderData->fname.' '.$orderData->lname;
$orderUserEmail=$orderData->email;
$orderUserMobile=$orderData->mobile;
$orderUserClient_ID=$orderData->client_unique_id;
$invoiceRayzorpayPayId  = createOrderIdEncode($orderData->paymentId,"Slot Booking");// 'INC'.$year.$orderData->paymentId; 
 
$gstNumber = (isset($userData['gstNumber']) && !empty($userData['gstNumber']))?'
<tr>
    <td colspan="2" style="text-align: left; color: #d49c11;"><b>GSTIN :</b> '.$userData['gstNumber'].'</td>
</tr>
':''; $invoiceTemplate = '
<html>
    <body>
        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width:50%; margin: auto;">
            <tbody>
                <tr>
                    <td style="padding: 23px 0px; background: white; box-shadow: 0px 0px 3px 0px #bcc3bf;">
                        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width: 800px; padding: 0px 40px 10px 40px; margin: auto;">
                            <tbody>
                                <tr>
                                    <td style="width: 300px;">
                                        <div class="logo">
                                            <img src="'.base_url().'/assets/images/law_logo.png" style="width: 130px; margin-left: 20px;" />
                                        </div>
                                    </td>
                                    <td style="font-family: system-ui; text-align: right;">
                                        <table>
                                            <tr>
                                                <td style="margin-bottom: 15px; font-size: 25px; color: #c08a00;font-weight: 600; text-align: right;">Insaaf99 </td>
                                            </tr>
                                            <tr>
                                                <td style="margin-bottom: 10px; line-height: 1.4; font-size: 14px; text-align: right;">
                                                G-45, First Floor, Udhyog Marg,
                                                Sector-6
                                                Opp Hyundai Service Station
                                                Noida, Uttar Pradesh (201301), India. <br>
                                                GST:- 09AANFJ5509Q1ZJ
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="margin-bottom: 10px; text-align: right;">
                                                    <a href="mailto:contact@insaaf99.com">contact@insaaf99.com</a>
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

                        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width: 800px; padding: 0px 40px; margin: auto; margin-top: 2px;">
                            <tbody>
                                <tr>
                                    <td style="width: 100%; border: 2px solid #d49c11; padding: 8px;">
                                        <table style="width: 99%; font-family: system-ui; font-size: 15px;">
                                            <tr>
                                              <td style=" color: #000000; font-weight:600;text-align: center;">'.strtoupper($categoryData[0]->sub_sub_category_name).'</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="width: 800px; padding: 0px 40px; margin: auto;margin-top: 2px;">
                            <tbody>
                                <tr>
                                    <td style="width:50%;">
                                        <table style="width: 100%;padding:20px; font-family: system-ui; font-size: 15px; height: 120px; border: 2px solid #d49c11;">
                                           
                                            <tr>
                                                <td style=" color: #d49c11;">'.strtoupper($orderUserName).'</td>
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="2" style="text-align: left; color: #d49c11;">'.$orderUserMobile.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;"><a href="'.$orderUserEmail.'">'.$orderUserEmail.'</a></td>
                                            </tr>
                                           '.$gstNumber.'
                                        </table>
                                    </td>

                                    <td style="width:50%; border: 2px solid #d49c11; padding: 8px;">
                                        <table style="width: 99%; font-family: system-ui; font-size: 15px;">
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Order ID:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$invoiceRayzorpayPayId.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Order Date:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$invoiceDate.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Client ID:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$orderUserClient_ID.'</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                  
                        <table border="0" align="center"  cellpadding="0" cellspacing="0" style="width:100%; padding: 0px 40px; margin: auto;">
                            <tbody style="padding-top: 20px;">
                                <tr>
                                  <td style="padding: 10px 10px 10px 23px; font-family: system-ui; color: #000; border-left: 2px solid #d49c11;font-weight: 600;width: 50%;">Price</td>
                                  <td style="padding: 10px; text-align: right; font-family: system-ui; border-right: 2px solid #d49c11; text-align: left; width: 50%;">- Rs. '.$cart['cart_data']['price'].'/-</td>
                               </tr>
                                <tr>
                                  <td style="padding: 10px 10px 10px 23px; font-family: system-ui; color: #000; border-left: 2px solid #d49c11;font-weight: 600;width: 50%;">Discount<span>('.$cart['cart_data']['discount'].'%)</span></td>
                                  <td style="padding: 10px; text-align: right; font-family: system-ui; border-right: 2px solid #d49c11; text-align: left; width: 50%;">- Rs. '.$cart['cart_data']['save_price'].'/-</td>
                               </tr>
                                <tr>
                                  <td style="padding: 10px 10px 10px 23px; font-family: system-ui; color: #000; border-left: 2px solid #d49c11;font-weight: 600;width: 50%;">GST<span>('.$cart['cart_data']['gst'].'%)</span></td>
                                  <td style="padding: 10px; text-align: right; font-family: system-ui; border-right: 2px solid #d49c11; text-align: left; width: 50%;">- Rs. '.$cart['cart_data']['gst_price'].'/-</td>
                               </tr>
                                <tr>
                                  <td style="padding: 10px 10px 10px 23px; font-family: system-ui; color: #000; border-left: 2px solid #d49c11;font-weight: 600;width: 50%;">Total Price</td>
                                  <td style="padding: 10px; text-align: right; font-family: system-ui;border-right: 2px solid #d49c11; text-align: left; width: 50%;">- Rs. '.$cart['cart_data']['gross_price'].'/-</td>
                               </tr>
                            </tbody>
                        </table>
                        <table border="0" align="center"  cellpadding="0" cellspacing="0" style="width:100%; padding: 0px 40px; margin: auto;">
                            <tbody style="padding-top: 20px;">
                                <tr>
                                    <th style="background-color: #d49c11; font-family: system-ui; font-weight: 300; text-align: center; padding: 10px; color: #fff;">Payment Date</th>
                                    <th style="background-color: #d49c11; font-family: system-ui; font-weight: 300; text-align: center; padding: 10px; color: #fff;">Payment Mode</th>
                                    <th style="background-color: #d49c11; font-family: system-ui; font-weight: 300; text-align: center; padding: 10px; color: #fff;">Payment Status</th>
                                    <th style="background-color: #d49c11; font-family: system-ui; font-weight: 300; text-align: center; padding: 10px; color: #fff;">Payment Amount (INR)</th>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; font-family: system-ui; color: #000; border-bottom: 2px solid #d49c11; border-left: 2px solid #d49c11; border-right: 2px solid #d49c11; text-align: center;">'.$invoiceDate.'</td>
                                    <td style="padding: 10px; text-align: right; font-family: system-ui; border-bottom: 2px solid #d49c11; border-right: 2px solid #d49c11; text-align: center;">'.strtoupper($payment_method).'</td>
                                    <td style="padding: 10px; text-align: right; font-family: system-ui; border-bottom: 2px solid #d49c11; border-right: 2px solid #d49c11; text-align: center;">'.$payment_status.'</td>
                                    <td style="padding: 10px; text-align: right; font-family: system-ui; border-bottom: 2px solid #d49c11; border-right: 2px solid #d49c11; text-align: center;">'.$invoiceTotalAmount.''."/-".'</td>
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
                                </tr>
                                <tr></tr>
                                <tr>
                                    <td colspan="1" style="text-align: left; font-family: system-ui;">
                                        <p style="font-size:14px;text-align: justify font-family: system-ui;">
                                            Please note that cancellation of your subscription is not available at Insaaf99 . We do not offer refunds of any value at any stage according to our refund policy, our policy
                                            equally to each member.
                                        </p>
                                        <br/>
                                        <a href="mailto:contact@insaaf99.com">Insaaf99.com</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
'; ?>