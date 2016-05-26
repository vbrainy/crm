<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Segments extends CI_Controller {

    function Segments() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("segments_model");
		 $this->load->model("staff_model");
		 $this->load->model("regions_model");
		    
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
			if (!check_staff_permission('segment_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['segments'] = $this->segments_model->segments_list();
		    			    	 
				$this->load->view('header');
				$this->load->view('segments/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
				//checking permission for staff
			if (!check_staff_permission('segment_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['staffs'] = $this->staff_model->staff_list();
		    	$data['regions'] = $this->regions_model->regions_list();
		    	
				$this->load->view('header');
				$this->load->view('segments/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
			  
		//checking permission for staff
			if (!check_staff_permission('sales_team_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		  
		$this->form_validation->set_rules('segment', 'Segment', 'required');
		$this->form_validation->set_rules('sales_target', 'Sales Target', 'required');
		$this->form_validation->set_rules('sales_forecast', 'Sales Forecast', 'required');
		$this->form_validation->set_rules('actual_sales', 'Actual Sales', 'required');
		$this->form_validation->set_rules('segment_leader', 'Segment Leader', 'required');
		$this->form_validation->set_rules('segment_members', 'Segment Members', 'required'); 
			 
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
        }         
        else
        {
            
            if( $this->segments_model->add_segment())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($segment_id)
	{
		    	//checking permission for staff
			if (!check_staff_permission('segment_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			  
				$data['segments'] = $this->segments_model->get_segment( $segment_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('segments/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($segment_id)
	{
				//checking permission for staff
			if (!check_staff_permission('segment_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
				$data['staffs'] = $this->staff_model->staff_list();
				$data['regions'] = $this->regions_model->regions_list();
		    	 
		    	$data['segments'] = $this->segments_model->get_segment( $segment_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('segments/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		//checking permission for staff
			if (!check_staff_permission('segment_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}  
		
		$this->form_validation->set_rules('segment', 'Segment', 'required');
		$this->form_validation->set_rules('sales_target', 'Sales Target', 'required');
		$this->form_validation->set_rules('sales_forecast', 'Sales Forecast', 'required');
		$this->form_validation->set_rules('actual_sales', 'Actual Sales', 'required');
		$this->form_validation->set_rules('segment_leader', 'Segment Leader', 'required');
		$this->form_validation->set_rules('segment_members', 'Segment Members', 'required'); 
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
        }
        else
        {
            
            if( $this->segments_model->update_segment() )
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
     * deletes opportunity     *  
     */
	function delete( $segment_id )
	{
		//checking permission for staff
			if (!check_staff_permission('segment_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}  
		 
		if( $this->segments_model->delete($segment_id) )
		{
			echo 'deleted';
		}
		
	}	
	 
	 
}