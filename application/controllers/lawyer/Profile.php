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
       $this->load->model('lawyer/lawyer_model');
       $this->load->model('admin/Case_category_model');
       $this->isLawyerLoggedIn(); 

    }

    /**
     * Index Page for this controller.
     */
   
    public function index($id=NULL)
    {
               $lawyerID=$_SESSION['id'];
               $lawyerData = $this->lawyer_model->find($lawyerID);
            
                if(!empty($lawyerData)){
                $data['userData'] = $lawyerData;

                $this->global['pageTitle'] = 'Insaaf99 : Profile';
                $this->loadViews("lawyer/profile/index", $this->global, $data , NULL ,'lawyer');
            }
    }

    public function edit($id=NULL)
    {
      $lawyerID = $_SESSION['id'];
   
           $lawyerData = $this->lawyer_model->find($lawyerID);
            if(!empty($lawyerData)){
            $data['userData'] = $lawyerData;
            $w['orderby']='name';
           $caseCategoryData = $this->Case_category_model->finddynamic($w);
           if(!empty($caseCategoryData)){
     
            $data['caseCategory']=$caseCategoryData;
           }
            
            $this->global['pageTitle'] = 'Insaaf99 : profile edit';
            $this->loadViews("lawyer/profile/edit", $this->global, $data , NULL ,'lawyer');
        }
    }
    public function update()
    {
         $form_data = $_POST;
         if(isset($form_data) && !empty($form_data)){

           $getData= $this->lawyer_model->find($_SESSION['id']);// get Lawyer data 

           $fname ='';
           $lname ='';
           $lawyer_unique_id ='';
           $login_pin ='';
           $email ='';
           $mobile ='';
           $category ='';
           $gender ='';
           $address ='';
           $experience ='';
           $practice_area ='';
           $bar_councle ='';
           $enrolement_no ='';
           $status ='';
           $state ='';
           $city ='';
           $language ='';
           $about ='';

           $oldfname ='';
           $oldlname ='';
           $oldclient_unique_id ='';
           $oldlogin_pin ='';
           $oldemail ='';
           $oldmobile ='';
           $oldgender ='';
           $oldaddress ='';
           $oldexperience ='';
           $oldpracticearea ='';
           $oldbar_councle ='';
           $oldenrolement_no ='';
           $profileImg ='';
           $enrol_image ='';
           $oldcategory ='';
           $oldstatus ='';
           $oldstate ='';
           $oldcity ='';
           $oldlanguage ='';
           $oldabout ='';
           
          
           $oldData =array();
           $newData =array();
           $lawyerData =array();
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
           if($getData->state !=$form_data['state']){
             $state =$form_data['state'];
             $oldstate =$getData->state;
           }
           if($getData->city !=$form_data['city']){
             $city =$form_data['city'];
             $oldcity =$getData->city;
           }
           if($getData->language !=$form_data['language']){
             $language =$form_data['language'];
             $oldlanguage =$getData->language;
           }
           if(isset($form_data['status']) && $getData->status !=$form_data['status']){
             $status =$form_data['status'];
             $oldstatus =$getData->status;
           }
      
           if(isset($form_data['lawyer_unique_id']) && $getData->lawyer_unique_id !=$form_data['lawyer_unique_id']){
             $lawyer_unique_id =$form_data['lawyer_unique_id'];
             $oldclient_unique_id =$getData->lawyer_unique_id;
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
           if($getData->experience !=$form_data['experience']){
               $experience =$form_data['experience'];
               $oldexperience =$getData->experience;
             }
           if($getData->practice_area !=$form_data['practice_area']){
             $practice_area =$form_data['practice_area'];
             $oldpracticearea=$getData->practice_area;
           }
           if($getData->bar_councle !=$form_data['bar_councle']){
             $bar_councle =$form_data['bar_councle'];
             $oldbar_councle=$getData->bar_councle;
           }
           if($getData->enrolement_no !=$form_data['enrolement_no']){
             $enrolement_no =$form_data['enrolement_no'];
             $oldenrolement_no =$getData->enrolement_no;
           }
           if(isset($form_data['category']) && $getData->category !=json_encode($form_data['category'])){
             $category =json_encode($form_data['category']);
             $oldcategory =$getData->category;
           }
           if($getData->about !=$form_data['about']){
             $about =json_encode($form_data['about']);
             $oldabout =$getData->about;
           }

           if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) && !empty($form_data['oldimage1'])){
             $profileImg =$form_data['oldimage1'];
           }
           if(isset($_FILES['enrol_image']['name']) && !empty($_FILES['enrol_image']['name']) && !empty($form_data['oldimage2'])){
               $enrol_image ='uploads/lawyer/'.$form_data['oldimage2'];
           }

           // get lawye Log details
           $lawyerData = json_decode($getData->other,true);
           if(!empty($lawyerData)){
               $lawyerData = $lawyerData['oldData'];
           }
       
           // store lawyer new data when update data 
           $newData =array('last_updated_date'=>date("d-m-Y H:i:s"),'updated_by'=>$_SESSION['fname'],'first_name'=>$fname,'last_name'=>$lname,'email'=>$email,'mobile'=>$mobile,'city'=>$city,'state'=>$state,'language'=>$language,'status'=>$status,'lawyer_unique_id'=>$lawyer_unique_id,'pin'=>$login_pin,'gender'=>$gender,'address'=>$address,'experience'=>$experience,'practice_area'=>$practice_area,'bar_councle'=>$bar_councle,'enrolement_no'=>$enrolement_no,'category'=>$category,'about'=>$about);

           // store lawyer old data when update data 
           $oldData =array('first_name'=>$oldfname,'last_name'=>$oldlname,'email'=>$oldemail,'mobile'=>$oldmobile,'city'=>$oldcity,'state'=>$oldstate,'language'=>$oldlanguage,'status'=>$oldstatus,'lawyer_unique_id'=>$oldclient_unique_id,'pin'=>$oldlogin_pin,'gender'=>$oldgender,'address'=>$oldaddress,'experience'=>$oldexperience,'practice_area'=>$oldpracticearea,'bar_councle'=>$oldbar_councle,'enrolement_no'=>$oldenrolement_no,'category'=>$oldcategory,'profileImg'=>$profileImg,'enrol_image'=>$enrol_image,'about'=>$oldabout);
           $lawyerData[] =$oldData;
// pre($form_data);
// pre($lawyerData);
// exit();
           $arr =array('newData'=>$newData,'oldData'=>$lawyerData);


        //    =============================
            $update=array();
            $update['id']            = $_SESSION['id'];
            $update['fname']         =$form_data['fname'];
            $update['lname']         =$form_data['lname'];
            $update['about']         =$form_data['about'];
            $update['gender']        = isset($form_data['gender'])?$form_data['gender']:'';
            $update['enrolement_no'] =$form_data['enrolement_no'];
            $update['experience']    =$form_data['experience'];
            $update['state']          =$form_data['state'];
            $update['city']          =$form_data['city'];
            $update['language']      =$form_data['language'];
            $update['practice_area'] =$form_data['practice_area'];
            $update['bar_councle']   =$form_data['bar_councle'];
            $update['address']       =$form_data['address'];
            $update['other']         =json_encode($arr);


            if(isset($_FILES['enrol_image']['name']) && $_FILES['enrol_image']['name'] != '') {

                $f_name         =$_FILES['enrol_image']['name'];
                $f_tmp          =$_FILES['enrol_image']['tmp_name'];
                $f_size         =$_FILES['enrol_image']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/lawyer/".$f_newfile;
            
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'enrol_image Upload Failed .');
                }else
                {
                    if(isset($getData->enrol_image) && !empty($getData->enrol_image)){
                        $file = $getData->enrol_image;
                        // if(file_exists($file))
                        // {
                        //     unlink($file);
                        // }
                    }
                    $update['enrol_image'] = $f_newfile;
                }
                
            }
            

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
                    $this->session->set_flashdata('error', 'Profile Image Upload Failed .');
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
            
           
            $result=$this->lawyer_model->save($update);

            lawyer_profile_status($_SESSION['id']);// update profile complition
            $this->session->set_flashdata('success','Profile successfully updated.');
            redirect(base_url('lawyer/profile'));

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
            
            if($form_data['otp']==$_SESSION['otp']){

             $getData= $this->lawyer_model->find($_SESSION['id']);// get Lawyer data 
         
             $email ='';
             $oldemail ='';
             $profileImg ='';
             $enrol_image ='';
             $oldcategory ='';
             $oldstatus ='';
 
             $oldData =array();
             $newData =array();
             $lawyerData =array();
             if($getData->email !=$form_data['email']){
                 $email =$form_data['email'];
                 $oldemail =$getData->email;
             }
           
 
             if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) && !empty($form_data['oldimage1'])){
               $profileImg =$form_data['oldimage1'];
             }
             if(isset($_FILES['enrol_image']['name']) && !empty($_FILES['enrol_image']['name']) && !empty($form_data['oldimage2'])){
                 $enrol_image ='uploads/lawyer/'.$form_data['oldimage2'];
             }
 
             // get lawye Log details
             $lawyerData = json_decode($getData->other,true);
             if(!empty($lawyerData)){
                 $lawyerData = $lawyerData['oldData'];
             }
         
             // store lawyer new data when update data 
             $newData =array('last_updated_date'=>date("d-m-Y H:i:s"),'updated_by'=>$_SESSION['fname'],'email'=>$email);
 
             // store lawyer old data when update data 
             $oldData =array('email'=>$oldemail,'status'=>$oldstatus,'category'=>$oldcategory,'profileImg'=>$profileImg,'enrol_image'=>$enrol_image);
             $lawyerData[] =$oldData;

             $arr =array('newData'=>$newData,'oldData'=>$lawyerData);

                        $toEmail = $form_data['email']; // Lawyer email 
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
                    
                // update data 
                $update=array();
                $update['id']=$_SESSION['id'];
                $update['email']=$form_data['email'];
                $update['other'] =json_encode($arr);
                
                $result = $this->lawyer_model->save($update);

            $_SESSION['email'] = $form_data['email'];
            lawyer_profile_status($_SESSION['id'], false);
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

                $result=$this->lawyer_model->save($update);
          
                if($result>0){
                echo 1;
                exit();
                }else{
                    echo 2;
                    exit();
                }
         }
 
    }


    public function update_lawyer_category(){
        
        if(isset($_POST) && !empty($_POST)){

            $email ='';
            $category ='';

            $oldemail ='';
            $profileImg ='';
            $enrol_image ='';
            $oldcategory ='';
            $oldstatus ='';

            $oldData =array();
            $newData =array();
            $lawyerData =array();

            $getData= $this->lawyer_model->find($_SESSION['id']);// get Lawyer data 


            if($getData->category !=json_encode($_POST['category'])){
                $category =json_encode($_POST['category']);
                $oldcategory =$getData->category;
              }

                // get lawye Log details
                $lawyerData = json_decode($getData->other,true);
                if(!empty($lawyerData)){
                    $lawyerData = $lawyerData['oldData'];
                }

                          // store lawyer new data when update data 
            $newData =array('last_updated_date'=>date("d-m-Y H:i:s"),'updated_by'=>$_SESSION['fname'],'category'=>$category);

            // store lawyer old data when update data 
            $oldData =array('status'=>$oldstatus,'category'=>$oldcategory,'profileImg'=>$profileImg,'enrol_image'=>$enrol_image);
            $lawyerData[] =$oldData;

            $arr =array('newData'=>$newData,'oldData'=>$lawyerData);
           

         $w=array();
         $w['id']=$_SESSION['id'];
         $w['category']=json_encode($_POST['category']);
         $w['other'] =json_encode($arr);

         $this->lawyer_model->save($w);
         $this->session->set_flashdata('success', 'Your Category Successfully Updated');
         if(isset($_POST['action']) && strtolower($_POST['action']) == 'complete_profile'){
            lawyer_profile_status($_SESSION['id']);
            redirect('lawyer/profile/edit?action=verification_doc');
            // redirect('lawyer/my_scheduler?action=complete_profile');
         }else{
             redirect('lawyer/profile/edit');
         }
        
       
        }
    }

}

?>