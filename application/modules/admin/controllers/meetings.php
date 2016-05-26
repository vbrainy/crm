<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meetings extends CI_Controller {

    function Meetings() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("meetings_model");
		 $this->load->model("customers_model");
		 $this->load->model("staff_model");
		 $this->load->model("salesteams_model");
		  
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
				if (!check_staff_permission('meetings_read'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
			
		    	$data['meetings'] = $this->meetings_model->all_meetings_list();
		    			    	 
				$this->load->view('header');
				$this->load->view('meetings/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
			  //checking permission for staff
				if (!check_staff_permission('meetings_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
					
			   $data['companies'] = $this->customers_model->company_list();
			   
			   $data['staffs'] = $this->staff_model->staff_list(); 
		    	 
				$this->load->view('header');
				$this->load->view('meetings/add',$data);
				$this->load->view('footer');
			 
	}
	//Add Meetings
   	function add_meeting()
	{
		//checking permission for staff
				if (!check_staff_permission('meetings_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}    	  
		  
		$this->form_validation->set_rules('meeting_subject', 'Meeting Subject', 'required');
		$this->form_validation->set_rules('starting_date', 'Starting date', 'required');		
		$this->form_validation->set_rules('ending_date', 'Ending date', 'required');
		
		$startDate = strtotime($_POST['starting_date']);
		$endDate = strtotime($_POST['ending_date']);

		  
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div style="color:red;margin-left:15px;">' . validation_errors() . '</div>';
        }
        elseif ($startDate >= $endDate)
        {
			echo '<div style="color:red;margin-left:15px;">Should be greater than Start Date</div>';
		  	exit;	
		}
        else
        {
            
            if( $this->meetings_model->add_meetings())
            { 
            
              $meeting_id=$this->db->insert_id();
              
              add_notifications($this->input->post('responsible'),'New Meeting Added',$meeting_id,'meetings');
              
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	} 
	 
	
	function edit_meeting($meeting_id)
    {	
    	//checking permission for staff
				if (!check_staff_permission('meetings_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
    	 
    	
    	$data['companies'] = $this->customers_model->company_list();
				
		$data['staffs'] = $this->staff_model->staff_list(); 
		    	
		$data['salesteams'] = $this->salesteams_model->salesteams_list(); 
    
    	$data['meeting'] = $this->meetings_model->get_meeting( $meeting_id );	    	 
     
     	 
     	 
     	$this->load->view('header');
		$this->load->view('meetings/update',$data);
	    $this->load->view('footer');
        
    	
   	}
   	
   	function edit_meeting_process()
    {
    	//checking permission for staff
				if (!check_staff_permission('meetings_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}	
    	
    	$this->form_validation->set_rules('meeting_subject', 'Meeting Subject', 'required');
		$this->form_validation->set_rules('starting_date', 'Starting date', 'required');		
		$this->form_validation->set_rules('ending_date', 'Ending date', 'required');
		
		$startDate = strtotime($_POST['starting_date']);
		$endDate = strtotime($_POST['ending_date']);

		   
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div style="color:red;margin-left:15px;">' . validation_errors() . '</div>';
        }
        elseif ($startDate >= $endDate)
        {
			echo '<div style="color:red;margin-left:15px;">Should be greater than Start Date</div>';
		  	exit;	
		}
        else
        {
            
            if( $this->meetings_model->edit_meetings())
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
     * deletes Meetings     *  
     */
	function meeting_delete( $meeting_id )
	{
		//checking permission for staff
				if (!check_staff_permission('meetings_delete'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
		 
			if( $this->meetings_model->delete($meeting_id) )
			{
				echo 'deleted';
			}
		
	}
	 
}
