<?php

/*
 * Configuration variables
 * $base_uri - this is the folder that this project is contained in
 * $default_controller - this is the controller that the site related functions are in
 * $debug_controller - this is the controller that handles all of the setup-related functions (creating db, testing db, etc)
 *  - should be commented out once site is live
 * $default_function - this is the name of the default function in the default controller file
 */
$base_uri = 'your_website';
$controller_path = 'controllers';
$default_controller = 'your_controller';
$default_function = 'display';

/*
 * We process the URI segments here so we can have pretty URLs
 * Slice up everything after the $base_uri
 * First segment after the base uri (if any) is the controller function (switches to default if there is none)
 * Additional segments (if any) are parameters sent to the function
 */

$uri_segments = array_filter(explode('/', $_SERVER['REQUEST_URI']));

$base_uri_index = array_search($base_uri, $uri_segments);
if ($base_uri_index !== FALSE){
	if (count($uri_segments) > $base_uri_index){
		$controller_function = ($uri_segments[$base_uri_index+1] != '') ? $uri_segments[$base_uri_index+1] : $default_function;
	} else {
		$controller_function = $default_function;
	}
	
	if (count($uri_segments) > ($base_uri_index+1)){
		$parameters = array_slice($uri_segments, $base_uri_index+1);
	} else {
		$parameters = array();
	}
}

/*
 * Set up our base url for css and js includes
 */
$url_part_2 = '';
for ($iii = 0; $iii <= $base_uri_index; $iii++){
	$url_part_2 .= $uri_segments[$iii] . '/';
}
$base_url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}" . $url_part_2;

/*
 * If we are doing debug/setup functions, change our variables accordingly
 */

$controller = $default_controller;
$function = $controller_function;


/*
 * Double check if our controller exists
 */ 
if( file_exists("{$controller_path}/{$controller}.php") ) {
    include_once "{$controller_path}/{$controller}.php";
} else {
    throw new Exception('Controller is invalid.');
}

/*
 * New instance of our controller
 */ 
$controller = new $controller($parameters, $base_url);

/*
 * Double check if our function exists
 */ 
if (method_exists($controller, $function) === false ) {
    throw new Exception('Function is invalid.');
} 

/*
 * Run the function
 */ 
$controller->$function();
exit();