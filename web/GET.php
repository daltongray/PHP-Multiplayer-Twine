<?php
// Our Variables

$scene1 = false;
$snakefound = false;


// get the q parameter from URL
$myJSON = $_REQUEST[q];
$myObj = json_decode($myJSON, true)

if ($myJSON !== "") {
    echo $myObj['var'];
    }

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



