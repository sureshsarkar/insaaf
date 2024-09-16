<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';

use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Invalid extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('base_library');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Latest_News_model');
        // Cookie helper
        $this->load->helper('cookie');
       
     }


    // Index =============================================================
    public function index()
    {

      echo "Invalid Crediantial <br> <a href='".base_url()."'> Go Back</a>";
      exit();
    } 
   

      
}

?>