<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Test extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('base_library');
        $this->load->model('admin/Sub_sub_category_model');
        $this->load->model('admin/Category_model'); 
         
        $this->load->model('admin/Certificate_model');
        // Cookie helper
        $this->load->helper('cookie');
    
     }

        public function index(){

       $clientName = "Guddu";
           $tocken = getClientRegistartionTemp($clientName);
           pre($tocken);
            $data['table']  = 'category';
            $data['id']     = '-id'; // Desc when - add
            $data['limit']     = '20'; // Desc when - add
            $data['categoryMenu']           = $this->getCategory($data); 
            $data["title"] = "Share Title";
            $data["description"] = "Share Description";
            $data["og_url"] = "https://insaaf99.com/test";
            $data["og_image"] = "https://insaaf99.com/uploads/blogs/644fc258082f5.jpg";
            $data["og_description"] = " Og Share Description";
            $data["og_site_name"] = "https://insaaf99.com";
            $data["file"]="front/test.php";
            $this->load->view('front/template',$data);
        }
}

?>