<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logged_calls extends CI_Controller {

    function Logged_calls() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("logged_calls_model");
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
				//checking permission for staff
				if (!check_staff_permission('logged_calls_read'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
			
		    	$data['logged_calls'] = $this->logged_calls_model->logged_calls_list($customer_id);
		    			    	 
				$this->load->view('header');
				$this->load->view('logged_calls/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
			  //checking permission for staff
				if (!check_staff_permission('logged_calls_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
				 	
			   $data['companies'] = $this->customers_model->company_list();
			   
			   $data['staffs'] = $this->staff_model->staff_list(); 
		    	 
				$this->load->view('header');
				$this->load->view('logged_calls/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		//checking permission for staff
				if (!check_staff_permission('logged_calls_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
					
		$this->form_validation->set_rules('date', 'Date', 'required');   
		  	
		$this->form_validation->set_rules('call_summary', 'Call Summary', 'required');
		
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->logged_calls_model->add_calls())
            { 
            	$call_id=$this->db->insert_id();
              
              add_notifications($this->input->post('resp_staff_id'),'New Call Added',$call_id,'logged_calls');
            	
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	 
	
	function update($call_id)
	{
		//checking permission for staff
				if (!check_staff_permission('logged_calls_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
		 
					 
		$data['companies'] = $this->customers_model->company_list();
				
		$data['staffs'] = $this->staff_model->staff_list(); 
	
    	$data['call'] = $this->logged_calls_model->get_call( $call_id );	    	 
		    	 
				$this->load->view('header');
				$this->load->view('logged_calls/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		//checking permission for staff
				if (!check_staff_permission('logged_calls_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
		 
		$this->form_validation->set_rules('date', 'Date', 'required');
		
		$this->form_validation->set_rules('call_summary', 'Call Summary', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->logged_calls_model->edit_calls() )
            {
                echo '<div class="alert alert-success">'.$this->lang->line('update_succesful').'</div>';
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
	function delete( $call_id )
	{
			//checking permission for staff
				if (!check_staff_permission('logged_calls_delete'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
		 
			if( $this->logged_calls_model->delete($call_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}
