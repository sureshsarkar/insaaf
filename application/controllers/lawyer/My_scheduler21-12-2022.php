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
    }
    
    /**
     * Index Page for this controller.
     */
    public function index($id = NULL)
    {
       $id=base64_decode($id);

        $where               = array();
        $where['id']         = $id;
        $table               = 'lawyer';
        $data['id']          = $id;
        $data['lawyer_name'] = $this->Lawyer_model->findByTable($where, $table);
      
        $this->isLawyerLoggedIn();  
        $this->global['pageTitle'] = 'Insaaf99 : Cleint';
        $this->loadViews("lawyer/my_scheduler/list", $this->global, $data, NULL, 'lawyer');
        
    }
    // Total cases list start 
    
    public function total_cases()
    {
        $this->isLawyerLoggedIn();  
        $data['total_cases']       = $this->Case_details_model->getparent_id();
        $this->global['pageTitle'] = 'Total cases ';
        $this->loadViews("lawyer/case_details/list1", $this->global, $data, NULL, 'lawyer');
        
    }

  
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLawyerLoggedIn();  
        $id    = $_POST['id'];
        // get image path 
        $rData = $this->Lawyer_scheduler_model->find($id);
        
        $result = $this->Lawyer_scheduler_model->delete($id);
        
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
   
    // end category 

    // Insert  *************************************************************
    public function insertnow()
    {
        date_default_timezone_set('Asia/Kolkata');
        $form_data = $this->input->post();
  
        $this->load->library('form_validation');
        $this->form_validation->set_rules('schedule_date', ' schedule date', 'trim|required');
        $this->form_validation->set_rules('schedule_time', ' schedule time', 'trim|required');
          if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'status' => 'true1',
                 ));
                //  pre("ok");
                 exit();

           }else{
           
               $scheduleDT           = date("Y-m-d", strtotime($form_data['schedule_date'])); 
               $where['schedule_date']  = $scheduleDT;
               $where['lawyer_id']  =$form_data['lawyer_id'] ;
               
               $old_schedule_date    = $this->Lawyer_scheduler_model->findOneBy($where);
                if (!empty($old_schedule_date)){
                    echo json_encode(array(
                        'status' => 'true3'
                    ));
                }else{
                
            $insertData                         = array();
            $insertData['lawyer_id']            = $form_data['lawyer_id'];
            $insertData['schedule_date']        = date("Y-m-d", strtotime($form_data['schedule_date'])); 

            $schedule_time                      = $form_data['schedule_time'];
            $time=explode(',',$schedule_time);
            $insertData['schedule_time']        =json_encode($time);

            $dayName                            =date("D", strtotime($insertData['schedule_date']));
            $insertData['schedule_day']         = $dayName;
            $insertData['schedule_status']      = 1;
            $insertData['dt']                   = date("Y-m-d H:i:s");
   
            $result = $this->Lawyer_scheduler_model->save($insertData);
           
            if ($result > 0) {
                echo json_encode(array(
                    'status' => 'true2',
                    'reload' => base_url('lawyer/My_scheduler/index/'.base64_encode($form_data['lawyer_id']))
                ));
           ;
            } else {
                echo json_encode(array(
                    'status' => 'true2',
                    'reload' => base_url('lawyer/My_scheduler/index/'.base64_encode($form_data['lawyer_id']))
                ));
               
            }
         
        }
        }
        
    }
    
    
    
    
    
    public function ajax_list($id = NULL)
    {
        error_reporting(0);
     
         $sql = "SELECT  * FROM lawyer_scheduler "; 
         $sql .=" WHERE `lawyer_id`='".$id."' ORDER BY id DESC";
         $list= $this->Lawyer_scheduler_model->rawQuery($sql);

        $no = 1;
        foreach ($list as $currentObj) {
            $row       = array();

            $row[] = '<span class="btn-primary btn12 badge">'.$no.'</span>';

            $lawyer_id       = $currentObj->lawyer_id;
            $lawyer_name = $this->Lawyer_model->find($lawyer_id);
            $row[]         = $lawyer_name->fname.' '.$lawyer_name->lname;
            $row[]     =$currentObj->schedule_date;
            $row[]     =$currentObj->schedule_day;
            $time=json_decode($currentObj->schedule_time);
            $row[]     =$time[0];
            $row[] = ($currentObj->schedule_status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px" href="' . base_url() . 'lawyer/My_scheduler/view/'.base64_encode($currentObj->id). '" title="view" ><i class="fa fa-eye"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info" style="margin: 4px 0px" href="' . base_url() . 'lawyer/My_scheduler/edit/'.base64_encode($currentObj->id). '" title="Edit" ><i class="fa fa-pencil"></i></a>  ';
            
            
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
    
    
    public function edit($id = NULL)
    {
        $id=base64_decode($id);
        $this->isLawyerLoggedIn();  
        if ($id == null) {
            redirect('lawyer/lawyer');
        }
   

        $sql = "SELECT  * FROM lawyer_scheduler "; 
        $sql .=" WHERE   `id`='".$id."'";
        $data11['schedule'] = $this->Lawyer_scheduler_model->rawQuery($sql);
        $data['schedule_detail']=$data11['schedule'][0];
        $this->global['pageTitle'] = 'Insaaf99 : Edit Client';
        $this->loadViews("lawyer/my_scheduler/edit", $this->global, $data, NULL, 'lawyer');
    }

    
    // Update *************************************************************
    public function update()
    {
        
        $this->isLawyerLoggedIn();  
        $this->load->library('form_validation');
        $this->form_validation->set_rules('schedule_date', 'schedule date ', 'trim');
        $this->form_validation->set_rules('schedule_time', 'schedule time ', 'trim');
        
        $form_data = $this->input->post();
     
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
            $insertData['id']                   = $form_data['id'];
            $insertData['schedule_date']        = $form_data['schedule_date'];
            $insertData['schedule_time']        = json_encode($form_data['schedule_time']);
            $insertData['schedule_status']      = $form_data['schedule_status'];
           
            $result = $this->Lawyer_scheduler_model->save($insertData);
          
            if ($result > 0){
                $this->session->set_flashdata('success', ' Updated Successfully');
                redirect('lawyer/My_scheduler/index/'.base64_encode($form_data['lawyer_id']));
            } else {
                $this->session->set_flashdata('error', 'Failed to Update');
              redirect('lawyer/My_scheduler/edit/'.base64_encode($form_data['lawyer_id']));

            }
        }
    }
    
    public function view($id = NULL)
    {
        $id=base64_decode($id);
        $this->isLawyerLoggedIn();

        $data['view_data'] = $this->Lawyer_scheduler_model->find($id);
        $this->global['pageTitle'] = ' View case';
        $this->loadViews("lawyer/my_scheduler/view", $this->global, $data , NULL,'lawyer');    
        
    }
    
    
    
    
}

?>