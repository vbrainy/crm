<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stats extends CI_Controller {

    function Stats() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("vertical_model");
		 $this->load->model("subverticals_model");
		 $this->load->model("customers_model");
		 //$this->load->model("category_model");
		 //$this->load->model("products_model");
		  
         $this->load->library('form_validation');
         
         /*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         
         check_login(); 
    }

	function value()
	{
		$data['verticals'] = $this->vertical_model->vertical_list();
		$data['sub_verticals'] = $this->subverticals_model->subverticals_list();
		$data['customers'] = $this->customers_model->company_list();
		//print_r($data);exit;
		$this->load->view('header');
		$this->load->view('stats/value', $data);
		$this->load->view('footer');
			 
	}
	
	 
}
