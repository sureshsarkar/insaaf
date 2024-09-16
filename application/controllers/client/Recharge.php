<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
use Razorpay\Api\Api;


class Recharge extends BaseController { 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('Client_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('client/Case_details_model');
        $this->load->model('admin/Wallet_model');

        // Cookie helper
        $this->load->helper('cookie');
    }

      //  code for payment gatway details fill 

      public function prepareData($amount,$razorpayOrderId,$userDetails)
      {
      $data = array(
          "key" => $this->config->item('razPaykey_id'),
          "amount" => $amount,
          "name" => "Insaaf99",
          "image" =>  base_url()."assets/images/law_logo.png",
          "prefill" => array(
          "name"  =>$userDetails['name'],
          "id"  =>$userDetails['id'],
          "email"  =>$userDetails['email'],
          "contact"  => $userDetails['phone'],
                            ),
          "notes"  => array(
        "address"  =>'',
        "merchant_order_id" => rand(),
                          ),
          "theme"  => array(
          "color"  => "#e2146f"
                      ),
            "order_id" => $razorpayOrderId,
        );
   
      return $data;
      }
  
    // Index =============================================================
    public function index()
    { 
       $data["title"]="index";
       $data["file"]="front/index";
       $this->load->view('front/template',$data);
    } 

    // code for register 
    public function recharge()
    {  
            $insertdata['name']           = $_SESSION['name'];
            $insertdata['id']             = $_SESSION['id'];
            $insertdata['email']          = $_SESSION['email'];
            $insertdata['phone']          = $_SESSION['phone'];
        
            date_default_timezone_set("Asia/Calcutta");
            $api = new Api($this->config->item('razPaykey_id'),$this->config->item('razSecret'));
            $_SESSION['payable_amount'] =198;
            
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
          
          
            $insertdata['password']  = $this->input->post('password');
            $sessionArray['ClientDetails']  = $insertdata;
            $this->session->set_userdata($sessionArray);



            $paymentData = array();
            $paymentData['user_id']         = $insertdata['id'];   
            $paymentData['name']            = $insertdata['name'];
            $paymentData['mobile']          = $insertdata['phone'] ;
            $paymentData['email']           = $insertdata['email'];
            $payAmount                      = $amount/100;
            $paymentData['amount']          = $payAmount;
            $paymentData['payment_date']    = date("Y/m/d h:m:s");  
            $paymentData['order_id']        = $razorpayOrderId;
            $paymentData['payment_status']  = 'pending';
            $paymentData['payment_type']    = 'Recharge';
            $paymentData['payment_mode']    = 'razorpay';

            
            $result   =   $this->Payment_model->save($paymentData);
            
            // Save data to walet start

            $paymentData1 = array();
            $paymentData1['client_id']         = $insertdata['id'];   
            $payAmount                         = $amount/100;
            $paymentData1['amount']            = $payAmount;
            $paymentData1['label']             = "Recharge";
            $paymentData1['user_type']          = "client";   
            $paymentData1['status']            = "pending";   
            
            $result2   =   $this->Wallet_model->save($paymentData1);
            // pre($result2);
            // exit();
            //Save data to walet end
            


            $data_view_port=$this->load->view('client/client_rezarpay',$data,TRUE);
            echo $data_view_port;

  
      }
// end code for register

    // code for register 
    public function case_payment($id=NULL)
    {          

            $sql = "SELECT c.* ,cc.total_amount,cc.gst_amount  FROM cases as c "; 
            $sql .= " JOIN case_category as cc ON cc.id = c.case_category_id "; 
            $sql .= " LEFT JOIN slot as s ON s.case_id = c.id "; 
            $sql .= "WHERE c.id = $id ";

            $rData = $this->Case_details_model->rawQuery($sql);
            $Data_result = $rData[0];
            $total_amount       = intval($Data_result->total_amount);
            $gst_amount       = intval($Data_result->gst_amount);
            $amount= $total_amount + $gst_amount;
            // pre($Data_result);
            // exit();
            $_SESSION['payable_amount']=$amount; // Case category amount
            
              $insertdata['id']             = $_SESSION['id'];
              $insertdata['case_id']        = $id;
              $insertdata['name']           = $_SESSION['name'];
              $insertdata['email']          = $_SESSION['email'];
              $insertdata['phone']          = $_SESSION['phone'];
          
          // 10000 patment gatway
          
              date_default_timezone_set("Asia/Calcutta");
              $api = new Api($this->config->item('razPaykey_id'),$this->config->item('razSecret'));
              
              
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
            
              $insertdata['password']  = $this->input->post('password');
              $sessionArray['ClientDetails']  = $insertdata;
              $this->session->set_userdata($sessionArray);
      
              $paymentData = array();
              $paymentData['user_id']         = $insertdata['id'];   
              $paymentData['name']            = $insertdata['name'];
              $paymentData['mobile']          = $insertdata['phone'] ;
              $paymentData['email']           = $insertdata['email'];
              $payAmount                      = $amount/100;
              $paymentData['amount']          = $payAmount;
              $paymentData['payment_date']    = date("Y/m/d h:m:s");  
              $paymentData['order_id']        = $razorpayOrderId;
              $paymentData['payment_status']  = 'pending';
              $paymentData['payment_type']    = 'Case Payment';
              $paymentData['payment_mode']    = '';

              //   code for update cases table for orderid 
              $casesUpdateData = array();
              $casesUpdateData['id'] = $id;
              $casesUpdateData['order_id']  = $razorpayOrderId;
              $casesUpdateData['payment']  = $payAmount;
              $casesUpdateData['payment_status']  = 0;
              
              $result1   =   $this->Case_details_model->save($casesUpdateData);

              
              // end code for update cases 
              
              $result   =   $this->Payment_model->save($paymentData);
              
              $data_view_port=$this->load->view('client/case_payment',$data,TRUE);
              echo $data_view_port;    
  
       }



}
?>