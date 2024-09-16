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
class Lawyer_note extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lawyer/lawyer_note_model');
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Lawyer_model');
        $this->load->model('admin/Query_model');
        date_default_timezone_set('Asia/Kolkata');
        $this->isLawyerLoggedIn();
    }
    
    /**
     * Index Page for this controller.
     */
    public function index($id = NULL)
    {
        // pre($_SESSION['id']);
        // exit();
       $id=base64_decode($id);
        $data['lawyer_id'] = $id;
        
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Slot list';
        $this->loadViews("lawyer/lawyer_note/list", $this->global, $data, NULL, 'lawyer');
        
    }
    
    // Add New 
    
    public function addnew()
    {
        $data = array();
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("lawyer/lawyer_note/addnew", $this->global, $data,NULL,'lawyer');
    }
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLawyerLoggedIn();
        $id    = $_POST['id'];
        // get image path 
        $rData = $this->lawyer_note_model->find($id);
        
        $result = $this->lawyer_note_model->delete($id);
        
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
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('notetext', 'note Name', 'trim|required');
        //form data 
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            $insertData                = array();
            $insertData['lawyer_id']        = (isset($_SESSION['id']))?$_SESSION['id']:"";
            $insertData['other']       = $form_data['notetext'];
            $insertData['created_at'] = date("Y-m-d H:i:s");
            $result                = $this->lawyer_note_model->save($insertData);
           
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Note successfully Added');
                redirect('lawyer/lawyer_note');
            } else {
                $this->session->set_flashdata('error', 'Note Addition failed');
            }
            redirect('lawyer/lawyer_note/addnew');
        }
        
    }
    
     // Member list
     public function ajax_list()
     {  
         error_reporting(0);
 
         $list =$this->lawyer_note_model->get_datatables();
     
         $data = array();
         $no =(isset($_POST['start']))?$_POST['start']:'';
        
         // save data for parent catelgory list
       
         foreach ($list as $currentObj) {
 
            //  pre($currentObj);
            //  exit();
             $temp_date = $currentObj->created_at;
             $date_at = date("d-m-Y h:i a", strtotime($temp_date));
             $no++;
             $row = array();
             $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
             $row[]=$currentObj->other;
             $row[] = $date_at;
             $row[] = '<a class="btn btn-sm btn-danger deletebtn " style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="'.base_url().'lawyer/lawyer_note/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
             $data[] = $row;
         }
      
         $output = array(
                         "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                         "recordsTotal" => $this->lawyer_note_model->count_all(),
                         "recordsFiltered" => $this->lawyer_note_model->count_filtered(),
                         "data" => $data,
                 );
         //output to json format
         echo json_encode($output);
     }
    
    
    
    
    public function view($id = NULL)
    {
        
        $this->isLawyerLoggedIn();
        if ($id == null) {
            redirect('lawyer/lawyer_note');
        }
        $data['view_data']         = $this->lawyer_note_model->find($id);
      
        $this->global['pageTitle'] = 'Insaaf99 : Edit size';
        $this->loadViews("lawyer/lawyer_note/view", $this->global, $data, NULL, 'lawyer');
        
    }
    
    // Edit
    
    public function edit($id = NULL)
    {
        $id=base64_decode($id);
        
        $this->isLawyerLoggedIn();
        if ($id == null) {
            redirect('lawyer/slot');
        }
        $data['edit_data'] = $this->lawyer_note_model->find($id);
        
        $client_id           = $data['edit_data']->client_id;
        $data['client_data'] = $this->Client_model->find($client_id);

        $query_id           = $data['edit_data']->query_Id;
        $data['query_data'] = $this->Query_model->find($query_id);
        $lawyer_id                 = $data['edit_data']->lawyer_id;
        $data['lawyer_data']       = $this->Lawyer_model->find($lawyer_id);
        $this->global['pageTitle'] = 'Insaaf99 : Slot Data ';
        $this->loadViews("lawyer/lawyer_note/edit", $this->global, $data, NULL, 'lawyer');
        
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
            $result1 = $this->lawyer_note_model->save($insertData);

            $clientData=$this->Client_model->find($form_data['client_id']);
            $lawyerData=$this->Lawyer_model->find($form_data['lawyer_id']);
            $slotData=$this->lawyer_note_model->find($form_data['id']);
           
            }
            elseif($form_data['slot_status'] == 2){
            $clientData=$this->Client_model->find($form_data['client_id']);
            $lawyerData=$this->Lawyer_model->find($form_data['lawyer_id']);
            $slotData=$this->lawyer_note_model->find($form_data['id']);
        
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

            $result2 = $this->lawyer_note_model->save($insertData);

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

            $result3 = $this->lawyer_note_model->save($insertData);
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
                redirect('lawyer/lawyer_note/index/'.base64_encode($form_data['lawyer_id']));
            } else {
                
                $this->session->set_flashdata('error', 'Please Select a Valid date to ctrate meeting');
            }
            redirect('lawyer/lawyer_note/edit/'.base64_encode($insertData['id']));
        }
        
    }
    

    // Update category*************************************************************
    public function addNoteByMeet()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('slot_id', 'Slot Id', 'trim|required');
        
        //form data 
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {

            $updateData=array();
            if(isset($form_data['id']) && !empty($form_data['id'])){
                $updateData['id']=$form_data['id'];
            }
            $updateData['slot_id']=$form_data['slot_id'];
            $updateData['lawyer_id']=$form_data['lawyer_id'];
            $updateData['note']=$form_data['note'];
            $updateData['created_at']=date("Y-m-d H:i:s");
            $result = $this->lawyer_note_model->save($updateData);
            if ($result > 0) {
                $this->session->set_flashdata('success', ' Note successfully added');
                redirect('lawyer/meeting/view/'.$form_data['slot_id']);
            } else {
                
                $this->session->set_flashdata('error', 'Failed to add Note');
            }
            redirect('lawyer/meeting/view/'.$form_data['slot_id']);
        }
        
    }
  
    
    
}

?>