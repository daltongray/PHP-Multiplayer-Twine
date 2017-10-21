<!DOCTYPE html>
<html>
<body>

Data structures:

Serverside
  SERVER.PHP
  REPO/ Playerfile | Dimension File | etc.JSONs

<h1>ClientSide</h1>

1. Declare local Objects

<p>
LocalPlayerFile = {       <br>
    FirstName:"Dalton",   <br>
    LastName:"Gray",      <br>
    Age:25,               <br>
    EyeColor:"Green",     <br>
    DimFile:"Earth"       <br>
};                        <br>
</p>
  
<p>
Our first name is: <span id = "FirstName"></span>       <br>
Our last name is: <span id = "LastName"></span>         <br>
Our age is: <span id = "Age"></span>                    <br>
Our eye color is: <span id = "EyeColor"></span>         <br>
Our DimFile is: <span id = "DimFile"></span>            <br>
</p>

  
<p>
LocalDimFile = {            <br>
    PlanetName:"Earth",     <br>
    GalaxyName:"MilkyWay",  <br>
    UniverseName:"1",       <br>
    CupStatus:"Half Full"   <br>
    Inhabitants: "Dalton"   <br>
}; <br>
</p>
  
<p>
Our planet name is: <span id = "PlanetName"></span>     <br>
Our GalaxyName is: <span id = "GalaxyName"></span>      <br>
Our UniverseName is: <span id = "UniverseName"></span>  <br>
Our CupStatus is: <span id = "CupStatus"></span>        <br>
Our Inhabitants are: <span id = "Inhabitants"></span>   <br>
</p>
  
<script>          

var LocalPlayerFile = {
    FirstName:"Dalton",
    LastName:"Gray",
    Age:25,
    EyeColor:"Green",
    DimFile:"Earth"
};

document.getElementById("FirstName").innerHTML = LocalPlayerFile.FirstName;
document.getElementById("LastName").innerHTML = LocalPlayerFile.LastName;
document.getElementById("Age").innerHTML = LocalPlayerFile.Age;
document.getElementById("EyeColor").innerHTML = LocalPlayerFile.EyeColor;
document.getElementById("DimFile").innerHTML = LocalPlayerFile.DimFile;

var LocalDimFile = {            
    PlanetName:"Earth",     
    GalaxyName:"MilkyWay",  
    UniverseName:"1",       
    CupStatus:"Half Full",   
    Inhabitants: "Dalton"
};
  
document.getElementById("PlanetName").innerHTML = LocalDimFile.PlanetName;
document.getElementById("GalaxyName").innerHTML = LocalDimFile.GalaxyName;
document.getElementById("UniverseName").innerHTML = LocalDimFile.UniverseName;
document.getElementById("CupStatus").innerHTML = LocalDimFile.CupStatus;
document.getElementById("Inhabitants").innerHTML = LocalDimFile.Inhabitants;
  
</script>


<h1>Jsonify for GET</h1>

This is a function in JS that will take args, passed to it by the GET function,   <br>
and turn them into a JSON that will sync up with our server. Adds a protocol: GET <br>

Pseudo Code: 
    Create object, 
        protocol = get
    each arg 
        equalls var 1, 2, 3, etc
        gets added to the object
    jsonify object

  <input type = "text" id = "FirstArg">
  <input type = "text" id = "SecondArg">
  
  <button onclick = "JSONifyForGetShell();">JSONify!</button>
  
  Result <span id = "JSONifyForGetResult"></span>
 
<script>
var JSONifyForGetShell = function() {
  
  var ArgOne = document.getElementById("FirstArg").value;
  var ArgTwo = document.getElementById("SecondArg").value;
  
  var Response = JSONifyForGet(ArgOne,ArgTwo,"ThirdArg");
  document.getElementById("JSONifyForGetResult").innerHTML = Response;
}

var JSONifyForGet = function () {

  
  var Obj = {
     Protocol:"TESTGET"
  };
  
  for(var i=0; i<arguments.length; i++){
    Obj["Var"+i] = arguments[i];
}
  
  
  var JSONObj = JSON.stringify(Obj);
  return JSONObj;
}
  
</script>
  

<h1>PHP for GET</h1>

This is a serverside php function that decodes a json passed to it,
sorts it by protocol, pulls up a JSON file, fetches the values of vars
listed in the recieved json, & compiles a json to send to the client.

Pseudo Code
    Take arg json
    Dejsonify
    console log error message
    for each varname
        twvar = var
  
  
 



<h1>De-Jsonify for GET</h1>

This is a function in JS that will decode a JSON received from the server, 
plop the error message into the console log, and update any local variables 
with their server values. 

Pseudo code:
    Decode json
    console log Error message 
    for each var, twvar = val




<h1>GET</h1>

Get("Var1", "var2", "var3", etc...)
    JSON = Jsonifyforget(this.args)
    xml JSON
    
    Dejsonifyforget(Response)
  
  Var 1<input type="text" id="GetInputOne"> <br>
  Var 2<input type="text" id="GetInputTwo"> <br>
  Var 3<input type="text" id="GetInputThree"> <br>

 
<script>  
  
  var GetTest = function() {
    var VarOne = document.getElementById("GetInputOne").value;
    var VarTwo = document.getElementById("GetInputTwo").value;
    var VarThree = document.getElementById("GetInputThree").value;

    GET(VarOne,VarTwo,VarThree);
  };
  
  
var GET = function() {
  
  str = JSONifyForGet.apply(null, arguments);
  console.log(str);
  
  //create a var for our xhttp object
  var xhttp;
 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
      var ReceivedResponse = this.responseText;         console.log(ReceivedResponse);
      var RRObject = JSON.parse(ReceivedResponse);
      console.log(RRObject.ErrorMessage);
      delete RRObject.ErrorMessage;
      
      var Values;
      for (Values in RRObject) {
        console.log(Values);
        console.log(LocalPlayerFile[Values]);
        LocalPlayerFile[Values] = RRObject[Values];
        console.log(LocalPlayerFile);
        document.getElementById("GetTestResult").innerHTML = LocalPlayerFile
      };
    }
  };
  //finally open an xml request, via GET protocol to GET.php
  //with the additional q= protocol which adds any txt from the field to the url
  //ie: how we send jsons!
  xhttp.open("GET", "server.php?q="+str, true);
  xhttp.send();   
}

  </script>
  
 <button onclick="GetTest()">Get These Vars</button>
 Result: <span id="GetTestResult">
  
  
    
    
    
    
    
    
<h1>Jsonify for UPDATE </h1>

This is a function that receives args from twine,
and turns them into a json for sending to the server. 
Adds a protocol: Update

take args, make object<br>
<br>
  <input type = "text" id = "FirstUpdateArg"> <br>
  <input type = "text" id = "SecondUpdateArg"> <br>
  <script>
    var JSONifyForUpdateShell = function() {

    var ArgOne = document.getElementById("FirstUpdateArg").value;
    var ArgTwo = document.getElementById("SecondUpdateArg").value;

   var Response = JSONifyForUpdate(ArgOne, ArgTwo, "Dalton", "LastName");
    document.getElementById("JSONifyForUpdateResult").innerHTML = Response;
  }

var JSONifyForUpdate = function() {


  var Obj = {
    Protocol: "Update"
  };
var o;
var ArgLenMinusOne = arguments.length - 1;
  for (var i = 0; i < ArgLenMinusOne; i += 2) {
    o = (i + 1);
    Obj[arguments[i]] = arguments[o];
  }
console.log(Obj);

  var JSONObj = JSON.stringify(Obj);
  return JSONObj;
}

  
  </script>
  
  <button onclick = "JSONifyForUpdateShell();">JSONify!</button>
    Results: <span id="JSONifyForUpdateResult"> </span>
    
    
    
    
    
    
    
    
    
<h1>DE-Jsonify for UPDATE </h1>

 




    
    
 <h1>Update</h1>
    
    This is a JS function that sends a json to the server,
which decodes it, opens a repo json, and plops the values 
   wesend it into the json, then returns the error reporting 
    Js plops that into the console log
and does little else.
    
    Update("Var1", "var2", "var3", etc...)
    JSON = JsonifyforUpdate(this.args)
    xml JSON
    
    Dejsonifyforupdate(Response)
    console log error msg <br>
  <br>
  
  Var 1<input type="text" id="UpdateInputOne"> <br>
  Val 1<input type="text" id="UpdateInputTwo"> <br>
  Var 2<input type="text" id="UpdateInputThree"> <br>
  Val 2<input type="text" id="UpdateInputFour"> <br>

 
<script>  
  
   
   
  
  var UpdateShell = function() {
    var VarOne = document.getElementById("UpdateInputOne").value;
    var VarTwo = document.getElementById("UpdateInputTwo").value;
    var VarThree = document.getElementById("UpdateInputThree").value;
    var VarFour = document.getElementById("UpdateInputFour").value;

    
    Update(VarOne,VarTwo,VarThree,VarFour);
  };
  
  
var Update = function() {
  
  var str = JSONifyForUpdate.apply(null, arguments);
  console.log(str);
  
  var xhttp;
 
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
      var ReceivedResponse = this.responseText;     
      var RRObject = JSON.parse(ReceivedResponse);
      console.log(RRObject.ErrorMessage);
      delete RRObject.ErrorMessage;
     
        document.getElementById("UpdateTestResults").innerHTML = RRObject.UpdateReport;
      };
    };
  

  xhttp.open("GET", "server.php?q="+str, true);
  xhttp.send();   
};

 
 
  </script>
  
 <button onclick="UpdateShell()">Update These Vars</button>
  <span id="UpdateTestResults"></span>
  
  
    
    
    
    
    
    
    
<h1>Create Repo</h1>

This is a Serverside PHP function that creates a json repository of vars. 
Used to create new playerfiles, and dimension files ( the files where all
the variables of a given server are kept.) 

Pseudo Code





<form action=""> 
JSON: <input type="text" id="txt1" onkeyup="showHint(this.value)">
</form>

<p>Suggestions: <span id="txtHint"></span></p> 

  
<script>
  //this function runs whatever's entered in the txt box above
  
function showHint(str) {
  //create a var for our xhttp object
  var xhttp;
  //if there's nothing in the text box...
  if (str.length == 0) { 
    //set the txthint to nothing and terminate the function
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  //an implied else, if there is text in the field,
  //create a new XML request
  xhttp = new XMLHttpRequest();
  //some xml thing I don't fully understant
  xhttp.onreadystatechange = function() {
    //when ready state ==4 & this status =200 -- also don't fully understand this
    if (this.readyState == 4 && this.status == 200) {
      //then set txt hint to whatever comes back from the GET request
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  //finally open an xml request, via GET protocol to GET.php
  //with the additional q= protocol which adds any txt from the field to the url
  //ie: how we send jsons!
  xhttp.open("GET", "GET.php?q="+str, true);
  xhttp.send();   
}
</script>
 

  
<form action=""> 
JSON with form {"var":"varname","val":"value"}: <input type="text" id="txt2" onkeyup="updatejson(this.value)">
</form>

<p>Output: <span id="updatejsonoutput"></span></p> 

  
  
<script>
function updatejson(str) {
  //create a var for our xhttp object
  var xhttp;
  //if there's nothing in the text box...
  if (str.length == 0) { 
    //set the txthint to nothing and terminate the function
    document.getElementById("updatejsonoutput").innerHTML = "nothing is written here!";
    return;
  }
  //an implied else, if there is text in the field,
  //create a new XML request
  xhttp = new XMLHttpRequest();
  //some xml thing I don't fully understant
  xhttp.onreadystatechange = function() {
    //when ready state ==4 & this status =200 -- also don't fully understand this
    if (this.readyState == 4 && this.status == 200) {
      //then set txt hint to whatever comes back from the GET request
      document.getElementById("updatejsonoutput").innerHTML = this.responseText;
    }
  };
  //finally open an xml request, via GET protocol to GET.php
  //with the additional q= protocol which adds any txt from the field to the url
  //ie: how we send jsons!
  xhttp.open("GET", "UPDATE.php?q="+str, true);
  xhttp.send();   
}
  
</script>

</body>
</html>
