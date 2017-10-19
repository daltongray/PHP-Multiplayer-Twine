<?php

//JSONs will come in after a q in the url. They will look like: 
//
// 		   {"Protocol":"Get",
//		        "Var1":"(Val1)",
//		        "Var2":"(Val2)",
//		        "etc.":"(etc.)"}
//
//Our Response object has a few values: 
//
//	ErrorResponse: JS will plop this response into the console log	
//	Var1, etc: These vars JS will plop into their corresponding twine vars
// 
// ----------------SETUP-----------------------------------------------------------------------
$Response = array(
	"ErrorMessage"=>"The Response Object has been setup. ");
//----------------------------------------------------------------------------------------------------------------------------
// ----------------ID JSON, UNPACK, SETUP-----------------------------------------------------------------------
		        $q = $_REQUEST["q"];
	$IncomingArray = json_decode($q, true);
  
if ($IncomingArray == NULL) {
       	$Response['ErrorMessage'] .= "The JSON sent to the server was mal formed. ";
	echo json_encode($Response);
	return;
}; 								                                          $Response['ErrorMessage'] .= "The JSON sent to the server was well formed. ";

	       $Protocol = $decodedjson['Protocol'];			        $Response['ErrorMessage'] .= "[Method] is ${method}. ";


if ($Protocol == "TESTGET") {

                $Url = "TestJSON.txt";
       $TestContents = file_get_contents("$Url");	            $Response['ErrorMessage'] .= "[TestContents] is ${TestContents}. ";
   $TestContentsJSON = json_decode($TestContents, true); 		  $Response['ErrorMessage'] .= "The [PFContentsJSON] is $TestContentsJSON. ";
$TestContentsVarDump = var_dump($TestContentsJSON);           $Response['ErrorMessage'] .= "The Var Dump of Test Contents JSON is ${TestContentsVarDump}; 


        //This code will flip the incoming JSON,
        //check for intersections in the Playerfile JSON,
        //then merge the two into the response object. :)
        // test it out at http://sandbox.onlinephpfunctions.com/
        

     $ArrayIncoming = array_flip($IncomingArray);
  $IntersectingVars = array_intersect_key($ArrayIncoming,$TestContentsJSON);


echo json_encode(array_merge($Response,$result));
return;

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
// This is where I left off!



if ($Protocol == "PlayerFileCheckAndCreate" or $Protocol == "PlayerFileAccess") {


    $PlayerFileName = $decodedjson['PlayerName'];		        $response['ErrorMessage'] .= "[PlayerFileName] is ${PlayerFileName}. ";
$PlayerFilePasscode = $decodedjson['Passcode'];			        $response['ErrorMessage'] .= "[PlayerFilePasscode] is ${PlayerFilePasscode}. ";
     $PlayerFileurl = "PlayerFiles/{$PlayerFileName}.txt";	$response['ErrorMessage'] .= "[PlayerFileurl] is ${PlayerFileurl}. ";
        $PFContents = file_get_contents("$PlayerFileurl");	$response['ErrorMessage'] .= "[PFContents] is ${PFContents}. ";
    $PFContentsJSON = json_decode($PFContents, true); 		  $response['ErrorMessage'] .= "The [PFContentsJSON] is $PFContentsJSON. ";
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
	
	if ($PFContentsJSON['Passcode'] != $PlayerFilePasscode){
		$PlayerFileVar1 = $decodedjson['Var1'];
		$response['TwineResponse'] = "Access";
		$response['AccessObject'] = "Wrong Passcode";
		echo json_encode($response);
		return;
	};
};
};
//----------------------------------------------------------------------------------------------------------------------------
?>
