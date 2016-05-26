<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

 
class Install extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('file');
		
	
	}
	
	function index()
	{
		
		$this->load->view('install/index');
	}
	
	
	/*****INSTALL THE SCRIPT HERE *****/
	function do_install()
	{
		$db_verify 				=	$this->check_db_connection();
		
		if($db_verify == true)
		{
			 
			// Replace the database settings//////////
			$data = read_file('./application/config/database.php');
			$data = str_replace('db_name', $this->input->post('db_name'), $data);
			$data = str_replace('db_uname', $this->input->post('db_uname'), $data);
			$data = str_replace('db_password', $this->input->post('db_password'), $data);
			$data = str_replace('db_hname', $this->input->post('db_hname'), $data);
			write_file('./application/config/database.php', $data);
			
			// Replace new default routing controller/////
			$data2 = read_file('./application/config/routes.php');
			$data2 = str_replace('install', 'admin', $data2);
			write_file('./application/config/routes.php', $data2);
			
			
			// Run the installer sql schema//////////			
			$this->load->database();
			
			$schema = read_file('./uploads/sales.sql');
			
			$query      = rtrim(trim($schema), "\n;");
			$query_list = explode(";", $query);
			
			foreach ($query_list as $query)
				$this->db->query($query);
			
			// Replace the admin login credentials and site's info///////////
			$this->db->insert('users', array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'register_time' => strtotime( date('d F Y g:i a') ),
                'ip_address' => $this->input->server('REMOTE_ADDR'),				 
                'status' => '1'
			));
			
			// Replace the system name	
			$this->db->where('id', '1');
			$this->db->update('settings', array(
				'site_name' => $this->input->post('system_name'),
				'site_email' => $this->input->post('email')
			));
			 
			  
			// Redirect to login page after completing installation
			redirect(base_url('admin/login'),'refresh');
			
		} else {
			$this->session->set_flashdata('installation_result', 'failed');
			redirect(base_url(), 'refresh');
		}
	}
	
	
	// -------------------------------------------------------------------------------------------------
	
	/* 
	 * Database validation check from user input settings
	 */
	function check_db_connection()
	{
		 
		$link = @mysql_connect($this->input->post('db_hname'), 
									$this->input->post('db_uname'), 
										$this->input->post('db_password'));
	 							
		if (!$link) {
			@mysql_close($link);
			return false;
		}
		
		$db_selected = mysql_select_db($this->input->post('db_name'), $link);
		if (!$db_selected) {
			@mysql_close($link);
			return false;
		}
		
		@mysql_close($link);
		return true;
	}
		

	 
}
