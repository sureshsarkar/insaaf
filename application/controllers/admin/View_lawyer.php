<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class View_lawyer extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/user_model');
        $this->load->model('admin/category_model');
        $this->load->model('admin/Case_details_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/Lawyer_scheduler_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
   

    public function index($id = NULL)
    {   
       
        $data['id']=$id;
        $data['view'] = $this->lawyer_model->find($id);
            date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
            /* code for total product */
            $where1['asign_lawyer_id']=$id;
            $toatalCases = $this->Case_details_model->findDynamic($where1);
            // $data['lawyer_cases']=$toatalCases;
            if(!empty($toatalCases)){
                $data['caseCount'] =  count($toatalCases) ;  
                $data['case_Count'] =  json_encode($toatalCases);

            }
            $where2['lawyer_id']=$id;
            $shedule_count = $this->Lawyer_scheduler_model->findDynamic($where2);
            // $data['lawyer_cases']=$toatalCases;
            if(!empty($shedule_count)){
                $data['Countshedule'] =  count($shedule_count) ;  
                $data['shedule_count'] =  json_encode($shedule_count);

            }
           
            $where3['asign_lawyer_id']=$id;
            $where3['status']         =0;   
            $toatalPendingCases = $this->Case_details_model->findDynamic($where3);
            // $data['lawyer_cases']=$toatalCases;
            if(!empty($toatalPendingCases)){
                $data['pendintCaseCount'] =  count($toatalPendingCases) ; 
                $data['pendin_tCaseCount'] =  json_encode($toatalPendingCases);

            }
         
          
            
            /* end code for counting year sales */
        $this->global['pageTitle'] = 'view lawyer';
        $this->loadViews("admin/view_lawyer", $this->global, $data , NULL ,'admin');
    }  
   
    /**
     * This function is used to add new user to the system
     */

     public function demo1(){
        $this->loadViews("admin/dashboard", $this->global , NULL);
       
     }
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            /*$this->form_validation->set_rules('role','Role','trim|required|numeric');*/
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
                
                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'name'=> $name,
                                    'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('addNew');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'UP70 : Edit User';
            
            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            /*$this->form_validation->set_rules('role','Role','trim|required|numeric');*/
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
                
                $userInfo = array();
                
                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name,
                                    'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
                        'name'=>ucwords($name), 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
       
        $this->global['pageTitle'] = 'UP70 : Change Password';
        
        $this->loadViews("admin/changePassword", $this->global, NULL, NULL);
      
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
      
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
      
        if($this->form_validation->run() == FALSE)
        {
            
            $this->loadChangePass();
        }
        else
        {
           
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('admin/view_lawyer/loadChangePass');
            }
            else
            {
                $usersData = array('password'=>$newPassword,'update_at'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                 redirect('admin/view_lawyer/loadChangePass');
            }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'UP70 : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>