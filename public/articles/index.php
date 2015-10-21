<?php

include_once('../../app/services/session.php');
include_once('../../app/models/article.php');
include_once('../../app/services/ArticleService.php');
include_once('../../app/services/HttpService.php');
include_once('../../app/services/BulletBoardCodeParser.php');

$page_title = "Articles";
$page_content ='../../app/views/articles/index.php';

$srv = ArticleService::get_instance();
$articles = $srv->get_all();

include_once('../../app/views/_layout.php');



