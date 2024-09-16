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
    

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Welcome extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('cookie');
        $lang='';
        if(!empty($_COOKIE['lang']) && isset($_COOKIE['lang'])){
         $lang=$_COOKIE['lang'];
        }else{
         $lang=config_item('language');
        }
       $this->lang->load('menu',$lang);
       $this->isUserLoggedIn();
    }

   

    public function index()
    { 
        $data = array();
        
        $this->global['pageTitle'] = 'Welcome';
        $this->global['menu_hide'] = '1';
        $this->loadViews("client/welcome", $this->global, $data, NULL, 'client');
        
    }


    public function payment_welcome()
    { 
        $data = array();
        
        $this->global['pageTitle'] = 'Welcome';
        $this->global['menu_hide'] = '1';
        $this->global['footer_hide'] = '1';
        $this->loadViews("client/payment_welcome", $this->global, NULL, NULL, 'client');
        
    }

   
    
}

?>