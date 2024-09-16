<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Dictionary extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('admin/dictionary_model');
        $this->load->model('admin/Latest_News_model');
        $this->load->model('admin/Category_model');
    }
    
    /**
     * Index Page for this controller.
     */
    public function index()
    {
        // $this->isLoggedIn();

        $this->global['pageTitle'] = 'Insaaf99 : Dictionary';
        $this->loadViews("admin/dictionary/list", $this->global, NULL, NULL, 'admin');
    }
   
    
    // Add New 
    
    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
        
        $this->loadViews("admin/dictionary/addnew", $this->global, NULL, NULL, 'admin');
        
    }
    
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
       
        $result = $this->dictionary_model->delete($id);
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
      
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('alphabet', 'Alphabet', 'trim|required');
        
        $form_data = $this->input->post();
       
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            
            date_default_timezone_set("Asia/Calcutta");
     
            $insertData['alphabet']       = $form_data['alphabet'];
            $insertData['alphabet_hi']       = $form_data['alphabet_hi'];
            $insertData['status']         = $form_data['status'];
            $insertData['descreption']    = $form_data['descreption'];
            $insertData['descreption_hi']    = $form_data['descreption_hi'];
            $insertData['slug']       = $form_data['slug_url'];
            $insertData['date_at']             = date("Y-m-d H:i:s");



            $result                    = $this->dictionary_model->save($insertData);
         
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Act Added Successfully');
                redirect('admin/dictionary');
            } else {
                $this->session->set_flashdata('error', ' Failed to Add Dictionary  ');
                redirect('admin/dictionary/addnew');
            }
        }
    }
    
    // category list
    public function ajax_list()
    {
        error_reporting(0);
        $this->isLoggedIn();
      
        $list = $this->dictionary_model->get_datatables();
        //    pre($list);
        $data = array();
        $no   = (isset($_POST['start'])) ? $_POST['start'] : '';
        // save data for parent catelgory list
        
        foreach ($list as $currentObj) {

            // pre($currentObj);
            $temp_date = $currentObj->date_at;
            $date_at   = date("d-m-Y h:i a", strtotime($temp_date));
            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = $currentObj->alphabet;
            $row[] = $currentObj->status == 1 ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="' . base_url() . 'admin/dictionary/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn"  href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
            $data[] = $row;
        }
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->dictionary_model->count_all(),
            "recordsFiltered" => $this->dictionary_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    // update by ajax 
    public function changestatus(){

        if(isset($_POST['id']) && $_POST['id'] !='')
        {
            
            $columnName  = $_POST['columnName'];
            $insertData['id'] = $_POST['id'];
            $insertData[$columnName] = $_POST['status'];
            $result = $this->dictionary_model->save($insertData);
            
        }
    }
    
    // Edit
    
    public function edit($id = NULL)
    {
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/dictionary');
        }
        $data['edit_data']         = $this->dictionary_model->find($id);
   
        $this->global['pageTitle'] = 'Insaaf99 :Edit News';
        $this->loadViews("admin/dictionary/edit", $this->global, $data, NULL, 'admin');
    }
    
    // Update category*************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('alphabet', 'alphabet', 'trim|required');
        //form data 
        $form_data = $this->input->post();
    
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
            date_default_timezone_set("Asia/Calcutta");
          
            
          
            $updateData['id']       = $form_data['id'];
            $updateData['alphabet']       = $form_data['alphabet'];
            $updateData['alphabet_hi']       = $form_data['alphabet_hi'];
            $updateData['status']         = $form_data['status'];
            $updateData['descreption']    = $form_data['descreption'];
            $updateData['descreption_hi']    = $form_data['descreption_hi'];
            $updateData['slug']       = $form_data['slug_url'];
            $updateData['date_at']             = date("Y-m-d H:i:s");
  
          
          
            $result = $this->dictionary_model->save($updateData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Your Act  successfully Updated');
                redirect('admin/dictionary');
            } else {
                $this->session->set_flashdata('error', ' Failed to Update Dictionary');
                redirect('admin/dictionary/edit/' . $updateData['id']);
            }
        }
    }


}

?>