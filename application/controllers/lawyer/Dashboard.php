<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

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
        $this->load->model('Base_model');
        $this->load->model('front/orders_model');
        $this->load->model('admin/category_model');
        $this->load->model('lawyer/Slot_model');
        $this->load->model('lawyer/lawyer_model');
        $this->load->model('lawyer/Case_details_model');
        $this->load->model('admin/product_model');
        $this->load->model('lawyer/Hearing_date_model');
        $this->load->model('admin/Lawyer_scheduler_model');
        $this->load->model('admin/Query_model');

        $this->isLawyerLoggedIn();  
      
    }
    
    /**
     * This function used to load the first screen of the user
     */
        

    public function index()
    {  
        
        if(($_SESSION['status'] == 1 || $_SESSION['status'] == 2) && $_SESSION['profile_complete'] > 50){

              // get Client data
              $user = $this->lawyer_model->find($_SESSION['id']);
            
              if($_SESSION['status'] != $user->status){
                  $this->session->set_userdata('status', $user->status);// set ststus in session
                  header("Location:".base_url('lawyer/dashboard'));
              }


            $id = $_SESSION['id'];
            $lawyerData=$this->lawyer_model->find($id);
            $sessionArray=array();
            $data['id']=$id;
            $data['name']=$_SESSION['name'];
                date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
                 /* code for total product */
                 $where1['asign_lawyer_id']=$id;

                 $where2['asign_lawyer_id']=$id;
                 $where2['status']=1;

                 $toatalcases = $this->Case_details_model->findDynamic($where1);

                 $where1['status'] = 0;
                 $pendingcases = $this->Case_details_model->findDynamic($where1);
                
                 $toatalRunningcases = $this->Case_details_model->findDynamic($where2); 
               
                 if(!empty($toatalcases)){
                     $data['caseCount'] =  count($toatalcases) ;   
                 }
                 if(!empty($pendingcases)){
                     $data['pendingcases'] =  count($pendingcases) ;   
                 }
                 if(!empty($toatalRunningcases)){
                     $data['toatalRunningcases'] =  count($toatalRunningcases) ;   
                 }

                /* code for order detaisl */
                $where['lawyer_id']=$id;
                $where3['lawyer_id']=$id;

                $where5['lawyer_id']=$id;
                $where5['lawyer_slot_noti']=0;
                $where5['again_status_noti']=0;
                $where55['lawyer_id']=$id;
                $where55['again_status_noti']=1;
                $where6['lawyer_id']=$id;
                $where6['lawyer_hearing_noti']=0;
                
                $where8['lawyer_id']=$id;
                
                $where9['lawyer_id']=$id;
                $where9['client_f_query']=1;
                $where9['query_status']=1;

                $slotDetails = $this->Slot_model->findDynamic($where);
                $hearingDetails = $this->Hearing_date_model->findDynamic($where);
                $meetingDetails = $this->Slot_model->findDynamic($where3);
                $SlotNotify = $this->Slot_model->findDynamic($where5);
                $SlotNotify1 = $this->Slot_model->findDynamic($where55);
                $HearingNotify = $this->Hearing_date_model->findDynamic($where6);
                $LawyerScheduler = $this->Lawyer_scheduler_model->findDynamic($where8);
                $Client_f_query = $this->Query_model->findDynamic($where9);
              
                if(!empty($slotDetails)){
                    $data['slotDetails'] =  count($slotDetails) ;
                    $data['slot_Details'] =  json_encode($slotDetails);
                }
                if(!empty($hearingDetails)){
                    $data['hearingDetails'] =  count($hearingDetails) ;
                    $data['hearing_Details'] =  json_encode($hearingDetails);
                }
                if(!empty($meetingDetails)){
                    $data['meetingDetails'] =  count($meetingDetails) ;
                    $data['meeting_Details'] =  json_encode($meetingDetails);
                }
               
                if(!empty($SlotNotify || $SlotNotify1)){
                    $data['SlotNotify'] =  (intval(count($SlotNotify)))+(intval(count($SlotNotify1)));
                    $data['Slot_Notify'] =  json_encode($SlotNotify);
                }
              
                if(!empty($HearingNotify)){
                    $data['HearingNotify'] =  count($HearingNotify) ;
                    $data['Hearing_Notify'] =  json_encode($HearingNotify);
                }
             
                if(!empty($LawyerScheduler)){
                    $data['LawyerScheduler'] =  count($LawyerScheduler) ;
                    $data['Lawyer_Scheduler'] =  json_encode($LawyerScheduler);
                }
                if(!empty($Client_f_query)){
                    $data['Client_f_query'] =  count($Client_f_query) ;
                    $data['ClientFquery'] =  json_encode($Client_f_query);
                }
                if(!empty($lawyer_f_query)){
                    $data['lawyer_f_query'] =  count($lawyer_f_query) ;
                    $data['lawyerfquery'] =  json_encode($lawyer_f_query);
                }
                /* end code for order details */
            // pre(  $id);
            // pre($data['MeetingNotify'] );
            // exit();
            
                /* end code for counting year sales */
            $this->global['pageTitle'] = 'Lawyer Dashboard';
            $this->loadViews("lawyer/dashboard", $this->global, $data , NULL ,'lawyer');

        }else{
            // get Client data
            $user = $this->lawyer_model->find($_SESSION['id']);
            
            if($_SESSION['status'] != $user->status){
                $this->session->set_userdata('status', $user->status);
                header("Location:".base_url('lawyer/dashboard'));
            }
            // complete profile dashbaord
            $data = array();
            $this->global['pageTitle'] = 'Complete profile';
            $this->loadViews("lawyer/complete-profile-dashboard", $this->global, $data , NULL ,'lawyer');
        }
    }  
    /**
     * This function is used to load the user list
     */
   
    
}

?>