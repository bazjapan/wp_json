<?php

/** 
 * @author Jan
 * 
 * 
 */
class UNCHAINED_DB {
	//TODO - Insert your code here
	

	function __construct() {
	
		//TODO - Insert your code here
	}
	
	
	function get_connection_details()
	{
		$details = array("server" => "localhost:3306", "user_name" => "root", "pass_word"=>"shed007", "database"=>"ws-db");
		return $details;
	}
}

?>