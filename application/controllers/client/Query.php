<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
use Razorpay\Api\Api;



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Query extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       
       $this->load->model('admin/client_query_model');
       $this->load->model('admin/lawyer_model');
       $this->load->model('support_model');

       $this->isUserLoggedIn(); 
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        // pass data in view    
        $data = array();
        $list = $this->client_query_model->get_datatables();
        $data['queryData'] = $list;
        $this->global['pageTitle'] = 'My Query';
        $this->loadViews("client/query/list", $this->global, $data, NULL, 'client');   
    }

    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        date_default_timezone_set('Asia/Kolkata'); 
        $this->isUserLoggedIn(); 
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('name','size Name','trim|required'); 
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {
            $insertData = array();
            $insertData['name'] = $form_data['name'];
            $insertData['status'] = $form_data['status'];
            $insertData['date_at'] = date("Y-m-d H:i:s");	
            $result = $this->lawyer_model->save($insertData);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'size successfully Added');
            }
            else
            { 
                $this->session->set_flashdata('error', 'size Addition failed');
            }
            redirect('lawyer/lawyer/addnew');
          }  
        
    }

    //  this code  code user detaisl  
    public function userData(){
       
        if(!empty($_SESSION['id'])){
            $userID = $_SESSION['id'];
            $userData = $this->lawyer_model->find($userID);
            if(!empty($userData)){
                $data['userData'] = $userData;
                $this->isUserLoggedIn(); 
                $this->global['pageTitle'] = 'Insaaf99 : Lawyer';
                $this->loadViews("lawyer/lawyer/list", $this->global, $data , NULL ,'lawyer');
            }
        }
    }
    // end code for user details 

    // Member list
    public function ajax_list()
    {   
        error_reporting(0);
		$list = $this->client_query_model->get_datatables();
        $parentCategoryList = array();
		$data = array();
        $no = (isset($_POST['start']))?$_POST['start']:'';
        // save data for parent catelgory list
        
        foreach ($list as $currentObj) {
            
            $new = ($currentObj->client_seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';
            
            $temp_date = $currentObj->dateAt;
            $date_at = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<p class="wrapText">'.$currentObj->msg.'<p>';
            $userData = $this->lawyer_model->find($currentObj->assign_lawyer);
            $row[] = $userData->fname;
            $row[] = ($currentObj->status == 1)?'<span class="text-danger" >Closed</span>':'<span class="text-success" >Open</span>'.$new;
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info " href="'.base_url().'client/query/chat/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
            
            $data[] = $row;
            }
            

        
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->client_query_model->count_all(),
                        "recordsFiltered" => $this->client_query_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    // Edit
 
    public function edit($id = NULL)
    {
        
        $this->isUserLoggedIn(); 
        if($id == null)
        {
            redirect('lawyer/lawyer');
        }
        $data['edit_data'] = $this->lawyer_model->find($id);
        $this->global['pageTitle'] = 'Insaaf99 : Lawyer  ';
        $this->loadViews("lawyer/lawyer/edit", $this->global, $data , NULL ,'lawyer');    
        
    } 

    public function chat($id = NULL)
    {
  
     

        $data = array();
        if(isset($id) && !empty($id)){
            $this->client_query_model->save(array('id'=> $id,'client_seen'=>1));// update query seen
            // get assign lawyer details 
            $sql = "SELECT l.*, q.status as chat_status, q.closed_by FROM client_query as q JOIN lawyer as l ON l.id = q.assign_lawyer WHERE q.id = '".$id."' ";
            
            $uData = $this->client_query_model->rawQuery($sql);
            $data['lawyer'] = (isset($uData) && !empty($uData))?$uData[0]:'';
            $data['chatId'] = $id;
        }

        if(!empty($id)){
            $data['firsMessage'] = true;
            // get chat
            $sql = "SELECT * FROM client_query WHERE parent_id = '".$id."' OR id = '".$id."'";
            $chatData = $this->client_query_model->rawQuery($sql);
            
            foreach($chatData as $k=>$v){
                if($v->user_id != $_SESSION['id']){
                    $data['firsMessage'] = false;
                }
            }

        }




        //Define pass data in view ==================================
        $userName = (isset($uData) && !empty($uData))?$uData[0]->fname:'';
        $data['chat_hide'] = '1';    

        $this->global['pageTitle'] = 'Chat with '.$userName;
        $this->loadViews("client/query/chat", $this->global, $data , NULL ,'client');    
        
    } 

    // chat refresh & save
    public function chat_refresh(){

        $fData = $_POST;
        $rData = array();

        // insert chat message in database

        if(isset($fData['msg']) && !empty($fData['msg']) ){
            // insert function 
            $w =  array();
            $w["status"]= "0";
            $w["user_id"]= $_SESSION['id'];
            $w["type"]= $fData['userType'];
            $w["dateAt"]= date("Y-m-d H:i:s");
            $w["updateAt"]= date("Y-m-d H:i:s");
            $w["parent_id"]= empty($fData['chatId'])?0:$fData['chatId'];
            $w["msg"]= $fData['msg'];
            $w["seen"]= "0";
            if(empty($fData['chatId'])){
                $w["assign_lawyer"]= "182";
            }
            $insId = $this->client_query_model->save($w);

            if(empty($fData['chatId'])){
                //send first query message admin
                $rArr = array('new_query'=>1,'chatId'=>$insId);
                $rArr['message'] = $this->admin_first_query_message($fData['msg'],$insId);
                echo json_encode($rArr);
                exit;
            }
        }

       // get chat data query 
       $sql = "SELECT * FROM client_query WHERE parent_id = '".$fData['chatId']."' OR id = '".$fData['chatId']."' ORDER BY id DESC LIMIT 150";
       $chatData = $this->client_query_model->rawQuery($sql);
       $updateStatus = 0;
       if(!empty($chatData)){
        foreach ($chatData as $k => $v) {
            $rData[$v->id] = $v;
            if($v->user_id != $_SESSION['id'] &&  $v->seen == 0){
                $updateStatus = 1;
            }
            $lastChatId = isset($lastChatId)?$lastChatId:$v->id;
        }
       }

       // update seen status 
       if($updateStatus == 1){
         $userType = isset($_SESSION['role'])?$_SESSION['role']:'';
         $checkUserType = (strtolower($userType) == 'client')?'lawyer':'client';
         $sql = "UPDATE client_query SET seen = '1' WHERE parent_id = '".$fData['chatId']."' AND type != '".strtolower($checkUserType)."' ";
         $this->client_query_model->rawQuery($sql);
         $lastChatId = '1';
       }
       
      
       if(isset($lastChatId) && $lastChatId == $fData['latChatId']){
         echo 'no_have_new';
       }else{
           echo json_encode($rData);
       }
    } 

    // slot_book *************************************************************
    public function slot_book($id)
    {   
        if(empty($_SESSION['email'])){
            header("Location:".base_url('client/profile/edit/'.$_SESSION['id'].'?action=verify_email'));
            exit;
        }
        $this->load->model('admin/case_details_model');
        $this->load->model('admin/slot_model');
        $this->load->model('admin/payment_model');
        $chatData = $this->client_query_model->find($id);
        if(!empty($chatData)){
             echo '<div class=""style="height:100vh;text-align: center;padding-top: 202px;" >
                <img src="'.base_url('assets/images/progress.gif').'" width="140">
                <p>Please wait..</p>
            </div>';
            //pre($chatData);
            $temp = str_replace('--complete_slot--', '', $chatData->msg);
            $json = base64_decode($temp);
            $arr  = json_decode($json,true);

            // get case detials
            $queryData = $this->client_query_model->find($chatData->parent_id);
            $payAmount  = 99*100;
            
            // create order id
            $api = new Api($this->config->item('razPaykey_id'),$this->config->item('razSecret'));
            $paymentData = array();
            
            $razorpayOrder = $api->order->create(array(
            'receipt'         => rand(),
            'amount'          => $payAmount, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
            ));

            // create a payment id
            $paymentData['user_id']         = $_SESSION['id'];   
            $paymentData['name']            = $_SESSION['name'];   
            $paymentData['mobile']          = $_SESSION['phone'];   
            $paymentData['email']           = isset($_SESSION['email'])?$_SESSION['email']:'';   
            
            $paymentData['amount']          = $payAmount;
            $paymentData['payment_date']    = date("Y-m-d H:i:s");  
            $paymentData['order_id']        = $razorpayOrder['id'];
            $paymentData['payment_status']  = 'pending';
            $paymentData['payment_type']    = 'Slot Booking ';
            $paymentData['payment_mode']    = 'razorpay';
            $paymentId   =   $this->payment_model->save($paymentData);     

            // create case 
            $caseData['asign_lawyer_id']           = $arr['id'];
            $caseData['client_id']                 = $_SESSION['id'];
            $caseData['case_category_id']          = $arr['case_category_id'];
            $caseData['case_description']          = $queryData->msg;
            $caseData['payment_status']            = 0;
            $caseData['payment_id']                = $paymentId;
            $caseData['dt']                        = date("Y-m-d H:i:s"); 
            $caseData['status']                    = 0; 
            $caseId   =   $this->case_details_model->save($caseData);
           
            // create a slot
            $slotData['lawyer_id']       = $arr['id'];
            $slotData['client_id']       = $_SESSION['id'];
            $slotData['case_id']         = $caseId;
            $slotData['slot_date']       =  date("Y-m-d", strtotime($arr['php_dateTime']));
            $slotData['time']            =  date("H:i A", strtotime($arr['php_dateTime']));;
            $slotData['meeting_time']    =  $arr['php_dateTime'];
            $slotData['period']          = 15;
            $slotData['slot_status']     = 0;
            $slotData['dt']          = date("Y-m-d H:i:s");  
            $slotId   =   $this->slot_model->save($slotData);
            header("Location:".base_url('client/cases/details/').base64_encode($caseId));
        }else{
            $data["file"]="front/404";
            $this->load->view('front/template',$data);
        }
        
    }



     // First query messate *************************************************************
    public function admin_first_query_message($msg,$chat_id)
    {   
        $toEmail= "bkweb11@gmail.com"; // admin mail //vinny_makkar@yahoo.com
        $subject= "Getting a new client query - Insaa99";

        $heading="Hi Admin, Getting a new client query";
        $content="
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>INSAAF-C-".$_SESSION['id']."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$_SESSION['name']."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$msg."</span></td>
            </tr>
        </div>
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query Date : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".date("d/M/Y h:i A")."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Reply Link : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><a href=".base_url('lawyer/query/chat/'.$chat_id).">Reply Now</a></td>
            </tr>
        </div>
        ";

        $message = get_email_temp($heading,$content);
        $this->send_email($toEmail, $subject, $message);

    }

    public function support(){
         // pass data in view    
         $data = array();
         $this->global['pageTitle'] = 'My Query';
         $this->loadViews("client/query/support", $this->global, $data, NULL, 'client');   
    }


    public function submitSupport(){

        if(isset($_POST) && !empty($_POST)){

            $paymentData['message']         = $_POST['mobile'];   
            $paymentData['message']         = $_POST['email'];   
            $paymentData['message']         = $_POST['message']; 

            $arr = array('mobile'=>$_POST['mobile'],'email'=>$_POST['email'],'message'=>$_POST['message'],'date'=>date("Y-m-d"));
            $insertData['jsonText'] = json_encode($arr);

            $result = $this->support_model->save($insertData);
            if($result > 0){
                echo 1;
                exit();
            }else{
                echo 2;
                exit();
            }
        }else{
            echo 2;
            exit();
        }  
    }
    
    
}

?>