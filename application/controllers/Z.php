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
class Z extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        // $this->isUserLoggedIn();
        $this->load->model('Base_model');
        $this->load->model('lawyer/Hearing_date_model');
        $this->load->model('client/Client_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        $this->load->model('client/Case_details_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/Slot_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('front/orders_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Lawyer_scheduler_model');
        $data['case_category1']=$this->Case_category_model->all();

    
    }

    

    public function l($id = NULL)
    {
        $TeamsMeetingLink = "";
        date_default_timezone_set("Asia/Kolkata");
        
        if(isset($_GET['t']) && $_GET['t'] == 'b'){
            $id=base64_decode($id);
        }else{
            $id=JKMdecoder($id);// decode function
        }

        if(isset($id) && !empty($id)){
           
            $sql="SELECT * FROM `slot`  WHERE `id`='".$id."'";
            $rData= $this->Slot_model->rawQuery($sql);

            $type="lawyer";//base64_encode('lawyer');

            if(isset($rData[0]) && !empty($rData[0])){
                $link= $rData[0];
                $slotId=$link->id;//base64_encode($link->id);
                $userId=$link->lawyer_id;//base64_encode($link->lawyer_id);
                $TeamsLink = json_decode($link->teamsdata,true);
                if( empty($TeamsLink['meetinglink'])){
                    echo 'Something went worng contact admin.';
                    exit;
                }else{
                    $TeamsMeetingLink =  $TeamsLink['meetinglink'];
                }
                // $meetingLink =   meet_link($type,$slotId,$userId);
                    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                    $CDT=strtotime(date('Y-m-d H:i:s'));
                    $meetTimeInS = strtotime($link->meeting_time);
                    $meetTPlusOne=$meetTimeInS+3600;
                    $timeDiff=$meetTPlusOne-$CDT;
                 
                    if($CDT<$meetTimeInS || $timeDiff>0){
                    
                    include_once 'meeting_timer.php';
                    //  Add Counter here 
                     echo ' 
                     <div class="mbody">
                           <div class="meeting_body">
                             <img src="'.base_url().'assets/images/law_logo.png" alt="" style="width:78px;">
                             <h2 class="__meet">Your Meeting will start after</h2>
                             <p id="demo"></p>
                           </div>
                           </div>
                           
                           ';
       
                    }else{
                        $message="Your Meeting Time Out";
                        include_once '404.php';
                        echo $templete;
                    }
            }else{
                 $message="Invalid URL";
                 include_once '404.php';
                 echo $templete;
                 }
      
        }else{
            $message="Invalid URL";
            include_once '404.php';
            echo $templete;
             }
    
    }

    public function c($id = NULL)
    {
        $TeamsMeetingLink = "";

       //$id=JKMdecoder($id);
        if(isset($_GET['t']) && $_GET['t'] == 'b'){
            $id=base64_decode($id);
        }else{
            $id=JKMdecoder($id);// decode function
        }


        if(isset($id) && !empty($id)){
            $sql="SELECT * FROM `slot`  WHERE `id`='".$id."'";
            $rData= $this->Slot_model->rawQuery($sql);
            
            $type="client";//base64_encode('client');
            if(isset($rData[0]) && !empty($rData[0])){
                $link= $rData[0];
                $TeamsLink = json_decode($link->teamsdata,true);
                if(empty($TeamsLink['meetinglink'])){
                    echo 'Something went worng contact admin.';
                    exit;
                }else{
                    $TeamsMeetingLink =  $TeamsLink['meetinglink'];
                }
               
                $slotId=$link->id;//base64_encode($link->id);
                $userId=$link->client_id;//base64_encode($link->client_id);
                // $meetingLink =   meet_link($type,$slotId,$userId);
                    date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                    $CDT=strtotime(date('Y-m-d H:i:s'));
                     $link->meeting_time;
                    $meetTimeInS = strtotime($link->meeting_time);
                    $meetTPlusOne=$meetTimeInS+3600;
                     $timeDiff=$meetTPlusOne-$CDT;

                 
                    if($CDT<$meetTimeInS || $timeDiff>0){
                    include_once 'meeting_timer.php';
                    //  Add Counter here 
                     echo '
                       <div class="mbody">
                         <div class="meeting_body">
                             <img src="'.base_url().'assets/images/law_logo.png" alt="" style="width:78px;">
                             <h2 class="__meet">Your Meeting will start after</h2>
                             <p id="demo"></p>
                          </div>
                          </div>
                           ';
       
                    }else{
                        $message="Your Meeting Time Out";
                        include_once '404.php';
                        echo $templete;
                    }
            }else{
                $message="Invalid URL";
                include_once '404.php';
                echo $templete;
                 }
      
        }else{
            $message="Invalid URL";
            include_once '404.php';
            echo $templete;
             }
    
    }
 

}

?>