<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 
 * @since : 15 November 2016
 */
class Lawyer_cases extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Client_model');
        $this->load->model('admin/Case_category_model');
        $this->load->model('admin/Case_sub_category_model');
        $this->load->model('admin/Case_details_model');
        $this->load->model('admin/Lawyer_model');
    }
    
    /**
     * Index Page for this controller.
     */
    public function index($id = NULL)
    {
        $where               = array();
        $where['id']         = $id;
        $data['view_lawyer'] = $this->Lawyer_model->findDynamic($where);
        
        $this->isLoggedIn();
        $this->global['pageTitle'] = 'Insaaf99 : lawyer cases';
        $this->loadViews("admin/lawyer_cases/list", $this->global, $data, NULL, 'admin');
        
    }
    
    // Total cases list start 
    
    public function total_cases()
    {
        $this->isLoggedIn();
        $data['total_cases']       = $this->Case_details_model->getparent_id();
        $this->global['pageTitle'] = 'Total cases ';
        $this->loadViews("admin/Case_details/list1", $this->global, $data, NULL, 'admin');
        
    }
    
    // Total cases list end 
    // Total cases list start 
    
    public function pending_cases()
    {
        $this->isLoggedIn();
        $where                 = array();
        $where['status']       = 0;
        $table                 = 'cases';
        $data['pending_cases'] = $this->Case_details_model->findByTable($where, $table);
        // pre($data['pending_cases']);
        
        $this->global['pageTitle'] = 'Total cases ';
        $this->loadViews("admin/Case_details/list2", $this->global, $data, NULL, 'admin');
        
    }
    
    // Total cases list end 
    
    
    
    // Add New 
    
    public function addnew($id)
    {
        $data['client_id'] = $id;
        
        $data['case_category'] = $this->Case_category_model->getparent_id();
        
        $data['case_sub_category'] = $this->Case_sub_category_model->getparent_id();
        
        $data['lawyer_name'] = $this->Lawyer_model->getparent_id();
        
        $this->isLoggedIn();
        
        $this->global['pageTitle'] = 'Insaaf99 : Add New Client';
        
        $this->loadViews("admin/Case_details/addnew", $this->global, $data, NULL, 'admin');
        
    }
    
    
    public function ajax_call_sub_cat_name()
    {
        $get_id = $this->input->post();
        //$response = $this->Sub_category_model->find($get_id['id']);
        
        $where['case_category_id'] = $get_id['id'];
        
        $table    = 'case_sub_category';
        $response = $this->Case_sub_category_model->findByTable($where, $table);
        // pre(json_encode($response));
        echo json_encode($response);
    }
    
    public function ajax_call_lawyer()
    {
        $get_id = $this->input->post();
        //$response = $this->Sub_category_model->find($get_id['id']);
        
        $where['sub_case_category_id'] = $get_id['id'];
        $where['status']               = 1;
        $table                         = 'lawyer';
        $response                      = $this->Lawyer_model->findByTable($where, $table);
        
        echo json_encode($response);
    }
    
    
    // delete category 
    public function delete()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
        // get image path 
        $rData = $this->Case_details_model->find($id);
        
        $result = $this->Case_details_model->delete($id);
        
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
    
    //  Delete case start
    // delete category 
    public function delete1()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
        // get image path 
        $rData = $this->Case_details_model->find($id);
        
        $result = $this->Case_details_model->delete($id);
        
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
    // delete case end
    
    // delete category 
    public function delete2()
    {
        // define path for file location 
        $this->isLoggedIn();
        $id    = $_POST['id'];
        // get image path 
        $rData = $this->Case_details_model->find($id);
        
        $result = $this->Case_details_model->delete($id);
        
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
    // delete case end
    
    
    
    // end category 
    // Insert Member *************************************************************
    public function insertnow()
    {
        
        date_default_timezone_set('Asia/Kolkata');
        $this->isLoggedIn();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('asign_lawyer_id', ' Lawyer name', 'trim|required');
        //form data 
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            $this->addnew();
        } else {
            $insertData                         = array();
            $insertData['case_category_id']     = $form_data['case_category_id'];
            $insertData['case_sub_category_id'] = $form_data['case_sub_category_id'];
            $insertData['asign_lawyer_id']      = $form_data['asign_lawyer_id'];
            $insertData['case_description']     = $form_data['case_description'];
            $insertData['client_id']            = $form_data['client_id'];
            $insertData['status']               = $form_data['status'];
            $insertData['dt']                   = date("Y-m-d H:i:s");
            
            // upload file
            if (isset($_FILES['case_file']['name']) && $_FILES['case_file']['name'] != '') {
                
                $f_name      = $_FILES['case_file']['name'];
                $f_tmp       = $_FILES['case_file']['tmp_name'];
                $f_size      = $_FILES['case_file']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/cases/" . $f_newfile;
                
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    // $file = "uploads/cases/".$form_data['oldimage'];
                    
                    // if(file_exists( $file))
                    // {
                    //     unlink($file);
                    // }
                    
                    $insertData['case_file'] = $f_newfile;
                    
                }
                
            }
            
            $result = $this->Case_details_model->save($insertData);
            // pre($result);
            // exit();
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Case added successfully');
                redirect('admin/Case_details/index/' . $insertData['client_id']);
            } else {
                $this->session->set_flashdata('error', 'Case  Addition failed');
            }
            redirect('admin/client/addnew');
        }
        
    }
    
    
    
    
    
    public function ajax_list($id = NULL)
    {
        error_reporting(0);
        $where                    = array();
        $where['asign_lawyer_id'] = $id;
        $list                     = $this->Case_details_model->findDynamic($where);
        
        $no = 1;
        foreach ($list as $currentObj) {
            $row       = array();
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $row[]     = $no;
            
            $client_id   = $currentObj->client_id;
            $client_name = $this->Client_model->find($client_id);
            $row[]       = $client_name->fname . ' ' . $client_name->lname;
            
            $cat_id        = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($cat_id);
            $row[]         = $category_name->name;
            
            $sub_case_id       = $currentObj->case_sub_category_id;
            $sub_category_name = $this->Case_sub_category_model->find($sub_case_id);
            $row[]             = $sub_category_name->case_sub_category;
            
            
            $row[] = ($currentObj->status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin-bottom: 4px;" href="' . base_url() . 'admin/lawyer_cases/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a>  ';
            
            // &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="'.base_url().'admin/Case_details/view1/'.$currentObj->id.'" title="view"  data_id="'.$currentObj->id.'" ><i class="fa fa-eye"></i></a>
            
            $data[] = $row;
            $no++;
            
        }
        
        
        
        
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->Case_details_model->count_all(),
            "recordsFiltered" => $this->Case_details_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    // Total Case list
    
    
    public function ajax_list1()
    {
        error_reporting(0);
        $list = $this->Case_details_model->getparent_id();
        $no   = 1;
        foreach ($list as $currentObj) {
            $row       = array();
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $row[]     = $no;
            
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $sub_case_id       = $currentObj->case_sub_category_id;
            $sub_category_name = $this->Case_sub_category_model->find($sub_case_id);
            $row[]             = $sub_category_name->case_sub_category;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->Lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
            
            
            $client_model = $currentObj->client_id;
            $client_name  = $this->Client_model->find($client_model);
            $fullname1    = $client_name->fname . ' ' . $client_name->lname;
            $row[]        = $fullname1;
            
            $row[] = ($currentObj->status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin-bottom: 4px;" href="' . base_url() . 'admin/case_details/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="' . base_url() . 'admin/Case_details/view1/' . $currentObj->id . '" title="view"  data_id="' . $currentObj->id . '" ><i class="fa fa-eye"></i></a> ';
            
            $data[] = $row;
            $no++;
            
        }
        
        
        
        
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->Case_details_model->count_all(),
            "recordsFiltered" => $this->Case_details_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    // total Caes list end 
    
    
    // pending Case list
    
    
    public function ajax_list2()
    {
        
        error_reporting(0);
        $where['status'] = 0;
        $table           = 'cases';
        $list            = $this->Case_details_model->findByTable($where, $table);
        
        $no = 1;
        foreach ($list as $currentObj) {
            $row       = array();
            $temp_date = $currentObj->dt;
            $date_at   = date("d-m-Y", strtotime($temp_date));
            $row[]     = $no;
            
            $case_id       = $currentObj->case_category_id;
            $category_name = $this->Case_category_model->find($case_id);
            $row[]         = $category_name->name;
            
            $sub_case_id       = $currentObj->case_sub_category_id;
            $sub_category_name = $this->Case_sub_category_model->find($sub_case_id);
            $row[]             = $sub_category_name->case_sub_category;
            
            $Lawyer_model = $currentObj->asign_lawyer_id;
            $lawyer_name  = $this->Lawyer_model->find($Lawyer_model);
            $fullname     = $lawyer_name->fname . ' ' . $lawyer_name->lname;
            $row[]        = $fullname;
            
            
            $client_model = $currentObj->client_id;
            $client_name  = $this->Client_model->find($client_model);
            $fullname1    = $client_name->fname . ' ' . $client_name->lname;
            $row[]        = $fullname1;
            
            $row[] = ($currentObj->status == 1) ? '<span class="btn-success badge">Active</span>' : '<span class="btn-danger badge">InActive</span>';
            
            $row[] = $date_at;
            $row[] = '<a class="btn btn-sm btn-info" style="margin-bottom: 4px;" href="' . base_url() . 'admin/case_details/edit/' . $currentObj->id . '" title="Edit" ><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-danger deletebtn" style="margin-bottom: 4px;" href="javascript:void(0)" title="delete"  data_id="' . $currentObj->id . '" ><i class="fa fa-trash"></i></a> &nbsp;&nbsp; <a class="btn btn-sm btn-info " style="margin-bottom: 4px;" href="' . base_url() . 'admin/Case_details/view1/' . $currentObj->id . '" title="view"  data_id="' . $currentObj->id . '" ><i class="fa fa-eye"></i></a> ';
            
            $data[] = $row;
            $no++;
            
        }
        
        
        
        
        $output = array(
            "draw" => (isset($_POST['draw'])) ? $_POST['draw'] : '',
            "recordsTotal" => $this->Case_details_model->count_all(),
            "recordsFiltered" => $this->Case_details_model->count_filtered(),
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }
    
    // pending Caes list end 
    // Edit
    
    public function edit($id = NULL)
    {
        
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/Case_details/total_cases');
        }
        $data['edit_data']         = $this->Case_details_model->find($id);
        $data['case_category']     = $this->Case_category_model->getparent_id();
        $data['case_sub_category'] = $this->Case_sub_category_model->getparent_id();
        $data['lawyer_name']       = $this->Lawyer_model->getparent_id();
        $this->global['pageTitle'] = 'Insaaf99 : Edit Client';
        $this->loadViews("admin/lawyer_cases/edit", $this->global, $data, NULL, 'admin');
    }
    
    public function ajax_call_case_sub_cat_name()
    {
        $get_id      = $this->input->post();
        // pre($get_id);
        $where['id'] = $get_id['id'];
        $table       = 'case_sub_category';
        $response    = $this->Case_sub_category_model->findByTable($where, $table);
        // pre(json_encode($response));
        echo json_encode($response);
    }
    
    public function ajax_call_lawyer_name()
    {
        $get_id                        = $this->input->post();
        // pre($get_id);
        $where['sub_case_category_id'] = $get_id['id'];
        $where['status']               = 1;
        $table                         = 'lawyer';
        $response                      = $this->Lawyer_model->findByTable($where, $table);
        //  pre(json_encode($response));
        echo json_encode($response);
    }
    
    public function view($id = NULL)
    {
        
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/Case_details/index');
        }
        $data['edit_data'] = $this->Case_details_model->find($id);
        if (!empty($data['edit_data'])) {
            $CategoryId      = $data['edit_data']->case_type;
            $where           = array();
            $where['id']     = $CategoryId;
            $where['status'] = 1;
            $categoryArray   = $this->Case_category_model->findDynamic($where);
            
            if (!empty($categoryArray)) {
                $data['Categoryname'] = $categoryArray[0]->name;
                
            }
        }
        $this->global['pageTitle'] = 'Insaaf99 : view Client';
        $this->loadViews("admin/client/view", $this->global, $data, NULL, 'admin');
        
    }
    
    public function view1($id = NULL)
    {
        
        pre('jhh');
        exit();
        
        $data['edit_data'] = $this->Case_details_model->find($id);
        $clien_id          = $data['edit_data']->client_id;
        
        $this->isLoggedIn();
        if ($id == null) {
            redirect('admin/Case_details/index' . $clien_id);
        }
        
        
        if (!empty($data['edit_data'])) {
            $CategoryId      = $data['edit_data']->case_category_id;
            $where           = array();
            $where['id']     = $CategoryId;
            $where['status'] = 1;
            $categoryArray   = $this->Case_category_model->findDynamic($where);
            
            if (!empty($categoryArray)) {
                $data['Categoryname'] = $categoryArray[0]->name;
                
            }
            $sub_CategoryId    = $data['edit_data']->case_sub_category_id;
            $where0            = array();
            $where0['id']      = $sub_CategoryId;
            $where0['status']  = 1;
            $sub_categoryArray = $this->Case_sub_category_model->findDynamic($where0);
            
            if (!empty($sub_categoryArray)) {
                $data['CategorySubname'] = $sub_categoryArray[0]->case_sub_category;
                
            }
            $client_id        = $data['edit_data']->client_id;
            $where1           = array();
            $where1['id']     = $client_id;
            $where1['status'] = 1;
            $clientArry       = $this->Client_model->findDynamic($where1);
            
            if (!empty($clientArry)) {
                $data['Client_name'] = $clientArry[0]->fname . ' ' . $clientArry[0]->lname;
                ;
                
            }
            
            $client_id        = $data['edit_data']->asign_lawyer_id;
            $where2           = array();
            $where2['id']     = $client_id;
            $where2['status'] = 1;
            $lawyerArry       = $this->Lawyer_model->findDynamic($where2);
            
            if (!empty($lawyerArry)) {
                $data['lawyer_name'] = $lawyerArry[0]->fname . ' ' . $lawyerArry[0]->lname;
                ;
                
            }
        }
        $this->global['pageTitle'] = 'Insaaf99 : view Client';
        $this->loadViews("admin/case_details/view1", $this->global, $data, NULL, 'admin');
        
    }
    
    // Update category*************************************************************
    public function update()
    {
        
        $this->isLoggedIn();
        $this->load->library('form_validation');
        // $this->form_validation->set_rules('fname','fname','trim|required');
        $this->form_validation->set_rules('case_category_id', 'case category ', 'trim');
        $this->form_validation->set_rules('case_sub_category_id', 'case sub category ', 'trim');
        
        //form data 
        $form_data = $this->input->post();
        if ($this->form_validation->run() == FALSE) {
            
            $this->edit($form_data['id']);
        } else {
            $insertData['client_id']            = $form_data['client_id'];
            $insertData['id']                   = $form_data['id'];
            $insertData['case_category_id']     = $form_data['case_category_id'];
            $insertData['case_sub_category_id'] = $form_data['case_sub_category_id'];
            $insertData['asign_lawyer_id']      = $form_data['asign_lawyer_id'];
            $insertData['case_description']     = $form_data['case_description'];
            $insertData['status']               = $form_data['status'];
            
            if (isset($_FILES['case_file']['name']) && $_FILES['case_file']['name'] != '') {
                
                $f_name      = $_FILES['case_file']['name'];
                $f_tmp       = $_FILES['case_file']['tmp_name'];
                $f_size      = $_FILES['case_file']['size'];
                $f_extension = explode('.', $f_name);
                $f_extension = strtolower(end($f_extension));
                $f_newfile   = uniqid() . '.' . $f_extension;
                $store       = "uploads/cases/" . $f_newfile;
                
                if (!move_uploaded_file($f_tmp, $store)) {
                    $this->session->set_flashdata('error', 'Image Upload Failed .');
                } else {
                    $file = "uploads/cases/" . $form_data['oldimage'];
                    
                    if (file_exists($file)) {
                        unlink($file);
                    }
                    
                    $insertData['case_file'] = $f_newfile;
                    
                }
                
            }
            
            $result = $this->Case_details_model->save($insertData);
            
            if ($result > 0) {
                
                
                $this->session->set_flashdata('success1', ' Case  successfully Updated');
                redirect('admin/lawyer_cases/index/' . $insertData['asign_lawyer_id']);
            } else {
                
                $this->session->set_flashdata('error1', 'Case Updation failed');
            }
            redirect('admin/lawyer_cases/edit/' . $insertData['id']);
        }
        
    }
    
    
    
    
}

?>