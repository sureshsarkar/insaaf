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
       $this->isLoggedSubAdmin();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        $this->global['pageTitle'] = 'Insaaf99 : Cleint';
        $this->loadViews("sub_admin/client/list", $this->global, NULL , NULL ,'sub_admin');
        
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
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            $first_name=$currentObj->fname;
            $last_name=$currentObj->lname;
            $fullname=$first_name.' '. $last_name;
            $row[] = $fullname;
            $row[]=$currentObj->client_unique_id;
            $row[]=$currentObj->mobile;
            $client_id=$currentObj->id;

            $where['client_id']=$client_id;
            // $case_details= $this->case_details_model->findDynamic($where);
         
            $row[] = ($currentObj->status==1)?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at.$new;
            $row[] = '<a class="btn btn-sm btn-info " style="margin-bottom: 4px 0px;" href="'.base_url().'sub_admin/client/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a>';

            // href="'.base_url().'sub_admin/view_client/index/'.$currentObj->id.'"
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



    public function view($id = NULL)
    {
        
        $data['view_data'] = $this->Client_model->find($id);
       
        $cases='';
        $w['asign_lawyer_id']=$id;
        $cases= $this->case_details_model->finddynamic($w);
        
        $data['cases']=$cases;

        // update seen status
        $this->Client_model->save(array('id'=> $id,'seen'=>1));
        
        $this->global['pageTitle'] = 'Insaaf99 : view Client';
        $this->loadViews("sub_admin/client/view", $this->global, $data , NULL ,'sub_admin');    
        
    } 
    
}

?>