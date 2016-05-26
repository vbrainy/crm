<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('language');
		$this->lang->load('salesmodule','english'); 
    }

    function exists_email( $email )
    {
		$email_count = $this->db->get_where('users',array('email' => $email))->num_rows();
		return $email_count;
        
    }
	
	function change_profile()
	{
		
		if (empty($_FILES['avatar']['name'])) 
		{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'phone_number' => $this->input->post('phone_number')
					);
				$condition = array('id' => userdata());
					
				return $this->db->update('users',$data,$condition);	
		}
		else
		{
				 
				$user = $this->user_model->user_data( userdata('email') );
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
							'email' => $this->input->post('email'),
							'phone_number' => $this->input->post('phone_number'),
							'user_avatar' => $img_data['file_name']
							);
							
					$condition = array('id' => userdata());
					
					return $this->db->update('users',$data,$condition);
				}	
		}
		 
		
	}

	function create_user()
    {
        $member_details = array(
                                    'first_name' => $this->input->post('first_name'),
                                    'last_name' => $this->input->post('last_name'),
                                    'email' => $this->input->post('email'),
                                    'password' => md5( $this->input->post('pass1') ),
                                    'register_time' => strtotime( date('d F Y g:i a') ),
                                    'ip_address' => $this->input->server('REMOTE_ADDR'), 
                                    'status' => '1'
                                    );
                                    
        return $this->db->insert('users',$member_details);
    }
	
	function update_user()
    {
		if($this->input->post('banned') == 1){ $status = 0; }else{ $status = 1; }
       
       
       
       if (empty($_FILES['user_avatar']['name'])) 
		{
			if($this->input->post('pass1')!="")
			{	
				$member_details = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'password' => md5( $this->input->post('pass1') ),
					'phone_number' => $this->input->post('phone_number'),
					'status' => $status
					);
			}
			else{
				
				$member_details = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'phone_number' => $this->input->post('phone_number'),
					'status' => $status
					);
			} 
					
				return $this->db->update('users',$member_details,array('id' => $this->input->post('user_id')));
		}
		else
		{
        		$config['upload_path'] = './uploads/';
				$config['allowed_types'] = config('allowed_extensions');
				$config['max_size']	= config('max_upload_file_size');
				$config['encrypt_name']	= TRUE;
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('user_avatar'))
				{
					echo $this->upload->display_errors();
				}
				else
				{ 
					 
				
					$img_data  = $this->upload->data();
					
					if($this->input->post('pass1')!="")
					{
						$member_details = array(
								'first_name' => $this->input->post('first_name'),
								'last_name' => $this->input->post('last_name'),
								'email' => $this->input->post('email'),
								'password' => md5( $this->input->post('pass1') ),
								'phone_number' => $this->input->post('phone_number'),
								'user_avatar' => $img_data['file_name'],
								'status' => $status
								);
					}
					else{
						
						$member_details = array(
								'first_name' => $this->input->post('first_name'),
								'last_name' => $this->input->post('last_name'),
								'email' => $this->input->post('email'),
								'phone_number' => $this->input->post('phone_number'),
								'user_avatar' => $img_data['file_name'],
								'status' => $status
								);
					}
							
					 
					
					return $this->db->update('users',$member_details,array('id' => $this->input->post('user_id')));
				}	
		}
    }
    
    function user_data( $username )
    {
        return $this->db->get_where('users',array('email' => $username))->row();
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
		
		$this->db->update('users',array('lostpw' => $lostpw_code),array('email' => $this->input->post('email') ));
		
		return $lostpw_code;
	}
	
	function check_code( $email,$code )
	{
		return $this->db->get_where('users',array('email' => $email,'lostpw' => $code))->num_rows();
	}
	
	function create_new_password( $email )
	{
		$new_password = substr( strtoupper( md5( microtime().'-'.rand(100,10000) ) ),0,6 );
		
		if( $this->db->update('users',array('password' => md5($new_password),'lostpw' => ''),array('email' => $email)) )
		{
			return $new_password;
		}
	}
	
	function check_password()
	{
		return $this->db->get_where('users',array('email' => userdata('email'), 'password' => md5( $this->input->post('currentpass') ) ))->num_rows();
	}
	
	function password_update()
	{
		return $this->db->update('users', array('password' => md5($this->input->post('pass1'))), array('email' => userdata('email')));
	}
	
	function user_list()
	{
		$this->db->order_by("users.id", "desc");
        $this->db->select('users.id, users.first_name,users.last_name, users.email,users.register_time');
        $this->db->from('users');         
        
        return $this->db->get()->result();
	}
	
	function user_type_list()
	{
		return $this->db->get('departments')->result();
	}
	
	function get_user( $user_id )
	{
		return $this->db->get_where('users',array('id' => $user_id))->row();
	}
	
	function check_user_id( $user_id )
    {
        return $this->db->get_where('users',array('id' => $user_id))->num_rows();
    }
	
	function delete( $user_id )
	{
		if( $this->db->delete('users',array('id' => $user_id)) )  // Delete user
		{  
			return true;
		}
	}
     
	
	function get_full_username()
	{
		$user = $this->user_model->user_data( userdata('email') );		
		return $user->first_name;
		
	}

}



?>