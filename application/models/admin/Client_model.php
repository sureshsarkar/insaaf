<?php if(!defined('BASEPATH')) exit('No direct script access allowed');



class Client_model extends Base_model
{
    public $table = "clint";
    var $column_order = array(null,'fname','lname','mobile','email','city','state','dt','client_unique_id'); //set column field database for datatable orderable
    var $column_search = array('fname' ,'lname','mobile','email','city','state','dt','client_unique_id'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order

        

        function __construct() {

            parent::__construct();

        }



    
    public function getparent_id()
    {   
       
        $query  = $this->db->query("SELECT id, FROM  clint");
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
            $this->getAction();
            return $query->num_rows();
        }

        // Count all
        public function count_all()
        {
            // $this->db->from($this->table);
            $this->_get_datatables_query();
            $this->getAction();
            return $this->db->count_all_results();
        }



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

    // send otp for client 
    public function otp_verify($data)
    {
        $ch = $data->type;
        switch ($ch) {
            case 'send_otp':
                
                $num = isset($mobile)?$mobile:$data->mobile;
                $otp = rand(1231,7879);
                $_SESSION['otp'] = $otp;
                $message='Your one Time OTP is : '.$otp.'
Team Insaaf99.com';
                
              //  $response = send_sms($num,$message);
                $data['otp'] = $otp;
                $data['mobile'] = $mobile;
                $arr = array ('status'=>'success','data'=>$data);
                return $arr;
                
                break;
            
            case 'verify_otp':
                $user_otp   = $_POST['otp'];
                $verify_otp = $_SESSION['otp'];
                
                if ($verify_otp == $user_otp) {
                    
                    echo "success";
                    
                }
                break;
            
            default:
                # code...
                break;
        }
    }

    // end code for send otp for client 

    public function getAction(){
        if(isset($_GET['type']) && $_GET['type'] == 'new_lawyer'){
            $this->db->where('clint.status','0');
        }
        if(isset($_GET['type']) && $_GET['type'] == 'close'){
            $this->db->where('clint.status','1');
        }
        if(isset($_GET['type']) && $_GET['type'] == 'all'){
            $this->db->where_in('clint.status',array('0','1','2'));
        }
        if(isset($_GET['type']) && $_GET['type'] == 'daterangefilter'){
            $from_date= date('Y-m-d H:i:s', strtotime($_GET['from_date']));
            $from_date= date('Y-m-d 00:00:00', strtotime($from_date));
            $to_date= date('Y-m-d H:i:s', strtotime($_GET['to_date']));
            $to_date= date('Y-m-d 23:59:59', strtotime($to_date));

            $this->db->where('clint.dt >=', $from_date);
            $this->db->where('clint.dt <=', $to_date);
        }
    }
    
}