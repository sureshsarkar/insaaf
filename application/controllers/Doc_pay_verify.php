<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
require APPPATH . '../assets/plugins/RazorPay/vendor/razorpay/razorpay/Razorpay.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Doc_pay_verify extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('base_library');
        // Cookie helper
        $this->load->helper('cookie');
        $this->load->model('admin/Payment_model');
		$this->load->model('client_model');
		$this->load->library('encryption');
        $this->load->model('admin/Certificate_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/sub_sub_category_model');

        
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
				$sql = "SELECT invoice_num FROM `z_payment` WHERE `invoice_num` LIKE '%I|$curentYear-$next_year%' ORDER BY `id` DESC";
			$last_invoicenumber_res =  $this->Payment_model->rawQuery($sql);
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
        
		$data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 

		
		if(!isset($_POST['orderId']))
		{
			echo "Something went wrong!";
			exit;
		}
		// check payment manual or recurring
		// get order Details=================================================


		$where = array();
		// $where['order_id']	=	$_POST['orderId'];
		// $orderData 	=	$this->payment_model->findOneBy($where);

		$key_id 	=  $this->config->item('razPaykey_id');
		$secret 	=  $this->config->item('razSecret');
		$order_id = $_POST['orderId'];
	
		
  		 $sql = "select * from z_payment z_payment  where z_payment.order_id='".$order_id."' ";
	
  		$orderData_result = $this->Payment_model->rawQuery($sql);
		

  		$orderData = $orderData_result[0];
		if(isset($orderData->order_id) && empty($orderData->order_id))
		{
		 	$keyId 		= $this->config->item('razPaykey_id');
		 	$keySecret 	=  $this->config->item('razSecret');
		}else{

			$keyId = $key_id;
			$keySecret = $secret;
		}

	
		$api = new Api($key_id, $secret);
		$payment_details = $api->payment->fetch($_POST['razorpay_payment_id']);
	
		$success = true;
	    $error = "payment_failed";
		if (empty($_POST['razorpay_payment_id']) === false)
		{	
			
			$api = new Api($keyId, $keySecret); 
			try
			{

				$attributes = array(
				'razorpay_order_id' => $_POST['orderId'],
				'razorpay_payment_id' => $_POST['razorpay_payment_id'],
				'razorpay_signature' => $_POST['razorpay_signature']
				);

				$api->utility->verifyPaymentSignature($attributes);
			}

			catch(SignatureVerificationError $e)
			{
				$success = false;
				$error = 'Razorpay Error : ' . $e->getMessage();
			}


		}

		if($success===true)
		{

			 $payMethod = $payment_details->method;
		
			date_default_timezone_set("Asia/Calcutta");

			$date = date("Y-m-d H:m:s");
		
			$data = array(
		 		'payment_status' => 'Success',
		 		'txn_id' => $_POST['razorpay_payment_id'],
		 		'updateAt' => $date,
		 		'gatewayResponse' =>$_POST['rPayResponse']
			 );
		
		 	 $order_id 		= $_POST['orderId'];
			 $result1=$this->db->update('z_payment',$data,'order_id="'.$order_id.'"');
			
			
             $sql1='';
			 $sql1 .= "select p.* , d.*,d.id as d_id,p.payment_status,p.id as pay_id from z_payment as p ";
			 $sql1 .="JOIN docx_certificate as d ON d.payment_id = p.id "; 
			 $sql1 .="WHERE p.order_id='".$order_id."'";

  		    $orderData_result = $this->Certificate_model->rawQuery($sql1);
		 
		    $orderData = $orderData_result[0];

			// code for update user status 
		
               /* code for last invoice_num nuumber */

		 	$invoice_num = $this->last_invoice(); // get last invoice number 
			
				/* end code for last invoice number */
			 if(!empty($orderData->user_id)){
			
				$updata = array();
				$updata['id'] =$orderData->d_id;
				$updata['payment_id'] =$orderData->pay_id;
				$updata['status'] = 1;
				$updata['updateAt'] = date('Y-m-d H:i:s');
			  
				 $this->Certificate_model->save($updata);
				
		
			 }
			
			// end code for update user status 



			// Razorypay Get Payment Details ==============================================
			$api = new Api($keyId, $keySecret);
			$rzpResponse = $api->payment->fetch($orderData->txn_id);
			
			$totalPrice=$orderData->amount;
			$payment_method = $payment_details->method;	
			$w['id']=$orderData->doc_id;
			$w['field']='sub_sub_category_name';
			$categoryData=$this->sub_sub_category_model->finddynamic($w);

		
		include_once "doc_mail_tmpl_invoice.php";
	  
		 $invoiceTemplate;
		
		
		require APPPATH ."../assets/plugins/php_pdf/vendor/autoload.php";
		$pdfname = rand();
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($invoiceTemplate);
		$fileTempName = "utils/invoices/".$pdfname."invoice.pdf";
		
		$fileName = $fileTempName;
		$mpdf->Output($fileName);
		/* code for save pdf file in database */
	
		$data = array(
			'pdfname' =>$pdfname
		);
		
		$this->db->update('z_payment',$data,'order_id="'.$order_id.'"');

		$addNotiToAdmin=array();
		$addNotiToAdmin['user_type']=1;// for Admin
		$addNotiToAdmin['user_id']=2;
		$addNotiToAdmin['subject']="New Documentation ";
		$addNotiToAdmin['msg']="New Certificate request done & payment also done";// for Admin
		$addNotiToAdmin['act_slug']=base_url().'admin/certificare';
		$addNotiToAdmin['status']=0;
		$addNotiToAdmin['dt']=date("Y-m-d H:i:s");
	
		notification($addNotiToAdmin); // For Admin

		$toEmail=$orderData->email; // client email
		$subject="Documentation payment Done ";
		$heading="Your Documentation Payment Added Successfully";
		$content="
		<div style='margin-top:1px;'>
			<tr>
			<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Document Type :</td>
			<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$categoryData[0]->sub_sub_category_name."</span></td>
			</tr>
		</div>
		<div style='margin-top:1px;'>
			<tr>
			<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Total amoune :</td>
			<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Rs. ".$additional['addtional']['gross_price']."/-</span></td>
			</tr>
		</div>
		<div style='margin-top:1px;'>
			<tr>
			<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Payment Status :</td>
			<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$orderData->payment_status."</span></td>
			</tr>
		</div>
		<div style='margin-top:1px;'>
			<tr>
			<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Invoice Link : </td>
			<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".base_url()."$fileName'>Download Invoice</a></span></td>
			</tr>
		</div>
		";

		  $message=get_email_temp($heading,$content);
	
		  $this->send_email($toEmail, $subject, $message);

		$toEmail="admin@insaaf99.com,write2nmakkar@gmail.com,vinny@insaaf99.com"; // admin email
		$subject="Documentation payment Added";
		$heading= $categoryData[0]->sub_sub_category_name." Documentation Payment Added Successfully";
		$content="
		<div style='margin-top:1px;'>
			<tr>
			<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Document Type :</td>
			<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$categoryData[0]->sub_sub_category_name."</span></td>
			</tr>
		</div>
		<div style='margin-top:1px;'>
			<tr>
			<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Total amoune :</td>
			<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Rs. ".$additional['addtional']['gross_price']."/-</span></td>
			</tr>
		</div>
		<div style='margin-top:1px;'>
			<tr>
			<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Payment Status :</td>
			<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$orderData->payment_status."</span></td>
			</tr>
		</div>
		<div style='margin-top:1px;'>
			<tr>
			<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Invoice Link : </td>
			<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".base_url()."$fileName'>Download Invoice</a></span></td>
			</tr>
		</div>
		";

		  $message=get_email_temp($heading,$content);
	
		  $this->send_email($toEmail, $subject, $message);

		// end send email for client details

			redirect(base_url('Welcome?ss=Your payment successfully done. Our team will contact you shrotly!'));
			exit();

		}else{
			$dataArr['updateAt'] = date("Y-m-d");
			$data = array(
				'payment_status' => 'Failed',
		 		'update_at' => $date,
		 		'gatewayResponse' =>$_POST['rPayResponse']
			 );
		 	$order_id 		= $_POST['orderId'];
			$this->db->update('z_payment',$data,'order_id="'.$order_id.'"');

                $this->session->unset_userdata('direct_booking');
                redirect(base_url('Welcome?ff=Your payment failed. So please make payment to make your document!'));
                exit();
		}
    }

}