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
class Slot_list extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Slot_model');
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Lawyer_model');
        $this->load->model('admin/Query_model');
        
    }

    public function index()
    {
      
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Slot list';
        $this->loadViews("admin/slot_list/list", $this->global,NULL , NULL, 'admin');
        
    }
    
     // Member list
     public function ajax_list()
     {
    
        error_reporting(0);

        $list = $this->Slot_model->get_datatables();


        $subCategoryList = array();
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

        foreach ($list as $currentObj) {
            $subCategoryList[$currentObj->id] = $currentObj->sub_case_category_id;
        }
        
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            // pre($currentObj);
            $temp_date = $currentObj->dt;
            $date_at =$temp_date;// date("d-m-Y H:i:s", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = '<span class="btn-primary  btn12  badge">'.$no.'</span>';
            
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
            $row[] =$currentObj->slot_date;
            $row[] =$currentObj->time;
            $row[] =$currentObj->period;
            $row[] =$date_at;
          

            $status1='';

            if($currentObj->slot_status==1){
                $status1 = '<span class="btn-success badge">Active</span>';
            }
          elseif($currentObj->slot_status==2){
                $status1 = '<span class="btn-primary  badge">Decline</span>';

            }else{
                $status1 = '<span class="btn-warning  badge">Pending</span>';
            }
            $row[]=$status1;
            // $row[] = ($currentObj->slot_status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';

            $row[] = '<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'admin/Slot_list/edit/'.$currentObj->slot_id.'" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin: 4px 0px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->slot_id.'" ><i class="fa fa-trash"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin: 4px 0px;" href="'.base_url().'admin/Slot_list/view/'.$currentObj->slot_id.'" title="view"  data_id="'.$currentObj->slot_id.'" ><i class="fa fa-eye"></i></a> ';

            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->Slot_model->count_all(),
                        "recordsFiltered" => $this->Slot_model->count_filtered(),
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
        $rData = $this->Slot_model->find($id);
        
        $result = $this->Slot_model->delete($id);
        
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
    
   
     
    public function view($id = NULL)
    {
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/slot_list');
        }
        $sql = "SELECT  *, l.fname as l_fname,l.lname as l_lname,c.fname as c_fname,c.lname as c_lname,cc.name FROM slot as s"; 
        $sql .= " JOIN lawyer as l ON l.id = s.lawyer_id "; //Fetch lawyer detail from Lawyer table using Id
        $sql .= " JOIN clint as c ON c.id = s.client_id "; //Fetch client detail from clint table using Id
        $sql .= " JOIN cases as ca ON ca.id = s.case_id "; 
        $sql .= " JOIN case_category as cc ON cc.id = ca.case_category_id "; 
        $sql .=" WHERE  s.id=$id  ";

        $data['view_data'] = $this->Slot_model->rawQuery($sql);
       
        $query_id           = $data['view_data'][0]->query_Id;
        $data['query_data'] = $this->Query_model->find($query_id);

        $this->global['pageTitle'] = 'Insaaf99 : Slot Data ';
        $this->loadViews("admin/slot_list/view", $this->global, $data, NULL, 'admin');
        
    }
    
    
    
    public function edit($id = NULL)
    {
        
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/size');
        }
        $data['edit_data']         = $this->Slot_model->find($id);
        $client_id           = $data['edit_data']->client_id;
        $data['client_data'] = $this->Client_model->find($client_id);

        $query_id           = $data['edit_data']->query_Id;
        $data['query_data'] = $this->Query_model->find($query_id);

        $lawyer_id                 = $data['edit_data']->lawyer_id;
        $data['lawyer_data']       = $this->Lawyer_model->find($lawyer_id);
      
        $this->global['pageTitle'] = 'Insaaf99 : Edit size';
        $this->loadViews("admin/slot_list/edit", $this->global, $data, NULL, 'admin');
        
    }
    
   
    
    // Update category*************************************************************
    public function update()
    {
      
        date_default_timezone_set('Asia/Kolkata');
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('slot_status', 'Status', 'trim');
        
        //form data 
        $form_data = $this->input->post();
        // pre( $form_data);
        // exit();
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
           
            $insertData['id']           = $form_data['id'];
            $insertData['client_id']    = $form_data['client_id'];
            $insertData['slot_date']    = $form_data['slot_date'];
            $insertData['time']         = $form_data['time'];
            $insertData['period']       = $form_data['period'];
            $insertData['lawyer_id']    = $form_data['lawyer_id'];
            $insertData['contact_mode'] = $form_data['contact_mode'];
            $insertData['reply']        = $form_data['reply'];
            $insertData['slot_status']  = $form_data['slot_status'];
    
            
            $result = $this->Slot_model->save($insertData);
            // pre($result);
            // exit();
          
            if ($result > 0) {
                
                $this->session->set_flashdata('success', ' Slot successfully Updated');
                redirect('admin/Slot_list');
            } else {
                
                $this->session->set_flashdata('error', 'Please Select a Valid date to ctrate zoom meeting');
            }
            redirect('admin/slot_list/edit/' . $insertData['id']);
        }
        
    }

   
}

?>