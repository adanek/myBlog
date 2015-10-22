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

        if(!AuthenticationService::can_delete_article($id)){
            HttpService::return_unauthorized();
        }

        ArticleService::get_instance()->remove_article($id);
        exit();
    }
}

//Otherwise
HttpService::return_not_found();

?>