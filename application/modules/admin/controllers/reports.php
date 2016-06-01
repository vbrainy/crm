<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class reports extends CI_Controller
{

    function reports()
    {
	parent::__construct();
	$this->load->database();
	$this->load->model("report_model");

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
	$data['reports'] = $this->report_model->reports_list();

	$this->load->view('header');
	$this->load->view('reports/index', $data);
	$this->load->view('footer');
    }

    function add()
    {

	$this->load->view('header');
	$this->load->view('reports/add');
	$this->load->view('footer');
    }

    function add_process()
    {

	check_login();
	if($this->form_validation->run('create_report_errors') == FALSE)
	{
	    echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">', '</li>') . '</ul></div>';
	}
	else
	{

	    if($this->report_model->add_report_error())
	    {
		$subject = 'Report Error';
		$message = 'Hello Admin, Some one has reported the error. Find details as below <br><br>';
		$message .= 'Module Name : ' . $this->input->post('module_name') . "<br>";
		$message .= 'Comment : ' . $this->input->post('comment') . "<br>";

		//send_notice($this->input->post('email'), $subject, $message);
		echo '<div class="alert alert-success">' . $this->lang->line('report_create_succesful') . '</div>';
	    }
	    else
	    {
		echo $this->lang->line('technical_problem');
	    }
	}
    }

    function update_status()
    {
	if($this->report_model->update_report_status1())
	{
	    echo '<div class="alert alert-success">' . $this->lang->line('report_status_updated') . '</div>';
	}
	else
	{
	    echo $this->lang->line('technical_problem');
	}
    }

}
