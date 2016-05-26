<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices_payment_log_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
      
	     
	function invoice_payments_log()
	{		
		$this->db->order_by("id", "desc");		
        $this->db->from('invoice_receive_payments');
        
        return $this->db->get()->result();
	} 
	
    
	function delete( $payment_id )
	{
		 
		if( $this->db->delete('invoice_receive_payments',array('id' => $payment_id)) )   
		{  
			return true;
		}
	}
	
	 
}



?>