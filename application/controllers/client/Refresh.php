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
        $this->load->model('client/Slot_model');
        $this->load->model('admin/Case_category_model');
        $data['case_category1']=$this->Case_category_model->all();

       $this->isUserLoggedIn();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {   
       echo "Something went wrong!!";
        
    }

    // $where16['client_id']=$id;
    // $where16['slot_status']=1;
    // $where16['client_meeting_noti']=0;
    // $where4['client_id']=$id;
    // $where4['status']=0;
    // $w['table'] = 'client_query';
    //     $w['parent_id'] = '0';
    //     $w['user_id'] = $_SESSION['id'];

     public function dashboard_data()
    {   
        // new Meeting
        $sql = "SELECT id FROM slot WHERE client_id = '".$_SESSION['id']."' AND client_meeting_noti = '0' AND slot_status = '1'";
        $newMeeting = $this->Slot_model->rawQuery($sql);
        // new Case
        $sql = "SELECT id FROM cases WHERE client_id = '".$_SESSION['id']."' AND client_case_noti = '0' ";
        $newCase = $this->Slot_model->rawQuery($sql);
        
        // // pending Case
        $sql = "SELECT id FROM cases WHERE client_id = '".$_SESSION['id']."' AND client_case_noti = '0' AND status = '0' ";
        $pendingCase = $this->Slot_model->rawQuery($sql);

        // //new paymwnt
        $sql = "SELECT id FROM z_payment WHERE user_id = '".$_SESSION['id']."' AND client_seen = '0' ";
        $newPaymwnt = $this->Slot_model->rawQuery($sql);
        // // new Query
        $sql = "SELECT id FROM client_query WHERE user_id = '".$_SESSION['id']."' AND parent_id = '0' AND client_seen = '0'";
        $newQuery = $this->Slot_model->rawQuery($sql);

        // return =========================================
        $data = array(
            'newMeeting' => count($newMeeting),
            'newCase' => count($newCase),
            'pendingCase' => count($pendingCase),
            'newPaymwnt' => count($newPaymwnt),
            'newQuery' => count($newQuery),
        );

        echo json_encode($data);
        
    }
    
   

    
    
}

?>