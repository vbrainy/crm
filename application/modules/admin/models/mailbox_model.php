<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Mailbox_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function send_email()
    {
    	
    	$count_id = count($this->input->post('to_email_id'));
    	 
		for($i=0;$i<$count_id;$i++)
		{ 
    		$email_details = array( 
	            'assign_customer_id' => $this->input->post('assign_customer_id'),
	            'to' => $this->input->post('to_email_id')[$i],
	            'from' => userdata('id'),
	            'subject' => $this->input->post('subject'),
	            'message' => $this->input->post('message'),
	            'date_time' => strtotime( date('d F Y g:i a') ),
	            'ip_address' => $this->input->server('REMOTE_ADDR')
	            );
	                               
	       	 $mail_res= $this->db->insert('emails',$email_details);
	     }
		 return $mail_res;
	}
	 
	 
	function email_list($id,$customer_id)
	{  
		if($customer_id!="")
		{
			$this->db->where(array('to' => $id,'assign_customer_id' => $customer_id) ); 
		}
		else
		{
			$this->db->where(array('to' => $id) ); 
		} 
        $this->db->order_by("id", "desc");		
        $this->db->select('emails.*');
        $this->db->from('emails');
        return $this->db->get()->result();
	} 
	
	function sent_email_list($id,$customer_id)
	{  
        
        if($customer_id!="")
		{
			$this->db->where(array('from' => $id,'assign_customer_id' => $customer_id) ); 
		}
		else
		{
			$this->db->where(array('from' => $id) ); 
		}
        
        $this->db->order_by("id", "desc");		
        $this->db->select('emails.*');
        $this->db->from('emails');
        return $this->db->get()->result();
	} 
	
    function get_call( $call_id )
	{
		return $this->db->get_where('calls',array('id' => $call_id))->row();
	}
	
	function delete( $mail_id )
	{
		if( $this->db->delete('emails',array('id' => $mail_id)) )  // Delete call
		{  
			return true;
		}
	}
     
	 
}
 
?>