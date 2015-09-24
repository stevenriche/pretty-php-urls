<?php 
class contact
{
	private $_params;
	private $_base_url;
	
		public function __construct($params, $base_url) { // constructor with parameters, base url (for js and css)
	        $this->_params = $params;
			$this->_base_url = $base_url;
	    }
	
	/*
	 * Every controller will need to have a "default function". Named "index" because of config in index.php
	 * This function would be reachable with the following urls
	 * http://www.example.com/contact
	 * http://www.example.com/contact/index
	 */
	function index(){
		
		echo "Contact Page";
		
	}
	
	/*
	 * Additional function in the 'contact' controller
	 * This function would be reachable with the following urls
	 * http://www.example.com/contact/example
	 */
	function exampmle(){
		echo "Another example!";
	}
	
}
