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
       $this->load->model('client/Case_details_model');
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
        $data['case_category1']=$this->Case_category_model->all();
        $data['client_id']=$id;
        $this->isUserLoggedIn();
        $this->global['pageTitle'] = 'Total Details';
        $this->loadViews("client/hearing_date/list", $this->global, $data , NULL ,'client');
        
    }
   
    // end category 
    

    // Member list
    public function ajax_list($client_id=NULL)
    {  
         $where['client_id'] = $client_id;
         $list=$this->Hearing_date_model->findDynamic($where);
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y H:i:s", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';
            
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
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">Pending</span>';
            $row[] = $date_at;
            
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px;" href="'.base_url().'client/hearing_date/view/'.$currentObj->id.'" title="Edit" ><i class="fa fa-eye"></i></a>  ';
            
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
        $this->isUserLoggedIn();
        if($id == null)
        {
            redirect('admin/size');
            
        }
        $data['view_data'] = $this->Hearing_date_model->find($id);

        $cat_id=$data['view_data']->case_cat_id;
        $case_cat_name=$this->Case_category_model->find($cat_id);
        $data['case_cat_name']=$case_cat_name;

        $sub_cat_id=$data['view_data']->case_sub_cat_id;
        $case_sub_cat_name=$this->Case_sub_category_model->find($sub_cat_id);
        $data['case_sub_cat_name']=$case_sub_cat_name;

        $lawyer_id=$data['view_data']->lawyer_id;
        $lawyer_name=$this->Lawyer_model->find($lawyer_id);
        $data['lawyer_name']=$lawyer_name;

        $this->global['pageTitle'] = ' View case';
        $this->loadViews("client/hearing_date/view", $this->global, $data , NULL,'client');    
        
    } 

   // Case notification  *************************************************************
   public function Hearing_notify()
   {
       
          $form_data  = $this->input->post();

           $data = array(
            'client_hearing_noti' => '1',
           );
        $result=$this->db->update('hearing',$data,'client_id="'.$form_data['client_id'].'" AND client_hearing_noti=0');
        
        
           if(!empty($result))
           {
                echo json_encode(array(
                    'status' => 'true',
                    'reload' => base_url('client/Hearing_date/index/' .base64_encode($form_data['client_id']))
                ));
           }
           else
           { 
               echo json_encode(array(
                  'status' => 'true1',
                  'reload' => base_url('client/Hearing_date/index/' .base64_encode($form_data['client_id']))
               ));
           }
          
    }
   
    
}

?>