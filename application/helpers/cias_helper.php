<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */


function update_notification($data){
    
    $CI = get_instance();
    $table='notification';
    if (!empty($data['id'])) {
                $CI->db->where('id', $data['id']);
                $CI->db->update($table, $data);
                $updated_status = $CI->db->affected_rows();
                if($updated_status) {
                    return $data['id'];
                } else {
                    return false;
                }
            }
}
// function to add notification end


// function to get notification data start
function get_notification($where){

    $CI = get_instance();
    $table='notification';


       foreach($where as $key=>$value)
        {
            // Fields set
            if($key == 'field')
            {
                $CI->db->select($value);
            }
            
         

            // Order By
            if($key == 'orderby')
            {
                $temp_order = explode('-',$value);
                if(count($temp_order) >1)
                 $CI->db->order_by($temp_order[1], 'DESC');
                else
                    $CI->db->order_by($value, 'ASC');
            }
          
            // where
            if($key != 'field' AND $key != 'orderby' AND $key != 'limit' AND $key != 'table' AND $key != 'like')
            {
                $temp_where = array($key=>$value);
               $CI->db->where($temp_where);
            }
            
        }

        if(!isset($where['table']))
            $CI->db->from($table);      
        else
            $CI->db->from($where['table']); 

        $query = $CI->db->get(); 
        //echo $CI->db->last_query();

        $result = $query->result();        
        return $result;

}
// function to get notification data end

function shorten_string($string, $wordsreturned)
{
  $retval = $string;
  $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
  $string = str_replace("\n", " ", $string);
  $array = explode(" ", $string);
  if (count($array)<=$wordsreturned)
  {
    $retval = $string;
  }
  else
  {
    array_splice($array, $wordsreturned);
    $retval = implode(" ", $array)." ...";
  }
  return $retval;
}








/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}


/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */

//  code for check user payment status 
function ClientDetails($id){
    $CI = &get_instance();
    $c_Data =  $CI->db->query("SELECT * FROM clint where id='$id' ")->result_array();
    $result= !empty($c_Data)?$c_Data[0]:'';
    return $result;

}

 


// end code for check user payment status 
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance();
                    
        $CI->load->library('email');
        
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        $CI->email->initialize($config);
        
        return $CI;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        $CI = &get_instance();
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if(!function_exists('resetPasswordEmail'))
{
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;
        // pre($detail);
        // die;
        
        $CI = setProtocol();        
        
        $CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->subject("Reset Password");
        $CI->email->message($CI->load->view('email/resetPassword', $data, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();
        
        return $status;
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}


if(!function_exists('text2url'))
{
    function text2url($text)
    {
        $url = str_replace('[', '-', $text);
        $url = str_replace(']', '-', $url);
        $url = str_replace('{', '-', $url);
        $url = str_replace('}', '-', $url);
        $url = str_replace('(', '-', $url);
        $url = str_replace(')', '-', $url);
        $url = str_replace('||', '-', $url);
        $url = str_replace('|', '-', $url);
        $url = str_replace('&', '-', $url);
        $url = str_replace('+', '-', $url);
        $url = str_replace(' ', '-', strtolower($url));
        $url = str_replace('–', '-', strtolower($url));
        $url = str_replace('--', '-', strtolower($url));
        $url = str_replace('--', '-', strtolower($url));
        $url = str_replace('--', '-', strtolower($url));
        $url = str_replace('--', '-', strtolower($url));
        $url = substr_replace($url ,"",-1);
        return $url;
    }
}


// CUrl

function callcurl($data) {
    $ch = curl_init();
    if(isset($data['apikey'])){
      $key = $data['apikey'];
      unset($data['apikey']);
    }  
    $url = $data['url'];
    unset($data['url']);

    //$headers = array('Authorization: Bearer '.$stripeData['secret_key']);
    
    curl_setopt($ch, CURLOPT_URL,$url);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    return $result;

   }

// curlUrl
    function curl_url($path = NULL){
       return 'https://movie.24chat.org/getapidata/'.$path;
    }   
// check is encoded
function is_base64_encoded($data)
{
    if (preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $data)) {
       return TRUE;
    } else {
       return FALSE;
    }
};


        function makeWord($fword,$cd,$length, $prefix=''){
            if ($length <= 0)
            {
                $prefix . "\n";
            if($prefix==$fword){
                echo "true". "\n";
            }
            else{
                echo "false". "\n";
                

            }
            return;
            }
            // $c=["n","w","e","s"];
        
            foreach($cd as $letter)
            {
            makeWord($fword,$cd,$length - 1, $prefix . $letter);
            }
        }


        function check($a){
            $lower=strtolower($a[1]);
            $cd= str_split($lower);
            // Use the function to write the words.
            $minSize = count($cd);
            $maxSize = count($cd);
            for ($i = $minSize; $i <= $maxSize; $i++)
            {
                makeWord($a[0],$cd, $i);
            }
        
        }

// check is encoded
function trimm($data)
{
    $data = str_replace('href="', "", $data);
    $data = str_replace('"', "", $data);
    $data = str_replace('https://veryfastdownload.pw/watch.php?link=', "", $data);
    $data = str_replace('https://veryfasturl.club/watch.php?link=', "", $data);
    
    $data = str_replace('https://gpshares.com/r/download.php?id=', "", $data);
    $data = str_replace('https://gpshare.xyz/download.php?id=', "", $data);
    $data = str_replace('href="https://gpshares.com/r/download.php?id=', "", $data);
    
    

    return trim($data);
};


// push notifications 
function api_push_notification($data) {
    $data  = json_decode($data);
    
    if(!isset($data->user_id)){
        return 'user_id required';
    }else if(!isset($data->user_type)){
        return 'user_type required';
    }else if(!isset($data->msg_title)){
        return 'msg_title required';
    }else if(!isset($data->msg_body)){
        return 'msg_body required';
    }

    // get device id 
    $CI = get_instance();
    $CI->load->model('admin/client_model');
    $table = (strtolower($data->user_type) == 'lawyer')?"lawyer":"clint";
    $w = array('table' =>$table, 'id'=>$data->user_id,'field'=>'device_id');
    $rData = $CI->client_model->findDynamic($w);

    if(empty($rData)){
        return "User id mistmatch!!";
    }


    // api  init ------------------------
    $ch = curl_init();
    $url = 'https://fcm.googleapis.com/fcm/send';
    $basicAuth = 'key=AAAAFrFYFt8:APA91bHJ3TXyqoWQQxP2_hpghdAnsZ5_04o-EHiVKA-E_iMNW0fW6u38CjN73MdRtGmUuXImyqHglRuvp4of78wMxa9dk6JcvK05hL6RIuCHS2vJ0XfC4vzjiBPOqnZnuFEmLkZ1TiwE';

    $headers = array(
                'Content-type:application/json',
                'Authorization: '.$basicAuth
                );

    $jsonData = array();
    $deviceID = $rData[0]->device_id;
    $jsonData['registration_ids'] = array($deviceID);

    $jsonData['notification'] =  array("body"=> $data->msg_body,
        "title"=> $data->msg_title,
        "android_channel_id"=> "insaafnotif99",
        //"image"=>"https://cdn2.vectorstock.com/i/1000x1000/23/91/small-size-emoticon-vector-9852391.jpg",
        "sound"=> true);
    if(isset($data->img)){
        $jsonData['notification']['image'] = $img;
    }

    if(isset($data->other)){
        $jsonData['data'] = json_decode(json_encode($data->other),true);
    }

   

    if(isset($data->navi_screen)){
      $attach_data  = "screen_".$data->navi_screen;
    }

    if(isset($data->screen_id)){
      $attach_data  = isset($attach_data)?$attach_data."|id_".$data->screen_id:"|id_".$data->screen_id;
    }

    if(isset($attach_data)){
     $jsonData['data']['_id'] = "type_".$data->user_type."|".$attach_data;
    }

    

   $jsonData = json_encode($jsonData);

   

    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    return $result;
}



    function select_where($where){

        foreach($where as $key=>$v)
        {
            // Fields set
            if($key == 'field')
            {
                $this->db->select($v);
            }
            
            // Order By
            if($key == 'orderby')
            {
                $temp_order = explode('-',$v);
                if(count($temp_order) >1)
                 $this->db->order_by($temp_order[1], 'DESC');
                else
                    $this->db->order_by($v, 'ASC');
            }
            // LIMIT
            if($key == 'limit')
            {
                $temp = explode(',', $v);
                if(isset($temp[1]))
                $this->db->limit($temp[0],$temp[1]);
                else
                $this->db->limit($v);
            }

            // Like
            if($key == 'like')
            {
                $temp = explode(',',$v);
                
                $this->db->like($temp[0], $temp[1]);
                
            }
            
            // where
            if($key != 'field' AND $key != 'orderby' AND $key != 'limit' AND $key != 'table' AND $key != 'like')
            {
                $temp_where = array($key=>$v);
               $this->db->where($temp_where);
            }
            
        } 
        if(!isset($where['table']))
            $this->db->from($this->table);      
        else
            $this->db->from($where['table']); 

        $query = $this->db->get(); 
        //echo $this->db->last_query();

        $result = $query->result();        
        return $result;
    }


    // auto time generate
    function getStaticTime(){
        // this is for static time
        $t = 12;
        $tempArr = array();
        while($t <= 20){
            $tempDate = date("Y-m-d ").$t.":00:00";
            $tempArr[] = date("h:i A", strtotime($tempDate));
            // for half time
            $tempDate = date("Y-m-d ").$t.":30:00";
            $tempArr[] = date("h:i A", strtotime($tempDate));
            $t++;
        }
        return $tempArr;
    }


    // date diffrence ==========================================
    function dateDiffMin($from,$to){
      $dateTimeObject1 = date_create($from); 
      $dateTimeObject2 = date_create($to);

      $type = "";
      if ($dateTimeObject1 < $dateTimeObject2) {
        $type = "-";
      } 
        
      $difference = date_diff($dateTimeObject1, $dateTimeObject2); 

      $minutes = $difference->days * 24 * 60;
      $minutes += $difference->h * 60;
      $minutes += $difference->i;
      //echo("The difference in minutes is:");
      return  intval($type.$minutes);
    }


    function getPrice($price,$discount,$gst){

        // $price=100;
        // $gst=18;
        // $discount=10;
        $hundrad=100;
        $savePrice=($price*($discount)/$hundrad);
        $grossPrice=($price*($hundrad - $discount)/$hundrad)*($hundrad + $gst)/$hundrad;
        $gstPrice=($price*($hundrad - $discount)/$hundrad)*($gst)/$hundrad;

        $priceData=json_encode(array('savePrice'=>$savePrice,'grossPrice'=>$grossPrice,'gstPrice'=>$gstPrice));
         return $priceData;
    }

    function lavelToText($test){
        $string = ucwords(str_replace("_"," ", $test));
        return $string;
    }


    // firebase deep link for video call
    function meet_link($type,$slot_id,$user_id){
        if(!isset($type) || !isset($slot_id) || !isset($user_id)){
          return "Error : type, slot_id, user_id is required";
        }
        $tempUrl = 't='.base64_encode($type).'&s='.base64_encode($slot_id).'&i='.base64_encode($user_id);
        $encodeUrl= urlencode($tempUrl);
        return $deepLink = 'https://insaaf.page.link/?link=https://call.insaaf99.com/%23/v?'.$encodeUrl.'&apn=com.insaaf99';
 
     }
// create order id encode
     function createOrderIdEncode($orderId,$type){
        $type = trim($type);
           $year = date("y");
            if($type == "Slot Booking"){
               $orderID = "INC".$year.$orderId;
               return $orderID;

            }elseif($type == "Documentation Payment"){
                $orderID = "IND".$year.$orderId;
                return $orderID;
            }else{
                $orderID = "-";
                return $orderID; 
            }
    }

// create order id decode
     function createOrderIdDecode($text){
           $orderID = substr($text,5);
            return $orderID;
    }

 // function to highlight text 
 function textHighLight($text,$word){
    $text  = preg_replace('#'.preg_quote($word) .'#i', '<span style="background-color:#F9F902;">\\0</span>',$text);
    return $text;
 }
 
?>