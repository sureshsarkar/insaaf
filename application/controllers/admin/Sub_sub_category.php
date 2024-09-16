<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Sub_sub_category extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {

        parent::__construct();
       $this->load->model('admin/Category_model');
       $this->load->model('admin/Sub_category_model');
       $this->load->model('admin/Sub_sub_category_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Sub Category';
        $this->loadViews("admin/sub_sub_category/list", $this->global, NULL , NULL ,'admin');
        
    }

    // Add New 

    public function addnew()
    {
      
        $data['category'] = $this->Category_model->getparent_id();
        $data['Sub_category'] = $this->Sub_category_model->getparent_id();
      
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Category';


        $this->loadViews("admin/sub_sub_category/addnew", $this->global, $data , NULL ,'admin');  
        
        
    } 

    public function ajax_call_sub_cat_name(){
        $get_id=$this->input->post();
        //$response = $this->Sub_category_model->find($get_id['id']);
        $where['category_id']=$get_id['id'];
        $table='sub_category';
        $response  = $this->Sub_category_model->findByTable($where,$table);
       // pre(json_encode($response));
        echo json_encode($response);
    }

    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id = $_POST['id'];
        // get image path 
        $rData = $this->Sub_sub_category_model->find($id);
        $file  = 'uploads/category/'.$rData->image;
        // delete image
        unlink($file);
        $result = $this->Sub_sub_category_model->delete($id);
        if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
        else { echo(json_encode(array('status'=>FALSE))); }
    }

    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
      
        
        
        $this->isLoggedIn();
		$this->load->library('form_validation');            
        $this->form_validation->set_rules('category_id','Category','trim|required');
        $this->form_validation->set_rules('sub_category_id','Sub Category','trim|required');
        $this->form_validation->set_rules('sub_sub_category_name','Sub Category','trim|required');
        //form data 
        $form_data  = $this->input->post();
      
        if($this->form_validation->run() == FALSE)
        {
            $this->addnew();
        }
        else
        {
       
            date_default_timezone_set("Asia/Calcutta");
            $insertData['category_id']                 = $form_data['category_id'];
            $insertData['sub_category_id']             = $form_data['sub_category_id'];
            $insertData['sub_sub_category_name']       = $form_data['sub_sub_category_name'];
            $insertData['sub_sub_category_name_hi']    = $form_data['sub_sub_category_name_hi'];
            $insertData['exclusive']                   = $form_data['exclusive'];
            $insertData['price']                       = $form_data['price'];
            $insertData['discount']                    = $form_data['discount'];
            $insertData['save_price']                  = $form_data['save_price'];
            $insertData['gst']                         = $form_data['gst'];
            $insertData['gross_price']                 = $form_data['gross_price'];
            $insertData['gst_price']                   = $form_data['gst_price'];
            $insertData['short_descreption_hi']        = $form_data['short_descreption_hi'];
            $insertData['short_descreption']           = $form_data['short_descreption'];
            $insertData['descreption']                 = $form_data['descreption'];
            $insertData['descreption_hi']              = $form_data['descreption_hi'];
            $insertData['status']                      = $form_data['status'];
            $insertData['slug_url']                    = $form_data['slug_url'];
            $insertData['dt']                          =date("Y-m-d H:i:s");	
            $insertData['meta_title']                  = $form_data['meta_title'];
            $insertData['meta_keyword']                = $form_data['meta_keyword'];
            $insertData['meta_description']            = $form_data['meta_description'];
            $insertData['meta_url']                    = $form_data['meta_url'];
            $insertData['img_alt']                     = $form_data['img_alt'];
            // pre($insertData);
            // exit();
            // add image

            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
				$f_name         =$_FILES['image']['name'];
                $f_tmp          =$_FILES['image']['tmp_name'];
                $f_size         =$_FILES['image']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/sub_sub_category/".$f_newfile;
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }
                else
                {
                   $insertData['image'] = $f_newfile;
                   
                }
            }




            
            $result = $this->Sub_sub_category_model->save($insertData);
            if($result > 0)
          
            {

                $this->session->set_flashdata('success', 'Sub sub Category successfully Added');
                redirect('admin/sub_sub_category');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Sub sub Category Addition failed');
            }
            redirect('admin/sub_sub_category/addnew');
          }  
        
    }

	
    // category list
    public function ajax_list()
    {
        error_reporting(0);
		$list = $this->Sub_sub_category_model->get_datatables();
    //    pre($list);
        $CategoryList = array();
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
        // save data for parent catelgory list
        foreach ($list as $currentObj) {
            $CategoryList[$currentObj->id] = $currentObj->category_id;
        }

        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] = $no;
            $id=$currentObj->category_id;
            $cat_name=$this->Category_model->find($id);
            $row[] = $cat_name->name;
         
            $sub_id=$currentObj->sub_category_id;
            $sub_cat_name=$this->Sub_category_model->find($sub_id);

            $row[] = $sub_cat_name->sub_category;
            $row[] =$currentObj->sub_sub_category_name;
            $row[] = $currentObj->status==1?'<span class="btn-success badge">Active</span>':'<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="'.base_url().'admin/sub_sub_category/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn"  href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> ';

            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->Sub_sub_category_model->count_all(),
                        "recordsFiltered" => $this->Sub_sub_category_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    // Edit
 
    public function edit($id = NULL)
    {
        
        $this->isLoggedIn();
        if($id == null)
        {
            redirect('admin/sub_sub_category');
        }
        $data['category'] = $this->Category_model->getparent_id();
        $data['sub_category'] = $this->Sub_category_model->getparent_id();
        $data['edit_data'] = $this->Sub_sub_category_model->find($id);
     
        $this->global['pageTitle'] = 'Insaaf99 : Edit Members';
        $this->loadViews("admin/sub_sub_category/edit", $this->global, $data , NULL ,'admin');
        
        
    } 
    public function ajax_call_sub_sub_cat_name(){
        $get_id=$this->input->post();
    //    pre($get_id);
        //$response = $this->Sub_category_model->find($get_id['id']);
        $where['category_id']=$get_id['id'];
        // pre($where['category_id']);
        // exit();
        $table='sub_category';
        $response  = $this->Sub_category_model->findByTable($where,$table);
        //  pre(json_encode($response));
        echo json_encode($response);
    }
    // Update category*************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');            
        $this->form_validation->set_rules('category_id','Category','trim|required');
        $this->form_validation->set_rules('sub_category','Sub category','trim');
        $this->form_validation->set_rules('sub_sub_category','Sub Sub category','trim');
        //form data 
        $form_data  = $this->input->post();
    
        if($this->form_validation->run() == FALSE)
        {
			
                $this->edit($form_data['id']);
        }
        else
        {
      
            $insertData['id']                          = $form_data['id'];
            $insertData['category_id']                 = $form_data['category_id'];
            $insertData['sub_category_id']             = $form_data['sub_category_id'];
            $insertData['sub_sub_category_name']       = $form_data['sub_sub_category_name'];
            $insertData['sub_sub_category_name_hi']    = $form_data['sub_sub_category_name_hi'];
            $insertData['exclusive']                   = $form_data['exclusive'];
            $insertData['price']                       = $form_data['price'];
            $insertData['discount']                    = $form_data['discount'];
            $insertData['save_price']                  = $form_data['save_price'];
            $insertData['gst']                         = $form_data['gst'];
            $insertData['gross_price']                 = $form_data['gross_price'];
            $insertData['gst_price']                   = $form_data['gst_price'];
            $insertData['short_descreption_hi']        = $form_data['short_descreption_hi'];
            $insertData['short_descreption']           = $form_data['short_descreption'];
            $insertData['descreption']                 = $form_data['descreption'];
            $insertData['descreption_hi']              = $form_data['descreption_hi'];
            $insertData['status']                      = $form_data['status'];
            $insertData['slug_url']                    = $form_data['slug_url'];
            $insertData['dt']                          =date("Y-m-d H:i:s");
            $insertData['meta_title']                  = $form_data['meta_title'];
            $insertData['meta_keyword']                = $form_data['meta_keyword'];
            $insertData['meta_description']            = $form_data['meta_description'];
            $insertData['meta_url']                    = $form_data['meta_url'];
            $insertData['img_alt']                     = $form_data['img_alt'];
          
         

              // Update image

              if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {

				$f_name         =$_FILES['image']['name'];
                $f_tmp          =$_FILES['image']['tmp_name'];
                $f_size         =$_FILES['image']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/sub_sub_category/".$f_newfile;
            
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }
                else
                {
					$file = "uploads/sub_sub_category/".$form_data['old_image'];
					if(file_exists ( $file))
					{
						unlink($file);
					}
					$insertData['image'] = $f_newfile;
                   
                }
             }

          
            
            $result = $this->Sub_sub_category_model->save($insertData);
            if($result > 0)
            {
                $this->session->set_flashdata('success', 'Sub Sub  Category successfully Updated');
                redirect('admin/sub_sub_category');
            }
            else
            { 
                $this->session->set_flashdata('error', 'Sub Sub Category Updation failed');
            }
            redirect('admin/sub_sub_category/edit/'.$insertData['id']);
          }  
        
    }
 // Add Classes************************************************
    public function addClasses(){
        $form_data  = $this->input->post();
           $arr = array();
            if(isset($form_data) && !empty($form_data)){
                $w['id'] = $form_data['id'];
                $w['field'] = 'classes';
                $arr = $this->Sub_sub_category_model->finddynamic($w);

                if($arr[0]->classes == ''){
                    $classData = array("class"=>$form_data['class'],"classDescreption"=>$form_data['classDescreption']);
                    $arr[0] = $classData;
                }else{
                    foreach ($arr as $k => $v) {
                        $jsonData = json_decode($v->classes);
                        $arr =  $jsonData;
                        
                        $classData = array("class"=>$form_data['class'],"classDescreption"=>$form_data['classDescreption']);
                        $arr[] =  $classData;
                        
                    }
                }
                
                $insertData['id']                          = $form_data['id'];
                $insertData['classes']                 = json_encode($arr);
              
                $result = $this->Sub_sub_category_model->save($insertData);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Classes Added successfully');
                    redirect('admin/sub_sub_category/edit/'.$insertData['id']);
                }
                else
                { 
                    $this->session->set_flashdata('error', 'Failed Classes to Add');
                }
                redirect('admin/sub_sub_category/edit/'.$insertData['id']);
            }else{
                $this->session->set_flashdata('error', 'Failed Classes to Add');
                redirect('admin/sub_sub_category/edit/'.$insertData['id']);
            }
    }


 // update Classes************************************************
    public function updateClasses(){
        $form_data  = $this->input->post();
       
           $arr = array();
            if(isset($form_data) && !empty($form_data)){
                $w['id'] = $form_data['id'];
                $w['field'] = 'classes';
                $rawData = $this->Sub_sub_category_model->finddynamic($w);
                $rawData = $rawData[0];
                $rawData = json_decode($rawData->classes);
                foreach ($rawData as $k => $v) {

                    if($k == $form_data['key'] ){
                        $classData = array("class"=>$form_data['class'],"classDescreption"=>$form_data['classDescreption']);
                    }else{
                        $classData = array("class"=>$v->class,"classDescreption"=>$v->classDescreption);
                    }
                       
                        $arr[] =  $classData;
                    }
               
                $updateClassData['id']                          = $form_data['id'];
                $updateClassData['classes']                 = json_encode($arr);
             
                $result = $this->Sub_sub_category_model->save($updateClassData);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Classes Updated successfully');
                    redirect('admin/sub_sub_category/edit/'.$updateClassData['id']);
                }
                else
                { 
                    $this->session->set_flashdata('error', 'Failed to Update Classes');
                }
                redirect('admin/sub_sub_category/edit/'.$updateClassData['id']);
            }else{
                $this->session->set_flashdata('error', 'Please Fill the Data Correctly');
                redirect('admin/sub_sub_category/edit/'.$updateClassData['id']);
            }
    }
}

?>