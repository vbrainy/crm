<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller {

    function Staff() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("segments_model");
		 $this->load->model("staff_model");
		 $this->load->model("regions_model");

	  
         $this->load->library('form_validation');
         
         /*cache control*/
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
         
         check_login();  
    }

	function index()
	{	
			//checking permission for staff
			if (!check_staff_permission('staff_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}   
		
		   		$data['staffs'] = $this->staff_model->staff_list();
		     
				$this->load->view('header');
				$this->load->view('staff/staff_list',$data);
				$this->load->view('footer');
			 
	}
	
	function add()
	{	 
		    //checking permission for staff
			if (!check_staff_permission('staff_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}   
				$data['segments'] = $this->segments_model->segments_list(); 
		    	$data['regions'] = $this->regions_model->regions_list();

				$this->load->view('header');
				$this->load->view('staff/add_staff');
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		//checking permission for staff
			if (!check_staff_permission('staff_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}  
		
		if( $this->form_validation->run('add_staff') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
        }
        elseif( $this->staff_model->exists_email( $this->input->post('email') ) > 0)
        {
            echo '<div class="alert error">Email already used.</div>';
        }
        else
        {
            
            if( $this->staff_model->add_staff() )
            {
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
				
	}
	
	/*
     * Displays member update form
     */
	function update( $staff_id )
	{
		//checking permission for staff
			if (!check_staff_permission('staff_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
		
		if( $staff_id == '1' )
        {
            
            $this->session->set_flashdata('message', '<div class="alert media fade in alert-danger" style="text-align: center;">You can not update admin</div>');
            redirect('admin/staff', 'refresh');
        }
        else
        {
			$data['staff'] = $this->staff_model->get_user( $staff_id );		

				$data['segments'] = $this->segments_model->segments_list(); 
		    	$data['regions'] = $this->regions_model->regions_list();

			$this->load->view('header');
			$this->load->view('staff/update_staff',$data);
			$this->load->view('footer');
		}
		
		
	}
	/*
     * update processing
     */
	function update_process()
	{
		//checking permission for staff
			if (!check_staff_permission('staff_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			} 
		
		if( $this->form_validation->run('update_staff') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        else
        {
            
            if( $this->staff_model->update_staff() )
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
     * deletes user
     * @param  a user id integer
     * @return string for ajax
     */
	function delete( $staff_id )
	{
		//checking permission for staff
			if (!check_staff_permission('staff_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}  
		 
			if( $this->staff_model->delete($staff_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}
