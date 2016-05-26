<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
       
	function invoices_list($customer_id)
	{
		$this->db->where('customer_id',$customer_id);
		$this->db->order_by("id", "desc");		
        $this->db->from('invoices');
        
        return $this->db->get()->result();
	} 
	
    function get_invoice( $invoice_id,$customer_id )
	{
		return $this->db->get_where('invoices',array('id' => $invoice_id,'customer_id' => $customer_id))->row();
	}
	
	function get_invoice_by_number( $invoice_number )
	{
		return $this->db->get_where('invoices',array('invoice_number' => $invoice_number))->row();
	}
	   
	
	function get_quotation( $order_id )
	{
		return $this->db->get_where('quotations_salesorder',array('id' => $order_id))->row();
	}
	 
	function invoice_products($invoice_id)
	{		    
		$this->db->where(array('invoice_id' => $invoice_id) );
		$this->db->order_by("id", "desc");		
        $this->db->from('invoices_products');
         
        return $this->db->get()->result();
	}
	 
	 
	function invoice_excel_list()
	{
		$this->db->select('invoice_number,invoice_date,due_date,payment_term,status,unpaid_amount'); 	
		$this->db->order_by("id", "desc");		
        $this->db->from('invoices');
        
        return $this->db->get()->result();
	} 
	
	function open_invoices_total_collection($customer_id)
	{

	    $this->db->select_sum('unpaid_amount');
	    $this->db->from('invoices');
	    $this->db->where(array('status'=> 'Open Invoice','customer_id' => $customer_id));
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
	    $this->db->where(array('status'=> 'Overdue Invoice','customer_id' => $customer_id));
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
	    $this->db->where(array('status'=> 'Paid Invoice','customer_id' => $customer_id));
	    $query = $this->db->get();
	    $total_sold = $query->row()->grand_total;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	}
	function invoices_total_collection()
	{

	    $this->db->select_sum('unpaid_amount');
	    $this->db->from('invoices');
	    //$this->db->where('status', 'Paid Invoice');
	    $query = $this->db->get();
	    $total_sold = $query->row()->unpaid_amount;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	} 
}



?>