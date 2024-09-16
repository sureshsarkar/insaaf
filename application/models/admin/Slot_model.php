<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Slot_model extends Base_model
{
    public $table = "slot";
    var $column_order = array(null,'c.fname','c.lname','l.fname','l.fname','meeting_time'); //set column field database for datatable orderable
    var $column_search = array('c.fname','c.lname','l.fname','l.fname','meeting_time'); //set column field database for datatable searchable 
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
            $this->jointTables();// call join function

            $this->db->select('slot.*,slot.id as slot_id,slot.dt as dt, l.fname as l_fname,l.lname as l_lname,c.fname as c_fname,c.lname as c_lname,cc.name');

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
            

            $this->action_condition();// call join function
          

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
            $this->jointTables();// call join function
            $this->action_condition();//action condition function
            return $this->db->count_all_results();
        }

        // join tables function
        public function jointTables(){
        $this->db->from($this->table);
        $this->db->join('lawyer as l ',' l.id = slot.lawyer_id');
        $this->db->join('clint as c ',' c.id = slot.client_id');
        $this->db->join('cases as ca ',' ca.id = slot.case_id');
        $this->db->join('case_category as cc ',' cc.id = ca.case_category_id');
    }


        // join tables function
        public function action_condition(){
        // action type
        if(isset($_GET['type']) && $_GET['type'] == 'open'){
            $this->db->where('slot_status','0');
        }
        if(isset($_GET['type']) && $_GET['type'] == 'close'){
            $this->db->where('slot_status','1');
        }
        if(isset($_GET['type']) && $_GET['type'] == 'upcoming'){
            $curentdate=date("Y-m-d H:i:s");
            $curentdate1 = strtotime($curentdate);
            $fromdate = strtotime("7 day", $curentdate1);
            $fromdate= date('Y-m-d H:i:s', $fromdate);
            $this->db->where('meeting_time >=', $curentdate);
            $this->db->where('slot_status','1');
        }
        if(isset($_GET['type']) && $_GET['type'] == '1'){
            $curentdate=date("Y-m-d H:i:s");
            $fromdate = date("Y-m-d 00:00:00");
            $this->db->where('slot.dt <=', $curentdate);
            $this->db->where('slot.dt >=', $fromdate);
        }
        if(isset($_GET['type']) && $_GET['type'] == '7'){
            $curentdate=date("Y-m-d H:i:s");
            $curentdate1 = strtotime($curentdate);
            $fromdate = strtotime("-7 day", $curentdate1);
            $fromdate= date('Y-m-d H:i:s', $fromdate);
            $this->db->where('slot.dt <=', $curentdate);
            $this->db->where('slot.dt >=', $fromdate);
        }
        if(isset($_GET['type']) && $_GET['type'] == '30'){
            $curentdate=date("Y-m-d H:i:s");
            $curentdate1 = strtotime($curentdate);
            $fromdate = strtotime("-30 day", $curentdate1);
            $fromdate= date('Y-m-d H:i:s', $fromdate);
            $this->db->where('slot.dt <=', $curentdate);
            $this->db->where('slot.dt >=', $fromdate);
        }
        if(isset($_GET['type']) && $_GET['type'] == '365'){
            $curentdate=date("Y-m-d H:i:s");
            $curentdate1 = strtotime($curentdate);
            $fromdate = strtotime("-365 day", $curentdate1);
            $fromdate= date('Y-m-d H:i:s', $fromdate);
            $this->db->where('slot.dt <=', $curentdate);
            $this->db->where('slot.dt >=', $fromdate);
        }
    }




}





  