<?php

/*
 * This class provides methods to handle articles
 */

class ArticleService
{

    /*
     * For the sake of simplicity use the service as a singleton
     */
    static private $instance = null;

    static public function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private $articles = array();
    private $file = '';

    private function __construct()
    {
        $this->file = realpath('../../data/articles.dat');
        $u = file_get_contents($this->file);
        $this->articles = unserialize($u);

        //$this->init();
    }

    function __destruct()
    {
        $s = serialize($this->articles);
        file_put_contents($this->file, $s);
    }

    private function __clone()
    {
    }

    /**
     * Returns all articles from the blog
     *
     * @return array<Article> Returns all articles
     */
    public function get_all()
    {
    	
    	#absteigend sortieren
    	uasort($this->articles, 'Article::compare_date_dsc');
    	
        return $this->articles;
    }

    /**
     * Returns the article with the given id if exists
     * @param $id string the id of the article
     * @return mixed Article the requested article or null
     */
    public function get_article($id){

        $res = null;

        if(isset($this->articles[$id])){
            $res = $this->articles[$id];
        }

        return $res;
    }

    public function update_article($article){
        $this->articles[$article->get_id()] = $article;
    }

    /**
     * Adds an article to the blog
     *
     * @param $user string the name of the user
     * @param $title string the title of the article
     * @param $keyword_string string a string containing the keywords separated with space
     * @param $content string the content of the article in block code
     */
    public function add_article($user, $title, $keyword_string, $content){

        $id = 'B'.(count($this->articles) + 1);
        $kws = $this->parse_keywords($keyword_string);

        $article = new Article($id, $user, $title, $kws, $content);
        $this->articles[$article->get_id()] = $article;
    }

    /**
     * Removes an article from the blog
     *
     * @param string $article The id of the article to remove
     * @return string a result string
     */
    public function remove_article($article)
    {
        $res = "Article $article not found";

        if(isset($this->articles[$article])){
            unset($this->articles[$article]);
            $res = "Article $article deleted";
        }

        return $res;
    }

    /**
     * Returns the comments of an article
     *
     * @param $article_id string The id of the article
     */
    public function get_comments($article_id){

    }

    /**
     * Adds a comment to an existing article
     * @param $comment Comment The comment to add
     */
    public function add_comment($comment){
    // Create unique comment id here
    }

    /**
     * Removes a comment
     * @param $comment_id string the id of the comment to remove
     */
    public function remove_comment($comment_id){

    }

    private function parse_keywords($keyword_string){
        $words = preg_split("/[\s]+/", $keyword_string);

        foreach($words as &$value){
            $value = strtoupper($value);
        }

        return $words;
    }
     
    private function init()
    {
        $this->articles = array();
        #Testdaten

        $this->add_article('Pati', 'First Article', 'php html', '<div>Das ist ein unglaublich beschissener Blogeintrag</div>');
        $this->add_article('Pati', 'Second Article', 'php html', '<div>Das ist ein unglaublich beschissener Blogeintrag</div>');
        $this->add_article('Andi', 'Third Article', 'php html', '<div>Das ist ein unglaublich beschissener Blogeintrag</div>');
    }
}