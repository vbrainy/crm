<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Calendar_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function pricelist_version_list()
	{
		$date = strtotime(date('Y-m-d'));
		
		$this->db->where(array('end_date >' => $date) );  
		$this->db->order_by("id", "desc");		
        $this->db->from('pricelist_version');
         
        return $this->db->get()->result();
	} 
    
    function quotations_list()
	{
		$date = strtotime(date('Y-m-d'));
		
		$id=userdata('id');
		if($id!='1')
		{
			$this->db->where('sales_person', $id);
		}
		
		$this->db->where(array('quot_or_order' => 'q','exp_date >' => $date) );  
		$this->db->order_by("id", "desc");		
        $this->db->from('quotations_salesorder');
        
        return $this->db->get()->result();
	} 
    
	function upcoming_meetings_list()
	{
		$id=userdata('id');
		if($id!='1')
		{
			$this->db->where('responsible',$id);
		}
		
		$date = strtotime(date('Y-m-d'));
		
		$this->db->where(array('starting_date >' => $date));  
		$this->db->order_by("id", "desc");		
        $this->db->from('meetings');
         
        return $this->db->get()->result();
	}
	
	function overdue_invoices_list()
	{
		$date = strtotime(date('Y-m-d'));
		
		$id=userdata('id');
		if($id!='1')
		{
			$this->db->where('salesperson_id',$id);
		}
					
		$this->db->where(array('due_date >' => $date));
		$this->db->order_by("id", "desc");		
        $this->db->from('invoices');
        
        return $this->db->get()->result();
	}
	
	function contracts_list()
	{
		$id=userdata('id');
		if($id!='1')
		{
			$this->db->where('resp_staff_id',$id);
		}
		
		$date = strtotime(date('Y-m-d'));
					
		$this->db->where(array('end_date >' => $date));
		$this->db->order_by("id", "desc");		
        $this->db->from('contracts');
        
        return $this->db->get()->result();
	}
	
	function opportunities_nexaction_list()
	{
		$date = date('Y-m-d');
		
		$id=userdata('id');
		if($id!='1')
		{
			$this->db->where('salesperson_id',$id);
		}
					
		$this->db->where(array('next_action >' => $date));	
		$this->db->order_by("id", "desc");		
        $this->db->from('opportunities');
         
        return $this->db->get()->result();
	}
	
	function delete( $id )
	{
		if( $this->db->delete('category',array('id' => $category_id)) )  // Delete customer
		{  
			return true;
		}
	}
     
	  

}



?>