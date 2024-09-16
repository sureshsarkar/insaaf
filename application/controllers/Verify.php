<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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

class Verify extends BaseController
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
        // $this->load->model('user_model');
        $this->load->model('client_model');
        $this->load->library('encryption');
        
        
    }
    
    
    public function last_invoice()
    {
        $where            = array();
        $where['field']   = 'invoice_num';
        $where['orderby'] = '-id';
        
        $result = $this->Payment_model->findDynamic($where);
        
        $lastdb_invoice_num    = '';
        $lastdb_invoice_year   = '';
        $lastdb_invoice_prefix = '';
        
        if (!empty($result[1]->invoice_num)) {
            
            $invoice_array         = explode("|", $result[1]->invoice_num);
            $lastdb_invoice_num    = $invoice_array[2];
            $lastdb_invoice_year   = $invoice_array[1];
            $lastdb_invoice_prefix = $invoice_array[0];
        } else {
            
            $invoice_lastnum = "001";
            $curentYear      = date("y");
            $old_year        = substr($curentYear, -2) - 1;
            $invoice_num     = "I|" . $old_year . "-" . $curentYear . "|" . $invoice_lastnum;
        }
        
        $current_month = date("m");
        if ($current_month < 03) {
            
            $lastdb_invoice_num = substr($lastdb_invoice_num, 1);
            $temp_invoice       = $lastdb_invoice_num + 1;
            $invoice_lastnum    = "00$temp_invoice";
            $curentYear         = date("y");
            $old_year           = substr($curentYear, -2) - 1;
            $invoice_num        = "I|" . $old_year . "-" . $curentYear . "|" . $invoice_lastnum;
            
        } else {
            
            $curentYear             = date("y");
            $lastdb_invoice_num     = substr($lastdb_invoice_num, 1);
            $temp_invoice           = $lastdb_invoice_num + 1;
            $invoice_lastnum        = "00$temp_invoice";
            $next_year              = substr($curentYear, -2) + 1;
            $old_year               = substr($curentYear, -2) - 1;
            $invoice_num            = "I|" . $curentYear . "-" . $next_year . "|" . $invoice_lastnum;
            // prefix
            $sql1                   = "SELECT invoice_num FROM `z_payment` WHERE `invoice_num` LIKE '%I|$curentYear-$next_year%' ORDER BY `id` DESC";
            $last_invoicenumber_res = $this->Payment_model->rawQuery($sql1);
            if (!empty($last_invoicenumber_res)) {
                //$invoice_num = "V|".$old_year."-".$curentYear."|".$invoice_lastnum;
                $invoice_num = "I|" . $curentYear . "-" . $next_year . "|" . $invoice_lastnum;
            } else {
                $invoice_lastnum = "001";
                $invoice_num     = "I|" . $curentYear . "-" . $next_year . "|" . $invoice_lastnum;
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
        
        
        $where = array();
        // $where['order_id']    =    $_POST['orderId'];
        // $orderData     =    $this->payment_model->findOneBy($where);
        
        $key_id   = $this->config->item('razPaykey_id');
        $secret   = $this->config->item('razSecret');
        $order_id = $_POST['orderId'];
        
        
        $sql = "select clint.* , z_payment.* from z_payment z_payment, clint  where z_payment.user_id = clint.id and z_payment.order_id='" . $order_id . "' ";
        
        $orderData_result = $this->Payment_model->rawQuery($sql);
        //   pre($orderData_result);
        //   exit();
        
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
            
            // pre($orderData_result);
            // exit();
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
            
            /* code for last invoice_num nuumber */
            
            
            
            /* end code for last invoice number */
            
            
            $dataArr['updateAt'] = date("Y-m-d");
            $data                = array(
                
                'payment_status' => 'Success',
                'txn_id' => $_POST['razorpay_payment_id'],
                'updateAt' => $date,
                'gatewayResponse' => $_POST['rPayResponse']
            );
            $order_id            = $_POST['orderId'];
            $this->db->update('z_payment', $data, 'order_id="' . $order_id . '"');
            
            // code for update user status 
            if (!empty($orderData_result[0]->id)) {
                
                $updata           = array();
                $updata['id']     = $orderData_result[0]->user_id;
                $updata['status'] = 1;
                
                $this->client_model->save($updata);
                
            }
            
            // end code for update user status 
            
            // Razorypay Get Payment Details ==============================================
            $api         = new Api($keyId, $keySecret);
            $rzpResponse = $api->payment->fetch($orderData->txn_id);
            
            $totalPrice     = $orderData->amount;
            $total_sell_amt = $totalPrice;
            $payment_method = $payment_details->method;
            include_once "registertion_mail_invoice.php";
            
            $invoiceTemplate;
           
            require APPPATH . "../assets/plugins/php_pdf/vendor/autoload.php";
            $pdfname = rand();
            $mpdf    = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($invoiceTemplate);
            $fileTempName = "utils/invoices/" . $pdfname . $orderData->user_id . "invoice.pdf";
            
            $fileName = $fileTempName;
            $mpdf->Output($fileName);
            /* code for save pdf file in database */
            // pre($fileTempName);
            // exit();
            $data = array(
                'pdfname' => $pdfname
            );
            
            $order_id = $_POST['orderId'];
            $this->db->update('z_payment', $data, 'order_id="' . $order_id . '"');
            
            include_once "registertion_mail_invoice.php";
            $welcomeTemplate;
            
            // $sesssion_details = $_SESSION['ClientDetails'];
            // Send mail to Admin
			$toEmail = "admin@insaaf99.com"; // admin email 
			$subject = "New Clint Registered ";
			$message = join('', array(
				"<div style='background:#ecc9dd; border-radius:8px;padding:7px;'>",
				"Dear Admin ",
				"<br/>",
				"<b style='font-size:15px; color:#3a3a8a;'>",
				"New Clint Registered Successfully ",
				"</b>",
				"<br/>",
				"<b style='font-size:15px; color:#3a3a8a;'>",
				"Client Name : ",
				"</b>",
				"<b style='font-size:15px;'>",
				$_SESSION['name'],
				"</b>",
				"<br/>",
				"<b style='font-size:15px; color:#3a3a8a;'>",
				"E-mail : ",
				"</b>",
				"<b style='font-size:15px;'>",
				$_SESSION['email'],
				"</b>",
				"<br/>",
				"<b style='font-size:15px;color:#162c97;'>",
				"Mobile :",
				"</b>",
				"<b style='font-size:15px;'>",
				$_SESSION['mobile'],
				"</b>",
				"<br>",
				"<b style='font-size:15px;color:#162c97;'>",
				"Your Password is :",
				"</b>",
				"<b style='font-size:15px;'>",
				$_SESSION['password'],
				"</b>",
				"<div>"
			  ));
            $this->send_email($toEmail, $subject, $message);
            
            /* code for send clint registration success mail */
            $toEmail = $_SESSION['email']; // client gmail addresss 
            $subject = "Registered Successfully ";
			$message = join('', array(
				"<div style='background:#ecc9dd; border-radius:8px;padding:7px;'>",
				" Hello Dear ",
				"<b style='font-size:15px; color:#3a3a8a;'>" . $_SESSION['name'],
				"</b>" . " You have successfully registered on <b> Insaaf99</b>",
				"<br/>",
				"<b style='font-size:15px; color:#3a3a8a;'>",
				"E-mail : ",
				"</b>",
				"<b style='font-size:15px;'>",
				$_SESSION['email'],
				"</b>",
				"<br/>",
				"<b style='font-size:15px;color:#162c97;'>",
				"Mobile :",
				"</b>",
				"<b style='font-size:15px;'>",
				$_SESSION['mobile'],
				"</b>",
				"<br>",
				"<b style='font-size:15px;color:#162c97;'>",
				"Your Login Password is :",
				"</b>",
				"<b style='font-size:15px;'>",
				$_SESSION['password'],
				"</b>",
				"<br>",
				"<b style='font-size:15px;color:#162c97;'>",
				"Go For Login:",
				"</b>",
				"<b style='font-size:15px;'>",
				 "<a href='".base_url()."'>Click Here For Login</a>",
				"</b>",
				"<div>"
			));
            $this->send_email($toEmail, $subject, $message);
            
            /* end code for send user registration success mail */
            
            //    echo $message;
            //$this->Payment->success();
            $this->session->set_flashdata('success', 'You have Successfully Registered into Insaaf99.com');
            redirect(base_url('client/Dashboard/index/'.$_SESSION['id']));
        
            // pre($sesssion_details['id']);
          
           // $data["file"] = "front/thank_you";
          //  $this->load->view('front/template', $data);

        } else {
            $dataArr['updateAt'] = date("Y-m-d");
            $data                = array(
                'payment_status' => 'Failed',
                
                'update_at' => $date,
                'gatewayResponse' => $_POST['rPayResponse']
            );
            $order_id            = $_POST['orderId'];
            $this->db->update('orders', $data, 'order_id="' . $order_id . '"');
            echo $html = "<p>Your payment failed</p>
            <p>{$error}</p>";
            //header('location:decliened.php');
        } //echo $html;
    }
    
}