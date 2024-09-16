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


class signup_ajax extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('Client_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Payment_model');
        
        // Cookie helper
        $this->load->helper('cookie');
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
    
    
    
    public function formSubmit()
    {
        
        
        $firstname = $_POST['firstname'];
        $lastname  = $_POST['lastname'];
        $email     = $_POST['email'];
        $mobile    = $_POST['mobile'];
        $Query     = $_POST['Query'];
        $sub_query = $_POST['sub_query'];
        $message1  = $_POST['message'];
        
        $toEmail = "sureshsarkar2020@gmail.com"; // admin email 
        $subject = "New Client  Registered ";
        $message = join('', array(
            "<div style='background:#ecc9dd; border-radius:8px;padding:7px;'>",
            "<b> Dear Admin",
            "<br>",
            "New Client Registered",
            "</b>",
            "<br>",
            " <b>Name :</b> ",
            $firstname,
            " ",
            $lastname,
            "<br>",
            "<b>E-mail :</b> ",
            $email,
            "<br/>",
            " <b>Mobile :</b>",
            $mobile,
            "<br>",
            " <b>Query : </b></b>",
            $Query,
            "<br>",
            "<b>Sub_query :</b>",
            $sub_query,
            "<br>",
            " <b>Other Query :</b>",
            $message1,
            "<br>",
            "<div>"
        ));
        $this->send_email($toEmail, $subject, $message, "<br/>", "Message : ", $message1, "<br/>");
        
        // end code for send admin mail 
        
        //code for send Client registration success mail
        $toEmail = $email; // Client gmail addresss 
        $subject = " Registered Successfully";
        $message = join('', array(
            "Hello",
            " Dear ",
            "<br>" . $firstname . ' ' . $lastname . " you've registered  successfully into <b>Insaaf99.com</b>"
        ));
        $result  = $this->send_email($toEmail, $subject, $message);
        /* end code for send user registration success mail */
        if ($result) {
            $this->session->set_flashdata('success', 'Mail send Successfully');
            redirect(base_url());
        } else {
            $this->session->set_flashdata('error', 'Mail send Successfully');
            redirect(base_url());
        }
        
        
    }
    
    // register =============================================================
    public function register1()
    {

        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        // Define =========================== 
        
        $data["title"] = "client_register";
        $data["file"]  = "front/client_register";
        $this->load->view('front/template', $data);
    }
    
    //  code for payment gatway details fill 
    
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
    
    // end code for payment getway details fill 
    
    // code for register 
    public function register()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        if (isset($_POST)) {
            
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname', 'fullname ', 'required|max_length[25]|trim');
            $this->form_validation->set_rules('lname', 'fullname ', 'required|max_length[25]|trim');
            $this->form_validation->set_rules('mobile', 'mobile ', 'required|max_length[10]|trim');
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|max_length[128]|trim');
            $this->form_validation->set_rules('password', 'password', 'required|max_length[255]|trim');
            
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'status' => 'true5'
                ));
                
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
                    //$data['device_ip'] =    $device_ip;
                    $insertdata['fname']       = $this->input->post('fname');
                    $insertdata['lname']       = $this->input->post('lname');
                    $insertdata['email']       = $this->input->post('email');
                    $insertdata['password']    = md5($this->input->post('password'));
                    $insertdata['client_type'] = 1;
                    $insertdata['mobile']      = $this->input->post('mobile');
                    $insertdata['message']     = $this->input->post('message');
                    $insertdata['term_condi']  = $this->input->post('term_condi');
                    $insertdata['status']      = 0;
                    
                    $insertdata['dt']          = date('Y-m-d H:i:s');
                    // pre($insertdata);
                    // exit();
                    // ===============================================================================
                    $image = array();
                    /* code for image upload */
                    
                    if (isset($_FILES['case_file']['name']) && $_FILES['case_file']['name'] != '') {
                        $f_name      = $_FILES['case_file']['name'];
                        $f_tmp       = $_FILES['case_file']['tmp_name'];
                        $f_size      = $_FILES['case_file']['size'];
                        $f_extension = explode('.', $f_name);
                        $f_extension = strtolower(end($f_extension));
                        $f_newfile   = uniqid() . '.' . $f_extension;
                        $store       = "uploads/client/" . $f_newfile;
                        if (!move_uploaded_file($f_tmp, $store)) {
                            $this->session->set_flashdata('error', 'Image Upload Failed .');
                        } else {
                            $insertdata['case_file'] = $f_newfile;
                            
                        }
                    }
                    
                    
                    
                    // 99 patment gatway
                    
                    date_default_timezone_set("Asia/Calcutta");
                    $api                        = new Api($this->config->item('razPaykey_id'), $this->config->item('razSecret'));
                    $_SESSION['payable_amount'] = 99;
                    
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
                    
                    $insertdata['password']        = $this->input->post('password');
                    $sessionArray['ClientDetails'] = $insertdata;
                    $this->session->set_userdata($sessionArray);
                    
                    if ($result > 0) {
                        
                        $toEmail = "admin@insaaf99.com"; // admin email 
                        // $toEmail = "admin@insaaf99.com"; // admin email 
                        $subject = "New Clint Registration ";
                        $message = join('', array(
                          "<div style='background:#ecc9dd; border-radius:8px;padding:7px;'>",
                          "Hello Dear Admin ",
                          "<br/>",
                          "<b style='font-size:15px; color:#3a3a8a;'>",
                          "New Clint Registered Successfully ",
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px; color:#3a3a8a;'>",
                          "Client Name : ",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['fname'],' ', $insertdata['lname'],
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px; color:#3a3a8a;'>",
                          "E-mail : ",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['email'],
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px;color:#162c97;'>",
                          "Mobile :",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['mobile'],
                          "</b>",
                          "<br>",
                          "<b style='font-size:15px;color:#162c97;'>",
                          "Your Password is :",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['password'],
                          "</b>",
                          "<div>"
                        ));
                        $this->send_email($toEmail, $subject, $message);
                        
                        
                        /* code for send clint registration success mail */
                        $toEmail = $insertdata['email'] ;// client gmail addresss 
                        $subject = "Registered Successfully ";
                        $message = join('', array(
                          "<div style='background:#ecc9dd; border-radius:8px;padding:7px;'>",
                          "Hello",
                          " Dear ",
                          "<b style='font-size:15px; color:#3a3a8a;'>" . $insertdata['fname'] . " " . $insertdata['lname'],
                          "</b>" . " You have successfully registered on <b> Insaaf99</b>",
                          "<br/>",
                          "<b style='font-size:15px; color:#3a3a8a;'>",
                          "E-mail : ",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['email'],
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px;color:#162c97;'>",
                          "Mobile :",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['mobile'],
                          "</b>",
                          "<br>",
                          "<b style='font-size:15px;color:#162c97;'>",
                          "Your Password is :",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['password'],
                          "</b>",
                          "<div>"
                      ));
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
                    //       $data_view_port=$this->load->view('front/razorpay-manual',$data,TRUE);
                    // echo $data_view_port;
                        $this->session->set_flashdata('success', 'Register Successfully');
                        redirect(base_url());
                    } else {
                        $this->session->set_flashdata('error', ' failed to Register ');
                    }
                    redirect(base_url('signup_ajax/register1'));
                  
                    
                    
                }
            }
        }
    }
    // end code for register
    // Code for  Login strat here
    public function login()
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
                    'isUserLoggedIn' => TRUE
                );
                $this->session->set_userdata($sessionArray);
                
                echo json_encode(array(
                    'status' => 'true',
                    'message' => $this->session->set_flashdata('success', 'Login Successfully'),
                    'reload' => base_url('client/Dashboard/index/' . $sessionArray['id'])
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
                    'name' => $user_result->firstname,
                    'lastname' => $user_result->lastname,
                    'gender' => $user_result->gender
                    //'isUserLoggedIn' => TRUE
                );
                
                $arr = array(
                    'userData' => json_encode($sessionArray)
                );
                $this->session->set_userdata($arr);
                $this->session->set_flashdata('success', 'Password change successfully');
                redirect(base_url());
            } else {
                echo 'Something went1  wrong <a href="' . base_url() . '"></a>';
            }
        } else {
            echo 'Something went2  wrong <a href="' . base_url() . '">Home</a>';
        }
    }
    
    public function client_term()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        $data["title"] = "index";
        $data["file"]  = "front/client_term";
        $this->load->view('front/template', $data);
    }
    public function otp_verify()
    {
        
        $ch = $_POST['ch'];
        
        switch ($ch) {
            case 'send_otp':
                
                $num = $_POST['mob'];
                
                $otp             = rand(10000, 999999);
                $_SESSION['otp'] = $otp;
                
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                    //CURLOPT_URL => "http://2factor.in/API/V1/293832-67745-11e5-88de-5600000c6b13/SMS/9911991199/4499",
                    CURLOPT_URL => "http://2factor.in/API/V1/0843c140-e89d-11ec-9c12-0200cd936042/SMS/" . $num . "/" . $otp . "",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "",
                    CURLOPT_HTTPHEADER => array(
                        "content-type: application/x-www-form-urlencoded"
                    )
                ));
                
                $response = curl_exec($curl);
                $err      = curl_error($curl);
                
                curl_close($curl);
                
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    echo 'success';
                }
                
                
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
    
}
?>
