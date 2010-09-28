

//var action=new Array("inserthorizontalrule","createlink","","","delete","cut","copy","paste","undo","redo","/","bold","italic","underline","","justifyleft","justifycenter","justifyright","","insertorderedlist","insertunorderedlist","outdent","indent")
//var tooltip=new Array("插入水平线","插入链接","插入图片","","删除","剪切","复制","粘贴","撤消","恢复","/","粗体","斜体","下划线","","向左对齐","向中靠","向右对齐","","列表","取消列表","取消缩进","缩进")
var action=new Array("bold","italic","underline","/","justifyleft","justifycenter","justifyright","","insertimage","insertMultiImage","inserttable","inserthorizontalrule","createlink","","delete","cut","copy","paste","undo","redo","","insertorderedlist","insertunorderedlist","outdent","indent","insertpage", "insertflash", "wordclean","bb2html","editimage","insertattach" )
var tooltip=new Array("粗体","斜体","下划线","/","向左对齐","向中靠","向右对齐","","单图插入","批量上传图片","插入表格","插入水平线","插入链接","","删除","剪切","复制","粘贴","撤消","恢复","","有序列表","无序列表","取消缩进","缩进","插入分页符", "多媒体插入", "Word格式清理", "bbcode转换html","图像处理","上传附件")

var s=
'     ' +
'    <style>' +
'    .Utoolbutton{border:1 double;border-color:threedface;cursor:hand;background:threedface}' +
'    .Dtoolbutton{border:1 double;border-color:#FFFFFF #999999 #999999 #FFFFFF;cursor:hand;background:DDDDDD}' +
'    .Ctoolbutton{border:1 double;border-color:#999999 #FFFFFF #FFFFFF #999999;cursor:hand;background:DDDDDD}' +
'    </style>' +
'    <table border=0 cellPadding=0 cellSpacing=0 width="100%"><tbody>' +
'      <tr><td colspan="2">';
for (var i=0;i<action.length;i++) {
  if (action[i]=="/") s+='<img width="16" height="16" src="editor/images/forecolor.gif" class="Utoolbutton" onmouseover="this.className=\'Dtoolbutton\';" onmouseout="this.className=\'Utoolbutton\';" onclick="this.className=\'Ctoolbutton\';forecolor();" title="字体颜色" hspace="2" vspace="0">'
  else if (action[i]=="") s+='　'
  else {
    s+='<img width="16" height="16" src="editor/images/' + action[i] + '.gif" class="Utoolbutton" onmouseover="this.className=\'Dtoolbutton\';" onmouseout="this.className=\'Utoolbutton\';" onclick="this.className=\'Ctoolbutton\';'   
    if (i>4) { 
     if(i==8) s+='inSinglephoto();'
	 else if(i==9) s+='inMultiphoto();'
     else if(i==10) s+='intable();'
   else if(i==25) s+='insertpagesign();'
 	else if(i==26) s+='showMenu(\'media_menu\',80,62);'
 	else if(i==27) s+='Word_Clean(1,1);'
	else if(i==28) s+='bb2html();'
	else if(i==29) s+='imageEdit();'
	else if(i==30) s+='commonInputPicker(\'attach\', \'\', \'\', \'parent.insertattach\');'
	//else if(i==32) s+='str2img();'
      else s+='format(\'' + action[i] + '\');'  
     }
    else s+='create(\'' + action[i] + '\');'
    s+='" title="' + tooltip[i] + '" hspace="2" vspace="0">'
  }
}
s+=
'      </td></tr><tr><td id=htmlOnly>' +
'<select onchange="format(\'fontname\',this[this.selectedIndex].value);this.selectedIndex=0"><option selected>字体<option value="宋体">宋体<option value="新宋体">新宋体<option value="楷体_GB2312">楷体_GB2312<option value="仿宋_GB2312">仿宋_GB2312<option value="黑体">黑体<option value="Arial">Arial<option value="Arial Black">Arial Black<option value="Courier New">Courier New<option value="Georgia">Georgia<option value="Impact">Impact<option value="Lucida Console">Lucida Console<option value="Lucida Sans Unicode">Lucida Sans Unicode<option value="Marlett">Marlett<option value="Symbol">Symbol<option value="Tahoma">Tahoma<option value="Times New Roman">Times New Roman<option value="Verdana">Verdana<option value="Webdings">Webdings<option value="Wingdings">Wingdings</option></select>' +
'<select onchange="format(\'fontSize\',this[this.selectedIndex].text);this.selectedIndex=0"><option selected>字号<option>1<option>2<option>3<option>4<option>5<option>6<option>7</option></select>' +
'<select onchange="format(\'formatblock\',this[this.selectedIndex].value);this.selectedIndex=0"><option>段落格式<option value="&lt;P&gt;">普通<option value="&lt;PRE&gt;">已编排格式<option value="&lt;H1&gt;">标题一<option value="&lt;H2&gt;">标题二<option value="&lt;H3&gt;">标题三<option value="&lt;H4&gt;">标题四<option value="&lt;H5&gt;">标题五<option value="&lt;H6&gt;">标题六</select>' +
'<select onchange="specialtype(this[this.selectedIndex].value);this.selectedIndex=0"><option>特殊字体格式<option value="sup">上标<option value="sub">下标<option value="del">删除线<option value="blink">闪烁<option value="big">增大字体<option value="small">减小字体</select>' +
'      </td><td>' +
'   <input id=mW onclick=setMode(true) type=checkbox CHECKED name=bW><label for=mw>编辑状态</label>' +
'<input id=mH onclick=setMode(false) type=checkbox name=bH><label for=mH>源代码</label>' +
'&nbsp;&nbsp;&nbsp;&nbsp;<input id=mP  type=checkbox name="data_Content_ImgAutoLocalize" value="1"  ><label for=mP>图片本地化</label>'+
'     </td></tr></table>' ;

document.write(s)