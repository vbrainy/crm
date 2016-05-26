<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regions extends CI_Controller {

    function Regions() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("regions_model");
		 $this->load->model("staff_model");
		    
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
			if (!check_staff_permission('region_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['regions'] = $this->regions_model->regions_list();
		    			    	 
				$this->load->view('header');
				$this->load->view('regions/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
				//checking permission for staff
			if (!check_staff_permission('region_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['staffs'] = $this->staff_model->staff_list();
		    	
				$this->load->view('header');
				$this->load->view('regions/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
			  
		//checking permission for staff
			if (!check_staff_permission('region_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		  
		$this->form_validation->set_rules('region', 'Region', 'required');
		$this->form_validation->set_rules('sales_target', 'Sales Target', 'required');
		$this->form_validation->set_rules('sales_forecast', 'Sales Forecast', 'required');
		$this->form_validation->set_rules('actual_sales', 'Actual Sales', 'required');
		$this->form_validation->set_rules('region_leader', 'Region Leader', 'required');
		$this->form_validation->set_rules('region_members', 'Region Members', 'required'); 
			 
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
        }         
        else
        {
            
            if( $this->regions_model->add_region())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($region_id)
	{
		    	//checking permission for staff
			if (!check_staff_permission('region_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
			  $data['regions'] = $this->regions_model->get_region( $region_id );	 
					 
		    	 
				$this->load->view('header');
				$this->load->view('regions/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($region_id)
	{
				//checking permission for staff
			if (!check_staff_permission('region_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
				$data['staffs'] = $this->staff_model->staff_list();
		    	 
		    	$data['region'] = $this->regions_model->get_region( $region_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('regions/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		//checking permission for staff
			if (!check_staff_permission('region_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}  
		
		$this->form_validation->set_rules('region', 'Region', 'required');
		$this->form_validation->set_rules('sales_target', 'Sales Target', 'required');
		$this->form_validation->set_rules('sales_forecast', 'Sales forecast', 'required');
		$this->form_validation->set_rules('actual_sales', 'Actual Sales', 'required');
		$this->form_validation->set_rules('region_leader', 'Region Leader', 'required');
		$this->form_validation->set_rules('region_members', 'Region Members', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
        }
        else
        {
            
            if( $this->regions_model->update_region() )
            {
                echo '<div class="alert alert-success">'.$this->lang->line('update_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
	}
	
		
	 function delete( $region_id )
	{
		//checking permission for staff
			if (!check_staff_permission('region_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}  
		 
		if( $this->regions_model->delete($region_id) )
		{
			echo 'deleted';
		}
		
	}	
	 
}