<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Testimonial extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('admin/testimonial_model');
        $this->load->model('admin/Latest_News_model');
        $this->load->model('admin/Category_model');
    }
    
    /**
     * Index Page for this controller.
     */
    public function index()
    {
        // $this->isLoggedIn();

        $this->global['pageTitle'] = 'Insaaf99 : Sub Category';
        $this->loadViews("admin/testimonial/list", $this->global, NULL, NULL, 'admin');
    }
   
    
    // Add New 
    
    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
        
        $this->loadViews("admin/testimonial/addnew", $this->global, NULL, NULL, 'admin');
        
    }
    
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
       
        $result = $this->testimonial_model->delete($id);
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
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        
        $form_data = $this->input->post();
        
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {

            $insertData['name']       = $form_data['name'];
            $insertData['name_hi']       = $form_data['name_hi'];
            $insertData['descreption']    = $form_data['descreption'];
            $insertData['descreption_hi']       = $form_data['descreption_hi'];
            $updateData['designation']       = $form_data['designation'];
            $insertData['status']         = $form_data['status'];
            $insertData['date_at']             = date("Y-m-d H:i:s");
      
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                $f_name      = $_FILES['image']['name'];
                $f_tmp       = $_FILES['image']['tmp_name'];
                $f_size      = $_FILES['image']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/testimonial/" . $f_newfile;
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {

                    if(isset($form_data['old_image']) && !empty($form_data['old_image'])){
                        $file = "uploads/testimonial/" .$form_data['old_image'];
                        if(file_exists($file))
                        {
                            unlink($file);
                        }
                    }

                    $insertData['image'] = $f_newfile;
                    
                }
            }
            
             $result                    = $this->testimonial_model->save($insertData);
         
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Act Added Successfully');
                redirect('admin/testimonial');
            } else {
                $this->session->set_flashdata('error', ' Failed to Add News  ');
                redirect('admin/testimonial/addnew');
            }
        }
    }
    
    // category list
    public function ajax_list()
    {
        error_reporting(0);
        $this->isLoggedIn();
      
        $list = $this->testimonial_model->get_datatables();
        //    pre($list);
        $data = array();
        $no   = (isset($_POST['start'])) ? $_POST['start'] : '';
        // save data for parent catelgory list
        
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->date_at;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = $currentObj->name;
            $row[] = $currentObj->status == 1 ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="' . base_url() . 'admin/testimonial/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn"  href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
            $data[] = $row;
        }
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->testimonial_model->count_all(),
            "recordsFiltered" => $this->testimonial_model->count_filtered(),
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
            $result = $this->testimonial_model->save($insertData);
            
        }
    }
    
    // Edit
    
    public function edit($id = NULL)
    {
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/testimonial');
        }
        $data['edit_data']         = $this->testimonial_model->find($id);
   
        $this->global['pageTitle'] = 'Insaaf99 :Edit News';
        $this->loadViews("admin/testimonial/edit", $this->global, $data, NULL, 'admin');
    }
    
    // Update category*************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        //form data 
        $form_data = $this->input->post();
       
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
           
            
            $updateData['id']       = $form_data['id'];
            $updateData['name']       = $form_data['name'];
            $updateData['name_hi']       = $form_data['name_hi'];
            $updateData['descreption']    = $form_data['descreption'];
            $updateData['descreption_hi']       = $form_data['descreption_hi'];
            $updateData['designation']       = $form_data['designation'];
            $updateData['status']         = $form_data['status'];
            $updateData['date_at']             = date("Y-m-d H:i:s");

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                
                $f_name      = $_FILES['image']['name'];
                $f_tmp       = $_FILES['image']['tmp_name'];
                $f_size      = $_FILES['image']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/testimonial/" . $f_newfile;
                
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    $file = "uploads/testimonial/".$form_data['old_image'];
                    
                        if(file_exists( $file))
                        {
                            unlink($file);
                        }
                        $updateData['image'] = $f_newfile;
                }
            }
            
          
            $result = $this->testimonial_model->save($updateData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Your testimonial successfully Updated');
                redirect('admin/testimonial');
            } else {
                $this->session->set_flashdata('error', ' Failed to Update Your testimonial');
                redirect('admin/testimonial/edit/' . $updateData['id']);
            }
        }
    }


}

?>