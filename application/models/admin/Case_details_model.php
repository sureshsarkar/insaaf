<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Case_details_model extends Base_model
{
    public $table = "cases";
    var $column_order = array('cc.name','l.fname','l.lname','c.fname','c.lname','c.city','c.state','c.client_unique_id','s.slot_status','cases.dt','s.meeting_time','s.dt'); //set column field database for datatable orderable
    var $column_search = array('cc.name','l.fname','l.lname','c.fname','c.lname','c.city','c.state','c.client_unique_id','s.slot_status','cases.dt','s.meeting_time','s.dt'); //set column field database for datatable searchable 
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
            $this->db->join('case_category as cc ',' cc.id = cases.case_category_id');
            $this->db->join('slot as s ',' s.case_id = cases.id');
            $this->db->join('clint as c ',' c.id = cases.client_id','left');
            $this->db->join('z_payment as p ',' p.id = cases.payment_id','left');
            $this->db->join('lawyer as l ',' l.id = cases.asign_lawyer_id','left');

            $this->db->select('cases.*,cc.name as category_name,c.fname as c_fname,c.lname as c_lname,c.state as c_state,c.city as c_city,l.fname as l_fname,l.lname as l_lname, s.slot_status, s.MeetingStatus, s.meeting_time,s.id as s_id,p.payment_status as paymentStatus');
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
            $this->_get_datatables_query();
            return $this->db->count_all_results();
        }
        
        public function action_condition()
        {
            
            if(isset($_GET['type']) && $_GET['type'] == 'open'){
                $this->db->where('cases.status', 0);   
            }
            if(isset($_GET['type']) && $_GET['type'] == 'close'){
                $this->db->where('cases.status', 1);   
                $this->db->where('s.MeetingStatus', 0);   
            }
            if(isset($_GET['type']) && $_GET['type'] == 'over'){
                $this->db->where_in('s.MeetingStatus', array('1','2'));   
                // $this->db->where('s.MeetingStatus', !0);   
            }

            if(isset($_GET['type']) && $_GET['type'] == 'cancel'){
                $this->db->where('s.MeetingStatus', 3);   
            }

            if(isset($_GET['type']) && $_GET['type'] == 'PPC'){
                $this->db->where('s.pageRefrence', 2);   
            }

            if(isset($_GET['type']) && $_GET['type'] == 'SEO'){
                $this->db->where('s.pageRefrence', 1);   
            }
            
            if(isset($_GET['type']) && $_GET['type'] == '1'){
                $curentdate=date("Y-m-d H:i:s");
                $fromdate = date("Y-m-d 00:00:00");
                $this->db->where('cases.dt <=', $curentdate);
                $this->db->where('cases.dt >=', $fromdate);
            }
            if(isset($_GET['type']) && $_GET['type'] == '7'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-7 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('cases.dt <=', $curentdate);
                $this->db->where('cases.dt >=', $fromdate);
            }
            if(isset($_GET['type']) && $_GET['type'] == '30'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-30 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('cases.dt <=', $curentdate);
                $this->db->where('cases.dt >=', $fromdate);
            }
            if(isset($_GET['type']) && $_GET['type'] == '365'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-365 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('cases.dt <=', $curentdate);
                $this->db->where('cases.dt >=', $fromdate);
            }

            if(isset($_GET['type']) && $_GET['type'] == 'daterangefilter'){
                $from_date= date('Y-m-d H:i:s', strtotime($_GET['from_date']));
                $from_date= date('Y-m-d 00:00:00', strtotime($from_date));
                $to_date= date('Y-m-d H:i:s', strtotime($_GET['to_date']));
                $to_date= date('Y-m-d 23:59:59', strtotime($to_date));

                $this->db->where('cases.dt >=', $from_date);
                $this->db->where('cases.dt <=', $to_date);
                // $this->db->where('cases.dt BETWEEN "'. $from_date. '" and "'.$to_date.'"');
            }

         }
}