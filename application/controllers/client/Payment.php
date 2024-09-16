<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Payment extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        $this->load->model('client/Case_details_model');
        $this->load->model('admin/Lawyer_model');
        $this->load->model('client/Payment_model');
        $this->isUserLoggedIn();
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
 $data = array();
        $w['user_id'] = $_SESSION['id'];
        $this->db->update('z_payment',array('client_seen'=>1), $w);
        
        // update notification
        if(isset($_GET) && !empty($_GET)){
            $data['id']=base64_decode($_GET['key']);
            $data['status']=1;
            $data['update_dt']=date("Y-m-d H:i:s");
           update_notification($data);
        }

        $list=$this->Payment_model->get_datatables(); 
        $data['paymentData'] = $list;
        $this->global['pageTitle'] = 'Insaaf99 : payment list';
        $this->loadViews("client/payment/list", $this->global, $data , NULL  ,'client');
        
    }

    // Add New 
    
    // delete product 
    public function delete()
    {
        
        $id = $_POST['id'];
       
        $result = $this->Payment_model->delete($id);
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
        /* end code for delete product */
    }

    public function ajax_list()
    {
       
       $list=$this->Payment_model->get_datatables(); 
       $data = array();
       $no =(isset($_POST['start']))?$_POST['start']:'';
        //  pre( $list);
        foreach ($list as $currentObj) {
            // $new = ($currentObj->client_seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';

            $row = array(); $no++;
            $temp_date = $currentObj->payment_date;
            $date_at   = date("Y-m-d H:i:s", strtotime($temp_date));
           
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';
            $row[] = "₹".$currentObj->amount;
            $row[] = $currentObj->payment_type;
            $row[] = ($currentObj->payment_status=="Success")?'<span class="btn-success badge">Success</span>':'<span class="btn-danger badge">Failed</span>';
            // $row[] = $new;
            $row[] = $date_at;
            if($currentObj->payment_status=="Success"){
                $row[] = '<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'utils/invoices/'.$currentObj->pdfname.$currentObj->user_id.'invoice.pdf" title="Edit" target="_blank"><i class="fa fa-download"></i></a>';
            }else{
                $row[] = '<a class="btn btn-sm btn-danger" style="margin: 5px 0px;" href="" disabled><i class="fa fa-download"></i></a>';
            }

            $data[] = $row;          

        }
            

       $output = array(
        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
        "recordsTotal" => $this->Payment_model->count_all(),
        "recordsFiltered" => $this->Payment_model->count_filtered(),
        "data" =>$data,
);
        //output to json format
        echo json_encode($output);
    }
  
}

?>