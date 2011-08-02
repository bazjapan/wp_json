<?php
/*
Controller name: Event_User_Registration
Controller description: Data manipulation methods for patner event registrations
Controller version: 0.1
*/

class JSON_API_Event_User_Registration_Controller {

public $partner_user_registrations_table = 'sp_event_user_registrations';


public function service_test()
{
return "Service is in Operation"; 
}


public function get_all_event_user_registrations()
{
global $wpdb;
$query = ("SELECT * FROM  $this->partner_user_registrations_table");
$result = $wpdb->get_results($query);
return $result;
}


public function get_event_user_registrations_by_registration_ID()
{
if(!$_POST['registration_ID'])
{
return array('status' => 'fail', 'message' => 'Please provide an registration_ID');
}
global $wpdb;
$id = $_POST['registration_ID'];
$query = sprintf("SELECT * FROM  $this->partner_user_registrations_table WHERE `registration_ID` = %s", $id);
$result = $wpdb->get_results($query);
return $result;
}


public function get_event_user_registrations_by_user_ID()
{
if(!$_POST['user_ID'])
{
return array('status' => 'fail', 'message' => 'Please provide an user_ID');
}
global $wpdb;
$id = $_POST['user_ID'];
$query = sprintf("SELECT * FROM  $this->partner_user_registrations_table WHERE `user_ID` = %s", $id);
$result = $wpdb->get_results($query);
return $result;
}


public function get_event_user_registrations_by_event_ID()
{
if(!$_POST['event_ID'])
{
return array('status' => 'fail', 'message' => 'Please provide an event_ID');
}
global $wpdb;
$id = $_POST['event_ID'];
$query = sprintf("SELECT * FROM  $this->partner_user_registrations_table WHERE `event_ID` = %s", $id);
$result = $wpdb->get_results($query);
return $result;
}


public function get_event_user_registrations_by_event_user_role()
{
if(!$_POST['event_user_role'])
{
return array('status' => 'fail', 'message' => 'Please provide an event_user_role');
}
global $wpdb;
$id = $_POST['event_user_role'];
$query = sprintf("SELECT * FROM  $this->partner_user_registrations_table WHERE `event_user_role` = %s", $id);
$result = $wpdb->get_results($query);
return $result;
}



public function update_event_user_registrations_by_registration_ID()
{
if(!$_POST['registration_ID']){return array('status' => 'fail','message' => 'Please provide an registration_ID');}
global $wpdb;
$dbfields['event_user_role'] = $_POST['event_user_role'];
$where = array( 'registration_ID' => $_POST['registration_ID'] );
$result = $wpdb->update($this->partner_user_registrations_table, $dbfields, $where);
return $_POST['registration_ID'];
}



public function remove_event_user_registrations_by_registration_ID()
{
if(!$_POST['registration_ID']){return array('status' => 'fail','message' => 'Please provide an registration_ID');}
global $wpdb;
$id = $_POST['registration_ID'];
$query = sprintf("DELETE FROM $this->partner_user_registrations_table WHERE `registration_ID` = %s", $id);
$result = $wpdb->query($query);
if($result == 1){return $id;};
return NULL;
}



public function remove_event_user_registrations_by_user_ID()
{
if(!$_POST['user_ID']){return array('status' => 'fail','message' => 'Please provide an user_ID');}
global $wpdb;
$id = $_POST['user_ID'];
$query = sprintf("DELETE FROM $this->partner_user_registrations_table WHERE `user_ID` = %s", $id);
$result = $wpdb->query($query);
if($result == 1){return $id;};
return NULL;
}



public function remove_event_user_registrations_by_event_ID()
{
if(!$_POST['event_ID']){return array('status' => 'fail','message' => 'Please provide an event_ID');}
global $wpdb;
$id = $_POST['event_ID'];
$query = sprintf("DELETE FROM $this->partner_user_registrations_table WHERE `event_ID` = %s", $id);
$result = $wpdb->query($query);
if($result == 1){return $id;};
return NULL;
}


public function add_event_user_registration()
{
global $wpdb;
$dbfields['user_ID'] = $_POST['user_ID'];
$dbfields['event_ID'] = $_POST['event_ID'];
$dbfields['event_user_role'] = $_POST['event_user_role'];
$result = $wpdb->insert($this->sp_event_user_registrations, $dbfields);
return $wpdb->insert_id;
}

}
?>
