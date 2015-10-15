<?php

#Start session
session_start();

// Check if post or get
$method = $_SERVER['REQUEST_METHOD'];

// POST - Save article
if($method == "POST"){

	$user = isset($_POST['username']) ? $_POST['username'] : null;

	if(is_null($user)){
		header('HTTP/1.0 404 Not Found');
		echo "<h1>Error 404 Not Found</h1>";
		echo "The page that you have requested could not be found.";
		exit();
	}

	$_SESSION['username'] = $user;

	// Redirect to articles
	header('Location: '.'/articles/index.php' );
	die();
}

// GET - Show form
if($method == "GET"){

	$page_title = "Login";

	include_once('../app/views/login.php');
}

?>