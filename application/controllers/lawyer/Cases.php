<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Cases extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('lawyer/Slot_model');
       $this->load->model('lawyer/case_details_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Case_sub_category_model');
       $this->load->model('admin/Client_model');
       // $this->load->model('admin/case_details_model');
    
    }

    /**
     * Index Page for this controller.
     */
    public function index($id = NULL)
    {  
        $id=$_SESSION['id'];
        $data['lawyer_id']=$id;
   
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Total Details';
        $this->loadViews("lawyer/lawyer_cases/list", $this->global, $data , NULL ,'lawyer');
        
    }
    public function runing_cases($id = NULL)
    {  
        // pre($id);
        // exit();
        $data['lawyer_id']=$id;
   
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Total Details';
        $this->loadViews("lawyer/runing_cases/list", $this->global, $data , NULL ,'lawyer');
        
    }
    
    // Add New 

    public function addnew()
    {
        $data['parent_list'] = $this->Slot_model->getparent_id();
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("lawyer/slot/addnew", $this->global, $data , NULL);   
    } 

     // Add New 

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
            redirect('lawyer/slot/addnew');
          }  
        
    }

   

    // Member list
    public function ajax_list($id=NULL)
    {  
         error_reporting(0);
         $where['asign_lawyer_id'] = $id;
        //  $list=$this->case_details_model->findDynamic($where);

         // $sql = "SELECT  * FROM cases "; 
         // $sql .=" WHERE `asign_lawyer_id`='".$id."' ORDER BY id DESC";
         // $list= $this->case_details_model->rawQuery($sql);
         $list = $this->case_details_model->get_datatables();
         // echo count($list);
		$data = array(); 
        $no =(isset($_POST['start']))?$_POST['start']:'';

        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $new = ($currentObj->lawyer_case_noti == 0)?'<span class="badge btn-primary bg-1 text-danger blink_now" >New</span>':'-';

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

            $case_category_id=$currentObj->case_category_id;
            $cat_name=$this->Case_category_model->find($case_category_id);
            $case_cat_name=$cat_name->name;
            $row[]=$case_cat_name;
            $row[]=$client->client_unique_id;

            // $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Approved</span>':'<span class="btn-danger badge">Pending</span>';
            $row[] = ($currentObj->status == 1)?"<small class='badge btn-success text-success text-bold'>Active</small>":"<small class='badge btn-danger text-danger text-bold'>Pending</small>";
            $row[]=$new;
            $row[] = $date_at.'/'.$time_at;
            
            $row[] = ' <a class="btn btn-sm btn-info " style="margin: 4px 0px" href="'.base_url().'lawyer/cases/view/'.base64_encode($currentObj->id).'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
            
            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->case_details_model->count_all(),
                        "recordsFiltered" => $this->case_details_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    // Member list
    public function ajax_list1($id=NULL)
    {  
         error_reporting(0);
        //  $where['asign_lawyer_id'] = $id;
        //  $where['status'] = 1;
        //  $list=$this->case_details_model->findDynamic($where);

         $sql = "SELECT  * FROM cases "; 
         $sql .=" WHERE `asign_lawyer_id`='".$id."' AND `status`=1 ORDER BY id DESC";
         $list= $this->case_details_model->rawQuery($sql);

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

            $case_category_id=$currentObj->case_category_id;
            $cat_name=$this->Case_category_model->find($case_category_id);
            $case_cat_name=$cat_name->name;
            $row[]=$case_cat_name;
            
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Approved</span>':'<span class="btn-danger badge">Pending</span>';
            $row[] = $date_at.'/'.$time_at;
            
            $row[] = ' <a class="btn btn-sm btn-info " style="margin: 4px 0px" href="#" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
            // $row[] = ' <a class="btn btn-sm btn-info " style="margin: 4px 0px" href="'.base_url().'lawyer/Lawyer_cases/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
            
            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->case_details_model->count_all(),
                        "recordsFiltered" => $this->case_details_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


     

    public function view($id = NULL)
    {

        $id=base64_decode($id);
        $this->isLawyerLoggedIn();
        if($id == null)
        {
            redirect('admin/size');
            
        }
        // update lawyer_meeting_noti status
        $this->case_details_model->save(array('id'=> $id,'lawyer_case_noti'=>1));

        $data['case_id']=$id;
        $data['view_data'] = $this->case_details_model->find($id);
        $cat_id=$data['view_data']->case_category_id;
        $case_cat_name1=$this->Case_category_model->find($cat_id);
        $data['case_cat_name1']=$case_cat_name1;

        $sub_cat_id=$data['view_data']->case_sub_category_id;
        $case_sub_cat_name1=$this->Case_sub_category_model->find($sub_cat_id);
        $data['case_sub_cat_name1']=$case_sub_cat_name1;

        $client_id=$data['view_data']->client_id;
        $client_name=$this->Client_model->find($client_id);
        $data['client_name']=$client_name;

     //  pre($data['case_sub_cat_name1']);
        //  exit();
        $this->global['pageTitle'] = ' View case';
        $this->loadViews("lawyer/lawyer_cases/view", $this->global, $data , NULL,'lawyer');    
        
    } 

    // Edit
 
    public function edit($id = NULL)
    {
        
        $this->isLawyerLoggedIn();
        if($id == null)
        {
            redirect('lawyer/slot');
        }
        $data['edit_data'] = $this->Slot_model->find($id);

        $client_id=$data['edit_data']->client_id;
        $data['client_data'] = $this->Client_model->find($client_id);
        $this->global['pageTitle'] = 'Insaaf99 : Slot Data ';
        $this->loadViews("lawyer/slot/edit", $this->global, $data , NULL,'lawyer');    
        
    }

    // Update category*************************************************************
    public function update()
    {
 
        $this->isLawyerLoggedIn();
        $this->load->library('form_validation');            
        // $this->form_validation->set_rules('fname','fname','trim|required');
        $this->form_validation->set_rules('status','Status','trim');
        
        //form data 
        $form_data  = $this->input->post();
 
        if($this->form_validation->run() == FALSE)
        {
			
                $this->edit($form_data['id']);
        }
        else
        {
           
            $insertData['id'] = $form_data['id'];
            $insertData['client_id'] = $form_data['client_id'];
            $insertData['slot_date'] = $form_data['slot_date'];
            $insertData['time'] = $form_data['time'];
            $insertData['period'] = $form_data['period'];
            $insertData['lawyer_id'] = $form_data['lawyer_id'];
            $insertData['contact_mode'] = $form_data['contact_mode'];
            $insertData['reply'] = $form_data['reply'];
            $insertData['status'] = $form_data['status'];
           
        
            $result = $this->Slot_model->save($insertData);
         
            if($result > 0)
            {
                
         
                $this->session->set_flashdata('success', ' Slot successfully Updated');
                redirect('lawyer/slot/index/'.$form_data['lawyer_id']);
            }
            else
            { 
               
                $this->session->set_flashdata('error', 'Category Updation failed');
            }
            redirect('lawyer/slot/edit/'.$insertData['id']);
          }  
        
    }

   // Send Case document by lawyer 
    public function Send_case_document()
    {
        
        date_default_timezone_set('Asia/Kolkata');         
           $form_data  = $this->input->post();
       
           $this->form_validation->set_rules('client_Id','client_Id','trim');
 
        //    $sql = "SELECT case_file FROM clint WHERE `id`='".$form_data['client_Id']."'"; 
          
 
        //    $dbData = $this->Client_model->rawQuery($sql);// Fetch data from client table
        //    $client_data = $dbData[0];
           $client_data = $form_data['old_case_file'];
        
           if($this->form_validation->run() == FALSE)
           {
               
                   $this->index($form_data['client_Id']);
           }
           else
           {
             
             $insertData['id'] =$form_data['case_Id'];
             $insertData['client_id'] =$form_data['client_Id'];
             $insertData['asign_lawyer_id'] =$form_data['lawyer_Id'];
             $date = date("Y-m-d H:i:s");	
        
             
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
 
                     $tempData = $client_data;
                     $insertData['case_file'] = empty($tempData)?$f_newfile:$tempData.",".$f_newfile;

                 }
                     
             }
             
               $result = $this->case_details_model->save($insertData);
   
               if($result > 0)
               {
                 $this->session->set_flashdata('success', ' Your Document added successfully');
                 redirect('lawyer/cases/view/'.$form_data['case_Id']);
               }
               else
               { 
                 $this->session->set_flashdata('error', '  Failed  to add document');
                 redirect('lawyer/cases/view/'.$form_data['case_Id']);
               }
             }  
           
         }

    
    
    
}

?>