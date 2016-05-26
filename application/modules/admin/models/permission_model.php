<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Permission_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function staff_permission($account_permission_id = '')
	{
		if(userdata('id')=='1')
		{
			return true;
		}
		else
		{
				$current_staff_account_role_id		=	$this->db->get_where('users',
														array('id'=>userdata('id')))
															->row()->account_role_id;
															
				$current_staff_account_permissions	=	$this->db->get_where('account_role',
																array('id'=>$current_staff_account_role_id))
																	->row()->account_permissions;
				 
				if (in_array($account_permission_id , explode(',' , $current_staff_account_permissions)))
				{
					return true;
				}
				else
				{
					return false;
				}
		}
		
	}  

}



?>