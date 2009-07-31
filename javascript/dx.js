$(document).ready(function(){
	$("#check").click(function()
	{
		var mobile=$('#mobile').attr("value");
		var yanzheng=$(this).attr("name");
		if(mobile==""){alert("联系方式不能为空！");return false;}
		if(mobile.length !=11){alert("手机号码不正确！");return false;}
		if(mobile.substring(0,2)!='13' && mobile.substring(0,2)!='15' && mobile.substring(0,2)!='18'){alert("手机号码不正确"); return false;}
		location.href='http://222.68.17.193:8080/qxt/jbs.jsp?phone='+mobile+'&content='+yanzheng+'&sign=1';	
		location.href='/dx/dx.php?mobile='+mobile+'&yanzheng='+yanzheng;
	});
	$("#zhuce").click(function(){
		var mobile=$("#mobile").attr("value");
		var yanzheng=$(this).attr("name");
		var yanzhengma=$("#yanzheng").attr("value");
		$("#utype").attr("value","zhuce");
		if(mobile==""){alert("联系方式不能为空");return false;}
		if(mobile.length!=11){alert("手机号码不正确");return false;}
		if(mobile.substring(0,2)!='13'&&mobile.substring(0,2)!='15'&&mobile.substring(0,2)!='18'){alert("手机号码不正确");return false;}
		if(yanzhengma==""){alert("验证码不能为空！");return false;}
		if(yanzhengma!=yanzheng){alert("验证码错误！");return false;}
		document.dx.submit();
	});
	$("#zhuxiao").click(function(){
		var mobile=$("#mobile").attr("value");
		$("#utype").attr("value","zhuxiao");
		if(mobile==""){alert("联系方式不能为空");return false;}
		if(mobile.length!=11){alert("手机号码不正确");return false;}
		if(mobile.substring(0,2)!='13'&& mobile.substring(0,2)!='15'&& mobile.substring(0,2)!='18'){alert("手机号码不正确");return false;}
		document.dx.submit();	
	})
	
})