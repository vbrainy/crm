<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
         
	function roles_list()
	{
        $this->db->order_by("role", "asc");		
        $this->db->select('user_roles.*');
        $this->db->from('user_roles');
        return $this->db->get()->result_array();
	} 

    function get_role_level($id)
    {
        return $this->db->get_where('user_roles', array('id'=> $id))->row_array();
    }

	function rights_list_by_role($roleId)
	{
		return $this->db->get_where('user_rights', array('role_id'=> $roleId))->row_array();
	}
}
?>