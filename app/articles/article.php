<?php

class Article {
	
	private $title;
	private $author;
	
	public function get_title(){
		return $this->title;
	}
	
	public function set_title($param1){
		$this->title = $param1;
	}
	
	public function get_author(){
		return $this->author;
	}
	
	public function set_author($param1){
		$this->author = $param1;
	}
	
}

?>