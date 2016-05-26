<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class regions_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function add_region()
    {
    		  
			$region_details = array(
	            'region' => $this->input->post('region'),
	            'region_leader' => $this->input->post('region_leader'),	            
	            'sales_target' => $this->input->post('sales_target'),
	            'sales_forecast' => $this->input->post('sales_forecast'),
	             'actual_sales' => $this->input->post('actual_sales'),
	            'status' => $this->input->post('status'),	             
	            'region_members' => implode(',',$this->input->post('region_members')),
	            'notes' => $this->input->post('notes'),	            
	            'register_time' => strtotime( date('d F Y g:i a') ),
	            'ip_address' => $this->input->server('REMOTE_ADDR')
	            );
	                               
	       	 return $this->db->insert('regions',$region_details);
		 
		  
	}
	
	function update_region()
    {
    	$region_details = array(
	            'region' => $this->input->post('region'),
	            'region_leader' => $this->input->post('region_leader'),	            
	            'sales_target' => $this->input->post('sales_target'),
	            'sales_forecast' => $this->input->post('sales_forecast'),
	            'actual_sales' => $this->input->post('actual_sales'),
	            'status' => $this->input->post('status'),	             
	            'region_members' => implode(',',$this->input->post('region_members')),
	            'notes' => $this->input->post('notes'),
	            );
	            	
		 return $this->db->update('regions',$region_details,array('id' => $this->input->post('region_id')));
	}
    
	function regions_list()
	{
		$this->db->order_by("id", "desc");		
       $this->db->from('regions');
         
       return $this->db->get()->result();
	} 
	
    function get_region( $region_id )
	{
		return $this->db->get_where('regions',array('id' => $region_id))->row();
	}
	
	function delete( $region_id )
	{
		if( $this->db->delete('regions',array('id' => $region_id)) )  // Delete region
		{  
			return true;
		}
	}
     
	 

}



?>