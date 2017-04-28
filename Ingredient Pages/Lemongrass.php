<?php 

    $pageTitle = 'Lemongrass';
    include '../Login/Control.php';
    include '../Header and Footer/Header.php';
?>

	<?php
		include "../Header and Footer/Nav.php";
	?>
	<div class="container-fluid lemongrass-container">
	<div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
	<div class="col-md-8 content">
		<div class="jumbotron lemongrass-image"><h1>Lemongrass</h1></div>
		<div class="ingredient-text">
                    <p>Lemongrass is an herb with a citrus twist -- hence its name! It is often used in Asian cuisine and will give your dish a zesty kick. Lemongrass oil also has many interesting uses, such as preservative, pesticide, antifungal, medicine, and insect repellant.</p>
                    <p>We source our lemongrass directly from South Asia and Southeast Asia. Our lemongrass is of the highest quality and freshness.</p><br>
                    <div class="credit">
                        <p>Photo credit: yuelanliu on <a href="https://pixabay.com/en/lemongrass-lemon-ingredient-kitchen-1713240/">Pixabay</a></p>
                    </div>
                </div>
		<?php
			$index = 1;
			include "../Login/Message.php";
		?>

	</div>
	<div class="col md-2 hidden-sm hidden-xs sidebar"></div>
	</div>
	<?php
		include "../Header and Footer/Footer.php";
	?>
