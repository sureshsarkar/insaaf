<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
use Razorpay\Api\Api;


class DocPayment extends BaseController{ 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('client/Case_details_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/certificate_model');

        // Cookie helper
        $this->load->helper('cookie');
        $lang='';
        if(!empty($_COOKIE['lang']) && isset($_COOKIE['lang'])){
         $lang=$_COOKIE['lang'];
        }else{
         $lang=config_item('language');
        }
       $this->lang->load('menu',$lang);
       date_default_timezone_set('Asia/Kolkata');
    }

    // Index =============================================================
    public function index()
    { 

      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 

    if(isset($_GET['id']) && !empty($_GET['id'])){


     $id = base64_decode($_GET['id']);

    $documentation = $this->certificate_model->find($id);
    $documentDetail =  json_decode($documentation->additional,true);

          if(isset($documentDetail) && !empty($documentDetail)){


      
                  // set data
                  $insertdata['id']             = $documentation->id;
                  $insertdata['name']           = $documentDetail['addtional']['first_name'];
                  $insertdata['email']          = $documentDetail['addtional']['email'];
                  $insertdata['phone']          = $documentDetail['addtional']['mobile'];
      
                  $api = new Api($this->config->item('razPaykey_id'),$this->config->item('razSecret'));
                  $_SESSION['payable_amount'] =$documentDetail['addtional']['gross_price'];
            
                  $paymentData = array();
                  
                  $razorpayOrder = $api->order->create(array(
                  'receipt'         => rand(),
                  'amount'          => $_SESSION['payable_amount']*100, // 2000 rupees in paise
                  'currency'        => 'INR',
                  'payment_capture' => 1 // auto capture
                  ));
                
                  $amount = $razorpayOrder['amount'];
           
                  $razorpayOrderId = $razorpayOrder['id'];
                

                  $_SESSION['razorpay_order_id'] = $razorpayOrderId;
                  $data['orderDetails'] = $this->prepareData($amount,$razorpayOrderId,$insertdata);

                  $sessionArray['ClientDetails']  = $insertdata;
                  $this->session->set_userdata($sessionArray);
  
                  $paymentData['name']            = $insertdata['name'];
                  $paymentData['mobile']          = $insertdata['phone'] ;
                  $paymentData['email']           = $insertdata['email'];
                  $payAmount                      = $amount/100;
                  $paymentData['amount']          = $payAmount;
                  $paymentData['payment_date']    = date("Y-m-d H:i:s");  
                  $paymentData['order_id']        = $razorpayOrderId;
                  $paymentData['payment_status']  = 'pending';
                  $paymentData['payment_type']    = 'Documentation Payment';
                  $paymentData['payment_mode']    = 'razorpay';
      
                  // pre($paymentData);
                  // exit();
                  $result   =   $this->Payment_model->save($paymentData); 
                  $updatedata['id']             = $documentation->id;
                  $updatedata['payment_id'] =$result;
                  
                  $result1   = $this->certificate_model->save($updatedata); // insert in certificate table
                  $data['title'] = "Documentation payment templet";
                  // Save data to walet start
                  $data["file"]="front/doc_pay_tem";
                  $this->load->view('front/template',$data);

          } 
    } 
    } 
    // end code for register


}
?>