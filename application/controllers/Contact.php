<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require APPPATH . '/libraries/BaseController.php';


class Contact extends BaseController { 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
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
       date_default_timezone_set('Asia/Kolkata');
        
    }


    // Index =============================================================
    public function index()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        // Define =========================== 
       
        $data["title"]="Contact Us | Insaaf99";

        $data["description"]="Insaaf99- Consult & Hire the Lawyers in India. Top Rated Advocates available for Consultation by Phone, Meeting, Video Call, at your Home / office and through Email.";

        $data["keywords"]="advice, help, best lawyer, legal advice, legal help, online legal helpline, lawyer online, law advice, legal help, find a lawyer, legal answers, talk to lawyer";

        $data["og_url"]="https://insaaf99.com/contact-us";

        $data["og_title"]="Contact Us | Insaaf99";

        $data["og_description"]="Insaaf99- Consult & Hire the Lawyers in India. Top Rated Advocates available for Consultation by Phone, Meeting, Video Call, at your Home / office and through Email.";

        $data["og_site_name"]="insaaf99.com";

        $data["twitter_card"]="summary";

        $data["twitter_title"]="Contact Us | Insaaf99";

        $data["twitter_description"]="Insaaf99- Consult & Hire the Lawyers in India. Top Rated Advocates available for Consultation by Phone, Meeting, Video Call, at your Home / office and through Email.";

        // captca code
        $bytes = random_bytes(3);
        $data['captcha'] = bin2hex($bytes);

        $data["canonical"]="https://insaaf99.com/contact-us";

       $data["file"]="front/contact";

       $this->load->view('front/template',$data);
    
    } 

    // Submit Contact form data in database***********************************************************
    public function formsubmit()
    {
      if(isset($_POST['token_responce'])){
     $url='https://www.google.com/recaptcha/api/siteverify';
    $secret='6Leprj8lAAAAALFhqJaPhh7IF91Hr6foszB_Wr4H';
    $recaptcha_response=$_POST['token_responce'];
    
    $request = file_get_contents($url . '?secret=' . $secret . '&response=' . $recaptcha_response);
    $response = json_decode($request);

    if($response->success==1 && $response->score >= 0.5){
     
            $name=  str_replace(' ','',$_POST['fname'])." ".str_replace(' ','',$_POST['lname']);
            $email=str_replace(' ','',$_POST['email']);
            $mobile=str_replace(' ','',$_POST['mobile']);
    
            $insertData=array();
            $insertData["name"]=$name;
            $insertData["email"]=$email;
            $insertData["mobile"]=$mobile;
            $insertData["query"]=$_POST['query'];
            $insertData["status"]=1;
            $insertData["contact_type"]='';
            $insertData["date_at"]=date('Y-m-d H:i:s');
            $insertData["seen"]=0;
          
            if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '') {
                $f_name      = $_FILES['attachment']['name'];
                $f_tmp       = $_FILES['attachment']['tmp_name'];
                $f_size      = $_FILES['attachment']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/contact/" . $f_newfile;
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    $insertData['attachment'] = $f_newfile;
                    
                }
            } 
           
             $result = $this->contact_model->save($insertData);
            if ($result > 0) {

// Send  Mail  start************************************************************************
       $toEmail       = "contact@insaaf99.com,vinny@insaaf99.com"; // admin email 
       $subject       = "A new User want to contact with Insaaf99";
   
       $heading="Dear Admin New inquiry added";
      $content="
      <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Name : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$name."</span></td>
            </tr>
      </div>
      <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$email."</span></td>
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
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Message : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$_POST['query']."</span></td>
            </tr>
      </div>
      ";
      
      $message=get_email_temp($heading,$content);
      $result=$this->send_email($toEmail, $subject, $message);
 
        $message=  $_POST['query'];
        $toEmail       = $email; // Client email 
        $subject    = "Thank you  inquiry into Insaaf99";
        $heading="Dear ".$name." your query successfully submited into Insaaf99";
       $content="
       <div style='margin-top:1px;'>
             <tr>
             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Name : </td>
             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$name."</span></td>
             </tr>
       </div>
       <div style='margin-top:1px;'>
             <tr>
             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$email."</span></td>
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
             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Message : </td>
             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$_POST['query']."</span></td>
             </tr>
       </div>
       ";
       
       $message=get_email_temp($heading,$content);
       
       $result1=$this->send_email($toEmail, $subject, $message);
         /* end code for send user registration success mail */
         
         //$this->session->set_flashdata('success', 'Your Query successfully Sent to Insaaf99.com');
         echo 1;
         exit;
      } else {
            $this->session->set_flashdata('error', 'Faile to sent your query!');
      }
      redirect(base_url('contact'));


      }
      else{
            echo 2;
            exit;
      }
      }else{
            echo 2;
            exit;
      }
}
// Send Mail  end**********************************************************************************************

 }

?>