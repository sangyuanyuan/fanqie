if(window.XMLHttpRequest){showhttp = new XMLHttpRequest();if (showhttp.overrideMimeType) {showhttp.overrideMimeType('text/xml');}}	else if (window.ActiveXObject){try {showhttp = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) {try {showhttp = new ActiveXObject("Microsoft.XMLHTTP");} catch (e) {}}}

function Post(url,section,mvalue,rpost){	var mdata;		if (!showhttp) { window.alert("不能创建XMLHttpRequest对象实例."); return false;	}		showhttp.open("POST", url, true);		showhttp.onreadystatechange = rpost;		showhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");		mdata = section+"="+mvalue;	showhttp.send(mdata);}
function check()
{
	var baby1='';
	var baby2='';
	var baby3='';
	var baby4='';
	var baby5='';
	var obj1=document.getElementsByName('babyx'); 
	var obj2=document.getElementsByName('babyq');
	var obj3=document.getElementsByName('babys');
	var obj4=document.getElementsByName('babyd');
	var obj5=document.getElementsByName('babyk');   
  for(i=0;i<obj1.length;i++)
  {   
  	if(obj1[i].checked)
  	{
  		baby1=obj1[i].value;    
  	}   
  }
  for(i=0;i<obj2.length;i++)
  {   
  	if(obj2[i].checked)
  	{   
  		baby2=obj2[i].value;   
  	}   
  }
  for(i=0;i<obj3.length;i++)
  {   
  	if(obj3[i].checked)
  	{   
  		baby3=obj3[i].value;    
  	}   
  }
  for(i=0;i<obj4.length;i++)
  {   
  	if(obj4[i].checked)
  	{   
  		baby4=obj4[i].value;     
  	}   
  } 
  for(i=0;i<obj5.length;i++)
  {   
  	if(obj5[i].checked)
  	{   
  		baby5=obj5[i].value;     
  	}   
  } 
	if (baby1 == '' || baby1 == null || baby2 == '' || baby2 == null || baby3 == '' || baby3 == null || baby4 == '' || baby4 == null || baby5 == '' || baby5 == null){
		 
	  alert('请选择五个宝宝！');
	  return false;
  }
	if (baby1 == baby2 || baby1 == baby3 || baby1 == baby4 || baby1 == baby5 || baby2 == baby3 || baby2 == baby4 || baby2 == baby5 || baby3 == baby4 || baby3 == baby5 || baby4 == baby5) 
	{
		alert('不能重复选择一个宝宝！');	
	  return false;
  }
	document.all.item('baby1').value = baby1;
	document.all.item('baby2').value = baby2;
	document.all.item('baby3').value = baby3;
	document.all.item('baby4').value = baby4;
	document.all.item('baby5').value = baby5;
  document.baby.submit();
}

function scheck()
{
	var baby1='';
	var baby2='';
	var baby3='';
	var baby4='';
	var baby5='';
	var obj1=document.getElementsByName('babyx'); 
	var obj2=document.getElementsByName('babyq');
	var obj3=document.getElementsByName('babys');
	var obj4=document.getElementsByName('babyd');
	var obj5=document.getElementsByName('babyk');   
  for(i=0;i<obj1.length;i++)
  {   
  	if(obj1[i].checked)
  	{
  		baby1=obj1[i].value;  
  	}   
  }
  for(i=0;i<obj2.length;i++)
  {   
  	if(obj2[i].checked)
  	{   
  		baby2=obj2[i].value;   
  	}   
  }
  for(i=0;i<obj3.length;i++)
  {  
  	if(obj3[i].checked)
  	{   
  		baby3=obj3[i].value;
  	}   
  }
  for(i=0;i<obj4.length;i++)
  {   
  	if(obj4[i].checked)
  	{   
  		baby4=obj4[i].value;     
  	}   
  } 
  for(i=0;i<obj5.length;i++)
  {   
  	if(obj5[i].checked)
  	{   
  		baby5=obj5[i].value;     
  	}   
  }
	if (baby1 == '' || baby1 == null || baby2 == '' || baby2 == null || baby3 == '' || baby3 == null || baby4 == '' || baby4 == null || baby5 == '' || baby5 == null){
		 
	  alert('请选择五个奖项！');
	  return false;
  }
	document.all.item('baby1').value = baby1;
	document.all.item('baby2').value = baby2;
	document.all.item('baby3').value = baby3;
	document.all.item('baby4').value = baby4;
	document.all.item('baby5').value = baby5;
  document.baby.submit();
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

function ck()
{
    document.location="babyresult.php"
}

function sck()
{
    document.location="3sresult.php?id=1"
}

function signuppost()
{
		var xm=document.getElementById("name").value;
		if(xm==""){alert("姓名不能为空");return false;}	
		document.uploadfiles.submit();			
}

function signuppost1()
{
		document.uploadfiles.submit();			
}

