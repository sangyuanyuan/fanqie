<html>
<head>
<title>插入图片</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>


<style type="text/css">
body{margin:0px;scrollbar-face-color: #B8B8B8; scrollbar-highlight-color: #F5F9FF; scrollbar-shadow-color: #828282; scrollbar-3dlight-color: #828282; scrollbar-arrow-color: #797979; scrollbar-track-color: #ECECEC; scrollbar-darkshadow-color: #ffffff}
body,a,table,div,span,td,th,input,select{font:9pt;font-family: "宋体", Verdana, Arial, Helvetica, sans-serif;}
.text{border:1 solid #aaaaaa;}
.button{height:18;border:1 ridge #aaaaaa;background-color:aaaaaa;color:ffffff}
.table {  border: 1px inset; border-color: menu #FFFFFF #FFFFFF menu}
</style>

<script language="JavaScript">
function info() {
var img;
img='';

dm=document.form;

img_url=dm.img_url.value;
img_link=dm.img_link.value;
img+="<img src='";
img+=img_url;
img+="'";

img_alt=dm.img_alt.value;
img+="alt='";
img+=img_alt;
img+="'";

by=dm.img_align;
cd=by.options[by.selectedIndex].value ;
img+="align='";
img+=cd;
img+="'";

img_border=dm.img_border.value;
img+="border='";
img+=img_border;
img+="'";

img_hspace=dm.img_hspace.value;
img+="hspace='";
img+=img_hspace;
img+="'";

img_vspace=dm.img_vspace.value;
img+="vspace='";
img+=img_vspace;
img+="'";

img_width=dm.img_width.value;
if(img_width!=""){
img+="width='";
img+=img_width;
img+="'";
}

img_height=dm.img_height.value;
if(img_height!=""){
img+="height='";
img+=img_height;
img+="'";
}


img= img + ">";
if(img_link!='') {
img="<a href='" + img_link + "'  target='_blank'>" + img + "</a>";
}
return img;



}

</script>
<script language="JavaScript">
function add(url){
	document.form.img_url.value=url
}
function show(MenuID)
{
 if(MenuID=="advance")
 {
  if(advance.style.display=="") {
  	advance.style.display="none";
	//this.window.dialogHeight='110pt';
  }else {
  		advance.style.display="";
		this.window.dialogHeight='240pt';
  }
 
 }
}


function openwin(targeturl) {
		//window.open(targeturl, '', 'width=300,height=170,resizable=1,scrollbars=yes');
		showModalDialog(targeturl,"color1","dialogWidth:400pt;dialogHeight:300pt;help:0;status:0;resizable:1");
			
}
</script>
<body bgcolor=menu topmargin="0" leftmargin="0">
<table border="0" align="center" cellpadding="5" cellspacing="0">
  <tr> 
    <td valign="top"> <Iframe name="list" id="list" src="../upload_ftp.php?mode=filelist&cId=<?=$_GET[cId]?>" frameborder=0 class=button style="width:200;height=230"> 
	
      </Iframe> </td>
    <td valign="top"><table width="381" border="0" cellspacing="0" cellpadding="0" align="center">
        <form  action="../upload.php?o=upload&type=img&mode=single&cId=<?=$_GET['cId']?>&changeName=1" method="post" enctype="multipart/form-data" name="form" target="operation" >
          <tr> 
            <td  valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr> 
                  <td colspan="2"><table border="0" cellspacing="0" cellpadding="0" height="19">
                      <tr> 
                        <td >图片绝对URL:&nbsp; </td>
                        <td > <input name="img_url" type="text" id="img_url3" value="http://" size="40"> 
                        </td>
                        <td ><input type="button" name="Submit" value="预览" onclick="openwin(this.form.img_url.value)"></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td>图片上传:</td>
                  <td><input name="uploadFile[]" type="file" id="upload_img3" > 
                    <input type="submit" name="Submit2" value="上传"> <a href="#" onclick="show('advance')">高级设置</a></td>
                </tr>
                <tr style="display:none" name=advance id=advance> 
                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr> 
                        <td colspan="2"><table border="0" cellspacing="0" cellpadding="0" height="19">
                            <tr> 
                              <td >替换文字:&nbsp; </td>
                              <td > <input name="img_alt" type="text" id="img_alt2"> 
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="2"><table border="0" cellspacing="0" cellpadding="0" height="19">
                            <tr> 
                              <td >图片链接:&nbsp; </td>
                              <td > <input name="img_link" type="text" id="img_link2" value="" size="40"> 
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td colspan="2"><table border="0" cellspacing="0" cellpadding="0" height="19">
                            <tr> 
                              <td> 限制尺寸:&nbsp; </td>
                              <td > 宽(W):&nbsp; </td >
                              <td > <input name="img_width" type="text" id="img_width3" size="6"> 
                              </td>
                              <td> &nbsp;高(H): </td>
                              <td > &nbsp; <input name="img_height" type="text" id="img_height3" size="6"> 
                              </td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td><table width="160" border="0" cellspacing="0" cellpadding="0" height="101" class="table">
                            <tr> 
                              <td height="88" valign="middle"> <table  border="0" cellspacing="0" cellpadding="0" height="90" align="center">
                                  <tr> 
                                    <td >布局:</td>
                                    <td >&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td >对齐:</td>
                                    <td > <select name="img_align" id="select2">
                                        <option value="">默认</option>
                                        <option value="left">左对齐</option>
                                        <option value="right">右对齐</option>
                                        <option value="baseline">基线</option>
                                        <option value="top">顶端</option>
                                        <option value="middle">中间</option>
                                        <option value="texttop">文本上方</option>
                                        <option value="absmiddle">绝对中间</option>
                                        <option value="absbottom">绝对底部</option>
                                      </select> </td>
                                  </tr>
                                  <tr> 
                                    <td >边框宽度:&nbsp;</td>
                                    <td > <input name="img_border" type="text" id="img_border2" size="6"> 
                                    </td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                        <td align="left"> <table width="158" border="0" cellspacing="0" cellpadding="0" align="right" height="101" class="table">
                            <tr> 
                              <td height="100" align="left" valign="middle"> <table  border="0" cellspacing="0" cellpadding="0" height="91" align="center" width="122">
                                  <tr> 
                                    <td >间隔:&nbsp;</td>
                                    <td height="12" >&nbsp;</td>
                                  </tr>
                                  <tr> 
                                    <td height="55" >水平:&nbsp;</td>
                                    <td > <input name="img_hspace" type="text" id="img_hspace3" size="6"> 
                                    </td>
                                  </tr>
                                  <tr> 
                                    <td height="24" >垂直</td>
                                    <td height="24" > <input name="img_vspace" type="text" id="img_vspace3" size="6"> 
                                    </td>
                                  </tr>
                                </table></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr align="center"> 
                  <td colspan="2"><br>
                    <input name="cId" type="hidden" id="cId3" value="<?=$_GET[cId]?>"> 
                    <input name="newName" type="hidden" id="newName3" value="<?=$_GET[newName]?>">	
                    <input name="action" type="hidden" id="action3" value="upload"> 
					<img id=preview_img src="" width=0 height=0>
                    <input name="button" type=button class=button onclick='window.returnValue = info();window.close();' value="确　定"> 
                    <input name="button" type=button class=button onclick="window.returnValue ='' ;window.close();" value="取　消"> 
                    <Iframe name=operation src="" frameborder=0 class=button style="display:none"> 
                    </Iframe> </td>
                </tr>
              </table></td>
          </tr>
        </form>
      </table> </td>
  </tr>
</table>
</body>
</html>
