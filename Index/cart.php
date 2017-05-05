
<?php  
    include '../Login/Control.php';
   $pageTitle = 'Shopping Cart';
   include '../Header and Footer/Header.php';
?>

<?php
	include "../Header and Footer/Nav.php";
?>


<?php 
function total (){
	$total = 0.0;
	$row   = $_SESSION['array'];
	
	foreach ($row as $ing){
		$id    = $ing['id'];
		$total += $_SESSION['items'][$id]['Total'];
	}
	
	return $total;
}
?>

<?php 
function view_cart(){
	$row = $_SESSION['array']; 
	echo '<table class="table">';
	echo '<tr> 
            <th>Name</th> 
            <th>Price</th>
			<th>Quantity</th>
          </tr> ';

	foreach ($row as $ing){
		$id    = $ing['id']; 
		
		$price = number_format((float)$_SESSION['items'][$id]['Total'] / $_SESSION['items'][$id]['Quantity'], 2 , '.' , ''); // formatted to 2 decimals
		$quant = $_SESSION['items'][$id]['Quantity']; //quantity
			echo '<tr>'; 
			echo "<td>$id</td>";
			echo "<td>$price</td>";
			echo "<td>$quant</td>";
			echo "<td><a href=\"cart.php?remove=yes&id=$id\">Remove from Cart</a></td>";			
			echo '</tr>';
		
	}
	
	echo '</table>';
}

function remove_item($id){
	foreach($_SESSION['array'] as $itemsKey => $items){
		foreach($items as $valueKey => $value){
			if($valueKey == 'id' && $value == $id){
				//delete this particular object from the $array
				unset($_SESSION['array'][$itemsKey]);
			} 
		}
	} 
	if (empty($_SESSION['array']))
		unset($_SESSION['array']);
}
?>

<?php 
if (isset($_GET['remove'])):
	$id = $_GET['id']; 
	$quant = $_SESSION['items'][$id]['Quantity'];
	if ($quant <= 1):
		unset($_SESSION['items'][$id]); //remove
		remove_item($id);//unset($_SESSION['array']);
		unset($_GET['id']);
		unset($_GET['price']);
	else:
		$_SESSION['items'][$id]['Total'] -= $_SESSION['items'][$id]['Total'] / $_SESSION['items'][$id]['Quantity'];
		$_SESSION['items'][$id]['Quantity']--; //remove only 1
	endif;
	header('Location: cart.php');
	die();
endif;
?>

<?php 
if (!isset($_SESSION['array']) and !isset($_GET['id'])):
	echo '<h3 align="center">Your Cart is Empty</h3>';
	echo '<p align="center"><a href="index.php">Continue Shopping</a></p>';
	require '../Header and Footer/Footer.php';
	die();
endif;
?>



<?php 
if (isset($_GET['id']) && isset($_GET['price'])):
	$id    = $_GET['id'];
	$price = $_GET['price'];
	if (!isset($_SESSION['array'])):
		$row  = array();
		$item = array("id" => $id, "price" => $price);
		$row[] = $item;  //stores ingredients in cart
		$_SESSION['array'] = $row;
		$_SESSION['items'] = array();
		$_SESSION['items'][$id] = array('Quantity' => 1, 'Total' => $row[0]['price']);

	else:
		$row = $_SESSION['array'];
		if (isset($_SESSION['items'][$id])): //item exists already
			$_SESSION['items'][$id]['Quantity']++;
			$price = $_GET['price'];
			$_SESSION['items'][$id]['Total'] += $price; 
		else:
			//create a new item
			$_SESSION['items'][$id] = array('Quantity' => 1, 'Total' => $_GET['price']); 
			$row[] = array("id" => $id, "price" => $_GET['price']); //add to cart
			$_SESSION['array'] = $row;
		endif;
	endif;
	//print_r($row);
endif;


?>

<div class="cart">
	<h2 align="center">My Cart</h2>
	<?php view_cart(); ?>
	<h3 align="center">Your Total is: $<?php echo number_format((float)total(), 2 , '.' , '');?></h3>
	<p align="center"><a href="checkout.php">Checkout</a></p>
	<p align="center"><a href="index.php">Continue Shopping</a></p>
</div>

<?php include "../Header and Footer/Footer.php"; ?>
