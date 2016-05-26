<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contracts extends CI_Controller {

    function Contracts() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("contracts_model");
		 $this->load->model("admin/customers_model");		  
		 $this->load->model("admin/staff_model");
         $this->load->library('form_validation');
         
         /*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         
         check_login_customer(); 
    }

	function index()
	{
		 
			 	$data['customer'] = $this->customer_model->user_data( userdata_customer('email') );	
			 	 
			 	
		    	$data['contracts'] = $this->contracts_model->contracts_list($data['customer']->company);
		    			    	 
				$this->load->view('header');
				$this->load->view('contracts/index',$data);
				$this->load->view('footer');
			 
	}
	 
	 
}
