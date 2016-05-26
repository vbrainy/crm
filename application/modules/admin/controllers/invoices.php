<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices extends CI_Controller {

    function Invoices() 
    {
         parent::__construct();
		 $this->load->database();		 
		 $this->load->model("invoices_model");
		 $this->load->model("salesorder_model");
		 $this->load->model("qtemplates_model");
		 $this->load->model("customers_model");
		 $this->load->model("staff_model");
		 $this->load->model("pricelists_model");	
		 $this->load->model("products_model");
		   
         $this->load->library('form_validation');
         
         $this->load->helper('pdf_helper');  
         
         /*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         
         check_login(); 
    }

	function index($customer_id='')
	{
		    	//checking permission for staff
			if (!check_staff_permission('invoices_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			 
		    	$data['invoices'] = $this->invoices_model->invoices_list($customer_id);
		    	
		    	$data['open_invoice_total'] = $this->invoices_model->open_invoices_total_collection();
		    	
		    	$data['overdue_invoices_total'] = $this->invoices_model->overdue_invoices_total_collection();
		    	
		    	$data['paid_invoices_total'] = $this->invoices_model->paid_invoices_total_collection();
		    	
		    	$data['invoices_total_collection'] = $this->invoices_model->invoices_total_collection();	    	   
		    	 	    	 
				$this->load->view('header');
				$this->load->view('invoices/index',$data);
				$this->load->view('footer');
			 
	}
	function status($pay_status)
	{
		//checking permission for staff
			if (!check_staff_permission('invoices_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['invoices'] = $this->invoices_model->invoices_list_status($pay_status);
		    	$data['open_invoice_total'] = $this->invoices_model->open_invoices_total_collection();
		    	
		    	$data['overdue_invoices_total'] = $this->invoices_model->overdue_invoices_total_collection();
		    	
		    	$data['paid_invoices_total'] = $this->invoices_model->paid_invoices_total_collection();
		    	
		    	$data['invoices_total_collection'] = $this->invoices_model->invoices_total_collection();	    
		    	 	    	 
				$this->load->view('header');
				$this->load->view('invoices/index',$data);
				$this->load->view('footer');
			 
	}	
	
	function view($invoice_id)
	{
		//checking permission for staff
			if (!check_staff_permission('invoices_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['invoice'] = $this->invoices_model->get_invoice($invoice_id);
				 
		    	$data['salesorder'] = $this->invoices_model->get_quotation($data['invoice']->order_id);
		    	
		    	 
				$data['companies'] = $this->customers_model->company_list();		    	   
		    	$data['products'] = $this->products_model->products_list();
		    	$data['qo_products'] = $this->invoices_model->invoice_products($invoice_id);    
	 
				$this->load->view('header');
				$this->load->view('invoices/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($invoice_id)
	{
		//checking permission for staff
			if (!check_staff_permission('invoices_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
				
				$data['invoice'] = $this->invoices_model->get_invoice($invoice_id);
				 
		    	$data['salesorder'] = $this->invoices_model->get_quotation($data['invoice']->order_id);
		    	
		    	 
				$data['companies'] = $this->customers_model->company_list();		    	   
		    	$data['products'] = $this->products_model->products_list();
		    	$data['qo_products'] = $this->invoices_model->invoice_products($invoice_id);    
		    	 
				$this->load->view('header');
				$this->load->view('invoices/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		//checking permission for staff
			if (!check_staff_permission('invoices_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			 		
		$this->form_validation->set_rules('invoice_id', 'Invoice ID', 'required');
		
		$this->form_validation->set_rules('customer_id', 'Customer', 'required');
		
		$this->form_validation->set_rules('invoice_date', 'Invoice Date', 'required');
		
		$this->form_validation->set_rules('due_date', 'Due Date', 'required');
		
		$this->form_validation->set_rules('payment_term', 'Payment Term', 'required');
		
		$this->form_validation->set_rules('status', 'Status', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->invoices_model->update_invoice() )
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
     * deletes invoice     *  
     */
	function delete( $invoice_id )
	{
			//checking permission for staff
			if (!check_staff_permission('invoices_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		 
			if( $this->invoices_model->delete($invoice_id) )
			{
				echo 'deleted';
			}
		
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
	
	function receive_payments($invoice_id)
	{
		$data['invoice'] = $this->invoices_model->get_invoice($invoice_id);
		 
		$this->load->view('header');
		$this->load->view('invoices/receive_payments',$data);
		$this->load->view('footer');
			 
	}
	
	function receive_payments_process()
	{
		$this->form_validation->set_rules('invoice_id', 'Invoice ID', 'required');
		
		$this->form_validation->set_rules('payment_received', 'Payment Received', 'required|numeric');
		
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        elseif( $this->invoices_model->check_unpaid_amount($this->input->post('invoice_id') ) ==false)
        {
            echo '<div class="alert alert-danger">Can\'t receive more than unpaid amount</div>';
        }
        else
        {
            
            if( $this->invoices_model->receive_payments() )
            {
                echo '<div class="alert alert-success">Payment receive successful</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function receive_payments_number()
	{		 
		$this->load->view('header');
		$this->load->view('invoices/receive_payments_by_number');
		$this->load->view('footer');
			 
	}
	
	function receive_payments_number_process()
	{
		$this->form_validation->set_rules('invoice_number', 'Invoice Number', 'required');
		
		$this->form_validation->set_rules('payment_received', 'Amount Received', 'required|numeric');
		
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }         
        else
        {
            
            if( $this->invoices_model->receive_payments_number() )
            {
                echo '<div class="alert alert-success">Payment receive successful</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function invoice_excel_list()
	{
		$this->load->library('excel');
		    	
		$data['invoices'] = $this->invoices_model->invoice_excel_list();
	    
	    $this->excel->to_excel($data['invoices'], 'Invoices-Excel'); 
	}
}
