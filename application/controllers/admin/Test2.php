<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Test extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/case_details_model');
        $this->load->model('admin/payment_model');
        $this->load->model('admin/Case_sub_category_model');   
        $this->isLoggedIn();
    }
    

    public function index()
    { 
        
        $data= array();
        $months = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
        /* code for order detaisl */
        $w['field']="id,fname,lname,gender,dt";
        $w['limit']=12;

        $clientDetails = $this->Client_model->findDynamic($w);
      
        if(!empty($clientDetails)){
            $data['clientCount'] =  count($clientDetails) ;
        }
        
        $sub_total = '';

        $price = [];

        $k = -1;
        $arr = array();
        $subArr = array();

        $subArr[] = 'Month';
        $subArr[] = 'Meetings';
        $subArr[] = 'Clients';
        $subArr[] = 'Queries';
        $arr[] = $subArr;

        
        foreach ($clientDetails as $key => $value) {
            $subArr = array();
            $k++;
           
            $subArr[] = $months[$k];
            $subArr[] = $value->id;
            $subArr[] = $value->id;
            $subArr[] = $value->id;

            $arr[] = $subArr;

        }

        $data['jsonData'] = json_encode($arr);
 pre($data['jsonData'] );
 exit();
        $this->global['pageTitle'] = 'Insaaf99 : Admin Test';
        $this->loadViews("admin/graphChart", $this->global, $data , NULL,'admin');
    }  
        
}
?>