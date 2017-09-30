<?php


//pull request out of url, get the q parameter from URL
$q = $_REQUEST["q"];

	//[variable] = dejsonify
     $decodedjson = json_decode($q, true);
    //if it's a poorly formed json it will come back as an error
    if ($decodedjson == NULL) {
        //if so, set hint to an err message so that prints to the client
        $response = "this JSON was mal formed";
        //otherwise...
    } 

?>
