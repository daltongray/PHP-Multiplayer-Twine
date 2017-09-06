<?php

// get the q parameter from URL
$q = $_REQUEST["q"];
$hint = "";
$filename = "vardb.txt";

// if q is not nothing
if ($q !== "") {
    // decode q as if it were a json and turn it into a useable php json
    $decodedjson = json_decode($q, true);
    // if q is not a json, it will err and return null, if so...
    if ($decodedjson == NULL) {
        // tell me i did it wrong
        $hint = "this JSON was mal formed";
        retun;
    // otherwise, we're assuming q was a good json
    } else { 
        $keyvar = "$decodedjson["var"]";
        
        //ANOTHER TEST
        $hint = "$keyvar";
        return;
        
        
        
        //open up our JSON file
        $vardb = file_get_contents("vardb.txt") or die('Cannot open file:  '.$filename);
        //if there's an error here
        if ($vardb = FALSE) {
            $hint = "there was an error with get_contents";
            return;
        };
       
        //temporary test
        
        $hint = $vardb;
        return;
        
        
    
        
        // decode it into something PHP can read
        $vardbjson = json_decode($vardb, true);
        if ($vardbjson = NULL) {
            $hint = "vardb.txt was not a properly formed json";
            return;
        };
        //put it in hint so we can echo it back to the client later
        $hint = $vardbjson['var1'];
    };
};
// Output, which is either an error message or the variable we were looking for
echo $hint;
?>
