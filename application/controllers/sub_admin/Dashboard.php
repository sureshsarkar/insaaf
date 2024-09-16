<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Dashboard extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Case_details_model');
        $this->load->model('admin/Slot_model');
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Lawyer_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Certificate_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Latest_News_model');
        $this->load->model('admin/mail_info_model');
        $this->load->model('admin/contact_model');
        $this->load->model('admin/calling_model');
        $this->load->model('support_model');
        $this->isLoggedSubAdmin();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
   
    public function index()
    { 
            error_reporting(0);
            /* code for order detaisl */
            $caseDetails = $this->Case_details_model->all();
            if(!empty($caseDetails)){
                $data['caseCount'] =  count($caseDetails) ;
            }

                        
            $totalPayment= $this->Payment_model->all();
            if(!empty($totalPayment)){
                $data['totalPayment'] =  count($totalPayment) ;
            }

            $calling_data= $this->calling_model->all();
            if(!empty($calling_data)){
                $data['calling_data'] =  count($calling_data) ;
            }

            $toatalClient= $this->Client_model->all();
            if(!empty($toatalClient)){
                $data['toatalClient'] =  count($toatalClient);

            }
            
            $p['contact_type']='PPC';
            $toatalPpc= $this->contact_model->finddynamic($p);
            if(!empty($toatalPpc)){
                $data['toatalPpc'] =  count($toatalPpc) ;
            }

            $c['contact_type'] !='PPC';
            $sql = "SELECT id FROM contact WHERE `contact_type` !='PPC' ";
            $toatalContact = $this->contact_model->rawQuery($sql);
            if(!empty($toatalContact)){
                $data['toatalContact'] =  count($toatalContact) ;
            }

            $toatalLawyer= $this->Lawyer_model->all();
            if(!empty($toatalLawyer)){
                $data['toatalLawyer'] =  count($toatalLawyer);
               
            }

           $supportCount= $this->support_model->all();
            if(!empty($supportCount)){
                $data['supportCount'] =  count($supportCount) ;
           
            }

            $curentTime          = date("Y-m-d H:i:s");
            $sql="SELECT * FROM slot where TIMESTAMPDIFF(MINUTE, '".$curentTime."', `meeting_time`) > 0 AND slot_status = '1'";
            $meeting= $this->Slot_model->rawquery($sql);
        
            if(!empty($meeting)){
                $data['meetingcount'] =  count($meeting) ;
                $data['meeting_count'] =  json_encode($meeting);
           
            }

        // code to show grph chart start 
                $arr = array();
                $subArr = array();

                $subArr[] = 'Month and Year';
                $subArr[] = 'Payment';
                $subArr[] = 'Meetings';
                $subArr[] = 'Clients';
                $subArr[] = 'Queries';
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
                    
                    //while loop to pass the year and fetch data from database by Year 
                    while($y <= $currentYear) {
                        $data['year']  .='-'.$y;

                       //for loop to fetch data from database by Month 
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

                            // store data in a array after geting data one by one
                            $subArr = array();
                            $subArr[] =$y.'-'.$months[$i];
                            $subArr[] = (empty($pData))?0:count($pData); 
                            $subArr[] = (empty($mData))?0:count($mData); 
                            $subArr[] = (empty($cData))?0:count($cData); 
                            $subArr[] = (empty($qData))?0:count($qData); 
                            $arr[] = $subArr;
                        }
                    $y++;
                    }

                $data['jsonData'] = json_encode($arr);
            
        // code to show grph chart end

        $this->global['pageTitle'] = 'Sub Admin Dashboard';
        $this->loadViews("sub_admin/dashboard", $this->global, $data , NULL,'sub_admin');
    } 


   
 
  
}

?>