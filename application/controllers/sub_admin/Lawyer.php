<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Lawyer extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/slot_model');
       $this->load->model('admin/lawyer_model');
       $this->load->model('admin/Case_category_model'); //Load the Model here   
       $this->load->model('admin/case_details_model'); //Load the Model here   
       $this->load->model('admin/Case_sub_category_model'); //Load the Model here   
       $this->isLoggedSubAdmin();
    }
    
   // Index *****************************************************************
    public function index()
    {

        $this->global['pageTitle'] = 'Insaaf99 : Lawyer List ';
        $this->loadViews("sub_admin/lawyer/list", $this->global, NULL , NULL ,'sub_admin');
        
    }

    
    // Member list*************************************************************
    public function ajax_list()
    {
        error_reporting(0);
        $list= $this->lawyer_model->get_datatables();
      
        $subCategoryList = array();
	     	$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';

        // save data for parent catelgory list
       
        foreach ($list as $currentObj) {

            // get data from z_payement, slot, cases table for lawyer Earn 
            $sql = '';
            $sql .= "SELECT c.id as caseId, s.id as slotId,p.id, p.order_id, p.txn_id, p.payment_status, p.amount FROM cases as c ";
            $sql .= "JOIN z_payment as p ON p.id = c.payment_id ";
            $sql .= "JOIN slot as s ON s.case_id = c.id ";
            $sql .= "WHERE c.asign_lawyer_id ='$currentObj->id' AND s.MeetingStatus = 2 AND p.payment_status = 'Success'";
            
            $sData = $this->slot_model->rawQuery($sql);

            $totalEarn=0;
              if(isset($sData) && !empty($sData)){
                foreach ($sData as $k => $v) {
                    $totalEarn = $totalEarn + $v->amount;
                }   
              }
              
       
          
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'';
            $l_status = $this->config->item('lawyerStatus');
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y h:i a", strtotime($temp_date));
            // select type
            $changeStatus = '<select class="lawyerStatus" id="lawyer_id'.$currentObj->id.'" data-id="'.$currentObj->id.'">';

            foreach($l_status as $k=>$v){
                $active = ($k == $currentObj->status)?' selected ':'';
                $changeStatus .= '<option value="'.$k.'" '.$active.' >'.$v.'</option>';
            }
            $changeStatus .= '</select>';

            $no++;
            $row = array();
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            
            $first_name=$currentObj->fname;
            $last_name=$currentObj->lname;
            $fullname=$first_name.' '. $last_name;
            $row[] = $fullname;
            $row[] = $currentObj->lawyer_unique_id;
            $row[] = $currentObj->mobile;
            $row[] = $currentObj->profile_complete.'%'.$new;
            $row[] = (empty($sData))?'<span class="badge bg-1 text-danger" >0</span>':'<span class="badge bg-1 text-danger" >'.count($sData).'</span>';
            $row[] = 'Rs-'.$totalEarn;
            $row[] = ($currentObj->city !='')?$currentObj->city:'-';
            $row[] = $changeStatus;
            $row[] = $date_at;
            $row[] = ' <a class="btn btn-sm btn-info " style="margin: 4px 0px;" href="'.base_url().'sub_admin/lawyer/view/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a>';
 
            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->lawyer_model->count_all(),
                        "recordsFiltered" => $this->lawyer_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    
    // Add New ************************************************************
    public function addnew()
    {
        $data['parent_list'] = $this->lawyer_model->getparent_id();
        $this->global['pageTitle'] = 'Insaaf99 : Add New size';
        $this->loadViews("sub_admin/lawyer/addnew", $this->global, $data , NULL ,'sub_admin');   
    } 


// view data ****************************************************************
    public function view($id = NULL)
    {
        
        if($id == null)
        {
            redirect('sub_admin/lawyer');
        }
            $data['view_data'] = $this->lawyer_model->find($id);
            $data['case_cat_data']= $this->Case_category_model->get_datatables();

            $w = array();
            $w['asign_lawyer_id']=$id;
            $cases= $this->case_details_model->finddynamic($w);
            $data['cases']=$cases;
            
            // get data from z_payement, slot, cases table for lawyer Earn 
            $sql = '';
            $sql .= "SELECT c.id as caseId, s.id as slotId,p.id, p.order_id, p.txn_id, p.payment_status, p.amount FROM cases as c ";
            $sql .= "JOIN z_payment as p ON p.id = c.payment_id ";
            $sql .= "JOIN slot as s ON s.case_id = c.id ";
            $sql .= "WHERE c.asign_lawyer_id ='$id' AND s.MeetingStatus = 2 AND p.payment_status = 'Success'";
            
            $sData = $this->slot_model->rawQuery($sql);
            $data['earnData']=$sData;
              
         // update seen status
        $this->lawyer_model->save(array('id'=> $id,'seen'=>1));
            
        $this->global['pageTitle'] = 'Insaaf99 : lawyer profile';
        $this->loadViews("sub_admin/lawyer/view", $this->global, $data , NULL ,'sub_admin');    
        
    } 

    
}

?>