<?php
/*
Controller name: Data_Store_Services
Controller description: Gets Data Store Infomation for site
Sequence version: 0.54
Sequence ID: 59
Store Name: 
Store Version: 0
Generated: 2011-06-22 18:53:12
Template Version: 0.2
*/

class JSON_API_Data_Store_Services_Controller {

public $_table = '';
private $sequence_version = 5.54;
private $sequence_ID = 59;
private $table_version = 0;


public function version()
{
return array('status' => 'ok', 'result'=>$this->sequence_version, 'message' => sprintf('Service is currently using sequence version %s',$this->sequence_version), 'sver'=>$this->sequence_version);
}


public function sequence_ID()
{
return array('status' => 'ok', 'result'=>$this->sequence_ID, 'message' => sprintf('Service is based on sequence_ID %s',$this->sequence_ID), 'sver'=>$this->sequence_version);
}



//----Custom Function-----
public function get_table_info()
{
if(!$_POST['table_name']){return array('status' => 'fail', 'message' => 'Please provide a table_name');}
global $wpdb;
$table_name = $_POST['table_name'];
$query = sprintf("DESC %s", $table_name);
$result = $wpdb->get_results($query);
return array('status' => 'ok', 'result'=>$result, 'message' => '', 'sver'=>$this->sequence_version);
}

//----Custom Function-----
public function apply_command()
{
if(!$_POST['command']){return array('status' => 'fail', 'message' => 'Please provide a command');}
global $wpdb;
$sql = $_POST['command'];
$query = $sql;
$result = $wpdb->query($query);

return array('status' => 'ok', 'result'=>$result, 'message' => 'Command applied', 'sver'=>$this->sequence_version);

}

//----Custom Function-----
public function get_number_records_in_table()
{
if(!$_POST['table_name']){return array('status' => 'fail', 'message' => 'Please provide a table_name');}
global $wpdb;
$table_name = $_POST['table_name'];
$query = sprintf("SELECT * from %s", $table_name);
$result = $wpdb->get_results($query);
return array('status' => 'ok', 'result'=>$wpdb->num_rows, 'message' => '', 'sver'=>$this->sequence_version);
}

//----Custom Function-----
public function get_table_names()
{
global $wpdb;
$sql = "show tables";
$query = $sql;
$result = $wpdb->get_results($query);
return array('status' => 'ok', 'result'=>$result, 'message' => '', 'sver'=>$this->sequence_version);
}

//----Custom Function-----
//v1
public function get_active_controller_info()
{
	$only_active = true;
    $controllers = array();
    $dir = json_api_dir();
    $dh = opendir("$dir/controllers");
    while ($file = readdir($dh)) {
      if (preg_match('/(. )\.php$/', $file, $matches)) {
        $controllers[] = $matches[1];
      }
    }
    $controllers = apply_filters('json_api_controllers', $controllers);
    $controllerInfo = array();
   	$active_controller_names = $this->get_active_controller_names();
    $active_controllers = array();
    
    if($only_active == true)
    {
    foreach ($controllers as $controller) 
    {
    foreach ($active_controller_names as $active)
    	{
    	 if($controller == $active)
    	 {
    	 	array_push($active_controllers, $controller);
    	 	break;
    	 }
   		}
    }
    }
    else{$active_controllers = $controllers;};
    
    
    foreach ($active_controllers as $controller) {
          
           $info = $this->controller_info($controller);
           array_push($controllerInfo, $info);
           
    }
    return array('status' => 'ok', 'result'=>$controllerInfo, 'message' => 'Active controllers with version higher than 0', 'sver'=>$this->sequence_version);
}



public function get_active_controller_names()
  {
  $active_controllers = explode(',', get_option('json_api_controllers', 'core'));
  return $active_controllers;
  }
  
  
  
private function json_api_dir() {
  if (defined('JSON_API_DIR') && file_exists(JSON_API_DIR)) {
    return JSON_API_DIR;
  } else {
    return dirname(__FILE__);
  }
}

  private function controller_info($controller) {
    $path = $this->controller_path($controller);
    $class = $this->controller_class($controller);
    $response = array(
      'name' => $controller,
      'sequence_version' => '0',
      'sequence_ID' => '0',
      'description' => '(No description available)',
      'methods' => array(),
  
    );
    if (file_exists($path)) {
      $source = file_get_contents($path);
      if (preg_match('/^\s*Controller name:(. )$/im', $source, $matches)) {
        $response['name'] = trim($matches[1]);
      }
      if (preg_match('/^\s*Sequence version:(. )$/im', $source, $matches)) {
        $response['sequence_version'] = trim($matches[1]);
      }
      if (preg_match('/^\s*Sequence ID:(. )$/im', $source, $matches)) {
        $response['sequence_ID'] = trim($matches[1]);
      }
      if (preg_match('/^\s*Controller description:(. )$/im', $source, $matches)) {
        $response['description'] = trim($matches[1]);
      }
   		if (preg_match('/^\s*Controller URI:(. )$/im', $source, $matches)) {
        $response['docs'] = trim($matches[1]);
      }
      if (!class_exists($class)) {
        require_once($path);
      }
      $response['methods'] = get_class_methods($class);
      
      
      
      return $response;
    } else if (is_admin()) {
      return "Cannot find controller class '$class' (filtered path: $path).";
    } else {
      $this->error("Unknown controller '$controller'.");
    }
    return $response;
  }
 
  
  
  //helpers
  
 private function controller_class($controller) {
    return "json_api_{$controller}_controller";
  }
  
 private function controller_path($controller) {
    $dir = json_api_dir();
    $controller_class = $this->controller_class($controller);
    return apply_filters("{$controller_class}_path", "$dir/controllers/$controller.php");
  }
//get_active_controller_info() end--------------------

//----Custom Function-----
public function update_table()
{
//update_table PHP Code Here:
}

//----Custom Function-----
public function get_table_version()
{
	if(!$_POST['table_name']){return array('status' => 'fail', 'message' => 'Please provide a table_name');}
	global $wpdb;
	$table_name = $_POST['table_name'];
	$table_version = get_option($table_name.'_table_version');
	return array('status' => 'ok', 'result'=>$table_version, 'message' => sprintf('Table: %s is at version %s',$table_name,$table_version), 'sver'=>$this->sequence_version);
	
}

//----Custom Function-----
public function show_tables()
{
global $wpdb;
$query = "SHOW TABLES";
$result = $wpdb->get_results($query);
return array('status' => 'ok', 'result'=>$result, 'message' => '', 'sver'=>$this->sequence_version);
}

//----Custom Function-----
public function get_table_prefix()
{
	global $wpdb;
	return array('status' => 'ok', 'result'=>$wpdb->prefix, 'message' => sprintf('Table prefix is:  %s',$wpdb->prefix), 'sver'=>$this->sequence_version);
}


//----Custom Function-----
public function set_table_version()
{
if(!$_POST['table_name']){return array('status' => 'fail', 'message' => 'Please provide a table_name');}
if(!$_POST['table_version']){return array('status' => 'fail', 'message' => 'Please provide a table_version');}
global $wpdb;
$table_name = $_POST['table_name'];
$table_version = $_POST['table_version'];
$result = update_option($table_name."_table_version", $table_version);
if(!$result)
{
$result = add_option($table_name."_table_version", $table_version);
}
//result is null if option not added;
return array('status' => 'ok', 'result'=>$result, 'message' => sprintf('Table: %s is now at version %s',$table_name,$table_version), 'sver'=>$this->sequence_version);
}

//----Custom Function-----
 public function is_controller_is_active()
  {
  //result is boolean;
 if(!$_POST['controller_name']){return array('status' => 'fail','message' => 'Please provide a controller_name','sver'=>$this->sequence_version);}
  $controller_to_find = $_POST['controller_name'];
  $active_controllers = $this->get_active_controller_names();
  $active = in_array($controller_to_find, $active_controllers);
  $result_text = $active==true?'active':'not active';
  return array('status' => 'ok', 'result'=>$active, 'message' => sprintf("%s is %s", $controller_to_find,$result_text), 'sver'=>$this->sequence_version);
  
  }

//----Custom Function-----
public function get_active_controller_by_store_name()
{
if(!$_POST['store_name']){return array('status' => 'fail', 'message' => 'Please provide an store_name');}
$store_name = $_POST['store_name'];
$result = $this->get_active_controller_info();
$all_active = $result['result'];
$controllers_using_table = array();
   foreach ($all_active as $controller) 
   {
 	if($controller["store_name"] == $store_name)
  	{
  	 array_push($controllers_using_table, $controller);
  	 }
   }
return array('status' => 'ok', 'result'=>$controllers_using_table, 'message' => sprintf('Active controllers relying on store %s',$store_name), 'sver'=>$this->sequence_version);
}

//----Custom Function-----
public function deploy_php_api_controller()
{
if(!$_POST['controller_name']){return array('status' => 'fail', 'message' => 'Please provide a controller_name');}
if(!$_POST['controller_content']){return array('status' => 'fail', 'message' => 'Please provide some controller_content');}	

$controler_name = $_POST['controller_name'].".php";
$file_content = urldecode($_POST['controller_content']);

$sub_dir = 	"/controllers/";
$dir = json_api_dir().$sub_dir;


$the_file = $dir.$controler_name;
$exists = file_exists($the_file);	

$directive = 'w '; 
//if doesn't exist
//if($exists)
//{
//$directive = 'a'; 	
//}
//else {
//$directive = 'x '; 
//}
$handle = fopen($the_file,$directive);
fwrite($handle,$file_content);
fclose($handle);


//$file = file($the_file);

return array('status' => 'ok', 'result'=> $controler_name, 'message' => sprintf('Controller has been deployed to %s',$dir), 'sver'=>$this->sequence_version);

}

//----Custom Function-----
public function deploy_js_controller()
{
if(!$_POST['controller_name']){return array('status' => 'fail', 'message' => 'Please provide a controller_name');}
if(!$_POST['controller_content']){return array('status' => 'fail', 'message' => 'Please provide some controller_content');}	
if(!$_POST['domain_code_root']){return array('status' => 'fail', 'message' => 'Please provide a domain_code_root');}	

$controler_name = $_POST['controller_name'].".js";
$file_content = urldecode($_POST['controller_content']);

$docRoot = getenv("DOCUMENT_ROOT");
$sub_dir = 	$_POST['domain_code_root'];
$dir = $docRoot.$sub_dir;
$siteRoot = "http://".$_SERVER['HTTP_HOST'];
$deployed_URL = $siteRoot.$sub_dir.$controler_name;

$the_file = $dir.$controler_name;
$exists = file_exists($the_file);	

$directive = 'w '; 

$handle = fopen($the_file,$directive);
fwrite($handle,$file_content);
fclose($handle);


$file = file($the_file);

return array('status' => 'ok', 'result'=> $deployed_URL, 'message' => sprintf('Controller has been deployed at %s',$deployed_URL), 'sver'=>$this->sequence_version);
}
}
?>
