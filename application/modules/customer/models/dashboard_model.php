<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);


class Dashboard_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_company( $customer_id )
	{
		return $this->db->get_where('company',array('id' => $customer_id))->row();
	}
     
	function total_salesorders($customer_id) 
    {
        
        $this->db->where(array('quot_or_order' => 'o','customer_id' => $customer_id) );
        $this->db->order_by("id", "desc");
        $this->db->from('quotations_salesorder');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_quotations($customer_id)     {
         
        $this->db->where(array('quot_or_order' => 'q','customer_id' => $customer_id) );
        $this->db->order_by("id", "desc");
        $this->db->from('quotations_salesorder');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_calls($customer_id)     {
         
        $this->db->where(array('company_id' => $customer_id));
        $this->db->order_by("id", "desc");
        $this->db->from('calls');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_invoices($customer_id)     {
         
        $this->db->where(array('customer_id' => $customer_id));
        $this->db->order_by("id", "desc");
        $this->db->from('invoices');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_meetings($customer_id)  
	{
         
        $this->db->order_by("id", "desc");
        $this->db->from('meetings');       
        
        $meetings_res=$this->db->get()->result();	
		$total=0;
		
		foreach( $meetings_res as $meetings)
		{   
			$b=explode(',',$meetings->attendees);
			if(in_array($customer_id,$b))
			{
				$total++;
			} 
		} 
		return $total;	
	} 
	
	function total_contracts($customer_id)     {
         
        $this->db->where(array('company_id' => $customer_id));
        $this->db->order_by("id", "desc");
        $this->db->from('contracts');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_sales_collection($customer_id)
	{

	    $this->db->select_sum('grand_total');
	    $this->db->from('invoices');
	    $this->db->where(array('customer_id'=> $customer_id));
	    $query = $this->db->get();
	    $total_sold = $query->row()->grand_total;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	}
	
	function open_invoices_total_collection($customer_id)
	{

	    $this->db->select_sum('unpaid_amount');
	    $this->db->from('invoices');
	    $this->db->where(array('status'=> 'Open Invoice','customer_id'=> $customer_id));
	    $query = $this->db->get();
	    $total_sold = $query->row()->unpaid_amount;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	}
	function overdue_invoices_total_collection($customer_id)
	{

	    $this->db->select_sum('unpaid_amount');
	    $this->db->from('invoices'); 
	    $this->db->where(array('status'=> 'Overdue Invoice','customer_id'=> $customer_id));
	    $query = $this->db->get();
	    $total_sold = $query->row()->unpaid_amount;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	}
	
	function paid_invoices_total_collection($customer_id)
	{

	    $this->db->select_sum('grand_total');
	    $this->db->from('invoices');
	    $this->db->where(array('status'=> 'Paid Invoice','customer_id'=> $customer_id));
	    $query = $this->db->get();
	    $total_sold = $query->row()->grand_total;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	}
	
	function quotations_total_collection($customer_id)
	{

	    $this->db->select_sum('grand_total');
	    $this->db->from('quotations_salesorder');
	    $this->db->where(array('quot_or_order'=> 'q','customer_id'=> $customer_id));
	    $query = $this->db->get();
	    $total_sold = $query->row()->grand_total;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	}
	
}



?>