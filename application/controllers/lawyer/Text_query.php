<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Text_query extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
      
       $this->load->model('admin/Case_category_model');
       $this->load->model('admin/Client_model');
       $this->load->model('admin/Lawyer_model');
       $this->load->model('lawyer/Query_model');

    
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {  
   
        $data['lawyer_id']=$_SESSION['id'];
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'Total Details';
        $this->loadViews("lawyer/text_query/list", $this->global, $data , NULL ,'lawyer');
        
    }
    public function edit($id = NULL)
    {
       
        // update lawyer_meeting_noti status
        $this->Query_model->save(array('id'=> $id,'lawyer_f_query_noti'=>1));

        $where=array();
        $where['id']=$id;
        $query=$this->Query_model->findDynamic($where);
        $data["edit_data"]=$query[0];

      if(!empty($data["edit_data"])){

           $client_id= $data["edit_data"]->user_id;
           $where1=array();
           $where1['id']=$client_id;
           $client=$this->Client_model->findDynamic($where1);
           $data["edit_client"]=$client[0];
      }
       
        $this->isLawyerLoggedIn();
        $this->global['pageTitle'] = 'edit case';
        $this->loadViews("lawyer/text_query/edit", $this->global, $data , NULL,'lawyer');    
        
    } 

      // Update category*************************************************************
      public function update_text_query()
      {
        
          $this->isLawyerLoggedIn();
          $this->load->library('form_validation');            
          $this->form_validation->set_rules('q_solution','Query solution','trim|required');
          
          //form data 
          $form_data  = $this->input->post();

          if($this->form_validation->run() == FALSE)
          {
              
                  $this->edit($form_data['q_id']);
          }
          else
          {
       
              $insertData['id']                    = $form_data['q_id'];
              $insertData['q_solution']            = $form_data['q_solution'];
              $insertData['f_query_status']  =1;
            
              $result = $this->Query_model->save($insertData);
             
              if($result > 0)
              {

                 /* send mail for Lawyer to book slot for lawyer */
                $toEmail = $form_data['c_email']; // client email 
                $subject = "Query Solution";
                $heading="Dear ".$form_data['c_name']." your query has been answered by our expert lawyer";
             
             $content="
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Your Query :</td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['query']."</span></td>
                 </tr>
             </div>
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>==></td>
                 </tr>
             </div>
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px text-align:justify;' valign='middle' width='100%' colspan='2'><span>".$form_data['q_solution']."</span></td>
                 </tr>
                 </div>
                 <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px text-align:justify;' valign='middle' width='100%' colspan='2'><span>We hope you are satisfied with the advice. In case you further need to consult our Lawyer One to One you may</span></td>
                 </tr>
             </div>
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Contact Us </td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a hreh='".base_url()."'>Click Here</a></span></td>
                 </tr>
             </div>
           ";
            
            $message=get_email_temp($heading,$content);
            $this->send_email($toEmail, $subject, $message);

                 /* send mail for Lawyer to book slot for lawyer */
                $toEmail= "vinny_makkar@yahoo.com"; 
                $subject= "Query Solution Sent Successfully";
                $heading="You have sent the solution of the query";
             $content="
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name:</td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['c_name']."</span></td>
                 </tr>
             </div>
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Email :</td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['c_email']."</span></td>
                 </tr>
             </div>
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Mobile :</td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['c_mobile']."</span></td>
                 </tr>
             </div>
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query :</td>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['query']."</span></td>
                 </tr>
             </div>
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query Solution :</td>
                 </tr>
             </div>
             <div style='margin-top:1px;'>
                 <tr>
                 <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px; text-align:justify;' valign='middle' width='52.5%' colspan='2'><span>".$form_data['q_solution']."</span></td>
                 </tr>
             </div>
           ";
            
            $message=get_email_temp($heading,$content);
            $this->send_email($toEmail, $subject, $message);


                  
           
                  $this->session->set_flashdata('success', 'Query Solution Sent successfully');
                  redirect('lawyer/dashboard/index/'.$form_data['lawyer_id']);
              }
              else
              { 
                 
                  $this->session->set_flashdata('error', 'Category Updation failed');
              }
              redirect('lawyer/Text_query/update_text_query');
            }  
          
      }
    

    // Member list
    public function ajax_list($lawyer_id=NULL)
    {  
         error_reporting(0);
         $where['lawyer_id'] = $lawyer_id;
         $where['query_status'] = 1;
         $where['client_f_query'] = 1;
         $where['orderby'] = '-id';
         $list=$this->Query_model->findDynamic($where); 
    
		$data = array();
        $no =(isset($_POST['start']))?$_POST['start']:'';
      
        foreach ($list as $currentObj) {
            $temp_date = $currentObj->dt;
            $date_at = date("d-m-Y H:i:s", strtotime($temp_date));
            $no++;
            $row = array();
            $row[] ='<span class="btn-primary btn12 badge">'.$no.'</span>';

            $new = ($currentObj->lawyer_f_query_noti == 0)?'<span class="badge bg-1 text-danger blink_now" >New</span>':'-';

            $client_id=$currentObj->user_id;
            $client=$this->Client_model->find($client_id);
            $first_name=$client->fname;
            $last_name=$client->lname;
            $fullname=$first_name.' '. $last_name;
            $row[] = $fullname;
            $row[] = $client->client_unique_id;
            $row[] =$currentObj->dt;

            $status1='';
            if($currentObj->f_query_status==1){
                $status1 = '<span class="btn-success badge">Approved</span>';
            }
            else{
                $status1 = '<span class="btn-warning  badge">Pending</span>';
            }
            $row[]=$status1;
            $row[]=$new;

            $row[] = '<a class="btn btn-sm btn-info" style="margin: 4px 0px" href="'.base_url().'lawyer/Text_query/edit/'.$currentObj->id.'" title="Edit" ><i class="fa fa-pencil"></i></a>  ';
            
            $data[] = $row;
        }
        $output = array(
                        "draw" => (isset($_POST['draw']))?$_POST['draw']:'',
                        "recordsTotal" => $this->Query_model->count_all(),
                        "recordsFiltered" => $this->Query_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    
}

?>