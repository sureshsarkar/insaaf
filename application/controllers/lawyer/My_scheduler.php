<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class My_scheduler extends BaseController
{
    
    
    //   This is default constructor of the class
   
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        $this->load->model('admin/Case_details_model');
        $this->load->model('admin/Lawyer_model');
        $this->load->model('admin/Lawyer_scheduler_model');
        $this->load->library('user_agent');
    }
    
    /**
     * Index Page for this controller.
     */
    public function index()
    {
       $id= $_SESSION['id'];

        $where               = array();
        $where['id']         = $id;
        $table               = 'lawyer';
        $data['id']          = $id;
        $data['lawyer_name'] = $this->Lawyer_model->findByTable($where, $table);
        $w['lawyer_id']  = $id;
        $data['scheduler_data'] = $this->Lawyer_scheduler_model->findDynamic($w);
   
        $this->isLawyerLoggedIn();  
        $this->global['pageTitle'] = 'Insaaf99 : Cleint';
        $this->loadViews("lawyer/my_scheduler/list", $this->global, $data, NULL, 'lawyer');   
    }

    function update_schedule($id){
      //print_r($_POST); die();
        $tempArr =  $_POST;
        $updateArr = array();
        if(!empty($tempArr)){
            foreach ($tempArr as $key => $value) {
                $temp2 = explode('_', $key);
                $temp3 = isset($updateArr[strtolower($temp2[0])])?$updateArr[strtolower($temp2[0])]:array();
                array_push($temp3,$value);
                $updateArr[strtolower($temp2[0])] = $temp3;
            }
            unset($updateArr['update']);
        }

        // when days not in array 
        $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        foreach ($days as $k => $day) {
           if(!isset($updateArr[strtolower($day)])){
                $updateArr[strtolower($day)] =  array();
           } 
        }

       $this->load->model('admin/lawyer_scheduler_model');
       $w['lawyer_id']  = $id;
       $sData = $this->lawyer_scheduler_model->findDynamic($w);
       $myArr = array();
       foreach($sData as $key => $value) {
            $myArr[strtolower($value->schedule_day)] = $value;
           }

      
       //  schedule data
       $update = 0;
     

       //return $myData; 

       foreach ($updateArr as $key => $value) {
           $w = array(); 
           $w['lawyer_id'] = $id;
           $w['schedule_day'] = ucfirst($key);
           $w['schedule_time'] = json_encode($value);
           $w['schedule_status'] = 1;



           if(isset( $myArr[strtolower($key)])){
            $w['id'] = $myArr[strtolower($key)]->id;
           }
           $updateDb = $this->lawyer_scheduler_model->save($w);
           $update = 1;
       }

       if(isset($_POST['action']) && strtolower($_POST['action']) == 'complete_profile'){
            lawyer_profile_status($_SESSION['id']);
            redirect('lawyer/profile/edit?action=verify_email&action=complete_profile');
         }else{
           redirect($this->agent->referrer());
        }
         
    }
  
    
    
    
    
}

?>