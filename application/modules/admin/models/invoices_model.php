<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoices_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
      
	function update_invoice()
    {
	     
	     $invoice_details = array(	            
	            'customer_id' => $this->input->post('customer_id'),
	            'invoice_date' => strtotime($this->input->post('invoice_date')),
	            'due_date' => strtotime($this->input->post('due_date')),
	            'payment_term' => $this->input->post('payment_term'),
	            'status' => $this->input->post('status')
	            );
		         
		 return $this->db->update('invoices',$invoice_details,array('id' => $this->input->post('invoice_id')));
		 
	}
    
	function invoices_list($customer_id='')
	{
		if($customer_id!="")
		{
			$this->db->where(array('customer_id' => $customer_id) ); 
		}
		
		$id= userdata('id');
		
		if($id!='1')
		{
			 $this->db->where('salesperson_id', $id);
		} 
		 		
		$this->db->order_by("id", "desc");		
        $this->db->from('invoices');
        
        return $this->db->get()->result();
	}
	
	function invoices_list_status($pay_status)
	{
		$id= userdata('id');
		
		if($id!='1')
		{
			 $this->db->where('salesperson_id', $id);
		} 
		
		$this->db->where('status',urldecode($pay_status));	 	
		$this->db->order_by("id", "desc");		
        $this->db->from('invoices');
        
        return $this->db->get()->result();
	}
	 
	
    function get_invoice( $invoice_id )
	{
		return $this->db->get_where('invoices',array('id' => $invoice_id))->row();
	}
	
	function get_invoice_by_number( $invoice_number )
	{
		return $this->db->get_where('invoices',array('invoice_number' => $invoice_number))->row();
	}
	    
	
	function delete( $invoice_id )
	{
		$this->db->delete('invoices_products',array('invoice_id' => $invoice_id));
		 
		if( $this->db->delete('invoices',array('id' => $invoice_id)) )  // Delete customer
		{  
			return true;
		}
	}
	
	function get_quotation( $order_id )
	{
		return $this->db->get_where('quotations_salesorder',array('id' => $order_id))->row();
	}
	 
	function invoice_products($invoice_id)
	{		    
		$this->db->where(array('invoice_id' => $invoice_id) );
		$this->db->order_by("id", "desc");		
        $this->db->from('invoices_products');
         
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
	
	function check_unpaid_amount( $invoice_id )
	{
		$amound=$this->db->get_where('invoices',array('id' => $invoice_id))->row();
		
		$unpaid_amount=$amound->unpaid_amount;
		
		if($this->input->post('payment_received')<=$unpaid_amount)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	function receive_payments()
    {
	     
	     $receive_payments_details = array(	            
	            'staff_id' => userdata('id'),
	            'invoice_id' => $this->input->post('invoice_id'),
	            'payment_date' => strtotime($this->input->post('payment_date')),
	            'payment_method' => $this->input->post('payment_method'),
	            'payment_received' => $this->input->post('payment_received'),
	            );
	      
	      $invoice_data = $this->invoices_model->get_invoice($this->input->post('invoice_id'));
	     
	     $unpaid_amount_new = bcsub($invoice_data->unpaid_amount,$this->input->post('payment_received'),2); 
	      
	      if($unpaid_amount_new=='0')
	      {
		  		$invoice_details = array(	            
	            'unpaid_amount' => $unpaid_amount_new,
	            'status' => 'Paid Invoice',
	            );
		         
		 		$invoices_res=$this->db->update('invoices',$invoice_details,array('id' => $this->input->post('invoice_id')));
		  }
		  else
		  {
		  		$invoice_details = array(	            
	            'unpaid_amount' => $unpaid_amount_new,
	            );
		         
		 		$invoices_res=$this->db->update('invoices',$invoice_details,array('id' => $this->input->post('invoice_id')));
		  }
	      
	            
		 return $this->db->insert('invoice_receive_payments',$receive_payments_details);
		 
	}
	
	function receive_payments_number()
    {
    	 
    		
	     $invoice_data = $this->invoices_model->get_invoice_by_number($this->input->post('invoice_number'));
	     if(empty($invoice_data))
	     {
		 	echo '<div class="alert alert-danger">Invoice number is invalid</div>';
		 	exit;
		 }
		elseif( $this->invoices_model->check_unpaid_amount($invoice_data->id) ==false)
        {
            echo '<div class="alert alert-danger">Can\'t receive more than unpaid amount</div>';
            exit;
        }
		 else
		 {		 		 
		 	$receive_payments_details = array(	            
	            'staff_id' => userdata('id'),
	            'invoice_id' => $invoice_data->id,
	            'payment_date' => strtotime($this->input->post('payment_date')),
	            'payment_method' => $this->input->post('payment_method'),
	            'payment_received' => $this->input->post('payment_received'),
	            );
	       
	     
	     $unpaid_amount_new = bcsub($invoice_data->unpaid_amount,$this->input->post('payment_received'),2); 
	     
	     
	     if($unpaid_amount_new=='0')
	      {
		  		$invoice_details = array(	            
	            'unpaid_amount' => $unpaid_amount_new,
	            'status' => 'Paid Invoice',
	            );
		         
		 		$invoices_res=$this->db->update('invoices',$invoice_details,array('id' => $invoice_data->id));
		  }
		  else
		  {
	      
	      $invoice_details = array(	            
	            'unpaid_amount' => $unpaid_amount_new,
	            );
		         
		 $invoices_res=$this->db->update('invoices',$invoice_details,array('id' => $invoice_data->id));
		 }
		         
		 return $this->db->insert('invoice_receive_payments',$receive_payments_details);	 
		 } 
     
		 
	}
	 
	function invoice_excel_list()
	{
		$this->db->select('invoice_number,invoice_date,due_date,payment_term,status,unpaid_amount'); 	
		$this->db->order_by("id", "desc");		
        $this->db->from('invoices');
        
        return $this->db->get()->result();
	} 
	
	function open_invoices_total_collection()
	{
		$id= userdata('id');
		
		if($id!='1')
		{
			 $this->db->where('salesperson_id', $id);
		} 
		
	    $this->db->select_sum('unpaid_amount'); 
	    $this->db->where('status', 'Open Invoice');  
	    $this->db->from('invoices');
	    		     
	    $query = $this->db->get();
	    $total_sold = $query->row()->unpaid_amount;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	}
	
	function overdue_invoices_total_collection()
	{
		
		$id= userdata('id');
		
		if($id!='1')
		{
			 $this->db->where('salesperson_id', $id);
		}
		
	    $this->db->select_sum('unpaid_amount');
	    $this->db->from('invoices');
	    $this->db->where('status', 'Overdue Invoice');
	    $query = $this->db->get();
	    $total_sold = $query->row()->unpaid_amount;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	}
	
	function paid_invoices_total_collection()
	{
		$id= userdata('id');
		
		if($id!='1')
		{
			 $this->db->where('salesperson_id', $id);
		}

	    $this->db->select_sum('grand_total');
	    $this->db->from('invoices');
	    $this->db->where('status', 'Paid Invoice');
	    $query = $this->db->get();
	    $total_sold = $query->row()->grand_total;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	}
	function invoices_total_collection()
	{
		
		$id= userdata('id');
		
		if($id!='1')
		{
			 $this->db->where('salesperson_id', $id);
		}

	    $this->db->select_sum('unpaid_amount');
	    $this->db->from('invoices');
	    //$this->db->where('payment_term', 'Paid Invoice');
	    $query = $this->db->get();
	    $total_sold = $query->row()->unpaid_amount;
		
	    if ($total_sold > 0)
	    {
	        return $total_sold;
	    }

	    return '0';

	} 
}



?>