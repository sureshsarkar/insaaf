<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
//require APPPATH . '/views/front/RazorPay/razorpay-php/Razorpay.php';
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
require APPPATH . '../assets/plugins/RazorPay/vendor/razorpay/razorpay/Razorpay.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Certi_verify extends BaseController
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
		$data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
    	// $_POST['orderId'] = '75';
		// $_POST['userId'] = '37';

		
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
	
		
  		 $sql = "select certificate.* , z_payment.* from z_payment z_payment, certificate  where z_payment.user_id = certificate.id and z_payment.order_id='".$order_id."' ";
	
  		$orderData_result = $this->Payment_model->rawQuery($sql);
		// pre($orderData_result);
		//   exit();

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
		// pre($payment_details);
		// exit();
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

			// pre($orderData_result);
			// exit();
			$payMethod = $payment_details->method;
			date_default_timezone_set("Asia/Calcutta");

			$date 						= date("Y/m/d h:m:s");
			$dataArr 				    = array();
			$dataArr['order_id'] 		= $_POST['orderId'];
			$dataArr['payment_status']  = "Success";
			if(isset($_POST['razorpay_payment_id'])){
					$dataArr['txn_id'] 			= $_POST['razorpay_payment_id'];
					$dataArr['gatewayResponse'] = $_POST['rPayResponse'];
			}

		
				
		
			$dataArr['updateAt'] = date("Y-m-d");
			$data = array(
		 		'payment_status' => 'Success',
		 		'txn_id' => $_POST['razorpay_payment_id'],
		 		'updateAt' => $date,
		 		'gatewayResponse' =>$_POST['rPayResponse']
			 );
		
		 	$order_id 		= $_POST['orderId'];
			 $result1=$this->db->update('z_payment',$data,'order_id="'.$order_id.'"');

			 $sql = "select certificate.* , z_payment.* from z_payment z_payment, certificate  where z_payment.user_id = certificate.id and z_payment.order_id='".$order_id."' ";
	
  		    $orderData_result = $this->Payment_model->rawQuery($sql);
		
		  
		    $orderData = $orderData_result[0];
			// code for update user status 

               /* code for last invoice_num nuumber */

		 	$invoice_num = $this->last_invoice(); // get last invoice number 
		 
				/* end code for last invoice number */
			 if(!empty($orderData_result[0]->id)){
			
				$updata = array();
				$updata['id'] = $orderData_result[0]->user_id;
				$updata['status'] = 1;
				$updata['payment_status'] = 1;
			    
				$this->Certificate_model->save($updata);
		
			 }

			// end code for update user status 



			// Razorypay Get Payment Details ==============================================
			$api = new Api($keyId, $keySecret);
			$rzpResponse = $api->payment->fetch($orderData->txn_id);
			
		$totalPrice=$orderData->amount;
		$total_sell_amt=$totalPrice;
		$payment_method = $payment_details->method;			
		include_once "mail_tmpl_invoice.php";
	
	  $invoiceTemplate;
		
		require APPPATH ."../assets/plugins/php_pdf/vendor/autoload.php";
		$pdfname = rand();
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML($invoiceTemplate);
		$fileTempName = "utils/invoices/".$pdfname.$orderData->user_id."invoice.pdf";
		
		$fileName = $fileTempName;
		$mpdf->Output($fileName);
		/* code for save pdf file in database */
	
		$data = array(
			'pdfname' =>$pdfname
		);
		
		$order_id 		= $_POST['orderId'];
		$this->db->update('z_payment',$data,'order_id="'.$order_id.'"');

		include_once "mail_tmpl_welcome.php";
		$welcomeTemplate;
		    $sesssion_details = $_SESSION['CertificateDetails'];
           if($result1 >0){
			$data['table']  = 'category';
            $data['id']     = '-id'; // Desc when - add
            $data['limit']     = '20'; // Desc when - add
            $data['categoryMenu']           = $this->getCategory($data); 
			
			$toEmail       = "admin@insaaf99.com"; // admin email
            $subject = "New Certificate Request ";
            $message = join('', array(
              "<div style='background:#ecc9dd; border-radius:8px;padding:7px;'>",
              "Hello Dear Admin ",
              "<br/>",
              "<b style='font-size: 22px;color: #09418b;'>",
              "New Certificate Request booked Successfully ",
              "</b>",
              "<br/>",
              "<b style='font-size:15px; color:#3a3a8a;'>",
              "Client Name : ",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['fname'],' ', $sesssion_details['lname'],
              "</b>",
              "<br/>",
              "<b style='font-size:15px; color:#3a3a8a;'>",
              "Category :",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['sub_cat_name'],
              "</b>",
              "<br/>",
              "<b style='font-size:15px;color:#162c97;'>",
              "Sub Category :",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['sub_sub_category_name'],
              "</b>",
              "<br>",
              "<b style='font-size:15px;color:#162c97;'>",
              "Cleint Email :",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['email'],
              "</b>",
              "<br>",
              "<b style='font-size:15px;color:#162c97;'>",
              "Cleint Mobile :",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['mobile'],
              "</b>",
			  "<br>",
              "Download Invoice :",
              "</b>",
              "<b style='font-size:15px;'>",
            //   "<a href='http://localhost/Sync/web/insaaf99/$fileName'>Download Invoice</a>",
              "<a href='".base_url()."$fileName'>Download Invoice</a>",
              "</b>",
              "<div>"
            ));
            $this->send_email($toEmail, $subject, $message);


			/* code for send clint registration success mail */
			$toEmail    =$sesssion_details['email'] ;  // client email  
            $subject = "Your Certificate Slot Booked Successfully";
            $message = join('', array(
              "<div style='background:#ecc9dd; border-radius:8px;padding:7px;'>",
              "<b style='font-size: 22px;color: #09418b;'>",
              "Our Team will Contact you very soon",
              "</b>",
              "<br/>",
              "<b style='font-size:15px; color:#3a3a8a;'>",
              "Client Name : ",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['fname'],' ', $sesssion_details['lname'],
              "</b>",
              "<br/>",
              "<b style='font-size:15px; color:#3a3a8a;'>",
              "Category :",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['sub_cat_name'],
              "</b>",
              "<br/>",
              "<b style='font-size:15px;color:#162c97;'>",
              "Sub Category :",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['sub_sub_category_name'],
              "</b>",
              "<br>",
              "<b style='font-size:15px;color:#162c97;'>",
              "Cleint Email :",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['email'],
              "</b>",
              "<br>",
              "<b style='font-size:15px;color:#162c97;'>",
              "Cleint Mobile :",
              "</b>",
              "<b style='font-size:15px;'>",
              $sesssion_details['mobile'],
              "</b>",
			  "<br>",
              "Download Payment Invoice :",
              "</b>",
              "<b style='font-size:15px;'>",
			//   "<a href='http://localhost/Sync/web/insaaf99/$fileName'>Download Invoice</a>",
			  "<a href='".base_url()."$fileName'>Download Invoice</a>",
              "</b>",
              "<div>"
            ));
            $this->send_email($toEmail, $subject, $message);

            $data["file"]         ="front/thank_you";
        	$this->load->view('front/template',$data);
        }

			// end send email for user details 
			
			
		}
		else
		{
			$dataArr['updateAt'] = date("Y-m-d");
			$data = array(
				'payment_status' => 'Failed',
		 	
		 		'update_at' => $date,
		 		'gatewayResponse' =>$_POST['rPayResponse']
			 );
		 	$order_id 		= $_POST['orderId'];
			$this->db->update('z_payment',$data,'order_id="'.$order_id.'"');
			echo $html = "<p>Your payment failed</p>
			<p>{$error}</p>";
		//header('location:decliened.php');
		}
    }

}


