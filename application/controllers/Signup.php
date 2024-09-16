<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Signup extends BaseController
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
        $lang='';
         if(!empty($_COOKIE['lang']) && isset($_COOKIE['lang'])){
          $lang=$_COOKIE['lang'];
         }else{
          $lang=config_item('language');
         }
        $this->lang->load('menu',$lang);
     }


    // Index =============================================================
    public function index()
    {
      if(isset($_SESSION['id']) && isset($_SESSION['role']) ){
          header("Location:".base_url($_SESSION['role']."/dashboard"));
          exit;
      }

      if(isset($_GET['type']) && (strtolower($_GET['type']) == 'client' || strtolower($_GET['type']) == 'lawyer')){
        $this->session->sess_destroy();
        $this->session->set_userdata('user_type', strtolower($_GET['type']));
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']  = '20'; // Desc when - add
        $data['categoryMenu'] = $this->getCategory($data); 
          // Define ===========================   
        if($_GET['type']=='client'){
          $data["description"]="Client Registration";
        }else{
          $data["description"]="Lawyer Registration";

        }
         $data["file"]="front/signup";
         $this->load->view('front/template',$data);
       }else{
        $data["file"]="front/404";
         $this->load->view('front/template',$data);
       }
    
    } 

    // Index =============================================================
    public function login()
    {
      if(isset($_SESSION['id']) && isset($_SESSION['role']) ){
          header("Location:".base_url($_SESSION['role']."/dashboard"));
          exit;
      }
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 
        // Define ===========================   
   
       $data["description"]="Get expert advice from top rated lawyers in India – Contact Now.";
       $data["file"]="front/login";
       $this->load->view('front/template',$data);
    
    } 
    // Index =============================================================
    public function loginnow()
    {
echo 1;
exit();
    
    } 


  
    


}

?>