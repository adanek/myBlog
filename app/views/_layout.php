<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myBlog<?php if(isset($page_title)){ echo(" - $page_title");} ?></title>
	<link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/styles/main.css" />
</head>

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