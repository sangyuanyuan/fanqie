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
		if(age==""){alert("���䲻��Ϊ�գ�");return false;}	
		if(xm==""){alert("��������Ϊ�գ�");return false;}	
		if(phone==""){alert("��ϵ��ʽ����Ϊ�գ�");return false;}	
		document.uploadfiles.submit();	
}
