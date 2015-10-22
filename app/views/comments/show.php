<?php
    /*
     * Expected variables:
     *
     * $user string The name of the user
     * $date string the formatted representation of the date
     * $comment string the comment itself
     */

?>

<article class="comment">
    <header>
        <?php echo("$user wrote on $date");?>
    </header>
    <?php echo("$comment \n");?>
</article>
