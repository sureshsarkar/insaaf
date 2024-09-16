<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Certificate_model extends Base_model
{
    public $table = "docx_certificate";
    var $column_order = array(null,'c.fname','c.lname','form_data','cart_data','dateAt'); //set column field database for datatable orderable
    var $column_search = array('c.fname','c.lname','form_data','cart_data','dateAt'); //set column field database for datatable searchable 
    var $order = array('id' => 'DESC'); // default order

        

        function __construct() {

            parent::__construct();

        }



    
    public function getparent_id()
    {   
       
        $query  = $this->db->query("SELECT id FROM  certificate");
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
            $this->db->join('z_payment as p ',' p.id = docx_certificate.payment_id','left');
            $this->db->join('clint as c ',' c.id = docx_certificate.user_id','left');
            $this->db->join('sub_sub_category as ss ',' ss.id = docx_certificate.doc_id','left');
            $this->db->select('docx_certificate.*, p.payment_status, ss.sub_sub_category_name, c.fname,c.lname');
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
            

            $this->action_condition();//call action condition function

             
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
            $this->action_condition();//call action condition function
            return $query->num_rows();
        }
        // Count all
        public function count_all()
        {
            $this->db->from($this->table);

            $this->action_condition();//call action condition function

            return $this->db->count_all_results();
        }


          // action type
          public function action_condition(){
            if(isset($_GET['type']) && $_GET['type'] == 'open'){
                $this->db->where('p.payment_status','pending');   
            }
            if(isset($_GET['type']) && $_GET['type'] == 'close'){
                $this->db->where('p.payment_status','Success');   
            }

            if(isset($_GET['type']) && $_GET['type'] == '1'){
                $curentdate=date("Y-m-d H:i:s");
                $fromdate = date("Y-m-d 00:00:00");
                $this->db->where('dateAt<=', $curentdate);
                $this->db->where('dateAt>=', $fromdate);
            }
            if(isset($_GET['type']) && $_GET['type'] == '7'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-7 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('dateAt<=', $curentdate);
                $this->db->where('dateAt>=', $fromdate);
            }
            if(isset($_GET['type']) && $_GET['type'] == '30'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-30 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('dateAt<=', $curentdate);
                $this->db->where('dateAt>=', $fromdate);
            }
            if(isset($_GET['type']) && $_GET['type'] == '365'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-365 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('dateAt<=', $curentdate);
                $this->db->where('dateAt>=', $fromdate);
            }
            if(isset($_GET['type']) && $_GET['type'] == 'daterangefilter'){
                $from_date= date('Y-m-d H:i:s', strtotime($_GET['from_date']));
                $from_date= date('Y-m-d 00:00:00', strtotime($from_date));
                $to_date= date('Y-m-d H:i:s', strtotime($_GET['to_date']));
                $to_date= date('Y-m-d 23:59:59', strtotime($to_date));
    
                $this->db->where('docx_certificate.dateAt >=', $from_date);
                $this->db->where('docx_certificate.dateAt <=', $to_date);
            }

          }

}





  