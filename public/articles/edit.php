<?php

include_once('../../app/models/article.php');
include_once('../../app/services/ArticleService.php');

// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

// POST - Save article
if($method == "POST"){

    $article_title = isset($_POST['title']) ? $_POST['title'] : null;
    $article_keywords = isset($_POST['keywords']) ? preg_split("/[\s]+/", $_POST['keywords']) : null;
    $article_content = isset($_POST['content']) ? $_POST['content'] : null;

    $article = new Article("", $article_title, "m.muster", $article_keywords, $article_content);

    $articles = ArticleService::get_instance();
    $articles->add_article($article);

    // Redirect to articles
    header('Location: /articles/index.php');
    die();
}

// GET - Show form
if($method == "GET"){

    $page_title = "Edit Article";
    $form_action = '/articles/edit.php';

    $title = 'First Blog entry';
    $keywords = 'css js awesome';
    $author = 'm.muster';
    $content = 'This is some content.';
    $date = 'October 15, 2015';

    $page_content = '../../app/views/articles/edit.php';

    include_once('../../app/views/_layout.php');
}
