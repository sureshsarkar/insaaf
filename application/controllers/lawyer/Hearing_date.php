<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Hearing_date extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('lawyer/Slot_model');
       $this->load->model('lawyer/Hearing_date_model');
       $this->load->model('admin/Case_details_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Case_sub_category_model');
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Lawyer_model');
    
    }

    /**
     * Index Page for this controller.
     */
    public function index($id = NULL)
    {  
        $id=base64_decode($id);
        $data['lawyer_id']=$id;
   
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Total Details';
        $this->loadViews("lawyer/hearing_date/list", $this->global, $data , NULL ,'lawyer');
        
    }
    
    // Add New 

    public function addnew($case_id=NULL)
    {
        $where=array();
        $where['id']=$case_id;
        $data['case_id']=$case_id;

        $case_detail=$data['case_detail']=$this->Case_details_model->findDynamic($where);
        $data['case_detail']=$case_detail;
        if(!empty($case_detail)){
            foreach($case_detail as $case){
               $client_id=$case->client_id;
               $where1['id']= $client_id;
               $client_name=$this->Client_model->findDynamic($where1);
               $data['client_name']=$client_name;
            }
        }
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("lawyer/hearing_date/addnew", $this->global, $data , NULL ,'lawyer');   
    } 
    // Add New 

    public function Complane($case_id=NULL)
    {  
        $where=array();
        $where['id']=$case_id;
        $list=$this->Case_details_model->findDynamic($where);

        $sql = "SELECT  cl.fname , cl.lname ,cc.name,csc.case_sub_category ,cl.mobile,cl.email,l.id as lawyer_id,l.fname as l_fname,l.lname as l_lname,l.email as l_email,l.mobile as l_mobile ,c.id as case_id FROM cases as c"; 
        $sql .= " JOIN case_category as cc ON cc.id = c.case_category_id "; //Fetch case category detail from case_category table using Id
        $sql .= " JOIN case_sub_category as csc ON csc.id = c.case_sub_category_id "; //Fetch sub_category detail from  case_sub_category table using Id
        $sql .= " JOIN clint as cl ON cl.id = c.client_id "; //Fetch client detail from clint table using Id
        $sql .= " JOIN lawyer as l ON l.id = c.asign_lawyer_id "; //Fetch client detail from clint table using Id
        $sql .= "WHERE c.id = $case_id";
        $data1['detail'] = $this->Case_details_model->rawQuery($sql);
        if(!empty($data1['detail'])){
            foreach($data1['detail'] as $value){
                $data['detail']=$value;
            }
        }
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("lawyer/hearing_date/complane", $this->global, $data , NULL ,'lawyer');   
    } 

     public function Complane_mail()
    {
    
        date_default_timezone_set('Asia/Kolkata'); 
        $this->isLawyerLoggedIn();
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('query','Query','trim|required'); 
        //form data 
        $form_data  = $this->input->post();
        if($this->form_validation->run() == FALSE)
        {
         
       
            $this->Complane($form_data['case_id']);
        }
       
        else
        {

        // pre( $form_data);
        // exit();
            $insertData = array();
            $insertData['client_name']         = $form_data['client_name'];
            $insertData['lawyer_name']         = $form_data['lawyer_name'];
            $insertData['case_cat']            = $form_data['case_cat'];
            $insertData['case_sub_cat']        = $form_data['case_sub_cat'];
            $insertData['client_mobile']       = $form_data['client_mobile'];
            $insertData['client_email']        = $form_data['client_email'];
            $insertData['lawyer_email']        = $form_data['lawyer_email'];
            $insertData['lawyer_mobile']       = $form_data['lawyer_mobile'];
            $insertData['query']               = $form_data['query'];


                /* send mail for Lawyer to sent zoom meeting link */

                   $toEmail = "admin@insaaf99.com "; // admin email 
                   $subject = "Lawyer's Complane query";
                   $heading="Lawyer Complane query for client behaviour";
                
                $content="
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Case Category:</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['case_cat']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name :</td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['client_name']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Email : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['client_email']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Mobile : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['client_mobile']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['lawyer_name']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Email : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['lawyer_email']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Mobile : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['lawyer_mobile']."</span></td>
                    </tr>
                </div>
                <div style='margin-top:1px;'>
                    <tr>
                    <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query : </td>
                    <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertData['query']."</span></td>
                    </tr>
                </div>
              ";
               
               $message=get_email_temp($heading,$content);
               $this->send_email($toEmail, $subject, $message);


                    if(!empty($result)){
                        $this->session->set_flashdata('success', ' Your query sent  successfully into insaaf99');
                        redirect('lawyer/Lawyer_cases/view/'.$form_data['case_id']);
                    }else{
                        $this->session->set_flashdata('error', '  Failed send query');
                        redirect('lawyer/hearing_date/Complane/'.$form_data['case_id']);
                    }
    }
    }

    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLawyerLoggedIn();
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
        $this->isLawyerLoggedIn();
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('client_id','client_id','trim|required'); 
        //form data 
        $form_data  = $this->input->post();
        
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {
            $insertData = array();
            $insertData['client_id']         = $form_data['client_id'];
            $insertData['lawyer_id']         = $form_data['lawyer_id'];
            $insertData['hearing_date']      = $form_data['hearing_date'];
            $insertData['hearing_time']      = date('h:i:a', strtotime($form_data['hearing_time']));
            $insertData['case_id']           = $form_data['case_id'];
            $insertData['case_cat_id']       = $form_data['case_cat_id'];
            $insertData['case_sub_cat_id']   = $form_data['case_sub_cat_id'];
            $insertData['status']            = $form_data['status'];
            $insertData['dt']                = date("Y-m-d H:i:s");	
        
            $result = $this->Hearing_date_model->save($insertData);
         
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Hearing date successfully Added');
                redirect('lawyer/Hearing_date/index/'.$insertData['lawyer_id']);
            }
            else
            { 
                $this->session->set_flashdata('error', 'Hearing date Addition failed');
                redirect('lawyer/hearing_date/addnew/'.$insertData['case_id']);
            }
            
          }  
        
    }

    // Member list
    public function ajax_list($lawyer_id=NULL)
    {  
       error_reporting(0);
         $where['lawyer_id'] = $lawyer_id;
        //  $sql = "SELECT  * FROM slot "; 
        //  $sql .=" WHERE `lawyer_id`='".$id."' ORDER BY id DESC";
        //  $list= $this->Hearing_date_model->rawQuery($sql);

         $list=$this->Hearing_date_model->findDynamic($where);
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y", strtotime($temp_date));
            $time_at = date("H:i:s", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';

            $client_id=$currentObj->client_id;
            $client=$this->Client_model->find($client_id);
            $first_name=$client->fname;
            $last_name=$client->lname;
            $fullname=$first_name.' '. $last_name;
            $row[] = $fullname;
            
            $lawyer_id=$currentObj->lawyer_id;
            $lawyer=$this->Lawyer_model->find($lawyer_id);
            $first_name=$lawyer->fname;
            $last_name=$lawyer->lname;
            $fullname1=$first_name.' '. $last_name;
            $row[] = $fullname1;

            $case_category_id=$currentObj->case_cat_id;
            $cat_name=$this->Case_category_model->find($case_category_id);
            $case_cat_name=$cat_name->name;
            $row[]=$case_cat_name;
            
            $row[] = $currentObj->hearing_date;
            $row[] = $currentObj->hearing_time;
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">Pending</span>';
            $row[] = $date_at.'/'.$time_at;
            
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px" href="'.base_url().'lawyer/hearing_date/edit/'.base64_encode($currentObj->id).'" title="Edit" ><i class="fa fa-pencil"></i></a>  ';
            
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


     

    public function view($id = NULL)
    {
        
        $this->isLawyerLoggedIn();
        if($id == null)
        {
            redirect('admin/size');
            
        }
        $data['view_data'] = $this->Case_details_model->find($id);
        $cat_id=$data['view_data']->case_category_id;
        $case_cat_name1=$this->Case_category_model->find($cat_id);
        $data['case_cat_name1']=$case_cat_name1;

        $sub_cat_id=$data['view_data']->case_sub_category_id;
        $case_sub_cat_name1=$this->Case_sub_category_model->find($sub_cat_id);
        $data['case_sub_cat_name1']=$case_sub_cat_name1;

        $client_id=$data['view_data']->client_id;
        $client_name=$this->Client_model->find($client_id);
        $data['client_name']=$client_name;
        
        $this->global['pageTitle'] = ' View case';
        $this->loadViews("lawyer/hearing_date/view", $this->global, $data , NULL,'lawyer');    
        
    } 

    // Edit
 
    public function edit($id = NULL)
    {
        $id=base64_decode($id);
        $this->isLawyerLoggedIn();
        if($id == null)
        {
            redirect('lawyer/hearing_date');
        }
        
        $data['edit_data'] = $this->Hearing_date_model->find($id);
        $client_id=$data['edit_data']->client_id;
        $data['client_name'] = $this->Client_model->find($client_id);
        $this->global['pageTitle'] = 'Insaaf99 : Slot Data ';
        $this->loadViews("lawyer/hearing_date/edit", $this->global, $data , NULL,'lawyer');    
    }

    // Update *************************************************************
    public function update()
    {
        $this->isLawyerLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('hearing_date','hearing date','trim|required');
        $this->form_validation->set_rules('hearing_time','hearing time','trim|required');
        $this->form_validation->set_rules('status','Status','trim');
        
      
        $form_data  = $this->input->post();
 
        if($this->form_validation->run() == FALSE)
        {
			
                $this->edit($form_data['id']);
        }
        else
        {
           
            $insertData['id']            = $form_data['id'];
            $insertData['hearing_date']  = $form_data['hearing_date'];
            $insertData['hearing_time']  = $form_data['hearing_time'];
            $insertData['status']        = $form_data['status'];
           
            $result = $this->Hearing_date_model->save($insertData);
           
            if($result > 0)
            {
                
         
                $this->session->set_flashdata('success', ' Slot successfully Updated');
                redirect('lawyer/Hearing_date/index/'.base64_encode($form_data['lawyer_id']));
            }
            else
            { 
               
                $this->session->set_flashdata('error', 'Category Updation failed');
            }
            redirect('lawyer/Hearing_date/edit/'.base64_encode($insertData['id']));
          }  
        
    } 
    
}

?>