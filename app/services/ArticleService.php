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

//        $this->init();
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
        return $this->articles;
    }

    /**
     * Returns the article with the given id if exists
     * @param $id string the id of the article
     * @return mixed Article the requested article or null
     */
    public function get_article($id){

        $res = null;

        if(in_array($id, $this->articles)){
            $res = $this->articles[$id];
        }

        return $res;
    }


    /**
     * Adds an article from the blog
     *
     * @param Article $article The article to add
     */
    public function add_article($article)
    {
        $id = count($this->articles) + 1;
        $new = new Article("B$id", $article->get_title(), $article->get_author(), $article->get_keywords(), $article->get_text());
        //array_push($this->articles, $new);
        $this->articles[$new->get_id()] = $new;
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

    private function init()
    {
        $this->articles = array();
        #Testdaten
        $article1 = new Article('B1', 'Test1', 'Pati', array('PHP', 'HTML'), 'Das ist ein unglaublich beschissener Blogeintrag');
        $article2 = new Article('B2', 'Test2', 'Pati', array('CSS', 'JS'), 'Und hier kommt auch schon der nächste nicht ganz so beschissene Eintrag');
        $article3 = new Article('B3', 'Test3', 'Andi', array('CSS', 'JS', 'PHP', 'HTML'), 'Andis Eintrag is ebenfalls nicht berauschend');

        $this->articles[$article1->get_id()]= $article1;
        $this->articles[$article2->get_id()]= $article2;
        $this->articles[$article3->get_id()]= $article3;
    }
}