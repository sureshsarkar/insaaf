<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Support extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('support_model');
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
        $this->global['pageTitle'] = 'Insaaf99 : Support';
        $this->loadViews("admin/support/list", $this->global, NULL , NULL ,'admin');
        
    }
  
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id = $_POST['id'];
        // get image path 
        $rData = $this->support_model->find($id);
        
        $result = $this->support_model->delete($id);

        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    // end category 

    // Member list
    public function ajax_list()
    {  
        error_reporting(0);

		$list =$this->support_model->get_datatables();
    
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

       
        // save data for parent catelgory list
      
        foreach ($list as $currentObj) {
            $jsonData = json_decode($currentObj->jsonText);
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';
            $temp_date = $currentObj->date;
            $date_at = date("d-m-Y h:i a", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            $row[] =$jsonData->mobile;
            $row[] =$jsonData->email;
            $row[] = $date_at.' '.$new;
            $row[] = '<a class="btn btn-sm btn-info " style="margin-bottom: 4px 0px;" href="'.base_url().'admin/support/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a> &nbsp;&nbsp <a class="btn btn-sm btn-info" style="margin: 4px 0px;" href="'.base_url().'admin/support/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }

        
     
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->support_model->count_all(),
                        "recordsFiltered" => $this->support_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    // Edit***********************************************************
 
    public function edit($id = NULL)
    {
        
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin');
        }
        $data['edit_data'] = $this->support_model->find($id);
        $where['status']=1;
        $data['category'] = $this->Case_category_model->findDynamic($where);
        $data['sub_category'] = $this->Case_sub_category_model->findDynamic($where);
        $this->global['pageTitle'] = 'Insaaf99 : Edit Client';
        $this->loadViews("admin/support/edit", $this->global, $data , NULL ,'admin');    
        
    } 


    public function view($id = NULL)
    {
        $this->isLoggedIn();
        
        $data['view_data'] = $this->support_model->find($id);

        // update seen status
        $this->support_model->save(array('id'=> $id,'seen'=>1));
        
        $this->global['pageTitle'] = 'Insaaf99 : view Client';
        $this->loadViews("admin/support/view", $this->global, $data , NULL ,'admin');    
        
    } 

    // Update category*************************************************************
    public function update()
   {
    
   }
    
    
}

?>