<!DOCTYPE html>
<html>
<body>

<h2>Convert a string written in JSON format, into a JavaScript object.</h2>

<p id="demo"></p>

<script>

var myJSON = '{ "name":"John", "age":31, "city":"New York" }';
var myObj = JSON.parse(myJSON);
var name = myObj.city;

document.write(name);

</script>

</body>
</html>



			   
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
