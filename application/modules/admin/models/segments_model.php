<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class segments_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function add_segment()
    {
    		  
			$segment_details = array(
	            'segment' => $this->input->post('segment'),
	            'quotations' => $this->input->post('quotations'),
	            'leads' => $this->input->post('leads'),
	            'opportunities' => $this->input->post('opportunities'),
	            'segment_leader' => $this->input->post('segment_leader'),	            
	            'sales_target' => $this->input->post('sales_target'),
	            'sales_forecast' => $this->input->post('sales_forecast'),
	            'actual_sales' => $this->input->post('actual_sales'),
	            'status' => $this->input->post('status'),
	            'regions' => $this->input->post('regions'),
	            'segment_members' => implode(',',$this->input->post('segment_members')),
	            'notes' => $this->input->post('notes'),	            
	            'register_time' => strtotime( date('d F Y g:i a') ),
	            'ip_address' => $this->input->server('REMOTE_ADDR')
	            );
	                               
	       	 return $this->db->insert('segments',$segment_details);
		 
		  
	}
	
	function update_segment()
    {
    	$segment_details = array(
	            'segment' => $this->input->post('segment'),
	            'quotations' => $this->input->post('quotations'),
	            'leads' => $this->input->post('leads'),
	            'opportunities' => $this->input->post('opportunities'),
	            'segment_leader' => $this->input->post('segment_leader'),	            
	            'sales_target' => $this->input->post('sales_target'),
	            'sales_forecast' => $this->input->post('sales_forecast'),
	            'actual_sales' => $this->input->post('actual_sales'),
	            'status' => $this->input->post('status'),
	            'regions' => $this->input->post('regions'),
	            'segment_members' => implode(',',$this->input->post('segment_members')),
	            'notes' => $this->input->post('notes')
	            );
	            	
		 return $this->db->update('segments',$segment_details,array('id' => $this->input->post('segment_id')));
	}
    
	function segments_list()
	{
		$this->db->order_by("id", "desc");		
        $this->db->from('segments');
         
        return $this->db->get()->result();
	} 
	
    function get_segment( $segment_id )
	{
		return $this->db->get_where('segments',array('id' => $segment_id))->row();
	}
	
	function delete( $segment_id )
	{
		if( $this->db->delete('segments',array('id' => $segment_id)) )  // Delete customer
		{  
			return true;
		}
	}
     
	 

}



?>