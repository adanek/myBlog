<?php

include_once('../../app/services/session.php');
include_once('../../app/services/HttpService.php');
include_once('../../app/services/AuthenticationService.php');
include_once('../../app/services/SanitationService.php');
include_once('../../app/services/ArticleService.php');
include_once('../../app/services/CommentService.php');
include_once('../../app/models/comment.php');

$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST"){

    // Check user role
    if(!AuthenticationService::can_write_comment()){
        HttpService::return_unauthorized();
    }

    // Validate data
    $article_id = SanitationService::convertHtml($_POST['article-id']);
    $text = SanitationService::convertHtml($_POST['comment']);

    // Save comment
    $comments = new CommentService();
    $comment = $comments->add_comment_to_article($article_id, $text);

    // Generate view data
    $user = $comment->user;
    $date = date("F d, Y", $comment->creation_date);
    $text = $comment->text;

    // Return comment to client
    include('../../app/views/comments/show.php');
    exit();
}

if($method == 'DELETE'){

    // Get form data
    parse_str(file_get_contents("php://input"), $post_vars);

    if(isset($post_vars['comment-id'])){

        $comment_id = $post_vars['comment-id'];
        $comments = new CommentService();
        $comment = $comments->get_comment($comment_id);

        // Check existence
        if(!isset($comment)){
            HttpService::return_not_found();
        }

        // Check permission
        if(!AuthenticationService::can_delete_comment($comment)){
            HttpService::return_unauthorized();
        }

        // Delete article
        $comments->delete_comment($comment_id);
        exit();
    }

    HttpService::return_bad_request();
}

// Otherwise
HttpService::return_not_found();

?>