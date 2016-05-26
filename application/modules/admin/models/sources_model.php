<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Sources_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function add_source()
    {
    		 
			$source_details = array(
	            'source_name' => $this->input->post('source_name'),
	            'source_contacts' => $this->input->post('source_contacts'),
	            'source_sales' => $this->input->post('source_sales'),
	             'notes' => $this->input->post('notes'),	            
	            'register_time' => strtotime( date('d F Y g:i a') ),
	            'ip_address' => $this->input->server('REMOTE_ADDR')            
	            );
	                                    
	       	 return $this->db->insert('sources',$source_details);
		 
		  
	}
	
	function update_source()
    {
    	$source_details = array(
	             'source_name' => $this->input->post('source_name'),
	            'source_contacts' => $this->input->post('source_contacts'),
	            'source_sales' => $this->input->post('source_sales'),
	             'notes' => $this->input->post('notes'),	      	             
	            );
	           
		 return $this->db->update('sources',$source_details,array('id' => $this->input->post('source_id')));
	}
    
	function sources_list()
	{
		$this->db->order_by("id", "desc");		
        $this->db->from('sources');
         
        return $this->db->get()->result();
	} 
	
    function get_source( $source_id )
	{
		return $this->db->get_where('sources',array('id' => $source_id))->row();
	}
	
	function delete( $source_id )
	{
		if( $this->db->delete('sources',array('id' => $source_id)) )  // Delete customer
		{  
			return true;
		}
	}
     
	  

}



?>