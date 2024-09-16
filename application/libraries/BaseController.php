<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
/**
 * Class : BaseController
 * Base Class to control over all the classes

 * @since : 15 November 2016
 */
class BaseController extends CI_Controller {
	protected $role = '';
	protected $vendorId = '';
	protected $name = '';
	protected $roleText = '';
	protected $global = array ();
	
	

	/**
	 * Takes mixed data and optionally a status code, then creates the response
	 *
	 * @access public
	 * @param array|NULL $data
	 *        	Data to output to the user
	 *        	running the script; otherwise, exit
	 */
	public function response($data = NULL) {
		$this->output->set_status_header ( 200 )->set_content_type ( 'application/json', 'utf-8' )->set_output ( json_encode ( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) )->_display ();
		exit ();
	}
	
	/**
	 * This function used to check the user is logged in or not
	 */
	function isLoggedIn() {
		$isLoggedIn = $this->session->userdata ( 'isLoggedIn' );
		
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect ( 'admin/login' );
		} else {
			$this->role = $this->session->userdata ( 'role' );
			$this->vendorId = $this->session->userdata ( 'userId' );
			$this->name = $this->session->userdata ( 'name' );
			$this->roleText = $this->session->userdata ( 'roleText' );
			
			$this->global ['name'] = $this->name;
			$this->global ['role'] = $this->role;
			$this->global ['role_text'] = $this->roleText;
		}
	}


	// code for sub admin check login or not  

	function isLoggedSubAdmin() {
		$isLoggedSubAdmin = $this->session->userdata ('isLoggedSubAdmin');
		
		if (! isset ( $isLoggedSubAdmin ) || $isLoggedSubAdmin != TRUE) {
			redirect ( 'sub_admin/login' );
		} else {
			$this->role = $this->session->userdata ( 'role' );
			$this->vendorId = $this->session->userdata ( 'userId' );
			$this->name = $this->session->userdata ( 'name' );
			$this->roleText = $this->session->userdata ( 'roleText' );
			
			$this->global ['name'] = $this->name;
			$this->global ['role'] = $this->role;
			$this->global ['role_text'] = $this->roleText;
		}
	}

	// check user already exits or not  using mobile, email 
	function checkuserexit($columnname,$value){
		$where[$columnname]  = $value;
		$status    = $this->client_model->findOneBy($where);
		return $status;
	}
	
	// check user already exits or not  using mobile, email 

//    client dashboard login  strat
	function isUserLoggedIn() {
 	$isLoggedIn = $this->session->userdata('isUserLoggedIn');
      
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect ( base_url('login') );
		} else {

			$this->role = $this->session->userdata ( 'role' );
			$this->vendorId = $this->session->userdata ( 'userId' );
			$this->name = $this->session->userdata ( 'name' );
			$this->roleText = $this->session->userdata ( 'roleText' );
			
			$this->global ['name'] = $this->name;
			$this->global ['role'] = $this->role;
			$this->global ['role_text'] = $this->roleText;
		}
	}
//    Lawyer dashboard login  strat
	function isLawyerLoggedIn() {
		$isLoggedIn = $this->session->userdata('isLawyerLoggedIn');
		
      
		if (! isset ( $isLoggedIn ) || $isLoggedIn != TRUE) {
			redirect ( base_url('login'));
		} else {

			$this->role = $this->session->userdata ( 'role' );
			$this->vendorId = $this->session->userdata ( 'userId' );
			$this->name = $this->session->userdata ( 'name' );
			$this->roleText = $this->session->userdata ( 'roleText' );
			
			$this->global ['name'] = $this->name;
			$this->global ['role'] = $this->role;
			$this->global ['role_text'] = $this->roleText;
		}
	}
  //    Lawyer dashboard login  end
	// end code for sub admin check login or not 

	public function get_ordersales($day,$model_name)
    {
      
        if($day==1){
            $day =0;
        }else{
            $day = $day;
        }
        date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
        $dt = date('Y-m-d H:i:s');
        $dt = strtotime($dt);
        $dt = strtotime("-$day day", $dt);     
        $week_date =  date('Y-m-d', $dt);
        $current_date  = date('Y-m-d H:i:s');
        $sql = "select * from `cases`  where `dt` BETWEEN '$week_date' AND '$current_date'";
        $result = $this->$model_name->rawQuery($sql);
        if(!empty($result))
        {
            return $result;
        }
    }

	
	/* code for menu */
    public function getCategory($data)
    {
    	
        $table = $data['table'];
        $arr = array();
        $arr['status']      = 1;
        $arr['field']       =   'name,name_hi,id,image,slug_url';
        $arr['limit']       =   $data['limit'];  
        $arr['table']       =   $table;
     
		$mainMenu = $this->Category_model->findDynamic($arr);
		
        $mainCategoryList = array();
        foreach ($mainMenu as $key => $value) {
            $mainCategoryList[$value->id] = $value;
            $inData = isset($inData)?$inData.","."'".$value->id."'":"'".$value->id."'";
			
        }
        if(isset($inData)){
            $sql = "SELECT category_id,sub_category,sub_category_hi,id,slug_url FROM `sub_category` WHERE `category_id` in ($inData) AND `status`='1'";
            $rData = $this->Category_model->rawQuery($sql);
		   
        }
        $subCategoryList = array();
        if(!empty($rData)){
			foreach ($rData as $value) {
				$subCategoryList[$value->id] = $value;
				$inData1 = isset($inData1)?$inData1.","."'".$value->id."'":"'".$value->id."'";
			}
		}
		if(isset($inData1)){
            $sql = "SELECT id,category_id,sub_category_id,sub_sub_category_name,sub_sub_category_name_hi,slug_url,price,discount,save_price,gross_price,gst,gst_price FROM `sub_sub_category` WHERE `sub_category_id` in ($inData1) AND `status`='1'";
            $rData1 = $this->Category_model->rawQuery($sql);
		   
        }
		$subCategoryList1 = array();
        if(!empty($rData1)){
			foreach ($rData1 as $value) {
				$subCategoryList1[$value->id] = $value;
				
			}
		}
		
        $data = array('category' => $mainCategoryList, 'subCategory' =>$subCategoryList, 'sub_subCategory' =>$subCategoryList1  );
        

		return $data;
        
    }
	// public function get_ordersales($day,$model_name)
    // {
      
    //     if($day==1){
    //         $day =0;
    //     }else{
    //         $day = $day;
    //     }
    //     date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
    //     $date_at = date('Y-m-d H:i:s');
    //     $date_at = strtotime($date_at);
    //     $date_at = strtotime("-$day day", $date_at);     
    //     $week_date =  date('Y-m-d', $date_at);
    //     $current_date  = date('Y-m-d H:i:s');
    //     $sql = "select purchase.* , shipping.* , orders.* from purchase purchase, orders orders, z_shipping shipping where purchase.order_id = shipping.order_id and orders.order_id = shipping.order_id and orders.date_at BETWEEN '$week_date' AND '$current_date'  GROUP BY orders.date_at  ";
    //     $result = $this->$model_name->rawQuery($sql);
    //     if(!empty($result))
    //     {
    //         return $result;
    //     }
    // }

	

	/**
	 * This function is used to check the access
	 */
	function isAdmin() {
		if ($this->role != ROLE_ADMIN) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * This function is used to check the access
	 */
	function isTicketter() {
		if ($this->role != ROLE_ADMIN || $this->role != ROLE_MANAGER) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * This function is used to load the set of views
	 */
	function loadThis() {
		$this->global ['pageTitle'] = 'CodeInsect : Access Denied';
		
		$this->load->view ( 'includes/header', $this->global );
		$this->load->view ( 'access' );
		$this->load->view ( 'includes/footer' );
	}
	
	/**
	 * This function is used to logged out user from system
	 */
	function logout() {
		$this->session->sess_destroy ();
		
		redirect ( 'login' );
	}

	/**
     * This function used to load views
     * @param {string} $viewName : This is view name
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $pageInfo : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return {null} $result : null
     */
    function loadViews($viewName = NULL, $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL,$type = NULL){

		
		if($type=="admin")
		{
			$header_location="admin/includes/header";
			$footer_location="admin/includes/footer";
		}
		else if($type=='sub_admin')
		{
			$header_location="sub_admin/includes/header";
			$footer_location="sub_admin/includes/footer";
		}
		else if($type=='lawyer')
		{
			$header_location="lawyer/includes/header";
			$footer_location="lawyer/includes/footer";
		}
		else if($type=='client')
		{
			$header_location="client/includes/header";
			$footer_location="client/includes/footer";
		}

		if(!isset($pageInfo['header_hide'])){
        	$this->load->view($header_location, $headerInfo);
		}
        $this->load->view($viewName, $pageInfo);
		if(!isset($pageInfo['footer_hide'])){
        	$this->load->view($footer_location, $pageInfo);
		}
    }

    function loadSingleViews($viewName = NULL,  $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

        //$this->load->view('admin/includes/header', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        //$this->load->view('admin/includes/footer', $footerInfo);
    }
	
	/**
	 * This function used provide the pagination resources
	 * @param {string} $link : This is page link
	 * @param {number} $count : This is page count
	 * @param {number} $perPage : This is records per page limit
	 * @return {mixed} $result : This is array of records and pagination data
	 */
	function paginationCompress($link, $count, $perPage = 10) {
		$this->load->library ( 'pagination' );
	
		$config ['base_url'] = base_url () . $link;
		$config ['total_rows'] = $count;
		$config ['uri_segment'] = SEGMENT;
		$config ['per_page'] = $perPage;
		$config ['num_links'] = 5;
		$config ['full_tag_open'] = '<nav><ul class="pagination">';
		$config ['full_tag_close'] = '</ul></nav>';
		$config ['first_tag_open'] = '<li class="arrow">';
		$config ['first_link'] = 'First';
		$config ['first_tag_close'] = '</li>';
		$config ['prev_link'] = 'Previous';
		$config ['prev_tag_open'] = '<li class="arrow">';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = 'Next';
		$config ['next_tag_open'] = '<li class="arrow">';
		$config ['next_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li class="arrow">';
		$config ['last_link'] = 'Last';
		$config ['last_tag_close'] = '</li>';
	
		$this->pagination->initialize ( $config );
		$page = $config ['per_page'];
		$segment = $this->uri->segment ( SEGMENT );
	
		return array (
				"page" => $page,
				"segment" => $segment
		);
	}
	function convert_number_to_words(float $number)
     {
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? 'Rupees '.$Rupees : '') . $paise;
}

// Ninety Nine Rupees Only

	public function send_email($toEmail,$subject,$message,$attachment=null){

        $mail = new PHPMailer(true);

        //Enable SMTP debugging.

        $mail->SMTPDebug = 0; // if want on put 3 and hide 0

        //Set PHPMailer to use SMTP.

        $mail->isSMTP();

        //Set SMTP host name

        $mail->Host         = "insaaf99.com";

        //Set this to true if SMTP host requires authentication to send email

        $mail->SMTPAuth     = true;

        //Provide username and password

        $mail->Username     = "admin@insaaf99.com";

        $mail->Password     = "Jkm!@#$%54321";

        //If SMTP requires TLS encryption then set it

        $mail->SMTPSecure   = "tls";

        //Set TCP port to connect to

        $mail->Port         = '26';//587;

        $mail->From         = "admin@insaaf99.com";

        $mail->FromName     = " Insaaf99 ";

        //$mail->addAddress($userData['email']);

        $toArr = explode(',',$toEmail);
        foreach ($toArr as $mail_Id) {
        	$mail->addAddress($mail_Id);//user email address
        }

        $mail->isHTML(true);

        // attachment
		// if(isset($attachment) && !empty($attachment)){
		// 	$mail->addAttachment($attachment);
		// }

        $mail->Subject =$subject;

        $mail->Body = $message;

        try {

            $mail->send();

           return 1;

        } catch (Exception $e) {

            echo "Mailer Error: " . $mail->ErrorInfo;

        }

    }


	

//code for payment gatway details fill 

	 public function prepareData($amount,$razorpayOrderId,$userDetails)
	 {
	 $data = array(
		 "key" => $this->config->item('razPaykey_id'),
		 "amount" => $amount,
		 "name" => "Insaaf99",
		 "image" =>  base_url()."assets/images/law_logo.png",
		 "prefill" => array(
		 "name"  =>$userDetails['name'],
		 "id"  =>$userDetails['id'],
		 "email"  =>$userDetails['email'],
		 "contact"  => $userDetails['phone'],
						   ),
		 "notes"  => array(
	   "address"  =>'',
	   "merchant_order_id" => rand(),
						 ),
		 "theme"  => array(
		 "color"  => "#e2146f"
					 ),
		   "order_id" => $razorpayOrderId,
	   );
  
	 return $data;
	 }


	//  functio to add multiple images

	
public function addImage()
{

    if (isset($_FILES['attachfile']['name']) && $_FILES['attachfile']['name'] != '') 
    {
        $image_array = [];

        foreach ($_FILES['attachfile']['tmp_name'] as $key => $val)
        {
            $filename = $_FILES['attachfile']['name'][$key];
    
            $f_tmp = $_FILES['attachfile']['tmp_name'][$key];
            $img_extension = explode('.', $filename);
            $img_extension = strtolower(end($img_extension));
            $f_newfile = uniqid() . '.' . $img_extension;
            $store = "uploads/certificale/" . $f_newfile;

			if(!move_uploaded_file($f_tmp,$store))
			{
				$this->session->set_flashdata('error', 'Image Upload Failed .');
			}else
			{
		
				$image_array[] = $store;
			}
        }
        return $image_array;
    }
}


}