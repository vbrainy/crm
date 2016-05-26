<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices extends CI_Controller {

    function Invoices() 
    {
         parent::__construct();
		 $this->load->database();		 
		 $this->load->model("invoices_model");
		 $this->load->model("admin/salesorder_model");
		 $this->load->model("admin/qtemplates_model");
		 $this->load->model("admin/customers_model");
		 $this->load->model("admin/staff_model");
		 $this->load->model("admin/pricelists_model");	
		 $this->load->model("admin/products_model");	 	 
         $this->load->library('form_validation');
         
         $this->load->helper('pdf_helper');  
         
         check_login_customer(); 
    }

	function index()
	{
		    	$data['customer'] = $this->customer_model->user_data( userdata_customer('email') );
		    	
		    	$company_id= $data['customer']->company;
		    	
		    	 
		    	$data['invoices'] = $this->invoices_model->invoices_list($company_id);
		    	
		    	$data['open_invoice_total'] = $this->invoices_model->open_invoices_total_collection($company_id);
		    	
		    	$data['overdue_invoices_total'] = $this->invoices_model->overdue_invoices_total_collection($company_id);
		    	
		    	$data['paid_invoices_total'] = $this->invoices_model->paid_invoices_total_collection($company_id);
		    	
		    	//$data['invoices_total_collection'] = $this->invoices_model->invoices_total_collection();	    	   
		    	 	    	 
				$this->load->view('header');
				$this->load->view('invoices/index',$data);
				$this->load->view('footer');
			 
	}
	  
	function view($invoice_id)
	{
				$data['customer'] = $this->customer_model->user_data( userdata_customer('email') );
					
		    	$data['invoice'] = $this->invoices_model->get_invoice($invoice_id,$data['customer']->company);
				 
		    	$data['salesorder'] = $this->invoices_model->get_quotation($data['invoice']->order_id);
		    	
		    	 
				$data['companies'] = $this->customers_model->company_list();		    	   
		    	$data['products'] = $this->products_model->products_list();
		    	$data['qo_products'] = $this->invoices_model->invoice_products($invoice_id);    
	 
				$this->load->view('header');
				$this->load->view('invoices/view',$data);
				$this->load->view('footer');
			 
	}
	 
   	function print_quot($invoice_id)
	{ 
		 
        $data['invoice'] = $this->invoices_model->get_invoice($invoice_id);
				 
    	$data['salesorder'] = $this->invoices_model->get_quotation($data['invoice']->order_id);
    	 
    	 
		$data['companies'] = $this->customers_model->company_list();		    	   
    	$data['products'] = $this->products_model->products_list();
    	$data['qo_products'] = $this->invoices_model->invoice_products($invoice_id);     
				
		
		$this->load->view('invoices/invoice_print',$data);
				
	}
	
	function ajax_create_pdf($invoice_id)
	{ 
		 
		
       $data['invoice'] = $this->invoices_model->get_invoice($invoice_id);
				 
    	$data['salesorder'] = $this->invoices_model->get_quotation($data['invoice']->order_id);
    	 
    	 
		$data['companies'] = $this->customers_model->company_list();		    	   
    	$data['products'] = $this->products_model->products_list();
    	$data['qo_products'] = $this->invoices_model->invoice_products($invoice_id);    
			          
		$html = $this->load->view('invoices/ajax_create_pdf',$data,true);
		
		$filename = 'Invoice-'.str_replace('/','-',$data['invoice']->invoice_number);
		   
		$pdfFilePath = FCPATH."/pdfs/".$filename.".pdf";
		
		  
		$mpdf=new mPDF('c','A4','','',20,15,48,25,10,10); 
		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Acme Trading Co. - Invoice");
		$mpdf->SetAuthor("Acme Trading Co.");
		//$mpdf->SetWatermarkText($data['salesorder']->payment_term);
		//$mpdf->showWatermarkText = true;
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 

		$mpdf->WriteHTML($html);

		$mpdf->Output($pdfFilePath, 'F');
		
		echo base_url()."pdfs/".$filename.".pdf";
	 	
	 	exit;	
	}
	
	function send_invoice()
	{
		 $this->load->helper('template');
		
		$quotation_id 	= $this->input->post('quotation_id');
		$email_subject 	= $this->input->post('email_subject');
		$to 			= implode(',',$this->input->post('recipients'));
		
		$email_body     = $this->input->post('message_body');
		
		$message_body = parse_template($email_body);	 
		 
		$invoice_pdf = $this->input->post('invoice_pdf');
		
		if(send_email($email_subject, $to,  $message_body,$invoice_pdf))		{
			echo "success";
			
		}
		else{
			echo "not sent";
		}
	} 	
	
	function ajax_customer_detais($customer_id)
	{
		$details=array();
		
		$details['email']=$this->customers_model->get_company($customer_id)->email;
		$details['address']=$this->customers_model->get_company($customer_id)->address; 
		
		echo json_encode($details);
	}
	
	function invoice_excel_list()
	{
		$this->load->library('excel');
		    	
		$data['invoices'] = $this->invoices_model->invoice_excel_list();
	    
	    $this->excel->to_excel($data['invoices'], 'Invoices-Excel'); 
	}
}
