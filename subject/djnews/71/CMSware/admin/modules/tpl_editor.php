<?php   
if(!defined('IN_IWPC')) {
 	exit('Access Denied');
}
include_once(INCLUDE_PATH."editor/class.devedit.php");
require_once LANG_PATH.$SYS_ENV['language'].'/lang_skin/admin/tpl_editor.php';

?>
<html>
<head>
<title> 
<?=$IN['PATH']?>
/ 
<?=$IN['targetFile']?>
- <?echo $_LANG_SKIN['title']; ?></title>
<link type="text/css" rel="StyleSheet" href="../html/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	cssFile = "../html/menu/skins/winclassic.css";

document.write("<link type=\"text/css\" rel=\"StyleSheet\" href=\"" + cssFile + "\" />" );

</script>

<script type="text/javascript" src="../html/menu/js/poslib.js"></script>
<script type="text/javascript" src="../html/menu/js/scrollbutton.js"></script>
<script type="text/javascript" src="../html/menu/js/menu4.js"></script>
<style type="text/css">
<!--
.cmsButton {
	font-family: "Arial", "Helvetica", "sans-serif";
	font-size: 12px;
	background-color: #F1F1F1;
	border: 1px solid #999;
}
-->
</style>
</head>
<script src="../html/functions.js" type="text/javascript" language="javascript"></script>
<SCRIPT language=JavaScript>
var NodeID = '<?=$IN['NodeID']?>';
var sId = '<?=$IN['sId']?>';
var PATH = '<?=$IN['PATH']?>';
var targetFile = '<?=$IN['targetFile']?>';
var o = '<?=$IN['o']?>';

function init()
{
	if(o == 'add' && document.FM.content.value=='') {
		tabClick(0);
		document.FM.content.focus();
	}
}
window.onload = init;
</script>
<body bgcolor=threedface STYLE="margin:0pt;padding:0pt;border: 1px buttonhighlight;"  >
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

//document.attachEvent( "oncontextmenu", showContextMenu );
document.attachEvent( "onkeyup", rememberKeyCode );

//]]>

</script>
<STYLE type=text/css>
TD {
	FONT-SIZE: 12px; COLOR: #000000; FONT-FAMILY: "MS Shell Dlg"
}
.tab {
	PADDING-RIGHT: 5px; PADDING-LEFT: 5px; FONT-SIZE: 12px; PADDING-BOTTOM: 1px; CURSOR: hand; PADDING-TOP: 5px; LETTER-SPACING: 1px
}
</STYLE>
<SCRIPT language=JavaScript>

function tabClick(idx) 
{

  
	for (i = 0; i < 3; i++) {
    

		if (i == idx) {

			var tabImgLeft = eval("document.all.tabImgLeft__" + idx);

			var tabImgRight = eval("document.all.tabImgRight__" + idx);
      
			var tabLabel = eval("document.all.tabLabel__" + idx);
      
			var tabContent = eval("document.all.tabContent__" + idx);

      
			tabImgLeft.src = "../html/images/mpc/tab_active_left.gif";
      
			tabImgRight.src = "../html/images/mpc/tab_active_right.gif";
      
			tabLabel.background = "../html/images/mpc/tab_active_bg.gif";
      
			tabContent.style.visibility = "visible";
      
			tabContent.style.display = "block";
     
		}
  else {
			var tabImgLeft = eval("document.all.tabImgLeft__" + i);
		
			var tabImgRight = eval("document.all.tabImgRight__" + i);
		
			var tabLabel = eval("document.all.tabLabel__" + i);
		
			var tabContent = eval("document.all.tabContent__" + i);

		
			tabImgLeft.src = "../html/images/mpc/tab_unactive_left.gif";
		
			tabImgRight.src = "../html/images/mpc/tab_unactive_right.gif";
		
			tabLabel.background = "../html/images/mpc/tab_unactive_bg.gif";
		
			tabContent.style.visibility = "hidden";
		
			tabContent.style.display = "none";
  
		
		}  

	}


}
var isTextModeChanged = false;
function prepareUpdateTmp()
{
	 
	if(isTextModeChanged) {
		//dosubmit
		document.updateTmp.updateContent.value = document.FM.content.value;
		document.updateTmp.submit();

	}

}

function prepareShowSrc()
{
	 
	if(isTextModeChanged) {
		//dosubmit
		document.previewContentForm.previewContent.value = document.FM.content.value;
		document.previewContentForm.submit();

	}

}

</script>

<script type="text/javascript">
writeNotSupported();

</script>

<script language="javascript">
// Coded by windy_sk <windy_sk@126.com> 20040205

function reportError(msg,url,line) {
	var str = "You have found an error as below: \n\n";
	str += "Err: " + msg + " on line: " + line;
	alert(str);
	return true;
}

window.onerror = reportError;


document.onkeydown = function() {
	if(event.ctrlKey){
		switch(event.keyCode) {
			case 82: //r
				runcode();
				break;
			case 83: //s
				savecode();
				break;
			case 71: //g
				goto(prompt('Please input the line number', '1'));
				break;
			case 65: //a
				document.execCommand("SelectAll");
				break;
			case 67: //c
				document.execCommand("Copy");
				break;
			case 88: //x
				document.execCommand("Cut");
				break;
			case 86: //v
				document.execCommand("Paste");
				break;
			case 90: //z
				document.execCommand("Undo");
				break;
			case 89: //y
				document.execCommand("Redo");
				break;
			default:
				break;
		}
		event.keyCode = 0;
		event.returnValue = false;
	}
	return;
}


function show_ln(){
	var txt_ln	 = document.getElementById('txt_ln');
	var txt_main	 = document.getElementById('txt_main');
	txt_ln.scrollTop = txt_main.scrollTop;
	while(txt_ln.scrollTop != txt_main.scrollTop) {
		txt_ln.value += (icount++) + '\n';
		txt_ln.scrollTop = txt_main.scrollTop;
	}
	return;
}


function editTab(){
	var code, sel, tmp, r;
	event.returnValue = false;
	sel =event.srcElement.document.selection.createRange();
	r = event.srcElement.createTextRange();

	switch (event.keyCode){
		case (8)	:
			if (!(sel.getClientRects().length > 1)){
				event.returnValue = true;
				return;
			}
			code = sel.text;
			tmp = sel.duplicate();
			tmp.moveToPoint(r.getBoundingClientRect().left, sel.getClientRects()[0].top);
			if(sel.parentElement() != tmp.parentElement()) return;;
			sel.setEndPoint('startToStart', tmp);
			sel.text = sel.text.replace(/^\t/gm, '');
			code = code.replace(/^\t/gm, '').replace(/\r\n/g, '\r');
			r.findText(code);
			r.select();
			break;
		case (9)	:
			if (sel.getClientRects().length > 1){
				code = sel.text;
				tmp = sel.duplicate();
				tmp.moveToPoint(r.getBoundingClientRect().left, sel.getClientRects()[0].top);
				if(sel.parentElement() != tmp.parentElement()) return;
				sel.setEndPoint('startToStart', tmp);
				sel.text = '\t'+sel.text.replace(/\r\n/g, '\r\t');
				code = code.replace(/\r\n/g, '\r\t');
				r.findText(code);
				r.select();
			}else{
				sel.text = '\t';
				sel.select();
			}
			break
		case (13)	:
			tmp = sel.duplicate();
			tmp.moveToPoint(r.getBoundingClientRect().left, sel.getClientRects()[0].top);
			if(sel.parentElement() != tmp.parentElement()) return;
			tmp.setEndPoint('endToEnd', sel);
			sel.text = '\r\n' + tmp.text.replace(tmp.text.replace(/^[\t ]+/g, ""),"");
			sel.select();
			break;
		default		:
			event.returnValue = true;
			break;
	}
	return;
}


function runcode() {
	var str = document.getElementById("txt_main").value;
	var code_win = window.open('about:blank');
	code_win.document.open();
	code_win.document.writeln("<script>");
	code_win.document.writeln("function reportError(msg,url,line){\nline-=14;\nvar str='You have found an error as below: \\n\\n';\nstr+='Err: '+msg+' on line: '+(line);\nalert(str);\nopener.goto(line);\nopener.focus();\nwindow.onerror=null;\nsetTimeout('self.close()',10);\nreturn true;\n}");
	code_win.document.writeln("window.onerror = reportError;");
	code_win.document.writeln("<\/script>");
	code_win.document.writeln(str);
	code_win.document.close();
	return;
}


function savecode() {
	var str = document.getElementById("txt_main").value;
	var code_win = window.open('about:blank','_blank','top=10000');
	code_win.document.open();
	code_win.document.writeln(str);
	code_win.document.close();
	code_win.document.execCommand('saveas','','code.html');
	code_win.close();
	return;
}


function goto(ln) {
	if(!/^\d+$/.test(ln) || ln==0) return;
	var obj = document.getElementById("txt_main");
	var rng = obj.createTextRange();
	var arr = obj.value.split(/\n/);
	if(ln>arr.length) ln = arr.length;
	var str_tmp = "";
	for(var i=0; i<ln-1; i++) {
		str_tmp += arr[i];
	}
	rng.moveStart('character',str_tmp.length);
	str_tmp = "";
	for(i=ln; i<arr.length; i++) {
		str_tmp += arr[i];
	}
	rng.moveEnd('character',-str_tmp.length); 
	rng.select();
	return;
}

//window.onload = function() {document.getElementById("txt_main").value = "<script>\nalert(')\n<\/script>";}
</script>

<form action="admin_tpl.php?sId=<?=$IN['sId']?>&o=updateTmpSubmit&NodeID=<?=$IN['NodeID']?>&TCID=<?=$IN['TCID']?>&TID=<?=$IN['TID']?>&PATH=<?=$IN['PATH']?>&targetFile=<?=$IN['targetFile']?>" method="post" name="updateTmp" > <INPUT TYPE="hidden" name="updateContent" >
 </form> 
<form action="admin_cms_block.php?sId=<?=$IN['sId']?>&o=previewSrc&NodeID=<?=$IN['NodeID']?>&TCID=<?=$IN['TCID']?>&TID=<?=$IN['TID']?>&PATH=<?=$IN['PATH']?>&targetFile=<?=$IN['targetFile']?>" method="post" name="previewContentForm" target="previewSrcFrame"> <INPUT TYPE="hidden" name="previewContent" >
 </form> 


<TABLE cellSpacing=0 cellPadding=0 width="100%" align=center border=0 bgcolor="threedface">

<TBODY>
  <TR>
    <TD  >
      <TABLE cellSpacing=0 cellPadding=0 border=0  >
        <TBODY>
        <TR>
          <TD>
            <TABLE height=22 cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD width=3><IMG id=tabImgLeft__0 height=22 
                  src="../html/images/mpc/tab_active_left.gif" 
                  width=3></TD>
                <TD class=tab id=tabLabel__0 onclick="tabClick(0);"
                background="../html/images/mpc/tab_active_bg.gif" 
                UNSELECTABLE="on" title="<?echo $_LANG_SKIN['main_content_help']; ?>"><label>源码编辑</label></TD>
                <TD width=3><IMG id=tabImgRight__0 height=22 
                  src="../html/images/mpc/tab_active_right.gif" 
                  width=3></TD></TR></TBODY></TABLE></TD>
          <TD>
            <TABLE height=22 cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD width=3><IMG id=tabImgLeft__1 height=22 
                  src="../html/images/mpc/tab_unactive_left.gif" 
                  width=3></TD>
                <TD class=tab id=tabLabel__1 onclick="tabClick(1);prepareShowSrc();"
                background="../html/images/mpc/tab_unactive_bg.gif" 
                UNSELECTABLE="on"><label>源码预览</label></TD>
                <TD width=3><IMG id=tabImgRight__1 height=22 
                  src="../html/images/mpc/tab_unactive_right.gif" 
                  width=3></TD></TR></TBODY></TABLE></TD>
          <TD>
            <TABLE height=22 cellSpacing=0 cellPadding=0 border=0>
              <TBODY>
              <TR>
                <TD width=3><IMG id=tabImgLeft__2 height=22 
                  src="../html/images/mpc/tab_unactive_left.gif" 
                  width=3></TD>
                <TD class=tab id=tabLabel__2 onclick="tabClick(2);prepareUpdateTmp();" 
                background="../html/images/mpc/tab_unactive_bg.gif" 
                UNSELECTABLE="on" TITLE="<?echo $_LANG_SKIN['publish_setting_help']; ?>"><label>区块模式</label></TD>
                <TD width=3><IMG id=tabImgRight__2 height=22 
                  src="../html/images/mpc/tab_unactive_right.gif" 
                  width=3></TD></TR></TBODY></TABLE></TD>
				  
				  
				  </TR></TBODY></TABLE>&nbsp;</TD></TR>
  <TR>
    <TD bgcolor="menu"  >
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TBODY>
        <TR>
          <TD 
          style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; PADDING-TOP: 0px; " 
          vAlign=top class="bigborder" >
<DIV id=tabContent__0 style=" VISIBILITY: visible">
<table border="0" cellspacing="2" cellpadding="0">
  <tr> 
    <td><div align="center">CMS调用:</div></td>
    <td colspan="3"> <input type="submit" style="width:70" class="cmsButton" name="Submit" value="CMS::LIST" onclick="prompt('内容列表LIST','&lt;CMS action=&quot;LIST&quot; return=&quot;List&quot; NodeID=&quot;?&quot; Num=&quot;?&quot; /&gt;   ')"> 
      <input name="Submit2" type="submit" class="cmsButton" style="width:100" onclick="prompt('内容调用CONTENT','&lt;CMS action=&quot;CONTENT&quot; return=&quot;var&quot; IndexID=&quot;68&quot; /&gt;')" value="CMS::CONTENT"> 
      <input name="Submit3" type="submit" class="cmsButton" style="width:100" onclick="prompt('调用节点ID为2的子节点，忽略节点ID为31和32的节点','&lt;CMS action=&quot;NODELIST&quot;  return=&quot;List&quot; Type=&quot;sub&quot; NodeID=&quot;2&quot; Ignore=&quot;31,32&quot; /&gt;')" value="CMS::NODELIST"> 
      <input name="Submit4" type="submit" class="cmsButton" style="width:100" onclick="prompt('搜索节点：来自变量$NodeID;搜索字段：新闻模型的Keywords字段;搜索关键字：来自变量$Keywords;返回记录数量：3条;关键字分隔符：“,”;忽略内容ID：来自变量$ContentID ','&lt;CMS action=&quot;SEARCH&quot; return=&quot;List&quot; NodeID=&quot;{$NodeID}&quot; Field=&quot;Keywords&quot; Keywords=&quot;{$Keywords}&quot; Num=&quot;3&quot; Separator=&quot;,&quot; IgnoreContentID=&quot;{$ContentID}&quot; /&gt;')" value="CMS::SEARCH "> 
      <input name="Submit6" type="submit" class="cmsButton" style="width:100" onclick="prompt('该调用标签可实现文章评论内容的调用.','&lt;CMS action=&quot;COMMENT&quot; return=&quot;List&quot; IndexID=&quot;{$IndexID}&quot; /&gt; ')" value="CMS::COMMENT"> 
      <input name="Submit5" type="submit" class="cmsButton" style="width:70" onclick="prompt('该调用标签可实现对数据库的直接查询调用.','&lt;CMS action=&quot;SQL&quot; return=&quot;List&quot; query=&quot;select * from cmsware_site where Disabled=0&quot; /&gt;')" value="CMS::SQL"> 
       </td>
  </tr>
  <tr> 
    <td>模板语法:</td>
    <td><input name="Submit72" type="submit" class="cmsButton" onclick="prompt('loop用于循环遍历取出数组中的变量','&lt;LOOP name=&quot;List&quot; var=&quot;var&quot; key=&quot;key&quot;&gt; &lt;/LOOP&gt; ')" value="Loop"> 
      <input name="Submit82" type="submit" class="cmsButton" onclick="prompt('if,elseif,else标签用于实现模板中的逻辑判断。','&lt;if test=&quot;$key==0&quot;&gt; &lt;elseif test=&quot;$key % 3 ==0&quot;&gt; &lt;else&gt; &lt;/if&gt;')" value="if/elseif/else"> 
      <input name="Submit9" type="submit" class="cmsButton" onclick="prompt('include外部模板包含','&lt;include: file=&quot;模板路径&quot;&gt; ')" value="include"> 
      <input name="Submit7" type="submit" class="cmsButton" onclick="prompt('变量定义语句Var','&lt;Var Name=&quot;变量名&quot; Value=&quot;变量值&quot; &gt; ')" value="Var"> 
    </td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;常用函数:</td>
    <td><input name="Submit73" type="submit" class="cmsButton" onclick="prompt('date ( 格式字串,  时间戳)\n格式化一个本地时间／日期','[@date(\'Y-m-d H:i:s\', $var.PublishDate)]')" value="日期格式"> 
      <input name="Submit74" type="submit" class="cmsButton" onclick="prompt('AutoMini(源图地址, 缩略图尺寸, 内容信息数组).\n缩略图尺寸使用“160*120”这样的格式，代表长160，宽120','[@AutoMini($var.Photo, \'120*100\', $var)]')" value="缩略图"> 
      <input name="Submit75" type="submit" class="cmsButton" onclick="prompt('CsubStr(字符串, 开始位置, 截取长度,后缀)','[@CsubStr( $var.Title , 0, 10)]')" value="标题长度截取"> 
      <input name="Submit76" type="submit" class="cmsButton" onclick="prompt('清空字符串中的回车换行符，常用于js输出','[@strip($var.Title)]')" value="strip"> 
      <input name="Submit762" type="submit" class="cmsButton" onclick="prompt('str_repeat (字符串, 重复次数).\n重复显示字符串N次（重复次数） ','[@str_repeat(&quot;&lt;td&gt;&lt;img src=\'/images/star.gif\' border=\'0\'&gt;&lt;/td&gt;   &quot;, $Star)]')" value="str_repeat"> 
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td colspan="3">
<?php
$count = 0;
foreach($CONTENT_MODEL_INFO as $key=>$var) {
	
	if($count>0 && $count%6 == 0) echo "<br>";

	$count++;

	echo "<SELECT NAME='' onchange=\"if(this.value != '') {prompt( this.options[selectedIndex].text, this.value);}\">";
		echo "<option value=''>--{$var[Name]}--</option>";
	
	foreach($var[Model] as $key1=>$var1) {
		echo "<option value='[\${$var1[FieldName]}]'>{$var1[FieldTitle]}</option>";
	}


	echo "</SELECT>";
}
?>

</td>
  </tr>
</table>
<table width="100%" border=0   cellPadding=0 cellSpacing=2 >
<form action="admin_tpl.php?sId=<?=$IN['sId']?>&o=<?=$IN['o']?>_submit&NodeID=<?=$IN['NodeID']?>&TCID=<?=$IN['TCID']?>&TID=<?=$IN['TID']?>&PATH=<?=$IN['PATH']?>&targetFile=<?=$IN['targetFile']?>" method="post" name="FM" ><!--actionFrame-->
<tr><td><INPUT TYPE="hidden" name="PATH" value="<?=$IN['PATH']?>">
<INPUT TYPE="hidden" name="targetFile" value="<?=$IN['targetFile']?>">

 
<TEXTAREA id='txt_main' name='content' onkeydown='editTab()'      style='height:420;width=800;background-color:#FFFFFF;' onchange="javascript:isTextModeChanged = true;" ><?php echo $content;?></TEXTAREA>

 

 </td>
 </tr>
</form></table>

</div>


<DIV id=tabContent__1 style=" DISPLAY: none; VISIBILITY: hidden">

<Iframe name="previewSrcFrame"   src="admin_cms_block.php?sId=<?=$IN['sId']?>&o=previewSrc&NodeID=<?=$IN['NodeID']?>&TCID=<?=$IN['TCID']?>&TID=<?=$IN['TID']?>&PATH=<?=$IN['PATH']?>&targetFile=<?=$IN['targetFile']?>"   style="width:100%;height:520;border:5;" > 
                </Iframe>
</div>
<DIV id=tabContent__2 style="DISPLAY: none; VISIBILITY: hidden" >

<Iframe name="BlockMode"   src="admin_cms_block.php?sId=<?=$IN['sId']?>&NodeID=<?=$IN['NodeID']?>&TCID=<?=$IN['TCID']?>&TID=<?=$IN['TID']?>&PATH=<?=$IN['PATH']?>&targetFile=<?=$IN['targetFile']?>"   style="width:100%;height:520;border:5;" > 
                </Iframe>


 </div>



 </TD>
       </TR></TBODY></TABLE></TD></TR>
 </TBODY></TABLE>
 

</body>
</html> 