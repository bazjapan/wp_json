<?php
/*
Controller name: UserProfiles
Controller description: controller for user profiles 
*/

class JSON_API_User_Profiles_Controller {

public $sp_user_profiles_table = "sp_user_profiles";


public function service_test()
{
 return "Service is in Operation"; 
}

 

public function get_all_user_profiles()
{
 global $wpdb;
 $result = $wpdb->get_results("SELECT * FROM  $this->sp_user_profiles_table");
 return $result;
}


public function get_profile_by_ID()
{
 
 if(!$_POST['user_ID'])
 {
 return array('status' => "fail", 'message' => "Please provide a user ID");
 }
      
 global $wpdb;
 $id = $_POST['user_ID'];
 $query = sprintf("SELECT * FROM  $this->sp_user_profiles_table WHERE `user_ID` = %s", $id);
 $result = $wpdb->get_results($query);
 return $result;
}

 


public function add_user_profiles()
{
 global $wpdb;
 $dbfields["user_first_name"] = $_POST['user_first_name'];
 $dbfields["user_last_name"] = $_POST['user_last_name'];
 $dbfields["user_job_title"] = $_POST['user_job_title'];
 $dbfields["user_personal_tele_no"] = $_POST['user_personal_tele_no'];
 $dbfields["user_personal_mob_no"] = $_POST['user_personal_mob_no'];
 $dbfields["use_company_name"] = $_POST['user_company_name'];
 $dbfields["user_company_addresses"] = $_POST['user_company_addresses'];
 $dbfields["user_company_postcode"] = $_POST['user_company_postcode'];
 $dbfields["user_company_country"] = $_POST['user_company_country'];
 $dbfields["user_company_contact_points"] = $_POST['user_company_contact_points'];
 $dbfields["user_company_area_business"] = $_POST['user_company_area_business'];
 $dbfields["user_keywords"] = $_POST['user_keywords'];
 $dbfields["user_company_url"] = $_POST['user_company_url'];  
 
 $result = $wpdb->insert($this->sp_user_profile_table, $dbfields);
 return $wpdb->insert_id;
}

public function update_user_profile()
{
 
 if(!$_POST['user_ID'])
 {
 return array(
        'status' => "fail",
        'message' => "Please provide an ID"
      );}
 global $wpdb;
      
  $dbfields["user_first_name"] = $_POST['user_first_name'];
 $dbfields["user_last_name"] = $_POST['user_last_name'];
 $dbfields["user_job_title"] = $_POST['user_job_title'];
 $dbfields["user_personal_tele_no"] = $_POST['user_personal_tele_no'];
 $dbfields["user_personal_mob_no"] = $_POST['user_personal_mob_no'];
 $dbfields["use_company_name"] = $_POST['user_company_name'];
 $dbfields["user_company_addresses"] = $_POST['user_company_addresses'];
 $dbfields["user_company_postcode"] = $_POST['user_company_postcode'];
 $dbfields["user_company_country"] = $_POST['user_company_country'];
 $dbfields["user_company_contact_points"] = $_POST['user_company_contact_points'];
 $dbfields["user_company_area_business"] = $_POST['user_company_area_business'];
 $dbfields["user_keywords"] = $_POST['user_keywords'];
 $dbfields["user_company_url"] = $_POST['user_company_url'];  
 
 $where = array( 'user_ID' => $_POST['user_ID'] );
 
 $result = $wpdb->update($this->sp_user_profiles_table, $dbfields, $where);
 return $_POST['user_ID'];
}

public function remove_profile()
{
 if(!$_POST['user_ID'])
 {
 return array(
        'status' => "fail",
        'message' => "Please provide a user ID"
      );}

    global $wpdb;
    
 $id = $_POST['user_ID'];
 
 $query = sprintf("DELETE FROM $this->sp_user_profiles_table WHERE `user_ID` = %s", $id);
 $result = $wpdb->query($query);
 if($result == 1)
 {
 return $id;
 }
 return NULL;
}


}

?>
