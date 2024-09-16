<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Test extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Client_model');
        $this->load->model('admin/case_details_model');
        $this->load->model('admin/payment_model');
        $this->load->model('admin/Case_sub_category_model');   
        $this->isLoggedIn();
    }
    

    public function index()
    { 
        $arr = array();
        $subArr = array();

        $subArr[] = 'Month';
        $subArr[] = 'Payment';
        $subArr[] = 'Meetings';
        $subArr[] = 'Clients';
        $subArr[] = 'Queries';
        $arr[] = $subArr;

        if(isset($_POST['year']) && !empty($_POST['year'])){
            $currentYear = intval($_POST['year']);
            $y = $currentYear -3;
        }else{
        $currentYear = intval(date("Y"));
        $y = $currentYear;
        }


         $months = ["1"=>"January", "2"=>"February", "3"=>"March", "4"=>"April", "5"=>"May", "6"=>"June", "7"=>"July", "8"=>"August", "9"=>"September", "10"=>"October", "11"=>"November", "12"=>"December"];
         $f =0;
         while($y <= $currentYear) {
    
                for ($i=1; $i <= count($months) ; $i++) { 
                $sql ='';
                $sql ="SELECT id,payment_date FROM `z_payment` WHERE payment_date BETWEEN '".$y."-0".$i."-01' AND '".$y."-".$i."-31' AND `payment_status`='Success'";
                $pData =  $this->Client_model->rawquery($sql);

                $sql ='';
                $sql ="SELECT id,dt FROM `slot` WHERE dt BETWEEN '".$y."-0".$i."-01' AND '".$y."-".$i."-31' AND `MeetingStatus`!=0";
                $mData =  $this->Client_model->rawquery($sql);

                $sql ='';
                $sql ="SELECT id,dt FROM `clint` WHERE dt BETWEEN '".$y."-0".$i."-01' AND '".$y."-".$i."-31' ";
                $cData =  $this->Client_model->rawquery($sql);

                $sql ='';
                $sql ="SELECT id,date_at FROM `contact` WHERE date_at BETWEEN '".$y."-0".$i."-01' AND '".$y."-".$i."-31' ";
                $qData =  $this->Client_model->rawquery($sql);
          
                    $subArr = array();
                    $subArr[] =$months[$i];
                    $subArr[] = (empty($pData))?0:count($pData); 
                    $subArr[] = (empty($mData))?0:count($mData); 
                    $subArr[] = (empty($cData))?0:count($cData); 
                    $subArr[] = (empty($qData))?0:count($qData); 
                    $arr[] = $subArr;

                }
              
            $y++;
            }
        $data= array();

        $data['jsonData'] = json_encode($arr);
        $this->global['pageTitle'] = 'Insaaf99 : Admin Test';
        $this->loadViews("admin/saveformdata", $this->global, $data , NULL,'admin');
    }  
        
}
?>