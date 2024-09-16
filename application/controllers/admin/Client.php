<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Client extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/case_details_model');
       $this->load->model('admin/Case_sub_category_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Cleint';
        $this->loadViews("admin/client/list", $this->global, NULL , NULL ,'admin');
        
    }
    
    // Add New 

    public function addnew()
    {
        $data['parent_list'] = $this->Client_model->getparent_id();
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Client';
        $this->loadViews("admin/client/addnew", $this->global, $data , NULL ,'admin');   
    } 
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id = $_POST['id'];
        // get image path 
        $rData = $this->Client_model->find($id);
        
        $result = $this->Client_model->delete($id);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        date_default_timezone_set('Asia/Kolkata'); 
        $this->isLoggedIn();
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
            $result = $this->Client_model->save($insertData);
            
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'size successfully Added');
            }
            else
            { 
                $this->session->set_flashdata('error', 'size Addition failed');
            }
            redirect('admin/client/addnew');
          }  
        
    }

    // Member list
    public function ajax_list()
    {  
        error_reporting(0);

		$list =$this->Client_model->get_datatables();
    
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

       
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'';
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y h:i a", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<input type="checkbox" name="checkbox" class="checkbox" value="'.$currentObj->id.'">';
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            $first_name=$currentObj->fname;
            $last_name=$currentObj->lname;
            $fullname=$first_name.' '. $last_name;
            $row[] = $fullname;
            $row[]=$currentObj->client_unique_id;
            $row[]=$currentObj->mobile;
            $city = (!empty($currentObj->city))?$currentObj->city:"N/A";
            $row[]= $city;
            $client_id=$currentObj->id;

            $where['client_id']=$client_id;
            // $case_details= $this->case_details_model->findDynamic($where);
         
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at.$new;
            $row[] = '<a class="btn btn-sm btn-info " style="margin-bottom: 4px 0px;" href="'.base_url().'admin/client/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> &nbsp;&nbsp <a class="btn btn-sm btn-info" style="margin: 4px 0px;" href="'.base_url().'admin/client/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a>';

            // href="'.base_url().'admin/view_client/index/'.$currentObj->id.'"
            $data[] = $row;
           // pre($case_details);

            // pre($case_details);
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


    // Edit
 
    public function edit($id = NULL)
    {
        
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin');
        }
        $data['edit_data'] = $this->Client_model->find($id);
        $where['status']=1;
        $data['category'] = $this->Case_category_model->findDynamic($where);
        $data['sub_category'] = $this->Case_sub_category_model->findDynamic($where);
        $this->global['pageTitle'] = 'Insaaf99 : Edit Client';
        $this->loadViews("admin/client/edit", $this->global, $data , NULL ,'admin');    
        
    } 


    public function view($id = NULL)
    {
        $this->isLoggedIn();
        
        $data['view_data'] = $this->Client_model->find($id);
       
        $cases='';
        $w['asign_lawyer_id']=$id;
        $cases= $this->case_details_model->finddynamic($w);
        
        $data['cases']=$cases;

        // update seen status
        $this->Client_model->save(array('id'=> $id,'seen'=>1));
        
        $this->global['pageTitle'] = 'Insaaf99 : view Client';
        $this->loadViews("admin/client/view", $this->global, $data , NULL ,'admin');    
        
    } 

    // Update category*************************************************************
    public function update()
    {
       
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        // $this->form_validation->set_rules('fname','fname','trim|required');
        $this->form_validation->set_rules('fname','fname','trim');
        $this->form_validation->set_rules('lname','lname','trim');
        $this->form_validation->set_rules('email','Email','trim');
        $this->form_validation->set_rules('mobile','Mobile','trim');
        
        //form data 
        $form_data  = $this->input->post();
      
        $sql = "SELECT case_file FROM clint WHERE `id`='".$form_data['id']."'"; 
         

        $dbData = $this->Client_model->rawQuery($sql);// Fetch data from client table
        $client_data = $dbData[0];
      
        if($this->form_validation->run() == FALSE)
        {
			
                $this->edit($form_data['id']);
        }
        else
        {
            $getData= $this->Client_model->find($form_data['id']);// get client data 
            $fname ='';
            $lname ='';
            $client_unique_id ='';
            $login_pin ='';
            $email ='';
            $mobile ='';
            $state ='';
            $city ='';
            $gender ='';
            $address ='';
            $oldfname ='';
            $oldlname ='';
            $oldclient_unique_id ='';
            $oldlogin_pin ='';
            $oldemail ='';
            $oldmobile ='';
            $oldgender ='';
            $oldaddress ='';
            $profileImg ='';
            $oldData =array();
            $newData =array();
            $clientData =array();

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
            if($getData->state !=$form_data['state']){
              $state =$form_data['state'];
              $oldstate =$getData->state;
            }
            if($getData->city !=$form_data['city']){
              $city =$form_data['city'];
              $oldcity =$getData->city;
            }
       
            if($getData->client_unique_id !=$form_data['client_unique_id']){
              $client_unique_id =$form_data['client_unique_id'];
              $oldclient_unique_id =$getData->client_unique_id;
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
            if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) && !empty($form_data['oldimage1'])){
                $profileImg =$form_data['oldimage1'];
              }

              // get lawye Log details
              $clientData = json_decode($getData->other,true);
              if(!empty($clientData)){
                  $clientData = $clientData['oldData'];
              }

            // store client old data when update data 
            $oldData =array('first_name'=>$oldfname,'last_name'=>$oldlname,'email'=>$oldemail,'mobile'=>$oldmobile,'client_unique_id'=>$oldclient_unique_id,'pin'=>$oldlogin_pin,'gender'=>$oldgender,'address'=>$oldaddress,'state'=>$oldstate,'city'=>$oldcity);
            // store client new data when update data 
            $newData =array('last_updated_date'=>date("d-m-Y H:i:s"),'updated_by'=>'Admin','first_name'=>$fname,'last_name'=>$lname,'email'=>$email,'mobile'=>$mobile,'client_unique_id'=>$client_unique_id,'pin'=>$login_pin,'gender'=>$gender,'address'=>$address,'profileImg'=>$profileImg,'state'=>$state,'city'=>$city);
            $clientData[] =$oldData;

            $arr =array('newData'=>$newData,'oldData'=>$clientData);
            
            $insertData['id'] = $form_data['id'];
            $insertData['client_unique_id'] = $form_data['client_unique_id'];
            $insertData['fname'] = $form_data['fname'];
            $insertData['lname'] = $form_data['lname'];
            $insertData['email'] = $form_data['email'];
            $insertData['gender'] = $form_data['gender'];
            $insertData['address'] = $form_data['address'];
            $insertData['login_pin'] = $form_data['login_pin'];
            $insertData['mobile'] = $form_data['mobile'];
            $insertData['state'] = $form_data['state'];
            $insertData['city'] = $form_data['city'];
            $insertData['client_type'] = 2;
            $insertData['status'] = $form_data['status'];
            $insertData['other'] = json_encode($arr);
            
            $result = $this->Client_model->save($insertData);
         

            if($result > 0)
            {
                $this->session->set_flashdata('success', ' Size successfully Updated');
                redirect('admin/client');
            }
            else
            { 
               
                $this->session->set_flashdata('error', 'Category Updation failed');
            }
            redirect('admin/client/edit/'.$insertData['id']);
          }  
        
    }
  
    // Client Notification
    public function client_notify()
    {
 
        $data = array(
            'admin_client_noti' => '1',
        );
        $result=$this->db->update('clint',$data,'admin_client_noti=0');
        
        if(!empty($result))
        {
                echo json_encode(array(
                    'status' => 'true',
                    'reload' => base_url('admin/client')
                ));
        }
        else
        { 
            echo json_encode(array(
                'status' => 'true1',
                'reload' => base_url('admin/client')
            ));
        }
        
    }
    
     // delete contact row 
     public function deleteByCheck()
     {
         // define path for file location 
         $this->isLoggedIn();
         $allVals = $_POST['allVals'];
         // get image path 
         $this->db->where_in('id', $allVals);	
         $delete = $this->db->delete('clint');
         echo $delete;
         exit();
     }
}

?>