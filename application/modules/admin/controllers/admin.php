<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller {

    function Admin() 
    {
         parent::__construct();
		 $this->load->database();
		 
         $this->load->model("user_model");
          
         $this->load->library('form_validation');
         
         /*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         
    } 
	function index()
	{
		redirect(base_url('admin/login'),'refresh');
	}
    /*
     * Displays form for new member
     */
    function create()
    {
	if( is_login() == 1 ){ redirect(base_url('admin/dashboard'),'refresh'); }
       
       
        $this->load->view('user/create_user');
        
    }
    /*
     * Makes controls for new member.
     */
    function create_process()
    {
        
        if( $this->form_validation->run('create_user') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        elseif( $this->user_model->exists_email( $this->input->post('email') ) > 0)
        {
            echo '<div class="alert error">'.$this->lang->line('already_account').'</div>';
        }
        else
        {
            
            if( $this->user_model->create_user())            {
               
                echo '<div class="alert error">' .$this->lang->line('register_succes_msg1'). '</div>';
            }
            else
            {
                 echo '<div class="alert error">' .$this->lang->line('technical_problem'). '</div>';
            }
        }
    }

    function register_succes()
    {
        $userdata = $this->user_model->user_data( $this->session->userdata('username') );
        $data['name'] = $userdata->name;
        
        $this->load->view('header');
        $this->load->view('user/register_succes',$data);
        $this->load->view('footer');
    }

	function lostpw_succes()    {
    	
        $this->load->view('user/lostpw_succes');
       
    }
    /*
     * Displays the login form
     */
    function login()
    {
		if( is_login() == 1 ){ redirect(base_url('admin/dashboard'),'refresh'); }
        
        $this->load->view('user/login_user');
        
    }

    function login_process()
    {
    	    	
        if( $this->form_validation->run('login_user') == FALSE )
        {
        	 
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
             
        }
        elseif( $this->user_model->exists_email( $this->input->post('email') ) == 0 )
        {
            echo '<div class="alert error">'.$this->lang->line('you_must_create_account').'</div>';
        }
        elseif( $this->user_model->check_user_detail() == FALSE )
        {
            echo '<div class="alert error">'.$this->lang->line('invalid_email_or_pass').'</div>';
        }
        else
        {
            $userdata = $this->user_model->user_data( $this->input->post('email') );
            
            $session_data = array(
                                      "username"   => $userdata->email,
                                      "userhash"   => md5( $userdata->password.$this->config->item('password_hash')  ) 
                                      );
                                      
            $this->session->set_userdata($session_data);
            
            echo '<script>location.href="'.base_url('admin/dashboard').'";</script>';
        }
    }
    /*
     * Logout function
     */
    function logout()
    {
        
        $session_items = array(
							'username' => '',
							'userhash'     => '',
                            //'user_type'     => '',
							'logged_in'=> FALSE
							
							);
		
		$this->session->unset_userdata($session_items);
		
		$this->output->nocache();
		
		redirect(base_url()."admin/login","refresh");
    }
	/*
     * Displays the Password reset form
     */
	function lostpassword()
	{
		if( is_login() == 1 ){ redirect(base_url('admin/dashboard'),'refresh'); }
		
		$this->load->view('header');
		$this->load->view('user/lostpassword');
		$this->load->view('footer');
	}
	/*
     * Sends request for password reset
     */
	function lostpassword_process()
	{
		 
		$this->form_validation->set_rules('email', 'Email', 'required');
			
		if( $this->form_validation->run('lostpassword') == FALSE )
		{
			echo '<div class="alert error">'.validation_errors().'</div>';
		}
		elseif( $this->user_model->exists_email( $this->input->post('email') ) == 0 )
		{
			echo '<div class="alert error">'.$this->lang->line('you_must_create_account').'</div>';
		}
		else
		{
			
			$lostpw_code = $this->user_model->create_lostpw_code();
			
			$subject = 'Reset password request';
            $message = 'Hello, <br> To reset your password please follow the link below: <br> <a href="'.base_url('admin/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('admin/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
            	
			send_notice($this->input->post('email'),$subject,$message);
			  
			echo '<script>location.href="'.base_url('admin/lostpw_succes').'";</script>';
		}
	}
	/*
     * Checks the reset password code
     */
	function check_code( $email, $code )
	{
		$status = $this->user_model->check_code( $email,$code );
		
		if( $status == 0 )
		{
			$this->session->set_flashdata('message','<div class="alert error">'.$this->lang->line('invalid_reset_code').'</div>');
			redirect(base_url('admin/login'),'refresh');
		}
		else
		{
			$new_password = $this->user_model->create_new_password( $email );
			
			$subject = 'New Password';
            $message = 'Hello, <br><br> New password is <b>'.$new_password.'</b>. Please <a href="'.base_url('admin/login').'">click here</a> for login';
            	
			send_notice($email,$subject,$message);
			
			$this->session->set_flashdata('message','<div class="alert ok">'.$this->lang->line('new_pass_sent').'</div>');
			redirect(base_url('admin/login'),'refresh');
		}
	}
	/*
     * Displays the settings
     */

    
    function account_settings()
	{
		check_login();
		
		
			$data['user'] = $this->user_model->user_data( userdata('email') );
			
			$this->load->view('header');
			$this->load->view('user/user_settings',$data);
			$this->load->view('footer');
		
	}

	function change_password()
	{
		check_login();
		
		if( $this->form_validation->run('change_password') == FALSE )
		{
			echo '<div class="alert error"><ul>'.validation_errors('<li>','</li>').'</ul></div>';
		}
		elseif( $this->user_model->check_password() == 0 )
		{
			echo '<div class="alert error">'.$this->lang->line('invalid_pass').'</div>';
		}
		else
		{
			if( $this->user_model->password_update() )
			{
				
					$session_data = array(
										  "username"   => userdata('email'),
										  "userhash"   => md5( userdata('password').$this->config->item('password_hash')  )
										  );
										  
					$this->session->set_userdata($session_data);
					echo '<div class="alert ok">'.$this->lang->line('update_succesful').'</div>';
			}
			else
			{
					echo '<div class="alert error">'.$this->lang->line('technical_problem').'</div>';
			}
		}
		
		
	}
	
	function change_profile()
	{
		check_login();
		
		 
		
		if( $this->form_validation->run('change_profile') == FALSE )
		{
			echo '<div class="alert error"><ul>'.validation_errors('<li>','</li>').'</ul></div>';
		}
		else
		{
			$session_data = array(
								 "username"   => $this->input->post('email'),
								 "userhash"   => md5( userdata('password').$this->config->item('password_hash')  ),
								// "user_type" => userdata('user_type')
								 );
										  
			if( $this->user_model->change_profile() )
			{
				$this->session->set_userdata($session_data);
				echo '<div class="alert ok">'.$this->lang->line('update_succesful').'</div>';
			}
			else
			{
				echo '<div class="alert error">'.$this->lang->line('technical_problem').'</div>';
			}
		}
		
		
	}
    
	function user_list()
	{
		check_login();  
		
		$data['users'] = $this->user_model->user_list();
		
		$this->load->view('header');
		$this->load->view('user/user_list',$data);
		$this->load->view('footer');
	}
	/*
     * Displays member update form
     */
	function update( $user_id )
	{
		check_login();   
		
		$data['user'] = $this->user_model->get_user( $user_id );		
		
		$this->load->view('header');
		$this->load->view('user/update_user',$data);
		$this->load->view('footer');
	}
	/*
     * update processing
     */
	function update_process()
	{
		check_login();   
		
		if( $this->form_validation->run('update_user') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        else
        {
            
            if( $this->user_model->update_user() )
            {
                echo '<div class="alert ok">'.$this->lang->line('update_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
	}
	/*
     * private function - Checks user ID
     * @param  a user id integer
     * @return bool
     */
	function _check_user_id($user_id)
	{
		if( $this->user_model->check_user_id( $user_id ) == 0 )
		{
			$this->form_validation->set_message('_check_user_id', 'The user id hidden field is invalid.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/*
     * deletes user
     * @param  a user id integer
     * @return string for ajax
     */
	function delete( $user_id )
	{
		check_login();   
		
		if( $this->_check_user_id($user_id) )
		{
			if( $this->user_model->delete($user_id) )
			{
				echo 'deleted';
			}
		}
	}    
    
}
