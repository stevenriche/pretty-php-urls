<?php

/*
 * Configuration variables
 * $base_uri - this is the folder that this project is contained in - on a live site, 
 *             it will be the domain after the http(s):// or www.
 * $controller_path - this is the folder path, in relation to index.php, where your controllers are stored
 * $default_controller - this is the controller that defaults if a valid controller is not part of the URL
 * $default_function - this is the name of the method that defaults if a valid method is not given.
 *                    **You should have your main method in every controller be called this!**
 */
$base_uri = '';
$controller_path = 'controllers';
$default_controller = 'home';
$default_function = 'index';

/*
 * We process the URI segments here so we can have pretty URLs
 * Slice up everything after the $base_uri
 * First segment after the base uri (if any) is the controller function (switches to default if there is none)
 * Additional segments (if any) are parameters sent to the function
 */

$uri_segments = explode('/', $_SERVER['REQUEST_URI']);
$base_uri_index = array_search($base_uri, $uri_segments);

if ($base_uri_index !== FALSE){
	if (count($uri_segments) > ($base_uri_index+1)){ // if we have additional segments
		if (file_exists("{$controller_path}/{$uri_segments[$base_uri_index+1]}.php") ){ // if first segment is a controller
			$controller = $uri_segments[$base_uri_index+1];
			$controller_index = $base_uri_index+1;
		} else { // if first segment is not a controller
			$controller = $default_controller;
			$controller_index = $base_uri_index;
		}
		include_once "{$controller_path}/{$controller}.php";
		$test_controller = new $controller(array(), ''); // temporary object to check if it has methods
		
		if (count($uri_segments) > ($controller_index+1) && method_exists($test_controller, $uri_segments[$controller_index+1])){
			$function = $uri_segments[$controller_index+1];
			$function_index = $controller_index+1;
		} else {
			$function = $default_function;
			$function_index = $controller_index;
		}
		
		if (count($uri_segments) > ($function_index+1)){
			$parameters = array_slice($uri_segments, $function_index+1);
		} else {
			$parameters = array();
		}
	} else {
		$controller = $default_controller;
		$function = $default_function;
		$parameters = array();
		include_once "{$controller_path}/{$controller}.php";
	}
} else {
	throw new Exception('Your base URI was not found in the URL. Please make sure your $base_uri variable is configured properly');
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
 * New instance of our controller
 */ 
$controller = new $controller($parameters, $base_url);

/*
 * Run the function
 */ 
$controller->$function();
exit();