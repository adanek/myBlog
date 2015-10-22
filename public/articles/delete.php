<?php
include_once('../../app/services/session.php');
include_once('../../app/models/article.php');
include_once('../../app/services/ArticleService.php');
include_once('../../app/services/AuthenticationService.php');
include_once('../../app/services/HttpService.php');

$method = $_SERVER['REQUEST_METHOD'];


if($method == 'DELETE'){

    parse_str(file_get_contents("php://input"), $post_vars);

    if(isset($post_vars['id'])){
        $id = $post_vars['id'];

        $articles = ArticleService::get_instance();
        $article = $articles->get_article($id);

        // Check existence
        if(!isset($article)){
            HttpService::return_not_found();
        }

        // Check permission
        if(!AuthenticationService::can_delete_article($article)){
            HttpService::return_unauthorized();
        }

        // Delete article
        $articles->remove_article($id);
        exit();
    }

    HttpService::return_bad_request();
}

//Otherwise
HttpService::return_not_found();

?>