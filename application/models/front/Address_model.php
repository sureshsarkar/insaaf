<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Address_model extends Base_model
{
    public $table = "user_address";
    var $column_order = array(null, 'firstname','email','mobile','gender','status'); //set column field database for datatable orderable
    var $column_search = array('firstname','email','mobile','gender','status'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order

        

        function __construct() {

            parent::__construct();

        }



     function delete($id) {

        $this->db->where('id', $id);

        $this->db->delete($this->table);        

        return $this->db->affected_rows();

    }


	// Login
	function loginMe($email, $password)
    {
        $field = '';
        if(!empty(is_numeric($email))){
           $field= 'mobile';
        }else{
                $field='email';
        }
        $decrpt_pass = md5($password);
        
        $this->db->from($this->table);
        //$this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where($field, $email);
        //$this->db->where("(email=$email OR mobile=$email)", NULL, FALSE);
        $this->db->where('password',$decrpt_pass);
        $query = $this->db->get();
        $user = $query->result();
        
          // echo  $str_data = $this->db->last_query();
        if(!empty($user)){
			return $user;
		}	
          else {
            return array();
        }
    }
	public function checkEmailExist($email)
    {
         $query =    $this->db->select('*')
                        ->where('email',$email)
                        ->from($this->table)
                        ->get();
        // echo  $str_data = $this->db->last_query();
     

        if ($query->num_rows() > 0){
    $id=$query->result()[0]->id;

            return $id;
        } else {
            return false;
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

       // Get  List
        function get_datatables()
        {
            $this->_get_datatables_query();
            if(isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }
        // Get Database 
         public function _get_datatables_query()
        {     
            $this->db->from($this->table);
            $i = 0;     
            foreach ($this->column_search as $item) // loop column 
            {
                if(isset($_POST['search']['value']) && $_POST['search']['value']) // if datatable send POST for search
                {
                    if($i===0) // first loop
                    {
                        $this->db->like($item, $_POST['search']['value']);
                    }
                    else
                    {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                }
                $i++;
            }
             
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }

        // Count  Filtered
        function count_filtered()
        {
            $this->_get_datatables_query();
            $query = $this->db->get();
            return $query->num_rows();
        }
        // Count all
        public function count_all()
        {
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }
        function matchOldPassword($userId, $oldPassword)
        {
            $this->db->select('id, password');
            $this->db->where('id', $userId);        
            
            $query = $this->db->get('z_users');
            $user = $query->result();
            if(!empty($user)){
                if($oldPassword==$user[0]->password)
                {
                    return $user;
                }else{
                    return array();
                }
                
            } else {
                return array();
            }
        }

}