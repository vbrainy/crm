<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customers extends CI_Controller
{

    function Customers()
    {
	parent::__construct();
	$this->load->database();
	$this->load->model("customers_model");

	$this->load->model("regions_model");
	$this->load->model("vertical_model");
	$this->load->model("subverticals_model");


	$this->load->library('form_validation');

	/* cache control */
	$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	$this->output->set_header('Pragma: no-cache');
	$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	check_login();
    }

    function index()
    {
	$data['customers'] = $this->customers_model->company_contact_list();

	$this->load->view('header');
	$this->load->view('customers/index', $data);
	$this->load->view('footer');
    }

    function add()
    {
	$data['contact_persons'] = $this->customers_model->contact_persons_list();
	$data['states']		 = $this->customers_model->state_list(160);
	$data['regions']	 = $this->regions_model->regions_list();
	$data['verticals']	 = $this->vertical_model->vertical_list();
	//$data['subverticals']	 = $this->subverticals_model->subverticals_list();

	$data['countries'] = $this->customers_model->country_list();
	$this->load->view('header');
	$this->load->view('customers/add', $data);
	$this->load->view('footer');
    }

    function add_process()
    {
	if($this->form_validation->run('admin_create_company') == FALSE)
	{
	    echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">', '</li>') . '</ul></div>';
	}
	elseif($this->customers_model->exists_email($this->input->post('email')) > 0)
	{
	    echo '<div class="alert error"><ul><li style="color:red">Email already used.</li></ul></div>';
	}
	else if($this->input->post('main_contact_person') == $this->input->post('contact_person'))
	{
	    echo '<div class="alert error"><ul><li style="color:red">Contact person should not be the same.</li></ul></div>';
	}
	else
	{
	    if($this->customers_model->add_company())
	    {
		$subject = 'Customer login details';
		$message = 'Hello,  <br><br><b>Email:</b> ' . $this->input->post('email') . '. <br> <b>Password:</b> ' . $this->input->post('password') . '. <br>Please <a href="' . base_url('customer/login') . '">click here</a> for login';

		send_notice($this->input->post('email'), $subject, $message);

		echo '<div class="alert alert-success">' . $this->lang->line('create_succesful') . '</div>';
	    }
	    else
	    {
		echo $this->lang->line('technical_problem');
	    }
	}
    }

    function view($company_id)
    {
	$data['total_sales'] = $this->customers_model->total_sales_collection($company_id);

	$data['open_invoices'] = $this->customers_model->open_invoices_total_collection($company_id);

	$data['overdue_invoices'] = $this->customers_model->overdue_invoices_total_collection($company_id);

	$data['paid_invoices'] = $this->customers_model->paid_invoices_total_collection($company_id);

	$data['quotations_total'] = $this->customers_model->quotations_total_collection($company_id);

	$data['salesorder'] = $this->customers_model->total_salesorders($company_id);

	$data['quotations'] = $this->customers_model->total_quotations($company_id);

	$data['invoices'] = $this->customers_model->total_invoices($company_id);

	$data['calls'] = $this->customers_model->total_calls($company_id);

	$data['meetings'] = $this->customers_model->total_meetings($company_id);

	$data['emails'] = $this->customers_model->total_emails($company_id);

	$data['contracts'] = $this->customers_model->total_contracts($company_id);

	$data['customer'] = $this->customers_model->get_company($company_id);

	$this->load->view('header');
	$this->load->view('customers/view', $data);
	$this->load->view('footer');
    }

    function update($company_id)
    {
	$data['customer']	 = $this->customers_model->get_company($company_id);
	$data['contact_persons'] = $this->customers_model->contact_persons_list();
	$data['regions']	 = $this->regions_model->regions_list();
	$data['verticals']	 = $this->vertical_model->vertical_list();
	$data['subverticals']	 = $this->subverticals_model->subverticals_list();
	$data['countries']	 = $this->customers_model->country_list();
	$data['states']		 = $this->customers_model->state_list(160);

	$this->load->view('header');
	$this->load->view('customers/update', $data);
	$this->load->view('footer');
    }

    function update_process()
    {
	if($this->form_validation->run('admin_update_company') == FALSE)
	{
	    echo '<div class="alert error red"><ul>' . validation_errors('<li style="color:red">', '</li>') . '</ul></div>';
	}
	else
	{
	    if($this->customers_model->update_company())
	    {
		echo '<div class="alert alert-success">' . $this->lang->line('update_succesful') . '</div>';
	    }
	    else
	    {
		echo $this->lang->line('technical_problem');
	    }
	}
    }

    /*
     * deletes customer
     * @param  a user id integer
     * @return string for ajax
     */

    function delete($customer_id)
    {
	check_login();

	if($this->customers_model->delete($customer_id))
	{
	    echo 'deleted';
	}
    }

    function download($file)
    {


	$path = base_url() . 'uploads/company/' . $file;

	$this->load->helper('file');

	$mime = get_mime_by_extension($path);

	// Build the headers to push out the file properly.
	header('Pragma: public');     // required
	header('Expires: 0');  // no cache
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
	header('Cache-Control: private', false);
	header('Content-Type: ' . $mime);  // Add the mime type from Code igniter.
	header('Content-Disposition: attachment; filename="' . basename($path) . '"');  // Add the file name
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($path)); // provide file size
	header('Connection: close');
	readfile($path); // push it out
	exit();
    }

    function ajax_state_list($country_id)
    {
	$data['state'] = $this->customers_model->state_list($country_id);
	$this->load->view('ajax_get_state', $data);
    }

    function ajax_subvertical_list($vertical_id)
    {
	$data['subverticals'] = $this->customers_model->subvertical_list_by_vertical_id($vertical_id);
	$this->load->view('ajax_get_subverticals', $data);
    }

    function ajax_city_list($state_id)
    {
	$data['cities'] = $this->customers_model->city_list($state_id);
	$this->load->view('ajax_get_city', $data);
    }

}
