<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Cases extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       
       $this->load->model('client/case_details_model');
       $this->load->model('client/slot_model');
       $this->load->model('admin/lawyer_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Payment_model');

       $this->isUserLoggedIn(); 
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
       
        // pass data in view    
        $data = array();
        $list = $this->case_details_model->get_datatables();
        $data['caseData'] = $list;
        $this->global['pageTitle'] = 'All Cases';
        $this->loadViews("client/cases/list", $this->global, $data, NULL, 'client');   
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
		$list = $this->case_details_model->get_datatables();
       
        $parentCategoryList = array();
		$data = array();
        $no = (isset($_POST['start']))?$_POST['start']:'';
        // save data for parent catelgory list

      
        foreach ($list as $currentObj) {
            $new = ($currentObj->client_case_noti == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';

            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y", strtotime($temp_date));
            /*------Payment Data -----*/
             $payment_data = $this->Payment_model->find($currentObj->payment_id);
             /*-----------------------*/
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $currentObj->category;
            $row[] = trim($currentObj->fname)." ".trim($currentObj->lname);
            $row[] = $date_at;
            $row[] = ($currentObj->status == 1)?"<small class='text-success text-bold'>Active</small>":"<small class='text-danger text-bold'>Pending</small>";
            $row[] = $new;
            if (isset($payment_data->payment_status) && $payment_data->payment_status=="pending"){
                $row[] = ' <a class="btn btn-sm btn-info " style="margin: 2px;" href="'.base_url().'client/cases/details/'.base64_encode($currentObj->id).'?case_id='.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" >View</a>
                <a class="btn btn-sm btn-primary " style="margin: 2px;" href="'.base_url('client/slot_booking_pay/Pay_for_slot/'.$payment_data->order_id).'" title="Pay">Pay</a> ';
            }else{
                $row[] = ' <a class="btn btn-sm btn-info " style="margin: 2px;" href="'.base_url().'client/cases/details/'.base64_encode($currentObj->id).'?case_id='.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" >View</a> ';
            }
            
            $data[] = $row;
            }
            

        
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->case_details_model->count_all(),
                        "recordsFiltered" => $this->case_details_model->count_filtered(),
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

    public function details($id = NULL)
     {
         $id=base64_decode($id);
    
         if($id == null)
         {
            redirect('client/dashboard');
         }
          // update lawyer_meeting_noti status
          if(isset($_GET['slot_id']) && !empty($_GET['slot_id'])){

              $this->slot_model->save(array('id'=> $_GET['slot_id'],'client_meeting_noti'=>1));
          }
          if(isset($_GET['case_id']) && !empty($_GET['case_id'])){
          // update lawyer_meeting_noti status
          $this->case_details_model->save(array('id'=> $_GET['case_id'],'client_case_noti'=>1));
          }

         $case_data = $this->case_details_model->find($id);
         $data['case_data'] = $case_data;
       
         if(!empty($data['case_data'])){
             $lawyerId=$data['case_data']->asign_lawyer_id;
             $where2 = array();
             $where2['id'] = $lawyerId;
             $lawyer_data = $this->lawyer_model->findDynamic($where2);
             $data['lawyer_data'] = empty($lawyer_data)?'':$lawyer_data[0];

             $slotData = $this->case_details_model->findDynamic(array('table'=>'slot', 'case_id' => $id));
             $data['slot_data'] = empty($slotData)?'':$slotData[0];

             $case_cat_data = $this->Case_category_model->find($case_data->case_category_id);
             $data['case_cat_data'] = $case_cat_data;

             $payment_data = $this->Payment_model->find($case_data->payment_id);
             $data['payment_data'] = $payment_data;

         }
        
         // pre($data );
         // exit();
        
         $this->global['pageTitle'] = 'Client Dashboard';
         $this->loadViews("client/total_cases/view", $this->global, $data , NULL ,'client');    
         
     } 

    // chat refresh & save
    

    
    
    
}

?>