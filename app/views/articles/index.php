<a href="/articles/create.php" class="btn">Write a new article</a>

<?php
while (list($art_key, $art) = each($articles)) { ?>

    <article>
        <header>
            <span class="article-date"><?php echo(date('F d, Y', $art->get_creation_date())); ?></span>

            <div class="title"><a href="/articles/show.php?id=<?php echo($art->get_id()); ?>"><?php echo($art->get_title()); ?></a></div>
            <div class="subtitle">
                <span class="author"><?php echo($art->get_author()); ?></span>
                <span>
                    <?php
                    $keywords = $art->get_keywords();
                    while (list($key, $val) = each($keywords)) {
                        ?>
                        <span class="label"><?php echo($val); ?></span>

                        <?php
                    }
                    ?>
                </span>
            </div>
        </header>

        <div class="article-body">
            <p>
                <?php
                    if(strlen($art->get_text()) > 250) {

                        // Cut the content at the last white space in the first 250 chars
                        $text = substr($art->get_text(), 0, 250);
                        $last = strrpos($text, ' ');
                        $text = substr($text, 0 , $last);
                        echo($text);
                ?>
                        <span class="more"><a href="/articles/show.php?id=<?php echo($art->get_id()); ?>"> ...</a></span>
                <?php
                    } else {
                        echo($art->get_text());
                    }
                ?>
            </p>
        </div>

        <footer>
            <div>

                <?php
                if($art->get_creation_date() != $art->get_change_date()){ ?>
                    <span>last modified on <?php echo(date('F d, Y', $art->get_change_date())); ?></span>
                <?php } ?>

                <a href="/articles/edit.php?id=<?php echo($art->get_id()) ?>">
                    <img class="icon icon-edit" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAA
                        eP4ixAAAC8ElEQVRoQ9Wa8ZVNMRCHf9sBFaADKkAFbAWogK2ArQAVoAKrAjpABagAHTjfO3feGbPJfcm7yb15OWf/2ZfkzZe
                        Z32SSvDON125IeiTptqQ/kj5J+nnIzLNDHVb+/K6kz5KA8e2FpLdztowEkoMw+99LepaDGQWEMPqa8ES0OwszCggGY+STglB
                        OwmwN8kDSF2f80TBbgryT9HSKewC8Fqo9sxWIQZjxiHgRzBYghBMpNrZjYS4kvdkCBABCCq+0grmzJghx/8FZ3hLmYi0Q00R
                        Mna1gLtcAicLuAXPeGyRCEFk7cQZxLPHMLwrMniApiJiZPM8xMH8lkQW/9QIpgcBwK00MqAbmsUEwuAdIKYSl3+ilUhgKzf0
                        5pTVILURuZy+F2YdmS5BjIcyYh6GAzMGcS7qKO2krkKUQbJSmmbkE8H3SBUfg/1oLkF4QMQFkIVqIvQeETwIGs0ux02VEokR
                        blrV6Qfi0nD2jtwqt3hBm56WkV0kXNNDIWhCzmljqkSEhasU+LEQNyNAQpSDDQ5SAnATEIZCTgZgD4bqG3dS30nKbManaKbU
                        wVSl2bj9J1VocWD6eEkTOI/H+NZ6xc+X1Jp6wBU955Mf0WkQfzsT+0WVIiJRHeGzhncIaz16EGm1YiBQIBdpLB+IFDgig/N1
                        3fVYXdkr0MbTwBoZau5k5A3Dov7VFdsplLg/CrQT6sEZq9FB+Dh5ngInH064ptjT9Rg3MnQXiSxPfsRlE1Ag3E7xvW7s3HS/
                        nFsI+S0GgHZ6Vr10UlExY28eH1m+Xanf3qYWT5SBStyKFU9Z3M5C4m/u0G2e1XyYQXoyLj/u5q5166ypGGAi348/DOJ96ET1
                        hh+G5BMDwTSC8Rvxu7nnQDSsfVz21Vs0KwApH7LvikZh2a+ZBS6RigK9dY9ZMtLQvIGSW1xUTsfJmOJdmQzRAWFFfckTDKBz
                        9qq+STmtXB5C4fzAHIcP/DaB23tX7m0YoFtGKhczBH3qtbumBL/wHfzoMog+cQikAAAAASUVORK5CYII=">
                </a>
                <a href="javascript:deleteArticle('<?php echo $art->get_id(); ?>')">
                    <img class="icon icon-trash" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4
                    ixAAABp0lEQVRoQ+2ZfVHEQAzFf6cAJOAAUAA4wAGDAnAAOAAHSAAFgALAATgABTCP2c6ETtv96sfNXfLX3TTd7EtedtNkxYbIak
                    Nw4EDWLZIekW2JyB5wARwMAP4A7oC3MZwyBbUE4hXYTdzg4RhgpgByDVwlgpDaI3Caod+pOgWQZ+AoWHsB9L8titqZ0TledyA3g
                    CLUFm38aUkgP7Weq3j/pCe6f0vmUsuBVESieXXUiGhReyopmasTtQNkto1cajmQTGp5RHIc1uctlST7ZiHlTyPNBan/78BXeKBab
                    Cf8/gRUfxXRd8wcsZdc+2i3x7Y9fWwVYC/PRanlQAKdPCIlJcpQIjq1nFrmfPfjt+OjyHPEc8RzZLig8xzxHPEc2ZIcyfnKjOku
                    +mEV21zOcwdS6i0NaTTfGFtuw6BI6/Y1wv/ZLKl+2xffPfBgOiO1oDQruTSLnAOyMSglQLSg7X7EbNQ8V4tIs5SolAJRD0tgbB8
                    raixT4Tv0lZNmjKVAmj2JAqJa6rwwFYuoKjo1jbzoe7VAogbmUnAgc3k61Y5HJNVTc+ltTER+Ae3S5DOrL0NoAAAAAElFTkSuQmCC">
                </a>


            </div>
        </footer>
    </article>

<?php } ?>

<script src="../../../scripts/delete.js"></script>
