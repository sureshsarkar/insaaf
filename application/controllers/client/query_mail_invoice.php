<?php 
// pre($orderData);
$invoiceNumber =$invoice_num;
$invoiceDate = date("M d, Y");
if(!empty($_SESSION)){
$invoiceClientId='';
$invoiceClientId = $orderData->client_unique_id;
}
  $invoiceAmount = 600;
   $invoiceGSTAmount = 'gdgdgjgdshgjkld';

 $invoiceTotalAmount =  $total_amt;

$invoiceTotalAmountInWord   = ucwords($this->convert_number_to_words($invoiceTotalAmount)).' Only'; 
$invoiceRayzorpayPayId      = createOrderIdEncode($orderData->paymentId,"Documentation Payment");//'IND'.$year.$orderData->paymentId;  
$to_name                    = $orderData->fname;
$to_last_name               = $orderData->lname;
$payment_status             =$orderData->pay_status;
$gstNumber = (isset($userData['gstNumber']) && !empty($userData['gstNumber']))?'
<tr>
    <td colspan="2" style="text-align: left; color: #ebc16e;"><b>GSTIN :</b> '.$userData['gstNumber'].'</td>
</tr>
':''; $invoiceTemplate = '
<html>
    <body>
        <table border="0" align="center"  cellpadding="0" cellspacing="0" style="width:50%; margin: auto;">
            <tbody>
                <tr>
                    <td style="padding: 23px 0px; background: white; box-shadow: 0px 0px 3px 0px #bcc3bf;">
                        <table border="0" align="center"  cellpadding="0" cellspacing="0" style="width:100%; padding: 0px 40px 10px 40px; margin: auto;">
                            <tbody>
                                <tr>
                                    <td style="width: 300px;">
                                        <div class="logo">
                                            <img src="'.base_url().'/assets/images/law_logo.png" style="width: 150px;margin-left: 20px;" />
                                        </div>
                                    </td>
                                    <td style="font-family: system-ui; text-align: right; width: 300px;">
                                        <table>
                                            <tr>
                                                <td style="margin-bottom: 15px; font-size: 25px; color: #e9a61a;font-weight: 600; text-align: right;">Insaaf99.com </td>
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
                                                    <a href="mailto:contact@insaaf99.com" style="font-size: 16px;color: black;font-weight: 400;">contact@insaaf99.com</a>
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
                                        <p style="margin-top: 17px;">Invoice </p>
                                    </td>
                                    <td style="width: 33%;">
                                        <p style="height: 1px; background-color: #b3b3b3; color: #000; width: 250px;"></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table border="0" align="center"  cellpadding="0" cellspacing="0" style="width: 800px; padding: 0px 40px; margin: auto;">
                            <tbody>
                                <tr>
                                    <td style="width: 360px;">
                                        <table style="width: 99%;padding:20px; font-family: system-ui; font-size: 15px; height: 120px; border: 2px solid #ebc16e;">
                                           
                                            <tr>
                                                <td style=" color: #000000;">'.strtoupper($orderData->fname).' '.strtoupper($orderData->lname).'</td>
                                               
                                            </tr>
                                            
                                            <tr>
                                                <td colspan="2" style="text-align: left; color: #000000;">'.$orderData->mobile.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: "><a href="mailto:'.$orderData->email.'" style="left;color:#000;">'.$orderData->email.'</a></td>
                                            </tr>
                                           '.$gstNumber.'
                                        </table>
                                        <!-- end -->
                                        <!-- new table start -->
                                    </td>

                                    <td style="width: 360px; border: 2px solid #ebc16e; padding: 8px;">
                                        <table style="width: 99%; font-family: system-ui; font-size: 15px;">
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Order ID:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$invoiceRayzorpayPayId.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Invoice Date:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$invoiceDate.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Client ID:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$invoiceClientId.'</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <!-- end -->
                                </tr>
                            </tbody>
                        </table>
                        <table border="0" align="center"  cellpadding="0" cellspacing="0" style="width: 800px; padding: 0px 40px; margin: auto;">
                            <tbody>
                                <tr>
                                    <td style="width: 360px;">
                                        <table style="width: 99%;padding:20px; font-family: system-ui; font-size: 15px; height: 120px; border: 2px solid #ebc16e;">
                                           
                                            <tr>
                                                <td style=" color: #000000;"><b>Case Details</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Case ID:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$orderData->case_category_id.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Case Category:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$case_category->name.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Meeting Type:</td>
                                                <td colspan="2" style="text-align: right; float: right;">Video Call</td>
                                            </tr>
                                           '.$gstNumber.'
                                        </table>
                                        <!-- end -->
                                        <!-- new table start -->
                                    </td>

                                    <td style="width: 360px; border: 2px solid #ebc16e; padding: 8px;">
                                        <table style="width: 99%; font-family: system-ui; font-size: 15px;">
                                            <tr>
                                                <td style=" color: #000000;"><b>Meeting Details</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Meeting Date:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$slotData[0]->slot_date.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Meeting Time:</td>
                                                <td colspan="2" style="text-align: right; float: right;">'.$slotData[0]->time.'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="text-align: left;">Meeting Duration:</td>
                                                <td colspan="2" style="text-align: right; float: right;">15 Minuts</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <!-- end -->
                                </tr>
                            </tbody>
                        </table>
                         
                        <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:100%; padding: 8px 40px; margin: auto;">
                            <tbody>
                                <tr>
                                    <th style="background-color: #ebc16e; font-family: system-ui; font-weight: 500; text-align: center; padding: 10px; color: black;">Payment Date</th>
                                    <th style="background-color: #ebc16e; font-family: system-ui; font-weight: 500; text-align: center; padding: 10px; color: black;">Payment Mode</th>
                                    <th style="background-color: #ebc16e; font-family: system-ui; font-weight: 500; text-align: center; padding: 10px; color: black;">Payment Status</th>
                                    <th style="background-color: #ebc16e; font-family: system-ui; font-weight: 500; text-align: center; padding: 10px; color: black;">Payment Amount (INR)</th>
                                </tr>
                                <tr>
                                    <td style="padding: 10px; font-family: system-ui; color: #000; border-bottom: 2px solid #ebc16e; border-left: 2px solid #ebc16e; border-right: 2px solid #ebc16e; text-align: center;">'.$invoiceDate.'</td>
                                    <td style="padding: 10px; text-align: right; font-family: system-ui; border-bottom: 2px solid #ebc16e; border-right: 2px solid #ebc16e; text-align: center;">'.strtoupper($payment_method).'</td>
                                    <td style="padding: 10px; text-align: right; font-family: system-ui; border-bottom: 2px solid #ebc16e; border-right: 2px solid #ebc16e; text-align: center;font-weight: 600;background: #ebc16e26;">'.$payment_status.'</td>
                                    <td style="padding: 10px; text-align: right; font-family: system-ui; border-bottom: 2px solid #ebc16e; border-right: 2px solid #ebc16e; text-align: center;font-weight: 500;">'.$total_amt.''."/-".'</td>
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
                                        <br />
                                        <a href="mailto:contact@insaaf99.com">contact@insaaf99.com</a>
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