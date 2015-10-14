
<!-- BEGIN TEST -->
<?php
include_once('../../app/models/article.php');
include_once('../../app/services/ArticleService.php');

$srv = ArticleService::get_instance();
$articles = $srv->get_all();
?>
<a href="/articles/create.php">New</a>
<table>
    <thead>
    <tr>
        <td></td>
        <td>ID</td>
        <td>Titel</td>
        <td>Autor</td>
        <td>Keywords</td>
        <td>Text</td>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ( $art = current( $articles ) ) {
        ?>
        <tr>
            <td><input type="checkbox"></td>
            <td> <?php echo $art->get_id(); ?>    </td>
            <td> <?php echo $art->get_title();?>  </td>
            <td> <?php echo $art->get_author();?> </td>
            <td> <?php
                $j = 0;
                $key = $art->get_keywords();
                $max = count ($key);
                while ($j < $max){
                    $word = $key[$j];
                    echo $word;
                    $j++;
                    if($j < $max){
                        echo ', ';
                    }
                }
                ?> </td>
            <td> <?php echo $art->get_text();?></td>
            <td><a href="javascript:deleteArticle('<?php echo $art->get_id(); ?>')">Delete</a></td>
        </tr>
        <?php
        next($articles);
    }
    ?>
    </tbody>
</table>
<!-- END TEST -->

<script src="../../../scripts/delete.js"></script>



