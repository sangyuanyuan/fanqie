function checkform() { 
if(addform.from.value != '') { 
if(!Isyx(addform.from.value)){ 
alert("��������ȷ�������ַ!") 
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
	alert('���������䲻��Ϊ�գ�');
	addform.from.focus(); 
	return false;
}
	
} 

function Isyx(yx){ 
var reyx= /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/; 
return(reyx.test(yx)); 
} 