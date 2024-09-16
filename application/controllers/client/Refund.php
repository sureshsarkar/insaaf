<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
include('zoom/config.php');
include('zoom/api.php');
use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


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
       $this->load->model('client/Slot_model');
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Query_model');
       $this->load->model('admin/Refund_model');
       $this->isUserLoggedIn();
    }

    /**
     * Index Page for this controller.
     */
    public function index($id = NULL)
    {  
      
        $data['case_category']=$this->Case_category_model->all();
        
        $sql="SELECT *,q.id as q_id FROM query as q  ";
        $sql.="JOIN z_payment as p ON p.order_id=q.order_id";
        $sql.=" WHERE q.id='".$id."'";
        $query_d = $this->Query_model->rawQuery($sql);
        $data['Query_Data']=$query_d[0];
        // pre($data['Query_Data']);
        // exit();
        $data['client_id']=$id;
        $this->global['pageTitle'] = 'Refund';
        $this->loadViews("client/refund/view", $this->global, $data , NULL ,'client');
        
    }

    public function insert()
    {
      
        date_default_timezone_set('Asia/Kolkata');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('q_id', 'query id', 'trim|required');
        //form data 
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->index($form_data['q_id']);
        } else {
           
            $insertData                         = array();
            $insertData['q_id']                 = $form_data['q_id'];
            $insertData['client_id']            = $form_data['client_id'];
            $insertData['order_id']             = $form_data['order_id'];
            $insertData['txn_id']               = $form_data['txn_id'];
            $insertData['payment_status']       = $form_data['payment_status'];
            $insertData['amount']               = $form_data['amount'];
            $insertData['dt']                   = date("Y-m-d h:i a");
           
            $result = $this->Refund_model->save($insertData);

            $data                = array(
                'q_payment_status' => '2'
            );
            $result1= $this->db->update('query', $data, 'id="' .$form_data['q_id'].'"');// Update Query table
            if ($result > 0 || $result1>0) {
                $this->session->set_flashdata('success', 'You Request is being under process & payment will refund within 7 days');
                redirect('client/Client_query/index/' . $insertData['client_id']);
            } else {
                $this->session->set_flashdata('error', 'Failed to Refund ');
                redirect('client/Refund/index'. $insertData['q_id']);
            }
        }
        
    }

    
    
    
}

?>