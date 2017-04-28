

<?php  
    include '../Login/Control.php';
   $pageTitle = 'Test Ajax';
   include_once './Create.php';
   include '../Header and Footer/Header.php';
?>

<?php
	include "../Header and Footer/Nav.php";
?>
	
<script>
	$(document).ready(function(){
		var http = new XMLHttpRequest();
		http.open("GET", "ajax_ingrimage.php?ing=Wasabi", true);
		
		http.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				var myObj = JSON.parse(this.responseText);
				$("#test").text(this.responseText);
				
				//use in ajax_ingrimage
				$("#rand_img").attr("src", 'data:image/png;base64,' + myObj[0]); //change src of image
			}
		}
		http.send(null);
	});
</script>

<div class="container-fluid" id="content">
	<p align="center" id="test">This Text will change if it gets the JSON object successfully from ajax_pages</p><br/><br/><br/>
	<p align="center">The following image will appear if ajax_ingrimage worked</p>
	<img id="rand_img" src="" alt="Random Image">
</div>

<?php include "../Header and Footer/Footer.php"; ?>

