<?php

/**
 * Class AuthenticationService
 *
 * This class provides functionality to authenticate a user
 * and provide information about his permissions
 */
include_once('DatabaseService.php');
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
        if(isset($_SESSION['username']) && ($comment->user == $_SESSION['username'])){
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

        // Delete Mocking behavior

    	// get db connection
    	$db = new DatabaseService ();
    	$sql_con = $db->getConnection();
    	
    	//connection failed
    	if (!$sql_con) {
    		HttpService::return_service_unavailable();
    	}
    	
    	//get hash algos
    	$algos = hash_algos();
    	
    	//take the 3rd algo
    	$algo = $algos[2];
    	
    	$pw_hash = hash($algo, $password);

    	//get user from db
    	$query = "SELECT * FROM user WHERE alias = '$username' AND password = '$pw_hash'";
    	$result = $sql_con->query($query);
    	
    	$row = mysqli_fetch_assoc($result);
    	
    	//login data correct?
    	if(!isset($row)){
    		HttpService::redirect_to('/login/fail');
        }
    	
    	//add alias to session
    	$_SESSION['username'] = $row['alias'];
        $_SESSION['user_id'] = $row['id'];
    	
    	$roles = array();
    	
    	//add user role
    	switch($row['role']){
    		case 1:
    			array_push($roles, 'admin');
    			break;
    		case 2:
    			array_push($roles, 'author');	
    			break;
    		case 3:
    			array_push($roles, 'user');
    			break;
    	}
    	
    	//add roles to session
    	$_SESSION['roles'] = $roles;
    	
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

    /**
     * Returns the id of the current user
     * @return string|null the id of the current user
     */
    public static function get_current_user_id(){

        $id = null;
        if(isset($_SESSION) && isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
        }

        return $id;
    }
}