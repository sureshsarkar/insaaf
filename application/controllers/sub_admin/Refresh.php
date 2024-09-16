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
        $this->load->model('admin/Case_category_model');
        // $data['case_category1']=$this->Case_category_model->all();
        $this->load->model('admin/client_query_model');
        $this->isLoggedSubAdmin();
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
        // new chat
        $sql = "SELECT id FROM client_query WHERE parent_id = '0' AND seen = '0' ";
        $newchat = $this->client_query_model->rawQuery($sql);


        // new Case
        $sql = "SELECT id FROM cases WHERE seen = '0' ";
        $newCase = $this->client_query_model->rawQuery($sql);

        // new Lawyer
        $sql = "SELECT id FROM lawyer WHERE seen = '0' ";
        $newLawyer = $this->client_query_model->rawQuery($sql);

         // new Client
        $sql = "SELECT id FROM clint WHERE seen = '0' ";
        $newClient = $this->client_query_model->rawQuery($sql);

         // new Payment
        $sql = "SELECT id FROM z_payment WHERE seen = '0' ";
        $newPayment = $this->client_query_model->rawQuery($sql);

         // new upcoming meetings
        $curentTime          = date("Y-m-d H:i:s");
        $sql="SELECT id FROM slot where TIMESTAMPDIFF(MINUTE, '".$curentTime."', `meeting_time`) > 0 AND upcome_seen = '0' AND slot_status = '1'";
        $upcomingmeetings= $this->client_query_model->rawquery($sql);

         // new Certificate Request
         $sql = "SELECT id FROM docx_certificate WHERE seen = '0' ";
         $newCertificate = $this->client_query_model->rawQuery($sql);

         // new support message
         $sql = "SELECT id FROM support WHERE seen = '0' ";
         $newSupport = $this->client_query_model->rawQuery($sql);
         
         // new contact Request
         $sql = "SELECT id FROM contact WHERE seen = '0' AND `contact_type`!='PPC' ";
         $newContact = $this->client_query_model->rawQuery($sql);

         // new ppc Request
         $sql = "SELECT id FROM contact WHERE seen = '0' AND `contact_type`='PPC' ";
         $newPpc = $this->client_query_model->rawQuery($sql);
         // new calling 
         $sql = "SELECT id FROM calling_data WHERE seen = '0' ";
         $calling = $this->client_query_model->rawQuery($sql);
        //  new todayCalling
         $curentDateTime=date("Y-m-d H:i:s");  
         $addOneDay= date('Y-m-d 23:59:59');
        $sql = "SELECT id FROM `calling_data` WHERE `folloupdate` BETWEEN '$curentDateTime' AND '$addOneDay'";
        $todayCalling = $this->client_query_model->rawQuery($sql);
        // return =========================================
        $data = array(
            'newChat' => count($newchat),
            'newCase' => count($newCase),
            'newLawyer' => count($newLawyer),
            'newClient' => count($newClient),
            'newPayment' => count($newPayment),
            'upcomingmeetings' => count($upcomingmeetings),
            'newCertificate' => count($newCertificate),
            'newContact' => count($newContact),
            'newPpc' => count($newPpc),
            'calling' => count($calling),
            'todayCalling' => count($todayCalling),
            'newSupport' => count($newSupport),
        );

        echo json_encode($data);
        
    }
 
}

?>