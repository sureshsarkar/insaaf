<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function check_slot($lawyer_id = '', $client_id= '', $slot_date= '', $slot_time= '')
    {
       $op = & get_instance();
   
       $op->db->select('*');
       $op->db->where('lawyer_id', $lawyer_id);
       $op->db->where('client_id', $client_id);
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
}

?>