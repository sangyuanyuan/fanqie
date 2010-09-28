<header name="Content-Type: application/x-javascript" />

var sHeader='<style>' +
			'body {font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 11px;}' +
            'td { font-family: Verdana, Arial, Helvetica, sans-serif,"仿宋体";font-size: 11px; border-style: dotted; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px}' +
            '</style>' +
            '<body >';
           
var bMode=true,sel=null

//{{{ 浏览器版本检测 2006-1-9
var BrowserInfo = new Object() ;
BrowserInfo.MajorVer = navigator.appVersion.match(/MSIE (.)/)[1] ;
BrowserInfo.MinorVer = navigator.appVersion.match(/MSIE .\.(.)/)[1] ;
BrowserInfo.IsIE55OrMore = BrowserInfo.MajorVer >= 6 || ( BrowserInfo.MajorVer >= 5 && BrowserInfo.MinorVer >= 5 ) ;
//}}}

function bb2html() {
	if (!Error_1()) return;
	if(confirm('开始进行bbcode到html的转换.\n\n选择确定将只进行bbcode到html的转换，选择取消将同时进行html标签的替换\n')){
		idEdit.focus();
		var html = document.all.SaveContent.value;
		html = BBcode2Html(html,false);
		document.all.SaveContent.value = html;
		
	} else {
		idEdit.focus();
		var html = document.all.SaveContent.value;
		html = BBcode2Html(html,true);
		document.all.SaveContent.value = html;
	}
}

//{{{ 替换特殊HTML字符 2006-1-9
function HTMLEncode(text){
	text = text.replace(/&/g, "&amp;") ;
	text = text.replace(/\"/g, "&quot;") ;
	text = text.replace(/</g, "&lt;") ;
	text = text.replace(/>/g, "&gt;") ;
	text = text.replace(/\'/g, "&#146;") ;
	text = text.replace(/\ /g,"&nbsp;");
	text = text.replace(/\n/g,"<br>");
	text = text.replace(/\t/g,"&nbsp;&nbsp;&nbsp;&nbsp;");
	return text;
}


//粘贴纯文本 2006-1-9
function pasteText() {
	if (!Error()) return;

	idEdit.focus();
	var sel;
	
	var sText = HTMLEncode( clipboardData.getData("Text") ) ;

    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( sText );
    sel.select();
	idEdit.focus();
}

// 从Word中粘贴，去除格式
function pasteWord(){
	if (!Error()) return;

	idEdit.focus();

	if (BrowserInfo.IsIE55OrMore)
		cleanAndPaste( GetClipboardHTML() ) ;
	else if ( confirm( "此功能要求IE5.5版本以上，你当前的浏览器不支持，是否按常规粘贴进行？" ) )
		format("paste") ;

	idEdit.focus();
}


// 清除WORD冗余格式并粘贴
function cleanAndPaste( html ) {
	// Remove all SPAN tags
	html = html.replace(/<\/?SPAN[^>]*>/gi, "" );
	// Remove Class attributes
	html = html.replace(/<(\w[^>]*) class=([^ |>]*)([^>]*)/gi, "<$1$3") ;
	// Remove Style attributes
	html = html.replace(/<(\w[^>]*) style="([^"]*)"([^>]*)/gi, "<$1$3") ;
	// Remove Lang attributes
	html = html.replace(/<(\w[^>]*) lang=([^ |>]*)([^>]*)/gi, "<$1$3") ;
	// Remove XML elements and declarations
	html = html.replace(/<\\?\?xml[^>]*>/gi, "") ;
	// Remove Tags with XML namespace declarations: <o:p></o:p>
	html = html.replace(/<\/?\w+:[^>]*>/gi, "") ;
	// Replace the &nbsp;
	html = html.replace(/&nbsp;/, " " );
	// Transform <P> to <DIV>
	var re = new RegExp("(<P)([^>]*>.*?)(<\/P>)","gi") ;	// Different because of a IE 5.0 error
	html = html.replace( re, "<div$2</div>" ) ;

    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( html );
    sel.select();

}

// 取剪粘板中的HTML格式数据
function GetClipboardHTML() {
	var oDiv = document.getElementById("HTMLEditor_Temp_HTML")
	oDiv.innerHTML = "" ;
	
	var oTextRange = document.body.createTextRange() ;
	oTextRange.moveToElementText(oDiv) ;
	oTextRange.execCommand("Paste") ;
	
	var sData = oDiv.innerHTML ;
	oDiv.innerHTML = "" ;
	
	return sData ;
}


// 粘贴时自动检测是否来源于Word格式
function onPaste() {
	if (bMode == true){
		var sHTML = GetClipboardHTML() ;
		if (BrowserInfo.IsIE55OrMore) {
			var re = /<\w[^>]* class="?MsoNormal"?/gi ;
			if ( re.test(sHTML)){
				if ( confirm( "你要粘贴的内容好象是从Word中拷出来的，是否要先清除Word格式再粘贴？" ) ){
					cleanAndPaste( sHTML ) ;
					return false ;
				}
			}
		}
		return true;
	}else{
		idEdit.document.selection.createRange().pasteHTML(HTMLEncode( clipboardData.getData("Text"))) ;
		return false;
	}
	
}


//}}}

function BBcode2Html(str,clearHtml) {
	
	if(clearHtml == true) {
		str = str.replace(/&/g,"&amp;");
		str = str.replace(/\"/g,"&quot;");
		str = str.replace(/</g,"&lt;");
		str = str.replace(/>/g,"&gt;");
	}
	
	str = str.replace(/\r/g,"");
	str = str.replace(/\n/g,"<BR>");
	str = str.replace(/\[url=([^]]*)](.*?)\[\/url]/ig,"<a href=\"$1\" target=\"_blank\">$2</a>");

	str = str.replace(/\[color=([^]]*)](.*?)\[\/color]/ig,"<font color=\"$1\">$2</font>");

	str = str.replace(/\[email](.*?)\[\/email]/ig,"<a href=\"mailto:$1\">$1</a>");
	str = str.replace(/\[email=([^]]*)](.*?)\[\/email]/ig,"<a href=\"mailto:$1\" >$2</a>");
	str = str.replace(/\[img](.*?)\[\/img]/ig,"<img src=\"$1\" border=0>");

	str = str.replace(/\[size=([^]]*)](.*?)\[\/size]/ig,"<font size=\"$1\">$2</font>");

	str = str.replace(/\[font=([^]]*)](.*?)\[\/font]/ig,"<font face=\"$1\">$2</font>");

	str = str.replace(/\[b](.*?)\[\/b]/ig,"<B>$1</B>");



	str = str.replace(/\[i](.*?)\[\/i]/ig,"<I>$1</I>");

	str = str.replace(/\[u](.*?)\[\/u]/ig,"<U>$1</U>");
	str = str.replace(/&nbsp;/g," ");
	str = str.replace(/\r/g,"&nbsp;");



	str = str.replace(/\[list]/gi,"<ul>");
	str = str.replace(/\[list=1]/gi,"<ol type=1>");
	str = str.replace(/\[list=a]/gi,"<ol type=a>");
	str = str.replace(/\[list=A]/gi,"<ol type=A>");
	str = str.replace(/\[\/list]/gi,"</ul></ol>");
	str = str.replace(/\[\*\]/g,"<li>");

return str;
} 

function EditLoad(data) {
  if (data!=null) data=data.replace(/&amp;/ig,'&');
  else data='';
  bLoad=true;
  EditContent.document.designMode="On";
  idEdit = EditContent
  idEdit.document.open()
  idEdit.document.write(sHeader+data)
  idEdit.document.close()
  idEdit.focus();
}
function Word_Clean(editor,htmlmode) {
/*
str=idEdit.document.all.tags("BODY")[0].innerHTML;
	//CUT/	len=sHeader.length;
	//CUT/	len=len+62;
	//CUT/	x = str.length;
	//CUT/	x=x-len-7;
	//document.write("The field named "+ sHeader.length +" has value of ");
	//CUT/	document.all.SaveContent.value=str.substr(len,x)
	document.all.SaveContent.value=str
    idEdit.document.body.innerText=getPureHtml(idEdit.document.body.innerHTML);
**/
	idEdit.focus();
	// 0bject based cleaning
	var body = idEdit.document.body;
	for (var index = 0; index < body.all.length; index++) {
		tag = body.all[index];
		//if (tag.Attribute["className"].indexOf("mso") > -1)
		tag.removeAttribute("className","",0);
		tag.removeAttribute("style","",0);
	}

	// Regex based cleaning
	var html = idEdit.document.body.innerHTML;
	html = html.replace(/<o:p>&nbsp;<\/o:p>/g, "");
	html = html.replace(/o:/g, "");
	html = html.replace(/<st1:.*?>/g, "");

	// Final clean up of empty tags
	html = html.replace(/<font>/g, "");
	html = html.replace(/<span>/g, "");
	
	idEdit.document.body.innerHTML = html;

}
function insertimg(){
  if (!Error()) return;
 //ab=window.prompt("请输入图片的链接地址:","http://");
 Today = new Date();
newName=Today.valueOf();

 url="editor/js/img.php?cId=" + document.content.cId.value + "&newName=" + newName;
 ab=showMeDialog(url,"color","dialogWidth:477pt;dialogHeight:240pt;help:0;status:0");

  if (ab!="") {
    var sel,RangeType
    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( ab );
    sel.select();
  }
  idEdit.focus();
}
function Error() {
  if (bMode) return true;
  alert("请选择“编辑状态”选项，才能使用系统编辑功能!");
  idEdit.focus();
  return false;
}
function Error_1() {
  if (!bMode) return true;
  alert("请选择“源代码”选项，才能使用bbcode转换html功能!");
  idEdit.focus();
  return false;
}

function format(what,opt) {
  if (!Error()) return;
  if (opt=="removeFormat"){
    what=opt;opt=null
  }
  //{{{ 粘贴自动检测Word格式 2006-1-9
  if(what=="paste") {
		var sHTML = GetClipboardHTML() ;
		if ( BrowserInfo.IsIE55OrMore) {
			var re = /<\w[^>]* class="?MsoNormal"?/gi ;
			if ( re.test(sHTML)){
				if ( confirm( "你要粘贴的内容好象是从Word中拷出来的，是否要先清除Word格式再粘贴？" ) ){
					cleanAndPaste( sHTML ) ;
					return false ;
				}
			}
		}  
  }
  //}}}

  if (opt==null) idEdit.document.execCommand(what)
  else           idEdit.document.execCommand(what,"",opt)
  idEdit.focus()
  sel=null
}

function getEl(sTag,start) {
  while ((start!=null) && (start.tagName!=sTag))
    start = start.parentElement
  return start
}

function create(what) {
  if (!Error()) return;
  idEdit.document.execCommand(what, true);
  idEdit.focus()
}

function specialtype(Mark){
  if (!Error()) return;
  var sel,RangeType
  sel = idEdit.document.selection.createRange();
  RangeType = idEdit.document.selection.type;
  if (RangeType == "Text"){
    sel.pasteHTML("<" + Mark + ">" + sel.text + "</" + Mark + ">");
    sel.select();
  }
  idEdit.focus();
}

function forecolor() {
  if (!Error()) return;
  var arr = showMeDialog("ui.php?sId=[$sId]&o=editor__color.htm","color","dialogWidth:200pt;dialogHeight:175pt;help:0;status:0");
  if (arr != null) format('forecolor',arr);
  else idEdit.focus();
}

//***************************************************
function inSinglephoto(){
  if (!Error()) return;
 //ab=window.prompt("请输入图片的链接地址:","http://");
 Today = new Date();
newName=Today.valueOf();
idEdit.focus();
 //url="upload.php?type=img&o=display&mode=single&cId=" + document.content.cId.value + "&newName=" + newName;
// var ab=showMeDialog(url,"color","dialogWidth:530pxt;dialogHeight:480px;help:0;status:0");
var ab=showMeDialog('upload.php?sId='+ sId +'&o=display&mode=one&type=img&NodeID=' + NodeID,"color","dialogWidth:260pt;dialogHeight:300pt;help:0;status:0;scroll:0");
	if(ab['SonIndexID']!="") {
		//alert(parent.parent.document.data_Title.value);
	}
	 
  if (ab['str']!="" && ab['str']!= null) {

	var str = ab['str'];
    var sel,RangeType;
    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( str );
    sel.select();
  }
  idEdit.focus();
}

function inMultiphoto(){
  if (!Error()) return;
 //ab=window.prompt("请输入图片的链接地址:","http://");
 Today = new Date();
newName=Today.valueOf();
idEdit.focus();

//var NodeID= parent.NodeID;
//var sId = parent.sId;
		//imageWin = window.open(HTTPStr + '://' + URL + '/icms/publish/de/upload.php?o=display&mode=single&type=img&cId=' + cId,'','width=530,height=480,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);

cd=showMeDialog('upload.php?sId='+ sId +'&o=display&mode=multi&type=img&NodeID=' + NodeID,"color","dialogWidth:260pt;dialogHeight:300pt;help:0;status:0;scroll:0");


// url="upload.php?type=img&o=display&mode=multi&cId=" + document.content.cId.value + "&newName=" + newName;
// cd=showMeDialog(url,"color","dialogWidth:260pt;dialogHeight:300pt;help:0;status:0");

  if (cd!="") {
    var sel,RangeType
    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( cd );
    sel.select();
  }
  idEdit.focus();
}

function imageEdit()
{
	var leftPos = (screen.availWidth-770) / 2;
	var topPos = (screen.availHeight-660) / 2 ;
	//alert('a')
	imageWin = window.open('photo_editor.php?o=main&sId='+ sId ,'','width=755,height=530,scrollbars=no,resizable=no,titlebar=0,top=' + topPos + ',left=' + leftPos);

}


function str2img(){
  if (!Error()) return;
 //ab=window.prompt("请输入图片的链接地址:","http://");
 Today = new Date();
newName=Today.valueOf();

 url="admin_img.php?mode=str2img&cId=" + document.content.cId.value + "&newName=" + newName;
 cd=showMeDialog(url,"color","dialogWidth:260pt;dialogHeight:230pt;help:0;status:0");

  if (cd!="") {
    var sel,RangeType
    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( cd );
    sel.select();
  }
  idEdit.focus();
}

function inphototable(url){
  if (!Error()) return;
  if (url!="") {
    var sel,RangeType
    sel = idEdit.document.selection.createRange();
    sel.pasteHTML('<table width="1" border="0" cellpadding="0" cellspacing="0" align=right><tr><td><img src="' + url + '"></td></tr><tr><td bgcolor="eaeaea">图片说明</td></tr></table>');
    sel.select();
  }
  idEdit.focus();
}
function insertpagesign(){
	 if (!Error()) return;
ab=showMeDialog("ui.php?sId=[$sId]&o=editor__page.html","color","dialogWidth:290pt;dialogHeight:50pt;help:0;status:0");
	
  if(ab=="undefined") {
  } else{
	 var sel,RangeType
    sel = idEdit.document.selection.createRange();
sel.pasteHTML(ab);

    sel.select();

  idEdit.focus();
  }
   

}


function insertcode(){
	 if (!Error()) return;
  ab=showMeDialog("editor/js/code.html","color","dialogWidth:290pt;dialogHeight:170pt;help:0;status:0");
	
  if(ab=="undefined") {
	  return false;
		
  }else if (ab!="") {
    var sel,RangeType
    sel = idEdit.document.selection.createRange();
    sel.pasteHTML(ab);
    sel.select();
  }
  idEdit.focus();

}

function inserthtmllist() {

 //if (!Error()) return;
 url="make.php?action=make_list&cId=1" ;
  ab=showMeDialog(url,"color","dialogWidth:530pt;dialogHeight:270pt;help:0;status:0");
	
  if(ab=="undefined") {
	  return false;
		
  }else if (ab!="") {
    var sel,RangeType
    sel = idEdit.document.selection.createRange();
    sel.pasteHTML(ab);
    sel.select();
  }
  idEdit.focus();


}
/*
function insertflash(){
	  if (!Error()) return;
 //ab=window.prompt("请输入图片的链接地址:","http://");
 Today = new Date();
newName=Today.valueOf();

 url="upload.php?type=flash&o=display&cId=" + document.content.cId.value + "&newName=" + newName;
ab=showMeDialog(url,"color","dialogWidth:477pt;dialogHeight:200pt;help:0;status:0");
//window.open(url, '', 'width=300,height=170,resizable=1,scrollbars=yes');

  if (ab!="") {
    var sel,RangeType
    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( ab );
    sel.select();
  }
  idEdit.focus();

}*/
/*
function insertattach(){
  if (!Error()) return;
 //ab=window.prompt("请输入图片的链接地址:","http://");
 Today = new Date();
newName=Today.valueOf();

 //url="upload.php?type=img&o=display&mode=single&cId=" + document.content.cId.value + "&newName=" + newName;
// var ab=showMeDialog(url,"color","dialogWidth:530pxt;dialogHeight:480px;help:0;status:0");
var ab=showMeDialog('upload.php?sId='+ sId +'&o=display&mode=one&type=attach&NodeID=' + NodeID,"color","dialogWidth:390px;dialogHeight:120px;help:0;status:0;scroll:0");
 	 
  if (ab!=null && ab['url']!="" && ab['url']!= null) {

	var str = "<a href=\""+ ab['url'] +"\" target=\"_blank\"><img src='"+ ab['publish_url'] + "images/icon/" + ab['suffix'] + ".gif' border=\"0\">" + ab['src_name'] + "</a>" ;
    var sel,RangeType;
    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( str );
    sel.select();
  }
  idEdit.focus();



}
*/
function insertattach(value, sform, element){
  if (!Error()) return;

	

  
  if (value!=null && value['url']!="" && value['url']!= null) {

	var str = "<a href=\""+ value['url'] +"\" target=\"_blank\"><img src='[$PUBLISH_URL]/images/icon/" + value['suffix'] + ".gif' border=\"0\">" + value['src_name'] + "</a>" ;
   
	var sel,RangeType;
    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( str );
    sel.select();
  } else {
	
	var arr = value;
	myRe=/([^\s]*)(\/)([^\/.]*)(.)(\w*)/g;
	myArray = myRe.exec(arr);
 
	if(myArray!= null && myArray[5] != null) {
		var str = "<a href=\""+ value +"\" target=\"_blank\"><img src='[$PUBLISH_URL]/images/icon/" + myArray[5] + ".gif' border=\"0\">" + myArray[3] + myArray[4] + myArray[5] + "</a>" ;
	   
		var sel,RangeType;
		sel = idEdit.document.selection.createRange();
		sel.pasteHTML( str );
		sel.select();
	
	}
  
  }
  idEdit.focus();



}



function insertflash(value, sform, element){
  if (!Error()) return;

	

  
  if (value!=null && value!="" ) {

	//var  str = "<EMBED quality=high src=\"" + value + "\"  pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"500\" height=\"300\" > </EMBED>";
   
	var  str = "<object width=300 height=80 classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\"><param name=\"movie\" value=\"" + value + "\" ><param name=\"wmode\" value=\"opaque\"><param name=\"quality\" value=\"autohigh\"><embed width=300 height=80 src=\"" + value + "\"  quality=\"autohigh\" wmode=\"opaque\" type=\"application/x-shockwave-flash\" plugspace=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\"></embed></object>";

	var sel,RangeType;
    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( str );
    sel.select();
  }  
  idEdit.focus();



}


function insertmedia(value, sform, element, type){
  if (!Error()) return;

  if (value!=null && value!="" ) {

    if(type == 'video') {
		var  str =   "<EMBED  src=\"" + value + "\" width=300 height=250 type=application/x-mplayer2 showdisplay=\"0\" showstatusbar=\"1\" showcontrols=\"1\" enablepositioncontrols=\"true\" clicktoplay=\"true\" enablecontextmenu=\"true\" autostart=\"0\" > </EMBED>";
	
	} else if(type == 'audio') {
		var  str =   "<EMBED  src=\"" + value + "\" width=300 height=68 type=application/x-mplayer2 showdisplay=\"0\" showstatusbar=\"1\" showcontrols=\"1\" enablepositioncontrols=\"true\" clicktoplay=\"true\" enablecontextmenu=\"true\" autostart=\"0\" loop=\"1\"> </EMBED>";
	} else if(type == 'rm') {
	
		var  str =   "<EMBED src=\"" + value + "\"  width=320 height=60 type=audio/x-pn-realaudio-plugin autostart=\"false\" controls=\"ControlPanel,statusbar\"></EMBED>";
	}

	var sel,RangeType;
    sel = idEdit.document.selection.createRange();
	sel.pasteHTML( str );
    sel.select();
  }  
  idEdit.focus();



}

function intable(){
  if (!Error()) return;
  ab=showMeDialog("ui.php?sId=[$sId]&o=editor__table.html","color","dialogWidth:300pt;dialogHeight:180pt;help:0;status:0");

  if (ab!="") {
    var sel,RangeType
    sel = idEdit.document.selection.createRange();
    sel.pasteHTML('<table ' + ab + '</table>');
    sel.select();
  }
  idEdit.focus();
}

//***************************************************
var sourceselectok;
function sourceshow(){
  if(document.all.sourceselect.style.visibility=='hidden')document.all.sourceselect.style.visibility='visible';
  else document.all.sourceselect.style.visibility='hidden';
  sourceselectok = 0;
  sourceing=setInterval("sourcehidden()",5);
}
function sourcehidden(){
  if (sourceselectok>=500) {
    if (window.sourceing) clearInterval(sourceing)
    document.all.sourceselect.style.visibility='hidden';
  }
  sourceselectok++;
}

//***************************************************
function clearEdit(){
  setMode(false)
  idEdit.document.open();
  idEdit.document.write(sHeader)
  idEdit.document.close();
}

function selectAll(){
  setMode(false)
  idEdit.document.all[0].innerHTML.select();
}

//**************************************************
function setMode(NewMode) {
  showContent(false,NewMode)
  if (NewMode!=bMode) {
    if (NewMode) {

     var sContents=sHeader + document.all.SaveContent.value
      //var sContents='abcd';
	 // sContents= document.all.SaveContent.value
      idEdit.document.open()
      idEdit.document.write(sContents)
      idEdit.document.close()
      document.all.EditContent.style.display='';
      document.all.SaveContent.style.display='none';
    }
  else {
    //显示html源码
	//document.all.SaveContent.style.width=document.body.scrollWidth-25;
	str=idEdit.document.all.tags("BODY")[0].innerHTML;
	//CUT/	len=sHeader.length;
	//CUT/	len=len+62;
	//CUT/	x = str.length;
	//CUT/	x=x-len-7;
	//document.write("The field named "+ sHeader.length +" has value of ");
	//CUT/	document.all.SaveContent.value=str.substr(len,x)
	document.all.SaveContent.value=str
    idEdit.document.body.innerText=getPureHtml(idEdit.document.body.innerHTML);
	//document.all.data_Content_html.value = document.all.SaveContent.value
  }
  bMode=NewMode
  for (var i=0;i<htmlOnly.children.length;i++)
   htmlOnly.children[i].disabled=(!bMode)
  }
  idEdit.focus()
}

function showContent(show,NewMode){
  document.all.bW.checked=false;
  document.all.bH.checked=false;
  //document.all.bE.checked=false;
  //document.all.bF.checked=false;
  document.all.EditContent.style.display='';
  document.all.SaveContent.style.display='';
  if (show) {
    document.all.EditContent.style.display='none';
    //if (NewMode) document.all.bE.checked=true;
    //else         document.all.bF.checked=true;
  }
  else {
  document.all.EditContent.style.display='none';
  
    if (NewMode) document.all.bW.checked=true;
    else         document.all.bH.checked=true;
  }
}

function getPureHtml(){
  var str = idEdit.document.body.innerHTML;
  
  return str.substr(1,500);
}

function rCode(s,a,b){
  var r = new RegExp(a,"gi");
  return s.replace(r,b); 
}

function setSave(NewMode){
  setMode(true)
  showContent(true,NewMode)
  if (NewMode) {
    var sContents=getPureHtml(idEdit.document.body.innerHTML);
  //  sContents=sContents.replace(/<(\/|)(tr|tbody|table)(.[^\<]*|)>/ig,'\[$1$2]');
   // sContents=sContents.replace(/<(\/|)(td|th)(.[^\<]*|)>/ig,'\[$1$2$3]');
  //  sContents=sContents.replace(/\[(td|th)/ig,'    \[$1');
    sContents=sContents.replace(/\[tr]/ig,'  \[TR]');
    sContents=sContents.replace(/\[tbody]\r\n  \[TR]/ig,'\[tbody]\n  \[TR bgcolor="efefef"]');
    sContents=sContents.replace(/\[table]/ig,'\[table width="1" border="0" cellpadding="0" cellspacing="0"]');
    var aryCode0 = new Array("<strong>","[b]","</strong>","[/b]","<p","[p","</p>","","<a href=","[url=","</a>","[/url]");
    var aryCode1 = new Array("<em>","[i]","</em>","[/i]","<u>","[u]","</u>","[/u]","<ul>","[list]","</ul>","[/list]","<ol>","[list=1]","</ol>","[/list]");
    var aryCode2 = new Array("<li>","[*]","</li>","","<font size=","[size=","<font color=","[color=","<font face=","[face=");
    var aryCode9 = new Array(">","]","<","[","</","[/");
    var aryCode = aryCode0.concat(aryCode1).concat(aryCode2).concat(aryCode9);
    for (var i=0;i<aryCode.length;i+=2){
      sContents=rCode(sContents,aryCode[i],aryCode[i+1]);	
    }
    sContents=sContents.replace(/\[p([^\]]*|)]/ig,'[BR]');
  } else {
    var sContents=idEdit.document.all[0].innerText
    sContents=sContents.replace(/\r\n/ig,'[BR]\n');
  }
  sContents=sContents.replace(/\ \[BR]/ig,'[BR]');
  document.all.SaveContent.value=sContents.replace(/([0-9a-zA-Z@]{32})/ig,"$1 ");
}