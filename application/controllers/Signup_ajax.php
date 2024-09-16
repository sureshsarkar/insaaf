<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Signup_ajax extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('Client_model');
        $this->load->model('Lawyer_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        
        
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
        // Define =========================== 
        
        $data["title"] = "index";
        $data["file"]  = "front/index";
        $this->load->view('front/template', $data);
        
    }

    // payment detail 
    public function prepareData($amount, $razorpayOrderId, $userDetails)
    {
        
        
        $data = array(
            "key" => $this->config->item('razPaykey_id'),
            "amount" => $amount,
            "name" => "Insaaf99",
            
            "image" => base_url() . "assets/images/front_logo/logo1.png",
            "prefill" => array(
                "name" => $userDetails['fname'] . ($userDetails['fname']) ? $userDetails['lname'] : '',
                "email" => $userDetails['email'],
                "contact" => $userDetails['mobile']
                //  "contact"  => '8937001226',
            ),
            "notes" => array(
                "address" => '',
                "merchant_order_id" => rand()
            ),
            "theme" => array(
                "color" => "#e2146f"
            ),
            "order_id" => $razorpayOrderId
        );
        return $data;
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
      
        $data["title"] = "client_register";
        $data["file"]  = "front/client_register";
        $this->load->view('front/template', $data);
    }

    // code for register 
    public function register()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        if (isset($_POST)) {
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname', 'First name ', 'required|max_length[25]|trim');
            $this->form_validation->set_rules('mobile', 'mobile ', 'required|max_length[10]|trim');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[128]|trim');
            $this->form_validation->set_rules('password', 'password', 'required|max_length[255]|trim');
            
            if ($this->form_validation->run() == FALSE) {
                // echo json_encode(array(
                //     'status' => 'true6',
                //     // 'message' => $this->session->set_flashdata('error', 'Please Fill the form correctly'),
                //     // 'reload' => base_url('signup_ajax/register1')
                // ));
                $this->session->set_flashdata('error', 'Please Fill the form correctly !');
                        redirect(base_url('signup_ajax/register1'));

                $this->index();
                
            } else {
                
                $email           = $this->input->post('email');
                $where['email']  = $email;
                $email_status    = $this->Client_model->findOneBy($where);
                $where           = array();
                $mobile          = $this->input->post('mobile');
                $where['mobile'] = $mobile;
                $mobile_status   = $this->Client_model->findOneBy($where);
                
                if (!empty($email_status) || !empty($mobile_status)) {
                    if (!empty($mobile_status) && !empty($email_status)) {

                        $this->session->set_flashdata('error', 'Email or Mobile number alrady exist !');
                        redirect(base_url('signup_ajax/register1'));
                        
                    } else if (!empty($mobile_status)) {
                      
                        $this->session->set_flashdata('error', 'Mobile number alrady exist !');
                        redirect(base_url('signup_ajax/register1'));
                        
                    } else if (!empty($email_status)) {
                     
                        $this->session->set_flashdata('error', 'Email number alrady exist !');
                        redirect(base_url('signup_ajax/register1'));
                        
                    }
                    
                } else {
                    
                    date_default_timezone_set('Asia/Kolkata');
                    $insertdata['fname']       = trim($this->input->post('fname'));
                    $insertdata['lname']       = trim($this->input->post('lname'));
                    $insertdata['email']       = $this->input->post('email');
                    $insertdata['password']    = md5($this->input->post('password'));
                    $insertdata['client_type'] = 1;
                    $insertdata['mobile']      = $this->input->post('mobile');
                    // $insertdata['message']     = $this->input->post('message');
                    $insertdata['term_condi']  = $this->input->post('term_condi');
                    $insertdata['f_pay_free']  = 0;
                    $insertdata['status']      = 1;
                    $insertdata['dt']          = date('Y-m-d H:i:s');
                   
                   
                    // ===============================================================================
                    $image = array();
                    /* code for image upload */
                    
            
                    
                    // 99 patment gatway
                    
                    date_default_timezone_set("Asia/Calcutta");
                    $_SESSION['payable_amount'] = 99;
                    // Razorpay API
                    $api           = new Api($this->config->item('razPaykey_id'), $this->config->item('razSecret'));
                    $razorpayOrder = $api->order->create(array(
                        'receipt' => rand(),
                        'amount' => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
                        'currency' => 'INR',
                        'payment_capture' => 1 // auto capture
                    ));
                
                    $amount = $razorpayOrder['amount'];
                    
                    $razorpayOrderId               = $razorpayOrder['id'];
                    $_SESSION['razorpay_order_id'] = $razorpayOrderId;
                    $data['orderDetails']          = $this->prepareData($amount, $razorpayOrderId, $insertdata);
                    
                    $result = $this->Client_model->save($insertdata); // insert in client table


                    $sql = "SELECT * FROM clint WHERE `mobile`='".$this->input->post('mobile')."'"; 
         
                    $dbData = $this->Client_model->rawQuery($sql);// Fetch data from client table
                    $client_d = $dbData[0];

                    $data = array('client_unique_id' => "INS99-C".$client_d->id );
                    $this->db->update('clint',$data,'id="'.$client_d->id.'"');
             
                    $sql1 = "SELECT * FROM clint WHERE `mobile`='".$this->input->post('mobile')."'"; 
         
                    $dbData = $this->Client_model->rawQuery($sql1);// Fetch data from client table
                    $client_data = $dbData[0];


                    $sessionArray = array(
                        'id' => $client_data->id,
                        'role' => 'user',
                        'email' => $client_data->email,
                        'phone' => $client_data->mobile,
                        'password' => $client_data->password,
                        'name' => $client_data->fname." ".$client_data->lname,
                        'profile_complete' => $client_data->profile_complete,
                        'Client_ID' => $client_data->client_unique_id,
                        'isUserLoggedIn' => TRUE
                    );


                    
                    // $sessionArray['ClientDetails'] = $sessionData;
                  $this->session->set_userdata($sessionArray);
             
                    
                    if ($result > 0) {
                        // For registration notification start
                        $addNotiToAdmin=array();
                        $addNotiToAdmin['user_type']=1;// for Admin
                        $addNotiToAdmin['user_id']=2;
                        $addNotiToAdmin['subject']="A new client registered ";
                        $addNotiToAdmin['msg']="A new client registered in Insaaf99 name is ".$client_data->fname.' '.$client_data->lname;
                        $addNotiToAdmin['act_slug']=base_url().'admin/client';
                        $addNotiToAdmin['status']=0;
                        $addNotiToAdmin['dt']=date("Y-m-d H:i:s");
                 
                        notification($addNotiToAdmin);// For Client registration notification to Admin function
                       
                       
                        // Send SMS in Mobile Number start 
                        $msg='Congratulations!
You have Successfully Registered into Insaaf99.com
Please refer your Registered Mail ID for more info';
                
                       send_sms($insertdata['mobile'],$msg);
                  
                        // Send SMS in Mobile Number end  
                        
                        $toEmail = "admin@insaaf99.com"; // admin email 
                        $subject = "New Client Registered ";
                     
                        $heading="Dear Admin New Client Registered into Insaaf99!";
                        
                        $content="
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['fname']." ".$insertdata['lname']."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['email']."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['mobile']."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Password : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$this->input->post('password')."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client_data->client_unique_id."</span></td>
                            </tr>
                        </div>
                     
                      ";
                       
                       $message=get_email_temp($heading,$content);
                       $this->send_email($toEmail, $subject, $message);
                     
                        
                        /* code for send clint registration success mail */
                      
                        $toEmail = $insertdata['email'] ;// client gmail addresss 
                        $subject = "Registered Successful";
                       
                        $heading="You have Successfully registered into Insaaf99!";
                        
                        $content="
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['email']."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['mobile']."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Password : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$this->input->post('password')."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client_data->client_unique_id."</span></td>
                            </tr>
                        </div>
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Go To Login : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".base_url()."'>Click To Go For Login</a></span></td>
                            </tr>
                        </div>
                      ";
                       
                       $message=get_email_temp($heading,$content);
                       $this->send_email($toEmail, $subject, $message);

                        
                        /* end code for send user registration success mail */
                    }
                    
                    $paymentData                   = array();
                    $paymentData['user_id']        = $result;
                    $paymentData['name']           = $insertdata['fname'] . " " . $insertdata['lname'];
                    $paymentData['email']          = $insertdata['email'];
                    $paymentData['mobile']         = $insertdata['mobile'];
                    $payAmount                     = $amount / 100;
                    $paymentData['amount']         = $payAmount;
                    $paymentData['payment_date']   = date("Y/m/d h:m:s");
                    $paymentData['order_id']       = $razorpayOrderId;
                    $paymentData['payment_mode']   = 'razorpay';
                    $paymentData['payment_type']   = 'Registration';
                    $paymentData['payment_status'] = 'pending';
                    
                    
                    // $result   =   $this->Payment_model->save($paymentData);
                    
                    if ($result > 0) {
                       
                //        $data_view_port=$this->load->view('front/razorpay-manual',$data,TRUE);
                //  echo $data_view_port;
                 
                    $this->session->set_flashdata('success', 'You have Successfully Registered into Insaaf99.com');
                    redirect(base_url('client/Dashboard/index/'.base64_encode($_SESSION['id'])));
                        // $this->session->set_flashdata('success', 'You have Successfully Registered into Insaaf99.com');
                        // redirect(base_url('signup_ajax/register1'));
                    } else {
                       
                        // echo json_encode(array(
                        //     'status' => 'true5',
                        //     // 'message' => $this->session->set_flashdata('error', 'Failed to Register'),
                        //     // 'reload' => base_url('signup_ajax/register1')
                        // ));

                        $this->session->set_flashdata('error', ' Failed to Register');
                        redirect(base_url('signup_ajax/register1'));
                    }
                  
                  
                    
                    
                }
            }
        }
    }
    // end code for register

    //check client mobile number existtance
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

  
    // Code for  Login strat here
    public function loginq()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[255]');
        if ($this->form_validation->run() == FALSE) {
            
            $this->index();
        } else {
         
            $email    = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $result   = $this->Client_model->loginMe($email, $password);
            
            
            $result = json_decode(json_encode($result), true);
            if (count($result) > 0) {
                $backPage = base_url();
                
                if (isset($_SESSION['backPage']) && !empty($_SESSION['backPage'])) {
                    
                    $backPage = $_SESSION['backPage'];
                    
                }
                $result1 = json_decode(json_encode($result, true));
                $result  = $result1[0];
                
                $sessionArray = array(
                    'id' => $result->id,
                    'role' => 'user',
                    'email' => $result->email,
                    'phone' => $result->mobile,
                    'name' => $result->fname . " " . $result->lname,
                    'Client_ID' => $result->client_unique_id,
                    'isUserLoggedIn' => TRUE
                );
                $this->session->set_userdata($sessionArray);
                
                echo json_encode(array(
                    'status' => 'true',
                    'message' => $this->session->set_flashdata('success', 'Login Successfully'),
                    'reload' => base_url('client/Dashboard/index/'.$sessionArray['id'])
                ));
                
                
            } else {
                echo json_encode(array(
                    'status' => 'false',
                ));
                
            }
        }
    }
    
    // Code for Login end here
    public function logout()
    {

        $this->session->sess_destroy();
        
        // unset cookie
        setcookie("loginCookie", "", time() - 3600);
        setcookie('loginCookie', '', -1, '/'); 

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
            
            
            if (!empty(is_numeric($email))) {
                
                $sql = "SELECT * from clint where mobile=$email";
            } else {
                
                $sql = "SELECT * from clint where email='$email'";
            }
            
            $res = $this->Client_model->rawQuery($sql);
            
            
            if (!empty($res)) {
                
                $_SESSION['email'] = $res[0]->email;
                $_SESSION['id']    = $res[0]->id;
                
                echo json_encode(array(
                    'status' => 'true',
                    'reload' => base_url('signup_ajax/setpassword')
                ));
                
                
            } else {
                echo json_encode(array(
                    'status' => 'false'
                ));
            }
        }
    }
    
    // Code to set password
    
    public function setpassword()
    {
        

        $this->load->view('front/includes/header');
        $this->load->view('front/includes/menu');
        $this->load->view('front/clint/setPassword');
        $this->load->view('front/includes/footer');
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
            
            $status = $this->Client_model->save($data);
            
            


            
            if (!empty($status)) {
                
                $where['id']  = $status;
                $user_result  = $this->Client_model->findOneBy($where);
                $sessionArray = array(
                    'userId' => $user_result->id,
                    'role' => 'user',
                    'email' => $user_result->email,
                    'phone' => $user_result->mobile,
                    'name' => $user_result->fname,
                    'lastname' => $user_result->lname,
                    'gender' => $user_result->gender
                    //'isUserLoggedIn' => TRUE
                );
            // Send mail to forgot password start code
            if (!empty($status)) {
             $toEmail       = $user_result->email; //Client Email
             $subject = "Password Changed Successfully ";
          
             $heading="Your have successfully Changed your password";
             
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
                redirect(base_url('signup_ajax/register1'));
            } else {
                echo 'Something went1  wrong <a href="' . base_url() . '"></a>';
            }
        } else {
            echo 'Something went2  wrong <a href="' . base_url() . '">Home</a>';
        }
    }
    // Client Terms and Conditions
    public function client_term()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        
        $data["title"] = "Terms and Condition";
        $data["description"]="Client terms conditions";
        $data["file"]  = "front/client_term";
        $this->load->view('front/template', $data);
    }
    
    // Lawyer Terms and Conditions
    public function lawyer_term()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        $data["title"] = "Terms and Condition";
        $data["description"]="Lawyer terms conditions";
        $data["file"]  = "front/lawyer_term";
        $this->load->view('front/template', $data);
    }



   public function client(){
    $this->session->set_userdata('user_type',2); 
    redirect(base_url("newpage"));
   }
   public function lawyer(){
    $this->session->set_userdata('user_type',1);  
    redirect(base_url("newpage"));
   }

    public function newregister(){
        if(isset($_POST['mobile']) && !empty($_POST['mobile'])){
            $where=array();
            $where['mobile']=$_POST['mobile'];
            $clientData=$this->Client_model->finddynamic($where);
            $lawyerData=$this->Lawyer_model->finddynamic($where);
            if(!empty($clientData)){
               echo "1";//"Mobile Number Already Exist as a Client";
               exit();
            }
            elseif(!empty($lawyerData)){
               echo "2";//"Mobile Number Already Exist as a Lawyer";
               exit();
            }
            else{
                if(isset($_POST['fname']) && !empty($_POST['fname'])){
                    $this->session->set_userdata('user_fname',$_POST['fname']);  
                 }

                if(isset($_POST['lname']) && !empty($_POST['lname'])){
                    $this->session->set_userdata('user_lname',$_POST['lname']);  
                 }
                $this->session->set_userdata('user_mobile', $_POST['mobile']); 
            }
           
           
            if(isset($_POST['gender']) && !empty($_POST['gender'])){
                $gender=$_POST['gender'];
                $this->session->set_userdata('user_gender', $gender); 
            }
//To Send OTP start
            $num = $_POST['mobile'];
            $otp = rand(1231,7879);
            $_SESSION['otp'] = $otp;
            $message='Your one Time OTP is : '.$otp.'
Team Insaaf99.com';
            
            send_sms($num,$message);
            echo '3';//yes


          exit();

        }
        echo "4";//no
        exit();

    }
// User Register
    public function register_now(){
        // check already added
        $checkData = $this->Client_model->findDynamic(array('table' => ($_POST['user_type'] == '1')?'lawyer':'clint', 'mobile'=>$_POST['mobile']));
        if(isset($_POST['password']) && !empty($_POST['cpassword']) && empty($checkData)){
            $data['fname']=str_replace(" ","",$_POST['fname']); 
            $data['lname']=str_replace(" ","",$_POST['lname']);
            $data['mobile']=$_POST['mobile'];
            $data['email']=$_POST['email'];
            $data['gender']=$_POST['gender'];
            $data['query']= (isset($_POST['query']))?$_POST['query']:'';
            $data['login_pin']=$_POST['password'];
            $data['profile_complete']= 30;
            $data['dt']  = date('Y-m-d H:i:s');

            $user_type = $_POST['user_type'];
            $user_type = ($user_type == 'client')?2:1;
            if(!empty($user_type) && $user_type == 1){  

                $userData=$this->Lawyer_model->save($data);
                $lawyerUID="INSF99L".$userData;
                $update['id']=$userData;
                $update['lawyer_unique_id']=$lawyerUID;
                $this->Lawyer_model->save($update);//update to insert Unique ID

                lawyerRegistrationEmail($_POST['email'],$lawyerUID);// call registartion email function for lawyer

                $userType="Lawyer";
                $this->registration_mail($data,$lawyerUID,$userType);
               

                
            }else if(!empty($user_type) && $user_type==2){
                $data['status']=1;
                $userData=$this->Client_model->save($data);
                clientRegistrationEmail($_POST['email'],$data['fname']);// call registartion email function for Client
                $clientUID="INSF99C".$userData;
                $update['id']=$userData;
                $update['client_unique_id']=$clientUID;
                 $this->Client_model->save($update);
               
                $userType="Client";
                $this->registration_mail($data,$clientUID,$userType);
              
            }
           
           // Send SMS in Mobile Number start 
             $message='Congratulations!
You have Successfully Registered into Insaaf99.com
Please refer your Registered Mail ID for more info';
                
            $response = send_sms($_POST['mobile'],$message);
           // Send SMS in Mobile Number end  
            session_unset();
            // session set
            $sessionArray = array(
                'id' => $userData,
                'role' => ($user_type == 1)?'lawyer':'client',
                'phone' => $_POST['mobile'],
                'fname' =>trim($_POST['fname']),
                'lname' =>trim($_POST['lname']),
                'profile_complete' =>30,
                'email' =>'',
                'img'   => base_url('assets/images/defult_image.png'),
                'name' =>trim($_POST['fname'])." ".trim($_POST['lname']),
                'status' =>($user_type == 1)?'0':'1',
            );
            if($user_type == 1){
              $sessionArray['isLawyerLoggedIn'] = true;   
            }else{
                $sessionArray['isUserLoggedIn'] = true;   
            }
           
            $this->session->set_userdata($sessionArray);
          
            // sava data in cookie for future login
            $sessionArray = serialize($sessionArray);
            setcookie('loginCookie',$sessionArray,time()+(86400*30*3),'/');// cookie data for 3 months
            
            echo $user_type;
            exit;
        }

    }


    public function otp_verify()
    {
        $ch = $_POST['ch'];
        switch ($ch) {
            case 'send_otp':
                $num = $_POST['mob'];
                $otp = rand(1231,7879);
                $_SESSION['otp'] = $otp;
                $message='Your one Time OTP is : '.$otp.'
Team Insaaf99.com';
                
                $response = send_sms($num,$message);
                    echo '1';
                break;
            case 'verify_otp':
                $user_otp   = $_POST['otp'];
                $verify_otp = $_SESSION['otp'];
                
                if ($verify_otp == $user_otp) {
                    echo "1";
                }
                //echo "1";
                break;
            default:
                # code...
                break;
        }
    }
    


  // Login ====================================================
  public function login()
    {
        $fData = $_POST;
        $userType = 1;
      
        // check phone number in lawyer table
        $w['table'] = 'lawyer';
        $w['mobile'] = $fData['mobile'];
        $uData = $this->Category_model->findDynamic($w);

        if(empty($uData)){
            $userType = 2;
            $w = array();
            $w['table'] = 'clint';
            $w['mobile'] = $fData['mobile'];
            $uData = $this->Category_model->findDynamic($w);
        }

        if(empty($uData)){
            echo "Phone number does not exist!";
            exit;
        }
        $uData = $uData[0];

        // match pin 
        if($uData->login_pin != $fData['pin']){
            echo "Wrong Password!";
            exit;
        }else{
            // set sesson
            session_unset();
            $sessionArray = array(
                'id' => $uData->id,
                'role' => ($userType == 1)?'lawyer':'client',
                'phone' => $uData->mobile,
                'email' => $uData->email,
                'fname' =>trim($uData->fname),
                'lname' =>trim($uData->lname),
                'profile_complete' =>$uData->profile_complete,
                'img'   => empty($uData->image)?base_url('assets/images/defult_image.png'):"https://insaaf99.com/".$uData->image,
                'name' =>trim($uData->fname)." ".trim($uData->lname),
                'status' => $uData->status,
            );
            if($userType == 1){
              $sessionArray['isLawyerLoggedIn'] = true;   
            }else{
                $sessionArray['isUserLoggedIn'] = true;   
            }
         
            $this->session->set_userdata($sessionArray);

            // sava data in cookie for future login
            $sessionArray = serialize($sessionArray);
            setcookie('loginCookie',$sessionArray,time()+(86400*30*3),'/');// for 3 months
            echo $userType;
            exit;
        }
    }


    // Send OTP ==========================================================
    public function send_otp()
    {
        // check phone number exit;
        $fData = $_POST;
        $w['table'] = 'lawyer';
        $w['mobile'] = $fData['mobile'];
        $uData = $this->Category_model->findDynamic($w);

        if(empty($uData)){
            $userType = 2;
            $w = array();
            $w['table'] = 'clint';
            $w['mobile'] = $fData['mobile'];
            $uData = $this->Category_model->findDynamic($w);
        }

        if(empty($uData)){
            echo "99";
            exit;
        }

        $num = $_POST['mobile'];
        $otp = rand(1231,7879);
        $_SESSION['otp'] = $otp;
        $message='Your one Time OTP is : '.$otp.'
Team Insaaf99.com';

        $response = send_sms($num,$message);

        echo "testnnoseww".base64_encode($otp);
                  
    }


     // Update Password==========================================================
    public function update_pin()
    {
        // check phone number exit;
        $fData = $_POST;
        $table = 'lawyer';

        $w['table'] = 'lawyer';
        $w['mobile'] = $fData['mobile'];
        $uData = $this->Category_model->findDynamic($w);

        if(empty($uData)){
            $table = 'clint';
            $userType = 2;
            $w = array();
            $w['table'] = 'clint';
            $w['mobile'] = $fData['mobile'];
            $uData = $this->Category_model->findDynamic($w);
        }
        if(!empty($uData)){
            $w = array();
            $w['id'] = $uData[0]->id;
            $w['login_pin'] = $fData['pin'];

            if($table == 'lawyer'){
                $this->Lawyer_model->save($w);
            }else{
                $this->Client_model->save($w);
            }
            echo 1;
        }

        exit;
                  
    }




   

// registration mail to Admin
public function registration_mail($emailData,$UID,$userType)
{   
    $toEmail= "vinny@insaaf99.com,write2nmakkar@gmail.com"; // admin mail //vinny@insaaf99.com,write2nmakkar@gmail.com
    $subject= "New ".$userType." registered into - Insaa99.com";

    $heading="Hi Admin, Getting a new ".$userType." registered";
    $content="
    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>".$userType." ID : </td>
        <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$UID."</span></td>
        </tr>
    </div>

    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>".$userType." Name : </td>
        <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$emailData['fname']." ".$emailData['lname']."</span></td>
        </tr>
    </div>
    <div style='margin-top:1px;'>
        <tr>
        <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>".$userType." Mobile : </td>
        <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$emailData['mobile']."</span></td>
        </tr>
    </div>
    ";

    $message = get_email_temp($heading,$content);
    return  $this->send_email($toEmail, $subject, $message);

}




}// class close

?>