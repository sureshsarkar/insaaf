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

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Teams extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('lawyer/Hearing_date_model');
        $this->load->model('client/Client_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        $this->load->model('Client/Case_details_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/Slot_model');
        
    }
    
    /**
     * This function used to load the first screen of the user
     */
    
    
      
            public function run()
            {
                $accessToken = 'xxx';
        
                $graph = new Graph();
                $graph->setAccessToken($accessToken);
        
                $user = $graph->createRequest("GET", "/me")
                              ->setReturnType(Model\User::class)
                              ->execute();
        
                echo "Hello, I am {$user->getGivenName()}.";
                exit();
            }
        

    
}

?>
