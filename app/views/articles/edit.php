<!--
    expect variables:

    $form_action string
    $title : string;
    $keywords string;
    $author string;
    $content string;
    $date string;
-->

<form action="<?php echo($form_action); ?>" method="post">
    <div class="header">
        <h3><?php echo($author);?> <small><?php echo($date);?></small></h3>
        <input type="hidden" name="id" value="<?php echo($id);?>">
    </div>

    <div class="form-group">
        <label for="article_title">Title:</label>
        <input id="article_title" name="title" type="text" class="form-control" value="<?php echo($title);?>">
    </div>
    <div class="form-group">
        <label for="article_keywords">Keywords:</label>
        <input id="article_keywords" name="keywords" type="text" class="form-control" placeholder="seperate with space" value="<?php echo($keywords);?>">
    </div>
    <div class="form-group">
        <label for="article_content">Content:</label>
        <textarea id="article_content" name="content" rows="5" class="form-control"><?php echo($content);?></textarea>
    </div>
    <div class="form-group">
        <input type="submit">
    </div>
</form>