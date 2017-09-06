<!DOCTYPE html>
<html>
<body>

<h1>USing an XMLHTTP GET Request to get a variable out of an external JSON</h1>

<h3>Type a JSON in the field below. set var to either "var1" or "var2"</h3>

<form action=""> 
JSON: <input type="text" id="txt1" onkeyup="showHint(this.value)">
</form>

<p>Suggestions: <span id="txtHint"></span></p> 

<script>
function showHint(str) {
  var xhttp;
  if (str.length == 0) { 
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "GET.php?q="+str, true);
  xhttp.send();   
}
</script>

</body>
</html>
