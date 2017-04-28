<?php 
	header ( 'Content-Type: text/json' );
	header ( "Access-Control-Allow-Origin: *" );
	
	$status = array("status" => "open");
	echo json_encode($status); 
?>