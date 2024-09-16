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
class Dashboard extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isUserLoggedIn();
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
        $this->load->model('admin/Certificate_model');
        $data['case_category1']=$this->Case_category_model->all();
 
    
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

    public function index()
    {
        // session_unset();
      $id = $_SESSION['id'];
      date_default_timezone_set("Asia/Calcutta");
        
      $curentDate     = strtotime(date('Y-m-d'));
      $data1['curentDate']=$curentDate;
    
      $data1['case_category1']=$this->Case_category_model->all();
    
      $sql = "SELECT * FROM query ";
      $sql .= "WHERE user_id = '".$id."' AND query_status = '0' ORDER BY id DESC ";
      $rData = $this->Query_model->rawQuery($sql);
      $data1['My_all_query']=$rData;

      $sql = "SELECT * FROM clint ";
    //   $sql .= "WHERE id = '".$id."' AND status ='0'";
      $sql .= "WHERE id = '".$id."'";
      $cData = $this->Client_model->rawQuery($sql);
      $data1['clientData']=$cData[0];

        date_default_timezone_set("Asia/Calcutta");
        $where['client_id'] = $id;
        $list=$this->Case_details_model->findDynamic($where);

        $curentTime          = date("Y-m-d H:i:s");

        $sql = "SELECT  *, l.email as l_email,l.fname,l.lname,c.fname as c_fname,c.lname as c_lname,c.email as c_email, TIMESTAMPDIFF(MINUTE, '".$curentTime."', `meeting_time`) as timediff  FROM slot as s"; 
        $sql .= " JOIN lawyer as l ON l.id = s.lawyer_id "; //Fetch lawyer detail from Lawyer table using Id
        $sql .= " JOIN clint as c ON c.id = s.client_id "; //Fetch client detail from clint table using Id
        $sql .=" WHERE  TIMESTAMPDIFF(MINUTE, '".$curentTime."', `meeting_time`) < 15  AND  TIMESTAMPDIFF(MINUTE, '".$curentTime."' , `meeting_time`) > 1 AND `client_id`='".$id."' AND `slot_status`=1  ";
        $data1['meeting_time'] = $this->Slot_model->rawQuery($sql);

       // code for count data strat
         $where=array();
         $where1=array();
         $where3=array();
         $where['client_id']=$id;
         $where3['client_id']=$id;
         $where3['status']=1;
         $where4['client_id']=$id;
         $where4['status']=0;
         $where11['user_id']=$id;
         $where12['user_id']=$id;
         $where12['query_status']=0;
         $where13['user_id']=$id;
         $where13['query_status']=1;
         $where15['client_id']=$id;
         $where15['client_hearing_noti']=0;

        

         $where17['user_id']=$id;
         $where17['query_status']=0;
         $where17['client_query_noti']=0;
         $where17['lawyer_id']=0;
         $where18['user_id']=$id;
         $where18['query_status']=1;
         $where18['client_select_lawyer_noti']=0;

         $table='cases';
         $table1='hearing';
         $table2='slot';
         $table3='z_payment';
         $table4='query';
         $table5='query';
         $w['user_id'] = $id;
         $w['field'] = 'id';
         $totalCase                          = $this->Case_details_model->findByTable($where,$table);

         $totalRuningCases                   = $this->Case_details_model->findByTable($where3,$table);
         $totalPendingCases                  = $this->Case_details_model->findByTable($where4,$table);
         $totalHearing                       = $this->Hearing_date_model->findByTable($where,$table1);
         $totalMeetingDate                   = $this->Slot_model->findByTable($where,$table2);

         $totalPayment11                     = $this->Payment_model->findByTable($where11,$table3);
         
         $toatalQuery                        = $this->Query_model->findByTable($where12,$table4);
         $toatallawyerselectedQuery          = $this->Query_model->findByTable($where13,$table5);
         $HearingNotify                      = $this->Hearing_date_model->findDynamic($where15);
         $QueryNotify                      = $this->Query_model->findDynamic($where17);
         $SelectLawyerNotify                      = $this->Query_model->findDynamic($where18);
         $Documentation                      = $this->Certificate_model->findDynamic($w);

         if(!empty($totalCase)){
             $data1['caseCount'] =  count($totalCase);
             $data1['total_case'] =  json_encode($totalCase);
         }
         if(!empty($totalRuningCases)){
             $data1['totalRuningCases'] =  count($totalRuningCases);
             $data1['total_Runing_Cases'] =  json_encode($totalRuningCases);
         }
         if(!empty($totalPendingCases)){
             $data1['totalPendingCases'] =  count($totalPendingCases);
             $data1['total_Pending_Cases'] =  json_encode($totalPendingCases);
         }

         if(!empty($totalHearing)){
            $data1['totalHearing'] =  count($totalHearing);
            $data1['total_Hearing'] =  json_encode($totalHearing);
        }
         if(!empty($totalMeetingDate)){
            $data1['totalMeetingDate'] =  count($totalMeetingDate);
            $data1['totalMeetingDate1'] =  json_encode($totalMeetingDate);
        }
         if(!empty($totalPayment11)){
              $data1['totalPayment'] =  count($totalPayment11);
              $data1['totalPayment1'] =  json_encode($totalPayment11);
        }
         if(!empty($toatalQuery)){
              $data1['toatalQuery'] =  count($toatalQuery);
              $data1['toatal_Query'] =  json_encode($toatalQuery);
        }
   
         if(!empty($toatallawyerselectedQuery)){
              $data1['toatallawyerselectedQuery'] =  count($toatallawyerselectedQuery);
              $data1['toatal_lawyer_selected_Query'] =  json_encode($toatallawyerselectedQuery);
        }
     
         if(!empty($HearingNotify)){
              $data1['HearingNotify'] =  count($HearingNotify);
              $data1['Hearing_Notify'] =  json_encode($HearingNotify);
        }
    
         if(!empty($QueryNotify)){
              $data1['QueryNotify'] =  count($QueryNotify);
              $data1['Query_Notify'] =  json_encode($QueryNotify);
        }
         if(!empty($SelectLawyerNotify)){
              $data1['SelectLawyerNotify'] =  count($SelectLawyerNotify);
              $data1['Select_Lawyer_Notify'] =  json_encode($SelectLawyerNotify);
        }
         if(!empty($Documentation)){
              $data1['Documentation'] =  count($Documentation);
              $data1['Select_Lawyer_Notify'] =  json_encode($Documentation);
        }

         /* end code for order details */

         $where1['client_id']=$id;
         $table='slot';
         $totalmeeting = $this->Slot_model->findByTable($where1,$table);
          // Count Total slot start
         if(!empty($totalmeeting)){
             $data1['meetingCount'] =  count($totalmeeting);
             $data1['total_case'] =  json_encode($totalmeeting);
         }
           // Count Total slot end
        $where               = array();
        $data['id']          = $id;
        $row=array();
       
        //fetch perticular client details 
        $where['client_id']   = $id;
        $where['status']      = 1;
        $data1['name']        = $_SESSION['name'];
        $data1['email']       = isset($_SESSION['email'])?$_SESSION['email']:'';
        $data1['case_detail'] = $this->Case_details_model->findDynamic($where);

        $sql = "SELECT c.*, l.fname,l.lname,l.email, l.lawyer_img,  l.experience, cc.name as case_cat_name,  s.zoom_link_id ,s.zoom_link,s.time, s.period,s.lawyer_id,s.client_id,s.case_id,s.reply,s.contact_mode,s.slot_date,s.slot_status,s.meeting_time,s.id as slot_id  FROM cases as c "; 
        $sql .= " JOIN lawyer as l ON l.id = c.asign_lawyer_id "; 
        $sql .= " JOIN case_category as cc ON cc.id = c.case_category_id "; 
        // $sql .= " JOIN case_sub_category as csc ON csc.id = c.case_sub_category_id "; 
        $sql .= " LEFT JOIN slot as s ON s.case_id = c.id "; 

        $sql .= "WHERE c.client_id = '".$_SESSION['id']."' AND c.status = '1' ORDER BY c.id DESC ";
        $rData = $this->Case_details_model->rawQuery($sql);

        $data1['fulldata']         = $rData;


        // all query count
        $w = array();
        $w['table'] = 'client_query';
        $w['parent_id'] = '0';
        $w['user_id'] = $_SESSION['id'];
        $w['field'] = 'id,status';
        $qData = $this->lawyer_model->findDynamic($w);

        // all case count
        $w = array();
        $w['table'] = 'cases';
        $w['client_id'] = $_SESSION['id'];
        $w['field'] = 'id,status';
        $caseData = $this->lawyer_model->findDynamic($w);

        $data1['caseData']  = $caseData;
        $data1['totalQuery']  = count($qData);
        $tempPendingQuery = 0;
        foreach ($qData as $key => $value) {
            if($value->status == '0'){
                $tempPendingQuery++;
            }
        }
        $data1['pendingQuery']  = $tempPendingQuery;

        // get user deatils -----------------------
        //TODO

        $this->global['pageTitle'] = 'Client Dashboard';
        // cehck page status
        if(isset($_GET['action']) && $_GET['action'] == 'welcome'){
            $isWelcomeScreen = true;   
        }else if(isset($_GET['action']) && $_GET['action'] == 'login' && (count($caseData) == 0 && count($qData) == 0)){
            $isWelcomeScreen = true;   
        }
        if(isset($isWelcomeScreen)){
            $this->global['pageTitle'] = 'Welcome to Insaaf99';
            $this->global['menu_hide'] = '1';
            $data1['footer_hide'] = 1;
            $this->loadViews("client/welcome", $this->global, $data1, NULL, 'client');   
        }else{
            $this->loadViews("client/dashboard", $this->global, $data1, NULL, 'client');
        }
    }
    




    // ===================================================
     public function remainder(){
        date_default_timezone_set("Asia/Calcutta");

         $insertData['dt']           = date("Y-m-d H:i:s");
     }

    // Show al case list start
    public function total_cases($id = NULL)
    {
        $id=base64_decode($id);
        $data['case_category1']=$this->Case_category_model->all();
    
        $data['client_id']=$id;
        $this->global['pageTitle'] = 'Client total cases ';
        $this->loadViews("client/total_cases/list", $this->global, $data, NULL, 'client');
    }
    public function runing_caes($id = NULL)
    {
        $data['case_category1']=$this->Case_category_model->all();
        $data['client_id']=$id;
        $this->global['pageTitle'] = 'Client total cases ';
        $this->loadViews("client/runing_caes/list", $this->global, $data, NULL, 'client');
    }
    public function pending_caes($id = NULL)
    {
        $id=base64_decode($id);
        $data['case_category1']=$this->Case_category_model->all();
        $data['client_id']=$id;
        $this->global['pageTitle'] = 'Client total cases ';
        $this->loadViews("client/pending_cases/list", $this->global, $data, NULL, 'client');
    }
    // Show al case list end 
    
    
    // book slot end
    
    // Update Slot *************************************************************
    public function updateslot()
    {
        
        $this->isUserLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('slot_date', 'slot date', 'trim|required');
       // $this->form_validation->set_rules('time', 'Time', 'trim|required');
        $this->form_validation->set_rules('period', 'Period', 'trim|required');
        $this->form_validation->set_rules('case_id', 'Case', 'trim|required');
        $this->form_validation->set_rules('slot_id', 'Case', 'trim|required');
        $this->form_validation->set_rules('client_id', 'Client Case', 'trim|required');
        $this->form_validation->set_rules('contact_mode', 'contact Mode', 'trim|required');
        
        //form data 
        $form_data = $this->input->post();
        // pre($form_data);
        //     exit();
        if ($this->form_validation->run() == FALSE) {
            
            $this->session->set_flashdata('error', 'Please fill the form correctly');
            $this->index($form_data['client_id']);
        } else {
            // pre($form_data);
            
            $insertData['id']           = $form_data['slot_id'];
            $insertData['case_id']      = $form_data['case_id'];
            $insertData['client_id']    = $form_data['client_id'];
            $insertData['lawyer_id']    = $form_data['lawyer_id'];
            $insertData['slot_date']    = $form_data['slot_date'];
            $time                       =$form_data['time'];
            $insertData['time']         = date('h:i A', strtotime($time));
            $insertData['period']       = $form_data['period'];
            $insertData['contact_mode'] = $form_data['contact_mode'];
            $insertData['slot_status']       = 0;
            $insertData['dt']           = date("Y-m-d H:i:s");
            
            $result = $this->Slot_model->save($insertData);
            if (!empty($result)) {
                /* send mail, SMS & notificatio on booking slot start */
                $clientData=$this->Client_model->find($form_data['client_id']);
                $lawyerData=$this->lawyer_model->find($form_data['lawyer_id']);
                $slotData=$this->Slot_model->find($form_data['slot_id']);

                nitification_when_book_slot($clientData,$lawyerData,$slotData);// function for send email sms & notification
               /* send mail, SMS & notificatio on booking slot start */
            }
            
            if ($result > 0) {
                
                
                $this->session->set_flashdata('success', 'Slot Booked Sulleccfuly');
                redirect('client/Dashboard');
                
            } else {
                
                $this->session->set_flashdata('error', 'Failed to book slot');
                $this->index();
            }
            
        }
        
    }
    


     // cases  list
     public function ajax_list($client_id = NULL)
     { 
        $client_id=base64_decode($client_id);
        error_reporting(0);
         $where=array();        //  pre($list);
         $where['client_id'] = $client_id;
         // $where['orderby'] = -1;
         // $table='cases';
         $list = $this->Case_details_model->get_datatables($where);
      
         $data = array();
         $no =(isset($_POST['start']))?$_POST['start']:'';
 
        
         // save data for parent catelgory list
       
         foreach ($list as $currentObj) {
             $temp_date = $currentObj->dt;
             $date_at = date("d-m-Y", strtotime($temp_date));
             $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
            $row[] = $date_at;
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
             $row[] = ' <a class="btn btn-sm btn-info " style="margin: 2px;" href="'.base_url().'client/Dashboard/Total_case_view/'.base64_encode($currentObj->id).'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
 
             $data[] = $row;
         }
         $output = array(
                         "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                         "recordsTotal" => $this->Case_details_model->count_all($where),
                         "recordsFiltered" => $this->Case_details_model->count_filtered(),
                         "data" => $data,
                 );
         //output to json format
         echo json_encode($output);
     }
     // cases  list
     public function ajax_list1($client_id = NULL)
     { 
        error_reporting(0);
         $where=array();
         $list =$this->Case_details_model->findBy();
   
         $where['client_id'] = $client_id;
         $where['status'] = 1;
         $table='cases';
         $list = $this->Case_details_model->findByTable($where,$table);
        //  pre($list);
        //  exit();
         $data = array();
         $no =(isset($_POST['start']))?$_POST['start']:'';
 
        
         // save data for parent catelgory list
       
         foreach ($list as $currentObj) {
             $temp_date = $currentObj->dt;
             $date_at = date("d-m-Y", strtotime($temp_date));
             $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
             $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
             $row[] = $date_at;
            //  $row[] = ' <a class="btn btn-sm btn-info " href="'.base_url().'client/client/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
 
             $data[] = $row;
         }
         $output = array(
                         "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                         "recordsTotal" => $this->Case_details_model->count_all($where),
                         "recordsFiltered" => $this->Client_model->count_filtered(),
                         "data" => $data,
                 );
         //output to json format
         echo json_encode($output);
     }
     public function ajax_list2($client_id = NULL)
     { 
        error_reporting(0);
         $where=array();   
         $where['client_id'] = $client_id;
         $where['status'] = 0;
         $table='cases';
         $list = $this->Case_details_model->get_datatables($where);
      
         $data = array();
         $no =(isset($_POST['start']))?$_POST['start']:'';
 
        
         // save data for parent catelgory list
       
         foreach ($list as $currentObj) {
             $temp_date = $currentObj->dt;
             $date_at = date("d-m-Y", strtotime($temp_date));
             $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
            $row[] = $date_at;
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
            //  $row[] = ' <a class="btn btn-sm btn-info " href="'.base_url().'client/client/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
             // $row[] = ' <a class="btn btn-xs btn-info" style="margin: 4px;" href="'.base_url().'client/Dashboard/Total_case_view/'.base64_encode($currentObj->id).'" title="view"  data_id="'.$currentObj->id.'" >Make Payment</a> ';
             $row[] = ' <a class="btn btn-sm btn-info" style="margin: 4px;" href="'.base_url().'client/Dashboard/Total_case_view/'.base64_encode($currentObj->id).'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
 
             $data[] = $row;
         }
         $output = array(
                         "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                         "recordsTotal" => $this->Case_details_model->count_all($where),
                         "recordsFiltered" => $this->Case_details_model->count_filtered($where),
                         "data" => $data,
                 );
         //output to json format
         echo json_encode($output);
     }


     public function Total_case_view($id = NULL)
     {
        $id=base64_decode($id);
         if($id == null)
         {
            redirect('client/dashboard');
         }
         $case_data = $this->Case_details_model->find($id);
         $data['case_data'] = $case_data;
       
         if(!empty($data['case_data'])){
             $lawyerId=$data['case_data']->asign_lawyer_id;
             $where2 = array();
             $where2['id'] = $lawyerId;
             $lawyer_data = $this->lawyer_model->findDynamic($where2);
             $data['lawyer_data'] = $lawyer_data[0];

             $case_cat_data = $this->Case_category_model->find($case_data->case_category_id);
             $data['case_cat_data'] = $case_cat_data;

             $payment_data = $this->Payment_model->find($case_data->payment_id);
             $data['payment_data'] = $payment_data;

         }
        
         // pre($data );
         // exit();
        
         $this->global['pageTitle'] = 'Client Dashboard';
         $this->loadViews("client/total_cases/view", $this->global, $data , NULL ,'client');    
         
     } 

     public function insertnow()
     {
         
         date_default_timezone_set('Asia/Kolkata');
         $this->isLoggedIn();
         $this->load->library('form_validation');
         $this->form_validation->set_rules('asign_lawyer_id', ' Lawyer name', 'trim|required');
         //form data 
         $form_data = $this->input->post();
         
         if ($this->form_validation->run() == FALSE) {
             $this->addnew();
         } else {
             $insertData                         = array();
             $insertData['case_category_id']     = $form_data['case_category_id'];
             $insertData['case_sub_category_id'] = $form_data['case_sub_category_id'];
             $insertData['asign_lawyer_id']      = $form_data['asign_lawyer_id'];
             $insertData['case_description']     = $form_data['case_description'];
             $insertData['client_id']            = $form_data['client_id'];
             $insertData['status']               = $form_data['status'];
             $insertData['payment']              = '';
             $insertData['payment_status']       = 0;
             $insertData['dt']                   = date("Y-m-d H:i:s");
             
             // upload file
             if (isset($_FILES['case_file']['name']) && $_FILES['case_file']['name'] != '') {
                 
                 $f_name      = $_FILES['case_file']['name'];
                 $f_tmp       = $_FILES['case_file']['tmp_name'];
                 $f_size      = $_FILES['case_file']['size'];
                 $f_extension = explode('.', $f_name);
                 $f_extension = strtolower(end($f_extension));
                 $f_newfile   = uniqid() . '.' . $f_extension;
                 $store       = "uploads/cases/" . $f_newfile;
                 
                 if (!move_uploaded_file($f_tmp, $store)) {
                     $this->session->set_flashdata('error', 'Image Upload Failed .');
                 } else {
                     // $file = "uploads/cases/".$form_data['oldimage'];
                     
                     // if(file_exists( $file))
                     // {
                     //     unlink($file);
                     // }
                     
                     $insertData['case_file'] = $f_newfile;
                     
                 }
                 
             }
             
             $result = $this->Case_details_model->save($insertData);
             if ($result > 0) {
                 $this->session->set_flashdata('success', 'Case added successfully');
                 redirect('admin/Case_details/index/' . $insertData['client_id']);
             } else {
                 $this->session->set_flashdata('error', 'Case  Addition failed');
             }
             redirect('admin/client/addnew');
         }
         
     }
     public function Find_lawyer_data()
     {

        date_default_timezone_set("Asia/Calcutta");
        
        $curentDate     = date('Y-m-d H:i:a');
       
        $data['queryId']= $_POST['queryId'];
        $data['user_ID']= $_POST['user_ID'];
        $data['lawyerId']= $_POST['lawyerId'];

        $sql = "SELECT * FROM lawyer_scheduler";   
        $sql .=" WHERE schedule_date  > '".$curentDate."'AND `lawyer_id`='".$_POST['lawyerId']."' AND `schedule_status`=1 ORDER BY schedule_date ";
        $data['schedule_data'] = $this->Lawyer_scheduler_model->rawQuery($sql);
    // pre($data['schedule_data']);
    // exit();
        $where=array();
        $where['lawyer_id'] = $_POST['lawyerId'];
        $tempDbData=$this->Slot_model->findDynamic($where);

        if(!empty($tempDbData)){
            foreach ($tempDbData as $key => $value) {
                $data['slot_data'][$value->slot_date][$value->time]  = 1;       
            }
        }
        

        
        $this->global['pageTitle'] = 'Client Dashboard';
        $this->loadViews("client/find_schedule_data", $this->global, $data, NULL, 'client');

       
     }

   
     
     
    public function Select_lawyer()
    { 
        date_default_timezone_set("Asia/Calcutta");
        $form_data = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('schedule_date', 'schedule date', 'trim|required');
        $this->form_validation->set_rules('schedule_time', 'schedule time', 'trim|required');
   
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'status' => 'true1',
             
            ));
            exit();
        }
          
        
        $sql="SELECT * FROM `query` WHERE `id`='".$form_data['query_id']."'";
        $rData = $this->Case_details_model->rawQuery($sql);
        $query_data= $rData[0];
        $clientData=$this->Client_model->find($form_data['client_id']);
        $lawyerData=$this->lawyer_model->find($form_data['lawyer_id']);

        $updateData['id']           = $query_data->id;
        $updateData['lawyer_id']    =$form_data['lawyer_id'];
        $updateData['query_status'] =1;
      
        $query_update = $this->Query_model->save($updateData);// Update Query table 
       
        if(isset($query_update) && !empty($query_update)){

            $insertData                         = array();
            $insertData['case_category_id']     = $query_data->case_cat_id;
            $insertData['asign_lawyer_id']      = $form_data['lawyer_id'];
            $insertData['case_description']     = $query_data->query;
            $insertData['client_id']            = $form_data['client_id'];
            $insertData['status']               =1;
            $insertData['payment']              = 'qq';
            $insertData['payment_status']       = 0;
            $insertData['dt']                   = date("Y-m-d H:i:a");
            $insertData['case_file']            = $query_data->querry_file;
            
            $result = $this->Case_details_model->save($insertData);// Insert into Case table 
           
    
            $sql="SELECT * FROM `cases`  WHERE `client_id`='".$form_data['client_id']."' ORDER by id DESC LIMIT 1 ";
            $rData = $this->Case_details_model->rawQuery($sql);
            $cases_data= $rData[0];
       
            $insertData1['lawyer_id']    = $form_data['lawyer_id'];
            $insertData1['client_id']    = $form_data['client_id'];
            $insertData1['query_Id']     = $form_data['query_id'];
            $insertData1['case_id']      = $cases_data->id;
            $insertData1['slot_date']    = $form_data['schedule_date'];
            $insertData1['time']         =date('H:i:s',strtotime($form_data['schedule_time'])); 
            $insertData1['meeting_time'] = date('Y-m-d',strtotime($form_data['schedule_date'])).' '.date('H:i:s',strtotime($form_data['schedule_time']));
            $insertData1['period']       = '15 minutes';
            $insertData1['contact_mode'] = 'Insaaf99 Meeting';
            $insertData1['slot_status']  = 1;
            $insertData1['dt']           = date("Y-m-d H:i:s");
    
            $result1 = $this->Slot_model->save($insertData1);// Update Slot table

            if ( $result AND $result1  > 0 ) {

                $clientData=$this->Client_model->find($form_data['client_id']);
                $lawyerData=$this->lawyer_model->find($form_data['lawyer_id']);
                $slotData=$this->Slot_model->find($result1);
               
                nitification_when_book_slot($clientData,$lawyerData,$slotData);// function for send email sms & notification
    
                $this->session->set_flashdata('success', 'You have successfully Selected a lawyer');
                redirect('client/Dashboard');
                
            } else{
                
                $this->session->set_flashdata('error', 'Failed to  Select a lawyer');
                redirect('client/Dashboard');
                
            }

        }
       
      
    }
    

    public function book_slot_again()
     {
        date_default_timezone_set("Asia/Calcutta");
        
        $curentDate     = date('Y-m-d');

        $data['slot_id']= $_POST['slot_id'];
        $data['client_id']= $_POST['client_id'];
        $data['lawyer_id']= $_POST['lawyer_id'];

        $where=array();
        $where['lawyer_id'] = $_POST['lawyer_id'];
       
        $sql = "SELECT * FROM lawyer_scheduler";   
        $sql .=" WHERE schedule_date  > '".$curentDate."'AND `lawyer_id`='".$_POST['lawyer_id']."' AND `schedule_status`=1 ORDER BY schedule_date ";
        $data['schedule_data'] = $this->Lawyer_scheduler_model->rawQuery($sql);

        $tempDbData=$this->Slot_model->findDynamic($where);

        if(!empty($tempDbData)){
            foreach ($tempDbData as $key => $value) {
                $data['slot_data'][$value->slot_date][$value->time]  = 1;       
            }
        }
        

        
        $this->global['pageTitle'] = 'Slot Booking';
        $this->loadViews("client/slot_book_again", $this->global, $data, NULL, 'client');

        
     }

     public function update_slot()
     {
         date_default_timezone_set("Asia/Calcutta");
         $form_data = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('schedule_date', 'schedule date', 'trim|required');
        $this->form_validation->set_rules('schedule_time', 'schedule time', 'trim|required');
   
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'status' => 'true1',
                'reload' => base_url('client/dashboard/book_slot_again')
             
            ));
            exit();
        }
        $sql = "SELECT * FROM lawyer";// Fetch Data from lawyer table using lawyer ID
        $sql .= " WHERE id = '".$form_data['lawyer_id']."'";
        $lawyerData = $this->lawyer_model->rawQuery($sql);
        $lData=$lawyerData[0];
       
            $insertData['id']           = $form_data['slot_id'];
            $insertData['lawyer_id']    = $form_data['lawyer_id'];
            $insertData['client_id']    = $form_data['client_id'];
            $insertData['slot_date']    = $form_data['schedule_date'];
            $insertData['time']         = date('H:i:s',strtotime($form_data['schedule_time']));
            $insertData['meeting_time'] =date('Y-m-d',strtotime($form_data['schedule_date'])).' '.date('H:i:s',strtotime($form_data['schedule_time']));
            $insertData['period']       = '15 minuts';//$form_data['period'];
            $insertData['contact_mode'] = 'Insaaf99 Meeting';//$form_data['contact_mode'];
            $insertData['slot_status']  = 1;
            $insertData['again_status_noti'] = 1;
            $insertData['dt']           = date("Y-m-d H:i:s");
 
            $result = $this->Slot_model->save($insertData);
            if ($result > 0 ) { 

                $clientData=$this->Client_model->find($form_data['client_id']);
                $lawyerData=$this->lawyer_model->find($form_data['lawyer_id']);
                $slotData=$this->Slot_model->find($form_data['slot_id']);

               nitification_when_book_slot($clientData,$lawyerData,$slotData);// function for send email sms & notification

                echo json_encode(array(
                    'status' => 'true2',
                    'reload' => base_url('client/Dashboard/index/'.base64_encode($form_data['client_id']))
                ));
            } else{
                echo json_encode(array(
                    'status' => 'true3',
                    'reload' => base_url('client/Dashboard/index/'.base64_encode($form_data['client_id']))
                ));
                
               
                
            }
    }
  
    public function Pass_date()
    {
        date_default_timezone_set("Asia/Calcutta");

        $form_data = $this->input->post();
        $date = date("d-m-Y", strtotime($form_data['schedule_date']));
        $where=array();
        $where['lawyer_id']=$form_data['lawyer_id'];
        $where['schedule_date']=$date;
        $data['schedule_data']=$this->Lawyer_scheduler_model->findDynamic($where);

        // echo json_encode($data['schedule_data']); 
        // exit();
    }
    // Free query function start
    public function Free_query($id)
    {
        $id=base64_decode($id);
        date_default_timezone_set("Asia/Calcutta");
        $form_data = $this->input->post();
        // pre($form_data);
        // exit();
        $where=array();
        $where['id']=$form_data['q_id'];
        $where['user_id']=$id;
        $Query=$this->Query_model->findDynamic($where);
        $data['Query_data']=$Query[0];
    
       $this->global['pageTitle'] = 'Client free query';
       $this->loadViews("client/free_query", $this->global, $data, NULL, 'client');
    }
    // Update Slot *************************************************************
    public function Send_free_query()
    {

        $this->isUserLoggedIn();
        $form_data = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('query', 'Query', 'trim|required');
  
        if ($this->form_validation->run() == FALSE) {
            
            $this->session->set_flashdata('error', 'Please fill correctly');
            $this->Free_query($form_data['client_id']);
        } else {
            
     
            $insertData['id']               = $form_data['q_id'];
            $insertData['user_id']          = $form_data['client_id'];
            $insertData['lawyer_id']        =182;
            $insertData['query']            = $form_data['query'];
            $insertData['client_f_query']   = 1;
            $insertData['query_status']     = 1;


           $addNotiToLawyer=array();
           $addNotiToLawyer['user_type']=2;// for Lawyer
           $addNotiToLawyer['user_id']=182;
           $addNotiToLawyer['subject']="A free query sent by ".$_SESSION['name'];
           $firsttenwords = shorten_string($form_data['query'], 15);// get some words 
           $addNotiToLawyer['msg']=$firsttenwords;// for Lawyer
           $addNotiToLawyer['act_slug']=base_url().'lawyer/text_query';
           $addNotiToLawyer['status']=0;
           $addNotiToLawyer['dt']=date("Y-m-d H:i:s");
    
           notification($addNotiToLawyer);
     
           $addNotiToAdmin=array();
           $addNotiToAdmin['user_type']=1;// for Admin
           $addNotiToAdmin['user_id']=2;
           $addNotiToAdmin['subject']="A free query sent by ".$_SESSION['name']." to Advocate Vinny Shangloo";
           $firsttenwords = shorten_string($form_data['query'], 15);// get some words 
           $addNotiToAdmin['msg']=$firsttenwords;// for Admin
           $addNotiToAdmin['act_slug']=base_url().'admin/Query';
           $addNotiToAdmin['status']=0;
           $addNotiToAdmin['dt']=date("Y-m-d H:i:s");
    
          notification($addNotiToAdmin);// For Admin


            $result = $this->Query_model->save($insertData);
            
            $updateData['id']    = $form_data['client_id'];
            $updateData['f_pay_free'] = 1;
            $result1 = $this->Client_model->save($updateData);
            
            if (!empty($result)) {

           
                // Send SMS in Mobile Number start 
                $clientname = explode(' ',trim($_SESSION['name']));
                $message='Dear '.$clientname[0].'
                
Thank you for contacting Insaaf99.com
Your query will be shortly answered by our Expert Lawyer';
                           
             send_sms($_SESSION['phone'],$message);
             

                /* send mail for Lawyer to book slot for lawyer */
                $toEmail= "vinny@insaaf99.com";  // lawyer email
                $subject="Client First Query";
                $heading="First Query From a Client";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['c_name']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Email : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['c_email']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['c_mobile']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['query']."</span></td>
                    </tr>
                </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);

                
                /* end code for Lawyer to book slot  send email */
                
                /* code for send  mail query confirmation for client */
                $toEmail = $form_data['c_email']; // Client gmail addresss 
                $subject = "Query Sent Successfully to Lawyer";
                $heading="Dear ".$form_data['c_name']." Thank you for contacting Insaaf99. Showing your interest in Insaaf99 is valuable to us.";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Your query will be shortly answered by our Expert Lawyers within 48 hours.</td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Regards</td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Team</td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Insaaf99</td>
                    </tr>
                </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);
                /* end code for send  mail  to slot booking confirmation */
            }
            
            if ($result > 0) {
                
                
                $this->session->set_flashdata('success', 'Your Query Sent Sulleccfuly to the Lawyer');
                redirect('client/dashboard/index/'.base64_encode($form_data['client_id']));
                
            } else {
                
                $this->session->set_flashdata('error', 'Failed To Send Query');
                redirect('client/Dashboard/Free_query'.$form_data['client_id']);
              
            }
            
        }
        
    }

     // code for register 
     public function Registration_pay_later()
     {
  
       $sql="select * from clint where `id`='".$this->input->post('id')."'";
       $ct_Data=$this->Client_model->rawQuery($sql);
       $client_Data= $ct_Data[0];

             
             if (empty($client_Data)) {
            $clientID=$this->input->post('id');
                 $this->session->set_flashdata('error', 'This User does not match !');
                 redirect(base_url('client/Dashboard/index/'.base64_encode($clientID)));
                 
             } else {
                     
                    date_default_timezone_set('Asia/Kolkata');
                     $DataInSession['id']       = $client_Data->id;
                     $DataInSession['fname']       = $client_Data->fname;
                     $DataInSession['lname']       = $client_Data->lname;
                     $DataInSession['email']       = $client_Data->email;
                     $DataInSession['password']    = $client_Data->password;
                     $DataInSession['client_type'] = 1;
                     $DataInSession['mobile']      = $client_Data->mobile;
                     $DataInSession['message']     = $client_Data->message;
                     $DataInSession['term_condi']  = $client_Data->term_condi;
                     $DataInSession['f_pay_free']  = 0;
                     $DataInSession['status']      = 0;
                    //  $insertdata['dt']          = date('Y-m-d H:i:s');
                    // pre($insertdata);
                    // exit();
                    
                     // ===============================================================================
                     $image = array();
                     /* code for image upload */
            
                     
                     // 99 patment gatway
                     
                     date_default_timezone_set("Asia/Calcutta");
                     $api                        = new Api($this->config->item('razPaykey_id'), $this->config->item('razSecret'));
                     $_SESSION['payable_amount'] = 99;
                     
                     $razorpayOrder = $api->order->create(array(
                         'receipt' => rand(),
                         'amount' => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
                         'currency' => 'INR',
                         'payment_capture' => 1 // auto capture
                     ));
                     
                     $amount = $razorpayOrder['amount'];
                     
                     $razorpayOrderId               = $razorpayOrder['id'];
                     $_SESSION['razorpay_order_id'] = $razorpayOrderId;
                     $data['orderDetails']          = $this->prepareData($amount, $razorpayOrderId, $DataInSession);
                     
                    //  $result = $this->Client_model->save($insertdata); // insert in client table
 
 // ====================================================================================================
 
                     $sessionArray = array(
                         'id' => $client_Data->id,
                         'role' => 'user',
                         'email' => $client_Data->email,
                         'mobile' => $client_Data->mobile,
                         'password' => $client_Data->password,
                         'name' => $client_Data->fname." ".$client_Data->lname,
                         'isUserLoggedIn' => TRUE
                     );
                     
                     // $sessionArray['ClientDetails'] = $sessionData;
                   $this->session->set_userdata($sessionArray);
                //    pre($_SESSION);
                //    exit();
                
                     
                     $paymentData                   = array();
                     $paymentData['user_id']        = $DataInSession['id'];
                     $paymentData['name']           = $DataInSession['fname'] . " " . $DataInSession['lname'];
                     $paymentData['email']          = $DataInSession['email'];
                     $paymentData['mobile']         = $DataInSession['mobile'];
                     $payAmount                     = $amount / 100;
                     $paymentData['amount']         = $payAmount;
                     $paymentData['payment_date']   = date("Y/m/d h:m:s");
                     $paymentData['order_id']       = $razorpayOrderId;
                     $paymentData['payment_mode']   = 'razorpay';
                     $paymentData['payment_type']   = 'Registration';
                     $paymentData['payment_status'] = 'pending';
                     
                    //  pre($paymentData);
                    //     exit();
                     $result   =   $this->Payment_model->save($paymentData);
                     
                     if ($result > 0) {
                        
                        $data_view_port=$this->load->view('front/razorpay-manual',$data,TRUE);
                  echo $data_view_port;

                         // $this->session->set_flashdata('success', 'You have Successfully Registered into Insaaf99.com');
                         // redirect(base_url('signup_ajax/register1'));
                     } else {
                        
                         $this->session->set_flashdata('error', ' Failed to Register');
                         redirect(base_url('signup_ajax/register1'));
                     }
                   
                   
                     
                     
                 }
             }
         
}

?>