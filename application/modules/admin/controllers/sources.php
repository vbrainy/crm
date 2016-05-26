<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sources extends CI_Controller {

    function Sources() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("sources_model");
		  
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
		    	$data['sources'] = $this->sources_model->sources_list();
		    			    	 
				$this->load->view('header');
				$this->load->view('sources/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
		    	 
				$this->load->view('header');
				$this->load->view('sources/add');
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		     
		$this->form_validation->set_rules('source_name', 'Sources Name', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->sources_model->add_source())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($source_id)
	{
		    	  
				$data['sources'] = $this->sources_model->get_source( $source_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('sources/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($source_id)
	{
				 
		    	$data['sources'] = $this->sources_model->get_source( $source_id ); 
		    	 
				$this->load->view('header');
				$this->load->view('sources/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		 
		
		$this->form_validation->set_rules('source_name', 'Source Name', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->sources_model->update_source() )
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
	function delete( $source_id )
	{
		 
			if( $this->sources_model->delete($source_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}