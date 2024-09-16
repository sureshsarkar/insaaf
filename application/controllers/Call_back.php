<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Call_back extends BaseController
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


    // Index =============================================================
    public function index()
    {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 
        // Define ===========================   
       $data["title"]="Call_back";
       $data["file"]="front/call_back";
       $this->load->view('front/template',$data);
    
    } 

    // Index =============================================================
    public function send()
    {
      if($_SERVER['REQUEST_METHOD']=="GET"){
        echo $_GET['hub_challenge']; //respond back hub_callenge key
        http_response_code(200);
    }else{
        $data = json_decode(file_get_contents('php://input'), true);
        error_log(json_encode($data)); //print inbound message     
    }
              
    } 

  
    


}

?>