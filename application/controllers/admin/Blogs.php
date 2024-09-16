<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Blogs extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('admin/blogs_model');
        $this->load->model('admin/Latest_News_model');
        $this->load->model('admin/Category_model');
    }
    
    /**
     * Index Page for this controller.
     */
    public function index()
    {
        // $this->isLoggedIn();

        $this->global['pageTitle'] = 'Insaaf99 : Sub Category';
        $this->loadViews("admin/blogs/list", $this->global, NULL, NULL, 'admin');
    }
   
    
    // Add New 
    
    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
        
        $this->loadViews("admin/blogs/addnew", $this->global, NULL, NULL, 'admin');
        
    }
    
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
       
        $result = $this->blogs_model->delete($id);
        if ($result > 0) {
            echo (json_encode(array(
                'status' => TRUE
            )));
        } else {
            echo (json_encode(array(
                'status' => FALSE
            )));
        }
    }
    
    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
      
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'News Title', 'trim|required');
        
        $form_data = $this->input->post();
        
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            
            date_default_timezone_set("Asia/Calcutta");
            $arr = array();
            $fqTitle = $form_data['fqTitle'];
            $fqDescription = $form_data['fqDescription'];
                if(isset($fqTitle) && !empty($fqTitle)){
                    for($i = 0; $i< count($fqTitle); $i++){
                    $arr [] = array("fqTitle"=>$fqTitle[$i],"fqDescription"=>$fqDescription[$i]);
                    }

                }

            $insertData['title']       = $form_data['title'];
            $insertData['title_hi']       = $form_data['title_hi'];
            $insertData['author_name']       = $form_data['author_name'];
            $insertData['descreption']    = $form_data['descreption'];
            $insertData['descreption_hi']    = $form_data['descreption_hi'];
            $insertData['status']         = $form_data['status'];
            $insertData['slug_url']       = $form_data['slug_url'];
            $insertData['dt']             = date("Y-m-d H:i:s");
            $insertData['meta_title']       = $form_data['meta_title'];
            $insertData['meta_keyword']       = $form_data['meta_keyword'];
            $insertData['meta_description']       = $form_data['meta_description'];
            $insertData['meta_url']       = $form_data['meta_url'];
            $insertData['fqData']       = (isset($arr) && !empty($arr))?json_encode($arr):"";
      
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                $f_name      = $_FILES['image']['name'];
                $f_tmp       = $_FILES['image']['tmp_name'];
                $f_size      = $_FILES['image']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/blogs/" . $f_newfile;
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {

                    if(isset($form_data['old_image']) && !empty($form_data['old_image'])){
                        $file = "uploads/blogs/" .$form_data['old_image'];
                        if(file_exists($file))
                        {
                            unlink($file);
                        }
                    }

                    $insertData['image'] = $f_newfile;
                    
                }
            }

            if (isset($_FILES['author_image']['name']) && $_FILES['author_image']['name'] != '') {
                $f_name      = $_FILES['author_image']['name'];
                $f_tmp       = $_FILES['author_image']['tmp_name'];
                $f_size      = $_FILES['author_image']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/blogs/" . $f_newfile;
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                       
                    $insertData['author_image'] = $f_newfile;
                    
                }
            }

            $result                    = $this->blogs_model->save($insertData);
         
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Act Added Successfully');
                redirect('admin/blogs');
            } else {
                $this->session->set_flashdata('error', ' Failed to Add News  ');
                redirect('admin/blogs/addnew');
            }
        }
    }
    
    // category list
    public function ajax_list()
    {
        error_reporting(0);
        $this->isLoggedIn();
      
        $list = $this->blogs_model->get_datatables();
        //    pre($list);
        $data = array();
        $no   = (isset($_POST['start'])) ? $_POST['start'] : '';
        // save data for parent catelgory list
        
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = $currentObj->title;
            $row[] = $currentObj->author_name;
            ($currentObj->treanding==1)?$checked="checked":$checked="";
            $row[] ='<input type="checkbox" id="treanding'.$currentObj->id.'"  name="treanding" data_id="'.$currentObj->id.'" class="trending" data_colname="treanding" '.$checked.' />';
            $row[] = $currentObj->status == 1 ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="' . base_url() . 'admin/blogs/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn"  href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
            $data[] = $row;
        }
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->blogs_model->count_all(),
            "recordsFiltered" => $this->blogs_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    // update by ajax 
    public function changestatus(){

        if(isset($_POST['id']) && $_POST['id'] !='')
        {
            
            $columnName  = $_POST['columnName'];
            $insertData['id'] = $_POST['id'];
            $insertData[$columnName] = $_POST['status'];
            $result = $this->blogs_model->save($insertData);
            
        }
    }
    
    // Edit
    
    public function edit($id = NULL)
    {
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/blogs');
        }
        $data['edit_data']         = $this->blogs_model->find($id);
   
        $this->global['pageTitle'] = 'Insaaf99 :Edit News';
        $this->loadViews("admin/blogs/edit", $this->global, $data, NULL, 'admin');
    }
    
    // Update category*************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        //form data 
        $form_data = $this->input->post();
        // pre($form_data['fqTitle']);
        // exit();
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
            date_default_timezone_set("Asia/Calcutta");
            
            $arr = array();
            $fqTitle = $form_data['fqTitle'];
            $fqDescription = $form_data['fqDescription'];
                if(isset($fqTitle) && !empty($fqTitle)){
                    for($i = 0; $i< count($fqTitle); $i++){
                    $arr [] = array("fqTitle"=>$fqTitle[$i],"fqDescription"=>$fqDescription[$i]);
                    }

                }
            
            $updateData['id']       = $form_data['id'];
            $updateData['title']       = $form_data['title'];
            $updateData['title_hi']       = $form_data['title_hi'];
            $updateData['author_name']       = $form_data['author_name'];
            $updateData['descreption']    = $form_data['descreption'];
            $updateData['descreption_hi']    = $form_data['descreption_hi'];
            $updateData['status']         = $form_data['status'];
            $updateData['slug_url']       = $form_data['slug_url'];
            $updateData['update_dt']             = date("Y-m-d H:i:s");
            $updateData['meta_title']       = $form_data['meta_title'];
            $updateData['meta_keyword']       = $form_data['meta_keyword'];
            $updateData['meta_description']       = $form_data['meta_description'];
            $updateData['meta_url']       = $form_data['meta_url'];
            $updateData['fqData']       = (isset($arr) && !empty($arr))?json_encode($arr):"";

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                
                $f_name      = $_FILES['image']['name'];
                $f_tmp       = $_FILES['image']['tmp_name'];
                $f_size      = $_FILES['image']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/blogs/" . $f_newfile;
                
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    $file = "uploads/blogs/".$form_data['old_image'];
                    
                        if(file_exists( $file))
                        {
                            unlink($file);
                        }
                        $updateData['image'] = $f_newfile;
                }
            }
            
            if (isset($_FILES['author_image']['name']) && $_FILES['author_image']['name'] != '') {
                
                $f_name      = $_FILES['author_image']['name'];
                $f_tmp       = $_FILES['author_image']['tmp_name'];
                $f_size      = $_FILES['author_image']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/blogs/" . $f_newfile;
                
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    $file = "uploads/blogs/".$form_data['old_author_image'];
                    
                        if(file_exists( $file))
                        {
                            unlink($file);
                        }
                        $updateData['author_image'] = $f_newfile;
                }
            }
          
          
            $result = $this->blogs_model->save($updateData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Your Act  successfully Updated');
                redirect('admin/blogs');
            } else {
                $this->session->set_flashdata('error', ' Failed to Update Your Act');
                redirect('admin/blogs/edit/' . $updateData['id']);
            }
        }
    }


}

?>