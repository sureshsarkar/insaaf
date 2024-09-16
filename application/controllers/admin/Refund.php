<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '/libraries/BaseController.php';
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';

use Razorpay\Api\Api;

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Refund extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('admin/Refund_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
     
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : payment list';
        $this->loadViews("admin/refund/list", $this->global, NULL , NULL  ,'admin');
        
    }

    // Add New 
    
    // delete product 
    public function delete()
    {
        $this->isLoggedIn();
        $id = $_POST['id'];
       
        $result = $this->Payment_model->delete($id);
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
        /* end code for delete product */
    }
    public function edit($id = NULL)
    {
      
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/Refund/index');
        }
        $data['edit_data']  = $this->Refund_model->find($id);

        $client_id=$data['edit_data']->client_id;

        $txn_id=$data['edit_data']->txn_id;

        $where=array();
        $where['txn_id'] = $txn_id;
        $where['user_id'] = $client_id;
        $payment=$this->Payment_model->findDynamic($where);
        $data['payment_data']=$payment[0];
        
        $this->global['pageTitle'] = 'Edit Refund';
        $this->loadViews("admin/refund/edit", $this->global, $data, NULL, 'admin');
        
    }

     // Update Refund*************************************************************
     public function update()
     {
      
         $this->isLoggedIn();
         $this->load->library('form_validation');            
         $this->form_validation->set_rules('txn_id','Transaction ID','trim|required');
       
         $form_data  = $this->input->post();
     
         if($this->form_validation->run() == FALSE)
         {
             
                 $this->edit($form_data['id']);
         }
         else
         {
            // Refund rezarpay  api
            $key_id= $this->config->item('razPaykey_id');
            $secret= $this->config->item('razSecret');;
            $paymentId=$form_data['txn_id'];

            $api = new Api($key_id, $secret);
            $amount=$form_data['amount'];
            $refund_data= $api->payment->fetch($paymentId)->refund(array(
                    "amount"=>$amount * 100,
                    "speed"=>"normal"
            ));
    
             $insertData['id']                     = $form_data['id'];
             $insertData['client_id']              = $form_data['client_id'];
             $insertData['q_id']                   = $form_data['q_id'];
             $insertData['payment_status']         = $form_data['payment_status'];
             $insertData['amount']                 = $form_data['amount'];
             $insertData['txn_id']                 = $form_data['txn_id'];
             $insertData['order_id']               = $form_data['order_id'];
             $insertData['status']                 = 1;
             $insertData['razorpay_ref_status']    = $refund_data['status'];
             $insertData['created_at']             = $refund_data['created_at'];
           
             $result = $this->Refund_model->save($insertData);

             $data                = array(
                'q_payment_status' => '3'
            );
            $result1= $this->db->update('query', $data, 'id="' .$form_data['q_id'].'"');// Update Query table
            if ($result > 0 || $result1>0) {
                 $this->session->set_flashdata('success', 'Your Refund request is accepted & amount wiil refund within 7 days !');
                 redirect('admin/Refund/index/');
             }
             else
             { 
                
                 $this->session->set_flashdata('error', ' Your Refund request is Failed');
                 redirect('admin/Refund/edit/'.$insertData['id']);
             }
             redirect('admin/Refund/edit/'.$insertData['id']);
           }  
         
     }

    public function ajax_list()
    {
       
        error_reporting(0);
        $list=$this->Refund_model->get_datatables();
     
         $no=1;
        foreach ($list as $currentObj) {

            $row = array();
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';

            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y H:i:s", strtotime($temp_date));
           
            $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
            
            $client_id = $currentObj->client_id;
            $client_data=$this->Client_model->find($client_id);
          
            $row[] = $client_data->fname." ".$client_data->lname;
            $row[] = $client_data->email;
            // $row[] = $client_data->mobile;
            $row[] = $currentObj->amount;
            $row[] = ($currentObj->payment_status=="1")?'<span class="btn-success badge">Success</span>':'<span class="btn-danger badge">Pending</span>';
            $row[] = $currentObj->order_id;
            $row[] = ($currentObj->status=="1")?'<span class="btn-success badge">On Refund</span>':'<span class="btn-danger badge">Pending</span>';
            $row[] = $new;
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'admin/refund/edit/'.$currentObj->id.'" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'admin/refund/view/'.$currentObj->id.'" title="view"><i class="fa fa-eye"></i></a>&nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a>';

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
     
     // View Refund 
    public function view($id = NULL)
    {
      $data=array();
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/Refund');
        }
          // update seen status
          $this->Refund_model->save(array('id'=> $id,'seen'=>1));

        $sql="SELECT * FROM payment_refund as r";
        $sql.=" JOIN z_payment as p ON p.txn_id=r.txn_id";
        $sql.=" JOIN clint as c ON c.id=r.client_id";
        $sql.=" WHERE r.id=$id";
      
        $result  = $this->Refund_model->rawquery($sql);

        if(!empty($result)){
            $data['view_data']=$result[0];
        }

        $this->global['pageTitle'] = 'Edit Refund';
        $this->loadViews("admin/refund/view", $this->global, $data, NULL, 'admin');
        
    }
}

?>