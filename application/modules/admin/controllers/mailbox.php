<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox extends CI_Controller {

    function Mailbox() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("mailbox_model");
		 $this->load->model("customers_model");
		 $this->load->model("staff_model");
		  
         $this->load->library('form_validation');
         
         /*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         
         check_login(); 
    }

	function index($customer_id='')
	{
		    	$data['email_list'] = $this->mailbox_model->email_list(userdata('id'),$customer_id);
		    	
		    	$data['sent_email_list'] = $this->mailbox_model->sent_email_list(userdata('id'),$customer_id);
		    	
		    	$data['staffs'] = $this->staff_model->staff_list(); 
				$data['customers'] = $this->customers_model->company_list(); 
		    	
		    	$data['customer_id']=$customer_id;
		    			    	 
				$this->load->view('header');
				$this->load->view('mailbox/index',$data);
				$this->load->view('footer');
			 
	}
	 
	function send_email()
	{
		     
		$this->form_validation->set_rules('assign_customer_id', 'Assign Customer', 'required');
		
		$this->form_validation->set_rules('to_email_id', 'Selet Email', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		//$this->form_validation->set_rules('message', 'Message', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->mailbox_model->send_email())
            { 
                echo '<div class="alert alert-success">Send Successfully</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	  
	
	/*
     * deletes category     *  
     */
	function delete( $mail_id )
	{
		 
			if( $this->mailbox_model->delete($mail_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}
