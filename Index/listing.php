<script>
	$(document).ready(function(){
		var http = new XMLHttpRequest();
		http.open("GET", "https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php", true);
		
		http.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				var myObj = JSON.parse(this.responseText);
				
				//Get every website
				for (var key in myObj){
					 if (myObj.hasOwnProperty(key)) {
						 var obj = myObj[key];
						 addRows(obj); //go add it to table
					}
				}
			}
		}
		http.send(null);
	});
	
	//add each website status to the table
	function addRows(obj) {
		var table = document.getElementById("AllIngredients");
		
		
		//loop through individual websites
		for (var val in obj){
			if (obj.hasOwnProperty(val)){
				//console.log(obj[val]); //Debugging: print val
				if (val == "baseURL"){
					
					get_status(obj[val] + "ajax_status.php",  //get the status from ajax_status.php
						function(result){
							if (result == "open"){ //if site is open
								var url = obj["baseURL"] + "ajax_listing.php";
								
								var http2 = new XMLHttpRequest();
								http2.open("GET", url, true); //get the ingredients listing
		
								http2.onreadystatechange = function(){
								if (this.readyState == 4 && this.status == 200){
									var myObj2 = JSON.parse(this.responseText);
									
									for (var ing in myObj2){
										var row   = table.insertRow(1); //add row
										var cell;
										for (var val in myObj2[ing]){
											if (val == "name"){
												cell = row.insertCell(0);
												cell.innerHTML = myObj2[ing][val];
											}
											else if (val == "short"){
												cell = row.insertCell(1);
												cell.innerHTML = myObj2[ing][val];
											}
											else if (val == "cost"){
												cell = row.insertCell(2);
												cell.innerHTML = myObj2[ing][val];
											}
										}
										
										//add more information
										var stringy = JSON.stringify(myObj2[ing]);
										stringy = encodeURIComponent(stringy);
										
										var info = '<a href="view_ingredient.php?ing=' + stringy + '&url=' + obj["baseURL"] + '">More Info</a>';
										cell = row.insertCell(3);
										cell.innerHTML = info;
									}
								}
							}
							http2.send(null);
							}
							//console.log(row.id);
							});
					
					//console.log(row.id);
				}	
				
            }
		}
	}
	
	function get_status(status,callback){
		//console.log(status);
		var result;
		
		var http = new XMLHttpRequest();
		http.open("GET", status, true);
		http.onreadystatechange = function(){
			if (this.readyState == 4 && this.status == 200){
				var myObj = JSON.parse(this.responseText);
				result = myObj["status"];
				callback(result);
			}
			else if (this.readyState == 4 && this.status != 200){
				result = "failed"; //could not obtain the website's status
				callback(result);
			}
		}
		http.send(null);
		//return result;
	}
</script>

<form method="POST" action="" id="pass_post_vars">
	<input type="hidden" name="url" value="10" />
</form>

<table class="table table-bordered" id="AllIngredients">
	<tr>
		<th>Ingredient Name</th>
		<th>Short Description</th>
		<th>Cost</th>
		<th>View Product</th>
	</tr>
</table>


