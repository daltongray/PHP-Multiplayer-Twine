window.JSONToServerTest = function(print){
var JSONToServer = '{';  
var i;  
var arg = arguments.length - 1;
for (i = 1; i < arguments.length; i++) { 
   JSONToServer += '"var' + i + '":"' + arguments[i] + '"';
		if (i == arg) {
		JSONToServer += '}';
		} else {
		JSONToServer += ',';
		} 
	}	
	variables().JSONToServerTest = JSONToServer;
}

//_____DIALOGUE FUNCTIONS_____________________




/*----------CLOSE DIALOGUE BOXES
			
Dialog.close();
			
--------------------------------*/





//____________DIALOGUE UPDATE____________________
//			
//	This function takes a passagename and a title. 
// 	it closes the current dialogue box, 
//	then generates a new one, pulling from the passagename
//	and titling it with the title given. 
//
//

window.DialogueUpdate = function(passagename, dialoguetitle){
	Dialog.close();
	Dialog.setup(dialoguetitle);
	Dialog.wiki(Story.get(passagename).processText()); 
	Dialog.open();
}

//----------------------------------------------------







//_____UTILITY FUNCTIONS________________________




//____________TWINE VAR WRAP____________________
//          
//  This function takes an html element   
//  and the name of a twine var. It gets 
//  the HTML element ID and turns it into 
//  A twine variable. Great for input fields. 
//
//

window.TwineVarWrap = function(element, twinevar){
	var content = document.getElementById(element).value;
	variables()[twinevar] = content;
};

//----------------------------------------------------





//	DEBUG FEATURE	TO ADD!!
//	
//	to save time and catch bugs client-side
//	before having to upload twine files to 
//	the server, I'm adding a debug switch.
//	any functions that interact with the
//	server, will check the debug var, which
//	is twine side, before executing an xml
//	request. It will instead plug the request
//	they would send to the server into a debug
//	variable or object.




//_____PLAYERFILE FUNCTIONS_____________________



//____________CHECK AND CREATE____________________
//          
//  This function takes a player name, and a player passcode
//  and an output. It connects to the server, where the server
//  checks to see if a file with the playername exists. Then 
//  If it doesn't it creates a file and outputs success. 
//
//


window.PlayerFileCheckAndCreate = function(TwPlayerName,TwPasscode,Output) {
  if (Output === "undefined") {var UpdateOutput = "TwinePseudoConsole";}
  variables()[Output] = "No Response Received from the Server.";
	var PlayerName = variables()[TwPlayerName];
	var Passcode = variables()[TwPasscode];
	
	var str = '{"Method":"CheckAndCreate","PlayerName":"'+PlayerName+'","Passcode":"'+Passcode+'"}';
  console.log("Here's our JSON-ified string:"+str);
	var url = "PlayerFile.php";
	console.log("Here's the URL we're sending it to"+url);
	var payload = url+"?q="+str;
	console.log("Here's the full payload, url and json");
	
	var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
		if(this.readyState == 1) {console.log("XML ReadyStatus = 1");};
		if(this.readyState == 2) {console.log("XML ReadyStatus = 2");};
		if(this.readyState == 3) {console.log("XML ReadyStatus = 3");};
		if(this.readyState == 4) {console.log("XML ReadyStatus = "+this.status);};
		if (this.readyState == 4 && this.status == 200) {
			var ResponseObject = JSON.parse(this.response);
			console.log("Here's the response text from the server"+ResponseObject.ErrorMessage);
			if (ResponseObject.TwineResponse == "Taken") {
			variables()[Output] = "The name was taken.";
			}
			if (ResponseObject.TwineResponse == "Success") {
			variables()[Output] = "PlayerFile Successfully Created!";
			}
    }
  }

  xhttp.open("GET", payload,);
  xhttp.send();
};


//----------------------------------------------------








//____________ACCESS____________________
//          
//  
//  
//   
//    
//
//


window.PlayerFileAccess = function(Var1,Output1) {
  if (Output1 === "undefined") {console.log("No Output Defined");}
  var PlayerName = variables()['PlayerName'];
	var Passcode = variables()['Passcode'];
	if (Var1 === "undefined") {Var1 = PlayerName;};

	var str = '{"Method":"Access","PlayerName":"'+PlayerName+'","Passcode":"'+Passcode+'","Var1":"'+Var1+'"}';
  console.log("Here's our JSON-ified string:"+str);
	var url = "PlayerFile.php";
	console.log("Here's the URL we're sending it to"+url);
	var payload = url+"?q="+str;
	console.log("Here's the full payload, url and json");
	
	var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
		if(this.readyState == 1) {console.log("XML ReadyStatus = 1");};
		if(this.readyState == 2) {console.log("XML ReadyStatus = 2");};
		if(this.readyState == 3) {console.log("XML ReadyStatus = 3");};
		if(this.readyState == 4) {console.log("XML ReadyStatus = "+this.status);};
		if (this.readyState == 4 && this.status == 200) {
			var ResponseObject = JSON.parse(this.response);
			console.log("Here's the response text from the server"+ResponseObject.ErrorMessage);
	
		
			if (ResponseObject.AccessObject == "Wrong Passcode") {
			variables()[Output1] = "Passcode was Invalid";
			}
			if (ResponseObject.AccessObject != "Wrong Passcode") {
			variables()[Output1] = ResponseObject.AccessObject;
			}
    }
  }

  xhttp.open("GET", payload,);
  xhttp.send();
};






//_____DIMFILE FUNCTIONS_____________________




//____________CHECK AND CREATE____________________
//          
//  This function takes a Dim name, and a Dim passcode
//  and an output. It connects to the server, where the server
//  checks to see if a file with the playername exists. Then 
//  If it doesn't it creates a file and outputs success. 
//
//


window.DimFileCheckAndCreate = function(TwDimName,TwPasscode,Output) {



// ----------------SETUP-------------------------------------------------
if (Output === "undefined") {var UpdateOutput = "TwinePseudoConsole";}

variables()[Output] = "No Response Received from the Server.";
	var DimName = variables()[TwDimName];
       var Passcode = variables()[TwPasscode];
	    var str = '{"Method":"CheckAndCreate","DimName":"';
	   var str += DimName+'","Passcode":"'+Passcode+'"}';
	    var url = "DimFile.php";
	var payload = url+"?q="+str;
	  var xhttp = new XMLHttpRequest();

  	console.log("Here's our JSON-ified string:"+str);
	console.log("Here's the URL we're sending it to"+url);
	console.log("Here's the full payload, url and json");
//-----------------------------------------------------------------------




// ----------------ON RESPONSE-------------------------------------------
var OnResponse = function(){
	if (ResponseObject.TwineResponse == "Taken") {
		variables()[Output] = "The name was taken.";
		}
	if (ResponseObject.TwineResponse == "Success") {
		variables()[Output] = "DimFile Successfully Created!";
		}
};
//-----------------------------------------------------------------------





// ----------------XML REQUEST-------------------------------------------
xhttp.onreadystatechange = function() {
	if(this.readyState == 1) {console.log("XML ReadyStatus = 1");};
	if(this.readyState == 2) {console.log("XML ReadyStatus = 2");};
	if(this.readyState == 3) {console.log("XML ReadyStatus = 3");};
	if(this.readyState == 4) {console.log("XML ReadyStatus = "+this.status);};
	if(this.readyState == 4 && this.status == 200) {
		var ResponseObject = JSON.parse(this.response);
		console.log("Here's the response text from the server"+ResponseObject.ErrorMessage);
		OnResponse;}
}

  xhttp.open("GET", payload,);
  xhttp.send();
};


//----------------------------------------------------








//____________ACCESS____________________
//          
//  
//  
//   
//    
//
//


window.DimFileAccess = function(Var1,Output1) {

// ----------------SETUP-------------------------------------------------
if (Output1 === "undefined") {console.log("No Output Defined");}
if (Var1 === "undefined") {Var1 = DimName;};

   var DimName = variables()['DimName'];
	var Passcode = variables()['DimPasscode'];
	     var str = '{"Method":"Access","DimName":"'+DimName+'",';
	    var str += '"Passcode":"'+Passcode+'","Var1":"'+Var1+'"}';
	     var url = "DimFile.php";
	 var payload = url+"?q="+str;
	   var xhttp = new XMLHttpRequest();

console.log("Here's our JSON-ified string:"+str);
console.log("Here's the URL we're sending it to"+url);
console.log("Here's the full payload, url and json");
//-----------------------------------------------------------------------




// ----------------ON RESPONSE-------------------------------------------
var OnResponse = function(){
	if (ResponseObject.AccessObject == "Wrong Passcode") {
		variables()[Output1] = "Passcode was Invalid";
	}
	if (ResponseObject.AccessObject != "Wrong Passcode") {
		variables()[Output1] = ResponseObject.AccessObject;
		variables().LocalDimFile = ResponseObject.TwineResponse;
	}
};
//-----------------------------------------------------------------------





// ----------------XML REQUEST-------------------------------------------
xhttp.onreadystatechange = function() {
	if(this.readyState == 1) {console.log("XML ReadyStatus = 1");};
	if(this.readyState == 2) {console.log("XML ReadyStatus = 2");};
	if(this.readyState == 3) {console.log("XML ReadyStatus = 3");};
	if(this.readyState == 4) {console.log("XML ReadyStatus = "+this.status);};
	if (this.readyState == 4 && this.status == 200) {
		var ResponseObject = JSON.parse(this.response);
		console.log("Here's the response text from the server"+ResponseObject.ErrorMessage);
		OnResponse;	
	}
}
xhttp.open("GET", payload,);
xhttp.send();
};
//-----------------------------------------------------------------------











