<?php
class my_model {
	
	private $_db_name;
	private $_db_user;
	private $_db_pass;
	private $_db;
	
	public function __construct(){
        $this->_db_name = 'my_db_name';
		$this->_db_user = 'my_db_username';
		$this->_db_pass = 'password';
		if (!isset($this->_db)){
			$this->_db = new PDO('mysql:host=localhost;dbname='.$this->_db_name.';charset=utf8', $this->_db_user, $this->_db_pass);
			$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);	
		}	
    }
	
	
}
