<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vertical_model extends CI_Model
{

    function __construct()
    {
	parent::__construct();
    }

    function add_vertical()
    {

	$vertical_details = array(
	    'vertical_name' => $this->input->post('vertical_name'),
	);

	return $this->db->insert('vertical', $vertical_details);
    }

    function update_vertical()
    {
	$vertical_details = array(
	    'vertical_name' => $this->input->post('vertical_name'),
	);

	return $this->db->update('vertical', $vertical_details, array('id' => $this->input->post('vertical_id')));
    }

    function vertical_list()
    {
	$this->db->order_by("id", "desc");
	$this->db->from('vertical');

	return $this->db->get()->result();
    }

    function get_vertical($vertical_id)
    {
	return $this->db->get_where('vertical', array('id' => $vertical_id))->row();
    }

    function delete($category_id)
    {
	if($this->db->delete('vertical', array('id' => $category_id)))  // Delete customer
	{
	    return true;
	}
    }

}

?>