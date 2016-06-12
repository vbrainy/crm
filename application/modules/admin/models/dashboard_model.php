<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Dashboard_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }   
     
    function total_segments() 
    {
        $this->db->order_by("id", "desc");
        $this->db->from('segments');       
        	
		return count($this->db->get()->result());	
	}
	
	
	function total_leads() 
    {	
    	if(userdata('id')!='1')
		{
			$this->db->where('salesperson_id', userdata('id'));
		}
		
        $this->db->order_by("id", "desc");
        $this->db->from('leads');       
        	
		return count($this->db->get()->result());	
	}
	function total_opportunities() 
    {
    	if(userdata('id')!='1')
		{
			$this->db->where('salesperson_id', userdata('id'));
		}
		
        $this->db->order_by("id", "desc");
        $this->db->from('opportunities');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_products() 
    {
        $this->db->order_by("id", "desc");
        $this->db->from('products');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_quotations() 
    {
    	if(userdata('id')!='1')
		{
			$this->db->where('sales_person', userdata('id'));
		}
		
        $this->db->where("quot_or_order", "q");
        $this->db->order_by("id", "desc");
        $this->db->from('quotations_salesorder');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_salesorders() 
    {
    	if(userdata('id')!='1')
		{
			$this->db->where('sales_person', userdata('id'));
		}
		
        $this->db->where("quot_or_order", "o");
        $this->db->order_by("id", "desc");
        $this->db->from('quotations_salesorder');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_calls() 
    {   
    	if(userdata('id')!='1')
		{
			$this->db->where('resp_staff_id', userdata('id'));
		}
		      
        $this->db->order_by("id", "desc");
        $this->db->from('calls');       
        	
		return count($this->db->get()->result());	
	}
	
    function total_customers() 
    {
        $this->db->order_by("id", "desc");
        $this->db->from('company');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_meetings() 
    {
    	if(userdata('id')!='1')
		{
			$this->db->where('responsible', userdata('id'));
		}
		
        $this->db->order_by("id", "desc");
        $this->db->from('meetings');       
        	
		return count($this->db->get()->result());	
	}
    
	function total_email() 
    {
    	$this->db->where('to', userdata('id'));
		 
        $this->db->order_by("id", "desc");
        $this->db->from('emails');       
        	
		return count($this->db->get()->result());	
	}
	function total_contracts() 
    {
    	if(userdata('id')!='1')
		{
			$this->db->where('resp_staff_id', userdata('id'));
		}
		
        $this->db->order_by("id", "desc");
        $this->db->from('contracts');       
        	
		return count($this->db->get()->result());	
	}
	
	function total_opp_won_by_product($product, $productName)	
	{
		$query = "";
		$query = "SELECT customer, gsm, solutions, devices, services FROM users WHERE id=". userdata('id');
		$result = $this->db->query($query);
		$userdata = $result->row_array();
		$query = "";
		$query = "SELECT count(opportunities.id) as num_rows FROM (`opportunities`) JOIN `products` ON `products`.`id` = `opportunities`.`product_id` and `products`.`id` = $product WHERE `stages` = 'Won' AND `salesperson_id` =".userdata('id');
		$result = $this->db->query($query);
		$num_rows = $result->row()->num_rows;
		$per = 0;
		if($num_rows > 0)
		{
			$per = (int) ($num_rows * 100) / $userdata[$productName];
		}
		//echo (int) ($numOfOpp * $userdata[$product]) / 100 . '%';exit;
		return $per .'%';
	}

	//GET TOTAL NUMBER OF OPP WON BY USER
	function total_opp_won()
	{
		$query = "SELECT count(opportunities.id) as num_rows FROM (`opportunities`) WHERE `stages` = 'Won' AND `salesperson_id` =".userdata('id');
		$result = $this->db->query($query);
		return $result->row()->num_rows;
	}


}

?>