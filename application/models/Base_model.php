<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base_model extends CI_Model{
    
    public $table;

    function __construct() {
            //parent::__construct();
            $this->table = $this->db->dbprefix.$this->table;
            $this->init_autoloader();
        }

        public function save($data) {
            // pre($data);
            // exit();
            if (!empty($data['id'])) {
                $this->db->where('id', $data['id']);
                $this->db->update($this->table, $data);
                $updated_status = $this->db->affected_rows();
                if($updated_status) {
                    return $data['id'];
                } else {
                    return false;
                }
            } else {
                $this->db->insert($this->table, $data);
                // return $this->db->last_query();
                return $this->db->insert_id();
            }
        }

        public function all() {
            $query = $this->db->select("")
                    ->from($this->table)
                    ->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            }
        }

        public function find($id) {
            $query = $this->db->select('*')
                    ->from($this->table)
                    ->where('id', $id)
                    ->get();
            if ($query->num_rows() > 0) {
                $result = $query->result();
                return $result[0];
            } else {
                return array();
            }
        }

        public function findBy($condition = array(),$orderBy = array()) {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where($condition);
            if(count($orderBy) > 0) {
                $this->db->order_by($orderBy['key'], $orderBy['value']);
            }
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            }
        }
        public function findByTable($condition = array(),$table = NULL) 
        {
           
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);
            $query = $this->db->get();
            // $str = $this->db->last_query();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            }
        }
        public function findOneBy($condition = array()) {
            $query = $this->db->select('*')
                    ->from($this->table)
                    ->where($condition)
                    ->get();
            if ($query->num_rows() > 0) {
                $result = $query->result();
                return $result[0];
            } else {
                return array();
            }
        }
        
        private function init_autoloader() {
            spl_autoload_register(function($classname) {
                if (file_exists('application/interfaces/' . $classname . '.php')) {
                    require_once 'application/interfaces/' . $classname . '.php';
                }
            });
        }
        
      //  public function findByLimit($condition = array(),$limit,$start) {
        public function findByLimit($condition ,$limit,$start) {
            $this->db->limit($limit, $start);
            $query = $this->db->select('*')
                    ->from($this->table)
                    ->where($condition)
                    ->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            }
        }
        
     /**
      * 
      * @param type $id
      * @return type
      */   
    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);        
        return $this->db->affected_rows();
    }

    // Count Row 
    function countRow($searchText = '')
    {
        $this->db->select('*');
        $this->db->from($this->table); 
        $query = $this->db->get();        
        return count($query->result());
    }

    // Row Listing
   // function rowListing($searchText = '', $page, $segment)
    function rowListing($searchText , $page, $segment)
    {
        $this->db->select('*');
        $this->db->from($this->table);      
        $this->db->limit($page, $segment);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();        
        $result = $query->result();        
        
        return $result;
    }

    // get dynamic fild & data
    
    /* 
       How To  Data Bind => like That 
        ======================
        $where  = array();
        $where['table']  = 'table_Name';
        $where['field']  = 'id,name,status,date';
        $where['orderby']  = '-id'; // Desc when - add
        $where['limit']  = '0,10';
        $where['id']  = '10';
        $where['name']  = 'user';
        $where['like']  = {'fieldname':'value','fieldname1':'value1'};
        
        

    */    
    function findDynamic($where)  
    {

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
                $tempArr = json_decode($v,true);
                if(!empty($tempArr)){
                    $cn = 0;
                    foreach($tempArr as $col=>$val){
                        if ($cn==0) {
                           $this->db->like($col, $val);
                        }else{
                            $this->db->or_like($col, $val);
                        }
                        
                        $cn++;        
                    }
                }
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
        // pre($this->db->last_query());
        return $result;
    }

    // raw query
    function rawQuery($sql)  
    {
        if (strpos($sql, 'UPDATE') !== false) {
            $query = $this->db->query($sql);
            return "Updated";
        }else{
            $query = $this->db->query($sql);
            //$result =  $query->result_array();
            $result = $query->result();        
            return $result;
        }
    }

    // updateDynamic
    public function updateDynamic($data) {
        if (!empty($data['where'])) {
            //$data['where'] = 'id_Name,value';
            $temp = explode(',', $data['where']);
            $this->db->where($temp[0], $temp[1]);
            $table = isset($data['table'])?$data['table']:$this->table;
            if(isset($data['table']))
                unset($data['table']);

            unset($data['where']);
            $this->db->update($table, $data);
            $updated_status = $this->db->affected_rows();
            if($updated_status) {
                return $temp[1];
            } else {
                return false;
            }
        } 
    }


    // delete Dynaimc
    function deleteDynamic($data) {
        //$data['where'] = 'id_Name,value';
        $temp = explode(',', $data['where']);
        $this->db->where($temp[0], $temp[1]);
        $table = isset($data['table'])?$data['table']:$this->table;
        if(isset($data['table']))
            unset($data['table']);

        unset($data['where']);

        $this->db->delete($table);        
        return $this->db->affected_rows();
    }

    // nitification when book slot start
    public function nitification_when_book_slot()
    {     
        /* send mail for client to sent meeting link */
        $toEmail ="sureshsarkar2020@gmail.com"; // client email 
        $subject = "Slot Booking reply";
        $form_data['lawyer_name']="Suresh";
        $form_data['slot_date']="20-12-2022";
        $form_data['time']="10:20 pm";
        $link="insaaf99.com";
     $heading="Slot Booking reply message";
     
     $content="
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Lawyer Name :</td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['lawyer_name']."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Date :</td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['slot_date']."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Slot Time :</td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span>".$form_data['time']."</span></td>
         </tr>
     </div>
     <div style='margin-top:1px;'>
         <tr>
         <td align='left' style='font-family:Montserrat,sans-serif;font-size:12px;line-height:24px;color: #4b4b4b;' width='35%'>Meeting Link : </td>
         <td align='left' style='font-family: Montserrat, sans-serif;color:#2e2323; font-size:12px;line-height:24px' valign='middle' width='52.5%'><span><a href='".$link."'>Join Meeting</a></span></td>
         </tr>
     </div>
   ";
    
    $message=get_email_temp($heading,$content);
  $result=  send_email($toEmail, $subject, $message);
  return $result;
        
    }


}

?>