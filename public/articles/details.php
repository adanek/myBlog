<?php

include_once('../../app/services/session.php');
include_once('../../app/models/article.php');
include_once('../../app/models/comment.php');
include_once('../../app/services/ArticleService.php');
include_once('../../app/services/HttpService.php');
include_once('../../app/services/BulletBoardCodeParser.php');
include_once('../../app/services/AuthenticationService.php');
include_once('../../app/services/SanitationService.php');
include_once('../../app/services/CommentService.php');


// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

// GET - Show form
if($method == "GET"){

    if(!isset($_GET['id'])){
        HttpService::return_bad_request();
    }

    $id = $_GET['id'];

    $srv = ArticleService::get_instance();
    $article = $srv->get_article($id);

    if(!isset($article)){
        HttpService::return_not_found();
    }

    $article_id = $article->get_id();
    $title = $article->get_title();
    $keywords = $article->get_keywords();
    $author = $article->get_author();
    $content = BulletBoardCodeParser::convertToHtml($article->get_text());
    $creation_date = date('F d, Y', $article->get_creation_date());

    $commentsSrv = new CommentService();
    $comments = $commentsSrv->get_comments_from_article($article_id);

    $page_title = "Article $id";
    $page_content = '../../app/views/articles/details.php';

    include_once('../../app/views/_layout.php');
    exit();
}

// Otherwise
HttpService::return_not_found();

