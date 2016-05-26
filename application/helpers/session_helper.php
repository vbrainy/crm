<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Admin Function
    function check_login()
    {
        $CI =& get_instance();
        
        $CI->load->model("user_model");
            
        $username = $CI->session->userdata('username');
    	$userhash = $CI->session->userdata('userhash');
            
        if($username == '' || $userhash == '')
    	{
    		redirect(base_url().'admin/login','refresh');
    		exit();
    	}
    	elseif( $CI->user_model->exists_email( $username ) == 0 )
    	{
    		redirect(base_url().'admin/login','refresh');
    		exit();
    	}
    	else
    	{
    			
    		$userdata  = $CI->user_model->user_data( $username );
                
    		$hash_db  = md5($userdata->password.$CI->config->item('password_hash'));
    			
    		if($userhash != $hash_db)
    		{
    			redirect(base_url().'admin/login','refresh');
    			exit();
    		}
    	}
    }


    function is_login()
	{
	   
        $CI =& get_instance();
        
		$CI->load->model("user_model");
		
		$username = $CI->session->userdata('username');
		$userhash = $CI->session->userdata('userhash');
		
		if( $username == '' || $userhash == '' )
		{
			return 0;	
		}
		else
		{
			$userdata  = $CI->user_model->user_data( $username );
                
    		$hash_db  = md5($userdata->password.$CI->config->item('password_hash'));
			
			
			if( $CI->user_model->exists_email( $username ) == 0 )
			{
				return 0;
			}
			elseif( $userhash != $hash_db )
			{
				return 0;
			}
			elseif( ( $CI->user_model->exists_email( $username ) == 1 ) && $userhash == $hash_db )
			{
				return 1;
			}
		}
	}
    
    function userdata( $field = 'id' )
    {
        $CI =& get_instance();
        
		$CI->load->model("user_model");
		
		$username = $CI->session->userdata('username');
        
        $userdata = $CI->user_model->user_data( $username );
        
        return $userdata->$field;
    }
    
/*
*Customer Function
*/    
function check_login_customer()
    {
        $CI =& get_instance();
        
        $CI->load->model("customer_model");
            
        $username = $CI->session->userdata('customername');
    	$userhash = $CI->session->userdata('customerhash');
            
        if($username == '' || $userhash == '')
    	{
    		redirect(base_url().'customer/login','refresh');
    		exit();
    	}
    	elseif( $CI->customer_model->exists_email( $username ) == 0 )
    	{
    		redirect(base_url().'customer/login','refresh');
    		exit();
    	}
    	else
    	{
    			
    		$userdata  = $CI->customer_model->user_data( $username );
                
    		$hash_db  = md5($userdata->password.$CI->config->item('password_hash'));
    			
    		if($userhash != $hash_db)
    		{
    			redirect(base_url().'customer/login','refresh');
    			exit();
    		}
    	}
    }


    function is_login_customer()
	{
	   
        $CI =& get_instance();
        
		$CI->load->model("customer_model");
		
		$username = $CI->session->userdata('customername');
		$userhash = $CI->session->userdata('customerhash');
		
		if( $username == '' || $userhash == '' )
		{
			return 0;	
		}
		else
		{
			$userdata  = $CI->customer_model->user_data( $username );
                
    		$hash_db  = md5($userdata->password.$CI->config->item('password_hash'));
			
			
			if( $CI->customer_model->exists_email( $username ) == 0 )
			{
				return 0;
			}
			elseif( $userhash != $hash_db )
			{
				return 0;
			}
			elseif( ( $CI->customer_model->exists_email( $username ) == 1 ) && $userhash == $hash_db )
			{
				return 1;
			}
		}
	}
    
    function userdata_customer( $field = 'id' )
    {
        $CI =& get_instance();
        
		$CI->load->model("customer_model");
		
		$username = $CI->session->userdata('customername');
        
        $userdata = $CI->customer_model->user_data( $username );
        
        return $userdata->$field;
    }    
    
    function config( $field = 'id' )
    {
        $CI =& get_instance();
        
		$CI->load->model("settings_model");
        
        $settings = $CI->settings_model->get_settings();
        
        return $settings->$field;
    }
    
?>