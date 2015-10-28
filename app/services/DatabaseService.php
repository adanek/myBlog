<?php

class DatabaseService
{
	private $mysqli = null;
	
	//constructor
	public function __construct(){
		
		$this->mysqli = new mysqli("localhost", "blogger", "P@ssw0rd", "webinfo", "3306");

		if(!$this->mysqli){
			HttpService::return_service_unavailable();
		}
		
	}
	
	public function getConnection(){
		return $this->mysqli;
	}
	
	//destructor
	public function __destruct(){

	}
}

?>