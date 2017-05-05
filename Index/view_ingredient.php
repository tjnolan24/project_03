<?php  
    include '../Login/Control.php';
   $pageTitle = 'View Ingredients';
   include '../Header and Footer/Header.php';
?>


<?php	
	include "../Header and Footer/Nav.php";
?>

<?php 
	if (isset($_GET['ing'])):
		$jIng = json_decode($_GET['ing'], true); //the json object converted to array
		//print_r($jIng);
?>
	<script>
	
	$(document).ready(function(){
		var http = new XMLHttpRequest();
		http.open("GET", "https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php", true);
		
		http.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				var myObj = JSON.parse(this.responseText);
				
				//Get every website
				for (var key in myObj){ //get the sites
					 if (myObj.hasOwnProperty(key)) {
						 var obj = myObj[key];
						 for (var val in obj){ //get the values in sites
							if (val == "baseURL"){
								if (obj[val] == "<?php echo $_GET['url']; ?>"){
									var url   = obj["baseURL"] + 'ajax_ingrimage.php?ing=' + "<?php echo $jIng['name']; ?>"; //get the image
									
									
									var http2 = new XMLHttpRequest();
									http2.open("GET", url, true);
									http2.onreadystatechange = function(){
										
										if (this.readyState == 4){
											if (this.status == 200) {
												var myObj2 = JSON.parse(this.responseText);
												//use in ajax_ingrimage
												$("#rand_img").attr("src", 'data:image/png;base64,' + myObj2); //change src of image
											}
										}	
									}
									http2.send(null);
									/*obtain long description of ingredient*/
									var http3 = new XMLHttpRequest();
									var url3   = obj["baseURL"] + "ajax_ingredient.php?ing=" + "<?php echo $jIng['name']; ?>"; 
									http3.open("GET", url3, true);
									http3.onreadystatechange = function(){
										if (this.readyState == 4){
											if (this.status == 200) {
												var myObj3 = JSON.parse(this.responseText);
												document.getElementById("description").innerHTML = myObj3['desc'];  //set description of ingredient
												document.getElementById("price").innerHTML = "Price: $" + myObj3['cost'] + " per " + myObj3["unit"];  //set description of ingredient
												console.log(this.responseText);
											}
										}	
									}
									http3.send(null);
								}
							} 
						}
					 }
				}
			}
		}	
		http.send(null);
		
	
		
		/*Continue building page after page has loaded*/
		document.getElementById("name").innerHTML = "Ingredient: <?php echo $jIng['name'];?>";  //set name of ingredient
	});
	
	</script>
		
	
<?php endif; ?>





<div class="container-fluid" id="content">
	<h1 align="center" id="name"></h1>
	<div class="ingredient-image"><img src="" id="rand_img" alt="Image Unavailable"></div>
		<div class="ingredient-text">
			<h2 align="center" id="description"></h2>
			<h2 align="center" id="price"></h2>
			<?php if (isset($_SESSION['userName']) and $_SESSION['userName']!="Guest"): //adds a cart option if user is signed in ?>
				<form action="#" method="post">
					<h2><a href="cart.php<?php echo "?action=cart&id=$jIng[name]&price=$jIng[cost]"?>">Add to Cart</a></h2>
				</form>
			<?php endif; ?> 
        </div>
             
</div>



<?php
	include "../Header and Footer/Footer.php";
?>