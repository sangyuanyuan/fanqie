function signuppost()
{
		for(i=0;i<document.uploadfiles.sex.length;i++)
		{
			if(document.uploadfiles.sex[i].checked)
				document.getElementById("xb").value=document.uploadfiles.sex[i].value;
		}
		var xm=document.getElementById("name").value;
		var age=document.getElementById("age").value;
		var phone=document.getElementById("phone").value;
		if(age==""){alert("年龄不能为空！");return false;}	
		if(xm==""){alert("姓名不能为空！");return false;}	
		if(phone==""){alert("联系方式不能为空！");return false;}	
		document.uploadfiles.submit();	
}
