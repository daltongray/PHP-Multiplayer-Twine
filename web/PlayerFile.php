<?php

//JSONs will come in after a q in the url. They will look like: 
//
// 		   {"Method":"CheckAndCreate"|"Access",
//		"PlayerName":"(PlayerName)",
//		  "Passcode":"(Passcode)",
//		      "Var1":"(Var1Name)",
//		      "Var2":"(Var2Name)",
//		      "Var3":"(Var3Name)"}
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
       		$response .= "The JSON sent to the server was mal formed.";
		echo $response;
		return;
	};
	
								$response .= "The JSON sent to the server was well formed. ";
    	$method = $decodedjson['Method'];
	
	if ($method == "CheckAndCreate"){
	
//	Check For Existing PlayerFiles With Same Name
	
	$PlayerFileName = $decodedjson['PlayerName'];
								$response .= 'The [PlayerFileName] is $PlayerFileName . ';
    $PlayerFilePasscode = $decodedjson['Passcode'];
    								$response .= "The [PlayerFilePasscode] is $PlayerFilePasscode . ";
     	 $PlayerFileurl = 'PlayerFiles/' . $PlayerFileName . '.txt';
								$response .= "The [PlayerFileurl] is $PlayerFileurl . ";
	 $CheckContents = file_get_contents('$PlayerFileurl');
								$response .= "The [CheckContents] is $CheckContents . ";
		
		if ($CheckContents != "") {
			$CheckContentsJSON = json_decode($CheckContents, true);
								$response .= "The [CheckContentsJSON] is $CheckContentsJSON. ";

			if ($CheckContentsJSON['PlayerName'] == $PlayerFileName){
				$response .= "Taken";
				echo $response;
				return;
			};
		};
	
//	Create A PlayerFile & Populate With Template
	
	$PlayerFileTemplateurl = "PlayerFiles/PlayerFileTemplate.txt"; 
								$response .= "The [PlayerFileTemplateurl] is $PlayerFileTemplateurl. ";

  	              $PFTJSON = file_get_contents("$PlayerFileTemplateurl");
								$response .= "The [PFTJSON] is $PFTJSON. ";

		   $PFTdecoded = json_decode($PFTJSON, true);
					  
		if ($PFTdecoded === null) {
			$response .= "Error connecting/decoding to the PlayerFile Template";
			echo $response;
			return;
		};
	
 $PFTdecoded['PlayerName'] = $PlayerFileName;
							//$response .= "The {$PFTdecoded['PlayerName']} is $PFTdecoded['PlayerName']. ";

   $PFTdecoded['Passcode'] = $PlayerFilePasscode;

								//$response .= "The {$PFTdecoded['Passcode']} is $PFTdecoded['Passcode']. ";

		
        	$fh = fopen('$PlayerFileurl', 'w');
        	fwrite($fh, json_encode($PFTJSON,JSON_UNESCAPED_UNICODE));
        	fclose($fh);
		$response .= "Success";
		echo $response;
		return;
	
	};

	if ($method === "Access"){
		$PlayerFileName = $decodedjson['PlayerName'];
		$PlayerFilePasscode = $decodedJSON['Passcode'];
     	 	$PlayerFileAccessurl = "PlayerFiles/".$PlayerFileName.".txt";

		/*
		if ($PlayerFileAccessurl != "PlayerFiles/Dalton.txt") {
			echo = $PlayerFileAccessurl;
			return;
		};
		*/
	  	$PlayerFileJSON = file_get_contents("$PlayerFileAccessurl");
		$response .= '$PlayerFileJSON' . $PlayerFileJSON;

		$decodedPFJSON = json_decode($PlayerFileJSON, true);
	
		if ($decodedPFJSON == null) {
			$response = "There was an error accessing this player file {$PlayerFileJSON} url: {$PlayerFileAccessurl}";
			echo $response;
			return;
		};
		
		if ($decodedPFJSON['Passcode'] == $decodedjson['Passcode']){
			$PlayerFileVar1 = $decodedjson['Var1'];
			$response .= $decodedPFJSON[$PlayerFileVar1];
			echo $response;
			return;
		};
		
	/*
	
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
     */  
    };
};

//send either the correct var back to the client, or an error message


?>
