<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Calling extends BaseController
{

//  This is default constructor of the class
   
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/contact_model');
       $this->load->model('admin/calling_model');
       $this->isLoggedSubAdmin();
    }

   
    //  Index Page for this controller.
    public function index()
    {

        
        $this->global['pageTitle'] = 'Insaaf99 : Calling';
        $this->loadViews("sub_admin/calling/list", $this->global, NULL , NULL ,'sub_admin');
    }
    
 
    // Add New 
    public function addnew()
    {
      
        $this->global['pageTitle'] = 'Insaaf99 : Add New calling Data';
        $this->loadViews("sub_admin/calling/addnew", $this->global, NULL , NULL ,'sub_admin');   
    } 

     // Insert Member *************************************************************
     public function insertnow()
     {
         
         $form_data  = $this->input->post();
         $this->load->library('form_validation');            
         $this->form_validation->set_rules('name','name','trim|required');
         $this->form_validation->set_rules('mobile','mobile','trim|required');
         //form data 
       
         if($this->form_validation->run() == FALSE)
         {
             $this->addnew();
         }
         else
         {
            	$leading_date = '';		
            	$folloup_dt = '';								
            	$additional = array();								

            if(isset($form_data['date']) && $form_data['time']){
                $Date         = date("Y-m-d", strtotime($form_data['date']));
                $Time         = date("H:i:s", strtotime($form_data['time']));
                $leading_date =date("Y-m-d H:i:s", strtotime("$Date $Time"));
            }

            if(isset($form_data['next_date']) && $form_data['next_time']){
                $folloupDate = date("Y-m-d", strtotime($form_data['next_date']));
                $folloupTime = date("H:i:s", strtotime($form_data['next_time']));
                $folloup_dt  = date("Y-m-d H:i:s", strtotime("$folloupDate $folloupTime"));
            }
             $additional[1] =array('subject'=>$form_data['subject'],'folloup_dt'=>$folloup_dt,'details'=>$form_data['details'],'added_by'=>$_SESSION['name'],'adding_dt'=>date("Y-m-d H:i:s"),'last_updated'=>date("Y-m-d H:i:s"));

             $insertData['name']     = $form_data['name'];
             $insertData['mobile']     = str_replace(' ', '', $form_data['mobile']);;
             $insertData['email'] = $form_data['email'];
             $insertData['state'] = $form_data['state'];
             $insertData['city'] = $form_data['city'];
             $insertData['email'] = $form_data['email'];
             $insertData['source'] = $form_data['source'];
             $insertData['status']   = $form_data['status'];
             $insertData['leading_date']   = $leading_date;
             $insertData['folloupdate']   = $folloup_dt;
             $insertData['comment']    = $form_data['comment'];
             $insertData['seen']    = 0;
             $insertData['adding_dt'] = date("Y-m-d H:i:s");	
             $insertData['additional']    = json_encode($additional);
        
             $result = $this->calling_model->save($insertData);
      
             if($result > 0)
             {
                 $this->session->set_flashdata('success', 'Follow up successfully Added');
                 redirect('sub_admin/calling');
             }
             else
             { 
                 $this->session->set_flashdata('error', 'Follow up Addition failed');
             }
             redirect('sub_admin/calling/addnew');
           }  
         
     }

    // Member list
    public function ajax_list()
    {  
        error_reporting(0);

		$list =$this->calling_model->get_datatables();
        $cuttentDate = date("Y-m-d");
        $cuttentDate = date(strtotime($cuttentDate));
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
       
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
        
            $followUpDate = (isset($currentObj->folloupdate) && !empty($currentObj->folloupdate))?$currentObj->folloupdate:'';
            $followUpDate = date(strtotime($followUpDate));

            $diff =  $followUpDate - $cuttentDate;
            $new = ($currentObj->seen == 0 && $followUpDate > 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'';
            $diff = ($diff > 0 )?'<span class="badge bg-1 bg-success text-danger blink_now" >Upcomming</span>':'';
            $temp_date = $currentObj->adding_dt;
            $date_at = date("d-m-Y h:i a", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            $row[] = $currentObj->name;
            $row[]=$currentObj->mobile;
            $row[]=$currentObj->state;
            $row[]=  (isset($followUpDate) && $followUpDate > 0)? date("Y-m-d", $followUpDate):'-' ;
            $JsonData = json_decode($currentObj->additional,true);
            $subject = (!empty($JsonData[count($JsonData)]['subject']))? $JsonData[count($JsonData)]['subject']:'' ;
            $row[]=$subject;

            $row[] = $date_at.$new;
            $row[] = '<a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="'.base_url().'sub_admin/calling/edit/'.$currentObj->id.$ppc.'" title="edit"  data_id="'.$currentObj->id.'" ><i class="fa fa-pencil"></i></a>';
            $data[] = $row;
        }
     
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->calling_model->count_all(),
                        "recordsFiltered" => $this->calling_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    public function edit($id = NULL)
    {
        $sql='';
        $sql ="SELECT * FROM calling_data WHERE id = $id";
        
        $data['edit_data'] = $this->calling_model->rawquery($sql);

        // update seen status

        $this->db->update('calling_data',array('seen' => 1));
        $this->db->update('calling_data',array('seen' => 1),'id="'.$id.'"');
        
        $this->global['pageTitle'] = 'Insaaf99 : edit Client';
        $this->loadViews("sub_admin/calling/edit", $this->global, $data , NULL ,'sub_admin');    
        
    }   

     // Insert Member *************************************************************
     public function update()
     {
         
         $form_data  = $this->input->post();
       
         $this->load->library('form_validation');            
         $this->form_validation->set_rules('subject','subject','trim|required');
         //form data 
       
         if($this->form_validation->run() == FALSE)
         {
             $this->addnew();
         }
         else
         {

            	$folloup_dt = '';								

            if(isset($form_data['next_date']) && $form_data['next_time']){
                $folloupDate = date("Y-m-d", strtotime($form_data['next_date']));
                $folloupTime = date("H:i:s", strtotime($form_data['next_time']));
                $folloup_dt  = date("Y-m-d H:i:s", strtotime("$folloupDate $folloupTime"));
            }
	        $getDataById =  $this->calling_model->find($form_data['id']);

            $jsonData = json_decode($getDataById->additional,true);
            
             $additional =array('subject'=>$form_data['subject'],'folloup_dt'=>$folloup_dt,'details'=>$form_data['details'],'added_by'=>$_SESSION['name'],'adding_dt'=>date("Y-m-d H:i:s"),'last_updated'=>date("Y-m-d H:i:s"));
             $jsonData[count($jsonData)+1] = $additional;
             
             $updatetData['id']    = $form_data['id'];
             $updatetData['folloupdate']    = $folloup_dt;
             $updatetData['additional']    = json_encode($jsonData);
             $updatetData['seen']          = 0;
             $updatetData['status']          = 1;	
            $result = $this->calling_model->save($updatetData);

             if($result > 0)
             {
                 $this->session->set_flashdata('success', 'Follow up successfully Added');
                 redirect('sub_admin/calling');
             }
             else
             { 
                 $this->session->set_flashdata('error', 'Follow up Addition failed');
             }
             redirect('sub_admin/calling/edit');
           }  
         
     }

     public function newUpdate(){
        if(isset($_POST) && !empty($_POST)){
        
        $w['id']=$_POST['id'];
        $w['field']="additional";
        $additional= $this->calling_model->finddynamic($w);
        $additional = json_decode($additional[0]->additional,true);

        $i=0;
        foreach ($additional as $key => $value) {
            $i++;
            if($i == $_POST['count']){
                $additional[$_POST['count']]['details']=$_POST['details'];
                $additional[$_POST['count']]['added_by']= $_SESSION['name'];
                $additional[$_POST['count']]['last_updated']= date("Y-m-d H:i:s");
            }
        }

        $updateData['id']=$_POST['id'];
        $updateData['additional']=json_encode($additional);
  
         $result =  $this->calling_model->save($updateData);
        if($result > 0){
            echo 1;
            exit();
        }
     }
     }

    
}

?>