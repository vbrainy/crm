<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Pricelists_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function add_pricelists()
    {
    	  
				$pricelist_details = array(
		            'pricelist_name' => $this->input->post('pricelist_name'),
		            'pricelist_status' => $this->input->post('pricelist_status'),
		            'pricelist_currency' => $this->input->post('pricelist_currency')
		            );
	      
	                                   
	        $pricelist_res = $this->db->insert('pricelists',$pricelist_details);
	        
	       return $pricelist_res;
		 
		  
	}
	
	function update_pricelist()
    {
    	 $pricelist_details = array(
		            'pricelist_name' => $this->input->post('pricelist_name'),
		            'pricelist_status' => $this->input->post('pricelist_status'),
		            'pricelist_currency' => $this->input->post('pricelist_currency')
		            );
		  
	           
		 return $this->db->update('pricelists',$pricelist_details,array('id' => $this->input->post('pricelist_id')));
	}
    
	function pricelists_list()
	{
		$this->db->order_by("id", "desc");		
        $this->db->from('pricelists');
        
         
        return $this->db->get()->result();
	} 
	
    function get_pricelist( $pricelist_id )
	{
		return $this->db->get_where('pricelists',array('id' => $pricelist_id))->row();
	}
	
	function delete( $pricelist_id )
	{
		$this->db->delete('pricelist_version',array('pricelist_id' => $pricelist_id));
		
		if( $this->db->delete('pricelists',array('id' => $pricelist_id)) )  // Delete customer
		{  
			return true;
		}
	}
     
	
	function pricelist_versions($pricelist_id)
	{
		$this->db->where(array('pricelist_id' => $pricelist_id) );
		$this->db->order_by("id", "desc");		
        $this->db->from('pricelist_version');
         
        return $this->db->get()->result();
	}
	
	function delete_versions( $version_id )
	{
		if( $this->db->delete('pricelist_version',array('id' => $version_id)) )  // Delete customer
		{  
			return true;
		}
	}   

}



?>