<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Meeting_list extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/Slot_model');
       $this->load->model('lawyer/Hearing_date_model');
       $this->load->model('admin/Case_details_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Case_sub_category_model');
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Lawyer_model');
       $this->isLoggedIn();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {  
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $data['id']=base64_decode($_GET['key']);
            $data['status']=1;
            $data['update_dt']=date("Y-m-d H:i:s");
            update_notification($data);
        }
        $this->global['pageTitle'] = ' Meeting List';
        $this->loadViews("admin/meeting_list/list", $this->global, NULL , NULL ,'admin');
        
    }
    public function view($id = NULL)
    {
       // update seen status
        $this->Slot_model->save(array('id'=> $id,'upcome_seen'=>1));

        $sql = "SELECT  *,s.id as slotId, cl.fname as c_fname,cl.lname as c_lname,l.fname as l_fname,l.lname as l_lname,l.mobile as l_mobile,l.email as l_email,l.lawyer_unique_id as lawyer_UID,cc.name as case_cat_name  FROM slot as s"; 
        $sql .= " JOIN lawyer as l ON l.id = s.lawyer_id"; //Fetch client detail from clint table using Id
        $sql .= " JOIN clint as cl ON cl.id = s.client_id "; //Fetch client detail from clint table using Id
        $sql .= " JOIN cases as c ON c.id = s.case_id "; //Fetch client detail from clint table using Id
        $sql .= " JOIN case_category as cc ON cc.id = c.case_category_id "; //Fetch client detail from clint table using
        $sql .=" WHERE  s.id='".$id."' AND `slot_status`= 1 ";
        $data1 = $this->Slot_model->rawQuery($sql);
        $data=array();
        if(!empty($data1)){
            foreach($data1 as $meeting_Detail){
                $data['meeting_Detail']=$meeting_Detail;
            }
        }
       
        if($id == null)
        {
            redirect('admin/size');
            
        }

        $this->global['pageTitle'] = ' View case';
        $this->loadViews("admin/meeting_list/view", $this->global, $data , NULL,'admin');    
        
    } 
    

    // Member list
    public function ajax_list()
    {  
     
        error_reporting(0);
         $list= $this->Slot_model->get_datatables();

		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        foreach ($list as $currentObj) {
          
            $new = ($currentObj->upcome_seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y H:i:s", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';

            
            $status1='';
            if($currentObj->slot_status ==0){
                $status1 = '<span class="btn-warning  badge">Pending</span>';

            }
            elseif($currentObj->slot_status ==1){
                $status1 = '<span class="btn-success badge">Approve</span>';

            }elseif($currentObj->slot_status ==2){
                $status1 = '<span class="btn-primary  badge">Decline</span>';

            }
            else{
                $status1 = '<span class="btn-warning  badge">Pending</span>';
            }

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
            $lawyerfullname=$first_name.' '. $last_name;
            $row[] = $lawyerfullname;
            
            $meeting=$currentObj->meeting_time;
            $date_meet = date("d-m-Y", strtotime($meeting));
            $time_meet = date("h:i:a", strtotime($meeting));
            $row[]=$date_meet.'/'.$time_meet;
            if($currentObj->slot_status=1){

                $encriptID= JKMencoder($currentObj->id);
                $row[]='<a href="'.base_url().'z/l/'.$encriptID.'"  class="btn btn-primary" style="margin: 4px 0px;font-size: 11px;" title="Click to Join" target="_blank">Join</a>';
            }else{
                $row[]="No Link Generated";
            }
           
            $row[]=$status1;
            $row[]=$new;
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px" href="'.base_url().'admin/meeting_list/view/'.$currentObj->id.'" title="View" ><i class="fa fa-eye"></i></a>  ';
            
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


    // Meeting notification update
    public function Meeting_notify()
    {
        $form_data  = $this->input->post();
    //    pre($form_data);
    //    exit();
            $data = array(
             // 'lawyer_id' =>  $form_data['lawyer_id'],
             'lawyer_meeting_noti' => '1',
            );
         $result= $this->db->update('slot',$data,'lawyer_id="'.$form_data['lawyer_id'].'" AND slot_status=1');

            if(!empty($result))
            {
                 echo json_encode(array(
                     'status' => 'true',
                     'reload' => base_url('admin/meeting_list/index/' .$form_data['lawyer_id'])
                 ));
            }
            else
            { 
                echo json_encode(array(
                   'status' => 'true1',
                   'reload' => base_url('admin/meeting_list/index/' .$form_data['lawyer_id'])
                ));
            }
           
          }

    // Meeting notification update
    public function click_f_query_noti()
    {
        $form_data  = $this->input->post();
    //    pre($form_data);
    //    exit();
            $data = array(
             // 'lawyer_id' =>  $form_data['lawyer_id'],
             'lawyer_f_query_noti' => '1',
            );
          $result= $this->db->update('query',$data,'lawyer_id="'.$form_data['lawyer_id'].'"');

            if(!empty($result))
            {
                 echo json_encode(array(
                     'status' => 'true',
                     'reload' => base_url('admin/Text_query/index/' .$form_data['lawyer_id'])
                 ));
            }
            else
            { 
                echo json_encode(array(
                   'status' => 'true1',
                   'reload' => base_url('admin/Text_query/index/' .$form_data['lawyer_id'])
                ));
            }
           
          }


     

   

    
    
    
}

?>