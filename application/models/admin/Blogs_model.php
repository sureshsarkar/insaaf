<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Blogs_model extends Base_model
{
    public $table = "blogs";
    var $column_order = array(null,'title','author_name','dt'); //set column field database for datatable orderable
    var $column_search = array('title','author_name','dt'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order

        

        function __construct() {

            parent::__construct();

        }
    
    public function getparent_id()
    {   
       
        $query  = $this->db->query("SELECT id, name FROM  news");
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
            $this->action_condition();

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
             $this->action_condition();
            return $this->db->count_all_results();
        }




        public function action_condition(){
            // action type
            if(isset($_GET['type']) && $_GET['type'] == 'open'){
                $this->db->where('status',0);   
            }
            if(isset($_GET['type']) && $_GET['type'] == 'close'){
                $this->db->where('status',1);   
            }

            if(isset($_GET['type']) && $_GET['type'] == '1'){
                $curentdate=date("Y-m-d H:i:s");
                $fromdate = date("Y-m-d 00:00:00");
                $this->db->where('dt<=', $curentdate);
                $this->db->where('dt>=', $fromdate);
            }
            
            if(isset($_GET['type']) && $_GET['type'] == '7'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-7 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('dt<=', $curentdate);
                $this->db->where('dt>=', $fromdate);
            }
            if(isset($_GET['type']) && $_GET['type'] == '30'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-30 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('dt<=', $curentdate);
                $this->db->where('dt>=', $fromdate);
            }
            if(isset($_GET['type']) && $_GET['type'] == '365'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-365 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('dt<=', $curentdate);
                $this->db->where('dt>=', $fromdate);
            }
        }


}





  