<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';



/**
 * Class : User (UserController)
 * User Class to control all user related operations.

 * @since : 15 November 2016
 */
class Chat_refresh extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
       parent::__construct();
       $this->load->model('admin/client_query_model');
       $this->load->model('admin/lawyer_model');
       $this->load->model('admin/client_model');

       
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {  
       echo "Something went wrong!!";
    }
    
    

    // chat refresh & save
    public function chat_refresh(){

        $fData = $_POST;
        $rData = array();
        $myId = (isset($_SESSION['role']) && $_SESSION['role'] == 'admin')?'182':$_SESSION['id'];
        

        // insert chat message in database

        if(isset($fData['msg']) && !empty($fData['msg']) ){
            // insert function 
            $w =  array();
            $w["status"]= "0";
            $w["user_id"]= $myId;
            $w["type"]= $fData['userType'];
            $w["dateAt"]= date("Y-m-d H:i:s");
            $w["updateAt"]= date("Y-m-d H:i:s");
            $w["parent_id"]= empty($fData['chatId'])?0:$fData['chatId'];
            $w["msg"]= $fData['msg'];
            $w["seen"]= "0";
            if(empty($fData['chatId'])){
                $w["assign_lawyer"]= "182";
            }
            $insId = $this->client_query_model->save($w);

            if(empty($fData['chatId'])){

                $rArr = array('new_query'=>1,'chatId'=>$insId);
                $rArr['messageSend'] = $this->admin_first_query_message($fData['msg'],$insId);
                
                echo json_encode($rArr);
                exit;
            }
      

            // if first reply then send mail
            if(($_SESSION['role'] == 'lawyer' ||  $_SESSION['role'] == 'admin' ) &&  isset($fData['chatId']) ){
                // check chat already reply
                $checkData = $this->client_query_model->findDynamic(array('parent_id' => $fData['chatId'], 'user_id' => '182'));
                if(count($checkData) == 1){
                    // send mail client
                    $msgData = $this->client_query_model->find($fData['chatId']);
                    if(!empty($msgData)){
                        $client = $this->client_model->find($msgData->user_id);
                        if(!empty($client)){
                            $client->msg = $msgData->msg;
                            $this->send_client_reply_mail($fData['msg'],$fData['chatId'],$client);
                        }
                    }
                }

            }
        }

       // get chat data query 
       $sql = "SELECT * FROM client_query WHERE parent_id = '".$fData['chatId']."' OR id = '".$fData['chatId']."' ORDER BY id DESC LIMIT 150";
       $chatData = $this->client_query_model->rawQuery($sql);
       $updateStatus = 0;
       if(!empty($chatData)){
        foreach ($chatData as $k => $v) {
            $rData[$v->id] = $v;
            if($v->user_id != $myId &&  $v->seen == 0){
                $updateStatus = 1;
            }
            $lastChatId = isset($lastChatId)?$lastChatId:$v->id;
        }
       }

       // update seen status 
       if($updateStatus == 1){
        
        $userType = isset($_SESSION['role'])?$_SESSION['role']:'';
        $userType = $_POST['userType'];
         $whereForClient = (strtolower($userType) == 'lawyer')?" (parent_id = '".$fData['chatId']."' OR id = '".$fData['chatId']."') ":" parent_id = '".$fData['chatId']."' ";
         $sql = "UPDATE client_query SET seen = '1' WHERE $whereForClient AND type != '".strtolower($userType)."' ";
         $this->client_query_model->rawQuery($sql);
         $lastChatId = '1';
       }
       
      
       // if(isset($lastChatId) && $lastChatId == $fData['latChatId']){
       //   echo 'no_have_new';
       // }else{
       //     echo json_encode($rData);
       // }

       echo json_encode($rData);
    } 



     // First query messate *************************************************************
    public function admin_first_query_message($msg,$chat_id)
    {   
        $toEmail= "vinny_makkar@yahoo.com,write2nmakkar@gmail.com"; // admin mail //vinny_makkar@yahoo.com,write2nmakkar@gmail.com
        $subject= "Getting a new client query - Insaa99";

        $heading="Hi Admin, Getting a new client query";
        $content="
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client ID : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>INSAAF-C-".$_SESSION['id']."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Client Name : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$_SESSION['name']."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$msg."</span></td>
            </tr>
        </div>
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query Date : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".date("d/M/Y h:i A")."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Reply Link : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><a href=".base_url('admin/query/chat/'.$chat_id).">Reply Now</a></td>
            </tr>
        </div>
        ";

        $message = get_email_temp($heading,$content);
        
        return  $this->send_email($toEmail, $subject, $message);

    }


    // First Reply *************************************************************
    public function send_client_reply_mail($msg,$chat_id,$data)
    {   
        $toEmail= $data->email; 
        $subject= "Hi ". $data->fname.", your query answer - Insaa99";

        $heading="Hi ".$data->fname.", your query reply";
        $content="
        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Your Query : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$data->msg."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Reply : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$msg."</span></td>
            </tr>
        </div>

        <div style='margin-top:1px;'>
            <tr>
            <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Query Date : </td>
            <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".date("d/M/Y h:i A")."</span></td>
            </tr>
        </div>
        ";

        $message = get_email_temp($heading,$content);
        
        return  $this->send_email($toEmail, $subject, $message);

    }

    

    
    
    
}

?>