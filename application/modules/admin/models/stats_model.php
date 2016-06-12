<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Stats_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_value($search)
    {
    	$query = "SELECT * FROM opportunities";
    	if(isset($search['customer']))
    	{
    		$query .= " WHERE customer=".$search['customer'];
    	}
    	$dbQuery = $this->db->query($query);
        //print_r($dbQuery->result_array());
        return $dbQuery->result_array();
	}
}