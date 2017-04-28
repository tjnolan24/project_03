<?php 
	header ( 'Content-Type: text/json' );
	header ( "Access-Control-Allow-Origin: *" );
?>


<?php 
	//display ingredients in database
	require_once '../lib/Database.php';
	$db = new Database();
	
	$ing_name = "";
	
	if (isset($_GET['ing'])){
		
		$ing_name = $_GET['ing'];
		$ing = $db->retrieveIngredient($ing_name);
		
		$name = $ing["ingredient_name"];
		$short = $ing["short"];
		$unit = $ing["unit"];
		$cost = $ing["price"];
		$time = $ing["time"];
		$desc = $ing["description"];
		
		$temp = array("name" => $name, "short" => $short, "unit" => $unit, "cost" => $cost, "time" => $time, "desc" => $desc);
		echo json_encode($temp);
		
	}
		
?>
