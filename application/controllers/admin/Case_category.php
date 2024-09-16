<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Case_category extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('admin/case_category_model');
    }
    
    /**
     * Index Page for this controller.
     */
    public function index()
    {
        
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Category';
        $this->loadViews("admin/case_category/list", $this->global, NULL, NULL, 'admin');
        
    }
    
    // Add New 
    
    public function addnew()
    {
        
        $data['parent_list'] = $this->case_category_model->getparent_id();
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New case Category';
        $this->loadViews("admin/case_category/addnew", $this->global, $data, NULL, 'admin');
    }
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
        // get image path 
        $rData = $this->case_category_model->find($id);
        $file  = 'uploads/category/' . $rData->image;
        // delete image
        unlink($file);
        $result = $this->case_category_model->delete($id);
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
        // pre($_POST);
        // exit();
        
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Category', 'trim|required');
        $this->form_validation->set_rules('total_amount', 'total_amount', 'trim|required');
        $this->form_validation->set_rules('owner_percentage', 'owner_percentage', 'trim|required');
        $this->form_validation->set_rules('owner_amount', 'owner_amount', 'trim|required');
        $this->form_validation->set_rules('lawyer_amount', 'lawyer_amount', 'trim|required');
        $this->form_validation->set_rules('gst', 'GST', 'trim|required');
        $this->form_validation->set_rules('about', 'About', 'trim');
        //form data 
        $form_data = $this->input->post();
        //  pre($form_data);
        // exit();
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            
            $insertData['name']             = $form_data['name'];
            $insertData['name_hi']          = $form_data['name_hi'];
            $insertData['total_amount']     = $form_data['total_amount'];
            $insertData['owner_percentage'] = $form_data['owner_percentage'];
            $insertData['owner_amount']     = $form_data['owner_amount'];
            $insertData['lawyer_amount']    = $form_data['lawyer_amount'];
            $insertData['slug_url']         = $form_data['slug_url'];
            $insertData['status']           = $form_data['status'];
            $insertData['gst']              = $form_data['gst'];
            $insertData['gst_amount']        = $form_data['gst_amount'];
            $insertData['about']            = $form_data['about'];
            
            if (isset($form_data['parent_id'])) {
                $insertData['parent_id'] = $form_data['parent_id'];
            }
            $insertData['dt'] = date("Y-m-d H:i:s");
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                $f_name      = $_FILES['image']['name'];
                $f_tmp       = $_FILES['image']['tmp_name'];
                $f_size      = $_FILES['image']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/category/" . $f_newfile;
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    $insertData['image'] = $f_newfile;
                    
                }
            }
            
            $result = $this->case_category_model->save($insertData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Case Category successfully Added');
                redirect('admin/case_category/');
            } else {
                $this->session->set_flashdata('error', 'Case Category Addition failed');
            }
            redirect('admin/case_category/addnew');
        }
        
    }
    
    
    // category list
    public function ajax_list()
    {
        $list = $this->case_category_model->get_datatables();
        // pre($list);
        $parentCategoryList = array();
        $data               = array();
        $no                 = (isset($_POST['start'])) ? $_POST['start'] : '';
        // save data for parent catelgory list
        foreach ($list as $currentObj) {
            $parentCategoryList[$currentObj->id] = $currentObj->name;
        }
        
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = $currentObj->name;
            $row[] = $currentObj->total_amount;
            $row[] = $currentObj->status == 1 ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" href="' . base_url() . 'admin/case_category/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin: 4px 0px;" href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
            
            $data[] = $row;
        }
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->case_category_model->count_all(),
            "recordsFiltered" => $this->case_category_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    
    // Edit
    
    public function edit($id = NULL)
    {
        
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/category');
        }
        // $data['parent_list']       = $this->case_category_model->getparent_id();
        $data['edit_data']         = $this->case_category_model->find($id);
        // pre($data['parent_list'] );
        // pre($data['edit_data']);
        // exit();
        $this->global['pageTitle'] = 'Insaaf99 : Edit Members';
        $this->loadViews("admin/case_category/edit", $this->global, $data, NULL, 'admin');
        
        
    }
    
    // Update category*************************************************************
    public function update()
    {
        // pre($_POST);
        // exit();
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'category', 'trim|required');
        $this->form_validation->set_rules('about', 'About', 'trim');
        $this->form_validation->set_rules('id', 'Id', 'trim|required');
        
        //form data 
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
            $insertData['id']               = $form_data['id'];
            $insertData['name']             = $form_data['name'];
            $insertData['name_hi']          = $form_data['name_hi'];
            $insertData['total_amount']     = $form_data['total_amount'];
            $insertData['owner_percentage'] = $form_data['owner_percentage'];
            $insertData['owner_amount']     = $form_data['owner_amount'];
            $insertData['gst']              = $form_data['gst'];
            $insertData['gst_amount']       = $form_data['gst_amount'];
            $insertData['lawyer_amount']    = $form_data['lawyer_amount'];
            $insertData['slug_url']         = $form_data['slug_url'];
            $insertData['about']            = $form_data['about'];
            $insertData['status']           = $form_data['status'];
            $insertData['dt']               = date("Y-m-d H:i:s");
            
            
            $result = $this->case_category_model->save($insertData);
            
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Case Category successfully Updated');
                redirect('admin/case_category');
            } else {
                $this->session->set_flashdata('error', 'Case Category Updation failed');
            }
            redirect('admin/case_category/edit/' . $insertData['id']);
        }
        
    }
    
    
    
    
}

?>