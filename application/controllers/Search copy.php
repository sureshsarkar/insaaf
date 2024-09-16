<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Search extends BaseController
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
      
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 

      if(isset($_GET['searchKey']) && !empty($_GET['searchKey'])){
       $search = $_GET['searchKey'];
  

        $sql  = "";
        $sql .= "SELECT news_cat,meta_url FROM `news` ";
        $sql .= "WHERE news_cat LIKE '%%$search%%'";
        $SearchNewsData = $this->Sub_sub_category_model->rawQuery($sql);
   
        $sql  = "";
        $sql .= "SELECT acts.title,acts.meta_url,act_sub_category.title,act_category.title FROM `acts` ";
        $sql .= "JOIN act_sub_category ON act_sub_category.id=acts.sub_category_id ";
        $sql .= "JOIN act_category ON act_category.id=acts.act_type ";
        $sql .= "WHERE acts.title LIKE '%%$search%%' OR act_sub_category.title LIKE '%%$search%%' OR act_category.title LIKE '%%$search%%'";
        $SearchActData = $this->Sub_sub_category_model->rawQuery($sql);

        $sql  = "";
        $sql .= "SELECT ssc.sub_sub_category_name as title,ssc.meta_url,sc.sub_category as sctitle,c.name as ctitle FROM sub_sub_category as ssc ";
        $sql .= "JOIN sub_category as sc ON sc.id=ssc.sub_category_id ";
        $sql .= "JOIN category as c ON c.id=ssc.category_id ";
        $sql .= "WHERE ssc.sub_sub_category_name LIKE '%$search%' OR sc.sub_category LIKE '%$search%' OR c.name LIKE '%$search%'";
        $SearchDocData = $this->Sub_sub_category_model->rawQuery($sql);
   
        $sql  = "";
        $sql .= "SELECT title,meta_url,author_name FROM `blogs` ";
        $sql .= "WHERE title LIKE '%%%$search%%%'";
        $SearchBlogData = $this->Sub_sub_category_model->rawQuery($sql);
      pre($SearchBlogData);
      // exit();
        $sql  = "";
        $sql .= "SELECT descreption,alphabet as meta_url FROM `dictionary` ";
        $sql .= "WHERE descreption LIKE '%%$search%%'";
        $SearchDecsData = $this->Sub_sub_category_model->rawQuery($sql);

        $data['search'] = $search;
            if(isset($SearchNewsData) && !empty($SearchNewsData)){
              $data['SearchNewsData'] = $SearchNewsData;
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
                
              $data["file"]="front/search";
              $this->load->view('front/template',$data);

              }elseif(isset($SearchActData) && !empty($SearchActData)){
                $data['SearchActData'] = $SearchActData;
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
                  
                $data["file"]="front/search";
                $this->load->view('front/template',$data);

              }elseif(isset($SearchDocData) && !empty($SearchDocData)){
                $data['SearchDocData'] = $SearchDocData;
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
                  
                $data["file"]="front/search";
                $this->load->view('front/template',$data);

              }elseif(isset($SearchBlogData) && !empty($SearchBlogData)){
                $data['SearchBlogData'] = $SearchBlogData;
                $data['blogpage'] = "Blog data";
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
                  
                $data["file"]="front/search";
                $this->load->view('front/template',$data);

              }elseif(isset($SearchDecsData) && !empty($SearchDecsData)){
                $data['SearchDecsData'] = $SearchDecsData;
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
                  
                $data["file"]="front/search";
                $this->load->view('front/template',$data);
              }else{
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
                
                $data["file"]="front/search";
                $this->load->view('front/template',$data);
              }

        }


    } 

  
    


}

?>