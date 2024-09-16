<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . "../assets/plugins/googlelogin/vendor/autoload.php"; // include google API client
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Googlelogin extends BaseController { 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('admin/googlelogin_model');
        $this->load->model('admin/Category_model');

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



    public function index()
    {
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
   

        $data["file"]="front/googlelogin";
        $this->load->view('front/template',$data);
    } 

    // login with google function 
    public function loginwithgoogle(){
   
    // set google client ID
    // $google_oauth_client_id = "77606373523-cntm8ntmoe1t8f9ch5e8lgpdan2hri2g.apps.googleusercontent.com";
    $google_oauth_client_id = "77606373523-ibe867jnur5h6grj5d4vit9a4sim5ksn.apps.googleusercontent.com";
 
    // create google client object with client ID
    $client = new Google_Client(['client_id' => $google_oauth_client_id]);
 
    // verify the token sent from AJAX
    $id_token = $_POST["id_token"];
 
    $payload = $client->verifyIdToken($id_token);
    if ($payload && $payload['aud'] == $google_oauth_client_id)
    {
        // get user information from Google
        $user_google_id = $payload['sub'];
        $name = $payload["name"];
        $data['device_ip'] = $_SERVER['REMOTE_ADDR'];
        $data['user_google_id'] = $payload['sub'];
        $data['device_type'] = check_device();
        $data['fname'] = $payload["given_name"];
        $data['lname'] = $payload["family_name"];
        $data['email'] = $payload["email"];
        $data['image'] = $payload["picture"];
        $data['created_at'] = date("Y-m-d H:i:s");

        /*------------ Insert into googlelogin table in the Database -----------------------*/

        $result  = $this->googlelogin_model->save($data);
        if($result > 0){
            $_SESSION['loginwithgoogle'] = "true";
            echo 1;
        } 
        else
        {
            echo 2;
        }
        // $ret=$sel_obj->signinwithgmail($user_google_id,$email);
        //    $num=mysqli_fetch_array($ret);
        //    if($num>0)
        //    {
        //     $_SESSION['uid']=$num['id'];
        //     $_SESSION['UserEmail']=$num['UserEmail'];
        //    }else{
        //     $sql=$sel_obj->registrationwithgmail($email,$user_google_id,$picture,$FullName,$last_name);
        //     if($sql)
        //     {
        //         $ret=$sel_obj->signinwithgmail($user_google_id,$email);
        //         $num=mysqli_fetch_array($ret);
        //         if($num>0)
        //         {
        //             $_SESSION['uid']=$num['id'];
        //             $_SESSION['UserEmail']=$num['UserEmail'];
        //             /*-------- Send Welcome Email ----------*/
        //              $ct_u_name = $FullName." ".$last_name;
        //              include_once('welcome_mail_to_user.php');
        //              /*--------------------------------------*/
        //         }
        //     }
        //    }
        /*----------------------------------------------------*/
 
        // send the response back to client side
        
        // echo "Successfully logged in. " . $user_google_id . ", " . $name . ", " . $email . ", " . $picture;
    }
    else
    {
        // token is not verified or expired
        echo "Failed to login.";
    }
    }
    

 }

?>