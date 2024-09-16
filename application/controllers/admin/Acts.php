<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Acts extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        
        parent::__construct();
        $this->load->model('admin/acts_model');
        $this->load->model('admin/base_act_category_model');
        $this->load->model('admin/base_act_sub_category_model');
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
        $this->loadViews("admin/acts/list", $this->global, NULL, NULL, 'admin');
    }
   
    
   

    public function addnew()
    {
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
        $where['status']=1;
        $result= $this->base_act_category_model->finddynamic($where);
    
        if(isset($result) && !empty($result)){
            $data['bare_act_category']=$result;
        }

        $where['status']=1;
        $result= $this->base_act_sub_category_model->finddynamic($where);
    
        if(isset($result) && !empty($result)){
            $data['bare_act_sub_category']=$result;
        }

        $this->loadViews("admin/acts/addnew", $this->global, $data, NULL, 'admin');
        
    }
    
    // delete Act 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
    
        $result = $this->acts_model->delete($id);
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

    
    // end Act 
    // Insert  *************************************************************
    public function insertnow()
    {
      
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'News Title', 'trim|required');
        
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {

            $insertData=array();
            $insertData['act_type']         = $form_data['act_type'];
            $insertData['sub_category_id']  = $form_data['sub_category_id'];
            $insertData['act_number']       = $form_data['act_number'];
            $insertData['title']            = $form_data['title'];
            $insertData['title_hi']         = $form_data['title_hi'];
            $insertData['descreption']      = $form_data['descreption'];
            $insertData['descreption_hi']   = $form_data['descreption_hi'];
            $insertData['status']           = $form_data['status'];
            $insertData['slug_url']         = $form_data['slug_url'];
            $insertData['meta_title']       = $form_data['meta_title'];
            $insertData['meta_keyword']     = $form_data['meta_keyword'];
            $insertData['meta_description'] = $form_data['meta_description'];
            $insertData['meta_url']         = $form_data['meta_url'];
            $insertData['dt']               = date("Y-m-d H:i:s");
            $result                         = $this->acts_model->save($insertData);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Bare Act Added Successfully');
                redirect('admin/acts/addnew');
            } else {
                $this->session->set_flashdata('error', ' Failed to Add Bare Act ');
                redirect('admin/acts/addnew');
            }
        }
    }
    
    
    // category list
    public function ajax_list()
    {
        error_reporting(0);
        $this->isLoggedIn();
      
        $list = $this->acts_model->get_datatables();
       
        $data = array();
        $no   = (isset($_POST['start'])) ? $_POST['start'] : '';
        // save data for parent catelgory list
        
        // pre($list);
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $no++;
            $row   = array();
            $row[] = $no;
        
            $row[] = $currentObj->categoty_title;
            $row[] = $currentObj->sub_category_title;
            $row[] = $currentObj->title;
            $row[] = $currentObj->act_number;
            $row[] = $currentObj->status == 1 ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="' . base_url() . 'admin/acts/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn"  href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
            $data[] = $row;
        }
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->acts_model->count_all(),
            "recordsFiltered" => $this->acts_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list_cat()
    {
        error_reporting(0);
        $this->isLoggedIn();
      
        $list = $this->acts_model->get_datatables();
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
            $row[] = $currentObj->act_type;
            $row[] = $currentObj->act_number;
            $row[] = $currentObj->status == 1 ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="' . base_url() . 'admin/acts/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn1"  href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
            $data[] = $row;
        }
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->acts_model->count_all(),
            "recordsFiltered" => $this->acts_model->count_filtered(),
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
            redirect('admin/acts');
        }
        $data['category']         = $this->base_act_category_model->all();
        $data['sub_category']         = $this->base_act_sub_category_model->all();
        $data['edit_data']         = $this->acts_model->find($id);

        $this->global['pageTitle'] = 'Insaaf99 :Edit News';
        $this->loadViews("admin/acts/edit", $this->global, $data, NULL, 'admin');
    }
    
    // Update category*************************************************************
    public function update()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        //form data 
        $form_data = $this->input->post();
     
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
          
            $updateData['id']          = $form_data['id'];
            $updateData['sub_category_id']  = $form_data['sub_category_id'];
            $updateData['act_type']         = $form_data['act_type'];
            $updateData['title']            = $form_data['title'];
            $updateData['title_hi']         = $form_data['title_hi'];
            $updateData['act_number']       = $form_data['act_number'];
            $updateData['descreption']      = $form_data['descreption'];
            $updateData['descreption_hi']   = $form_data['descreption_hi'];
            $updateData['status']           = $form_data['status'];
            $updateData['slug_url']         = $form_data['slug_url'];
            $updateData['meta_title']       = $form_data['meta_title'];
            $updateData['meta_keyword']     = $form_data['meta_keyword'];
            $updateData['meta_description'] = $form_data['meta_description'];
            $updateData['meta_url']         = $form_data['meta_url'];
            $updateData['update_dt']        = date("Y-m-d H:i:s");
          
          
            $result = $this->acts_model->save($updateData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Your Act  successfully Updated');
                redirect('admin/acts');
            } else {
                $this->session->set_flashdata('error', ' Failed to Update Your Act');
                redirect('admin/acts/edit/' . $updateData['id']);
            }
        }
    }

     // Add Bare Acts category 
    
     public function category()
     {
         $this->isLoggedIn();
         $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
         $this->loadViews("admin/acts/category/list", $this->global, NULL, NULL, 'admin');
         
     }
     public function sub_category()
     {
         $this->isLoggedIn();
         $this->global['pageTitle'] = 'Insaaf99 : Add New suc_ ategory';
         $this->loadViews("admin/acts/sub_category/list", $this->global, NULL, NULL, 'admin');
         
     }
     public function addcategory()
     {
         $this->isLoggedIn();
         $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
         $this->loadViews("admin/acts/category/addnew", $this->global, NULL, NULL, 'admin');
         
     }
     public function addsubcategory()
     {
         $categoryData=$this->base_act_category_model->all();

         if(isset($categoryData) && !empty($categoryData)){
           $data['category']=$categoryData;
         }

         $this->isLoggedIn();
         $this->global['pageTitle'] = 'Insaaf99 : Add New Category';
         $this->loadViews("admin/acts/sub_category/addnew", $this->global, $data, NULL, 'admin');
         
     }

     public function insertcategory()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'News Title', 'trim|required');
        
        $form_data = $this->input->post();
     
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            
            $insertData['title']       = $form_data['title'];
            $insertData['title_hi']       = $form_data['title_hi'];
            $insertData['status']         = $form_data['status'];
            $insertData['slug_url']         = $form_data['slug_url'];

              // attach Image
              if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {

                $f_name         =$_FILES['image']['name'];
                $f_tmp          =$_FILES['image']['tmp_name'];
                $f_size         =$_FILES['image']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/acts/".$f_newfile;
            
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }else
                {
              
                    $insertData['image'] = $f_newfile;
                }
                
            }

            $result= $this->base_act_category_model->save($insertData);
          
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Act Category Added Successfully');
                redirect('admin/acts/category');
            } else {
                $this->session->set_flashdata('error', ' Failed to Add Act Category ');
                redirect('admin/acts/category');
            }
        }
    }

     public function insertsubcategory()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'News Title', 'trim|required');
        
        $form_data = $this->input->post();
     
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            // pre($form_data);
            // exit();
            
            $insertData['category_id']       = $form_data['category_id'];
            $insertData['title']       = $form_data['title'];
            $insertData['title_hi']       = $form_data['title_hi'];
            $insertData['section_range']       = $form_data['section_range'];
            $insertData['status']         = $form_data['status'];
            $result= $this->base_act_sub_category_model->save($insertData);
          
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Act Sub Category Added Successfully');
                redirect('admin/acts/addsubcategory');
            } else {
                $this->session->set_flashdata('error', ' Failed to Add Act Sub Category ');
                redirect('admin/acts/addsubcategory');
            }
        }
    }
 
      // category list
      public function ajax_list1()
      {
          error_reporting(0);
          $this->isLoggedIn();
   
          $list = $this->base_act_category_model->get_datatables();
            //  pre($list);
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
              $row[] = $currentObj->status == 1 ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
              $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="' . base_url() . 'admin/acts/editActCategory/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn2"  href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
              $data[] = $row;
          }
          $output = array(
              "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
              "recordsTotal" => $this->base_act_category_model->count_all(),
              "recordsFiltered" => $this->base_act_category_model->count_filtered(),
              "data" => $data
          );
          //output to json format
          echo json_encode($output);
      }

      public function ajax_list2()
      {
          error_reporting(0);
          $this->isLoggedIn();
        
          $list = $this->base_act_sub_category_model->get_datatables();
            //  pre($list);
          $data = array();
          $no   = (isset($_POST['start'])) ? $_POST['start'] : '';
          // save data for parent catelgory list
          
          foreach ($list as $currentObj) {
              $temp_date = $currentObj->dt;
              $date_at   = date("d-m-Y", strtotime($temp_date));
              $no++;
              $row   = array();
              $row[] = $no;
            
              $row[] = $currentObj->cat_title;
              $row[] = $currentObj->title;
              $row[] = $currentObj->status == 1 ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
              $row[] = '<a class="btn btn-sm btn-info" style="margin:4px; 0px;" href="' . base_url() . 'admin/acts/editActsubCategory/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn3"  href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> ';
              $data[] = $row;
          }
          $output = array(
              "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
              "recordsTotal" => $this->base_act_category_model->count_all(),
              "recordsFiltered" => $this->base_act_category_model->count_filtered(),
              "data" => $data
          );
          //output to json format
          echo json_encode($output);
      }

        // Edit
    
    public function editActCategory($id = NULL)
    {
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/acts/category');
        }
        $data['edit_data']         = $this->base_act_category_model->find($id);
   
        $this->global['pageTitle'] = 'Insaaf99 :Edit Bare Act Category';
        $this->loadViews("admin/acts/category/edit", $this->global, $data, NULL, 'admin');
    }

    public function editActsubCategory($id = NULL)
    {
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/acts/sub_category');
        }
        $data['edit_cat_data']  = $this->base_act_category_model->all();
        $data['edit_data']         = $this->base_act_sub_category_model->find($id);
   
        $this->global['pageTitle'] = 'Insaaf99 :Edit Bare Act Category';
        $this->loadViews("admin/acts/sub_category/edit", $this->global, $data, NULL, 'admin');
    }
    
    // Update category*************************************************************
    public function updateActCategory()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        //form data 
        $form_data = $this->input->post();
      
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
        
            $updateData['id']          = $form_data['id'];
            $updateData['title']       = $form_data['title'];
            $updateData['title_hi']       = $form_data['title_hi'];
            $updateData['slug_url']         = $form_data['slug_url'];
            $updateData['status']         = $form_data['status'];

            // attach Image
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {

                $f_name         =$_FILES['image']['name'];
                $f_tmp          =$_FILES['image']['tmp_name'];
                $f_size         =$_FILES['image']['size'];
                $f_extension    =explode('.',$f_name);
                $f_extension    =strtolower(end($f_extension));
                $f_newfile      =uniqid().'.'.$f_extension;
                $store          ="uploads/acts/".$f_newfile;
            
                if(!move_uploaded_file($f_tmp,$store))
                {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                }else
                {
                    if(isset($form_data->oldimage) && !empty($form_data->oldimage)){
                        $file = $form_data->oldimage;
                        if(file_exists($file))
                        {
                            unlink($file);
                        }
                    }
                    $updateData['image'] = $f_newfile;
                }
                
            }

          
            $result = $this->base_act_category_model->save($updateData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Your Act  successfully Updated');
                redirect('admin/acts/category');
            } else {
                $this->session->set_flashdata('error', ' Failed to Update Your Act');
                redirect('admin/acts/editActCategory/' . $updateData['id']);
            }
        }
    }

    public function updateActSubCategory()
    {
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        //form data 
        $form_data = $this->input->post();
      
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
        
            $updateData['id']          = $form_data['id'];
            $updateData['category_id'] = $form_data['category_id'];
            $updateData['title']       = $form_data['title'];
            $updateData['title_hi']       = $form_data['title_hi'];
            $updateData['section_range']       = $form_data['section_range'];
            $updateData['status']         = $form_data['status'];

            $result = $this->base_act_sub_category_model->save($updateData);
            
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Your Act  successfully Updated');
                redirect('admin/acts/sub_category');
            } else {
                $this->session->set_flashdata('error', ' Failed to Update Your Act');
                redirect('admin/acts/editActsubCategory/' . $updateData['id']);
            }
        }
    }

     // delete Act category 
     public function deletecategory()
     {
         // define path for file location 
         $this->isLoggedIn();
         $id    = $_POST['id'];
        
         $result = $this->base_act_category_model->delete($id);
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
     // delete Act Sub category 
     public function deletesubcategory()
     {
         // define path for file location 
         $this->isLoggedIn();
         $id    = $_POST['id'];
        
         $result = $this->base_act_sub_category_model->delete($id);
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
     public function get_bare_sub_category()
     {
      
        $id=$_POST['id'];
        $where=array();
        $where['category_id']=$id;
        $sub_cat_dat= $this->base_act_sub_category_model->finddynamic($where);
         echo json_encode(array(
                            'data' =>$sub_cat_dat,
                            'status' => 'true'
                        ));
                       
    
     }
      


}

?>