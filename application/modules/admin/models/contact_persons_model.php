<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Contact_persons_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function exists_email( $email )
    {
		$email_count = $this->db->get_where('customer',array('email' => $email))->num_rows();
		return $email_count;
        
    }
    
    function add_contact_persons()
    {
		
		 if (empty($_FILES['customer_avatar']['name'])) 
		 {
		 		
		 		$customer_details = array(
	                                    'first_name' => $this->input->post('first_name'),
	                                    'last_name' => $this->input->post('last_name'),
	                                    'address' => $this->input->post('address'),
	                                    'website' => $this->input->post('website'),
	                                    'job_position' => $this->input->post('job_position'),
	                                    'phone' => $this->input->post('phone'),
	                                    'mobile' => $this->input->post('mobile'),
	                                    'fax' => $this->input->post('fax'),
	                                    'title' => $this->input->post('title'),
	                                    'company' => $this->input->post('company'),
	                                    'segment_id' => $this->input->post('segment_id'),
	                                    'email' => $this->input->post('email'),
	                                   // 'password' => md5( $this->input->post('password') ),
	                                    'register_time' => strtotime( date('d F Y g:i a') ),
	                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
	                                    'status' => '1'
	                                    );
	                                            
		 		
		 }
		 else
		 {
		 	
		 		
		 		$config['upload_path'] = './uploads/customer/';
				$config['allowed_types'] = config('allowed_extensions');
				$config['max_size']	= config('max_upload_file_size');
				$config['encrypt_name']	= TRUE;
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('customer_avatar'))
				{
					
					echo $this->upload->display_errors();
				}
				else
				{
					$img_data  = $this->upload->data();
					
		 			$customer_details = array(
	                                    'first_name' => $this->input->post('first_name'),
	                                    'last_name' => $this->input->post('last_name'),
	                                    'address' => $this->input->post('address'),
	                                    'website' => $this->input->post('website'),
	                                    'job_position' => $this->input->post('job_position'),
	                                    'phone' => $this->input->post('phone'),
	                                    'mobile' => $this->input->post('mobile'),
	                                    'fax' => $this->input->post('fax'),
	                                    'title' => $this->input->post('title'),
	                                    'company' => $this->input->post('company'),
	                                    'segment_id' => $this->input->post('segment_id'),
	                                    'email' => $this->input->post('email'),
	                                   // 'password' => md5( $this->input->post('password') ),
	                                    'customer_avatar' => $img_data['file_name'],
	                                    'register_time' => strtotime( date('d F Y g:i a') ),
	                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
	                                    'status' => '1'
	                                    );
	                   
	       		}
		 }
		 
		 $contact_person_res= $this->db->insert('customer',$customer_details);
		 $contact_person_id = $this->db->insert_id();
		 
		 if($this->input->post('main_contact_person')=='1')
		 { 
			 $company_details = array(
		                         'main_contact_person' => $contact_person_id,
		                          );
		                          	
			 $this->db->update('company',$company_details,array('id' => $this->input->post('company')));
		  }	
		  
		 return $contact_person_res;
	}
	
	function update_contact_person()
    {
		
		 if (empty($_FILES['customer_avatar']['name'])) 
		 {	
		 	 if($this->input->post('email')!="")
			 {			
		 		
		 		$customer_details = array(
	                                    'first_name' => $this->input->post('first_name'),
	                                    'last_name' => $this->input->post('last_name'),
	                                    'address' => $this->input->post('address'),
	                                    'website' => $this->input->post('website'),
	                                    'job_position' => $this->input->post('job_position'),
	                                    'phone' => $this->input->post('phone'),
	                                    'mobile' => $this->input->post('mobile'),
	                                    'fax' => $this->input->post('fax'),
	                                    'title' => $this->input->post('title'),
	                                    'company' => $this->input->post('company'),
	                                    'segment_id' => $this->input->post('segment_id'),
	                                    'email' => $this->input->post('email'),
	                                    //'password' => md5( $this->input->post('password') ),
	                                    'register_time' => strtotime( date('d F Y g:i a') ),
	                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
	                                    'status' => '1'
	                                    );
	          }
	          else
	          {
			  	$customer_details = array(
	                                    'first_name' => $this->input->post('first_name'),
	                                    'last_name' => $this->input->post('last_name'),
	                                    'address' => $this->input->post('address'),
	                                    'website' => $this->input->post('website'),
	                                    'job_position' => $this->input->post('job_position'),
	                                    'phone' => $this->input->post('phone'),
	                                    'mobile' => $this->input->post('mobile'),
	                                    'fax' => $this->input->post('fax'),
	                                    'title' => $this->input->post('title'),
	                                    'company' => $this->input->post('company'),
	                                    'segment_id' => $this->input->post('segment_id'),
	                                    'email' => $this->input->post('email'),
	                                    'register_time' => strtotime( date('d F Y g:i a') ),
	                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
	                                    'status' => '1'
	                                    );
			  }                     
	         
	       // return $this->db->update('customer',$customer_details,array('id' => $this->input->post('customer_id')));
		 		
		 }
		 else
		 {
		 	
		 		
		 		$config['upload_path'] = './uploads/customer/';
				$config['allowed_types'] = config('allowed_extensions');
				$config['max_size']	= config('max_upload_file_size');
				$config['encrypt_name']	= TRUE;
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('customer_avatar'))
				{
					
					echo $this->upload->display_errors();
				}
				else
				{
					$img_data  = $this->upload->data();
					
					if($this->input->post('email')!="")
			 		{	
					
		 						$customer_details = array(
	                                    'first_name' => $this->input->post('first_name'),
	                                    'last_name' => $this->input->post('last_name'),
	                                    'address' => $this->input->post('address'),
	                                    'website' => $this->input->post('website'),
	                                    'job_position' => $this->input->post('job_position'),
	                                    'phone' => $this->input->post('phone'),
	                                    'mobile' => $this->input->post('mobile'),
	                                    'fax' => $this->input->post('fax'),
	                                    'title' => $this->input->post('title'),
	                                    'company' => $this->input->post('company'),
	                                    'segment_id' => $this->input->post('segment_id'),
	                                    'email' => $this->input->post('email'),
	                                    //'password' => md5( $this->input->post('password') ),
	                                    'customer_avatar' => $img_data['file_name'],
	                                    'register_time' => strtotime( date('d F Y g:i a') ),
	                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
	                                    'status' => '1'
	                                    );
	               }
	               else
	               {
				   				$customer_details = array(
	                                    'first_name' => $this->input->post('first_name'),
	                                    'last_name' => $this->input->post('last_name'),
	                                    'address' => $this->input->post('address'),
	                                    'website' => $this->input->post('website'),
	                                    'job_position' => $this->input->post('job_position'),
	                                    'phone' => $this->input->post('phone'),
	                                    'mobile' => $this->input->post('mobile'),
	                                    'fax' => $this->input->post('fax'),
	                                    'title' => $this->input->post('title'),
	                                    'company' => $this->input->post('company'),
	                                    'segment_id' => $this->input->post('segment_id'),
	                                    'email' => $this->input->post('email'),
	                                    'customer_avatar' => $img_data['file_name'],
	                                    'register_time' => strtotime( date('d F Y g:i a') ),
	                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
	                                    'status' => '1'
	                                    );
				   }	                                    
	       			
	       		}
		 }
		 
		 //Update main contact
		 if($this->input->post('main_contact_person')=='1')
		  { 
			$company_details = array(
		                         'main_contact_person' => $this->input->post('customer_id'),
		                          );
		                          	
			 $this->db->update('company',$company_details,array('id' => $this->input->post('company'))); 
		  }
		   
		  
		   return $this->db->update('customer',$customer_details,array('id' => $this->input->post('customer_id')));
	}
    
	
	function total_customers() 
    {
        $this->db->order_by("id", "desc");
        $this->db->from('customer');       
        	
		return count($this->db->get()->result());	
	}
	function contact_persons_list()
	{
		$this->db->order_by("id", "desc");		
        $this->db->from('customer');
         
        return $this->db->get()->result();
	}
	
    function get_contact_persons( $customer_id )
	{
		return $this->db->get_where('customer',array('id' => $customer_id))->row();
	}
	
	function delete( $contact_person_id )
	{
		if( $this->db->delete('customer',array('id' => $contact_person_id)) )  // Delete contact person
		{  
			return true;
		}
	}
     
	
	 

}



?>