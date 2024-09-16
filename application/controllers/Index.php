<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Index extends BaseController
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
        $this->load->model('admin/sub_sub_category_model');
        $this->load->model('admin/Latest_News_model');
        $this->load->model('lawyer/slot_model');
        $this->load->model('admin/dictionary_model');
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

      // get cookie data for login and save in session
      if(isset($_COOKIE['loginCookie'])){
        $cookieValue = $_COOKIE['loginCookie'];
          if (!empty($cookieValue)) {
            $cookieValue = unserialize($cookieValue);
            $this->session->set_userdata($cookieValue);
          }
    }
    
      $data1['table']  = 'category';
      $data1['id']     = '-id'; // Desc when - add
      $data1['limit']     = '20'; // Desc when - add
      $data['categoryMenu']      = $this->getCategory($data1); 
      
      // all category
      $w['field']='sub_sub_category_name,sub_sub_category_name_hi,slug_url'; 
      $data['allCategoty'] =$this->sub_sub_category_model->finddynamic($w);
      // Fetch Latest news data from ddatabase
      $where               = array();
      $where['orderby']    ='-1';
      $where['limit']    ='4';
      $where['status']    ='1';
      $data['latest_news'] = $this->Latest_News_model->findDynamic($where);

       // Fetch Latest news data from ddatabase
       $w               = array();
       $w['orderby']    ='-1';
       $w['limit']    ='4';
       $w['table']    ='testimonial';
       $w['status']    ='1';
       $data['testimonial'] = $this->Latest_News_model->findDynamic($w);

      $data["title"]="Consult Lawyer Online for Legal Consultation in India | Insaaf99";
      $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
      $data["description"]="Get online legal advice from committed lawyers in INDIA. INSAAF99 provides online legal consultancy at reasonable fee. 24*7 customer support & live chat. Consult NOW.";
      $data["og_url"]="https://insaaf99.com";
      $data["og_title"]="Consult Lawyer Online for Legal Consultation in India | Insaaf99";
      $data["og_description"]="Get online legal advice from committed lawyers in INDIA. INSAAF99 provides online legal consultancy at reasonable fee. 24*7 customer support & live chat. Consult NOW.";
      $data["og_site_name"]="insaaf99.com";
      $data["twitter_card"]="summary";
      $data["twitter_title"]="Consult Lawyer Online for Legal Consultation in India | Insaaf99";
      $data["twitter_description"]="Get online legal advice from committed lawyers in INDIA. INSAAF99 provides online legal consultancy at reasonable fee. 24*7 customer support & live chat. Consult NOW.";
      $data["canonical"]="https://insaaf99.com";
      $data['page'] = 'index';
      $device = check_device();
      // if(isset($device) && $device=='m'){
      //   $data['page'] = 'ppc-mobile';
      //   $data["file"]="front/mobilehome";
      //   $this->load->view('front/template',$data);
      // }else{

        $data["file"]="front/index";
        $this->load->view('front/template',$data);
      // }

    
    } 

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
          if(count($result) > 0 ){
              echo json_encode(array('result'=>$result));  
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
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data1); 
        
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
          $_SESSION['user_lname'] = $name[1];
        }else{
          $_SESSION['user_lname'] = "";
        }

    }

      $this->session->set_userdata('user_mobile', $_POST['mobile']); 
    
   
   
    if(isset($_POST['gender']) && !empty($_POST['gender'])){
        $gender=$_POST['gender'];
        $_SESSION['user_gender'] = $gender;
    }else{
      $_SESSION['user_gender'] = "";
    }

    if(isset($_POST['email']) && !empty($_POST['email'])){
        $email=$_POST['email'];
        $_SESSION['user_email'] = $email;
    }else{
      $_SESSION['user_email'] = "";
    }

    if(isset($_POST['query']) && !empty($_POST['query'])){
        $query=$_POST['query'];
        $_SESSION['user_query'] = $query;
    }else{
      $_SESSION['user_query'] = "";
    }

    $redirect = base_url('signup?type=client&user_fname='.$_SESSION['user_fname'].'&user_lname='.$_SESSION['user_lname'].'&user_mobile='.$_SESSION['user_mobile'].'&user_gender='.$_SESSION['user_gender'].'&user_email='.$_SESSION['user_email']);
    
    echo json_encode(array('status'=>3,'redirect'=>$redirect));

  exit();


}
   
}

?>