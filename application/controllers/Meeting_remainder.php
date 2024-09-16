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
class Meeting_remainder extends BaseController
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
        $this->load->model('admin/Case_details_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/Slot_model');
        
        // $this->isUserLoggedIn();
        
    }
    
    /**
     * This function used to load the first screen of the user
     */
    
    
    public function expire_soon()
    {
       
        date_default_timezone_set("Asia/Calcutta");
        
        $curentTime          = date("Y-m-d H:i:s");

        $sql = "SELECT  *,s.id as s_id , l.email as l_email,l.mobile as l_mobile,l.fname,l.lname,c.fname as c_fname,c.lname as c_lname,c.email as c_email,c.mobile as c_mobile, TIMESTAMPDIFF(MINUTE, '".$curentTime."', `meeting_time`) as timediff  FROM slot as s"; 
        $sql .= " JOIN lawyer as l ON l.id = s.lawyer_id "; //Fetch lawyer detail from Lawyer table using Id
        $sql .= " JOIN clint as c ON c.id = s.client_id "; //Fetch client detail from clint table using Id
        $sql .=" WHERE  TIMESTAMPDIFF(MINUTE, '".$curentTime."', `meeting_time`) < 30  AND  TIMESTAMPDIFF(MINUTE, '".$curentTime."' , `meeting_time`) > 1  AND `slot_status`=1  ";
        $data1['meeting_time'] = $this->Slot_model->rawQuery($sql);
        pre($data1['meeting_time']);
        exit();

        if(isset($data1['meeting_time']) && !empty($data1['meeting_time'])){
            foreach($data1['meeting_time'] as $details){
               
            $lawyer_name=$details->fname.' '. $details->lname;
            $client_name=$details->c_fname.' '. $details->c_lname;
            $details->l_email;
            $details->c_email;
            $details->l_mobile;
            $details->c_mobile;
            $details->s_id;
            // exit();
            if (!empty($details->c_email)) {
           

                $encriptID= JKMencoder($details->s_id);
$link= 'https://insaaf99.com/z/c/'.$encriptID;
// $link= base_url().'z/'.$encriptID;
                $time=date("h:i a",strtotime($details->time));
                $clientname = explode(' ',trim($details->c_fname));
//                 $msg='Dear '.$clientname[0].' your meeting have been scheduled today at '.$time.'
// Zoom ID : '.$details->zoom_link_id.'
// Meeting Password : '.$details->zoom_password.'
// Meeting Link: '.$link;
$slot_date="today";

$msg='Hurray!
Our Expert Lawyer has confirmed for one to one session requested by you on '.$slot_date.' at '.$time.'
Meeting Link: '.$link;


                // send_sms($details->c_mobile,$msg);
             
                  $encriptID= JKMencoder($details->s_id);
                  $link= 'https://insaaf99.com/z/l/'.$encriptID;
                //   $link= base_url().'z/l/'.$encriptID;
                $lawyername = explode(' ',trim($details->fname));
//                 $msg='Dear '.$lawyername[0].' your meeting have been scheduled today at '.$time.'
// Zoom ID : '.$details->zoom_link_id.'
// Meeting Password : '.$details->zoom_password.'
// Meeting Link: '.$link;
$details->l_mobile="9511060074";

              $msg='Insaaf99 has successfully created meeting Link on '.$slot_date.' at '.$time.'
Meeting Link: '.$link;


                send_sms($details->l_mobile,$msg);

                /* send mail for Client to book slot for Client */
                $toEmail = $details->c_email; // Client email 
                $subject = "Meeting Remainder ".$details->timediff." Minutes ";
              $heading="Your Meeting will start within ". $details->timediff." "."Minutes ";
              $content="
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer_name."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->slot_date."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->time."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Period :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->period."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$details->zoom_link."'>Join Meeting</a></span></td>
                  </tr>
              </div>
            ";
             $message=get_email_temp($heading,$content);
             $this->send_email($toEmail, $subject, $message);
              
                /* end code for Lawyer to book slot  send email */
            }
            if (!empty($details->l_email)) {
                
                //  $msg='';
                
                //   $response = send_sms($details->l_mobile,$msg);

                /* send mail for Lawyer to book slot for Lawyer */

              $toEmail = $details->l_email; // Lawyer email 
              $subject = "Meeting Remainder ".$details->timediff." Minutes ";
              $heading="Your Meeting will start within ". $details->timediff." "."Minutes ";
              $content="
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client_name."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->slot_date."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->time."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Period :</td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->period."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$details->zoom_link."'>Join Meeting</a></span></td>
                  </tr>
              </div>
            ";
             $message=get_email_temp($heading,$content);
             $this->send_email($toEmail, $subject, $message);

                
                /* end code for Lawyer to book slot  send email */
            }
                /* send mail for Admin to book slot for Admin */
              $toEmail = "adnin@insaaf99.com"; // Admin email 
                $subject = "Zoom Meeting Remainder ". $details->timediff." "."Minutes ";
                $heading="Your Meeting will start within ". $details->timediff." "."Minutes ";
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer_name."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client_name."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->slot_date."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->time."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Period :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$details->period."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$details->zoom_link."'>Join Meeting</a></span></td>
                    </tr>
                </div>
              ";
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);

                
                /* end code for Admin to book slot  send email */
            

        }
    }
       
        
    }
 
 
    // Show al case list end 
  
    
  
    
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'UP70 : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL, 'client');
    }
}

?>
