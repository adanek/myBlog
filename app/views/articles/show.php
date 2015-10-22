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

    <div id="comment-add">
        <a id="btn-form-show" class="btn" href="javascript:showForm()">Leave a comment</a>

        <form id="form-comment" class="hidden">

            <div class="form-group">
                <input type="hidden" name="article-id" value="<?php echo($article_id); ?>">
            </div>

            <div class="form-group">
                <label for="comment">Your comment:</label>
                <textarea class="form-control" name="comment" id="comment" rows="10" autofocus></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Save" class="btn">
                <a href="javascript:hideForm()" class="btn">Cancel</a>
            </div>

        </form>
    </div>

    <div id="comments">
        <?php
        foreach ($comments as $comment) {

            $user = $comment->user;
            $date = date("F d, Y", $comment->creation_date);
            $comment = $comment->text;

            include('../../app/views/comments/show.php');
        }
        ?>

    </div>

</section>

<script src="/scripts/comment.js"></script>