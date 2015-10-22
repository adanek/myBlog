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

        // Check if client is author
        if(isset($_SESSION['roles']) && in_array('author', $_SESSION['roles'])){
            return true;
        }

        // Check if client is admin
        if(isset($_SESSION['roles']) && in_array('admin', $_SESSION['roles'])){
            return true;
        }

        return false;
    }

    /**
     * Checks if the current user has the permission to edit the article
     * @param $article Article the article to check against
     * @return bool true if he has the permission
     */
    public static function can_edit_article($article){

        // Check if client is the author of the article
        if(isset($_SESSION['username']) && ($article->get_author()==$_SESSION['username'])){
            return true;
        }

        return false;
    }

    /**
     * Checks if the current user has the permission to delete the article
     * @param $article Article the article to check against
     * @return bool true if he has the permission
     */
    public static function can_delete_article($article){

        // Check if client is admin
        if(isset($_SESSION['roles']) && in_array('admin', $_SESSION['roles'])){
            return true;
        }

        // Check if client is the author of the article
        if(isset($_SESSION['username']) && ($article->get_author()==$_SESSION['username'])){
            return true;
        }

        return false;
    }

    /**
     * Checks if the current user has the permission to write a comment to any article
     * @return bool true if he has the permission
     */
    public static function can_write_comment(){

        // Check if client is user
        if(isset($_SESSION['roles']) && in_array('user', $_SESSION['roles'])){
            return true;
        }

        // Check if client is author
        if(isset($_SESSION['roles']) && in_array('author', $_SESSION['roles'])){
            return true;
        }

        // Check if client is admin
        if(isset($_SESSION['roles']) && in_array('admin', $_SESSION['roles'])){
            return true;
        }

        return false;
    }

    /**
     * Checks if the current client has the permission to delete a specific comment
     * @param $comment Comment the comment to check against
     * @return bool true if the client has the permission
     */
    public static function can_delete_comment($comment){

        // Check if client is admin
        if(isset($_SESSION['roles']) && in_array('admin', $_SESSION['roles'])){
            return true;
        }

        // Check if client is the author of the comment
        if(isset($_SESSION['username']) && ($comment->user ==$_SESSION['username'])){
            return true;
        }

        return false;
    }

    /**
     * login
     * @param $username string
     * @param $password string
     */
    public static function login($username, $password){

        // Todo: Implement user/password check
        // If successful then add all roles to the array roles in the current session
        // Set user alias as in session['username']
        // Delete Mocking behavior

        // Mocking behavior begin

        if(is_null($username)){
            header('HTTP/1.0 404 Not Found');
            echo "<h1>Error 404 Not Found</h1>";
            echo "The page that you have requested could not be found.";
            exit();
        }

        $roles = array();

        if($username == 'Andi'){

            array_push($roles, 'author');
        }

        if($username == 'Pati'){
            array_push($roles, 'admin');
        }

        if($username == 'Tim'){
            array_push($roles, 'user');
        }

        $_SESSION['roles'] = $roles;
        $_SESSION['username'] = $username;

        // Mocking behavior end
    }

    /**
     * logout
     */
    public static function logout(){

        if(isset($_SESSION)){
            session_destroy();
        }
    }

    /**
     * Returns the name of the current user
     * @return string the name of the current user or null if no user is logged in
     */
    public static function get_current_username(){

        $name = null;
        if(isset($_SESSION) && isset($_SESSION['username'])){
            $name = $_SESSION['username'];
        }

        return $name;
    }
}