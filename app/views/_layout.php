<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myBlog<?php if(isset($page_title)){ echo(" - $page_title");} ?></title>

    <link rel="stylesheet" href="/styles/main.css" />
</head>

<?php 
	#Session starten
	session_start();
	
	#redirect zum Login Form
	if(!isset($_SESSION['username'])){
		header('Location: '.'/login.php' );
		die();
	}
?>

<body>

<header>
    <a href="/">Welcome to myBlog.com</a>
</header>

<div class="content">
    <?php include($page_content);?>
</div>

<footer>
    <div class="footer">
        <p class="credit">Brought to you by Team 1 Webdesign</p>
    </div>
</footer>

</body>
</html>