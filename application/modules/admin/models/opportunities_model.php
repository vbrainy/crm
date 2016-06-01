<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class opportunities_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function exists_email( $email )
    {
		$email_count = $this->db->get_where('opportunities',array('email' => $email))->num_rows();
		return $email_count;
        
    }
    
    function add_opportunities()
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
    		 
			$opportunity_details = array(
	            'opportunity' => $this->input->post('opportunity'),
	            'stages' => $this->input->post('stages'),
	            //'expected_revenue' => $this->input->post('expected_revenue'),
	            //'probability' => $this->input->post('probability'),
	            'customer' => $this->input->post('customer'),	            
	            //'email' => $this->input->post('email'),
	            //'phone' => $this->input->post('phone'),
	            'salesperson_id' => $this->input->post('salesperson_id'),
	            //'segment_id' => $this->input->post('segment_id'),
	            //'region_id' => $this->input->post('region_id'),
	            //'vertical_id' => $this->input->post('vertical_id'),
	            //'subvertical_id' => $this->input->post('subvertical_id'),
	            'next_action' => date('Y-m-d', strtotime($this->input->post('next_action'))),
	            //'next_action_title' => $this->input->post('next_action_title'),
	            'expected_closing' => date('Y-m-d', strtotime($this->input->post('expected_closing'))),
	            'identified_date' => date('Y-m-d', strtotime($this->input->post('identified_date'))),
	            'closed_date' => date('Y-m-d', strtotime($this->input->post('closed_date'))),
	            //'priority' => $this->input->post('priority'),
	            //'tags' => $tags,
	            //'lost_reason' =>$this->input->post('lost_reason'),	           
	            'internal_notes' => $this->input->post('internal_notes'),
	            //'assigned_partner_id' => $this->input->post('assigned_partner_id'), 
	             //'sources' => $this->input->post('sources'),
	            //'contact_name' => $this->input->post('contact_name'),
	            'register_time' => strtotime( date('d F Y g:i a') ),
	            'ip_address' => $this->input->server('REMOTE_ADDR')
	            );
	                                   
	       	 return $this->db->insert('opportunities',$opportunity_details);
		 
		  
	}
	
	function update_opportunities()
    {
    	$opportunity_details = array(
	            'opportunity' => $this->input->post('opportunity'),
	            'stages' => $this->input->post('stages'),
	            'expected_revenue' => $this->input->post('expected_revenue'),
	            'probability' => $this->input->post('probability'),
	            'customer' => $this->input->post('customer'),	            
	            'email' => $this->input->post('email'),
	            'phone' => $this->input->post('phone'),
	            'salesperson_id' => $this->input->post('salesperson_id'),
	            'segment_id' => $this->input->post('segment_id'),
	            'region_id' => $this->input->post('region_id'),
	            'vertical_id' => $this->input->post('vertical_id'),
	            'subvertical_id' => $this->input->post('subvertical_id'),
	            'next_action' => date('Y-m-d', strtotime($this->input->post('next_action'))),
	            'next_action_title' => $this->input->post('next_action_title'),
	            'expected_closing' => date('Y-m-d', strtotime($this->input->post('expected_closing'))),
	            'identified_date' => date('Y-m-d', strtotime($this->input->post('identified_date'))),
	            'closed_date' => date('Y-m-d', strtotime($this->input->post('closed_date'))),
	            'priority' => $this->input->post('priority'),
	            'tags' => implode(',',$this->input->post('tags')),
	            'lost_reason' =>$this->input->post('lost_reason'),	           
	            'internal_notes' => $this->input->post('internal_notes'),
	            'assigned_partner_id' => $this->input->post('assigned_partner_id'),
	            'sources' => $this->input->post('sources'),
	            'contact_name' => $this->input->post('contact_name'),
	            );
	            	
		 return $this->db->update('opportunities',$opportunity_details,array('id' => $this->input->post('opportunity_id')));
	}
    
	function opportunities_list($staff_id)
	{
		if($staff_id!='1')
		{
			$this->db->where('salesperson_id', $staff_id);
		}
		
		$this->db->order_by("id", "desc");		
        $this->db->from('opportunities');
         
        return $this->db->get()->result();
	} 
	
    function get_opportunities( $opportunity_id )
	{
		return $this->db->get_where('opportunities',array('id' => $opportunity_id))->row();
	}
	
	function delete( $opportunity_id )
	{
		
		$this->db->delete('calls',array('call_type_id' => $opportunity_id));
		
		$this->db->delete('meetings',array('meeting_type_id' => $opportunity_id));
		
		if( $this->db->delete('opportunities',array('id' => $opportunity_id)) )  // Delete customer
		{  
			return true;
		}
	}
    
    //Get last row
	function get_quotations_last_id()
	{
		$query ="select * from quotations_salesorder order by id DESC limit 1";

	     $res = $this->db->query($query);

	     if($res->num_rows() > 0) {
	            return $res->result("array");
	    }
	    return array();
    }
     
	function convert_to_quotation($opportunity_id)
	{
		 $opportunity_data = $this->opportunities_model->get_opportunities( $opportunity_id );
		 		 
		 $total_fields=$this->opportunities_model->get_quotations_last_id();
    	 $last_id=$total_fields[0]['id'];
    	  
    	 $quotation_no="SO00".($last_id+1);
    	 
    	 $exp_date=date('m/d/Y', strtotime(' + '.config('payment_term1').' days'));
    	 
    	 $quotation_details = array(
	            'quotations_number' => $quotation_no,
	            'customer_id' => $opportunity_data->customer,
	            'qtemplate_id' => '2',            
	            'date' => strtotime(date('m/d/Y h:i')),
	            'exp_date' => strtotime($exp_date),            
	            'payment_term' => config('payment_term1'),
	            'sales_person' => $opportunity_data->salesperson_id,
	            'segment_id' => $opportunity_data->segment_id,	            
	            'status' => 'Draft Quotation',
		        'quot_or_order' => 'q'
	            );
		                              
		  $quotations_res = $this->db->insert('quotations_salesorder',$quotation_details); 
		   
		  return $quotations_res;
	} 


    
    
    
    function ExportCSV()
{
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "opportunity_exp.csv";
        $query = "SELECT * FROM opportunities WHERE 1";
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
}
}



?>