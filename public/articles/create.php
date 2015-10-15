<?php

// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

// POST - Save article
if($method == "POST"){

    include_once('../../app/models/article.php');
    include_once('../../app/services/ArticleService.php');

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

    $page_title = "New Article";
    $form_action = '/articles/create.php';

    $id = '';
    $title = '';
    $keywords = '';
    $author = 'm.muster';
    $content = '';
    $date = 'October 15, 2015';

    $page_content = '../../app/views/articles/edit.php';

    include_once('../../app/views/_layout.php');
}



