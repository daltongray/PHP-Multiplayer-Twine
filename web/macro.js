<!DOCTYPE html>
<html>

<head>
	
<script> src="http://code.jquery.com/jquery-latest.min.js" </script>

</head>

<body>

<h2>Convert a string written in JSON format, into a JavaScript object.</h2>






<script>



$(function() {
    alert( 'JavaScript Loaded!' );
});
	
var url = "GET.php";
var method = "GET";
var dataJSON =  {"var":"$txt"};

	
jQuery.ajax({
	url: url,
	method: method,
	data: dataJSON,
	dataType: 'json',
	success: function (data, status, jqXHR) {
		console.log("Success! Here's the data is returned: ", data);
		console.log("Text status: ", status);
		console.log("HTTP Request response: ", jqXHR);

		if (method == "GET") {
			return data;
		} else if (method == "POST") {
			return "Data updated, response from server: " + data;
		} 

	},
	error: function (jqXHR, status) {
		console.log("AJAX Error: ", jqXHR);
		console.log("Error tText status: ", status);
	}
})
	
	
	/*
function JQuery.ajax(
  	url: "GET.php",
	method: "GET",
  	data: {"var":"$txt"},
	dataType: "json",
  	success: function (data, status, jqXHR){
		document.write(data.var1);
		
});
	
*/

			   
/*

$.ajax({
  	url: index.php,
	method: 'GET',
  	data: {"var":"$txt"},
  	success: function (data){
		
		}
  	dataType: 'json',
});


jQuery.ajax({
			url: 'index.php',
			method: method,
			data: dataJSON,
			dataType: 'json',
			success: function (data, status, jqXHR) {
				console.log("Success! Here's the data is returned: ", data);
				console.log("Text status: ", status);
				console.log("HTTP Request response: ", jqXHR);

				if (todo == "get_data") {
					return data;
				} else if (todo == "update_data") {
					return "Data updated, response from server: " + data;
				} 

			},
			error: function (jqXHR, status) {
				console.log("AJAX Error: ", jqXHR);
				console.log("Error tText status: ", status);
			}
		})
*/

</script>

</body>
</html>
