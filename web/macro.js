
/*
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
*/

Macro.add("fetch", {
    handler  : function () {
		//First lets create the JSON markup of our variable
	  var varfromtwine = this.args[0];
    var str = '{"var":"'varfromtwine'"}';
			
		//create a var for our xhttp object
    var xhttp;
    //create a new XML request
    xhttp = new XMLHttpRequest();
    //some xml thing I don't fully understand
			
    xhttp.onreadystatechange = function() {
      //when ready state ==4 & this status =200 -- 
		  //also don't fully understand this
			
      if (this.readyState == 4 && this.status == 200) {
        //then return whatever comes back from the GET request
        varfromtwine = this.responseText;
				print '$'+varfromtwine;
      }
		};
  //finally open an xml request, via GET protocol to GET.php
  //with the additional q= protocol which adds 
	//any txt from the field to the url
  //ie: how we send jsons!
  xhttp.open("GET", "GET.php?q="+str, true);
  xhttp.send();   
		}
});

