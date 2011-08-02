<?php
/*
Controller name: Users
Controller description: WordSmart User Service
*/

class JSON_API_Users_Controller {
	
	public function get_all_users() {
		$result = get_users();
		return $result;
	}
	public function check_email_exists() {
		if (! $_POST ["user_email"]) {
			return array ('status' => "fail", 'message' => "Please provide an email" );
		}
		require_once (ABSPATH . 'wp-includes/registration.php');
		$email = $_POST ["user_email"];
		return email_exists ( $email ); //if !exists return false else returns userID of email
	}
	public function check_user_login_exists() {
		if (! $_POST ["user_login"]) {
			return array ('status' => "fail", 'message' => "Please provide an login name" );
		}
		
		require_once (ABSPATH . 'wp-includes/registration.php');
		$login = $_POST ["user_login"];
		return username_exists ( $login ); //if exists returns user id else null
	}
	
	public function register_user() {
		if (! $_POST ["user_login"]) {
			return array ('status' => "fail", 'message' => "Please provide a user name" );
		}
		if (! $_POST ["user_pass"]) {
			return array ('status' => "fail", 'message' => "Please provide a password" );
		}
		if (! $_POST ["user_email"]) {
			return array ('status' => "fail", 'message' => "Please provide an email" );
		}
		
		require_once (ABSPATH . 'wp-admin/includes/user.php');
		require_once (ABSPATH . 'wp-includes/registration.php');
		
		$username = $_POST ["user_login"];
		$userpass = $_POST ["user_pass"];
		$email = $_POST ["user_email"];
		
		$exists = username_exists ( $username );
		
		if (is_null ( $exists )) {
			$user_id = wp_create_user ( $username, $userpass, $email );
			
			//add meta
			

			//			if($_POST["user_dob"]){update_user_meta( $user_id, "user_dob", $_POST["user_dob"]);};
			//			if($_POST["user_native_dialect_code"]){update_user_meta( $user_id, "user_native_dialect_code", $_POST["user_native_dialect_code"]);};
			//			if($_POST["user_gender"]){update_user_meta( $user_id, "user_gender", $_POST["user_gender"]);};
			//			if($_POST["user_trans_pairs"]){update_user_meta( $user_id, "user_trans_pairs", $_POST["user_trans_pairs"]);};
			//			if($_POST["user_second_languages"]){update_user_meta( $user_id, "user_second_languages", $_POST["user_second_languages"]);};
			//			if($_POST["user_default_keyword_languages"]){update_user_meta( $user_id, "user_default_keyword_languages", $_POST["user_default_keyword_languages"]);};
			//			
			return $user_id;
		} else {
			return array ('status' => "fail", 'message' => "Username already exists, please choose another." );
		}
	}
	
	public function remove_user_by_id()
	{
		
	if(!$_POST["ID"]){return array('status' => "fail",'message' => "Please provide a user ID");}
	require_once(ABSPATH . 'wp-admin/includes/user.php');
	$id = $_POST["ID"];
	$boolean_result = wp_delete_user($id);
	return $boolean_result;
	
	}
	public function get_user_by_id()
	{
	if(!$_POST["ID"]){return array('status' => "fail",'message' => "Please provide a user ID");}
	require_once(ABSPATH . 'wp-admin/includes/user.php');
	$id = $_POST["ID"];
	return get_user_by("id", $id);
	
	}
	
	
	public function login() {
		global $json_api, $post;
		
		extract ( $json_api->query->get ( array ('user_login', 'user_pass' ) ) );
		
		$rememberme = true;
		$result = "fail";
		
		global $wp_error;
		if (empty ( $wp_error )) {
			$wp_error = new WP_Error ();
		}
		$creds = array ();
		$creds ['user_login'] = $user_login;
		$creds ['user_password'] = $user_pass;
		$creds ['remember'] = $rememberme;
		$user = wp_signon ( $creds, false );
		
		if (is_wp_error ( $user )) {
			$result = "fail";
		} else {
			//instance of WP_User
			$result = "ok";
		}
		
		return array ('status' => $result, 'user_login' => $user->user_login );
	}
	
	//logout
	

	public function logout() {
		wp_logout ();
		return array ('status' => 'ok' );
	}

	// public function contributer_login() {
//    global $json_api, $post;
//    extract($json_api->query->get(array('user_login','user_pass')));
//    
//    $rememberme = true;
//    $result = "fail";
//    
//   global $wp_error;
//        if ( empty($wp_error) ) {
//            $wp_error = new WP_Error();
//        }
//        $creds = array();
//		$creds['user_login'] = $user_login;
//		$creds['user_password'] = $user_pass;
//		$creds['remember'] = $rememberme;
//		$user = wp_signon( $creds, false );
//        
//        if(is_wp_error($user)) {
//           $result = "fail";
//        } else {
//        	//instance of WP_User
//           $result = "ok";
//        }
//  	
//  return array(
//        'status' => $result,
//  		'ID' => $user->ID,
//        'user_login' => $user->user_login,
//  		'user_dob' => $user->user_dob,
//  		'user_email' => $user->user_email,
// 		'user_native_dialect_code' => $user->user_native_dialect_code,
//  		'user_gender' => $user->user_gender,
//  		'user_trans_pairs' => $user->user_trans_pairs,
//  		'user_second_languages' => $user->user_second_languages,
//  		'user_default_keyword_languages' => $user->user_default_keyword_languages
// 		);
//  }


}

?>
