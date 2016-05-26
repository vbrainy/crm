<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Salesorder_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
     
	 function add_quotation()
    {
    	 $total_fields=$this->salesorder_model->get_quotations_last_id();
    	 $last_id=$total_fields[0]['id'];
    	  
    	 $quotation_no="SO00".($last_id+1);
    	 
		 $quotation_details = array(
	            'quotations_number' => $quotation_no,
	            'customer_id' => $this->input->post('customer_id'),
	            'qtemplate_id' => $this->input->post('quotation_template'),
	            'date' => strtotime($this->input->post('date')),
	            'pricelist_id' => $this->input->post('pricelist_id'),
	            'exp_date' => strtotime($this->input->post('expiration_date')),
	            'payment_term' => $this->input->post('payment_term'),
	            'sales_person' => $this->input->post('sales_person'),
	            'sales_team_id' => $this->input->post('sales_team_id'),
	            'terms_and_conditions' => $this->input->post('terms_and_conditions'),
	            'status' => $this->input->post('status'),
	            'total' => $this->input->post('total'),
		        'tax_amount' => $this->input->post('tax_amount'),
		        'grand_total' => $this->input->post('grand_total'),
		        'quot_or_order' => 'q'
	            );
		                              
		  $quotations_res = $this->db->insert('quotations_salesorder',$quotation_details); 
		  $quotation_order_id = $this->db->insert_id();
		   
	      //Add or edit quotation template products 
				$count = count($this->input->post('product_name'));
				for($i=0;$i<$count;$i++)
				{
					  
						 $products_add=array(
							'quotation_order_id'  =>  $quotation_order_id,
							'product_id'  =>  $this->input->post('p_id')[$i],
							'product_name'  =>  $this->input->post('product_name')[$i],
							'discription'  =>  $this->input->post('description')[$i],
							'quantity'  =>  $this->input->post('quantity')[$i],
							'price'  =>  $this->input->post('product_price')[$i],
							'sub_total'  =>  $this->input->post('sub_total')[$i]
							  );
										
				        $qtemplate_products = $this->db->insert('quotations_salesorder_products',$products_add);  
			
					  
				} 
	      
				 
		  return $quotations_res;
	}
	
	function update_quotation()
    {
	     
	     $quotation_details = array(	            
	            'customer_id' => $this->input->post('customer_id'),
	            'qtemplate_id' => $this->input->post('quotation_template'),
	            'date' => strtotime($this->input->post('date')),
	            'pricelist_id' => $this->input->post('pricelist_id'),
	            //'exp_date' => strtotime($this->input->post('expiration_date')),
	            'payment_term' => $this->input->post('payment_term'),
	            'sales_person' => $this->input->post('sales_person'),
	            'sales_team_id' => $this->input->post('sales_team_id'),
	            'terms_and_conditions' => $this->input->post('terms_and_conditions'),
	            //'status' => $this->input->post('status'),
	            'total' => $this->input->post('total'),
		        'tax_amount' => $this->input->post('tax_amount'),
		        'grand_total' => $this->input->post('grand_total')
	            );
		             
		   
	      //Add or edit quotation template products 
				$count = count($this->input->post('product_name'));
				for($i=0;$i<$count;$i++)
				{
					 
					if(isset($this->input->post('quotation_product_id')[$i]))					{						
						$products_edit=array(
							'quotation_order_id'  =>  $this->input->post('quotation_id'),
							'product_id'  =>  $this->input->post('p_id')[$i],
							'product_name'  =>  $this->input->post('product_name')[$i],
							'discription'  =>  $this->input->post('description')[$i],
							'quantity'  =>  $this->input->post('quantity')[$i],
							'price'  =>  $this->input->post('product_price')[$i],
							'sub_total'  =>  $this->input->post('sub_total')[$i]
							  );
						
						$this->db->update('quotations_salesorder_products',$products_edit,array('id' => $this->input->post('quotation_product_id')[$i]));			  
					}
					else
					{
						 
						 $products_add=array(
							'quotation_order_id'  =>  $this->input->post('quotation_id'),
							'product_id'  =>  $this->input->post('p_id')[$i],
							'product_name'  =>  $this->input->post('product_name')[$i],
							'discription'  =>  $this->input->post('description')[$i],
							'quantity'  =>  $this->input->post('quantity')[$i],
							'price'  =>  $this->input->post('product_price')[$i],
							'sub_total'  =>  $this->input->post('sub_total')[$i]
							  );
										
				        $qo_products = $this->db->insert('quotations_salesorder_products',$products_add);  
			
					}
					
					 
			
				} 
	           
		 return $this->db->update('quotations_salesorder',$quotation_details,array('id' => $this->input->post('quotation_id')));
	}
    
	function quotations_list($customer_id)
	{
		$id=userdata('id');
		if($id!='1')
		{
			$this->db->where('sales_person', $id);
		}
		
		if($customer_id!="")
		{ 
			$this->db->where(array('quot_or_order' => 'o','customer_id' => $customer_id) );	
		} 
		else
		{
		
			$this->db->where(array('quot_or_order' => 'o') );	
		}		
		$this->db->order_by("id", "desc");		
        $this->db->from('quotations_salesorder');
        
        return $this->db->get()->result();
	} 
	
    function get_quotation( $order_id )
	{
		return $this->db->get_where('quotations_salesorder',array('id' => $order_id,'quot_or_order' => 'o'))->row();
	}
	
	function delete( $order_id )
	{
		 
		if( $this->db->delete('quotations_salesorder',array('id' => $order_id)) )  // Delete customer
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
	 
	function quot_order_products($qo_id)
	{		    
		$this->db->where(array('quotation_order_id' => $qo_id) );
		$this->db->order_by("id", "desc");		
        $this->db->from('quotations_salesorder_products');
         
        return $this->db->get()->result();
	}
	
	function get_qo_product( $product_id )
	{
		return $this->db->get_where('quotations_salesorder_products',array('id' => $product_id))->row();
	}	
	
	function delete_qo_product( $product_id )
	{
		$product_data = $this->salesorder_model->get_qo_product( $product_id );
		$quotations_data = $this->salesorder_model->get_quotation( $product_data->quotation_order_id );
		 
		 $new_total= number_format($quotations_data->total - $product_data->price,2,'.','');
		
		$new_tax_amount= $quotations_data->tax_amount - number_format($product_data->quantity*$product_data->price*config('sales_tax')/100,2,'.',' ');
		
		 $new_grand_total= number_format($new_total + $new_tax_amount,2,'.','');
		 
		$quotation_details = array( 
		            'total' => $new_total,
		            'tax_amount' => $new_tax_amount,
		            'grand_total' => $new_grand_total
		            );
		
		$this->db->update('quotations_salesorder',$quotation_details,array('id' => $product_data->quotation_order_id));
		
		if( $this->db->delete('quotations_salesorder_products',array('id' => $product_id)) )   
		{  
			return true;
		}
	}
	
	function get_invoices_last_id()
	{
		$query ="select * from invoices order by id DESC limit 1";

	     $res = $this->db->query($query);

	     if($res->num_rows() > 0) {
	            return $res->result("array");
	    }
	    return array();
   }
	
	function create_invoice($order_id)
	{
		$order_data = $this->salesorder_model->get_quotation( $order_id );
		
		 $total_fields=$this->salesorder_model->get_invoices_last_id();
    	 $last_id=$total_fields[0]['id'];
    	  
    	 $invoice_number=config('invoice_prefix')."/".date('Y')."/00".($last_id+1);
		
		$due_date=date('m/d/Y', strtotime(' + '.$order_data->payment_term.' days'));
		
		 
		
			
		$invoice_details = array( 
		            'order_id' => $order_data->id,
		            'customer_id' => $order_data->customer_id,
		            'salesperson_id' => $order_data->sales_person,
		            'sales_team_id' => $order_data->sales_team_id,
		            'invoice_number' => $invoice_number,
		            'invoice_date' => strtotime(date('m/d/Y')),
		            'due_date' => strtotime($due_date),
		            'payment_term' => $order_data->payment_term,
		            'status' => 'Open Invoice',
		            'total' => $order_data->total,
		        	'tax_amount' => $order_data->tax_amount,
		        	'grand_total' => $order_data->grand_total,
		        	'unpaid_amount' => $order_data->grand_total
		            );
		            
		$invoice_res = $this->db->insert('invoices',$invoice_details); 
		
		$invoice_id = $this->db->insert_id();
		
		$qo_products = $this->salesorder_model->quot_order_products($order_id);
		
		foreach( $qo_products as $qo_product)
		{
			$products_add=array(
						'invoice_id'  =>  $invoice_id,
						'product_id'  =>  $qo_product->id,
						'product_name'  =>  $qo_product->product_name,
						'discription'  =>  $qo_product->discription,
						'quantity'  =>  $qo_product->quantity,
						'price'  =>  $qo_product->price,
						'sub_total'  =>  $qo_product->sub_total
						  );
										
			$invoices_products = $this->db->insert('invoices_products',$products_add);  
			
		}
		
		//Actual Invoice update		
	    $this->db->where('id', $order_data->sales_team_id);
		$this->db->set('actual_invoice', 'actual_invoice+'.$order_data->grand_total.'', FALSE);
		$this->db->update('salesteams');         
	     
		
		return $invoice_id;
	}
	
	function get_pricelist_version_by_pricelist_id( $pricelist_id )
	{
		return $this->db->get_where('pricelist_version',array('pricelist_id' => $pricelist_id,'start_date <=' => strtotime(date('Y-m-d')),'end_date >=' => strtotime(date('Y-m-d'))))->row();
	}
	
	function get_pricelist_version_product( $pricelist_ver_id,$product_id )
	{
		$data['product_price']=$this->db->get_where('pricelist_versions_products',array('pricelist_versions_id' => $pricelist_ver_id,'product_id' => $product_id))->row();  
		return $data['product_price']->special_price;
	}
	
	function get_product_price($product_id,$pricelist_id)
	{ 
		$data['pricelist_version'] = $this->salesorder_model->get_pricelist_version_by_pricelist_id($pricelist_id);
		 
		return $this->db->get_where('pricelist_versions_products',array('product_id' => $product_id,'pricelist_versions_id' => $data['pricelist_version']->id))->row();		
		 
	}
	  
}



?>