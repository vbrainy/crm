<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

    function Category() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("category_model");
		  
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
		    	$data['categories'] = $this->category_model->category_list();
		    			    	 
				$this->load->view('header');
				$this->load->view('category/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
		    	 
				$this->load->view('header');
				$this->load->view('category/add');
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		     
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->category_model->add_category())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($category_id)
	{
		    	  
				$data['category'] = $this->category_model->get_category( $category_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('category/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($category_id)
	{
				 
		    	$data['category'] = $this->category_model->get_category( $category_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('category/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		 
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->category_model->update_category() )
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
	function delete( $category_id )
	{
		 
			if( $this->category_model->delete($category_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}
