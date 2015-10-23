<?php

/**
 * This class provides methods to handle articles
 */
include_once ('DatabaseService.php');
class ArticleService {
	/*
	 * For the sake of simplicity use the service as a singleton
	 */
	private static $instance = null;
	static public function get_instance() {
		if (null === self::$instance) {
			self::$instance = new self ();
		}

		return self::$instance;
	}
	private $articles = array ();
	private $file = '';
	private $sql_con = null;
	private function __construct() {

		// get db connection
		$db = new DatabaseService ();
		$this->sql_con = $db->getConnection ();

		if (! $this->sql_con) {
			HttpService::return_service_unavailable ();
		}
	}
	function __destruct() {
		// $s = serialize($this->articles);
		// file_put_contents($this->file, $s);
	}
	private function __clone() {
	}

	/**
	 * Returns all articles from the blog
	 *
	 * @return array<Article> Returns all articles
	 */
	public function get_all() {

		// absteigend sortieren
		$query = "SELECT article.id, article.author, article.title, article.creation_date, article.change_date, article.text, user.alias FROM article ";
		$query .= "INNER JOIN user ON article.author = user.id ORDER BY article.creation_date DESC";

		// select articles
		$result_article = $this->sql_con->query ( $query );

		$articles = array ();

		while ( $row = mysqli_fetch_assoc ( $result_article ) ) {

			// create new article object
			$article = new Article ( $row ['id'], $row ['alias'], $row ['title'], $this->getKeywords ( $row ['id'] ), $row ['text'] );
			$article->set_creation_date($row['creation_date']);
			$article->set_change_date($row['change_date']);
			array_push ( $articles, $article );
		}

		return $articles;
	}

	/**
	 * Returns the article with the given id if exists
	 *
	 * @param $id string
	 *        	the id of the article
	 * @return mixed Article the requested article or null
	 */
	public function get_article($id) {
		$query = "SELECT article.id, article.author, article.title, article.creation_date, article.change_date, article.text, user.alias FROM article ";
		$query .= "INNER JOIN user ON article.author = user.id WHERE article.id = " . $id;

		$result_article = $this->sql_con->query ( $query );

		$row = mysqli_fetch_assoc ( $result_article );

		$article = new Article ( $row ['id'], $row ['alias'], $row ['title'], $this->getKeywords ( $row ['id'] ), $row ['text'] );
		$article->set_creation_date($row['creation_date']);
		$article->set_change_date($row['change_date']);
		return $article;
	}

	/**
	 * Adds an article to the blog
	 *
	 * @param $user string
	 *        	the name of the user
	 * @param $title string
	 *        	the title of the article
	 * @param $keyword_string string
	 *        	a string containing the keywords separated with space
	 * @param $content string
	 *        	the content of the article in block code
	 */
	public function add_article($user, $title, $keyword_string, $content) {

		$time = time();
		
		$query  = "INSERT INTO `webinfo`.`article` (`id`, `title`, `author`, `creation_date`, `change_date`, `text`) ";
		$query .= "VALUES (NULL, '$title', '$user', '$time', '$time', '$content')";
		
		//insert article
		$this->sql_con->query($query);
		
		//get created id
        $id = mysqli_insert_id($this->sql_con);
        $this->updateKeywords($id, $keyword_string);
	}

	/**
	 * Updates an existing article
	 *
	 * @param $id string
	 *        	the id of the article
	 * @param $title string
	 *        	the title of the article
	 * @param $keyword_string string
	 *        	a string containing the keywords separated with space
	 * @param $content string
	 *        	the content of the article in block code
	 */
	public function update_article($id, $title, $keyword_string, $content) {
		$query = "SELECT * FROM article WHERE id = " . $id;
		$result = $this->sql_con->query ( $query );

		$row = mysqli_fetch_assoc ( $result );

		if (! isset ( $row )) {
			HttpService::return_not_found ();
		}

		$change_date = time();

		$query = "UPDATE article SET title = '$title', text = '$content', change_date = '$change_date' WHERE id = '$id'";
		$result = $this->sql_con->query ( $query );

		if (! isset ( $result )) {
			HttpService::return_not_found ();
		}

		$this->updateKeywords($id, $keyword_string);
		
	}

	/**
	 * Removes an article from the blog
	 *
	 * @param string $article
	 *        	The id of the article to remove
	 * @return string a result string
	 */
	public function remove_article($article) {

		//first delete keywords
		$this->deleteKeywords($article);
		
		//delete article
		$query = "DELETE FROM article WHERE id = '$article'";
		$result = $this->sql_con->query($query);
		
		$res = "Article $article deleted";

		return $res;
	}

	/**
	 * Splits an string of space separated keywords into an array
	 *
	 * @param $keyword_string string
	 *        	the string containing the keywords separated with space
	 * @return array an array containing the keywords
	 */
	private function parse_keywords($keyword_string) {
		$words = preg_split ( "/[\s]+/", $keyword_string );

		foreach ( $words as &$value ) {
			$value = strtoupper ( $value );
		}

		return $words;
	}

	/**
	 * Create some demo data
	 */
	private function init() {
		$this->articles = array ();
		// Testdaten

		$this->add_article ( 'Pati', 'First Article', 'php html', '<div>Das ist ein unglaublich beschissener Blogeintrag</div>' );
		$this->add_article ( 'Pati', 'Second Article', 'php html', '<div>Das ist ein unglaublich beschissener Blogeintrag</div>' );
		$this->add_article ( 'Andi', 'Third Article', 'php html', '<div>Das ist ein unglaublich beschissener Blogeintrag</div>' );
	}

	/**
	 * get keywords from article
	 */
	private function getKeywords($id) {

		// select keywords per article
		$result_keywords = $this->sql_con->query ( "SELECT * FROM keywords WHERE article = " . $id );

		$keywords = array ();

		while ( $row_keywords = mysqli_fetch_assoc ( $result_keywords ) ) {
			array_push ( $keywords, $row_keywords ['keyword'] );
		}
		return $keywords;
	}
	
	/**
	 * update keywords in database
	 */	
	private function updateKeywords($id, $keyword_string){
		
		//first delete keywords
		$this->deleteKeywords($id);
		
		$keywords = $this->parse_keywords ( $keyword_string );
		
		foreach($keywords AS $val ) {

            if(!empty($val)){
                $query = "INSERT INTO `webinfo`.`keywords` (`article`, `keyword`) VALUES ('$id', '$val')";
                $result = $this->sql_con->query($query);
            }
		}
		
	}
	
	/**
	 * delete keywords in database
	 */
	private function deleteKeywords($id){
		
	    $query = "DELETE FROM keywords WHERE article = '$id'";
		$result = $this->sql_con->query ( $query );
		
	}
}

?>