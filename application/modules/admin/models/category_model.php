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
	            );
	                                    
	       	 return $this->db->insert('category',$category_details);
		 
		  
	}
	
	function update_category()
    {
    	$category_details = array(
	            'category_name' => $this->input->post('category_name'),	             
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
	
	function delete( $category_id )
	{
		if( $this->db->delete('category',array('id' => $category_id)) )  // Delete customer
		{  
			return true;
		}
	}
     
	  

}



?>