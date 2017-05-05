<?php  
   include '../Login/Control.php';
   include '../Login/Support.php';
   $pageTitle = 'Checkout';
   include '../Header and Footer/Header.php';
?>

<?php
	include "../Header and Footer/Nav.php";
?>

<?php 
	if (isset($_POST['check'])){
		$users = User::readUsers(); //get users from users.csv
		foreach ($users as $u){
			if ($u->type == 'admin'){
				$to      = $u->email;
				$subject = 'Customer Purchase';
				$message = 'Customer Purchased some items from the store!';
				mail($to,$subject,$message);
			}
		}
		clear_cart();
		//header('Location: cart.php');
		echo '<h2 align="center">Thanks for Shopping With Us!</h2>';
		echo '<p align="center"><a href="index.php">Back To Shopping</a></p>';
		include '../Header and Footer/Footer.php';
		die();
	}
	
	function clear_cart(){
		unset($_SESSION['array']);
		unset($_SESSION['items']);
	}
?>

<?php 
function total (){
	$total = 0.0;
	$row = $_SESSION['array'];
	
	foreach ($row as $ing){
		$id = $ing['id'];
		$total += $_SESSION['items'][$id]['Total'];
	}
	
	return $total;
}
?>

<div class="checkout">
	<h1 align="center">Your Total is $<?php echo number_format((float)total(), 2 , '.' , '');?></h1>
	<h2 align="center">Are You Sure You Want To Checkout?</h2>
	<form action="#" method="post">
		<input type="submit" name="check" value="Checkout">
	</form>
</div>

<?php include "../Header and Footer/Footer.php"; ?>