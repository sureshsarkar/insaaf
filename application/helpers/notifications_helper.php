<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;


 // query_request_admin_message 
 function query_request_admin_message($client,$query)
{     
     // ======================================================================
     
       $toEmail= "vinny_makkar@yahoo.com,write2nmakkar@gmail.com"; // admin mail //vinny_makkar@yahoo.com,write2nmakkar@gmail.com
        $subject= "Getting a new client query - Insaa99";

        $heading="Hi Admin, Getting a new client query";
        $content="
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>INSAAF-C-".$client->id."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client->fname." ".$client->lname."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$query->msg."</span></td>
            </tr>
        </div>
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query Date : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".date("d/M/Y h:i A")."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Reply Link : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><a href=".base_url('admin/query/chat/'.$query->id).">Reply Now</a></td>
            </tr>
        </div>
        ";

        $message = get_email_temp($heading,$content);
        return  send_mail($toEmail, $subject, $message);
    
}





// slot_booking 
 function slot_booking_admin_message($client,$slot,$payment)
{     
     // ======================================================================
     
     $toEmail= "vinny_makkar@yahoo.com,write2nmakkar@gmail.com,admin@insaaf99.com";//"bkweb11@gmail.com"; // admin mail //vinny_makkar@yahoo.com,write2nmakkar@gmail.com
        $subject= "Getting a new Slot Booking - Insaa99";

        $heading="Hi Admin, Getting a new Slot Booking";
        $content="
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>INSAAF-C-".$client->id."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client->fname." ".$client->lname."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Case : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slot->name."</span></td>
            </tr>
        </div>

         <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Case Description : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slot->case_description."</span></td>
            </tr>
        </div>

         <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Time : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".date("d-m-Y h:i A", strtotime($slot->meeting_time))."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Payment : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>₹".$payment->amount."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Booking Date : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".date("d/M/Y h:i A")."</span></td>
            </tr>
        </div>
        ";

        $message = get_email_temp($heading,$content);
        
        return  send_mail($toEmail, $subject, $message);
    
}

 // certificate_request_admin_message 
 function certificate_request_admin_message($client,$certificate,$payment)
{     
     // ======================================================================
     
        $toEmail= "admin@insaaf99.com";//"bkweb11@gmail.com"; // admin mail //vinny_makkar@yahoo.com,write2nmakkar@gmail.com
        $subject= "Getting a new certificate Request - Insaa99";

        $heading="Hi Admin, Getting a new certificate Request";
        $content="
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>INSAAF-C-".$client->id."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client->fname." ".$client->lname."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Certificate : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$certificate->sub_sub_category_name."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Payment : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>₹ ".$payment->amount."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Date : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".date("d/M/Y h:i A")."</span></td>
            </tr>
        </div>
        ";
        $message = get_email_temp($heading,$content);
        return  send_mail($toEmail, $subject, $message);
    
}


 // certificate_request_client_message 
 function certificate_request_client_message($client,$certificate,$payment)
{     
     // ======================================================================
     
        $toEmail= $client->email; // client mail //vinny_makkar@yahoo.com
        $subject= "Your Certificate Booked Successfully - Insaa99";

        $heading="Hi ".$client->fname." ".$client->lname." , Getting for certificate Request";
        $content="
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>INSAAF-C-".$client->id."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client->fname." ".$client->lname."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Certificate : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$certificate->sub_sub_category_name."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Payment : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span> ₹".$payment->amount."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Request Date : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".date("d/M/Y h:i A")."</span></td>
            </tr>
        </div>

        
        ";

        $message = get_email_temp($heading,$content);
        return  send_mail($toEmail, $subject, $message);
    
}

// meeting expire email start 
function clientMeetingExpire($clientData,$lawyerData,$slotData){
    $toEmail = $clientData->email; // Client email 
    $subject = "Booking is expired";
    $heading="Dear ".$clientData->fname." ".$clientData->lname." booking slot is expired for some reason. Please Book the Slot Again";
 $content="
 <div style='margin-top:1px;'>
     <tr>
     <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
     <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerData->fname." ".$lawyerData->lname."</span></td>
     </tr>
 </div>
 <div style='margin-top:1px;'>
     <tr>
     <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
     <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData->slot_date."</span></td>
     </tr>
 </div>
 <div style='margin-top:1px;'>
     <tr>
     <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
     <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData->time."</span></td>
     </tr>
 </div>
 <div style='margin-top:1px;'>
     <tr>
     <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Status :</td>
     <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Expired</span></td>
     </tr>
 </div>
 <div style='margin-top:1px;'>
     <tr>
     <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Please Book Slot Again :</td>
     <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='https://insaaf99.com'>Click Here</a></span></td>
     </tr>
 </div>
";

$message=get_email_temp($heading,$content);
return send_mail($toEmail, $subject, $message);
       
}

function lawyerMeetingExpire($clientData,$lawyerData,$slotData){
     $toEmail = $lawyerData->email; // Lawyer email
     $subject = "Meeting is expired";
     $heading="Dear ".$lawyerData->fname." ".$lawyerData->lname." this slot has expired due to some reasons. we will rescheduled the same shortly.";
     $content="
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$clientData->fname." ".$clientData->lname."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData->slot_date."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData->time."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Status :</td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Expired</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: red;' width='100%' colspan='2'>Kindly Approve the next slot if booked again by the client</td>
         </tr>
     </div>
   ";
    
    $message=get_email_temp($heading,$content);
   return send_mail($toEmail, $subject, $message);
}
// meeting expire email end


// user Registration Email start 
function clientRegistrationEmail($toEmail,$clientName){     

    $toEmail= $toEmail;// "sureshsarkar2020@gmail.com";//"bkweb11@gmail.com"; // admin mail //vinny_makkar@yahoo.com,write2nmakkar@gmail.com
    $subject= "Registartion Successfully - Insaa99";
 
        $message = getClientRegistartionTemp($clientName);
        return  send_mail($toEmail, $subject, $message);
}


function lawyerRegistrationEmail($lawyerEmail,$lawyerId){

    $toEmail = $lawyerEmail; // lawyer email 
    $subject = "Registration Successful into Insaaf99";
 
    $heading="Hello you have registered successfully into Insaaf99.com";
    $content="
    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Email : </td>
        <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerEmail."</span></td>
        </tr>
    </div>
    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer ID : </td>
        <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerId."</span></td>
        </tr>
    </div>
    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Congratulations!! </td>
        </tr>
    </div>
    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;text-align: justify;' width='100%' colspan='2'>We are delighted to welcome you on Insaaf99-India,s first cloud-based legal practice management App & Web-dashboard. You've taken the first step on a path that could change your practice and your legal career for years to come. </td>
        </tr>
    </div>
    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Next Step:</td>
        </tr>
    </div>
    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b; text-align: justify;' width='100%' colspan='2'>Complete your profile and upload a copy of your Bar Council ID which will help us verify your profile quickly.</td>
        </tr>
    </div>
    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Regards <br>Team Insaaf99</td>
        </tr>
    </div>
  ";

$message=get_email_temp($heading,$content);
return  send_mail($toEmail, $subject, $message);

}
// user Registration Email end
    
    
    // send default fuction 
function send_mail($toEmail,$subject,$message){

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
    $mail->FromName     = "Insaaf99";
    //$mail->addAddress($userData['email']);
    $toArr = explode(',',$toEmail);
    foreach ($toArr as $mail_Id) {
        $mail->addAddress($mail_Id);//user email address
    }
    $mail->isHTML(true);
    // attachment
    $mail->Subject =$subject;
    $mail->Body = $message;
    try {
        $mail->send();
       return 1;
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

}




 
 // send mail , sms & notification to client, lawyer and admin on reschedule meeting end
 
 
?>