<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Contact extends BaseController
{

//  This is default constructor of the class
   
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/contact_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Contact';
        $this->loadViews("admin/contact/list", $this->global, NULL , NULL ,'admin');
        
    }
    
 
    // delete contact row 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id = $_POST['id'];
        // get image path 
        
        $result = $this->contact_model->delete($id);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    // end contact row 
 
    // delete contact row 
    public function deleteByCheck()
    {
        // define path for file location 
        $this->isLoggedIn();
        $allVals = $_POST['allVals'];
        // get image path 
        $this->db->where_in('id', $allVals);	
        $delete = $this->db->delete('contact');
        echo $delete;
        exit();
    }

    // end contact row 
  

    // Member list
    public function ajax_list()
    {  
        error_reporting(0);

		$list =$this->contact_model->get_datatables();
    
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
       
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {

            // pre($currentObj);
            // exit();
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';
            $temp_date = $currentObj->date_at;
            $date_at = date("d-m-Y h:i a", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<input type="checkbox" name="checkbox" class="checkbox" value="'.$currentObj->id.'">';
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            $row[] = '<span style="display: -webkit-box; max-width: 200px; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden;">'.$currentObj->name.'</span> ';
            $row[]=$currentObj->mobile;
            $row[]=$currentObj->email;

            // $where['client_id']=$client_id;
            // $case_details= $this->case_details_model->findDynamic($where);
            $ppc = ($currentObj->contact_type =='PPC')?'?ppc_key=ppc':'';
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
            $row[] = ($currentObj->contact_type=='PPC')?'<span class="btn-warning badge">PPC</span>':'<span class="btn-danger badge">Contact</span>';
            $row[]=$new;
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-danger deletebtn " style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="'.base_url().'admin/contact/view/'.$currentObj->id.$ppc.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
            $data[] = $row;
        }
     
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->contact_model->count_all(),
                        "recordsFiltered" => $this->contact_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    public function view($id = NULL)
    {

        if(isset($_GET['key']) && !empty($_GET['key'])){
            $data['id']=base64_decode($_GET['key']);
            $data['status']=1;
            $data['update_dt']=date("Y-m-d H:i:s");
           update_notification($data);
        }
        
        $this->isLoggedIn();
        
        $data['view_data'] = $this->contact_model->find($id);

        // update seen status
        $this->contact_model->save(array('id'=> $id,'seen'=>1));
        
        $this->global['pageTitle'] = 'Insaaf99 : view Client';
        $this->loadViews("admin/contact/view", $this->global, $data , NULL ,'admin');    
        
    }   
    
}

?>