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
echo json_encode($Response);
	return;

if ($IncomingArray == NULL) {
       	$Response['ErrorMessage'] .= "The JSON sent to the server was mal formed. ";
	echo json_encode($Response);
	return;
}; 								          $Response['ErrorMessage'] .= "The JSON sent to the server was well formed. ";

	   $Protocol = $IncomingArray['Protocol'];			  $Response['ErrorMessage'] .= "[Method] is ${Protocol}. ";


if ($Protocol == "TESTGET") {

                $Url = "TestJSON.txt";
       $TestContents = file_get_contents("$Url");	           	  $Response['ErrorMessage'] .= "[TestContents] is ${TestContents}. ";
   $TestContentsJSON = json_decode($TestContents, true); 		  $Response['ErrorMessage'] .= "The [PFContentsJSON] is $TestContentsJSON. ";
$TestContentsVarDump = var_dump($TestContentsJSON);           	 	  $Response['ErrorMessage'] .= "The Var Dump of Test Contents JSON is ${TestContentsVarDump}; 
        
     $ArrayIncoming = array_flip($IncomingArray);
  $IntersectingVars = array_intersect_key($ArrayIncoming,$TestContentsJSON);

echo json_encode(array_merge($Response,$result));
return;
};



?>
