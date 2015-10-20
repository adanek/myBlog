<?php

include_once('../../app/services/session.php');
include_once('../../app/models/article.php');
include_once('../../app/services/ArticleService.php');
include_once('../../app/services/SanitationService.php');
include_once('../../app/services/HttpService.php');

// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

// POST - Save article
if($method == "POST"){

    // Parse parameters from request
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;
    $user = $_SESSION['username'];
    $id = $_POST['id'];

    // Validate required parameters
    if(!isset($title, $content, $user, $id)){
        HttpService::return_bad_request();
    }

    // Sanitize user input
    $title = SanitationService::convertHtml($title);
    $keywords = SanitationService::convertHtml($keywords);
    $content = SanitationService::convertHtml($content);

    // Save article
    $articles = ArticleService::get_instance();
    $articles->update_article($id, $title, $keywords, $content);

    // Redirect to articles
    header('Location: /articles/index.php');
    die();


    $srv = ArticleService::get_instance();
    $article = $srv->get_article($id);

    if(is_null($article)){
        header('HTTP/1.0 404 Not Found');
        echo "<h1>Error 404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }

    $article->set_title($_POST['title']);
    $article->set_keywords($_POST['keywords']);
    $article->set_text($_POST['content']);
    $article->set_change_date(time());

    $srv->update_article($article);

    // Redirect to articles
    header('Location: /articles/index.php');
    die();
}

// GET - Show form
if($method == "GET"){

    $id = $_GET['id'];

    $srv = ArticleService::get_instance();
    $article = $srv->get_article($id);

    if(!isset($article)){
        HttpService::return_not_found();
    }

    $title = $article->get_title();
    $keywords = implode(' ', $article->get_keywords());
    $author = $article->get_author();
    $content = $article->get_text();
    $date = date('F d, Y', $article->get_creation_date());

    $page_title = "Edit Article";
    $form_action = '/articles/edit.php';
    $page_content = '../../app/views/articles/edit.php';

    include_once('../../app/views/_layout.php');
}
