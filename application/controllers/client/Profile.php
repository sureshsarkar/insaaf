<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Profile extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('client/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->isUserLoggedIn(); 

    }

    /**
     * Index Page for this controller.
     */
   
    public function index($id=NULL)
    {
               $clientID=$_SESSION['id'];
               $clientData = $this->Client_model->find($clientID);
                if(!empty($clientData)){
                $data['userData'] = $clientData;

                $this->global['pageTitle'] = 'Insaaf99 : client';
                $this->loadViews("client/profile/index", $this->global, $data , NULL ,'client');
            }
    }

    public function edit($id=NULL)
    {
               $clientID = $_SESSION['id'];
               $clientData = $this->Client_model->find($clientID);
                if(!empty($clientData)){
                $data['userData'] = $clientData;

                if($clientData->email_verify ==0){
                   $data['requireUpdate'] = 'email_verify';
                }

                
                $this->global['pageTitle'] = 'Insaaf99 : client';
                $this->loadViews("client/profile/edit", $this->global, $data , NULL ,'client');
            }
    }
    public function update()
    {
       $form_data = $_POST;
         if(isset($form_data) && !empty($form_data)){

            $getData= $this->Client_model->find($_SESSION['id']);// get Lawyer data 

            $fname ='';
            $lname ='';
            $client_unique_id ='';
            $login_pin ='';
            $email ='';
            $mobile ='';
            $gender ='';
            $address ='';
            $status ='';
            $about ='';
 
            $oldfname ='';
            $oldlname ='';
            $oldclient_unique_id ='';
            $oldlogin_pin ='';
            $oldemail ='';
            $oldmobile ='';
            $oldgender ='';
            $oldaddress ='';
            $profileImg ='';
            $oldstatus ='';
            $oldabout ='';
            
           
            $oldData =array();
            $newData =array();
            $clientData =array();
            if($getData->fname !=$form_data['fname']){
                $fname =$form_data['fname'];
                $oldfname =$getData->fname;
            }
            if($getData->lname !=$form_data['lname']){
            $lname =$form_data['lname'];
            $oldlname =$getData->lname;
            }
            if(isset($form_data['email']) && $getData->email !=$form_data['email']){
              $email =$form_data['email'];
              $oldemail =$getData->email;
            }
            if(isset($form_data['mobile']) && $getData->mobile !=$form_data['mobile']){
              $mobile =$form_data['mobile'];
              $oldmobile =$getData->mobile;
            }
            if(isset($form_data['status']) && $getData->status !=$form_data['status']){
              $status =$form_data['status'];
              $oldstatus =$getData->status;
            }
       
            if(isset($form_data['client_unique_id']) && $getData->client_unique_id !=$form_data['client_unique_id']){
              $client_unique_id =$form_data['client_unique_id'];
              $oldclient_unique_id =$getData->client_unique_id;
            }
            if(isset($form_data['login_pin']) && $getData->login_pin !=$form_data['login_pin']){
              $login_pin =$form_data['login_pin'];
              $oldlogin_pin =$getData->login_pin;
            }
            if($getData->gender !=$form_data['gender']){
              $gender =$form_data['gender'];
              $oldgender =$getData->gender;
            }
            if($getData->address !=$form_data['address']){
                $address =$form_data['address'];
                $oldaddress =$getData->address;
              }
            if(isset($form_data['about']) && $getData->about !=$form_data['about']){
              $about =json_encode($form_data['about']);
              $oldabout =$getData->about;
            }
 
            if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) && !empty($form_data['oldimage1'])){
              $profileImg =$form_data['oldimage1'];
            }
 
            // get lawye Log details
            $clientData = json_decode($getData->other,true);
            if(!empty($clientData)){
                $clientData = $clientData['oldData'];
            }
         
            // store lawyer new data when update data 
            $newData =array('last_updated_date'=>date("d-m-Y H:i:s"),'updated_by'=>$_SESSION['fname'],'first_name'=>$fname,'last_name'=>$lname,'email'=>$email,'mobile'=>$mobile,'status'=>$status,'client_unique_id'=>$client_unique_id,'pin'=>$login_pin,'gender'=>$gender,'address'=>$address,'about'=>$about);
 
            // store lawyer old data when update data 
            $oldData =array('first_name'=>$oldfname,'last_name'=>$oldlname,'email'=>$oldemail,'mobile'=>$oldmobile,'status'=>$oldstatus,'client_unique_id'=>$oldclient_unique_id,'pin'=>$oldlogin_pin,'gender'=>$oldgender,'address'=>$oldaddress,'profileImg'=>$profileImg,'about'=>$oldabout);
            $clientData[] =$oldData;
       
            $arr =array('newData'=>$newData,'oldData'=>$clientData);

           
            // ==========================
            $update=array();
            $update['id']=$_SESSION['id'];
            $update['fname']=$form_data['fname'];
            $update['lname']=$form_data['lname'];
            $update['gender']=$form_data['gender'];
            $update['address']=$form_data['address'];
            $update['other'] = json_encode($arr);
        
           
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {

                $f_name         =$_FILES['image']['name'];
                $f_tmp          =$_FILES['image']['tmp_name'];
                $f_size         =$_FILES['image']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/profile/".$f_newfile;
            
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }else
                {
                    if(isset($getData->image) && !empty($getData->image)){
                        $file = $getData->image;
                        // if(file_exists($file))
                        // {
                        //     unlink($file);
                        // }
                    }
                    $update['image'] = $store;
                }
                
            }
           
            $result=$this->Client_model->save($update);
            
            client_profile_status($_SESSION['id']);// update profile complition
            $this->session->set_flashdata('success','Profile successfully updated.');
            redirect(base_url('client/profile'));

         }
 
    }



    // Send Email OTP 
    public function send_email_otp()
    {
         if(isset($_POST) && !empty($_POST)){
       
            $update=array();
            $update['id']=$_SESSION['id'];
            $update['email']=$_POST['email'];

            $otp = rand(1231,7879);
            $_SESSION['otp'] = $otp;
            $toEmail = $_POST['email']; // Client email 
            $subject = "Email Verify OTP";
         
            $heading="Your One time OTP is-";
            
            $content="
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>OTP : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$otp."</span></td>
                </tr>
            </div>
          ";
           
           $message=get_email_temp($heading,$content);
           $this->send_email($toEmail, $subject, $message);
         echo 1;
         exit();
         }else{
            echo 2;
            exit();
         }
 
    }

    // Send Email OTP 
    public function verify_email_otp()
    { 
        $form_data = $_POST;
         if(isset($form_data) && !empty($form_data)){
       
      
            if($form_data['otp'] == $_SESSION['otp']){

                $getData= $this->Client_model->find($_SESSION['id']);// get Lawyer data 
         
                $email ='';
                $oldemail ='';
                $profileImg ='';
                $oldstatus ='';
    
                $oldData =array();
                $newData =array();
                $clientData =array();
                if($getData->email !=$form_data['email']){
                    $email =$form_data['email'];
                    $oldemail =$getData->email;
                }
    
                // get lawye Log details
                $clientData = json_decode($getData->other,true);
                if(!empty($clientData)){
                    $clientData = $clientData['oldData'];
                }
            
                // store lawyer new data when update data 
                $newData =array('last_updated_date'=>date("d-m-Y H:i:s"),'updated_by'=>$_SESSION['fname'],'email'=>$email);
    
                // store lawyer old data when update data 
                $oldData =array('email'=>$oldemail,'status'=>$oldstatus,'profileImg'=>$profileImg);
                $clientData[] =$oldData;
   
                $arr =array('newData'=>$newData,'oldData'=>$clientData);


                $_SESSION['email'] =$form_data['email'];
                $update=array();
                $update['id']= $_SESSION['id'];
                $update['email_verify']=1;
                $update['email']= $form_data['email'];
                $update['other'] =json_encode($arr);
                
                $this->Client_model->save($update);
             
                
                client_profile_status($_SESSION['id']);// update profile complition
                

                if(empty($getData->email)){

                        $toEmail = $form_data['email']; // Client email 
                        $subject = "Registration successful into Insaaf99.com";
                    
                        $heading="You have registered successfully into <b> Insaaf99.com</b>";
                        
                        $content="
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Registration Email : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['email']."</span></td>
                            </tr>
                        </div>
                    ";
                    
                    $message=get_email_temp($heading,$content);
                    $this->send_email($toEmail, $subject, $message);

                }else{

                        $toEmail = $form_data['email']; // Client email 
                        $subject = "You have changed email successfully";
                    
                        $heading="You have successfully changed your email";
                        $content="
                        <div style='margin-top:1px;'>
                            <tr>
                            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Registration Email : </td>
                            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['email']."</span></td>
                            </tr>
                        </div>
                    ";
                    
                    $message=get_email_temp($heading,$content);
                    $this->send_email($toEmail, $subject, $message);
                    
                }

                echo 1;
                exit();
            }else{
                echo 2;// Invalid OTP
                exit();
            }
          
         }else{
            echo 2;
            exit();
         }
 
    }

    // Save PIN Start
    public function save_pin()
    {
         if(isset($_POST) && !empty($_POST)){
         
            $update['id']=$_SESSION['id'];
            $update['login_pin']=$_POST['password'];

                $result=$this->Client_model->save($update);
          
                if($result>0){
                echo 1;
                exit();
                }else{
                    echo 2;
                    exit();
                }
         }
 
    }


}

?>