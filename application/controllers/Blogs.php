<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';
require APPPATH . "../assets/plugins/phpmailer/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require APPPATH . '/libraries/BaseController.php';


class Blogs extends BaseController { 

	public function __construct()
    {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('admin/blogs_model');
        $this->load->model('admin/Category_model');

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



    public function index()
    {
      redirect('https://insaaf99.com/blog');
        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        
       $blog = '';
       $where=array();
       $where['orderby']="-id";
       $where['limit']="3";
       $where['status']=1;
       $blog= $this->blogs_model->finddynamic($where);

       if(isset($blog) && !empty($blog)){
           $data["blogList"]=$blog;
       }

       $blog = '';
       $where=array();
       $where['orderby']="-id";
       $where['treanding']=1;
       $where['status']=1;
       $blog= $this->blogs_model->finddynamic($where);

       if(isset($blog) && !empty($blog)){
           $data["TreandBlogList"]=$blog;
       }
       $blog = '';
       $where=array();
       $where['orderby']="-id";
       $where['status']=1;
       $blog= $this->blogs_model->finddynamic($where);

       if(isset($blog) && !empty($blog)){
           $data["AllBlogs"]=$blog;
       }
       
       $data["title"]="Blogs | Insaaf99";
       $data["keywords"]=$blog[0]->meta_title;
       $data["description"]=$blog[0]->meta_description;
       $data["og_url"]="https://insaaf99.com";
       $data["og_title"]=$blog[0]->meta_title;
       $data["og_description"]=$blog[0]->meta_description;
       $data["og_site_name"]="insaaf99.com";
       $data["twitter_card"]="summary";
       $data["twitter_title"]=$blog[0]->meta_title;
       $data["twitter_description"]=$blog[0]->meta_description;
       $data["canonical"]="https://insaaf99.com";

        $data["file"]="front/blog";
        $this->load->view('front/template',$data);
    } 
    
    public function blog_details($slug)
    {

        if($slug == 'documents-required-for-pan-card-application'){
            redirect('https://insaaf99.com/blog/documents-required-for-pan-card-application');
        }elseif($slug == 'what-is-the-difference-between-lawyer-and-advocate'){
            redirect('https://insaaf99.com/blog/difference-between-lawyer-and-advocate');
        }elseif($slug == 'what-are-the-aadhar-card-address-change-documents-required'){
            redirect('https://insaaf99.com/blog/aadhar-card-address-change-documents-required');
        }elseif($slug == 'what-are-the-documents-required-for-change-of-address-in-aadhaar-card'){
            redirect('https://insaaf99.com/blog/aadhar-card-address-change-documents-required');
        }else{
            redirect('https://insaaf99.com/blog/'.$slug);
        }

        $data['table']  = 'category';
        $data['id']     = '-id'; // Desc when - add
        $data['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data); 
        $where=array();
        $where['slug_url']=$slug;
        $blogDetails= $this->blogs_model->finddynamic($where);
 
        if(isset($blogDetails) && !empty($blogDetails)){
            $data["blogDetails"]=$blogDetails[0];
        }

        $where=array();
        $where['orderby']="-id";
        $where['status']=1;
        $where['limit']=4;
        $blog= $this->blogs_model->finddynamic($where);
 
        if(isset($blog) && !empty($blog)){
            $data["blogList"]=$blog;
        }
        if(isset($blogDetails[0]) && !empty($blogDetails[0])){

            $data["title"]=$blogDetails[0]->title;
            $data["keywords"]=$blogDetails[0]->meta_title;
            $data["description"]="Blogs with lawyer online in India for free legal advice. Insaaf99 provide online lawyer consultation services and other legal help. Talk to a law consultant expert.";
            $data["og_url"]=base_url()."student-corner/blog/".$blogDetails[0]->slug_url;
            $data["og_title"]="Blogs Lawyer Online for Legal Advice in India | Insaaf99";
            $data["og_description"]="Blogs with lawyer online in India for free legal advice. Insaaf99 provide online lawyer consultation services and other legal help. Talk to a law consultant expert.";
            $data["og_site_name"]="insaaf99.com";
            $data["og_image"] = base_url()."uploads/blogs/".$blogDetails[0]->image;
            $data["twitter_card"]="summary";
            $data["twitter_title"]="Blogs Lawyer Online for Legal Advice in India | Insaaf99";
            $data["twitter_description"]="Blogs with lawyer online in India for free legal advice. Insaaf99 provide online lawyer consultation services and other legal help. Talk to a law consultant expert.";
            $data["canonical"]="https://insaaf99.com";

        }

        $data["file"]="front/blog_details";
        $this->load->view('front/template',$data);
    
    } 

 }

?>