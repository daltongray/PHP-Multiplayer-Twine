<?php

// get the q parameter from URL
$q = $_REQUEST["q"];
$hint = "";
//set the location of our json full of variables

//if what's sent from the client is not nothing...
if ($q !== "") {
    //then parse it as a json
    $decodedjson = json_decode($q, true);
    //if it's a poorly formed json it will come back as an error
    if ($decodedjson == NULL) {
        //if so, set hint to an err message so that prints to the client
        $hint = "this JSON was mal formed";
        //otherwise...
    } else { 
        //pull the value of "var" from the json that was sent
        //this assumes that all jsons sent here have the following structure:
        //{"var":"value"}
        $filename = $decodedjson['var'];
        //then connect to the json.txt,
        $vardb = file_get_contents($filename,".txt") or die("DED");
        if ($vardb = "DED") {
          $hint="Good";
          echo $hint;
          return;
        }
    }
};

//send either the correct var back to the client, or an error message


?>
