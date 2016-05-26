<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Meetings_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function add_meetings()
    {
    		$timeCalc = strtotime($this->input->post('ending_date')) - strtotime($this->input->post('starting_date'));   
	        $timeCalc = ($timeCalc/60/60);
    		 
    		$meetings_details = array(
	            'meeting_type' => $this->input->post('meeting_type'),
	            'meeting_type_id' => $this->input->post('meeting_type_id'),
	            'meeting_subject' => $this->input->post('meeting_subject'),
	            'attendees' => implode(',',$this->input->post('attendees')),
	            'responsible' => $this->input->post('responsible'),
	            'starting_date' => strtotime($this->input->post('starting_date')),
	            'ending_date' => strtotime($this->input->post('ending_date')),
	            'all_day' => $this->input->post('all_day'),
	            'location' => $this->input->post('location'),
	            'meeting_description' => $this->input->post('meeting_description'),
	            'privacy' => $this->input->post('privacy'),
	            'show_time_as' => $this->input->post('show_time_as'),
	            'duration' => $timeCalc,
	            );
	                                    
	       	 return $this->db->insert('meetings',$meetings_details);
		 
	}
	
	function edit_meetings()
    {
    		$timeCalc = strtotime($this->input->post('ending_date')) - strtotime($this->input->post('starting_date'));   
	        $timeCalc = ($timeCalc/60/60);
    		 
    		$meetings_details = array(
	            'meeting_type' => $this->input->post('meeting_type'),
	            'meeting_type_id' => $this->input->post('meeting_type_id'),
	            'meeting_subject' => $this->input->post('meeting_subject'),
	            'attendees' => implode(',',$this->input->post('attendees')),
	            'responsible' => $this->input->post('responsible'),
	            'starting_date' => strtotime($this->input->post('starting_date')),
	            'ending_date' => strtotime($this->input->post('ending_date')),
	            'all_day' => $this->input->post('all_day'),
	            'location' => $this->input->post('location'),
	            'meeting_description' => $this->input->post('meeting_description'),
	            'privacy' => $this->input->post('privacy'),
	            'show_time_as' => $this->input->post('show_time_as'),
	            'duration' => $timeCalc,
	            );
	        
	        
	        return $this->db->update('meetings',$meetings_details,array('id' => $this->input->post('meeting_id')));
	           
		 
	}
	 
	function meetings_list($type_id,$type)
	{
		 
        $this->db->order_by("id", "desc");		
        $this->db->select('meetings.*');
        $this->db->from('meetings');
        $this->db->where(array('meeting_type_id'=> $type_id,'meeting_type'=> $type));
         
        return $this->db->get()->result();
	} 
	
    function get_meeting( $meeting_id )
	{
		return $this->db->get_where('meetings',array('id' => $meeting_id))->row();
	}
	
	function delete( $meeting_id )
	{
		if( $this->db->delete('meetings',array('id' => $meeting_id)) )  // Delete meeting
		{  
			return true;
		}
	}
     
	function all_meetings_list()
	{
		
		if(userdata('id')!='1')
		{
			$this->db->where('responsible', userdata('id'));
		} 
        $this->db->order_by("id", "desc");		
        $this->db->select('meetings.*');
        $this->db->from('meetings'); 
        
        return $this->db->get()->result();
	} 

}



?>