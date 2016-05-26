<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricelists extends CI_Controller {

    function Pricelists() 
    {
         parent::__construct();
		 $this->load->database();		 
		 $this->load->model("pricelists_model");
		  	 
         $this->load->library('form_validation');
         
         /*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         
         check_login(); 
    }

	function index()
	{
			//checking permission for staff
			if (!check_staff_permission('pricelists_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['pricelists'] = $this->pricelists_model->pricelists_list();
		    	 	    	 
				$this->load->view('header');
				$this->load->view('pricelists/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{ 
		//checking permission for staff
			if (!check_staff_permission('pricelists_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
				$this->load->view('header');
				$this->load->view('pricelists/add');
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		//checking permission for staff
			if (!check_staff_permission('pricelists_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		     
		$this->form_validation->set_rules('pricelist_name', 'Pricelist Name', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->pricelists_model->add_pricelists())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($pricelist_id)
	{
		    	 //checking permission for staff
			if (!check_staff_permission('pricelists_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			 
				$data['pricelist'] = $this->pricelists_model->get_pricelist( $pricelist_id );
		    	
		    	$data['versions'] = $this->pricelists_model->pricelist_versions( $pricelist_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('pricelists/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($pricelist_id)
	{
				//checking permission for staff
			if (!check_staff_permission('pricelists_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
				 
		    	$data['pricelist'] = $this->pricelists_model->get_pricelist( $pricelist_id );
		    	
		    	$data['versions'] = $this->pricelists_model->pricelist_versions( $pricelist_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('pricelists/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		 //checking permission for staff
			if (!check_staff_permission('pricelists_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		
		$this->form_validation->set_rules('pricelist_name', 'Pricelist Name', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->pricelists_model->update_pricelist() )
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
     * deletes pricelist     *  
     */
	function delete( $pricelist_id )
	{
		//checking permission for staff
			if (!check_staff_permission('pricelists_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		 
			if( $this->pricelists_model->delete($pricelist_id) )
			{
				echo 'deleted';
			}
		
	}
	
	/*
     * deletes version     *  
     */
	function delete_version( $version_id )
	{
		 
			if( $this->pricelists_model->delete_versions($version_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}
