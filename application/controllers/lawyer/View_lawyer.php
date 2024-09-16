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
        $this->load->model('front/orders_model');
        $this->load->model('admin/category_model');
        $this->load->model('admin/lawyer_category_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/product_model');
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

            /* end code for counting year sales */
        $this->global['pageTitle'] = 'view_lawyer';
        $this->loadViews("lawyer/view_lawyer", $this->global, $data , NULL, 'lawyer');
    }  
   
 
    /**
     * This function is used to add new user to the system
     */

     public function demo1(){
        $this->loadViews("admin/dashboard", $this->global , NULL , 'lawyer');
       
     }
   
  

    
   

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'UP70 : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL , 'lawyer');
    }
}

?>