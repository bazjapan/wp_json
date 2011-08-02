<?php
/*
Controller name: events
Controller description: Partner Events
*/

class JSON_API_Events_Controller {

public $events_table = "sp_events";


public function service_test()
{
	return "Service is in Operation"; 
}



public function get_all_events()
{
	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM  $this->events_table");
	return $result;
}




public function add_event()
{
	global $wpdb;
	$dbfields["event_title"] = $_POST['event_title'];
	$dbfields["event_start"] = $_POST['event_start'];
	$dbfields["event_end"] = $_POST['event_end'];
	$dbfields["event_community_start"] = $_POST['event_community_start'];
	$dbfields["event_community_end"] = $_POST['event_community_end'];
	$dbfields["event_reg_start"] = $_POST['event_reg_start'];
	$dbfields["event_reg_end"] = $_POST['event_reg_end'];
	$dbfields["event_floorplan"] = $_POST['event_floorplan'];
	$dbfields["event_description"] = $_POST['event_description'];
	$dbfields["event_website"] = $_POST['event_website'];
	$dbfields["event_logo"] = $_POST['event_logo'];
	$dbfields["event_city"] = $_POST['event_city'];
	$dbfields["event_country"] = $_POST['event_country'];
	$dbfields["event_address"] = $_POST['event_address'];
	$dbfields["event_location_lat"] = $_POST['event_location_lat'];
	$dbfields["event_location_long"] = $_POST['event_location_long'];
	$dbfields["event_details"] = $_POST['event_details'];
	
	$result = $wpdb->insert($this->events_table, $dbfields);
	return $wpdb->insert_id;
}

public function update_event()
{
	
	if(!$_POST['event_ID'])
	{
	return array(
        'status' => "fail",
        'message' => "Please provide an ID"
      );}
	global $wpdb;
      
	$dbfields["event_title"] = $_POST['event_title'];
	$dbfields["event_start"] = $_POST['event_start'];
	$dbfields["event_end"] = $_POST['event_end'];
	$dbfields["event_community_start"] = $_POST['event_community_start'];
	$dbfields["event_community_end"] = $_POST['event_community_end'];
	$dbfields["event_reg_start"] = $_POST['event_reg_start'];
	$dbfields["event_reg_end"] = $_POST['event_reg_end'];
	$dbfields["event_floorplan"] = $_POST['event_floorplan'];
	$dbfields["event_description"] = $_POST['event_description'];
	$dbfields["event_website"] = $_POST['event_website'];
	$dbfields["event_logo"] = $_POST['event_logo'];
	$dbfields["event_city"] = $_POST['event_city'];
	$dbfields["event_country"] = $_POST['event_country'];
	$dbfields["event_address"] = $_POST['event_address'];
	$dbfields["event_location_lat"] = $_POST['event_location_lat'];
	$dbfields["event_location_long"] = $_POST['event_location_long'];
	$dbfields["event_details"] = $_POST['event_details'];
	
	$where = array( 'event_ID' => $_POST['event_ID'] );
	
	$result = $wpdb->update($this->events_table, $dbfields, $where);
	return $_POST['event_ID'];
}

public function remove_event()
{
	if(!$_POST['event_ID'])
	{
	return array(
        'status' => "fail",
        'message' => "Please provide an event ID"
      );}

    global $wpdb;
    
	$id = $_POST['event_ID'];
	
	$query = sprintf("DELETE FROM $this->events_table WHERE `event_ID` = %s", $id);
	$result = $wpdb->query($query);
	if($result == 1)
	{
	return $_POST['event_ID'];
	}
	return NULL;
}


}

?>
