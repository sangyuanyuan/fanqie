<html>
<head>
<script language="javascript" type="text/javascript">
var win = window.opener;

function getWords(){
    var wrds = "";
    for(var i=0; i<win.arr.length; i++){
        wrds += i + ',' + win.arr[i].word;
        if (i<win.arr.length-1) wrds += ",";
    }
    document.frm.words.value = wrds;
    document.frm.lang.value = win.spellLang;
	document.frm.myRef.value = document.location
    document.frm.submit();
}	

</script>
</head>
<body onload="getWords();">
<form name="frm" method="post" action="http://www.spellcheckme.com/suggestions_wep.php">
<input type="hidden" name="words" value="">
<input type="hidden" name="myRef" value="">
<input type="hidden" name="lang" value="">
<font face=verdana size=2>Checking spelling. Please wait...</font>
</form>

</body>
</html>