<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
use Razorpay\Api\Api;


class Slot_booking_pay extends BaseController{ 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('client_model');
        $this->load->model('lawyer_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('client/Case_details_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Slot_model');

        // Cookie helper
        $this->load->helper('cookie');
    }

     
  
    // Index =============================================================
    public function index()
    { 
       $data["title"]="index";
       $data["file"]="front/index";
       $this->load->view('front/template',$data);
    } 

    // code for register 
    public function Pay_for_slot($order_id ='')
    {      

      $clientID = $_SESSION['id'];
      $query= $this->db->query("select id from slot where `client_id` = $clientID AND `MeetingStatus` = '2'");
      $userSlotData=$query->result_array(); // get client data rom slot


            if(empty($_SESSION['email'])){
                header("Location:".base_url('client/profile/edit/'.$_SESSION['id'].'?action=verify_email'));
                exit;
            }
            // set data
            $insertdata['id']             = $_SESSION['id'];
            $insertdata['name']           = $_SESSION['name'];
            $insertdata['email']          = isset($_SESSION['email'])?$_SESSION['email']:'';
            $insertdata['phone']          = $_SESSION['phone'];

            // echo $order_id; exit();
            date_default_timezone_set("Asia/Calcutta");
            $form_data  = $this->input->post();
            // pre($form_data);
            // exit();
            
            if (isset($form_data['queryId']) && $form_data['queryId']!="") {
                $queryID = $form_data['queryId'];
            }else{
                $queryID = '';
            }

            $insertdata['queryId']  = isset($insertdata['queryId'])?$insertdata['queryId']:$queryID;
        
            $api = new Api($this->config->item('razPaykey_id'),$this->config->item('razSecret'));
            $_SESSION['payable_amount'] = (isset($userSlotData) && count($userSlotData) > 0)?'299':'99';
      
            $paymentData = array();
            
            $razorpayOrder = $api->order->create(array(
            'receipt'         => rand(),
            'amount'          => $_SESSION['payable_amount']*100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
            ));
          
            $amount = $razorpayOrder['amount'];
            if ($order_id!="") {
              $razorpayOrderId = $order_id;
              $payment_data = $this->db->get_where('z_payment' , ['order_id'=> $order_id])->row();
              $paymentData['id'] = $payment_data->id;
            }else{
              $razorpayOrderId = $razorpayOrder['id'];
            }
            // $razorpayOrderId = $razorpayOrder['id'];
            
            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
            $data['orderDetails'] = $this->prepareData($amount,$razorpayOrderId,$insertdata);
          
            $sessionArray['ClientDetails']  = $insertdata;
            $this->session->set_userdata($sessionArray);
          
            $paymentData['user_id']         = $insertdata['id'];   
            $paymentData['name']            = $insertdata['name'];
            $paymentData['mobile']          = $insertdata['phone'] ;
            $paymentData['email']           = $insertdata['email'];
            $payAmount                      = $amount/100;
            $paymentData['amount']          = $payAmount;
            $paymentData['payment_date']    = date("Y-m-d H:i:s");  
            $paymentData['order_id']        = $razorpayOrderId;
            $paymentData['payment_status']  = 'pending';
            $paymentData['payment_type']    = 'Slot Booking ';
            $paymentData['payment_mode']    = 'razorpay';

            
            $result   =   $this->Payment_model->save($paymentData); 
            if (isset($form_data['queryId']) && $form_data['queryId']!="") {
              $queryData['id']    = $queryID;
              $queryData['order_id']        = $razorpayOrderId;
              $result1   =   $this->Query_model->save($queryData);
            }
            

            /*============ BOOKING SLOT =======*/
            if (isset($form_data['slot_date']) && $form_data['slot_date']!='') {
               /*---------- Save Case Data ----*/
               if (!empty($this->session->userdata('case_file'))) {
                $filename = $this->session->userdata('case_file');
               }else{
                $filename = '';
               }
              $caseData['asign_lawyer_id']           = $form_data['lawyer_id'];
              $caseData['client_id']                 = $form_data['client_id'];
              $caseData['case_category_id']          = $form_data['case_category_id'];
              $caseData['case_description']          = $form_data['case_description'];
              $caseData['payment_status']          = 0;
              $caseData['dt']          = date("Y-m-d H:i:s"); 
              $caseData['payment_id']          = $result; 
              $caseData['case_file']          = $filename; 
              $caseData['status']          = 0; 
              $result2   =   $this->Case_details_model->save($caseData);

              /*------- Save Slot Data ------*/
              $device  = check_device();
              $slotData['lawyer_id']       = $form_data['lawyer_id'];
              $slotData['client_id']       = $form_data['client_id'];
              $slotData['case_id']         = $result2;
              $slotData['slot_date']       = $form_data['slot_date'];
              $slotData['time']            = $form_data['time'];
              $slotData['meeting_time']    = $form_data['meeting_time'];
              $slotData['came_from']       = 1;
              $slotData['period']          = 15;
              $slotData['slot_status']     = 0;
              $slotData['dt']          = date("Y-m-d H:i:s");  
              $slotData['camp_data']     = json_encode(array("device"=>$device));
              $result3   =   $this->Slot_model->save($slotData);
              /*-------- Unset Form Data ----------*/
              $this->session->unset_userdata('ses_case_cat_id');
              $this->session->unset_userdata('ses_lawyer_id');
              $this->session->unset_userdata('case_description');
              $this->session->unset_userdata('ses_schedule_date');
              $this->session->unset_userdata('ses_schedule_time');
              $this->session->unset_userdata('case_file');
            }
            /*=================================*/
      
            // Save data to walet start
            $data_view_port=$this->load->view('client/client_query_pay',$data,TRUE);
            echo $data_view_port;
      }
// end code for register

      // create book slot code
      public function generate_code(){
        $form_data = $_POST;
        $lawyer = $this->lawyer_model->find($form_data['lawyer_id']);
        $tempArr =  array(
            'id' =>$form_data['lawyer_id'], 
            'Lawer' =>trim($lawyer->fname)." ".trim($lawyer->lname), 
            'email' =>$lawyer->email, 
            'mobile' =>$lawyer->mobile, 
            'unique_id' =>$lawyer->lawyer_unique_id, 
            'img' =>$lawyer->image, 
            'experience' =>$lawyer->experience, 
            'practice_area' =>$lawyer->practice_area, 
            'meeting_date' => date("d-m-Y", strtotime($form_data['meeting_time'])) , 
            'meeting_time' =>date("H:i:s", strtotime($form_data['meeting_time'])) ,
            'php_dateTime' =>$form_data['meeting_time'], 
            'case_category_id' =>$form_data['case_category_id'], 
            'query_id' =>$_SESSION['chat_id']
            
        );

        $temp = json_encode($tempArr);
        $tempString = base64_encode($temp);
        $data['code'] = "--complete_slot--".$tempString;
        $this->global['pageTitle'] = 'Copy code';
        $this->loadViews("lawyer/query/copy_code", $this->global, $data, NULL, 'lawyer');
      
  }

    // code for register 
    public function case_payment($id=NULL)
    {          

            $sql = "SELECT c.* ,cc.total_amount,cc.gst_amount  FROM cases as c "; 
            $sql .= " JOIN case_category as cc ON cc.id = c.case_category_id "; 
            $sql .= " LEFT JOIN slot as s ON s.case_id = c.id "; 
            $sql .= "WHERE c.id = $id ";

            $rData = $this->Case_details_model->rawQuery($sql);
            $Data_result = $rData[0];
            $total_amount       = intval($Data_result->total_amount);
            $gst_amount       = intval($Data_result->gst_amount);
            $amount= $total_amount + $gst_amount;
            // pre($Data_result);
            // exit();
            $_SESSION['payable_amount']=$amount; // Case category amount
            
              $insertdata['id']             = $_SESSION['id'];
              $insertdata['case_id']        = $id;
              $insertdata['name']           = $_SESSION['name'];
              $insertdata['email']          = $_SESSION['email'];
              $insertdata['phone']          = $_SESSION['phone'];
          
          // 10000 patment gatway
          
              date_default_timezone_set("Asia/Calcutta");
              $api = new Api($this->config->item('razPaykey_id'),$this->config->item('razSecret'));
              
              
              $razorpayOrder = $api->order->create(array(
              'receipt'         => rand(),
              'amount'          => $_SESSION['payable_amount']*100, // 2000 rupees in paise
              'currency'        => 'INR',
              'payment_capture' => 1 // auto capture
              ));

              $amount = $razorpayOrder['amount'];
              
              $razorpayOrderId = $razorpayOrder['id'];
              $_SESSION['razorpay_order_id'] = $razorpayOrderId;
              $data['orderDetails'] = $this->prepareData($amount,$razorpayOrderId,$insertdata);
            
              $insertdata['password']  = $this->input->post('password');
              $sessionArray['ClientDetails']  = $insertdata;
              $this->session->set_userdata($sessionArray);
      
              $paymentData = array();
              $paymentData['user_id']         = $insertdata['id'];   
              $paymentData['name']            = $insertdata['name'];
              $paymentData['mobile']          = $insertdata['phone'] ;
              $paymentData['email']           = $insertdata['email'];
              $payAmount                      = $amount/100;
              $paymentData['amount']          = $payAmount;
              $paymentData['payment_date']    = date("Y/m/d h:m:s");  
              $paymentData['order_id']        = $razorpayOrderId;
              $paymentData['payment_status']  = 'pending';
              $paymentData['payment_type']    = 'Case Payment';
              $paymentData['payment_mode']    = '';

              //   code for update cases table for orderid 
              $casesUpdateData = array();
              $casesUpdateData['id'] = $id;
              $casesUpdateData['order_id']  = $razorpayOrderId;
              $casesUpdateData['payment']  = $payAmount;
              $casesUpdateData['payment_status']  = 0;
              
              $result1   =   $this->Case_details_model->save($casesUpdateData);

              
              // end code for update cases 
              
              $result   =   $this->Payment_model->save($paymentData);
              
              $data_view_port=$this->load->view('client/case_payment',$data,TRUE);
              echo $data_view_port;    
  
       }



}
?>