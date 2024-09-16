<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Calling_model extends Base_model
{
    public $table = "calling_data";
    var $column_order = array(null,'mobile','name','status','adding_dt','folloupdate','seen','leading_date','city','state','email'); //set column field database for datatable orderable
    var $column_search = array('mobile','name','status','adding_dt','folloupdate','seen','leading_date','city','state','email'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order

        function __construct() {

            parent::__construct();

        }
 
    public function getparent_id()
    {   
        $query  = $this->db->query("SELECT id, name FROM  category");
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
            // $this->db->where('calling_data 0);  
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
             
           $this->filterDataFunction();

            
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
            $this->filterDataFunction();
            return $query->num_rows();
        }
        // Count all
        public function count_all()
        {
            $this->db->from($this->table);
            $this->filterDataFunction();
            return $this->db->count_all_results();
        }


        public function filterDataFunction(){
               if(isset($_GET['type']) && $_GET['type'] == 'today'){
                $curentDateTime=date("Y-m-d H:i:s");  
                $addOneDay = strtotime("1 day", strtotime($curentDateTime));
                $addOneDay= date('Y-m-d H:i:s', $addOneDay);
                $curentDateTime=date("Y-m-d H:i:s");  
                $addOneDay = strtotime("1 day", strtotime($curentDateTime));
                $addOneDay= date('Y-m-d H:i:s', $addOneDay);
                $this->db->where('folloupdate BETWEEN "'.$curentDateTime. '" and "'.$addOneDay.'"');
                }
                if(isset($_GET['type']) && $_GET['type'] == 'upcomming'){
                    $curentdate=date("Y-m-d H:i:s");  
                    $this->db->where('folloupdate >', $curentdate);
                }
        }
}





  