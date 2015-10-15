<?php

class Article {
	
	private $id;
	private $title;
	private $author;
	private $keywords = array();
	private $creation_date;
	private $change_date;
	private $text;

	public function __construct($id, $title, $author, $keywords, $text){
		$this->id            = $id;
		$this->title         = $title;
		$this->author        = $author;
		$this->keywords      = $keywords;
		$this->creation_date = time();
		$this->text          = $text;
	}
	
	public function get_id(){
		return $this->id;
	}
	
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
	
	public function get_keywords(){
		return $this->keywords;
	}

	public function set_keywords($kws){
		$this->keywords = $kws;
	}
	
	public function add_keyword($param1){
		array_push($this->keywords, $param1);
	}
	
	public function get_creation_date(){
		return $this->creation_date;
	}
	
	public function get_change_date(){
		return $this->change_date;
	}
	
	public function set_change_date($param1){
		$this->change_date = $param1;
	}
	
	public function get_text(){
		return $this->text;
	}
	
	public function set_text($param1){
		$this->text = $param1;
	}
}

?>