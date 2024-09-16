<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Lawyer_account extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('Lawyer_model');
        $this->load->model('Client_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        // Cookie helper
        $this->load->helper('cookie');
        $this->load->library('session');
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
    
        $data["title"] = "index";
        $data["file"]  = "front/index";
        $this->load->view('front/template', $data);
    }

    
    
    // register =============================================================
    public function register1()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data);
        // Define =========================== 
        $data['case_category']     = $this->Case_category_model->getparent_id();
        
        $data['case_sub_category'] = $this->Case_sub_category_model->getparent_id();

        // ==================================
        $data["title"]="Lawyer Registration Form";

        $data["description"]="Lawyer Registration";

        $data["keywords"]="";

        $data["og_url"]="https://insaaf99.com/lawyer/registration";

        $data["og_title"]="Lawyer Registration Form";

        $data["og_description"]="Lawyer Registration";

        $data["og_site_name"]="insaaf99.com";

        $data["twitter_card"]="summary";

        $data["twitter_title"]="Lawyer Registration Form";

        $data["twitter_description"]="Lawyer Registration";

        $data["canonical"]="https://insaaf99.com/lawyer/registration";
        // ===================================
        $data["file"]              = "front/lawyer_register";
        $this->load->view('front/template', $data);
    }
    
    public function ajax_call_case_sub_category_name()
    {
        $get_id = $this->input->post();
        $where['case_category_id'] = $get_id['id'];
        $table                     = 'case_sub_category';
        $response                  = $this->Case_sub_category_model->findByTable($where, $table);
        echo json_encode($response);
    }
    
    public function check_existtance(){
        
        $number=$_POST['number'];
        $where['mobile'] = $number;
        $lawyer_mobile_status   = $this->Lawyer_model->findOneBy($where);
        $client_mobile_status   = $this->Client_model->findOneBy($where);
        
        if (!empty($lawyer_mobile_status) || !empty($client_mobile_status)) {
            if (!empty($lawyer_mobile_status)) {
                echo json_encode(array(
                    'status' => 'Lmobile'
                ));
                
            }else{
                echo json_encode(array(
                    'status' => 'Cmobile'
                ));
                
            }
          }else{
            echo json_encode(array(
                'status' => 'No_mobile'
            ));
        }

    }
    
    // code for register 
    public function register()
    {
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data2['categoryMenu']           = $this->getCategory($data1);
        
        if (isset($_POST)) {
           
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fname', 'fname ', 'required|max_length[25]|trim');
            $this->form_validation->set_rules('mobile', 'mobile ', 'required|max_length[10]|trim');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[128]|trim');
            $form_data  = $this->input->post();
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'status' => 'true1'
                ));
                
            } else {
                
                $email           = $this->input->post('email');
                $where['email']  = $email;
                $email_status    = $this->Lawyer_model->findOneBy($where);
                $where           = array();
                $mobile          = $this->input->post('mobile');
                $where['mobile'] = $mobile;
                $mobile_status   = $this->Lawyer_model->findOneBy($where);
                
                if (!empty($email_status) || !empty($mobile_status)) {
                    if (!empty($mobile_status) && !empty($email_status)) {
                        echo json_encode(array(
                            'status' => 'true2'
                        ));
                        
                    } else if (!empty($mobile_status)) {
                        echo json_encode(array(
                            'status' => 'true3'
                        ));
                        
                    } else if (!empty($email_status)) {
                        echo json_encode(array(
                            'status' => 'true4'
                        ));
                    }
                }  
                else {
                    date_default_timezone_set('Asia/Kolkata');
                    $data['fname']                = trim($this->input->post('fname'));
                    $data['lname']                = trim($this->input->post('lname'));
                    $data['email']                = $this->input->post('email');
                    $data['mobile']               = $this->input->post('mobile');
                    $data['password']             = md5($form_data['password']);
                    $data['category']             = json_encode ($this->input->post('category'));
                    $data['sub_case_category_id'] = $this->input->post('sub_case_category_id');
                    $data['enrolement_no']        = $this->input->post('enrolement_no');
                    $data['experience']           = $this->input->post('experience');
                    $data['address']              = $this->input->post('address');
                    $data['practice_area']        = ($this->input->post('practice_area'));
                    $data['bar_councle']          = $this->input->post('bar_councle');
                    $data['term_condi']           = $this->input->post('term_condi');
                    $data['phone_condition']      = $this->input->post('phone_condition');
                    $data['status']               = 0;
                    $data['dt']                   = date('d-m-y H:i:s');

                    // Image upload ===============================================================================
                    $image = array();
                    /* code for image upload */
                    if (isset($_FILES['lawyer_img']['name']) && $_FILES['lawyer_img']['name'] != '') {
                        $f_name      = $_FILES['lawyer_img']['name'];
                        $f_tmp       = $_FILES['lawyer_img']['tmp_name'];
                        $f_size      = $_FILES['lawyer_img']['size'];
                        $f_extension = explode('.', $f_name);
                        $f_extension = strtolower(end($f_extension));
                        $f_newfile   = uniqid() . '.' . $f_extension;
                        $store       = "uploads/profile/" . $f_newfile;
                        if (!move_uploaded_file($f_tmp, $store)) {
                            $this->session->set_flashdata('error', 'Image Upload Failed .');
                        } else {
                            $data['lawyer_img'] = $f_newfile;
                        }
                    }
                    
                    // Upload Enrolment ID Image
                    
                    if (isset($_FILES['enrol_image']['name']) && $_FILES['enrol_image']['name'] != '') {
                        $f_name      = $_FILES['enrol_image']['name'];
                        $f_tmp       = $_FILES['enrol_image']['tmp_name'];
                        $f_size      = $_FILES['enrol_image']['size'];
                        $f_extension = explode('.', $f_name);
                        $f_extension = strtolower(end($f_extension));
                        $f_newfile   = uniqid() . '.' . $f_extension;
                        $store       = "uploads/lawyer/" . $f_newfile;
                        if (!move_uploaded_file($f_tmp, $store)) {
                            $this->session->set_flashdata('error', 'Image Upload Failed .');
                        } else {
                            $data['enrol_image'] = $f_newfile;
                            
                        }
                    }
                    
                   
                   $result = $this->Lawyer_model->save($data);

                   $sql = "SELECT * FROM lawyer WHERE `mobile`='".$this->input->post('mobile')."'"; 
         
                    $dbData = $this->Lawyer_model->rawQuery($sql);// Fetch data from client table
                    $lawyer_d = $dbData[0];

                    $updatedata = array('lawyer_unique_id' => "INS99-L".$lawyer_d->id );
                    $this->db->update('lawyer',$updatedata,'id="'.$lawyer_d->id.'"');
          
                    $sql = "SELECT * FROM lawyer WHERE `mobile`='".$this->input->post('mobile')."'"; 
         
                    $dbData = $this->Lawyer_model->rawQuery($sql);// Fetch data from client table
                    $lawyer_data = $dbData[0];
                
                    if (!empty($result)) {

                           // For registration notification start
                           $addNotiToAdmin=array();
                           $addNotiToAdmin['user_type']=1;// for Admin
                           $addNotiToAdmin['user_id']=2;
                           $addNotiToAdmin['subject']="A new Lawyer registered ";
                           $addNotiToAdmin['msg']="A new Lawyer registered in Insaaf99 name is ".$lawyer_data->fname.' '.$lawyer_data->lname;
                           $addNotiToAdmin['act_slug']=base_url().'admin/Lawyer';
                           $addNotiToAdmin['status']=0;
                           $addNotiToAdmin['dt']=date("Y-m-d H:i:s");
                    
                           notification($addNotiToAdmin);// For Client registration notification to Admin function
                    
                        // Send SMS in Mobile Number start 
                        $message='Congratulations!
You have Successfully Registered with Insaaf99.com
You are requested to kindly Complete your Profile
Team Insaaf99.com';
                
                         $response = send_sms($data['mobile'],$message);
                        // Send SMS in Mobile Number end 

                        // send mail for admin 
                         $toEmail = "admin@insaaf99.com"; // admin email 
                         $subject = "New Lawyer Registered ";
                      
                         $heading="Dear Admin New Lawyer Registered into Insaaf99!";
                         
                         $content="
                         <div style='margin-top:1px;'>
                             <tr>
                             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
                             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$data['fname']." ".$data['lname']."</span></td>
                             </tr>
                         </div>
                         <div style='margin-top:1px;'>
                             <tr>
                             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
                             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$data['email']."</span></td>
                             </tr>
                         </div>
                         <div style='margin-top:1px;'>
                             <tr>
                             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$data['mobile']."</span></td>
                             </tr>
                         </div>
                         <div style='margin-top:1px;'>
                             <tr>
                             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Password : </td>
                             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['password']."</span></td>
                             </tr>
                         </div>
                         <div style='margin-top:1px;'>
                             <tr>
                             <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
                             <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer_data->lawyer_unique_id."</span></td>
                             </tr>
                         </div>
                       ";
                        
                        $message=get_email_temp($heading,$content);
                        $this->send_email($toEmail, $subject, $message);
                        /* end code for admin  send email */
                        
                        /* code for send Lawyer registration success mail */
                        $toEmail = $data['email']; // lawyer gmail 
                        $subject = "Registration Successful into Insaaf99";
                     
                        $heading="Hello you have registered successfully into Insaaf99.com";
                        $content="
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$data['email']."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$data['mobile']."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Password : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['password']."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer_data->lawyer_unique_id."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Congratulations!! </td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;text-align: justify;' width='100%' colspan='2'>We are delighted to welcome you on Insaaf99-India,s first cloud-based legal practice management App & Web-dashboard. You've taken the first step on a path that could change your practice and your legal career for years to come. </td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Next Step:</td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b; text-align: justify;' width='100%' colspan='2'>Complete your profile and upload a copy of your Bar Council ID which will help us verify your profile quickly.</td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Regards <br>Team Insaaf99</td>
                            </tr>
                        </div>
                      ";
                       $message=get_email_temp($heading,$content);
                       $this->send_email($toEmail, $subject, $message);
                        /* end code for send user registration success mail */
                        
                        $user_result = $this->Lawyer_model->find($result);
                        $sessionArray = array(
                            'userId' => $user_result->id,
                            'role' => 'lawyer',
                            'email' => $user_result->email,
                            'phone' => $user_result->mobile,
                            'Lawyer_ID' => $lawyer_data->lawyer_unique_id,
                            'isLawyerLoggedIn' => TRUE
                        );
                        
                        $arr                  = array(
                            'userData' => json_encode($sessionArray)
                        );
                        //    $userStatus = $this->session->set_userdata($arr);
                        $_SESSION['userData'] = $arr;
                        if (!empty($_SESSION['userData'])) {
                            
                            echo json_encode(array(
                                'status' => 'true',
                                'message' => $this->session->set_flashdata('success', 'Account Created Successfully'),
                                'reload' => base_url('lawyer/dashboard/index/'.base64_encode($user_result->id))
                            ));
                            
                        }
                        
                    } else {
                        $this->session->set_flashdata('error', 'Some Thing Went wrong!');
                        redirect(base_url());
                    }
                }
            }
        }
    }
    // end code for register 
    
    // Code for  lawyer register welcome page start
    public function welcome()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        
        $data["file"] = "front/lawyer_welcome";
        $this->load->view('front/template', $data);
    }
    // Code for  Login strat here
    public function login()
    {
       
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mobile', 'mobile', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[255]');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            
            $mobile    = $this->input->post('mobile');
            $password = $this->input->post('password');
            $pin = $this->input->post('password');
            if(!empty($mobile)){
                $sql = "SELECT * FROM lawyer ";
                $sql .= "WHERE mobile = '".$mobile."'";
                $rData = $this->Lawyer_model->rawQuery($sql);
                if(!empty($rData)){
                    $lawyerData=$rData[0];
                    if($lawyerData->login_pin==$pin){
                        $result   = json_decode(json_encode($lawyerData), true);
                        if (count($rData) > 0) {
                            $backPage = base_url();
                            
                            if (isset($_SESSION['backPage']) && !empty($_SESSION['backPage'])) {
                                
                                $backPage = $_SESSION['backPage'];
                            }
                            $result = json_decode(json_encode($lawyerData, true));
                            
                            $sessionArray = array(
                                'id' => $lawyerData->id,
                                'role' => 'lawyer',
                                'email' => $lawyerData->email,
                                'phone' => $lawyerData->mobile,
                                'name' => $lawyerData->fname . " " . $lawyerData->lname,
                                'isLawyerLoggedIn' => TRUE
                            );

                            $this->session->set_userdata($sessionArray);
                            echo json_encode(array(
                                'status' => 'true',
                                'message' => $this->session->set_flashdata('success', 'Login Successfully'),
                                'reload' => base_url('lawyer/dashboard/index/'.base64_encode($sessionArray['id']))
                            ));
                        }
                    }
                    elseif($lawyerData->password==md5($password)){
                        $result   = json_decode(json_encode($lawyerData), true);
                        if (count($rData) > 0) {
                            $backPage = base_url();
                            
                            if (isset($_SESSION['backPage']) && !empty($_SESSION['backPage'])) {
                                
                                $backPage = $_SESSION['backPage'];
                            }
                            $result = json_decode(json_encode($lawyerData, true));
                            
                            $sessionArray = array(
                                'id' => $lawyerData->id,
                                'role' => 'lawyer',
                                'email' => $lawyerData->email,
                                'phone' => $lawyerData->mobile,
                                'name' => $lawyerData->fname . " " . $lawyerData->lname,
                                'isLawyerLoggedIn' => TRUE
                            );
                            
                            //$arr = array('userData'=>json_encode($sessionArray));
                            $this->session->set_userdata($sessionArray);
                            echo json_encode(array(
                                'status' => 'true',
                                'message' => $this->session->set_flashdata('success', 'Login Successfully'),
                                'reload' => base_url('lawyer/Dashboard/index/'.base64_encode($sessionArray['id']))
                            ));
                            
                            
                        }
                    }else {
                        echo json_encode(array(
                            'status' => 'pin_pass'
                        ));
                    }
                    
                }else {
                    echo json_encode(array(
                        'status' => 'wrong_mobile'
                    ));
                }


            }else {
                echo json_encode(array(
                    'status' => 'login_detail'
                ));
            }
        }
    }
    
    // Code for Login end here
    
    
    public function logout()
    {
        $Logout = $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logout Successfully');
        $this->session->set_flashdata('error', '', 'Email or password mismatch');
        redirect(base_url());
    }
    // Code for Logout start here
    // Code for forgot password
    
    public function forgot()
    {
        
        $email = $this->input->post('email');
        
        if (!empty($email)) {
            
            // $p  =   $this->user_model->checkEmailExist($email);
            
            if (!empty(is_numeric($email))) {
                
                $sql = "SELECT * from lawyer where mobile=$email";
            } else {
                
                $sql = "SELECT * from lawyer where email='$email'";
            }
            
            $res = $this->Lawyer_model->rawQuery($sql);
            
            
            if (!empty($res)) {
                
                $_SESSION['email'] = $res[0]->email;
                $_SESSION['id']    = $res[0]->id;
                
                
                echo json_encode(array(
                    'status' => 'true',
                    'reload' => base_url('Lawyer_account/setpassword')
                ));
                
            } else {
                // $this->session->set_flashdata('error','Please enter valid Email');
                echo json_encode(array(
                    'status' => 'false'
                ));
                // redirect(base_url('lawyer_accoutn/login'));
            }
        }
    }
    
    // Code to set password
    
    public function setpassword()
    {
        
        $this->load->view('front/includes/header');
        $this->load->view('front/includes/menu');
        $this->load->view('front/lawyer/setPassword');
        $this->load->view('front/includes/footer');
    }
    public function lawyer_term()
    {
        $data["title"] = "index";
        $data["file"]  = "front/lawyer_term";
        $this->load->view('front/template', $data);
    }
    // Code to update password
    
    public function updatepass()
    {
        if (isset($_POST['id'])) {
            
            $id               = $_POST['id'];
            $password         = $_POST['password'];
            $data             = array();
            $data['password'] = md5($_POST['password']);
            $data['id']       = $_POST['id'];
            
            $status = $this->Lawyer_model->save($data);
            
            if (!empty($status)) {
            
                $where['id']  = $status;
                $user_result  = $this->Lawyer_model->findOneBy($where);
                $sessionArray = array(
                    'userId' => $user_result->id,
                    'role' => 'lawyer',
                    'email' => $user_result->email,
                    'phone' => $user_result->mobile,
                    'name' => $user_result->fname,
                    'lastname' => $user_result->lname,
                    'gender' => $user_result->gender
                );

                 // Send mail to forgot password start code
            if (!empty($status)) {

              // send mail for Lawyer 
              $toEmail = $user_result->email; // Lawyer email 
              $subject = "Password Change Successfully ";
           
              $heading="Dear Lawyer ".$user_result->fname." ".$user_result->lname." your password changed and You have set a new password";
              
              $content="
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$user_result->email."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$user_result->mobile."</span></td>
                  </tr>
              </div>
              <div style='margin-top:1px;'>
                  <tr>
                  <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Password : </td>
                  <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$password."</span></td>
                  </tr>
              </div>
            ";
             
             $message=get_email_temp($heading,$content);
             $this->send_email($toEmail, $subject, $message);

            }

            // Send mail to forgot password end code
                
                $arr = array(
                    'userData' => json_encode($sessionArray)
                );
                $this->session->set_userdata($arr);
                $this->session->set_flashdata('success', 'Password change successfully');
                redirect(base_url());
            } else {
                echo 'Something went  wrong <a href="' . base_url() . '">Home</a>';
            }
        } else {
            echo 'Something went  wrong <a href="' . base_url() . '">Home</a>';
        }
    }
    
    // sent otp verify
    
    
    public function otp_verify()
    {
        
        $ch = $_POST['ch'];
        
        switch ($ch) {
            case 'send_otp':
                
            
                $num = $_POST['mob'];
                $otp             = rand(10000, 999999);
                $_SESSION['otp'] = $otp;
                $message='Your one Time OTP is : '.$otp.'
Team Insaaf99.com';
                $response = send_sms($num,$message);
                    echo 'success';
                
                break;
            
            case 'verify_otp':
                $user_otp   = $_POST['otp'];
                $verify_otp = $_SESSION['otp'];
                
                if ($verify_otp == $user_otp) {
                    
                    echo "success";
                    
                }
                break;
            
            default:
                # code...
                break;
        }
        
    }

    // Email otp 
    public function EmailOtp(){
        
        if(isset($_POST['emailAddress'])){
   
            $emailAddress = $_POST['emailAddress'];
            $otp    = mt_rand(1111, 9999);
        
            if(isset($_POST['type']) && $_POST['type']=='sendotp'){
              
                    $subject    ="Email Verification OTP ";

                    $message    = "Please Verify your email <br/> Your OTP IS ".$otp;
                  
                    $sendStatus = $this->send_email($emailAddress,$subject,$message);
                   
                    if($sendStatus==1){
                        $otpSendTime =  date('Y-m-d H:i:s', strtotime('+2 minutes'));
                        $_SESSION['Send_otp_email_Time'] = $otpSendTime;
                        $_SESSION['Email_old_otp'] = $otp;
                        echo "yes";
                        exit();
                    }else{
                        echo 'no';// not exits 
                        exit();
                     }

            }


            if(isset($_POST['type']) && $_POST['type']=='forgot'){
                $where = array();
                $where['email']   = $emailAddress;
                $emailexits       = $this->Lawyer_model->findDynamic($where);
              
                if(!empty($emailexits)){
                  
                    $subject    ="Email Verification ";
                    $message    = "Please Verify your email <br/> Your OTP IS <b>".$otp."</b>";
                    $sendStatus = $this->send_email($emailAddress,$subject,$message);
                    $otpStatus='success';
                    if($otpStatus=='success'){
                        $otpSendTime =  date('Y-m-d H:i:s', strtotime('+2 minutes'));
                        $_SESSION['Send_otp_email_Time'] = $otpSendTime;
                        $_SESSION['Email_old_otp'] = $otp;
                        
                         echo 'yes';
                         exit();
                    }
                }else{
                   echo '0';// not exits 
                   exit();
                }
                
            }
        }else{
            echo "no";
        }
        exit();
    }

public function email_otp_verification(){
        if(!empty($_POST['otp'])){
            $otpSendTime =    $_SESSION['Send_otp_email_Time'];
            $currnetTime =    date("Y-m-d H:i:s");

            $time1 = new DateTime($otpSendTime);
            $time2 = new DateTime($currnetTime);
            $timediff = $time1->diff($time2);
            $overTime = $timediff->format('%i');
            if($overTime<=2){
                if($_POST['otp']==$_SESSION['Email_old_otp']){
            
                    echo 'yes';
                }else{
                   echo 'No';
                //   echo 'yes';
                }
            }else{
                echo '0';// time over 
            }
            exit();

        }else{
            echo '2';// for please enter otp 
        }
    }
}

?>