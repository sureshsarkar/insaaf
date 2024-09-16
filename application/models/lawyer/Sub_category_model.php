<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Sub_category_model extends Base_model
{
    public $table = "z_sub_category";
    var $column_order = array(null, 'sc.image','c.name','sc.name','sc.status','sc.date_at'); //set column field database for datatable orderable
    var $column_search = array('sc.image','c.name','sc.name','sc.status','sc.date_at'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order

        

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
            $this->db->select('sc.*,c.name as category');
            $this->_get_datatables_query();
            if(isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $query = $this->db->get();
            return $query->result();
        }
        // Get Database 
         public function _get_datatables_query()
        {   
            $this->db->from($this->table. ' as sc');  
            $this->db->join('z_product_category as c', 'c.id = sc.category_id');
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
                $this->db->order_by("sc.".key($order), $order[key($order)]);
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

        function getAllSubParent($parentId){
               $where = array();
               $where['parent_id'] =  $parentId;
               $where['status'] =  1;
               $where['field'] = 'id';
               $rData = $this->findDynamic($where);
               //pre($rData);
               $inData = '';
               if(!empty($rData))
               while (count($rData) != 0 ) {
                    $TempInData = '';
                   foreach ($rData as $v) {
                      $TempInData = empty($TempInData)?$v->id:$TempInData.",".$v->id;
                   }

                    $this->db->select("id");
                    $this->db->from($this->table);
                    //$this->db->where_in("parent_id", "$TempInData");
                    $this->db->where("parent_id IN (".$TempInData.")",NULL, false);
                    $query = $this->db->get();
                    $rData = $query->result();
                    $this->db->last_query();
                    $inData = empty($inData)?$TempInData:$inData.",".$TempInData;
               }
               return $inData;
        }

        public function getSubCategory($parentId = null, $nextAll = Null){
            if(!empty($nextAll)){
               $inData = $this->getAllSubParent($parentId);
            }

            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->order_by('no_of_parent', 'ASC');

            if(isset($inData))
                $this->db->where("parent_id IN (".$inData.")",NULL, false);
            else if(!empty($parentId))
                $this->db->where('parent_id', $parentId);

            $this->db->where('status', '1');
            $query = $this->db->get();
            $list = $query->result(); 
            return $list;
        }
        public function SubCategoryWithParent($parenId = null){
            $this->db->select('id,name,parent_id,no_of_parent');
            $this->db->from($this->table);
            $this->db->order_by('no_of_parent', 'ASC');
            if(!empty($parenId))
            $this->db->where('parent_id', $parenId);
            $query = $this->db->get();
            $result = $query->result(); 

            $list = array();       
            foreach ($result as $key => $v) {
                if($v->no_of_parent == 0){
                    $list[$v->id] = $v->name;
                }else{
                    $list[$v->id] = isset($list[$v->parent_id])?$v->name.", ".$list[$v->parent_id]:$v->name;
                    
                }
            }
            return $list;
        }

}





  