<?php

class Article {
	
	private $title;
	
	public function get_title(){
		return $this->title;
	}
	
	public function set_title($param1){
		$this->title = $param1;
	}
	
}

?>