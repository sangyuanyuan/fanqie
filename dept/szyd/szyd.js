function checkform() { 
if(addform.from.value != '') { 
if(!Isyx(addform.from.value)){ 
alert("请输入正确的邮箱地址!") 
addform.from.focus(); 
return false; 
}
else
{
	document.addform.submit();	
}
}
else
{
	alert('发件人邮箱不能为空！');
	addform.from.focus(); 
	return false;
}
	
} 

function Isyx(yx){ 
var reyx= /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
return(reyx.test(yx)); 
} 