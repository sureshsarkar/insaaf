<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


    require APPPATH . '/libraries/BaseController.php';
    require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
    require APPPATH . '../assets/plugins/RazorPay/vendor/autoload.php';
    use Razorpay\Api\Api;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Certificare extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Certificate_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Client_model');
        $this->load->model('admin/sub_sub_category_model');
        $this->load->model('admin/Payment_model');

        
    }


    public function index()
    { 
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Certificate';
        $this->loadViews("admin/certificate/list", $this->global, NULL, NULL, 'admin');
        
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

        // pre($currentObj);
           
           $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';
           $temp_date = $currentObj->dateAt;
           $date_at = date("d-m-Y h:i a", strtotime($temp_date));
           $no++;
           
           $row = array();
           $row[] ='<span class="btn-primary  btn12  badge">'.$no.'</span>';
           
           
           if(isset($currentObj->user_id) && !empty($currentObj->user_id)){
               $row[]=$currentObj->fname.' '. $currentObj->lname;
            }else{
            $additional= json_decode($currentObj->additional,true);
            $row[] = $additional['addtional']['first_name'].' '.$additional['addtional']['last_name'];
           }
         
           $row[] = ($currentObj->payment_status == "Success") ? '<span class="btn-success badge">Success</span>' : '<span class="btn-danger badge">Failed</span>';
           $row[] =$date_at;
           $row[] =$new;
           $row[] = '<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'admin/certificare/view/'.$currentObj->id.'" title="Edit" ><i class="fa fa-eye"></i></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin: 4px 0px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a>';

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
  
    
    
    // Edit
    
    public function view($id = NULL)
    {
        $this->Certificate_model->save(array('id'=> $id,'seen'=>1));

        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/Certificate');
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
        $this->loadViews("admin/certificate/view", $this->global, $data, NULL, 'admin');
        
    }
    
  // delete certificate 
  public function delete()
  {
      // define path for file location 
      $this->isLoggedIn();
      $id    = $_POST['id'];
      // get image path 
      $rData = $this->Certificate_model->find($id);
      
      $result = $this->Certificate_model->delete($id);
      
      if ($result > 0) {
          echo (json_encode(array(
              'status' => TRUE
          )));
      } else {
          echo (json_encode(array(
              'status' => FALSE
          )));
      }
  }

  // Query Notification
  public function certi_notify()
  {
   
      $data = array(
          'admin_certi_noti' => '1',
      );
      $result=$this->db->update('certificate',$data,'admin_certi_noti=0');
      
      if(!empty($result))
      {
              echo json_encode(array(
                  'status' => 'true',
                  'reload' => base_url('admin/Certificare')
              ));
      }
      else
      { 
          echo json_encode(array(
              'status' => 'true1',
              'reload' => base_url('admin/Certificare')
          ));
      }
      
  }
    
    
}

?>