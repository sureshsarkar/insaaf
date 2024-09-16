<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Query_model extends Base_model
{
    public $table = "query";
    var $column_order = array(null,'name'); //set column field database for datatable orderable
    var $column_search = array('name'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order


        function __construct() {

            parent::__construct();

        }
    
    public function getparent_id()
    {   
       
        $query  = $this->db->query("SELECT id, FROM  query");
        if($query->num_rows() > 0)
        {
            $category_array = array();
            foreach($query->result() as $row)
            {
               $category_array[] = $row;
            }
            return $category_array;
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

            $this->db->select('query.*,cc.name');
           
            $this->db->join('case_category as cc ',' cc.id=query.case_cat_id');

            $this->db->from($this->table);
            $this->db->order_by("id", "desc");
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

            if($_SESSION['role'] == 'lawyer'){
               $this->db->where('query.lawyer_id', $_SESSION['id']);
               $this->db->where('query.query_status', 1);
               $this->db->where('query.client_f_query', 1);
            }else{
                // $this->db->where('cases.client_id', $_SESSION['id']);
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
            $this->_get_datatables_query();
            return $this->db->count_all_results();
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

}





  