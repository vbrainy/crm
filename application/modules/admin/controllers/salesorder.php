<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salesorder extends CI_Controller {

    function Salesorder() 
    {
         parent::__construct();
		 $this->load->database();		 
		 $this->load->model("salesorder_model");
		 $this->load->model("qtemplates_model");
		 $this->load->model("customers_model");
		 $this->load->model("staff_model");
		 $this->load->model("salesteams_model");
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
			if (!check_staff_permission('sales_orders_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['salesorder'] = $this->salesorder_model->quotations_list($customer_id);
		    	 	    	 
				$this->load->view('header');
				$this->load->view('salesorder/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{ 
			//checking permission for staff
			if (!check_staff_permission('sales_orders_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
				$data['qtemplates'] = $this->qtemplates_model->qtemplate_list();
				
				$data['companies'] = $this->customers_model->company_list();
		    	
		    	$data['staffs'] = $this->staff_model->staff_list(); 
		    	
		    	$data['salesteams'] = $this->salesteams_model->salesteams_list(); 
		    	
		    	$data['pricelists'] = $this->pricelists_model->pricelists_list(); 
		    	
		    	$data['products'] = $this->products_model->products_list();
		    	
				$this->load->view('header');
				$this->load->view('quotations/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		//checking permission for staff
			if (!check_staff_permission('sales_orders_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		     
		$this->form_validation->set_rules('customer_id', 'Customer', 'required');
		
		$this->form_validation->set_rules('date', 'Date', 'required');
		
		//$this->form_validation->set_rules('quotation_template', 'Quotation Template', 'required');
		
		//$this->form_validation->set_rules('pricelist_id', 'Pricelist', 'required');
		
		$this->form_validation->set_rules('sales_person', 'Salesperson', 'required');
		
		$this->form_validation->set_rules('sales_team_id', 'Sales Team', 'required');
		
		$this->form_validation->set_rules('grand_total', 'Total', 'required');
		 
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red">' . validation_errors() . '</div>';
        } 
        else
        {
            
            if( $this->salesorder_model->add_quotation())
            { 
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($quotation_id)
	{
			//checking permission for staff
			if (!check_staff_permission('sales_orders_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
		    	$data['quotation'] = $this->salesorder_model->get_quotation($quotation_id);
		    	
		    	$data['qtemplates'] = $this->qtemplates_model->qtemplate_list();
				
				$data['companies'] = $this->customers_model->company_list();
		    	
		    	$data['staffs'] = $this->staff_model->staff_list(); 
		    	
		    	$data['pricelists'] = $this->pricelists_model->pricelists_list(); 
		    	 
		    	$data['qo_products'] = $this->salesorder_model->quot_order_products($quotation_id); 
				 
				$this->load->view('header');
				$this->load->view('salesorder/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($qo_id)
	{
			//checking permission for staff
			if (!check_staff_permission('sales_orders_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
				 
		    	$data['quotation'] = $this->salesorder_model->get_quotation($qo_id);
		    	
		    	$data['qtemplates'] = $this->qtemplates_model->qtemplate_list();
				
				$data['companies'] = $this->customers_model->company_list();
		    	
		    	$data['staffs'] = $this->staff_model->staff_list(); 
		    	
		    	$data['salesteams'] = $this->salesteams_model->salesteams_list(); 
		    	
		    	$data['pricelists'] = $this->pricelists_model->pricelists_list(); 
		    	
		    	$data['products'] = $this->products_model->products_list();
		    	$data['qo_products'] = $this->salesorder_model->quot_order_products($qo_id);    
		    	 
				$this->load->view('header');
				$this->load->view('salesorder/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		 //checking permission for staff
			if (!check_staff_permission('sales_orders_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		
		$this->form_validation->set_rules('customer_id', 'Customer', 'required');
		
		$this->form_validation->set_rules('date', 'Date', 'required');
		
		//$this->form_validation->set_rules('quotation_template', 'Quotation Template', 'required');
		
		//$this->form_validation->set_rules('pricelist_id', 'Pricelist', 'required');
		
		$this->form_validation->set_rules('sales_person', 'Salesperson', 'required');
		
		$this->form_validation->set_rules('sales_team_id', 'Sales Team', 'required');
		
		$this->form_validation->set_rules('grand_total', 'Total', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error" style="color:red"> ' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->salesorder_model->update_quotation() )
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
	function delete( $order_id )
	{
		 //checking permission for staff
			if (!check_staff_permission('sales_orders_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
			if( $this->salesorder_model->delete($order_id) )
			{
				echo 'deleted';
			}
		
	}
	 
	
	function ajax_qtemplates_products($qtemplate_id,$pricelist_id)
    {	
    	$data['qtemplate_products'] = $this->qtemplates_model->qtemplate_products($qtemplate_id);  
    	
    	$data['pricelist_version'] = $this->salesorder_model->get_pricelist_version_by_pricelist_id($pricelist_id);
    	  	 
        $this->load->view('salesorder/ajax_qtemplates_products',$data);
    	
   	}
   	
   	function print_quot($quotation_id)
	{ 
        $data['quotation'] = $this->salesorder_model->get_quotation($quotation_id);
    	
    	$data['qtemplates'] = $this->qtemplates_model->qtemplate_list();
		
		$data['companies'] = $this->customers_model->company_list();
    	
    	$data['staffs'] = $this->staff_model->staff_list(); 
    	
    	$data['pricelists'] = $this->pricelists_model->pricelists_list(); 
    	
    	$data['qo_products'] = $this->salesorder_model->quot_order_products($quotation_id);   		
				
		
		$this->load->view('salesorder/order_print',$data);
				
	}
	
	function ajax_create_pdf($quotation_id)
	{ 
		 
		
        $data['quotation'] = $this->salesorder_model->get_quotation($quotation_id);
    	
    	$data['qtemplates'] = $this->qtemplates_model->qtemplate_list();
		
		$data['companies'] = $this->customers_model->company_list();
    	
    	$data['staffs'] = $this->staff_model->staff_list(); 
    	
    	$data['pricelists'] = $this->pricelists_model->pricelists_list(); 
    	
    	$data['qo_products'] = $this->salesorder_model->quot_order_products($quotation_id);   		 
          
		$html = $this->load->view('salesorder/ajax_create_pdf',$data,true);
		
		$filename = 'Order-'.$data['quotation']->quotations_number;
		  
		$pdfFilePath = FCPATH."/pdfs/".$filename.".pdf";
		
		  
		$mpdf=new mPDF('c','A4','','',20,15,48,25,10,10); 
		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Acme Trading Co. - Invoice");
		$mpdf->SetAuthor("Acme Trading Co.");
		$mpdf->SetWatermarkText($data['quotation']->payment_term);
		$mpdf->showWatermarkText = true;
		$mpdf->watermark_font = 'DejaVuSansCondensed';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 

		$mpdf->WriteHTML($html);

		$mpdf->Output($pdfFilePath, 'F');
		
		echo base_url()."pdfs/".$filename.".pdf";
	 	
	 	exit;	
	}
	
	function send_quotation()
	{
		 $this->load->helper('template');
		
		$quotation_id 	= $this->input->post('quotation_id');
		$email_subject 	= $this->input->post('email_subject');
		$to 			= implode(',',$this->input->post('recipients'));
		
		$email_body     = $this->input->post('message_body');
		
		$message_body = parse_template($email_body);	 
		 
		$quotation_pdf = $this->input->post('quotation_pdf');
		
		if(send_email($email_subject, $to,  $message_body,$quotation_pdf))		{
			echo "success";
			
		}
		else{
			echo "not sent";
		}
	} 
	
	
	/*
     * deletes product     *  
     */
	function delete_qo_product( $product_id )
	{ 
		   	if( $this->salesorder_model->delete_qo_product($product_id) )
			{
				echo 'deleted';
			}
			 
	}
	
	/*
	Create Invoice
	*/
	function create_invoice( $order_id )
	{ 
		$invoice_id=$this->salesorder_model->create_invoice($order_id);	   	 
		redirect('admin/invoices/update/'.$invoice_id);   	 
			 
	}
	function ajax_get_products_price($product_id,$pricelist_id)
    {	
    	$data['products_price'] = $this->salesorder_model->get_product_price($product_id,$pricelist_id);  
    	   	 
        echo  $data['products_price']->special_price;
        exit;
   	}
}
