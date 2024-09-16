<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Razorpay_manual extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('Client_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        
        
        // Cookie helper
        $this->load->helper('cookie');
    }
    
 
    
 
    
    //  code for payment gatway details fill 
    
    public function prepareData($amount, $razorpayOrderId, $userDetails)
    {
        
        
        $data = array(
            "key" => $this->config->item('razPaykey_id'),
            "amount" => $amount,
            "name" => "Insaaf99",
            
            "image" => base_url() . "assets/images/front_logo/logo1.png",
            "prefill" => array(
                "name" => $userDetails['fname'] . ($userDetails['fname']) ? $userDetails['lname'] : '',
                "email" => $userDetails['email'],
                "contact" => $userDetails['mobile']
                //  "contact"  => '8937001226',
            ),
            "notes" => array(
                "address" => '',
                "merchant_order_id" => rand()
            ),
            "theme" => array(
                "color" => "#e2146f"
            ),
            "order_id" => $razorpayOrderId
        );
        return $data;
    }
    
    // end code for payment getway details fill 
    
    // code for register 
    public function Razorpay_manual()
    {
  
        $data["file"]         ="front/razorpay-manual";
        $this->load->view('front/template',$data);
                    
            
        }
}
  

?>
