function check()
{
		var buyname=document.getElementById("buyname").value;
		var spname=document.getElementById("spname").value;
		var num=document.getElementById("num").value;
		var mobile=document.getElementById("phone").value;
		var address=document.getElementById("address").value
		if(buyname==""){alert("�û���������Ϊ�գ�");return false;}
		if(spname==""){alert("��Ʒ���Ʋ���Ϊ�գ�");return false;}
		if(mobile==""){alert("��ϵ��ʽ����Ϊ�գ�");return false;}
		if(address==""){alert("�ͻ���ַ����Ϊ�գ�");return false;}
		if(num==""){alert("��������Ϊ�գ�");return false;}
		
		document.fqtg.submit();			
}