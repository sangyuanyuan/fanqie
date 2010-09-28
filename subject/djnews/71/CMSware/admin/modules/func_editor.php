<?php   
if(!defined('IN_IWPC')) {
 	exit('Access Denied');
}
include_once(INCLUDE_PATH."editor/class.devedit.php");
require_once LANG_PATH.$SYS_ENV['language'].'/lang_skin/admin/func_editor.php';
?>
<html>
<head>
<title><?=$IN[PATH]?>/<?=$IN[targetFile]?> - <?echo $_LANG_SKIN['title']; ?></title>
<link type="text/css" rel="StyleSheet" href="../html/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 CHARSET;?>">
<script type="text/javascript">

var ie55 = /MSIE ((5\.[56789])|([6789]))/.test( navigator.userAgent ) &&
			navigator.platform == "Win32";

if ( !ie55 ) {
	window.onerror = function () {
		return true;
	};
}

function writeNotSupported() {
	if ( !ie55 ) {
		document.write( "<p class=\"warning\">" +
			"This script only works in Internet Explorer 5.5" +
			" or greater for Windows</p>" );
	}
}

</script>
<script type="text/javascript">

function getQueryString( sProp ) {
	var re = new RegExp( sProp + "=([^\\&]*)", "i" );
	var a = re.exec( document.location.search );
	if ( a == null )
		return "";
	return a[1];
};

function changeCssFile( sCssFile ) {
	var loc = String(document.location);
	var search = document.location.search;
	if ( search != "" )
		loc = loc.replace( search, "" );
	loc = loc + "?css=" + sCssFile;
	document.location.replace( loc );
}

var cssFile = getQueryString( "css" );
if ( cssFile == "" )
	cssFile = "../../html/menu/skins/winclassic.css";

document.write("<link type=\"text/css\" rel=\"StyleSheet\" href=\"" + cssFile + "\" />" );

</script>

<script type="text/javascript" src="../../html/menu/js/poslib.js"></script>
<script type="text/javascript" src="../../html/menu/js/scrollbutton.js"></script>
<script type="text/javascript" src="../../html/menu/js/menu4.js"></script>

</head>
<script src="../html/functions.js" type="text/javascript" language="javascript"></script>
<SCRIPT language=JavaScript>
var NodeID = '<?=$IN[NodeID]?>';
var sId = '<?=$IN['sId']?>';
var PATH = '<?=$IN[PATH]?>';
var targetFile = '<?=$IN[targetFile]?>';
var o = '<?=$IN[o]?>';

</script>
<body bgcolor=threedface STYLE="margin:0pt;padding:0pt;border: 1px buttonhighlight;" onload="document.FM.content.focus();">
<script type="text/javascript">
//<![CDATA[

// set css file to use for menus
Menu.prototype.cssFile = cssFile;

var tmp;

// Build context menu
var cMenu = new Menu();

var openItem, openNewWinItem;

cMenu.add( openItem = new MenuItem( "Open" ) );
openItem.mnemonic = "o";
cMenu.add( openNewWinItem = new MenuItem( "Open in New Window" ) );
openNewWinItem.mnemonic = "n";
openNewWinItem.target = "_blank";	// open in new window

var backItem, forwardItem, refreshItem;

cMenu.add( backItem = new MenuItem( "Back", function () { window.history.go(-1); }, "images/back.png" ) );
backItem.mnemonic = "b";
cMenu.add( forwardItem = new MenuItem( "Forward", function () { window.history.go(1); }, "images/forward.png" ) );
forwardItem.mnemonic = "o";
cMenu.add( refreshItem = new MenuItem( "Refresh", function () { document.location.reload(); }, "images/refresh.png" ) );
refreshItem.mnemonic = "r";

cMenu.add( new MenuSeparator() );


cMenu.add( new MenuSeparator() );

cMenu.add( tmp = new MenuItem( "View Source", function () {	document.location = "view-source:" + document.location; }, "images/notepad.png" ) );
tmp.mnemonic = "v";


// edit menu
var eMenu = new Menu()

var undoItem, cutItem, copyItem, pasteItem, deleteItem, selectAllItem;

// undo is broken in IE
// eMenu.add( undoItem = new MenuItem( "Undo", function () { document.execCommand( "Undo" ); }, "images/undo.small.png" ) );
// undoItem.mnemonic = "u";
//
//
// eMenu.add( new MenuSeparator() );


eMenu.add( cutItem = new MenuItem( "Cut", function () { document.execCommand( "Cut" ); }, "../../html/menu/images/cut.small.png" ) );
cutItem.mnemonic = "t";

eMenu.add( copyItem = new MenuItem( "Copy", function () { document.execCommand( "Copy" ); }, "../../html/menu/images/copy.small.png" ) );
copyItem.mnemonic = "c";

eMenu.add( pasteItem = new MenuItem( "Paste", function () { document.execCommand( "Paste" ); }, "../../html/menu/images/paste.small.png" ) );
pasteItem.mnemonic = "p";

eMenu.add( deleteItem = new MenuItem( "Delete", function () { document.execCommand( "Delete" ); }, "../../html/menu/images/delete.small.png" ) );
deleteItem.mnemonic = "d";


eMenu.add( new MenuSeparator() );

eMenu.add( searchItem = new MenuItem( "Search", function () { showModelessDialog("<?=INCLUDE_PATH?>editor/class.devedit.php?ToDo=FindReplace&DEP1=./&DEP=./", document.FM, "dialogWidth:385px; dialogHeight:165px; scroll:no; status:no; help:no;" );} ) );
eMenu.add( new MenuSeparator() );

eMenu.add( selectAllItem = new MenuItem( "Select All", function () { document.execCommand( "SelectAll" ); } ) );
selectAllItem.mnemonic = "a";




var oldOpenState = null;	// used to only change when needed
var lastKeyCode = 0;

function rememberKeyCode() {
	lastKeyCode = window.event.keyCode;
}

function showContextMenu() {

	var el = window.event.srcElement;

	// check for edit
	var showEditMenu = el != null &&
						(el.tagName == "INPUT" || el.tagName == "TEXTAREA");

	// check for anchor
	while ( el != null && el.tagName != "A" )
		el = el.parentNode;

	var showOpenItems = el != null && el.tagName == "A";

	if ( showOpenItems != oldOpenState ) {
		openItem.visible		= showOpenItems;
		openNewWinItem.visible	= showOpenItems;
		backItem.visible		= !showOpenItems;
		forwardItem.visible		= !showOpenItems;
		refreshItem.visible		= !showOpenItems;
		oldOpenState = showOpenItems;
	}

	if ( showOpenItems ) {
		openItem.action = openNewWinItem.action = el.href;
	}

	// find left and top
	var left, top;

	if ( showEditMenu )
		el = window.event.srcElement;
	else if ( !showOpenItems )
		el = document.documentElement;

	if ( lastKeyCode == 93 ) {	// context menu key
		left = posLib.getScreenLeft( el );
		top = posLib.getScreenTop( el );
	}
	else {
		left = window.event.screenX;
		top = window.event.screenY;
	}

	if ( showEditMenu ) {

		// undo is broken in IE
		// undoItem.disabled =			!document.queryCommandEnabled( "Undo" );
		cutItem.disabled =			!document.queryCommandEnabled( "Cut" );
		copyItem.disabled =			!document.queryCommandEnabled( "Copy" );
		pasteItem.disabled =		!document.queryCommandEnabled( "Paste" );
		deleteItem.disabled =		!document.queryCommandEnabled( "Delete" );
		selectAllItem.disabled =	!document.queryCommandEnabled( "SelectAll" );

		eMenu.invalidate();
		eMenu.show( left, top );
	}
	else {
		//cMenu.invalidate();
		//cMenu.show( left, top );
	}

	event.returnValue = false;
	lastKeyCode = 0
};

document.attachEvent( "oncontextmenu", showContextMenu );
document.attachEvent( "onkeyup", rememberKeyCode );

//]]>

</script>

<script type="text/javascript">
writeNotSupported();
</script>
<form action="admin_setting.php?sId=<?=$IN['sId']?>&o=<?=$IN['o']?>_submit" method="post" name="FM" ><!--actionFrame-->
<table width="100%" border=0   cellPadding=0 cellSpacing=2 >
<tr><td><INPUT TYPE="hidden" name="PATH" value="<?=$IN['PATH']?>">
<INPUT TYPE="hidden" name="targetFile" value="<?=$IN['targetFile']?>">
<TEXTAREA NAME="content" cols="111" rows="37" wrap="VIRTUAL"><?=$content?></TEXTAREA>
 </td>
 </tr>
</table>

</form>
</body>
</html>