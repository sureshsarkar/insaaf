<?php
class LoginModel extends CI_Model{
   public function __cunstruct(){
     parent::__cunstruct();
   }  
   // GEt all data from table
   public function select_all_data($table,$field,$warr=''){
       if($warr!=''){
         $this->db->where($warr);
       }
       return $this->db->select($field)->from($table)->get()->result_array();
    } 
     // Insert vendor
    public function insert_data($table,$data){
       return $this->db->insert($table,$data);
    }

    // Delete vendor

    function delete_vendor($table,$arr){
         $this->db->where($arr);  
         $this->db->delete($table);
    }
   // Update User 
   public function update_user_data($table,$data,$arr){
      $this->db->where($arr);
      $this->db->update($table,$data); 

   }
    // update status

   public function update_user($table,$data,$arr){
       $this->db->where($arr);
       $this->db->update($table,$data);
   }

    // delete Customer 
    function delete_customer($table,$arr){
      $this->db->where($arr);  
      $this->db->delete($table);
    }    
   
    // Update Customer 
   public function update_customer_data($table,$data,$arr){
      $this->db->where($arr);
      $this->db->update($table,$data); 

   }
}    
?> 