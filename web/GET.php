<?php
$txt = "Hello World!"

if (isset($_GET)) {
	// open the file (just like we did above)
  	$get_vars = json_decode(stripslashes($_GET['var']), true);

	// We'll need that file ID so we get the right file.
	// echo the contents. By just echo'ing the contents
	// the AJAX will receive that as data, because that's
	// what the server says. Whatever we echo here
	// is considered the server response.
	
	// F Y I: If we were to echo "error",
	// Our AJAX will still treat it as a "success" because
	// we SUCCESSfully connected to the server and got a response.
	// It will have to be on the javascript side that we parse the response
	// and see if it is infact an error.
	// an example error might be a json object that looks like this:
	// {"status": "error", "error": "Could not locate file"}
	// in javascript we'll have to check what the response JSon looks like
	// and if the variable "status" is set to "error", read out the 
	// "error" variable to get more info.
	$contents_JSON = {"var1":"$$get_vars"};
	echo $contents_JSON;
	// close the file
}

?>

