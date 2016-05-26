<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Qtemplates extends CI_Controller {

	
    function Qtemplates() 
    {
    		
         parent::__construct();
		 $this->load->database();		 
		 $this->load->model("qtemplates_model");
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
		    	$data['qtemplates'] = $this->qtemplates_model->qtemplate_list();
		    		 
				$this->load->view('header');
				$this->load->view('qtemplates/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{ 
				$data['products'] = $this->products_model->products_list();
				 
				$this->load->view('header');
				$this->load->view('qtemplates/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		     
		$this->form_validation->set_rules('quotation_template', 'Quotation Template', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->qtemplates_model->add_qtemplates())
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
		    	  
				$data['pricelist'] = $this->qtemplates_model->get_pricelist( $pricelist_id );
		    	
		    	$data['versions'] = $this->qtemplates_model->pricelist_versions( $pricelist_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('pricelists/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($qtemplate_id)
	{
				 
		    	$data['qtemplate'] = $this->qtemplates_model->get_qtemplate( $qtemplate_id );
		    	
		    	$data['qtemplate_products'] = $this->qtemplates_model->qtemplate_products( $qtemplate_id );
		    	
		    	$data['products'] = $this->products_model->products_list();	 
		    	 
				$this->load->view('header');
				$this->load->view('qtemplates/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		 
		
		$this->form_validation->set_rules('quotation_template', 'Quotation Template', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->qtemplates_model->update_qtemplates() )
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
	function delete( $qtemplate_id )
	{
		 
			if( $this->qtemplates_model->delete($qtemplate_id) )
			{
				echo 'deleted';
			}
		
	}
	
	/*
     * deletes product     *  
     */
	function delete_product( $product_id )
	{
		 	$new_values=$this->qtemplates_model->delete_qtemplate_product($product_id) ;
		 
		   echo $new_values;
			 
	}
	 
}
