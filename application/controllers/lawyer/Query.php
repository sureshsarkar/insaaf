<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



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

         $this->load->model('Base_model');
        $this->load->model('lawyer/Hearing_date_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        $this->load->model('admin/Case_details_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('front/orders_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Lawyer_scheduler_model');
        $data['case_category1']=$this->Case_category_model->all();
        $this->load->model('admin/Slot_model');

       $this->load->model('admin/client_query_model');
       $this->load->model('admin/lawyer_model');
       $this->load->model('admin/client_model');

       $this->isLawyerLoggedIn(); 
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {   

        // pass data in view    
        $data = array();
        $this->global['pageTitle'] = 'My Query';
        $this->loadViews("lawyer/query/list", $this->global, $data, NULL, 'lawyer');   
    }
    
    // Add New 

   


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
            /* $insertData['width'] = $form_data['width'];
             $insertData['height'] = $form_data['height'];*/
          
           // $insertData['sizeCode'] = $form_data['sizeCode'];
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

		$list = $this->client_query_model->get_datatables();
        $parentCategoryList = array();
		$data = array();
        $no = (isset($_POST['start']))?$_POST['start']:'';
        // save data for parent catelgory list

      
        foreach ($list as $currentObj) {
          
            $temp_date = $currentObj->dateAt;
            $date_at = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<p class="wrapText">'.$currentObj->msg.'<p>';
            // $userData = $this->lawyer_model->find($currentObj->assign_lawyer);
            $clientData = $this->client_model->find($currentObj->user_id);
              // pre($clientData);
            $row[] = $clientData->fname;
            $row[] = $currentObj->status;
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info " href="'.base_url().'lawyer/query/chat/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
            
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
            // get assign lawyer details 
            $sql = "SELECT c.*,q.status as chat_status, q.closed_by FROM client_query as q JOIN clint as c ON c.id = q.user_id WHERE q.id = '".$id."' ";
            
            $uData = $this->client_query_model->rawQuery($sql);
            $data['dbData'] = (isset($uData) && !empty($uData))?$uData[0]:'';
            $data['chatId'] = $id;
        }


        //Define pass data in view ==================================
        $userName = (isset($uData) && !empty($uData))?$uData[0]->fname:'';
        $data['chat_hide'] = '1';    

        $this->global['pageTitle'] = 'Chat with '.$userName;
        $this->loadViews("lawyer/query/chat", $this->global, $data , NULL ,'lawyer');    
        
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
                $rArr = array('new_query'=>1,'chatId'=>$insId);
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
         $sql = "UPDATE client_query SET seen = '1' WHERE parent_id = '".$fData['chatId']."' AND type != 'client' ";
         $this->client_query_model->rawQuery($sql);
       }
       
      
       if(isset($lastChatId) && $lastChatId == $fData['latChatId']){
         echo 'no_have_new';
       }else{
           echo json_encode($rData);
       }
    } 

    
    // for copy cody
    public function copy_code_sess_distroy(){
        $this->session->unset_userdata('chat_id');
        $this->session->unset_userdata('chat_user');
        echo "Done";
    }

    // for close query
    public function close_query(){
        $w['id'] = $_POST['id'];
        $w['closed_by'] = $_SESSION['fname']." ".$_SESSION['lname'];
        $w['status'] = '1';
        $this->client_query_model->save($w);

        // update all
        $sql = " UPDATE client_query SET status = '1' WHERE parent_id = '".$_POST['id']."'";
        $this->client_query_model->rawQuery($sql);
        echo "Done";
    }

    
    
}

?>