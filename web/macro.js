function() {
    alert( 'JavaScript Loaded!' );
});

//declare variables

var url = "GET.php";
var method = "GET";
var dataTest = "hello";
var dataJSON =  { "var":"$txt" };

//AJAX GET a simple string	

jQuery.ajax({
	url: url,
	method: method,
	data: dataTest,
	//data: dataJSON,
	success: function (data, status, jqXHR) {
		console.log("Success! Here's the data is returned: ", data);
		console.log("Text status: ", status);
		console.log("HTTP Request response: ", jqXHR);
	},
	error: function (jqXHR, status) {
		console.log("AJAX Error: ", jqXHR);
		console.log("Error Text status: ", status);
	}
})
