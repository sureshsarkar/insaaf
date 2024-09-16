<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Newscreen extends BaseController
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
      //echo meet_link('lawyer','244','240');
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 
        // Define ===========================   
        $data["title"]="Appoint Lawyers Online for Legal Consultation in India | Insaaf99";
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
        $data["description"]="Insaaf99 - discover lawyers or advocates online for legal advice services in India. Consult professional advocates on phone to resolve your legal question 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
        $data["og_url"]="https://insaaf99.com/about-us";
        $data["og_title"]="Appoint Lawyers Online for Legal Consultation in India | Insaaf99";
        $data["og_description"]="Insaaf99 - discover lawyers or advocates online for legal advice services in India. Consult professional advocates on phone to resolve your legal question 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
        $data["og_site_name"]="insaaf99.com";
        $data["twitter_card"]="summary";
        $data["twitter_title"]="Appoint Lawyers Online for Legal Consultation in India | Insaaf99";
        $data["twitter_description"]="Insaaf99 - discover lawyers or advocates online for legal advice services in India. Consult professional advocates on phone to resolve your legal question 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
        $data["canonical"]="https://insaaf99.com/about-us";
        
       $data["file"]="front/newscreen";
       $this->load->view('front/template',$data);
    } 

  
    


}

?>