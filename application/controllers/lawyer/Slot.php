<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
include('zoom/config.php');
include('zoom/api.php');
use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Slot extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lawyer/Slot_model');
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Lawyer_model');
        $this->load->model('admin/Query_model');
        date_default_timezone_set('Asia/Kolkata');
        
    }
    
    /**
     * Index Page for this controller.
     */
    public function index($id = NULL)
    {
       $id=base64_decode($id);
        $data['lawyer_id'] = $id;
        
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Slot list';
        $this->loadViews("lawyer/slot/list", $this->global, $data, NULL, 'lawyer');
        
    }
    
    // Add New 
    
    public function addnew()
    {
        $data['parent_list'] = $this->Slot_model->getparent_id();
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("lawyer/slot/addnew", $this->global, $data, NULL);
    }
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLawyerLoggedIn();
        $id    = $_POST['id'];
        // get image path 
        $rData = $this->Slot_model->find($id);
        
        $result = $this->Slot_model->delete($id);
        
        if ($result > 0) {
            echo (json_encode(array(
                'status' => TRUE
            )));
        } else {
            echo (json_encode(array(
                'status' => FALSE
            )));
        }
    }
    
    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        
       
        $this->isLawyerLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'size Name', 'trim|required');
        //form data 
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            $insertData                = array();
            $insertData['name']        = $form_data['name'];
            $insertData['slot_status'] = $form_data['status'];
            /* $insertData['width'] = $form_data['width'];
            $insertData['height'] = $form_data['height'];*/
            
            // $insertData['sizeCode'] = $form_data['sizeCode'];
            $insertData['date_at'] = date("Y-m-d H:i:s");
            $result                = $this->Slot_model->save($insertData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'size successfully Added');
            } else {
                $this->session->set_flashdata('error', 'size Addition failed');
            }
            redirect('lawyer/slot/addnew');
        }
        
    }
    
    // Member list
    public function ajax_list($id = NULL)
    {
        if(!empty($_SESSION)){
            $id=$_SESSION['id'];

        }
     
        error_reporting(0);

        if(isset($_GET['slot'])){
            $_GET['slot']=base64_decode($_GET['slot']);

            $whereUser ='';
            if(isset($_GET['meet']) && $_GET['meet'] == '1' ){
                $curentdate=date("Y-m-d H:i:s");
                $fromdate = date("Y-m-d 00:00:00");
                $sql1 = " AND `dt` BETWEEN '".$fromdate."' and '".$curentdate."'";
            }else if(isset($_GET['slot']) && $_GET['slot'] == '7' ){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-7 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $sql1 = " AND `dt` BETWEEN '".$fromdate."' and '".$curentdate."'";
            }else if(isset($_GET['slot']) && $_GET['slot'] == '30' ){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-30 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $sql1 = " AND `dt` BETWEEN '".$fromdate."' and '".$curentdate."'";
            }else if(isset($_GET['slot']) && $_GET['slot'] == '365' ){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-365 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $sql1 = " AND `dt` BETWEEN '".$fromdate."' and '".$curentdate."'";
            }else if(isset($_GET['slot']) && $_GET['slot'] == 'all' ){
                $sql1 = " ";
                
            }else{

            }
        }

        $sql = "SELECT  * FROM slot "; 
        $sql .=" WHERE `lawyer_id`='".$id."' ".$sql1." ORDER BY dt DESC";
    
        $list= $this->Slot_model->rawQuery($sql);
       
      
        $data               = array();
        $no                 = (isset($_POST['start'])) ? $_POST['start'] : '';
        // save data for parent catelgory list
        
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $time_at   = date("H:i:s", strtotime($temp_date));
            $no++;
            $row   = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';
            
            $client_id = $currentObj->client_id;
            $client    = $this->Client_model->find($client_id);
            
            $first_name = $client->fname;
            $last_name  = $client->lname;
            $fullname   = $first_name . ' ' . $last_name;
            $row[]      = $fullname;
            $row[]      = $client->client_unique_id;
            
            $row[] = $currentObj->slot_date;
            $row[] = date("h:i a", strtotime($currentObj->time));
            $row[] = $currentObj->period;
            // $row[] = $currentObj->contact_mode;

            $status1='';
            if($currentObj->slot_status==1){
                $status1 = '<span class="btn-success badge">Approve</span>';
            }
          elseif($currentObj->slot_status==2){
                $status1 = '<span class="btn-danger  badge">Declined</span>';
            }else{
                $status1 = '<span class="btn-warning  badge">Pending</span>';
            }
            $row[]=$status1;

            // $row[] = ($currentObj->slot_status == 1) ? '<span class="btn-success badge">Approved</span>' : '<span class="btn-danger badge">Pending</span>';
            $row[] = $date_at.'/'.$time_at;
            
            $row[] = ' <a class="btn btn-sm btn-info " style="margin: 4px 0px" href="' . base_url() . 'lawyer/slot/edit/'.base64_encode($currentObj->id). '" title="view"  data_id="' . $currentObj->id . '" ><i class="fa fa-pencil"></i></a>';
            
            $data[] = $row;
        }
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->Slot_model->count_all(),
            "recordsFiltered" => $this->Slot_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    
    
    
    public function view($id = NULL)
    {
        
        $this->isLawyerLoggedIn();
        if ($id == null) {
            redirect('admin/size');
        }
        $data['edit_data']         = $this->Slot_model->find($id);
        $this->global['pageTitle'] = 'Insaaf99 : Edit size';
        $this->loadViews("lawyer/slot/view", $this->global, $data, NULL, 'lawyer');
        
    }
    
    // Edit
    
    public function edit($id = NULL)
    {
        $id=base64_decode($id);
        
        $this->isLawyerLoggedIn();
        if ($id == null) {
            redirect('lawyer/slot');
        }
        $data['edit_data'] = $this->Slot_model->find($id);
        
        $client_id           = $data['edit_data']->client_id;
        $data['client_data'] = $this->Client_model->find($client_id);

        $query_id           = $data['edit_data']->query_Id;
        $data['query_data'] = $this->Query_model->find($query_id);
        $lawyer_id                 = $data['edit_data']->lawyer_id;
        $data['lawyer_data']       = $this->Lawyer_model->find($lawyer_id);
        $this->global['pageTitle'] = 'Insaaf99 : Slot Data ';
        $this->loadViews("lawyer/slot/edit", $this->global, $data, NULL, 'lawyer');
        
    }
    

    // Update category*************************************************************
    public function update()
    {
      
        date_default_timezone_set('Asia/Kolkata');
        $this->isLawyerLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('slot_status', 'Status', 'trim');
        
        //form data 
        $form_data = $this->input->post();
      
 
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {

            if ($form_data['slot_status'] == 1) {
            
            $insertData['id']           = $form_data['id'];
            $insertData['client_id']    = $form_data['client_id'];
            $insertData['slot_date']    = $form_data['slot_date'];
            if(!empty($form_data['time'])){
                $time= date("H:i:s",strtotime($form_data['time']));
                $insertData['time']         = $time;
               }
            $insertData['period']       = $form_data['period'];
            $insertData['lawyer_id']    = $form_data['lawyer_id'];
            $insertData['contact_mode'] = $form_data['contact_mode'];
            $insertData['slot_status']  = $form_data['slot_status'];
            $insertData['again_status_noti'] = 2;
            $result1 = $this->Slot_model->save($insertData);

            $clientData=$this->Client_model->find($form_data['client_id']);
            $lawyerData=$this->Lawyer_model->find($form_data['lawyer_id']);
            $slotData=$this->Slot_model->find($form_data['id']);
           
            }
            elseif($form_data['slot_status'] == 2){
            $clientData=$this->Client_model->find($form_data['client_id']);
            $lawyerData=$this->Lawyer_model->find($form_data['lawyer_id']);
            $slotData=$this->Slot_model->find($form_data['id']);
        
            $insertData['id']           = $form_data['id'];
            $insertData['zoom_link_id'] = '';
            $insertData['zoom_link']    = '';
            $insertData['zoom_password']= '';
            $insertData['client_id']    = $form_data['client_id'];
            $insertData['slot_date']    = $form_data['slot_date'];
            if(!empty($form_data['time'])){
                $time= date("H:i:s",strtotime($form_data['time']));
                $insertData['time']         = $time;
               }
            $insertData['period']       = $form_data['period'];
            $insertData['lawyer_id']    = $form_data['lawyer_id'];
            $insertData['contact_mode'] = $form_data['contact_mode'];
            $insertData['slot_status']  = $form_data['slot_status'];
            $insertData['query_Id']     = $form_data['query_id'];
            $insertData['again_status_noti'] = 2;
            
           // for client
            $addNotiToClient=array();
            $addNotiToClient['user_type']=3;// for client
            $addNotiToClient['user_id']=$form_data['client_id'];
            $addNotiToClient['subject']="Your Slot is declined";
            $addNotiToClient['msg']="For some reason your meeting is declined date ".$form_data['slot_date'].' at '.$form_data['time'];
            $addNotiToClient['act_slug']=base_url().'client/meeting';
            $addNotiToClient['status']=0;
            $addNotiToClient['dt']=date("Y-m-d H:i:s");
     
            notification($addNotiToClient);
      
            // for Admin
            $addNotiToAdmin=array();
            $addNotiToAdmin['user_type']=1;// for Admin
            $addNotiToAdmin['user_id']=2;
            $addNotiToAdmin['subject']="A Slot declined by Advocate ".$_SESSION['name'];
            $addNotiToAdmin['msg']="A Slot declined by Advocate ".$_SESSION['name'].' that has been booked for'.$form_data['slot_date']." at ".$form_data['time'];
            $addNotiToAdmin['act_slug']=base_url().'admin/meeting_list';
            $addNotiToAdmin['status']=0;
            $addNotiToAdmin['dt']=date("Y-m-d H:i:s");
     
           notification($addNotiToAdmin);// For Admin

            $result2 = $this->Slot_model->save($insertData);

            }
            elseif($form_data['slot_status'] == 0){

            $insertData['id']           = $form_data['id'];
            $insertData['zoom_link_id'] = '';
            $insertData['zoom_link']    = '';
            $insertData['zoom_password']= '';
            $insertData['client_id']    = $form_data['client_id'];
            $insertData['slot_date']    = $form_data['slot_date'];
            if(!empty($form_data['time'])){
             $time= date("H:i:s",strtotime($form_data['time']));
             $insertData['time']         = $time;
            }
            $insertData['period']       = $form_data['period'];
            $insertData['lawyer_id']    = $form_data['lawyer_id'];
            $insertData['contact_mode'] = $form_data['contact_mode'];
            // $insertData['reply']        = $form_data['reply'];
            $insertData['slot_status']  = $form_data['slot_status'];
            $insertData['again_status_noti'] = 2;

            $addNotiToClient=array();
            $addNotiToClient['user_type']=3;// for client
            $addNotiToClient['user_id']=$form_data['client_id'];
            $addNotiToClient['subject']="Your Slot is in pending";
            $addNotiToClient['msg']="Your slot is pending date is ".$form_data['slot_date'].' at '.$form_data['time'];
            $addNotiToClient['act_slug']=base_url().'client/meeting';
            $addNotiToClient['status']=0;
            $addNotiToClient['dt']=date("Y-m-d H:i:s");
     
            notification($addNotiToClient);

            $addNotiToAdmin=array();
            $addNotiToAdmin['user_type']=1;// for Admin
            $addNotiToAdmin['user_id']=2;
            $addNotiToAdmin['subject']="A Slot was set in pending by Advocate ".$_SESSION['name'];
            $addNotiToAdmin['msg']="A Slot was pending by Advocate ".$_SESSION['name'].' for'.$form_data['slot_date']." at ".$form_data['time'];
            $addNotiToAdmin['act_slug']=base_url().'admin/meeting_list';
            $addNotiToAdmin['status']=0;
            $addNotiToAdmin['dt']=date("Y-m-d H:i:s");
     
            notification($addNotiToAdmin);// For Admin

            $result3 = $this->Slot_model->save($insertData);
            }
           
            if (!empty($result1) && $form_data['slot_status'] == 1) {

                nitification_when_book_slot($clientData,$lawyerData,$slotData);
                /* end code for Lawyer to sent meeting link */
            }
            
            
            // Send mail to update  in Decline condition start
            if (!empty($result2) && $form_data['slot_status'] == 2) {
                 
                $clientphone = explode(' ',trim($form_data["client_phone"]));
                $message='Opps! It seems our expert is not available at a selected time slot. You are requested to kindly book you slot again.
Team Insaaf99.com';
                        
               send_sms($clientphone[0],$message);
               // Send SMS end 

                $toEmail = $form_data['client_email']; // client email 
                $subject = "Slot Booking reply";
                  $heading="Opps! It seems our Expert is not available at a selected time slot. You are requested to kindly book your slot again.";
                  $content="
                  <div style='margin-top:1px;'>
                      <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                      <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['lawyer_name']."</span></td>
                      </tr>
                  </div>
                  <div style='margin-top:1px;'>
                      <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Thanks & Regard</td>
                      </tr>
                  </div>
                  <div style='margin-top:1px;'>
                      <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Team</td>
                      </tr>
                  </div>
                  <div style='margin-top:1px;'>
                      <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Insaaf99 </td>
                      </tr>
                  </div>
                ";
                 $message=get_email_temp($heading,$content);
                 $this->send_email($toEmail, $subject, $message);

                /* end code for client to sent meeting link */
                
            }
            // Send mail to update  in Decline condition end
           
       
            if ($result1 || $result2 ||$result3 > 0) {
                
                
                $this->session->set_flashdata('success', ' Slot successfully Updated');
                redirect('lawyer/slot/index/'.base64_encode($form_data['lawyer_id']));
            } else {
                
                $this->session->set_flashdata('error', 'Please Select a Valid date to ctrate meeting');
            }
            redirect('lawyer/slot/edit/'.base64_encode($insertData['id']));
        }
        
    }
  
    
    
}

?>