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
       $this->isLoggedSubAdmin();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        
        $this->global['pageTitle'] = 'Insaaf99 : Contact';
        $this->loadViews("sub_admin/contact/list", $this->global, NULL , NULL ,'sub_admin');
        
    }
    
    // Member list
    public function ajax_list()
    {  
        error_reporting(0);

		$list =$this->contact_model->get_datatables();
    
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
       
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';
            $temp_date = $currentObj->date_at;
            $date_at = date("d-m-Y h:i a", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            $row[] = '<span style="display: -webkit-box; max-width: 200px; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden;">'.$currentObj->name.'</span> ';
            $row[]=$currentObj->mobile;
            $row[]=$currentObj->email;
            $ppc = ($currentObj->contact_type =='PPC')?'?ppc_key=ppc':'';
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
            $row[] = ($currentObj->contact_type=='PPC')?'<span class="btn-warning badge">PPC</span>':'<span class="btn-danger badge">Contact</span>';
            $row[]=$new;
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="'.base_url().'sub_admin/contact/view/'.$currentObj->id.$ppc.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> ';
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
        
        
        $data['view_data'] = $this->contact_model->find($id);

        // update seen status
        $this->contact_model->save(array('id'=> $id,'seen'=>1));
        
        $this->global['pageTitle'] = 'Insaaf99 : view Client';
        $this->loadViews("sub_admin/contact/view", $this->global, $data , NULL ,'sub_admin');    
        
    }   
    
}

?>