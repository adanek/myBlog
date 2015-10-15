<?php

include_once('../../app/services/session.php');
include_once('../../app/models/article.php');
include_once('../../app/services/ArticleService.php');

// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

// POST - Save article
if($method == "POST"){

    $id = $_POST['id'];
    $srv = ArticleService::get_instance();
    $article = $srv->get_article($id);

    if(is_null($article)){
        header('HTTP/1.0 404 Not Found');
        echo "<h1>Error 404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }

    $article->set_title($_POST['title']);
    $article->set_keywords(preg_split("/[\s]+/", $_POST['keywords']));
    $article->set_text($_POST['content']);

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

    if(is_null($article)){
        header('HTTP/1.0 404 Not Found');
        echo "<h1>Error 404 Not Found</h1>";
        echo "The page that you have requested could not be found.";
        exit();
    }

    $title = $article->get_title();
    $keywords = implode(' ', $article->get_keywords());
    $author = 'm.muster';
    $content = $article->get_text();
    $date = 'October 15, 2015';

    $page_title = "Edit Article";
    $form_action = '/articles/edit.php';
    $page_content = '../../app/views/articles/edit.php';

    include_once('../../app/views/_layout.php');
}
