<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;



function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function send_email_for_slot($toEmail,$subject,$message){
 if(empty($toEmail)){
  return false;
 }
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

// function to add notification start
function notification($data){
    
    $CI = get_instance();
    $table='notification';
    $CI->db->insert($table, $data);
    return $CI->db->insert_id();
}


function send_sms($phone,$msg){
    $mobile='91'.$phone;
    // Account details
    $apiKey = urlencode('MzI0MzQ5NGMzMTc2NTA1Nzc4Njk0NDQxNDg1ODYxNDg=');
    // Message details
    $numbers = array($mobile);
    $sender = urlencode('JKMISF');
    $message = rawurlencode($msg);
    $numbers = implode(',', $numbers);
    // Prepare data for POST request
    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
    
    // Send the POST request with cURL
    $ch = curl_init('https://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Process your response here
    return $response;
    }
    
    // Encript List start
    function JKMencoder($encode){
        $arraycode= str_split($encode);
        $count=strlen($encode);
        // $encriptlist=$CI->config->item('zurl');
        $encriptlist=array();
        $encriptlist=array(
            '0' =>'b',
            '1' =>'d',
            '2' =>'f',
            '3' =>'h',
            '4' =>'j',
            '5' =>'l',
            '6' =>'n',
            '7' =>'p',
            '8' =>'r',
            '9' =>'t'
        );
     
        $newstring="";
        
        $i=0;
        while ($i<$count){
          $newstring .=(empty($newstring)) ? $encriptlist[$arraycode[$i]] :$encriptlist[$arraycode[$i]];
          $i++;
        }
        return $newstring;
    }
    
    // Encript List start
    function JKMdecoder($id){
        $encriptlist=array();
        $encriptlist=array(
            '0' =>'b',
            '1' =>'d',
            '2' =>'f',
            '3' =>'h',
            '4' =>'j',
            '5' =>'l',
            '6' =>'n',
            '7' =>'p',
            '8' =>'r',
            '9' =>'t'
        );
    
        $arraycode= str_split($id);
        $count=count($encriptlist);
      
        $flipped = array_flip($encriptlist);
       
        $newstring='';
      
        for($i=0; $i<$count; $i++){
         
            if(isset($arraycode[$i]) && !empty($arraycode[$i])){
                if(isset($flipped[$arraycode[$i]])){
                    $newstring .= $flipped[$arraycode[$i]];
                }else{
                 return 0;
                }
             
            }
      
        }
        return $newstring;
    }



// nitification when book slot start
 function nitification_when_book_slot($clientData,$lawyerData,$slotData)
{     

$dateTime=$slotData->meeting_time;
$date=date("d-m-Y",strtotime($dateTime));
$time=date("h:i a",strtotime($dateTime));
$clientName =str_replace(' ', '',$clientData->fname);
$lawyerName =str_replace(' ', '',$lawyerData->fname);
          // for client notification
          $addNotiToClient=array();
          $addNotiToClient['user_type']=3;// for client
          $addNotiToClient['user_id']=$clientData->id;
          $addNotiToClient['subject']="You have assign a lawyer";
          $addNotiToClient['msg']="Your meeting date is ".$date.' at '.$time;
          $addNotiToClient['act_slug']=base_url().'client/meeting';
          $addNotiToClient['status']=0;
          $addNotiToClient['dt']=date("Y-m-d H:i:s");
   
        //   notification($addNotiToClient);

          if(!empty($lawyerData)){
              $addNotiToLawyer=array();
              $addNotiToLawyer['user_type']=2;// for Lawyer
              $addNotiToLawyer['user_id']=$lawyerData->id;
              $addNotiToLawyer['subject']="You have assign a meeting with ".$clientData->fname;
              $addNotiToLawyer['msg']="Your meeting date is ".$date." at ".$time;
              $addNotiToLawyer['act_slug']=base_url().'lawyer/meeting';
              $addNotiToLawyer['status']=0;
              $addNotiToLawyer['dt']=date("Y-m-d H:i:s");
            //   notification($addNotiToLawyer);// For Lawyer
          }
     
          // for Admin notification
          $addNotiToAdmin=array();
          $addNotiToAdmin['user_type']=1;// for Admin
          $addNotiToAdmin['user_id']=2;
          $addNotiToAdmin['subject']="New meeting created";
          $addNotiToAdmin['msg']="A New meeting confirmed for".$date." at ".$time;
          $addNotiToAdmin['act_slug']=base_url().'admin/meeting_list';
          $addNotiToAdmin['status']=0;
          $addNotiToAdmin['dt']=date("Y-m-d H:i:s");
   
        //   notification($addNotiToAdmin);// For Admin 
   
              $encriptID= JKMencoder($slotData->id);
              $link='https://insaaf99.com/z/c/'.$encriptID;
              $link1='https://insaaf99.com/z/l/'.$encriptID;
         
              // Send SMS in Mobile Number start for client

$msg='Dear '.$clientName.' your appointment has been fixed @ '.$time.' meeting Date: '.$date.' meeting link: '.$link.'
Team Insaaf99';
send_sms($clientData->mobile,$msg);

                // Send SMS in Mobile Number end 

             // Send SMS in Mobile Number for client start


$msg='Dear '.$lawyerName.' your appointment has been fixed @ '.$time.' meeting Date: '.$date.' meeting link: '.$link1.'
Team Insaaf99';

send_sms($lawyerData->mobile,$msg);
             
             // Send SMS in Mobile Number end 


              /* send mail for client to sent meeting link */
                 $toEmail = $clientData->email; // client email 
                 $subject = "Your meeting confirmed";
              $heading="Hurray! your meeting is scheduled with our Expert lawyer";
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
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$date."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$time."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$link."'>Join Meeting</a></span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
              <tr>
              <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Note : </td>
              <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Your are requested to not share your email,mobile or any personal details with the lawyer</span></td>
              </tr>
          </div>
            ";
             
             $message=get_email_temp($heading,$content);
             send_email_for_slot($toEmail, $subject, $message);
              /* end code for client to sent meeting link */
       
              
              /* send mail for Lawyer to sent meeting link */
              $toEmail = $lawyerData->email; // lawyer email 
              $subject = "Assigned a meeting by Insaaf99.com";
              $heading="You have assigned a meeting for One-O-One with our client";
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
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$date."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$time."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$link1."'>Join Meeting</a></span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
              <tr>
              <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Note : </td>
              <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Your are requested to not share your email,mobile or any personal details with the client</span></td>
              </tr>
          </div>
            ";
             
             $message=get_email_temp($heading,$content);
             send_email_for_slot($toEmail, $subject, $message);

              /* end code for Lawyer to sent meeting link */
              
               
              /* send mail for Admin to sent  meeting link */
                $toEmail = "admin@insaaf99.com,write2nmakkar@gmail.com,vinny@insaaf99.com"; //Admin email 
                $subject = "Assigned lawyer for meeting successfully";
              $heading="Hurray! Insaaf99 has successfully created Meeting Link ";
              $content="
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$clientData->fname." ".$clientData->lname."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerData->fname." ".$lawyerData->lname."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$date."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$time."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$link."'>Join Meeting</a></span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$link1."'>Join Meeting</a></span></td>
                  </tr>
              </div>
            ";
             $message=get_email_temp($heading,$content);
             send_email_for_slot($toEmail, $subject, $message);
    
}



// nitification when reassign lawyer start
 function nitification_when_book_slot_reassing_lawyer($clientData,$lawyerData,$slotData)
{     
          $dateTime=$slotData->meeting_time;
          $date=date("d-m-Y",strtotime($dateTime));
          $time=date("h:i a",strtotime($dateTime));
          $clientName =str_replace(' ', '',$clientData->fname);
          $lawyerName =str_replace(' ', '',$lawyerData->fname);

          // for client notification
          $addNotiToClient=array();
          $addNotiToClient['user_type']=3;// for client
          $addNotiToClient['user_id']=$clientData->id;
          $addNotiToClient['subject']="You have reassign a lawyer";
          $addNotiToClient['msg']="Your meeting date is ".$slotData->slot_date.' at '.$slotData->time;
          $addNotiToClient['act_slug']=base_url().'client/meeting';
          $addNotiToClient['status']=0;
          $addNotiToClient['dt']=date("Y-m-d H:i:s");
   
          notification($addNotiToClient);

          $addNotiToLawyer=array();
          $addNotiToLawyer['user_type']=2;// for Lawyer
          $addNotiToLawyer['user_id']=$lawyerData->id;
          $addNotiToLawyer['subject']="You have reassign a meeting with ".$clientData->fname;
          $addNotiToLawyer['msg']="Your meeting date is ".$slotData->slot_date." at ".$slotData->time;
          $addNotiToLawyer['act_slug']=base_url().'lawyer/meeting';
          $addNotiToLawyer['status']=0;
          $addNotiToLawyer['dt']=date("Y-m-d H:i:s");
   
          notification($addNotiToLawyer);// For Lawyer
     
          // for Admin notification
          $addNotiToAdmin=array();
          $addNotiToAdmin['user_type']=1;// for Admin
          $addNotiToAdmin['user_id']=2;
          $addNotiToAdmin['subject']="Reassign meeting ";
          $addNotiToAdmin['msg']="Reassign meeting confirmed for".$slotData->slot_date." at ".$slotData->time;
          $addNotiToAdmin['act_slug']=base_url().'admin/meeting_list';
          $addNotiToAdmin['status']=0;
          $addNotiToAdmin['dt']=date("Y-m-d H:i:s");
   
          notification($addNotiToAdmin);// For Admin 
   
              $encriptID= JKMencoder($slotData->id);
              $link='https://insaaf99.com/z/c/'.$encriptID;
              $link1='https://insaaf99.com/z/l/'.$encriptID;
         
              // Send SMS in Mobile Number start for client
  
$msg='Dear '.$clientName.' your appointment has been fixed @ '.$time.' meeting Date: '.$date.' meeting link: '.$link.'
Team Insaaf99';

send_sms($clientData->mobile,$msg);
              
                // Send SMS in Mobile Number end 

             // Send SMS in Mobile Number for client start
           
$message='Dear '.$lawyerName.' your appointment has been fixed @ '.$time.' meeting Date: '.$date.' meeting link: '.$link1.'
Team Insaaf99';

send_sms($lawyerData->mobile,$message);
             
             // Send SMS in Mobile Number end 


              /* send mail for client to sent meeting link */
                 $toEmail = $clientData->email; // client email 
                 $subject = "Hurray! Reassign a meeting";
              $heading="You have reassign meeting by Insaaf99.com";
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
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$date."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$time."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$link."'>Join Meeting</a></span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Note : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Your are requested to not share your email,mobile or any personal details with the lawyer</span></td>
                  </tr>
              </div>
            ";
             
             $message=get_email_temp($heading,$content);
             send_email_for_slot($toEmail, $subject, $message);
              /* end code for client to sent meeting link */
       
              
              /* send mail for Lawyer to sent meeting link */
              $toEmail = $lawyerData->email; // lawyer email 
              $subject = "Hurray! Reassign meeting ";
              $heading="You have reassign a meeting by Insaaf99.com";
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
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$date."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$time."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$link1."'>Join Meeting</a></span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
              <tr>
              <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Note : </td>
              <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Your are requested to not share your email,mobile or any personal details with the client</span></td>
              </tr>
          </div>
            ";
             
             $message=get_email_temp($heading,$content);
             send_email_for_slot($toEmail, $subject, $message);

              /* end code for Lawyer to sent meeting link */

               
              /* send mail for Admin to sent  meeting link */
                $toEmail = "admin@insaaf99.com,write2nmakkar@gmail.com,vinny@insaaf99.com"; //Admin email 
                $subject = "Reassign meeting successful";
              $heading="You have successfully reassign meeting";
              $content="
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$clientData->fname." ".$clientData->lname."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerData->fname." ".$lawyerData->lname."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$date."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$time."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$link."'>Join Meeting</a></span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$link1."'>Join Meeting</a></span></td>
                  </tr>
              </div>
            ";
             $message=get_email_temp($heading,$content);
             send_email_for_slot($toEmail, $subject, $message);
    
}
// nitification when reassign lawyer end

 // send mail , sms & notification to client, lawyer and admin on reschedule meeting start
    
  function reschedulemeet($clientData,$lawyer,$slotData,$post,$casecategoryData)
 {
    $clientName =str_replace(' ', '',$clientData->fname);
    $lawyerName =str_replace(' ', '',$lawyer->fname);

     $encriptID= JKMencoder($slotData->id);
     $C_link='https://insaaf99.com/z/c/'.$encriptID;
     $L_link='https://insaaf99.com/z/l/'.$encriptID;
     
         // Send SMS in Mobile Number start for client

$message='Dear '.$clientName.'
Your meeting has been rescheduled @ '.$post['meetingTime'].'
Meeting Date: '.$post['meetingDate'].'
Your meeting link: '.$C_link.'
Team Insaaf99';

send_sms($clientData->mobile,$message);

   
      
           // Send SMS in Mobile Number end 

        // Send SMS in Mobile Number for client start
      
$message='Dear '.$lawyerName.'
Your meeting has been rescheduled @ '.$post['meetingTime'].'
Meeting Date: '.$post['meetingDate'].'
Your meeting link: '.$L_link.'
Team Insaaf99';
 
          send_sms($lawyer->mobile,$message);
        // Send SMS in Mobile Number end 
     

   // for client notification
   $addNotiToClient=array();
   $addNotiToClient['user_type']=3;// for client
   $addNotiToClient['user_id']=$clientData->id;
   $addNotiToClient['subject']="Your Slot confirmed";
   $addNotiToClient['msg']="Your meeting date is ".$post['meetingDate'].'  at '.$post['meetingTime'];
   $addNotiToClient['act_slug']=base_url().'client/meeting';
   $addNotiToClient['status']=0;
   $addNotiToClient['dt']=date("Y-m-d H:i:s");

notification($addNotiToClient);

   $addNotiToLawyer=array();
   $addNotiToLawyer['user_type']=2;// for Lawyer
   $addNotiToLawyer['user_id']=$lawyer->id;
   $addNotiToLawyer['subject']="A New meeting assign you ";
   $addNotiToLawyer['msg']="A new meeting for ".$post['meetingDate']." at ".$post['meetingTime'];
   $addNotiToLawyer['act_slug']=base_url().'lawyer/meeting';
   $addNotiToLawyer['status']=0;
   $addNotiToLawyer['dt']=date("Y-m-d H:i:s");

   notification($addNotiToLawyer);// For Lawyer
 
   // for Admin notification
   $addNotiToAdmin=array();
   $addNotiToAdmin['user_type']=1;// for Admin
   $addNotiToAdmin['user_id']=2;
   $addNotiToAdmin['subject']="Meeting confirmed ";
   $addNotiToAdmin['msg']="A meeting confirmed for".$post['meetingDate']." at ".$post['meetingTime'];
   $addNotiToAdmin['act_slug']=base_url().'admin/meeting_list';
   $addNotiToAdmin['status']=0;
   $addNotiToAdmin['dt']=date("Y-m-d H:i:s");

   notification($addNotiToAdmin);// For Admin
  

     // email to client start***********************************************************************************************************************
   

     $toEmail= $clientData->email; // client email  
     $subject="Rescheduled Meeting on insaaf99.com";

     $heading="Your meeting is rescheduled now ";
     $content="
     <div style='margin-top:1px;'>
         <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer->fname." ".$lawyer->lname."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer ID: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer->lawyer_unique_id."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Case Category: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$casecategoryData->name."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Date : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$post['meetingDate']."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Time : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$post['meetingTime']."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$C_link."'>Join Meeting</a></span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
     <tr>
     <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Note : </td>
     <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Your are requested to not share your email,mobile or any personal details with the lawyer</span></td>
     </tr>
 </div>
   ";
    
    $message=get_email_temp($heading,$content);
    send_email_for_slot($toEmail, $subject, $message);
     // email to client end ***********************************************************************************************************************
    
     // email to lawyer start***********************************************************************************************************************
   

     $toEmail= $lawyer->email; // lawyer email  
     $subject="Assigned a meeting by Insaaf99.com";
     
     $heading="You have been Assigned a meeting by Insaaf99";
     $content="
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name: </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$clientData->fname." ".$clientData->lname."</span></td>
         </tr>
         </div>
         <div style='margin-top:1px;'>
         <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$clientData->client_unique_id."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
     <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Case Category: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$casecategoryData->name."</span></td>
         </tr>
         </div>
         <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Date : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$post['meetingDate']."</span></td>
         </tr>
         </div>
         <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Time : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$post['meetingTime']."</span></td>
         </tr>
         </div>
         <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$L_link."'>Join Meeting</a></span></td>
         </tr>
         </div>
         <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Note : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Your are requested to not share your email,mobile or any personal details with the client</span></td>
         </tr>
        </div>
         ";
    
         $message=get_email_temp($heading,$content);
         send_email_for_slot($toEmail, $subject, $message);
         // email to lawyer start***********************************************************************************************************************
         
         
     // email to Admin start***********************************************************************************************************************


     $toEmail= "admin@insaaf99.com,write2nmakkar@gmail.com,vinny@insaaf99.com"; // Admin email  
     $subject="Meeting scheduled with insaaf99.com";

     $heading="Your slot confirm by Insaaf99";
     $content="
     <div style='margin-top:1px;'>
         <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer->fname." ".$lawyer->lname."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer ID: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer->lawyer_unique_id."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$clientData->fname." ".$clientData->lname."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$clientData->client_unique_id."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
           <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Case Category: </td>
           <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$casecategoryData->name."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Date : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$post['meetingDate']."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Time : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$post['meetingTime']."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Meeting Link : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$C_link."'>Join Meeting</a></span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Meeting Link : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$L_link."'>Join Meeting</a></span></td>
         </tr>
     </div>
   ";
    
    $message=get_email_temp($heading,$content);
    send_email_for_slot($toEmail, $subject, $message);
     // email to Admin end ***********************************************************************************************************************

 }
 
 // send mail , sms & notification to client, lawyer and admin on reschedule meeting end
 

 //  Send Meeting remainder for lawyer notification start 
function ClientSlotBookPayment($clientFristName,$clientMobile){
    
$msg="Dear ".$clientFristName."
Your Payment has been successfully received. You will be contacted by our Team in a short while.
Team Insaaf99.com";

$res=  send_sms($clientMobile,$msg);
return $res;  
}
//  Send Meeting remainder notification end



//  Send Meeting remainder for client notification start 
function clientMeetingRemain($clintFirstName,$clientMobile,$slotID,$date,$time,$details){
$encriptID= JKMencoder($slotID);
$clientLink='https://insaaf99.com/z/c/'.$encriptID;

$msg="Hi ".$clintFirstName.", ready for the One-O-One consultation Today @ ".$time."
Meeting link: ".$clientLink."
A gentle reminder !
Insaaf99.com";
send_sms($clientMobile,$msg);

/* send mail for Client to book slot for Client */
$toEmail = $details->c_email; // Client email 
$subject = "Meeting Reminder ".$details->timediff." Minutes ";
$heading="Your Meeting will start in ". $details->timediff." "."Minutes ";
$content="
<div style='margin-top:1px;'>
    <tr>
    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->fname." ".$details->lname."</span></td>
    </tr>
</div>
<div style='margin-top:1px;'>
    <tr>
    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$date."</span></td>
    </tr>
</div>
<div style='margin-top:1px;'>
    <tr>
    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$time."</span></td>
    </tr>
</div>
<div style='margin-top:1px;'>
    <tr>
    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$clientLink."'>Join Meeting</a></span></td>
    </tr>
</div>
<div style='margin-top:1px;'>
<tr>
<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Note : </td>
<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Your are requested to not share your email,mobile or any personal details with the lawyer</span></td>
</tr>
</div>
";
$message=get_email_temp($heading,$content);
return send_email_for_slot($toEmail,$subject,$message);
}
//  Send Meeting remainder notification end




//  Send Meeting remainder notification for lawyer  start 
function lawyerMeetingRemain($lawyerFirstName,$lawyerMobile,$slotID,$date,$time,$details){

$encriptID= JKMencoder($slotID);
$lawyerLink='https://insaaf99.com/z/l/'.$encriptID;

$msg="Hi ".$lawyerFirstName.", ready for the One-O-One consultation Today @ ".$time."
Meeting link: ".$lawyerLink."
A gentle reminder !
Insaaf99.com";
send_sms($lawyerMobile,$msg);

/* send mail for Lawyer to book slot for Lawyer */

$toEmail =$details->l_email; // Lawyer email 
$subject = "Meeting Reminder ".$details->timediff." Minutes ";
$heading="Your Meeting will start in ". $details->timediff." "."Minutes ";
$content="
<div style='margin-top:1px;'>
    <tr>
    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->c_fname." ". $details->c_lname."</span></td>
    </tr>
</div>
<div style='margin-top:1px;'>
    <tr>
    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$date."</span></td>
    </tr>
</div>
<div style='margin-top:1px;'>
    <tr>
    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$time."</span></td>
    </tr>
</div>
<div style='margin-top:1px;'>
    <tr>
    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$lawyerLink."'>Join Meeting</a></span></td>
    </tr>
</div>
<div style='margin-top:1px;'>
<tr>
<td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Note : </td>
<td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Your are requested to not share your email,mobile or any personal details with the client</span></td>
</tr>
</div>
";
$message=get_email_temp($heading,$content);
return send_email_for_slot($toEmail, $subject, $message);

}
//  Send Meeting remainder notification end


 function documentationNotification($FormData,$categoryData,$grossPrice,$paymentLink){
    $subject = "Documentation confirmation";
    $toEmail = $FormData['addtional']['email'];
    // Send SMS to mobile start
$clientphone = explode(' ',trim($FormData['addtional']['mobile']));
$message='Thank you for showing your interest .Our team will contact you shortly.
Team Insaaf99.com';
                        
//  send_sms($clientphone[0],$message);
           
// Send SMS to mobile end

  $temp = documentationEmailTemp($FormData,$categoryData,$grossPrice,$paymentLink);
   send_email_for_slot($toEmail, $subject, $temp);
echo 1;
exit();
 }
?>