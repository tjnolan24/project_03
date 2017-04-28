

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
		http.open("GET", "ajax_listing.php", true);
		
		http.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				var myObj = JSON.parse(this.responseText);
				$("#test").text(this.responseText);
			}
		}
		http.send(null);
	});
</script>

<div class="container-fluid" id="content">
	<p align="center" id="test">This Text will change if it gets the JSON object successfully from ajax_status.php</p>
</div>

<?php include "../Header and Footer/Footer.php"; ?>

