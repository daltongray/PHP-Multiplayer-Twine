<?php

//JSONs will come in after a q in the url. They will look like: 
//
// 		   {"Method":"CheckAndCreate"|"Access",
//		"PlayerName":"(PlayerName)",
//		  "Passcode":"(Passcode)",
//		      "var1":"(Var1Name)",
//		      "var2":"(Var2Name)",
//		      "var3":"(Var3Name)"}
//
//
//JS will expect three types of responses
//		
//		Taken | Success | (Error)
//
//Given the method "CheckAndCreate":
//		Taken returns if there's already a playerfile with that name
//		Success returns if the check passes, after a new file is created
//		Error returns if something unexpected happens. 
//			This file creates the error message, 
//			Which JS will print to the console log (hopefully)

$response = "";
$q = $_REQUEST["q"];
if ($q !== "") {
	$decodedjson = json_decode($q, true);

    if ($decodedjson == NULL) {
        $response = "The JSON sent to the server was mal formed.";
		echo $response;
		return;
	} 
	
    $method = $decodedjson['Method'];
	
	if ($method == "CheckAndCreate"){
	
//	Check For Existing PlayerFiles With Same Name
	
	$PlayerFileName = $decodedjson['PlayerName'];
    $PlayerFilePasscode = $decodedjson['Passcode'];
     	 $PlayerFileurl = 'PlayerFiles/' . $PlayerFileName . '.txt';
	 $CheckContents = file_get_contents('$PlayerFileurl');
    
	if ($CheckContents != "") {
		$CheckContentsJSON = json_decode($CheckContents, true);
			if ($CheckContentsJSON['PlayerName'] == $PlayerFileName){
			$response = "Taken";
			echo $response;
			return;
			};
	};
	
//	Create A PlayerFile & Populate With Template
	
	$PlayerFileTemplateurl = "PlayerFiles/PlayerFileTemplate.txt"; 
  	              $PFTJSON = file_get_contents("$PlayerFileTemplateurl");
		   $PFTdecoded = json_decode($PFTJSON, true);
					  
	if ($PFTdecoded === null) {
	$response = "Error connecting/decoding to the PlayerFile Template";
	echo $response;
	return;
	};
	
 $PFTdecoded['PlayerName'] = $PlayerFileName
   $PFTdecoded['Passcode'] = $PlayerFilePasscode

	
	if (is_writable($PlayerFileurl)) {
        $fh = fopen("$PlayerFileurl", 'w');
        fwrite($fh, json_encode($PFTJSON,JSON_UNESCAPED_UNICODE));
        fclose($fh);
		$response = "Success";
		echo $response;
        } 
	
	}
/*
	if ($method === "Access"){
	
	};
	$response = "Method Value Was Invalid";
	echo $reponse;
	return;
	
	
        //then connect to the json.txt,
        $vardb = file_get_contents($filename,".txt") or die("DED");
        if ($vardb === "DED") {
          $hint="Good";
          echo $hint;
          return;
       
    }
*/
};

//send either the correct var back to the client, or an error message


?>
