<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Slot_model extends Base_model
{
    public $table = "slot";
    // $layer_name = "l.fname"." ".
    var $column_order = array(null,'l.fname','slot.slot_date','slot.time', 'cc.name', 'slot.slot_status','slot.dt'); //set column field database for datatable orderable
    var $column_search = array('l.fname','slot.slot_date','slot.time', 'cc.name', 'slot.slot_status','slot.dt'); //set column field database for datatable searchable 
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
            //echo $this->db->last_query();
            // exit;
        }
        // Get Database 
         public function _get_datatables_query()
        {     
            $this->db->from($this->table);
            $this->db->join('lawyer as l ',' l.id=slot.lawyer_id', 'left');
            $this->db->join('cases as cs ',' cs.id=slot.case_id');
            $this->db->join('case_category as cc ',' cc.id=cs.case_category_id');
            $this->db->select('slot.*,slot.client_meeting_noti as client_seen,l.fname,l.lname,cs.case_description, cc.name as case_name, ');
            /*---------- Where Clause -----------*/
            if($_SESSION['role'] == 'lawyer'){
               $this->db->where('slot.lawyer_id', $_SESSION['id']);
            }elseif($_SESSION['role'] == 'client'){
                $this->db->where('slot.client_id', $_SESSION['id']);
            }else{

            }
            /*------------------------------------*/
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
            if(isset($_GET['type']) && $_GET['type'] == 'upcoming'){
                $today_date= date('Y-m-d H:i:s');
                $timestamp = strtotime($today_date);
                $timestamp_one_hour_befor = $timestamp - 3600;
                $curent_date= date('Y-m-d H:i:s', $timestamp_one_hour_befor);

                $this->db->where('slot.slot_status', '1');
                $this->db->where('slot.meeting_time >', $curent_date);
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





  