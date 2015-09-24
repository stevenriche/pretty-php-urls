<?php 
class home
{
	private $_params;
	private $_base_url;
	
		public function __construct($params, $base_url) { // constructor with parameters, base url (for js and css)
	        $this->_params = $params;
			$this->_base_url = $base_url;
	    }
	
	/*
	 * Home page
	 * This function would be reachable with the following urls
	 * http://www.example.com
	 * http://www.example.com/home
	 * http://www.example.com/home/index
	 */
	function index(){
		
		$base_url = $this->_base_url;
		
		// include_once 'models/my_model.php';
		// $model = new my_model();
		
		
		if( file_exists("views/home_view.php") ) {
		   include('views/home_view.php');
		} else {
			echo 'Couldn\'t find file!';
		}
		
	}
	
	/*
	 * Additional function in the 'home' controller
	 * This function would be reachable with the following urls
	 * http://www.example.com/about
	 * http://www.example.com/home/about
	 */
	function about(){
		echo "About page!";
	}
	
}
