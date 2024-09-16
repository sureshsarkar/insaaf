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

       $this->isLoggedIn();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {   

        // pass data in view    
        $data = array();
        $this->global['pageTitle'] = 'My Query';
        $this->loadViews("admin/query/list", $this->global, $data, NULL, 'admin');   
    }
    
    // Add New 

   


    

    //  this code  code user detaisl  
    public function userData(){
       
        if(!empty($_SESSION['id'])){
            $userID = $_SESSION['id'];
            $userData = $this->lawyer_model->find($userID);
            if(!empty($userData)){
                $data['userData'] = $userData;
                $this->isUserLoggedIn(); 
                $this->global['pageTitle'] = 'Insaaf99 : Lawyer';
                $this->loadViews("lawyer/lawyer/list", $this->global, $data , NULL ,'admin');
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
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-success blink_now " >New</span>':'';
            $temp_date = $currentObj->dateAt;
            $date_at = date("d-m-Y h:i a", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<p class="wrapText">'.$currentObj->msg.'<p>';
            // $userData = $this->lawyer_model->find($currentObj->assign_lawyer);
            $clientData = $this->client_model->find($currentObj->user_id);
            $lawyerData = $this->lawyer_model->find($currentObj->assign_lawyer);
              // pre($clientData);
            $row[] = isset($clientData->fname)?$clientData->fname." ".$clientData->lname:'';
            $row[] = isset($lawyerData->fname)?$lawyerData->fname." ".$lawyerData->lname:'-';
            $row[] = ($currentObj->status == 0)?"Open ".$new:'Closed';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info " href="'.base_url().'admin/query/chat/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin: 4px 0px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a>';
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
        $this->loadViews("lawyer/lawyer/edit", $this->global, $data , NULL ,'admin');    
        
    } 


      // delete certificate 
  public function delete()
  {
      // define path for file location 
      $this->isLoggedIn();
      $id    = $_POST['id'];
      // get image path 
      $rData = $this->client_query_model->find($id);
      
      $result = $this->client_query_model->delete($id);
      
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
        $this->loadViews("admin/query/chat", $this->global, $data , NULL ,'admin');    
        
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