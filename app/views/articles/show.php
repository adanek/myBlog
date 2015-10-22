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
    <a class="btn">Leave a comment</a>
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
