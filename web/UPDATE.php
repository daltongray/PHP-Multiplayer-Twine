<?php

// get the q parameter from URL
$q = $_REQUEST["q"];
//$hint = $q;

//$hint = "";
//set the location of our json full of variables

$filename = "vardb.txt";

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
        
        
        // the trouble seems to be in the following block of code
        //if you deploy, you'll be able to call up the values on both forms
        //but the update function won't make a lasting impact on the json called 
        // by the get function. 
        
        
        //pull the value of "var" from the json that was sent
        //this assumes that all jsons sent here have the following structure:
        //{"var":"foo","val":"bar"}
        $keyvar = $decodedjson["var"];
        $keyval = $decodedjson["val"];
        //then connect to the json.txt,
        $vardb = file_get_contents("$filename") or die("could not reach $filename");
        //decode it as a json
        $vardbjson = json_decode($vardb, true);
        
        //then pull the 1st var that was sent here
        // Modify the value, and write the structure to a file
        $vardbjson["$keyvar"] = "$keyval"; 
        
        $hint = $vardbjson["keyvar"];
        
        if (is_writable($filename)) {
        $fh = fopen("$filename", 'w') or die("Error opening output file");
        fwrite($fh, json_encode($vardbjson,JSON_UNESCAPED_UNICODE));
        fclose($fh);
        } else {
            $hint = "$filename is not writeable";
        }
      
    }
};

//send either the correct var back to the client, or an error message
echo $hint;

?>
