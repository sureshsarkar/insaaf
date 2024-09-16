<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
include('zoom/config.php');
include('zoom/api.php');
use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Client_query extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('client/Slot_model');
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Case_sub_category_model');
       $this->load->model('client/Case_details_model');
       $this->load->model('admin/Lawyer_model');
       $this->load->model('admin/Query_model');
    
    }

    /**
     * Index Page for this controller.
     */
    public function index($id = NULL)
    {  
        $id=base64_decode($id);
        $data['case_category1']=$this->Case_category_model->all();
        $this->isUserLoggedIn();
        $data['user_id']=$id;
        $this->global['pageTitle'] = 'Insaaf99 : Query list';
        $this->loadViews("client/client_query/list", $this->global, $data , NULL ,'client');
        
    }
    /**
     * Index Page for this controller.
     */
    public function select_lawyer_query($id = NULL)
    {  
        $id=base64_decode($id);
        
        $data['case_category1']=$this->Case_category_model->all();

        $this->isUserLoggedIn();
        $data['user_id']=$id;
        $this->global['pageTitle'] = 'Insaaf99 :Selected lawyer  Query list';
        $this->loadViews("client/client_query/list1", $this->global, $data , NULL ,'client');
        
    }
    
    // Add New 

    public function addnew()
    {
        $data['parent_list'] = $this->Slot_model->getparent_id();
        $this->isUserLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("client/slot/addnew", $this->global, $data , NULL);   
    } 
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isUserLoggedIn();
        $id = $_POST['id'];
        // get image path 
        $rData = $this->Slot_model->find($id);
        
        $result = $this->Slot_model->delete($id);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        date_default_timezone_set('Asia/Kolkata'); 
        $this->isUserLoggedIn();
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('name','size Name','trim|required'); 
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {
            $insertData = array();
            $insertData['name'] = $form_data['name'];
            $insertData['status'] = $form_data['status'];
            /* $insertData['width'] = $form_data['width'];
             $insertData['height'] = $form_data['height'];*/
          
           // $insertData['sizeCode'] = $form_data['sizeCode'];
            $insertData['date_at'] = date("Y-m-d H:i:s");	
            $result = $this->Slot_model->save($insertData);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'size successfully Added');
            }
            else
            { 
                $this->session->set_flashdata('error', 'size Addition failed');
            }
            redirect('client/slot/addnew');
          }  
        
    }

    // Member list
    public function ajax_list($id=NULL)
    {  
        error_reporting(0);
          $sql = "SELECT  * FROM query "; 
          $sql .=" WHERE `user_id`='".$id."' AND `query_status`=0 ORDER BY id DESC";
          $list= $this->Query_model->rawQuery($sql); 
   
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

      
        foreach ($list as $currentObj) {

            $temp_date = $currentObj->dt;
            $date_at = $temp_date;
            $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';
           
            $case_cat_id=$currentObj->case_cat_id;
            $case_cat_name=$this->Case_category_model->find($case_cat_id);
            $row[] = $case_cat_name->name;
            // $row[]=$currentObj->query;
            $row[] = $date_at;
            $row[] = ($currentObj->q_payment_status==1)?'<span class="btn-success badge">Paid</span>':'<span class="btn-danger badge">Not Paid</span>';
       

            $row[] = '<a class="btn btn-sm btn-info " style="margin: 4px 0px;""  href="'.base_url().'client/Client_query/view/'.base64_encode($currentObj->id).'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin: 4px 0px;""  href="'.base_url().'client/Client_query/edit/'.base64_encode($currentObj->id).'" title="edit"  data_id="'.$currentObj->id.'" ><i class="fa fa-edit"></i></a> ';
            
            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->Query_model->count_all(),
                        "recordsFiltered" => $this->Query_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list1($id=NULL)
    {  
       
        error_reporting(0);

          $sql = "SELECT  * FROM query "; 
          $sql .=" WHERE `user_id`='".$id."' AND `query_status`=1 ORDER BY id DESC";
          $list= $this->Query_model->rawQuery($sql); 

		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

       
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
           
            $temp_date = $currentObj->dt;
            $date_at =$temp_date;
            $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';

            $lawyer_id=$currentObj->lawyer_id;
            $lawyer_name=$this->Lawyer_model->find($lawyer_id);
            $row[] = $lawyer_name->fname.' '.$lawyer_name->lname;

            $case_cat_id=$currentObj->case_cat_id;
            $case_cat_name=$this->Case_category_model->find($case_cat_id);
            $row[] = $case_cat_name->name;
            $row[] = $date_at;
          if($currentObj->client_first_q_status==1){
            $row[] = ' <a class="btn btn-sm btn-success " style="margin: 4px 0px;""  href="'.base_url().'client/Client_query/view1/'.base64_encode($currentObj->id).'" title="view first query"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a>';
             }else{
                $row[] = ' <a class="btn btn-sm btn-info " style="margin: 4px 0px;""  href="'.base_url().'client/Client_query/view1/'.base64_encode($currentObj->id).'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a>';
             }
            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->Query_model->count_all(),
                        "recordsFiltered" => $this->Query_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


     

    public function view($id = NULL)
    {
        $id=base64_decode($id);
      
        $this->isUserLoggedIn();
        if($id == null)
        {
            redirect('admin/size');
        }
        $data['view_data'] = $this->Query_model->find($id);
        $case_cat_id=$data['view_data']->case_cat_id;
        
        $data['case_cat_name']=$this->Case_category_model->find($case_cat_id);
     
        $data['view_data'] = $this->Query_model->find($id);
        
        $this->global['pageTitle'] = 'Insaaf99 : Edit size';
        $this->loadViews("client/client_query/view", $this->global, $data , NULL,'client');    
        
    } 
    public function view1($id = NULL)
    {
        $id=base64_decode($id);
      
        $this->isUserLoggedIn();
        if($id == null)
        {
            redirect('admin/size');
        }
        $data['view_data'] = $this->Query_model->find($id);
        $case_cat_id=$data['view_data']->case_cat_id;
        // pre($data['view_data']);
        // exit();
        $data['case_cat_name']=$this->Case_category_model->find($case_cat_id);
     
        $data['view_data'] = $this->Query_model->find($id);
        
        $this->global['pageTitle'] = 'Insaaf99 : Edit size';
        $this->loadViews("client/client_query/view1", $this->global, $data , NULL,'client');    
        
    } 

    // Edit
 
    public function edit($id = NULL)
    {
        $id=base64_decode($id);
       
        $this->isUserLoggedIn();
        if($id == null)
        {
            redirect('client/slot'); 
        }
        $data['edit_data'] = $this->Query_model->find($id);

        $client_id=$data['edit_data']->user_id;
        $data['client_data'] = $this->Client_model->find($client_id);
     
        $data['case_cat_data']       = $this->Case_category_model->getparent_id();
      
        $this->global['pageTitle'] = 'Insaaf99 : Slot Data ';
        $this->loadViews("client/client_query/edit", $this->global, $data , NULL,'client');    
        
    }

    // Update *************************************************************
    public function update()
    {
     
        $this->isUserLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('case_cat_id','case cat id','trim|required');
        
        //form data 
        $form_data  = $this->input->post();

        if($this->form_validation->run() == FALSE)
        {
                $this->edit($form_data['id']);
        }
        else
        {
      
            $insertData['id']           = $form_data['id'];
            $insertData['user_id']      = $form_data['user_id'];
            $insertData['case_cat_id']  = $form_data['case_cat_id'];
            $insertData['query']        = $form_data['query'];
            $insertData['query_status'] = 0;
            // $insertData['q_payment_status'] = 0;
     
            if(isset($_FILES['querry_file']['name']) && $_FILES['querry_file']['name'] != '') {
               
                $f_name         =$_FILES['querry_file']['name'];
                $f_tmp          =$_FILES['querry_file']['tmp_name'];
                $f_size         =$_FILES['querry_file']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/cases/".$f_newfile;
                
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }
                else
                {   
                    $insertData['querry_file'] = $f_newfile;
                }
            }
            $result = $this->Query_model->save($insertData);
    
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Your Query Updated Successfully');
                redirect('client/Client_query/index/'.base64_encode($form_data['user_id']));
            }
            else
            { 
                $this->session->set_flashdata('error', 'Failed to  Update Query');
            }
            redirect('client/Client_query/edit/'.base64_encode($insertData['id']));
          }  
    }


     // Send Document*************************************************************
     public function Send_document()
     {
   
        date_default_timezone_set('Asia/Kolkata');
        $this->isUserLoggedIn();          
        $form_data  = $this->input->post();
       
         $this->form_validation->set_rules('client_Id','client_Id','trim');

         if($this->form_validation->run() == FALSE)
         {
             
                 $this->index($form_data['client_Id']);
         }
         else
         {
   
           $insertData['user_id']             =$form_data['client_Id'];
           $insertData['query']               =$form_data['message'];
           $insertData['query_status']        =0;
           $insertData['case_cat_id']         =$form_data['case_cat_id'];
           $insertData['user_type']           =1;

             $sql1 = "SELECT * FROM clint WHERE `id`='".$form_data['client_Id']."'"; 
        
             $dbData = $this->Client_model->rawQuery($sql1);// Fetch data from client table
             $client_data = $dbData[0];
           if(isset($client_data) && empty($client_data)){
                if(isset($client_data->client_first_q_status) && empty($client_data->client_first_q_status)){
                   $insertData['client_first_q_status']     =1;
                 }
            }

           $insertData['q_payment_status']    =0;
           $insertData['dt']                  = date("d-m-Y H:i:s");	
          
           $addNotification=array();
           $addNotification['user_type']=3;// for client
           $addNotification['user_id']=$form_data['client_Id'];
           $addNotification['subject']="You have sent a new query";
           $firsttenwords = shorten_string($form_data['message'], 15);// get some words 
           $addNotification['msg']=$firsttenwords;// for client
           $addNotification['act_slug']=base_url().'client/query';
           $addNotification['status']=0;
           $addNotification['dt']=date("Y-m-d H:i:s");
    
           notification($addNotification);
     
           $addNotiToAdmin=array();
           $addNotiToAdmin['user_type']=1;// for Admin
           $addNotiToAdmin['user_id']=2;
           $addNotiToAdmin['subject']="New Query sent by ".$client_data->fname;
           $firsttenwords = shorten_string($form_data['message'], 15);// get some words 
           $addNotiToAdmin['msg']=$firsttenwords;// for Admin
           $addNotiToAdmin['act_slug']=base_url().'admin/query';
           $addNotiToAdmin['status']=0;
           $addNotiToAdmin['dt']=date("Y-m-d H:i:s");
    
          notification($addNotiToAdmin);// For Admin
          

           if(isset($_FILES['case_file']['name']) && $_FILES['case_file']['name'] != '') {
               
               $f_name         =$_FILES['case_file']['name'];
               $f_tmp          =$_FILES['case_file']['tmp_name'];
               $f_size         =$_FILES['case_file']['size'];
               $f_extension    =explode('.',$f_name);
               $f_extension    =strtolower(end($f_extension));
               $f_newfile      =uniqid().'.'.$f_extension;
               $store          ="uploads/cases/".$f_newfile;
               
               if(!move_uploaded_file($f_tmp,$store))
               {
                   $this->session->set_flashdata('error', 'Image Upload Failed .');
               }
               else
               {   
                  
                   $insertData['querry_file'] = $f_newfile;
               }
                   
           }
        
             
             $result = $this->Query_model->save($insertData);
             if($result >0)
             {

                // Send SMS in Mobile Number start 
                // $message='Dear '.$form_data['client_name'].' Thank you for contacting Insaaf99.com Your query will be shortly answered by our Expert Lawyer';

                $clientname = explode(' ',trim($form_data['client_name']));
      
                $amount="99";
        
                $message= 'Dear '.$clientname[0].'
Your query has been successfully received please make the payment of Rs '.$amount.' for VC with your selected Expert Lawyer.';
        
                 send_sms($form_data['client_phone'],$message);
             
                // Send SMS in Mobile Number end 
            $toEmail= "admin@insaaf99.com"; // Admin email  
            $subject = "New  Query Registered & payment done";

            $heading="Client Query regitered";
            $content="
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['client_name']."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['client_email']."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['client_phone']."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['message']."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Date : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['dt']."</span></td>
                </tr>
            </div>
          ";
           
           $message=get_email_temp($heading,$content);
           $this->send_email($toEmail, $subject, $message);


            $toEmail= $form_data['client_email']; // Client email  
            $subject="Your  Query Sent Successfully ";

            $heading="Your Query Sent Successfully into Insaa99";
            $content="
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['message']."</span></td>
                </tr>
            </div>
            <div style='margin-top:1px;'>
                <tr>
                <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Date : </td>
                <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['dt']."</span></td>
                </tr>
            </div>
          ";
           
           $message=get_email_temp($heading,$content);
           $this->send_email($toEmail, $subject, $message);


           }
 
             if($result > 0)
             {
               $this->session->set_flashdata('success', ' Query sent  successfully ,we will contact you with in 48 hours');
               redirect('client/dashboard/index/'.base64_encode($form_data['client_Id']));
             }
             else
             { 
               $this->session->set_flashdata('error', '  Failed  to send you query');
               redirect('client/dashboard/index/'.base64_encode($form_data['client_Id']));
             }
           }  
         
       }

       // Query notification  *************************************************************
   public function Query_notify()
   {
       
     $form_data  = $this->input->post();
     
           $data = array(
            'client_query_noti' => '1',
           );
        $result=$this->db->update('query',$data,'user_id="'.$form_data['client_id'].'" AND client_query_noti=0');
        
        
           if(!empty($result))
           {
                echo json_encode(array(
                    'status' => 'true',
                    'reload' => base_url('client/Client_query/index/' .base64_encode($form_data['client_id']))
                ));
           }
           else
           { 
               echo json_encode(array(
                  'status' => 'true1',
                  'reload' => base_url('client/Client_query/index/' .base64_encode($form_data['client_id']))
               ));
           }
          
    }
       // Query notification  *************************************************************
   public function select_lawyer_notify()
   {
       
          $form_data  = $this->input->post();

           $data = array(
            'client_select_lawyer_noti' => '1',
           );
        $result=$this->db->update('query',$data,'user_id="'.$form_data['client_id'].'" AND client_select_lawyer_noti=0');
        
        
           if(!empty($result))
           {
                echo json_encode(array(
                    'status' => 'true',
                    'reload' => base_url('client/Client_query/select_lawyer_query/' .base64_encode($form_data['client_id']))
                ));
           }
           else
           { 
               echo json_encode(array(
                  'status' => 'true1',
                  'reload' => base_url('client/Client_query/select_lawyer_query/'.base64_encode($form_data['client_id']))
               ));
           }
          
    }

    
    
    
}

?>