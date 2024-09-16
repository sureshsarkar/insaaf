<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Lawyer_scheduler extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
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

        $where               = array();
        $where['id']         = $id;
        $table               = 'lawyer';
        $data['id']          = $id;
        $data['lawyer_name'] = $this->Lawyer_model->findByTable($where, $table);
        // pre($data['lawyer_name']);
        // exit();
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Cleint';
        $this->loadViews("admin/lawyer_scheduler/list", $this->global, $data, NULL, 'admin');
        
    }
    // Total cases list start 
    
    public function total_cases()
    {
        $this->isLoggedIn();
        $data['total_cases']       = $this->Case_details_model->getparent_id();
        $this->global['pageTitle'] = 'Total cases ';
        $this->loadViews("admin/case_details/list1", $this->global, $data, NULL, 'admin');
        
    }

    

  
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
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
    // Insert Member *************************************************************
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

           } else {
            $insertData                         = array();
            $insertData['lawyer_id']            = $form_data['lawyer_id'];
            $insertData['schedule_date']        = $form_data['schedule_date'];
            $insertData['schedule_time']        = date('h:i:a', strtotime($form_data['schedule_time'])); 
            $dayName                            =date("D", strtotime($insertData['schedule_date']));
            $insertData['schedule_day']         = $dayName;
            $insertData['schedule_status']      = 1;
            $insertData['dt']                   = date("Y-m-d H:i:s");
           
          
            $result = $this->Lawyer_scheduler_model->save($insertData);
            if ($result > 0) {
                echo json_encode(array(
                    'status' => 'true2',
                    'reload' => base_url('admin/Lawyer_scheduler/index/' .$form_data['lawyer_id'])
                ));
           ;
            } else {
                echo json_encode(array(
                    'status' => 'true2',
                    'reload' => base_url('admin/Lawyer_scheduler/index/' .$form_data['lawyer_id'])
                ));
               
            }
         
        }
        
    }
    
    
    
    
    
    public function ajax_list($id = NULL)
    {
        error_reporting(0);
        $where['lawyer_id'] = $id;
        $list               = $this->Lawyer_scheduler_model->findDynamic($where);
       
        
        $no = 1;
        foreach ($list as $currentObj) {
            $row       = array();
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $row[]     = $no;
            
            $lawyer_id       = $currentObj->lawyer_id;
            $lawyer_name = $this->Lawyer_model->find($lawyer_id);
            $row[]         = $lawyer_name->fname.' '.$lawyer_name->lname;
            $row[]     =$currentObj->schedule_date;
            $row[]     =$currentObj->schedule_day;
            $row[]     =$currentObj->schedule_time;
            $row[] = ($currentObj->schedule_status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px" href="' . base_url() . 'admin/Lawyer_scheduler/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a>  ';
            
            // &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="'.base_url().'admin/Case_details/view1/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a>
            
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
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/lawyer');
        }
   

        $sql = "SELECT  * FROM lawyer_scheduler "; 
        $sql .=" WHERE   `id`='".$id."'";
        $data11['schedule'] = $this->Lawyer_scheduler_model->rawQuery($sql);
        $data['schedule_detail']=$data11['schedule'][0];
        $this->global['pageTitle'] = 'Insaaf99 : Edit Client';
        $this->loadViews("admin/lawyer_scheduler/edit", $this->global, $data, NULL, 'admin');
    }

    public function view($id = NULL)
    {
        
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/Case_details/index');
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
        $this->loadViews("admin/client/view", $this->global, $data, NULL, 'admin');
        
    }
    
    // Update category*************************************************************
    public function update()
    {
        // pre($_POST);
        // exit();
        $this->isLoggedIn();
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('fname','fname','trim|required');
        $this->form_validation->set_rules('schedule_date', 'schedule date ', 'trim');
        $this->form_validation->set_rules('schedule_time', 'schedule time ', 'trim');
        
        //form data 
        $form_data = $this->input->post();
     ;
     
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
            $insertData['id']                   = $form_data['id'];
            $insertData['schedule_date']        = $form_data['schedule_date'];
            $insertData['schedule_time']        = $form_data['schedule_time'];
            $insertData['schedule_status']      = $form_data['schedule_status'];
          
            $result = $this->Lawyer_scheduler_model->save($insertData);
          
            if ($result > 0) {
                
                
                $this->session->set_flashdata('success', ' Updated Successfully');
                redirect('admin/Lawyer_scheduler/index/'.$form_data['lawyer_id']);
            } else {
                
                $this->session->set_flashdata('error', 'Failed to Update');
              redirect('admin/Lawyer_scheduler/edit/' . $form_data['lawyer_id']);

            }
        }
        
    }
    
    
    
    
}

?>