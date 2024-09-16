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
class Slot_expire extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('lawyer/Hearing_date_model');
        $this->load->model('client/client_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        $this->load->model('client/Case_details_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/Slot_model');
        
    }
    
    /**
     * This function used to load the first screen of the user
     */
    
    public function index()
    {

        $sql = "SELECT  * FROM slot"; 
        $sql .=" WHERE `slot_status`=1 AND `expire_status` =0 AND `MeetingStatus`=0";
        $slot_date= $this->Slot_model->rawQuery($sql);

        if(!empty($slot_date)){
            foreach($slot_date as $slot){
               $mtime=strtotime($slot->meeting_time);

            //    $CTime=date('Y-m-d H:i:s');
            //      $curentTime=date(strtotime($CTime));
            //       echo $diff= round(($mtime - $curentTime) / 60,2). " minute";

                $diff = dateDiffMin($slot->meeting_time,date("Y-m-d H:i:s"));

                $sql = "SELECT  slot.* FROM slot"; 
                $sql .=" WHERE '".$diff."' < 1  AND `slot_status`=1 AND `expire_status`=0 AND `MeetingStatus`=0 ";
                $data1['update_slot_status'] = $this->Slot_model->rawQuery($sql);
                // pre($data1['update_slot_status']);
                // exit();
                if(!empty($data1['update_slot_status'])){
                    foreach($data1['update_slot_status'] as $slotData){
                      
                        $clientID=$slotData->client_id;
                  
                        $sql1 = "SELECT  * FROM clint"; 
                        $sql1 .=" WHERE `id`='".$clientID."'";
                        $cData = $this->client_model->rawQuery($sql1);
                        $clientData=$cData[0];

                        $lawyerID=$slotData->lawyer_id;
                        $sql1 = "SELECT  * FROM lawyer"; 
                        $sql1 .=" WHERE `id`='".$lawyerID."'";
                        $lData = $this->lawyer_model->rawQuery($sql1);
                        $lawyerData=$lData[0];
 
                        $updateData['id']=$slotData->id;
                        $updateData['expire_status']=1;
                        $updateData['reply']='Please book your slot again';

                        $this->Slot_model->save($updateData);// update slot table
                 
                      if (!empty($clientData) && !empty($lawyerData) && $result=1) {
                       
                        $addNotiToClient=array();
                        $addNotiToClient['user_type']=3;// for client
                        $addNotiToClient['user_id']=$clientData->id;
                        $addNotiToClient['subject']="Your slot was expired";
                        $addNotiToClient['msg']="Please book your slot again for a different time schedule";
                        $addNotiToClient['act_slug']='https://insaaf99.com/client/meeting';
                        $addNotiToClient['status']=0;
                        $addNotiToClient['dt']=date("Y-m-d H:i:s");
                 
                        notification($addNotiToClient); // For client

                        $addNotiToLawyer=array();
                        $addNotiToLawyer['user_type']=2;// for Lawyer
                        $addNotiToLawyer['user_id']=$lawyerData->id;
                        $addNotiToLawyer['subject']="A slot was expired";
                        $addNotiToLawyer['msg']="Your slot was expired because of not done video call";
                        $addNotiToLawyer['act_slug']='https://insaaf99.com/lawyer/meeting';
                        $addNotiToLawyer['status']=0;
                        $addNotiToLawyer['dt']=date("Y-m-d H:i:s");
                 
                        notification($addNotiToLawyer); // For Lawyer
                  
                        $addNotiToAdmin=array();
                        $addNotiToAdmin['user_type']=1;// for Admin
                        $addNotiToAdmin['user_id']=2;
                        $addNotiToAdmin['subject']="A slot was expired";
                        $addNotiToAdmin['msg']="Slot was expired booked for ".$slotData->slot_date." at ".$slotData->time;// for Admin
                        $addNotiToAdmin['act_slug']='https://insaaf99.com/admin/case_details';
                        $addNotiToAdmin['status']=0;
                        $addNotiToAdmin['dt']=date("Y-m-d H:i:s");
                 
                       notification($addNotiToAdmin);// For Admin
                       
                       clientMeetingExpire($clientData,$lawyerData,$slotData);// call function to send email
                       lawyerMeetingExpire($clientData,$lawyerData,$slotData);// call function to send email
                    }
                     
                    }
                }
            }
        }
    }


    // Meeting Remainder

    public function expire_soon()
    {
        $curentTime          = date("Y-m-d H:i:s");

        $sql = "SELECT  *,s.id as s_id , l.email as l_email,l.mobile as l_mobile,l.fname,l.lname,c.fname as c_fname,c.lname as c_lname,c.email as c_email,c.mobile as c_mobile, TIMESTAMPDIFF(MINUTE, '".$curentTime."', `meeting_time`) as timediff  FROM slot as s"; 
        $sql .= " JOIN lawyer as l ON l.id = s.lawyer_id "; //Fetch lawyer detail from Lawyer table using Id
        $sql .= " JOIN clint as c ON c.id = s.client_id "; //Fetch client detail from clint table using Id
        $sql .=" WHERE  TIMESTAMPDIFF(MINUTE, '".$curentTime."', `meeting_time`) < 30 AND  TIMESTAMPDIFF(MINUTE, '".$curentTime."' , `meeting_time`) > 1  AND `slot_status`=1  AND `remain_status`=0 AND `MeetingStatus`=0 ";
        $data1['meeting_time'] = $this->Slot_model->rawQuery($sql);
     
// pre($data1['meeting_time']);
// exit();
        if(isset($data1['meeting_time']) && !empty($data1['meeting_time'])){
            foreach($data1['meeting_time'] as $details){
            
                
            //   if($details->timediff <= 30){
           
                $updata['id'] = $details->s_id;
                $updata['remain_status'] = 1;
                        
               $this->Slot_model->save($updata);// update remain_status
         
            $lawyer_name=$details->fname.' '. $details->lname;
            $client_name=$details->c_fname.' '. $details->c_lname;
           
        


            $clintFirstName=$details->c_fname;
            $clientMobile=$details->c_mobile;
            $slotID=$details->s_id;
            $lawyerFirstName=$details->fname;
            $lawyerMobile=$details->l_mobile;
            $date=date("Y-m-d",strtotime($details->meeting_time));
            $time=date("h:i a",strtotime($details->meeting_time));

            $encriptID= JKMencoder($slotID);
            $lawyerLink='https://insaaf99.com/z/l/'.$encriptID;
            $clientLink='https://insaaf99.com/z/c/'.$encriptID;
      
            clientMeetingRemain($clintFirstName,$clientMobile,$slotID,$date,$time,$details);//call client meeting remain sms & email function
            
            lawyerMeetingRemain($lawyerFirstName,$lawyerMobile,$slotID,$date,$time,$details);//call lawyer meeting remain sms & email function
        
                /* send mail for Admin to book slot for Admin */
                $toEmail="admin@insaaf99.com,write2nmakkar@gmail.com,vinny@insaaf99.com";// admin email
                $subject = "Meeting Reminder ". $details->timediff." "."Minutes ";
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
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Meeting Link : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$lawyerLink."'>Join Meeting</a></span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Meeting Link : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$clientLink."'>Join Meeting</a></span></td>
                    </tr>
                </div>
              ";
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);
               
                /* end code for Admin to book slot  send email */
        // }
    }
    }
       
        
    }
}

?>