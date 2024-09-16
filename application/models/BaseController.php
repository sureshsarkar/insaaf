<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 

/**
 * Class : BaseController
 * Base Class to control over all the classes

 * @since : 15 November 2016
 */
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
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
	
    

	/* this function for send mail */

	public function send_email($toEmail,$subject,$message){
        $mail = new PHPMailer(true);
        //Enable SMTP debugging.
        $mail->SMTPDebug = 0; // if want on put 3 and hide 0
        //Set PHPMailer to use SMTP.
        $mail->isSMTP();
        //Set SMTP host name
        $mail->Host         = "trufedu.com";
        //Set this to true if SMTP host requires authentication to send email
        $mail->SMTPAuth     = true;
        //Provide username and password
        $mail->Username     = "contactus@trufedu.com";
        $mail->Password     = "truFedu@2022";
        //If SMTP requires TLS encryption then set it
        $mail->SMTPSecure   = "tls";
        //Set TCP port to connect to
        $mail->Port         = '26';//587;
        $mail->From         = "help@trufedu.com";
        $mail->FromName     = "Insaaf99";
        //$mail->addAddress($userData['email']);
        $mail->addAddress($toEmail);//user email address
        $mail->isHTML(true);
        // attachment
       
        $mail->Subject =$subject;
        $mail->Body = $message;
        try {
            $mail->send();
           return 1;
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }

	/* end send mail function */



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

    function isUserLoggedIn() {
		$isLoggedIn = $this->session->userdata('isUserLoggedIn');
		
      
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

    // function isUserLoggedIn() {
	 	
	// 	$isLoggedIn = $this->session->userdata( 'userData' );
	// 	if (empty ($isLoggedIn)) {
	// 		redirect ('login');
	// 	} else {
	// 		$this->name = $this->session->userdata ( 'name' );
	// 		$this->global ['name'] = $this->name;
			
	// 	}

	// }

	
	
	public function update_Qnt($productId_list,$productQnt_list){
		$status = 0;
		foreach ($productId_list as $key => $value) {
            $sql = "SELECT no_item FROM product where id=$value";
            $result = $this->payment_model->rawQuery($sql);
        
            foreach ($result as $key1 => $value1) {
                /* code for update product quantity */
                foreach ($productQnt_list as $key => $value2) {
                $new_total = $value1->no_item+$value2;
                $data = array('no_item' =>$new_total);
                $status = $this->db->update('product',$data,'id="'.$value.'"');
                  return  $status =1;    
                }

            }
        }
	}
	public function update_Qnt1($productId_list,$productQnt_list){
		$status = 0;
		foreach ($productId_list as $key => $value) {
            $sql = "SELECT no_item FROM product where id=$value";
            $result = $this->payment_model->rawQuery($sql);
        
            foreach ($result as $key1 => $value1) {
                /* code for update product quantity */
                foreach ($productQnt_list as $key => $value2) {
                
                            $new_total = $value1->no_item-$value2;
                            $data = array('no_item' =>$new_total);
                            if($value1->no_item <= 0){
                                $data = array('no_item' =>0);
                            }else{
	                            $new_total = $value1->no_item-$value2;
	                            $data = array('no_item' =>$new_total);
                            }
          
                $status = $this->db->update('product',$data,'id="'.$value.'"');
                  return  $status =1;    
                }

            }
        }
	}

/*code for deal of day  */
	public function deal_event_day(){

		$today_date = date('Y-m-d');
		
		$today_date="2022-03-02";
		$next_date="02/27/2022";
		$sql  = "SELECT * FROM event WHERE status=1 ORDER by id DESC";
		$res  = $this->event_model->rawQuery($sql);


		if(!empty($res))
		{
			if (($today_date >= $res[0]->from_date) && ($today_date <= $res[0]->to_date)){
			   return $res[0]; 
			 
			}else{
			  return false;
			}

		}
		

	}
/* end code for deal of day */

	public function wishlistData()
	{
		if(isset($_SESSION['userData']))
		{
	        $userdata   = json_decode($_SESSION['userData']);
	        $where = array();
	        $where['user_id'] = $userdata->userId;
	        $table= 'z_whishlist';
	        $wishlist   = $this->index_model->findByTable($where,$table);
	        if(!empty($wishlist)){
	        
	          return $wishlist;
	        }
    	}
	}

	public function GetwishlistData(){
        
        if(isset($_SESSION['userData']))
        {

            $userdata           = json_decode($_SESSION['userData']);
            $where              = array();
            $where['user_id']   = $userdata->userId;
            $table              = 'z_whishlist';
            $sql                =" SELECT id,product_name,product_id from z_whishlist where user_id='".$userdata->userId."'";
            $wishlist           = $this->productlist_model->rawQuery($sql);
          
            if(!empty($wishlist)){
              return $wishlist; 
            }
        }
    }

    /* get cart list data  */
    public function getuserCart(){
    	if(!empty($_SESSION["cart"])) 
        {
            return $cart_list = json_decode($this->session->userdata('cart'),true);   
        }
    }
    /* end cart list data */
    /*
	}



	/* code for menu */
    public function getCategory($data)
    {
    	
        if(!empty($data['[parent_id']))
        {
            $parent_id = $data['[parent_id'];
        }else{
            $parent_id = '';
        }
        $table = $data['table'];
        $arr = array();
        $arr['status']      = 1;
        $arr['parent_id']   =   $parent_id;
        $arr['field']       =   'name,id,image';
        $arr['limit']       =   $data['limit'];  
        $arr['table']       =   $table;
        //$arr['orderby']     =   $data['id'];  
        $mainMenu = $this->findDynamic($arr);
        $mainCategoryList = array();
        foreach ($mainMenu as $key => $value) {
            $mainCategoryList[$value->id] = $value;
            $inData = isset($inData)?$inData.","."'".$value->id."'":"'".$value->id."'";
        }
        if(isset($inData)){
            $sql = "SELECT name,image,id,parent_id FROM `category` WHERE `parent_id` in ($inData)";
            $rData = $this->rawQuery($sql);
        }
        $subCategoryList = array();
        if(!empty($rData))
        foreach ($rData as $value) {
            $subCategoryList[$value->parent_id][$value->id] = $value;
        }

        $data = array('category' => $mainCategoryList, 'subCategory' =>$subCategoryList  );
        return $data;
        
    }


    public function get_ordersales($day)
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
        $sql = "SELECT * FROM `cases` WHERE `dt` BETWEEN '$week_date' AND '$current_date' ";
   
        $result = $this->Case_details_model->rawQuery($sql);
        pre($result);
        if(!empty($result))
        {
            return $result;
        }

    }

    // public function get_ordersales($day)
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
    //     $sql = "SELECT * FROM `z_payment` WHERE `payment_date` BETWEEN '$week_date' AND '$current_date' ";
   
    //     $result = $this->payment_model->rawQuery($sql);
    //    // pre($result);
    //     if(!empty($result))
    //     {
    //         return $result;
    //     }

    // }

    function findDynamic($where)  
    {

        foreach($where as $key=>$v)
        {
            // Fields set
            if($key == 'field')
            {
                $this->db->select($v);
            }
            
            // Order By
            if($key == 'orderby')
            {
                $temp_order = explode('-',$v);
                if(count($temp_order) >1)
                 $this->db->order_by($temp_order[1], 'DESC');
                else
                    $this->db->order_by($v, 'ASC');
            }
            // LIMIT
            if($key == 'limit')
            {
                $temp = explode(',', $v);
                if(isset($temp[1]))
                $this->db->limit($temp[0],$temp[1]);
                else
                $this->db->limit($v);
            }

            // Like
            if($key == 'like')
            {
                $temp = explode(',',$v);
                
                $this->db->like($temp[0], $temp[1]);
                
            }            
            // where
            if($key != 'field' AND $key != 'orderby' AND $key != 'limit' AND $key != 'table' AND $key != 'like')
            {
                $temp_where = array($key=>$v);
               $this->db->where($temp_where);
            }
            
        } 
        if(!isset($where['table']))
            $this->db->from($this->table);      
        else
            $this->db->from($where['table']); 

        $query = $this->db->get(); 
        //  $this->db->last_query();

        $result = $query->result();     
      //  pre($result);   
        return $result;
    }
     // raw query
    function rawQuery($sql)  
    {
        $query = $this->db->query($sql);
        //$result =  $query->result_array();
        $result = $query->result();        
        return $result;
    }
    /* end code for menu */

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
    function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

        $this->load->view('admin/includes/header', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('admin/includes/footer', $footerInfo);
    }

    function loadSingleViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL){

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
}