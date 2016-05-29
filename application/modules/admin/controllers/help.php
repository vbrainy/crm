<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class help extends CI_Controller
{

    function help()
    {
	parent::__construct();
	$this->load->database();
	$this->load->model("help_model");

	$this->load->library('form_validation');

	/* cache control */
	$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	$this->output->set_header('Pragma: no-cache');
	$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	check_login();
    }

    function add()
    {

	$this->load->view('header');
	$this->load->view('help/add');
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

	    if($this->help_model->add_report_error())
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

}
