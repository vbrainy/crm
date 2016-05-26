<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Settings_model extends CI_Model {

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
    	if (empty($_FILES['site_logo']['name'])) 
		 {	
		 	$data = array(
	        'site_name' => $this->input->post('site_name'),		
	        'site_email' => $this->input->post('site_email')        
	        );
		 }
		 else
		 {
		 	    $config['upload_path'] = './uploads/site';
				$config['allowed_types'] = config('allowed_extensions');
				$config['max_size']	= config('max_upload_file_size');
				$config['encrypt_name']	= TRUE;
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('site_logo'))
				{
					echo $this->upload->display_errors();
				}
				else
				{ 
					 
					$img_data  = $this->upload->data();
					
					$data = array(
					'site_logo' => $img_data['file_name'],
			        'site_name' => $this->input->post('site_name'),		
			        'site_email' => $this->input->post('site_email')        
			        );
				}
		 }
		
        
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
	
	function sales_tax_settings()
    {
		$data = array(         
        'sales_tax' => $this->input->post('sales_tax')        
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	}
	
	function invoice_prefix_settings()
    {
		$data = array(         
        'invoice_prefix' => $this->input->post('invoice_prefix')        
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	}
	
	function payment_term_settings()
    {
		$data = array(         
        'payment_term1' => $this->input->post('payment_term1'),
        'payment_term2' => $this->input->post('payment_term2'),
        'payment_term3' => $this->input->post('payment_term3')        
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	}
	
	 function login_settings()
    {
    	if (!empty($_FILES['login_bg']['name'])) 
		 {	  
		 	    $config['upload_path'] = './uploads/site';
				$config['allowed_types'] = config('allowed_extensions');
				$config['max_size']	= config('max_upload_file_size');
				$config['encrypt_name']	= TRUE;
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('login_bg'))
				{
					echo $this->upload->display_errors();
				}
				else
				{ 
					 
					$img_data  = $this->upload->data();
					
					$data = array(
					'login_bg' => $img_data['file_name'] 
			        );
				}
		 }
		
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	}
	
	function smtp_settings()
    {
    
		$data = array(         
        'smtp_host' => $this->input->post('smtp_host'),
        'smtp_port' => $this->input->post('smtp_port'),
        'smtp_user' => $this->input->post('smtp_user'),
        'smtp_pass' => $this->input->post('smtp_pass')        
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	}
	
	function reminder_settings()
    {
		$data = array(         
        'opportunities_reminder_days' => $this->input->post('opportunities_reminder_days'),
        'contract_renewal_days' => $this->input->post('contract_renewal_days'),
        'invoice_reminder_days' => $this->input->post('invoice_reminder_days')        
        );
        
		$condition = array('id' => 1);
		
		return $this->db->update('settings',$data,$condition);
	}
	
}



?>