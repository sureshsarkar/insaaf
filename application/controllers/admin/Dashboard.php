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
        $this->load->model('admin/Case_details_model');;
        $this->load->model('admin/acts_model');;
        $this->load->model('admin/blogs_model');;
        $this->load->model('admin/Slot_model');
        $this->load->model('lawyer/Hearing_date_model');
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Lawyer_model');
        $this->load->model('admin/Payment_model');
        $this->load->model('admin/Query_model');
        $this->load->model('admin/Client_query_model');
        $this->load->model('admin/Certificate_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Latest_News_model');
        $this->load->model('admin/Refund_model');
        $this->load->model('admin/mail_info_model');
        $this->load->model('admin/dictionary_model');
        $this->load->model('admin/contact_model');
        $this->load->model('admin/calling_model');
        $this->load->model('support_model');

        $this->isLoggedIn();   

    }
    
        

    public function index()
    { 
            

            error_reporting(0);
            /* code for order detaisl */
            $caseDetails = $this->Case_details_model->all();
            if(!empty($caseDetails)){
                $data['caseCount'] =  count($caseDetails) ;
                $data['total_case'] =  json_encode($caseDetails);
            }

            $acts = $this->acts_model->all();
            if(!empty($acts)){
                $data['actCount'] =  count($acts) ;
                $data['total_acts'] =  json_encode($acts);
            }
            $dictionary = $this->dictionary_model->all();
            if(!empty($dictionary)){
                $data['dictionaryCount'] =  count($dictionary) ;
                $data['total_blogs'] =  json_encode($dictionary);
            }

            $calling_data= $this->calling_model->all();
            if(!empty($calling_data)){
                $data['calling_data'] =  count($calling_data) ;
            }

            $blogs = $this->blogs_model->all();
            if(!empty($blogs)){
                $data['blogCount'] =  count($blogs) ;
                $data['total_blogs'] =  json_encode($blogs);
            }
        
            /* code for total product */
            $where = array();
            $where['status']    = 0;
            $toatalPendingCases = $this->Case_details_model->findDynamic($where);
            if(!empty($toatalPendingCases)){
                $data['pedingCaseCount'] =  count($toatalPendingCases) ;   
            }

            $model_name = 'Case_details_model';
            $day = 7;
            
            $newCase_list =  $this->get_ordersales($day,$model_name);   
            if(!empty($newCase_list)){
                $data['newCase_list']    =   count($newCase_list);
                $data['newCase_list1'] =  json_encode($newCase_list);

           
            }

            $toatalSlot = $this->Slot_model->all();
            if(!empty($toatalSlot)){
                $data['toatalSlot'] =  count($toatalSlot) ;
                $data['toatalSlot1'] =  json_encode($toatalSlot);

               
            }
            
            $toatalHearing = $this->Hearing_date_model->all();
            if(!empty($toatalHearing)){
                $data['toatalHearing'] =  count($toatalHearing) ;
                $data['toatalHearing1'] =  json_encode($toatalHearing);

            }
            $toatalClient= $this->Client_model->all();
            if(!empty($toatalClient)){
                $data['toatalClient'] =  count($toatalClient) ;
                $data['toatalClient1'] =  json_encode($toatalClient);

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
                $data['toatalLawyer'] =  count($toatalLawyer) ;
                $data['toatalLawyer1'] =  json_encode($toatalLawyer);
               
            }
            $toatalPaymentList= $this->Payment_model->all();
            if(!empty($toatalPaymentList)){
                $data['toatalPaymentList'] =  count($toatalPaymentList) ;
                $data['toatalPaymentList1'] =  json_encode($toatalPaymentList);
               
            }
            $w['parent_id']=0;
            $toatalquery= $this->Client_query_model->finddynamic($w);
            if(!empty($toatalquery)){
                $data['toatalquery'] =  count($toatalquery) ;
                $data['toatalquery1'] =  json_encode($toatalquery);
           
            }
           $toatalCertificate= $this->Certificate_model->all();
            if(!empty($toatalCertificate)){
                $data['toatalCertificate'] =  count($toatalCertificate) ;
                $data['toatalCertificate1'] =  json_encode($toatalCertificate);
           
            }
       
           $RefundCount= $this->Refund_model->all();
            if(!empty($RefundCount)){
                $data['RefundCount'] =  count($RefundCount) ;
                $data['Refund_Count'] =  json_encode($RefundCount);
           
            }

           $supportCount= $this->support_model->all();
            if(!empty($supportCount)){
                $data['supportCount'] =  count($supportCount) ;
                $data['support_Count'] =  json_encode($supportCount);
           
            }
           $Newscount= $this->Latest_News_model->all();
            if(!empty($Newscount)){
                $data['Newscount'] =  count($Newscount) ;
                $data['News_count'] =  json_encode($Newscount);
           
            }

            $curentTime          = date("Y-m-d H:i:s");
            $sql="SELECT * FROM slot where TIMESTAMPDIFF(MINUTE, '".$curentTime."', `meeting_time`) > 0 AND slot_status = '1'";
            $meeting= $this->Slot_model->rawquery($sql);
        
            if(!empty($meeting)){
                $data['meetingcount'] =  count($meeting) ;
                $data['meeting_count'] =  json_encode($meeting);
           
            }
        // Notification 
        $where=array();
        $where['admin_case_noti']=0;
        $AllCaseNotify= $this->Case_details_model->findDynamic($where);
        if(!empty($toatalQuery)){
            $data['AllCaseNotify'] =  count($AllCaseNotify) ;
            $data['All_Case_Notify'] =  json_encode($AllCaseNotify);
        }
        $where1=array();
        $where1['admin_case_noti']=0;
        $where1['status']=0;
        $AllPendingCaseNotify= $this->Case_details_model->findDynamic($where1);
        if(!empty($AllPendingCaseNotify)){
            $data['AllPendingCaseNotify'] =  count($AllPendingCaseNotify) ;
            $data['All_Pending_Case_Notify'] =  json_encode($AllPendingCaseNotify);
        }
        $where2=array();
        $where2['admin_slot_noti']=0;
        $SlotNotify= $this->Slot_model->findDynamic($where2);
        if(!empty($SlotNotify)){
            $data['SlotNotify'] =  count($SlotNotify) ;
            $data['Slot_Notify'] =  json_encode($SlotNotify);
        }
        
        $where3['admin_hearing_noti']=0;
        $HearingNotify= $this->Hearing_date_model->findDynamic($where3);
        if(!empty($HearingNotify)){
            $data['HearingNotify'] =  count($HearingNotify) ;
            $data['Hearing_Notify'] =  json_encode($HearingNotify);
        }
        $where4['admin_client_noti']=0;
        $ClientNotify= $this->Client_model->findDynamic($where4);
        if(!empty($ClientNotify)){
            $data['ClientNotify'] =  count($ClientNotify) ;
            $data['Client_Notify'] =  json_encode($ClientNotify);
        }
        $where5['admin_lawyer_noti']=0;
        $LawyerNotify= $this->Lawyer_model->findDynamic($where5);
        if(!empty($LawyerNotify)){
            $data['LawyerNotify'] =  count($LawyerNotify) ;
            $data['Lawyer_Notify'] =  json_encode($LawyerNotify);
        }
        $where6['admin_pay_noti']=0;
        $PayNotify= $this->Payment_model->findDynamic($where6);
        if(!empty($PayNotify)){
            $data['PayNotify'] =  count($PayNotify) ;
            $data['Pay_Notify'] =  json_encode($PayNotify);
        }
        $where7['admin_query_noti']=0;
        $QueryNotify= $this->Query_model->findDynamic($where7);
        if(!empty($QueryNotify)){
            $data['QueryNotify'] =  count($QueryNotify) ;
            $data['Query_Notify'] =  json_encode($QueryNotify);
        }
        $where8['admin_certi_noti']=0;
        $CertiNotify= $this->Certificate_model->findDynamic($where8);
        if(!empty($CertiNotify)){
            $data['CertiNotify'] =  count($CertiNotify) ;
            $data['Certi_Notify'] =  json_encode($CertiNotify);
        }
        $where9['admin_noti']=0;
        $RefundNotify= $this->Refund_model->findDynamic($where9);
        if(!empty($RefundNotify)){
            $data['RefundNotify'] =  count($RefundNotify) ;
            $data['Refund_Notify'] =  json_encode($RefundNotify);
        }
       
        $where10['news_noti']=0;
        $newsNoti= $this->Latest_News_model->findDynamic($where10);
        if(!empty($newsNoti)){
            $data['newsNoti'] =  count($newsNoti) ;
            $data['news_Noti'] =  json_encode($newsNoti);
        }

        $sql = "SELECT id,status FROM lawyer WHERE status = '2' OR status = '1' ";
        $dbData = $this->Certificate_model->rawQuery($sql);
        $data['newLawyer'] = count($dbData);

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

        $this->global['pageTitle'] = 'Admin Dashboard';

        $this->loadViews("admin/dashboard", $this->global, $data , NULL,'admin');
    }  
        

    public function send_mail_CL()
    { 
      
        $this->load->library('form_validation');
        $this->form_validation->set_rules('info', 'info','required');

        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            
            $insertdata                       = array();
            $insertdata['mail']               = $form_data['mail'];
            $insertdata['info']               = $form_data['info'];
            $insertdata['status']             = 1;
            $insertdata['date_at']            = date("Y-m-d H:i:s");
            $result                           = $this->mail_info_model->save($insertdata);
            
            if ($result > 0) {

                        $toEmail = $insertdata['mail'] ;// client gmail addresss 
                        $subject = "Info for Insaaf99.com ";
                        $message = join('', array(
                          "<div style='background:#cad4f6e6; border-radius:8px;padding:7px; text-align:justify;'>",
                          "<p style='font-size:15px;'>",
                          "Hello Dear",
                          "<p/>",
                          "<br/>",
                          "<b style='font-size:15px; color:#3a3a8a;'>",
                          "Email : ",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['mail'],
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px; color:#3a3a8a;'>",
                          "Information : ",
                          "</b>",
                          "<b style='font-size:15px;'>",
                          $insertdata['info'],
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px;'>",
                          "Inconvenience is Regretted",
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px;'>",
                          "Team",
                          "</b>",
                          "<br/>",
                          "<b style='font-size:15px;color: #0075ff;'>",
                          "Insaaf99",
                          "</b>",
                          "<div>"
                      ));
                       $this->send_email($toEmail, $subject, $message);

                $this->session->set_flashdata('success', 'Your mail sent Successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to send mail');
            }
            redirect(base_url('admin'));
        }
    }  
    public function saveFormData(){
        $this->global['pageTitle'] = 'Insaaf99 : view Client';
        $this->loadViews("admin/saveformdata", $this->global, NULL , NULL ,'admin');    
        
    }
}
?>