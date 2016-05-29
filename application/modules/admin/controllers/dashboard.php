<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function Dashboard() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("dashboard_model");
		 $this->load->model("invoices_model");
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
    
    	$data['leads']=$this->dashboard_model->total_leads();		    	
    	$data['opportunities']=$this->dashboard_model->total_opportunities();
    	$data['customers']=$this->dashboard_model->total_customers();
    	//$data['staff'] = $this->staff_model->get_user($this->session->userdata['id']);
		$this->load->view('header');			 
		$this->load->view('dashboard/index',$data);
		$this->load->view('footer');	
			  
	}
	
	/*
     * delete notification     *  
     */
	function delete_notification( $notification_id)
	{
		 
			if( $this->dashboard_model->delete_notification($notification_id) )
			{
				echo 'deleted';
			}
		
	}
}