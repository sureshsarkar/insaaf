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
class Forms extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Sub_sub_category_model');
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


    public function index(){
    
        $where['slug_url']='sale-deed';//$slug;
  
        $result= $this->Sub_sub_category_model->finddynamic($where);
 
           if(isset($result) && !empty($result)){
             $data['sub_sub_category_data']=$result[0];
           }
        $this->global['pageTitle'] = 'Document Form ';
        $this->loadViews("client/forms/form1", $this->global, $data, NULL, 'client');
  
      }

    
}

?>