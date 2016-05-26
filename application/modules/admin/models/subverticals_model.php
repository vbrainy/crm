<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Subverticals_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function add_subverticals()
    {
    	
				$subverticals_details = array(
		            'subvertical_name' => $this->input->post('subvertical_name'),
		            'vertical_id' => $this->input->post('vertical_id'),
		            'status' => $this->input->post('status'),
		            'description' => $this->input->post('description'),
		            'active' => $this->input->post('active'),
		            
		          
		            	             
		            );
	            
	             
	        return $this->db->insert('subverticals',$subverticals_details);
	        
	        
	           
		  
	}
	
	function update_subverticals()
    {
  	
    		 
				$subverticals_details = array(
		            'subvertical_name' => $this->input->post('subvertical_name'),
		            'vertical_id' => $this->input->post('vertical_id'),
		            'status' => $this->input->post('status'),
		            'description' => $this->input->post('description'),
		            'active' => $this->input->post('active')
		            
		            	             
		            );
	      
	     
	          
		   	
	           
		 return $this->db->update('subverticals',$subverticals_details,array('id' => $this->input->post('subvertical_id')));
	}
	
    
	function subverticals_list()
	{
		$this->db->order_by("id", "desc");		
        $this->db->from('subverticals');
         
        return $this->db->get()->result();
	} 
	
    function get_subverticals( $subvertical_id )
	{
		return $this->db->get_where('subverticals',array('id' => $subvertical_id))->row();
	}
	
	function delete( $subvertical_id )
	{
		
		
		if( $this->db->delete('subverticals',array('id' => $subvertical_id)) )  // Delete customer
		{  
			return true;
		}
	}
     
	
	 

}



?>