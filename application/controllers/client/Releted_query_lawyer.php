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
/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Releted_query_lawyer extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isUserLoggedIn();
        $this->load->model('Base_model');
        $this->load->model('lawyer/Hearing_date_model');
        $this->load->model('client/Client_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        $this->load->model('client/Case_details_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('admin/Slot_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('front/orders_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Lawyer_scheduler_model');

 
    
    }

    public function index($id)
    {
        $id=base64_decode($id);
        if(!empty($_POST)){
            $q_id = $_POST['q_id'];
        }
        if(!empty($_GET)){
            $q_id = base64_decode($_GET['q_id']);
        }

        $sql = "Select * from clint";
        $sql .= " WHERE id = '".$id."' ";
        $cData = $this->Client_model->rawQuery($sql);
        $data1['client_pay_data']=$cData[0]; // Client data 

        $sql = "Select * from query ";
        $sql .="WHERE id = '".$q_id."'";
        $qData = $this->Query_model->rawQuery($sql);
        $data1['client_query_data']=$qData[0]; // Client  Query data 
    
        $data1['case_category1']=$this->Case_category_model->all();
        

        $QueryID=$q_id;
        $userID=$id;
        $data1['query_ID']=$QueryID;
        $data1['user_ID']=(object) $userID;
     
       
          $query_id=$q_id;
        
        $id=$_SESSION['id'];
        $sql = "Select q.*, cc.name as catName FROM query as q JOIN case_category as cc ON cc.id = q.case_cat_id WHERE q.id = '".$query_id."' AND q.user_id = '".$id."' AND q.query_status=0 ";
        $rData = $this->Query_model->rawQuery($sql);
        $data1['my_query']=$rData;
        $queryData = array();
        if(!empty($rData)){
            $temp = array();
            $k = 1;
            foreach ($rData as $key => $value) {
                $queryData[$value->case_cat_id]['catName'] = $value->catName;
                $queryData[$value->case_cat_id]['query_id'][$k] = $value->id;
                $queryData[$value->case_cat_id]['query'][$k] = $value->query;
                $queryData[$value->case_cat_id]['query_status'][$k] = $value->query_status;
                if(!isset($temp[$value->case_cat_id])){
                    $categories = isset($categories)?$categories.'["'.$value->case_cat_id.'"]':'["'.$value->case_cat_id.'"]';
                }
                $temp[$value->case_cat_id] = $value->case_cat_id;
            }
            $k++;
        }

        if(isset($categories)){
       
           $sql = " SELECT * FROM lawyer WHERE JSON_CONTAINS(category,'".$categories."') ";
            $rData = $this->lawyer_model->rawQuery($sql);
              if(isset($rData) && !empty($rData)){
                    foreach ($rData as $key => $v) {
                        $data['selected_lawyer'][$v->id] = $v;
                            $temp = array();
                            if(!empty($v->category)){
                                $tempCat = json_decode($v->category,true);
                                foreach ($tempCat as $catKey => $cat) {
                                    if(isset($queryData) && isset($queryData[$cat])){
                                        $temp[] = $queryData[$cat]['catName'];
                                    }
                                }
                        }
                        $data['selected_lawyer'][$v->id]->categoryName = json_encode($temp);
                        $data['selected_lawyer'][$v->id]->query_id = (isset($queryData) && isset($queryData[$cat]))?$queryData[$cat]['query_id']:'';
                        $data['selected_lawyer'][$v->id]->query = (isset($queryData) && isset($queryData[$cat]))?$queryData[$cat]['query']:'';
                        $data['selected_lawyer'][$v->id]->query_status = (isset($queryData) && isset($queryData[$cat]))?$queryData[$cat]['query_status']:'';
                    }
            }else{
                echo "There is no lawyer available in this category";
            }
        }
        $data1['my_lawyers']=$data['selected_lawyer'];
        $data1['query_Id']=$q_id;

        $this->global['pageTitle'] = 'Client Dashboard';
        $this->loadViews("client/releted_query_lawyer", $this->global, $data1, NULL, 'client');
    }
 
    
    // Update Slot *************************************************************
    public function updateslot()
    {
          
        $this->isUserLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('slot_date', 'slot date', 'trim|required');
       // $this->form_validation->set_rules('time', 'Time', 'trim|required');
        $this->form_validation->set_rules('period', 'Period', 'trim|required');
        $this->form_validation->set_rules('case_id', 'Case', 'trim|required');
        $this->form_validation->set_rules('slot_id', 'Case', 'trim|required');
        $this->form_validation->set_rules('client_id', 'Client Case', 'trim|required');
        $this->form_validation->set_rules('contact_mode', 'contact Mode', 'trim|required');
        
        //form data 
        $form_data = $this->input->post();
        // pre($form_data);
        //     exit();
        if ($this->form_validation->run() == FALSE) {
            
            $this->session->set_flashdata('error', 'Please fill the form correctly');
            $this->index($form_data['client_id']);
        } else {
            // pre($form_data);
            
            $insertData['id']           = $form_data['slot_id'];
            $insertData['case_id']      = $form_data['case_id'];
            $insertData['client_id']    = $form_data['client_id'];
            $insertData['lawyer_id']    = $form_data['lawyer_id'];
            $insertData['slot_date']    = $form_data['slot_date'];
            $time                       =$form_data['time'];
            $insertData['time']         = date('h:i A', strtotime($time));
            $insertData['period']       = $form_data['period'];
            $insertData['contact_mode'] = $form_data['contact_mode'];
            $insertData['slot_status']       = 0;
            $insertData['dt']           = date("Y-m-d H:i:s");
            
            $result = $this->Slot_model->save($insertData);
            
            if (!empty($result)) {
                /* send mail for Lawyer to book slot for lawyer */
                $toEmail = $form_data['lawyer_email']; // lawyer email 
                $subject = "New Slot Booked Updated";
                $heading="New Slot Booked Updated Successfully";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['client_name']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['slot_date']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['time']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting period : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['period']."</span></td>
                    </tr>
                </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);

                
                /* end code for Lawyer to book slot  send email */
                
                /* code for send  mail  to slot booking confirmation for client */
                $toEmail = $form_data['client_email']; // Client email 
                $subject = "Slot Booked Successfully";
                $heading="Dear ".$form_data['client_name']." your slot booking is now pending confirmation with our expert Lawyer";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['lawyer_name']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['slot_date']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['time']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting period : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['period']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Process : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>Pending</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Confirmation mail coming soon.</td>
                    </tr>
                </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);


                $toEmail = "admin@insaaf99.com"; // Admin email
                $subject = "Slot Bookng update  Successfully";
                $heading="New slot booking update ";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['lawyer_name']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['client_name']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['slot_date']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['time']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting period : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['period']."</span></td>
                    </tr>
                </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);

                
                /* end code for send  mail  to slot booking confirmation */
            }
            
            if ($result > 0) {
                
                
                $this->session->set_flashdata('success', 'Slot Booked Sulleccfuly');
                redirect('client/Dashboard/index/' . base64_encode($form_data['client_id']));
                
            } else {
                
                $this->session->set_flashdata('error', 'Failed to book slot');
                $this->index();
            }
            
        }
        
    }
    


     // cases  list
     public function ajax_list($client_id = NULL)
     { 
        error_reporting(0);
         $where=array();
         $list =$this->Case_details_model->findBy();
        //  pre($list);
         $where['client_id'] = $client_id;
         $table='cases';
         $list = $this->Case_details_model->findByTable($where,$table);
        //  pre($list);
        //  exit();
         $data = array();
         $no =(isset($_POST['start']))?$_POST['start']:'';
 
        
         // save data for parent catelgory list
       
         foreach ($list as $currentObj) {
             $temp_date = $currentObj->dt;
             $date_at = date("d-m-Y", strtotime($temp_date));
             $no++;
            $row = array();
            $row[] = $no;
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $sub_case_id       = $currentObj->case_sub_category_id;
            $sub_category_name = $this->Case_sub_category_model->find($sub_case_id);
            $row[]             = $sub_category_name->case_sub_category;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
             $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
             $row[] = $date_at;
             $row[] = ' <a class="btn btn-sm btn-info " href="'.base_url().'client/Dashboard/Total_case_view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
 
             $data[] = $row;
         }
         $output = array(
                         "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                         "recordsTotal" => $this->Client_model->count_all(),
                         "recordsFiltered" => $this->Client_model->count_filtered(),
                         "data" => $data,
                 );
         //output to json format
         echo json_encode($output);
     }
     // cases  list
     public function ajax_list1($client_id = NULL)
     { 
        error_reporting(0);
         $where=array();
         $list =$this->Case_details_model->findBy();
   
         $where['client_id'] = $client_id;
         $where['status'] = 1;
         $table='cases';
         $list = $this->Case_details_model->findByTable($where,$table);
        //  pre($list);
        //  exit();
         $data = array();
         $no =(isset($_POST['start']))?$_POST['start']:'';
 
        
         // save data for parent catelgory list
       
         foreach ($list as $currentObj) {
             $temp_date = $currentObj->dt;
             $date_at = date("d-m-Y", strtotime($temp_date));
             $no++;
            $row = array();
            $row[] = $no;
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $sub_case_id       = $currentObj->case_sub_category_id;
            $sub_category_name = $this->Case_sub_category_model->find($sub_case_id);
            $row[]             = $sub_category_name->case_sub_category;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
             $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
             $row[] = $date_at;
            //  $row[] = ' <a class="btn btn-sm btn-info " href="'.base_url().'client/client/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
 
             $data[] = $row;
         }
         $output = array(
                         "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                         "recordsTotal" => $this->Client_model->count_all(),
                         "recordsFiltered" => $this->Client_model->count_filtered(),
                         "data" => $data,
                 );
         //output to json format
         echo json_encode($output);
     }
     public function ajax_list2($client_id = NULL)
     { 
        error_reporting(0);
         $where=array();
         $list =$this->Case_details_model->findBy();
   
         $where['client_id'] = $client_id;
         $where['status'] = 0;
         $table='cases';
         $list = $this->Case_details_model->findByTable($where,$table);
      
         $data = array();
         $no =(isset($_POST['start']))?$_POST['start']:'';
 
        
         // save data for parent catelgory list
       
         foreach ($list as $currentObj) {
             $temp_date = $currentObj->dt;
             $date_at = date("d-m-Y", strtotime($temp_date));
             $no++;
            $row = array();
            $row[] = $no;
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $sub_case_id       = $currentObj->case_sub_category_id;
            $sub_category_name = $this->Case_sub_category_model->find($sub_case_id);
            $row[]             = $sub_category_name->case_sub_category;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
             $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
             $row[] = $date_at;
            //  $row[] = ' <a class="btn btn-sm btn-info " href="'.base_url().'client/client/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
 
             $data[] = $row;
         }
         $output = array(
                         "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                         "recordsTotal" => $this->Client_model->count_all(),
                         "recordsFiltered" => $this->Client_model->count_filtered(),
                         "data" => $data,
                 );
         //output to json format
         echo json_encode($output);
     }


     public function Total_case_view($id = NULL)
     {

         if($id == null)
         {
             redirect('admin/size');
         }
         $data['view_data'] = $this->Case_details_model->find($id);
       
         if(!empty($data['view_data'])){
             $CategoryId=$data['view_data']->case_category_id;
             $where = array();
             $where['id'] = $CategoryId;
             $where['status'] = 1;
             $categoryArray = $this->Case_category_model->findDynamic($where);
            
             if(!empty($categoryArray)){
                 $data['Categoryname'] =  $categoryArray[0]->name;
                
             }
            
            
             $subCategoryId=$data['view_data']->case_sub_category_id;
             $where1 = array();
             $where1['id'] = $subCategoryId;
             $where1['status'] = 1;
             $subcategoryArray = $this->Case_sub_category_model->findDynamic($where1);
             if(!empty($subcategoryArray)){
                 $data['subCategoryname'] =  $subcategoryArray[0]->case_sub_category;
                 
             }
             $subCategoryId=$data['view_data']->case_sub_category_id;
             $where1 = array();
             $where1['id'] = $subCategoryId;
             $where1['status'] = 1;
             $subcategoryArray = $this->Case_sub_category_model->findDynamic($where1);
             if(!empty($subcategoryArray)){
                 $data['subCategoryname'] =  $subcategoryArray[0]->case_sub_category;
                 
             }
             $lawyerId=$data['view_data']->asign_lawyer_id;
             $where2 = array();
             $where2['id'] = $lawyerId;
             $lawyer_detail = $this->lawyer_model->findDynamic($where2);
            
             if(!empty($lawyer_detail)){
                 $data['lawyer_name'] =  $lawyer_detail[0]->fname ." ".$lawyer_detail[0]->lname;
                 
             }
            //  pre($data['subCategoryname'] );
            //  exit();
         }
        
         $this->global['pageTitle'] = 'Insaaf99 : view Client';
         $this->loadViews("client/total_cases/view", $this->global, $data , NULL ,'client');    
         
     }

     public function insertnow()
     {
         
         date_default_timezone_set('Asia/Kolkata');
         $this->isLoggedIn();
         $this->load->library('form_validation');
         $this->form_validation->set_rules('asign_lawyer_id', ' Lawyer name', 'trim|required');
         //form data 
         $form_data = $this->input->post();
         
         if ($this->form_validation->run() == FALSE) {
             $this->addnew();
         } else {
             $insertData                         = array();
             $insertData['case_category_id']     = $form_data['case_category_id'];
             $insertData['case_sub_category_id'] = $form_data['case_sub_category_id'];
             $insertData['asign_lawyer_id']      = $form_data['asign_lawyer_id'];
             $insertData['case_description']     = $form_data['case_description'];
             $insertData['client_id']            = $form_data['client_id'];
             $insertData['status']               = $form_data['status'];
             $insertData['payment']              = '';
             $insertData['payment_status']       = 0;
             $insertData['dt']                   = date("Y-m-d H:i:s");
             
             // upload file
             if (isset($_FILES['case_file']['name']) && $_FILES['case_file']['name'] != '') {
                 
                 $f_name      = $_FILES['case_file']['name'];
                 $f_tmp       = $_FILES['case_file']['tmp_name'];
                 $f_size      = $_FILES['case_file']['size'];
                 $f_extension = explode('.', $f_name);
                 $f_extension = strtolower(end($f_extension));
                 $f_newfile   = uniqid() . '.' . $f_extension;
                 $store       = "uploads/cases/" . $f_newfile;
                 
                 if (!move_uploaded_file($f_tmp, $store)) {
                     $this->session->set_flashdata('error', 'Image Upload Failed .');
                 } else {
                     // $file = "uploads/cases/".$form_data['oldimage'];
                     
                     // if(file_exists( $file))
                     // {
                     //     unlink($file);
                     // }
                     
                     $insertData['case_file'] = $f_newfile;
                     
                 }
                 
             }
             
             $result = $this->Case_details_model->save($insertData);
             if ($result > 0) {
                 $this->session->set_flashdata('success', 'Case added successfully');
                 redirect('admin/Case_details/index/' . $insertData['client_id']);
             } else {
                 $this->session->set_flashdata('error', 'Case  Addition failed');
             }
             redirect('admin/client/addnew');
         }
         
     }
     public function Find_lawyer_data()
     {
        $where=array();
        $where['lawyer_id'] = $_POST['lawyer_id'];
        $where['schedule_status'] =1;

        $schedule_data=$this->Lawyer_scheduler_model->findDynamic($where);
        

        // $res = array('error' => 0,'schedule_data'=>$schedule_data);

                            
        echo json_encode($schedule_data);
        
        // return json_encode($data['lawyer_schedule_data']);
       
     }
     
     
     public function Select_lawyer()
     {

        date_default_timezone_set("Asia/Calcutta");
    
        $form_data = $this->input->post();
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('slot_date', 'slot date', 'trim|required');
        $this->form_validation->set_rules('time', 'Time', 'trim|required');
        $this->form_validation->set_rules('period', 'Period', 'trim|required');
        $this->form_validation->set_rules('contact_mode', 'contact Mode', 'trim|required');
   
        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array(
                'status' => 'true1',
             
            ));
            exit();
        }

        $sql="SELECT * FROM `query` WHERE `id`='".$form_data['query_id']."'";
        $rData = $this->Case_details_model->rawQuery($sql);
        $query_data= $rData[0];
       
        $sql="SELECT * FROM `lawyer` WHERE `id`='".$form_data['lawyer_id']."'";
        $rData = $this->Case_details_model->rawQuery($sql);
        $lawyer_data= $rData[0];

        $sql="SELECT * FROM `clint` WHERE `id`='".$form_data['client_id']."'";
        $rData = $this->Case_details_model->rawQuery($sql);
        $client_data= $rData[0];
           
        $updateData['id']           = $query_data->id;
        $updateData['lawyer_id']    =$form_data['lawyer_id'];
        $updateData['query_status'] =1;
      
        $query_update = $this->Query_model->save($updateData);// Update Query table 

            // +++++++++++++++++++++++++++++++++++++++++
            $insertData                         = array();
            $insertData['case_category_id']     = $form_data['case_cat_id'];
            // $insertData['case_sub_category_id'] = $form_data['case_sub_category_id'];
            $insertData['asign_lawyer_id']      = $form_data['lawyer_id'];
            $insertData['case_description']     = $query_data->query;
            $insertData['client_id']            = $form_data['client_id'];
            $insertData['status']               =1;
            $insertData['payment']              = '';
            $insertData['payment_status']       = 0;
            $insertData['dt']                   = date("Y-m-d H:i:s");
            $insertData['case_file']            =  $query_data->querry_file;
          
            $result = $this->Case_details_model->save($insertData);


            // ====================================================
            $sql="SELECT * FROM `cases`  WHERE `client_id`='".$form_data['client_id']."' ORDER by id DESC LIMIT 1 ";
            $rData1 = $this->Case_details_model->rawQuery($sql);
            $cases_data= $rData1[0];

            $insertData1['lawyer_id']    = $form_data['lawyer_id'];
            $insertData1['client_id']    = $form_data['client_id'];
            $insertData1['case_id']      = $cases_data->id;
            $time                        =$form_data['time'];
            $insertData1['slot_date']    = $form_data['slot_date'];
            $date                        = $form_data['slot_date'];
            $insertData1['time']         = date('h:i:a', strtotime($time)); 
            $meeting_time                = $date . ' ' . $time;
            $insertData1['meeting_time'] = date('Y-m-d H:i:a',strtotime($meeting_time)); 
            $insertData1['period']       = $form_data['period'];
            $insertData1['contact_mode'] = $form_data['contact_mode'];
            $insertData1['slot_status']  = 0;
            $insertData1['dt']           = date("Y-m-d H:i:s");
          
            $result1 = $this->Slot_model->save($insertData1);
  
    
            $lawyer_id 		        = $form_data['lawyer_id'];
            $schedule_date 		    = $form_data['slot_date'];
            $schedule_time 		    = $form_data['time'];
           
     
            $sql  ="UPDATE `lawyer_scheduler` SET `schedule_status`=0 WHERE `lawyer_id`='$lawyer_id' AND `schedule_date`='$schedule_date'  AND `schedule_time`='$schedule_time'";

            $query = $this->db->query($sql);// Updating  lawyer_scheduler table's status
        
            if (!empty($result)) {
                /* send mail for Lawyer to book slot for lawyer */
                $toEmail = $lawyer_data->email; // lawyer email 
                $subject = "Dear Lawyer New case and slot booked";
                $heading="Congratulations! New Case and slot added Successfully";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client_data->fname." ".$client_data->lname."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['slot_date']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['time']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting period : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['period']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Confirme Now </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".base_url()."'></a></span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Regards</td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Team Insaaf99</td>
                    </tr>
                </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);
                
                /* end code for Lawyer to book slot  send email */
                
                /* code for send  mail  to slot booking confirmation for client */
                $toEmail = $client_data->email; // Client email
                $subject = "Slot Booked Successfully";
                $heading="Dear ".$client_data->fname." ".$client_data->lname." your slot booking is now pending in  Insaaf99.com";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer_data->fname.' '.$lawyer_data->lname."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['slot_date']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['time']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting period : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['period']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Process</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'>Pending</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Confirmation mail coming soon!</td>
                    </tr>
                </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);

                $toEmail ="admin@insaaf99.com" ; // Admin email
                $subject = "New case added successfully";
                $heading="Daer Admin New Case Added";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$lawyer_data->fname.' '.$lawyer_data->lname."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$client_data->fname.' '.$client_data->lname."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['slot_date']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['time']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Process</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'>Pending</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Confirmation mail coming soon!</td>
                    </tr>
                </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);

                
                /* end code for send  mail  to slot booking confirmation */
            }

            if ( $query_update AND $result AND $result1  > 0 ) {
                echo json_encode(array(
                    'status' => 'true2',
                    'reload' => base_url('client/Dashboard/index')
                ));
                // $this->session->set_flashdata('error', 'You have successfully Select a lawyer');
                // redirect('client/Dashboard/index/' .$form_data['client_id']);
                
            } else{
                echo json_encode(array(
                    'status' => 'true3',
                    'reload' => base_url('client/Dashboard')
                 
                ));
                // $this->session->set_flashdata('error', 'Failed to  Select a lawyer');
                // redirect('client/Dashboard/index/' .$form_data['client_id']);
              
            }
      
    }


 
}

?>