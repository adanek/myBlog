<?php

/**
 * Class CommentService
 * This class provides Methods to create, query and delete Comments
 */
class CommentService
{
    /**
     * Returns the comments from the article with the given id
     * @param $article_id the id of the article
     * @return array <Comment> containing all comments or null if article does not exist
     */
    public function get_comments_from_article($article_id){
        $comments = array();
        array_push($comments, new Comment(1, 'Tim', 'Men! That\'s awesome', 5555));
        array_push($comments, new Comment(2, 'Ben', 'Best article ever', 5556));

        return $comments;
    }

    /**
     * Returns the comment with the given id
     * @param $comment_id
     * @return Comment the comment or null if it does not exist     *
     */
    public function get_comment($comment_id){

    }

    /**
     * Adds a comment to the article with the given id
     * @param $article_id the id of the article
     * @param $text the text of the comment
     * @return Comment the new comment
     */
    public function add_comment_to_article($article_id, $text){
        $username = AuthenticationService::get_current_username();
        $date = time();

        // Push to database
    }

    /**
     * Deletes the comment with the given id
     * @param $comment_id the id of the comment
     */
    public function delete_comment($comment_id){

    }
}

?>