<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends Base_model
{   
    
    public $table = "z_payment";   

    var $column_order = array(null,'z_payment.id','c.fname','c.lname','c.mobile','c.client_unique_id','amount','payment_type','payment_status','payment_date'); //set column field database for datatable orderable
    var $column_search = array('z_payment.id','c.fname','c.lname','c.mobile','c.client_unique_id','txn_id','payment_type','payment_status','payment_date', 'amount', 'order_id'); //set column field database for datatable searchable 
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
           $this->db->select('z_payment.*, c.fname as fname,c.mobile as cmobile');
           $i = 0;
           foreach ($this->column_search as $item) // loop column 
           {
            $search_var = $_POST['search']['value'];
            
            $search_var = createOrderIdDecode($search_var);
               if(isset($search_var) && $search_var) // if datatable send POST for search
               {
                   if($i===0) // first loop
                   {
                       $this->db->like($item, $search_var);
                   }
                   else
                   {
                       $this->db->or_like($item, $search_var);
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
            
            // action type
            if(isset($_GET['typeOf']) && $_GET['typeOf'] == 'all'){
            $this->db->where_in('z_payment.payment_status',['success','pending']);
            }

            if(isset($_GET['status']) && $_GET['status'] == 'open'){
            $this->db->where('z_payment.payment_status','pending');
            }

            if(isset($_GET['status']) && $_GET['status'] == 'close'){
            $this->db->where('z_payment.payment_status','success');
            }

            if(isset($_GET['typeOf']) && $_GET['typeOf'] == '1'){
                $curentdate=date("Y-m-d H:i:s");
                $fromdate = date("Y-m-d 00:00:00");
                $this->db->where('payment_date <=', $curentdate);
                $this->db->where('payment_date >=', $fromdate);
            }
            
            if(isset($_GET['typeOf']) && $_GET['typeOf'] == '7'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-7 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('payment_date <=', $curentdate);
                $this->db->where('payment_date >=', $fromdate);
            }
            if(isset($_GET['typeOf']) && $_GET['typeOf'] == '30'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-30 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('payment_date <=', $curentdate);
                $this->db->where('payment_date >=', $fromdate);
            }
            if(isset($_GET['typeOf']) && $_GET['typeOf'] == '365'){
                $curentdate=date("Y-m-d H:i:s");
                $curentdate1 = strtotime($curentdate);
                $fromdate = strtotime("-365 day", $curentdate1);
                $fromdate= date('Y-m-d H:i:s', $fromdate);
                $this->db->where('payment_date <=', $curentdate);
                $this->db->where('payment_date >=', $fromdate);
            }
            if(isset($_GET['daterange']) && $_GET['daterange'] == 'daterangefilter'){
                $from_date= date('Y-m-d H:i:s', strtotime($_GET['from_date']));
                $from_date= date('Y-m-d 00:00:00', strtotime($from_date));
                $to_date= date('Y-m-d H:i:s', strtotime($_GET['to_date']));
                $to_date= date('Y-m-d 23:59:59', strtotime($to_date));
    
                $this->db->where('z_payment.payment_date >=', $from_date);
                $this->db->where('z_payment.payment_date <=', $to_date);
            }

         }

        
        function rawQuery($sql)  
        {
            $query = $this->db->query($sql);
            //$result =  $query->result_array();
            $result = $query->result();        
            return $result;
        }
}