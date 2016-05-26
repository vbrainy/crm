<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Leads_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function exists_email( $email )
    {
		$email_count = $this->db->get_where('leads',array('email' => $email))->num_rows();
		return $email_count;
        
    }
    
    function add_leads()
    {
    		$tags_value= implode(',',$this->input->post('tags'));
    		if( empty( $tags_value ))
			{
			    $tags='';
			}
			else
			{
				$tags=$tags_value;
			}
    					 
			$leads_details = array(
	            'opportunity' => $this->input->post('opportunity'),
	            'company_name' => $this->input->post('company_name'),
	            'customer' => $this->input->post('customer'),
	            'address' => $this->input->post('address'),
	            'country_id' => $this->input->post('country_id'),
	            'state_id' => $this->input->post('state_id'),
	            'city_id' => $this->input->post('city_id'),
	            'salesperson_id' => $this->input->post('salesperson_id'),
	            'segment_id' => $this->input->post('segment_id'),
	            'contact_name' => $this->input->post('contact_name'),
	            'title' => $this->input->post('title'),
	            'email' => $this->input->post('email'),
	            'function' => $this->input->post('function'),
	            'phone' => $this->input->post('phone'),
	            'mobile' => $this->input->post('mobile'),
	            'fax' => $this->input->post('fax'),
	            'tags' => $tags,
	            'priority' => $this->input->post('priority'),
	            'internal_notes' => $this->input->post('internal_notes'),
	            'assigned_partner_id' => $this->input->post('assigned_partner_id'), 
	            'sources' => $this->input->post('sources'),
	            'register_time' => strtotime( date('d F Y g:i a') ),
	            'ip_address' => $this->input->server('REMOTE_ADDR')
	            );
	                                    
	       	 return $this->db->insert('leads',$leads_details);
		 
		  
	}
	
	function update_leads()
    {
    	$leads_details = array(
	            'opportunity' => $this->input->post('opportunity'),
	            'company_name' => $this->input->post('company_name'), 
	            'customer' => $this->input->post('customer'),
	            'address' => $this->input->post('address'),
	            'country_id' => $this->input->post('country_id'),
	            'state_id' => $this->input->post('state_id'),
	            'city_id' => $this->input->post('city_id'),
	            'salesperson_id' => $this->input->post('salesperson_id'),
	             'segment_id' => $this->input->post('segment_id'),
	            'contact_name' => $this->input->post('contact_name'),
	            'title' => $this->input->post('title'),
	            'email' => $this->input->post('email'),
	            'function' => $this->input->post('function'),
	            'phone' => $this->input->post('phone'),
	            'mobile' => $this->input->post('mobile'),
	            'fax' => $this->input->post('fax'),
	            'tags' => implode(',',$this->input->post('tags')),
	            'priority' => $this->input->post('priority'),
	            'internal_notes' => $this->input->post('internal_notes'),
	            'assigned_partner_id' => $this->input->post('assigned_partner_id'),
	             'sources' => $this->input->post('sources'),
	            );	
	           
		 return $this->db->update('leads',$leads_details,array('id' => $this->input->post('lead_id')));
	}
    
	function leads_list($staff_id)
	{	
		if($staff_id!='1')
		{
			$this->db->where('salesperson_id', $staff_id);
		} 
		
		$this->db->order_by("id", "desc");		
        $this->db->from('leads');
         
        return $this->db->get()->result();
	} 
	
    function get_lead( $lead_id,$staff_id )
	{
		if($staff_id!='1')
		{
			return $this->db->get_where('leads',array('id' => $lead_id,'salesperson_id' => $staff_id))->row();
		}
		else
		{
			return $this->db->get_where('leads',array('id' => $lead_id))->row();
		}	
		
	}
	
	function delete( $lead_id )
	{
		$this->db->delete('calls',array('call_type_id' => $lead_id));
		
		if( $this->db->delete('leads',array('id' => $lead_id)) )  // Delete customer
		{  
			return true;
		}
	}
     
	function country_list()
	{
		$this->db->order_by("name", "asc");		
        $this->db->from('countries');
         
        return $this->db->get()->result();
	}
	 
	 function state_list($country_id)
     {
       
        $this->db->order_by("name", "asc");		
        $this->db->select('states.*');
        $this->db->from('states');
        $this->db->where('country_id', $country_id);
         
        return $this->db->get()->result();        
       
     }
     function city_list($state_id)
     {
       
        $this->db->order_by("name", "asc");		
        $this->db->select('cities.*');
        $this->db->from('cities');
        $this->db->where('state_id', $state_id);
         
        return $this->db->get()->result();        
       
     }
     
     function add_convert_to_opportunity()
     {
     	$data['lead'] = $this->leads_model->get_lead( $this->input->post('convert_opport_lead_id'),userdata('id') );
     	
     	  
	 	$opportunity_details = array(
	            'opportunity' => $data['lead']->opportunity,
	            'customer' => $data['lead']->customer,            
	            'email' => $data['lead']->email,
	            'phone' => $data['lead']->phone,
	            'salesperson_id' => $this->input->post('salesperson_id'),
	            'segment_id' => $this->input->post('segment_id'),
	            'next_action' => date('Y-m-d'),
	            'expected_closing' => date('Y-m-d'),
	            'priority' => $data['lead']->priority,
	            'tags' => $data['lead']->tags,
	            'internal_notes' => $data['lead']->internal_notes,
	            'assigned_partner_id' => $data['lead']->assigned_partner_id, 
	            'register_time' => strtotime( date('d F Y g:i a') ),
	            'ip_address' => $this->input->server('REMOTE_ADDR')
	            );
	                                   
	       	 return $this->db->insert('opportunities',$opportunity_details);
	 	
	 }

}



?>