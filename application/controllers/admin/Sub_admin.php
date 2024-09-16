<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Sub_admin extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/sub_admin_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Sub Admin';
        $this->loadViews("admin/sub_admin/list", $this->global, NULL , NULL ,'admin');
        
    }

    // Add New 

    public function addnew()
    {

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New sub_admin';
        $this->loadViews("admin/sub_admin/addnew", $this->global, NULL, NULL ,'admin');   
    } 
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id = $_POST['id'];
        // get image path 
        $rData = $this->sub_admin_model->find($id);
        
        $result = $this->sub_admin_model->delete($id);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        date_default_timezone_set('Asia/Kolkata'); 
        $this->isLoggedIn();
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('fname','First Name','trim|required');
        
        //form data 

        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {
            $insertData = array();
            $insertData['fname'] = $form_data['fname'];
            $insertData['lname'] = $form_data['lname'];
            $insertData['email'] = $form_data['email'];
            $insertData['mobile'] = $form_data['mobile'];
            $insertData['password'] = $form_data['password'];
            $insertData['status'] = $form_data['status'];
            $insertData['dt'] = date("Y-m-d H:i:s");	
            $result = $this->sub_admin_model->save($insertData);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Color successfully Added');
                redirect('admin/sub_admin');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Color Addition failed');
            }
            redirect('admin/sub_admin/addnew');
          }  
        
    }

    public function view($id = NULL)
    {
        
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin/sub_admin');
        }
        $data['edit_data'] = $this->sub_admin_model->find($id);
        $this->global['pageTitle'] = 'Insaaf99 : Edit sub_admin';
        $this->loadViews("admin/sub_admin/view", $this->global, $data , NULL ,'admin');    
        
    } 

    // Member list
    public function ajax_list()
    {
		$list = $this->sub_admin_model->get_datatables();
        $parentCategoryList = array();
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

       
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y", strtotime($temp_date));
           
            $no++;
            $row = array();
            $row[] = $no;
            $first_name=$currentObj->fname;
            $last_name=$currentObj->lname;
            $fullname=$first_name.' '. $last_name;
            $row[] = $fullname;
            $row[] = $currentObj->email;
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'admin/sub_admin/edit/'.$currentObj->id.'" title="Edit" style="margin: 4px 0px;" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a>  &nbsp;&nbsp; <a class="btn btn-sm btn-info " href="'.base_url().'admin/sub_admin/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a>  ';

            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->sub_admin_model->count_all(),
                        "recordsFiltered" => $this->sub_admin_model->count_filtered(),
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
            redirect('admin/sub_admin');
        }
        
        $data['edit_data'] = $this->sub_admin_model->find($id);

        $this->global['pageTitle'] = 'Insaaf99 : Edit sub_admin';
        $this->loadViews("admin/sub_admin/edit", $this->global, $data , NULL ,'admin');
        
        
    } 

    // Update category*************************************************************
    public function update()
    {
	
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('fname','First name','trim|required');
      
        //form data 
        $form_data  = $this->input->post();
      
        if($this->form_validation->run() == FALSE)
        {
            // pre($form_data);
            // exit();
                $this->edit($form_data['id']);
        }
        else
        {
            $insertData['id'] = $form_data['id'];
            $insertData['fname'] = $form_data['fname'];
            $insertData['lname'] = $form_data['lname'];
            $insertData['email'] = $form_data['email'];
            $insertData['mobile'] = $form_data['mobile'];
            $insertData['password'] = $form_data['password'];
            $insertData['status'] = $form_data['status'];
           
            $result = $this->sub_admin_model->save($insertData);
			

            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Category successfully Updated');
                redirect('admin/sub_admin');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Category Updation failed');
            }
            redirect('admin/sub_admin/edit/'.$insertData['id']);
          }  
        
    }

    
    
    
}

?>