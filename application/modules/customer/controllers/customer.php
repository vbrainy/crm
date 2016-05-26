<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {

    function Customer() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("customer_model"); 
         $this->load->library('form_validation');
    }
     
	function index()
	{ 
				redirect(base_url('customer/login'),'refresh');
			 
	}
	 /*
     * Displays form for new member
     */
    function create()
    {
	if( is_login_customer() == 1 ){ redirect(base_url('customer/dashboard'),'refresh'); }
       
       
        $this->load->view('user/create_customers');
        
    }
    /*
     * Makes controls for new member.
     */
    function create_process()
    {
        
        if( $this->form_validation->run('create_customers') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        elseif( $this->customer_model->exists_email( $this->input->post('email') ) > 0)
        {
            echo '<div class="alert error">'.$this->lang->line('already_account').'</div>';
        }
        else
        {
            
            if( $this->customer_model->create_customers())            {
               
                echo '<div class="alert error">' .$this->lang->line('register_succes_msg1'). '</div>';
            }
            else
            {
                 echo '<div class="alert error">' .$this->lang->line('technical_problem'). '</div>';
            }
        }
    }
	
	/*
     * Displays the login form
     */
    function login()
    {
		if( is_login_customer() == 1 ){ redirect(base_url('customer/dashboard'),'refresh'); }
        
        $this->load->view('user/login_user');
        
    }
    
    function login_process()
    {
    	    	
        if( $this->form_validation->run('login_customer') == FALSE )
        {
        	 
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
             
        }
        elseif( $this->customer_model->exists_email( $this->input->post('email') ) == 0 )
        {
            echo '<div class="alert error">'.$this->lang->line('you_must_create_account').'</div>';
        }
        elseif( $this->customer_model->check_user_detail() == FALSE )
        {
            echo '<div class="alert error">'.$this->lang->line('invalid_email_or_pass').'</div>';
        }
        else
        {
            $userdata = $this->customer_model->user_data( $this->input->post('email') );
            
            $session_data = array(
                                      "customername"   => $userdata->email,
                                      "customerhash"   => md5( $userdata->password.$this->config->item('password_hash')  )
                                      );
                                      
            $this->session->set_userdata($session_data);
            
            echo '<script>location.href="'.base_url('customer/dashboard').'";</script>';
        }
    }
 
	/*
     * Logout function
     */
    function logout()
    {
        
        $session_items = array(
							'customername' => '',
							'customerhash'     => '',                            
							'logged_in'=> FALSE
							
							);
		
		$this->session->unset_userdata($session_items);
		
		redirect(base_url()."customer/login","refresh");
    }
    
    /*
     * Sends request for password reset
     */
	function lostpassword_process()
	{
		 
		
		if( $this->form_validation->run('customer_lostpassword') == FALSE )
		{
			echo '<div class="alert error">'.validation_errors().'</div>';
		}
		elseif( $this->customer_model->exists_email( $this->input->post('email') ) == 0 )
		{
			echo '<div class="alert error">'.$this->lang->line('you_must_create_account').'</div>';
		}
		else
		{
			
			$lostpw_code = $this->customer_model->create_lostpw_code();
			
			$subject = 'Reset password request';
            $message = 'Hello, <br> To reset your password please follow the link below: <br> <a href="'.base_url('customer/check_code/'.$this->input->post('email').'/'.$lostpw_code).'">'.base_url('customer/check_code/'.$this->input->post('email').'/'.$lostpw_code).'</a>';
            	
			send_notice($this->input->post('email'),$subject,$message);
			  
			echo '<script>location.href="'.base_url('customer/lostpw_succes').'";</script>';
		}
	}
	
	function lostpw_succes()    {
    	
        $this->load->view('user/lostpw_succes');
       
    }
	
	/*
     * Checks the reset password code
     */
	function check_code( $email, $code )
	{
		$status = $this->customer_model->check_code( $email,$code );
		
		if( $status == 0 )
		{
			$this->session->set_flashdata('message','<div class="alert error">'.$this->lang->line('invalid_reset_code').'</div>');
			redirect(base_url('customer/login'),'refresh');
		}
		else
		{
			$new_password = $this->customer_model->create_new_password( $email );
			
			$subject = 'New Password';
            $message = 'Hello, <br><br> New password is <b>'.$new_password.'</b>. Please <a href="'.base_url('customer/login').'">click here</a> for login';
            	
			send_notice($email,$subject,$message);
			
			$this->session->set_flashdata('message','<div class="alert ok">'.$this->lang->line('new_pass_sent').'</div>');
			redirect(base_url('customer/login'),'refresh');
		}
	}
	
	/*
     * Displays the settings
     */

    
    function settings()
	{
		    check_login_customer();
		 
			$data['customer'] = $this->customer_model->user_data( userdata_customer('email') );
			
			$this->load->view('header');
			$this->load->view('user/user_settings',$data);
			$this->load->view('footer');
		
	}
	
	function change_profile()
	{
		check_login_customer();
		 
		
		if( $this->form_validation->run('customer_change_profile') == FALSE )
		{
			echo '<div class="alert error"><ul>'.validation_errors('<li>','</li>').'</ul></div>';
		}
		else
		{
			$session_data = array(
								 "customername"   => $this->input->post('email'),
								 "customerhash"   => md5( userdata_customer('password').$this->config->item('password_hash')  )
								 );
										  
			if( $this->customer_model->change_profile() )
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
	
	function change_password()
	{
		check_login_customer();
		
		if( $this->form_validation->run('customer_change_password') == FALSE )
		{
			echo '<div class="alert error"><ul>'.validation_errors('<li>','</li>').'</ul></div>';
		}
		elseif( $this->customer_model->check_password() == 0 )
		{
			echo '<div class="alert error">'.$this->lang->line('invalid_pass').'</div>';
		}
		else
		{
			if( $this->customer_model->password_update() )
			{
				
					$session_data = array(
										  "customername"   => userdata_customer('email'),
										  "customerhash"   => md5( userdata_customer('password').$this->config->item('password_hash')  ) 
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

    
}
