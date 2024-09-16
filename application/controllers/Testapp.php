
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


class Testapp extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('client_model');
        $this->load->model('lawyer_model');
        
        // Cookie helper
        $this->load->helper('cookie');
        $lang='';
        if(!empty($_COOKIE['lang']) && isset($_COOKIE['lang'])){
         $lang=$_COOKIE['lang'];
        }else{
         $lang=config_item('language');
        }
       $this->lang->load('menu',$lang);
    }
    
    
    
    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index()
    {
        header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
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
      
   
    
    // Action Connect With Pages ===============================

          if($data->action=='send_otp' || $data->action=='get_client_with_codition' || $data->action=='Get_client_details' || $data->action=='get_lawyer_with_codition' || $data->action=='get_all_client' || $data->action=='get_all_lawyer' || $data->action=='update_client' || $data->action=='add_client' || $data->action=='delete_client'){
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
    
          
           
    }          
           
    // get all lawyers
     function get_all_lawyer($data){
            $alluser = $this->lawyer_model->all();
           
        $rData['success'] = 1;  
        $rData['returnVal'] = "This action blocked.";
        return $alluser;
    }

    // get all users

     function get_all_client($data){
            $alluser = $this->client_model->all();
           
        $rData['success'] = 1;  
        $rData['returnVal'] = "This action blocked.";
        return $alluser;
    }

    // get client with condition

     function get_client_with_codition($data){
        pre($data);
        exit();
            $alluser = $this->client_model->finddynamic($data);
           
        $rData['success'] = 1;  
        $rData['returnVal'] = "This action blocked.";
        return $alluser;
    }
    // get lawyer with condition

     function get_lawyer_with_codition($data){
            $alluser = $this->lawyer_model->finddynamic($data);
           
        $rData['success'] = 1;  
        $rData['returnVal'] = "This action blocked.";
        return $alluser;
    }

    // update users

     function update_client($data){
            $alluser = $this->client_model->save($data);
           
        $rData['success'] = 1;  
        $rData['returnVal'] = "This action blocked.";
        return $alluser;
    }

    // add users

     function add_client($data){
        $alluser = $this->client_model->save($data);
           
        $rData['success'] = 1;  
        $rData['returnVal'] = "This action blocked.";
        return $alluser;
    }
    
    // delete users

     function delete_client($data){
        $alluser = $this->client_model->delete($data);
           
        $rData['success'] = 1;  
        $rData['returnVal'] = "This action blocked.";
        return $alluser;
    }
    
    // sent OTP
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



}
?>

