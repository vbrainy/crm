<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Settings_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }    
    
    function get_settings()
    {
        return $this->db->get_where('settings',array('id' => 1))->row();
    } 
    
     

}



?>