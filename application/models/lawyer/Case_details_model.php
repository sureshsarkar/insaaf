<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Case_details_model extends Base_model
{
    public $table = "cases";
    var $column_order = array(null, 'cl.fname','cc.name', 'cl.client_unique_id','cases.status' ,'cases.dt'); //set column field database for datatable orderable
    var $column_search = array('cl.client_unique_id','cl.fname','cl.lname','cl.mobile','cc.name', 'cases.dt','cases.status'); //set column field database for datatable searchable 
    var $order = array('cases.id' => 'desc'); // default order

        

        function __construct() {

            parent::__construct();

        }



     function delete($id) {

        $this->db->where('id', $id);

        $this->db->delete($this->table);        

        return $this->db->affected_rows();

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
            $this->db->join('case_category as cc ',' cc.id=cases.case_category_id');
            $this->db->join('clint as cl ',' cl.id=cases.client_id');

            $this->db->select('cases.*,cc.name as category,cl.fname,cl.lname');
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
               $this->db->where('cases.asign_lawyer_id', $_SESSION['id']);
            }else{
                // $this->db->where('cases.client_id', $_SESSION['id']);
            }
            if(isset($_GET['type']) && $_GET['type'] == 'pending'){
                $this->db->where('cases.status', 0);   
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

}