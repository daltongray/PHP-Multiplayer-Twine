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
//Our Response object has a few values: 
//
//	TwineResponse: JS will expect four types of responses	
//		Taken | Success | (Error) | Access
//
//	ErrorMessage: JS will publish this to the consolelog, for debugging purposes.
//
//	Access Object: This is where our PlayerFile Associative Array will go. 
//
//Given the method "CheckAndCreate":
//		Taken returns if there's already a playerfile with that name
//		Success returns if the check passes, after a new file is created
//		Error returns if something unexpected happens. 
//			This file creates the error message, 
//			Which JS will print to the console log (hopefully)
//
//
//Given the method "Access":
//	PHP will check to see if the player's passcode works. 
//	Then it will parse the server-side PF for the values that the client wants
//	It will package those vars in our Access Object
//	Plop it in the response object, and send it to JS to pull from. 
//	JS will for each of the vars, to populate a client-side playerfile. 




// ----------------SETUP-----------------------------------------------------------------------
$response = array(
	"TwineResponse"=>"Error",  // Taken | Success | Error | AccessObject
	"ErrorMessage"=>"The Response Object has been setup. ",
	"AccessObject"=>"null");
//----------------------------------------------------------------------------------------------------------------------------





// ----------------ID JSON, UNPACK, SETUP-----------------------------------------------------------------------
		  $q = $_REQUEST["q"];
	$decodedjson = json_decode($q, true);

if ($decodedjson == NULL) {
       	$response['ErrorMessage'] .= "The JSON sent to the server was mal formed. ";
	echo json_encode($response);
	return;
};								$response['ErrorMessage'] .= "The JSON sent to the server was well formed. ";
    $PlayerFileName = $decodedjson['PlayerName'];		$response['ErrorMessage'] .= "[PlayerFileName] is ${PlayerFileName}. ";
$PlayerFilePasscode = $decodedjson['Passcode'];			$response['ErrorMessage'] .= "[PlayerFilePasscode] is ${PlayerFilePasscode}. ";
	    $method = $decodedjson['Method'];			$response['ErrorMessage'] .= "[Method] is ${method}. ";
     $PlayerFileurl = "PlayerFiles/{$PlayerFileName}.txt";	$response['ErrorMessage'] .= "[PlayerFileurl] is ${PlayerFileurl}. ";
        $PFContents = file_get_contents("$PlayerFileurl");	$response['ErrorMessage'] .= "[PFContents] is ${PFContents}. ";
    $PFContentsJSON = json_decode($PFContents, true); 		$response['ErrorMessage'] .= "The [PFContentsJSON] is $PFContentsJSON. ";

//----------------------------------------------------------------------------------------------------------------------------





//------------------CHECK AND CREATE ------------------------------------------------------------------------------------
if ($method == "CheckAndCreate"){ 
	
	
	// ----------------CHECK-----------------------------------------------------------------------
	if ($PFContents != "") {
		if ($PFContentsJSON['PlayerName'] == $PlayerFileName){
			$response['TwineResponse'] = "Taken";
			echo json_encode($response);
			return;
		};
	};
	//----------------------------------------------------------------------------------------------------------------------------

	
	
	//-----------------CREATE SETUP------------------------------------------------------------------------------------
	
      $PlayerFileTemplateurl = "PlayerFiles/PlayerFileTemplate.txt";  		$response['ErrorMessage'] .= "The [PlayerFileTemplateurl] is $PlayerFileTemplateurl. ";
	            $PFTJSON = file_get_contents("$PlayerFileTemplateurl");	$response['ErrorMessage'] .= "The [PFTJSON] is $PFTJSON. ";
	         $PFTdecoded = json_decode($PFTJSON, true);
	
	if ($PFTdecoded === null) {						$response['ErrorMessage'] .= "Error connecting/decoding to the PlayerFile Template";
		echo json_encode($response);
		return;
	};
	
    $PFTdecoded['PlayerName'] = $PlayerFileName;
$updatedPFTdecodedPlayerName = $PFTdecoded['PlayerName']; 			$response['ErrorMessage'] .= "UPDATED JSON ['PlayerName'] is $updatedPFTdecodedPlayerName ";
     $PFTdecoded['Passcode'] = $PlayerFilePasscode;
  $updatedPFTdecodedPasscode = $PFTdecoded['Passcode'];				$response['ErrorMessage'] .= "UPDATED JSON ['Passcode'] is ${$updatedPFTdecodedPasscode}. ";
	//----------------------------------------------------------------------------------------------------------------------------

		
	
	//-----------------CREATE EXECUTE------------------------------------------------------------------------------------
	$fh = fopen("$PlayerFileurl", 'w');
        fwrite($fh, json_encode($PFTdecoded,JSON_UNESCAPED_UNICODE));
        fclose($fh);
	$response['TwineResponse'] = "Success";
	echo json_encode($response);
	return;
};
//----------------------------------------------------------------------------------------------------------------------------




//------------------Access ------------------------------------------------------------------------------------
if ($method === "Access"){
	if ($PFContentsJSON == null) {		$response['ErrorMessage'] .= "There was an error accessing this player file. ";
		echo json_encode($response);
		return;
	};
	
	if ($PFContentsJSON['Passcode'] == $PlayerFilePasscode){
		$PlayerFileVar1 = $decodedjson['Var1'];
		$response['TwineResponse'] = "Access";
		$response['AccessObject'] = $decodedPFJSON[$PlayerFileVar1];
		echo json_encode($response);
		return;
	};
};
//----------------------------------------------------------------------------------------------------------------------------




?>
