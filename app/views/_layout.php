<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myBlog<?php if(isset($page_title)){ echo(" - $page_title");} ?></title>

    <link rel="stylesheet" href="/styles/main.css" />
</head>
<body>
<?php include($page_content);?>
</body>
</html>