<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Staff_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function exists_email( $email )
    {
		$email_count = $this->db->get_where('users',array('email' => $email))->num_rows();
		return $email_count;
        
    }
	
	function staff_list()
	{
		$this->db->order_by("users.id", "desc");
		//$this->db->where('users.id !=',1); 
        $this->db->select('users.id, users.first_name,users.last_name, users.email,users.register_time');
        $this->db->from('users');
        
        
        return $this->db->get()->result();
	}
	
	function get_user( $staff_id )
	{
		return $this->db->get_where('users',array('id' => $staff_id))->row();
	}
	
	function add_staff()
	{
		 if (empty($_FILES['user_avatar']['name'])) 
		 {	
			$staff_details = array(
	                                    'first_name' => $this->input->post('first_name'),
	                                    'last_name' => $this->input->post('last_name'),
	                                    'email' => $this->input->post('email'),
	                                    'password' => md5( $this->input->post('pass1') ),
	                                    'register_time' => strtotime( date('d F Y g:i a') ),
	                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
	                                    'account_role_id' => $this->input->post('account_role_id'),

 'roles' => $this->input->post('roles'),
 'customer' => $this->input->post('customer'),
 'gsm' => $this->input->post('gsm'),
 'solutions' => $this->input->post('solutions'),
 'devices' => $this->input->post('devices'),
 'job_title' => $this->input->post('job_title'),
 'segment_id' => $this->input->post('segment_id'),
 'region_id' => $this->input->post('region_id'),
 'supervisor_id' => $this->input->post('supervisor_id'),
	                                    'status' => '1'
	                                    );
	                                    
	         
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
					
					$staff_details = array(
	                                    'first_name' => $this->input->post('first_name'),
	                                    'last_name' => $this->input->post('last_name'),
	                                    'email' => $this->input->post('email'),
	                                    'password' => md5( $this->input->post('pass1') ),
	                                    'user_avatar' => $img_data['file_name'],
	                                    'register_time' => strtotime( date('d F Y g:i a') ),
	                                    'ip_address' => $this->input->server('REMOTE_ADDR'),
	                                    'account_role_id' => $this->input->post('account_role_id'),


 'roles' => $this->input->post('roles'),
 'customer' => $this->input->post('customer'),
 'gsm' => $this->input->post('gsm'),
 'solutions' => $this->input->post('solutions'),
 'devices' => $this->input->post('devices'),
  'job_title' => $this->input->post('job_title'),
 'segment_id' => $this->input->post('segment_id'),
 'region_id' => $this->input->post('region_id'),
 'supervisor_id' => $this->input->post('supervisor_id'),
	                                    'status' => '1'
	                                    );
	                                    
	       		   
					
				}
			
		}
		//print_r($_POST);exit;
		$user_res = $this->db->insert('users',$staff_details);
		
		$user_id = $this->db->insert_id();
		
		$permission_details = array(
				'staff_id' => $user_id,
				'sales_team_read' => $this->input->post('sales_team_read'),
				'sales_team_write' => $this->input->post('sales_team_write'),
				'sales_team_delete' => $this->input->post('sales_team_delete'),
				'region_read' => $this->input->post('sales_team_read'),
				'region_write' => $this->input->post('sales_team_write'),
				'region_delete' => $this->input->post('sales_team_delete'),
				'lead_read' => $this->input->post('lead_read'),
				'lead_write' => $this->input->post('lead_write'),
				'lead_delete' => $this->input->post('lead_delete'),
				'opportunities_read' => $this->input->post('opportunities_read'),
				'opportunities_write' => $this->input->post('opportunities_write'),
				'opportunities_delete' => $this->input->post('opportunities_delete'),
				'logged_calls_read' => $this->input->post('logged_calls_read'),
				'logged_calls_write' => $this->input->post('logged_calls_write'),
				'logged_calls_delete' => $this->input->post('logged_calls_delete'),
				'meetings_read' => $this->input->post('meetings_read'),
				'meetings_write' => $this->input->post('meetings_write'),
				'meetings_delete' => $this->input->post('meetings_delete'),
				'products_read' => $this->input->post('products_read'),
				'products_write' => $this->input->post('products_write'),
				'products_delete' => $this->input->post('products_delete'), 
				'quotations_read' => $this->input->post('quotations_read'),
				'quotations_write' => $this->input->post('quotations_write'),
				'quotations_delete' => $this->input->post('quotations_delete'),
				'sales_orders_read' => $this->input->post('sales_orders_read'),
				'sales_orders_write' => $this->input->post('sales_orders_write'),
				'sales_orders_delete' => $this->input->post('sales_orders_delete'),
				'invoices_read' => $this->input->post('invoices_read'),
				'invoices_write' => $this->input->post('invoices_write'),
				'invoices_delete' => $this->input->post('invoices_delete'),
				'pricelists_read' => $this->input->post('pricelists_read'),
				'pricelists_write' => $this->input->post('pricelists_write'),
				'pricelists_delete' => $this->input->post('pricelists_delete'),
				'contracts_read' => $this->input->post('contracts_read'),
				'contracts_write' => $this->input->post('contracts_write'),
				'contracts_delete' => $this->input->post('contracts_delete'),
				'staff_read' => $this->input->post('staff_read'),
				'staff_write' => $this->input->post('staff_write'),
				'staff_delete' => $this->input->post('staff_delete'),
				'admin_read' => $this->input->post('admin_read'),
				'admin_write' => $this->input->post('admin_write'),
				'admin_delete' => $this->input->post('admin_delete'),
				'customers_read' => $this->input->post('customers_read'),
				'customers_write' => $this->input->post('customers_write'),
				'customers_delete' => $this->input->post('customers_delete'),
				'statistics'=> $this->input->post('statistics')
						
								);	
		//print_r($permission_details);exit;
		$add_permission = $this->db->insert('account_permission',$permission_details);
		return  $user_res;
		
	}
	
	function update_staff()
    {
		
		$permission_details = array(
				'sales_team_read' => $this->input->post('sales_team_read'),
				'sales_team_write' => $this->input->post('sales_team_write'),
				'sales_team_delete' => $this->input->post('sales_team_delete'),
				'region_read' => $this->input->post('sales_team_read'),
				'region_write' => $this->input->post('sales_team_write'),
				'region_delete' => $this->input->post('sales_team_delete'),
				'lead_read' => $this->input->post('lead_read'),
				'lead_write' => $this->input->post('lead_write'),
				'lead_delete' => $this->input->post('lead_delete'),
				'opportunities_read' => $this->input->post('opportunities_read'),
				'opportunities_write' => $this->input->post('opportunities_write'),
				'opportunities_delete' => $this->input->post('opportunities_delete'),
				'logged_calls_read' => $this->input->post('logged_calls_read'),
				'logged_calls_write' => $this->input->post('logged_calls_write'),
				'logged_calls_delete' => $this->input->post('logged_calls_delete'),
				'meetings_read' => $this->input->post('meetings_read'),
				'meetings_write' => $this->input->post('meetings_write'),
				'meetings_delete' => $this->input->post('meetings_delete'), 
				'products_read' => $this->input->post('products_read'),
				'products_write' => $this->input->post('products_write'),
				'products_delete' => $this->input->post('products_delete'),
				'quotations_read' => $this->input->post('quotations_read'),
				'quotations_write' => $this->input->post('quotations_write'),
				'quotations_delete' => $this->input->post('quotations_delete'),						'sales_orders_read' => $this->input->post('sales_orders_read'),
				'sales_orders_write' => $this->input->post('sales_orders_write'),
				'sales_orders_delete' => $this->input->post('sales_orders_delete'),
				'invoices_read' => $this->input->post('invoices_read'),
				'invoices_write' => $this->input->post('invoices_write'),
				'invoices_delete' => $this->input->post('invoices_delete'),
				'pricelists_read' => $this->input->post('pricelists_read'),
				'pricelists_write' => $this->input->post('pricelists_write'),
				'pricelists_delete' => $this->input->post('pricelists_delete'),
				'contracts_read' => $this->input->post('contracts_read'),
				'contracts_write' => $this->input->post('contracts_write'),
				'contracts_delete' => $this->input->post('contracts_delete'),
				'staff_read' => $this->input->post('staff_read'),
				'staff_write' => $this->input->post('staff_write'),
				'staff_delete' => $this->input->post('staff_delete'),
				'statistics'=> $this->input->post('statistics'),
				'admin_read' => $this->input->post('admin_read'),
				'admin_write' => $this->input->post('admin_write'),
				'admin_delete' => $this->input->post('admin_delete'),
				'customers_read' => $this->input->post('customers_read'),
				'customers_write' => $this->input->post('customers_write'),
				'customers_delete' => $this->input->post('customers_delete')
									
									);	
	
		$update_permission = $this->db->update('account_permission',$permission_details,array('staff_id' => $this->input->post('user_id')));
	
	
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
					'account_role_id' => $this->input->post('account_role_id'),

 'roles' => $this->input->post('roles'),
 'customer' => $this->input->post('customer'),
 'gsm' => $this->input->post('gsm'),
 'solutions' => $this->input->post('solutions'),
 'devices' => $this->input->post('devices'),
					'status' => $status
					);	
			}	
			else{
				
				$member_details = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),					
					'phone_number' => $this->input->post('phone_number'),
					'account_role_id' => $this->input->post('account_role_id'),

 'roles' => $this->input->post('roles'),
 'customer' => $this->input->post('customer'),
 'gsm' => $this->input->post('gsm'),
 'solutions' => $this->input->post('solutions'),
 'devices' => $this->input->post('devices'),
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
								'account_role_id' => $this->input->post('account_role_id'),
								'user_avatar' => $img_data['file_name'],


 'roles' => $this->input->post('roles'),
 'customer' => $this->input->post('customer'),
 'gsm' => $this->input->post('gsm'),
 'solutions' => $this->input->post('solutions'),
 'devices' => $this->input->post('devices'),
								'status' => $status
								);
					}
					else
					{
							$member_details = array(
								'first_name' => $this->input->post('first_name'),
								'last_name' => $this->input->post('last_name'),
								'email' => $this->input->post('email'),							
								'phone_number' => $this->input->post('phone_number'),
								'account_role_id' => $this->input->post('account_role_id'),
								'user_avatar' => $img_data['file_name'],

 'roles' => $this->input->post('roles'),
 'customer' => $this->input->post('customer'),
 'gsm' => $this->input->post('gsm'),
 'solutions' => $this->input->post('solutions'),
 'devices' => $this->input->post('devices'),
								'status' => $status
								);	
					}
					 
					
					return $this->db->update('users',$member_details,array('id' => $this->input->post('user_id')));
				}	
		}
    }
    
    function delete( $staff_id )
	{
		if( $this->db->delete('users',array('id' => $staff_id ,'users.id !=' => '1')) )  // Delete user
		{  
			return true;
		}
	}
	
	function get_user_fullname( $staff_id )
	{
		
		$this->db->where('id', $staff_id);
		//here we select every clolumn of the table
		$q = $this->db->get('users');
		$data = $q->result_array();

		 
		return $data[0]['first_name'].' '.$data[0]['last_name'];
	}
	
	function get_staff_user_image( $staff_id )
	{
		
		$this->db->where('id', $staff_id);
		//here we select every clolumn of the table
		$q = $this->db->get('users');
		$data = $q->result_array();

		return $data[0]['user_avatar'];
	}
     
}



?>