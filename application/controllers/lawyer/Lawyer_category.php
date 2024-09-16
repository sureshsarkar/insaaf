<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Lawyer_category extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {

        parent::__construct();
    //    $this->load->model('admin/category_model');
       $this->load->model('admin/lawyer_category_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Category';
        $this->loadViews("admin/lawyer_category/list", $this->global, NULL , NULL);
        
    }

    // Add New 

    public function addnew()
    {
      
        $data['parent_list'] = $this->lawyer_category_model->getparent_id();
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
        $this->loadViews("admin/lawyer_category/addnew", $this->global, $data , NULL);   
    } 
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id = $_POST['id'];
        // get image path 
        $rData = $this->lawyer_category_model->find($id);
        $file  = 'uploads/category/'.$rData->image;
        // delete image
        unlink($file);
        $result = $this->lawyer_category_model->delete($id);
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
        $this->form_validation->set_rules('name','Category','trim|required');
        $this->form_validation->set_rules('about','About','trim');
        //form data 
        $form_data  = $this->input->post();
      
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {

            $insertData['name']     = $form_data['name'];
            $insertData['status']   = $form_data['status'];
            $insertData['about']    = $form_data['about'];
           
            $insertData['dt'] = date("Y-m-d H:i:s");	
			if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
				$f_name         =$_FILES['image']['name'];
                $f_tmp          =$_FILES['image']['tmp_name'];
                $f_size         =$_FILES['image']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/category/".$f_newfile;
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }
                else
                {
                   $insertData['image'] = $f_newfile;
                   
                }
            }
      
            $result = $this->lawyer_category_model->save($insertData);
         
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Category successfully Added');
                redirect('admin/lawyer_category');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Category Addition failed');
            }
            redirect('admin/lawyer_category/addnew');
          }  
        
    }

	
    // category list
    public function ajax_list()
    {
		$list = $this->lawyer_category_model->get_datatables();
        
        $parentCategoryList = array();
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        // save data for parent catelgory list
        foreach ($list as $currentObj) {
            $parentCategoryList[$currentObj->id] = $currentObj->name;
        }

        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
           // $row[] = '<img src ="'.base_url().'uploads/case_category/'.$currentObj->image.'" width="50" alt = "'.$currentObj->name.'"/>';
            $row[] = $currentObj->name;
            // $row[] = $currentObj->about;
           // $row[] = (!empty($currentObj->parent_id) && isset($parentCategoryList[$currentObj->parent_id]))?$parentCategoryList[$currentObj->parent_id]:'';
            $row[] = $currentObj->status==1?'Active':'InActive';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'admin/lawyer_category/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> ';

            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->lawyer_category_model->count_all(),
                        "recordsFiltered" => $this->lawyer_category_model->count_filtered(),
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
            redirect('admin/lawyer_category');
        }
        $data['parent_list'] = $this->lawyer_category_model->getparent_id();
        $data['edit_data'] = $this->lawyer_category_model->find($id);
        $this->global['pageTitle'] = 'Insaaf99 : Edit Members';
        $this->loadViews("admin/lawyer_category/edit", $this->global, $data , NULL);
        
        
    } 

    // Update category*************************************************************
    public function update()
    {
		// pre($_POST);
        //  exit();
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('name','category','trim|required');
        $this->form_validation->set_rules('about','About','trim');
        $this->form_validation->set_rules('id','Id','trim|required');
        
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
			
                $this->edit($form_data['id']);
        }
        else
        {
            $insertData['id'] = $form_data['id'];
            $insertData['name'] = $form_data['name'];
           
            $insertData['about'] = $form_data['about'];
        
            // $insertData['image'] = $form_data['old_image'];
			$insertData['status'] = $form_data['status'];
            $insertData['dt'] = date("Y-m-d H:i:s");

			// if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {

			// 	$f_name         =$_FILES['image']['name'];
            //     $f_tmp          =$_FILES['image']['tmp_name'];
            //     $f_size         =$_FILES['image']['size'];
            //     $f_extension    =explode('.',$f_name);
            //     $f_extension    =strtolower(end($f_extension));
            //     $f_newfile      =uniqid().'.'.$f_extension;
            //     $store          ="uploads/category/".$f_newfile;
            
            //     if(!move_uploaded_file($f_tmp,$store))
            //     {
            //         $this->session->set_flashdata('error', 'Image Upload Failed .');
            //     }
            //     else
            //     {
			// 		$file = "uploads/category/".$form_data['old_image'];
			// 		if(file_exists ( $file))
			// 		{
			// 			unlink($file);
			// 		}
			// 		$insertData['image'] = $f_newfile;
                   
            //     }
            //  }

            $result = $this->lawyer_category_model->save($insertData);
			

            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Category successfully Updated');
                redirect('admin/lawyer_category');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Category Updation failed');
            }
            redirect('admin/lawyer_category/edit/'.$insertData['id']);
          }  
        
    }

    
    
    
}

?>