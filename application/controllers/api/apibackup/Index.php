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

          if($data->action == 'get_all_user' || $data->action == 'client_registraion' || $data->action == 'send_otp' || $data->action == 'set_video_callid' || $data->action == 'get_video_callid' || $data->action == 'find_dynamic' || $data->action == 'save' || $data->action == 'delete'){
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

    // function for client registration   *********************************************

    function client_registraion($data)
    {
        $this->load->model('admin/client_model');
        if(!isset($data->fname) || empty($data->fname)  ){
            return $return =  "Name required.";        
        }else if(!isset($data->mobile) ||  empty($data->mobile) ){
            return $return =  "Phone Number required.";        
        } else if(!isset($data->email) ||  empty($data->email) ){
            return $return =  "Email Address required.";        
        } else if(!isset($data->password) ||  empty($data->password) ){
            return $return =  "Password required.";        
        }


        // check for email exit or not  ********************************
        $email    = $data->email;
        $columnname = 'email';
        $email_status   =    $this->checkuserexit($columnname,$email);

        $mobile    = $data->mobile;
        $columnname = 'mobile';
        $mobile_status   =    $this->checkuserexit($columnname,$mobile);
        if(!empty($email_status) || !empty($mobile_status)) {
            if (!empty($mobile_status) && !empty($email_status)) {
                $arr = array ('status'=>0,'message'=>'Email or  mobile Number Already Exits ');
                return $arr;
            } else if (!empty($mobile_status)) {
                $arr = array ('status'=>0,'message'=>'Mobile number alrady exist !');
                return $arr;

            } else if (!empty($email_status)) {
                $arr = array ('status'=>0,'message'=>'Email number alrady exist !');
                return $arr;
            }
        }else{
            $insertData = array();
            $insertData['fname']   = $data->fname;
            if(!empty($data->lname)){
                $insertData['lname']   = $data->lname;
            }
            $insertData['mobile']   = $data->mobile;
            $insertData['email']   = $data->email;
            $insertData['password']   = $data->password;
            $insertData['f_pay_free']  = 0;
            $insertData['status']      = 1;
            $insertData['dt']          = date('Y-m-d H:i:s');
            $insertedID = $this->client_model->save($insertData);
            if(!empty($insertedID)){
                // code for update client unique id ********************************
                $updateData = array();
                $updateData['client_unique_id']     =  'INSAAF99-'.$insertedID; 
                $updateData['id']                   =  $insertedID;
                $updateStatu = $this->client_model->save($updateData);
                $insertData['id']                   = $insertedID;
                $insertData['UniqueID']             = $updateData['client_unique_id'];
                // end code for update client unique id  ********************************
                
                // code for send mail and message  ********************************

                // Send SMS in Mobile Number start 
                $message='Congratulations!
                You have Successfully Registered into Insaaf99.com
                Please refer your Registered Mail ID for more info';

                //$response = send_sms($insertData['mobile'],$message);

                // Send SMS in Mobile Number end  

                // send email for admin when user register success ********************************

                $toEmail = "ajitkp18@gmail.com"; // admin email 
                $subject = "New Clint Registered ";
                $this->send_mail_admin_client_reg($toEmail,$subject,$insertData);

                // end email for admin when user register success 
                        
                $toEmail = $insertData['email']; 
                $subject = "Registered Successfully ";
                $this->send_mail_client_reg($toEmail,$subject,$insertData);

                // end code for send mail and message 

                $rData['success'] = 1;  
                $rData['returnVal'] = json_decode(json_encode($insertData),true);
                return $rData;
            }else{
                $arr = array ('status'=>0,'message'=>'Something Went Wrong');
                return $arr;
            }      
        }
        // end check for email exit or not         
    }

    // end here function for client registration   *********************************************

    // code for send mobile otp 
    function send_otp($data){


        $this->load->model('admin/client_model');

        if(!isset($data->mobile) || empty($data->mobile)  ){
            return $return =  "Mobile Number required.";        
        }else if(!isset($data->ch) ||  empty($data->ch) ){
            return $return =  " OTP Type required.";        
        } 
        $mobile    = $data->mobile;
        $columnname = 'mobile';
        $mobile_status   =    $this->checkuserexit($columnname,$mobile);
       
        if(!empty($mobile_status)) {
            if (!empty($mobile_status)) {
                $arr = array ('status'=>0,'message'=>'Mobile number alrady exist !');
                return $arr;
            } 
        }else{
            $otptype  = $data->ch;
            $mobile  = $data->mobile;
            $otp_status  = $this->client_model->otp_verify($data);
            if($otp_status['status']=='success'){
                $rData['status'] = 'success';  
                $rData['returnVal'] = json_encode($otp_status);
                return $rData;
            }else{
                $rData['status'] = 'error';
                $rData['returnVal'] = json_encode($otp_status);
                return $rData;
            }
        }
       


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
                $arr = "Something Went Wrong";
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
                $arr = "Something Went Wrong";
                return $arr;
            }
        }
    }


    // end code for match video id 























    // Login *********************************************************
    function emp_login($data){
        $this->load->model('admin/employee_model');

        if(!isset($data->emp_id) ||  !isset($data->password) ){
            return $return =  "Employee ID & Password required.";        
        }

        $w = array();
        $w['emp_id'] = $data->emp_id;
        $w['password'] = $data->password;
        $w['field'] = 'id,name,email,phone,emp_id,image,department,dob,gender,joining_date,father_name,employee_profile,status,parent_id,   status,authorized_status';
        $result = $this->employee_model->findDynamic($w);
        if(empty($result)){
            return "Employee ID OR Password Mistmatch";
        }else if($result[0]->status != '1') {
            return "You are temporary blocked.";
        }else{
            $this->load->model('admin/designation_model');
            $profile_type = $this->designation_model->listArr();
            $this->load->model('admin/department_model');
            $department = $this->department_model->listArr();
            $userType   = $this->config->item('admin_type');
            
            $dbData = $result[0];
            
            $dbData->department = isset($department[$dbData->department])?$department[$dbData->department]:$dbData->department;
            $dbData->employee_profile = isset($profile_type[$dbData->employee_profile])?$profile_type[$dbData->employee_profile]:$dbData->employee_profile;
            $dbData->gender = ($dbData->gender == 1)?"Male":"Female";

            $dbData->role = isset($userType[$dbData->authorized_status])?$userType[$dbData->authorized_status]:"";
        }

        $rData['success'] = 1;  
        $rData['returnVal'] = json_decode(json_encode($dbData),true);
        return $rData;
    }

    // Management OR Team Leader get Employee list ******************************************
    function my_employee($data){

        $this->load->model('admin/employee_model');

        if(!isset($data->emp_id)){
            return $return =  "Employee ID";        
        }

        $w = array();
        $dbData = array();
        $w['parent_id'] = $data->emp_id;
        $w['field'] = 'id,name,email,phone,emp_id,image,department,dob,gender,joining_date,father_name,employee_profile,status,parent_id,   status,authorized_status';

        $result = $this->employee_model->findDynamic($w);

        // $field = 'e.id,e.name,e.email,e.phone,e.emp_id,e.image,e.department,e.dob,e.gender,e.joining_date,e.father_name,e.employee_profile,e.status,e.parent_id,e.status,e.authorized_status ';
        // $sql = "SELECT $field FROM ss_employee as e LEFT JOIN at_leave as l ON l.emp_id = e.id WHERE e.parent_id = '".$data->emp_id."'";
        // $result = $this->employee_model->rawQuery($sql);


        //echo $this->db->last_query();
        $where_in = '';
        if(empty($result)){
            return "Employee ID OR Password Mistmatch";
        }else if($result[0]->status != '1') {
            return "You are temporary blocked.";
        }else{
            $this->load->model('admin/designation_model');
            $profile_type = $this->designation_model->listArr();
            $this->load->model('admin/department_model');
            $department = $this->department_model->listArr();
            $userType   = $this->config->item('admin_type');
                
            foreach ($result as  $emp) {
                $emp->department = isset($department[$emp->department])?$department[$emp->department]:$emp->department;
                $emp->employee_profile = isset($profile_type[$emp->employee_profile])?$profile_type[$emp->employee_profile]:$emp->employee_profile;
                $emp->gender = ($emp->gender == 1)?"Male":"Female";
                $emp->role = isset($userType[$emp->authorized_status])?$userType[$emp->authorized_status]:"";
                $emp->newLeaveRequest = 0;

                // data pass in array
                $dbData[$emp->id] = $emp;
                $where_in = !empty($where_in)?$where_in.",'".$emp->id."'":"'".$emp->id."'";
            }
        }

        // get Lead Data
        $sql = "SELECT emp_id, count(emp_id) as newLeaveRequest FROM at_leave  WHERE status = '0' AND emp_id IN (".$where_in.") GROUP BY emp_id  ";
        $result = $this->employee_model->rawQuery($sql);
        if(!empty($result)){
            foreach ($result as $empData) {
                $dbData[$empData->emp_id]->newLeaveRequest = $empData->newLeaveRequest;
            }
        }

        

        $rData['success'] = 1;  
        $rData['returnVal'] = json_decode(json_encode($dbData),true);
        return $rData;
    }


     // Check In Now *********************************************************
    function check_in($data){
        $this->load->model('admin/attendance_model');

        if(!isset($data->emp_id) ){
            return $return =  "Employee ID required.";        
        }

        //check alrady Logged In
        $w = array();
        $w['emp_id'] = $data->emp_id;
        $w['date_at'] = date("Y-m-d");
        $dbData = $this->attendance_model->findDynamic($w);

        if(!empty($dbData)){
            return "Already Logged IN";
        }



        $w = array();
        $w['emp_id'] = $data->emp_id;
        $w['month'] = date("m");
        $w['year'] = date("Y");
        $w['date_at'] = date("Y-m-d");
        $w['check_in'] = date("Y-m-d H:i:s");
        $w['update_at'] = date("Y-m-d H:i:s");
        $w['login_status'] = 1;

        $result = $this->attendance_model->save($w);
        
        $rData['success'] = 1;  
        $rData['returnVal'] = "saved";
        return $rData;
    }  



    // Check Out Now *********************************************************
    function check_out($data){
        $this->load->model('admin/attendance_model');

        if(!isset($data->emp_id) ){
            return $return =  "Employee ID required.";        
        }

        //check alrady Logged In
        $w = array();
        $w['emp_id'] = $data->emp_id;
        $w['date_at'] = date("Y-m-d");
        $dbData = $this->attendance_model->findDynamic($w);

        if(empty($dbData)){
            return "You are not logged IN";
        }else if($dbData[0]->login_status == 2){
            return "Already Log out";
        }



        $w = array();
        $w['id'] = $dbData[0]->id;
        $w['check_out'] = date("Y-m-d H:i:s");
        $w['update_at'] = date("Y-m-d H:i:s");
        $w['login_status'] = 2;
        $w['working_hours'] = dateDiffMin($dbData[0]->check_in,$w['check_out']);
        $w['status'] = ($w['working_hours'] > 240 )?2:4;

        $result = $this->attendance_model->save($w);
        
        $rData['success'] = 1;  
        $rData['returnVal'] = "updated";
        return $rData;
    }   



    // Check In Data *********************************************************
    function check_in_data($data){
        $this->load->model('admin/attendance_model');

        if(!isset($data->emp_id) ){
            return $return =  "Employee ID required.";        
        }

        $w = array();
        $w['emp_id'] = $data->emp_id;
        $w['date_at'] = date("Y-m-d");
        $result = $this->attendance_model->findDynamic($w);
        if(empty($result)){
            return "Not login";
        }else{
            $dbData = $result[0];
            $dbData->working_min = empty($dbData->working_hours)?dateDiffMin($dbData->check_in,date("Y-m-d H:i:s")):$dbData->working_hours;
        }

        $rData['success'] = 1;  
        $rData['returnVal'] = json_decode(json_encode($dbData),true);
        return $rData;
    }


    // attendanceData *********************************************************
    function attandance_data($data){
        $this->load->model('admin/attendance_model');

        if(!isset($data->emp_id) ){
            return $return =  "Employee ID required.";        
        }

        $w = array();
        $w['emp_id'] = $data->emp_id;
        $w['date_at'] = date("Y-m-d");
        $result = $this->attendance_model->findDynamic($w);

        $whereis = '';
        if(isset($data->month)){
            $dataFrom = date("Y-").$data->month."-".'01';
            $lastDay = date("t", strtotime($dataFrom));
            $dataTo = date("Y-").$data->month."-".$lastDay;
            $whereis .= " AND at.date_at  between '".$dataFrom."' and '".$dataTo."'"; 
        }else if(isset($data->dateFrom) && isset($data->dateTo)){
            $whereis .= " AND at.date_at  between '".$data->dateFrom."' and '".$data->dateTo."'"; 
        }else{
            $dataTo = date("Y-m-").'01';
            $whereis .= " AND at.date_at  between '".$dataTo."' and '".date("Y-m-d")."'"; 
        }



        $sql = "SELECT * FROM at_attendance as at WHERE emp_id = '".$data->emp_id."' $whereis ";
        $dbData = $this->attendance_model->rawQuery($sql);
        
        if(empty($dbData)){
            return "No have data";
        }


        

        $rData['success'] = 1;  
        $rData['returnVal'] = json_decode(json_encode($dbData),true);
        return $rData;
    }


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



        $result = $this->$myModel->save($w);
        // if(empty($result))
        // {
        //     return "No have data";
        // }

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






    // ===============================================================================================
    // ===============================================================================================
    // ===============================================================================================


    // Leave Request *********************************************************
    function leave_request($data){
        $this->load->model('admin/leave_model');
        if(!isset($data->emp_id) ){
            return $return =  "Employee ID required.";        
        }

        if(!isset($data->leave_date) ){
            return $return =  "Leave Date required.";        
        }


       
        
            $tempData = explode("to", $data->leave_date);
            $dateis   = date("Y-m-d", strtotime($tempData[0]));
            $dateTo   = isset($tempData[1])?date("Y-m-d", strtotime($tempData[1])):$dateis;
            while ($dateis <=  $dateTo) {
                $save = array();
                $save['emp_id'] = $data->emp_id;
                $save['month'] = date("M", strtotime($dateis));
                $save['year'] = date("Y", strtotime($dateis));
                $save['date_at'] = $dateis;
                $save['reason'] = $data->msg;
                $save['status'] = 0;
                $save['request_at'] = date("Y-m-d H:i:s");
                $save['update_at'] = date("Y-m-d H:i:s");
                // check already exist
                $w = array();
                $w['emp_id'] = $data->emp_id;
                $w['date_at'] = $dateis;
                $checkData = $this->leave_model->findDynamic($w);
                if(empty($checkData)){
                    $this->leave_model->save($save);    
                }
                $dateis = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( $dateis ) ) . "+1 day" ) );
            }

        

        $rData['success'] = 1;  
        $rData['returnVal'] = "Reqsuest Submitted.";
        return $rData;
    }


    // Leave Request Approved OR Deny *********************************************************
    function leave_approve_action($data){
        $this->load->model('admin/leave_model');
        if(!isset($data->emp_id) ){
            return $return =  "Employee ID required.";        
        }

        if(!isset($data->leave_id) ){
            return $return =  "Employee Leave ID required.";        
        }

        if($data->approve_status == 1){

        }else{
            if(!isset($data->deny_reson) ){
                return $return =  "deny_reson required.";        
            }            
            $update['deny_reson'] = $data->deny_reson;
        }


        $update = array();
        $update['id'] = $data->leave_id;
        $update['approved_by'] = $data->approved_by;
        $update['update_at'] = date("Y-m-d H:i:s");
        $update['status'] = ($data->approve_status == 1)?1:2;


        $this->leave_model->save($update);

        $rData['success'] = 1;  
        $rData['returnVal'] = "Successfully Updated";
        return $rData;
    }

    // Leave List *********************************************************
    function all_leave_list($data){
        $this->load->model('admin/leave_model');
        if(!isset($data->emp_id) ){
            return $return =  "Employee ID required.";        
        }


        // $w = array();
        // $w['emp_id'] = $data->emp_id;
        // $w['orderby'] = "-id";
        // $w['limit'] = 365;
        // $dbData = $this->leave_model->findDynamic($w);

        $sql = "SELECT e.name as approvedBy, l.* FROM at_leave as l LEFT JOIN ss_employee as e ON e.id = l.approved_by WHERE l.emp_id = '".$data->emp_id."' ORDER BY l.id DESC LIMIT 365 ";
        $dbData = $this->leave_model->rawQuery($sql);



        $rData['success'] = 1;  
        $rData['returnVal'] = json_decode(json_encode($dbData),true);
        return $rData;
    }


    // update employee profile *********************************************************
    function change_profile($data){
        $this->load->model('admin/employee_model');
        if(!isset($data->emp_id) ){
            return $return =  "Employee ID required.";        
        }
        if(!isset($data->img_file) ){
            return $return =  "Profile Image required.";        
        }

        $w = array();
        $userData = $this->employee_model->find($data->emp_id) ;

        $f_newfile = strtolower(str_replace(" ", "_", $userData->name)).$data->emp_id."_".uniqid().".jpg";
        $fileName = "uploads/employee/".$f_newfile;
        $base64_string = $data->img_file;
        file_put_contents($fileName, base64_decode($base64_string));

        $insertData['id'] = $data->emp_id;
        $insertData['image'] = $f_newfile;
        $this->employee_model->save($insertData);

        $rData['success'] = 1;  
        $rData['returnVal'] = 'Successfully updated';
        return $rData;
    }

    // code for get client  details 
    function Get_client_details($data){
        $this->load->model('admin/client_model');
        if(!isset($data->user_id)){
            return $return =  "Client Id Required";        
        }else{
            $getData = $this->client_model->find($data->user_id);
            if(!empty($getData)){
                $rData['success'] = 1;  
                $rData['returnVal'] = json_decode(json_encode($getData),true);
                return $rData;
            }else{
                $arr = "Something Went Wrong";
                return $arr;
            }
        }
    }

    // end code for get client details




    



}

?>