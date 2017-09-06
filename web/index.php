<!DOCTYPE html>
<html>
<body>

<h1>USing an XMLHTTP GET Request to get a variable out of an external JSON</h1>

<h3>This is a prototyping tool for testing the backend GET system. 
  Type a JSON in the field below. set var to either "var1" or "var2"</h3>

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

</body>
</html>
