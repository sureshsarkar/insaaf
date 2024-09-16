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
class Create_case extends BaseController
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
        $this->load->model('client/Case_details_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/Slot_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('front/orders_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Lawyer_scheduler_model');
        $data['case_category1']=$this->Case_category_model->all();
        $this->load->model('lawyer/lawyer_model');
    }


    public function index()
    {   
        if(!isset($_SESSION['email']) || empty($_SESSION['email']))  {
             redirect(base_url("client/profile/edit?action=verify_email&msg= "));
             exit;
          }

        $checkStatus = (isset($_GET['action']) && $_GET['action'] == 'lawyer_call')?true:false;
        if(!$checkStatus){
            $this->isUserLoggedIn();
        }else{
            $_SESSION['chat_user'] = isset($_GET['u'])?$_GET['u']:'';
            $_SESSION['chat_id'] = isset($_GET['chat_id'])?$_GET['chat_id']:'';
            if(!isset($_GET['u'])){
                header("Location:".base_url("lawyer/dashboard"));
            }
        }
        
        $where=array();
        $where['status'] = 1;
        $data['all_lawyer'] = $this->lawyer_model->finddynamic($where);
        $data['all_case_category'] = $this->Case_category_model->finddynamic($where);
        // pre($data['all_case_category']);

        $type = ($checkStatus)?'lawyer':'client';
        $this->global['pageTitle'] = ucfirst($type). ' Dashboard';
        $this->loadViews("client/create_case/ajax1", $this->global, $data, NULL, $type);
    }



     // payment detail 
     public function prepareData($amount, $razorpayOrderId, $userDetails)
     {
         
         
         $data = array(
             "key" => $this->config->item('razPaykey_id'),
             "amount" => $amount,
             "name" => "Insaaf99",
             
             "image" => base_url() . "assets/images/front_logo/logo1.png",
             "prefill" => array(
                 "name" => $userDetails['fname'] . ($userDetails['fname']) ? $userDetails['lname'] : '',
                 "email" => $userDetails['email'],
                 "contact" => $userDetails['mobile']
                 //  "contact"  => '8937001226',
             ),
             "notes" => array(
                 "address" => '',
                 "merchant_order_id" => rand()
             ),
             "theme" => array(
                 "color" => "#e2146f"
             ),
             "order_id" => $razorpayOrderId
         );
         return $data;
     }

    public function save_ses_casecategory(){
        if (!empty($this->input->post('case_cat'))) {
           
            $cat_id = '["'.$this->input->post('case_cat').'"]';
            $data['catData'] = $this->Case_category_model->find($this->input->post('case_cat'));
            $where=array();
            $sql = "SELECT * FROM lawyer  WHERE status = '1' AND  JSON_CONTAINS(category, '".$cat_id."' ) ORDER BY id ASC LIMIT 80 ";
            $data['all_lawyer'] = $this->lawyer_model->rawQuery($sql);
            if(empty($data['all_lawyer'])){
                echo 3;
                exit;
            }
            $this->session->set_userdata('ses_case_cat_id', $this->input->post('case_cat'));
            echo $template = $this->load->view('client/create_case/lawyer-list',$data,true);
            
        }else{
            echo 2;
        }
    }

    public function ajax2($lid = NULL)
    {   

        $checkStatus = (isset($_SESSION['role']) && $_SESSION['role'] == 'lawyer')?true:false;
        if(!$checkStatus){
            $this->isUserLoggedIn();
        }

        if(!empty($lid)){
            $lawyer_id = base64_decode($lid); 
            $this->session->set_userdata('ses_lawyer_id', $lawyer_id);  
        

            $where = array();  $where2 = array(); $data['case_cats']=[]; 
            $where['id'] = $lawyer_id;
            $get_lawyer = $this->lawyer_model->finddynamic($where);
            $data['lawyer_data'] = $get_lawyer[0];
            // pre($data['lawyer_data']);  
            $get_case_categories = json_decode($data['lawyer_data']->category);
            foreach($get_case_categories as $case_categories){
                $where2['id'] = $case_categories;
                $getCase = $this->Case_category_model->finddynamic($where2);
                $data['case_cats'][] = array(
                    'id' => $getCase[0]->id,
                    'name' => $getCase[0]->name
                );
            }
        }
            
        // pre($data['case_cats']);
        $type = ($checkStatus)?'lawyer':'client';
        $this->global['pageTitle'] = ucfirst($type).' Selcte Case category';
        $this->loadViews("client/create_case/ajax2", $this->global, $data, NULL, $type);
    }

    public function ajax3($lid = NULL)
    {

        $checkStatus = (isset($_SESSION['role']) && $_SESSION['role'] == 'lawyer')?true:false;
        if(!$checkStatus){
        $this->isUserLoggedIn();
        }

        if(!empty($lid)){
            $lawyer_id = base64_decode($lid); 
            $this->session->set_userdata('ses_lawyer_id', $lawyer_id); 
            if (!empty($this->input->post('case_cat'))) {
               $this->session->set_userdata('ses_case_cat_id', $this->input->post('case_cat')); 
            }
            
            $where = array(); $Date = date("Y-m-d"); 
            $day = date('D', strtotime($Date. ' + 1 days'));
            $where['lawyer_id'] = $lawyer_id;
            $where['schedule_day'] = $day;
            $get_schedule = $this->Lawyer_scheduler_model->finddynamic($where);
        }   
         
        if (isset($get_schedule) &&  !empty($get_schedule)) {
           $data['schedule_times'] = json_decode($get_schedule[0]->schedule_time);
        }else{

           $tempArr = getStaticTime();
           $data['schedule_times']=$tempArr;
           // $data['schedule_times']= [];

        }


        $type = ($checkStatus)?'lawyer':'client';
        $this->global['pageTitle'] = 'Choose Meeting Time';
        $this->loadViews("client/create_case/ajax3", $this->global, $data, NULL, $type);
    }


    

    public function get_time()
    {   

        // pre($_POST); die();
        /*$where = array();  $schedule_time = array(); $response = ''; 
        $where['lawyer_id'] = $this->input->post('lawyer_id');
        $where['schedule_day'] = $this->input->post('schedule_day');
        $get_schedule = $this->Lawyer_scheduler_model->finddynamic($where);
        if (!empty($get_schedule)) {
           $schedule_time = json_decode($get_schedule[0]->schedule_time);
        }else{
           $schedule_time = [];
        }
        
        $n = 1;
        foreach($schedule_time as $schedule){
            
            $Date = $this->input->post('schedule_date');
            $booked = check_slot($this->session->userdata('ses_lawyer_id'), date('Y-m-d', strtotime($Date)), $schedule); 
            if ($booked == 1) {
                $disabled = 'disabled'; 
            }else{
                $disabled = '';
            }
            if ($n==1 && $booked !=1) {
                $active = 'active'; $checked = 'checked';
            }else{
                $active = ''; $checked = '';
            }

            $response .= '
                <label class="btn btn-outline-primary des_btn_colr_fjjjg '.$active.' '.$disabled.'">
                   <input type="radio" name="schedule_time" value="'.$schedule.'" '.$checked.'> '.$schedule.'
                </label>
            ';
            $n++;
        }
        */
        $response = '';
        $tempArr = getStaticTime();
        $n = 1;
        foreach($tempArr as $schedule){
            
            $AddDate = $this->input->post('schedule_date');
            $addTime = date("H:i:s", strtotime($schedule));
            $AddDate =date("Y-m-d H:i:s", strtotime("$AddDate $addTime"));
            $booked = check_slot_booked($AddDate); //check time booked or not function

            // call function fetche date & time from scheduler table to block date time || check_date_time_block()
            $dateBlock = date("Y-m-d", strtotime("$AddDate"));
            $timeBlock = date("h:i A", strtotime("$schedule"));
            $date_time_block = check_date_time_block($dateBlock,$timeBlock);
            

            if ($n==1 && $booked !=1) {
                $active = 'active'; $checked = 'checked';
            }else{
                $active = ''; $checked = '';
            }
            
            if ($booked == 1) {
                $disabled = 'disabled'; 
            }elseif((isset($date_time_block) && !empty($date_time_block))){
                $disabled = 'disabled'; $active = '';
            }
            else{
                $disabled = '';
            }
      

            $response .= '
                <label class="btn btn-outline-primary des_btn_colr_fjjjg '.$active.' '.$disabled.'">
                   <input type="radio" name="schedule_time" value="'.$schedule.'" '.$checked.'> '.$schedule.'
                </label>
            ';
            $n++;
        }



        // static time chage
        // $tempArr = getStaticTime();
        // $response = '';
        // foreach ($tempArr as $key => $value) {
        //     $disabled = '';
        //     $active = '';
        //     $checked = '';
        //     $schedule = $value;
        //     $response .= '
        //         <label class="btn btn-outline-primary des_btn_colr_fjjjg '.$active.' '.$disabled.'">
        //            <input type="radio" name="schedule_time" value="'.$schedule.'" '.$checked.'> '.$schedule.'
        //         </label>
        //     ';
        // }
        //$data['schedule_times']=$tempArr;
        echo $response;       
    }

    public function ajax4($lid = NULL)
    {   

        $checkStatus = (isset($_SESSION['role']) && $_SESSION['role'] == 'lawyer')?true:false;
        if(!$checkStatus){
        $this->isUserLoggedIn();
        }else{
            $w['table'] = 'client_query';
            $w['id'] = $_SESSION['chat_id'];
            $w['field'] = 'id,msg,status';
            $chatData = $this->lawyer_model->findDynamic($w);
            $data['msgData'] = empty($chatData)?'':$chatData[0];
        }

        $lawyer_id = base64_decode($lid);  
        if ($this->input->post('schedule_date')!='') {
            $this->session->set_userdata('ses_schedule_date', $this->input->post('schedule_date'));
            $this->session->set_userdata('ses_schedule_time', $this->input->post('schedule_time'));
        }

        if(isset($_SESSION['ses_case_cat_id'])){
            $caseDb = $this->Case_category_model->find($_SESSION['ses_case_cat_id']);
            $tempCaseName =  empty($caseDb)?'':$caseDb->name." case ";
        }

        $data['case_category'] = isset($tempCaseName)?$tempCaseName:'';
         
         

        
        $type = ($checkStatus)?'lawyer':'client';
        $data['lawyer_data'] = $lid;
        $this->global['pageTitle'] = 'Client Dashboard';
        $this->loadViews("client/create_case/ajax4", $this->global, $data, NULL, $type);
    }

    public function ajax5($lid = NULL)
    {   
       
        $checkStatus = (isset($_SESSION['role']) && $_SESSION['role'] == 'lawyer')?true:false;
        if(!$checkStatus){
        $this->isUserLoggedIn();
        }else{
            $w['id'] = $_SESSION['chat_id'];
        }

        // print_r($_FILES['case_file']); die();
        if (isset($_FILES['case_file']['name'])) {
            $tmpName = $_FILES['case_file']['tmp_name'];
            $filename = rand(111,999999).$_FILES['case_file']['name'];
            $location = "uploads/cases/".$filename;
            if(move_uploaded_file($tmpName, $location)){
                $this->session->set_userdata('case_file', $filename);
            }
        }
        $lawyer_id = base64_decode($lid);  
        $this->session->set_userdata('case_description', $this->input->post('case_description'));
        // $this->session->set_userdata('case_file', $_FILES['case_file']);
        $data['lawyer_data'] = $lid;
        /*----------- Session Data -------------*/
        $ses_case_cat_id = $this->session->userdata('ses_case_cat_id');
        $ses_lawyer_id = $this->session->userdata('ses_lawyer_id');
        $case_description = $this->session->userdata('case_description');
        $ses_schedule_date = $this->session->userdata('ses_schedule_date');
        $ses_schedule_time = $this->session->userdata('ses_schedule_time');
        /*-------------- Form Data -------------*/
        $where = array();  $where2 = array();
        $where['id'] = $lawyer_id;
        $get_lawyer = $this->lawyer_model->finddynamic($where);
        $data['lawyer_data'] = !empty($get_lawyer)?$get_lawyer[0]:'';

        $where2['id'] = $ses_case_cat_id;
        $getCase = $this->Case_category_model->finddynamic($where2);
        $data['case_cat_data'] = $getCase[0];

        // pre($data); die();
        /*--------------------------------------*/
        $type = ($checkStatus)?'lawyer':'client';
        $this->global['pageTitle'] = 'Client Dashboard';
        $this->loadViews("client/create_case/ajax5", $this->global, $data, NULL, $type);
    }

    public function payment_success($order_id=''){
        if ($order_id=='') {
            redirect('client/dashboard/index/'.$_SESSION['id']);
            exit();
        }
        $data = [];
        // $data['invoiceTemplate'] = $invoiceTemplate;

        // $where['order_id'] = 'order_KwXu7gjoaCSMx1';
        $where['order_id'] = $order_id;
        $payment_data=$this->Payment_model->findDynamic($where);
        // pre($payment_data); 
        // exit();
        $data['payment_data'] = $payment_data[0];
        $this->global['pageTitle'] = 'Client Dashboard';
        $this->loadViews("client/create_case/payment_success", $this->global, $data, NULL, 'client');
    }

    public function payment_failed($order_id='', $error=''){
        $data = [];
        // $where['order_id'] = 'order_KwXu7gjoaCSMx1';
        $where['order_id'] = $order_id;
        $payment_data=$this->Payment_model->findDynamic($where);
        $data['payment_data'] = $payment_data[0];
        // pre($data);

        $data['error'] = $error;
        $this->global['pageTitle'] = 'Client Dashboard';
        $this->loadViews("client/create_case/payment_failed", $this->global, $data, NULL, 'client');
    }
 
     
         
     


}

?>