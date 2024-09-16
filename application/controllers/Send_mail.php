<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require APPPATH . '/libraries/BaseController.php';


class signup_ajax extends BaseController { 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('Client_model');
        $this->load->model('front/payment_model');

        // Cookie helper
        $this->load->helper('cookie');
    }



  

    /* this function for send mail */

	// public function send_email($toEmail,$subject,$message){
    //     $mail = new PHPMailer(true);
    //     //Enable SMTP debugging.
    //     $mail->SMTPDebug = 0; // if want on put 3 and hide 0
    //     //Set PHPMailer to use SMTP.
    //     $mail->isSMTP();
    //     //Set SMTP host name
    //     $mail->Host         = "vaibhavlaxmi.co.in";
    //     //Set this to true if SMTP host requires authentication to send email
    //     $mail->SMTPAuth     = true;
    //     //Provide username and password
    //     $mail->Username     = "info@vaibhavlaxmi.co.in";
    //     $mail->Password     = "Jitendra@2022";
    //     //If SMTP requires TLS encryption then set it
    //     $mail->SMTPSecure   = "tls";
    //     //Set TCP port to connect to
    //     $mail->Port         = '26';//587;
    //     $mail->From         = "sureshsarkar201811@gmail.com";
    //     $mail->FromName     = " Insaaf99 ";
    //     //$mail->addAddress($userData['email']);
    //     $toArr = explode(',',$toEmail);
    //     $mail->addAddress($toArr[0]);//user email address
    //     $mail->isHTML(true);
    //     // attachment
    //     $mail->Subject =$subject;
    //     $mail->Body = $message;
    //     try {
    //         $mail->send();
    //        return 1;
    //     } catch (Exception $e) {
    //         echo "Mailer Error: " . $mail->ErrorInfo;
    //     }
    // }
	/* end send mail function */

    public function test(){
        echo 'Test';
    }
    

}
?>