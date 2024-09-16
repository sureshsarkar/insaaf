<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Uspage extends BaseController
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
    public function index($slug_url)
    {
     $data['pagename']= "uspage";

      // echo $slug_url;
      // exit();
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 

      $sql = "SELECT ssc.*,c.name as cat_name ,sc.sub_category as sub_cat_name,sc.sub_category_hi as sub_cat_name_hi  FROM sub_sub_category as ssc "; 
      $sql .= " JOIN category as c ON c.id = ssc.category_id "; 
      $sql .= " LEFT JOIN sub_category as sc ON sc.id = ssc.sub_category_id "; 
      $sql .= "WHERE ssc.slug_url = '".$slug_url."' AND c.id ='11' ";
      $rData = $this->Sub_sub_category_model->rawQuery($sql);

      if(empty($rData)){
      redirect(base_url('404_override'));
      exit();
      }else{

     $data['details'] =$rData[0];

     if(isset($slug_url) && !empty($slug_url)){

     $data["title"]=$rData[0]->meta_title;//"Partnership Deed | Partnership Deed Registration Online | Insaaf99";

      $data["keywords"]=$rData[0]->meta_keyword;//"partnership deed,what is partnership deed,partnership deed registration";

      $data["description"]=$rData[0]->meta_description;//"Fill the required documents & information to our website. Get online partenership deed registration in India at Rs.5310 only with Insaaf99.";

      $data["og_url"]=$rData[0]->meta_url;//"https://insaaf99.com/specialization/documentation/partnership-deed";

      $data["og_title"]=$rData[0]->meta_title;//"Partnership Deed | Partnership Deed Registration Online | Insaaf99";

      $data["og_description"]=$rData[0]->meta_description;//"Fill the required documents & information to our website. Get online partenership deed registration in India at Rs.5310 only with Insaaf99.";

      $data["og_site_name"]="insaaf99.com";

      $data["twitter_card"]="summary";
      
      $data["twitter_title"]=$rData[0]->meta_title;//"Partnership Deed | Partnership Deed Registration Online | Insaaf99";

      $data["twitter_description"]=$rData[0]->meta_description;//"Fill the required documents & information to our website. Get online partenership deed registration in India at Rs.5310 only with Insaaf99.";

      $data["canonical"]=$rData[0]->meta_url;//"https://insaaf99.com/specialization/documentation/partnership-deed";
     

   }else{
    $data["title"]="Hire Online Lawyer for Legal Consultation/Advice in India | Insaaf99";
    $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
    $data["description"]="Get Online lawyer or advocate for legal consultation/advice in India. Consult a professional lawyer on phone to resolve your legal query 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
    $data["og_url"]="https://insaaf99.com";
    $data["og_title"]="Hire Online Lawyer for Legal Consultation/Advice in India | Insaaf99";
    $data["og_description"]="Get Online lawyer or advocate for legal consultation/advice in India. Consult a professional lawyer on phone to resolve your legal query 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
    $data["og_site_name"]="insaaf99.com";
    $data["twitter_card"]="summary";
    $data["twitter_title"]="Hire Online Lawyer for Legal Consultation/Advice in India | Insaaf99";
    $data["twitter_description"]="Get Online lawyer or advocate for legal consultation/advice in India. Consult a professional lawyer on phone to resolve your legal query 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
    $data["canonical"]="https://insaaf99.com";
      }

      $data["file"]="ppc/uspage";
      $this->load->view('ppc/template',$data);
}

      // //echo meet_link('lawyer','244','240');
      // $data['table']  = 'category';
      // $data['id']     = '-id'; // Desc when - add
      // $data['limit']     = '20'; // Desc when - add
      // $data['categoryMenu']           = $this->getCategory($data); 


      //   // Define ===========================   
      //   $data["title"]="Appoint Lawyers Online for Legal Consultation in India | Insaaf99";
      //   $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
      //   $data["description"]="Insaaf99 - discover lawyers or advocates online for legal advice services in India. Consult professional advocates on phone to resolve your legal question 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
      //   $data["og_url"]="https://insaaf99.com/about-us";
      //   $data["og_title"]="Appoint Lawyers Online for Legal Consultation in India | Insaaf99";
      //   $data["og_description"]="Insaaf99 - discover lawyers or advocates online for legal advice services in India. Consult professional advocates on phone to resolve your legal question 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
      //   $data["og_site_name"]="insaaf99.com";
      //   $data["twitter_card"]="summary";
      //   $data["twitter_title"]="Appoint Lawyers Online for Legal Consultation in India | Insaaf99";
      //   $data["twitter_description"]="Insaaf99 - discover lawyers or advocates online for legal advice services in India. Consult professional advocates on phone to resolve your legal question 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
      //   $data["canonical"]="https://insaaf99.com/about-us";
      //   $data['details'] = "";
      //  $data["file"]="ppc/uspage";
      //  $this->load->view('ppc/template',$data);
    } 

}

?>