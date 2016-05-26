<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Logged_calls_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function add_calls()
    {
    		$calls_details = array( 
	            'date' => strtotime( $this->input->post('date')),
	            'call_summary' => $this->input->post('call_summary'),
	            'company_id' => $this->input->post('company_id'),
	            'resp_staff_id' => $this->input->post('resp_staff_id'),
	            );
	                                    
	       	 return $this->db->insert('calls',$calls_details);
		 
	}
	
	function edit_calls()
    {
    		$calls_details = array( 
	            'date' => strtotime( $this->input->post('date')),
	            'call_summary' => $this->input->post('call_summary'),
	            'company_id' => $this->input->post('company_id'),
	            'resp_staff_id' => $this->input->post('resp_staff_id'),
	            );
	                                    
	       	 return $this->db->update('calls',$calls_details,array('id' => $this->input->post('call_id')));
		 
	}
	 
	function logged_calls_list($customer_id)
	{
		
		if($customer_id!="")
		{
			$this->db->where(array('company_id' => $customer_id) ); 
		} 
		if(userdata('id')!='1')
		{
			$this->db->where('resp_staff_id', userdata('id'));
		}
		
        $this->db->order_by("id", "desc");		
        $this->db->select('calls.*');
        $this->db->from('calls');
        return $this->db->get()->result();
	} 
	
    function get_call( $call_id )
	{
		return $this->db->get_where('calls',array('id' => $call_id))->row();
	}
	
	function delete( $call_id )
	{
		if( $this->db->delete('calls',array('id' => $call_id)) )  // Delete call
		{  
			return true;
		}
	}
     
	 
}
 
?>