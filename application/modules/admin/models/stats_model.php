<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Stats_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    
    function get_value($search)
    {
        //print_R($search['stage']);exit;
        //$query = "SELECT *, (SUM(opo.voice_annual_rec_fee)+SUM(opo.data_annual_rec_fee)+SUM(opo.bundle_annual_rec_fee)+SUM(opo.annual_rec_fee)) as total_rec_fee, (SUM(opo.voice_one_time_fee)+SUM(opo.data_one_time_fee)+SUM(opp.bundle_one_time_fee)+SUM(opp.services_one_time_cost)) as total_one_time_fee FROM opportunities op LEFT JOIN opportunity_product_options opo ON opo.opportunity_id = op.id";
        $query = "SELECT op.*,(SUM(if(ISNULL(opo.voice_annual_rec_fee),0,opo.voice_annual_rec_fee))+SUM(if(ISNULL(opo.data_annual_rec_fee),0,opo.data_annual_rec_fee))+SUM(if(ISNULL(opo.bundle_annual_rec_fee),0,opo.bundle_annual_rec_fee))+SUM(if(ISNULL(opo.annual_rec_fee),0,opo.annual_rec_fee))) as total_rec_fee, (SUM(if(ISNULL(opo.voice_one_time_fee), 0,opo.voice_one_time_fee))+SUM(if(ISNULL(opo.data_one_time_fee),0,opo.data_one_time_fee))+SUM(if(ISNULL(opo.bundle_one_time_fee),0,opo.bundle_one_time_fee))+SUM(if(ISNULL(opo.services_one_time_cost),0,opo.services_one_time_cost))) as total_one_time_fee FROM opportunities op 
                INNER JOIN opportunity_product_options opo ON opo.opportunity_id = op.id";
        if(!empty($search['vertical']))
        {
            $tempStr="";
            if($search['vertical'] != 'all')
            {
                $tempStr .= "'".$search['vertical']."'";
                $query .= " INNER JOIN company as c ON c.vertical IN (".$tempStr.")";
            }
            
        }
        if(!empty($search['sub_vertical']))
        {
            $tempStr="";
            if($search['sub_vertical'] != 'all')
            {
                $tempStr .= "'".$search['sub_vertical']."'";
                $query .= " INNER JOIN company as com ON com.subverticals IN (".$tempStr.")";
            }
            
        }
        $condi = "";
        if(!empty($search['segment']))
        {
            $tempStr="";
            if($search['segment'] != 'all')
            {
                $tempStr .= $search['segment'];
                $query .= " INNER JOIN users u ON u.id=op.salesperson_id 
                        INNER JOIN segments s ON s.id = u.segment_id
                        WHERE u.segment_id IN (".$tempStr.")";
                    $condi = 1;
            }
            
        }
        $where="";
        
        if(!empty($search['stage']))
        {
            $tempStr="";
            if($search['stage'] != 'all')
            {
                if(!strpos("WHERE", $query))
                {
                    $where = " WHERE";
                }
                else
                {
                    $where .= " AND ";
                }
                $tempStr .= "'".$search['stage']."'";
                $where .= " op.stages IN (".$tempStr.")";
                $condi = 1;
            }
        }
        if(!empty($search['category']))
        {
            $tempStr="";
                if($search['category'] != 'all')
                {
                    if(!strpos("WHERE", $query))
                    {
                        $where = " WHERE";
                    }
                    else
                    {
                        $where .= " AND ";
                    }
                    $tempStr .= $search['category'];
                    $where .= " op.product_id IN (".$tempStr.")";
                    $condi = 1;
                }
        }
        if(!empty($search['product']))
        {
            $tempStr = "";
                if($search['product'] != 'all')
                {
                    if(!strpos("WHERE", $query))
                    {
                        $where = " WHERE";
                    }
                    else
                    {
                        $where .= " AND ";   
                    }
                    $tempStr .= $search['product'];
                    $where .= " op.category_id IN (".$tempStr.")";
                    $condi = 1;
                }
        }
        //$where .= "`op`.`is_confirmed` = 1 AND `op`.`stages`='WON'"; 
        $query .=  $where ." GROUP BY `op`.id";
        //echo $query;exit;
        $dbQuery = $this->db->query($query);
        //print_r($dbQuery->result_array());exit;
        return $dbQuery->result_array();
    }


    /*function get_value($search)
    {
        //print_R($search['stage']);exit;
    	//$query = "SELECT *, (SUM(opo.voice_annual_rec_fee)+SUM(opo.data_annual_rec_fee)+SUM(opo.bundle_annual_rec_fee)+SUM(opo.annual_rec_fee)) as total_rec_fee, (SUM(opo.voice_one_time_fee)+SUM(opo.data_one_time_fee)+SUM(opp.bundle_one_time_fee)+SUM(opp.services_one_time_cost)) as total_one_time_fee FROM opportunities op LEFT JOIN opportunity_product_options opo ON opo.opportunity_id = op.id";
        $query = "SELECT op.*,(SUM(if(ISNULL(opo.voice_annual_rec_fee),0,opo.voice_annual_rec_fee))+SUM(if(ISNULL(opo.data_annual_rec_fee),0,opo.data_annual_rec_fee))+SUM(if(ISNULL(opo.bundle_annual_rec_fee),0,opo.bundle_annual_rec_fee))+SUM(if(ISNULL(opo.annual_rec_fee),0,opo.annual_rec_fee))) as total_rec_fee, (SUM(if(ISNULL(opo.voice_one_time_fee), 0,opo.voice_one_time_fee))+SUM(if(ISNULL(opo.data_one_time_fee),0,opo.data_one_time_fee))+SUM(if(ISNULL(opo.bundle_one_time_fee),0,opo.bundle_one_time_fee))+SUM(if(ISNULL(opo.services_one_time_cost),0,opo.services_one_time_cost))) as total_one_time_fee FROM opportunities op LEFT JOIN opportunity_product_options opo ON opo.opportunity_id = op.id";
        if(!empty($search['vertical']))
        {
            $tempStr="";
            if($search['vertical'] == 'all')
            {
                
                foreach ($search['verticals'] as $key => $value) {
                    $tempStr .= $value->id;
                    if(isset($search['verticals'][$key+1]))
                    {
                        $tempStr .= ",";
                    }
                }
            }
            else
            {
                $tempStr .= "'".$search['vertical']."'";
            }
            $query .= " INNER JOIN company as c ON c.vertical IN (".$tempStr.")";
        }
        if(!empty($search['sub_vertical']))
        {
            $tempStr="";
            if($search['sub_vertical'] == 'all')
            {
                
                foreach ($search['sub_verticals'] as $key => $value) {
                    $tempStr .= $value->id;
                    if(isset($search['sub_verticals'][$key+1]))
                    {
                        $tempStr .= ",";
                    }
                }
            }
            else
            {
                $tempStr .= "'".$search['sub_vertical']."'";
            }
            $query .= " INNER JOIN company as com ON com.subverticals IN (".$tempStr.")";
        }
        $condi = "";
        if(!empty($search['segment']))
        {
            $tempStr="";
            if($search['segment'] == 'all')
            {
               foreach ($search['segments'] as $key => $value) {
                    $tempStr .= $value->id;
                    if(isset($search['segments'][$key+1]))
                    {
                        $tempStr .= ",";
                    }
                }
            }
            else
            {
                $tempStr .= $search['segment'];
            }
            $query .= " INNER JOIN users u ON u.id=op.salesperson_id 
                        INNER JOIN segments s ON s.id = u.segment_id
                        WHERE u.segment_id IN (".$tempStr.")";
            $condi = 1;
        }
        $where="";
        if(strpos("WHERE", $query))
        {
            $where = " WHERE";
        }
        
    	if(!empty($search['stage']))
    	{
            if(!empty($condi))
            {
                if($search['stage'] == 'all')
                {
                    $where .= " OR ";
                }
                else
                {
                    $where .= " AND ";
                }
            }
            $tempStr="";
            if($search['stage'] == 'all')
            {
             
                $i=0;
                foreach ($search['stages'] as $key => $value) {
                    $tempStr .= "'".$key."'";
                    $i++;
                    if($i < count($search['stages']))
                    {
                        $tempStr .= ",";
                    }
                }
            }
            else
            {
                $tempStr .= "'".$search['stage']."'";
            }
    		$where .= " op.stages IN (".$tempStr.")";
            $condi = 1;
    	}
        if(!empty($search['category']))
        {
            if(!empty($condi))
            {
                if($search['category'] == 'all')
                {
                    $where .= " OR ";
                }
                else
                {
                    $where .= " AND ";
                }
            }
            $tempStr="";
            if($search['category'] == 'all')
            {
                //print_r($search['categories']);exit;
                
                foreach ($search['categories'] as $key => $value) {
                    $tempStr .= $value->id;
                
                    if(isset($search['categories'][$key+1]))
                    {
                        $tempStr .= ",";
                    }
                }
            }
            else
            {
                $tempStr .= $search['category'];
            }
            $where .= " op.category_id IN (".$tempStr.")";
            $condi = 1;
        }
        if(!empty($search['product']))
        {
            if(!empty($condi))
            {
                if($search['product'] == 'all')
                {
                    $where .= " OR ";
                }
                else
                {
                    $where .= " AND ";   
                }
            }
            $tempStr="";
            if($search['product'] == 'all')
            {
                //print_r($search['categories']);exit;
                
                foreach ($search['products'] as $key => $value) {
                    $tempStr .= $value->id;
                
                    if(isset($search['products'][$key+1]))
                    {
                        $tempStr .= ",";
                    }
                }
            }
            else
            {
                $tempStr .= $search['product'];
            }
            $where .= " op.product_id IN (".$tempStr.")";
            $condi = 1;
        }
        //$where .= "`op`.`is_confirmed` = 1 AND `op`.`stages`='WON'"; 
        $query .=  $where ." GROUP BY `op`.id";
        //echo $query;exit;
    	$dbQuery = $this->db->query($query);
        //print_r($dbQuery->result_array());exit;
        return $dbQuery->result_array();
	}*/
}