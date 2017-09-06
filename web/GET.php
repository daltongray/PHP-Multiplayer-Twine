<?php
// Our Variables

$scene1 = false;
$snakefound = false;


// get the q parameter from URL
$myJSON = $_REQUEST[q];
// Decode the JSON we received from Q
$myObj = json_decode($myJSON, true);
// if it's not a JSON it will retun NULL
if ($myObj !== "NULL") {
    //returns the var value of the JSON it was fed.
    echo $myObj['var'];
    //otherwise...
    } else {
    // tell us it's not a string and print the stuff we got
    echo "this is not a JSON string, the value i got was" + $myJSON

/*
$hint = "";

// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = $name;
            } else {
                $hint .= ", $name";
            }
        }
    }
}
*/
// Output "no suggestion" if no hint was found or output correct values 
// echo $hint === "" ? "no suggestion" : $hint;
?>



