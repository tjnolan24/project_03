
<?php  
    include '../Login/Control.php';
   $pageTitle = 'Federation Status';
   //include_once './Create.php';
   include '../Header and Footer/Header.php';
?>

<?php
	include "../Header and Footer/Nav.php";
?>


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
		var table = document.getElementById("GlobalStatus");
		var row   = table.insertRow(1); //add row
		var cell;
		
		//loop through individual websites
		for (var val in obj){
			if (obj.hasOwnProperty(val)){
				//console.log(obj[val]); //Debugging: print val
				if (val == "baseURL"){
					
					get_status(obj[val] + "ajax_status.php", 
						function(result){
							row.className = result;
							cell   = row.insertCell(2);
							cell.innerHTML = result;
							//console.log(row.id);
							}); //get the status from ajax_status.php
					
					//console.log(row.id);
				}	
				else if(val == "nameShort"){
					cell = row.insertCell(0);
					cell.innerHTML = obj[val];
				}
				else if(val == "nameLong"){
					cell = row.insertCell(1);
					cell.innerHTML = obj[val];
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

<table class="table table-bordered" id="GlobalStatus">
	<tr>
		<th>Short Name</th>
		<th>Long Name</th>
		<th>Status</th>
	</tr>
</table>

<?php include "../Header and Footer/Footer.php"; ?>