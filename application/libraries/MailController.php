<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * Class : BaseController
 * Base Class to control over all the classes

 * @since : 15 November 2016

 */
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
 class MailController extends BaseController {

	
	
	// code for sub admin check login or not  

    function checkuserexit($columnname,$columnvalue) {
        $where = array();
        $where[$columnname] = $columnvalue;
        $exitstatus  = $this->client_model->findDynamic($where);
        return $exitstatus;
    }
    
    // code for send mail for admin 

    function send_mail_admin_client_reg($toEmail,$subject,$insertdata){
        $mail = new PHPMailer(true);

        //Enable SMTP debugging.

        $mail->SMTPDebug = 0; // if want on put 3 and hide 0

        //Set PHPMailer to use SMTP.

        $mail->isSMTP();

        //Set SMTP host name

        $mail->Host         = "insaaf99.com";

        //Set this to true if SMTP host requires authentication to send email

        $mail->SMTPAuth     = true;

        //Provide username and password

        $mail->Username     = "admin@insaaf99.com";

        $mail->Password     = "Jkm!@#$%54321";

        //If SMTP requires TLS encryption then set it

        $mail->SMTPSecure   = "tls";

        //Set TCP port to connect to

        $mail->Port         = '26';//587;

        $mail->From         = "admin@insaaf99.com";

        $mail->FromName     = " Insaaf99 ";

        //$mail->addAddress($userData['email']);

        $mail->addAddress($toEmail);//user email address

        $mail->isHTML(true);

        // attachment
        if(isset($insertdata['lname']) && empty($insertdata['lname'])){
            $lname = $insertdata['lname'];
        }else{
            $lname = '';
        }
       

        $mail->Subject =$subject;
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
                          $insertdata['fname'],' ', $lname,
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px; color:#3a3a8a;'>",
                          "E-mail : ",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['email'],
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px;color:#162c97;'>",
                          "Mobile :",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['mobile'],
                          "</b>",
                          "<br>",
                          "<b style='font-size:15px;color:#162c97;'>",
                          "Your Password is :",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['password'],
                          "</b>",
                          "<br>",
                          "<b style='font-size:15px;color:#162c97;'>",
                          "Client ID :",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['UniqueID'],
                          "</b>",
                          "<div>"
                        ));

        $mail->Body = $message;
        try {

            $mail->send();

           return 1;

        } catch (Exception $e) {

            echo "Mailer Error: " . $mail->ErrorInfo;

        }

    }

    // end code for send mail for admin 


    // code for send user registration successs
        function send_mail_client_reg($toEmail,$subject,$insertdata){
        $mail = new PHPMailer(true);

        //Enable SMTP debugging.

        $mail->SMTPDebug = 0; // if want on put 3 and hide 0

        //Set PHPMailer to use SMTP.

        $mail->isSMTP();

        //Set SMTP host name

        $mail->Host         = "insaaf99.com";

        //Set this to true if SMTP host requires authentication to send email

        $mail->SMTPAuth     = true;

        //Provide username and password

        $mail->Username     = "admin@insaaf99.com";

        $mail->Password     = "Jkm!@#$%54321";

        //If SMTP requires TLS encryption then set it

        $mail->SMTPSecure   = "tls";

        //Set TCP port to connect to

        $mail->Port         = '26';//587;

        $mail->From         = "admin@insaaf99.com";

        $mail->FromName     = " Insaaf99 ";

        //$mail->addAddress($userData['email']);

        $mail->addAddress($toEmail);//user email address

        $mail->isHTML(true);

        // attachment
        if(isset($insertdata['lname']) && empty($insertdata['lname'])){
            $lname = $insertdata['lname'];
        }else{
            $lname = '';
        }
       

        $mail->Subject =$subject;
        $message = join('', array(
                        "<div style='background:#ecc9dd; border-radius:8px;padding:7px;'>",
                        " Hello Dear ",
                        "<b style='font-size:15px; color:#3a3a8a;'>" . $insertdata['fname'] . " " . $lname,
                        "</b>" . " You have successfully registered on <b> Insaaf99</b>",
                        "<br/>",
                        "<b style='font-size:15px; color:#3a3a8a;'>",
                        "E-mail : ",
                        "</b>",
                        "<b style='font-size:15px;'>",
                        $insertdata['email'],
                        "</b>",
                        "<br/>",
                        "<b style='font-size:15px;color:#162c97;'>",
                        "Mobile :",
                        "</b>",
                        "<b style='font-size:15px;'>",
                        $insertdata['mobile'],
                        "</b>",
                        "<br>",
                        "<b style='font-size:15px;color:#162c97;'>",
                        "Your Login Password is :",
                        "</b>",
                        "<b style='font-size:15px;'>",
                        $insertdata['password'],
                        "</b>",
                        "<br>",
                        "<b style='font-size:15px;color:#162c97;'>",
                        "Client ID :",
                        "</b>",
                        "<b style='font-size:15px;'>",
                        $insertdata['UniqueID'],
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
        $mail->Body = $message;
        try {

            $mail->send();

           return 1;

        } catch (Exception $e) {

            echo "Mailer Error: " . $mail->ErrorInfo;

        }

    }


    // end code for send user registration success
	 
}