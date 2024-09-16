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
        $this->load->model('sub_admin/Payment_model');
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
        
        $this->isLoggedSubAdmin();
        $this->global['pageTitle'] = 'Insaaf99 : payment list';
        $this->loadViews("sub_admin/payment/list", $this->global, NULL , NULL  ,'sub_admin');
        
    }

    // Add New 
    
    // delete product 
    public function delete()
    {
        $this->isLoggedSubAdmin();
        $id = $_POST['id'];
       
        $result = $this->Payment_model->delete($id);
     
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
        /* end code for delete product */
    }

    public function ajax_list()
    {
       
        error_reporting(0);
        $list=$this->Payment_model->get_datatables();

         $no=1;
        foreach ($list as $currentObj) {
            $row = array();
            $userID= (!empty($currentObj->user_id))?$currentObj->user_id:"";
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';
            $temp_date = $currentObj->payment_date;
            $date_at   = date("Y-m-d h:i a", strtotime($temp_date));
           
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            if(isset($currentObj->fname) && !empty($currentObj->fname)){
                $row[] = $currentObj->fname;
            }else{
                $row[] = $currentObj->name;
            }
            if(isset($currentObj->cmobile) && !empty($currentObj->cmobile)){
                $row[] = $currentObj->cmobile;
            }else{
                $row[] = $currentObj->mobile;
            }
          
            $row[] = "₹ ".$currentObj->amount;
            $row[] = ($currentObj->payment_status=="Success")?'<span class="btn-success badge">Success</span>':'<span class="btn-danger badge">Failed</span>';
            $row[] = $date_at;
            $row[] = $new;
            if($currentObj->payment_status=="Success"){
                $pay = '<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'utils/invoices/'.$currentObj->pdfname.$userID.'invoice.pdf" title="Edit" target="_blank"><i class="fa fa-download"></i></a>';
            }else{
                $pay='<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="#" title="Edit" disabled><i class="fa fa-download"></i></a>&nbsp;&nbsp'; 
            }
                $row[] = '<a class="btn btn-sm btn-success" href="'.base_url().'sub_admin/payment/view/'.$currentObj->id.'"><i class="fa fa-eye"></i></a>&nbsp;&nbsp; '.$pay;
            
            $data[] = $row;
            $no++;

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
  
     // View payment
     public function view($id='')
     {
        $data=array();
       $this->Payment_model->save(array('id'=> $id,'seen'=>1));

       $PaymentData= $this->Payment_model->find($id);
 
       if(!empty($PaymentData)){
           $data['view_data'] =$PaymentData;
      
         
        }else{
        $sql="";
        $sql .="SELECT * FROM z_payment as p ";
        $sql .="JOIN clint as c ON c.id=p.user_id ";
        $sql .="WHERE p.id='".$id."'";
        $result=$this->Payment_model->rawQuery($sql);
        if(isset($result) && !empty($result)){
            $data['view_data']=$result[0];
        }
      }

        $this->global['pageTitle'] = 'Insaaf99 : payment list';
        $this->loadViews("sub_admin/payment/view", $this->global, $data , NULL  ,'sub_admin');
     
     }
}
?>