<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';

use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Newpage extends BaseController
{
  
    /**
     * This is default constructor of the class
     */
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('base_library');
        $this->load->model('admin/blogs_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Latest_News_model');
        $this->load->model('lawyer/slot_model');
        $this->load->model('admin/dictionary_model');
        $this->load->model('admin/contact_model');
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
// pre($_SESSION);
      $data1['table']  = 'category';
      $data1['id']     = '-id'; // Desc when - add
      $data1['limit']     = '20'; // Desc when - add
      $data['categoryMenu']      = $this->getCategory($data1); 
 
      // Fetch Latest news data from ddatabase
        $where               = array();
        $where['orderby']    ='-1';
        $where['limit']    ='4';
        $where['status']    ='1';
        $data['latest_news'] = $this->Latest_News_model->findDynamic($where);
    //  ================================
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


    // ==============================
       $data["file"]="front/newpage";
       $this->load->view('front/template',$data);
    } 

    // public function sitemap()
    // {

  
    //    $data["title"]="All News";
    //    $data["file"]="front/sitemap.xml";
    //    $this->load->view('front/template',$data);
    // } 

    public function allnews()
    {
 

        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']      = $this->getCategory($data1); 


 
      // Fetch Latest news data from ddatabase
        $where               = array();

        if (isset($_GET['search']) && $_GET['search']!='') {
          $word = $_GET['search'];
          $likeArr = array(
            "descreption"=>$word,
            "news_cat"=>$word,
            "expert_hi"=>$word,
            "descreption_hi"=>$word,
            "expert"=>$word
          );
          $where['like']    = json_encode($likeArr);
        }


        // echo $word; die();
        $where['orderby']    ='-1';
        $where['status']    ='1';
        $data['latest_news'] = $this->Latest_News_model->findDynamic($where);


  
        
        $data["title"]="All Latest News And Judgement | Insaaf99";
        $data["keywords"]="All Latest News And Judgement";
        $data["description"]="All latest news related to supreme court, delhi high court judgment.";
        $data["og_url"]="https://insaaf99.com/all-news";
        $data["og_title"]="All Latest News And Judgement | Insaaf99";
        $data["og_description"]="All latest news related to supreme court, delhi high court judgment";
        $data["og_site_name"]="insaaf99.com";
        $data["twitter_card"]="summary";
        $data["twitter_title"]="All Latest News And Judgement | Insaaf99 ";
        $data["twitter_description"]="All latest news related to supreme court, delhi high court judgment.";
        $data["canonical"]="https://insaaf99.com/all-news";

       
       $data["file"]="front/allnews";
       $this->load->view('front/template',$data);
    } 
    

    public function searchNews(){
       if(isset($_POST['search']) && !empty($_POST['search'])){
        $search =$_POST['search'];
        $sql ='';
        $sql .="SELECT * FROM `news` ";
        $sql .="WHERE `news_cat` LIKE '%{$search}%' OR `descreption` LIKE '%{$search}%'";

        $result = $this->Latest_News_model->rawquery($sql);
     if(!empty($result)){
        echo json_encode(array('result'=>$result[0]));  
      exit();
     }else{
      echo 2;
      exit();
     }


       }
    }


    public function News($slug)
    {
     
      $data1['table']  = 'category';
      $data1['id']     = '-id'; // Desc when - add
      $data1['limit']     = '20'; // Desc when - add
      $data['categoryMenu']      = $this->getCategory($data1); 
     
        $where['slug_url']    =$slug;
        $da= $this->Latest_News_model->findDynamic($where);
    //  pre($da);
    //  exit;
      
        if(isset($da[0]) && !empty($da[0])){

      $data["title"]=$da[0]->meta_title;
      $data["description"]=$da[0]->meta_description;

      $data["keywords"]=$da[0]->meta_keyword;

      $data["og_url"]=$da[0]->meta_url;

      $data["og_title"]=$da[0]->meta_title;

      $data["og_description"]=$da[0]->meta_description;

      $data["og_site_name"]="insaaf99.com";

      $data["twitter_card"]="summary";

      $data["twitter_title"]=$da[0]->meta_title;

      $data["twitter_description"]=$da[0]->meta_description;

      $data["canonical"]=$da[0]->meta_url;
    
      



    $data['news_detail'] =$da[0];
    $data["file"]="front/news_detail";
    $this->load->view('front/template',$data);

      }else{
        echo " Invalid Crediantial";
      }

    }
    

      // turms =============================================================
    public function turms()
    {
      $data1['table']  = 'category';
      $data1['id']     = '-id'; // Desc when - add
      $data1['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data1); 
        // Define =========================== 
       
        $data["title"]="Terms of Us | Insaaf99";
        $data["description"]="Free legal advice from top rated advocates in. Consult online, by email and book appointments. Get online legal help.";

        $data["keywords"]="law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";

        $data["og_url"]="https://insaaf99.com/terms-condition";

        $data["og_title"]="Terms of Us | Insaaf99";

        $data["og_description"]="Free legal advice from top rated advocates in. Consult online, by email and book appointments. Get online legal help";

        $data["og_site_name"]="insaaf99.com";

        $data["twitter_card"]="summary";

        $data["twitter_title"]="Terms of Us | Insaaf99";

        $data["twitter_description"]="Free legal advice from top rated advocates in. Consult online, by email and book appointments. Get online legal help.";

        $data["canonical"]="https://insaaf99.com/terms-condition";
        

       $data["file"]="front/turms";
       $this->load->view('front/template',$data);
    } 
      // policy =============================================================
      public function policy()
      {
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data1); 
  
          // Define =========================== 
          $data["title"]="Privacy Policy | Insaaf99";
          $data["description"]="Consult & Hire the Best Lawyers in India. Top Rated Advocates available for Consultation by Phone, Meeting, Video Call, at your Home";
  
          $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, ";
  
          $data["og_url"]="https://insaaf99.com/privacy-policy";
  
          $data["og_title"]="Privacy & Policy | insaaf99";
  
          $data["og_description"]="Consult & Hire the Best Lawyers in India. Top Rated Advocates available for Consultation by Phone, Meeting, Video Call, at your Home";
  
          $data["og_site_name"]="insaaf99.com";
  
          $data["twitter_card"]="summary";
  
          $data["twitter_title"]="Privacy & Policy | insaaf99";
  
          $data["twitter_description"]="Consult & Hire the Best Lawyers in India. Top Rated Advocates available for Consultation by Phone, Meeting, Video Call, at your Home";
  
          $data["canonical"]="https://insaaf99.com/privacy-policy";

         $data["file"]="front/policy";
         $this->load->view('front/template',$data);
      } 
      // refund =============================================================
      public function refund()
      {
         $data["title"]="refund";
         $data["file"]="front/refund";
         $this->load->view('front/template',$data);
      }
      public function student()
      {
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data1); 
        
        $where=array();
        $where['status']=1;
        $where['orderby']='-id';

        $result=$this->blogs_model->findDynamic($where);
        if(!empty($result)){
                $data['blog_data']=$result;
        }
      

         $data["description"]="Login with Google. Or login with your email. Email address. Password. Forgot your password? Sign in. Benefits. For Students · For Educators";
         $data["title"]="Student Corner";
         $data["file"]="front/student";
         $this->load->view('front/template',$data);
      }
      public function dictionay()
      {
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data1); 

      
        $w['field']='alphabet';
        $alphabet=$this->dictionary_model->findDynamic($w);
        foreach( $alphabet as $key=> $val){
          $res[$key]=$val->alphabet;
          $data['alphabet'][]=$res[$key];
        }
        $data['alphabetForJson']=json_encode($data['alphabet']);

        $w1['limit']=1;
        $result=$this->dictionary_model->findDynamic($w1);
        if(!empty($result)){
          $data['dictionary_data']=$result[0];
        }
      


         $data["title"]="Dictionay";
         $data["file"]="front/dictionay";
         $this->load->view('front/template',$data);
      }

      public function study_materials()
      {
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data1); 

         $data["title"]="Study Materials";
         $data["file"]="front/study_materials";
         $this->load->view('front/template',$data);
      }
     // get data from dictionary table using ajax
      public function getdictionary()
      {
      
        if(isset($_POST['alphabet']) && !empty($_POST['alphabet'])){

          $w['alphabet']=$_POST['alphabet'];
          $result=$this->dictionary_model->findDynamic($w);
              echo json_encode(array($result));
          exit();
        }
          
      }

      public function english()
      {
        if(!empty($_POST)){

          $backPage   = base_url();
          if(isset($_SERVER['HTTP_REFERER'])){
             $backPage  =  $_SERVER['HTTP_REFERER']; 
          }

        
        if(isset($_POST['english']) && !empty($_POST['english'])){
          $language=$_POST['english'];
         setcookie('lang',$language,time()+(86400 * 30),'/');
         setcookie('langText','English',time()+(86400 * 30),'/');

          echo json_encode(array(
            'res'=>'yes',
            'reload' => $backPage
        ));
        exit();
         
        }
       else if(isset($_POST['hindi']) && !empty($_POST['hindi'])){
        $language=$_POST['hindi'];
        setcookie('lang',$language,time()+(86400 * 30),'/');
        setcookie('langText','हिन्दी',time()+(86400 * 30),'/');
   
        echo json_encode(array(
          'res'=>'yes',
          'reload' => $backPage
      ));
      exit();
         
      
        }
        }else{
          echo json_encode(array(
            'res'=>'no',
            'reload' => base_url()
        ));
        exit();
          
        }
        
      }

      // set cookie for discleamer 
       public function setCookie(){
        setcookie('disclamer',$_POST['disclamer'],time()+(86400),'/');
       }
      // set cookie for discleamer  end

      
    // Submit Contact form data in database***********************************************************
    public function formSubmit11()
    {
       if(isset($_POST['name']) && !empty($_POST['name'])){
                $name=  str_replace(' ','',$_POST['name']);
                $mobile=str_replace(' ','',$_POST['mobile']);
        
                $insertData=array();
                $insertData["name"]=$name;
                $insertData["mobile"]=$mobile;
                $insertData["query"]=$_POST['query'];
                $insertData["status"]=1;
                $insertData["contact_type"]='homePage';
                $insertData["date_at"]=date('Y-m-d H:i:s');
                $insertData["seen"]=0; 
              
                $result = $this->contact_model->save($insertData);
            
                if ($result > 0) {

         // Send  Mail  start************************************************************************
          $toEmail       = "contact@insaaf99.com"; // admin email 
          $subject       = "A new User want to contact with Insaaf99";
      
          $heading="Dear Admin New enquiry added";
          $content="
          <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Name : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$name."</span></td>
                </tr>
          </div>
          <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$mobile."</span></td>
                </tr>
          </div>
          <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$_POST['query']."</span></td>
                </tr>
          </div>
          ";
          
          $message=get_email_temp($heading,$content);
          $this->send_email($toEmail, $subject, $message);
            echo 1;
            exit;
          } else {
            echo 1;
            exit;
          }

  }
}
// Send Mail  end**********************************************************************************************

// check Mobile exist or not 
  public function checkMobile(){
    $this->load->model('Client_model');
    $this->load->model('Lawyer_model');
    $w['mobile'] = $_POST['mobile'];
    $cData = $this->Client_model->findDynamic($w);
    $lData = $this->Lawyer_model->findDynamic($w);

    if(isset($cData) && !empty($cData)){
      echo 1;
      exit();
    }
    if(isset($lData) && !empty($lData)){
      echo 2;
      exit();
    }
  }

// register throw Home page 

  public function homeRegister(){
      if(isset($_POST['name']) && !empty($_POST['name'])){

             $name =  explode(" ",$_POST['name']);
             if(isset($name[0]) && !empty($name[0])){
                $this->session->set_userdata('user_fname',$name[0]);  
             }
            if(isset($name[1]) && !empty($name[1])){
              $this->session->set_userdata('user_lname',$name[1]);  
            }else{
              $this->session->set_userdata('user_lname',' '); 
            }

        }

          $this->session->set_userdata('user_mobile', $_POST['mobile']); 
        
       
       
        if(isset($_POST['gender']) && !empty($_POST['gender'])){
            $gender=$_POST['gender'];
            $this->session->set_userdata('user_gender', $gender); 
        }

        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email=$_POST['email'];
            $this->session->set_userdata('user_email', $email); 
        }

        if(isset($_POST['query']) && !empty($_POST['query'])){
            $query=$_POST['query'];
            $this->session->set_userdata('user_query', $query); 
        }


        $redirect = base_url('signup?type=client&user_fname='.$_SESSION['user_fname'].'&user_lname='.$_SESSION['user_lname'].'&user_mobile='.$_SESSION['user_mobile'].'&user_gender='.$_SESSION['user_gender'].'&user_email='.$_SESSION['user_email']);
        echo json_encode(array('status'=>3,'redirect'=>$redirect));

      exit();


}


}

?>