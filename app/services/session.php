<?php 
	#Session starten
	session_start();
	
	#redirect zum Login Form
	if(!isset($_SESSION['username'])){
		header('Location: '.'/login.php' );
		die();
	}
?>
