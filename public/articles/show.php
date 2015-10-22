<?php

include_once('../../app/services/session.php');
include_once('../../app/models/article.php');
include_once('../../app/models/comment.php');
include_once('../../app/services/ArticleService.php');
include_once('../../app/services/HttpService.php');
include_once('../../app/services/BulletBoardCodeParser.php');
include_once('../../app/services/AuthenticationService.php');
include_once('../../app/services/SanitationService.php');


// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST"){

    // Check user role
    if(!AuthenticationService::can_write_comment()){
        HttpService::return_unauthorized();
    }

    // Validate data
    $user = $_SESSION["username"];
    $date = date("F d, Y", time());
    $article_id = SanitationService::convertHtml($_POST['article-id']);
    $comment = SanitationService::convertHtml($_POST['comment']);

    // Save comment
    $articles = ArticleService::get_instance();
    $articles->add_comment($comment);

    // Return comment to client
    include('../../app/views/comments/show.php');
}

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

    $comments = array();
    array_push($comments, new Comment(1, 'Tim', 'Men! That\'s awesome', 5555));
    array_push($comments, new Comment(2, 'Ben', 'Best article ever', 5556));

    $page_title = "Article $id";
    $page_content = '../../app/views/articles/show.php';

    include_once('../../app/views/_layout.php');
}

