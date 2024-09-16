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
class Specialization extends BaseController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/specialization_model');

        
    }


    public function index()
    { 
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Specialization';
        $this->loadViews("admin/specialization/list", $this->global, NULL, NULL, 'admin');
        
    }


    public function addnew()
    { 
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Specialization';
        $this->loadViews("admin/specialization/addnew", $this->global, NULL, NULL, 'admin');
        
    }


      // Insert Specialization category *************************************************************
      public function insertnow()
      {
        //   pre($_POST);
        //   exit();
          
          $this->isLoggedIn();
          $this->load->library('form_validation');
          $this->form_validation->set_rules('title', 'title', 'trim|required');
          $this->form_validation->set_rules('description', 'description', 'trim|required');
          //form data 
          $form_data = $this->input->post();
         
          if ($this->form_validation->run() == FALSE) {
              $this->addnew();
          } else {

              $insertData['title']             = $form_data['title'];
              $insertData['title_hi']          = $form_data['title_hi'];
              $insertData['img_alt']          = $form_data['img_alt'];
              $insertData['slug']         = $form_data['slug_url'];
              $insertData['status']           = $form_data['status'];
              $insertData['description']     = $form_data['description'];
              $insertData['descreption_hi']     = $form_data['descreption_hi'];
              $insertData['meta_keyword'] = $form_data['meta_keyword'];
              $insertData['meta_description']     = $form_data['meta_description'];
              $insertData['meta_url']    = $form_data['meta_url'];
              $insertData['meta_title']              = $form_data['meta_title'];
              $insertData['meta_og_description']        = $form_data['meta_og_description'];
              $insertData['meta_twitter_title']            = $form_data['meta_twitter_title'];
              $insertData['meta_twitter_description']            = $form_data['meta_twitter_description'];
              $insertData['meta_canonical']            = $form_data['meta_canonical'];
              $insertData['dt'] = date("Y-m-d H:i:s");

              if (isset($_FILES['banner_img']['name']) && $_FILES['banner_img']['name'] != '') {
                  $f_name      = $_FILES['banner_img']['name'];
                  $f_tmp       = $_FILES['banner_img']['tmp_name'];
                  $f_size      = $_FILES['banner_img']['size'];
                  $f_extension = explode('.', $f_name);
                  $f_extension = strtolower(end($f_extension));
                  $f_newfile   = uniqid() . '.' . $f_extension;
                  $store       = "uploads/specialization/" . $f_newfile;
                  if (!move_uploaded_file($f_tmp, $store)) {
                      $this->session->set_flashdata('error', 'Image Upload Failed .');
                  } else {
                      $insertData['banner_img'] = $f_newfile;
                      
                  }
              }

              if (isset($_FILES['detail_img']['name']) && $_FILES['detail_img']['name'] != '') {
                  $f_name      = $_FILES['detail_img']['name'];
                  $f_tmp       = $_FILES['detail_img']['tmp_name'];
                  $f_size      = $_FILES['detail_img']['size'];
                  $f_extension = explode('.', $f_name);
                  $f_extension = strtolower(end($f_extension));
                  $f_newfile   = uniqid() . '.' . $f_extension;
                  $store       = "uploads/specialization/" . $f_newfile;
                  if (!move_uploaded_file($f_tmp, $store)) {
                      $this->session->set_flashdata('error', 'Image Upload Failed .');
                  } else {
                      $insertData['detail_img'] = $f_newfile;
                      
                  }
              }
              
              $result = $this->specialization_model->save($insertData);
              
              if ($result > 0) {
                  $this->session->set_flashdata('success', 'Specialization successfully Added');
                  redirect('admin/specialization/');
              } else {
                  $this->session->set_flashdata('error', 'Specialization Addition failed');
              }
              redirect('admin/specialization/addnew');
          }
          
      }

    
    // Member list
    public function ajax_list()
    {
      
        error_reporting(0);
        $list= $this->specialization_model->get_datatables();
 
       $subCategoryList = array();
       $data = array();
       $no =(isset($_POST['start']))?$_POST['start']:'';

       foreach ($list as $currentObj) {
           $subCategoryList[$currentObj->id] = $currentObj->sub_case_category_id;
       }
       // save data for parent catelgory list
     
       foreach ($list as $currentObj) {
           $temp_date = $currentObj->dt;
           $date_at = date("d-m-Y H:i:s", strtotime($temp_date));
           $no++;
           $row = array();
           $row[] = $no;
           $row[] = $currentObj->title;
           $row[] = ($currentObj->status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">Pending</span>';
           $row[] =$date_at;
           $row[] = '<a class="btn btn-sm btn-info" style="margin: 5px 0px;" href="'.base_url().'admin/specialization/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin: 4px 0px;" href="javascript:void(0)" title="delete"  data_id="'.$currentObj->id.'" ><i class="fa fa-trash"></i></a> </a> ';

           $data[] = $row;
       }
       $output = array(
                       "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                       "recordsTotal" => $this->specialization_model->count_all(),
                       "recordsFiltered" => $this->specialization_model->count_filtered(),
                       "data" => $data,
               );
       //output to json format
       echo json_encode($output);
   }
  
    
    
    // Edit
    
    public function edit($id = NULL)
    {
        
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/specialization');
        }
      
        $result = $this->specialization_model->find($id);
      
        $data=array();
        if(!empty($result)){
            $data['edit_data']=$result;
        }
        $this->global['pageTitle'] = 'Edit : specialization category';
        $this->loadViews("admin/specialization/edit", $this->global, $data, NULL, 'admin');
        
    }


     // Insert Specialization category *************************************************************
     public function update()
     {
        
         
         $this->isLoggedIn();
         $this->load->library('form_validation');
         $this->form_validation->set_rules('title', 'title', 'trim|required');
         $this->form_validation->set_rules('description', 'description', 'trim|required');
         //form data 
         $form_data = $this->input->post();
        
         if ($this->form_validation->run() == FALSE) {
             $this->edit($form_data['id']);
         } else {
           
             $insertData['id']             = $form_data['id'];
             $insertData['title']             = $form_data['title'];
             $insertData['title_hi']          = $form_data['title_hi'];
             $insertData['img_alt']          = $form_data['img_alt'];
             $insertData['slug']         = $form_data['slug_url'];
             $insertData['status']           = $form_data['status'];
             $insertData['description']     = $form_data['description'];
             $insertData['descreption_hi']     = $form_data['descreption_hi'];
             $insertData['meta_keyword'] = $form_data['meta_keyword'];
             $insertData['meta_description']     = $form_data['meta_description'];
             $insertData['meta_url']    = $form_data['meta_url'];
             $insertData['meta_title']              = $form_data['meta_title'];
             $insertData['meta_og_description']        = $form_data['meta_og_description'];
             $insertData['meta_twitter_title']            = $form_data['meta_twitter_title'];
             $insertData['meta_twitter_description']            = $form_data['meta_twitter_description'];
             $insertData['meta_canonical']            = $form_data['meta_canonical'];
             $insertData['dt'] = date("Y-m-d H:i:s");
          
             if (isset($_FILES['banner_img']['name']) && $_FILES['banner_img']['name'] != '') {
                 $f_name      = $_FILES['banner_img']['name'];
                 $f_tmp       = $_FILES['banner_img']['tmp_name'];
                 $f_size      = $_FILES['banner_img']['size'];
                 $f_extension = explode('.', $f_name);
                 $f_extension = strtolower(end($f_extension));
                 $f_newfile   = uniqid() . '.' . $f_extension;
                 $store       = "uploads/specialization/" . $f_newfile;
                 if (!move_uploaded_file($f_tmp, $store)) {
                     $this->session->set_flashdata('error', 'Image Upload Failed .');
                 } else {
                    if(isset($form_data['old_banner_img']) && !empty($form_data['old_banner_img'])){
                        $file = "uploads/specialization/".$form_data['old_banner_img'];
                        if(file_exists($file))
                        {
                            unlink($file);
                        }
                    }
                     $insertData['banner_img'] = $f_newfile;
                     
                 }
             }

             if (isset($_FILES['detail_img']['name']) && $_FILES['detail_img']['name'] != '') {
                 $f_name      = $_FILES['detail_img']['name'];
                 $f_tmp       = $_FILES['detail_img']['tmp_name'];
                 $f_size      = $_FILES['detail_img']['size'];
                 $f_extension = explode('.', $f_name);
                 $f_extension = strtolower(end($f_extension));
                 $f_newfile   = uniqid() . '.' . $f_extension;
                 $store       = "uploads/specialization/" . $f_newfile;
                 if (!move_uploaded_file($f_tmp, $store)) {
                     $this->session->set_flashdata('error', 'Image Upload Failed .');
                 } else {
                    if(isset($form_data['old_detail_img']) && !empty($form_data['old_detail_img'])){
                        $file = "uploads/specialization/".$form_data['old_detail_img'];
                        if(file_exists($file))
                        {
                            unlink($file);
                        }
                    }
                     $insertData['detail_img'] = $f_newfile;
                     
                 }
             }
             
             $result = $this->specialization_model->save($insertData);
             
             if ($result > 0) {
                 $this->session->set_flashdata('success', 'Specialization successfully Updated');
                 redirect('admin/specialization');
             } else {
                 $this->session->set_flashdata('error', 'Specialization Addition failed');
             }
             redirect('admin/specialization/edit');
         }
         
     }

    
  // delete certificate 
  public function delete()
  {
      // define path for file location 
      $this->isLoggedIn();
      $id    = $_POST['id'];
      // get image path 
      $rData = $this->specialization_model->find($id);
      
      $result = $this->specialization_model->delete($id);
      
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


    
    
}

?>