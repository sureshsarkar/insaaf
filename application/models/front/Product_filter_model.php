<?php
class Product_filter_model extends CI_Model
{
	function fetch_filter_type($type)
	{
		$this->db->distinct();
		$this->db->select($type);
        $this->db->from('product');
		$this->db->where('status', '1');
		$this->db->order_by('product_id', 'DESC');
		return $this->db->get();
	}

	function make_query($minimum_price, $maximum_price, $brand, $ram, $storage)
	{
		$query = "
		SELECT * FROM product 
		WHERE status = '1' 
		";
		
		if(isset($minimum_price, $maximum_price) && !empty($minimum_price) && !empty($maximum_price))
		{   
            $minimum_price = 100;
            $maximum_price = 500;
            $sql = "SELECT * from product where status=1";
            $p = $this->product_model->rawQuery($sql);
            //pre($p);
            $p_array=array();
            $inData1="";
            foreach ($p as $key => $value) {
                $price = json_decode($value->price);
            //    / pre($price);
                for($i=0;$i<count($price);$i++)
                {

                    $database_price=$price[$i];
                    if($database_price>$minimum_price && $database_price < $maximum_price)
                    {
                        $inData1 .= isset($value->id)?"'".$value->id."',":"'".$value->id."'";
                        
                        array_push($p_array,$value->id);
                        //pre($database_price);
                    }

                }
          
            }
            $inData1=substr_replace($inData1 ,"",-1);
           
           
			// $query .= "
			//  AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
			// ";
            $query .= " AND id '".$inData1."'";
		}

		if(isset($brand))
		{
			
			$brand_filter = implode("','", $brand);
			$query .= "
			 AND category_id IN('".$brand_filter."')
			";
		}
		if(isset($ram))
		{
			
			$ram_filter = implode("%' OR color LIKE '%", $ram);
			$ram_filter.="%'";
			// /$ram_filter.="]";
			$query .= "
			 AND color LIKE '%".$ram_filter."
			";
		}
		if(isset($storage))
		{
			$storage_filter = implode("%' OR size LIKE '%", $storage);
			$storage_filter.="%'";
			// /$ram_filter.="]";
			$query .= "
			 AND size LIKE '%".$storage_filter."
			";

			
		}
        echo $query;
		return $query;
	}

	function fetch_data($limit, $start, $minimum_price, $maximum_price, $brand, $ram, $storage)
	{
	 	$query = $this->make_query($minimum_price, $maximum_price, $brand, $ram, $storage);

	 	$query .= ' LIMIT '.$start.', ' . $limit;

		$data = $this->db->query($query);

		$output = '';
		if($data->num_rows() > 0)
		{
				
            foreach ($data->result_array() as $key => $value) {

                if(!empty($value['image']))
                {
                    $image_array = json_decode($value['image'],true);
                }
                if(isset($cart_list)){
                    $cart_status =  findKey($cart_list,$value['id']);
                }
                
                if(!empty($wishlist)){
                    $wish_status =  findwishlist($wishlist,$value['id']);
                } 

                $regular_price1 = json_decode($value['regular_price']); 
                $regular_price =      number_format($regular_price1[0],0);
                $price1 = json_decode($value['price']); 
                $price =      $price1[0];
            
                $output.='  
                <div class="col-md-3 pb-2">
                    <div class="latest-items item bg1 ">
                        <div class="properties pb-30">
                            <div class="properties-card volgaWpButton">
                                <div class="">';
                                /* code for already wish list added or not */
                                    
                                    if(isset($wish_status) && $wish_status == 1)
                                    {
                                    $output.='
                                        <a href="javascript:void(0)" id="disproductid_'.$value['id'].'" class="ml_200 WishListChange  productid_'.$value['id'].' wish_id_'.$value['id'].'" data_id="'.$value['id'].'" data-toggle="tooltip" data-placement="top" title="Already Added in wishlist">
                                        <i class="fa fa-heart mt-2 pt-1" aria-hidden="true"></i>
                                        </a>'; 

                                    }else{
                                    $output.='
                                        <a href="javascript:void(0)" id="productid_'.$value['id'].'" class="ml_200 productid_'.$value['id'].' add_wish wish_id_'.$value['id'].'" data-id="'.$value['id'].'" style="color:#000!important;" >
                                            <i class="fa fa-heart-o mt-2 pt-1" aria-hidden="true"></i>
                                        </a>                                        
                                    ';
                                    }
                                    /* end code for already wish list added or not */

                                    $output.='<div class="properties-img">
                                                <a href="'.base_url('product/details/'.$value['slug_url'].'').'">
                                                    <div class="items-img shopBycategory shopByproduct" style="background-image: url('. base_url().'uploads/product/'. $image_array[0].');">    
                                                    </div>
                                                </a>
                                                </div>
                                            </div>';           
                                    $output.='
                                        </div>
                                    </div>


                                    <div class="properties-caption properties-caption2">
                                        <a href="'.base_url('product/details/'.$value['slug_url'].'').'">
                                            <h6 class="overflowText">'.$value['name'].'</h6>
                                            <div class="properties-footer">
                                                <div class="price">
                                            
                                                    <span class="text-success">
                                                        ₹'.$regular_price.'
                                                    </span>
                                                    <strike>
                                                        <span class="pl-3">₹'.$price.'</span>
                                                    </strike>
                                                
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>
                ';
            }
		}
		else
		{
			$output = '<h3>No Data Found</h3>';
		}
		return $output;
	}

	function count_all($minimum_price, $maximum_price, $brand, $ram, $storage)
	{
	 	$query = $this->make_query($minimum_price, $maximum_price, $brand, $ram, $storage);
		$data = $this->db->query($query);
		return $data->num_rows();
	}

}
?>