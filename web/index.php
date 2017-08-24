<?php
// do php stuff

include('macro.js');

$txt = "Hello world!";


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



if (isset($_POST['data'])) {
	// Javascript sends the data over in one "data" object.
	$post_vars = json_decode(stripslashes($_POST['data']), true);
	// First we need the ID of the file we're opening.
	// I'm implying that our filenames are literally the name
	// of the "ID" that we use. That "ID" should be sent over
	// and should be used to identify that user or instance. 
	// Basically, we need a way to correctly recall the file every time.
	$filename = $post_vars['id'];
	// The path to our database files, in relation to this script.
	// Could just be "" for the same directory.
	$path = "/database_files/folder/test"; 
	// let's open the file. The statement below will 
	// combine the path and filename strings together.
	$file = fopen($path . $filename);
	// No file? Create one.
	// send all the contents of the file into a string.
	// json_decode that string into an array to make it easier to manipulate
	// (we did this above wtih the $_POST variable)
	// update the vars with the new data.
		// something like $file_var['lives'] = $post_vars['lives'];
	// re-encode the JSON with json_encode.
	// Write the encoded JSON string back into that file. 
	// close the file.
	echo "success";
}


?>
