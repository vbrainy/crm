<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class report_model extends CI_Model
{

    function __construct()
    {
	parent::__construct();
    }

    function add_report_error()
    {
	$error_details = array(
	    'user_id' => $this->session->userdata('id'),
	    'module_title' => $this->input->post('module_name'),
	    'comment' => $this->input->post('comment'),
	    'created_datetime' => date('d F Y g:i a'),
	    'status' => '0'
	);

	$report_error_res	 = $this->db->insert('reports_errors', $error_details);
	$report_error_id	 = $this->db->insert_id();
	return $report_error_res;
    }

    function reports_list()
    {
	$this->db->order_by("id", "desc");
	$this->db->from('reports_errors');

	return $this->db->get()->result();
    }

    function update_report_status1()
    {
	$report_id	 = $this->input->get('report_id');
	$status		 = $this->input->get('status');
	return $this->db->update('reports_errors', array('status' => $status), array('id' => $report_id));
    }

}
