<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Contracts_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function add_contracts()
    {
    		if (empty($_FILES['real_signed_contract']['name'])) 
		 	{
			 		$contracts_details = array( 
		            'start_date' => strtotime( $this->input->post('start_date')),
		            'end_date' => strtotime( $this->input->post('end_date')),
		            'description' => $this->input->post('description'),
		            'company_id' => $this->input->post('company_id'),
		            'resp_staff_id' => $this->input->post('resp_staff_id')
		            );
		 	}
		 	else
		 	{
				
					$config['upload_path'] = './uploads/contract/';
					$config['allowed_types'] = config('allowed_extensions');
					$config['max_size']	= config('max_upload_file_size');
					$config['encrypt_name']	= TRUE;
					
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('real_signed_contract'))
					{
						echo $this->upload->display_errors();
					}
					else
					{ 
						 
						$img_data  = $this->upload->data();
						
						$contracts_details = array( 
			            'start_date' => strtotime( $this->input->post('start_date')),
			            'end_date' => strtotime( $this->input->post('end_date')),
			            'description' => $this->input->post('description'),
			            'company_id' => $this->input->post('company_id'),
			            'resp_staff_id' => $this->input->post('resp_staff_id'),
			            'real_signed_contract' => $img_data['file_name']
			            );
					
					}		
			}
    		
	                                    
	       	 return $this->db->insert('contracts',$contracts_details);
		 
	}
	
	function edit_contracts()
    {
    		if (empty($_FILES['real_signed_contract']['name'])) 
		 	{
			 		$contracts_details = array( 
		            'start_date' => strtotime( $this->input->post('start_date')),
		            'end_date' => strtotime( $this->input->post('end_date')),
		            'description' => $this->input->post('description'),
		            'company_id' => $this->input->post('company_id'),
		            'resp_staff_id' => $this->input->post('resp_staff_id')
		            );
		 	}
		 	else
		 	{
				
					$config['upload_path'] = './uploads/contract/';
					$config['allowed_types'] = config('allowed_extensions');
					$config['max_size']	= config('max_upload_file_size');
					$config['encrypt_name']	= TRUE;
					
					$this->load->library('upload', $config);
					
					if ( ! $this->upload->do_upload('real_signed_contract'))
					{
						echo $this->upload->display_errors();
					}
					else
					{ 
						 
						$img_data  = $this->upload->data();
						
						$contracts_details = array( 
			            'start_date' => strtotime( $this->input->post('start_date')),
			            'end_date' => strtotime( $this->input->post('end_date')),
			            'description' => $this->input->post('description'),
			            'company_id' => $this->input->post('company_id'),
			            'resp_staff_id' => $this->input->post('resp_staff_id'),
			            'real_signed_contract' => $img_data['file_name']
			            );
					
					}		
			}
	                                    
	       	 return $this->db->update('contracts',$contracts_details,array('id' => $this->input->post('contract_id')));
		 
	}
	 
	function contracts_list($customer_id)
	{
		if($customer_id!="")
		{
			$this->db->where(array('company_id' => $customer_id) ); 
		} 
		if(userdata('id')!='1')
		{
			$this->db->where('resp_staff_id', userdata('id'));
		}
		 
        $this->db->order_by("id", "desc");		
        $this->db->select('contracts.*');
        $this->db->from('contracts');
        return $this->db->get()->result();
	} 
	
    function get_contracts( $contract_id )
	{
		return $this->db->get_where('contracts',array('id' => $contract_id))->row();
	}
	
	function delete( $contract_id )
	{
		if( $this->db->delete('contracts',array('id' => $contract_id)) )  // Delete call
		{  
			return true;
		}
	}
     
	 
}
 
?>