<HTML>
<HEAD>
<TITLE>查找 / 替换</TITLE>
<script language="JavaScript">
// init stuff
var rng;
rng = dialogArguments.document.selection.createRange();

// returns a calculated value for matching case and matching whole words
function searchtype(){
    var retval = 0;
    var matchcase = 0;
    var matchword = 0;
    if (document.frmSearch.blnMatchCase.checked) matchcase = 4;
    if (document.frmSearch.blnMatchWord.checked) matchword = 2;
    retval = matchcase + matchword;
    return(retval);
}

function checkInput(){
    if (document.frmSearch.strSearch.value.length < 1) {
        alert("[sTxtFindError]");
        return false;
    } else {
        return true;
    }
}

// find the text I want
function findtext(){
    if (checkInput()) {
        var searchval = document.frmSearch.strSearch.value;
        rng.collapse(false);
        if (rng.findText(searchval, 1000000000, searchtype())) {
            rng.select();
        } else {
            var startfromtop = confirm("[sTxtFindNotFound]");
            if (startfromtop) {
                rng.expand("textedit");
                rng.collapse();
                rng.select();
                findtext();
            }
        }
    }
}

// replace the selected text
function replacetext(){
    if (checkInput()) {
        if (document.frmSearch.blnMatchCase.checked){
            if (rng.text == document.frmSearch.strSearch.value) rng.text = document.frmSearch.strReplace.value
        } else {
            if (rng.text.toLowerCase() == document.frmSearch.strSearch.value.toLowerCase()) rng.text = document.frmSearch.strReplace.value
        }
        findtext();
    }
}

function replacealltext(){
    if (checkInput()) {
        var searchval = document.frmSearch.strSearch.value;
        var wordcount = 0;
        var msg = "";
        rng.expand("textedit");
        rng.collapse();
        rng.select();
        while (rng.findText(searchval, 1000000000, searchtype())){
            rng.select();
            rng.text = document.frmSearch.strReplace.value;
            wordcount++;
        }
        if (wordcount == 0) msg = "[sTxtFindNotReplaced]"
        else msg = wordcount + "[sTxtFindReplaced]";
        alert(msg);
    }
}
</script>

</HEAD>
<BODY bgcolor="ThreeDFace">
<FORM NAME="frmSearch" method="post" action="">
<TABLE CELLSPACING="0" cellpadding="5" border="0">
<TR><TD VALIGN="top" align="left" nowrap style="font-family:Arial; font-size:11px;">
    <label for="strSearch">[sTxtFindFindWhat]</label><br>
    <INPUT TYPE=TEXT SIZE=40 NAME=strSearch id="strSearch" style="width : 280px;"><br>
    <label for="strReplace">[sTxtFindReplaceWith]</label><br>
    <INPUT TYPE=TEXT SIZE=40 NAME=strReplace id="strReplace" style="width : 280px;"><br>
    <INPUT TYPE=Checkbox SIZE=40 NAME=blnMatchCase ID="blnMatchCase"><label for="blnMatchCase">[sTxtFindMatchCase]</label><br>
    <INPUT TYPE=Checkbox SIZE=40 NAME=blnMatchWord ID="blnMatchWord"><label for="blnMatchWord">[sTxtFindMatchWord]</label>
</td>
<td rowspan="2" valign="top">
    <button name="btnFind" style="width:75px; height:22px; font-family:Tahoma; font-size:11px; margin-top:15px" onClick="findtext();">[sTxtFindNext]</button><br>
    <button name="btnReplace" style="width:75px; height:22px; font-family:Tahoma; font-size:11px; margin-top:7px" onClick="replacetext();">[sTxtFindReplaceText]</button><br>
    <button name="btnReplaceall" style="width:75px; height:22px; font-family:Tahoma; font-size:11px; margin-top:7px" onClick="replacealltext();">[sTxtFindReplaceAll]</button><br>
    <button name="btnCancel" style="width:75px; height:22px; font-family:Tahoma; font-size:11px; margin-top:7px" onClick="window.close();">[sTxtFindClose]</button><br>
</td>
</tr>
</table>
</FORM>
</BODY>
</HTML>