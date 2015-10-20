<?php

include_once('../../app/services/session.php');
include_once('../../app/models/article.php');
include_once('../../app/services/ArticleService.php');


// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

// GET - Show form
if($method == "GET"){

    if(!isset($_GET['id'])){

        // Set response status to bad request
        http_response_code(400);
        exit();
    }

    $id = $_GET['id'];

    $srv = ArticleService::get_instance();
    $article = $srv->get_article($id);

    if(is_null($article)){
        // Set response status to Not Found
        http_response_code(404);
        exit();
    }

    $title = $article->get_title();
    $keywords = implode(' ', $article->get_keywords());
    $author = $article->get_author();
    $content = $article->get_text();
    $creation_date = date('F d, Y', $article->get_creation_date());

    $page_title = "Article $id";
    $page_content = '../../app/views/articles/show.php';

    include_once('../../app/views/_layout.php');
}
