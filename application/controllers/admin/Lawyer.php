<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Lawyer extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/slot_model');
       $this->load->model('admin/lawyer_model');
       $this->load->model('admin/Case_category_model'); //Load the Model here   
       $this->load->model('admin/case_details_model'); //Load the Model here   
       $this->load->model('admin/Case_sub_category_model'); //Load the Model here   
       $this->isLoggedIn();
    }
    
   // Index *****************************************************************
    public function index()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Lawyer List ';
        $this->loadViews("admin/lawyer/list", $this->global, NULL , NULL ,'admin');
    }

    
    // Member list*************************************************************
    public function ajax_list()
    {
        error_reporting(0);
        $list= $this->lawyer_model->get_datatables();
      
        $subCategoryList = array();
	     	$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

        // save data for parent catelgory list
       
        foreach ($list as $currentObj) {

            // get data from z_payement, slot, cases table for lawyer Earn 
            $sql = '';
            $sql .= "SELECT c.id as caseId, s.id as slotId,p.id, p.order_id, p.txn_id, p.payment_status, p.amount FROM cases as c ";
            $sql .= "JOIN z_payment as p ON p.id = c.payment_id ";
            $sql .= "JOIN slot as s ON s.case_id = c.id ";
            $sql .= "WHERE c.asign_lawyer_id ='$currentObj->id' AND s.MeetingStatus = 2 AND p.payment_status = 'Success'";
            
            $sData = $this->slot_model->rawQuery($sql);

            $totalEarn=0;
              if(isset($sData) && !empty($sData)){
                foreach ($sData as $k => $v) {
                    $totalEarn = $totalEarn + $v->amount;
                }   
              }
              
       
          
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'';
            $l_status = $this->config->item('lawyerStatus');
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y h:i a", strtotime($temp_date));
            // select type
            $changeStatus = '<select class="lawyerStatus" id="lawyer_id'.$currentObj->id.'" data-id="'.$currentObj->id.'">';

            foreach($l_status as $k=>$v){
                $active = ($k == $currentObj->status)?' selected ':'';
                $changeStatus .= '<option value="'.$k.'" '.$active.' >'.$v.'</option>';
            }
            $changeStatus .= '</select>';

            $no++;
            $row = array();
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            
            $first_name=$currentObj->fname;
            $last_name=$currentObj->lname;
            $fullname=$first_name.' '. $last_name;
            $row[] = $fullname;
            $row[] = $currentObj->lawyer_unique_id;
            $row[] = $currentObj->mobile;
            $row[] = $currentObj->profile_complete.'%'.$new;
            // $row[] = $currentObj->email;
            $row[] = (empty($sData))?'<span class="badge bg-1 text-danger" >0</span>':'<span class="badge bg-1 text-danger" >'.count($sData).'</span>';
            $row[] = 'Rs-'.$totalEarn;
            $row[] = ($currentObj->city !='')?$currentObj->city:'-';
            $row[] = $changeStatus;
            $row[] = $date_at;
            $row[] = ' <a class="btn btn-sm btn-info " style="margin: 4px 0px;" href="'.base_url().'admin/lawyer/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin: 4px 0px;" href="javascript:void(0)" title="'.$first_name.'"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> &nbsp;&nbsp <a class="btn btn-sm btn-info" style="margin: 4px 0px;" href="'.base_url().'admin/lawyer/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></a> ';
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->lawyer_model->count_all(),
                        "recordsFiltered" => $this->lawyer_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    
    // Add New ************************************************************
    public function addnew()
    {
        $data['parent_list'] = $this->lawyer_model->getparent_id();
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("admin/lawyer/addnew", $this->global, $data , NULL ,'admin');   
    } 


    // delete category ******************************************************
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id = $_POST['id'];
        $result = $this->lawyer_model->delete($id);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    // Edit ****************************************************************
    public function edit($id = NULL)
    {
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin/lawyer');
        }
     
        $data['edit_data'] = $this->lawyer_model->find($id);
        $w['orderby'] = "name";
        $data['case_cat_data'] = $this->Case_category_model->findDynamic($w);

        $data['sub_category'] = $this->Case_sub_category_model->getparent_id();
 
        $this->global['pageTitle'] = 'Insaaf99 : Edit Lawyer';
        $this->loadViews("admin/lawyer/edit", $this->global, $data , NULL ,'admin');    
        
    } 

// view data ****************************************************************
    public function view($id = NULL)
    {
        
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin/lawyer');
        }
            $data['view_data'] = $this->lawyer_model->find($id);
            $w['orderby'] = "name";
            $data['case_cat_data'] = $this->Case_category_model->findDynamic($w);

            $w = array();
            $w['asign_lawyer_id']=$id;
            $cases= $this->case_details_model->finddynamic($w);
            $data['cases']=$cases;
            
            // get data from z_payement, slot, cases table for lawyer Earn 
            $sql = '';
            $sql .= "SELECT c.id as caseId, s.id as slotId, s.meeting_time, s.adminFeedback, p.id, p.order_id, p.txn_id, p.payment_status, p.amount, cl.fname,cl.lname,cl.client_unique_id, cc.name FROM cases as c ";
            $sql .= "JOIN z_payment as p ON p.id = c.payment_id ";
            $sql .= "JOIN slot as s ON s.case_id = c.id ";
            $sql .= "JOIN clint as cl ON cl.id = c.client_id ";
            $sql .= "JOIN case_category as cc ON cc.id = c.case_category_id ";
            $sql .= "WHERE c.asign_lawyer_id ='$id' AND s.MeetingStatus = 2 AND p.payment_status = 'Success' ";
            $sql .= "ORDER BY c.id DESC ";
            $sData = $this->slot_model->rawQuery($sql);
            $data['earnData']=$sData;

             $sql .= "LIMIT 10";
             $sData = $this->slot_model->rawQuery($sql);
             $data['meetingData']=$sData;
              
         // update seen status
        $this->lawyer_model->save(array('id'=> $id,'seen'=>1));
            
        $this->global['pageTitle'] = 'Insaaf99 : lawyer profile';
        $this->loadViews("admin/lawyer/view", $this->global, $data , NULL ,'admin');    
        
    } 


    
// view lawyer all cases ****************************************************************
public function lawyer_allcase($id = NULL)
{
    
    $this->isLoggedIn();
    if($id == null)
    {
        redirect('admin/lawyer');
    }
        $data['view_data'] = $this->lawyer_model->find($id);
        $w['orderby'] = "name";
        $data['case_cat_data'] = $this->Case_category_model->findDynamic($w);
        
        // get data from z_payement, slot, cases table for lawyer Earn 
        $sql = '';
        $sql .= "SELECT c.id as caseId, s.id as slotId, s.meeting_time, s.adminFeedback, p.id, p.order_id, p.txn_id, p.payment_status, p.amount, cl.fname,cl.lname,cl.client_unique_id, cc.name FROM cases as c ";
        $sql .= "JOIN z_payment as p ON p.id = c.payment_id ";
        $sql .= "JOIN slot as s ON s.case_id = c.id ";
        $sql .= "JOIN clint as cl ON cl.id = c.client_id ";
        $sql .= "JOIN case_category as cc ON cc.id = c.case_category_id ";
        $sql .= "WHERE c.asign_lawyer_id ='$id' AND s.MeetingStatus = 2 AND p.payment_status = 'Success' ";
        $sql .= "ORDER BY c.id DESC";
        $sData = $this->slot_model->rawQuery($sql);

        $data['meetingData']=$sData;
    $this->global['pageTitle'] = 'Insaaf99 : lawyer profile';
    $this->loadViews("admin/lawyer/allcases", $this->global, $data , NULL ,'admin');    
    
} 

    // Update Lawyer*************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fname','fname','trim');
        $this->form_validation->set_rules('lname','lname','trim');
        $this->form_validation->set_rules('email','Email','trim');
        $this->form_validation->set_rules('mobile','Mobile','trim');
        
        //form data 
        $form_data  = $this->input->post();
  
        if($this->form_validation->run() == FALSE)
        {
                $this->edit($form_data['id']);
        }
        else
        {

            $getData= $this->lawyer_model->find($form_data['id']);// get Lawyer data 
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
            $oldlanguage ='';

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
            if($getData->email !=$form_data['email']){
              $email =$form_data['email'];
              $oldemail =$getData->email;
            }
            if($getData->mobile !=$form_data['mobile']){
              $mobile =$form_data['mobile'];
              $oldmobile =$getData->mobile;
            }
            if($getData->city !=$form_data['city']){
                $city =$form_data['city'];
                $oldcity =$getData->city;
            }
            if($getData->state !=$form_data['state']){
                $state =$form_data['state'];
                $oldstate =$getData->state;
            }
              if($getData->language !=$form_data['language']){
                $language =$form_data['language'];
                $oldlanguage =$getData->language;
             }
            if($getData->status !=$form_data['status']){
              $status =$form_data['status'];
              $oldstatus =$getData->status;
            }
       
            if($getData->lawyer_unique_id !=$form_data['lawyer_unique_id']){
              $lawyer_unique_id =$form_data['lawyer_unique_id'];
              $oldclient_unique_id =$getData->lawyer_unique_id;
            }
            if($getData->login_pin !=$form_data['login_pin']){
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
            if($getData->category !=json_encode($form_data['category'])){
              $category =json_encode($form_data['category']);
              $oldcategory =$getData->category;
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
            $newData =array('last_updated_date'=>date("d-m-Y H:i:s"),'updated_by'=>'Admin','first_name'=>$fname,'last_name'=>$lname,'email'=>$email,'mobile'=>$mobile,'city'=>$city,'state'=>$state,'status'=>$status,'lawyer_unique_id'=>$lawyer_unique_id,'pin'=>$login_pin,'gender'=>$gender,'address'=>$address,'experience'=>$experience,'practice_area'=>$practice_area,'bar_councle'=>$bar_councle,'enrolement_no'=>$enrolement_no,'category'=>$category);

            // store lawyer old data when update data 
            $oldData =array('first_name'=>$oldfname,'last_name'=>$oldlname,'email'=>$oldemail,'mobile'=>$oldmobile,'city'=>$oldcity,'state'=>$oldstate,'language'=>$oldlanguage,'status'=>$oldstatus,'lawyer_unique_id'=>$oldclient_unique_id,'pin'=>$oldlogin_pin,'gender'=>$oldgender,'address'=>$oldaddress,'experience'=>$oldexperience,'practice_area'=>$oldpracticearea,'bar_councle'=>$oldbar_councle,'enrolement_no'=>$oldenrolement_no,'category'=>$oldcategory,'profileImg'=>$profileImg,'enrol_image'=>$enrol_image);
            $lawyerData[] =$oldData;

            $arr =array('newData'=>$newData,'oldData'=>$lawyerData);
     

            $insertData['id'] = $form_data['id'];
            $insertData['fname'] = str_replace(" ","",$form_data['fname']);
            $insertData['lname'] = str_replace(" ","",$form_data['lname']);
            $insertData['email'] = $form_data['email'];
            $insertData['mobile'] = $form_data['mobile'];
            $insertData['city']   = $form_data['city'];
            $insertData['state']   = $form_data['state'];
            $insertData['language'] = $form_data['language'];
            $insertData['gender'] = $form_data['gender'];
            $insertData['login_pin'] = $form_data['login_pin'];
            $insertData['category'] =json_encode($form_data['category']);
            $insertData['enrolement_no'] = $form_data['enrolement_no'];
            $insertData['experience'] = $form_data['experience'];
            $insertData['address'] = $form_data['address'];
            $insertData['practice_area'] = $form_data['practice_area'];
            $insertData['bar_councle'] = $form_data['bar_councle'];
            $insertData['lawyer_unique_id'] = $form_data['lawyer_unique_id'];
            $insertData['status'] = $form_data['status'];
            $insertData['other'] =json_encode($arr);
         
       
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
                }
                else
                {
					// $file = "uploads/profile/".$form_data['oldimage1'];
                   
					// if(file_exists ( $file))
					// {
					// 	unlink($file);
					// }
                    
					$insertData['image'] = $store;
                 
                }
                 
            }

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
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }
                else
                {
					// $file = "uploads/lawyer/".$form_data['oldimage2'];
                   
					// if(file_exists ( $file))
					// {
					// 	unlink($file);
					// }
                    
					$insertData['enrol_image'] = $f_newfile;
                }
                 
            }

            $result = $this->lawyer_model->save($insertData);
            if($result > 0)
            {
         
                $this->session->set_flashdata('success', ' Lawyer delails  successfully Updated');
                redirect('admin/lawyer');
            }
            else
            { 
               
                $this->session->set_flashdata('error', ' Lawyer delails  Updation failed');
            }
            redirect('admin/lawyer/edit/'.$insertData['id']);
          }  
        
    }

   
// Update Lawyer status********************************************************************************************
    public function update_lawyer_status(){
        if(isset($_POST) && !empty($_POST)){
            $lawyerData=$this->lawyer_model->find($_POST['lawyerId']);// get lawyer data
          
            if($_POST['status']==1){
                $data['id']=$_POST['lawyerId'];
                $data['status']=$_POST['status'];
                $this->lawyer_model->save($data);// update status
                
                $toEmail=$lawyerData->email; // lawyer email
                $subject="Account approved";
                $heading="Your account is successfully activated";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                      <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerData->fname." ".$lawyerData->lname."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer ID :</td>
                      <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerData->lawyer_unique_id."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Status :</td>
                      <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span class='text-success'>Active</span></td>
                    </tr>
                </div>
              ";
               $message=get_email_temp($heading,$content);
              //  $this->send_email($toEmail, $subject, $message);

                echo 1;
                exit();
            }else{
                $s="";
                if($_POST['status']==0){
                    $s="Pending";
                }else if($_POST['status']==1){
                    $s="Active";
                }else if($_POST['status']==2){
                    $s="Under Review";
                }else if($_POST['status']==3){
                    $s="In-Active";
                }
             
                $data['id']=$_POST['lawyerId'];
                $data['status']=$_POST['status'];
                $data['reason']=$_POST['reason'];
                $this->lawyer_model->save($data);// update status


                $toEmail=$lawyerData->email; // lawyer email
                $subject="Account deactivated";
                $heading="Your account deactivated";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Reason :</td>
                      <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$_POST['reason']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                      <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerData->fname." ".$lawyerData->lname."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer ID :</td>
                      <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyerData->lawyer_unique_id."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                      <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Status :</td>
                      <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span class='text-success'>".$s."</span></td>
                    </tr>
                </div>
              ";
               $message=get_email_temp($heading,$content);
              //  $this->send_email($toEmail, $subject, $message);

                echo 2;
                exit();

            }

        }
    }
    
}

?>