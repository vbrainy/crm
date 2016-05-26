<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vertical extends CI_Controller {

    function Vertical() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("vertical_model");
		  
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
		    	$data['verticals'] = $this->vertical_model->vertical_list();
		    			    	 
				$this->load->view('header');
				$this->load->view('vertical/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
		    	 
				$this->load->view('header');
				$this->load->view('vertical/add');
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		     
		$this->form_validation->set_rules('vertical_name', 'Vertical Name', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->vertical_model->add_vertical())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($vertical_id)
	{
		    	  
				$data['vertical'] = $this->vertical_model->get_vertical( $vertical_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('vertical/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($vertical_id)
	{
				 
		    	$data['vertical'] = $this->vertical_model->get_vertical( $vertical_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('vertical/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		 
		
		$this->form_validation->set_rules('vertical_name', 'Vertical Name', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->vertical_model->update_vertical() )
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
     * deletes vertical     *  
     */
	function delete( $vertical_id )
	{
		 
			if( $this->vertical_model->delete($vertical_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}