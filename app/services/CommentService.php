<?php

include_once('DatabaseService.php');

/**
 * Class CommentService
 * This class provides Methods to create, query and delete Comments
 */
class CommentService
{

    public $sql_con = null;

    //constructor
    public function __construct()
    {

        // get db connection
        $db = new DatabaseService ();
        $this->sql_con = $db->getConnection();

        if (!$this->sql_con) {
            HttpService::return_service_unavailable();
        }
    }

    /**
     * Returns the comments from the article with the given id
     * @param $article_id the id of the article
     * @return array <Comment> containing all comments or null if article does not exist
     */
    public function get_comments_from_article($article_id)
    {

        $comments = array();

        //build select query
        $query = "SELECT comment.id, comment.user_id, comment.text, comment.creation_date, user.alias FROM comment ";
        $query .= "INNER JOIN user ON comment.user_id = user.id WHERE comment.article = " . $article_id;

        // select comments
        $result_comments = $this->sql_con->query($query);

        while ($row = mysqli_fetch_assoc($result_comments)) {

            // create new article object
            $comment = new Comment ($row ['id'], $row ['alias'], $row ['text'], $row['creation_date']);
            array_push($comments, $comment);
        }

        return $comments;
    }

    /**
     * Returns the comment with the given id
     * @param $comment_id
     * @return Comment the comment or null if it does not exist     *
     */
    public function get_comment($comment_id)
    {

        $query = "SELECT comment.id, comment.user_id, comment.text, comment.creation_date, user.alias
                  FROM comment
                  INNER JOIN user ON comment.user_id = user.id
                  WHERE comment.id = $comment_id";

        $result = $this->sql_con->query($query);

        $row = mysqli_fetch_assoc($result);

        $comment = new Comment($row['id'], $row['alias'], $row['text'], $row['creation_date']);
        return $comment;
    }

    /**
     * Adds a comment to the article with the given id
     * @param $article_id the id of the article
     * @param $text the text of the comment
     * @return Comment the new comment
     */
    public function add_comment_to_article($article_id, $text)
    {

        $username = AuthenticationService::get_current_username();
        $date = time();

        //get user id from alias
        $query = "SELECT id FROM user WHERE alias = '$username'";
        $result = $this->sql_con->query($query);

        $row = mysqli_fetch_assoc($result);

        $user_id = $row['id'];

        $query = "INSERT INTO `webinfo`.`comment` (`user_id`, `text`, `creation_date`, `article`) ";
        $query .= "VALUES ('$user_id', '$text', '$date', '$article_id')";

        $result = $this->sql_con->query($query);

        $id = mysqli_insert_id($this->sql_con);
        $comment = new Comment($id, $username, $text, $date);
        return $comment;
    }

    /**
     * Deletes the comment with the given id
     * @param $comment_id the id of the comment
     */
    public function delete_comment($comment_id)
    {

        $query = "DELETE FROM `webinfo`.`comment` WHERE `comment`.`id` = '$comment_id'";
        $result = $this->sql_con->query($query);
    }
}

?>