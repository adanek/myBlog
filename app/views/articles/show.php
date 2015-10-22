<a class="btn" href="/articles/index.php">Back to list</a>

<article>

    <header>
        <div class="title"><?php echo($title); ?></div>
        <div class="sub-title">form <?php echo($author); ?> on <?php echo($creation_date); ?></div>
    </header>

    <div class="content">
        <?php echo($content); ?>
    </div>

</article>

<section>
    <header>Comments:</header>
    <a class="btn" onclick="showForm()">Leave a comment</a>

    <form class="form-comment">
        <div class="form-group">
            <input type="hidden" name="article-id" value="<?php echo($article_id);?>"
        </div>
        <div class="form-group">
            <label for="comment">Your comment:</label>
            <textarea class="form-control" name="comment" id="comment" rows="10"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Save" class="btn">
        </div>
    </form>
<?php
        foreach($comments as $comment){

            ?>

<article class="comment">
    <header>
        <span><?php echo("$comment->user wrote on ".date("F d, Y", $comment->creation_date))?></span>
    </header>
    <p>
        <?php echo($comment->text);?>
    </p>
</article>

<?php }?>

</section>

<script src="/scripts/comment.js"></script>