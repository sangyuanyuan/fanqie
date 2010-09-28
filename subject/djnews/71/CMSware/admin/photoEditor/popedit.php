<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>图像处理</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
 <SCRIPT language=javascript src="photoEditor/photojet.js"></SCRIPT>
<!--<SCRIPT language=javascript src="device.js"></SCRIPT>-->
<!-- 标签结束 --><script language=javascript>
var myPage = window.opener;

window.onload = setValues;

// var cellBgColor = myTable.selectedTD.bgColor;
//var imageWidth = myPage.selectedImage.width;
//var imageHeight = myPage.selectedImage.height;
//var imageAlign = myPage.selectedImage.align;
//var imageBorder = myPage.selectedImage.border;
//var imageAltTag = myPage.selectedImage.alt;
//var imageHspace = myPage.selectedImage.hspace;
//var imageVspace = myPage.selectedImage.vspace;

function setValues() {

	imageForm.image_width.value = imageWidth;
	imageForm.image_height.value = imageHeight;

	if (imageBorder == "") {
		imageBorder = "0"
	}

	imageForm.border.value = imageBorder;
	imageForm.alt_tag.value = imageAltTag;
	imageForm.hspace.value = imageHspace;
	imageForm.vspace.value = imageVspace;
	// tableForm.cell_width.value = cellWidth;
	this.focus();
}

function doModify() {
	if(confirm("编辑完成？确认保存吗？")) {
	var error = 0;


	eval( "apply_save('save','msie','MMS')");	
	//window.close();
	}

	else {
		return false;
	}


	
}

function printAlign() {
	if ((imageAlign != undefined) && (imageAlign != "")) {
		document.write('<option selected>' + imageAlign)
		document.write('<option>None')
	} else {
		document.write('<option selected>None')
	}
}

function printvAlign() {
	if ((imagevAlign != undefined) && (imagevAlign != "")) {
		document.write('<option selected>' + imagevAlign)
		document.write('<option>None')
	} else {
		document.write('<option selected>None')
	}
}

document.onkeydown = function () { 
			if (event.keyCode == 13) {	// ENTER
				doModify()			
			}
}

document.onkeypress = onkeyup = function () { 				
	if (event.keyCode == 13) {	// ENTER
	event.cancelBubble = true;
	event.returnValue = false;
	return false;				
	}
};

</script>
<SCRIPT language=javascript>

var PHOTOJET_HOST_PORT = "photoEditor";
var currentOperation = "crop";
var currentBehavior = "preview";          //preview or submit
var selectedImage;
function start( op ){

    currentOperation = op;
    if( op == "morph" )
       document.workarea.location.href = op+".php";
    else
       document.workarea.location.href = "photo_editor.php?sId=<?=$sys->session[sId]?>&o=" + op ;
	  
    //document.all.fixbox.disabled = true;
    //if( op == "crop" )  document.all.fixbox.disabled = false;
//	
}
function start1( op ){

  currentOperation = op;
    if( op == "morph" )
       document.workarea.location.href = op+".php";
    else
       document.workarea.location.href = op+".p";

    //document.all.fixbox.disabled = true;
    //if( op == "crop" )  document.all.fixbox.disabled = false;
//	
}
function newOne() {
    currentOperation = 'new';
	apply()
}
function apply(){
    if( currentOperation != "" )
        eval( "apply_" + currentOperation +"('preview','msie','MMS')");
}

function init(){                                                     // init something for onLoad event
   //currentImage.src = "http://photo.sohu.com/20050105/Img223790063.jpg";

	if (myPage.EditContent.document.selection.type == "Control") {
		var oControlRange = myPage.EditContent.document.selection.createRange();
		if (oControlRange(0).tagName.toUpperCase() == "IMG") {
			selectedImage = myPage.EditContent.document.selection.createRange()(0);
		}  else {
			alert('请选择待编辑的图片:)');
			window.close();
		
		}
	 
		 
		currentImage.src = selectedImage.src;	
	
	
	} else {
		alert('请选择待编辑的图片:)');
		window.close();
	
	}

	document.exewin.location="photo_editor.php?sId=" + myPage.sId;
	//alert(document.exewin.src);
     //var index = location.href.indexOf("?");
    //if( index >=0 ) currentImage.src = location.href.substring(index+1);
   // document.saveas1.location.href =  currentImage.src;

	setResult( currentImage.src, 0, 0 );
    /*var opts = document.view.devicelist.options;
    for( i = 0; i < devices.length; i++){
        thedevice = devices[ i ];
        var opt = new Option(thedevice.label,i,false,false);
        opts[opts.length] =  opt ;
    }*/
}

function preview( action ){
    deviceObj = document.view.devicelist;
    if(deviceObj.selectedIndex == -1){
        alert("请选择具体的手机型号");
        return;
    }
    deviceIndex = deviceObj.options[deviceObj.selectedIndex].value;
    if( deviceIndex == -1 ){
        alert("请选择具体的手机型号");
        return;
    }
    thedevice = devices[ deviceIndex ];
    themode   = thedevice.getMode( 0 );
    previewMode = true;
    currentBehavior = action;
    imagePreview( action, thedevice.name, themode.name );
}

function setCropbox(){
    if( currentOperation != "crop" )	return;
    
    fix = eval(document.all.fixbox.value);
    if( !fix )
        document.workarea.setbox( "whr",0,0,0 );
    else{
        deviceObj = document.view.devicelist;
        if(deviceObj.selectedIndex == -1) return;
        deviceIndex = deviceObj.options[deviceObj.selectedIndex].value;
        if( deviceIndex == -1 ){
            alert("请选择具体的手机型号");
            return;
        }
        themode = devices[ deviceIndex ].getMode( 0 );
        w = themode.MW;
        h = themode.MH;
        whr = 0;
        if( h > 0 )    whr = w/h;
        document.workarea.setbox( "whr",w,h,whr );
    }
}
function openHelp(){
    //window.open( "help.html#"+ currentOperation,"helpwin","menu=0,width=450,height=350,scrollbars=yes");
    window.open( "help.html","helpwin","menu=0,width=450,height=350,scrollbars=yes");
}
function saveas() {
	//document.saveas1.location.href = document.workarea.workImage.src;
	document.saveas1.document.execCommand("saveAs");
}
</SCRIPT>
<LINK href="photoEditor/album.css" rel=stylesheet type=text/css>
<STYLE>

.MenuTit {
	BACKGROUND-COLOR: #7da8e8; BORDER-BOTTOM: #333333 1px solid; BORDER-LEFT: #333333 1px solid; BORDER-RIGHT: #333333 1px solid; BORDER-TOP: #ffffff 1px solid; COLOR: #ffffff; FONT-SIZE: 11pt; FONT-WEIGHT: bold
}
.MenuList {
	BACKGROUND-COLOR: #b9d0f2; BORDER-LEFT: #666666 1px solid; BORDER-RIGHT: #666666 1px solid; COLOR: #0000ff; FONT-FAMILY: "宋体" ,"Arial", "sans-serif"; FONT-SIZE: 9pt
}
A:link {
	COLOR: blue; TEXT-DECORATION: none
}
A:visited {
	COLOR: #ffff99; TEXT-DECORATION: none
}
A:active {
	COLOR: red; TEXT-DECORATION: none
}
A:hover {
	COLOR: white; TEXT-DECORATION: underline
}
</STYLE>

</HEAD>
<BODY onload="init()" bgcolor=threedface style="border: 1px buttonhighlight;">
<table  width="100%" border="0" cellpadding="0" cellspacing="0"  >
<tr height=2> 
	<td align=center><img src="../de_images/vertical_spacer.gif" width="100%" height="2" tabindex=1 HIDEFOCUS></td>
  </tr>
  <tr height=1> 
	<td align=center></td>
  </tr>
  </table><TABLE align=center border=0 cellPadding=0 cellSpacing=0 width=100%>
  <TR> 
    <TD bgcolor=threedface width=100% valign=top><TABLE align=center border=0 cellPadding=3 cellSpacing=0 width="100%" bgcolor=threedface>
        <TR> 
          <TD bgcolor=threedface width="100%" align="center" valign=top align=center>
<A href="javascript:start('crop')"><IMG border=0 height=20 src="photoEditor/images/i_02.gif" width=55></A> &nbsp;
<A href="javascript:start('overlay')"><IMG border=0 height=20 src="photoEditor/images/i_03.gif" width=55></A> &nbsp;
<A href="javascript:start('luminance')"><IMG border=0 height=20 src="photoEditor/images/i_04.gif" width=55></A><!--&nbsp;<A href="javascript:start('contrast')"><IMG border=0 height=20 src="images/i_05.gif" width=55></A>--> &nbsp;
<A href="javascript:start('colorize')"><IMG border=0 height=20 src="photoEditor/images/i_06.gif" width=55></A> &nbsp;
<A href="javascript:start('rotate')"><IMG border=0 height=20 src="photoEditor/images/i_07.gif" width=55></A> &nbsp;
<A href="javascript:start('scale')"><IMG border=0 height=20 src="photoEditor/images/i_08.gif" width=55 alt="Scale"></A> &nbsp;
<!--A href="javascript:start('warp')"><IMG border=0 height=20 src="images/i_10.gif" width=55 alt="扭曲"></A> &nbsp;<A href="javascript:start('morph')"><IMG border=0 height=20 src="images/i_09.gif" width=55 alt="变形动画"></A--></TD>
        </TR>
      </TABLE>
<table  width="100%" border="0" cellpadding="0" cellspacing="0"  >
<tr height=2> 
	<td align=center><img src="../de_images/vertical_spacer.gif" width="100%" height="2" tabindex=1 HIDEFOCUS></td>
  </tr>
  <tr height=1> 
	<td align=center></td>
  </tr>
  </table>   <TABLE align=center border=0 cellPadding=0 cellSpacing=0  
      width="100%">
        <TR bgcolor=threedface> 
          <TD >&nbsp;<!--onclick=start1('newPhoto')<INPUT class=btn name=button  type=button value=" 新建 "> -->
            &nbsp;&nbsp;<INPUT class=btn name=button onclick=backOne() type=button value=" <<撤消 "> 
            &nbsp; <INPUT class=btn name=button onclick=forwardOne() type=button value=" 恢复>> "> 
            &nbsp; <INPUT class=btn name=button onclick=clearAll() type=button value="清除操作"> 
            &nbsp; <INPUT class=btn name=button onclick=openHelp() type=button value=" 帮助 "> 
            &nbsp; <INPUT class=btn name=button onclick=saveas() type=button value="本地保存" > 
           &nbsp; </TD>
          <TD   height=26 align=right>&nbsp; <INPUT class=btn name=button onClick="javascript:doModify();" type=button value=" 保  存 " > 
 			&nbsp; <INPUT class=btn name=button onClick="javascript:window.close()" type=button value=" 取消 " > &nbsp;&nbsp; </TD>
        </TR>
        <TR > 
          <FORM NAME="view" action="" onSubmit="return false;">
            <input id=fixbox name=fixbox  type=hidden value="false">
            <TD colSpan=2 height=0 noWrap></TD>
          </form>
        </TR>
      </TABLE>
      <TABLE border=0 cellPadding=0 cellSpacing=0 width="100%">
        <TR> <!-- <IFRAME border=0 frameBorder=1 height=472-->
          <TD  vAlign=top> <IFRAME border=0 frameBorder=1 height=472 width=100%  id=workarea 
    marginHeight=0 marginWidth=0 name=workarea src="photo_editor.php?o=crop&sId=<?=$sys->session[sId]?>" ></IFRAME> <IFRAME border=0 frameBorder=0 width=0 height=0 id=exewin marginHeight=0 marginWidth=0 name=exewin src="photo_editor.php?sId=<?=$sys->session[sId]?>"></IFRAME> 
            <IFRAME border=0 frameBorder=0 width=0 height=0 id=saveas1 marginHeight=0 marginWidth=0 name=saveas1 src=""></IFRAME> 
          </TD>
        </TR>
      </TABLE></TD>
  </TR>
</TABLE>
</body>
</html>
