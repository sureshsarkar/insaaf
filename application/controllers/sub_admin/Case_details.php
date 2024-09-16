<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Case_details extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/client_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        $this->load->model('admin/Case_details_model');
        $this->load->model('admin/Lawyer_model');
        $this->isLoggedSubAdmin();
    }
    
    /**
     * Index Page for this controller.
     */
    public function index()
    {
       
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $data['id']=base64_decode($_GET['key']);
            $data['status']=1;
            $data['update_dt']=date("Y-m-d H:i:s");
            update_notification($data);
        }
        
        $data['total_cases']       = 0;
        $this->global['pageTitle'] = 'Total cases ';
        $this->loadViews("sub_admin/case_details/list1", $this->global, $data, NULL, 'sub_admin');
        
    }
  
    // Total cases list start 
    
    public function pending_cases()
    {
        $where                 = array();
        $where['status']       = 0;
        $table                 = 'cases';
        $data['pending_cases'] = $this->Case_details_model->findByTable($where, $table);
        
        $this->global['pageTitle'] = 'Total cases ';
        $this->loadViews("sub_admin/case_details/list2", $this->global, $data, NULL, 'sub_admin');
        
    }
    
    // Total cases list end 

     // Total cases list start 
    
    
     public function totalNew_cases()
     {
 
         $data['listtype']= $type;
         $this->global['pageTitle'] = 'Total '.$type.' cases';
         $this->loadViews("sub_admin/case_details/list3", $this->global, $data, NULL, 'sub_admin');
         
     }
    
    
    
    // Add New 
    
    public function addnew($id)
    {
        $data['client_id'] = $id;
        
        $data['case_category'] = $this->Case_category_model->getparent_id();
        
        $data['case_sub_category'] = $this->Case_sub_category_model->getparent_id();
        
        $data['lawyer_name'] = $this->Lawyer_model->getparent_id();
        
        $this->global['pageTitle'] = 'Insaaf99 : Add New Client';
        
        $this->loadViews("sub_admin/case_details/addnew", $this->global, $data, NULL, 'sub_admin');
    }
    
    
    public function ajax_call_sub_cat_name()
    {
        $get_id = $this->input->post();
        
        $where['case_category_id'] = $get_id['id'];
        
        $table    = 'case_sub_category';
        $response = $this->Case_sub_category_model->findByTable($where, $table);
        echo json_encode($response);
    }
    
    public function ajax_call_lawyer()
    {
        $get_id = $this->input->post();
        
        $where['sub_case_category_id'] = $get_id['id'];
        $where['status']               = 1;
        $table                         = 'lawyer';
        $response                      = $this->Lawyer_model->findByTable($where, $table);
        
        echo json_encode($response);
    }
    
    // Insert Member *************************************************************
    public function insertnow()
    {
        
        date_default_timezone_set('Asia/Kolkata');
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('asign_lawyer_id', ' Lawyer name', 'trim|required');
        //form data 
        $form_data = $this->input->post();
        
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            $insertData                         = array();
            $insertData['case_category_id']     = $form_data['case_category_id'];
            $insertData['case_sub_category_id'] = $form_data['case_sub_category_id'];
            $insertData['asign_lawyer_id']      = $form_data['asign_lawyer_id'];
            $insertData['case_description']     = $form_data['case_description'];
            $insertData['client_id']            = $form_data['client_id'];
            $insertData['status']               = $form_data['status'];
            $insertData['payment']              = '';
            $insertData['payment_status']       = 0;
            $insertData['dt']                   = date("Y-m-d H:i:s");
           
            // upload file
            if (isset($_FILES['case_file']['name']) && $_FILES['case_file']['name'] != '') {
                
                $f_name      = $_FILES['case_file']['name'];
                $f_tmp       = $_FILES['case_file']['tmp_name'];
                $f_size      = $_FILES['case_file']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/cases/" . $f_newfile;
                
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    $insertData['case_file'] = $f_newfile;
                    
                }
                
            }
            
            $result = $this->Case_details_model->save($insertData);
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Case added successfully');
                redirect('sub_admin/Case_details/index/' . $insertData['client_id']);
            } else {
                $this->session->set_flashdata('error', 'Case  Addition failed');
            }
            redirect('sub_admin/client/addnew');
        }
        
    }


    // Case Detials *************************************************************
    public function details($id = NULL)
    {

        $this->load->model('sub_admin/Payment_model');

      
        if ($id == null) {
            redirect('sub_admin/Case_details');
        }


         $case_data = $this->Case_details_model->find($id);
         $slotData = $this->Case_details_model->findDynamic(array('table'=>'slot', 'case_id' => $id));
         $clientDetails = $this->Case_details_model->findDynamic(array('table'=>'clint', 'id' => $case_data->client_id));
         $data['case_data'] = $case_data;
         $data['slot_data'] = empty($slotData)?'':$slotData[0];
         $data['client'] = empty($clientDetails)?'':$clientDetails[0];

       
         if(!empty($data['case_data'])){
             $lawyerId = $data['case_data']->asign_lawyer_id;
             $where2 = array();
             $where2['table'] = 'lawyer';
             $where2['id'] = $lawyerId;
             $lawyer_data = $this->Case_details_model->findDynamic($where2);
             $data['lawyer_data'] = empty($lawyer_data)?'':$lawyer_data[0];

             $case_cat_data = $this->Case_category_model->find($case_data->case_category_id);
             $data['case_cat_data'] = $case_cat_data;

     

             $payment_data = $this->Payment_model->find($case_data->payment_id);
             $data['payment_data'] = $payment_data;


             // get all matched lawyer list
            $catID = '["'.$case_data->case_category_id.'"]';
            $sql = "SELECT id,fname,lname,status,image,mobile,city FROM lawyer  WHERE status = '1' AND  JSON_CONTAINS(category, '".$catID."' ) ORDER BY id ASC LIMIT 80 ";
            $data['allLawyers'] = $this->Payment_model->rawQuery($sql);
            
         }

         // update seen status
         $this->Case_details_model->save(array('id'=> $id,'seen'=>1));

         $this->global['pageTitle'] = 'Insaaf99 : Case Details';
         $this->loadViews("sub_admin/case_details/details", $this->global, $data, NULL, 'sub_admin');
    }     



    // assign lawyer *************************************************************
    public function assign_lawyer()
    {

        $this->load->model('client/slot_model');
        date_default_timezone_set('Asia/Kolkata');
        if(!isset($_POST['lawyerId']) || !isset($_POST['caseId'])){
            echo "3";
            exit;
        }

        $lawyer = $this->Lawyer_model->find($_POST['lawyerId']);
        $caseData = $this->Case_details_model->find($_POST['caseId']);
        $casecategoryData = $this->Case_category_model->find($caseData->case_category_id);
        $clientData = $this->client_model->find($caseData->client_id);
        $slotData = $this->Case_details_model->findDynamic(array('table'=>'slot', 'case_id' => $_POST['caseId']));

        if(empty($lawyer) || empty($caseData) || empty($slotData)){
            echo "4";
            exit;
        }else{
            $slotData = $slotData[0];
        }
        if(empty($_POST['meetingDate']) && empty($_POST['meetingTime'])){
           
           // update case
           $this->Case_details_model->save(array('id'=>$_POST['caseId'],'status'=> 1, 'asign_lawyer_id'=> $_POST['lawyerId']));

           // update Slot
           $this->slot_model->save(array('id'=>$slotData->id, 'slot_status'=> 1,'remain_status'=>0,'expire_status'=>0, 'lawyer_id'=> $_POST['lawyerId']));
           
            if(isset($slotData) && empty($slotData->again_status_noti)){
                
                    nitification_when_book_slot($clientData,$lawyer,$slotData);// sent notification ,sms,email to lawyer, client & Admin
                  
            
                }else{
                
                    nitification_when_book_slot_reassing_lawyer($clientData,$lawyerData,$slotData); // sent notification ,sms,email to lawyer, client & Admin
                }
          
            // your meeting activated & assigned lawyer & meeting detials
            echo 1;
            exit;
        }else{
           
            // when schedule time change/ rescheduled
            
            $newMeetTime  = date("Y-m-d", strtotime($_POST['meetingDate']))." ".date("H:i:s", strtotime($_POST['meetingTime']));
            $this->slot_model->save(array('id'=>$slotData->id, 'slot_status'=> 1,'remain_status'=>0,'expire_status'=>0, 'meeting_time'=> $newMeetTime));

             reschedulemeet($clientData,$lawyer,$slotData,$_POST,$casecategoryData);// called a function
          
                echo 2;
                exit;
                // send notification TODO || lawyer & client
        }

        echo "Error: Something went wrong!!";
        
    
    }    // assign lawyer *************************************************************


   
    
    
    public function ajax_list($id = NULL)
    {
        
        error_reporting(0);
        $where['client_id'] = $id;
        $list               = $this->Case_details_model->findDynamic($where);
        
        $no = 1;
        foreach ($list as $currentObj) {
            $row       = array();
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $row[] ='<span class="badge">'.$no.'</span>';
            
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $sub_case_id       = $currentObj->case_sub_category_id;
            $sub_category_name = $this->Case_sub_category_model->find($sub_case_id);
            $row[]             = $sub_category_name->case_sub_category;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->Lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
            
            $row[] = ($currentObj->status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px" href="' . base_url() . 'sub_admin/Case_details/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a>';
            
            $data[] = $row;
            $no++;
            
        }
        
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->Case_details_model->count_all(),
            "recordsFiltered" => $this->Case_details_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    // Total Case list
    
    // use for case_details List 
    public function ajax_list1()
    {
        error_reporting(0);

        $list = $this->Case_details_model->get_datatables();
       
        $no   = 1;
        foreach ($list as $currentObj) {
            $new = ($currentObj->seen == 0)?'<span class="badge bg-danger text-danger blink_now" >New</span>':'';
            $isBlink = ($currentObj->slot_status == 9)?' blink_now ':'';
            $status = ($currentObj->slot_status == 1) ? '<span class="btn-info badge">Active</span>' : '<span class="btn-warning badge '.$isBlink.' ">'.$this->config->item('slot_status')[$currentObj->slot_status].'</span>';
            $status = ($currentObj->MeetingStatus != 0)?'<span class="btn-success badge">Meeting Success</span>':$status;
            $payment = ($currentObj->paymentStatus =='Success')?'<span class="btn-success badge">Success</span>':'<span class="btn-darger badge">Failed</span>';
            $row       = array();
            $temp_date = $currentObj->dt;
            $tempMeeting = $currentObj->meeting_time;
            $date_at   = date("d-m-Y h:i a", strtotime($temp_date));
            $meetingAt   = date("d-m-Y h:i A", strtotime($tempMeeting));
            $row[] = '<span class="btn-primary  btn12  badge">'.$no.'</span>';
            
            $row[]         = $currentObj->category_name;
            
            $row[]     = $currentObj->l_fname . ' ' . $currentObj->l_lname;
            
            $row[]  = $currentObj->c_fname . ' ' . $currentObj->c_lname;
          
            
            $row[] = $status." ".$new ;
            $row[] = $payment;
            
            $row[] = $meetingAt;
            $row[] = $date_at;
            $row[] = ' <a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="' . base_url() . 'sub_admin/Case_details/details/' . $currentObj->id . '" title="view"  data_id="' . $currentObj->id . '" ><i class="fa fa-eye"></i></a> ';
            
            $data[] = $row;
            $no++;
            
        }
        
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->Case_details_model->count_all(),
            "recordsFiltered" => $this->Case_details_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    // total Caes list end 

   
    
    // pending Case list
    
    public function ajax_list2()
    {
        
        error_reporting(0);
        $where=array();
        $where['status']=0;
        $where['orderby']='-1';
        $list = $this->Case_details_model->findDynamic($where);
     
        $no = 1;
        foreach ($list as $currentObj) {
            $row       = array();
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y h:i a", strtotime($temp_date));
            $row[] = '<span class="btn-primary  btn12  badge">'.$no.'</span>';
            
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->Lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
            
            
            $client_model = $currentObj->client_id;
            $client_name  = $this->client_model->find($client_model);
            $fullname1    = $client_name->fname . ' ' . $client_name->lname;
            $row[]        = $fullname1;
            
            $row[] = ($currentObj->status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px" href="' . base_url() . 'sub_admin/Case_details/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="' . base_url() . 'sub_admin/Case_details/details/' . $currentObj->id . '" title="view"  data_id="' . $currentObj->id . '" ><i class="fa fa-eye"></i></a> ';
            
            $data[] = $row;
            $no++;
            
        }
        
        
        
        
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->Case_details_model->count_all(),
            "recordsFiltered" => $this->Case_details_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    // pending Caes list end 
  
    // new  Caes list end 
    public function ajax_list3()
    {   
        error_reporting(0);
        $type = $_GET['type'];
      
         if($type=='today'){
             $day =1;
         }else if($type=='week'){
             $day =7;
         }else if($type=='month'){
             $day = 31;
         }else if($type=='year'){
             $day = 365;
         }else{
             $day = 1;
         }
         $data = array();
         /* code for counting today sales */
         $day = $day;
         $model_name = 'Case_details_model';
         $result =  $this->get_ordersales($day,$model_name);
         if(!empty($result)){
             $list =  $result;
         }
        
  
        $no   = 1;
        foreach ($list as $currentObj) {
            $row       = array();
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y H:i:s", strtotime($temp_date));
            $row[] = '<span class="btn-primary  btn12  badge">'.$no.'</span>';

            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
           
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->Lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
            
            
            $client_id = $currentObj->client_id;
            $client_name  = $this->client_model->find($client_id);
           
            $fullname1    = $client_name->fname. ' '.$client_name->lname;
            $row[]        = $fullname1;
            
            $row[] = ($currentObj->status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px" href="' . base_url() . 'sub_admin/Case_details/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;  <a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="' . base_url() . 'sub_admin/Case_details/details/' . $currentObj->id . '" title="view"  data_id="' . $currentObj->id . '" ><i class="fa fa-eye"></i></a> ';
            
            $data[] = $row;
            $no++;
            
        }
        
        
        
        
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->Case_details_model->count_all(),
            "recordsFiltered" => $this->Case_details_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    // Edit
    
    public function edit($id = NULL)
    {
        
        
        if ($id == null) {
            redirect('sub_admin/size');
        }
        $data['edit_data']         = $this->Case_details_model->find($id);
        $data['case_category']     = $this->Case_category_model->getparent_id();
        $data['case_sub_category'] = $this->Case_sub_category_model->getparent_id();
        $data['lawyer_name']       = $this->Lawyer_model->getparent_id();
        $this->global['pageTitle'] = 'Insaaf99 : Edit Client';
        $this->loadViews("sub_admin/case_details/edit", $this->global, $data, NULL, 'sub_admin');
    }
    
    public function ajax_call_case_sub_cat_name()
    {
        $get_id      = $this->input->post();
        $where['case_category_id'] = $get_id['id'];
        $table       = 'case_sub_category';
        $response    = $this->Case_sub_category_model->findByTable($where, $table);
        echo json_encode($response);
    }
    
    public function ajax_call_lawyer_name()
    {
        $get_id                        = $this->input->post();
      
        $where['sub_case_category_id'] = $get_id['id'];
        $where['status']               = 1;
        $table                         = 'lawyer';
        $response                      = $this->Lawyer_model->findByTable($where, $table);
        echo json_encode($response);
    }
    
    public function view($id = NULL)
    {
        
        
        if ($id == null) {
            redirect('sub_admin/Case_details/index');
        }
        $data['edit_data'] = $this->Case_details_model->find($id);
        if (!empty($data['edit_data'])) {
            $CategoryId      = $data['edit_data']->case_type;
            $where           = array();
            $where['id']     = $CategoryId;
            $where['status'] = 1;
            $categoryArray   = $this->Case_category_model->findDynamic($where);
            
            if (!empty($categoryArray)) {
                $data['Categoryname'] = $categoryArray[0]->name;
                
            }
        }
        $this->global['pageTitle'] = 'Insaaf99 : view Client';
        $this->loadViews("sub_admin/client/view", $this->global, $data, NULL, 'sub_admin');
        
    }
    
    
    // Update category*************************************************************
    public function update()
    {
   
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('case_category_id', 'case category ', 'trim');
        $this->form_validation->set_rules('case_sub_category_id', 'case sub category ', 'trim');
        
        //form data 
        $form_data = $this->input->post();
        
        $sql = "SELECT case_file FROM cases WHERE `id`='".$form_data['id']."'"; 
         
        $dbData = $this->Case_details_model->rawQuery($sql);// Fetch data from client table
        $client_data = $dbData[0];
      
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
            $insertData['client_id']            = $form_data['client_id'];
            $insertData['id']                   = $form_data['id'];
            $insertData['case_category_id']     = $form_data['case_category_id'];
            $insertData['case_sub_category_id'] = $form_data['case_sub_category_id'];
            $insertData['asign_lawyer_id']      = $form_data['asign_lawyer_id'];
            $insertData['case_description']     = $form_data['case_description'];
            $insertData['status']               = $form_data['status'];
            if($form_data['status']=='0'){
               $insertData['admin_case_noti']   = 0;
            }else{
               $insertData['admin_case_noti']   = 1;
            }
            if (isset($_FILES['case_file']['name']) && $_FILES['case_file']['name'] != '') {
                
                $f_name      = $_FILES['case_file']['name'];
                $f_tmp       = $_FILES['case_file']['tmp_name'];
                $f_size      = $_FILES['case_file']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/cases/" . $f_newfile;
                
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                   
                    $tempData = $client_data->case_file;
                    $insertData['case_file'] = empty($tempData)?$f_newfile:$tempData.",".$f_newfile;
                    
                }
                
            }
            // pre($insertData);
            // exit();
            $result = $this->Case_details_model->save($insertData);
            
            if ($result > 0) {
                
                
                $this->session->set_flashdata('success', ' Case  successfully Updated');
                redirect('sub_admin/Case_details/index/'.$insertData['client_id']);
            } else {
                
                $this->session->set_flashdata('error', 'Case Updation failed');
              redirect('sub_admin/Case_details/edit/' . $insertData['id']);

            }
        }
        
    }


// update date time function 
    public function update_date_time(){
        if(isset($_POST) && !empty($_POST)){
            $date= $_POST['date'];
            $time= $_POST['time'];
            $data['time']         = date("h:i A",strtotime($time));
            $data['slot_date']    = date("Y-m-d",strtotime($date));
            $data['meeting_time'] = date("Y-m-d H:i:s",strtotime("$date $time"));
 
            $this->db->update('slot',$data,'case_id="'.$_POST['case_id'].'"');
            echo 1;
            exit();
        }
    }

    public function teamsLink(){
        $allData = json_encode(array('meetinglink'=>$_POST['meetinglink'],'password'=>$_POST['password'],'meeting_id'=>$_POST['meeting_id']));
    $data = array(
        'teamsdata' => $allData,
    );
      $this->db->update('slot',$data,'case_id="'.$_POST['case_id'].'"');
      echo 1;
      exit();
    }

    // update_meeting status when meeting done 
    public function update_meeting(){
      if(isset($_POST['case_id']) && !empty($_POST['case_id'])){
        $data = array(
            'MeetingStatus' => 2,
        );
        $this->db->update('slot',$data,'case_id="'.$_POST['case_id'].'"');
        echo 1;
        exit();
      }
    }
    
    
}

?>