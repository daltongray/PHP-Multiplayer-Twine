<?php

// get the q parameter from URL
$q = $_REQUEST["q"];

// if q is not nothing
if ($q !== "") {
    // decode q as if it were a json and turn it into a useable php json
    $decodedjson = json_decode($q, true);
    // if q is not a json, it will err and return null, if so...
    if ($decodedjson == NULL) {
        // tell me i did it wrong
        $hint = "this JSON was mal formed";
    // otherwise, we're assuming q was a good json
    } else { 
        //open up our JSON file
        $vardb = fopen("vardb.txt", "r");
        // decode it into something PHP can read
        $vardbjson = json_decode($vardb, true);
        //put it in hint so we can echo it back to the client later
        $hint = $vardbjson['$decodedjson['var']'];
    };
};
// Output, which is either an error message or the variable we were looking for
echo $hint;
?>
