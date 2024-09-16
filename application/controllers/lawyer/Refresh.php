<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Refresh extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();

        $this->load->model('Base_model');
        $this->load->model('lawyer/Slot_model');
        $this->load->model('admin/Case_category_model');
        $data['case_category1']=$this->Case_category_model->all();

       $this->isLawyerLoggedIn();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {   
       echo "Something went wrong!!";
        
    }




     public function dashboard_data()
    {   
        // new Meeting
        $sql = "SELECT id FROM slot WHERE lawyer_id = '".$_SESSION['id']."' AND lawyer_meeting_noti = '0' ";
        $newMeeting = $this->Slot_model->rawQuery($sql);
        // new Case
        $sql = "SELECT id FROM cases WHERE asign_lawyer_id = '".$_SESSION['id']."' AND lawyer_case_noti = '0' ";
        $newCase = $this->Slot_model->rawQuery($sql);
        
        // pending Case
        $sql = "SELECT id FROM cases WHERE asign_lawyer_id = '".$_SESSION['id']."' AND lawyer_case_noti = '0' AND status = '0' ";
        $pendingCase = $this->Slot_model->rawQuery($sql);

        // first Query
        $sql = "SELECT id FROM query WHERE lawyer_id = '".$_SESSION['id']."' AND lawyer_f_query_noti = '0' ";
        $firstQuery = $this->Slot_model->rawQuery($sql);

        // return =========================================
        $data = array(
            'newMeeting' => count($newMeeting),
            'newCase' => count($newCase),
            'pendingCase' => count($pendingCase),
            'firstQuery' => count($firstQuery),
        );

        echo json_encode($data);
        
    }
    
   

    
    
}

?>