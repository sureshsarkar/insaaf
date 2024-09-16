<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
use Razorpay\Api\Api;


class New_user extends BaseController{ 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('client_model');
        $this->load->model('lawyer_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('admin/case_category_model');
        $this->load->model('client/Case_details_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Slot_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/scheduler_model');


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

     
    // Index =============================================================
    public function index()
    { 

        $data = array();
        $w['table']  = 'category';
        $w['id']     = '-id'; // Desc when - add
        $w['limit']     = '20'; // Desc when - add
        $data['categoryMenu']      = $this->getCategory($w); 
        $data['all_category'] = $this->case_category_model->all();

        
        
        $tempArr = getStaticTime();
        $data['schedule_times']=$tempArr;
        
   
        $where['table']= "state"; 
        $where['orderby']= "name"; 
        $states = $this->case_category_model->findDynamic($where);
        $data['states'] = $states;

       // meta ==================================
        $data["title"]="Free Legal Advice from Expert Lawyers & Advocates in India - Insaaf99";
        $data["keywords"]="Legal Advice, Legal Advice Online, Online Legal Advice, Free Legal Advice";
        $data["description"]="Free legal advice online from top expert Lawyers and get solutions immediately for  all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
        $data["og_url"]="https://insaaf99.com/legal-advice";
        $data["og_title"]="Free Legal Advice from Expert Lawyers & Advocates in India - Insaaf99";
        $data["og_description"]=" Free legal advice online from top expert Lawyers and get solutions immediately for all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
        $data["og_site_name"]="https://insaaf99.com/legal-advice";
        $data["twitter_card"]="summary";
        $data["twitter_title"]="Free Legal Advice from Expert Lawyers & Advocates in India - Insaaf99";
        $data["twitter_description"]="Free legal advice online from top expert Lawyers and get solutions immediately for all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
        $data["canonical"]="https://insaaf99.com/legal-advice";



       $data["file"]="front/new_user";
       $this->load->view('front/template',$data);
    } 

    // code for booking slot 
    public function Pay_for_slot($order_id ='')
    {     

        $form_data  = $this->input->post();

        // get client data
        $clientW['mobile'] = $form_data['mobile'];
        $clientW['field'] = "id";
        $clientGetData =  $this->client_model->finddynamic($clientW);
   
        // get client success meeting data in slot table
       if(isset($clientGetData) && count($clientGetData) > 0){
        $clientID = $clientGetData[0]->id;
        $query= $this->db->query("select id from slot where `client_id` = $clientID AND `MeetingStatus` = '2'");
        $userSlotData=$query->result_array(); // get client data rom slot
       }

        if(isset($form_data) && !empty($form_data)){
           // check fullname exist or not
            if(isset($form_data['fullname']) && !empty($form_data['fullname'])){
                $name= explode(" ",$form_data['fullname']);
                $form_data['fname']=$name[0];
                if(count($name) >2){
                    $form_data['lname']=$name[count($name)-1]; 
                }else{
                    $form_data['lname']=$name[1];
                }
            }

            $meeting_time = date('Y-m-d H:i:s', strtotime($form_data['schedule_date'].' '.$form_data['schedule_time']));

            // check if already exist
            $w = array('mobile' =>$form_data['mobile']);
            $dbData = $this->client_model->finddynamic($w);
            if(empty($dbData)){
                $insertdata=array();
                $insertdata['fname']        =trim($form_data['fname']);
                $insertdata['lname']        =trim($form_data['lname']);
                $insertdata['email']        =(isset($form_data['email']))?$form_data['email']:"";
                $insertdata['mobile']       =$form_data['mobile'];
                $insertdata['state']        =$form_data['state'];
                $insertdata['city']         =$form_data['city'];
                $insertdata['status']       =2;
                $insertdata['added_from']   ="web_ppc";
                $insertdata['dt']           =date('Y-m-d H:i:s');
                $insertdata['status']       =1;

                $clientId =  $this->client_model->save($insertdata);
                $updatetdata['id']               = $clientId;
                $updatetdata['client_unique_id'] ="INSF99C".$clientId;
                $this->client_model->save($updatetdata);

            }else{
                // already exit user mobile number
                $clientId = $dbData[0]->id;
                $insertdata = json_decode(json_encode($dbData[0]),true);
            }
           

            $_SESSION['direct_booking'] =1;
            $_SESSION['id']             =$clientId;
            $insertdata['phone']        =$form_data['mobile'];
            $insertdata['id']           =$clientId;
            $insertdata['name']         =trim($form_data['fname']).' '.trim($form_data['lname']);
       
       
            if (isset($form_data['queryId']) && $form_data['queryId']!="") {
                $queryID = $form_data['queryId'];
            }else{
                $queryID = '';
            }

            $insertdata['queryId']  = isset($insertdata['queryId'])?$insertdata['queryId']:$queryID;
        
            $api = new Api($this->config->item('razPaykey_id'),$this->config->item('razSecret'));
            $_SESSION['payable_amount'] = (isset($userSlotData) && count($userSlotData) >0)?299:99;
      
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
            
            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
            $data['orderDetails'] = $this->prepareData($amount,$razorpayOrderId,$insertdata);
 
            $sessionArray['ClientDetails']  = $insertdata;
            $this->session->set_userdata($sessionArray);
      
            $paymentData['user_id']         = $clientId;   
            $paymentData['name']            = $insertdata['fname'];
            $paymentData['mobile']          = $insertdata['mobile'] ;
            $paymentData['email']           = (isset($form_data['email']))?$form_data['email']:"";
            $payAmount                      = $amount/100;
            $paymentData['amount']          = $payAmount;
            $paymentData['payment_date']    = date("Y-m-d H:i:s");  
            $paymentData['order_id']        = $razorpayOrderId;
            $paymentData['payment_status']  = 'pending';
            $paymentData['payment_type']    = 'Slot Booking';
            $paymentData['payment_mode']    = 'razorpay';

            
            $paymentResult   =   $this->Payment_model->save($paymentData);

            if (isset($form_data['queryId']) && $form_data['queryId']!="") {
              $queryData['id']              = $queryID;
              $queryData['order_id']        = $razorpayOrderId;
              $result1  = $this->Query_model->save($queryData);
            }
            

            /*============ BOOKING SLOT =======*/
            if (isset($form_data['schedule_date']) && $form_data['schedule_date']!='') {
               /*---------- Save Case Data ----*/
               if (!empty($this->session->userdata('case_file'))) {
                $filename = $this->session->userdata('case_file');
               }else{
                $filename = '';
               }
            //   $caseData['asign_lawyer_id']           = $form_data['lawyer_id'];
              $caseData['client_id']                 = $clientId;
              $caseData['case_category_id']          = $form_data['case_category_id'];
              $caseData['case_description']          = (isset($form_data['case_description']))?$form_data['case_description']:"";
              $caseData['payment_status']            = 0;
              $caseData['dt']                        = date("Y-m-d H:i:s"); 
              $caseData['payment_id']                = $paymentResult; 
              $caseData['case_file']                 = $filename; 
              $caseData['status']                    = 0; 
              $result2   =   $this->Case_details_model->save($caseData);

              /*------- Save Slot Data ------*/
            if(isset($_SESSION['camp_id']) && ($_SESSION['camp_id'])){
                $camp_id =$_SESSION['camp_id'];
                unset($_SESSION['camp_id']);
            }else{
                $camp_id ="";
            }

            if(isset($_SESSION['keyword']) && ($_SESSION['keyword'])){
                $keyword =$_SESSION['keyword'];
                unset($_SESSION['keyword']);
            }else{
                $keyword ="";
            }

            if(isset($_SESSION['type']) && ($_SESSION['type'])){
                $type =$_SESSION['type'];
                unset($_SESSION['type']);
            }else{
                $type ="";
            }

            if(isset($_SESSION['network']) && ($_SESSION['network'])){
                $network =$_SESSION['network'];
                unset($_SESSION['network']);
            }else{
                $network ="";
            }
         
            if(isset($form_data['state'])){
                $state =$form_data['state'];
            }else{
                $state ="";
            }
            
            if(isset($form_data['city'])){
                $city =$form_data['city'];
            }else{
                $city ="";
            }
           
             $device  = check_device();
            
              $slotData['lawyer_id']       = '';
              $slotData['client_id']       = $clientId;
              $slotData['case_id']         = $result2;
              $slotData['slot_date']       = date("Y-m-d", strtotime($form_data['schedule_date']));
              $slotData['time']            = $form_data['schedule_time'];
              $slotData['meeting_time']    = $meeting_time;
              $slotData['came_from']       = 1;
              $slotData['period']          = 15;
              $slotData['slot_status']     = 0;
              $slotData['camp_data']     = json_encode(array("device"=>$device,"camp_id"=>$camp_id,"keyword"=>$keyword,"type"=>$type,"network"=>$network,"state"=>$state,"city"=>$city));
            
               if($form_data['refrence'] == "legal-advice"){
                $pageRef = 1;
                }elseif($form_data['refrence'] == "talk-to-lawyer"){
                  $pageRef = 2;
                }else{
                    $pageRef = 0; 
                }
              $slotData['pageRefrence']        = $pageRef; //json_encode(array('refrence'=>(isset($form_data['refrence']) && !empty($form_data['refrence']))? $form_data['refrence']:""));
              $slotData['dt']              = date("Y-m-d H:i:s"); 
         
              $result3   = $this->Slot_model->save($slotData);
 
            }
            /*=================================*/
        //  redirected to Welcome page 
            // if(isset($caseData['case_category_id']) && $caseData['case_category_id'] == 53){
            //     redirect('welcome');
            //     exit;
            // }
            // Go to payment page
            $data_view_port=$this->load->view('front/new_user_pay',$data,TRUE);
            echo $data_view_port;
      }
      }
// end code for booking slot

       public function get_time()
    { 
        
        
        $response = '';
        $tempArr = getStaticTime();
        $n = 0;
        foreach($tempArr as $schedule){
            
            $AddDate = $this->input->post('schedule_date');
            $addTime = date("H:i:s", strtotime($schedule));
            $AddDate =date("Y-m-d H:i:s", strtotime("$AddDate $addTime"));

            //check time booked or not function || check_slot_booked
            $booked = check_slot_booked($AddDate);
            
            // call function fetche date & time from scheduler table to block date time || check_date_time_block()
            $dateBlock = date("Y-m-d", strtotime("$AddDate"));
            $timeBlock = date("h:i A", strtotime("$schedule"));
            $date_time_block = check_date_time_block($dateBlock,$timeBlock);
            
            if ($n==0 && $booked !=1) {
                $active = 'active'; $checked = 'checked';
            }else{
                $active = ''; $checked = '';
            }
            
            if ($booked == 1) {
                $disabled = 'disabled'; $checked = ''; $n--;
            }elseif((isset($date_time_block) && $date_time_block==1)){
                $disabled = 'disabled'; $active = '';  $checked = '';$n--;
            }else{
                $disabled = '';
            }

            $response .= '
            <div class="slote">
                <label class="btn btn-outline-primary des_btn_colr_fjjjg '.$active.' '.$disabled.'">
                   <input type="radio" name="schedule_time" value="'.$schedule.'" '.$checked.'> '.$schedule.'
                </label>
                </div>
            ';
            $n++;
        }

        echo $response;       
    }


    public function getMobileNumber(){

        $w['mobile'] = $_POST['mobile'];
        $clientData = $this->client_model->finddynamic($w);
        $lawyerData = $this->lawyer_model->finddynamic($w);
    
        if(isset($clientData) && !empty($clientData)){
            echo json_encode(array('data'=>$clientData[0], 'status'=>1));
            exit();
        }elseif(isset($lawyerData) && !empty($lawyerData)){
            echo json_encode(array('data'=>$lawyerData[0], 'status'=>2));
            exit();
        }else{
            echo json_encode(array('data'=>"", 'status'=>""));
            exit();
        }
    }
}
?>