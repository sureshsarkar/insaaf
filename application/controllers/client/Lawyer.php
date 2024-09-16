<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Lawyer extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       
       $this->load->model('lawyer/lawyer_model');
       $this->isUserLoggedIn(); 
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->userData();
       // $this->isUserLoggedIn(); 
       // $this->global['pageTitle'] = 'Insaaf99 : Lawyer';
       // $this->loadViews("lawyer/lawyer/list", $this->global, NULL , NULL ,'lawyer');
        
    }
    
    // Add New 

   


    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        date_default_timezone_set('Asia/Kolkata'); 
        $this->isUserLoggedIn(); 
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('name','size Name','trim|required'); 
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {
            $insertData = array();
            $insertData['name'] = $form_data['name'];
            $insertData['status'] = $form_data['status'];
            /* $insertData['width'] = $form_data['width'];
             $insertData['height'] = $form_data['height'];*/
          
           // $insertData['sizeCode'] = $form_data['sizeCode'];
            $insertData['date_at'] = date("Y-m-d H:i:s");	
            $result = $this->lawyer_model->save($insertData);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'size successfully Added');
            }
            else
            { 
                $this->session->set_flashdata('error', 'size Addition failed');
            }
            redirect('lawyer/lawyer/addnew');
          }  
        
    }

    //  this code  code user detaisl  
    public function userData(){
       
        if(!empty($_SESSION['id'])){
            $userID = $_SESSION['id'];
            $userData = $this->lawyer_model->find($userID);
            if(!empty($userData)){
                $data['userData'] = $userData;
                $this->isUserLoggedIn(); 
                $this->global['pageTitle'] = 'Insaaf99 : Lawyer';
                $this->loadViews("lawyer/lawyer/list", $this->global, $data , NULL ,'lawyer');
            }
        }
    }
    // end code for user details 

    // Member list
    public function ajax_list()
    {
        
		$list = $this->lawyer_model->get_datatables();
        $parentCategoryList = array();
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row = array();
           
            
            $first_name=$currentObj->fname;
            $last_name=$currentObj->lname;
            $userID = $_SESSION['id'];
            $fullname=$first_name.' '. $last_name;
            if($userID==$currentObj->id){
                $row[] = 1;
            $row[] = $fullname;
            // $row[] = $currentObj->sizeCode;
        /*    $row[] = $currentObj->width;
            $row[] = $currentObj->height;*/
            $row[] = ($currentObj->status==1)?'<span class="btn-success">Active</span>':'<span class="btn-danger">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" href="'.base_url().'lawyer/lawyer/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info " href="'.base_url().'lawyer/lawyer/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
            
            }
            $data[] = $row;

        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->lawyer_model->count_all(),
                        "recordsFiltered" => $this->lawyer_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    // Edit
 
    public function edit($id = NULL)
    {
        
        $this->isUserLoggedIn(); 
        if($id == null)
        {
            redirect('lawyer/lawyer');
        }
        $data['edit_data'] = $this->lawyer_model->find($id);
        $this->global['pageTitle'] = 'Insaaf99 : Lawyer  ';
        $this->loadViews("lawyer/lawyer/edit", $this->global, $data , NULL ,'lawyer');    
        
    } 

    public function view($id = NULL)
    {
        
        $this->isUserLoggedIn(); 
        if($id == null)
        {
            redirect('admin/lawyer');
        }
        $data['edit_data'] = $this->lawyer_model->find($id);
        $this->global['pageTitle'] = 'Insaaf99 : Edit size';
        $this->loadViews("lawyer/lawyer/view", $this->global, $data , NULL ,'lawyer');    
        
    } 

    // Update category*************************************************************
    public function update()
    {
       ;
        $this->isUserLoggedIn(); 
        $this->load->library('form_validation');            
        // $this->form_validation->set_rules('fname','fname','trim|required');
        $this->form_validation->set_rules('fname','fname','trim');
        $this->form_validation->set_rules('lname','lname','trim');
        $this->form_validation->set_rules('email','Email','trim');
        $this->form_validation->set_rules('mobile','Mobile','trim');
        
        //form data 
        $form_data  = $this->input->post();
       
        if($this->form_validation->run() == FALSE)
        {
			
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
            $insertData['father_name'] = $form_data['father_name'];
            $insertData['enrolement_no'] = $form_data['enrolement_no'];
            $insertData['experience'] = $form_data['experience'];
            $insertData['address'] = $form_data['address'];
            $insertData['practice_area'] = $form_data['practice_area'];
            $insertData['bar_councle'] = $form_data['bar_councle'];
         
           
            
            if(isset($_FILES['lawyer_img']['name']) && $_FILES['lawyer_img']['name'] != '') {
              
				$f_name         =$_FILES['lawyer_img']['name'];
                $f_tmp          =$_FILES['lawyer_img']['tmp_name'];
                $f_size         =$_FILES['lawyer_img']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/lawyer/".$f_newfile;
                
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }
                else
                {
					$file = "uploads/lawyer/".$form_data['oldimage1'];
                   
					if(file_exists ( $file))
					{
						unlink($file);
					}
                    
					$insertData['lawyer_img'] = $f_newfile;
                 
                }
                 
            }

            if(isset($_FILES['enrol_image']['name']) && $_FILES['enrol_image']['name'] != '') {
              
				$f_name         =$_FILES['enrol_image']['name'];
                $f_tmp          =$_FILES['enrol_image']['tmp_name'];
                $f_size         =$_FILES['enrol_image']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/lawyer/".$f_newfile;
                
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }
                else
                {
					$file = "uploads/lawyer/".$form_data['oldimage2'];
                   
					if(file_exists ( $file))
					{
						unlink($file);
					}
                    
					$insertData['enrol_image'] = $f_newfile;
                 
                }
                 
            }

            if(isset($_FILES['resume']['name']) && $_FILES['resume']['name'] != '') {
              
				$f_name         =$_FILES['resume']['name'];
                $f_tmp          =$_FILES['resume']['tmp_name'];
                $f_size         =$_FILES['resume']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/lawyer/".$f_newfile;
                
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }
                else
                {
					$file = "uploads/lawyer/".$form_data['oldimage3'];
                   
					if(file_exists ( $file))
					{
						unlink($file);
					}
                    
					$insertData['resume'] = $f_newfile;
                 
                }
                 
            }
        
            $result = $this->lawyer_model->save($insertData);
         

            if($result > 0)
            {
                
         
                $this->session->set_flashdata('success', ' Size successfully Updated');
                redirect('lawyer/lawyer');
            }
            else
            { 
               
                $this->session->set_flashdata('error', 'Category Updation failed');
            }
            redirect('lawyer/lawyer/edit/'.$insertData['id']);
          }  
        
    }

    
    
    
}

?>