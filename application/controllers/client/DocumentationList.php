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
class DocumentationList extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Certificate_model');
       $this->load->model('admin/sub_sub_category_model');
       $this->isUserLoggedIn(); 
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {   


        $documentationData = $this->Certificate_model->get_datatables();
        $data['documentationData'] = $documentationData;
        $this->global['pageTitle'] = 'Insaaf99 : Documentation List';
        $this->loadViews("client/documentationList/list", $this->global, $data , NULL ,'client');
        
    }
    


       // Member list
       public function ajax_list()
       {
         
           error_reporting(0);
           $list= $this->Certificate_model->get_datatables();
   
          $subCategoryList = array();
          $data = array();
          $no =(isset($_POST['start']))?$_POST['start']:'';
   
          foreach ($list as $currentObj) {
              $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'';
              $temp_date = $currentObj->dateAt;
              $date_at = date("d-m-Y h:i a", strtotime($temp_date));
              $no++;
              $row = array();
              $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
              if(isset($currentObj->user_id) && !empty($currentObj->user_id)){
               $fullname=$currentObj->fname.' '. $currentObj->lname;
               $row[] = $fullname;
               $row[] = $currentObj->sub_sub_category_name;
              }else{
               $row[] = "";
               $row[] = "";
              }
            
              $row[] = ($currentObj->payment_status == "Success") ? '<span class="btn-success badge">Success</span>' : '<span class="btn-danger badge">Failed</span>';
              $row[] =$date_at.' '.$new;
              $row[] = '<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'client/documentationList/view/'.base64_encode($currentObj->id).'" title="Edit" ><i class="fa fa-eye"></i></i></a>';
   
              $data[] = $row;
          }
          $output = array(
                          "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                          "recordsTotal" => $this->Certificate_model->count_all(),
                          "recordsFiltered" => $this->Certificate_model->count_filtered(),
                          "data" => $data,
                  );
          //output to json format
          echo json_encode($output);
      }


      public function view($id = NULL)
      {

        $id = base64_decode($id);
          $this->Certificate_model->save(array('id'=> $id,'seen'=>1));

          if ($id == null) {
              redirect('client/documentationList');
          }
          $sql = "SELECT  * FROM docx_certificate as d "; 
          $sql .="LEFT JOIN z_payment as p ON p.id=d.payment_id ";
          $sql .="LEFT JOIN clint as c ON c.id=d.user_id ";
          $sql .="WHERE  d.id=$id  ";
  
          $result = $this->Certificate_model->rawQuery($sql);
          $data=array();
          if(!empty($result)){
              $w['id']=$result[0]->doc_id;
              $w['field']="sub_sub_category_name";
              $categoryData= $this->sub_sub_category_model->finddynamic($w);
     
              $data['categoryData']=$categoryData[0];
              $data['view_data']=$result[0];
          }
      
          $this->global['pageTitle'] = 'Insaaf99 : Slot Data ';
          $this->loadViews("client/documentationList/view", $this->global, $data, NULL, 'client');
          
      }
    
}

?>