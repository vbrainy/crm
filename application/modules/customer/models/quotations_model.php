<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Quotations_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
	function quotations_list($customer_id)
	{
		$this->db->where(array('quot_or_order' => 'q','customer_id' => $customer_id) );
		$this->db->order_by("id", "desc");		
        $this->db->from('quotations_salesorder');
        
        return $this->db->get()->result();
	} 
	
    function get_quotation($quotation_id,$customer_id)
	{
		return $this->db->get_where('quotations_salesorder',array('id' => $quotation_id,'customer_id' => $customer_id,'quot_or_order' => 'q'))->row();
	}
	  
	function quot_order_products($qo_id)
	{		    
		$this->db->where(array('quotation_order_id' => $qo_id) );
		$this->db->order_by("id", "desc");		
        $this->db->from('quotations_salesorder_products');
         
        return $this->db->get()->result();
	}
	 
	 
}



?>