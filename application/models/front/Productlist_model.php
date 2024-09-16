<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class productlist_model extends Base_model
{   
    
    public $table = "product";   

    var $column_order = array(null, 'service_name','service_price','service_at','service_status'); //set column field database for datatable orderable
    var $column_search = array('service_name','service_price','service_at','service_status'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order

        

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

    /*public function all() {
            $query = $this->db->select("")
                    ->from($this->table)
                    ->get();
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            }
        }*/
    /* end code for product list without condtion */

    /* get treanding prodcut or deal of day  or featured */
    public function treandingProdcut($data){
        $arr = array();
        $arr['status']      = 1;
        $arr['field']       =   'name,id,image,slug_url,regular_price,price';
        $arr['limit']       =   $data['limit'];  
        //$arr['orderby']     =   $data['id'];  
        $arr[$data['columName']]     = 1 ; 
        $arr['table']     =   $data['table'];
        $result = $this->findDynamic($arr);
        return $result;
    }
    /* end treanding product  or deal of day  or featured   */
    public function productDetails($data){
                $query = $this->db->select('*')

                    ->from($data['table'])

                    ->where('category_id', $data['categoryId'])

                    ->get();

            if ($query->num_rows() > 0) {

                $result = $query->result();

                return $result[0];

            } else {

                return array();

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
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }
        function rawQuery($sql)  
        {
            $query = $this->db->query($sql);
            //$result =  $query->result_array();
            $result = $query->result();        
            return $result;
        }
}
