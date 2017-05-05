<?php  
    include '../Login/Control.php';
   $pageTitle = 'Home';
   include_once './Create.php';
   include '../Header and Footer/Header.php';
?>

	<?php
	$_SESSION['control'] = 0;
		include "../Header and Footer/Nav.php";
	?>
	<div class="container-fluid">
	<h1 class="homepage">Welcome to Ingredients For You!</h1>
	<p class="homepage">We offer the freshest ingredients for your gourmet cooking. Sourced from small farms and prepared in store, our ingredients can't be beat!</p>
	</div>
	
	
        <?php
        $_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
            //display ingredients in database
            require_once '../lib/Database.php';
            $db = new Database();
            $ingredients = $db->getIngredients();
            
            foreach($ingredients as $ing) { ?>
                <div class="row" style="text-align: center; padding: 10px; margin-bottom: 2px;">
                    <div class="col-xs-12">
                    <h3>
                       <?php echo "<a href= 'https://www.cs.colostate.edu/~tjnolan/project_03_v2/Ingredient Pages/DisplayIngredient.php?ing=" . $ing["ingredient_name"] . "'>"; ?>
                       <?php echo $ing["ingredient_name"];?>
                       </a>
                    </h3>
                    <?php $img = "../Ingredient Pages/".$ing["image"];?>
                        <img src= "<?php echo $img?>" style="height: 200px; width: 200px; margin-bottom: 5px;" alt="<?php echo $ing["ingredient_name"];?>" />
                    </div>
		</div>
            <?php }; ?>	
            
		<div id="other_ingr">
			<br/><br/><p align="center">If you would like to look at other ingredients from different sites, here they are!</p>
			<?php include 'listing.php'?>
		</div>
	
	<?php
		include "../Header and Footer/Footer.php";
	?>
