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
        $this->load->model('admin/Payment_model');
        $this->load->model('admin/sub_sub_category_model');
        $this->load->helper('cookie');
        $lang='';
        if(!empty($_COOKIE['lang']) && isset($_COOKIE['lang'])){
         $lang=$_COOKIE['lang'];
        }else{
         $lang=config_item('language');
        }
       $this->lang->load('menu',$lang);
    }

    public function prepareData($amount, $razorpayOrderId, $userDetails)
    {
        
        
        $data = array(
            "key" => $this->config->item('razPaykey_id'),
            "amount" => $amount,
            "name" => "Insaaf99",
            
            "image" => base_url() . "assets/images/law_logo.png",
            "prefill" => array(
                "name" => $userDetails['fname'] . ($userDetails['fname']) ? $userDetails['lname'] : '',
                "email" => $userDetails['email'],
                "contact" => $userDetails['mobile']
                //  "contact"  => '8937001226',
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
      
        $this->global['pageTitle'] = 'Certificate';
        $this->loadViews("admin/certificate/list", $this->global, NULL, NULL, 'admin');
    }

    public function payment()
    {  
       $data['table']  = 'category';
       $data['id']     = '-id'; // Desc when - add
       $data['limit']     = '20'; // Desc when - add
       $data['categoryMenu']           = $this->getCategory($data); 

       $form_data = $this->input->post();

       $data['doc_id']       =$form_data['doc_id'];
       $data['sub_cat_name'] =$form_data['sub_cat_name'];
       $data['sub_cat_name_hi'] =$form_data['sub_cat_name_hi'];
       $data['sub_sub_category_name'] =$form_data['sub_sub_category_name'];
       $data['sub_sub_category_name_hi'] =$form_data['sub_sub_category_name_hi'];
       $data['discount'] =$form_data['discount'];
       $data['save_price'] =$form_data['save_price'];
       $data['price'] =$form_data['price'];
       $data['gross_price'] =$form_data['gross_price'];
       $data['gst_price'] =$form_data['gst_price'];
       $data['gst'] =$form_data['gst'];
      
       $data["title"]="payment";
       $data["file"]="front/payment";
       $this->load->view('front/template',$data);
    
    }
 
    public function book_now()
    {
       $data['table']  = 'category';
       $data['id']     = '-id'; // Desc when - add
       $data['limit']     = '20'; // Desc when - add
       $data['categoryMenu']           = $this->getCategory($data); 
 
       $form_data = $this->input->post();
     
       $w['id'] = $form_data['doc_id'];
       $w['field'] = 'descreption,discount,save_price,price,gross_price,gst_price,gst';
       $categoryData =$this->sub_sub_category_model->finddynamic($w);
  
       $categoryData = json_decode(json_encode($categoryData[0]), true);
    
       $res=getPrice($categoryData['price'],$categoryData['discount'],$categoryData['gst']); 
       $grossPrice=json_decode($res);
       $grossPrice=$grossPrice->grossPrice;

       $form_data['addtional']['discount'] = $categoryData['discount'];
       $form_data['addtional']['save_price'] = $categoryData['save_price'];
       $form_data['addtional']['price'] = $categoryData['price'];
       $form_data['addtional']['gross_price'] =$grossPrice;
       $form_data['addtional']['gst_price'] = $categoryData['gst_price'];
       $form_data['addtional']['gst'] = $categoryData['gst'];
       $cartArr=json_encode(array("addtional"=>$form_data['addtional']));


       $insertdata['doc_id']                     =$form_data['doc_id'];
       $insertdata['additional']                 =$cartArr;
       $insertdata['dateAt']                     = date('Y-m-d H:i:s');
       $insertdata['status']                     =0;

     
      $result   = $this->Certificate_model->save($insertdata); // insert in certificate table
      $paymentLink = base_url('docPayment?id=').base64_encode($result);
  

     
      
      
      if($result >0){     
            // call function send email and SMS to client start
             documentationNotification($form_data,$categoryData,$grossPrice,$paymentLink);
            // call function send email and SMS to client end
                    
                /* code for send clint registration success mail */
      //   	$toEmail =$form_data['addtional']['email'] ;  // client email  
      //       $subject = "Your Certificate Request Sent Successfully ";
      //       $heading="Our Team will Contact you very soon";
      //      $content="
      //      <div style='margin-top:1px;'>
      //            <tr>
      //            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Gross Price : </td>
      //            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['addtional']['gross_price']."</span></td>
      //            </tr>
      //      </div>
      //      <div style='margin-top:1px;'>
      //            <tr>
      //            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>GST : </td>
      //            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['addtional']['gst']."%</span></td>
      //            </tr>
      //      </div>
      //      <div style='margin-top:1px;'>
      //            <tr>
      //            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
      //            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['addtional']['email']."</span></td>
      //            </tr>
      //      </div>
      //      <div style='margin-top:1px;'>
      //            <tr>
      //            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Mobile : </td>
      //            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['addtional']['mobile']."</span></td>
      //            </tr>
      //      </div>
      //      <div style='margin-top:1px;'>
      //            <tr>
      //            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Thanks & Regard</td>
      //            </tr>
      //      </div>
      //      <div style='margin-top:1px;'>
      //            <tr>
      //            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='100%' colspan='2'>Team</td>
      //            </tr>
      //      </div>
      //      <div style='margin-top:1px;'>
      //            <tr>
      //            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: blue;' width='100%' colspan='2'>Insaaf99</td>
      //            </tr>
      //      </div>
      //      ";
      //      $message=get_email_temp($heading,$content);
      //      $this->send_email($toEmail, $subject, $message);

            /* code for send clint registration success mail */
            $toEmail    ="admin@insaaf99.com";//Admin email  
            $subject = "Your Certificate Request Sent Successfully ";
            $heading="Dear Admin please check there is a new certificate request comes";
           $content="
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['addtional']['first_name']." ".$form_data['addtional']['last_name']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Gross Price : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['addtional']['gross_price']."</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>GST : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['addtional']['gst']."%</span></td>
                 </tr>
           </div>
           <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>E-mail : </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['addtional']['email']."</span></td>
                 </tr>
           </div>
           ";
           $message=get_email_temp($heading,$content);
           
        //    $this->send_email($toEmail, $subject, $message);
          }
                    if($result >0){
                       echo 1;
                       exit();
                     }
    }
    
}

?>