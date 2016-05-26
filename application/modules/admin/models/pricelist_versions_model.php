<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Pricelist_versions_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function exists_products( $pricelist_vers_id,$product_id )
    {
		$product_count = $this->db->get_where('pricelist_versions_products',array('pricelist_versions_id' => $pricelist_vers_id,'product_id'=> $product_id))->num_rows();
		return $product_count;
        
    }
    
    function add_pricelists_versions()
    {
    	  
				$pricelist_version_details=array(							
							'pricelist_version_name'  =>  $this->input->post('pricelist_version_name'),
							'pricelist_id'  =>  $this->input->post('pricelist_id'),
							'active'  =>  $this->input->post('active'),
							'start_date'  =>  strtotime($this->input->post('start_date')),
							'end_date'  =>  strtotime($this->input->post('end_date'))							  
							  );
	      
	                                   
	        $pricelist_vers_res = $this->db->insert('pricelist_version',$pricelist_version_details);
	       
	        $pricelist_version_id = $this->db->insert_id();
	        
	           //Add pricelist version 
				$count = count($this->input->post('product_name'));
				for($i=0;$i<$count;$i++)
				{
					 $products_add=array(
							'pricelist_versions_id'  =>  $pricelist_version_id,
							'product_id'  =>  $this->input->post('p_id')[$i],
							'product_name'  =>  $this->input->post('product_name')[$i],
							'discription'  =>  $this->input->post('description')[$i], 
							'price'  =>  $this->input->post('product_price')[$i],
							'special_price'  =>  $this->input->post('special_price')[$i]
							 
							  );
										
				        $pricelist_versions_products = $this->db->insert('pricelist_versions_products',$products_add);
				}
				 
	       return $pricelist_vers_res;
		 
		  
	}
	
	function update_pricelists_versions()
    {
    	 $pricelist_version_details=array(							
							'pricelist_version_name'  =>  $this->input->post('pricelist_version_name'),
							'pricelist_id'  =>  $this->input->post('pricelist_id'),
							'active'  =>  $this->input->post('active'),
							'start_date'  =>  strtotime($this->input->post('start_date')),
							'end_date'  =>  strtotime($this->input->post('end_date'))							  
							  );
		 
		      //Add or Edit 
				$count = count($this->input->post('product_name'));
				for($i=0;$i<$count;$i++)
				{
					 
					if(isset($this->input->post('pricelist_ver_product_id')[$i]))
					{
						
						$products_edit=array(
							'pricelist_versions_id'  =>  $this->input->post('pricelist_version_id'),
							'product_id'  =>  $this->input->post('p_id')[$i],
							'product_name'  =>  $this->input->post('product_name')[$i],
							'discription'  =>  $this->input->post('description')[$i], 
							'price'  =>  $this->input->post('product_price')[$i],
							'special_price'  =>  $this->input->post('special_price')[$i]
							 
							  );
						
						$this->db->update('pricelist_versions_products',$products_edit,array('id' => $this->input->post('pricelist_ver_product_id')[$i]));			  
					}
					else
					{
						 if( $this->pricelist_versions_model->exists_products( $this->input->post('pricelist_version_id'), $this->input->post('p_id')[$i] ) > 0)
				        {
				            echo '<div class="alert error">Product already added.</div>';
				            exit;
				        }	
						
						  $products_add=array(
							'pricelist_versions_id'  =>  $this->input->post('pricelist_version_id'),
							'product_id'  =>  $this->input->post('p_id')[$i],
							'product_name'  =>  $this->input->post('product_name')[$i],
							'discription'  =>  $this->input->post('description')[$i], 
							'price'  =>  $this->input->post('product_price')[$i],
							'special_price'  =>  $this->input->post('special_price')[$i]
							 
							  );
										
				        $pricelist_versions_products = $this->db->insert('pricelist_versions_products',$products_add);  
			
					}
					
					 
			
				} 
	           
		 return $this->db->update('pricelist_version',$pricelist_version_details,array('id' => $this->input->post('pricelist_version_id')));
	}
    
	function pricelist_versions_list()
	{
		$this->db->order_by("id", "desc");		
        $this->db->from('pricelist_version');
        
         
        return $this->db->get()->result();
	} 
	
    function get_pricelist_version( $pricelist_ver_id )
	{
		return $this->db->get_where('pricelist_version',array('id' => $pricelist_ver_id))->row();
	}
	
	function delete( $pricelist_id )
	{
		$this->db->delete('pricelist_versions_products',array('pricelist_versions_id' => $pricelist_id));
		
		if( $this->db->delete('pricelist_version',array('id' => $pricelist_id)) )  // Delete 
		{  
			return true;
		}
	}
     
	
	function pricelist_version_product($pricelist_ver_id)
	{
		$this->db->where(array('pricelist_versions_id' => $pricelist_ver_id) );
		$this->db->order_by("id", "desc");		
        $this->db->from('pricelist_versions_products');
         
        return $this->db->get()->result();
	}
	
	function delete_price_ver_product( $product_id )
	{
		if( $this->db->delete('pricelist_versions_products',array('id' => $product_id)) )  
		{  
			return true;
		}
	}   

}



?>