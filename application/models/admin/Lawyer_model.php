<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Lawyer_model extends Base_model
{
    public $table = "lawyer";
    var $column_order = array(null,'fname','lname','mobile','email','city','status','dt','bar_councle','practice_area','lawyer_unique_id'); //set column field database for datatable orderable
    var $column_search = array('fname','lname','mobile','email','status','city','dt','bar_councle','practice_area','lawyer_unique_id'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order

        

        function __construct() {

            parent::__construct();

        }



    
    public function getparent_id()
    {   
       
        $query  = $this->db->query("SELECT id, fname,lname FROM  lawyer");
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
            $this->db->select('lawyer.*,lawyer.dt');
           
            // $this->db->join('case_category as cc ',' cc.id=lawyer.category');
            // $this->db->join('case_sub_category as csc  ',' csc.id=lawyer.sub_case_category_id');

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
             
            if(isset($_POST['order'])) // here order processing
            {
                $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }


            // action type
           $this->getAction();
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


        public function getAction(){
            if(isset($_GET['type']) && $_GET['type'] == 'under_review'){
                $this->db->where_in('lawyer.status', 2);
                // $this->db->where_in('lawyer.status',  array('0','2'));
            }
            if(isset($_GET['type']) && $_GET['type'] == 'open'){
                $this->db->where('lawyer.status','0');
            }
            if(isset($_GET['type']) && $_GET['type'] == 'close'){
                $this->db->where('lawyer.status','1');
            }
            if(isset($_GET['type']) && $_GET['type'] == 'blocked'){
                $this->db->where('lawyer.status','3');
            }
            if(isset($_GET['status']) && $_GET['status'] == 'male'){
                $this->db->where('lawyer.gender','1');
            }
            if(isset($_GET['status']) && $_GET['status'] == 'female'){
                $this->db->where('lawyer.gender','2');
            }

            if(isset($_GET['type']) && $_GET['type'] == 'daterangefilter'){
                $from_date= date('Y-m-d H:i:s', strtotime($_GET['from_date']));
                $from_date= date('Y-m-d 00:00:00', strtotime($from_date));
                $to_date= date('Y-m-d H:i:s', strtotime($_GET['to_date']));
                $to_date= date('Y-m-d 23:59:59', strtotime($to_date));
 
                $this->db->where('lawyer.dt >=', $from_date);
                $this->db->where('lawyer.dt <=', $to_date);
            }
        }

}





  