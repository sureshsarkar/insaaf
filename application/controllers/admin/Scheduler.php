<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Scheduler extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('admin/scheduler_model');

        $this->isLoggedIn();
    }

    // Index schduler *************************************************************
    
    public function index()
    {
        $this->global['pageTitle'] = 'Insaaf99 : Sub Category';
        $this->loadViews("admin/scheduler/list", $this->global, NULL, NULL, 'admin');
    }


      // category list
      public function ajax_list()
      {
          error_reporting(0);
          $this->isLoggedIn();
        
          $list = $this->scheduler_model->get_datatables();
          //    pre($list);
          $data = array();
          $no   = (isset($_POST['start'])) ? $_POST['start'] : '';
          // save data for parent catelgory list
          
          foreach ($list as $currentObj) {
              $temp_date = $currentObj->dateAt;
              $date_at   = date("d-m-Y", strtotime($temp_date));
              $no++;
              $row   = array();
              $row[] = $no;
              $row[] = $currentObj->date;
              $row[] = $currentObj->time;
              $row[] = $date_at;
              $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="' . base_url() . 'admin/scheduler/edit/' . $currentObj->id . '" title="view" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn"  href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
              $data[] = $row;
          }
          $output = array(
              "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
              "recordsTotal" => $this->scheduler_model->count_all(),
              "recordsFiltered" => $this->scheduler_model->count_filtered(),
              "data" => $data
          );
          //output to json format
          echo json_encode($output);
      }


          // Add New 
    
    public function addnew()
    {
     
        $tempArr = getStaticTime();
        $data['times']=$tempArr;
        $this->global['pageTitle'] = 'Insaaf99 : Add New scheduler';
       
        $this->loadViews("admin/scheduler/addnew", $this->global, $data, NULL, 'admin');
        
    }

    public function edit($id)
    {
     
        $tempArr = getStaticTime();
        $data['times']=$tempArr;

        $data['edit_data'] =  $this->scheduler_model->find($id);
      
        $this->loadViews("admin/scheduler/edit", $this->global, $data, NULL, 'admin');
        
    }
    
    // delete category 
    public function delete()
    {
        $id    = $_POST['id'];
       
        $result = $this->scheduler_model->delete($id);
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

   
    // Insert schduler *************************************************************
    public function insertnow()
    {
      
        $form_data = $this->input->post();
      


            $insertData['date']        = date("Y-m-d",strtotime($form_data['date']));
            $insertData['time']        = json_encode($form_data['time']);
            $insertData['dateAt']      = date("Y-m-d H:i:s");
    
            $result                    = $this->scheduler_model->save($insertData);
         
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Scheduler Added Successfully');
                redirect('admin/scheduler');
            } else {
                $this->session->set_flashdata('error', ' Failed to Add News  ');
                redirect('admin/scheduler/addnew');
            }
        
    }
    
    
    // Update scheduler*************************************************************
    public function update()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        //form data 
        $form_data = $this->input->post();
     
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
            date_default_timezone_set("Asia/Calcutta");
          
            $updateData['id']          = $form_data['id'];
            $updateData['date']        = date("Y-m-d",strtotime($form_data['date']));
            $updateData['time']        = json_encode($form_data['time']);

            $result = $this->scheduler_model->save($updateData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Your Scheduler  successfully Updated');
                redirect('admin/scheduler');
            } else {
                $this->session->set_flashdata('error', ' Failed to Update Your Scheduler');
                redirect('admin/scheduler');
            }
        }
    }


}

?>