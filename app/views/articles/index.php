<?php
include_once('../../app/models/article.php');
include_once('../../app/services/ArticleService.php');

$srv = ArticleService::get_instance();
$articles = $srv->get_all();
?>
<a href="/articles/create.php">New</a>

<?php
while ( list($art_key, $art) = each( $articles ) ) { ?>

    <article>
        <header>
            <span><?php echo(date('F d, Y',$art->get_creation_date()));?></span>
            <div class="title">
                <?php echo($art->get_title());?>
                <small>
                    <a href="/articles/edit.php?id=<?php echo($art->get_id())?>">Edit</a>
                    <a href="javascript:deleteArticle('<?php echo $art->get_id(); ?>')">Delete</a>
                </small>
            </div>
            <div class="author">
                <?php echo($art->get_author());?>
                <small>
                <?php
                    $keywords = $art->get_keywords();
                    while(list($key, $val) = each($keywords)){
                ?>
                        <span class="label"><?php echo($val);?></span>

                <?php
                    }
                ?>
                </small>
            </div>
        </header>

         <div class="article-body">
        <p><?php echo($art->get_text());?></p>
    </div>

    </article>

    <?php } ?>

<script src="../../../scripts/delete.js"></script>
