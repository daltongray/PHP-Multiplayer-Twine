<?php

$q = $_REQUEST["q"];
if ($q !== "") {
    $decodedjson = json_decode($q, true);
    if ($decodedjson == NULL) {
        $hint = "this JSON was mal formed";
		return;
    }
	$filename = $decodedjson["filename"]; 
    $keyvar = $decodedjson["var"];
	$keyval = $decodedjson["val"];
	
	$vardb = file_get_contents("$filename");
        $vardbjson = json_decode($vardb, true);
        $vardbjson["$keyvar"] = "$keyval";         
        if (is_writable($filename)) {
        $fh = fopen("$filename", 'w');
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
