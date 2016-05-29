<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Category_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function add_category()
    {
    		 
			$category_details = array(
	            'category_name' => $this->input->post('category_name'),	    
	            'product_id' => $this->input->post('product_id')	             
	            );
	                                    
	       	 return $this->db->insert('category',$category_details);
		 
		  
	}
	
	function update_category()
    {
    	$category_details = array(
	            'category_name' => $this->input->post('category_name'),	             
	            'product_id' => $this->input->post('product_id')
	            );
	           
		 return $this->db->update('category',$category_details,array('id' => $this->input->post('category_id')));
	}
    
	function category_list()
	{
		$this->db->order_by("id", "desc");		
        $this->db->from('category');
         
        return $this->db->get()->result();
	} 
	
    function get_category( $category_id )
	{
		return $this->db->get_where('category',array('id' => $category_id))->row();
	}
	
	function get_product_category( $product_id )
	{
		$query = $this->db->get_where('category',array('product_id' => $product_id));
		return $query->result_array();
	}


	function delete( $category_id )
	{
		if( $this->db->delete('category',array('id' => $category_id)) )  // Delete customer
		{  
			return true;
		}
	}
     
	  

}



?>