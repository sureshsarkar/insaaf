<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
class Practice_area extends BaseController
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
        $this->load->model('admin/specialization_model');
        
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



    /**
     * Index Page for this controller.
     */
    // Index =============================================================
    public function index()
    {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 
      $w['status']=1;
      $result=$this->specialization_model->finddynamic($w);
   
      if(isset($result) && !empty($result)){
        $data['specialization_data']=$result;
      }
       
      $data["title"]="Find Affordable Lawyers, Advocates, Vakils and Law-Firms in Your City | Insaaf99";
      $data["description"]="let's consult with expert lowers on Intellectual Property Rights, Cyber Crimes, Litigation, Real Estate Practice, Family Law Practice, Start Ups, Arbitration And Dispute Resolution, Banking and get better solution.";

      $data["keywords"]="Affordable Lawyers, Advocates online, Law-Firms in india";

      $data["og_url"]="https://insaaf99.com/specialization";

      $data["og_title"]="Find Affordable Lawyers, Advocates, Vakils and Law-Firms in Your City | Insaaf99";

      $data["og_description"]="let's consult with expert lowers on Intellectual Property Rights, Cyber Crimes, Litigation, Real Estate Practice, Family Law Practice, Start Ups, Arbitration And Dispute Resolution, Banking and get better solution.";

      $data["og_site_name"]="insaaf99.com";

      $data["twitter_card"]="summary";

      $data["twitter_title"]="Find Affordable Lawyers, Advocates, Vakils and Law-Firms in Your City | Insaaf99";

      $data["twitter_description"]="let's consult with expert lowers on Intellectual Property Rights, Cyber Crimes, Litigation, Real Estate Practice, Family Law Practice, Start Ups, Arbitration And Dispute Resolution, Banking and get better solution.";

      $data["canonical"]="https://insaaf99.com/specialization";

       $data["file"]="front/practice_area";
       $this->load->view('front/template',$data);
    
   }


    // intel
    public function detail($slug)
    {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data);

        // Define ===========================   
        $w['slug']=$slug;
        $result=$this->specialization_model->finddynamic($w);


        if(isset($result) && !empty($result)){

          $data['specialization_detali']=$result[0];
        }else{
          redirect(base_url('404_override'));
          exit();
        }
   
            

            $data["title"]=$result[0]->meta_twitter_title;

            $data["description"]=$result[0]->meta_description;

            $data["keywords"]=$result[0]->meta_keyword;

            $data["og_url"]="https://insaaf99.com/specialization/".$slug;

            $data["og_title"]=$result[0]->meta_twitter_title;

            $data["og_description"]=$result[0]->meta_og_description;

            $data["og_site_name"]="insaaf99.com";

            $data["twitter_card"]="summary";

            $data["twitter_title"]=$result[0]->meta_twitter_title;

            $data["twitter_description"]=$result[0]->meta_twitter_description;

            $data["canonical"]="https://insaaf99.com/specialization/".$slug;

       $data["file"]="front/specialization_detail";
        
       $this->load->view('front/template',$data);
    
    }

   
   public function test($slug_url){


      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 

      $sql = "SELECT ssc.*,c.name as cat_name ,sc.sub_category as sub_cat_name,sc.sub_category_hi as sub_cat_name_hi  FROM sub_sub_category as ssc "; 
      $sql .= " JOIN category as c ON c.id = ssc.category_id "; 
      $sql .= " LEFT JOIN sub_category as sc ON sc.id = ssc.sub_category_id "; 
      $sql .= "WHERE ssc.slug_url = '".$slug_url."' AND c.id ='12' ";
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

            $data["file"]="front/document";
            $this->load->view('front/template',$data);
     }
   }

   public function test1($slug_url){

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

            $data["file"]="front/document";
            $this->load->view('front/template',$data);
     }
   }
  

    // intel
    public function intel()
    {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 
        // Define ===========================   
        
        $data["title"]="Intellectual Property Rights | Insaaf99";
        $data["description"]="INSAAF 99  provides high rated lawyers who provides their expertise advice in protecting the legal Rights to the inventors or Creators resulting from intellectual activity in the industrial, literary,artistic field or scientific.";

        $data["keywords"]="Limited Liability Partnership, Limited Liability Partnership Registration";

        $data["og_url"]="https://insaaf99.com/specialization/intellectual-property-rights";

        $data["og_title"]="Intellectual Property Rights | Insaaf99";

        $data["og_description"]="INSAAF 99  provides high rated lawyers who provides their expertise advice in protecting the legal Rights to the inventors or Creators resulting from intellectual activity in the industrial, literary,artistic field or scientific.";

        $data["og_site_name"]="insaaf99.com";

        $data["twitter_card"]="summary";

        $data["twitter_title"]="Intellectual Property Rights | Insaaf99";

        $data["twitter_description"]="INSAAF 99  provides high rated lawyers who provides their expertise advice in protecting the legal Rights to the inventors or Creators resulting from intellectual activity in the industrial, literary,artistic field or scientific.";

        $data["canonical"]="https://insaaf99.com/specialization/intellectual-property-rights";

       $data["file"]="front/intel";
       $this->load->view('front/template',$data);
    
    }
       // intel
    public function cyber()
    {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 
        // Define ===========================   

        $data["title"]="Cyber Crime Legal Advice from Top Lawyers in India | Insaaf99";

        $data["description"]="Get Cyber Crime advice from the best Cyber Crime lawyers in India with Insaaf99 legal advice service. All you have to do is post your Cyber Crime related query to get it answered by professional Cyber Crime lawyer. Avail Now!";

        $data["keywords"]="Free Cyber Crime legal advice, Cyber Crime legal help, legal helpline, ask free Cyber Crime question , free Cyber Crime help , ask lawyer free, talk to lawyer free";

        $data["og_url"]="https://insaaf99.com/specialization/cyber-crimes";

        $data["og_title"]="Cyber Crime Legal Advice from Top Lawyers in India | Insaaf99";

        $data["og_description"]="Get Cyber Crime advice from the best Cyber Crime lawyers in India with Insaaf99 legal advice service. All you have to do is post your Cyber Crime related query to get it answered by professional Cyber Crime lawyer. Avail Now!";

        $data["og_site_name"]="insaaf99.com";

        $data["twitter_card"]="summary";

        $data["twitter_title"]="Cyber Crime Legal Advice from Top Lawyers in India | Insaaf99";

        $data["twitter_description"]="Get Cyber Crime advice from the best Cyber Crime lawyers in India with Insaaf99 legal advice service. All you have to do is post your Cyber Crime related query to get it answered by professional Cyber Crime lawyer. Avail Now!";

        $data["canonical"]="https://insaaf99.com/specialization/cyber-crimes";


       $data["file"]="front/cyber";
       $this->load->view('front/template',$data);
    
    }
    
     //  litigation
     public function litigation()
     {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 
         // Define ===========================   
         $data["title"]="Litigation Lawyer in India | Insaaf99";

         $data["description"]="INSAAF 99 is a hub of practicing lawyers who have their expertise and practical experience in conducting both private and commercial litigation before diverse fora,";
 
         $data["keywords"]="";
 
         $data["og_url"]="https://insaaf99.com/specialization/litigation";
 
         $data["og_title"]="Litigation Lawyer in India | Insaaf99";
 
         $data["og_description"]="INSAAF 99 is a hub of practicing lawyers who have their expertise and practical experience in conducting both private and commercial litigation before diverse fora,";
 
         $data["og_site_name"]="insaaf99.com";
 
         $data["twitter_card"]="summary";
 
         $data["twitter_title"]="Litigation Lawyer in India | Insaaf99";
 
         $data["twitter_description"]="INSAAF 99 is a hub of practicing lawyers who have their expertise and practical experience in conducting both private and commercial litigation before diverse fora,";
 
         $data["canonical"]="https://insaaf99.com/specialization/litigation";

         
        $data["file"]="front/litigation";
        $this->load->view('front/template',$data);
     
     }
         // Real
         public function Real()
         {
          $data['table']  = 'category';
          $data['id']     = '-id'; // Desc when - add
          $data['limit']     = '20'; // Desc when - add
          $data['categoryMenu']           = $this->getCategory($data); 
             // Define =========================== 
             $data["title"]="Real Estate Law Practice in India | Insaaf99";

        $data["description"]="We at Insaaf99 vises its clients and prepares legal documentation for the purchase, leasing, sale,mortgage of real estate properties including commercial, industrial, agricultural and residential property.";

        $data["keywords"]="Free Cyber Crime legal advice, Cyber Crime legal help, legal helpline, ask free Cyber Crime question , free Cyber Crime help , ask lawyer free, talk to lawyer free";

        $data["og_url"]="https://insaaf99.com/specialization/real-estate-practice";

        $data["og_title"]="Real Estate Law Practice in India | Insaaf99";

        $data["og_description"]="We at Insaaf99 vises its clients and prepares legal documentation for the purchase, leasing, sale,mortgage of real estate properties including commercial, industrial, agricultural and residential property.";

        $data["og_site_name"]="insaaf99.com";

        $data["twitter_card"]="summary";

        $data["twitter_title"]="Real Estate Law Practice in India | Insaaf99";

        $data["twitter_description"]="We at Insaaf99 vises its clients and prepares legal documentation for the purchase, leasing, sale,mortgage of real estate properties including commercial, industrial, agricultural and residential property.";

        $data["canonical"]="https://insaaf99.com/specialization/real-estate-practice";



            $data["file"]="front/Real";
            $this->load->view('front/template',$data);
         

         }

         
     // Family
     public function Family()
     {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data);
         // Define ===========================  

         $data["title"]="Get Family Law Practice in India | Insaaf99";

         $data["description"]="Family law (matrimonial law ) deals with law related to family matters and domestic relations. It is One of the key areas of law practice i.e. Matrimonial and Family laws.";
 
         $data["keywords"]="Free Cyber Crime legal advice, Cyber Crime legal help, legal helpline, ask free Cyber Crime question , free Cyber Crime help , ask lawyer free, talk to lawyer free";
 
         $data["og_url"]="https://insaaf99.com/specialization/family-law-practice";
 
         $data["og_title"]="Get Family Law Practice in India | Insaaf99";
 
         $data["og_description"]="Family law (matrimonial law ) deals with law related to family matters and domestic relations. It is One of the key areas of law practice i.e. Matrimonial and Family laws.";
 
         $data["og_site_name"]="insaaf99.com";
 
         $data["twitter_card"]="summary";
 
         $data["twitter_title"]="Get Family Law Practice in India | Insaaf99";
 
         $data["twitter_description"]="Family law (matrimonial law ) deals with law related to family matters and domestic relations. It is One of the key areas of law practice i.e. Matrimonial and Family laws.";
 
         $data["canonical"]="https://insaaf99.com/specialization/family-law-practice";

        $data["file"]="front/family";
        $this->load->view('front/template',$data);
     
     }
      // Start
      public function Start()
      {

         $data['table']  = 'category';
         $data['id']     = '-id'; // Desc when - add
         $data['limit']     = '20'; // Desc when - add
         $data['categoryMenu']           = $this->getCategory($data);
          // Define ===========================  
          
          $data["title"]="Get Startup Legal Services at Affordable Price | Insaaf99";

          $data["description"]="Need legal help? Are you looking for expert advice? Connect with civil/criminal lawyers at Insaaf99, India’s best online portal for legal services.";
  
          $data["keywords"]="Free Cyber Crime legal advice, Cyber Crime legal help, legal helpline, ask free Cyber Crime question , free Cyber Crime help , ask lawyer free, talk to lawyer free";
  
          $data["og_url"]="https://insaaf99.com/specialization/start-ups";
  
          $data["og_title"]="Get Startup Legal Services at Affordable Price | Insaaf99";
  
          $data["og_description"]="Need legal help? Are you looking for expert advice? Connect with civil/criminal lawyers at Insaaf99, India’s best online portal for legal services.";
  
          $data["og_site_name"]="insaaf99.com";
  
          $data["twitter_card"]="summary";
  
          $data["twitter_title"]="Get Startup Legal Services at Affordable Price | Insaaf99";
  
          $data["twitter_description"]="Need legal help? Are you looking for expert advice? Connect with civil/criminal lawyers at Insaaf99, India’s best online portal for legal services.";
  
          $data["canonical"]="https://insaaf99.com/specialization/start-ups";

          

         $data["file"]="front/Start";
         $this->load->view('front/template',$data);
      
      }


  // intelactual_area=>patents
  public function intelactual_area_parents()
  {
   $data['table']  = 'category';
   $data['id']     = '-id'; // Desc when - add
   $data['limit']     = '20'; // Desc when - add
   $data['categoryMenu']           = $this->getCategory($data);
      // Define ===========================   
     $data["title"]="about";
     $data["file"]="front/patents";
     $this->load->view('front/template',$data);
  
  }

   // intelactual_area=>Trademark
   public function intelactual_area_trademark()
   {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data);
       // Define ===========================   
      $data["title"]="about";
      $data["file"]="front/trademark";
      $this->load->view('front/template',$data);
   
   }

    // intelactual_area=>Design
    public function intelactual_area_Design()
    {

      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data);
        // Define ===========================   
       $data["title"]="about";
       $data["file"]="front/Design";
       $this->load->view('front/template',$data);
    
    }

  // intelactual_area=>Copyright
  public function intelactual_area_Copyright()
  {  
   $data['table']  = 'category';
   $data['id']     = '-id'; // Desc when - add
   $data['limit']     = '20'; // Desc when - add
   $data['categoryMenu']           = $this->getCategory($data);
      // Define ===========================   
     $data["title"]="about";
     $data["file"]="front/Copyright";
     $this->load->view('front/template',$data);
  
  }

  // Banking
  public function Banking()
  { 
   $data['table']  = 'category';
   $data['id']     = '-id'; // Desc when - add
   $data['limit']     = '20'; // Desc when - add
   $data['categoryMenu']           = $this->getCategory($data); 
      // Define ===========================   

      $data["title"]="Banking And Insolvency Law | Insaaf99";

      $data["description"]="Banking and finance is the area where Insaaf99 , the firm advises a multiplicity of clients; banks and financial institutions (Indian and foreign)";

      $data["keywords"]="";

      $data["og_url"]="https://insaaf99.com/specialization/banking-insolvency-law";

      $data["og_title"]="Banking And Insolvency Law | Insaaf99";

      $data["og_description"]="Banking and finance is the area where Insaaf99 , the firm advises a multiplicity of clients; banks and financial institutions (Indian and foreign)";

      $data["og_site_name"]="insaaf99.com";

      $data["twitter_card"]="summary";

      $data["twitter_title"]="Banking And Insolvency Law | Insaaf99";

      $data["twitter_description"]="Banking and finance is the area where Insaaf99 , the firm advises a multiplicity of clients; banks and financial institutions (Indian and foreign)";

      $data["canonical"]="https://insaaf99.com/specialization/banking-insolvency-law";


     $data["file"]="front/Banking";
     $this->load->view('front/template',$data);
  
  }

     // Arbitration
     public function Arbitration()
     {  
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data);
         // Define ===========================   
         $data["title"]="Arbitration And Dispute Resolution | Insaaf99";

         $data["description"]="The Insaaf99 along with its associated lawyers enjoys a dynamic back ground in Domestic as well as International Arbitrations";
 
         $data["keywords"]="";
 
         $data["og_url"]="https://insaaf99.com/specialization/arbitration-and-dispute-resolution";
 
         $data["og_title"]="Arbitration And Dispute Resolution | Insaaf99";
 
         $data["og_description"]="The Insaaf99 along with its associated lawyers enjoys a dynamic back ground in Domestic as well as International Arbitrations";
 
         $data["og_site_name"]="insaaf99.com";
 
         $data["twitter_card"]="summary";
 
         $data["twitter_title"]="Arbitration And Dispute Resolution | Insaaf99";
 
         $data["twitter_description"]="The Insaaf99 along with its associated lawyers enjoys a dynamic back ground in Domestic as well as International Arbitrations";
 
         $data["canonical"]="https://insaaf99.com/specialization/arbitration-and-dispute-resolution";


        $data["file"]="front/arbitration";
        $this->load->view('front/template',$data);
     
     }
    // intelactual_area=>patents=>Novartis
    public function Novartis()
    {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data);
        // Define ===========================   
       $data["title"]="about";
       $data["file"]="front/Novartis";
       $this->load->view('front/template',$data);
    
    }

  // intelactual_area=>patents=>Hoffmann
  public function Hoffmann()
  {  
   $data['table']  = 'category';
   $data['id']     = '-id'; // Desc when - add
   $data['limit']     = '20'; // Desc when - add
   $data['categoryMenu']           = $this->getCategory($data);
      // Define ===========================   
     $data["title"]="about";
     $data["file"]="front/Hoffmann";
     $this->load->view('front/template',$data);
  
  }

     // intelactual_area=>patents=>Snehlata
     public function Snehlata()
     {  $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data);
         // Define ===========================   
        $data["title"]="about";
        $data["file"]="front/Snehlata";
        $this->load->view('front/template',$data);
     
     }

         // intelactual_area=>patents=>Bayer
         public function Bayer()
         {  $data['table']  = 'category';
          $data['id']     = '-id'; // Desc when - add
          $data['limit']     = '20'; // Desc when - add
          $data['categoryMenu']           = $this->getCategory($data);
             // Define ===========================   
            $data["title"]="about";
            $data["file"]="front/Bayer";
            $this->load->view('front/template',$data);
         
         }
         
      // intelactual_area=>patents=>Bajaj
      public function Bajaj()
      { 
         $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data);
          // Define ===========================   
         $data["title"]="about";
         $data["file"]="front/Bajaj";
         $this->load->view('front/template',$data);
      
      }
                                             
   public function all_services(){
         $data['table']  = 'category';
         $data['id']     = '-id'; // Desc when - add
         $data['limit']     = '20'; // Desc when - add
         $data['categoryMenu']           = $this->getCategory($data);

         $data["title"]="All services";
         $data["file"]="front/all_services";
         $this->load->view('front/template',$data);
   }

} 
 
?>