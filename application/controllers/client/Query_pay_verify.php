<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
require APPPATH . '../assets/plugins/RazorPay/vendor/razorpay/razorpay/Razorpay.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Query_pay_verify extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->load->library('base_library');
        $this->load->helper('cookie');
        $this->load->model('admin/Payment_model');
        $this->load->model('client/Case_details_model');
        $this->load->model('Client_model');
        $this->load->library('encryption');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Slot_model');
        $this->load->model('admin/lawyer_model');
        
    }
   
    public function last_invoice()
	{
		$where = array();
		$where['field'] = 'invoice_num';
		$where['orderby'] = '-id';
		
		$result = $this->Payment_model->findDynamic($where);
		
		$lastdb_invoice_num ='';
		$lastdb_invoice_year ='';
		$lastdb_invoice_prefix ='';
		
		if(!empty($result[1]->invoice_num)){

			$invoice_array =explode("|",$result[1]->invoice_num);
			$lastdb_invoice_num 		=$invoice_array[2];	
			$lastdb_invoice_year 		=$invoice_array[1];	
			$lastdb_invoice_prefix 		=$invoice_array[0];	
		}else{

			$invoice_lastnum    = "001";
			$curentYear = date("y");
			$old_year = substr($curentYear, -2)-1;
			$invoice_num = "I|".$old_year."-".$curentYear."|".$invoice_lastnum;
		}
		
			$current_month = date("m");
			if($current_month < 03){

			$lastdb_invoice_num = substr($lastdb_invoice_num,1);
			$temp_invoice       = $lastdb_invoice_num+1;
			$invoice_lastnum    = "00$temp_invoice";
			$curentYear = date("y");
			$old_year = substr($curentYear, -2)-1;
			 $invoice_num = "I|".$old_year."-".$curentYear."|".$invoice_lastnum;
				
			}else{

			$curentYear = date("y");
			$lastdb_invoice_num = substr($lastdb_invoice_num,1);
			$temp_invoice       = $lastdb_invoice_num+1;
				$invoice_lastnum    = "00$temp_invoice";
			$next_year 			= substr($curentYear, -2)+1;
			$old_year 			= substr($curentYear, -2)-1;
				$invoice_num = "I|".$curentYear."-".$next_year."|".$invoice_lastnum;
			// prefix
				$sql1 = "SELECT invoice_num FROM `z_payment` WHERE `invoice_num` LIKE '%I|$curentYear-$next_year%' ORDER BY `id` DESC";
			$last_invoicenumber_res =  $this->Payment_model->rawQuery($sql1);
			if(!empty($last_invoicenumber_res)){
				//$invoice_num = "V|".$old_year."-".$curentYear."|".$invoice_lastnum;
				$invoice_num = "I|".$curentYear."-".$next_year."|".$invoice_lastnum;
			}else{
				$invoice_lastnum    = "001";
					$invoice_num = "I|".$curentYear."-".$next_year."|".$invoice_lastnum;
				// enpty
			}	
		}
		return $invoice_num;
	}

    public function index()
    {
        
        // $_POST['orderId'] = '75';
        // $_POST['userId'] = '37';
        
        
        if (!isset($_POST['orderId'])) {
            echo "Something went wrong!";
            exit;
        }
        // check payment manual or recurring
        // get order Details=================================================
        
        $key_id   = $this->config->item('razPaykey_id');
        $secret   = $this->config->item('razSecret');
        $order_id = $_POST['orderId'];
        
        
        $sql = "select clint.* , z_payment.* from z_payment z_payment, clint  where z_payment.user_id = clint.id and z_payment.order_id='" . $order_id . "' ";
        
        $orderData_result = $this->Payment_model->rawQuery($sql);
        //  code for cases  

        $where1 = array();
        $where1['order_id'] = $order_id;
        $casesDetails  = $this->Case_details_model->findDynamic($where1);
       
        // end code for cases 
        
        $orderData = $orderData_result[0];
        
       
        if (isset($orderData->order_id) && empty($orderData->order_id)) {
            $keyId     = $this->config->item('razPaykey_id');
            $keySecret = $this->config->item('razSecret');
        } else {
            
            $keyId     = $key_id;
            $keySecret = $secret;
        }
        $api             = new Api($key_id, $secret);
        $payment_details = $api->payment->fetch($_POST['razorpay_payment_id']);
     
        $success = true;
        $error   = "payment_failed";
        if (empty($_POST['razorpay_payment_id']) === false) { 
            
            $api = new Api($keyId, $keySecret);
            try {
                
                $attributes = array(
                    'razorpay_order_id' => $_POST['orderId'],
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );
                
                $api->utility->verifyPaymentSignature($attributes);
            }
            
            catch (SignatureVerificationError $e) {
                $success = false;
                $error   = 'Razorpay Error : ' . $e->getMessage();
            }
            
            
        }
        
        if ($success === true) {
         
             
            $payMethod = $payment_details->method;
            date_default_timezone_set("Asia/Calcutta");
            
            $date                      = date("Y/m/d h:m:s");
            $dataArr                   = array();
            $dataArr['order_id']       = $_POST['orderId'];
            $dataArr['payment_status'] = "Success";
            if (isset($_POST['razorpay_payment_id'])) {
                $dataArr['txn_id']          = $_POST['razorpay_payment_id'];
                $dataArr['gatewayResponse'] = $_POST['rPayResponse'];
            }
          
            	
            
            $dataArr['updateAt'] = date("Y-m-d");
            $data                = array(
                'payment_status' => 'Success',
                'txn_id' => $_POST['razorpay_payment_id'],
                'updateAt' => $date,
                'gatewayResponse' => $_POST['rPayResponse']
            );

            $order_id            = $_POST['orderId'];
            $result1=$this->db->update('z_payment', $data, 'order_id="' . $order_id . '"');
            $sesssion_details = $_SESSION['ClientDetails'];

            if (isset($sesssion_details['queryId']) && $sesssion_details['queryId']!='') {
              $sql = "select z_payment.* , query.*, clint.*, clint.id as c_id,query.id as q_id from z_payment ,query,clint  where query.user_id = z_payment.user_id and query.user_id =clint.id and query.id='" . $sesssion_details['queryId'] . "'and z_payment.order_id='" . $order_id . "' ";
            }else{
              $sql = "select z_payment.*, z_payment.id as paymentId, cases.*, clint.*, clint.id as c_id,cases.id as cs_id ,z_payment.payment_status as pay_status from z_payment ,cases,clint  where cases.client_id = z_payment.user_id and cases.payment_id =z_payment.id and z_payment.order_id='" . $order_id . "' and clint.id = '".$_SESSION['id'] ."'";
            }
            
        
           $orderData_result = $this->Payment_model->rawQuery($sql);
      
            $orderData = $orderData_result[0];
     
        // pre($orderData);
        // exit();
            // get data from case category table 
            $case_category= $this->Case_category_model->find($orderData->case_category_id);
            // pre($orderData_result);
  
            
          
           /* code for last invoice_num nuumber */

		 		$invoice_num = $this->last_invoice(); // get last invoice number 
		 
                 /* end code for last invoice number */

            // code for update user status 
            if (isset($sesssion_details['queryId']) && $sesssion_details['queryId']!='') {
                if(!empty($orderData->q_id)){
                    $updata = array();
                    $updata['id']               = $orderData->q_id; 
                    $updata['q_payment_status'] = 1;
                    $updata['order_id']         = $order_id;
                  
                    $da=$this->Query_model->save($updata);
                   
                 }
             }else{
                $updata = array();
                $updata['id']               = $orderData->cs_id; 
                $updata['payment_status'] = 1;
                $updata['status'] = 0;
              
                $da=$this->Case_details_model->save($updata);
                /*----- Update Slot ------*/
                $update_slot = $this->db->update('slot', ['slot_status'=>0], ['case_id'=> $updata['id']]);
             }
            
            
            // end code for update user status 
  
            /*=============== Send Notification ===============*/
            $w_client = array();
            $w_client['table']  = 'clint';
            $w_client['id']  = $orderData->user_id;
            $clientData = $this->Client_model->findDynamic($w_client);

            $w_lawyer = array();
            $w_lawyer['table']  = 'lawyer';
            $w_lawyer['id']  = $orderData->asign_lawyer_id;
            $lawyerData = $this->lawyer_model->findDynamic($w_lawyer);

            $w_slot = array();
            $w_slot['table']  = 'slot';
            $w_slot['case_id']  = $orderData->cs_id;
            $slotData = $this->Slot_model->findDynamic($w_slot);

            // temporary not use
            //nitification_when_book_slot($clientData[0],$lawyerData[0],$slotData[0]);

            // Razorypay Get Payment Details ==============================================
            $api         = new Api($keyId, $keySecret);
            $rzpResponse = $api->payment->fetch($orderData->txn_id);

            $totalPrice=$orderData->amount;
            $total_amt=$totalPrice;
            $payment_method = $payment_details->method;	
            include_once "query_mail_invoice.php";
		    $invoiceTemplate;
          
         

            require APPPATH ."../assets/plugins/php_pdf/vendor/autoload.php";
            $pdfname = rand();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($invoiceTemplate);
            $fileTempName = "utils/invoices/".$pdfname.$orderData->user_id."invoice.pdf";
            
            $fileName = $fileTempName;
            $mpdf->Output($fileName);
            /* code for save pdf file in database */
            // pre($fileTempName);
            // exit();
            $data12 = array(
                'pdfname' =>$pdfname
            );
            $sesssion_details = $_SESSION['ClientDetails'];
            // pre($sesssion_details);
            // exit();
            $order_id 		= $_POST['orderId'];
            $result2=$this->db->update('z_payment',$data12,'order_id="'.$order_id.'"');

            if($result2 >0){
              $clientFristName=$clientData[0]->fname;
              $clientMobile=$sesssion_details['phone'];
              ClientSlotBookPayment($clientFristName,$clientMobile);//call function to send sms to client

               /* code for send client mail */
               $toEmail    =$sesssion_details['email'] ;  // client email  
               $subject = "Payment Success";
               $heading="We have Successfully recieved the payment for One to One Session with our Expert Lawyer";
               
               $content="
               <div style='margin-top:1px;'>
                   <tr>
                   <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Case Category: </td>
                   <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$case_category->name."</span></td>
                   </tr>
               </div>
               <div style='margin-top:1px;'>
                   <tr>
                   <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Date :</td>
                   <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData[0]->slot_date."</span></td>
                   </tr>
               </div>
               <div style='margin-top:1px;'>
                   <tr>
                   <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Time :</td>
                   <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData[0]->time."</span></td>
                   </tr>
               </div>
               <div style='margin-top:1px;'>
                   <tr>
                   <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Duration :</td>
                   <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>15 Minuts</span></td>
                   </tr>
               </div>
               <div style='margin-top:1px;'>
                   <tr>
                   <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Payment Status :</td>
                   <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$orderData->pay_status."</span></td>
                   </tr>
               </div>
               <div style='margin-top:1px;'>
                   <tr>
                   <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Please Note :</td>
                   <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>This meeting cannot be Rescheduled due to Busy and Fixed Time Slots. You are therefore requested to make yourself available for the Selected Slot.</span></td>
                   </tr>
               </div>
               <div style='margin-top:1px;'>
                   <tr>
                   <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Invoice : </td>
                   <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".base_url()."$fileName'>Download Invoice</a></span></td>
                   </tr>
               </div>
             ";
              
              $message=get_email_temp($heading,$content);
              $this->send_email($toEmail, $subject, $message);

              
                $toEmail="admin@insaaf99.com,write2nmakkar@gmail.com,vinny@insaaf99.com"; // admin email
                $subject="New Query payment added ";
                $heading="New Query Payment Added Successfully";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$sesssion_details['name']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Email : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$sesssion_details['email']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$sesssion_details['phone']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Case Category: </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$case_category->name."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Date :</td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData[0]->slot_date."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Time :</td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData[0]->time."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Payment Status :</td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$orderData->pay_status."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Invoice : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".base_url()."$fileName'>Download Invoice</a></span></td>
                </tr>
            </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);
             }
          
             $addNotificationAdmin=array();
             $addNotificationAdmin['user_type']=1;// for admin
             $addNotificationAdmin['user_id']=2;
             $addNotificationAdmin['subject']="New Consultation Successfully Booked";
             $addNotificationAdmin['msg']="A new slot booking payment received successfully ".$sesssion_details['name'];
             $addNotificationAdmin['act_slug']=base_url().'admin/payment';
             $addNotificationAdmin['status']=0;
             $addNotificationAdmin['dt']=date("Y-m-d H:i:s");
      
              notification($addNotificationAdmin);

             $this->session->set_flashdata('success', 'Slot Payment Successfully Done');

             if(isset($_SESSION['direct_booking']) && !empty($_SESSION['direct_booking'])){
                $this->session->unset_userdata('direct_booking');
                redirect(base_url('Welcome?s=>Your Slot booked successfully our team will contact you shortly <br> Thank you!'));
            }

            include_once 'redirectWelcomeJs.php';

            // redirect(base_url('client/welcome/payment_welcome?pay_msg=Your Payment has been successfully received. Please Download App for meeting link'));

            // redirect(base_url('client/create_case/payment_success/'.$order_id));
           
        } else {

            if(isset($_SESSION['direct_booking']) && !empty($_SESSION['direct_booking'])){
                $this->session->unset_userdata('direct_booking');
                redirect(base_url('Welcome?f=Your payment failed. So please make payment to book your slot!'));
                exit();
            }
            include_once 'redirectFailedJs.php';

            // redirect(base_url('client/welcome/payment_welcome?pay_msg=Your Payment has been failed. Please Download App for payment and meeting link'));

            // redirect(base_url('client/create_case/payment_failed/'.$order_id.'/'.$error));
        } 
    
    }
    
}