<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Customer_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('language');
		$this->lang->load('salesmodule','english'); 
    }

    function exists_email( $email )
    {
		$email_count = $this->db->get_where('customer',array('email' => $email))->num_rows();
		return $email_count;
        
    }
    function create_customers()
    {
        $customer_details = array(
                                    'first_name' => $this->input->post('first_name'),
                                    'last_name' => $this->input->post('last_name'),
                                    'email' => $this->input->post('email'),
                                    'password' => md5( $this->input->post('pass1') ),
                                    'register_time' => strtotime( date('d F Y g:i a') ),
                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
                                    'status' => '1'
                                    );
                                    
        return $this->db->insert('customer',$customer_details);
    }
    
    function user_data( $username )
    {
        return $this->db->get_where('customer',array('email' => $username))->row();
    }
    
    function check_user_detail()
    {
        $username = $this->input->post('email');
        $password = $this->input->post('password');
        
        $userdata = $this->user_data( $username );
        
        if( $userdata->email == $username && $userdata->password == md5($password) && $userdata->status == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function create_lostpw_code()
	{
		$lostpw_code = md5( microtime().'-'.rand(10,10000).'-'.$this->input->post('email') );
		
		$this->db->update('customer',array('lostpw' => $lostpw_code),array('email' => $this->input->post('email') ));
		
		return $lostpw_code;
	}
	
	function check_code( $email,$code )
	{
		return $this->db->get_where('customer',array('email' => $email,'lostpw' => $code))->num_rows();
	}
	
	function create_new_password( $email )
	{
		$new_password = substr( strtoupper( md5( microtime().'-'.rand(100,10000) ) ),0,6 );
		
		if( $this->db->update('customer',array('password' => md5($new_password),'lostpw' => ''),array('email' => $email)) )
		{
			return $new_password;
		}
	}
	
	function check_password()
	{
		return $this->db->get_where('customer',array('email' => userdata_customer('email'), 'password' => md5( $this->input->post('currentpass') ) ))->num_rows();
	}
	
	function get_user( $user_id )
	{
		return $this->db->get_where('customer',array('id' => $user_id))->row();
	}
	
	function check_user_id( $user_id )
    {
        return $this->db->get_where('customer',array('id' => $user_id))->num_rows();
    }
    
    function change_profile()
	{
		
		if (empty($_FILES['avatar']['name'])) 
		{
				$data = array(
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
	                                    'email' => $this->input->post('email')
					);
				$condition = array('id' => userdata_customer());
					
				return $this->db->update('customer',$data,$condition);	
		}
		else
		{
				 
				$user = $this->customer_model->user_data( userdata_customer('email') );
				delete_files(base_url("uploads/" . $user->user_avatar));		
				//echo base_url("uploads/" . $user->user_avatar);
				//exit;
				
				
				
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = config('allowed_extensions');
				$config['max_size']	= config('max_upload_file_size');
				$config['encrypt_name']	= TRUE;
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('avatar'))
				{
					echo $this->upload->display_errors();
				}
				else
				{ 
					 
				
					$img_data  = $this->upload->data();
					
					$data = array(
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
                            'email' => $this->input->post('email'),
							'user_avatar' => $img_data['file_name']
							);
							
					$condition = array('id' => userdata_customer());
					
					return $this->db->update('customer',$data,$condition);
				}	
		}
		 
		
	}
    
	function password_update()
	{
		return $this->db->update('customer', array('password' => md5($this->input->post('pass1'))), array('email' => userdata_customer('email')));
	}
}
 
?>