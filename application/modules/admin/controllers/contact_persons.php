<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_persons extends CI_Controller {

    function Contact_persons() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("contact_persons_model");
		 $this->load->model("customers_model"); 
		 $this->load->model("segments_model");
		  
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
		    	$data['contact_persons'] = $this->contact_persons_model->contact_persons_list();
		    			    	 
				$this->load->view('header');
				$this->load->view('contact_persons/index',$data);
				$this->load->view('footer');
			 
	}
	function add()
	{
				$data['segments'] = $this->segments_model->segments_list();
		    	$data['companies'] = $this->customers_model->company_list(); 
		    	 
				$this->load->view('header');
				$this->load->view('contact_persons/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
		    	  
		check_login();  
		
		if( $this->form_validation->set_rules('email', 'Email', 'required') == FALSE )
		
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
        }
        elseif( $this->contact_persons_model->exists_email( $this->input->post('email') ) > 0)
        {
            echo '<div class="alert error">Email already used.</div>';
        }
        else
        {
            
            if( $this->contact_persons_model->add_contact_persons())
            {
            	$subject = 'Customer login details';
           		$message = 'Hello,  <br><br><b>Email:</b> '.$this->input->post('email').'. <br>Please Verify your Information';
             
			     send_notice($this->input->post('email'),$subject,$message);
            	
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
            }
            else 
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	}
	
	function view($customer_id)
	{
		    	  
				$data['contact_person'] = $this->contact_persons_model->get_contact_persons( $customer_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('contact_persons/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($customer_id)
	{
				$data['companies'] = $this->customers_model->company_list();
				
				$data['segments'] = $this->segments_model->segments_list();
				
		    	$data['contact_person'] = $this->contact_persons_model->get_contact_persons( $customer_id );	
		    	
		    	$data['main_contact'] = $this->customers_model->get_company($data['contact_person']->company); 
		    	 
				$this->load->view('header');
				$this->load->view('contact_persons/update',$data);
				$this->load->view('footer');
			 
	}
	
	function update_process()
	{
		check_login();   
		
		if( $this->form_validation->set_rules('email', 'Email', 'required') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li>','</li>') . '</ul></div>';
        }
        else
        {
            
            if( $this->contact_persons_model->update_contact_person() )
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
     * deletes contact person
     * @param  a user id integer
     * @return string for ajax
     */
	function delete( $contact_person_id )
	{
		check_login();  
		 
			if( $this->contact_persons_model->delete($contact_person_id) )
			{
				echo 'deleted';
			}
		
	}
	
	
	function add_process_ajax()
	{
		    	  
		check_login();  
		
		if( $this->form_validation->set_rules('email', 'Email', 'required') == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
        }
        elseif( $this->contact_persons_model->exists_email( $this->input->post('email') ) > 0)
        {
            echo '<div class="alert error">Email already used.</div>';
        }
        else
        {
            
            if( $this->contact_persons_model->add_contact_persons())
            {
            	$contact_person_id = $this->db->insert_id();
            	
            	$data['contact_person'] = $this->contact_persons_model->get_contact_persons( $contact_person_id );	
            		
            	$subject = 'Customer login details';
           		$message = 'Hello,  <br><br><b>Email:</b> '.$this->input->post('email').'. <br>Please Verify your Information';
             
			    send_notice($this->input->post('email'),$subject,$message);
            	
                //echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
                $details=array();
		
				$details['co_person_id']=$contact_person_id;
				$details['co_person_name']=$data['contact_person']->first_name.' '.$data['contact_person']->last_name; 
				
				echo json_encode($details);
                
            }
            else
            {
                echo $this->lang->line('technical_problem');
            }
        }
			 
	} 
}