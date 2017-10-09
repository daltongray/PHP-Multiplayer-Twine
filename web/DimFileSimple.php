window.DFAccess = function (VarToCheck,VarToOutput){
	var url = "DimFile.php"
	var payload = url+"?q="+VarToCheck;
	console.log("Here's the full payload, url and json");
	
	var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
		if(this.readyState == 1) {console.log("XML ReadyStatus = 1");};
		if(this.readyState == 2) {console.log("XML ReadyStatus = 2");};
		if(this.readyState == 3) {console.log("XML ReadyStatus = 3");};
		if(this.readyState == 4) {console.log("XML ReadyStatus = "+this.status);};
		if (this.readyState == 4 && this.status == 200) {
			var ResponseObject = this.response;
			console.log("Here's the response text from the server"+ResponseObject);
			variables()[VarToOutput] = ResponseObject;
			console.log("Here's the tw Output"+variables()[VarToOutput]);
			}
    }
  }

  xhttp.open("GET", payload,);
  xhttp.send();
}
