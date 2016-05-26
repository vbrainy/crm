<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leads extends CI_Controller {

    function Leads() 
    {	
         parent::__construct();
		 $this->load->database();
		 $this->load->model("leads_model");
		 $this->load->model("customers_model");
		  $this->load->model("contact_persons_model");
		 $this->load->model("staff_model");
		 $this->load->model("segments_model");	
		 $this->load->model("sources_model");	  
         $this->load->model("calls_model");          
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
			if (!check_staff_permission('lead_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}
			
			
		    	$data['leads'] = $this->leads_model->leads_list(userdata('id'));
		    			    	 
				$this->load->view('header');
				$this->load->view('leads/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
				//checking permission for staff
				if (!check_staff_permission('lead_write'))	
				{
				redirect(base_url('admin/access_denied'), 'refresh');  
				} 
			 
		    	$data['companies'] = $this->customers_model->company_list();
		    	
		    	$data['countries'] = $this->leads_model->country_list(); 
		    	
		    	$data['staffs'] = $this->staff_model->staff_list(); 
		    	
		    	$data['segments'] = $this->segments_model->segments_list(); 
		    	$data['sources'] = $this->sources_model->sources_list();
		 
		    	 
				$this->load->view('header');
				$this->load->view('leads/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		    	  
		//checking permission for staff
		 if (!check_staff_permission('lead_write'))	
		 {
				redirect(base_url('admin/access_denied'), 'refresh');  
		 }
		
		$this->form_validation->set_rules('opportunity', 'Opportunity', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email');
		$this->form_validation->set_rules('customer', 'Customer', 'required'); 
		$this->form_validation->set_rules('segment_id', 'Segment', 'required'); 
		 
				 
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
        }
        elseif( $this->leads_model->exists_email( $this->input->post('email') ) > 0)
        {
            echo '<div class="alert error">Email already used.</div>';
        }
        else
        {
            
            if( $this->leads_model->add_leads())
            { 
            	 
               //redirect("admin/leads/update/".$this->db->insert_id());               
              // echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
              $lead_id=$this->db->insert_id();
              
              add_notifications($this->input->post('salesperson_id'),'New Lead Added',$lead_id,'leads');
             
               echo 'yes_'.$lead_id;
                
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($lead_id)
	{
				//checking permission for staff
				if (!check_staff_permission('lead_read'))	
		 		{
					redirect(base_url('admin/access_denied'), 'refresh');  
		 		} 
				 
				
		    	$data['companies'] = $this->customers_model->company_list();
		    	$data['staffs'] = $this->staff_model->staff_list();		    			    	
		    	$data['calls'] = $this->calls_model->calls_list($lead_id,$type='leads'); 
		    	$data['segments'] = $this->segments_model->segments_list(); 
		    	$data['sources'] = $this->sources_model->sources_list();
		    	$data['contact_persons'] = $this->contact_persons_model->contact_persons_list();
		    	  
				$data['lead'] = $this->leads_model->get_lead( $lead_id,userdata('id') );	 
		    	 
				$this->load->view('header');
				$this->load->view('leads/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($lead_id)
	{
				//checking permission for staff
				if (!check_staff_permission('lead_write'))	
		 		{
					redirect(base_url('admin/access_denied'), 'refresh');  
		 		} 
				
				 
				
				$data['companies'] = $this->customers_model->company_list();
		    	$data['countries'] = $this->leads_model->country_list();
		    	$data['staffs'] = $this->staff_model->staff_list();		    	
		    	$data['segments'] = $this->segments_model->segments_list();
		    	$data['sources'] = $this->sources_model->sources_list();
		    	$data['contact_persons'] = $this->contact_persons_model->contact_persons_list();
		    	
		    	$data['calls'] = $this->calls_model->calls_list($lead_id,$type='leads');    
		    	
		    	$data['lead'] = $this->leads_model->get_lead( $lead_id,userdata('id'));	 				
		    	  
		    	 
				$this->load->view('header');
				$this->load->view('leads/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		//checking permission for staff
		 if (!check_staff_permission('lead_write'))	
	 		{
				redirect(base_url('admin/access_denied'), 'refresh');  
	 		}   
		
		$this->form_validation->set_rules('opportunity', 'Opportunity', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email');
		$this->form_validation->set_rules('customer', 'Customer', 'required'); 
		$this->form_validation->set_rules('segment_id', 'Segment', 'required');
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert alert-danger"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        else
        {
            
            if( $this->leads_model->update_leads() )
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
     * deletes lead     *  
     */
	function delete( $lead_id )
	{
		//checking permission for staff
		 if (!check_staff_permission('lead_delete'))	
	 		{
				redirect(base_url('admin/access_denied'), 'refresh');  
	 		} 	
	 			 
			if( $this->leads_model->delete($lead_id) )
			{
				echo 'deleted';
			}
		
	}
	
	
   	
   	
   	//Add Call
   	function add_call()
	{
		    
		$this->form_validation->set_rules('date', 'Date', 'required');
		
		$this->form_validation->set_rules('call_summary', 'Call Summary', 'required');
		 
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div style="color:red;margin-left:15px;">' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->calls_model->add_calls())
            { 
            	echo 'yes';
                //echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	/*
     * deletes call     *  
     */
	function call_delete( $call_id )
	{
		check_login();  
		 
			if( $this->calls_model->delete($call_id) )
			{
				echo 'deleted';
			}
		
	}
	
	
    function edit_call($call_id)
    {	
    	$data['companies'] = $this->customers_model->company_list();
				
		$data['staffs'] = $this->staff_model->staff_list(); 
	
    	$data['call'] = $this->calls_model->get_call( $call_id );	    	 
     $data['sources'] = $this->sources_model->sources_list();
     $data['contact_persons'] = $this->contact_persons_model->contact_persons_list();
     	 
     	 
     	$this->load->view('header');
		$this->load->view('opportunities/edit_call',$data);
	    $this->load->view('footer');
        
    	
   	}
   	
   	function edit_call_process()
    {
    	$this->form_validation->set_rules('date', 'Date', 'required');
    	
    	$this->form_validation->set_rules('call_summary', 'Call Summary', 'required');
		 
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div style="color:red;margin-left:15px;">' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->calls_model->edit_calls())
            { 
                echo '<div style="margin-left:15px;">'.$this->lang->line('update_succesful').'</div>';
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
    	
    }
    
    function convert_to_opportunity()
	{
		    
		   
		    
            if( $this->leads_model->add_convert_to_opportunity())
            { 
            	 
              // redirect("admin/opportunities/update/".$this->db->insert_id());              		  
              echo 'yes_'.$this->db->insert_id();	
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        	 
	}
	 
}