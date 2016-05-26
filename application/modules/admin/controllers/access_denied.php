<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_denied extends CI_Controller {

    function Access_denied() 
    {
         parent::__construct();
		 $this->load->database();
		  
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
				$this->load->view('access_denied'); 
	}
	 
	 
}
