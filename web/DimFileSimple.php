<?php
//
//	One Var will come in on a GET Request
//	This will open the DIMFILE, Decode the JSON and return the value of the Var
//



// ----------------SETUP-----------------------------------------------------------------------
 $response = array(
	"Var"=>"Error",  // Taken | Success | Error | AccessObject
	"ErrorMessage"=>"The Response Object has been setup. ";
//----------------------------------------------------------------------------------------------------------------------------




// ----------------SETUP-----------------------------------------------------------------------
              $q = $_REQUEST["q"]; 		$response['ErrorMessage'] .= "The Var is ${q}. ";
    $DimFileName = "AlphaQ";				$response['ErrorMessage'] .= "[DimFileName] is ${DimFileName}. ";
     $DimFileurl = "DimFiles/{$DimFileName}.txt";	$response['ErrorMessage'] .= "[DimFileurl] is ${DimFileurl}. ";
     $DFContents = file_get_contents("$DimFileurl");	$response['ErrorMessage'] .= "[DFContents] is ${DFContents}. ";
 $DFContentsJSON = json_decode($DFContents, true); 	$response['ErrorMessage'] .= "The [DFContentsJSON] is $DFContentsJSON. ";
     $VarToTwine = $DFContentsJSON[$q];			$response['ErrorMessage'] .= "The [VarToTwine] is ${VarToTwine}. ";
	$response['Var'] = $VarToTwine;
	echo $response;
	return;
//----------------------------------------------------------------------------------------------------------------------------




?>
