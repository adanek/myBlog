<?php
/**
 * Created by IntelliJ IDEA.
 * User: adanek
 * Date: 13.10.2015
 * Time: 21:11
 */
?>

<script src="../../scripts/delete.js"></script>
<div>

<!-- BEGIN TEST -->
<?php 
include('../../articles/article.php');

	#Testdaten
	$article1 = new Article('1', 'Test1', 'Pati', array('PHP', 'HTML'), 'Das ist ein unglaublich beschissener Blogeintrag');
	$article2 = new Article('2', 'Test2', 'Pati', array('CSS', 'JS'), 'Und hier kommt auch schon der nächste beschissene Eintrag');
	$article3 = new Article('3', 'Test3', 'Andi', array('CSS', 'JS', 'PHP', 'HTML'), 'Andis Eintrag is ebenfalls nicht berauschend');
	
	$articles = array(
		$article1->get_id() => $article1,
		$article2->get_id() => $article2,
		$article3->get_id() => $article3
	);
	?>
	<table border="1">
	<thead>
		<tr>
		    <td></td>
			<td>ID</td>
			<td>Titel</td>
			<td>Autor</td>
			<td>Keywords</td>
			<td>Text</td>
		</tr>
	</thead>
	<tbody>
		<?php
		while ( $art = current( $articles ) ) {
		?>
		<tr>
		 <td><input type="checkbox"></input></td>
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
		</tr>
		<?php 
		next($articles);
	}
	?>
	</tbody>
	</table>
<!-- END TEST -->

</div>
<button onclick="deleteArticle(2)">Delete</button>
