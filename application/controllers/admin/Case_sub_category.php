<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Case_sub_category extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {

        parent::__construct();
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Case_sub_category_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Sub Category';
        $this->loadViews("admin/case_sub_category/list", $this->global, NULL , NULL ,'admin');
        
    }

    // Add New 

    public function addnew()
    {
      
        $data['category'] = $this->Case_category_model->getparent_id();
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
        $this->loadViews("admin/case_sub_category/addnew", $this->global, $data , NULL ,'admin');   
    }
    
    
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id = $_POST['id'];
        // get image path 
        $rData = $this->Case_sub_category_model->find($id);
        $file  = 'uploads/category/'.$rData->image;
        // delete image
        unlink($file);
        $result = $this->Case_sub_category_model->delete($id);
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        // pre($_POST);
        // exit();
        
        $this->isLoggedIn();
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('case_category_id','Case Category','trim|required');
        $this->form_validation->set_rules('case_sub_category','Case Sub Category','trim|required');
        //form data 
        $form_data  = $this->input->post();
      
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {


         
            $insertData['case_category_id']  = $form_data['case_category_id'];
            $insertData['case_sub_category']   = $form_data['ca se_sub_category'];
            $insertData['case_sub_category_hi']   = $form_data['case_sub_category_hi'];
            $insertData['status']         = $form_data['status'];
            $insertData['slug_url']       = $form_data['slug_url'];
            $insertData['dt']             =date("Y-m-d H:i:s");	
       
            $result = $this->Case_sub_category_model->save($insertData);
          
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Sub Category successfully Added');
                redirect('admin/case_sub_category');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Sub Category Addition failed');
            }
            redirect('admin/case_sub_category/addnew');
          }  
        
    }

	
    // category list
    public function ajax_list()
    {
        error_reporting(0);
		$list = $this->Case_sub_category_model->get_datatables();
        
        $CategoryList = array();
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        // save data for parent catelgory list
        foreach ($list as $currentObj) {
            $CategoryList[$currentObj->id] = $currentObj->case_category_id;
        }

        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $id=$currentObj->case_category_id;
            $cat_name=$this->Case_category_model->find($id);
            $row[] = $cat_name->name;
            $row[] = $currentObj->case_sub_category;
            $row[] = $currentObj->status==1?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px;" href="'.base_url().'admin/case_sub_category/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin: 4px 0px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> ';

            $data[] = $row;
        }

        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->Case_sub_category_model->count_all(),
                        "recordsFiltered" => $this->Case_sub_category_model->count_filtered(),
                        "data" => $data,
                );


        //output to json format

        echo json_encode($output);

    }


    // Edit
 
    public function edit($id = NULL)
    {
        
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin/sub_category');
        }
        $data['category'] = $this->Case_category_model->getparent_id();
        // pre($data['category']);
        // exit();
        $data['edit_data'] = $this->Case_sub_category_model->find($id);
        $this->global['pageTitle'] = 'Insaaf99 : Edit case sub category';
        $this->loadViews("admin/case_sub_category/edit", $this->global, $data , NULL ,'admin');
        
        
    } 
  
    // Update category*************************************************************
    public function update()
    {
        
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('case_category_id','Category','trim|required');
        $this->form_validation->set_rules('case_sub_category','Sub category','trim');
        
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
			
                $this->edit($form_data['id']);
        }
        else
        {
           
            $insertData['id'] = $form_data['id'];
            $insertData['case_category_id'] = $form_data['case_category_id'];
            $insertData['case_sub_category'] = $form_data['case_sub_category'];
            $insertData['case_sub_category_hi'] = $form_data['case_sub_category_hi'];
			$insertData['status'] = $form_data['status'];
            $insertData['dt'] = date("Y-m-d H:i:s");
            
            $result = $this->Case_sub_category_model->save($insertData);
          

            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Case Sub  Category successfully Updated');
                redirect('admin/case_sub_category');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Case Sub Category Updation failed');
            }
            redirect('admin/sub_category/edit/'.$insertData['id']);
          }  
        
    }

    
    
    
}

?>