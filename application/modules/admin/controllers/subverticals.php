<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subverticals extends CI_Controller {

    function Subverticals() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("vertical_model");
		 $this->load->model("subverticals_model");
		   	 
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
			/*if (!check_staff_permission('subverticals_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}*/
			
		    	$data['subverticals'] = $this->subverticals_model->subverticals_list();
		    			    	 
				$this->load->view('header');
				$this->load->view('subverticals/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
				//checking permission for staff
			/*if (!check_staff_permission('subverticals_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}*/
			
				$data['verticals'] = $this->vertical_model->vertical_list();
		    	 
				$this->load->view('header');
				$this->load->view('subverticals/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		//checking permission for staff
			/*if (!check_staff_permission('subverticals_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}*/
		     
		$this->form_validation->set_rules('subvertical_name', 'Vertical Name', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->subverticals_model->add_subverticals())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($subvertical_id)
	{	
			//checking permission for staff
			/*if (!check_staff_permission('subverticals_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}*/
		    	  
				$data['subvertical'] = $this->subverticals_model->get_subverticals( $subvertical_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('subverticals/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($subvertical_id)
	{
				//checking permission for staff
			/*if (!check_staff_permission('subverticals_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}*/
			
				$data['verticals'] = $this->vertical_model->vertical_list();
				 
		    	$data['subvertical'] = $this->subverticals_model->get_subverticals( $subvertical_id );
		    	
		    	
				$this->load->view('header');
				$this->load->view('subverticals/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		//checking permission for staff
			/*if (!check_staff_permission('subverticals_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			} */
		
		$this->form_validation->set_rules('subvertical_name', 'Subvertical Name', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->subverticals_model->update_subverticals() )
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
     * deletes subverticals     *  
     */
	function delete( $subverticals_id )
	{
			//checking permission for staff
			if (!check_staff_permission('subverticals_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		 
			if( $this->subverticals_model->delete($subverticals_id) )
			{
				echo 'deleted';
			}
		
	}
	
	
}