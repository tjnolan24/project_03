<?php 
	header ( 'Content-Type: text/json' );
	header ( "Access-Control-Allow-Origin: *" );
?>

<?php 
	//display ingredients in database
	require_once '../lib/Database.php';
	$db = new Database();
	$ingredients = $db->getIngredients();
	
	$json = array(); //the json object that will return all ingredients
	
	foreach($ingredients as $ing){
		$name = $ing["ingredient_name"];
		$short = $ing["short"];
		$unit = $ing["unit"];
		$cost = $ing["price"];
		$temp = array("name" => $name, "short" => $short, "unit" => $unit, "cost" => $cost);
		$json[] = $temp;
	}
	
	echo json_encode($json);
	
?>

