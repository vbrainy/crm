<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Contracts_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
     
	 
	function contracts_list($customer_id)
	{
		$this->db->where(array('company_id' => $customer_id) ); 
        $this->db->order_by("id", "desc");		
        $this->db->select('contracts.*');
        $this->db->from('contracts');
        return $this->db->get()->result();
	} 
	
    
	 
}
 
?>