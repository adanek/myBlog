<?php

/**
 * Class AuthenticationService
 *
 * This class provides functionality to authenticate a user
 * and provide information about his permissions
 */
class AuthenticationService
{
    /**
     * Checks if the current user has the permission to write an article
     * @return bool true if he has the permission
     */
    public static function can_write_article(){
        return isset($_SESSION['username']);
    }

    /**
     * Checks if the current user has the permission to edit the article
     * @param $article_id string the id of the article
     * @return bool true if he has the permission
     */
    public static function can_edit_article($article_id){
        return isset($_SESSION['username']);
    }

    /**
     * Checks if the current user has the permission to delete the article
     * @param $article_id string the id of the article
     * @return bool true if he has the permission
     */
    public static function can_delete_article($article_id){
        return isset($_SESSION['username']);
    }

    /**
     * login
     * @param $username string
     * @param $password string
     */
    public static function login($username, $password){

        if(is_null($username)){
            header('HTTP/1.0 404 Not Found');
            echo "<h1>Error 404 Not Found</h1>";
            echo "The page that you have requested could not be found.";
            exit();
        }

        $_SESSION['username'] = $username;
    }

    /**
     * logout
     */
    public static function logout(){
        session_destroy();
    }
}