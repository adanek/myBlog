

<form action="<?php echo($form_action); ?>" method="post">
    <div class="form-group">
        <label for="article_title">Title:</label>
        <input id="article_title" name="title" type="text" class="form-control">
    </div>
    <div class="form-group">
        <label for="article_keywords">Keywords:</label>
        <input id="article_keywords" name="keywords" type="text" class="form-control" placeholder="seperate with space">
    </div>
    <div class="form-group">
        <label for="article_content">Content:</label>
        <textarea id="article_content" name="content" rows="5" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <input type="submit">
    </div>
</form>