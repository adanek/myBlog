<?php

class Article {
	
	private $id;
	private $title;
	private $author;
	private $keywords = array();
	private $creation_date;
	private $change_date;
	private $text;

	public function __construct($id, $author, $title, $keywords, $content){
		$this->id            = $id;
		$this->author        = $author;
        $this->title         = $title;
        $this->keywords      = $keywords;
        $this->text          = $content;
        $this->creation_date = time();
        $this->change_date   = $this->creation_date;
	}
	
	public function get_id(){
		return $this->id;
	}

    public function set_id($param1){
        $this->id = $param1;
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

	public function set_keywords($keywords){
		$this->keywords = $keywords;
	}
	
	public function get_creation_date(){
		return $this->creation_date;
	}
	
	public function set_creation_date($date){
		$this->creation_date = $date;
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
	
	public static function compare_date_asc($a, $b) {
		$date1 = $a->get_creation_date();
		$date2 = $b->get_creation_date();
		if ($date1 == $date2) {
			return 0;
		}
		return ($date1 < $date2) ? - 1 : 1;
	}
	
	public static function compare_date_dsc($a, $b) {
		$date1 = $a->get_creation_date();
		$date2 = $b->get_creation_date();
		if ($date1 == $date2) {
			return 0;
		}
		return ($date1 > $date2) ? - 1 : 1;
	}
}

?>