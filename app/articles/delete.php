<?php
$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

if($method == 'DELETE'){

   parse_str(file_get_contents("php://input"), $post_vars);
   
   while($art = current($articles)){
   	$id = $art->get_id();
   	if($id == $post_vars["id"]){
   		unset($articles[$id]);
   		break;
   	}
   	next($articles);
   }
   
   
    echo('Article Nr. ' .$post_vars["id"] .' deleted');
}

header('location: ', '/articles/create.php');
die();

?>