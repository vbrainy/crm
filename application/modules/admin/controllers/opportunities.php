<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Opportunities extends CI_Controller {

    function Opportunities() 
    {
         parent::__construct();
		 $this->load->database();
		 $this->load->model("opportunities_model");
		 $this->load->model("customers_model");
		 $this->load->model("staff_model");
		 $this->load->model("segments_model");
		 $this->load->model("subverticals_model");
		 $this->load->model("vertical_model");
		 $this->load->model("regions_model");
		 $this->load->model("calls_model");
		 $this->load->model("meetings_model"); 
		  $this->load->model("sources_model");
		  $this->load->model("contact_persons_model");
		  $this->load->model("products_model");
		  $this->load->model("category_model");
		 
				
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
			if (!check_staff_permission('opportunities_read'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			} 
	    	$data['opportunities'] = $this->opportunities_model->opportunities_list(userdata('id'));
			//print_r($data);		    exit;
			$this->load->view('header');
			$this->load->view('opportunities/index',$data);
			$this->load->view('footer');
			 
	}
	function add()
	{
				//checking permission for staff
				 if (!check_staff_permission('opportunities_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
			
		    	$data['companies'] = $this->customers_model->company_list();
		    	$data['staffs'] = $this->staff_model->staff_list(); 
		    	$data['verticals'] = $this->vertical_model->vertical_list();
		    	$data['segments'] = $this->segments_model->segments_list(); 
		    	$data['subverticals'] = $this->subverticals_model->subverticals_list();
		    	$data['regions'] = $this->regions_model->regions_list();
		    	$data['sources'] = $this->sources_model->sources_list();
		    	$data['contact_persons'] = $this->contact_persons_model->contact_persons_list();
		    	$data['products'] = $this->products_model->products_list();
		    	$data['categories'] = $this->category_model->category_list();
				$this->load->view('header');
				$this->load->view('opportunities/add',$data);
				$this->load->view('footer');
			 
	}
	function add_process()
	{
				//checking permission for staff
				  if (!check_staff_permission('opportunities_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}   
				 
				$this->form_validation->set_rules('opportunity', 'Opportunity', 'required');
				$this->form_validation->set_rules('next_action_title', 'Next Action', 'required'); 		
				$this->form_validation->set_rules('identified_date', 'Identified Date', 'required'); 
				$this->form_validation->set_rules('next_action', 'Next Action Date', 'required'); 
				$this->form_validation->set_rules('expected_closing', 'Expected Closing', 'required'); 
				$this->form_validation->set_rules('salesperson_id', 'Sales Person', 'required');  			
				//$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email');
				
				$this->form_validation->set_rules('customer', 'Customer', 'required'); 
				//$this->form_validation->set_rules('segments_id', 'Segment', 'required');		
				$this->form_validation->set_rules('product_id', 'Product', 'required'); 
				$this->form_validation->set_rules('category_id', 'Category', 'required'); 
				
				/*echo $product = $this->input->post('product');
				$category = strtolower($this->input->post('category'));
				switch ($product) {

				case 'gsm':
                	if($category == 'new activations pre-paid')
                	{

                		//$this->form_validation->set_rules('new_act_pre_paid_voice_qty', 'Voice Qty', 'required'); 
                		// $productOptions['voice_qty'] = $this->input->post('new_act_pre_paid_voice_qty');
                		// $productOptions['voice_one_time_fee'] = $this->input->post('new_act_pre_paid_voice_one_time_fee');
                		// $productOptions['voice_annual_rec_fee'] = $this->input->post('new_act_pre_paid_voice_annual_rec_fee');

                		// $productOptions['data_qty'] = $this->input->post('new_act_pre_paid_data_qty');
                		// $productOptions['data_one_time_fee'] = $this->input->post('new_act_pre_paid_data_one_time_fee');
                		// $productOptions['data_annual_rec_fee'] = $this->input->post('new_act_pre_paid_data_annual_rec_fee');

                		// $productOptions['bundle_qty'] = $this->input->post('new_act_pre_paid_bundle_qty');
                		// $productOptions['bundle_one_time_fee'] = $this->input->post('new_act_pre_paid_bundle_one_time_fee');
                		// $productOptions['bundle_annual_rec_fee'] = $this->input->post('new_act_pre_paid_bundle_annual_rec_fee');
                	}
                }
*/
				if( $this->form_validation->run() == FALSE )
		        {
		            echo '<div class="alert"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
		        }
		        /*elseif( $this->opportunities_model->exists_email( $this->input->post('email') ) > 0)
		        {
		            echo '<div class="alert alert-danger">Email already used.</div>';
		        }*/
		        else
		        {

		            if( $this->opportunities_model->add_opportunities())
		            { 
		            
		            	$opportunity_id=$this->db->insert_id();
              
             			 add_notifications($this->input->post('salesperson_id'),'New Opportunities Added',$opportunity_id,'opportunities');
              	
		                //echo 'yes_'.$opportunity_id;
		                echo  '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
		            }
		            else
		            {
		                echo $this->lang->line('technical_problem');
		            }
		        }
			 
	}
	
	function view($opportunity_id)
	{
				//checking permission for staff
				 if (!check_staff_permission('opportunities_read'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				}
				
				 
				
				$data['companies'] = $this->customers_model->company_list();
				
				$data['staffs'] = $this->staff_model->staff_list(); 
		    	 
		    	$data['calls'] = $this->calls_model->calls_list($opportunity_id,$type='opportunities');  
	
				$data['meetings'] = $this->meetings_model->meetings_list($opportunity_id,$type='opportunities');  
				$data['verticals'] = $this->vertical_model->vertical_list();
		     $data['segments'] = $this->segments_model->segments_list();
		    	$data['subverticals'] = $this->subverticals_model->subverticals_list();
		    	$data['regions'] = $this->regions_model->regions_list();
		    	$data['sources'] = $this->sources_model->sources_list();
		    	$data['contact_persons'] = $this->contact_persons_model->contact_persons_list();
					  
		    	  
				$data['opportunity'] = $this->opportunities_model->get_opportunities( $opportunity_id );	 
		    	 
				$this->load->view('header');
				$this->load->view('opportunities/view',$data);
				$this->load->view('footer');
			 
	}
	
	function update($opportunity_id)
	{
			//checking permission for staff
				if (!check_staff_permission('opportunities_write'))	
				{
					redirect(base_url('admin/access_denied'), 'refresh');  
				} 
				 
				
				$data['companies'] = $this->customers_model->company_list();
				
				$data['staffs'] = $this->staff_model->staff_list(); 
		    	
		    	$data['segments'] = $this->segments_model->segments_list();
		    	$data['calls'] = $this->calls_model->calls_list($opportunity_id,$type='opportunities');  
	
				$data['meetings'] = $this->meetings_model->meetings_list($opportunity_id,$type='opportunities');  
					    	 
		    	$data['opportunity'] = $this->opportunities_model->get_opportunities( $opportunity_id );
		    	$data['verticals'] = $this->vertical_model->vertical_list();
		     
		    	$data['subverticals'] = $this->subverticals_model->subverticals_list();
		    	$data['regions'] = $this->regions_model->regions_list();	
		    	 $data['sources'] = $this->sources_model->sources_list();
		    	$data['contact_persons'] = $this->contact_persons_model->contact_persons_list();
		    	 $data['products'] = $this->products_model->products_list();
		    	$data['categories'] = $this->category_model->get_product_category($data['opportunity']->product_id);
		    	//echo "<pre>";
		    	//print_r($data['opportunity']);exit;
				$this->load->view('header');
				$this->load->view('opportunities/update',$data);
			    $this->load->view('footer');
			 
	}
	
	function update_process()
	{
		//checking permission for staff
		if (!check_staff_permission('opportunities_write'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}		   
		
		$this->form_validation->set_rules('opportunity', 'Opportunity', 'required');
		//$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|htmlspecialchars|max_length[50]|valid_email');
		$this->form_validation->set_rules('customer', 'Customer', 'required'); 
		$this->form_validation->set_rules('salesperson_id', 'Sales Person', 'required');
		//$this->form_validation->set_rules('segment_id', 'Segment', 'required');  
		$this->form_validation->set_rules('next_action', 'Next Action Date', 'required'); 
		$this->form_validation->set_rules('expected_closing', 'Expected Closing', 'required'); 
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div class="alert error"><ul>' . validation_errors('<li style="color:red">','</li>') . '</ul></div>';
        }
        else
        {
            
            if( $this->opportunities_model->update_opportunities() )
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
     * deletes opportunity     *  
     */
	function delete( $opportunity_id )
	{
		//checking permission for staff
		if (!check_staff_permission('opportunities_delete'))	
			{
				redirect(base_url('admin/access_denied'), 'refresh');  
			}		    
		 
			if( $this->opportunities_model->delete($opportunity_id) )
			{
				echo 'deleted';
			}
		
	}	
	
	//Add Call
   	function add_call()
	{
		    	  
		check_login(); 
		
		$this->form_validation->set_rules('call_summary', 'Call Summary', 'required');
		 
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div style="color:red;margin-left:15px;">' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->calls_model->add_calls())
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
	
	
	//Add Meetings
   	function add_meeting()
	{
		    	  
		  
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
                echo '<div class="alert alert-success">'.$this->lang->line('create_succesful').'</div>';
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
		check_login();  
		 
			if( $this->meetings_model->delete($meeting_id) )
			{
				echo 'deleted';
			}
		
	}
	
	function edit_meeting($meeting_id)
    {	
    	$data['companies'] = $this->customers_model->company_list();
				
		$data['staffs'] = $this->staff_model->staff_list(); 
		    	
		$data['segments'] = $this->segments_model->segments_list(); 
    
    	$data['meeting'] = $this->meetings_model->get_meeting( $meeting_id );	    	 
     
     	 
     	 
     	$this->load->view('header');
		$this->load->view('opportunities/edit_meeting',$data);
	    $this->load->view('footer');
        
    	
   	}
   	
   	function edit_meeting_process()
    {
    
    	
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
    
    
    function edit_call($call_id)
    {	
    	$data['companies'] = $this->customers_model->company_list();
				
		$data['staffs'] = $this->staff_model->staff_list(); 
	
    	$data['call'] = $this->calls_model->get_call( $call_id );	    	 
     
     	 
     	 
     	$this->load->view('header');
		$this->load->view('opportunities/edit_call',$data);
	    $this->load->view('footer');
        
    	
   	}
   	
   	function edit_call_process()
    {
    	
    	$this->form_validation->set_rules('call_summary', 'Call Summary', 'required');
		 
		
		if( $this->form_validation->run() == FALSE )
        {
            echo '<div style="color:red;margin-left:15px;">' . validation_errors() . '</div>';
        }
        else
        {
            
            if( $this->calls_model->edit_calls())
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
     * confirm sale*  
     */
	function convert_to_quotation( $opportunity_id )
	{
		if( $this->opportunities_model->convert_to_quotation($opportunity_id))
		{
			$quotation_id = $this->db->insert_id();
			redirect('admin/quotations/update/'.$quotation_id);
		}
		   
	} 
	
	
      

}