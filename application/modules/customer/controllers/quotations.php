<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotations extends CI_Controller {

    function Quotations() 
    {
         parent::__construct();
		 $this->load->database();		 
		 $this->load->model("quotations_model");
		 $this->load->model("admin/qtemplates_model");
		 $this->load->model("admin/customers_model");
		 $this->load->model("admin/staff_model");
		 $this->load->model("admin/salesteams_model");
		 $this->load->model("admin/pricelists_model");	
		 $this->load->model("admin/products_model");	 	 
         $this->load->library('form_validation');
         
         $this->load->helper('pdf_helper');  
         
         check_login_customer(); 
    }

	function index()
	{
			   $data['customer'] = $this->customer_model->user_data( userdata_customer('email') );	
				
		    	$data['quotations'] = $this->quotations_model->quotations_list($data['customer']->company);
		    	 	    	 
				$this->load->view('header');
				$this->load->view('quotations/index',$data);
				$this->load->view('footer');
			 
	}
	 
	function view($quotation_id)
	{
			   $data['customer'] = $this->customer_model->user_data( userdata_customer('email') );
			
		    	$data['quotation'] = $this->quotations_model->get_quotation($quotation_id,$data['customer']->company);
		    	
		    	$data['qtemplates'] = $this->qtemplates_model->qtemplate_list();
				
				$data['companies'] = $this->customers_model->company_list();
		    	
		    	$data['staffs'] = $this->staff_model->staff_list(); 
		    	
		    	$data['pricelists'] = $this->pricelists_model->pricelists_list(); 
		    	 
		    	$data['qo_products'] = $this->quotations_model->quot_order_products($quotation_id); 
				 
				$this->load->view('header');
				$this->load->view('quotations/view',$data);
				$this->load->view('footer');
			 
	} 
   	function print_quot($quotation_id)
	{ 
        $data['quotation'] = $this->quotations_model->get_quotation($quotation_id);
    	
    	$data['qtemplates'] = $this->qtemplates_model->qtemplate_list();
		
		$data['companies'] = $this->customers_model->company_list();
    	
    	$data['staffs'] = $this->staff_model->staff_list(); 
    	
    	$data['pricelists'] = $this->pricelists_model->pricelists_list(); 
    	
    	$data['qo_products'] = $this->quotations_model->quot_order_products($quotation_id);   		
				
		
		$this->load->view('quotations/quotation_print',$data);
				
	}
	
	function ajax_create_pdf($quotation_id)
	{ 
		 
		
        $data['quotation'] = $this->quotations_model->get_quotation($quotation_id);
    	
    	$data['qtemplates'] = $this->qtemplates_model->qtemplate_list();
		
		$data['companies'] = $this->customers_model->company_list();
    	
    	$data['staffs'] = $this->staff_model->staff_list(); 
    	
    	$data['pricelists'] = $this->pricelists_model->pricelists_list(); 
    	
    	$data['qo_products'] = $this->quotations_model->quot_order_products($quotation_id);   		 
          
		$html = $this->load->view('quotations/ajax_create_pdf',$data,true);
		
		$filename = 'Quotation-'.$data['quotation']->quotations_number;
		  
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
	
	 
	 
}
