<script language=JavaScript>
window.onload = this.focus

function insert_char(oChar) {
	var sel = window.opener.foo.document.selection;
	var rng = sel.createRange();
	rng.pasteHTML(oChar.innerHTML)
	window.close()
}

</script>
<style>
.char { cursor: hand; border-left: 1px solid #EEEEEE; border-top: 1px solid #EEEEEE; border-right: 1px solid #999999; border-bottom: 1px solid #999999; padding-bottom: 4px; padding-top: 4px; width: 29px; }
</style>
<title>[sTxtChars]</title>
<link rel="stylesheet" href="de_includes/de_styles.css" type="text/css">
<body bgcolor=threedface style="border: 1px buttonhighlight;">
<form name=textForm>
<div class="appOutside">
<div style="border: solid 1px #000000; background-color: #FFFFEE; padding:5px;">
	<img src="de_images/popups/bulb.gif" align=left width=16 height=17>
	<span>[sTxtCharsInst]</span>
</div>
<br>

<table bgcolor='threedface'>
  <tr>
	<td align='center'><div onClick="insert_char(this);" class="char">&nbsp;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&iexcl;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&cent;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&pound;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&yen;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&sect;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&uml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&copy;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&laquo;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&not;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&reg;</div></td>
  </tr>
  <tr>
	<td align='center'><div onClick="insert_char(this);" class="char">&deg;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&plusmn;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&acute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&micro;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&para;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&middot;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&cedil;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&raquo;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&iquest;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Agrave;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Aacute;</div></td>
  </tr>
  <tr>
	<td align='center'><div onClick="insert_char(this);" class="char">&Acirc;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Atilde;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Auml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Aring;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&AElig;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Ccedil;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Egrave;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Eacute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Ecirc;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Euml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Igrave;</div></td>
  </tr>
  <tr>
	<td align='center'><div onClick="insert_char(this);" class="char">&Iacute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Icirc;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Iuml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Ntilde;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Ograve;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Oacute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Ocirc;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Otilde;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Ouml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Oslash;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Ugrave;</div></td>
  </tr>
  <tr>
	<td align='center'><div onClick="insert_char(this);" class="char">&Uacute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Ucirc;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&Uuml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&szlig;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&agrave;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&aacute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&acirc;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&atilde;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&auml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&aring;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&aelig;</div></td>
  </tr>
  <tr>
	<td align='center'><div onClick="insert_char(this);" class="char">&ccedil;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&egrave;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&eacute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&ecirc;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&euml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&igrave;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&iacute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&icirc;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&iuml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&ntilde;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&ograve;</div></td>
  </tr>
  <tr>
	<td align='center'><div onClick="insert_char(this);" class="char">&oacute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&ocirc;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&otilde;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&ouml;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&divide;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&oslash;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&ugrave;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&uacute;</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&ucirc</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&uuml</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">&yuml;</div></td>
  </tr>
  <tr>
	<td align='center'><div onClick="insert_char(this);" class="char">‚</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">ƒ</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">„</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">…</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">†</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">‡</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">ˆ</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">‰</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">‹</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">Œ</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">‘</div></td>
  </tr>
  <tr>
	<td align='center'><div onClick="insert_char(this);" class="char">’</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">“</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">”</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">•</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">–</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">—</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">˜</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">™</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">›</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">œ</div></td>
	<td align='center'><div onClick="insert_char(this);" class="char">Ÿ</div></td>
  </tr>
</table>