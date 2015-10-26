<?php
/*
 * Expected variables:
 *
 * $user string The name of the user
 * $date string the formatted representation of the date
 * $comment string the comment itself
 */

?>

<article class="comment clearfix" id="comment-<?php echo($comment->comment_id); ?>">

    <img src="/img/user.png" alt="user icon" class="icon-user"/>

    <header>
        <span class="author"><?php echo($user); ?></span> - <span class="article-date"><?php echo($date); ?></span>
    </header>
    <p><?php echo("$text \n"); ?></p>

    <?php if (AuthenticationService::can_delete_comment($comment)) { ?>
        <div class="comment-delete">
            <a href="javascript:deleteComment(<?php echo($comment->comment_id); ?>)">
                <img class="icon icon-trash" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4
                    ixAAABp0lEQVRoQ+2ZfVHEQAzFf6cAJOAAUAA4wAGDAnAAOAAHSAAFgALAATgABTCP2c6ETtv96sfNXfLX3TTd7EtedtNkxYbIak
                    Nw4EDWLZIekW2JyB5wARwMAP4A7oC3MZwyBbUE4hXYTdzg4RhgpgByDVwlgpDaI3Caod+pOgWQZ+AoWHsB9L8titqZ0TledyA3g
                    CLUFm38aUkgP7Weq3j/pCe6f0vmUsuBVESieXXUiGhReyopmasTtQNkto1cajmQTGp5RHIc1uctlST7ZiHlTyPNBan/78BXeKBab
                    Cf8/gRUfxXRd8wcsZdc+2i3x7Y9fWwVYC/PRanlQAKdPCIlJcpQIjq1nFrmfPfjt+OjyHPEc8RzZLig8xzxHPEc2ZIcyfnKjOku
                    +mEV21zOcwdS6i0NaTTfGFtuw6BI6/Y1wv/ZLKl+2xffPfBgOiO1oDQruTSLnAOyMSglQLSg7X7EbNQ8V4tIs5SolAJRD0tgbB8
                    raixT4Tv0lZNmjKVAmj2JAqJa6rwwFYuoKjo1jbzoe7VAogbmUnAgc3k61Y5HJNVTc+ltTER+Ae3S5DOrL0NoAAAAAElFTkSuQmCC">
            </a>
        </div>
    <?php } ?>

</article>
