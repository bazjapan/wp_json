<?php
/*
Controller name: Test
Controller description: Controller for testing
Sequence version: 0.1
Sequence ID: 44
Generated: 2011-06-11 20:43:09
*/

class JSON_API_Test_Controller {

public $test_table = 'tb_test';
private $sequence_version = '0.1';
private $sequence_ID = '44';

public $exhibitor_class;
public $users_class;



public function blog_route()
{
$docRoot = getenv("DOCUMENT_ROOT");
$sub_dir = 	"/code/js/controllers/";
$dir = $docRoot.$sub_dir;	
return array ('siteurl'=>$docRoot , 'wpurl'=>get_bloginfo('wpurl'),'template_url'=>get_bloginfo('template_url'));	
	
}





}
?>
