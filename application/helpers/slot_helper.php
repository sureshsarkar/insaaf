<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function check_slot($lawyer_id = '', $slot_date= '', $slot_time= '')
    {
       $op = & get_instance();
   
       $op->db->select('*');
       //$op->db->where('lawyer_id', $lawyer_id);
       $op->db->where('slot_date', $slot_date);
       $op->db->where('time', $slot_time);
       $op->db->from('slot');
       $res = $op->db->get();
       $result =  $res->row();
       if (!empty($result)) {
           return 1;
       }else{
        return 0;
       }
    }  

    function check_slot_booked($slot_date_time= '')
    {
       $op = & get_instance();
   
       $op->db->select('*');
       //$op->db->where('lawyer_id', $lawyer_id);
       $op->db->where('meeting_time', $slot_date_time);
       $op->db->from('slot');
       $res = $op->db->get();
       $result =  $res->row();
       if (!empty($result)) {
           return 1;
       }else{
        return 0;
       }
    } 
    
    
    function check_date_time_block($dateBlock ='',$timeBlock='')
    {
       $cunnentDate = date("Y-m-d");
       $op = & get_instance();
   
       $query = $op->db->select('*')
       ->from("scheduler")
       ->where('date >=', $cunnentDate)
       ->get();

        if($query->num_rows() > 0) {
            $blockTime = $query->result();
            $arr = array();
                if(isset($blockTime) && !empty($blockTime)){
                    foreach ($blockTime as $key => $value) {
                        $time = json_decode($value->time);
                        // return gettype($value->time); 
                        // exit();
                        // if($time[0] == 'false'){
                        //     return $time[0];
                        // }else{
                            foreach ($time as $k => $v) {
                                $arr[$value->date][$v] = $v;
                            }
                    
                }
            }
            
            // return $arr[$dateBlock]['false'];
            // exit();
            if(isset($arr[$dateBlock][$timeBlock]) && !empty($arr[$dateBlock][$timeBlock])){
                return 1;
            }else if(isset($arr[$dateBlock]['false']) && $arr[$dateBlock]['false'] = 'false'){
                return 1;
            }else{
                return 0;
            }
        } else {
           return 0;
        }

    }  
    
    // function to check device
    function check_device()
    {
            // check which devise is using
            $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile")); 
            $isTab = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "tablet")); 
            $isWin = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "windows")); 
            $isAndroid = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "android")); 
            $isIPhone = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "iphone")); 
            $isIPad = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "ipad")); 
             
            $result = "";
            if($isMob){ 
                  $result = "m";
            }elseif($isTab){ 
                  $result = "w_tab";
            }elseif($isWin){ 
                  $result = "pc";
            }elseif($isAndroid){ 
                  $result = "android";
            }elseif($isIPhone){ 
                  $result = "iphone";
            }elseif($isIPad){ 
                  $result = "ipad";
            }else{ 
                  $result = "N/A";
            }

            return $result;
    }   

    
// generate access tochen start
        function createToken($slotId)
        {
            if(empty($slotId)){
                $accessToken = "";
                return $accessToken;
                exit();
            }
            $slotID = $slotId;
            $url = 'https://agora-node-tokenserver--sau-rabhrabh.repl.co/access_token?channelName='.$slotId;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $accessToken = curl_exec($curl);
            curl_close($curl);
            $accessToken =  json_decode($accessToken);
            return $accessToken->token;
        }
// generate access tochen end

}

?>