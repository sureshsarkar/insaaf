<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Latest_News extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        
        parent::__construct();
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
        $this->loadViews("admin/latest_news/list", $this->global, NULL, NULL, 'admin');
    }
   
    
    // Add New 
    
    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
        
        $this->loadViews("admin/latest_news/addnew", $this->global, NULL, NULL, 'admin');
        
    }
    
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
        // get image path 
        $rData = $this->Latest_News_model->find($id);
        $file  = 'uploads/news/' . $rData->image;
        // delete image
        unlink($file);
        $result = $this->Latest_News_model->delete($id);
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
        $this->form_validation->set_rules('news_cat', 'News Category', 'trim|required');
        
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            
            date_default_timezone_set("Asia/Calcutta");
          
     
            $insertData['news_cat']       = $form_data['news_cat'];
            $insertData['news_cat_hi']       = $form_data['news_cat_hi'];
            $insertData['expert']         = $form_data['expert'];
            $insertData['expert_hi']         = $form_data['expert_hi'];
            $insertData['descreption']    = $form_data['descreption'];
            $insertData['descreption_hi']    = $form_data['descreption_hi'];
            $insertData['status']         = $form_data['status'];
            $insertData['slug_url']       = $form_data['slug_url'];
            $insertData['adding_date']    = date("Y-M-d");
            $insertData['dt']             = date("Y-m-d H:i:s");
            $insertData['meta_title']       = $form_data['meta_title'];
            $insertData['meta_keyword']       = $form_data['meta_keyword'];
            $insertData['meta_description']       = $form_data['meta_description'];
            $insertData['meta_url']          = $form_data['meta_url'];
            $insertData['img_alt']           = $form_data['img_alt'];

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                $f_name      = $_FILES['image']['name'];
                $f_tmp       = $_FILES['image']['tmp_name'];
                $f_size      = $_FILES['image']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/news/" . $f_newfile;
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    $insertData['image'] = $f_newfile;
                    
                }
            }

            $result                    = $this->Latest_News_model->save($insertData);
            if ($result > 0) {
                $this->session->set_flashdata('success', 'News Added Successfully');
                redirect('admin/Latest_News');
            } else {
                $this->session->set_flashdata('error', ' Failed to Add News  ');
                redirect('admin/Latest_News/addnew');
            }
        }
    }
    
    // category list
    public function ajax_list()
    {
        $this->isLoggedIn();
        error_reporting(0);
        $list = $this->Latest_News_model->get_datatables();
        $data = array();
        $no   = (isset($_POST['start'])) ? $_POST['start'] : '';
        // save data for parent catelgory list
        //    pre($list);
        
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row   = array();
            $row[] = $no;
            $row[] = $currentObj->news_cat;
            $row[] = $currentObj->expert;
            $row[] = $currentObj->status == 1 ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="' . base_url() . 'admin/Latest_News/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn"  href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
            $data[] = $row;
        }
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->Latest_News_model->count_all(),
            "recordsFiltered" => $this->Latest_News_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    // Edit
    
    public function edit($id = NULL)
    {
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/Latest_News');
        }
        $data['edit_data']         = $this->Latest_News_model->find($id);
   
        $this->global['pageTitle'] = 'Insaaf99 :Edit News';
        $this->loadViews("admin/latest_news/edit", $this->global, $data, NULL, 'admin');
    }
    
    // Update category*************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('news_cat', 'news category', 'trim|required');
        //form data 
        $form_data = $this->input->post();
    
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {

            $insertData['id']          = $form_data['id'];
            $insertData['news_cat']    = $form_data['news_cat'];
            $insertData['news_cat_hi']    = $form_data['news_cat_hi'];
            $insertData['expert']      = $form_data['expert'];
            $insertData['expert_hi']      = $form_data['expert_hi'];
            $insertData['descreption'] = $form_data['descreption'];
            $insertData['descreption_hi'] = $form_data['descreption_hi'];
            $insertData['status']      = $form_data['status'];
            $insertData['slug_url']    = $form_data['slug_url'];
            $insertData['dt']          = date("Y-m-d H:i:s");
            $insertData['meta_title']       = $form_data['meta_title'];
            $insertData['meta_keyword']       = $form_data['meta_keyword'];
            $insertData['meta_description']       = $form_data['meta_description'];
            $insertData['meta_url']       = $form_data['meta_url'];
            $insertData['img_alt']       = $form_data['img_alt'];
           
               // upload file
               if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                
                $f_name      = $_FILES['image']['name'];
                $f_tmp       = $_FILES['image']['tmp_name'];
                $f_size      = $_FILES['image']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/news/" . $f_newfile;
                
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    $file = "uploads/news/".$form_data['old_image'];
                    
                        if(file_exists( $file))
                        {
                            unlink($file);
                        }
                        $insertData['image'] = $f_newfile;
                }
            }

            $result = $this->Latest_News_model->save($insertData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Your News  successfully Updated');
                redirect('admin/Latest_News');
            } else {
                $this->session->set_flashdata('error', ' Failed to Update Your News');
                redirect('admin/Latest_News/edit/' . $insertData['id']);
            }
        }
    }

// Nesw Notification
  public function News_notify()
  {
   
      $data = array(
          'news_noti' => '1',
      );
      $result=$this->db->update('news',$data,'news_noti=0');
      
      if(!empty($result))
      {
              echo json_encode(array(
                  'status' => 'true',
                  'reload' => base_url('admin/Latest_News')
              ));
      }
      else
      { 
          echo json_encode(array(
              'status' => 'true1',
              'reload' => base_url('admin/Latest_News')
          ));
      }
      
  }
}

?>