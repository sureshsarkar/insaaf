<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Client extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('client/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->isUserLoggedIn(); 
    }

    /**
     * Index Page for this controller.
     */
    public function index($id=NULL)
    {
               $clientID=$_SESSION['id'];
               $clientData = $this->Client_model->find($clientID);
                if(!empty($clientData)){
                $data['userData'] = $clientData;

                pre($clientData);
                $this->global['pageTitle'] = 'Insaaf99 : client';
                $this->loadViews("client/profile/index", $this->global, $data , NULL ,'client');
            }
    }
    
    // Add New 

    public function addnew()
    {
        $data['parent_list'] = $this->Client_model->getparent_id();
        $this->isUserLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("client/client/addnew", $this->global, $data , NULL);   
    } 
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isUserLoggedIn();
        $id = $_POST['id'];
        // get image path 
        $rData = $this->Client_model->find($id);
        
        $result = $this->Client_model->delete($id);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

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
            $result = $this->Client_model->save($insertData);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'size successfully Added');
            }
            else
            { 
                $this->session->set_flashdata('error', 'size Addition failed');
            }
            redirect('client/client/addnew');
          }  
        
    }
    // Member list
    public function ajax_list()
    {
        error_reporting(0);
		$list =$this->Client_model->get_datatables();
        
        $parentCategoryList = array();
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

       
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y", strtotime($temp_date));
           
            $row = array();
            $row[] = $no;
            $first_name=$currentObj->fname;
            $last_name=$currentObj->lname;
            $fullname=$first_name.' '. $last_name;
            $row[] = $fullname;
            $row[] = ($currentObj->status==1)?'<span class="btn-success">Active</span>':'<span class="btn-danger">InActive</span>';
            $row[] = $date_at;
            $row[] = ' <a class="btn btn-sm btn-info " href="'.base_url().'client/client/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';

            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->Client_model->count_all(),
                        "recordsFiltered" => $this->Client_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    // Edit
 
    public function edit($id = NULL)
    {
        $id=base64_decode($id);
       
        $this->isUserLoggedIn();
        if($id == null)
        {
            redirect('client/size');
        }
        $data['edit_data'] = $this->Client_model->find($id);
    
        $this->global['pageTitle'] = 'Insaaf99 : Edit size';
        $this->loadViews("client/client/edit", $this->global, $data , NULL,'client');    
        
    } 

    public function view($id = NULL)
    {
        $id=base64_decode($id);
        $this->isUserLoggedIn();
        if($id == null)
        {
            redirect('client/client');
        }
        $data['edit_data'] = $this->Client_model->find($id);
        // pre($data['edit_data']);
        // exit();
        $this->global['pageTitle'] = 'Insaaf99 : Edit size';
        $this->loadViews("client/client/view", $this->global, $data , NULL,'client');    
        
    } 
   

    // Update category*************************************************************
    public function update()
    {
       
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
            $insertData['message'] = $form_data['message'];
           
          
            
      
            if(isset($_FILES['case_file']['name']) && $_FILES['case_file']['name'] != '') {
               
				$f_name         =$_FILES['case_file']['name'];
                $f_tmp          =$_FILES['case_file']['tmp_name'];
                $f_size         =$_FILES['case_file']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/client/".$f_newfile;
             
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }
                else
                {
				    $file = "uploads/client/".$form_data['oldimage'];
               
					if(file_exists( $file))
					{
						unlink($file);
					}
                    
					$insertData['case_file'] = $f_newfile;
                 
                }
                 
            }
    
            $result = $this->Client_model->save($insertData);
         

            if($result > 0)
            {
                
         
                $this->session->set_flashdata('success', ' Size successfully Updated');
                redirect('client/client/index/'.$insertData['id']);
            }
            else
            { 
               
                $this->session->set_flashdata('error', 'Category Updation failed');
            }
            redirect('client/client/edit/'.$insertData['id']);
          }  
        
    }
  

    // query
    public function Query()
    {  
        date_default_timezone_set('Asia/Kolkata');  
        $this->isUserLoggedIn();

        $form_data  = $this->input->post();
            $insertData = array();
            $insertData['dt'] = date("Y-m-d");
            if (!empty($form_data)) {
                /* send mail for Lawyer to book slot for lawyer */
                 $toEmail       = "admin@gmail.com"; // Admin email
                $subject = "New  Query Registered  ";
                $message = join('', array(
                    "<div style='background:#cad4f6e6; border-radius:8px;padding:7px;'>",
                    "<b style='font-size:22px; color:#3a3a8a;'>",
                    "Client Query for case",
                    "</b>",
                    "<br/>",
                    "<b style='font-size:15px;color:#162c97;'>",
                    "Client Name : ",
                    "</b>",
                    "<b style='font-size:15px;'>",
                    $_SESSION['name'],
                    "</b>",
                    "<br/>",
                    "<b style='font-size:15px;color:#162c97;'>",
                    "Email:",
                    "</b>",
                    "<b style='font-size:15px;'>",
                    $_SESSION['email'],
                    "</b>",
                    "<br/>",
                    "<b style='font-size:15px;color:#162c97;'>",
                    "Phone :",
                    "</b>",
                    "<b style='font-size:15px;'>",
                    $_SESSION['phone'],
                    "</b>",
                    "<br/>",
                    "<b style='font-size:15px;color:#162c97;'>",
                    "Query :",
                    "</b>",
                    "<b style='font-size:15px;'>",
                    $form_data['query'],
                    "</b>",
                    "<br/>",
                    "<b style='font-size:15px;color:#162c97;'>",
                    "Date :",
                    "</b>",
                    "<b style='font-size:15px;'>",
                    $insertData['dt'],
                    "</b>",
                    "<div>"
                ));
               $result= $this->send_email($toEmail, $subject, $message);
            }	
           
        if(!empty($result)){
            $this->session->set_flashdata('success', ' Your query sent  successfully into insaaf99');
            redirect('client/dashboard/index/'.base64_encode($form_data['client_Id']));
        }else{
            $this->session->set_flashdata('error', '  failed send query');
            redirect('client/dashboard/index/'.base64_encode($form_data['client_Id']));
        }
    

    
    }

     

}

?>