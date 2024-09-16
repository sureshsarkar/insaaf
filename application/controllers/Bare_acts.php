<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require APPPATH . '/libraries/BaseController.php';


class Bare_acts extends BaseController { 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Acts_model');
        $this->load->model('admin/base_act_category_model');
        $this->load->model('admin/base_act_sub_category_model');

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

        $where=array();
        $where['status']=1;
        $resilt=$this->base_act_category_model->finddynamic($where);
        if(isset($resilt) && !empty($resilt)){
            $data['act_category']=$resilt;
        }
     
       $data["title"]="Bare Acts";
       $data["description"]="India Code, Free Indian Bare Acts, Indian Statutes,Legislation, bills, law, Indian Code, Indian Bare Acts,India's central statues,legislation,amendments";
       $data["file"]="front/bare_acts";
       $this->load->view('front/template',$data);
    
    } 

    public function act_sub_type($slug)
    { 
     
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        // Define =========================== 
        $where=array();
        $where['slug_url']=$slug;
        $result= $this->base_act_category_model->finddynamic($where);

      if(isset($result) && !empty($result)){
        $data['bare_act_cat_name']=$result[0];
      }

        $where=array();
        $where['slug_url']=$slug;
        $result1= $this->base_act_category_model->finddynamic($where);

      if(isset($result1) && !empty($result1)){
        $where=array();
        $where['category_id']=$result1[0]->id;
        $result2= $this->base_act_sub_category_model->finddynamic($where);

      if(isset($result2) && !empty($result2)){
        $data['bare_act_sub_cat_data']=$result2;
      }
    
    }
        
        $data["title"]="Constitution of Indian Articles | Insaaf99";
      
        $data["file"]="front/sections";

        $this->load->view('front/template',$data);
    
    } 
    public function section_detail($slug)
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        // Define =========================== 
        $where["slug_url"]=$slug;
        $result= $this->Acts_model->finddynamic($where);
        
        if(isset($result) &&  !empty($result)){
          $data['sectionData']=$result[0];

          $data["title"]=$result[0]->meta_title;
          $data["description"]=$result[0]->meta_description;
          $data["keywords"]=$result[0]->meta_keyword;
          $data["og_url"]=$result[0]->meta_url;
          $data["og_title"]=$result[0]->meta_title;
          $data["og_description"]=$result[0]->meta_description;
          $data["og_site_name"]="insaaf99.com";
          $data["twitter_card"]="summary";
          $data["twitter_title"]=$result[0]->meta_title;
          $data["twitter_description"]=$result[0]->meta_description;
          $data["canonical"]=$result[0]->meta_url;
        }else{
          $data['sectionData']="";
          $data["title"]="";
          $data["description"]="";
          $data["keywords"]="";
          $data["og_url"]="";
          $data["og_title"]="";
          $data["og_description"]="";
          $data["og_site_name"]="insaaf99.com";
          $data["twitter_card"]="summary";
          $data["twitter_title"]="";
          $data["twitter_description"]="";
          $data["canonical"]="";
        }
        
       $data["file"]="front/section_detail";

       $this->load->view('front/template',$data);
    
    } 

    public function indian_panel_code()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 

        $sql = "SELECT * FROM acts ";
        // $sql .= "WHERE act_type = 'IPC' AND status = '1' ORDER BY act_number ASC ";
        $sql .= "WHERE act_type = 'IPC' AND status = '1'";
        $res = $this->Acts_model->rawQuery($sql);
        if(!empty($res)){
            $data['IPC']=$res;
           }
        // Define =========================== 
        $data["title"]="IPC Sections | Indian Penal Code 1860 Sections | Insaaf99";
        $data["description"]="The Indian Penal Code (IPC) is the official criminal code of India. It is a comprehensive code intended to cover all substantive aspects of criminal law";

        $data["keywords"]="IPC Sections, Indian Penal Code 1860 Sections";

        $data["og_url"]="https://insaaf99.com/bare-acts/indian-panel-code";

        $data["og_title"]="IPC Sections | Indian Penal Code 1860 Sections | Insaaf99";

        $data["og_description"]="The Indian Penal Code (IPC) is the official criminal code of India. It is a comprehensive code intended to cover all substantive aspects of criminal law";

        $data["og_site_name"]="insaaf99.com";

        $data["twitter_card"]="summary";

        $data["twitter_title"]="IPC Sections | Indian Penal Code 1860 Sections | Insaaf99";

        $data["twitter_description"]="The Indian Penal Code (IPC) is the official criminal code of India. It is a comprehensive code intended to cover all substantive aspects of criminal law";

        $data["canonical"]="https://insaaf99.com/bare-acts/indian-panel-code";

       $data["file"]="front/ipc";

       $this->load->view('front/template',$data);
    
    } 

    public function civil_procedure()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        // Define =========================== 
        
        $sql = "SELECT * FROM acts ";
        // $sql .= "WHERE act_type = 'CPC' AND status = '1' ORDER BY act_number ASC ";
        $sql .= "WHERE act_type = 'CPC' AND status = '1'  ";
       $res = $this->Acts_model->rawQuery($sql);
       if(!empty($res)){
        $data['CPC']=$res;
       }
       
       $data["title"]="Civil Procedure Code";
       $data["file"]="front/civil_procedure";

       $this->load->view('front/template',$data);
    
    } 

    public function criminal_procedure()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        // Define =========================== 
        $sql = "SELECT * FROM acts ";
        // $sql .= "WHERE act_type = 'CrPC' AND status = '1' ORDER BY act_number ASC ";
        $sql .= "WHERE act_type = 'CrPC' AND status = '1' ";
       $res = $this->Acts_model->rawQuery($sql);
       if(!empty($res)){
        $data['CrPC']=$res;
       }
       
        $data["title"]="Insaaf99- Indian Criminal Procedure Code";
        $data["description"]="The Indian Penal Code (IPC) is the official criminal code of India. It is a comprehensive code intended to cover all substantive aspects of criminal law.";

        $data["keywords"]="Indian Criminal Procedure Code";

        $data["og_url"]="https://insaaf99.com/bare-acts/criminal-procedure-code";

        $data["og_title"]="Insaaf99- Indian Criminal Procedure Code";

        $data["og_description"]="The Indian Penal Code (IPC) is the official criminal code of India. It is a comprehensive code intended to cover all substantive aspects of criminal law";

        $data["og_site_name"]="insaaf99.com";

        $data["twitter_card"]="summary";

        $data["twitter_title"]="Insaaf99- Indian Criminal Procedure Code";

        $data["twitter_description"]="The Indian Penal Code (IPC) is the official criminal code of India. It is a comprehensive code intended to cover all substantive aspects of criminal law.";

        $data["canonical"]="https://insaaf99.com/bare-acts/criminal-procedure-code";


       $data["file"]="front/criminal_procedure";

       $this->load->view('front/template',$data);
    
    } 

    public function domestic_voilence()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        // Define =========================== 
       
       $data["title"]="Domestic Voilence Act";
       $data["file"]="front/domestic_voilence";

       $this->load->view('front/template',$data);
    
    } 

    public function motor_vehicle()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        // Define =========================== 
       
       $data["title"]="Motor Vehicle Act";
       $data["file"]="front/motor_vehicle";

       $this->load->view('front/template',$data);
    
    } 

 }

?>