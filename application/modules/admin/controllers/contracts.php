<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contracts extends CI_Controller {

    function Contracts() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("contracts_model");
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
			if (!check_staff_permission('contracts_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['contracts'] = $this->contracts_model->contracts_list($customer_id);
		    			    	 
				$this->load->view('header');
				$this->load->view('contracts/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
		//checking permission for staff
			if (!check_staff_permission('contracts_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			   $data['companies'] = $this->customers_model->company_list();
			   
			   $data['staffs'] = $this->staff_model->staff_list(); 
		    	 
				$this->load->view('header');
				$this->load->view('contracts/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		  //checking permission for staff
			if (!check_staff_permission('contracts_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			   
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		
		$this->form_validation->set_rules('end_date', 'End Date', 'required');
		
		$this->form_validation->set_rules('description', 'Description', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->contracts_model->add_contracts())
            { 
            	
            	$contract_id=$this->db->insert_id();
            	
            	 add_notifications($this->input->post('resp_staff_id'),'New Contract Added',$contract_id,'contracts');
            
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	 
	
	function update($contract_id)
	{
		//checking permission for staff
			if (!check_staff_permission('contracts_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
				 
		$data['companies'] = $this->customers_model->company_list();
				
		$data['staffs'] = $this->staff_model->staff_list(); 
	
    	$data['contract'] = $this->contracts_model->get_contracts( $contract_id );	    	 
		    	 
				$this->load->view('header');
				$this->load->view('contracts/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		//checking permission for staff
			if (!check_staff_permission('contracts_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		
		$this->form_validation->set_rules('end_date', 'End Date', 'required');
		
		$this->form_validation->set_rules('description', 'Description', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->contracts_model->edit_contracts() )
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
     * delete contracts  *  
     */
	function delete( $contract_id )
	{
		//checking permission for staff
			if (!check_staff_permission('contracts_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		 
			if( $this->contracts_model->delete($contract_id) )
			{
				echo 'deleted';
			}
		
	}
	
	function download( $file)
	{
		 
		 
		$path = base_url().'uploads/contract/'.$file; 
	
		$this->load->helper('file');

	    $mime = get_mime_by_extension($path);

	    // Build the headers to push out the file properly.
	    header('Pragma: public');     // required
	    header('Expires: 0');         // no cache
	    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	    header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
	    header('Cache-Control: private',false);
	    header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
	    header('Content-Disposition: attachment; filename="'.basename($path).'"');  // Add the file name
	    header('Content-Transfer-Encoding: binary');
	    header('Content-Length: '.filesize($path)); // provide file size
	    header('Connection: close');
	    readfile($path); // push it out
	    exit();
		
	}
	 
}
