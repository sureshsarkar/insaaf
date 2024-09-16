<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends Base_model
{   
    
    public $table = "z_payment";   

    var $column_order = array(null,'c.fname','c.lname','c.mobile','z_payment.amount','payment_status','z_payment.payment_date'); //set column field database for datatable orderable
    var $column_search = array('c.fname','c.lname','c.mobile','z_payment.amount','payment_status','z_payment.payment_date'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order

        

        function __construct() {

            parent::__construct();

        }



     function delete($id) {

        $this->db->where('id', $id);

        $this->db->delete($this->table);        

        return $this->db->affected_rows();

    }
    public function allRecord($data) 
    {
        $query = $this->db->select("")
                ->from($data['table'])
                ->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    /* find all product list without condtion */

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
    /* end code for product list without condtion */

    /* get treanding prodcut or deal of day  or featured */
 
    /* end treanding product  or deal of day  or featured   */
    
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

        // Get Video List
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
            $this->db->join('clint as c ',' c.id = z_payment.user_id','left');
            $this->db->select('z_payment.*,c.fname as fname,c.mobile as cmobile');
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
               if(isset($_GET['type']) && $_GET['type'] == 'open'){
                $this->db->where('z_payment.payment_status','pending');
            }
            if(isset($_GET['type']) && $_GET['type'] == 'close'){
                $this->db->where('z_payment.payment_status','success');
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
        
        function rawQuery($sql)  
        {
            $query = $this->db->query($sql);
            $result = $query->result();        
            return $result;
        }
}
