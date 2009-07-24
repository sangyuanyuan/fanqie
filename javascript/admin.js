var showhttp = false;
var PostDiv="abderraf123123";
var Urls = "admin.post.php"
var PostStr="";
var HType="";

if(window.XMLHttpRequest){showhttp = new XMLHttpRequest();if (showhttp.overrideMimeType) {showhttp.overrideMimeType('text/xml');}}	else if (window.ActiveXObject){try {showhttp = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) {try {showhttp = new ActiveXObject("Microsoft.XMLHTTP");} catch (e) {}}}

function Admin_Reset(){	document.getElementById("admin_username").value="";	document.getElementById("admin_password").value="";}
function Press_Login(){if (event.keyCode==13){Admin_Login()}}
function Admin_Login(){	
	if(document.getElementById("admin_username").value==""||document.getElementById("admin_password").value=="")
	{alert("用户名和密码不能为空");return false;}	
	if(document.getElementById("nickname").checked)
	{	
		document.login.action="checklogin2.php";
	}
	document.login.submit();			
	//var LoginStr=document.getElementById("admin_username").value+PostDiv+document.getElementById("admin_password").value;	
	//AdminLoginPost(Urls,"Login",LoginStr);
}
function AdminLoginPost(url,section,mvalue){	var mdata;		if (!showhttp) { window.alert("不能创建XMLHttpRequest对象实例.");return false;	}		showhttp.open("POST", url, true);		showhttp.onreadystatechange = AdminLoginRPost;		showhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		mdata = section+"="+mvalue;	showhttp.send(mdata);}
function AdminLoginRPost(){if (showhttp.readyState == 4){ 	if (showhttp.status == 200) {	var R_AdminLoginRPost = showhttp.responseText;  if(R_AdminLoginRPost.substring(0,5)=="Error"){alert("登录失败");return false;}	if(R_AdminLoginRPost.substring(0,2)=="OK"){window.location.reload();}	 } else { alert("服务器忙，请刷新后重试。");}}}

function Admin_Logout(){Post(Urls,"logout","logout",AdminLogoutRPost);}
function AdminLogoutRPost(){if (showhttp.readyState == 4){ if (showhttp.status == 200) {	var R_AdminLoginRPost = showhttp.responseText; window.location.href="/";	 } else { alert("服务器忙，请刷新后重试。");}}}

function Admin_Reg(){	
	if(document.getElementById("admin_username").value==""||document.getElementById("admin_password").value==""||document.getElementById("admin_password2").value==""||document.getElementById("admin_email").value=="")
	{alert("昵称、密码、邮箱不能为空");return false;}
	if(document.getElementById("admin_password").value!=document.getElementById("admin_password2").value)
	{alert("重复密码输入错误");return false;}
	document.login.submit();			

}

function Admin_UpdatePwd(){	
	if(document.getElementById("admin_userid").value==""||document.getElementById("admin_password").value==""||document.getElementById("admin_password1").value==""||document.getElementById("admin_password2").value=="")
	{alert("昵称、原密码、新密码及重复密码不能为空");return false;}
	if(document.getElementById("admin_password1").value!=document.getElementById("admin_password2").value)
	{alert("重复密码输入错误");return false;}
	var pwd=document.getElementById("admin_password1").value;
	var badChar ="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	badChar += "abcdefghijklmnopqrstuvwxyz";
	badChar += "0123456789";
	badChar += " "+"　";//半角与全角空格
	badChar += "`~!@#$%^&()-_=+]\\|:;\"\\'<,>?/";//不包含*或.的英文符号
	if(pwd.length<6)
	{
		alert("密码不能小于六位！");
		return false;
	}
	for(var i=0;i<pwd.length;i++){
		var c = pwd.charAt(i);
		if(badChar.indexOf(c) == -1){
				alert("请不要输入中文！");
				return false;
		}
	}
	
	document.change.submit();			

}

function show_menu(num){for(var i=1;i<=7;i++){document.getElementById("menus"+i).style.display="none";}document.getElementById("menus"+num).style.display="inline";}
function show_menu1(num){document.getElementById("menus"+num).style.display="inline";}
function newspage(){var key1=document.getElementById("newskey1").value;	var key2=document.getElementById("newskey2").value;	var key3=document.getElementById("newskey3").value;	var key4=document.getElementById("newskey4").value;	 var page=document.getElementById("newspage").value; window.location.href="?key1="+key1+"&key2="+key2+"&key3="+key3+"&key4="+key4+"&page="+page;}

function Post(url,section,mvalue,rpost){	var mdata;		if (!showhttp) { window.alert("不能创建XMLHttpRequest对象实例.");return false;	}		showhttp.open("POST", url, true);		showhttp.onreadystatechange = rpost;		showhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		mdata = section+"="+mvalue;	showhttp.send(mdata);}

function headtitle(num)
{
	var param1=document.getElementById("param1"+num).value;
	var param2=document.getElementById("param2"+num).value;
	var param3=0;
	if(document.getElementById("param3"+num).checked){param3=1;}
	
	PostStr=num+PostDiv+param1+PostDiv+param2+PostDiv+param3;
	Post(Urls,"headtitle",PostStr,rheadtitle);
}

function rheadtitle()
{
    if (showhttp.readyState == 4) { 
        if (showhttp.status == 200) { 
 		   		var result = showhttp.responseText;
  		   if(result=="OK"){window.location.reload();return false; }
		
        } else { 
            alert("服务器忙，请刷新后重试。");
          }
    }
}


function newscan(num){PostStr=num;Post(Urls,"newscan",PostStr,rnewscan);}
function rnewscan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function newspub(num){PostStr=num;Post(Urls,"newspub",PostStr,rnewspub);}
function rnewspub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function newsdel1(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"newsdel1",PostStr,rnewsdel1);}
function rnewsdel1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function newsback1(num){if(!window.confirm("确定要退回吗")){return false;};  PostStr=num;Post(Urls,"newsback1",PostStr,rnewsback1);}
function rnewsback1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

	
function newspriority1(num){var PostStr=num+PostDiv+document.getElementById("newspriority"+num).value; Post(Urls,"newspriority1",PostStr,rnewspriority1);}
function rnewspriority1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function newskey(){	var key1=document.getElementById("newskey1").value;	var key2=document.getElementById("newskey2").value;	var key3=document.getElementById("newskey3").value;	var key4=document.getElementById("newskey4").value;	window.location.href="?key1="+key1+"&key2="+key2+"&key3="+key3+"&key4="+key4;}	
function newskeypress(){if (event.keyCode==13){newskey()}}

function newscategoryselect(num1,num2)
{
	if(num1=="a")
	{
		var val=document.getElementById("selecta").value;
		if(val==11)
		{
			document.getElementById("check").style.display="inline";	
		}
		for(var i=1;i<=60;i++)
		{
			if(document.getElementById("selectb"+i)){document.getElementById("selectb"+i).style.display="none";}
			if(document.getElementById("selectc"+i)){document.getElementById("selectc"+i).style.display="none";}
		}
		if(document.getElementById("selectb"+val)){document.getElementById("selectb"+val).style.display="inline";}
	}	
	if(num1=="b")
	{
		var val=document.getElementById("selectb"+num2).value;
		for(var i=1;i<=60;i++)
		{
			if(document.getElementById("selectc"+i)){document.getElementById("selectc"+i).style.display="none";}
		}
		if(document.getElementById("selectc"+val)){document.getElementById("selectc"+val).style.display="inline";}
	}	
	if(num1=="c")
	{
		var val=document.getElementById("selectc"+num2).value;
	}		
	
	document.getElementById("param4").value=val;

}



function newscategoryselect2(num1,num2)
{
	if(num1=="aa")
	{
		var val=document.getElementById("selectaa").value;
		for(var i=1;i<=60;i++)
		{
			if(document.getElementById("selectbb"+i)){document.getElementById("selectbb"+i).style.display="none";}
			if(document.getElementById("selectcc"+i)){document.getElementById("selectcc"+i).style.display="none";}
		}
		if(document.getElementById("selectbb"+val)){document.getElementById("selectbb"+val).style.display="inline";}
	}	
	if(num1=="bb")
	{
		var val=document.getElementById("selectbb"+num2).value;
		for(var i=1;i<=60;i++)
		{
			if(document.getElementById("selectcc"+i)){document.getElementById("selectcc"+i).style.display="none";}
		}
		if(document.getElementById("selectcc"+val)){document.getElementById("selectcc"+val).style.display="inline";}
	}	
	if(num1=="cc")
	{
		var val=document.getElementById("selectcc"+num2).value;
	}		
	
	document.getElementById("param42").value=val;

}


function newsshow(num)
{
		for(var i=1;i<=5;i++)
		{
			document.getElementById("newsshow"+i).style.display="none";
		}
		if(num==1)
		{
			document.getElementById("newsshow1").style.display="inline";
			document.getElementById("newsshow2").style.display="inline";
			document.getElementById("newsshow5").style.display="inline";
		}
		if(num==2)
		{
			document.getElementById("newsshow3").style.display="inline";
		}
		if(num==3)
		{
			document.getElementById("newsshow4").style.display="inline";
		}	
		
		document.getElementById("newstypes").value=num;
}

function newsadd()
{
		
		document.uploadfiles.target="_self";
		var title=document.getElementById("title").value;
		var shorttitle=document.getElementById("shorttitle").value;
		var priority=document.getElementById("priority").value;
		var param4=document.getElementById("param4").value;
		if(document.getElementById("param6a").checked){var newstype="1";}
		if(document.getElementById("param6b").checked){var newstype="2";}
		if(document.getElementById("param6c").checked){var newstype="3";}
		var description=document.getElementById("description").value;
	//	var content=document.getElementById("content").value;
		var iscommentable="0";
		if(document.getElementById("iscommentable").checked){iscommentable="1";}
		var linkurl=document.getElementById("linkurl").value;
		if(title==""){alert("标题不能为空");return false;}
		if(shorttitle==""){alert("短标题不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
		if(newstype=="3"&&linkurl==""){alert("URL不能为空");return false;}

		var titlelen=strlen(title);
	 	if(titlelen>42){ alert("标题长度不正确"); return false;}

		
		if(!checkslength()){return false;}
		document.uploadfiles.target="_self";
		if(newstype=="2")
		{
			var upfile=document.getElementById("upfile").value;
			if(upfile==""){alert("上传文件不能为空");return false;}
			var upload_file_extension=upfile.substring(upfile.length-4,upfile.length);
			if(upload_file_extension.toLowerCase()!=".doc"&&upload_file_extension.toLowerCase()!=".txt"&&upload_file_extension.toLowerCase()!=".xls"&&upload_file_extension.toLowerCase()!=".ppt"&&upload_file_extension.toLowerCase()!=".rar"&&upload_file_extension.toLowerCase()!=".pdf"&&upload_file_extension.toLowerCase()!=".mp3"){alert("上传文件类型错误");return false;}
			document.uploadfiles.submit();			
		}
		else
		{
			document.getElementById("uploadfiles").action="admin.post.php";
			document.uploadfiles.submit();	
		}	
		
		
	//	HType=param4;
	//	PostStr=title+PostDiv+shorttitle+PostDiv+priority+PostDiv+param4+PostDiv+keyword+PostDiv+newstype+PostDiv+description+PostDiv+content+PostDiv+iscommentable+PostDiv+linkurl;
	//	Post(Urls,"newsadd",PostStr,rnewsadd);

}
function rnewsadd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.href="news.php?key3="+HType;return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function newscomment(num){PostStr=num;Post(Urls,"newscomment",PostStr,rnewscomment);}
function rnewscomment(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function newscommentkey(){	var key1=document.getElementById("newscommentkey1").value;	var key2=document.getElementById("newscommentkey2").value; var newscommentid=document.getElementById("newscommentid").value;  window.location.href="?key1="+key1+"&key2="+key2+"&id="+newscommentid;}	
function newscommentkeypress(){if (event.keyCode==13){newscommentkey()}}

function newscommentpage(){var key1=document.getElementById("newscommentkey1").value;	var key2=document.getElementById("newscommentkey2").value;	var newscommentid=document.getElementById("newscommentid").value; 	 var page=document.getElementById("newscommentpage").value; window.location.href="?key1="+key1+"&key2="+key2+"&id="+newscommentid+"&page="+page;}

function newsupdate()
{
		document.uploadfiles.target="_self";
		var param0=document.getElementById("newsid").value;
		var title=document.getElementById("title").value;
		var shorttitle=document.getElementById("shorttitle").value;
		var priority=document.getElementById("priority").value;
		var param4=document.getElementById("param4").value;
		var keyword=document.getElementById("keyword").value;
		if(document.getElementById("param6a").checked){var newstype="1";}
		if(document.getElementById("param6b").checked){var newstype="2";}
		if(document.getElementById("param6c").checked){var newstype="3";}
		var description=document.getElementById("description").value;
		var content=document.getElementById("content").value;
		var iscommentable="0";
		if(document.getElementById("iscommentable").checked){iscommentable="1";}
		var linkurl=document.getElementById("linkurl").value;
		if(title==""){alert("标题不能为空");return false;}
		if(shorttitle==""){alert("短标题不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
	
		var titlelen=strlen(title);
	 	if(titlelen>42){ alert("标题长度不正确"); return false;}
		
		if(!checkslength()){return false;}
		
		
		if(newstype=="3"&&linkurl==""){alert("URL不能为空");return false;}
		if(newstype=="2")
		{
			var upfile=document.getElementById("upfile").value;
			if(upfile!="")
			{
				var upload_file_extension=upfile.substring(upfile.length-4,upfile.length);
				if(upload_file_extension.toLowerCase()!=".doc"&&upload_file_extension.toLowerCase()!=".txt"&&upload_file_extension.toLowerCase()!=".xls"&&upload_file_extension.toLowerCase()!=".ppt"&&upload_file_extension.toLowerCase()!=".mp3"&&upload_file_extension.toLowerCase()!=".rar"){alert("上传文件类型错误");return false;}
			}
			document.uploadfiles.submit();			
		}
		else
		{
			document.getElementById("uploadfiles").action="admin.post.php";
			document.uploadfiles.submit();	
		}	
		
		//HType=param4;
		//PostStr=param0+PostDiv+title+PostDiv+shorttitle+PostDiv+priority+PostDiv+param4+PostDiv+keyword+PostDiv+newstype+PostDiv+description+PostDiv+content+PostDiv+iscommentable+PostDiv+linkurl;
		//Post(Urls,"newsupdate",PostStr,rnewsupdate);
}

function rnewsupdate(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.href="news.php?key3="+HType; return false;}} else {alert("服务器忙，请刷新后重试。");}}}



function videocan(num){PostStr=num;Post(Urls,"videocan",PostStr,rvideocan);}
function rvideocan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function videopub(num){PostStr=num;Post(Urls,"videopub",PostStr,rvideopub);}
function rvideopub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function videodel1(num){if(!window.confirm("确定要删除吗")){return false;}; PostStr=num;Post(Urls,"videodel1",PostStr,rvideodel1);}
function rvideodel1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function videopriority1(num){var PostStr=num+PostDiv+document.getElementById("newspriority"+num).value; Post(Urls,"videopriority1",PostStr,rvideopriority1);}
function rvideopriority1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function videocomment(num){PostStr=num;Post(Urls,"videocomment",PostStr,rvideocomment);}
function rvideocomment(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function videoadd()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("commentable").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("keyword").value;
		var param7=document.getElementById("upfile1").value;
		var param8=document.getElementById("upfile2").value;
		var param9=document.getElementById("description").value;
		var videonlineurl=document.getElementById("videonlineurl").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
		if(param5==""){alert("关键词不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile1").value;
		if(upfile1==""&&videonlineurl==""){alert("上传图片不能为空");return false;}
		if(upfile1!=""){
	  var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		
		var upfile2=document.getElementById("upfile2").value;
		if(upfile2==""&&videonlineurl==""){alert("上传视频不能为空");return false;}
		if(upfile2!=""){
	  	upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);
		}		document.uploadfiles.submit();			
}


function videoupdate()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("commentable").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("keyword").value;
		var param7=document.getElementById("upfile1").value;
		var param8=document.getElementById("upfile2").value;
		var param9=document.getElementById("description").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
		if(param5==""){alert("关键词不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile1").value;
		if(upfile1!="")
		{
	  	var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		var upfile2=document.getElementById("upfile2").value;
		if(upfile2!="")
		{
	  	upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);		
		}
		document.uploadfiles.submit();			

}



function photocan(num){PostStr=num;Post(Urls,"photocan",PostStr,rphotocan);}
function rphotocan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function photopub(num){PostStr=num;Post(Urls,"photopub",PostStr,rphotopub);}
function rphotopub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function photodel1(num){if(!window.confirm("确定要删除吗")){return false;}; PostStr=num;Post(Urls,"photodel1",PostStr,rphotodel1);}
function rphotodel1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function photoback1(num){if(!window.confirm("确定要退回除吗")){return false;}; PostStr=num;Post(Urls,"photoback1",PostStr,rphotoback1);}
function rphotoback1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

	
function photopriority1(num){var PostStr=num+PostDiv+document.getElementById("newspriority"+num).value; Post(Urls,"photopriority1",PostStr,rphotopriority1);}
function rphotopriority1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function photoadd()
{
	
		var param1=document.getElementById("title").value;
		var param4=document.getElementById("param4").value;
		var param9=document.getElementById("description").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile").value;
		if(upfile1==""){alert("上传图片不能为空");return false;}
	  var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}

		document.uploadfiles.submit();			

}

function photoupdate()
{
	
		var param1=document.getElementById("title").value;
		var param4=document.getElementById("param4").value;
		var param9=document.getElementById("description").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile").value;
		if(upfile1!="")
		{
	  	var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
	  }
		document.uploadfiles.submit();			

}



function deptcan(num){PostStr=num;Post(Urls,"deptcan",PostStr,rdeptcan);}
function rdeptcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function deptpub(num){PostStr=num;Post(Urls,"deptpub",PostStr,rdeptpub);}
function rdeptpub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function deptdel(num){if(!window.confirm("确定要删除吗")){return false;};PostStr=num;Post(Urls,"deptdel",PostStr,rdeptdel);}
function rdeptdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function deptpriority1(num){var PostStr=num+PostDiv+document.getElementById("newspriority"+num).value; Post(Urls,"deptpriority1",PostStr,rdeptpriority1);}
function rdeptpriority1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function deptadd()
{
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("code").value;
		var param4=document.getElementById("url").value;
		var param5=document.getElementById("description").value;
		if(param1==""){alert("标题不能为空");return false;}
		if(param3==""){alert("代码不能为空");return false;}
		if(param5==""){alert("描述不能为空");return false;}
		PostStr=param1+PostDiv+param2+PostDiv+param3+PostDiv+param4+PostDiv+param5;
		Post(Urls,"deptadd",PostStr,rdeptadd);
}
function rdeptadd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){alert("添加成功");window.location.href="department.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function deptupdate()
{
		var param0=document.getElementById("deptid").value;
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("code").value;
		var param4=document.getElementById("url").value;
		var param5=document.getElementById("description").value;
		if(param1==""){alert("标题不能为空");return false;}
		if(param3==""){alert("代码不能为空");return false;}
		if(param5==""){alert("描述不能为空");return false;}
		PostStr=param0+PostDiv+param1+PostDiv+param2+PostDiv+param3+PostDiv+param4+PostDiv+param5;
		Post(Urls,"deptupdate",PostStr,rdeptupdate);
}
function rdeptupdate(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.href="department.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function deptmagdel(num){PostStr=num;Post(Urls,"deptmagdel",PostStr,rdeptmagdel);}
function rdeptmagdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function deptmagadd()
{
		var PostStr=document.getElementById("deptid").value+PostDiv+document.getElementById("loginname").value;
		if(PostStr==""){alert("管理员不能为空");return false;}
		Post(Urls,"deptmagadd",PostStr,rdeptmagadd);

}

function rdeptmagadd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="error"){alert("管理员不存在");return false;}if(result=="OK"){alert("添加成功");window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function leadercan(num){PostStr=num;Post(Urls,"leadercan",PostStr,rleadercan);}
function rleadercan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function leaderpub(num){PostStr=num;Post(Urls,"leaderpub",PostStr,rleaderpub);}
function rleaderpub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function leaderdel(num){PostStr=num;Post(Urls,"leaderdel",PostStr,rleaderdel);}
function rleaderdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function leaderpriority1(num){var PostStr=num+PostDiv+document.getElementById("newspriority"+num).value; Post(Urls,"leaderpriority1",PostStr,rleaderpriority1);}
function rleaderpriority1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function leaderadd()
{
	
		var param1=document.getElementById("name").value;
		var param2=document.getElementById("position").value;
		var param3=document.getElementById("priority").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("email").value;
		var param6=document.getElementById("description").value;
		var param7=document.getElementById("upfile").value;
		
		if(param1==""){alert("姓名不能为空");return false;}
		if(param2==""){alert("职务不能为空");return false;}
		if(param4==""){alert("部门不能为空");return false;}
		if(param5==""){alert("电子邮箱不能为空");return false;}
		if(param6==""){alert("分工不能为空");return false;}
		if(param7==""){alert("图片不能为空");return false;}

	  var upload_file_extension=param7.substring(param7.length-4,param7.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}

		
		document.uploadfiles.submit();			

}


function leaderupdate()
{
	
		var param1=document.getElementById("name").value;
		var param2=document.getElementById("position").value;
		var param3=document.getElementById("priority").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("email").value;
		var param6=document.getElementById("position").value;
		var param7=document.getElementById("upfile").value;
		
		if(param1==""){alert("姓名不能为空");return false;}
		if(param2==""){alert("职务不能为空");return false;}
		if(param4==""){alert("部门不能为空");return false;}
		if(param5==""){alert("电子邮箱不能为空");return false;}
		if(param6==""){alert("分工不能为空");return false;}
		if(param7!="")
		{
	  	var upload_file_extension=param7.substring(param7.length-4,param7.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		
		document.uploadfiles.submit();			

}


function lactivityselect1()
{
		var val=document.getElementById("select1").value;
		for(var i=1;i<=60;i++)
		{
			if(document.getElementById("select2"+i)){document.getElementById("select2"+i).style.display="none";}
		}
		document.getElementById("select2"+val).style.display="inline";
		document.getElementById("dept").value=val;
		document.getElementById("leader").value="";
}

function lactivityselect2(num)
{
		var val=document.getElementById("select2"+num).value;
		document.getElementById("leader").value=val;
}

function lactivityadd()
{
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("dept").value;
		var param3=document.getElementById("leader").value;
		var param4=document.getElementById("content").value;
		if(param1==""){alert("标题不能为空");return false;}
		if(param2==""){alert("部门不能为空");return false;}
		if(param3==""){alert("领导不能为空");return false;}
		if(param4==""){alert("内容不能为空");return false;}
		PostStr=param1+PostDiv+param2+PostDiv+param3+PostDiv+param4;
		Post(Urls,"lactivityadd",PostStr,rlactivityadd);
}

function rlactivityadd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.href="lactivity.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function lactivitydel(num){PostStr=num;Post(Urls,"lactivitydel",PostStr,rlactivitydel);}
function rlactivitydel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function lactivityupdate()
{
		var param0=document.getElementById("postid").value;
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("dept").value;
		var param3=document.getElementById("leader").value;
		var param4=document.getElementById("content").value;
		if(param1==""){alert("标题不能为空");return false;}
		if(param2==""){alert("部门不能为空");return false;}
		if(param3==""){alert("领导不能为空");return false;}
		if(param4==""){alert("内容不能为空");return false;}
		PostStr=param0+PostDiv+param1+PostDiv+param2+PostDiv+param3+PostDiv+param4;
		Post(Urls,"lactivityupdate",PostStr,rlactivityupdate);
}

function rlactivityupdate(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.href="lactivity.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function llettercan(num){PostStr=num;Post(Urls,"llettercan",PostStr,rllettercan);}
function rllettercan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function lletterpub(num){PostStr=num;Post(Urls,"lletterpub",PostStr,rlletterpub);}
function rlletterpub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function lletterdel(num){PostStr=num;Post(Urls,"lletterdel",PostStr,rlletterdel);}
function rlletterdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function lletterpriority1(num){var PostStr=num+PostDiv+document.getElementById("newspriority"+num).value; Post(Urls,"lletterpriority1",PostStr,rlletterpriority1);}
function rlletterpriority1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function lletterupdate()
{
		var param0=document.getElementById("postid").value;
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("content").value;
		if(param1==""){alert("标题不能为空");return false;}
		if(param2==""){alert("内容不能为空");return false;}
		PostStr=param0+PostDiv+param1+PostDiv+param2;
		Post(Urls,"lletterupdate",PostStr,rlletterupdate);
}

function rlletterupdate(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.href="lletter.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function ldialogcan(num){PostStr=num;Post(Urls,"ldialogcan",PostStr,rldialogcan);}
function rldialogcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function ldialogpub(num){PostStr=num;Post(Urls,"ldialogpub",PostStr,rldialogpub);}
function rldialogpub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function dialog_show_leaders()
{
	var val=document.getElementById("leader_ids").value;
	if(val==""){return false;}

	val=val+",";
	
	Post(Urls,"ldialog_show_leaders",val,rdialog_show_leaders);
}

function rdialog_show_leaders(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;   document.getElementById("show_leaders").innerHTML=result;} else {alert("服务器忙，请刷新后重试。");}}}

function dialog_show_masters()
{
	var val=document.getElementById("master_ids").value;
	if(val==""){return false;}
	//if(val.substring(val.length-1)!=','){alert("请用','分割工号!"); return false;};
	val=val+",";
	
	Post(Urls,"ldialog_show_leaders",val,rdialog_show_masters);
}

function rdialog_show_masters(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;   document.getElementById("show_masters").innerHTML=result;} else {alert("服务器忙，请刷新后重试。");}}}


function ldialogadd()
{
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("starttime").value;
		var param3=document.getElementById("endtime").value;
		var param4=document.getElementById("leader_ids").value;
		var param5=document.getElementById("master_ids").value;
		var param6=document.getElementById("content").value;
		if(param1==""){alert("标题不能为空");return false;}
		if(param2==""){alert("起始时间不能为空");return false;}
		if(param3==""){alert("结束时间不能为空");return false;}
		if(param4==""){alert("领导工号不能为空");return false;}
		if(param5==""){alert("主持人工号不能为空");return false;}
		if(param6==""){alert("内容不能为空");return false;}
		PostStr=param1+PostDiv+param2+PostDiv+param3+PostDiv+param4+PostDiv+param5+PostDiv+param6;
		Post(Urls,"ldialogadd",PostStr,rldialogadd);
}

function rldialogadd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.href="ldialog.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function ldialogdel(num){PostStr=num;Post(Urls,"ldialogdel",PostStr,rldialogdel);}
function rldialogdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function ldialogupdate()
{
		var param0=document.getElementById("postid").value;
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("starttime").value;
		var param3=document.getElementById("endtime").value;
		var param4=document.getElementById("leader_ids").value;
		var param5=document.getElementById("master_ids").value;
		var param6=document.getElementById("content").value;
		if(param1==""){alert("标题不能为空");return false;}
		if(param2==""){alert("起始时间不能为空");return false;}
		if(param3==""){alert("结束时间不能为空");return false;}
		if(param4==""){alert("领导工号不能为空");return false;}
		if(param5==""){alert("主持人工号不能为空");return false;}
		if(param6==""){alert("内容不能为空");return false;}
		PostStr=param0+PostDiv+param1+PostDiv+param2+PostDiv+param3+PostDiv+param4+PostDiv+param5+PostDiv+param6;
		Post(Urls,"ldialogupdate",PostStr,rldialogupdate);
}

function rldialogupdate(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.href="ldialog.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function lrelpydel(num){PostStr=num;Post(Urls,"lreplydel",PostStr,rlreplydel);}
function rlreplydel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}



function tooladd()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("upfile").value;
		var param3=document.getElementById("description").value;

		
		if(param1==""){alert("标题不能为空");return false;}
		if(param2==""){alert("文件不能为空");return false;}
		if(param3==""){alert("描述不能为空");return false;}

  	var upload_file_extension=param2.substring(param2.length-4,param2.length);
		if(upload_file_extension.toLowerCase()!=".rar"&&upload_file_extension.toLowerCase()!=".zip"&&upload_file_extension.toLowerCase()!=".exe"&&upload_file_extension.toLowerCase()!=".pdf"&&upload_file_extension.toLowerCase()!=".doc"&&upload_file_extension.toLowerCase()!=".xls"&&upload_file_extension.toLowerCase()!=".txt"&&upload_file_extension.toLowerCase()!=".chm"){alert("上传文件类型错误");return false;}
		
		document.uploadfiles.submit();			

}


function toolcan(num){PostStr=num;Post(Urls,"toolcan",PostStr,rtoolcan);}
function rtoolcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function toolpub(num){PostStr=num;Post(Urls,"toolpub",PostStr,rtoolpub);}
function rtoolpub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function tooldel(num){PostStr=num;Post(Urls,"tooldel",PostStr,rtooldel);}
function rtooldel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function toolupdate()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("upfile").value;
		var param3=document.getElementById("description").value;

		
		if(param1==""){alert("标题不能为空");return false;}
		if(param3==""){alert("描述不能为空");return false;}

		if(param2!="")
		{
  		var upload_file_extension=param2.substring(param2.length-4,param2.length);
			if(upload_file_extension.toLowerCase()!=".rar"&&upload_file_extension.toLowerCase()!=".zip"&&upload_file_extension.toLowerCase()!=".exe"&&upload_file_extension.toLowerCase()!=".pdf"&&upload_file_extension.toLowerCase()!=".doc"&&upload_file_extension.toLowerCase()!=".xls"&&upload_file_extension.toLowerCase()!=".txt"&&upload_file_extension.toLowerCase()!=".chm"){alert("上传文件类型错误");return false;}
		}
		document.uploadfiles.submit();			

}


function newsshowc()
{
		if(document.getElementById("isshowongrouppage").checked)
		{document.getElementById("newsshowc").style.display="inline";}
		else
		{document.getElementById("newsshowc").style.display="none";}
		
		
	
}




function newsadd2()
{
		document.uploadfiles.target="_self";
		var title=document.getElementById("title").value;
		var shorttitle=document.getElementById("shorttitle").value;
		var priority=document.getElementById("priority").value;
		
		var iscommentable=0;
		if(document.getElementById("iscommentable").checked){iscommentable=1;}
		var isshowongrouppage=0;
		if(document.getElementById("isshowongrouppage").checked){isshowongrouppage=1;}

		var keyword=document.getElementById("keyword").value;
		var newstype=0;
		if(document.getElementById("param6a").checked){var newstype="1";}
		if(document.getElementById("param6b").checked){var newstype="2";}
		if(document.getElementById("param6c").checked){var newstype="3";}
		
		var titlelen=strlen(title);
	 	if(titlelen>42){ alert("标题长度不正确"); return false;}

		var linkurl=document.getElementById("linkurl").value;
		var param4=document.getElementById("param4").value;
		
		if(title==""){alert("标题不能为空");return false;}
		if(shorttitle==""){alert("短标题不能为空");return false;}
		if(keyword==""){alert("关键词不能为空");return false;}
		if(isshowongrouppage==1&&param4==""){alert("分类不能为空");return false;}
		
		if(isshowongrouppage==1&&!checkslength()){return false;}
		
		//if(newstype=="1"&&description==""){alert("描述不能为空");return false;}
		//if(newstype=="1"&&content==""){alert("简介不能为空");return false;}
		if(newstype=="3"&&linkurl==""){alert("URL不能为空");return false;}
		if(newstype=="2")
		{
			var upfile=document.getElementById("upfile").value;
			if(upfile==""){alert("上传文件不能为空");return false;}
			var upload_file_extension=upfile.substring(upfile.length-4,upfile.length);
			if(upload_file_extension.toLowerCase()!=".doc"&&upload_file_extension.toLowerCase()!=".txt"&&upload_file_extension.toLowerCase()!=".xls"&&upload_file_extension.toLowerCase()!=".pdf"&&upload_file_extension.toLowerCase()!=".rar"){alert("上传文件类型错误");return false;}
			document.uploadfiles.submit();			
			return false;
		}
		else
		{
			document.getElementById("uploadfiles").action="admin.post.php";
			document.uploadfiles.submit();	
		}	
		
		//HType=param4;
		//PostStr=title+PostDiv+shorttitle+PostDiv+priority+PostDiv+iscommentable+PostDiv+keyword+PostDiv+isshowongrouppage+PostDiv+newstype+PostDiv+param4+PostDiv+description+PostDiv+content+PostDiv+linkurl;
		//Post(Urls,"newsadd2",PostStr,rnewsadd2);		
		

}
function rnewsadd2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; alert(result); if(result=="OK"){window.location.href="news2.php?key3="+HType;return false;}} else {alert("服务器忙，请刷新后重试。");}}}


function newsdel2(num){if(!window.confirm("确定要删除吗")){return false;}; PostStr=num;Post(Urls,"newsdel2",PostStr,rnewsdel2);}
function rnewsdel2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function show_menu2(num){for(var i=1;i<=3;i++){document.getElementById("menus"+i).style.display="none";}document.getElementById("menus"+num).style.display="inline";}

function newsprview()
{
	 	document.uploadfiles.target="_blank";
		document.uploadfiles.action="/news/previewnews.php";
		document.uploadfiles.submit();			
}



function newsupdate2()
{
		document.uploadfiles.target="_self";
		var param0=document.getElementById("newsid").value;
		var title=document.getElementById("title").value;
		var shorttitle=document.getElementById("shorttitle").value;
		var priority=document.getElementById("priority").value;
		var param4=document.getElementById("param4").value;
		var keyword=document.getElementById("keyword").value;
		var isshowongrouppage=0;
		if(document.getElementById("isshowongrouppage").checked){isshowongrouppage=1;}
		if(document.getElementById("param6a").checked){var newstype="1";}
		if(document.getElementById("param6b").checked){var newstype="2";}
		if(document.getElementById("param6c").checked){var newstype="3";}
		var description=document.getElementById("description").value;
		var content=document.getElementById("content").value;
		var iscommentable="0";
		if(document.getElementById("iscommentable").checked){iscommentable="1";}
		var linkurl=document.getElementById("linkurl").value;
		if(title==""){alert("标题不能为空");return false;}
		if(shorttitle==""){alert("短标题不能为空");return false;}
		if(isshowongrouppage==1&&param4==""){alert("分类不能为空");return false;}
		
		var titlelen=strlen(title);
	 	if(titlelen>42){ alert("标题长度不正确"); return false;}


		if(isshowongrouppage==1&&!checkslength()){return false;}

		if(newstype=="3"&&linkurl==""){alert("URL不能为空");return false;}
		if(newstype=="2")
		{
			var upfile=document.getElementById("upfile").value;
			if(upfile!="")
			{
				var upload_file_extension=upfile.substring(upfile.length-4,upfile.length);
				if(upload_file_extension.toLowerCase()!=".doc"&&upload_file_extension.toLowerCase()!=".txt"&&upload_file_extension.toLowerCase()!=".xls"&&upload_file_extension.toLowerCase()!=".pdf"&&upload_file_extension.toLowerCase()!=".rar"){alert("上传文件类型错误");return false;}
			}
			document.uploadfiles.submit();			
		}
		else
		{
			document.getElementById("uploadfiles").action="admin.post.php";
			document.uploadfiles.submit();	
		}	
		//HType=param4;
		//PostStr=param0+PostDiv+title+PostDiv+shorttitle+PostDiv+priority+PostDiv+isshowongrouppage+PostDiv+param4+PostDiv+keyword+PostDiv+newstype+PostDiv+description+PostDiv+content+PostDiv+iscommentable+PostDiv+linkurl;
		//Post(Urls,"newsupdate2",PostStr,rnewsupdate2);
}
function rnewsupdate2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.href="news2.php?key3="+HType; return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function photoadd2()
{
	
		var title=document.getElementById("title").value;
		var param4=document.getElementById("param4").value;
		var description=document.getElementById("description").value;
		
		if(title==""){alert("标题不能为空");return false;}
		if(description==""){alert("描述不能为空");return false;}
		var isshowongrouppage=0;
		if(document.getElementById("isshowongrouppage").checked){isshowongrouppage=1;}
		if(isshowongrouppage==1&&param4==""){alert("分类不能为空");return false;}
		
		var upfile1=document.getElementById("upfile").value;
		if(upfile1==""){alert("上传图片不能为空");return false;}
	  var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}

		document.uploadfiles.submit();			

}

function photoupdate2()
{
	
		var title=document.getElementById("title").value;
		var param4=document.getElementById("param4").value;
		var description=document.getElementById("description").value;
		
		if(title==""){alert("标题不能为空");return false;}
		if(description==""){alert("描述不能为空");return false;}
		
		var isshowongrouppage=0;
		if(document.getElementById("isshowongrouppage").checked){isshowongrouppage=1;}
		if(isshowongrouppage==1&&param4==""){alert("分类不能为空");return false;}


		var upfile1=document.getElementById("upfile").value;
		if(upfile1!="")
		{
	  	var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
	  }
		document.uploadfiles.submit();			

}


function videoadd2()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("iscommentable").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("keyword").value;
		var param7=document.getElementById("upfile1").value;
		var param8=document.getElementById("upfile2").value;
		var param9=document.getElementById("description").value;
		var videonlineurl=document.getElementById("videonlineurl").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		var isshowongrouppage=0;
		if(document.getElementById("isshowongrouppage").checked){isshowongrouppage=1;}
		if(isshowongrouppage==1&&param4==""){alert("分类不能为空");return false;}
		if(param5==""){alert("关键词不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile1").value;
		if(upfile1==""&&videonlineurl==""){alert("上传图片不能为空");return false;}
		if(upfile1!=""){
	  var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		
		var upfile2=document.getElementById("upfile2").value;
		if(upfile2==""&&videonlineurl==""){alert("上传视频不能为空");return false;}
		if(upfile2!=""){
	  upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);			
		}
		document.uploadfiles.submit();			

}




function videoupdate2()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("iscommentable").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("keyword").value;
		var param7=document.getElementById("upfile1").value;
		var param8=document.getElementById("upfile2").value;
		var param9=document.getElementById("description").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		var isshowongrouppage=0;
		if(document.getElementById("isshowongrouppage").checked){isshowongrouppage=1;}
		if(isshowongrouppage==1&&param4==""){alert("分类不能为空");return false;}
		if(param5==""){alert("关键词不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile1").value;
		if(upfile1!="")
		{
	  var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		var upfile2=document.getElementById("upfile2").value;
		if(upfile2!="")
		{
	  upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);		
		}
		document.uploadfiles.submit();			

}




function votepriority1(num){var PostStr=num+PostDiv+document.getElementById("votepriority"+num).value; Post(Urls,"votepriority1",PostStr,rvotepriority1);}
function rvotepriority1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function votedel1(num){if(!window.confirm("确定要删除吗")){return false;};PostStr=num;Post(Urls,"votedel1",PostStr,rvotedel1);}
function rvotedel1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function votetypes(num)
{

	if(num==1)
	{
		for(var i=1;i<=10;i++)
		{
			document.getElementById("vote_pic"+i).style.display="none";
		}
	}
	else
	{
		for(var i=1;i<=10;i++)
		{
			document.getElementById("vote_pic"+i).style.display="inline";
		}

	}		
	document.getElementById("votetypeval").value=num;


}



function voteadd()
{
	
		var title=document.getElementById("title").value;
		if(title==""){alert("标题不能为空");return false;}

		var upfile0=document.getElementById("upfile0").value;
		if(upfile0!="")
		{
	  	var upload_file_extension=upfile0.substring(upfile0.length-4,upfile0.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		
		var main_cate_id=document.getElementById("main_cate_id").value;
		if(main_cate_id==""){alert("显示位置不能为空");return false;}
		
		var endtime=document.getElementById("endtime").value;
		if(endtime==""){alert("结束日期不能为空");return false;}
		
		var content1=document.getElementById("content1").value;
		if(content1==""){alert("投票内容1不能为空");return false;}

		if(document.getElementById("votetypeb").checked)
		{
			 if(document.getElementById("upfile1").value==""){alert("内容图片1不能为空");return false;}
			 for(var i=2;i<=10;i++)
			 {
			 		if(document.getElementById("content"+i).value!=""&&document.getElementById("upfile"+i).value==""){alert("内容图片"+i+"不能为空");return false;}
			 		upfile=document.getElementById("upfile"+i).value;
					if(document.getElementById("upfile"+i).value!="")
					{
	  				upload_file_extension=upfile.substring(upfile.length-4,upfile.length);
						if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片"+i+"类型错误");return false;}
		 			}
			 		
			 }
			 
			 
		}
		document.uploadfiles.submit();			



}


function voteitemdel(num){if(!window.confirm("确定要删除吗")){return false;};PostStr=num;Post(Urls,"voteitemdel",PostStr,rvoteitemdel);}
function rvoteitemdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function voteitemupdate(num,num2)
{
		if(document.getElementById("content"+num2).value==""){alert("投票内容"+num2+"不能为空");return false;}
		document.getElementById("uptype").value=num;
		document.getElementById("voteitemid").value=num2;
		//alert(num2);
		document.uploadfiles.submit();			
		
}

function voteitemadds(num2)
{
		if(document.getElementById("content"+num2).value==""){alert("投票内容"+num2+"不能为空");return false;}
		document.getElementById("voteitemadd").value=num2;
		document.uploadfiles.submit();			
		
}




function voteupdate()
{
	
		var title=document.getElementById("title").value;
		if(title==""){alert("标题不能为空");return false;}

		var upfile0=document.getElementById("upfile0").value;
		if(upfile0!="")
		{
	  	var upload_file_extension=upfile0.substring(upfile0.length-4,upfile0.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		
		var main_cate_id=document.getElementById("main_cate_id").value;
		if(main_cate_id==""){alert("显示位置不能为空");return false;}
		
		var endtime=document.getElementById("endtime").value;
		if(endtime==""){alert("结束日期不能为空");return false;}
		
		document.uploadfiles.submit();			



}



function photoadd222()
{
	

		document.uploadfiles.submit();			

}


function newscopy(newsid)
{
	var newscopy=document.getElementById("param42").value;
	if(newscopy==""){alert("请选择分类！");return false;}
	PostStr=newscopy+PostDiv+newsid;
	Post(Urls,"newscopy",PostStr,rnewscopy);
}

function rnewscopy(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){alert("新闻复制成功");return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function subjectitemdel(num){PostStr=num;Post(Urls,"subjectitemdel",PostStr,rsubjectitemdel);}
function rsubjectitemdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
function subjectitempublish(num){
	
	PostStr=num+PostDiv+document.getElementById('cateidselect'+num).value;
	//alert('ok');
	Post(Urls,"subjectitempublish",PostStr,rsubjectitempublish);}
function rsubjectitempublish(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; alert(result); if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function photodel2(num){if(!window.confirm("确定要删除吗")){return false;};PostStr=num;Post(Urls,"photodel2",PostStr,rphotodel2);}
function rphotodel2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function videodel2(num){PostStr=num;Post(Urls,"videodel2",PostStr,rvideodel2);}
function rvideodel2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function priorityclear(ctype)
{
	if(!window.confirm("清空优先级")){return false;}
	for(var i=1;i<=20;i++)
	{
				if(document.getElementById("priority"+i)){document.getElementById("priority"+i).value="";}
	}
	if(ctype=="newsall"){newspriorityall1();}
	if(ctype=="newspart"){newspriorityall2();}
	if(ctype=="photoall"){photopriorityall1();}
	if(ctype=="photopart"){photopriorityall2();}
	if(ctype=="videoall"){videopriorityall1();}
	if(ctype=="videopart"){videopriorityall2();}
	if(ctype=="magall"){magpriorityall1();}
	if(ctype=="link"){linkpriorityall1();}
	
	
}	

function newspriorityall(dept)
{
	if(!window.confirm("编辑优先级")){return false;}
	if(dept=="all"){	newspriorityall1();}
	if(dept=="part"){	newspriorityall2();}
}

function newspriorityall1()
{
	var pid="";
	var pp="";
	var PostDiv1="abc";
	var PostDiv2="def";
	PostStr="";
	for(var i=1;i<=20;i++)
	{
			if(document.getElementById("priority"+i))
			{
				pid=document.getElementById("priorityh"+i).value;
				pp=document.getElementById("priority"+i).value;
				if(pp==""){pp="100";}
				PostStr=PostStr+pid+PostDiv1+pp+PostDiv2;
			}
	}
	Post(Urls,"newspriorityall1",PostStr,rnewspriorityall1);
}
function rnewspriorityall1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}





function newspriorityall2()
{
	var pid="";
	var pp="";
	var PostDiv1="abc";
	var PostDiv2="def";
	PostStr="";
	for(var i=1;i<=20;i++)
	{
			if(document.getElementById("priority"+i))
			{
				pid=document.getElementById("priorityh"+i).value;
				pp=document.getElementById("priority"+i).value;
				if(pp==""){pp="100";}
				PostStr=PostStr+pid+PostDiv1+pp+PostDiv2;
			}
	}
	Post(Urls,"newspriorityall2",PostStr,rnewspriorityall2);
}
function rnewspriorityall2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function newscan2(num){PostStr=num;Post(Urls,"newscan2",PostStr,rnewscan2);}
function rnewscan2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function newspub2(num){PostStr=num;Post(Urls,"newspub2",PostStr,rnewspub2);}
function rnewspub2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function photopriorityall(dept){	if(!window.confirm("编辑优先级")){return false;}	if(dept=="all"){	photopriorityall1();}	if(dept=="part"){	photopriorityall2();}}
function photopriorityall1(){		var pid="";	var pp="";	var PostDiv1="abc";	var PostDiv2="def";	PostStr="";	for(var i=1;i<=20;i++)	{			if(document.getElementById("priority"+i))			{				pid=document.getElementById("priorityh"+i).value;				pp=document.getElementById("priority"+i).value;				if(pp==""){pp="100";}				PostStr=PostStr+pid+PostDiv1+pp+PostDiv2;			}	}	Post(Urls,"photopriorityall1",PostStr,rphotopriorityall1);}
function rphotopriorityall1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function photopriorityall2(){		var pid="";	var pp="";	var PostDiv1="abc";	var PostDiv2="def";	PostStr="";	for(var i=1;i<=20;i++)	{			if(document.getElementById("priority"+i))			{				pid=document.getElementById("priorityh"+i).value;				pp=document.getElementById("priority"+i).value;				if(pp==""){pp="100";}				PostStr=PostStr+pid+PostDiv1+pp+PostDiv2;			}	}	Post(Urls,"photopriorityall2",PostStr,rphotopriorityall2);}
function rphotopriorityall2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function photocan2(num){PostStr=num;Post(Urls,"photocan2",PostStr,rphotocan2);}
function rphotocan2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}


function photopub2(num){PostStr=num;Post(Urls,"photopub2",PostStr,rphotopub2);}
function rphotopub2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function videopriorityall(dept){	if(!window.confirm("编辑优先级")){return false;}	if(dept=="all"){	videopriorityall1();}	if(dept=="part"){	videopriorityall2();}}

function videopriorityall1(){		var pid="";	var pp="";	var PostDiv1="abc";	var PostDiv2="def";	PostStr="";	for(var i=1;i<=20;i++)	{			if(document.getElementById("priority"+i))			{				pid=document.getElementById("priorityh"+i).value;				pp=document.getElementById("priority"+i).value;				if(pp==""){pp="100";}				PostStr=PostStr+pid+PostDiv1+pp+PostDiv2;			}	}	Post(Urls,"videopriorityall1",PostStr,rvideopriorityall1);}
function rvideopriorityall1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function videopriorityall2(){		var pid="";	var pp="";	var PostDiv1="abc";	var PostDiv2="def";	PostStr="";	for(var i=1;i<=20;i++)	{			if(document.getElementById("priority"+i))			{				pid=document.getElementById("priorityh"+i).value;				pp=document.getElementById("priority"+i).value;				if(pp==""){pp="100";}				PostStr=PostStr+pid+PostDiv1+pp+PostDiv2;			}	}	Post(Urls,"videopriorityall2",PostStr,rvideopriorityall2);}
function rvideopriorityall2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function videoback1(num){if(!window.confirm("确定要退回吗")){return false;};  PostStr=num;Post(Urls,"videoback1",PostStr,rvideoback1);}
function rvideoback1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function newscategoryselectnew(num1,num2)
{
	if(num1=="a")
	{
		var val=document.getElementById("selecta").value;
		var slength=val.split("&")[1]; 
		val=val.split("&")[0]; 
		for(var i=1;i<=60;i++)
		{
			if(document.getElementById("selectb"+i)){document.getElementById("selectb"+i).style.display="none";}
			if(document.getElementById("selectc"+i)){document.getElementById("selectc"+i).style.display="none";}
		}
		if(document.getElementById("selectb"+val)){document.getElementById("selectb"+val).style.display="inline";}
	}	
	if(num1=="b")
	{
		var val=document.getElementById("selectb"+num2).value;
		var slength=val.split("&")[1]; 
		val=val.split("&")[0]; 
		for(var i=1;i<=60;i++)
		{
			if(document.getElementById("selectc"+i)){document.getElementById("selectc"+i).style.display="none";}
		}
		if(document.getElementById("selectc"+val)){document.getElementById("selectc"+val).style.display="inline";}
	}	
	if(num1=="c")
	{
		var val=document.getElementById("selectc"+num2).value;
		var slength=val.split("&")[1]; 
		val=val.split("&")[0]; 
	}		
	
	document.getElementById("param4").value=val;
	shorttitlelength(slength);
}

function shorttitlelength(len)
{
		document.getElementById("slength").value=len;

}


function checkslength()
{

	 	var val1=document.getElementById("shorttitle").value;
		val1=strlen(val1);
	 	var val2=document.getElementById("slength").value;
	 	if(val1>val2){ alert("短标题长度不正确"); return false;}
	 	else{return true;}
	
}




function strlen(str)   
{   
    var i;   
    var len;   
    len = 0;   
    for (i=0;i<str.length;i++)   
    {   
        if (str.charCodeAt(i)>255) len+=2; else len++;   
    }   
    return len;   
}   



function shorttitleclear()
{
	if(!window.confirm("清空短标题长度")){return false;}
	for(var i=1;i<=20;i++)
	{
				if(document.getElementById("shorttitle"+i)){document.getElementById("shorttitle"+i).value="";}
	}
	shorttitleall2();
}	


function shorttitleall1()
{
	if(!window.confirm("编辑短标题长度")){return false;}
	shorttitleall2();
	
}

function shorttitleall2()
{	
	var pid="";
	var pp="";
	var PostDiv1="abc";
	var PostDiv2="def";
	PostStr="";
	for(var i=1;i<=20;i++)
	{
			if(document.getElementById("shorttitle"+i))
			{
				pid=document.getElementById("shorttitleh"+i).value;
				pp=document.getElementById("shorttitle"+i).value;
				if(pp==""){pp="100";}
				PostStr=PostStr+pid+PostDiv1+pp+PostDiv2;
			}
	}
	Post(Urls,"shorttitleall2",PostStr,rshorttitleall2);
}	

function rshorttitleall2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}



function news_del_select()
{
	//var news_del_num=document.getElementById("news_del_num").value;
	if(document.getElementById("news_del1").checked==true)
	{
		for(var i=1;i<=20;i++)
		{
			if(document.getElementById("news_del"+i)){document.getElementById("news_del"+i).checked=false;}
		}		
	}
	else
	{
		
		for(var i=1;i<=20;i++)
		{
			if(document.getElementById("news_del"+i)){document.getElementById("news_del"+i).checked=true;}
		}
	}	
}

function news_del_back()
{
	if(!window.confirm("确定要批量删除退回吗")){return false;};
	var PostDiv1="abc";
	var PostDiv2="def";
	PostStr="";
	for(var i=1;i<=20;i++)
	{
		if(document.getElementById("news_del"+i))
		{
		  if(document.getElementById("news_del"+i).checked==true)
		  {
			PostStr=PostStr+document.getElementById("news_delid"+i).value+PostDiv1+document.getElementById("news_deldept"+i).value+PostDiv2;
		  }
		}
	}
	if(PostStr==""){return false;}
	Post(Urls,"news_del_back",PostStr,rnews_del_back);
}	

function rnews_del_back(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function changepassword(id)
{
	var pwd=document.getElementById("password").value
	PostStr=id+PostDiv+pwd;
	Post(Urls,"changepassword",PostStr,rchangepassword);
}	

function rchangepassword(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function videocan2(num){ PostStr=num;Post(Urls,"videocan2",PostStr,rvideocan2);}
function rvideocan2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function videopub2(num){PostStr=num;Post(Urls,"videopub2",PostStr,rvideopub2);}
function rvideopub2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function deptcategoryadd(parentid,level)
{
		var param1=parentid;
		var param2=document.getElementById("deptid").value;
		var param3=document.getElementById("name"+level).value;
		var param4=document.getElementById("orderid"+level).value;
		var param5=level;
		if(param2==""){alert("部门ID不能为空");return false;}
		if(param3==""){alert("分类名不能为空");return false;}
		if(param4==""){alert("序列不能为空");return false;}
		PostStr=param1+PostDiv+param2+PostDiv+param3+PostDiv+param4+PostDiv+param5;
		Post(Urls,"deptcategoryadd",PostStr,rdeptcategoryadd);
}

function rdeptcategoryadd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){alert("添加成功");window.location.href="deptcategory.php";return false; }} else {alert("点太快了，休息下。");}}}

/* 部门分类*/
function selectdepttype(id)
{
	var depttype=document.getElementById("contenttype").value;
	document.location.href="deptcategoryinsert.php?id="+id+"&type="+depttype;
}
function selectfirst(id)
{
	var depttype=document.getElementById("contenttype").value;
	var one=document.getElementById("one").value;
	document.getElementById("second").style.display="block";
	document.location.href="deptcategoryinsert.php?id="+id+"&type="+depttype+"&p1id="+one;
}
function selectsecond(id)
{
	var depttype=document.getElementById("contenttype").value;
	var one=document.getElementById("one").value;
	var two=document.getElementById("two").value;
	document.getElementById("second").style.display="block";
	document.getElementById("third").style.display="block";
	document.location.href="deptcategoryinsert.php?id="+id+"&type="+depttype+"&p1id="+one+"&p2id="+two;
}




function activitiesadd()
{
		var title=document.getElementById("title").value;
		var starttime=document.getElementById("starttime").value;
		var endtime=document.getElementById("endtime").value;
		var content=document.getElementById("content").value;
		if(title==""){alert("标题不能为空");return false;}
		if(starttime==""){alert("开始时间不能为空");return false;}
		if(endtime==""){alert("结束时间不能为空");return false;}	
		if(content==""){alert("内容不能为空");return false;}	
		var upfile=document.getElementById("upfile").value;
		if(upfile!="")
		{
			var upload_file_extension=upfile.substring(upfile.length-4,upfile.length);
			if(upload_file_extension.toLowerCase()!=".doc"&&upload_file_extension.toLowerCase()!=".zip"&&upload_file_extension.toLowerCase()!=".rar"&&upload_file_extension.toLowerCase()!=".ppt"&&upload_file_extension.toLowerCase()!=".xls"){alert("上传文件类型错误");return false;}
		
		}
		document.uploadfiles.submit();			
}


function activitiescan(num){PostStr=num;Post(Urls,"activitiescan",PostStr,ractivitiescan);}
function ractivitiescan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function activitiespub(num){PostStr=num;Post(Urls,"activitiespub",PostStr,ractivitiespub);}
function ractivitiespub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function activitiesdel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"activitiesdel",PostStr,ractivitiesdel);}
function ractivitiesdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function tgcheck()
{
	var issendfq=document.forms["uploadfiles"].issendfq;
	if(issendfq.checked==true)
	{
		document.getElementById("sendfq").value="1"
	}
	else
	{
		document.getElementById("sendfq").value="0"
	}
}
function tgadd()
{
		var title=document.getElementById("title").value;
		var starttime=document.getElementById("starttime").value;
		var endtime=document.getElementById("endtime").value;
		var price=document.getElementById("price").value;
		if(title==""){alert("标题不能为空");return false;}
		if(starttime==""){alert("开始时间不能为空");return false;}
		if(endtime==""){alert("结束时间不能为空");return false;}
		if(price==""){alert("价格不能为空");return false;}
		var uptype=document.getElementById("uptype").value
		if(uptype!="tgupdate")
		{
			var upfile1=document.getElementById("upfile1").value;
			if(upfile1==""){alert("上传图片不能为空");return false;}	
		  	var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		document.uploadfiles.submit();			
}

function tgcan(num){PostStr=num;Post(Urls,"tgcan",PostStr,rtgcan);}
function rtgcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function tgpub(num){PostStr=num;Post(Urls,"tgpub",PostStr,rtgpub);}
function rtgpub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function tgdel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"tgdel",PostStr,rtgdel);}
function rtgdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function shopcan(num){PostStr=num;Post(Urls,"shopcan",PostStr,rshopcan);}
function rshopcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function shoppub(num){PostStr=num;Post(Urls,"shoppub",PostStr,rshoppub);}
function rshoppub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function shopdel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"shopdel",PostStr,rshopdel);}
function rshopdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function smgadshow(num)
{
		for(var i=1;i<=4;i++)
		{
			document.getElementById("smgadshow"+i).style.display="none";
		}
		if(num==1)
		{
			document.getElementById("smgadshow1").style.display="inline";
		}
		if(num==3)
		{
			document.getElementById("smgadshow2").style.display="inline";
			document.getElementById("smgadshow3").style.display="inline";
			document.getElementById("smgadshow4").style.display="inline";
		}	
		
		document.getElementById("adtype").value=num;
}

function smgadsize(num)
{
		document.getElementById("smgadsize2").value=num;
}




function smgadadd()
{
		var title=document.getElementById("title").value;
		if(title==""){alert("标题不能为空");return false;}

		var upfile=document.getElementById("upfile").value;
		if(upfile==""){alert("图片不能为空");return false;}
  	var upload_file_extension=upfile.substring(upfile.length-4,upfile.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		
		var adtype=document.getElementById("adtype").value;
		if(adtype=="3")
		{
			var description=document.getElementById("description").value;
			var x=document.getElementById("x").value;
			var y=document.getElementById("y").value;
			var height=document.getElementById("height").value;
			var width=document.getElementById("width").value;
			if(description==""){alert("广告文字不能为空");return false;}
			if(x==""){alert("X不能为空");return false;}
			if(y==""){alert("Y不能为空");return false;}
			if(height==""){alert("高不能为空");return false;}
			if(width==""){alert("宽不能为空");return false;}
			
		}
		document.uploadfiles.submit();			
}

function smgaddel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"smgaddel",PostStr,rsmgaddel);}
function rsmgaddel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function smgadcan(num){PostStr=num;Post(Urls,"smgadcan",PostStr,rsmgadcan);}
function rsmgadcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function smgadpub(num){PostStr=num;Post(Urls,"smgadpub",PostStr,rsmgadpub);}
function rsmgadpub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function smgadupdate()
{
		var title=document.getElementById("title").value;
		if(title==""){alert("标题不能为空");return false;}

		var upfile=document.getElementById("upfile").value;
		if(upfile!="")
		{
  		var upload_file_extension=upfile.substring(upfile.length-4,upfile.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		var adtype=document.getElementById("adtype").value;
		if(adtype=="3")
		{
			var description=document.getElementById("description").value;
			var x=document.getElementById("x").value;
			var y=document.getElementById("y").value;
			var height=document.getElementById("height").value;
			var width=document.getElementById("width").value;
			if(description==""){alert("广告文字不能为空");return false;}
			if(x==""){alert("X不能为空");return false;}
			if(y==""){alert("Y不能为空");return false;}
			if(height==""){alert("高不能为空");return false;}
			if(width==""){alert("宽不能为空");return false;}
			
		}
		document.uploadfiles.submit();			
}



function photocomment(num){if(!window.confirm("确定要删除吗")){return false;};PostStr=num;Post(Urls,"photocomment",PostStr,rphotocomment);}
function rphotocomment(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function magpub(num){PostStr=num;Post(Urls,"magpub",PostStr,rmagpub);}
function rmagpub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function magcan(num){PostStr=num;Post(Urls,"magcan",PostStr,rmagcan);}
function rmagcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function magdel1(num){if(!window.confirm("确定要删除吗")){return false;}; PostStr=num;Post(Urls,"magdel1",PostStr,rmagdel1);}
function rmagdel1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function magback1(num){if(!window.confirm("确定要退回吗")){return false;};  PostStr=num;Post(Urls,"magback1",PostStr,rmagback1);}
function rmagback1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function magpriorityall1(){		var pid="";	var pp="";	var PostDiv1="abc";	var PostDiv2="def";	PostStr="";	for(var i=1;i<=20;i++)	{			if(document.getElementById("priority"+i))			{				pid=document.getElementById("priorityh"+i).value;				pp=document.getElementById("priority"+i).value;				if(pp==""){pp="100";}				PostStr=PostStr+pid+PostDiv1+pp+PostDiv2;			}	}	Post(Urls,"magpriorityall1",PostStr,rmagpriorityall1);}
function rmagpriorityall1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function magpriorityall(dept){	if(!window.confirm("编辑优先级")){return false;}	if(dept=="all"){	magpriorityall1();}	if(dept=="part"){	magpriorityall2();}}
function rmagpriorityall1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function magadd()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("commentable").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("keyword").value;
		var param7=document.getElementById("upfile1").value;
		var param8=document.getElementById("upfile2").value;
		var param9=document.getElementById("description").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
		if(param5==""){alert("关键词不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile1").value;
		if(upfile1==""){alert("上传图片不能为空");return false;}
		if(upfile1!=""){
	  var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		
		var upfile2=document.getElementById("upfile2").value;
		if(upfile2==""){alert("上传电子杂志不能为空");return false;}
		if(upfile2!=""){
	  upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);
		if(upload_file_extension.toLowerCase()!=".exe"){alert("上传电子杂志类型错误");return false;}
		}		
		document.uploadfiles.submit();			

}


function magpub2(num){PostStr=num;Post(Urls,"magpub2",PostStr,rmagpub2);}
function rmagpub2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function magcan2(num){PostStr=num;Post(Urls,"magcan2",PostStr,rmagcan2);}
function rmagcan2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}


function magdel2(num){if(!window.confirm("确定要删除吗")){return false;};	PostStr=num;Post(Urls,"magdel2",PostStr,rmagdel2);}
function rmagdel2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function magadd2()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("iscommentable").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("keyword").value;
		var param7=document.getElementById("upfile1").value;
		var param8=document.getElementById("upfile2").value;
		var param9=document.getElementById("description").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		var isshowongrouppage=0;
		if(document.getElementById("isshowongrouppage").checked){isshowongrouppage=1;}
		if(isshowongrouppage==1&&param4==""){alert("分类不能为空");return false;}
		if(param5==""){alert("关键词不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile1").value;
		if(upfile1==""){alert("上传图片不能为空");return false;}
	  var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		
		var upfile2=document.getElementById("upfile2").value;
		if(upfile2==""){alert("上传视频不能为空");return false;}
	  upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);
		if(upload_file_extension.toLowerCase()!=".exe"){alert("上传电子杂志类型错误");return false;}
		document.uploadfiles.submit();			

}





function magupdate()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("iscommentable").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("keyword").value;
		var param7=document.getElementById("upfile1").value;
		var param8=document.getElementById("upfile2").value;
		var param9=document.getElementById("description").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
		if(param5==""){alert("关键词不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile1").value;
		if(upfile1!="")
		{
	  	var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		var upfile2=document.getElementById("upfile2").value;
		if(upfile2!="")
		{
	  	upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);
			if(upload_file_extension.toLowerCase()!=".exe"){alert("上传电子杂志类型错误");return false;}
		}
		document.uploadfiles.submit();			

}


function magcomment(num){if(!window.confirm("确定要删除吗")){return false;}; PostStr=num;Post(Urls,"magcomment",PostStr,rmagcomment);}
function rmagcomment(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}






function magupdate2()
{
	
		var param1=document.getElementById("title").value;
		var param2=document.getElementById("priority").value;
		var param3=document.getElementById("iscommentable").value;
		var param4=document.getElementById("param4").value;
		var param5=document.getElementById("keyword").value;
		var param7=document.getElementById("upfile1").value;
		var param8=document.getElementById("upfile2").value;
		var param9=document.getElementById("description").value;
		
		if(param1==""){alert("标题不能为空");return false;}
		var isshowongrouppage=0;
		if(document.getElementById("isshowongrouppage").checked){isshowongrouppage=1;}
		if(isshowongrouppage==1&&param4==""){alert("分类不能为空");return false;}
		if(param5==""){alert("关键词不能为空");return false;}
		if(param9==""){alert("描述不能为空");return false;}
		
		var upfile1=document.getElementById("upfile1").value;
		if(upfile1!="")
		{
	  var upload_file_extension=upfile1.substring(upfile1.length-4,upfile1.length);
		if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		var upfile2=document.getElementById("upfile2").value;
		if(upfile2!="")
		{
	  upload_file_extension=upfile2.substring(upfile2.length-4,upfile2.length);
		if(upload_file_extension.toLowerCase()!=".exe"){alert("上传电子杂志类型错误");return false;}
		}
		document.uploadfiles.submit();			

}




function catype(ctp)
{
	 document.getElementById('c1').src='category1.php?ctype='+ctp;
	 document.getElementById('c2').src='';
	 document.getElementById('c3').src='';

}


function catype1(num)
{
	for(var i=1;i<=30;i++)
	{
	 if(document.getElementById('name1'+i)){document.getElementById('name1'+i).style.color='#000000';}
	}
	document.getElementById('name1'+num).style.color='#FF0000';
	var ctp=document.getElementById('ctype').value;
	var pid=document.getElementById('id1'+num).value;
	window.parent.document.getElementById('c2').src='category2.php?ctype='+ctp+'&pid='+pid;
	window.parent.document.getElementById('c3').src='';
}

function catype2(num)
{
	for(var i=1;i<=30;i++)
	{
	 if(document.getElementById('name2'+i)){document.getElementById('name2'+i).style.color='#000000';}
	}
	document.getElementById('name2'+num).style.color='#FF0000';
	var ctp=document.getElementById('ctype').value;
	var pid=document.getElementById('id2'+num).value;
	var tid=document.getElementById('topid').value;
	window.parent.document.getElementById('c3').src='category3.php?ctype='+ctp+'&pid='+pid+'&tid='+tid;
}

function catadd1(ctype){
	var cateaddname1=document.getElementById('cateaddname1').value;
	var cateaddorderno1=document.getElementById('cateaddorderno1').value;
	if(cateaddname1==""||cateaddorderno1=="")	{		alert("名称和序号不能为空")		}
	PostStr=ctype+PostDiv+cateaddname1+PostDiv+cateaddorderno1;
	Post(Urls,"catadd1",PostStr,rcatadd1);
}

function rcatadd1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function cataupdate1(id,num,ctype)
{
	var name=document.getElementById('name1'+num).value;
	var orderno=document.getElementById('orderno1'+num).value;
	PostStr=ctype+PostDiv+id+PostDiv+name+PostDiv+orderno;
	Post(Urls,"cataupdate1",PostStr,rcataupdate1);
	
}
function rcataupdate1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function catadd2(ctype){
	var cateaddname2=document.getElementById('cateaddname2').value;
	var cateaddorderno2=document.getElementById('cateaddorderno2').value;
	var parentid=document.getElementById('parentid').value;
	var topid=document.getElementById('topid').value;
	if(cateaddname2==""||cateaddorderno2=="")	{		alert("名称和序号不能为空")		}
	PostStr=ctype+PostDiv+cateaddname2+PostDiv+cateaddorderno2+PostDiv+parentid+PostDiv+topid;
	Post(Urls,"catadd2",PostStr,rcatadd2);
}

function rcatadd2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function cataupdate2(id,num,ctype)
{
	var name=document.getElementById('name2'+num).value;
	var orderno=document.getElementById('orderno2'+num).value;
	PostStr=ctype+PostDiv+id+PostDiv+name+PostDiv+orderno;
	Post(Urls,"cataupdate2",PostStr,rcataupdate2);
	
}
function rcataupdate2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function catadd3(ctype){
	var cateaddname3=document.getElementById('cateaddname3').value;
	var cateaddorderno3=document.getElementById('cateaddorderno3').value;
	var parentid=document.getElementById('parentid').value;
	var topid=document.getElementById('topid').value;
	if(cateaddname3==""||cateaddorderno3=="")	{		alert("名称和序号不能为空")		}
	PostStr=ctype+PostDiv+cateaddname3+PostDiv+cateaddorderno3+PostDiv+parentid+PostDiv+topid;

	Post(Urls,"catadd3",PostStr,rcatadd3);
}

function rcatadd3(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function cataupdate3(id,num,ctype)
{
	var name=document.getElementById('name3'+num).value;
	var orderno=document.getElementById('orderno3'+num).value;
	PostStr=ctype+PostDiv+id+PostDiv+name+PostDiv+orderno;
	Post(Urls,"cataupdate3",PostStr,rcataupdate3);
	
}
function rcataupdate3(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function catadel1(id,ctype)
{
	if(!window.confirm("确定要删除吗")){return false;}; 
	PostStr=ctype+PostDiv+id;
	Post(Urls,"catadel1",PostStr,rcatadel1);
}
function rcatadel1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){	 window.parent.document.getElementById('c2').src=''; window.parent.document.getElementById('c3').src='';window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function catadel2(id,ctype)
{
	if(!window.confirm("确定要删除吗")){return false;}; 
	PostStr=ctype+PostDiv+id;
	Post(Urls,"catadel2",PostStr,rcatadel2);
}
function rcatadel2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){	 window.parent.document.getElementById('c3').src='';window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function catadel3(id,ctype)
{
	if(!window.confirm("确定要删除吗")){return false;}; 
	PostStr=ctype+PostDiv+id;
	Post(Urls,"catadel3",PostStr,rcatadel3);
}
function rcatadel3(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){	window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function ptype(ptp)
{
	 document.getElementById('c1').src='positioninsert.php?ptype='+ptp;

}



function positionadd()
{
		var name=document.getElementById("name").value;
		var description=document.getElementById("description").value;
		var param4=document.getElementById("param4").value;
		var ptype=document.getElementById("ptype").value
		if(name==""){alert("名称不能为空");return false;}
		if(description==""){alert("描述不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
		PostStr=ptype+PostDiv+name+PostDiv+description+PostDiv+param4;
		Post(Urls,"positionadd",PostStr,rpositionadd);
}

function rpositionadd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.parent.location.href="position.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function positiondel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"positiondel",PostStr,rpositiondel);}
function rpositiondel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function positionupdate()
{
		var name=document.getElementById("name").value;
		var description=document.getElementById("description").value;
		var param4=document.getElementById("param4").value;
		var pid=document.getElementById("pid").value
		if(name==""){alert("名称不能为空");return false;}
		if(description==""){alert("描述不能为空");return false;}
		if(param4==""){alert("分类不能为空");return false;}
		PostStr=pid+PostDiv+name+PostDiv+description+PostDiv+param4;
		Post(Urls,"positionupdate",PostStr,rpositionupdate);
}

function rpositionupdate(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.href="position.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function menuadd()
{
		var name=document.getElementById("name").value;
		var description=document.getElementById("description").value;
		if(name==""){alert("名称不能为空");return false;}
		if(description==""){alert("描述不能为空");return false;}
		PostStr=name+PostDiv+description;
		Post(Urls,"menuadd",PostStr,rmenuadd);
}

function rmenuadd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function menuupdate(id,num)
{
		var name=document.getElementById("name"+num).value;
		var description=document.getElementById("description"+num).value;
		if(name==""){alert("名称不能为空");return false;}
		if(description==""){alert("描述不能为空");return false;}
		PostStr=id+PostDiv+name+PostDiv+description;
		Post(Urls,"menuupdate",PostStr,rmenuupdate);
}

function rmenuupdate(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function menudel(id)
{
		if(!window.confirm("确定要删除吗")){return false;}; 
		PostStr=id;
		Post(Urls,"menudel",PostStr,rmenudel);
}

function rmenudel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function mtype1(num)
{
	for(var i=1;i<=30;i++)
	{
	 if(document.getElementById('name1'+i)){document.getElementById('name1'+i).style.color='#000000';}
	}
	document.getElementById('name1'+num).style.color='#FF0000';
	var menuid=document.getElementById('menuid').value;
	var pid=document.getElementById('id1'+num).value;
	window.parent.document.getElementById('c2').src='menu2.php?menuid='+menuid+'&pid='+pid;
	window.parent.document.getElementById('c3').src='';
}


function mtype2(num)
{
	for(var i=1;i<=30;i++)
	{
	 if(document.getElementById('name2'+i)){document.getElementById('name2'+i).style.color='#000000';}
	}
	document.getElementById('name2'+num).style.color='#FF0000';
	var menuid=document.getElementById('menuid').value;
	var pid=document.getElementById('id2'+num).value;
	var tid=document.getElementById('topid').value;
	window.parent.document.getElementById('c3').src='menu3.php?menuid='+menuid+'&pid='+pid+'&tid='+tid;
}



function menuadd1(menuid){
	var menuaddname1=document.getElementById('menuaddname1').value;
	var menuaddorderno1=document.getElementById('menuaddorderno1').value;
	var menuaddtarget1=document.getElementById('menuaddtarget1').value;
	var menuaddurl1=document.getElementById('menuaddurl1').value;
	if(menuaddname1==""||menuaddorderno1=="")	{		alert("名称和序号不能为空");		return false;	}
	PostStr=menuid+PostDiv+menuaddname1+PostDiv+menuaddorderno1+PostDiv+menuaddtarget1+PostDiv+menuaddurl1;
	Post(Urls,"menuadd1",PostStr,rmenuadd1);
}

function rmenuadd1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;   if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function menudel1(id)
{
	if(!window.confirm("确定要删除吗")){return false;}; 
	PostStr=id;
	Post(Urls,"menudel1",PostStr,rmenudel1);
}
function rmenudel1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){	 window.parent.document.getElementById('c2').src=''; window.parent.document.getElementById('c3').src='';window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function menuupdate1(id,num)
{
	var name=document.getElementById('name1'+num).value;
	var orderno=document.getElementById('orderno1'+num).value;
	var target=document.getElementById('target1'+num).value;
	var url=document.getElementById('url1'+num).value;
	PostStr=id+PostDiv+name+PostDiv+orderno+PostDiv+target+PostDiv+url;
	Post(Urls,"menuupdate1",PostStr,rmenuupdate1);
	
}
function rmenuupdate1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function menuadd2(menuid){
	var menuaddname2=document.getElementById('menuaddname2').value;
	var menuaddorderno2=document.getElementById('menuaddorderno2').value;
	var menuaddtarget2=document.getElementById('menuaddtarget2').value;
	var menuaddurl2=document.getElementById('menuaddurl2').value;
	
	var parentid=document.getElementById('parentid').value;
	var topid=document.getElementById('topid').value;
	
	if(menuaddname2==""||menuaddorderno2=="")	{		alert("名称和序号不能为空");	return false;		}
	PostStr=menuid+PostDiv+menuaddname2+PostDiv+menuaddorderno2+PostDiv+menuaddtarget2+PostDiv+menuaddurl2+PostDiv+parentid+PostDiv+topid;
	Post(Urls,"menuadd2",PostStr,rmenuadd2);
}

function rmenuadd2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;    if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function menudel2(id)
{
	if(!window.confirm("确定要删除吗")){return false;}; 
	PostStr=id;
	Post(Urls,"menudel2",PostStr,rmenudel2);
}
function rmenudel2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){	 window.parent.document.getElementById('c3').src='';window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function menuupdate2(id,num)
{
	var name=document.getElementById('name2'+num).value;
	var orderno=document.getElementById('orderno2'+num).value;
	var target=document.getElementById('target2'+num).value;
	var url=document.getElementById('url2'+num).value;
	PostStr=id+PostDiv+name+PostDiv+orderno+PostDiv+target+PostDiv+url;
	Post(Urls,"menuupdate2",PostStr,rmenuupdate2);
	
}
function rmenuupdate2(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function menuadd3(menuid){
	var menuaddname3=document.getElementById('menuaddname3').value;
	var menuaddorderno3=document.getElementById('menuaddorderno3').value;
	var menuaddtarget3=document.getElementById('menuaddtarget3').value;
	var menuaddurl3=document.getElementById('menuaddurl3').value;
	
	var parentid=document.getElementById('parentid').value;
	var topid=document.getElementById('topid').value;
	
	if(menuaddname3==""||menuaddorderno3=="")	{		alert("名称和序号不能为空");	 return false;	}
	PostStr=menuid+PostDiv+menuaddname3+PostDiv+menuaddorderno3+PostDiv+menuaddtarget3+PostDiv+menuaddurl3+PostDiv+parentid+PostDiv+topid;
	Post(Urls,"menuadd3",PostStr,rmenuadd3);
}

function rmenuadd3(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;   if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function menudel3(id)
{
	if(!window.confirm("确定要删除吗")){return false;}; 
	PostStr=id;
	Post(Urls,"menudel3",PostStr,rmenudel3);
}
function rmenudel3(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){	window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function menuupdate3(id,num)
{
	var name=document.getElementById('name3'+num).value;
	var orderno=document.getElementById('orderno3'+num).value;
	var target=document.getElementById('target3'+num).value;
	var url=document.getElementById('url3'+num).value;
	PostStr=id+PostDiv+name+PostDiv+orderno+PostDiv+target+PostDiv+url;
	Post(Urls,"menuupdate3",PostStr,rmenuupdate3);
	
}
function rmenuupdate3(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){	window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}


function voteadd2()
{
	
		var title=document.getElementById("title").value;
		if(title==""){alert("标题不能为空");return false;}

		var upfile0=document.getElementById("upfile0").value;
		if(upfile0!="")
		{
	  	var upload_file_extension=upfile0.substring(upfile0.length-4,upfile0.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		
		var param42=document.getElementById("param42").value;
		if(param42==""){alert("分类不能为空");return false;}
		
		var endtime=document.getElementById("endtime").value;
		if(endtime==""){alert("结束日期不能为空");return false;}
		
		var content1=document.getElementById("content1").value;
		if(content1==""){alert("投票内容1不能为空");return false;}

		if(document.getElementById("votetypeb").checked)
		{
			 if(document.getElementById("upfile1").value==""){alert("内容图片1不能为空");return false;}
			 for(var i=2;i<=10;i++)
			 {
			 		if(document.getElementById("content"+i).value!=""&&document.getElementById("upfile"+i).value==""){alert("内容图片"+i+"不能为空");return false;}
			 		upfile=document.getElementById("upfile"+i).value;
					if(document.getElementById("upfile"+i).value!="")
					{
	  				upload_file_extension=upfile.substring(upfile.length-4,upfile.length);
						if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片"+i+"类型错误");return false;}
		 			}
			 		
			 }
			 
			 
		}
		document.uploadfiles.submit();			



}

function voteupdate2()
{
	
		var title=document.getElementById("title").value;
		if(title==""){alert("标题不能为空");return false;}

		var upfile0=document.getElementById("upfile0").value;
		if(upfile0!="")
		{
	  	var upload_file_extension=upfile0.substring(upfile0.length-4,upfile0.length);
			if(upload_file_extension.toLowerCase()!=".png"&&upload_file_extension.toLowerCase()!=".jpg"&&upload_file_extension.toLowerCase()!=".gif"){alert("上传图片类型错误");return false;}
		}
		
		
		var endtime=document.getElementById("endtime").value;
		if(endtime==""){alert("结束日期不能为空");return false;}
		
		document.uploadfiles.submit();			
}

function voteitemadds2(num2)
{
		if(document.getElementById("content"+num2).value==""){alert("投票内容"+num2+"不能为空");return false;}
		document.getElementById("voteitemadd2").value=num2;
		document.uploadfiles.submit();			
		
}

function voteitemupdate2(num,num2)
{
		if(document.getElementById("content"+num2).value==""){alert("投票内容"+num2+"不能为空");return false;}
		document.getElementById("uptype").value=num;
		document.getElementById("voteitemid2").value=num2;
		document.uploadfiles.submit();			
		
}


function linkdel(num){if(!window.confirm("确定要删除吗")){return false;};PostStr=num;Post(Urls,"linkdel",PostStr,rlinkdel);}
function rlinkdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}



function linkadd()
{
		var name=document.getElementById("name").value;
		var link=document.getElementById("link").value;
		var target=document.getElementById("target").value;
		var description=document.getElementById("description").value;
		var priority=document.getElementById("priority").value;
		var param42=document.getElementById("param42").value;
		if(name==""){alert("标题不能为空");return false;}
		if(link==""){alert("链接不能为空");return false;}
		if(description==""){alert("描述不能为空");return false;}
		if(param42==""){alert("分类不能为空");return false;}
		if(priority==""){priority="100"}
		PostStr=name+PostDiv+link+PostDiv+description+PostDiv+param42+PostDiv+target+PostDiv+priority;
		Post(Urls,"linkadd",PostStr,rlinkadd);
}

function rlinkadd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.href="link.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function linkupdate()
{
		var name=document.getElementById("name").value;
		var link=document.getElementById("link").value;
		var target=document.getElementById("target").value;
		var description=document.getElementById("description").value;
		var priority=document.getElementById("priority").value;
		var param42=document.getElementById("param42").value;
		var id=document.getElementById("linkid").value;
		if(name==""){alert("标题不能为空");return false;}
		if(link==""){alert("链接不能为空");return false;}
		if(description==""){alert("描述不能为空");return false;}
		if(param42==""){alert("分类不能为空");return false;}
		if(priority==""){priority="100"}
		PostStr=id+PostDiv+name+PostDiv+link+PostDiv+description+PostDiv+param42+PostDiv+target+PostDiv+priority;
		Post(Urls,"linkupdate",PostStr,rlinkupdate);
}

function rlinkupdate(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.href="link.php";return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function linkpriorityall1(){		var pid="";	var pp="";	var PostDiv1="abc";	var PostDiv2="def";	PostStr="";	for(var i=1;i<=20;i++)	{			if(document.getElementById("priority"+i))			{				pid=document.getElementById("priorityh"+i).value;				pp=document.getElementById("priority"+i).value;				if(pp==""){pp="100";}				PostStr=PostStr+pid+PostDiv1+pp+PostDiv2;			}	}	Post(Urls,"linkpriorityall1",PostStr,rlinkpriorityall1);}
function rlinkpriorityall1(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function linkpriorityall(dept)
{
	if(!window.confirm("编辑优先级")){return false;}
	if(dept=="all"){	linkpriorityall1();}
}


function deptcomment(num){if(!window.confirm("确定要删除吗")){return false;}; PostStr=num;Post(Urls,"deptcomment",PostStr,rdeptcomment);}
function rdeptcomment(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function delactivitier(aid)
{
		var id=aid;
		PostStr=id;
		Post(Urls,"delactivitier",PostStr,rdelactivitier);
}
function rdelactivitier(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function deltg(tgid)
{
		var id=tgid;
		PostStr=id;
		Post(Urls,"deltg",PostStr,rdeltg);
}
function rdeltg(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function getclass1()
{
	alert(document.getElementById("selectclass").value);
}

function leaderuseradd()
{
	 	var loginname=document.getElementById("loginname").value;
	 	var rights=document.getElementById("rights").value;
		var PostStr=loginname+PostDiv+rights;
		if(PostStr==""){alert("管理员不能为空");return false;}
		Post(Urls,"leaderuseradd",PostStr,rleaderuseradd);

}

function rleaderuseradd(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="error"){alert("查无此人");return false;}if(result=="OK"){alert("添加成功");window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}

function leaderuserdel(roleid)
{
	
		if(!window.confirm("确定要删除吗")){return false;}
	 	var id=roleid;
	 	PostStr=id;
		Post(Urls,"leaderuserdel",PostStr,rleaderuserdel);

}

function rleaderuserdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="error"){alert("查无此人");return false;}if(result=="OK"){alert("删除成功");window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function leader_Login(){	
	if(document.getElementById("admin_username").value==""||document.getElementById("admin_password").value=="")
	{alert("用户名和密码不能为空");return false;}	
	document.login.submit();			
	//var LoginStr=document.getElementById("admin_username").value+PostDiv+document.getElementById("admin_password").value;	
	//AdminLoginPost(Urls,"Login",LoginStr);
}

function wtadd()
{
		var i;
		var ts=0;
		var obj=document.getElementById("problemname");
	   	if(obj.options[obj.selectedIndex].name!="judge"){
				var question=document.getElementById("question").value;
				if(question==""){alert("题目不能为空");return false;}
				var answer=document.getElementById("answer").value;
				if(answer==""){alert("答案不能为空");return false;}
				var content1=document.getElementById("content1").value;
				if(content1==""){alert("答案选项1不能为空");return false;}
		
				for(i=1;i<=4;i++)
				{
					if(document.getElementById("content"+i).value!="")
					{
							ts=ts+1;
					}
				}
				document.getElementById("ts").value=ts;	
			}
		document.uploadfiles.submit();			
}

function xmadd()
{
		var i;
		var ts=0;
	
		var problem=document.getElementById("problem").value;
		if(problem==""){alert("项目名不能为空");return false;}
		var starttime=document.getElementById("starttime").value;
		if(starttime==""){alert("开始时间不能为空");return false;}
		var endtime=document.getElementById("endtime").value;
		if(endtime==""){alert("结束时间不能为空");return false;}
		var obj=document.getElementById("uselimit");
		if(obj.options[obj.selectedIndex].value=="havelimie"){
			var totallimit=document.getElementById("totallimit").value;
			if(totallimit==""){alert("总时限不能为空");return false;}
			var singlelimit=document.getElementById("singlelimit").value;
			if(singlelimit==""){alert("每题时限不能为空");return false;}
		}
		var point=document.getElementById("point").value;
		if(point==""){alert("每题分值不能为空");return false;}
		var problemtype=document.getElementById("endtime").value;
		if(problemtype==""){alert("试题类型不能为空");return false;}
		document.uploadfiles.submit();			
}

function problemdel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"problemdel",PostStr,rproblemdel);}
function rproblemdel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function questiondel(num){if(!window.confirm("确定要删除吗")){return false;};  PostStr=num;Post(Urls,"questiondel",PostStr,rquestiondel);}
function rquestiondel(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText;  if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function problemcan(num){PostStr=num;Post(Urls,"problemcan",PostStr,rproblemcan);}
function rproblemcan(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false;}} else {alert("服务器忙，请刷新后重试。");}}}

function problempub(num){PostStr=num;Post(Urls,"problempub",PostStr,rproblempub);}
function rproblempub(){if (showhttp.readyState == 4) {if (showhttp.status == 200) {var result = showhttp.responseText; if(result=="OK"){window.location.reload();return false; }} else {alert("服务器忙，请刷新后重试。");}}}
	
function typep(){
	
	 var obj=document.getElementById("problemname");
   if(obj.options[obj.selectedIndex].name=="judge"){
   	document.getElementById("dan").style.display="none";
   	for(var i=1;i<=4;i++){
   		document.getElementById("xux"+i).style.display="none";
  	}
  	document.getElementById("shifei").style.display="inline";
  	document.getElementById("shuoming").style.display="inline";
  }else{
  	document.getElementById("dan").style.display="inline";
   	for(var i=1;i<=4;i++){
   		document.getElementById("xux"+i).style.display="inline";
  	}
  	document.getElementById("shifei").style.display="none";
  	document.getElementById("shuoming").style.display="none";
  }
}

function belimit(){
	
	var obj=document.getElementById("uselimit");
	if(obj.options[obj.selectedIndex].value=="nolimit"){
		document.getElementById("tlimit").style.display="none";
		document.getElementById("elimit").style.display="none";
	}else{
		document.getElementById("tlimit").style.display="inline";
		document.getElementById("elimit").style.display="inline";
	}
}