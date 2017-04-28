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
		
		$img = $ing["image"];
		$encoded_data = base64_encode(file_get_contents("../Ingredient Pages/$img")); 
		
		$temp = array($encoded_data);
		echo json_encode($temp);
		
	}
		
?>
