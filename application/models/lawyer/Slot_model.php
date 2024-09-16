<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Slot_model extends Base_model
{
    public $table = "slot";
    var $column_order = array(null,'cl.fname', 'slot.meeting_time', NULL, 'slot.slot_status'); //set column field database for datatable orderable
    var $column_search = array('slot.meeting_time','slot.time','slot.dt','cl.fname','cl.lname'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order

        

        function __construct() {

            parent::__construct();

        }



    
    public function getparent_id()
    {   
       
        $query  = $this->db->query("SELECT id FROM  slot");
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
            $this->db->join('clint as cl ',' cl.id=slot.client_id');
            $this->db->select('slot.*,cl.fname,cl.lname,cl.client_unique_id');

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
               $this->db->where('slot.lawyer_id', $_SESSION['id']);
            }else{
                // $this->db->where('cases.client_id', $_SESSION['id']);
            }
            /*=========== Filter =========*/
            if(isset($_GET['meet']) && $_GET['meet'] == '1' ){
                $curentdate=date("Y-m-d H:i:s");
                $fromdate = date("Y-m-d 00:00:00");
                $this->db->where("slot.dt BETWEEN '$fromdate' AND '$curentdate'");
            }else if(isset($_GET['meet']) && $_GET['meet'] == '7' ){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-7 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where("slot.dt BETWEEN '$fromdate' AND '$curentdate'");
            }else if(isset($_GET['meet']) && $_GET['meet'] == '30' ){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-30 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where("slot.dt BETWEEN '$fromdate' AND '$curentdate'");
            }else if(isset($_GET['meet']) && $_GET['meet'] == '365' ){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-365 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where("slot.dt BETWEEN '$fromdate' AND '$curentdate'");
            }else if(isset($_GET['meet']) && $_GET['meet'] == 'all' ){
                $sql1 = " ";
            }else{

            }
            /*================*/
             
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





  