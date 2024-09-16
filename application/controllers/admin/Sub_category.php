<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Sub_category extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {

        parent::__construct();
       $this->load->model('admin/Category_model');
       $this->load->model('admin/Sub_category_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Sub Category';
        $this->loadViews("admin/sub_category/list", $this->global, NULL , NULL ,'admin');
        
    }

    // Add New 

    public function addnew()
    {
      
        $data['category'] = $this->Category_model->getparent_id();
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
        $this->loadViews("admin/sub_category/addnew", $this->global, $data , NULL ,'admin');   
    } 
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id = $_POST['id'];
        // get image path 
        $rData = $this->Sub_category_model->find($id);
        $file  = 'uploads/category/'.$rData->image;
        // delete image
        unlink($file);
        $result = $this->Sub_category_model->delete($id);
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
        $this->form_validation->set_rules('category_id','Category','trim|required');
        $this->form_validation->set_rules('sub_category','Sub Category','trim|required');
        //form data 
        $form_data  = $this->input->post();
      
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {

            $insertData['category_id']  = $form_data['category_id'];
            $insertData['sub_category']   = $form_data['sub_category'];
            $insertData['sub_category_hi']   = $form_data['sub_category_hi'];
            $insertData['status']         = $form_data['status'];
            $insertData['slug_url']       = $form_data['slug_url'];
            $insertData['dt']             =date("Y-m-d H:i:s");	
      
            $result = $this->Sub_category_model->save($insertData);
         
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Category successfully Added');
                redirect('admin/sub_category');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Category Addition failed');
            }
            redirect('admin/sub_category/addnew');
          }  
        
    }

	
    // category list
    public function ajax_list()
    {
        error_reporting(0);
		$list = $this->Sub_category_model->get_datatables();
        
        $CategoryList = array();
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        // save data for parent catelgory list
        foreach ($list as $currentObj) {
            $CategoryList[$currentObj->id] = $currentObj->category_id;
        }

        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $id=$currentObj->category_id;
            $cat_name=$this->Category_model->find($id);
            $row[] = $cat_name->name;
            $row[] = $currentObj->sub_category;
            $row[] = $currentObj->status==1?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;"" href="'.base_url().'admin/sub_category/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn"  href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> ';

            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->Sub_category_model->count_all(),
                        "recordsFiltered" => $this->Sub_category_model->count_filtered(),
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
        $data['category'] = $this->Category_model->getparent_id();
        $data['edit_data'] = $this->Sub_category_model->find($id);
        $this->global['pageTitle'] = 'Insaaf99 : Edit Members';
        $this->loadViews("admin/sub_category/edit", $this->global, $data , NULL ,'admin');
        
        
    } 

    // Update category*************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('category_id','Category','trim|required');
        $this->form_validation->set_rules('sub_category','Sub category','trim');
        
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
			
                $this->edit($form_data['id']);
        }
        else
        {
            $insertData['id'] = $form_data['id'];
            $insertData['category_id'] = $form_data['category_id'];
           
            $insertData['sub_category'] = $form_data['sub_category'];
            $insertData['sub_category_hi'] = $form_data['sub_category_hi'];
        
            // $insertData['image'] = $form_data['old_image'];
			$insertData['status'] = $form_data['status'];
            $insertData['dt'] = date("Y-m-d H:i:s");
            $result = $this->Sub_category_model->save($insertData);
			

            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Category successfully Updated');
                redirect('admin/sub_category');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Category Updation failed');
            }
            redirect('admin/sub_category/edit/'.$insertData['id']);
          }  
        
    }

    
    
    
}

?>