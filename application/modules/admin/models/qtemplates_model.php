<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Qtemplates_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function add_qtemplates()
    {
    	  
				$qtemplate_details = array(
		            'quotation_template' => $this->input->post('quotation_template'),
		            'quotation_duration' => $this->input->post('quotation_duration'),
		            'immediate_payment' => $this->input->post('immediate_payment'),
		            'terms_and_conditions' => $this->input->post('terms_and_conditions'),
		            'total' => $this->input->post('total'),
		            'tax_amount' => $this->input->post('tax_amount'),
		            'grand_total' => $this->input->post('grand_total')
		            );
	      
	                                   
	        $qtemplate_res = $this->db->insert('qtemplate',$qtemplate_details);
	       
	        $qtemplate_id = $this->db->insert_id();
	        
	           //Add quotation template products
				
				$count = count($this->input->post('product_name'));
				for($i=0;$i<$count;$i++)
				{
					$data=array(
							'qtemplate_id'  =>  $qtemplate_id,
							'product_id'  =>  $this->input->post('p_id')[$i],
							'product_name'  =>  $this->input->post('product_name')[$i],
							'discription'  =>  $this->input->post('description')[$i],
							'quantity'  =>  $this->input->post('quantity')[$i],
							'price'  =>  $this->input->post('product_price')[$i],
							'sub_total'  =>  $this->input->post('sub_total')[$i]
							  );
										
				   $qtemplate_products = $this->db->insert('qtemplate_products',$data);  
				}
				 
	       return $qtemplate_res;
		 
		  
	}
	
	function update_qtemplates()
    {
    	$qtemplate_details = array(
		            'quotation_template' => $this->input->post('quotation_template'),
		            'quotation_duration' => $this->input->post('quotation_duration'),
		            'immediate_payment' => $this->input->post('immediate_payment'),
		            'terms_and_conditions' => $this->input->post('terms_and_conditions'),
		            'total' => $this->input->post('total'),
		            'tax_amount' => $this->input->post('tax_amount'),
		            'grand_total' => $this->input->post('grand_total')
		            );
		 
		      //Add or edit quotation template products 
				$count = count($this->input->post('product_name'));
				for($i=0;$i<$count;$i++)
				{
					 
					if(isset($this->input->post('qtemplate_product_id')[$i]))
					{
						
						$products_edit=array(
							'qtemplate_id'  =>  $this->input->post('qtemplates_id'),
							'product_id'  =>  $this->input->post('p_id')[$i],
							'product_name'  =>  $this->input->post('product_name')[$i],
							'discription'  =>  $this->input->post('description')[$i],
							'quantity'  =>  $this->input->post('quantity')[$i],
							'price'  =>  $this->input->post('product_price')[$i],
							'sub_total'  =>  $this->input->post('sub_total')[$i]
							  );
						
						$this->db->update('qtemplate_products',$products_edit,array('id' => $this->input->post('qtemplate_product_id')[$i]));			  
					}
					else
					{
						 
						 $data=array(
							'qtemplate_id'  =>  $this->input->post('qtemplates_id'),
							'product_id'  =>  $this->input->post('p_id')[$i],
							'product_name'  =>  $this->input->post('product_name')[$i],
							'discription'  =>  $this->input->post('description')[$i],
							'quantity'  =>  $this->input->post('quantity')[$i],
							'price'  =>  $this->input->post('product_price')[$i],
							'sub_total'  =>  $this->input->post('sub_total')[$i]
							  );
										
				        $qtemplate_products = $this->db->insert('qtemplate_products',$data);  
			
					}
					
					 
			
				} 
	           
		 return $this->db->update('qtemplate',$qtemplate_details,array('id' => $this->input->post('qtemplates_id')));
	}
    
	function qtemplate_list()
	{
		$this->db->order_by("id", "desc");		
        $this->db->from('qtemplate');
        
         
        return $this->db->get()->result();
	} 
	
    function get_qtemplate( $qtemplate_id )
	{
		return $this->db->get_where('qtemplate',array('id' => $qtemplate_id))->row();
	}
	
	function delete( $qtemplate_id )
	{
		if($qtemplate_id!='2')
		{
			
			$this->db->delete('qtemplate_products',array('qtemplate_id' => $qtemplate_id));
			
			if( $this->db->delete('qtemplate',array('id' => $qtemplate_id)) )   
			{  
				return true;
			}
		}
		else
		{
			echo "Default template not delete";
			exit;
		}
		
	}
     
	
	function qtemplate_products($qtemplate_id)
	{
		$this->db->where(array('qtemplate_id' => $qtemplate_id) );
		$this->db->order_by("id", "desc");		
        $this->db->from('qtemplate_products');
         
        return $this->db->get()->result();
	}
	
	function get_qtemplate_product( $product_id )
	{
		return $this->db->get_where('qtemplate_products',array('id' => $product_id))->row();
	}
	
	function delete_qtemplate_product( $product_id )
	{
		$product_data = $this->qtemplates_model->get_qtemplate_product( $product_id );
		$qtemplate_data = $this->qtemplates_model->get_qtemplate( $product_data->qtemplate_id );
		
		$new_total= number_format($qtemplate_data->total - $product_data->price,2,'.',' ');
		
		$new_tax= number_format($new_total*config('sales_tax')/100,2,'.',' ');
		
		$new_grand_total=number_format($new_total+$new_tax,2,'.',' ');
		 
		$qtemplate_details = array( 
		            'total' => $new_total,
		            'tax_amount' => $new_tax,
		            'grand_total' => $new_grand_total
		            );
		
		$this->db->update('qtemplate',$qtemplate_details,array('id' => $product_data->qtemplate_id));
			
		$this->db->delete('qtemplate_products',array('id' => $product_id));  
		 
		return $new_total.'_'.$new_tax.'_'.$new_grand_total;
	}  
	
	//Get Total
	function get_total( $qtemplate_id )
	{
		
		$this->db->where('id', $qtemplate_id);
		//here we select every clolumn of the table
		$q = $this->db->get('qtemplate');
		$data = $q->result_array();

		 
		return $data[0]['grand_total'];
	} 
	
	 
}



?>