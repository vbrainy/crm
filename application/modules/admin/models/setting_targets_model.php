<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_targets_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }    
    
    function get_settings()
    {
        return $this->db->get_where('setting_targets',array('id' => 1))->row();
    } 

    function setting_targets_add(){
    	$data = array(         
    	'last_updated_user_id'=> $this->input->post('last_updated_user_id'),
        'customer_acquisition' => $this->input->post('customer_acquisition'),
        'gsm' => $this->input->post('gsm'),
        'solutions' => $this->input->post('solutions'),
        'devices' => $this->input->post('devices'),
        'services' => $this->input->post('services')                       
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('setting_targets',$data,$condition);
    }
}