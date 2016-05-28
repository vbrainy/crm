<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');
error_reporting(0);

class Customers_model extends CI_Model
{

    function __construct()
    {
	parent::__construct();
    }

    function exists_email($email)
    {
	$email_count = $this->db->get_where('company', array('email' => $email))->num_rows();
	return $email_count;
    }

    function add_company()
    {
	if(!empty($_FILES['company_attachment']['name']))
	{

	    $config['upload_path']	 = './uploads/company/';
	    $config['allowed_types'] = config('allowed_extensions');
	    $config['max_size']	 = config('max_upload_file_size');
	    $config['encrypt_name']	 = TRUE;

	    $this->load->library('upload', $config);

	    if(!$this->upload->do_upload('company_attachment'))
	    {

		echo $this->upload->display_errors();
	    }
	    else
	    {
		$company_data = $this->upload->data();

		$company_attachment = $company_data['file_name'];
	    }
	}
	else
	{
	    $company_attachment = '';
	}

	if(empty($_FILES['company_avatar']['name']))
	{

	    $company_details = array(
		'name' => $this->input->post('name'),
		'address' => $this->input->post('address'),
		'country_id' => $this->input->post('country_id'),
		'state_id' => $this->input->post('state_id'),
		'city_id' => $this->input->post('city_id'),
		'annual_turnover' => $this->input->post('annual_turnover'),
		'number_employees' => $this->input->post('number_employees'),
		'domestic_branches' => $this->input->post('domestic_branches'),
		'int_branches' => $this->input->post('int_branches'),
		'website' => $this->input->post('website'),
		'phone' => $this->input->post('phone'),
		'mobile' => $this->input->post('mobile'),
		'fax' => $this->input->post('fax'),
		'email' => $this->input->post('email'),
		'company_attachment' => $company_attachment,
		'main_contact_person' => $this->input->post('main_contact_person'),
		'contact_person' => $this->input->post('contact_person'),
		'regions' => $this->input->post('regions'),
		'vertical' => $this->input->post('vertical'),
		'subverticals' => $this->input->post('subverticals'),
		'register_time' => strtotime(date('d F Y g:i a')),
		'ip_address' => $this->input->server('REMOTE_ADDR'),
		'status' => '1'
	    );

	    return $this->db->insert('company', $company_details);
	}
	else
	{


	    $config['upload_path']	 = './uploads/company/';
	    $config['allowed_types'] = config('allowed_extensions');
	    $config['max_size']	 = config('max_upload_file_size');
	    $config['encrypt_name']	 = TRUE;

	    $this->load->library('upload', $config);

	    if(!$this->upload->do_upload('company_avatar'))
	    {

		echo $this->upload->display_errors();
	    }
	    else
	    {
		$img_data = $this->upload->data();

		$company_details = array(
		    'name' => $this->input->post('name'),
		    'address' => $this->input->post('address'),
		    'website' => $this->input->post('website'),
		    'phone' => $this->input->post('phone'),
		    'mobile' => $this->input->post('mobile'),
		    'fax' => $this->input->post('fax'),
		    'country_id' => $this->input->post('country_id'),
		    'state_id' => $this->input->post('state_id'),
		    'city_id' => $this->input->post('city_id'),
		    'annual_turnover' => $this->input->post('annual_turnover'),
		    'number_employees' => $this->input->post('number_employees'),
		    'domestic_branches' => $this->input->post('domestic_branches'),
		    'int_branches' => $this->input->post('int_branches'),
		    'email' => $this->input->post('email'),
		    'company_avatar' => $img_data['file_name'],
		    'company_attachment' => $company_attachment,
		    'main_contact_person' => $this->input->post('main_contact_person'),
		    'contact_person' => $this->input->post('contact_person'),
		    'vertical' => $this->input->post('vertical'),
		    'subverticals' => $this->input->post('subverticals'),
		    'regions' => $this->input->post('regions'),
		    'register_time' => strtotime(date('d F Y g:i a')),
		    'ip_address' => $this->input->server('REMOTE_ADDR'),
		    'status' => '1'
		);

		return $this->db->insert('company', $company_details);
	    }
	}
    }

    function get_company($company_id)
    {
	return $this->db->get_where('company', array('id' => $company_id))->row();
    }

    function update_company()
    {

	if(!empty($_FILES['company_attachment']['name']))
	{

	    $config['upload_path']	 = './uploads/company/';
	    $config['allowed_types'] = config('allowed_extensions');
	    $config['max_size']	 = config('max_upload_file_size');
	    $config['encrypt_name']	 = TRUE;

	    $this->load->library('upload', $config);

	    if(!$this->upload->do_upload('company_attachment'))
	    {

		echo $this->upload->display_errors();
	    }
	    else
	    {
		$company_data = $this->upload->data();

		$company_attachment = $company_data['file_name'];
	    }
	}
	else
	{
	    $company_attachment = $this->input->post('attach_file');
	}

	if(empty($_FILES['company_avatar']['name']))
	{


	    $company_details = array(
		'name' => $this->input->post('name'),
		'address' => $this->input->post('address'),
		'website' => $this->input->post('website'),
		'phone' => $this->input->post('phone'),
		'mobile' => $this->input->post('mobile'),
		'fax' => $this->input->post('fax'),
		'country_id' => $this->input->post('country_id'),
		'state_id' => $this->input->post('state_id'),
		'city_id' => $this->input->post('city_id'),
		'annual_turnover' => $this->input->post('annual_turnover'),
		'main_contact_person' => $this->input->post('main_contact_person'),
		'contact_person' => $this->input->post('contact_person'),
		'number_employees' => $this->input->post('number_employees'),
		'domestic_branches' => $this->input->post('domestic_branches'),
		'int_branches' => $this->input->post('int_branches'),
		'email' => $this->input->post('email'),
		'company_attachment' => $company_attachment,
		'vertical' => $this->input->post('vertical'),
		'subverticals' => $this->input->post('subverticals'),
		'regions' => $this->input->post('regions'),
		'status' => '1'
	    );

	    return $this->db->update('company', $company_details, array('id' => $this->input->post('company_id')));
	}
	else
	{


	    $config['upload_path']	 = './uploads/company/';
	    $config['allowed_types'] = config('allowed_extensions');
	    $config['max_size']	 = config('max_upload_file_size');
	    $config['encrypt_name']	 = TRUE;

	    $this->load->library('upload', $config);

	    if(!$this->upload->do_upload('company_avatar'))
	    {

		echo $this->upload->display_errors();
	    }
	    else
	    {
		$img_data = $this->upload->data();

		//Unlink Old image
		$img_name = $this->customers_model->get_company($this->input->post('company_id'));
		unlink('./uploads/company/' . $img_name->company_avatar);

		$company_details = array(
		    'name' => $this->input->post('name'),
		    'address' => $this->input->post('address'),
		    'website' => $this->input->post('website'),
		    'phone' => $this->input->post('phone'),
		    'mobile' => $this->input->post('mobile'),
		    'fax' => $this->input->post('fax'),
		    'country_id' => $this->input->post('country_id'),
		    'state_id' => $this->input->post('state_id'),
		    'city_id' => $this->input->post('city_id'),
		    'annual_turnover' => $this->input->post('annual_turnover'),
		    'number_employees' => $this->input->post('number_employees'),
		    'domestic_branches' => $this->input->post('domestic_branches'),
		    'int_branches' => $this->input->post('int_branches'),
		    'email' => $this->input->post('email'),
		    'company_avatar' => $img_data['file_name'],
		    'company_attachment' => $company_attachment,
		    'main_contact_person' => $this->input->post('main_contact_person'),
		    'contact_person' => $this->input->post('contact_person'),
		    'vertical' => $this->input->post('vertical'),
		    'subverticals' => $this->input->post('subverticals'),
		    'regions' => $this->input->post('regions'),
		    'status' => '1'
		);

		return $this->db->update('company', $company_details, array('id' => $this->input->post('company_id')));
	    }
	}
    }

    function total_customers()
    {
	$this->db->order_by("id", "desc");
	$this->db->from('customer');

	return count($this->db->get()->result());
    }

    function company_list()
    {
	$this->db->order_by("name", "desc");
	$this->db->from('company');

	return $this->db->get()->result();
    }

    function company_contact_list()
    {
	$this->db->order_by("company.name", "desc");
	$this->db->select('company.id,company.name,company.phone,company.company_attachment,company.main_contact_person');
	$this->db->from('company');


	return $this->db->get()->result();
    }

    function get_contact_person($contact_person, $field)
    {
	$this->db->select($field);
	$this->db->from('customer');
	$this->db->where('id', $contact_person);


	return $this->db->get()->row()->$field;
    }

    function delete($company_id)
    {
	$img_name = $this->customers_model->get_company($company_id);
	unlink('./uploads/company/' . $img_name->company_avatar);

	if($this->db->delete('company', array('id' => $company_id)))  // Delete customer
	{
	    return true;
	}
    }

    function contact_persons_list()
    {

	$this->db->order_by("id", "desc");
	$this->db->from('customer');

	return $this->db->get()->result();
    }

    function total_salesorders($customer_id)
    {

	$this->db->where(array('quot_or_order' => 'o', 'customer_id' => $customer_id));
	$this->db->order_by("id", "desc");
	$this->db->from('quotations_salesorder');

	return count($this->db->get()->result());
    }

    function total_quotations($customer_id)
    {

	$this->db->where(array('quot_or_order' => 'q', 'customer_id' => $customer_id));
	$this->db->order_by("id", "desc");
	$this->db->from('quotations_salesorder');

	return count($this->db->get()->result());
    }

    function total_calls($customer_id)
    {

	$this->db->where(array('company_id' => $customer_id));
	$this->db->order_by("id", "desc");
	$this->db->from('calls');

	return count($this->db->get()->result());
    }

    function total_invoices($customer_id)
    {

	$this->db->where(array('customer_id' => $customer_id));
	$this->db->order_by("id", "desc");
	$this->db->from('invoices');

	return count($this->db->get()->result());
    }

    function total_meetings($customer_id)
    {

	$this->db->order_by("id", "desc");
	$this->db->from('meetings');

	$meetings_res	 = $this->db->get()->result();
	$total		 = 0;

	foreach($meetings_res as $meetings)
	{
	    $b = explode(',', $meetings->attendees);
	    if(in_array($customer_id, $b))
	    {
		$total++;
	    }
	}
	return $total;
    }

    function total_sales_collection($customer_id)
    {

	$this->db->select_sum('grand_total');
	$this->db->from('invoices');
	$this->db->where(array('customer_id' => $customer_id));
	$query		 = $this->db->get();
	$total_sold	 = $query->row()->grand_total;

	if($total_sold > 0)
	{
	    return $total_sold;
	}

	return '0';
    }

    function country_list()
    {
	$this->db->order_by("name", "asc");
	$this->db->from('countries');

	return $this->db->get()->result();
    }

    function state_list($country_id)
    {

	$this->db->order_by("name", "asc");
	$this->db->select('states.*');
	$this->db->from('states');
	$this->db->where('country_id', $country_id);

	return $this->db->get()->result();
    }

    function city_list($state_id)
    {

	$this->db->order_by("name", "asc");
	$this->db->select('cities.*');
	$this->db->from('cities');
	$this->db->where('state_id', $state_id);

	return $this->db->get()->result();
    }

    function open_invoices_total_collection($customer_id)
    {

	$this->db->select_sum('unpaid_amount');
	$this->db->from('invoices');
	$this->db->where(array('status' => 'Open Invoice', 'customer_id' => $customer_id));
	$query		 = $this->db->get();
	$total_sold	 = $query->row()->unpaid_amount;

	if($total_sold > 0)
	{
	    return $total_sold;
	}

	return '0';
    }

    function overdue_invoices_total_collection($customer_id)
    {

	$this->db->select_sum('unpaid_amount');
	$this->db->from('invoices');
	$this->db->where(array('status' => 'Overdue Invoice', 'customer_id' => $customer_id));
	$query		 = $this->db->get();
	$total_sold	 = $query->row()->unpaid_amount;

	if($total_sold > 0)
	{
	    return $total_sold;
	}

	return '0';
    }

    function paid_invoices_total_collection($customer_id)
    {

	$this->db->select_sum('grand_total');
	$this->db->from('invoices');
	$this->db->where(array('status' => 'Paid Invoice', 'customer_id' => $customer_id));
	$query		 = $this->db->get();
	$total_sold	 = $query->row()->grand_total;

	if($total_sold > 0)
	{
	    return $total_sold;
	}

	return '0';
    }

    function quotations_total_collection($customer_id)
    {

	$this->db->select_sum('grand_total');
	$this->db->from('quotations_salesorder');
	$this->db->where(array('quot_or_order' => 'q', 'customer_id' => $customer_id));
	$query		 = $this->db->get();
	$total_sold	 = $query->row()->grand_total;

	if($total_sold > 0)
	{
	    return $total_sold;
	}

	return '0';
    }

    function total_emails($customer_id)
    {

	$this->db->where(array('assign_customer_id' => $customer_id));
	$this->db->order_by("id", "desc");
	$this->db->from('emails');

	return count($this->db->get()->result());
    }

    function total_contracts($customer_id)
    {

	$this->db->where(array('company_id' => $customer_id));
	$this->db->order_by("id", "desc");
	$this->db->from('contracts');

	return count($this->db->get()->result());
    }

}

?>