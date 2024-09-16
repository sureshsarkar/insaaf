<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
// include('zoom/config.php');
// include('zoom/api.php');
use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Hearing_list extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Slot_model');
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Lawyer_model');
        $this->load->model('lawyer/Hearing_date_model');

        
    }

    public function index()
    {

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Slot list';
        $this->loadViews("admin/hearing_list/list", $this->global, NULL, NULL, 'admin');
        
    }
    
    // Member list
    public function ajax_list()
    {
        error_reporting(0);
      
        $sql = "SELECT  *,h.id as h_id,c.fname as c_fname,c.lname as c_lname,l.fname as l_fname,l.lname as l_lname,cc.name as name FROM hearing as h "; 
        $sql .= " JOIN lawyer as l ON l.id = h.lawyer_id "; //Fetch lawyer detail from Lawyer table using Id
        $sql .= " JOIN clint as c ON c.id = h.client_id "; //Fetch client detail from clint table using Id
        $sql .= " JOIN case_category as cc ON cc.id = h.case_cat_id ORDER BY h.id DESC";
        $list= $this->Hearing_date_model->rawQuery($sql);
    // pre($list);
       $subCategoryList = array();
       $data = array();
       $no =(isset($_POST['start']))?$_POST['start']:'';

       foreach ($list as $currentObj) {
           $subCategoryList[$currentObj->id] = $currentObj->sub_case_category_id;
       }
       // save data for parent catelgory list
     
       foreach ($list as $currentObj) {

          

           $temp_date = $currentObj->dt;
           $date_at = date("d-m-Y H:i:s", strtotime($temp_date));
           $no++;
           $row = array();
           $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
           
           $first_name=$currentObj->c_fname;
           $last_name=$currentObj->c_lname;
           $fullname=$first_name.' '. $last_name;
           $row[] = $fullname;

           $first_name=$currentObj->l_fname;
           $last_name=$currentObj->l_lname;
           $fullname1=$first_name.' '. $last_name;
           $row[] = $fullname1;

           if(empty($currentObj->name))
           {
              // echo 'EMPTY';
                $row[]='No Category Assigned';
           }
           else{
              // echo 'NOT EMPTY';
               $row[]=$currentObj->name;
           }
        
           $row[] =$currentObj->hearing_date;
           $row[] =$currentObj->hearing_time;
         
           $row[] = ($currentObj->status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
           $row[] = '<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'admin/Hearing_list/edit/'.$currentObj->h_id.'" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin: 4px 0px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->h_id.'" ><i class="fa fa-trash"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin: 4px 0px;" href="'.base_url().'admin/Hearing_list/view/'.$currentObj->h_id.'" title="view"  data_id="'.$currentObj->h_id.'" ><i class="fa fa-eye"></i></a> ';

           $data[] = $row;
       }
       $output = array(
                       "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                       "recordsTotal" => $this->Hearing_date_model->count_all(),
                       "recordsFiltered" => $this->Hearing_date_model->count_filtered(),
                       "data" => $data,
               );
       //output to json format
       echo json_encode($output);
   }
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
        // get image path 
        $rData = $this->Hearing_date_model->find($id);
        
        $result = $this->Hearing_date_model->delete($id);
        
        if ($result > 0) {
            echo (json_encode(array(
                'status' => TRUE
            )));
        } else {
            echo (json_encode(array(
                'status' => FALSE
            )));
        }
    }
    

      
    public function edit($id = NULL)
    {
        
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/size');
        }
        $data['edit_data']         = $this->Hearing_date_model->find($id);
        $client_id           = $data['edit_data']->client_id;
        $data['client_data'] = $this->Client_model->find($client_id);
        
        $lawyer_id                 = $data['edit_data']->lawyer_id;
        $data['lawyer_data']       = $this->Lawyer_model->find($lawyer_id);
        $this->global['pageTitle'] = 'Insaaf99 : Edit Hearing date';
        $this->loadViews("admin/hearing_list/edit", $this->global, $data, NULL, 'admin');
        
    }
    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        
        date_default_timezone_set('Asia/Kolkata');
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'size Name', 'trim|required');
        //form data 
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            $insertData                = array();
            $insertData['name']        = $form_data['name'];
            $insertData['slot_status'] = $form_data['status'];
            /* $insertData['width'] = $form_data['width'];
            $insertData['height'] = $form_data['height'];*/
            
            // $insertData['sizeCode'] = $form_data['sizeCode'];
            $insertData['date_at'] = date("Y-m-d H:i:s");
            $result                = $this->Slot_model->save($insertData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'size successfully Added');
            } else {
                $this->session->set_flashdata('error', 'size Addition failed');
            }
            redirect('admin/hearing_list/addnew');
        }
        
    }
    
    
    
    
  
    
    // Edit
    
    public function view($id = NULL)
    {
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/hearing_list');
        }
        $sql = "SELECT  *,h.id as h_id, l.fname as l_fname,l.lname as l_lname,c.fname as c_fname,c.lname as c_lname,cc.name,csc.case_sub_category FROM hearing as h"; 
        $sql .= " JOIN lawyer as l ON l.id = h.lawyer_id "; //Fetch lawyer detail from Lawyer table using Id
        $sql .= " JOIN clint as c ON c.id = h.client_id "; //Fetch client detail from clint table using Id
        $sql .= " JOIN cases as ca ON ca.id = h.case_id "; 
        $sql .= " JOIN case_category as cc ON cc.id = h.case_cat_id "; 
        $sql .= " JOIN case_sub_category as csc ON csc.id = h.case_sub_cat_id ";
        $sql .=" WHERE  h.id=$id  ";

        $data['view_data'] = $this->Hearing_date_model->rawQuery($sql);
        // pre(    $data['view_data']);
        // exit();
        $this->global['pageTitle'] = 'Insaaf99 : Slot Data ';
        $this->loadViews("admin/hearing_list/view", $this->global, $data, NULL, 'admin');
        
    }
    
    
    
    
    // Update category*************************************************************
    public function update()
    {
      
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('hearing_date', 'hearing_date', 'trim');
        
        //form data 
        $form_data = $this->input->post();

        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
           
        date_default_timezone_set('Asia/Kolkata');
           
            $insertData['id']                = $form_data['id'];
            $insertData['client_id']         = $form_data['client_id'];
            $insertData['lawyer_id']         = $form_data['lawyer_id'];
            $insertData['case_id']           = $form_data['case_id'];
            $insertData['case_cat_id']       = $form_data['case_cat_id'];
            $insertData['case_sub_cat_id']   = $form_data['case_sub_cat_id'];
            $insertData['hearing_date']      = $form_data['hearing_date'];
            $insertData['hearing_time']      = $form_data['hearing_time'];
            $insertData['status']            = $form_data['status'];
            
        //  pre($insertData);
        //     exit();
            $result = $this->Hearing_date_model->save($insertData);
            // pre($result);
            // exit();
         
            if ($result > 0) {
                
                
                $this->session->set_flashdata('success', ' Hearing date  successfully Updated');
                redirect('admin/Hearing_list/');
            } else {
                
                $this->session->set_flashdata('error', 'Failed to update hearing date ');
            }
            redirect('admin/Hearing_list/edit/' . $insertData['id']);
        }
        
    }

    
    
}

?>