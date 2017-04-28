<?php 
    include '../Login/Control.php';
    $pageTitle = 'Wasabi';
    $wasabiComments = 0;
    include '../Header and Footer/Header.php';
?>


	<?php
		include "../Header and Footer/Nav.php";
	?>
	<div class="container-fluid wasabi-container">
	<div class="col-md-2 hidden-sm hidden-xs sidebar"></div>
	<div class="col-md-8 content">
		<div class="jumbotron wasabi-image"><h1>Wasabi</h1></div>
		<div class="ingredient-text">
                    <p>Wasabi - also known as Japanese horseradish - is a plant that grows naturally along stream beds in mountain river valleys in Japan. It is part of the <i>Brassicaceae</i> plant family, which also includes horseradish, mustard, and cabbages. Most people know and love wasabi for its intense and sinus-clearing spicy taste.</p>
                    <p>We get our wasabi from Japan's Izu peninsula, and we grind it into paste in-store! Having some sushi or another Asian dish for dinner? You won't want to skip the wasabi, trust us!</p><br>
                    <div class="credit">
                        <p>Photo credit: Sabigirl at English Wikipedia, <a href="https://commons.wikimedia.org/wiki/File%3AFresh_wasabi_rhizomes.jpg">via Wikimedia Commons</a></p>
                    </div>
                </div>
		<div class="image"></div>
                <?php
                    include "../Login/Message.php";
                ?>
	</div>
	<div class="col md-2 hidden-sm hidden-xs sidebar"></div>
	</div>
	<?php
		include "../Header and Footer/Footer.php";
	?>
