<?php

//JSONs will come in after a q in the url. They will look like: 
//
// 		   {"Method":"CheckAndCreate"|"Access",
//		   "DimName":"(DimName)",
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
//	Access Object: This is where our DimFile Associative Array will go. 
//
//Given the method "CheckAndCreate":
//		Taken returns if there's already a DimFile with that name
//		Success returns if the check passes, after a new file is created
//		Error returns if something unexpected happens. 
//			This file creates the error message, 
//			Which JS will print to the console log (hopefully)
//
//
//Given the method "Access":
//	PHP will check to see if the player's passcode works. 
//	Then it will parse the server-side DF for the values that the client wants
//	It will package those vars in our Access Object
//	Plop it in the response object, and send it to JS to pull from. 
//	JS will for each of the vars, to populate a client-side DimFie. 




// ----------------SETUP-----------------------------------------------------------------------
$response = array(
	"TwineResponse"=>"Error",  // Taken | Success | Error | AccessObject
	"ErrorMessage"=>"The Response Object has been setup. ",
	"AccessObject"=>"null");
//----------------------------------------------------------------------------------------------------------------------------





// ----------------ID JSON, UNPACK, SETUP-----------------------------------------------------------------------
		        $q = $_REQUEST["q"];
	$decodedjson = json_decode($q, true);

if ($decodedjson == NULL) {       $response['ErrorMessage'] .= "The JSON sent to the server was mal formed. ";
	echo json_encode($response);
	return;
}; 								                $response['ErrorMessage'] .= "The JSON sent to the server was well formed. ";


    $DimFileName = $decodedjson['DimName'];		$response['ErrorMessage'] .= "[DimFileName] is ${DimFileName}. ";
$DimFilePasscode = $decodedjson['Passcode'];		$response['ErrorMessage'] .= "[DimFilePasscode] is ${DimFilePasscode}. ";
	 $method = $decodedjson['Method'];		$response['ErrorMessage'] .= "[Method] is ${method}. ";
     $DimFileurl = "DimFiles/{$DimFileName}.txt";	$response['ErrorMessage'] .= "[DimFileurl] is ${DimFileurl}. ";
     $DFContents = file_get_contents("$DimFileurl");	$response['ErrorMessage'] .= "[DFContents] is ${DFContents}. ";
 $DFContentsJSON = json_decode($DFContents, true); 	$response['ErrorMessage'] .= "The [DFContentsJSON] is $DFContentsJSON. ";

//----------------------------------------------------------------------------------------------------------------------------





//------------------CHECK AND CREATE ------------------------------------------------------------------------------------
if ($method == "CheckAndCreate"){ 
	
	
	// ----------------CHECK-----------------------------------------------------------------------
	if ($DFContents != "") {
		if ($DFContentsJSON['DimName'] == $DimFileName){
			$response['TwineResponse'] = "Taken";
			echo json_encode($response);
			return;
		};
	};
	//----------------------------------------------------------------------------------------------------------------------------

	
	
	//-----------------CREATE SETUP------------------------------------------------------------------------------------
	
      $DimFileTemplateurl = "DimFiles/DimFileTemplate.txt";  		$response['ErrorMessage'] .= "The [DimFileTemplateurl] is $DimFileTemplateurl. ";
	            $DFTJSON = file_get_contents("$DimFileTemplateurl");	$response['ErrorMessage'] .= "The [DFTJSON] is $DFTJSON. ";
	         $DFTdecoded = json_decode($DFTJSON, true);
	
	if ($DFTdecoded === null) {						$response['ErrorMessage'] .= "Error connecting/decoding to the DimFile Template";
		echo json_encode($response);
		return;
	};
	
    $DFTdecoded['DimName'] = $DimFileName;
$updatedDFTdecodedDimName = $DFTdecoded['DimName']; 			$response['ErrorMessage'] .= "UPDATED JSON ['DimName'] is $updatedDFTdecodedDimName ";
     $DFTdecoded['Passcode'] = $DimFilePasscode;
  $updatedDFTdecodedPasscode = $DFTdecoded['Passcode'];				$response['ErrorMessage'] .= "UPDATED JSON ['Passcode'] is ${$updatedDFTdecodedPasscode}. ";
	//----------------------------------------------------------------------------------------------------------------------------

		
	
	//-----------------CREATE EXECUTE------------------------------------------------------------------------------------
	$fh = fopen("$DimFileurl", 'w');
        fwrite($fh, json_encode($DFTdecoded,JSON_UNESCAPED_UNICODE));
        fclose($fh);
	$response['TwineResponse'] = "Success";
	echo json_encode($response);
	return;
};
//----------------------------------------------------------------------------------------------------------------------------




//------------------Access ------------------------------------------------------------------------------------
if ($method === "Access"){
	if ($DFContentsJSON == null) {		$response['ErrorMessage'] .= "There was an error accessing this player file. ";
		echo json_encode($response);
		return;
	};
	
	if ($DFContentsJSON['Passcode'] == $DimFilePasscode){
		$DimFileVar1 = $decodedjson['Var1']; 	$response['ErrorMessage'] .= "DimFileVar1 = ${DimFileVar1}. ";
		
		$response['TwineResponse'] = $decodedDFJSON[$DimFileVar1];	$response['ErrorMessage'] .= "The Var 1 from the DF JSON = ${decodedDFJSON[$DimFileVar1]}. ";
		$response['AccessObject'] = $DFContentsJSON; 	$response['ErrorMessage'] .= "The DFContentsJSON form the DF JSON = ${DFContentsJSON}. ";
		echo json_encode($response);
		return;
	};
	
	if ($DFContentsJSON['Passcode'] != $DimFilePasscode){
		$response['TwineResponse'] = "Wrong Passcode";
		$response['AccessObject'] = null;
		echo json_encode($response);
		return;
	};
};
//----------------------------------------------------------------------------------------------------------------------------




?>
