<script>
//NOT FINISHED YET
function addRows(lst) {
	var rt = "";
	var tab = document.getElementById('GlobalStatus');
	var i = tab.rows.length;
	var len = lst.length;
	for (j = len - 1; j >= 0; j--) {
		rt  = "<tr><td>";
		rt += "<a href=\"" + lst[j].url + "\">" + lst[j].name + "</a>";
		rt += "</td>";
		rt += "<td id=\"" + lst[j].name + "_sound\"> ... </td> </tr>";
		var rr = tab.insertRow(i);
		rr.innerHTML = rt;
	}
	for (j = 0; j < len; j++) {
		getStatus(lst[j].name);
	}
}
function getStatus(n)

        $.ajax({
                url: "https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php",
                data: "json",
                success: function (check) {
                    //jQuery.post("asound.php", {a : n}, function(data, status) 
                   
                   
                },
                
                    error: function(ts) { alert(ts.responseText) 
                }
                
          });

</script>

<table id="GlobalStatus">
        <tr>
            <th>Short Name</th>
            <th>Long Name</th>
            <th>Status</th>
        </tr>
</table>
