<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



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
       $this->load->model('lawyer/slot_model');
       $this->load->model('lawyer/Hearing_date_model');
       $this->load->model('admin/case_details_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Case_sub_category_model');
       $this->load->model('admin/client_model');
       $this->load->model('admin/lawyer_model'); 
       $this->load->model('admin/Payment_model');
    
    }

    /**
     * Index Page for this controller.
     */
    public function index($id = NULL)
    {  
        $id=$_SESSION['id'];
        // $fromdate = date("Y-m-d 00:00:00");
        // pre($fromdate);
        // exit();
        $data['lawyer_id']=$id;
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Meetings';
        $this->loadViews("lawyer/meeting_date/list", $this->global, $data , NULL ,'lawyer');
        
    }


    // veiw details
    public function view($id = NULL)
    {
        
         if($id == null)
         {
            redirect('lawyer/meeting');
         }

         // get note data from note table
          $w['slot_id']=  $id;
          $w['table']=  "lawyer_notes";
          $noteData = $this->slot_model->finddynamic($w);
          if(isset($noteData) && !empty($noteData)){
              $data['noteData'] = $noteData[0];
          }
         // update lawyer_meeting_noti status
        $this->slot_model->save(array('id'=> $id,'lawyer_meeting_noti'=>1));

         $data['slot_data'] = $slotData = $this->slot_model->find($id);
         if(!empty($data['slot_data'])){

             $client_id = $slotData->client_id;
             $where2 = array();
             $where2['table'] = 'clint';
             $where2['id'] = $client_id;
             $client_data = $this->slot_model->findDynamic($where2);
             $data['client_data'] = empty($client_data)?'':$client_data[0];


             $caseData = $this->slot_model->findDynamic(array('table'=>'cases', 'id' => $slotData->case_id));
             $case_data = $data['case_data'] = empty($caseData)?'':$caseData[0];

             $case_cat_data = $this->Case_category_model->find($case_data->case_category_id);
             $data['case_cat_data'] = $case_cat_data;

             $payment_data = $this->Payment_model->find($case_data->payment_id);
             $data['payment_data'] = $payment_data;

         }
        
        
         $this->global['pageTitle'] = 'Client Dashboard';
         $this->loadViews("lawyer/meeting_date/view", $this->global, $data , NULL ,'lawyer');  
        
    } 
    

    // Member list
    public function ajax_list()
    {  
        
        $id=$_SESSION['id'];
        // pre($_GET);
        // echo "ok";
        error_reporting(0);

        $list= $this->slot_model->get_datatables();
        
		$data = array(); 
        $no =(isset($_POST['start']))?$_POST['start']:'';
        
        foreach ($list as $currentObj) {
            // pre($list);
   
            $caseDetails= $this->case_details_model->find($currentObj->case_id);// get case category id
            $caseCategoryData= $this->Case_category_model->find($caseDetails->case_category_id); // get case category data
         

            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y H:i:s", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<span class="btn-info btn12 badge">'.$no.'</span>';
// pre($currentObj);
            $row[] = $currentObj->fname.' '. $currentObj->lname;
            $row[] = '<span class="p-1" >'.$currentObj->client_unique_id.'</span>';
            $row[] = $caseCategoryData->name;
            $new = ($currentObj->lawyer_meeting_noti == 0)?'<span class="badge btn-primary bg-1 text-danger blink_now" >New</span>':'';
          
            $meeting=$currentObj->meeting_time;
            $date_meet = date("d-m-Y", strtotime($meeting));
            $time_meet = date("h:i:a", strtotime($meeting));
            $row[]=$date_meet.'/'.$time_meet." ".$new;
            if($currentObj->id !='' ){
                $slotID=base64_encode($currentObj->id);
                $encriptID= JKMencoder($currentObj->id);
                $lawyerID=base64_encode($currentObj->lawyer_id);
                $lawyer=base64_encode('lawyer');
                if($currentObj->MeetingStatus == 0){
                    $diff = dateDiffMin($currentObj->meeting_time,date("Y-m-d H:i:s"));
                    if($currentObj->slot_status == 1 && $diff > -20 ) {
                        $linkBtn ='<a href="'.base_url().'z/l/'.$encriptID.'"  class="btn btn-primary" style="margin: 4px 0px;font-size: 11px;" title="Click to Join" target="_blank">Join</a>';
                    }else if($currentObj->slot_status == 0) {
                        $linkBtn = '<span class="btn-warning badge">Pending</span>';
                    }else{
                        $linkBtn = '<span class="btn-danger badge">Expired</span>';
                    }
                    

                    
                }else{
                    $linkBtn = '<span class="btn-success badge">Meeting Success</span>';
                }
                $row[]=$linkBtn;
            }else{
                $row[]="No Link Generated";
                
            }

            // select type
            $changeStatus = '<select class="slotStatus" id="slot_id'.$currentObj->id.'" data-id="'.$currentObj->id.'" client-id="'.$currentObj->client_id.'"  >';

        
            $active1 = ($currentObj->slot_status==1)?' selected ':'';
            $active2 = ($currentObj->slot_status==2)?' selected ':'';
            
            $changeStatus .= '<option value="1" '.$active1.' >Aproved</option>';
            $changeStatus .= '<option value="2" '.$active2.' >No Available</option>';
               
            $changeStatus .= '</select>';


           
            // $row[]=$new;
            // $row[]=$changeStatus;
            $status =  (isset($currentObj->slot_status)  && $currentObj->slot_status==1)?'<span class="btn-success badge">Active<span/>':'<span class="btn-danger badge">Inactive<span/>';
            $row[]=$status;
            
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px" href="'.base_url().'lawyer/meeting/view/'.$currentObj->id.'" title="Edit" ><i class="fa fa-eye"></i></a>  ';
            
            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->slot_model->count_all(),
                        "recordsFiltered" => $this->slot_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function joinmeet($id=null){

        
        $this->isLawyerLoggedIn();
        if($id == null)
        {
            redirect('lawyer/Meeting_date/index/'.$_SESSION['id']);
            
        }
        $slotID=base64_decode($id ,true);
        $this->global['pageTitle'] = 'Meet Now';
        $this->loadViews("lawyer/joinmeet/meet", $this->global, NULL , NULL,'lawyer');
        
    }

 
// Disapprove the Meeting function 
    public function update_meeting_status(){
        date_default_timezone_set('Asia/Calcutta');
        $curentDate=date("Y-m-d H:i:s");

        if(isset($_POST['reason']) && !empty($_POST['reason'])){
            $data['id']=$_POST['slot_id'];
            $arr=['reason'=>$_POST['reason'],'update_date'=>$curentDate];
            $data['reason']=json_encode($arr);
            $data['slot_status']=$_POST['slot_status'];

            $slotData=$this->slot_model->find($_POST['slot_id']);
            $clientData=$this->client_model->find($_POST['client_id']);
            $lawyerData=$this->lawyer_model->find($_SESSION['id']);

// ******************************************************************************
            // $toEmail="sureshsarkar2020@gmail.com"; // admin email
            $toEmail="admin@insaaf99.com"; // admin email
            $subject="Meeting disapproved";
            $heading="A meeting disapprove by lawyer";

            $content="
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$clientData->fname." ".$clientData->lname."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID :</td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$clientData->client_unique_id."</span></td>
            </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerData->fname." ".$lawyerData->lname."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer ID: </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerData->lawyer_unique_id."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting ID : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$_POST['slot_id']."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Date : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData->slot_date."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Time : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$slotData->time."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Reason for decline: </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$_POST['reason']."</span></td>
                </tr>
            </div>
        
            ";
        
            $message=get_email_temp($heading,$content);
            $this->send_email($toEmail, $subject, $message);
        
// ******************************************************************************

            $this->slot_model->save($data);
            echo 1;
            exit();
        }
    }

    
    
    
}

?>