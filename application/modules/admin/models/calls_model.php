<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Calls_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function add_calls()
    {
    		$calls_details = array(
	            'call_type' => $this->input->post('call_type'),
	            'call_type_id' => $this->input->post('call_type_id'),
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
	            'call_type' => $this->input->post('call_type'),
	            'call_type_id' => $this->input->post('call_type_id'),
	            'date' => strtotime( $this->input->post('date')),
	            'call_summary' => $this->input->post('call_summary'),
	            'company_id' => $this->input->post('company_id'),
	            'resp_staff_id' => $this->input->post('resp_staff_id'),
	            );
	                                    
	       	 return $this->db->update('calls',$calls_details,array('id' => $this->input->post('call_id')));
		 
	}
	 
	function calls_list($type_id,$type)
	{
		 
        $this->db->order_by("id", "desc");		
        $this->db->select('calls.*');
        $this->db->from('calls');
        $this->db->where(array('call_type_id'=> $type_id,'call_type'=> $type));
         
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