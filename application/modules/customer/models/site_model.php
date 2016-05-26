<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Site_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }    
    
    function get_settings()
    {
        return $this->db->get_where('settings',array('id' => 1))->row();
    } 
    
    function general_settings()
    {
		$data = array(
        'site_name' => $this->input->post('site_name'),		
        'site_email' => $this->input->post('site_email')        
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	}
	
	 function upload_settings()
    {
		$data = array(
        'allowed_extensions' => $this->input->post('allowed_extensions'),
        'max_upload_files' => $this->input->post('max_upload_files'),
        'max_upload_file_size' => $this->input->post('max_upload_file_size')
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	} 

}



?>