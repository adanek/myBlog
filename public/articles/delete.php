<?php
include_once('../../app/services/session.php');
include_once('../../app/models/article.php');
include_once('../../app/services/ArticleService.php');

$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

if($method == 'DELETE'){

    parse_str(file_get_contents("php://input"), $post_vars);

    if(isset($post_vars['id'])){
        $id = $post_vars['id'];

        $res = ArticleService::get_instance()->remove_article($id);
        echo($res);
    }
}
?>