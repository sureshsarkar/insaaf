<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Ppc extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('base_library');
        $this->load->model('admin/sub_sub_category_model');
        $this->load->model('admin/case_category_model');
        $this->load->model('admin/Category_model'); 
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
       
      $this->load->model('front/campan_model');
      $get_data = $_GET;
      if(isset($get_data) && !empty($get_data)){
            // check which devise is using
            $get_data['device'] = check_device();

            $campanData['camp_id'] = (isset($get_data['camp_id']))?$get_data['camp_id']:"";
            $campanData['current_slug'] = base_url().$_SERVER['REQUEST_URI'];
            $campanData['keyword'] =  (isset($get_data['keyword']))?$get_data['keyword']:"";
            $campanData['device']  =  $get_data['device']; 
            $campanData['type']  =  (isset($get_data['type']))?$get_data['type']:""; 
            $campanData['network']  =  (isset($get_data['network']))?$get_data['network']:""; 
            $campanData['device_ip']  = $_SERVER['REMOTE_ADDR'];
            $campanData['created_at']  = date("Y-m-d H:i:s");
            
            $_SESSION['camp_id'] = $campanData['camp_id'];
            $_SESSION['keyword'] = $campanData['keyword'];
            $_SESSION['type'] = $campanData['type'];
            $_SESSION['network'] = $campanData['network'];
            $this->campan_model->save($campanData);
      }
      
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 
      $v1 = rand(1,9);
      $v2 = rand(1,9);

      $data['v1']    = $v1; 
      $data['v2']    = $v2;
      
      $w['field'] ="sub_sub_category_name";
      $result =$this->sub_sub_category_model->finddynamic($w);
      $data['categoryList'] =$result;

      
      $data1['table']  = 'category';
      $data1['id']     = '-id'; // Desc when - add
      $data1['limit']     = '20'; // Desc when - add
      $data['categoryMenu']      = $this->getCategory($data1); 
      $data['all_category'] = $this->case_category_model->all();

      $where['table']= "state"; 
      $where['orderby']= "name"; 
      $states = $this->case_category_model->findDynamic($where);
      $data['states'] = $states;
      
      // meta ==================================
      $data["title"]="Appoint Lawyers Online for Legal Consultation in India | Insaaf99";
      $data["keywords"]="Legal Advice, Legal Advice Online, Online Legal Advice, Free Legal Advice";
      $data["description"]="Free legal advice online from top expert Lawyers and get solutions immediately for  all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
      $data["og_url"]="https://insaaf99.com/talk-to-lawyer";
      $data["og_title"]="Free Legal Advice from Expert Lawyers & Advocates in India - Insaaf99";
      $data["og_description"]=" Free legal advice online from top expert Lawyers and get solutions immediately for all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
      $data["og_site_name"]="https://insaaf99.com/talk-to-lawyer";
      $data["twitter_card"]="summary";
      $data["twitter_title"]="Free Legal Advice from Expert Lawyers & Advocates in India - Insaaf99";
      $data["twitter_description"]="Free legal advice online from top expert Lawyers and get solutions immediately for all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
      $data["canonical"]="https://insaaf99.com/talk-to-lawyer";

      // get all lawyer
      $w = array();
      $w['status']="1";
      $w['table']="lawyer";
      $w['limit']="8";
      $w['field']="id,fname, lname, gender, experience,image, practice_area,language";
      $data['lawyers'] = $this->campan_model->findDynamic($w);

      $device = check_device();
      if(isset($device) && $device=='m'){
        $data['page'] = 'ppc-mobile';
        $data["file"]="front/mobilehome";
        $this->load->view('front/template',$data);
      }else{

        $data["file"]="front/ppc";
        $this->load->view('front/template',$data);
      }
     
    } 

    // Index =============================================================
    public function mobilescreen()
    {
      
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 
      $v1 = rand(1,9);
      $v2 = rand(1,9);

      $data['v1']    = $v1; 
      $data['v2']    = $v2;
      
      $w['field'] ="sub_sub_category_name";
      $result =$this->sub_sub_category_model->finddynamic($w);
      $data['categoryList'] =$result;

      
      $data1['table']  = 'category';
      $data1['id']     = '-id'; // Desc when - add
      $data1['limit']     = '20'; // Desc when - add
      $data['categoryMenu']      = $this->getCategory($data1); 
      $data['all_category'] = $this->case_category_model->all();
      
      // meta ==================================
      $data["title"]="Appoint Lawyers Online for Legal Consultation in India | Insaaf99";
      $data["keywords"]="Legal Advice, Legal Advice Online, Online Legal Advice, Free Legal Advice";
      $data["description"]="Free legal advice online from top expert Lawyers and get solutions immediately for  all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
      $data["og_url"]="https://insaaf99.com/talk-to-lawyer";
      $data["og_title"]="Free Legal Advice from Expert Lawyers & Advocates in India - Insaaf99";
      $data["og_description"]=" Free legal advice online from top expert Lawyers and get solutions immediately for all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
      $data["og_site_name"]="https://insaaf99.com/talk-to-lawyer";
      $data["twitter_card"]="summary";
      $data["twitter_title"]="Free Legal Advice from Expert Lawyers & Advocates in India - Insaaf99";
      $data["twitter_description"]="Free legal advice online from top expert Lawyers and get solutions immediately for all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
      $data["canonical"]="https://insaaf99.com/talk-to-lawyer";


      $data["file"]="front/ppcmobile";
      $this->load->view('front/template',$data);

     
    } 

  
    // Submit Contact form data in database***********************************************************
    public function submit()
    {
      

      $this->load->library('form_validation');
      $this->form_validation->set_rules('aditional', 'aditional ', 'required');

      $form_data = $this->input->post();

            if(!isset($form_data['v1']) || !isset($form_data['v2']) || !isset($form_data['robotValue']) && !empty($form_data['v1'] || $form_data['v2'] || $form_data['robotValue']) && ($form_data['robotValue'] = $form_data['v1'] + $form_data['v2'])){
                 $this->session->set_flashdata('error', 'You are a fake user!');
                 $this->index();
            }

      if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', 'Please Fill the form correctly !');
        $this->index();
      }
      
            $aditional = array('category'=>$form_data['adtional']['category'],'language'=>$form_data['adtional']['language']);
            $insertData=array();
            $insertData["name"]=$form_data['name'];
            $insertData["email"]=$form_data['email'];
            $insertData["mobile"]=str_replace(" ","",$form_data['mobile']);
            $insertData["adtional"]=json_encode($aditional);
            $insertData["contact_type"]=$form_data['contact_type'];
            $insertData["status"]=1;
            $insertData["date_at"]=date('Y-m-d H:i:s');
            $insertData["seen"]=0;
        
            $result = $this->contact_model->save($insertData);
            if ($result > 0) {
        
// Send  Mail  start************************************************************************
       $toEmail       ="contact@insaaf99.com,write2nmakkar@gmail.com,vinny_makkar@yahoo.com"; // admin email 
       $subject       = "Getting a PPC Leads";
   
      $heading="Dear Admin New inquiry from PPC Leads";
      $content="
      <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Name : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['name']."</span></td>
            </tr>
      </div>
      <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['email']."</span></td>
            </tr>
      </div>
      <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['mobile']."</span></td>
            </tr>
      </div>
      <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Category : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['adtional']['category']."</span></td>
            </tr>
      </div>
      <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Language : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['adtional']['language']."</span></td>
            </tr>
      </div>
      <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Date : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData["date_at"]."</span></td>
            </tr>
      </div>
      ";
      
      $message=get_email_temp($heading,$content);
     $this->send_email($toEmail, $subject, $message);
 
        $toEmail       = $form_data['email']; // Client email 
        $subject    = "Thank you  enquiry into Insaaf99, we will contact you shortly!";
        $heading="Dear ".$insertData['name']." your enquery successfully submited into Insaaf99";
       $content="
       <div style='margin-top:1px;'>
             <tr>
             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Category : </td>
             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['adtional']['category']."</span></td>
             </tr>
       </div>
       <div style='margin-top:1px;'>
             <tr>
             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Language : </td>
             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['adtional']['language']."</span></td>
             </tr>
       </div>
       ";
       
       $message=get_email_temp($heading,$content);
       
       $this->send_email($toEmail, $subject, $message);
         /* end code for send user registration success mail */
         
         //$this->session->set_flashdata('success', 'Your Query successfully Sent to Insaaf99.com');
        
         redirect(base_url('welcome'));
      }


}
// Send Mail  end**********************************************************************************************


            public function temDataFunc()
            {
                  $this->load->model('front/campan_model');
                 if(isset($_POST)){
                  $name = (isset($_POST["name"]))?$_POST["name"]:"";
                  $mobile = (isset($_POST["mobile"]))?$_POST["mobile"]:"";
                  $category = (isset($_POST["category"]))?$_POST["category"]:"";
                  $state = (isset($_POST["state"]))?$_POST["state"]:"";
                  $city = (isset($_POST["city"]))?$_POST["city"]:"";

                  $campanData['device_ip'] = $_SERVER['REMOTE_ADDR'];
                  $campanData['keyword'] = isset($_POST['keyword'])?$_POST['keyword']:'';
                  $campanData['type'] = isset($_POST['type'])?$_POST['type']:'';
                  $campanData['network'] = isset($_POST['network'])?$_POST['network']:'';
                  $campanData['camp_id'] = (isset($_POST['camp_id']) && !empty($_POST['camp_id']))?$_POST['camp_id']:'NA';
                  $campanData['tempData'] = json_encode(array("name"=>$name,"mobile"=>$mobile,"category"=>$category,"state"=>$state,"city"=>$city));
                  $campanData['device'] = check_device();
                  $campanData['created_at'] = date("Y-m-d H:i:s");
                  $campanData['date_at'] = date("Y-m-d");
                  $campanData['seen'] = 0;

                  
                  // check if already exist
                  $w = array('device_ip' => $_SERVER['REMOTE_ADDR'],'date_at' => date("Y-m-d"),'orderby'=> '-id');
                  $dbData = $this->campan_model->findDynamic($w);
                  if(!empty($dbData)){
                        $temp = $dbData[0]->tempData;
                        if(!empty($temp)){
                              $arr = json_decode($temp,true);
                        }
                        if(isset($arr) && strlen($arr['mobile']) >= 10 && ($arr['mobile'] != $mobile) ){

                        }else{
                              $campanData['id'] = $dbData[0]->id;
                              unset($campanData['created_at']);
                              $campanData['update_at'] = date("Y-m-d H:i:s");        
                        }
                        
                  }
                
                  $this->campan_model->save($campanData);
                  echo 1;
                  
                 } 
            }



          public function mobilehome(){
         
            $data1['table']  = 'category';
            $data1['id']     = '-id'; // Desc when - add
            $data1['limit']     = '20'; // Desc when - add
            $data['categoryMenu']      = $this->getCategory($data1); 
            $data['all_category'] = $this->case_category_model->all();
            
            // meta ==================================
            $data["title"]="Appoint Lawyers Online for Legal Consultation in India | Insaaf99";
            $data["keywords"]="Legal Advice, Legal Advice Online, Online Legal Advice, Free Legal Advice";
            $data["description"]="Free legal advice online from top expert Lawyers and get solutions immediately for  all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
            $data["og_url"]="https://insaaf99.com/talk-to-lawyer";
            $data["og_title"]="Free Legal Advice from Expert Lawyers & Advocates in India - Insaaf99";
            $data["og_description"]=" Free legal advice online from top expert Lawyers and get solutions immediately for all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
            $data["og_site_name"]="https://insaaf99.com/talk-to-lawyer";
            $data["twitter_card"]="summary";
            $data["twitter_title"]="Free Legal Advice from Expert Lawyers & Advocates in India - Insaaf99";
            $data["twitter_description"]="Free legal advice online from top expert Lawyers and get solutions immediately for all legal issues in just 10 minutes. 24/7 Support Services. Book Now!";
            $data["canonical"]="https://insaaf99.com/talk-to-lawyer";
      
            $data['page'] = 'ppc-mobile';
            $data["file"]="front/mobilehome";
            $this->load->view('front/template',$data);
          }
}

?>