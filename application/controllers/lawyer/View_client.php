<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class View_client extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lawyer/user_model');
        $this->load->model('front/orders_model');
        $this->load->model('lawyer/category_model');
        $this->load->model('lawyer/lawyer_category_model');
        $this->load->model('lawyer/Client_model');
        $this->load->model('lawyer/product_model');
        $this->isLawyerLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
   

    public function index($id = NULL)
    {   
        $data['id']=$id;
        $data['view'] = $this->Client_model->find($id);
        
            date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

            /* code for order detaisl */
            $orderDetails = $this->orders_model->all();
            if(!empty($orderDetails)){
                $data['orderCount'] =  count($orderDetails) ;
                $data['total_order'] =  json_encode($orderDetails);
            }
            /* end code for order details */
            /* code for total product */
            $toatalproduct = $this->product_model->all();
            if(!empty($toatalproduct)){
                $data['productCount'] =  count($toatalproduct) ;   
            }
           // $totaldistributor = $this->distributor_model->all();
            if(!empty($totaldistributor)){

                $data['totaldistributor'] =  count($totaldistributor) ;
                
            }
            /* end code for total produt */

            /* code for counting today sales */
       
            $model_name = 'orders_model';
            $day = 1;
            
            $result =  $this->get_ordersales($day,$model_name);   
            if(!empty($result)){
                $data['total_today_sell']    =   count($result);
            }
         
            /* end code for counting today sales */

            /* this code for outof stock product */   
            $where = array();
            $where['status']    = 1;
            $where['field']     = 'id,no_item';
            $product_list       =    $this->product_model->findDynamic($where);
            $out_of_stock       = 0;                                                                                                                                             
            $soon_out_of_stock  = 0; 
            $list_array  = array();
            if(!empty($product_list)){
                foreach ($product_list as $key => $value) {
                   $list_array[] = json_decode($value->no_item,true);
                    //pre($value->no_item);
                }
                foreach ($list_array as $key1 => $value1) {
                    foreach ($value1 as $key2 => $value2) {
                        if($value2 == 0){
                            $out_of_stock++;
                        }
                       
                    }
                }
                $data['out_of_stock']    =  $out_of_stock;
                $data['soon_out_of_stock ']     =  $soon_out_of_stock;
            }
            /* end  this code for outof stock product */
            $where = array();
            $where['status']    =1;
            $table='z_users';
            $totaluser  = $this->product_model->findByTable($where,$table);
            if(!empty($totaluser)){
                $data['userCount'] =  count($totaluser) ;
            }
            /* end code counting total user */

            /* code for today cancel order list */
            $cancel_date  = date('Y-m-d');
            $sql = "SELECT id FROM orders where cancel_date LIKE '%$cancel_date%' AND cancel_status=1";
            $total_today_cancel = $this->orders_model->rawQuery($sql);
            if(!empty($total_today_cancel)){
                $data['total_today_cancel'] = count($total_today_cancel);
            }
            $return_date  = date('Y-m-d');
            $sql = "SELECT id FROM orders where return_date LIKE '%$return_date%' AND return_status=1";
            $total_return_order = $this->orders_model->rawQuery($sql);
            if(!empty($total_return_order)){
                $data['total_return_order'] = count($total_return_order);
            }

            $where = array();
            $where['cancel_status']  = 1;
            $where['field']          ='id,order_id';
            $TotalCancelArray = $this->orders_model->findDynamic($where);
            if(!empty($TotalCancelArray)){
                $data['TotalCancelArray'] = count($TotalCancelArray);
            }
            $where = array();
            $where['return_status']  = 1;
            $where['field']          ='id,order_id';
            $TotalReturnArray = $this->orders_model->findDynamic($where);
            if(!empty($TotalReturnArray)){
                $data['TotalReturnArray'] = count($TotalReturnArray);
            }

            /* emd code for today cancel order list */

            /* code for counting today sales */
            $model_name = 'orders_model';
            $day = 1;
            
            $result =  $this->get_ordersales($day,$model_name);   
            if(!empty($result)){
                $data['total_today_sell']    =   count($result);
            }
            /* end code for counting today sales */

            /* code for counting week  sales */
            $day = 7;
            $result =  $this->get_ordersales($day,$model_name);
            if(!empty($result)){
                $data['total_week_sell']    =   count($result);
            }
            
            /* end code for counting week sales */

            /* code for counting month  sales */

            $day = 31;
            $result =  $this->get_ordersales($day,$model_name);
            if(!empty($result)){
                $data['total_month_sell']    =   count($result);
            }
           
            /* end code for counting month sales */

            /* code for counting year sales */
            $day = 365;
            $result =  $this->get_ordersales($day,$model_name);
            if(!empty($result)){
                $data['total_year_sell']    =   count($result);
            }
            /* end code for counting year sales */
        $this->global['pageTitle'] = 'view_client';
        $this->loadViews("lawyer/view_client", $this->global, $data , NULL, 'lawyer');
    }  
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->userListingCount($searchText);

            $returns = $this->paginationCompress ( "userListing/", $count, 5 );
            
            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'UP70 : User Listing';
            
            $this->loadViews("users", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'UP70 : Add New User';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */

     public function demo1(){
        $this->loadViews("lawyer/dashboard", $this->global , NULL);
       
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
        
        $this->loadViews("lawyer/changePassword", $this->global, NULL, NULL);
      
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
                redirect('lawyer/view_lawyer/loadChangePass');
            }
            else
            {
                $usersData = array('password'=>$newPassword,'update_at'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                 redirect('lawyer/view_lawyer/loadChangePass');
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