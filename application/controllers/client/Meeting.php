<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

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
class Meeting extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('client/Slot_model');
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Case_sub_category_model');
       $this->load->model('client/Case_details_model');
       $this->load->model('admin/Lawyer_model');
       $this->load->model('admin/Lawyer_scheduler_model');
       date_default_timezone_set('Asia/Kolkata'); 
       $this->isUserLoggedIn(); 
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {   
        $data = array();
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $w['id']=base64_decode($_GET['key']);
            $w['status']=1;
            $w['update_dt']=date("Y-m-d H:i:s");
           update_notification($w);
        }

        $list = $this->Slot_model->get_datatables();
        $data['meetingData'] = $list;
        $this->global['pageTitle'] = 'Insaaf99 : Slot list';
        $this->loadViews("client/meeting_list/list", $this->global, $data , NULL ,'client');
        
    }
    
    // Add New 

    public function addnew()
    {

        $data['parent_list'] = $this->Slot_model->getparent_id();
    
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("client/slot/addnew", $this->global, $data , NULL);   
    } 
    // delete category 
    public function delete()
    {
        // define path for file location 
    
        $id = $_POST['id'];
        // get image path 
        $rData = $this->Slot_model->find($id);
        
        $result = $this->Slot_model->delete($id);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        date_default_timezone_set('Asia/Kolkata'); 
    
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
            /* $insertData['width'] = $form_data['width'];
             $insertData['height'] = $form_data['height'];*/
          
           // $insertData['sizeCode'] = $form_data['sizeCode'];
            $insertData['date_at'] = date("Y-m-d H:i:s");	
            $result = $this->Slot_model->save($insertData);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'size successfully Added');
            }
            else
            { 
                $this->session->set_flashdata('error', 'size Addition failed');
            }
            redirect('client/slot/addnew');
          }  
        
    }

    // Member list
    public function ajax_list($id=NULL) 
    {  
        error_reporting(0);
        $curent_date= strtotime(date('Y-m-d H:i:s'));
        $list = $this->Slot_model->get_datatables();
 
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

       // pre($list);
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $new = ($currentObj->client_seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';
        // pre($currentObj);
        // exit();
            $temp_date = $currentObj->dt;
            $date_at = date("Y-m-d |  H:i A", strtotime($temp_date));
            // reshcedule button
            $diff = dateDiffMin($currentObj->meeting_time, date("Y-m-d H:i:s") );
           

            $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';

            $fullname= empty($currentObj->fname)?'-':$currentObj->fname.' '. $currentObj->lname;
            $row[] = $currentObj->case_name;
            $row[] = $fullname;
            
            $DT="";
            $DT=$date+3600;
            
            $row[]= date("Y-m-d", strtotime($currentObj->meeting_time));
            $row[]= date("h:i A", strtotime($currentObj->meeting_time));

            if($diff > -60 && $currentObj->slot_status==1){
                $client=base64_encode('client');
                // $encriptID=base64_encode($currentObj->id);
                $encriptID= JKMencoder($currentObj->id);
                $clientID=base64_encode($currentObj->client_id);
                $row[]='<a href="'.base_url().'z/c/'.$encriptID.'" class="btn btn-primary" style="margin: 4px 0px;font-size: 11px;" title="Click to Join" target="_blank">Join</a>';
            }else if($currentObj->slot_status==0){
                $row[]='Lawyer will be assigned shortly';
            }else if($currentObj->MeetingStatus==1 || $currentObj->MeetingStatus==2){
                $row[]='Meeting Over';
            }else if($currentObj->slot_status==1 && $currentObj->MeetingStatus == 0 && $diff < -60 ){
                $row[]= '<a href="'.base_url().'client/meeting/reschedule/'.base64_encode($currentObj->id).'" class="btn btn-primary" style="margin: 4px 0px;font-size: 11px;" title="Click to Re-schedule">Re-Schedule</a>';
            }else{
                $row[]='-';
            }
            $row[] = ($currentObj->slot_status==1)?'<span class="btn-success badge">Approved</span>':'<span class="btn-danger badge">'.$this->config->item('slot_status')[$currentObj->slot_status].'</span>';
            $row[]=$new;
            $row[] = $date_at;
            $row[]='<a href="'.base_url().'client/cases/details/'.base64_encode($currentObj->case_id).'?slot_id='.$currentObj->id.'" class="btn btn-primary" style="margin: 4px 0px;font-size: 11px;" title="View">View</a>';
            
            
            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->Slot_model->count_all(),
                        "recordsFiltered" => $this->Slot_model->count_filtered(),
                        "data" => $data,
                );
        echo json_encode($output);
    }

    public function reschedule($slotid = NULL)
    {
        $slotid = base64_decode($slotid);
        $checkStatus = (isset($_SESSION['role']) && $_SESSION['role'] == 'lawyer')?true:false;
        if(!$checkStatus){
        $this->isUserLoggedIn();
        }
        $rData = $this->Slot_model->find($slotid);
        // pre($rData);
        $lawyer_id = $rData->lawyer_id;
        if (!empty($this->input->post('case_cat'))) {
           $this->session->set_userdata('ses_case_cat_id', $this->input->post('case_cat')); 
        }
        
        $where = array(); $Date = date("Y-m-d"); 
        $day = date('D', strtotime($Date. ' + 1 days'));
        $where['lawyer_id'] = $lawyer_id;
        $where['schedule_day'] = $day;
        $get_schedule = $this->Lawyer_scheduler_model->finddynamic($where);
        if (!empty($get_schedule)) {
           $data['schedule_times'] = getStaticTime();
        }else{
           $data['schedule_times']=[];
        }

        $data['slotid'] = $slotid;
        $data['lawyer_id'] = $lawyer_id;
        $type = ($checkStatus)?'lawyer':'client';
        $this->global['pageTitle'] = 'Choose Meeting Time';
        $this->loadViews("client/meeting_list/reschedule", $this->global, $data, NULL, $type);
    }

    public function save_reschedule($slotid=NULL){

    
        $slotid = base64_decode($slotid);        
        $originalDate = $this->input->post('schedule_date');
        $schedule_date = date("Y-m-d", strtotime($originalDate));
        $schedule_time = $this->input->post('schedule_time');
        /*------ Meeting Time ------*/
        $meeting_day = $schedule_date." ".$schedule_time;
        $meeting_time = date('Y-m-d H:i:s', strtotime($meeting_day));
        $caseData = $this->Slot_model->find($slotid);
        $this->mail_admin_reschedule($caseData->case_id,date("d/M/Y h:i A", strtotime($meeting_time)));
        
        /*----------------*/
        
        $insertData['id'] = $slotid;
        $insertData['slot_date'] = $schedule_date;
        $insertData['time'] = $schedule_time;
        $insertData['meeting_time'] = $meeting_time;
        $insertData['slot_status'] = 9;
        // pre($insertData); exit();
        $result = $this->Slot_model->save($insertData);



        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Re-Schedule Request Submitted</div>');
        redirect('client/meeting');
    }


    public function view($id = NULL)
    {
    
        if($id == null)
        {
            redirect('client/meeting');
        }
          

        $data['edit_data'] = $this->Slot_model->find($id);
        $this->global['pageTitle'] = 'Insaaf99 : Edit size';
        $this->loadViews("client/slot/view", $this->global, $data , NULL,'client');    
        
    } 

    // Edit
 
    public function edit($id = NULL)
    {
    
        if($id == null)
        {
            redirect('client/slot');
        }
        $data['edit_data'] = $this->Slot_model->find($id);

        $client_id=$data['edit_data']->client_id;
        $data['client_data'] = $this->Client_model->find($client_id);
        $this->global['pageTitle'] = 'Insaaf99 : Slot Data ';
        $this->loadViews("client/slot/edit", $this->global, $data , NULL,'client');    
        
    }

    // Update category*************************************************************
    public function update()
    {
    
        $this->load->library('form_validation');            
        // $this->form_validation->set_rules('fname','fname','trim|required');
        $this->form_validation->set_rules('status','Status','trim');
        
        //form data 
        $form_data  = $this->input->post();

       


        if($this->form_validation->run() == FALSE)
        {
			
                $this->edit($form_data['id']);
        }
        else
        {
            
        $zoomMeetTime  =  date("d-m-Y H:i:s", strtotime($form_data['slot_date']." ". $form_data['time']));  
        $arr['topic']='Test by insaaf99';
        $arr['start_date']=$form_data['slot_date'];
        $arr['start_time']=$form_data['time'];
        $arr['zoomMeetTime']=$zoomMeetTime;
        $arr['duration']=30;
        $arr['password']='insaaf99';
        $arr['type']='2';
    //    pre($arr);
       
       $result=createMeeting($arr);
           
        if(isset($result->id)){
            echo "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
            echo "Password: ".$result->password."<br/>";
            echo "Start Date: ".$result->start_time."<br/>";
            echo "Start Time: ".$result->start_time."<br/>";
            echo "Duration: ".$result->duration."<br/>";
            exit();
        }else{
            echo '<pre>';
            print_r($result);
            exit();
        }

            $insertData['id'] = $form_data['id'];
            $insertData['client_id'] = $form_data['client_id'];
            $insertData['slot_date'] = $form_data['slot_date'];
            $insertData['time'] = $form_data['time'];
            $insertData['period'] = $form_data['period'];
            $insertData['lawyer_id'] = $form_data['lawyer_id'];
            $insertData['contact_mode'] = $form_data['contact_mode'];
            $insertData['reply'] = $form_data['reply'];
            $insertData['status'] = $form_data['status'];
        
            $result = $this->Slot_model->save($insertData);
        
           if(!empty($result)){
            /* send mail for Lawyer to book slot for lawyer */
            $toEmail= $form_data['client_email'];// client email 
            $subject= "Slot Booking reply";
            $heading="Slot Booking reply message";
            
            $content="
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['lawyer_name']."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Reply : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['reply']."</span></td>
                </tr>
            </div>
          ";
           
           $message=get_email_temp($heading,$content);
           $this->send_email($toEmail, $subject, $message);

            /* end code for Lawyer to book slot  send email */
       }


            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Slot successfully Updated');
                redirect('client/slot/index/'.$form_data['lawyer_id']);
            }
            else
            { 
                $this->session->set_flashdata('error', 'Category Updation failed');
            }
            redirect('client/slot/edit/'.$insertData['id']);
          }  
    }
  



    // email admin when request new schedule
    // First query messate *************************************************************
    public function mail_admin_reschedule($slot_id,$meetTime)
    {   
        $toEmail= "vinny_makkar@yahoo.com"; // admin mail //vinny_makkar@yahoo.com
        $subject= "Client Re-schedule Request - Insaa99";

        $heading="&nbsp;Hi Admin, ".$_SESSION['name']." send a request for change meeting schedule";
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
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>New Meeting time: </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$meetTime."</span></td>
            </tr>
        </div>
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Request Date : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".date("d/M/Y h:i A")."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Action : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><a href=".base_url('admin/Case_details/details/'.$slot_id).">Approve Now</a></td>
            </tr>
        </div>
        ";

        $message = get_email_temp($heading,$content);
        return  $this->send_email($toEmail, $subject, $message);

    }
    
    
}

?>