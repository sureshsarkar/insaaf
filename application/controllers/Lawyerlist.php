<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Lawyerlist extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('base_library');
        $this->load->model('admin/Sub_sub_category_model');
        $this->load->model('admin/lawyer_model');
        $this->load->model('client/Client_model');
        $this->load->model('admin/Category_model'); 
         
        $this->load->model('admin/Certificate_model');
        // Cookie helper
        $this->load->helper('cookie');
        $lang='';
         if(!empty($_COOKIE['lang']) && isset($_COOKIE['lang'])){
          $lang=$_COOKIE['lang'];
         }else{
          $lang=config_item('language');
         }
        $this->lang->load('menu',$lang);
     }


    // Index =============================================================
    public function index()
    {
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 

      // search lawyer
      $fData = $_POST;
      $where = array();
      if(isset($fData['search'])){
        // TODO search according category
        $likeArr = array('fname'=>$fData['search'],'lname'=>$fData['search']);
        $where['like'] = json_encode($likeArr);
        $where['status'] = 1;
      }else{
          $where['status'] = 1;
       }
      
      $get_lawyer = $this->lawyer_model->finddynamic($where);
      $data['get_lawyer']=$get_lawyer;

      // ge category list
      $w = array();
      $w['table'] = 'case_category';
      $w['status'] = '1';
      
      $data['catData'] = $this->lawyer_model->findDynamic($w);
          // get all lawyer
      $w = array();
      $w['status']="1";
      $w['field']="id,fname, lname, gender, experience,image, practice_area,language";
      $data['lawyers'] = $this->lawyer_model->findDynamic($w);

    $data["file"]="front/lawyerlist";
    $this->load->view('front/template',$data);
    
    } 
    // Index =============================================================
    public function lawyer_details()
    {
      $id = "";
   if(isset($_GET['k']) && !empty($_GET['k'])){     
     $id = base64_decode($_GET['k']);
    }
   
      $data['table']  = 'category';
      $data['id']     = '-id'; // Desc when - add
      $data['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data); 

      $w = array();
      $w['status']="1";
      $w['table']="case_category";
      $data['caseCategory'] = $this->lawyer_model->findDynamic($w);

      $w = array();
      $w['status']="1";
      $w['id']=$id;
      $w['field']= "id, fname,lname,language,practice_area,image,experience,city,about";
       $lawyerData = $this->lawyer_model->findDynamic($w);
       if(!empty($lawyerData[0])){
         $data['lawyerData'] = $lawyerData[0];
        }
       
      $data["file"]="front/lawyer_details";
      $this->load->view('front/template',$data);
    
    } 


    // profile =============================================
    public function profile($id = null)
    {
      if(empty($id)){
        redirect('lawyerlist');
        exit;
      }
      $id = base64_decode($id);

      // get lawyer details 
      $lData = $this->lawyer_model->find($id);
      $where['lawyer_id'] = $id;
      $where['table'] = "tbl_rating";
      $data['rating_data'] = $this->lawyer_model->findDynamic($where);

     /* $get_client = $this->db->get_where('case_category', ['id'=> $case_cat2])->row();*/

      // pre($data['rating_data']);


      if(empty($lData)){
           redirect('lawyerlist');
            exit; 
      }
      $data['lawyer'] = $lData;

       // pre($lData);  

     
        
    $data["file"]="front/lawyer_detail";
    $data["title"]= $lData->fname.' '.$lData->lname." - Insaaf Lawyer";
    $this->load->view('front/template',$data);
    
    } 

   


  // lawyerreviw and reting

    public function lawyer_rating()
    {
        // print_r($this->input->post()); die();
        if (!isset($_SESSION['id']) || $_SESSION['id']=="") {
            redirect(base_url('login'));
        }
        $client_id = $_SESSION['id'];
        $lawyer_id = $this->input->post('lawyer_id');
        $postdata = array(
            'lawyer_id' => $lawyer_id,
            'client_id' => $client_id,
            'rating' => $this->input->post('rating'),
            'comment' => $this->input->post('comment')
        );
        $rating_data = $this->db->get_where('tbl_rating', ['client_id'=>$client_id, 'lawyer_id'=>$lawyer_id])->row();
        if (empty($rating_data)) {
            $insert = $this->db->insert('tbl_rating', $postdata);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Thanks for rating us </div>');
        }else{
            $update = $this->db->update('tbl_rating', $postdata, ['id'=> $rating_data->id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Rating updated sucessfully</div>');    
        }
        redirect('lawyerlist/profile/'.base64_encode($lawyer_id));
    }

    
  

}

?>