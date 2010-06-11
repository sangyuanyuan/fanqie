<html>
<head>
<script language="javascript" type="text/javascript">

function QueryString(key)
{
	var value = null;
	for (var i=0;i<QueryString.keys.length;i++)
	{
		if (QueryString.keys[i]==key)
		{
			value = QueryString.values[i];
			break;
		}
	}
	return value;
}
QueryString.keys = new Array();
QueryString.values = new Array();

function QueryString_Parse()
{
	var query = window.location.search.substring(1);
	var pairs = query.split("&");
	
	for (var i=0;i<pairs.length;i++)
	{
		var pos = pairs[i].indexOf('=');
		if (pos >= 0)
		{
			var argname = pairs[i].substring(0,pos);
			var value = pairs[i].substring(pos+1);
			QueryString.keys[QueryString.keys.length] = argname;
			QueryString.values[QueryString.values.length] = value;		
		}
	}

}

QueryString_Parse();

var win = window.opener;
var nw = new Array(); // array that stores wrong words
var ec = -1;
var currec = 0;
var orig = win.foo.document.body.innerText;
var init = false;

window.attachEvent("onfocus",redoSpellCheck);

function word(pos) {
	this.position=pos;
	this.addSuggestion=addSuggestion;
	this.suggestions=new Object();
	this.suggCount=0;
	this.status=0; // 0 = unchanged, 1 = ignored, 2 = changed, 3 = not found
	try{
	    this.word = win.arr[pos].word;
	}
	catch(e){
	    this.word = null;
	    this.status = 3;
	}
}

function addSuggestion(s) {
	this.suggestions[this.suggCount]=s;
	this.suggCount++;
}

function initForm(){
    /* set up initial form values */
    setWord(0);
    init=true;
}

function setWord(idx){
    var oOption;
    if (currec > ec || ec == -1) {
        alert("Spelling check is complete");
        window.close();
    }else{
        if(nw[idx].status != 0){
            setWord(++currec);
            return;
        }
        if(win.arr[nw[currec].position].getWord()){
            notWord.value = nw[idx].word;
            if(nw[idx].suggCount > 0) {
                sugg.innerHTML = ""; // clear all options then repopulate
                for(j=0; j<nw[idx].suggCount;j++){
                    oOption = document.createElement("OPTION");
                    sugg.options.add(oOption);
                    oOption.innerText = nw[idx].suggestions[j];
                    oOption.value = nw[idx].suggestions[j];
                }

				if (nw[idx].suggestions[0] != "(no suggestions)")
				{
	                repWord.value = nw[idx].suggestions[0];
					sugg.disabled = false
				} else {
					repWord.value = nw[idx].word
					repWord.select()
					repWord.focus()
					sugg.disabled = true
				}

            }
        }
    }
}

function selectSuggestion(obj){
    repWord.value = sugg[obj.selectedIndex].value;
}

function ignore(){
    nw[currec].status=1;
    setWord(++currec);
}
function ignoreAll(){
    var ic = currec;
    nw[currec].status=1;
    for(i=currec;i<ec;i++){
        if(nw[ic].word == nw[i].word) nw[i].status=1;
    }
    setWord(++currec);
}

function isvalid(wrd){
	for(i=0;i<sugg.options.length;i++) if(sugg.options[i].value==wrd) return true;
	return false;
}

function change(){
    var newword = repWord.value;
    var numwords;
    if(newword.length != 0){numwords = getWordCount();} else {numwords = 0;}
    nw[currec].status=2;
    win.arr[nw[currec].position].fixWord(newword, numwords);
    // if (!isvalid(newword)){redoSpellCheck();return;}
    orig = win.foo.document.body.innerText;
    setWord(++currec);
}

function changeAll(){
    var ic = currec;
    var newword = repWord.value;
    var numwords;
    if(newword.length != 0){numwords = getWordCount();} else {numwords = 0;}
    nw[currec].status=2;
    for(i=ic;i<=ec;i++){
        if(nw[ic].word == nw[i].word){
            nw[i].status=2;
            win.arr[nw[i].position].fixWord(newword, numwords);
        }
    }
    // if (!isvalid(newword)){redoSpellCheck();return;}
    orig = win.foo.document.body.innerText;
    setWord(++currec);
}

function getWordCount(){
    var r = repWord.createTextRange();
    var rEnd = true; var wordcount=0;
    // loop until I run out of words
    while(rEnd){
        if(r.text.match(/[\ \n\r]+$/)) r.moveEnd("character",-1); // strip out any trailing line feeds and spaces
        t=r.text; // grab the text
        if((t!="." || t!="!" || t!="?") && (rEnd!=0 && t.match("[A-Za-z]"))) r.collapse();
        /* grab the next word */
        r.move("word",1); rEnd = r.expand("word");
        wordcount++;
    }
    return wordcount;
}

function redoSpellCheck(){
    if(win.foo.document.body.innerText != orig && init){
        init = false; // we've started the resubmit process, don't restart it!
        alert("You've changed the content directly or replaced \na word with one not in the dictionary. \nThe spellcheck will be repeated.");
        win.rng.select(); // reselect original range
        win.spellCheck(); // redo the spellcheck
        return;
    }
}

// Include the JavaScript suggestions file
document.write("<\script language=javascript type=text/javascript src=$HTTPStr://www.spellcheckme.com/delete_js.php?file=" + QueryString('JS') + "></\script>");

</script>


<style type="text/css">
	body    { background-color: threedface; border:0px; }
	div     { font-family:Tahoma; font-size:11px; }
	.btn    { width:75px; height:22px; font-family:Tahoma; font-size:11px; margin-top:7px; }
</style>
</head>

<body onload="initForm();">
<table border="0" cellpadding="0" cellspacing="0" width="285">
<tr><td valign="top">
<div><label for="notWord">Not in Dictionary</label></div>
<div><input type="text" id="notWord" style="width:200px;" disabled></div>

<div style="margin-top:7px;"><label for="repWord">Replace with</label></div>
<div><input type="text" id="repWord" style="width:200px;"></div>

<div style="margin-top:7px;"><label for="sugg">Suggestions</label></div>
<select id="sugg" size="5" style="width:200px;" onclick="selectSuggestion(this);">
</select>
</td><td valign="top" align="right">

<button onclick="ignore();" class="btn">Ignore</button><br>
<button onclick="ignoreAll();" class="btn">Ignore All</button><br>
<button onclick="change();" class="btn" style="margin-top:15px;">Change</button><br>
<button onclick="changeAll();" class="btn">Change All</button><br>
<button onclick="window.close();" class="btn" style="margin-top:40px;">Cancel</button>

</td>
</tr></table>
</body>
</html>