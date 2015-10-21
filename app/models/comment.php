<?php
class Comment {

    public $comment_id;
    public $user;
    public $text;
    public $creation_date;

    /**
     * Creates a new instance of comment
     *
     * @param $id int the id of the comment
     * @param $user string the alias of the user
     * @param $text string the comment of the user
     * @param $date int the timestamp of the comment
     */
    public function __construct($id, $user, $text, $date) {

        $this->comment_id = $id;
        $this->user = $user;
        $this->text = $text;
        $this->creation_date = $date;
    }
}

?>