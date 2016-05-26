<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function Dashboard() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("customer_model");
		 $this->load->model("dashboard_model"); 
         $this->load->library('form_validation');
    }

	function index()
	{
			$data['customer'] = $this->customer_model->user_data( userdata_customer('email'));
			
			$company_id = $data['customer']->company;
			 	
			$data['total_sales'] = $this->dashboard_model->total_sales_collection($company_id);
			
			$data['open_invoices'] = $this->dashboard_model->open_invoices_total_collection($company_id);
			
			$data['overdue_invoices'] = $this->dashboard_model->overdue_invoices_total_collection($company_id);
			
			$data['paid_invoices'] = $this->dashboard_model->paid_invoices_total_collection($company_id);
			
			$data['quotations_total'] = $this->dashboard_model->quotations_total_collection($company_id);
			
			$data['salesorder'] = $this->dashboard_model->total_salesorders($company_id);
			
			$data['quotations'] = $this->dashboard_model->total_quotations($company_id);
			
			$data['invoices'] = $this->dashboard_model->total_invoices($company_id);
			
			$data['calls'] = $this->dashboard_model->total_calls($company_id);
		
		    $data['meetings'] = $this->dashboard_model->total_meetings($company_id);	 
		    $data['contracts'] = $this->dashboard_model->total_contracts($company_id);	 
		    	  
			$data['customer'] = $this->dashboard_model->get_company( $company_id );
			 	
		  	    $this->load->view('header');			 
				$this->load->view('dashboard/index',$data);
				$this->load->view('footer');	
		
	}
	
	 
}
