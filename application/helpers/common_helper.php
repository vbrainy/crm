<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('is_active_menu'))
{
	function is_active_menu($url)
	{
		if(is_array($url))
		{
			foreach ($url as $menu) {
				if(strpos(uri_string(),$menu))
					return 'active';
			}					
		}
		else
		{
			if(uri_string()=='' && $url=='')
				return 'active';

			if(uri_string()=='' || $url=='')
				return '';
			return (strpos(uri_string(),$url))?'active':'';			
		}
	}
}
function country_name($country_id)
{ 
		$CI =& get_instance();
        return $CI->db->get_where('countries',array('id' => $country_id))->row();
}

function state_name($state_id)
{ 
		$CI =& get_instance();
        return $CI->db->get_where('states',array('id' => $state_id))->row();
}

function city_name($city_id)
{ 
		$CI =& get_instance();
        return $CI->db->get_where('cities',array('id' => $city_id))->row();
}

function customer_name($customer_id)
{ 
		$CI =& get_instance();
        return $CI->db->get_where('company',array('id' => $customer_id))->row();
}

function sales_by_month_chart($month) 
    {	
    	 
    	  $first_date = date('d-m-Y',strtotime('first day of '.$month.''));
		  $last_date = date('d-m-Y',strtotime('last day of '.$month.''));
 		  
 		$CI =& get_instance();
 		
		$CI->db->where('sales_order_create_date BETWEEN "'.strtotime($first_date).'" AND "'.strtotime($last_date).'"'); 
		$CI->db->where('quot_or_order','o'); 	
        $CI->db->order_by("id", "desc");
        $CI->db->from('quotations_salesorder');  
        	
		return count($CI->db->get()->result());	
	} 
 
 	function sales_performance_salescount($date,$team_id) 
    {	
    	 
 		$CI =& get_instance();
 		
 		$CI->db->select_sum('grand_total'); 
		$CI->db->where(array('sales_order_create_date'=>$date,'quot_or_order'=>'o','sales_team_id'=>$team_id));  
         
        $CI->db->from('quotations_salesorder');  
        
        $query = $CI->db->get();
	    $total_sales = $query->row()->grand_total;
		
	    if ($total_sales > 0)
	    {
	        return round($total_sales);
	        
	    }

	    return '0';
        	
		//return count($CI->db->get()->result());	
	}
 
 	function add_notifications($salesperson_id,$title,$section_id,$section_name)
	{ 
			$CI =& get_instance();
	        
	        $notification_details = array(
	            'salesperson_id' => $salesperson_id,
	            'date' => strtotime(date('d F Y g:i a')),
	            'title' => $title,
	            'section_id' => $section_id,
	            'section_name' => $section_name
	            );
	            
	        
	       return $CI->db->insert('notifications',$notification_details);
	}
	
	  
	
	function get_notifications()
	{ 
		$CI =& get_instance();
		
		$CI->db->where('salesperson_id', userdata('id'));
		$CI->db->where('status', '0'); 
		$CI->db->order_by("id", "desc");		
        $CI->db->from('notifications');
         
        $result=$CI->db->get()->result();
         
		
		return $result;
	}
	
	function xTimeAgo ($oldTime)  
	{
		    $etime = time() - $oldTime;

		    if ($etime < 1)
		    {
		        return '0 seconds';
		    }

		    $a = array( 365 * 24 * 60 * 60  =>  'year',
		                 30 * 24 * 60 * 60  =>  'month',
		                      24 * 60 * 60  =>  'day',
		                           60 * 60  =>  'hour',
		                                60  =>  'minute',
		                                 1  =>  'second'
		                );
		    $a_plural = array( 'year'   => 'years',
		                       'month'  => 'months',
		                       'day'    => 'days',
		                       'hour'   => 'hours',
		                       'minute' => 'minutes',
		                       'second' => 'seconds'
		                );

		    foreach ($a as $secs => $str)
		    {
		        $d = $etime / $secs;
		        if ($d >= 1)
		        {
		            $r = round($d);
		            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
		        }
		    }
	}
		 
	
	function get_permission_value($staff_id,$field)
	{
		$CI =& get_instance();
		   
		$field_value=$CI->db->get_where('account_permission',array('staff_id' => $staff_id))->row();
		  
		if($field_value->$field=='1')
		{
			return true;
		}
		else
		{
			return false;	
		}
		
		 
	}
	
	function check_staff_permission($field)
	{
		$CI =& get_instance();
		
		$staff_id= userdata('id');
		
		if($staff_id=='1')
		{
			return true;
		}
		else
		{
		 
				$field_value=$CI->db->get_where('account_permission',array('staff_id' => $staff_id))->row();
				  
				if($field_value->$field=='1')
				{
					return true;
				}
				else
				{
					return false;	
				}
		}
		 
	}	
     
?>