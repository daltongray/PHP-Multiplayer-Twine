<?php
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
