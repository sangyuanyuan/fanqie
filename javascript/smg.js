//新闻相关js函数

function PostComment()
{
	var commenter;
	var comment;
	commenter = document.getElementById("commenter").value;
	comment = document.getElementById("commentcontent").value;
	if (commenter == '' || commenter == null){
		 
	  alert('评论人不能为空！');
	  return false;
  }
	if (comment == '' || comment == null) 
	{
		alert('评论内容不能为空！');
		
	  return false;
  }
  document.commentform.submit();
  return true;
}

function CheckWriteLetter()
{
	var writer = document.getElementById('writer').value;
	var stitle = document.getElementById('lettertitle').value;
	var content = document.getElementById('lettercontent').value;
	
	if(writer == '' || writer == null){
		alert('昵称不能为空');
		return false;
	}
	if(stitle == '' || stitle == null){
		alert('标题不能为空');
		return false;
	}
	if(content == '' || content == null){
		alert('内容不能为空');
		return false;
	}
	return true;
}

function jumppage(urlprex,pageindex)
{

  var url1=urlprex;
	var page=pageindex;
	var surl=url1+page;
	window.location.href=surl;
}


//首页Tab切换
function ChangeNews(newstype)
{
	var qnewstab = document.getElementById('quicknews');
	var pnewstab = document.getElementById('picnews');
	
	var qtab = document.getElementById("tab1");
	var ptab = document.getElementById("tab2");
	//alert('test');
	if(newstype=='quicknews')
	{
		qtab.className='btn1bg';
		ptab.className='btn1';
		qnewstab.style.display='block';
    pnewstab.style.display='none';
    
	}else if (newstype=='picnews')
	{
		qtab.className='btn1';
		ptab.className='btn1bg';		
		qnewstab.style.display='none';
    pnewstab.style.display='block';
	}
}

//首页切换广告和视频
function ChangeAdTab(num)
{
	document.getElementById("ad1").style.display='none';
	document.getElementById("ad2").style.display='none';
	document.getElementById("ad3").style.display='none';
	document.all("index1").style.color='#000000';
	document.all("index2").style.color='#000000';
	document.all("index3").style.color='#000000';
	document.all("index"+num).style.color='red';
	document.getElementById("ad"+num).style.display='block';
}

//首页切换游泳池和星行动
function ChangeStTab(num)
{
	document.getElementById("st1").style.display='none';
	document.getElementById("st2").style.display='none';
	document.getElementById("sta1").style.color='black';
	document.getElementById("sta2").style.color='black';
	document.getElementById("st"+num).style.display='inline';
	document.getElementById("sta"+num).style.color='red';
}

//首页切换股市行情和天气预报
function ChangeGtTab(num)
{
	document.getElementById("gt1").style.display='none';
	document.getElementById("gt2").style.display='none';
	document.getElementById("gt"+num).style.display='inline';
}

//首页切换领导在线的tab
function ChangeLeaderTab(num)
{
	var tab1 = document.getElementById("leadertab1");
	var tab2 = document.getElementById("leadertab2");
	var tab3 = document.getElementById("leadertab3");
	var tab4 = document.getElementById("leadertab4");
	
	var box1 = document.getElementById("leaderbox1");
	var box2 = document.getElementById("leaderbox2");
	var box3 = document.getElementById("leaderbox3");
	var box4 = document.getElementById("leaderbox4");
	
	tab1.className = 'header';
	tab2.className = 'header';
	tab3.className = 'header';
	tab4.className = 'header';
	
	box1.style.display = 'none';
	box2.style.display = 'none';
	box3.style.display = 'none';
	box4.style.display = 'none';
	
	var box = document.getElementById("leaderbox" + num);
	box.style.display = 'block';
	
	var tab = document.getElementById("leadertab" + num);
	tab.className = 'headeractive';
}

//切换评论页的tab切换
function ChangeCommentTab(num)
{
	var tab1 = document.getElementById("c_titel1");
	var tab2 = document.getElementById("c_titel2");
	var tab3 = document.getElementById("c_titel3");
	tab1.className = 'itemnoactive';
	tab2.className = 'itemnoactive';
	tab3.className = 'itemnoactive';	
	var tab = document.getElementById("c_titel" + num);
	tab.className = 'itemactive';	
	
	
	
}

//首页博客、社区和风向标的Tab切换
function ChangeBCWTab(num)
{
	document.getElementById("b1").style.display="none";
	document.getElementById("b2").style.display="none";
	document.getElementById("b3").style.display="none";
	document.getElementById("b"+num).style.display="inline";
	
	document.getElementById("a1").style.background="url(/images/bg/index_tright_title_bg.jpg) no-repeat";
	document.getElementById("a2").style.background="url(/images/bg/index_tright_title_bg.jpg) no-repeat";
	document.getElementById("a3").style.background="url(/images/bg/index_tright_title_bg.jpg) no-repeat";
	document.getElementById("a"+num).style.background="url(/images/bg/index_tright_A_bg.jpg) no-repeat";

	document.getElementById("c1").style.color="#ffffff";
	document.getElementById("c2").style.color="#ffffff";
	document.getElementById("c3").style.color="#ffffff";
	document.getElementById("c"+num).style.color="#05B7C1";
}

//首页新闻、栏目和部门的Tab切换
function ChangeNPDTab(num)
{
	document.getElementById("d1").style.display="none";
	document.getElementById("d2").style.display="none";
	document.getElementById("d3").style.display="none";
	document.getElementById("d"+num).style.display="inline";
}

//首页每日一搏、每日一播的Tab切换
function ChangeEveryDayTab(num)
{
	document.getElementById("e1").style.display="none";
	document.getElementById("e2").style.display="none";
	document.getElementById("e"+num).style.display="inline";
	
	document.getElementById("everyday1").style.background="url(/images/bg/everydayvideo.jpg) no-repeat";
	document.getElementById("everyday2").style.background="url(/images/bg/everydayvideo.jpg) no-repeat";
	document.getElementById("everyday"+num).style.background="url(/images/bg/everydayblog.jpg) no-repeat";
}

//部门网站tab的切换
function ChangeDepartTab(num)
{
	document.getElementById("a1").style.display="none";
	document.getElementById("a2").style.display="none";
	document.getElementById("a3").style.display="none";
	document.getElementById("a"+num).style.display="inline";
	
	document.getElementById("title1").style.background="url('/images/inner/tdli03_2.gif') no-repeat";
	document.getElementById("title2").style.background="url('/images/inner/tdli03_2.gif') no-repeat";
	document.getElementById("title3").style.background="url('/images/inner/tdli03_2.gif') no-repeat";
	document.getElementById("title"+num).style.background="url('/images/inner/tdli03.gif') no-repeat";
}



//显示、隐藏领导对话回复
function ShowDialogAnswer(aid)
{
	var an = document.getElementById("answer"+aid);
	if (an.style.display == 'none')
	{
		an.style.display ='block';	
	}else
	{
		an.style.display ='none';	
	}
}


//取COOKIE
function RequestCookies(cookieName, dfltValue)
{
    var lowerCookieName = cookieName.toLowerCase();
    var cookieStr = document.cookie;
    if (cookieStr == "")
    {
        return dfltValue;
    }
    var cookieArr = cookieStr.split("; ");
    var pos = -1;
    for (var i=0; i<cookieArr.length; i++)
    {
        pos = cookieArr[i].indexOf("=");
        if (pos > 0)
        {
            if (cookieArr[i].substring(0, pos).toLowerCase() == lowerCookieName)
            {
                return unescape(cookieArr[i].substring(pos+1, cookieArr[i].length));
            }
        }
    }
    return dfltValue;
}

function test()
{
	alert('test');
}
//logout
if(window.XMLHttpRequest){showhttp = new XMLHttpRequest();if (showhttp.overrideMimeType) {showhttp.overrideMimeType('text/xml');}}	else if (window.ActiveXObject){try {showhttp = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) {try {showhttp = new ActiveXObject("Microsoft.XMLHTTP");} catch (e) {}}}
//function logout(){ var Urls='/admin/admin.post.php'; Post(Urls,"logout","logout",rlogout);}
function Post(url,section,mvalue,rpost){	var mdata;		if (!showhttp) { window.alert("不能创建XMLHttpRequest对象实例.");return false;	}		showhttp.open("POST", url, true);		showhttp.onreadystatechange = rpost;		showhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		mdata = section+"="+mvalue;	showhttp.send(mdata);}
function rlogout(){if (showhttp.readyState == 4){ if (showhttp.status == 200) {	var result = showhttp.responseText; window.location.reload();document.getElementById("hiddendiv").innerHTML='<script language="javascript">alert("aa");</script>';} else { alert("点太快了，休息下。");}}}

function AddSiteClickcount(deptid)
{
	Post('/ajaxpost.php',"dept_id",deptid,raddcount);
}
function raddcount()
{
	if (showhttp.readyState == 4)
	{ 
	  if (showhttp.status == 200) 
	  {	
	  	var result = showhttp.responseText; 
	  	//alert(result);
	  } 
	  else 
	  { 
	  	
	  }
	 }
}





function showprogramtype()
{
		document.getElementById("programtype").value=document.getElementById("selectprogramtype").value;
}

function signuppost()
{
	if(document.getElementById("programtype").value=="")	{alert("节目类型不能为空");return false;}
	if(document.getElementById("name").value=="")	{alert("节目名称型不能为空");return false;}
	if(document.getElementById("url").value=="")	{alert("节目链接不能为空");return false;}
	document.signup.submit();
}

function myKeyDown()
{
    var k=window.event.keyCode;
    if ((k==46)||(k==8)||(k==189)||(k==109)||(k==190)||(k==110)|| (k>=48 && k<=57)||(k>=96 && k<=105)||(k>=37 && k<=40)) 
    {}
    else if(k==13)
    {
         window.event.keyCode = 9;
    }
    else{
         window.event.returnValue = false;
    }
}

function check(yz)
{
		var mobile=document.getElementById("mobile").value;
		var yanzheng=yz;
		if(mobile==""){alert("联系方式不能为空！");return false;}
		if(mobile.length !=11){alert("手机号码不正确！");return false;}
		if(mobile.substring(0,2)!='13' && mobile.substring(0,2)!='15' && mobile.substring(0,2)!='18'){alert("手机号码不正确"); return false;}
		location.href='http://222.68.17.193:8080/qxt/jbs.jsp?phone='+mobile+'&content='+yanzheng+'&sign=1';	
		location.href='/dx/dx.php?mobile='+mobile+'&yanzheng='+yanzheng;
}

function zhuce(yz)
{
		var mobile=document.getElementById("mobile").value;
		var yanzheng=yz;
		var yanzhengma=document.getElementById("yanzheng").value;
		document.all.item('utype').value='zhuce';
		if(mobile==""){alert("联系方式不能为空");return false;}
		if(mobile.length!=11){alert("手机号码不正确");return false;}
		if(mobile.substring(0,2)!='13'&&mobile.substring(0,2)!='15'&&mobile.substring(0,2)!='18'){alert("手机号码不正确");return false;}
		if(yanzhengma==""){alert("验证码不能为空！");return false;}
		if(yanzhengma!=yanzheng){alert("验证码错误！");return false;}
		document.dx.submit();		
}
function closepic()
{
	document.getElementById('piao2').style.display="none";
}

function zhuxiao()
{
		var mobile=document.getElementById("mobile").value;
		document.all.item('utype').value='zhuxiao';
		if(mobile==""){alert("联系方式不能为空");return false;}
		if(mobile.length!=11){alert("手机号码不正确");return false;}
		if(mobile.substring(0,2)!='13'&& mobile.substring(0,2)!='15'&& mobile.substring(0,2)!='18'){alert("手机号码不正确");return false;}
		document.dx.submit();		
}

function tab(num)
{
	document.getElementById("zd1").style.display='none';
	document.getElementById("zd2").style.display='none';
	document.getElementById("lb1").style.display='none';
	document.getElementById("lb2").style.display='none';
	document.getElementById("zd"+num).style.display='block';
	document.getElementById("lb"+num).style.display='block';
}
