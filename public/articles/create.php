<?php

// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

include_once('../../app/services/session.php');
include_once('../../app/services/AuthenticationService.php');
include_once('../../app/services/HttpService.php');

if(!AuthenticationService::can_write_article()){
    HttpService::return_unauthorized();
}

// POST - Save article
if($method == "POST"){

    include_once('../../app/models/article.php');
    include_once('../../app/services/ArticleService.php');
    include_once('../../app/services/SanitationService.php');
    include_once('../../app/services/HttpService.php');

    // Parse parameters from request
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;
    $user = $_SESSION['username'];

    // Validate required parameters
    if(!isset($title, $content, $user)){
        HttpService::return_bad_request();
    }

    // Sanitize user input
    $title = SanitationService::convertHtml($title);
    $keywords = SanitationService::convertHtml($keywords);
    $content = SanitationService::convertHtml($content);

    // Save article
    $articles = ArticleService::get_instance();
    $articles->add_article($user, $title, $keywords, $content);

    // Redirect to articles
    HttpService::redirect_to('/articles/index.php');
}

// GET - Show form
if($method == "GET"){

    $page_title = "New Article";
    $form_action = '/articles/create.php';

    $id = '';
    $title = '';
    $keywords = '';
    $author = $_SESSION['username'];
    $content = '';
    $date = date('F d, Y', time());

    $page_content = '../../app/views/articles/edit.php';

    include_once('../../app/views/_layout.php');
}



