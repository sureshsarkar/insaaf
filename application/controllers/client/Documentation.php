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
class Documentation extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Certificate_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Sub_category_model');
        $this->load->model('admin/Sub_sub_category_model');
        $this->load->model('admin/Payment_model');
        $this->load->helper('cookie');
        $lang='';
        if(!empty($_COOKIE['lang']) && isset($_COOKIE['lang'])){
         $lang=$_COOKIE['lang'];
        }else{
         $lang=config_item('language');
        }
       $this->lang->load('menu',$lang);
       $this->isUserLoggedIn();
    }

    public function prepareData($amount, $razorpayOrderId,$userData)
    {
        
        
        $data = array(
            "key" => $this->config->item('razPaykey_id'),
            "amount" => $amount,
            "name" => "Insaaf99",
            
            "image" => base_url() . "assets/images/law_logo.png",
            "prefill" => array(
                "name" => $userData['name'],
                "email" => $userData['email'],
                "contact" => $userData['phone']
            ),
            "notes" => array(
                "address" => '',
                "merchant_order_id" => rand()
            ),
            "theme" => array(
                "color" => "#e2146f"
            ),
            "order_id" => $razorpayOrderId
        );
        return $data;
    }
    
    public function index()
    { 
      $where=array();
      $where['status']=1;
      $categoryData=$this->Category_model->finddynamic($where);
      if(isset($categoryData) && !empty($categoryData)){
          $data['categoryData']=$categoryData;
      }
      $where1=array();
      $where1['status']=1;
      $sub_categoryData=$this->Sub_category_model->finddynamic($where1);
      
      if(isset($sub_categoryData) && !empty($sub_categoryData)){
          $data['sub_categoryData']=$sub_categoryData;
      }

      $where2=array();
      $where2['status']=1;
      $sub_sub_categoryData=$this->Sub_sub_category_model->finddynamic($where2);
      
      if(isset($sub_sub_categoryData) && !empty($sub_sub_categoryData)){
          $data['sub_sub_categoryData']=$sub_sub_categoryData;
      }
        $this->global['pageTitle'] = 'Documentation';
        $this->loadViews("client/documentation/document_menu", $this->global, $data, NULL, 'client');
        
    }

    public function startup_dedail($slug){
    
      $where['slug_url']=$slug;
      $result= $this->Sub_sub_category_model->finddynamic($where);
         if(isset($result) && !empty($result)){
           $data['sub_sub_category_data']=$result[0];
           $data['data']=$result[0];
         }


      $this->global['pageTitle'] = 'Client total cases ';
      $this->loadViews("client/documentation/document_detail", $this->global, $data, NULL, 'client');

    }

    public function documentation_detail($slug){
    
      $where['slug_url']=$slug;

      $result= $this->Sub_sub_category_model->finddynamic($where);


      $this->global['pageTitle'] = 'Documentation Booking';

         if(isset($result) && !empty($result)){
            $data['sub_sub_category_data']=$result[0];
           
                if($result[0]->form=='form1'){
                    $this->loadViews("client/forms/form1", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form2'){
                    $this->loadViews("client/forms/form2", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form3'){
                    $this->loadViews("client/forms/form3", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form4'){
                    $this->loadViews("client/forms/form4", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form5'){
                    $this->loadViews("client/forms/form5", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form6'){
                    $this->loadViews("client/forms/form6", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form7'){
                    $this->loadViews("client/forms/form7", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form8'){
                    $this->loadViews("client/forms/form8", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form9'){
                    $this->loadViews("client/forms/form9", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form10'){
                    $this->loadViews("client/forms/form10", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form11'){
                    $this->loadViews("client/forms/form11", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form12'){
                    $this->loadViews("client/forms/form12", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form13'){
                    $this->loadViews("client/forms/form13", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form14'){
                    $this->loadViews("client/forms/form14", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form15'){
                    $this->loadViews("client/forms/form15", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form16'){
                    $this->loadViews("client/forms/form16", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form17'){
                    $this->loadViews("client/forms/form17", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form18'){
                    $this->loadViews("client/forms/form18", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form19'){
                    $this->loadViews("client/forms/form19", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form20'){
                    $this->loadViews("client/forms/form20", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form21'){
                    $this->loadViews("client/forms/form21", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form22'){
                    $this->loadViews("client/forms/form22", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form23'){
                    $this->loadViews("client/forms/form23", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form24'){
                    $this->loadViews("client/forms/form24", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form25'){
                    $this->loadViews("client/forms/form25", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form26'){
                    $this->loadViews("client/forms/form26", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form27'){
                    $this->loadViews("client/forms/form27", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form28'){
                    $this->loadViews("client/forms/form28", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form29'){
                    $this->loadViews("client/forms/form29", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form30'){
                    $this->loadViews("client/forms/form30", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form31'){
                    $this->loadViews("client/forms/form31", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form32'){
                    $this->loadViews("client/forms/form32", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form33'){
                    $this->loadViews("client/forms/form33", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form34'){
                    $this->loadViews("client/forms/form34", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form35'){
                    $this->loadViews("client/forms/form35", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form36'){
                    $this->loadViews("client/forms/form36", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form37'){
                    $this->loadViews("client/forms/form37", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form38'){
                    $this->loadViews("client/forms/form38", $this->global, $data, NULL, 'client');
                }
                elseif($result[0]->form=='form39'){
                    $this->loadViews("client/forms/form39", $this->global, $data, NULL, 'client');
                }
                else{
                    $this->loadViews("client/documentation/document_detail", $this->global, $data, NULL, 'client');
                }
         }
    }

    // payment fucntion 
    public function payment()
    {  
      date_default_timezone_set('Asia/Kolkata'); 
        $this->isUserLoggedIn();
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('doc_id','Document ID','trim|required');
        //form data 
        $form_data  = $this->input->post();
    // pre($form_data);
    // exit();
        if($this->form_validation->run() == FALSE)
        {
            $this->documentation_detail($form_data['slug']);
        }
        else
        {
        $formArr='';
        $cartArr='';
        if((isset($form_data['first']) && !empty($form_data['first'])) && (isset($form_data['second']) && !empty($form_data['second'])) ){
            $formArr=json_encode(array("first_party"=>$form_data['first'],"second_party"=>$form_data['second']));
        }
        $cartArr=json_encode(array("cart_data"=>$form_data['cart']));

       $insertdata['user_id'] =$_SESSION['id'];
       $insertdata['doc_id'] =$form_data['doc_id'];
       $insertdata['form_data'] =$formArr;
       $insertdata['cart_data'] =$cartArr;
       $insertdata['dateAt'] =date('Y-m-d H:i:s');
       $insertdata['status'] =0;

        $image_array = array();
        if(!empty($_FILES['attachfile']['name'])){
            // call function to add multiple images
            $image_array[] = $this->addImage();
        }
        $insertdata['additional']=json_encode(array('more_details'=>$form_data['addtional'],'attachment'=>$image_array));
     
         // patment gatway
         $api= new Api($this->config->item('razPaykey_id'), $this->config->item('razSecret'));
         $_SESSION['payable_amount'] = $form_data["gross_price"];//total Pay amount
         
         $razorpayOrder = $api->order->create(array(
             'receipt' => rand(),
             'amount' => $_SESSION['payable_amount'] * 100, // rupees in paise
             'currency' => 'INR',
             'payment_capture' => 1 // auto capture
         ));

         $amount = $razorpayOrder['amount'];
         $razorpayOrderId               = $razorpayOrder['id'];
         $_SESSION['razorpay_order_id'] = $razorpayOrderId;
         $userData['name']=$_SESSION['name'];
         $userData['email']=$_SESSION['email'];
         $userData['phone']=$_SESSION['phone'];
         $data['orderDetails']          = $this->prepareData($amount, $razorpayOrderId,$userData);

         $sessionArray['CertificateDetails'] = $insertdata;// add in session
       
         $this->session->set_userdata($sessionArray);
        
         $paymentData                   = array();
         $paymentData['user_id']        =$_SESSION['id'];
         $paymentData['amount']         = $_SESSION['payable_amount'];
         $paymentData['payment_date']   = date("Y-m-d H:m:s");
         $paymentData['order_id']       = $razorpayOrderId;
         $paymentData['payment_mode']   = 'razorpay';
         $paymentData['payment_type']   = 'Documentation Payment';
         $paymentData['payment_status'] = 'pending';

         $result   =   $this->Payment_model->save($paymentData);
         $insertdata['payment_id'] =$result;

         $result1   = $this->Certificate_model->save($insertdata); // insert in certificate table

         if($result >0 && $result1 >0 ){
        
             $data_view_port=$this->load->view('front/rezarpay_for_certificate',$data,TRUE);
             echo $data_view_port;
         }
         }
    
    }
 
    public function Book_now()
    {
       $data['table']  = 'category';
       $data['id']     = '-id'; // Desc when - add
       $data['limit']     = '20'; // Desc when - add
       $data['categoryMenu']           = $this->getCategory($data); 
 
       $form_data = $this->input->post();
       date_default_timezone_set("Asia/Calcutta");

       $insertdata['sub_cat_name']               =$form_data['sub_cat_name'];
       $insertdata['sub_sub_category_name']      =$form_data['sub_sub_category_name'];
       $insertdata['discount']                   =$form_data['discount'];
       $insertdata['save_price']                 =$form_data['save_price'];
       $insertdata['price']                      =$form_data['price'];
       $insertdata['gross_price']                =$form_data['gross_price'];
       $insertdata['gst_price']                  =$form_data['gst_price'];
       $insertdata['gst']                        =$form_data['gst'];
       $insertdata['fname']                      =$form_data['first_name'];
       $insertdata['lname']                      =$form_data['last_name'];
       $insertdata['email']                      =$form_data['my_email'];
       $insertdata['mobile']                     =$form_data['my_mobile'];
       $insertdata['state']                      =$form_data['my_state'];
       $insertdata['city']                       =$form_data['my_city'];
       $insertdata['status']                     = '0';
       $insertdata['payment_status']             = '0';
       $insertdata['dt']                         = date('Y-m-d H:i:s');
       
  
                // 99 patment gatway
             
                $api                        = new Api($this->config->item('razPaykey_id'), $this->config->item('razSecret'));
                $_SESSION['payable_amount'] = $insertdata['gross_price'];//total Pay amount
                
                $razorpayOrder = $api->order->create(array(
                    'receipt' => rand(),
                    'amount' => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
                    'currency' => 'INR',
                    'payment_capture' => 1 // auto capture
                ));
                $amount = $razorpayOrder['amount'];
                $razorpayOrderId               = $razorpayOrder['id'];
                $_SESSION['razorpay_order_id'] = $razorpayOrderId;
                $data['orderDetails']          = $this->prepareData($amount, $razorpayOrderId, $insertdata);

                $result   = $this->Certificate_model->save($insertdata); // insert in certificate table

                $sessionArray['CertificateDetails'] = $insertdata;
                $this->session->set_userdata($sessionArray);

               
                $paymentData                   = array();
                $paymentData['user_id']        = $result;
                $paymentData['name']           = $insertdata['fname'] . " " . $insertdata['lname'];
                $paymentData['email']          = $insertdata['email'];
                $paymentData['mobile']         = $insertdata['mobile'];
                $payAmount                     = $amount / 100;
                $paymentData['amount']         = $payAmount;
                $paymentData['payment_date']   = date("Y/m/d h:m:s");
                $paymentData['order_id']       = $razorpayOrderId;
                $paymentData['payment_mode']   = 'razorpay';
                $paymentData['payment_type']   = 'Certificate Payment';
                $paymentData['payment_status'] = 'pending';


                // $result1   =   $this->Payment_model->save($paymentData);
               
                    // $data_view_port=$this->load->view('front/rezarpay_for_certificate',$data,TRUE);
                    // echo $data_view_port;
// Send SMS to mobile start
$clientphone = explode(' ',trim($insertdata["mobile"]));
$message='Thank you for showing your interest .Our team will contact you shortly.
Team Insaaf99.com';
                        
            //  send_sms($clientphone[0],$message);
           
// Send SMS to mobile end
                    
                /* code for send clint registration success mail */
        	$toEmail    =$insertdata['email'] ;  // client email  
            $subject = "Your Certificate Request Sent Successfully ";
            $heading="Our Team will Contact you very soon";
           $content="
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Category : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['sub_cat_name']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Sub Category : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['sub_sub_category_name']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Gross Price : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['gross_price']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>GST : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['gst']."%</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['email']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['mobile']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Thanks & Regard</td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Team</td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: blue;' width='100%' colspan='2'>Insaaf99</td>
                 </tr>
           </div>
           ";
           $message=get_email_temp($heading,$content);
           $this->send_email($toEmail, $subject, $message);
           

            /* code for send clint registration success mail */
            $toEmail    ="admin@insaaf99.com,vinny@insaaf99.com";//Admin email  
            $subject = "Your Certificate Request Sent Successfully ";
            $heading="Dear Admin please check there is a new certificate request comes";
           $content="
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['fname']." ".$insertdata['lname']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Category : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['sub_cat_name']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Sub Category : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['sub_sub_category_name']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Gross Price : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['gross_price']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>GST : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['gst']."%</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$insertdata['email']."</span></td>
                 </tr>
           </div>
           ";
           $message=get_email_temp($heading,$content);
           
           $this->send_email($toEmail, $subject, $message);

                    if($result >0){
                        $this->session->set_flashdata('success','Your certificate request send Successfully');
                        redirect(base_url());
                     }else{
                           $this->session->set_flashdata('error','Failed to  send certificate request Successfully');
                           redirect(base_url());
                         }
    }


    public function requesrCall(){

        if(isset($_POST['categoryId']) && !empty($_POST['categoryId'])){
            $arr=array("Request_for"=>"Request call for Documentation","type"=>"RequestCall");
            $cartArr=json_encode(array("addtional"=>$arr));

            $insertdata['user_id']                    =$_SESSION['id'];
            $insertdata['doc_id']                     =$_POST['categoryId'];
            $insertdata['additional']                 =$cartArr;
            $insertdata['dateAt']                     = date('Y-m-d H:i:s');
            $insertdata['status']                     =0;

            $result = $this->Certificate_model->save($insertdata);
            if($result > 0){
              echo 1;
              exit();
            }else{
              echo 2;
              exit();
            }

       
        }
      
    }
    
}

?>