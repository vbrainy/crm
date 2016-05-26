<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

    function Products() 
    {
         parent::__construct();
		 $this->load->database();
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
				//checking permission for staff
			if (!check_staff_permission('products_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['products'] = $this->products_model->products_list();
		    			    	 
				$this->load->view('header');
				$this->load->view('products/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
				//checking permission for staff
			if (!check_staff_permission('products_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
	
		    	 
				$this->load->view('header');
				$this->load->view('products/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		//checking permission for staff
			if (!check_staff_permission('products_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		     
		$this->form_validation->set_rules('product_name', 'Product Name', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->products_model->add_products())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($product_id)
	{	
			//checking permission for staff
			if (!check_staff_permission('products_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		    	  
				$data['product'] = $this->products_model->get_products( $product_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('products/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($product_id)
	{
				//checking permission for staff
			if (!check_staff_permission('products_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			

				 
		    	$data['product'] = $this->products_model->get_products( $product_id );
		    	
		    	$data['variants'] = $this->products_model->product_variants( $product_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('products/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		//checking permission for staff
			if (!check_staff_permission('products_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			} 
		
		$this->form_validation->set_rules('product_name', 'Product Name', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->products_model->update_products() )
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
     * deletes products     *  
     */
	function delete( $products_id )
	{
			//checking permission for staff
			if (!check_staff_permission('products_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		 
			if( $this->products_model->delete($products_id) )
			{
				echo 'deleted';
			}
		
	}
	
	/*
     * deletes products     *  
     */
	function delete_variant( $variant_id )
	{
		 	//checking permission for staff
			if (!check_staff_permission('products_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
			if( $this->products_model->delete_variant($variant_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}
