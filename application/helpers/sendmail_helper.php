<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  	
  	
  	function send_notice($email,$subject,$message)
    {
		$CI =& get_instance();
         
        
        $CI->load->library('email');
        $config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$CI->email->initialize($config);

			
		$CI->email->from( config('site_email') , $CI->config->item('site_name') );
		$CI->email->to( $email );
			
		$CI->email->subject( $subject );
		$CI->email->message( $message );
			
		$CI->email->send();

		
        
    }
  	
	/*
	function send_email($subject  = '', $to = '',  $body = '', $attachment = ''){
	$CI =& get_instance();

	 	
		$from_email = config('site_email');
		$from_name = config('site_name');

		$CI->load->library("email");
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$CI->email->initialize($config);
		$CI->email->from($from_email, $from_name);
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($body);
		
		if($attachment != '')
		$CI->email->attach($attachment);

		if($CI->email->send()){
			return true;
		}

	 
	}*/	
	
	function send_email($subject  = '', $to = '',  $body = '', $attachment = '')
    {
		$CI =& get_instance();
        
         
        
       	$CI->load->library('email');
       	$CI->load->helper('path'); 
       	
       	 
       	// Configure email library
		
		if(config('smtp_host')!="" and config('smtp_port')!="" and config('smtp_user')!="" and config('smtp_pass')!="" )
		{
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = config('smtp_host');
			$config['smtp_port'] = config('smtp_port');
			$config['smtp_user'] = config('smtp_user');
			$config['smtp_pass'] = config('smtp_pass');
		}
		
		
       	$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$CI->email->initialize($config);
		
		$CI->email->set_newline("\r\n");
			
		$CI->email->from( config('site_email') , config('site_name'));
		$CI->email->to( $to );
			
		$CI->email->subject( $subject );
		$CI->email->message( $body );
		
		$path = set_realpath('pdfs/');
 		$CI->email->attach($path . $attachment);
		 
		//$CI->email->attach($attachment);
			
		if($CI->email->send()){
			return true;
		}
		  
        
    }
  


    
?>