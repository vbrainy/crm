<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class opportunities_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function exists_email( $email )
    {
		$email_count = $this->db->get_where('opportunities',array('email' => $email))->num_rows();
		return $email_count;
        
    }
    
    function add_opportunities()
    {
    		$tags_value= implode(',',$this->input->post('tags'));
    		if( empty( $tags_value ))
			{
			    $tags='';
			}
			else
			{
				$tags=$tags_value;
			}

			$product = $this->input->post('product');
			//echo "<br/>";
			$category = strtolower($this->input->post('category'));
			
			$productOptions = [];
			//print_R($_POST);
            //exit;
			switch ($product) {
				case 'gsm':
                	if($category == 'new activations pre-paid')
                	{
                		$productOptions['voice_qty'] = $this->input->post('new_act_pre_paid_voice_qty');
                		$productOptions['voice_one_time_fee'] = $this->input->post('new_act_pre_paid_voice_one_time_fee');
                		$productOptions['voice_annual_rec_fee'] = $this->input->post('new_act_pre_paid_voice_annual_rec_fee');

                		$productOptions['data_qty'] = $this->input->post('new_act_pre_paid_data_qty');
                		$productOptions['data_one_time_fee'] = $this->input->post('new_act_pre_paid_data_one_time_fee');
                		$productOptions['data_annual_rec_fee'] = $this->input->post('new_act_pre_paid_data_annual_rec_fee');

                		$productOptions['bundle_qty'] = $this->input->post('new_act_pre_paid_bundle_qty');
                		$productOptions['bundle_one_time_fee'] = $this->input->post('new_act_pre_paid_bundle_one_time_fee');
                		$productOptions['bundle_annual_rec_fee'] = $this->input->post('new_act_pre_paid_bundle_annual_rec_fee');
                	}
					else if($category == 'new activations post-paid')
                	{
                		$productOptions['voice_qty'] = $this->input->post('new_act_post_paid_voice_qty');
                		$productOptions['voice_one_time_fee'] = $this->input->post('new_act_post_paid_voice_one_time_fee');
                		$productOptions['voice_annual_rec_fee'] = $this->input->post('new_act_post_paid_voice_annual_rec_fee');

                		$productOptions['data_qty'] = $this->input->post('new_act_post_paid_data_qty');
                		$productOptions['data_one_time_fee'] = $this->input->post('new_act_post_paid_data_one_time_fee');
                		$productOptions['data_annual_rec_fee'] = $this->input->post('new_act_post_paid_data_annual_rec_fee');

                		$productOptions['bundle_qty'] = $this->input->post('new_act_post_paid_bundle_qty');
                		$productOptions['bundle_one_time_fee'] = $this->input->post('new_act_post_paid_bundle_one_time_fee');
                		$productOptions['bundle_annual_rec_fee'] = $this->input->post('new_act_post_paid_bundle_annual_rec_fee');
                	}
                	else if($category == 'mnp pre-paid')
                	{
                		$productOptions['voice_qty'] = $this->input->post('mnp_pre_paid_voice_qty');
                		$productOptions['voice_one_time_fee'] = $this->input->post('mnp_pre_paid_voice_one_time_fee');
                		$productOptions['voice_annual_rec_fee'] = $this->input->post('mnp_pre_paid_voice_annual_rec_fee');

                		$productOptions['data_qty'] = $this->input->post('mnp_pre_paid_data_qty');
                		$productOptions['data_one_time_fee'] = $this->input->post('mnp_pre_paid_data_one_time_fee');
                		$productOptions['data_annual_rec_fee'] = $this->input->post('mnp_pre_paid_data_annual_rec_fee');

                		$productOptions['bundle_qty'] = $this->input->post('mnp_pre_paid_bundle_qty');
                		$productOptions['bundle_one_time_fee'] = $this->input->post('mnp_pre_paid_bundle_one_time_fee');
                		$productOptions['bundle_annual_rec_fee'] = $this->input->post('mnp_pre_paid_bundle_annual_rec_fee');
                	}
                	else if($category == 'mnp post-paid')
                	{
                		$productOptions['voice_qty'] = $this->input->post('mnp_post_paid_voice_qty');
                		$productOptions['voice_one_time_fee'] = $this->input->post('mnp_post_paid_voice_one_time_fee');
                		$productOptions['voice_annual_rec_fee'] = $this->input->post('mnp_post_paid_voice_annual_rec_fee');

                		$productOptions['data_qty'] = $this->input->post('mnp_post_paid_data_qty');
                		$productOptions['data_one_time_fee'] = $this->input->post('mnp_post_paid_data_one_time_fee');
                		$productOptions['data_annual_rec_fee'] = $this->input->post('mnp_post_paid_data_annual_rec_fee');

                		$productOptions['bundle_qty'] = $this->input->post('mnp_post_paid_bundle_qty');
                		$productOptions['bundle_one_time_fee'] = $this->input->post('mnp_post_paid_bundle_one_time_fee');
                		$productOptions['bundle_annual_rec_fee'] = $this->input->post('mnp_post_paid_bundle_annual_rec_fee');
                	}
                break;
              	case 'solutions':
                	if($category == 'dedicated internet')
                	{
                		$productOptions['capacity_per_location'] = $this->input->post('dedi_int_capacity_per_location');
                		$productOptions['number_of_locations'] = $this->input->post('dedi_int_number_of_location');
                		$productOptions['value_per_location'] = $this->input->post('dedi_int_value_per_location');

                		$productOptions['end_location_city'] = $this->input->post('dedi_int_end_location_city');
                		$productOptions['end_location_state'] = $this->input->post('dedi_int_end_location_state');
                		$productOptions['total_installation_cost'] = $this->input->post('dedi_int_total_installation_cost');

                		$productOptions['annual_rec_fee'] = $this->input->post('dedi_int_annual_rec_fee');
                	}
                	else if($category == 'national leased lines')
                	{
                		$productOptions['number_of_locations'] = $this->input->post('national_leased_lines_number_of_locations');
                		$productOptions['a_point_location_city'] = $this->input->post('national_leased_lines_a_point_location_city');
                		$productOptions['a_point_location_state'] = $this->input->post('national_leased_lines_a_point_location_state');
                		$productOptions['b_point_location_city'] = $this->input->post('national_leased_lines_b_point_location_city');
                		$productOptions['b_point_location_state'] = $this->input->post('national_leased_lines_b_point_location_state');
                		$productOptions['capacity_required'] = $this->input->post('national_leased_lines_capacity_required');
                		$productOptions['total_installation_cost'] = $this->input->post('national_leased_lines_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('national_leased_lines_annual_rec_fee');
                		
                	}
                	else if($category == 'international leased lines')
                	{
                		$productOptions['number_of_locations'] = $this->input->post('inter_leased_lines_number_of_locations');
                		$productOptions['a_point_location_city'] = $this->input->post('inter_leased_lines_a_point_location_city');
                		$productOptions['a_point_location_state'] = $this->input->post('inter_leased_lines_a_point_location_state');

                		$productOptions['b_point_location_city'] = $this->input->post('inter_leased_lines_b_point_location_city');
                		$productOptions['b_point_location_state'] = $this->input->post('inter_leased_lines_b_point_location_state');
                		$productOptions['capacity_required'] = $this->input->post('inter_leased_lines_capacity_required');

                		$productOptions['total_installation_cost'] = $this->input->post('inter_leased_lines_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('inter_leased_lines_annual_rec_fee');
                	}
                	else if($category == 'pri')
                	{
                		$productOptions['installation_location_city'] = $this->input->post('pri_installation_location_city');
                		$productOptions['installation_location_state'] = $this->input->post('pri_installation_location_state');
                		$productOptions['number_of_dod_units'] = $this->input->post('pri_number_of_dod_units');

                		$productOptions['number_of_did_units'] = $this->input->post('pri_number_of_did_units');
                		$productOptions['total_installation_cost'] = $this->input->post('pri_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('pri_annual_rec_fee');
                	}
					else if($category == 'apn over internet')
                	{
                		$productOptions['number_of_units'] = $this->input->post('over_internet_number_of_units');
                		$productOptions['total_installation_cost'] = $this->input->post('over_internet_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('over_internet_annual_rec_fee');
                	}
                	else if($category == 'apn over leased lines')
                	{
                		$productOptions['number_of_locations'] = $this->input->post('leased_lines_number_of_locations');
                		$productOptions['a_point_location_city'] = $this->input->post('leased_lines_a_point_location_city');
                		$productOptions['a_point_location_state'] = $this->input->post('leased_lines_a_point_location_state');

                		$productOptions['b_point_location_city'] = $this->input->post('leased_lines_b_point_location_city');
                		$productOptions['b_point_location_state'] = $this->input->post('leased_lines_b_point_location_state');
                		$productOptions['capacity_required'] = $this->input->post('leased_lines_capacity_required');

                		$productOptions['total_installation_cost'] = $this->input->post('leased_lines_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('leased_lines_annual_rec_fee');
                	}
                break;              
              	case 'devices':
          			$productOptions['device_type'] = $this->input->post('dev_device_type');
            		$productOptions['number_of_units'] = $this->input->post('dev_number_of_units');
            		$productOptions['total_value'] = $this->input->post('dev_total_value');
                break;  
              	case 'valueaddedservices':
                	$productOptions['services_qty'] = $this->input->post('ser_services_qty');
            		$productOptions['services_one_time_cost'] = $this->input->post('ser_services_one_time_cost');
            		$productOptions['annual_rec_fee'] = $this->input->post('ser_annual_rec_fee');
                break; 
			}

			//print_R($productOptions);    		exit;
			$opportunity_details = array(
	            'opportunity' => $this->input->post('opportunity'),
	            'product_id' => $this->input->post('product_id'),
	            'category_id' => $this->input->post('category_id'),
	            'stages' => $this->input->post('stages'),
	            //'expected_revenue' => $this->input->post('expected_revenue'),
	            //'probability' => $this->input->post('probability'),
	            'customer' => $this->input->post('customer'),	            
	            //'email' => $this->input->post('email'),
	            //'phone' => $this->input->post('phone'),
	            'salesperson_id' => $this->input->post('salesperson_id'),
	            //'segment_id' => $this->input->post('segment_id'),
	            //'region_id' => $this->input->post('region_id'),
	            //'vertical_id' => $this->input->post('vertical_id'),
	            //'subvertical_id' => $this->input->post('subvertical_id'),
	            'next_action' => date('Y-m-d', strtotime($this->input->post('next_action'))),
	            'next_action_title' => $this->input->post('next_action_title'),
	            'expected_closing' => date('Y-m-d', strtotime($this->input->post('expected_closing'))),
	            'identified_date' => date('Y-m-d', strtotime($this->input->post('identified_date'))),
	            'closed_date' => date('Y-m-d', strtotime($this->input->post('closed_date'))),
	            //'priority' => $this->input->post('priority'),
	            //'tags' => $tags,
	            //'lost_reason' =>$this->input->post('lost_reason'),	           
	            'internal_notes' => $this->input->post('internal_notes'),
	            //'assigned_partner_id' => $this->input->post('assigned_partner_id'), 
	             //'sources' => $this->input->post('sources'),
	            //'contact_name' => $this->input->post('contact_name'),
	            'register_time' => strtotime( date('d F Y g:i a') ),
	            //'ip_address' => $this->input->server('REMOTE_ADDR')
	            );
				$this->db->insert('opportunities',$opportunity_details);
				$productOptions['opportunity_id'] = $this->db->insert_id();
				//$this->db->insert('opportunity_product_options',$productOptions);
				//echo $this->db->last_query();exit;
				return $this->db->insert('opportunity_product_options',$productOptions);
				
       	 		//return $this->db->insert('opportunities',$opportunity_details);
		 
		  
	}
	
	function update_opportunities()
    {


    		$product = strtolower($this->input->post('product'));
			//echo "<br/>";
			$category = strtolower($this->input->post('category'));

			$productOptions = [];
            //echo "<pre>";
			//print_R($_POST);exit;
			switch ($product) {
				case 'gsm':
                	if($category == 'new activations pre-paid')
                	{
                		$productOptions['voice_qty'] = $this->input->post('new_act_pre_paid_voice_qty');
                		$productOptions['voice_one_time_fee'] = $this->input->post('new_act_pre_paid_voice_one_time_fee');
                		$productOptions['voice_annual_rec_fee'] = $this->input->post('new_act_pre_paid_voice_annual_rec_fee');

                		$productOptions['data_qty'] = $this->input->post('new_act_pre_paid_data_qty');
                		$productOptions['data_one_time_fee'] = $this->input->post('new_act_pre_paid_data_one_time_fee');
                		$productOptions['data_annual_rec_fee'] = $this->input->post('new_act_pre_paid_data_annual_rec_fee');

                		$productOptions['bundle_qty'] = $this->input->post('new_act_pre_paid_bundle_qty');
                		$productOptions['bundle_one_time_fee'] = $this->input->post('new_act_pre_paid_bundle_one_time_fee');
                		$productOptions['bundle_annual_rec_fee'] = $this->input->post('new_act_pre_paid_bundle_annual_rec_fee');
                	}
					else if($category == 'new activations post-paid')
                	{
                		$productOptions['voice_qty'] = $this->input->post('new_act_post_paid_voice_qty');
                		$productOptions['voice_one_time_fee'] = $this->input->post('new_act_post_paid_voice_one_time_fee');
                		$productOptions['voice_annual_rec_fee'] = $this->input->post('new_act_post_paid_voice_annual_rec_fee');

                		$productOptions['data_qty'] = $this->input->post('new_act_post_paid_data_qty');
                		$productOptions['data_one_time_fee'] = $this->input->post('new_act_post_paid_data_one_time_fee');
                		$productOptions['data_annual_rec_fee'] = $this->input->post('new_act_post_paid_data_annual_rec_fee');

                		$productOptions['bundle_qty'] = $this->input->post('new_act_post_paid_bundle_qty');
                		$productOptions['bundle_one_time_fee'] = $this->input->post('new_act_post_paid_bundle_one_time_fee');
                		$productOptions['bundle_annual_rec_fee'] = $this->input->post('new_act_post_paid_bundle_annual_rec_fee');
                	}
                	else if($category == 'mnp pre-paid')
                	{
                		$productOptions['voice_qty'] = $this->input->post('mnp_pre_paid_voice_qty');
                		$productOptions['voice_one_time_fee'] = $this->input->post('mnp_pre_paid_voice_one_time_fee');
                		$productOptions['voice_annual_rec_fee'] = $this->input->post('mnp_pre_paid_voice_annual_rec_fee');

                		$productOptions['data_qty'] = $this->input->post('mnp_pre_paid_data_qty');
                		$productOptions['data_one_time_fee'] = $this->input->post('mnp_pre_paid_data_one_time_fee');
                		$productOptions['data_annual_rec_fee'] = $this->input->post('mnp_pre_paid_data_annual_rec_fee');

                		$productOptions['bundle_qty'] = $this->input->post('mnp_pre_paid_bundle_qty');
                		$productOptions['bundle_one_time_fee'] = $this->input->post('mnp_pre_paid_bundle_one_time_fee');
                		$productOptions['bundle_annual_rec_fee'] = $this->input->post('mnp_pre_paid_bundle_annual_rec_fee');
                	}
                	else if($category == 'mnp post-paid')
                	{
                		$productOptions['voice_qty'] = $this->input->post('mnp_post_paid_voice_qty');
                		$productOptions['voice_one_time_fee'] = $this->input->post('mnp_post_paid_voice_one_time_fee');
                		$productOptions['voice_annual_rec_fee'] = $this->input->post('mnp_post_paid_voice_annual_rec_fee');

                		$productOptions['data_qty'] = $this->input->post('mnp_post_paid_data_qty');
                		$productOptions['data_one_time_fee'] = $this->input->post('mnp_post_paid_data_one_time_fee');
                		$productOptions['data_annual_rec_fee'] = $this->input->post('mnp_post_paid_data_annual_rec_fee');

                		$productOptions['bundle_qty'] = $this->input->post('mnp_post_paid_bundle_qty');
                		$productOptions['bundle_one_time_fee'] = $this->input->post('mnp_post_paid_bundle_one_time_fee');
                		$productOptions['bundle_annual_rec_fee'] = $this->input->post('mnp_post_paid_bundle_annual_rec_fee');
                	}
                break;
              	case 'solutions':
                	if($category == 'dedicated internet')
                	{
                		$productOptions['capacity_per_location'] = $this->input->post('dedi_int_capacity_per_location');
                		$productOptions['number_of_locations'] = $this->input->post('dedi_int_number_of_location');
                		$productOptions['value_per_location'] = $this->input->post('dedi_int_value_per_location');

                		$productOptions['end_location_city'] = $this->input->post('dedi_int_end_location_city');
                		$productOptions['end_location_state'] = $this->input->post('dedi_int_end_location_state');
                		$productOptions['total_installation_cost'] = $this->input->post('dedi_int_total_installation_cost');

                		$productOptions['annual_rec_fee'] = $this->input->post('dedi_int_annual_rec_fee');
                	}
                	else if($category == 'national leased lines')
                	{
                		$productOptions['number_of_locations'] = $this->input->post('national_leased_lines_number_of_locations');
                		$productOptions['a_point_location_city'] = $this->input->post('national_leased_lines_a_point_location_city');
                		$productOptions['a_point_location_state'] = $this->input->post('national_leased_lines_a_point_location_state');
                		$productOptions['b_point_location_city'] = $this->input->post('national_leased_lines_b_point_location_city');
                		$productOptions['b_point_location_state'] = $this->input->post('national_leased_lines_b_point_location_state');
                		$productOptions['capacity_required'] = $this->input->post('national_leased_lines_capacity_required');
                		$productOptions['total_installation_cost'] = $this->input->post('national_leased_lines_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('national_leased_lines_annual_rec_fee');
                		
                	}
                	else if($category == 'international leased lines')
                	{
                		$productOptions['number_of_locations'] = $this->input->post('inter_leased_lines_number_of_locations');
                		$productOptions['a_point_location_city'] = $this->input->post('inter_leased_lines_a_point_location_city');
                		$productOptions['a_point_location_state'] = $this->input->post('inter_leased_lines_a_point_location_state');

                		$productOptions['b_point_location_city'] = $this->input->post('inter_leased_lines_b_point_location_city');
                		$productOptions['b_point_location_state'] = $this->input->post('inter_leased_lines_b_point_location_state');
                		$productOptions['capacity_required'] = $this->input->post('inter_leased_lines_capacity_required');

                		$productOptions['total_installation_cost'] = $this->input->post('inter_leased_lines_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('inter_leased_lines_annual_rec_fee');
                	}
                	else if($category == 'pri')
                	{
                		$productOptions['installation_location_city'] = $this->input->post('pri_installation_location_city');
                		$productOptions['installation_location_state'] = $this->input->post('pri_installation_location_state');
                		$productOptions['number_of_dod_units'] = $this->input->post('pri_number_of_dod_units');

                		$productOptions['number_of_did_units'] = $this->input->post('pri_number_of_did_units');
                		$productOptions['total_installation_cost'] = $this->input->post('pri_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('pri_annual_rec_fee');
                	}
					else if($category == 'apn over internet')
                	{
                		$productOptions['number_of_units'] = $this->input->post('over_internet_number_of_units');
                		$productOptions['total_installation_cost'] = $this->input->post('over_internet_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('over_internet_annual_rec_fee');
                	}
                	else if($category == 'apn over leased lines')
                	{
                		$productOptions['number_of_locations'] = $this->input->post('leased_lines_number_of_locations');
                		$productOptions['a_point_location_city'] = $this->input->post('leased_lines_a_point_location_city');
                		$productOptions['a_point_location_state'] = $this->input->post('leased_lines_a_point_location_state');

                		$productOptions['b_point_location_city'] = $this->input->post('leased_lines_b_point_location_city');
                		$productOptions['b_point_location_state'] = $this->input->post('leased_lines_b_point_location_state');
                		$productOptions['capacity_required'] = $this->input->post('leased_lines_capacity_required');

                		$productOptions['total_installation_cost'] = $this->input->post('leased_lines_total_installation_cost');
                		$productOptions['annual_rec_fee'] = $this->input->post('leased_lines_annual_rec_fee');
                	}
                break;              
              	case 'devices':
          			$productOptions['device_type'] = $this->input->post('dev_device_type');
            		$productOptions['number_of_units'] = $this->input->post('dev_number_of_units');
            		$productOptions['total_value'] = $this->input->post('dev_total_value');
                break;  
              	case 'valueaddedservices':
                	$productOptions['services_qty'] = $this->input->post('ser_services_qty');
            		$productOptions['services_one_time_cost'] = $this->input->post('ser_services_one_time_cost');
            		$productOptions['annual_rec_fee'] = $this->input->post('ser_annual_rec_fee');
                break; 
			}

                $config['upload_path'] = './uploads/opportunity';
                $config['allowed_types'] = config('allowed_extensions');
                $config['max_size'] = config('max_upload_file_size');
                $config['encrypt_name'] = TRUE;
                
                $this->load->library('upload', $config);
                
                if ( ! $this->upload->do_upload('purchase_order_att'))
                {
                    echo $this->upload->display_errors();
                }
                else
                { 
                     
                    $img_data  = $this->upload->data();
                }
                //print_r($img_data);exit;

    	$opportunity_details = array(
	            'opportunity' => $this->input->post('opportunity'),
	            'stages' => $this->input->post('stages'),
	            'expected_revenue' => $this->input->post('expected_revenue'),
	            'probability' => $this->input->post('probability'),
	            'customer' => $this->input->post('customer'),	            
	            'email' => $this->input->post('email'),
	            'phone' => $this->input->post('phone'),
	            'salesperson_id' => $this->input->post('salesperson_id'),
	            'segment_id' => $this->input->post('segment_id'),
	            'region_id' => $this->input->post('region_id'),
	            'vertical_id' => $this->input->post('vertical_id'),
	            'subvertical_id' => $this->input->post('subvertical_id'),
	            'next_action' => date('Y-m-d', strtotime($this->input->post('next_action'))),
	            'next_action_title' => $this->input->post('next_action_title'),
	            'expected_closing' => date('Y-m-d', strtotime($this->input->post('expected_closing'))),
	            'identified_date' => date('Y-m-d', strtotime($this->input->post('identified_date'))),
	            'closed_date' => date('Y-m-d', strtotime($this->input->post('closed_date'))),
                'purchase_order_att' => $img_data['file_name'],
	            'priority' => $this->input->post('priority'),
	            'tags' => implode(',',$this->input->post('tags')),
	            'lost_reason' =>$this->input->post('lost_reason'),	           
                'lost_date' => date('Y-m-d', strtotime($this->input->post('lost_date'))),             
	            'internal_notes' => $this->input->post('internal_notes'),
	            'assigned_partner_id' => $this->input->post('assigned_partner_id'),
	            'sources' => $this->input->post('sources'),
	            'contact_name' => $this->input->post('contact_name'),
	            );
	     
	     		$productOptions['opportunity_id'] = $this->input->post('opportunity_id');
	     		//print_r($productOptions);exit;
				//$this->db->insert('opportunity_product_options',$productOptions);
				//echo $this->db->last_query();exit;
				$this->db->update('opportunity_product_options',$productOptions,array('opportunity_id' => $this->input->post('opportunity_id')));       	
				//echo $this->db->last_query();exit;
		 return $this->db->update('opportunities',$opportunity_details,array('id' => $this->input->post('opportunity_id')));
	}
    
	function opportunities_list($staff_id)
	{
		/*if($staff_id!='1')
		{
			$this->db->where('salesperson_id', (int) $staff_id);
		}*/
		
		$this->db->order_by("id", "desc");		
        $this->db->from('opportunities');
        return $this->db->get()->result();
	} 
	
    function get_opportunities( $opportunity_id )
	{	
		return $this->db->join('category', 'category.id = opportunities.category_id')->join('products', 'products.id = opportunities.product_id')->join('opportunity_product_options', 'opportunities.id = opportunity_product_options.opportunity_id')->get_where('opportunities',array('opportunities.id' => $opportunity_id))->row();
		// print_R($query);
		// echo $this->db->last_query();exit;
		// return $this->db->join('opportunity_product_options as opo', 'opo.opportunity_id = opportunities.id')->where('opportunities',array('id' => $opportunity_id))->row();
	}
	
	function delete( $opportunity_id )
	{
		
		$this->db->delete('calls',array('call_type_id' => $opportunity_id));
		
		$this->db->delete('meetings',array('meeting_type_id' => $opportunity_id));
		
		if( $this->db->delete('opportunities',array('id' => $opportunity_id)) )  // Delete customer
		{  
			return true;
		}
	}
    
    //Get last row
	function get_quotations_last_id()
	{
		$query ="select * from quotations_salesorder order by id DESC limit 1";

	     $res = $this->db->query($query);

	     if($res->num_rows() > 0) {
	            return $res->result("array");
	    }
	    return array();
    }
     
	function convert_to_quotation($opportunity_id)
	{
		 $opportunity_data = $this->opportunities_model->get_opportunities( $opportunity_id );
		 		 
		 $total_fields=$this->opportunities_model->get_quotations_last_id();
    	 $last_id=$total_fields[0]['id'];
    	  
    	 $quotation_no="SO00".($last_id+1);
    	 
    	 $exp_date=date('m/d/Y', strtotime(' + '.config('payment_term1').' days'));
    	 
    	 $quotation_details = array(
	            'quotations_number' => $quotation_no,
	            'customer_id' => $opportunity_data->customer,
	            'qtemplate_id' => '2',            
	            'date' => strtotime(date('m/d/Y h:i')),
	            'exp_date' => strtotime($exp_date),            
	            'payment_term' => config('payment_term1'),
	            'sales_person' => $opportunity_data->salesperson_id,
	            'segment_id' => $opportunity_data->segment_id,	            
	            'status' => 'Draft Quotation',
		        'quot_or_order' => 'q'
	            );
		                              
		  $quotations_res = $this->db->insert('quotations_salesorder',$quotation_details); 
		   
		  return $quotations_res;
	} 


    
    
    
    function ExportCSV()
{
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "opportunity_exp.csv";
        $query = "SELECT * FROM opportunities WHERE 1";
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
}
}



?>