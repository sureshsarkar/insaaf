<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . '/libraries/MailController.php';


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Index extends MailController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
       // $this->load->model('admin/category_model');
  
        $this->load->library('base_library');
        date_default_timezone_set('Asia/Kolkata');
     }



    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index()
    {

        // required headers
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With,Access-Control-Allow-Origin, Accept");
  
        
        // Body Data ==================
         $data = json_decode(file_get_contents("php://input"));
          if(empty($data)){
            if(empty($_POST)){
                $data  =  new stdClass();
            }else{
                $data = json_decode(json_encode($_POST));
            }
          }else{
            $data = json_decode(json_encode($data));
          }

         



        // headers
            $headerData = $apache_headers= apache_request_headers();
            $myKey = '80898ajadsfjdsaf89ad456uug444sfsd8f9asfd989df89sfd8a8f9df';
            $receviApikey  = strval($data->apikey);
            $dataAction  = $data->action;
            if(!empty($headerData) && isset($receviApikey) && isset($dataAction) && $receviApikey == $myKey  ){
            //$data->apiKey = $headerData['apiKey'];
              $data->action = $dataAction;
            
            }else{
                $rData['error'] = "API Key Mistmatch!!";
                echo json_encode($rData);
                exit;
            }
        

          // Action Connect With Pages ===============================

          if($data->action == 'get_all_user' || $data->action == 'send_otp' || $data->action == 'set_video_callid' || $data->action == 'get_video_callid' || $data->action == 'find_dynamic' || $data->action == 'save' || $data->action == 'delete'|| $data->action == 'Get_client_details' || $data->action == 'updateMeetingStauts' || $data->action == 'raw_query' || $data->action == 'upload_file' || $data->action == 'otp_email' || $data->action == 'update_schedule' || $data->action == 'slot_booking_msg' || $data->action == 'call_push_notification' || $data->action == 'first_query_admin_notification' || $data->action == 'certificate_alert_msg' || $data->action == 'slot_booking_alert_msg' || $data->action == 'welcome_msg' || $data->action == 'get_block_date'){
            $apiFn    =  $data->action; 
            $returnFn = $this->$apiFn($data);
          }else{
            $rData['error'] = "Bad request...";
            echo json_encode($rData);
            exit;
          }


           // return -----------------------------------
            if(!isset($returnFn['success'])){
              $rData['error'] = $returnFn;
           }else{
              $rData = $returnFn;
           }
           echo json_encode($rData);   


    } // end index function





    // Get All Users *********************************************************
    function get_all_user($data){
        $this->load->model('admin/lawyer_model');
            $alluser = $this->lawyer_model->all();
            pre($alluser);
        $rData['success'] = 1;  
        $rData['returnVal'] = "This action blocked.";
        return $rData;
    }

    
    // end here function for client registration   *********************************************

     // code for send mobile otp 
    function send_otp($data){
            if(!isset($data->phone) || empty($data->phone)){
                return "Valid Phone Number Required";
            }
            $otp = rand(1231,7879);
            $sms='Your one Time OTP is : '.$otp.'
Team Insaaf99.com';
            send_sms($data->phone,$sms);

            $rData['success'] = 1;  
            $rData['returnVal'] = $otp;
            return $rData;
            
        
    }
    // end code for otp mobile
    

    // code for insertvideo call id 

    function set_video_callid($data){
        $this->load->model('admin/slot_model');
        if(!isset($data->video_id)){
            return $return =  "Meeting Id Required";        
        }else{
            $updateData = array();
            
            $type=$data->user_type;
            if($type=='client'){
                $updateData['client_meeting_id'] = $data->video_id;                
            }else{
                $updateData['lawyer_meeting_id'] = $data->video_id; 
            }
            $updateData['id'] = $data->slot_id;
           // pre($updateData);

            $updateStatus = $this->slot_model->save($updateData);
           // pre($updateStatus);

            if(!empty($updateStatus)){
                $rData['success'] = 1;  
                $rData['returnVal'] = json_decode(json_encode($updateData),true);
                return $rData;
            }else{
                $arr = "Something Went Wrong-- set_video_callid";
                return $arr;
            }
        }
    }

    // end code for insert video call id 


    // code for match video id 
    function get_video_callid($data){
        $this->load->model('admin/slot_model');
        if(!isset($data->slot_id)){
            return $return =  "Slot Id Required";        
        }else{
           
            $getData = $this->slot_model->find($data->slot_id);
            if(!empty($getData)){
                $rData['success'] = 1;  
                $rData['returnVal'] = json_decode(json_encode($getData),true);
                return $rData;
            }else{
                $arr = "Something Went Wrong -- get_video_callid";
                return $arr;
            }
        }
    }


    // end code for match video id 

      // code for get client  details 
      function Get_client_details($data){
      
        $this->load->model('admin/client_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/slot_model');
        if(!isset($data->slot_id) || empty($data->slot_id)){
            return $return =  "Slot Id Required";        
        } else{
            $slotBookingDetails = $this->slot_model->find($data->slot_id);
            if(!empty($slotBookingDetails)){
                $lawyerId=  $slotBookingDetails->lawyer_id;
                $clientId=  $slotBookingDetails->client_id;
                $ClientData = $this->client_model->find($clientId);
                $lawyerData = $this->lawyer_model->find($lawyerId);
               
                $getData = array(
                    0 => array(
                        'clientData' => $ClientData,
                        'lawyerData'=>$lawyerData
                    ),
                   
                );
            }
            
            if(!empty($getData)){
                
                $rData['success'] = 1;  
                $rData['returnVal'] = json_decode(json_encode($getData),true);
                return $rData;
            }else{
                $arr = "Something Went Wrong -- Get_client_details";
                return $arr;
            }            
        }
    }

    // end code for get client details

    // code for update meeting status 

    function updateMeetingStauts($data){
        $this->load->model('admin/client_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/slot_model');
        if(!isset($data->slot_id) || empty($data->slot_id)){
            return $return =  "Slot Id Required";        
        } else{
           $updateData = array();
           $updateData['id'] = $data->slot_id;
           $updateData['MeetingStatus'] =   2;
           $updateData['MeetingStatusUpdateTime'] = date('Y-m-d H:i:s');
           $updateStatus = $this->slot_model->save($updateData);
            $rData['success'] = 1;  
            $rData['returnVal'] = json_decode(json_encode($updateData),true);
            return $rData;
        }   
    }

    // Update Schedule ============================================================

    function update_schedule($data){
      
        $this->load->model('admin/lawyer_scheduler_model');
        if(!isset($data->lawyer_id)){
            return $return =  "Lawyer Id Required";        
        }else  if(!isset($data->schedule_data)){
            return $return =  "Schedule Data Required";        
        } else{
           $w['lawyer_id']  = $data->lawyer_id;

           $sData = $this->lawyer_scheduler_model->findDynamic($w);
           $updateArr = array();
           foreach($sData as $key => $value) {
            $updateArr[strtolower($value->schedule_day)] = $value;
           }

           //  schedule data
           $update = 0;
           $myData = base64_decode($data->schedule_data);
           $myData = json_decode($myData,true);

           //return $myData; 

           foreach ($myData as $key => $value) {
               $w = array(); 
               $w['lawyer_id'] = $data->lawyer_id;
               $w['schedule_day'] = ucfirst($key);
               $w['schedule_time'] = json_encode($value);
               $w['schedule_status'] = 1;



               if(isset($updateArr[strtolower($key)])){
                $w['id'] = $updateArr[strtolower($key)]->id;
               
                // update
               }

               $updateDb = $this->lawyer_scheduler_model->save($w);
               $update = 1;
           }

           // update user details 
           if(isset($data->profile_complete)){
               $this->load->model('admin/lawyer_model');
               $w = array();
               $w['id'] = $data->lawyer_id;
               $w['profile_complete'] = 60;
               $updateStatus = $this->lawyer_model->save($w);
           }

          

           
            if(!empty($update)){
                $rData['success'] = 1;  
                $rData['returnVal'] = "Success";
                return $rData;
            }else{
                $arr = "Something Went Wrong--";
                return $arr;
            }
        }   
    }


    // Send email & message when booked a slot ============================================================

    function slot_booking_msg($data){
        if(!isset($data->user_id)){
            return $return =  "Client Id Required";        
        }else  if(!isset($data->lawyer_id)){
            return $return =  "Lawyer ID Required";  
        }else  if(!isset($data->slot_id)){
            return $return =  "Slot ID  Required";        
        } else{
            $this->load->model('admin/slot_model');    
            // get slot data
            $w = array();
            $w['table']  = 'slot';
            $w['id']  = $data->slot_id;
            
            $slotData = $this->slot_model->findDynamic($w);
            if(empty($slotData)){
                return "Slot Id Mist match";
            }

            $slotData = $slotData[0];

            // get user  data
            $w = array();
            $w['table']  = 'clint';
            $w['id']  = $data->user_id;
            
            $clientData = $this->slot_model->findDynamic($w);
            if(empty($slotData)){
                return "User Id Mist match";
            }

            $clientData = $clientData[0];

            // get Lawyer data
            if(!empty($lawyer_id)){
                $w = array();
                $w['table']  = 'lawyer';
                $w['id']  = $data->lawyer_id;
                
                $lawyerData = $this->slot_model->findDynamic($w);
                if(empty($slotData)){
                    return "User Id Mist match";
                }

                $lawyerData = $lawyerData[0];
            }else{
                $lawyerData;
            }

            $this->load->helper('send_slot_notification_helper');
            //nitification_when_book_slot($clientData,$lawyerData,$slotData);

            $rData['success'] = 1;  
            $rData['returnVal'] = "Success";
            return $rData;
           
           
        }   
    }


    // Push Notification ============================================================

    function call_push_notification($data){
            if(!isset($data->user_id)){
                return "user_id required";
            }else if(!isset($data->user_type)){
                return "user_type required";
            }else if(!isset($data->msg_title)){
                return "msg_title required";
            }else if(!isset($data->msg_body)){
                return "msg_body required";
            }

            $notification_for = 'Video Call';
            $rApi = api_push_notification(json_encode($data));
            $rData['success'] = 1;  
            $rData['returnVal'] = $rApi;
            return $rData;
    }


    // Push Notification ============================================================

    function first_query_admin_notification($data){
            if(!isset($data->user_id)){
                return "user_id required";
            }else if(!isset($data->query_id)){
                return "query_id required";
            }

            $this->load->model('admin/client_model');
            $this->load->model('admin/client_query_model');

            $this->load->helper('notifications_helper');

            // get client details 
            $client =$this->client_model->find($data->user_id);
            $query =$this->client_query_model->find($data->query_id);
            

            if(empty($client) || empty($query)){
                return 'Query Admin notification, Something Went Wrong';
            }
            query_request_admin_message($client,$query);

            

            // $notification_for = 'Video Call';
            // $rApi = api_push_notification(json_encode($data));
            $rData['success'] = 1;  
            $rData['returnVal'] = 'success';
            return $rData;
    }

    // API Function if required ============================================================

     // Certificate Mail,msg, notification ============================================================

    function certificate_alert_msg($data){
            if(!isset($data->user_id)){
                return "user_id required";
            }else if(!isset($data->certificate_id)){
                return "certificate_id required";
            }else if(!isset($data->payment_id)){
                return "payment_id required";
            }

            $this->load->model('admin/client_model');
            $this->load->model('admin/certificate_model');
            $this->load->model('admin/payment_model');

            $this->load->helper('notifications_helper');

            // get client details 
            $client =$this->client_model->find($data->user_id);
            
            
            $certificate =$this->certificate_model->rawQuery("SELECT c.*, sc.sub_sub_category_name as name, sc.sub_sub_category_name  FROM docx_certificate as c LEFT JOIN `sub_sub_category` sc ON sc.id = c.doc_id  WHERE c.id = '".$data->certificate_id."'");
            $payment =$this->payment_model->find($data->payment_id);
            

            if(empty($client) || empty($certificate) || empty($payment)){
                return 'Mail Notification Something Went Wrong';
            }
            $certificate = $certificate[0];


            // admin mail
            certificate_request_admin_message($client,$certificate,$payment);

            // client
            //client_mail($client,$certificate,$payment);


            // $notification_for = 'Video Call';
            // $rApi = api_push_notification(json_encode($data));
            $rData['success'] = 1;  
            $rData['returnVal'] = 'success';
            return $rData;
    }


    // Slot Booking Mail,msg, notification ============================================================

    function slot_booking_alert_msg($data){
            if(!isset($data->user_id)){
                return "user_id required";
            }else if(!isset($data->slot_id)){
                return "slot_id required";
            }else if(!isset($data->payment_id)){
                return "payment_id required";
            }

            $this->load->model('admin/client_model');
            $this->load->model('admin/slot_model');
            $this->load->model('admin/payment_model');

            $this->load->helper('notifications_helper');

            // get client details 
            $client =$this->client_model->find($data->user_id);
            $slot =$this->slot_model->rawQuery("SELECT s.*,c.case_description, cc.name  FROM slot as s LEFT JOIN `cases` c ON c.id = s.case_id LEFT JOIN case_category as cc ON cc.id = c.case_category_id  WHERE s.id = '".$data->slot_id."'");
            $payment =$this->payment_model->find($data->payment_id);
            
           
            if(empty($client) || empty($slot) || empty($payment)){
                return 'Mail Notification Something Went Wrong';
            }
            $slot = $slot[0];


            // admin mail
            slot_booking_admin_message($client,$slot,$payment);

            // client
            //client_mail($client,$certificate,$payment);


            // $notification_for = 'Video Call';
            // $rApi = api_push_notification(json_encode($data));
            $rData['success'] = 1;  
            $rData['returnVal'] = 'success';
            return $rData;
    }


     // Welcome Message ============================================================

    function welcome_msg($data){
            if(!isset($data->user_id)){
                return "user_id required";
            }else if(!isset($data->type)){
                return "type required";
            }

            $this->load->model('admin/client_model');
            $this->load->model('admin/lawyer_model');
            

            // get client details 
            if(strtolower($data->type) == 'client'){
                $user =$this->client_model->find($data->user_id);    
            }else{
                $user =$this->lawyer_model->find($data->user_id);    
            }
            $msg='Congratulations!
You have Successfully Registered into Insaaf99.com
Please refer your Registered Mail ID for more info';
                
            send_sms($user->mobile,$msg);


            $rData['success'] = 1;  
            $rData['returnVal'] = 'success';
            return $rData;
    }

    


    // Dynamic Querys ======================================================================
    // find Dynamic *********************************************************
    function find_dynamic($data){
        $this->load->model('admin/lawyer_model');

        if(!isset($data->table) ){
            return $return =  "Table Name Required";        
        }


        $w = json_decode(json_encode($data),true);
        unset($w['apikey']);
        unset($w['action']);

        $result = $this->lawyer_model->findDynamic($w);
        if(empty($result))
        {
            return "No have data";
        }

        $rData['success'] = 1;  
        $rData['returnVal'] = json_decode(json_encode($result),true);
        return $rData;
    }


    // Save & Update *********************************************************
    function save($data){
        if(!isset($data->model) && !isset($data->model_location) ){
            return $return =  "Model Required";        
        }

        $this->load->model($data->model_location);
        $myModel = $data->model;



        $w = json_decode(json_encode($data),true);
        unset($w['apikey']);
        unset($w['action']);
        unset($w['model']);
        unset($w['model_location']);
        if(isset($w['other_action'])){
            $other_action = $w['other_action'];
            unset($w['other_action']);
        }



        $result = $this->$myModel->save($w);

        // other action function 
        if(isset($other_action) && $other_action == '_enquiry_notification'){
            $s = array('id' => empty($w['parent_id'])?$result:$w['parent_id']);
            $eData =  $this->$myModel->findDynamic($s);
            $eData = $eData[0];

            // get lawyer || client Name 
            $tempUserID = ($w['type'] == 'lawyer')?$eData->assign_lawyer:$eData->user_id;
            $s = array('table' => ($w['type'] == 'client')?'clint':'lawyer','id' => $tempUserID,'field'=>'fname,lname');
            $uData = $this->$myModel->findDynamic($s);
            $name = empty($uData)?'':trim($uData[0]->fname).' '.trim($uData[0]->lname);
           
            // send notification
            $tempUserID = ($w['type'] == 'client')?$eData->assign_lawyer:$eData->user_id;
            $arr = array('user_id' => $tempUserID,'user_type' => $w['type'],'msg_title' => $name. ' ('.ucfirst($w['type']).')','msg_body' => $w['msg'],'navi_screen' => 'query'); 
            $r = $this->call_push_notification(json_decode(json_encode($arr)));
           
        }
        
        $rData['success'] = 1;  
        $rData['returnVal'] = json_decode(json_encode($result),true);
        return $rData;
    }


    // Delete *********************************************************
    function delete($data){
        if(!isset($data->model) && !isset($data->model_location) ){
            return $return =  "Model Required";        
        }else if(!isset($data->delete_id)){
            return "Delete Id Required";
        }

        $this->load->model($data->model_location);
        $myModel = $data->model;

        $result = $this->$myModel->delete($data->delete_id);

        $rData['success'] = 1;  
        $rData['returnVal'] = json_decode(json_encode($result),true);
        return $rData;
    }
    // End Dynamic Query======================================================================


    // Raw Query *********************************************************
    function raw_query($data){
        if(!isset($data->sql)){
            return $return =  "SQL Query Required";        
        }
        $this->load->model('admin/lawyer_model');

        $result = $this->lawyer_model->rawQuery($data->sql);
        $rData['success'] = 1;  
        $rData['returnVal'] = json_decode(json_encode($result),true);
        return $rData;
    }
    // End Raw Query======================================================================


    // upload File *********************************************************
    function upload_file($data){
        if(!isset($data->encoded_file)){
            return $return =  "Base64 file required";        
        }
        
        $imgdata = base64_decode($data->encoded_file);
        //return $data->encoded_file;
        $f = finfo_open();
        $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);

        if($mime_type == 'image/jpeg'){
          $extention = ".jpeg";
        }else if($mime_type == 'image/jpg'){
          $extention = ".jpg";
        }else if($mime_type == 'image/png' || $mime_type == 'image/PNG'){
          $extention = ".png";
        }else if($mime_type == 'text/plain'){
          $extention = ".pdf";
        }else if(strpos($mime_type, 'application') !== false) {
            $extention = ".pdf";
        }

       $_fileName = "insaaf_".uniqid().$extention;
       $fileName = isset($data->save_location)?$data->save_location.$_fileName:"uploads/docs/".$_fileName;   
       
       $base64_string = $data->encoded_file;
       file_put_contents($fileName, base64_decode($base64_string));

       $result['file_location'] = base64_encode($fileName);

        $rData['success'] = 1;  
        $rData['returnVal'] = $rData['returnVal'] = json_decode(json_encode($result),true);
        return $rData;
    }
    // End Upload file Query======================================================================


     // Send OTP Mail *********************************************************
    function otp_email($data){
        if(!isset($data->email)){
            return $return =  "Email Id required";        
        }
        
        $emailAddress = $data->email;
            $otp    = mt_rand(1111, 9999);
            $subject    ="Email Verification OTP ";
            $message    = "Please Verify your email <br/> Your OTP IS ".$otp;
            $sendStatus = $this->send_email($data->email,$subject,$message);
            if($sendStatus==1){
               $result['otp'] = $otp;
            }else{
                return "Verification otp sending faild, Please contact with Administrator!!";
            }
       

        $rData['success'] = 1;  
        $rData['returnVal'] = $result['otp'];
        return $rData;
    }
    // End Upload file Query======================================================================


// Get block date and Time
    function get_block_date($data){
        $this->load->model('admin/slot_model');
        if(!isset($data->table)){
            return $return =  "Table name is Required";        
        }else{
           $w['table'] = $data->table;
            $getData = $this->slot_model->findDynamic($w);
            if(!empty($getData)){
                // return json_decode(json_encode($getData),true);
                $rData['success'] = 1;  
                $rData['returnVal'] = json_decode(json_encode($getData),true);
                return $rData;
            }else{
                $arr = "Something Went Wrong -- get_video_callid";
                return $arr;
            }
        }
    }

// Get block date and Time End


}

?>