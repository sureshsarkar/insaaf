<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Tempdata extends BaseController
{

//  This is default constructor of the class
   
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/contact_model');
    //    $this->load->model('admin/campan_model');
       $this->load->model('front/campan_model');
    //    $this->isLoggedIn();
    }

   
    //  Index Page for this controller.
    public function index()
    {   

      $query =  $this->db->from("campan")->where('tempData !=', null)->where('seen =', 0)->get();
       $get_tem= $query->result();
            if(isset($get_tem) && !empty($get_tem)){
                $count = count($get_tem);
            }else{
                $count = 0;
            }

        $this->global['pageTitle'] = 'Insaaf99 : Calling ('.$count.')';
        $this->loadViews("admin/tempdata/list", $this->global, NULL , NULL ,'admin');

    }
    
 
    // Add New 
    public function addnew()
    {
      
        $this->global['pageTitle'] = 'Insaaf99 : Add New tempdata Data';
        $this->loadViews("admin/tempdata/addnew", $this->global, NULL , NULL ,'admin');   
    } 

     // Insert Member *************************************************************
     public function insertnow()
     {
         
         $form_data  = $this->input->post();
// pre($form_data);
// exit();
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
        
             $result = $this->campan_model->save($insertData);
      
             if($result > 0)
             {
                 $this->session->set_flashdata('success', 'Follow up successfully Added');
                 redirect('admin/tempdata');
             }
             else
             { 
                 $this->session->set_flashdata('error', 'Follow up Addition failed');
             }
             redirect('admin/tempdata/addnew');
           }  
         
     }

    
    // delete tempdata row 
    public function delete()
    {
        // define path for file location 
       
        $id = $_POST['id'];
        // get image path 
        
        $result = $this->campan_model->delete($id);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }
    // end tempdata row 
  

    // Member list
    public function ajax_list()
    {  
        error_reporting(0);
		$list =$this->campan_model->get_datatables();
        $cuttentDate = date("Y-m-d");
        $cuttentDate = date(strtotime($cuttentDate));
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
      
       
        // save data for parent catelgory list
        foreach ($list as $currentObj) {
            if(isset($currentObj->tempData) && $currentObj->tempData !=""){
         $tempData = json_decode($currentObj->tempData);
         $name = $tempData->name;
         $mobile = $tempData->mobile;
         $state = $tempData->state;
         $city = $tempData->city;


         // get uri parms
         if(isset($currentObj->current_slug) && !empty($currentObj->current_slug)){
            $parts = parse_url($currentObj->current_slug);
            parse_str($parts['query'], $utm);
        }
        $adPosition = (isset($utm) && isset($utm['adposition']))?"|".$utm['adposition']:'';

         $category = $tempData->category;
         if(isset($category) && !empty($category)){
             $categoryData = $this->Case_category_model->find($category);
            $categoryName = $categoryData->name;
        }else{
            $categoryName = "";
         }
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now seenNew" data-id="'.$currentObj->id.'">New</span>':'';

            $temp_date = $currentObj->created_at;
            $date_at = date("d-m-Y h:i a", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<input type="checkbox" name="checkbox" class="checkbox" value="'.$currentObj->id.'">';
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            $row[]= (isset($name))?$name:"";
            $row[]= (isset($mobile))?$mobile:"";
            $row[]= (isset($categoryName))?$categoryName:"";
            $row[]=$state;
            $row[]=$city;
            $row[]=$currentObj->device;
            $row[]=$currentObj->network;
            $row[]=$currentObj->type." | ".$currentObj->keyword." | ".$currentObj->camp_id.$adPosition;
            $row[]=$currentObj->feedback;

            $row[] = $date_at.$new;
            $row[] = '<a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="'.base_url().'admin/tempdata/view/'.$currentObj->id.'" title="edit"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a>&nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> ';
            $data[] = $row;
        }
        }
     
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->campan_model->count_all(),
                        "recordsFiltered" => $this->campan_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    public function view($id = NULL)
    {
        $w['id'] = $id;
        $w['seen'] = 1;
         $this->campan_model->save($w);
        $data['view_data'] = $this->campan_model->find($id);
       
        $category = $this->Case_category_model->all();
        $data['category_id'] = $category;

        $this->global['pageTitle'] = 'Insaaf99 : edit Client';
        $this->loadViews("admin/tempdata/view", $this->global, $data , NULL ,'admin');    
        
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
	        $getDataById =  $this->campan_model->find($form_data['id']);

            $jsonData = json_decode($getDataById->additional,true);
            
             $additional =array('subject'=>$form_data['subject'],'folloup_dt'=>$folloup_dt,'details'=>$form_data['details'],'added_by'=>$_SESSION['name'],'adding_dt'=>date("Y-m-d H:i:s"),'last_updated'=>date("Y-m-d H:i:s"));
             $jsonData[count($jsonData)+1] = $additional;
             
             $updatetData['id']    = $form_data['id'];
             $updatetData['folloupdate']    = $folloup_dt;
             $updatetData['additional']    = json_encode($jsonData);
             $updatetData['seen']          = 0;
             $updatetData['status']          = 1;	
            $result = $this->campan_model->save($updatetData);

             if($result > 0)
             {
                 $this->session->set_flashdata('success', 'Follow up successfully Added');
                 redirect('admin/tempdata');
             }
             else
             { 
                 $this->session->set_flashdata('error', 'Follow up Addition failed');
             }
             redirect('admin/tempdata/edit');
           }  
         
     }

     public function newUpdate(){
        if(isset($_POST) && !empty($_POST)){
        
        $w['id']=$_POST['id'];
        $w['field']="additional";
        $additional= $this->campan_model->finddynamic($w);
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
  
         $result =  $this->campan_model->save($updateData);
        if($result > 0){
            echo 1;
            exit();
        }
     }
     }


     // functio to detele multiple 

      // delete contact row 
    public function deleteByCheck()
    {
        // define path for file location 
        $this->isLoggedIn();
        $allVals = $_POST['allVals'];
        // get image path 
        $this->db->where_in('id', $allVals);	
        $delete = $this->db->delete('campan');
        echo $delete;
        exit();
    }

    // end contact row 

      // delete contact row 
    public function addFeed()
    {
        // define path for file location 
        // $this->isLoggedIn();
        $data['id'] = $_POST['id'];
        $data['feedback'] = $_POST['feed'];
        // get image path 
         $result =  $this->campan_model->save($data);
         echo 1;
        exit();
    }

    // end contact row 

    
}

?>