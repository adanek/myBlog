<?php

include_once('../app/services/AuthenticationService.php');
include_once('../app/services/HttpService.php');

#Start session
session_start();

// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

// POST - Save article
if($method == "POST"){

	$user = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
	AuthenticationService::login($user, $password);

	// Redirect to articles
    HttpService::redirect_to('/articles/');
}

// GET - Show form
if($method == "GET"){

    $show_error = false;
	if(isset($_GET) && isset($_GET['login'])){
        $show_error = true;
    }

	$page_title = "Login";
	$page_content = '../app/views/login.php';
	include_once('../app/views/_layout.php');
}

?>