<?php
class Category extends CI_Model{
    public function __cunstruct(){
      parent::__cunstruct();
   }
  

     // Get all data from table
     public function select_all_data($table,$field,$arr=''){
        
        return $this->db->select($field)->from($table)->get()->result_array();
     } 
      // Get all data from table
      public function select_where_data($table,$field,$arr=''){
        
         return $this->db->select($field)->from($table)->where($arr)->get()->result_array();
      }
      // Insert Category
     public function insert_data($table,$data){
        return $this->db->insert($table,$data);
     }
    
     // Delete Category
    function delete_category($table,$arr){
        $this->db->where($arr);  
        $this->db->delete($table);
    }

    // Update Category
    public function update_category_data($table,$data,$arr){
        $this->db->where($arr);
        $this->db->update($table,$data); 
  
     }
}