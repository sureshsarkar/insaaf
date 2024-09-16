<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Product_model extends Base_model
{
    public $table = "product";
    var $column_order = array(null, null,'product.name','product.no_item','category.name','product.status','product.date_at'); //set column field database for datatable orderable
    var $column_search = array(null,null,'product.name', 'product.no_item','category.name','product.status','product.name'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order

    

        function __construct() {

            parent::__construct();

        }



     function delete($id) {

        $this->db->where('id', $id);

        $this->db->delete($this->table);        

        return $this->db->affected_rows();

    }
	
    // get all record from table 
    public function all_list($tablename) {
        $query = $this->db->select("")
                ->from($tablename)
                ->get();
        if ($query->num_rows() > 0) {
            $result_array = array();
            foreach($query->result() as $row)
            {
               $result_array[] = $row;
            }
            return $result_array;
        } else {
            return array();
        }
    }
    // get parent id 
    public function getparent_id()
    {   
       
        $query  = $this->db->query("SELECT id, name FROM  category");
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
    // end parent id
	
	// cart product
	public function cart_product($data) {
			
			//$this->db->select('*');
			$this->db->from($this->table);
			foreach($data as $k=>$v)
			{
				
				if(isset($where))
				{
					$where .= " OR id='".$k."'";
				}
				else
					$where = "id='".$k."'";
			}
			
			$this->db->where($where);
			
			$query = $this->db->get();
           if ($query->num_rows() > 0) {

               $result = $query->result();
               $temp = $query->result();
			   foreach($temp as $k=>$v)
			   {
				   $result[$k]->no_item = $data[$v->id]; 
			   }
			   return $result;
			}
			else {

                return array();

            }

			exit;
            

        }
		
		// Find
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
        function get_datatables($where = NULL)
        {
           /* pre($_POST);*/
           if(empty($where))
           {
            $where=NULL;
           }
            $this->_get_datatables_query($where);
            if(isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
//echo $str = $this->db->last_query();
            return $query->result();
        }
        // Get Database 

        
        public function _get_datatables_query($where = NULL)
        {     

            $this->db->select('product.*,category.name as category');
            //$this->db->from('product');
            $this->db->join('category','category.id=product.category_id');
           
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
             
            // for quintity where 
       /*     if(isset($_POST['quintity']))
            {
                echo 'ok';
               // $where .= " OR id='".$k."'";
            }
            else{
                echo 'by';
                //$where = "id='".$k."'";
            

            //$this->db->where($where);
            }
            */
            
          /*  $_POST['no_item']  =   10;
            if(isset($_POST['no_item'])){

                $this->db->where('product.no_item<=',$_POST['no_item']);
            }*/
            
            if(isset($_POST['order'])) // here order processing
            {     
              

              $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);


            } 
            else if(isset($this->order))
            {
                $order = $this->order;
                $this->db->order_by(key($order), $order[key($order)]);
            }

            /*if(isset($where))
            {
                $this->db->where('product.date_at LIKE ',"%".$where."%");
            }*/
            




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

}





  