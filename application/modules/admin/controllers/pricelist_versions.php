<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricelist_versions extends CI_Controller {

    function Pricelist_versions() 
    {
         parent::__construct();
		 $this->load->database();		 
		 $this->load->model("pricelist_versions_model");
		 $this->load->model("pricelists_model");
		 $this->load->model("products_model");	
		  
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
		    	$data['pricelist_versions'] = $this->pricelist_versions_model->pricelist_versions_list();
		    	 	    	 
				$this->load->view('header');
				$this->load->view('pricelist_versions/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{ 
				$data['pricelists'] = $this->pricelists_model->pricelists_list();
				$data['products'] = $this->products_model->products_list();
				
				$this->load->view('header');
				$this->load->view('pricelist_versions/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		     
		$this->form_validation->set_rules('pricelist_version_name', 'Pricelist version name', 'required');
		
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		
		$this->form_validation->set_rules('end_date', 'End Date', 'required');
		
		$this->form_validation->set_rules('pricelist_id', 'Pricelist', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->pricelist_versions_model->add_pricelists_versions())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($pricelist_ver_id)
	{
		    	  
				$data['pricelist_version'] = $this->pricelist_versions_model->get_pricelist_version($pricelist_ver_id);
				
				$data['pricelist_version_product'] = $this->pricelist_versions_model->pricelist_version_product($pricelist_ver_id);	 
		    	 
				$this->load->view('header');
				$this->load->view('pricelist_versions/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($pricelist_ver_id)
	{
				 
		    	$data['pricelists'] = $this->pricelists_model->pricelists_list();
				$data['products'] = $this->products_model->products_list();	 
	
				$data['pricelist_version'] = $this->pricelist_versions_model->get_pricelist_version($pricelist_ver_id);
				
				$data['pricelist_version_product'] = $this->pricelist_versions_model->pricelist_version_product($pricelist_ver_id);
					 	    	 
				$this->load->view('header');
				$this->load->view('pricelist_versions/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		 
		
		$this->form_validation->set_rules('pricelist_version_name', 'Pricelist version name', 'required');
		
		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		
		$this->form_validation->set_rules('end_date', 'End Date', 'required');
		
		$this->form_validation->set_rules('pricelist_id', 'Pricelist', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->pricelist_versions_model->update_pricelists_versions() )
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
		 
			if( $this->pricelist_versions_model->delete($pricelist_id) )
			{
				echo 'deleted';
			}
		
	}
	
	/*
     * deletes version     *  
     */
	function delete_price_ver_product( $product_id )
	{
		 
			if( $this->pricelist_versions_model->delete_price_ver_product($product_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}
