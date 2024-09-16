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
        $this->load->model('admin/Case_details_model');
        $this->load->model('admin/Lawyer_model');
        $this->load->model('admin/Payment_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $data = array();
        if(isset($_GET['key']) && !empty($_GET['key'])){
            $data['id']=base64_decode($_GET['key']);
            $data['status']=1;
            $data['update_dt']=date("Y-m-d H:i:s");
            update_notification($data);
        }
        
       // code to show grph chart start 
       $arr = array();
       $subArr = array();
       $subArr[] = 'Month and Year';
       $subArr[] = 'Payment';
       $subArr[] = 'Meetings';
       $arr[] = $subArr;
       // get year using podt method
       if(isset($_POST['year']) && !empty($_POST['year'])){
           $currentYear = intval($_POST['year']);
           $y = $currentYear -1;
       }else{
       $currentYear = intval(date("Y"));
       $y = $currentYear-1;
       }
           // pass year in view
           // create month data in array
           $months = ["1"=>"Jan", "2"=>"Feb", "3"=>"Mar", "4"=>"Apr", "5"=>"May", "6"=>"June", "7"=>"July", "8"=>"Aug", "9"=>"Sept", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec"];
           $year = "";
           //while loop to pass the year and fetch data from database by Year 
           while($y <= $currentYear) {
             $y;
             $currentYear;

             $year  .='-'.$y;
              //for loop to fetch data from database by Month 
               for ($i=1; $i <= count($months) ; $i++) { 
               $sql ='';
               $sql ="SELECT id,payment_date FROM `z_payment` WHERE payment_date BETWEEN '".$y."-0".$i."-01' AND '".$y."-".$i."-31' AND `payment_status`='Success'";
               $pData =  $this->Client_model->rawquery($sql);

               $sql ='';
               $sql ="SELECT id,dt FROM `slot` WHERE dt BETWEEN '".$y."-0".$i."-01' AND '".$y."-".$i."-31' AND `MeetingStatus`!=0";
               $mData =  $this->Client_model->rawquery($sql);

                   // store data in a array after geting data one by one
                   $subArr = array();
                   $subArr[] =$y.'-'.$months[$i];
                   $subArr[] = (empty($pData))?0:count($pData); 
                   $subArr[] = (empty($mData))?0:count($mData); 
                   $arr[] = $subArr;
               }
           $y++;
           }

       $data['jsonData'] = json_encode($arr);
       $data['year']  = $year;
// code to show grph chart end

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : payment list';
        $this->loadViews("admin/payment/list", $this->global, $data , NULL  ,'admin');
        
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

    public function ajax_list()
    {
       
        error_reporting(0);
        $list=$this->Payment_model->get_datatables();

         $no=1;
        foreach ($list as $currentObj) {
            $row = array();
            $userID= (!empty($currentObj->user_id))?$currentObj->user_id:"";
            $new = ($currentObj->seen == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'';
            $temp_date = $currentObj->payment_date;
            $date_at   = date("Y-m-d h:i a", strtotime($temp_date));

            $row[] ='<input type="checkbox" name="checkbox" class="checkbox" value="'.$currentObj->id.'">';
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
            $row[] = "Rs- ".$currentObj->amount;

           $orderID = createOrderIdEncode($currentObj->id,$currentObj->payment_type);
        
            $row[] =$orderID;
            $row[] = ($currentObj->payment_status=="Success")?'<span class="btn-success badge">Success</span>':'<span class="btn-danger badge">Failed</span>';
            $row[] = $date_at.$new;
            if($currentObj->payment_status=="Success"){
                $pay = '<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'utils/invoices/'.$currentObj->pdfname.$userID.'invoice.pdf" title="Edit" target="_blank"><i class="fa fa-download"></i></a>';
            }else{
                $pay='<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="#" title="Edit" disabled><i class="fa fa-download"></i></a>&nbsp;&nbsp'; 
            }
                $row[] = '<a class="btn btn-sm btn-success" href="'.base_url().'admin/payment/view/'.$currentObj->id.'"><i class="fa fa-eye"></i></a>&nbsp;&nbsp <a class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a>&nbsp;&nbsp;'.$pay;
            
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
       $this->Payment_model->save(array('id'=> $id,'seen'=>1));
       $PaymentData= $this->Payment_model->find($id);
       if(empty($PaymentData->user_id)){
           $data['view_data'] =$PaymentData;
        }else{
        $sql="";
        $sql .="SELECT *, p.id as p_id FROM z_payment as p ";
        $sql .="JOIN clint as c ON c.id=p.user_id ";
        $sql .="WHERE p.id='".$id."'";
        $result=$this->Payment_model->rawQuery($sql);
        $data['view_data']=$result[0];
      
      }

        $this->global['pageTitle'] = 'Insaaf99 : payment list';
        $this->loadViews("admin/payment/view", $this->global, $data , NULL  ,'admin');
     
     }


    // delete contact row 
    public function deleteByCheck()
    {
        // define path for file location 
        $this->isLoggedIn();
        $allVals = $_POST['allVals'];
        // get image path 
        $this->db->where_in('id', $allVals);	
        $delete = $this->db->delete('z_payment');
        echo $delete;
        exit();
    }

}
?>