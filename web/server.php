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

$Response = array("ErrorMessage"=>"The Response Object has been setup. ");

//----------------------------------------------------------------------------------------------------------------------------
// ----------------ID JSON, UNPACK, SETUP-----------------------------------------------------------------------
		  $q = $_REQUEST["q"];
      $IncomingArray = json_decode($q, true);
                $Url = "TestJSON.txt";
       $TestContents = file_get_contents("$Url");	           	  $Response['ErrorMessage'] .= "[TestContents] is ${TestContents}. ";
   $TestContentsJSON = json_decode($TestContents, true); 		 
         $PlayerFile = $TestContentsJSON;
           $Protocol = $IncomingArray['Protocol'];			  $Response['ErrorMessage'] .= "[Method] is ${Protocol}. ";
	   unset($IncomingArray['Protocol']);


if ($IncomingArray == NULL) {
       	$Response['ErrorMessage'] .= "The JSON sent to the server was mal formed. ";
	echo json_encode($Response);
	return;
}; 								      	  $Response['ErrorMessage'] .= "The JSON sent to the server was well formed. ";


//-----------------------------------------------------------------
// -------------------  GET   -------------------------------------

if ($Protocol == "TESTGET") {
	$ArrayIncoming = array_flip($IncomingArray);
	unset($ArrayIncoming['']);
	$PlayerFile = array_intersect_key($PlayerFile, $ArrayIncoming);
	$PlayerFile = $PlayerFile + $Response;
	echo json_encode($PlayerFile);
	return;
};

//-----------------------------------------------------------------
// ----------------  UPDATE   -------------------------------------


if($Protocol = "Update") {
    $vardb = '{"FirstName":"Quasar","LastName":"Gray"}'; //file_get_contents("$filename") or die("could not reach $filename");
    $vardbjson = json_decode($vardb, true);

    foreach ($IncomingArray as $key => $value) {
    $PlayerFile[$key] = $value;
    };						$Response['ErrorMessage'] .= json_encode($vardbjson);

    if (is_writable($Url)) {
        $fh = fopen("$Url", 'w') or die("Error opening output file");
        fwrite($fh, json_encode($PlayerFile,JSON_UNESCAPED_UNICODE));
        fclose($fh);
    };

    $Response['UpdateReport'] = "Successfully updated the PlayerFile.";
    echo json_encode($Response);	
};

?>
