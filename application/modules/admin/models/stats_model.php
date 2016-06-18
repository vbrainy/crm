<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Stats_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_value($search)
    {

    	$query = "SELECT * FROM opportunities op";
        if(!empty($search['vertical']))
        {
            $query .= " LEFT JOIN company as c ON c.vertical=".$search['vertical'];
        }
        if(!empty($search['sub_vertical']))
        {
            $query .= " LEFT JOIN company as com ON com.subverticals=".$search['sub_vertical'];
        }
        $where = " WHERE";
        $condi = "";
    	if(!empty($search['customer']))
    	{
    		$condi .= " customer=".$search['customer'];
    	}
        if(!empty($condi))
        {
            $where .= $condi ." AND ";
        }
        else
        {
            $where .= $condi;
        }
        $where .= "`op`.`is_confirmed` = 1 AND `op`.`stages`='WON'"; 
        $query .=  $where ." GROUP BY `op`.id";
        //echo $query;exit;
    	$dbQuery = $this->db->query($query);
        //print_r($dbQuery->result_array());
        return $dbQuery->result_array();
	}
}